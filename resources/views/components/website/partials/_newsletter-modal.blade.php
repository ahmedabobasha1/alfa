<div class="newsletter-modal style3 modal fade" id="newsletter_modal" tabindex="-1" aria-hidden="true">           
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-body p-0">

                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                
                <div class="newsletter-wrap d-flex flex-column">
                    <div class="newsltr-img">
                        <img class="rounded-bottom-0 blur-up lazyload"
                        data-src="{{ $newsletter_modal->image_path }}" 
                        src="{{ $newsletter_modal->image_path }}" 
                        alt="{{ $newsletter_modal->alt_image }}" title="{{ $newsletter_modal->title }}" width="582" height="202" />
                    </div>
                
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>