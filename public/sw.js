// Service Worker for Tulip Website
const CACHE_NAME = 'tulip-v11';
const OFFLINE_PAGE = '/offline-simple.html';

// Check if in development environment
const isDevelopment = () => {
  return self.location.hostname.includes('localhost') ||
    self.location.hostname.includes('.test') ||
    self.location.hostname.includes('127.0.0.1');
};

// Development-only logging
const devLog = (message) => {
  if (isDevelopment()) {
    devLog(message);
  }
};

// Essential files to cache
const STATIC_CACHE_URLS = [
  OFFLINE_PAGE,
  '/manifest.json'
];

// Install event - cache essential files
self.addEventListener('install', event => {
  devLog('🚀 SW: Installing...');

  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => {
        devLog('📦 SW: Caching essential files...');
        return cache.addAll(STATIC_CACHE_URLS);
      })
      .then(() => {
        devLog('✅ SW: Installation complete');
        return self.skipWaiting();
      })
      .catch(error => {
        console.error('❌ SW: Install failed', error);
      })
  );
});

// Activate event - clean old caches and take control
self.addEventListener('activate', event => {
  devLog('🔄 SW: Activating...');

  event.waitUntil(
    caches.keys()
      .then(cacheNames => {
        return Promise.all(
          cacheNames.map(cacheName => {
            if (cacheName !== CACHE_NAME) {
              devLog('🗑️ SW: Deleting old cache:', cacheName);
              return caches.delete(cacheName);
            }
          })
        );
      })
      .then(() => {
        devLog('✅ SW: Activated and controlling all pages');
        return self.clients.claim();
      })
  );
});

// Fetch event - handle all network requests
self.addEventListener('fetch', event => {
  const { request } = event;

  // Skip non-GET requests
  if (request.method !== 'GET') return;

  // Skip external requests
  if (!request.url.startsWith(self.location.origin)) return;

  // Skip service worker file itself
  if (request.url.includes('/sw.js')) return;

  devLog('🔍 SW: Intercepting request: ' + new URL(request.url).pathname);

  event.respondWith(handleFetch(request));
});

// Main fetch handler
async function handleFetch(request) {
  const url = new URL(request.url);

  // For page requests, use Network First strategy for fresh data
  if (isPageRequest(request)) {
    devLog('🌐 SW: Page request for: ' + url.pathname);

    // Try network first to get fresh data
    try {
      devLog('🌐 SW: Fetching fresh page from network: ' + url.pathname);

      // Set a shorter timeout for network requests to fail fast when offline
      const controller = new AbortController();
      const timeoutId = setTimeout(() => controller.abort(), 3000); // 3 second timeout

      const networkResponse = await fetch(request, {
        signal: controller.signal
      });

      clearTimeout(timeoutId);

      if (networkResponse.ok) {
        devLog('✅ SW: Fresh page fetched, updating cache...');
        await cacheResponse(request, networkResponse.clone());
        return networkResponse;
      } else {
        devLog('⚠️ SW: Server error (status: ' + networkResponse.status + ')');

        // Handle different error types
        if (networkResponse.status >= 500 && networkResponse.status < 600) {
          // Server errors (500, 502, 503, etc.) - show the actual error
          devLog('🚨 SW: Server error detected, showing Laravel error page');
          return networkResponse;
        } else if (networkResponse.status === 404) {
          // 404 errors - try cache first, then show error
          devLog('🔍 SW: 404 error, checking cache first');
          const cachedResponse = await caches.match(request);
          if (cachedResponse) {
            devLog('✅ SW: Serving cached page for 404: ' + url.pathname);
            return cachedResponse;
          } else {
            devLog('📄 SW: No cached page, showing 404 error');
            return networkResponse;
          }
        } else {
          // Other client errors (401, 403, etc.) - show the error
          devLog('🚫 SW: Client error, showing error page');
          return networkResponse;
        }
      }
    } catch (error) {
      devLog('❌ SW: Network completely failed, checking cache first: ' + error.message);

      // Try to serve from cache first before showing offline page
      const cachedResponse = await caches.match(request);
      if (cachedResponse) {
        devLog('✅ SW: Serving cached page while offline: ' + url.pathname);
        return cachedResponse;
      } else {
        devLog('📱 SW: No cached page found, showing offline page');
        return getOfflinePage();
      }
    }
  }

  // For other resources (CSS, JS, images, etc.)
  try {
    // Try cache first
    const cachedResponse = await caches.match(request);
    if (cachedResponse) {
      devLog('📦 SW: Serving from cache:', url.pathname);
      return cachedResponse;
    }

    // Try network
    devLog('🌐 SW: Fetching from network:', url.pathname);
    const networkResponse = await fetch(request);

    // Cache successful responses
    if (networkResponse.ok) {
      await cacheResponse(request, networkResponse.clone());
    }

    return networkResponse;

  } catch (error) {
    devLog('❌ SW: Network failed for resource:', url.pathname);

    // Return error for resources
    return new Response('Offline', {
      status: 503,
      statusText: 'Service Unavailable'
    });
  }
}

// Cache successful responses
async function cacheResponse(request, response) {
  try {
    const cache = await caches.open(CACHE_NAME);

    // For HTML pages, ALWAYS cache regardless of headers (force caching)
    if (isPageRequest(request)) {
      // Read the response body
      const responseBody = await response.clone().text();

      // Create a clean response without problematic headers
      const cleanResponse = new Response(responseBody, {
        status: response.status,
        statusText: response.statusText,
        headers: {
          'Content-Type': 'text/html; charset=utf-8',
          'Cache-Control': 'max-age=3600' // Cache for 1 hour
        }
      });

      await cache.put(request, cleanResponse);
      devLog('💾 SW: Cached page (forced):', request.url);
      return;
    }

    // For other resources, check headers
    const vary = response.headers.get('vary');
    if (vary === '*') {
      devLog('⚠️ SW: Skipping resource cache due to Vary: *');
      return;
    }

    const cacheControl = response.headers.get('cache-control');
    if (cacheControl?.includes('no-store')) {
      devLog('⚠️ SW: Skipping resource cache due to no-store');
      return;
    }

    await cache.put(request, response);
    devLog('💾 SW: Cached:', request.url);

  } catch (error) {
    devLog('⚠️ SW: Cache failed:', error.message);
  }
}

// Check if request is for a page
function isPageRequest(request) {
  // Primary check: navigation requests
  if (request.mode === 'navigate') {
    return true;
  }

  // Secondary check: document destination
  if (request.destination === 'document') {
    return true;
  }

  // Check Accept header for HTML
  const acceptHeader = request.headers.get('accept');
  if (acceptHeader && acceptHeader.includes('text/html')) {
    return true;
  }

  // Check URL patterns for pages (no file extension or common page paths)
  const url = new URL(request.url);
  const pathname = url.pathname;

  // Skip API endpoints and assets
  if (pathname.includes('/api/') ||
    pathname.includes('/assets/') ||
    pathname.includes('/_debugbar/') ||
    pathname.includes('/sw.js')) {
    return false;
  }

  // Check for file extensions (not a page if it has common file extensions)
  const fileExtensions = /\.(js|css|png|jpg|jpeg|gif|svg|ico|woff|woff2|ttf|eot|json|xml|txt|pdf|webp|avif|bmp)$/i;
  if (fileExtensions.test(pathname)) {
    return false;
  }

  // If it's a GET request and doesn't match exclusions, treat as page
  return request.method === 'GET';
}

// Get offline page - always fetch fresh version
async function getOfflinePage() {
  try {
    // First try to fetch fresh offline page
    devLog('📱 SW: Fetching fresh offline page...');
    const freshOfflinePage = await fetch(OFFLINE_PAGE);

    if (freshOfflinePage.ok) {
      devLog('✅ SW: Serving fresh offline page');
      // Cache the fresh version
      const cache = await caches.open(CACHE_NAME);
      await cache.put(OFFLINE_PAGE, freshOfflinePage.clone());
      return freshOfflinePage;
    }
  } catch (error) {
    devLog('⚠️ SW: Could not fetch fresh offline page, trying cache...');
  }

  // Fallback to cached version
  try {
    const cache = await caches.open(CACHE_NAME);
    const cachedPage = await cache.match(OFFLINE_PAGE);

    if (cachedPage) {
      devLog('📱 SW: Serving cached offline page');
      return cachedPage;
    }
  } catch (error) {
    devLog('⚠️ SW: Could not get cached offline page');
  }

  // Fallback offline response
  return new Response(`
    <!DOCTYPE html>
    <html lang="ar" dir="rtl">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>غير متصل - Tulip</title>
      <style>
        body { 
          font-family: Arial, sans-serif; 
          text-align: center; 
          padding: 50px; 
          background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
          color: white;
          margin: 0;
          min-height: 100vh;
          display: flex;
          align-items: center;
          justify-content: center;
        }
        .container { 
          background: rgba(255,255,255,0.1); 
          padding: 40px; 
          border-radius: 15px; 
          backdrop-filter: blur(10px);
          max-width: 500px;
        }
        h1 { font-size: 2.5rem; margin-bottom: 20px; }
        p { font-size: 1.2rem; margin-bottom: 30px; opacity: 0.9; }
        button { 
          background: #fff; 
          color: #667eea; 
          border: none; 
          padding: 15px 30px; 
          border-radius: 25px; 
          font-size: 1.1rem;
          cursor: pointer;
          transition: transform 0.2s;
        }
        button:hover { transform: translateY(-2px); }
      </style>
    </head>
    <body>
      <div class="container">
        <h1>📡 غير متصل</h1>
        <p>لا يمكن الوصول للإنترنت حالياً</p>
        <button onclick="window.location.reload()">🔄 إعادة المحاولة</button>
      </div>
      <script>
        window.addEventListener('online', () => window.location.reload());
      </script>
    </body>
    </html>
  `, {
    headers: { 'Content-Type': 'text/html; charset=utf-8' }
  });
}

// Handle messages from main thread
self.addEventListener('message', event => {
  if (event.data?.type === 'SKIP_WAITING') {
    self.skipWaiting();
  } else if (event.data?.type === 'REFRESH_CACHE') {
    // Force refresh specific page cache
    const url = event.data.url;
    refreshPageCache(url);
  } else if (event.data?.type === 'CLAIM_CLIENTS') {
    // Force claim all clients immediately
    devLog('🔄 SW: Claiming all clients...');
    self.clients.claim();
  }
});

// Function to refresh page cache
async function refreshPageCache(url) {
  try {
    devLog('🔄 SW: Refreshing cache for:', url);
    const request = new Request(url);
    const response = await fetch(request);

    if (response.ok) {
      await cacheResponse(request, response.clone());
      devLog('✅ SW: Cache refreshed for:', url);
    }
  } catch (error) {
    devLog('⚠️ SW: Failed to refresh cache:', error.message);
  }
}

// Periodic cache refresh (every 30 minutes)
setInterval(async () => {
  try {
    const cache = await caches.open(CACHE_NAME);
    const requests = await cache.keys();

    // Only refresh HTML pages, not resources
    const pageRequests = requests.filter(req =>
      req.url.includes('/en') ||
      req.url.includes('/ar') ||
      req.url.endsWith('/')
    );

    devLog(`🔄 SW: Background refresh for ${pageRequests.length} pages`);

    // Refresh up to 5 pages to avoid overwhelming
    for (const request of pageRequests.slice(0, 5)) {
      try {
        const response = await fetch(request);
        if (response.ok) {
          await cacheResponse(request, response.clone());
          devLog('🔄 SW: Background updated:', request.url);
        }
      } catch (error) {
        // Silently fail for background updates
      }
    }
  } catch (error) {
    devLog('⚠️ SW: Background refresh failed:', error.message);
  }
}, 30 * 60 * 1000); // 30 minutes

devLog('✅ SW: Script loaded');
