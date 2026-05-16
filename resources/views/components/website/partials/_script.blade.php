<!-- JavaScript -->
    <script src="{{ Path::js('jquery-3.7.1.min.js') }}"></script>
    <script src="{{ Path::js('jquery-migrate-3.5.0.min.js') }}"></script>
    <script src="{{ Path::js('modernizr-2.6.2.min.js') }}"></script>
    <script src="{{ Path::js('imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ Path::js('jquery.isotope.v3.0.2.js') }}"></script>
    <script src="{{ Path::js('popper.min.js') }}"></script>
    <script src="{{ Path::js('bootstrap.min.js') }}"></script>
    <script src="{{ Path::js('scrollIt.min.js') }}"></script>
    <script src="{{ Path::js('jquery.waypoints.min.js') }}"></script>
    <script src="{{ Path::js('owl.carousel.min.js') }}"></script>
    <script src="{{ Path::js('jquery.stellar.min.js') }}"></script>
    <script src="{{ Path::js('jquery.magnific-popup.js') }}"></script>
    <script src="{{ Path::js('YouTubePopUp.js') }}"></script>
    <script src="{{ Path::js('vegas.slider.min.js') }}"></script>
    <script src="{{ Path::js('custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1/dist/fancybox/fancybox.umd.js"></script>
    <!-- End Javascript -->


    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <x-dashboard.partials.toastr-notifications />

    <script>
        let recaptchaLoaded = false;

        function loadRecaptcha() {
            if (recaptchaLoaded) return;
            recaptchaLoaded = true;

            const script = document.createElement('script');
            script.src = "https://www.google.com/recaptcha/api.js?onload=onRecaptchaLoadCallback&render=explicit";
            script.async = true;
            script.defer = true;
            document.body.appendChild(script);
        }

        function onRecaptchaLoadCallback() {
            grecaptcha.render(document.querySelector('.g-recaptcha'), {
                'sitekey': "{{ config('captcha.sitekey') }}"
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector(".contact-form");
            if (form) {
                form.addEventListener("focusin", loadRecaptcha, {
                    once: true
                });
            }
        });
        Fancybox.bind('[data-fancybox]', {
        // Your custom options
      });    
    </script>
