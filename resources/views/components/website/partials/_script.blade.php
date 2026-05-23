<!-- JavaScript -->

<!-- JS here -->
<script src="{{ Path::js('vendor/jquary-3.7.1.min.js') }}"></script>
<script src="{{ Path::js('vendor/bootstrap-bundle.js') }}"></script>
<script src="{{ Path::js('vendor/imagesloaded-pkgd.js') }}"></script>
<script src="{{ Path::js('vendor/waypoints.min.js') }}"></script>
<script src="{{ Path::js('vendor/venobox.min.js') }}"></script>
<script src="{{ Path::js('vendor/odometer.min.js') }}"></script>
<script src="{{ Path::js('vendor/meanmenu.js') }}"></script>
<script src="{{ Path::js('vendor/jquery.isotope.js') }}"></script>
<script src="{{ Path::js('vendor/swiper.min.js') }}"></script>
<script src="{{ Path::js('vendor/split-type.min.js') }}"></script>
<script src="{{ Path::js('vendor/gsap.min.js') }}"></script>
<script src="{{ Path::js('vendor/scroll-trigger.min.js') }}"></script>
<script src="{{ Path::js('vendor/scroll-smoother.js') }}"></script>
<script src="{{ Path::js('vendor/jquery.carouselTicker.js') }}"></script>
<script src="{{ Path::js('vendor/nice-select.js') }}"></script>
<script src="{{ Path::js('vendor/three.min.js') }}"></script>
<script src="{{ Path::js('vendor/panolens.min.js') }}"></script>
<script src="{{ Path::js('vendor/jquery.event.move.min.js') }}"></script>
<script src="{{ Path::js('vendor/jquery.twentytwenty.min.js') }}"></script>
<script src="{{ Path::js('slider.js') }}"></script>
<script src="{{ Path::js('banner-process.js') }}"></script>
<script src="{{ Path::js('contact.js') }}"></script>
<script src="{{ Path::js('main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox/fancybox.umd.js"></script>
<script>
    if (typeof Swiper !== "undefined") {
                var pdGallery = document.querySelector(".pd-details-gallery");
                if (pdGallery) {
                    new Swiper(".pd-details-gallery", {
                        loop: true,
                        speed: 600,
                        slidesPerView: 1,
                        spaceBetween: 0,
                        navigation: {
                            nextEl: ".pd-details-gallery-next",
                            prevEl: ".pd-details-gallery-prev"
                        },
                        pagination: {
                            el: ".pd-details-gallery-pagination",
                            clickable: true
                        }
                    });
                }
            }
            if (typeof Fancybox !== "undefined") {
                Fancybox.bind("[data-fancybox=\"project-gallery\"]", {});
            }
</script>


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
        
        Fancybox?.bind('[data-fancybox]', {
        // Your custom options
      });    
    </script>
