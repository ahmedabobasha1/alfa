<div class="fixed-cta-group">
    @if($settings['site_whatsapp'])
    <a href="https://wa.me/{{ $settings['site_whatsapp'] }}" class="cta-icon" target="_blank">
        <i class="fa-brands fa-whatsapp"></i>
    </a>
    @endif
    @if($settings['phone'])
    <a href="tel:{{ $settings['phone'] }}" class="cta-icon" target="_blank">
           <i class="ti-mobile"></i>
    </a>
    @endif
</div>