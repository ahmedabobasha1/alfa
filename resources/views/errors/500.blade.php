<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>خطأ في الخادم</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
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
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
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

        .error-details {
            background: rgba(0, 0, 0, 0.2);
            padding: 1.5rem;
            border-radius: 10px;
            margin: 2rem 0;
            text-align: right;
            font-family: monospace;
            font-size: 0.9rem;
            line-height: 1.4;
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

        .btn-secondary {
            background: linear-gradient(45deg, #6c757d, #495057);
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .help-section {
            background: rgba(255, 255, 255, 0.1);
            padding: 1.5rem;
            border-radius: 15px;
            margin-top: 2rem;
            text-align: right;
        }

        .help-section h3 {
            margin-bottom: 1rem;
            color: #ffc107;
        }

        .help-list {
            list-style: none;
            padding: 0;
        }

        .help-list li {
            padding: 0.5rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .help-list li:last-child {
            border-bottom: none;
        }

        .timestamp {
            font-size: 0.8rem;
            opacity: 0.7;
            margin-top: 1rem;
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
        <div class="error-icon">🚨</div>
        <h1 class="error-title">خطأ في الخادم</h1>
        <p class="error-message">
            عذراً، حدث خطأ غير متوقع في الخادم. نحن نعمل على حل هذه المشكلة.
        </p>

        @if (config('app.debug') && isset($exception))
            <div class="error-details">
                <strong>تفاصيل الخطأ:</strong><br>
                <strong>الملف:</strong> {{ $exception->getFile() }}<br>
                <strong>السطر:</strong> {{ $exception->getLine() }}<br>
                <strong>الرسالة:</strong> {{ $exception->getMessage() }}<br>
                @if ($exception->getCode())
                    <strong>الكود:</strong> {{ $exception->getCode() }}<br>
                @endif
            </div>
        @else
            <div class="error-details">
                <strong>معرف الخطأ:</strong> {{ uniqid('ERR_') }}<br>
                <strong>الوقت:</strong> {{ now()->format('Y-m-d H:i:s') }}<br>
                <strong>الصفحة:</strong> {{ request()->fullUrl() }}
            </div>
        @endif

        <div class="error-actions">
            <button class="btn btn-primary" onclick="window.location.reload()">
                🔄 إعادة المحاولة
            </button>
            <a href="/" class="btn btn-success">
                🏠 العودة للرئيسية
            </a>
            <button class="btn btn-secondary" onclick="history.back()">
                ⬅️ العودة للخلف
            </button>
        </div>

        <div class="help-section">
            <h3>💡 ماذا يمكنك فعله؟</h3>
            <ul class="help-list">
                <li>🔄 أعد تحميل الصفحة - قد تكون مشكلة مؤقتة</li>
                <li>⏰ انتظر بضع دقائق وحاول مرة أخرى</li>
                <li>🏠 عد للصفحة الرئيسية وجرب مسار آخر</li>
                <li>📞 تواصل معنا إذا استمرت المشكلة</li>
            </ul>
        </div>

        <div class="timestamp">
            🕒 {{ now()->format('Y-m-d H:i:s') }}
        </div>
    </div>

    <script>
        // Auto-refresh after 30 seconds if not in debug mode
        @if (!config('app.debug'))
            setTimeout(() => {
                if (confirm('هل تريد إعادة المحاولة تلقائياً؟')) {
                    window.location.reload();
                }
            }, 30000);
        @endif

        // Log error for tracking
        console.error('🚨 Server Error 500:', {
            url: window.location.href,
            timestamp: new Date().toISOString(),
            userAgent: navigator.userAgent
        });
    </script>
</body>

</html>
