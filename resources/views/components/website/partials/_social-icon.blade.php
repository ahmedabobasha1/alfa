<div class="social-icon position-fixed bottom-0 d-flex flex-column gap-1 z-3">
    @if ($settings['phone'])
        <a href="tel:{{ $settings['phone'] }}" class="btn d-flex align-items-center justify-content-center"
            aria-label="اتصال">
            <i class="fas fa-phone"></i>
        </a>
    @endif
        @if ($settings['site_whatsapp'])
            <a href="https://wa.me/{{ $settings['site_whatsapp'] }}" target="_blank" rel="noopener noreferrer"
                class="btn d-flex align-items-center justify-content-center" aria-label="WhatsApp">
                <i class="fab fa-whatsapp"></i>
            </a>
        @endif
</div>
