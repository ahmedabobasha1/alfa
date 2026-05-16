<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الصفحة غير موجودة</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #6f42c1 0%, #5a32a3 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            direction: rtl;
            text-align: center;
        }

        .error-container {
            background: rgba(255, 255, 255, 0.1);
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            max-width: 600px;
            width: 90%;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-10px);
            }

            60% {
                transform: translateY(-5px);
            }
        }

        .error-title {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .error-message {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        .error-url {
            background: rgba(0, 0, 0, 0.2);
            padding: 1rem;
            border-radius: 10px;
            margin: 1.5rem 0;
            font-family: monospace;
            font-size: 0.9rem;
            word-break: break-all;
        }

        .error-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin: 2rem 0;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(45deg, #007bff, #0056b3);
            color: white;
        }

        .btn-success {
            background: linear-gradient(45deg, #28a745, #1e7e34);
            color: white;
        }

        .btn-warning {
            background: linear-gradient(45deg, #ffc107, #e0a800);
            color: #000;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .suggestions {
            background: rgba(255, 255, 255, 0.1);
            padding: 1.5rem;
            border-radius: 15px;
            margin-top: 2rem;
            text-align: right;
        }

        .suggestions h3 {
            margin-bottom: 1rem;
            color: #ffc107;
        }

        .suggestion-links {
            display: grid;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .suggestion-links a {
            color: #17a2b8;
            text-decoration: none;
            padding: 0.5rem;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .suggestion-links a:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        @media (max-width: 768px) {
            .error-container {
                padding: 2rem;
                margin: 1rem;
            }

            .error-title {
                font-size: 2rem;
            }

            .error-actions {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>

<body>
    <div class="error-container">
        <div class="error-icon">🔍</div>
        <h1 class="error-title">404 - الصفحة غير موجودة</h1>
        <p class="error-message">
            عذراً، الصفحة التي تبحث عنها غير موجودة أو تم نقلها إلى مكان آخر.
        </p>

        <div class="error-url">
            <strong>الرابط المطلوب:</strong><br>
            {{ request()->fullUrl() }}
        </div>

        <div class="error-actions">
            <a href="/" class="btn btn-success">
                🏠 العودة للرئيسية
            </a>
            <button class="btn btn-primary" onclick="history.back()">
                ⬅️ العودة للخلف
            </button>
            <button class="btn btn-warning" onclick="searchSite()">
                🔍 البحث في الموقع
            </button>
        </div>

        <div class="suggestions">
            <h3>🔗 روابط مفيدة</h3>
            <div class="suggestion-links">
                <a href="/">🏠 الصفحة الرئيسية</a>
                <a href="/en">🌐 الصفحة الإنجليزية</a>
                <a href="/ar">🇪🇬 الصفحة العربية</a>
                <a href="/en/about-us">ℹ️ من نحن</a>
                <a href="/en/contact-us">📞 اتصل بنا</a>
                <a href="/en/services">🛠️ خدماتنا</a>
                <a href="/en/products">📦 منتجاتنا</a>
                <a href="/en/blogs">📝 المدونة</a>
            </div>
        </div>
    </div>

    <script>
        function searchSite() {
            const query = prompt('ما الذي تبحث عنه؟');
            if (query) {
                // You can customize this to your site's search functionality
                window.location.href = `/?search=${encodeURIComponent(query)}`;
            }
        }

        // Log 404 for analytics
        console.warn('📄 Page Not Found (404):', {
            url: window.location.href,
            referrer: document.referrer,
            timestamp: new Date().toISOString()
        });

        // Check if there's a similar page in cache (Service Worker feature)
        if ('serviceWorker' in navigator && navigator.serviceWorker.controller) {
            navigator.serviceWorker.controller.postMessage({
                type: 'FIND_SIMILAR_PAGE',
                url: window.location.pathname
            });
        }
    </script>
</body>

</html>
