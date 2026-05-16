<x-dashboard.layout :title="__('dashboard.edit') . ' ' . $service->name">

    <!-- Page Header -->
    <x-dashboard.partials.page-header :header="__('dashboard.edit') . ' ' . $service->name" :label_url="route('dashboard.services.index')" :label="__('dashboard.services')" />
    <!-- End Page Header -->

    <!-- Row-->
    <div class="row">
        <div class="col-sm-12 col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title pt-3">{{ __('dashboard.edit') . ' ' . $service->name }}</h4>
                    <div class="d-flex gap-2">
                        <a href="{{ route('dashboard.services.images.index', $service) }}" class="upload_images">
                            <button class="btn btn-primary">
                                <i class="fa fa-upload"></i>
                                {{ __('dashboard.upload_images') }}
                            </button>
                        </a>
                        <a href="{{ route('dashboard.services.tabs.index', $service) }}" class="upload_images">
                            <button class="btn btn-primary">
                                <i class="fa fa-plus"></i>
                                {{ __('dashboard.add_tabs') }}
                            </button>
                        </a>
                        <a href="{{ route('dashboard.services.benefits.index', $service) }}" class="upload_images">
                            <button class="btn btn-primary">
                                <i class="fa fa-plus"></i>
                                {{ __('dashboard.add_benefits') }}
                            </button>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('dashboard.services.update', [$service->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">

                            <div class="form-group col-md-4">
                                <label class="">{{ __('dashboard.name_en') }}</label>
                                <input class="form-control" name="name_en" type="text"
                                    value="{{ old('name_en', $service->name_en) }}"
                                    placeholder="{{ __('dashboard.name_en') }}">
                                @error('name_en')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label class="">{{ __('dashboard.name_ar') }}</label>
                                <input class="form-control" name="name_ar" type="text"
                                    value="{{ old('name_ar', $service->name_ar) }}"
                                    placeholder="{{ __('dashboard.name_ar') }}">
                                @error('name_ar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-2">
                                <label>{{ __('dashboard.order') }}</label>
                                <input class="form-control" name="order" type="number"
                                    value="{{ old('order', $service->order) }}"
                                    placeholder="{{ __('dashboard.order') }}">
                                @error('order')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-2">
                                <label for="parent">{{ __('dashboard.parent') }}</label>
                                <select class="form-control select2" name="parent_id">
                                    <option value="">{{ __('dashboard.no_parent') }}</option>
                                    @foreach ($services as $serviceItem)
                                        <option value="{{ $serviceItem->id }}"
                                            {{ old('parent_id', $service->parent_id) == $serviceItem->id ? 'selected' : '' }}>
                                            {{ $serviceItem->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <hr>
                            </div>

                            <div class="form-group col-md-6">
                                <label>{{ __('dashboard.image') }} (225px * 225px max 1mb)</label>
                                <input type="file" class="form-control" name="image" accept="image/*">
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-2">
                                <label for="">{{ __('dashboard.current_image') }}</label>
                                @if ($service->image_path)
                                    <img src="{{ $service->image_path }}" width="150" class="img-thumbnail">
                                @else
                                    <p class="text-muted">{{ __('dashboard.no_image') }}</p>
                                @endif
                            </div>

                            <div class="form-group col-md-4">
                                <label class="">{{ __('dashboard.alt_image') }}</label>
                                <input class="form-control" name="alt_image" type="text"
                                    placeholder="{{ __('dashboard.alt_image') }}"
                                    value="{{ old('alt_image', $service->alt_image) }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>{{ __('dashboard.icon') }} (50px * 50px max 1mb)</label>
                                <input type="file" class="form-control" name="icon" accept="image/*">
                                @error('icon')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-2">
                                <label for="">{{ __('dashboard.current_icon') }}</label>
                                @if ($service->icon_path)
                                    <img src="{{ $service->icon_path }}" width="150" class="img-thumbnail">
                                @else
                                    <p class="text-muted">{{ __('dashboard.no_icon') }}</p>
                                @endif
                            </div>

                            <div class="form-group col-md-4">
                                <label class="">{{ __('dashboard.alt_icon') }}</label>
                                <input class="form-control" name="alt_icon" type="text"
                                    placeholder="{{ __('dashboard.alt_icon') }}"
                                    value="{{ old('alt_icon', $service->alt_icon) }}">
                            </div>

                            <div class="col-12">
                                <hr>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.short_desc_en') }}</label>
                                <textarea class="form-control" name="short_desc_en" rows="3" placeholder="{{ __('dashboard.short_desc_en') }}">{{ old('short_desc_en', $service->short_desc_en) }}</textarea>
                                @error('short_desc_en')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.short_desc_ar') }}</label>
                                <textarea class="form-control" name="short_desc_ar" rows="3" placeholder="{{ __('dashboard.short_desc_ar') }}">{{ old('short_desc_ar', $service->short_desc_ar) }}</textarea>
                                @error('short_desc_ar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <hr>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.long_desc_en') }}</label>
                                <textarea class="form-control" id="myeditorinstance" name="long_desc_en" rows="6"
                                    placeholder="{{ __('dashboard.long_desc_en') }}">{{ old('long_desc_en', $service->long_desc_en) }}</textarea>
                                @error('long_desc_en')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.long_desc_ar') }}</label>
                                <textarea class="form-control" id="myeditorinstance" name="long_desc_ar" rows="6"
                                    placeholder="{{ __('dashboard.long_desc_ar') }}">{{ old('long_desc_ar', $service->long_desc_ar) }}</textarea>
                                @error('long_desc_ar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- AI Content Generation Section -->
                            <div class="col-12">
                                <hr>
                                <h4 class="card-title">
                                    <i class="fas fa-robot"></i> {{ __('dashboard.ai_content_generation_with_ai') }}
                                </h4>
                                <p class="text-muted">{{ __('dashboard.ai_content_description') }}</p>

                                <div class="card border-primary">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label
                                                    class="form-label">{{ __('dashboard.content_type_for_long_description') }}</label>
                                                <select class="form-control" id="aiContentType">
                                                    <option value="">{{ __('dashboard.choose_content_type') }}
                                                    </option>
                                                    <option value="detailed_description">
                                                        {{ __('dashboard.detailed_service_description') }}</option>
                                                    <option value="benefits_features">
                                                        {{ __('dashboard.service_benefits_features') }}</option>
                                                    <option value="technical_details">
                                                        {{ __('dashboard.technical_details') }}</option>
                                                    <option value="seo_content">
                                                        {{ __('dashboard.seo_optimized_content') }}</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label
                                                    class="form-label">{{ __('dashboard.required_language') }}</label>
                                                <select class="form-control" id="aiLanguage">
                                                    <option value="ar">{{ __('dashboard.arabic') }}</option>
                                                    <option value="en">English</option>
                                                    <option value="both">{{ __('dashboard.both_languages') }}
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <label
                                                    class="form-label">{{ __('dashboard.service_description_or_keywords') }}</label>
                                                <textarea class="form-control" id="aiPrompt" rows="3"
                                                    placeholder="{{ __('dashboard.service_description_placeholder') }}">{{ $service->name_ar ?: $service->name_en }}</textarea>
                                                <small
                                                    class="form-text text-muted">{{ __('dashboard.service_description_help_text') }}</small>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">{{ __('dashboard.content_length') }}</label>
                                                <select class="form-control" id="aiLength">
                                                    <option value="short">{{ __('dashboard.short_content') }}
                                                    </option>
                                                    <option value="medium" selected>
                                                        {{ __('dashboard.medium_content') }}</option>
                                                    <option value="long">{{ __('dashboard.long_content') }}</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-3 d-flex align-items-end">
                                                <button type="button" class="btn btn-primary w-100"
                                                    id="generateServiceContent">
                                                    <i
                                                        class="fas fa-magic me-2"></i>{{ __('dashboard.generate_content') }}
                                                </button>
                                            </div>

                                            <div class="col-md-12">
                                                <div id="aiGenerationStatus" class="mt-2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- AI Image Generation Section -->
                            <div class="col-12">
                                <hr>
                                <h4 class="card-title">
                                    <i class="fas fa-image"></i> {{ __('dashboard.ai_image_generation') }}
                                </h4>
                                <p class="text-muted">{{ __('dashboard.ai_image_description') }}</p>

                                <div class="card border-success">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label
                                                    class="form-label">{{ __('dashboard.image_description') }}</label>
                                                <textarea class="form-control" id="aiImagePrompt" rows="3"
                                                    placeholder="{{ __('dashboard.image_description_placeholder') }}">{{ $service->name_ar ?: $service->name_en }}</textarea>
                                                <small
                                                    class="form-text text-muted">{{ __('dashboard.image_description_help_text') }}</small>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">{{ __('dashboard.image_style') }}</label>
                                                <select class="form-control" id="aiImageStyle">
                                                    <option value="">{{ __('dashboard.choose_image_style') }}
                                                    </option>
                                                    <option value="realistic">{{ __('dashboard.realistic') }}</option>
                                                    <option value="digital-art">{{ __('dashboard.digital_art') }}
                                                    </option>
                                                    <option value="illustration">{{ __('dashboard.illustration') }}
                                                    </option>
                                                    <option value="cartoon">{{ __('dashboard.cartoon') }}</option>
                                                    <option value="photography">{{ __('dashboard.photography') }}
                                                    </option>
                                                    <option value="abstract">{{ __('dashboard.abstract') }}</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">{{ __('dashboard.image_size') }}</label>
                                                <select class="form-control" id="aiImageSize">
                                                    <option value="512x512">{{ __('dashboard.small_512x512') }}
                                                    </option>
                                                    <option value="1024x1024" selected>
                                                        {{ __('dashboard.medium_1024x1024') }}</option>
                                                    <option value="1024x1792">{{ __('dashboard.large_1024x1792') }}
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="col-md-12 mb-3 d-flex align-items-end">
                                                <button type="button" class="btn btn-success w-100"
                                                    id="generateServiceImage">
                                                    <i
                                                        class="fas fa-magic me-2"></i>{{ __('dashboard.generate_image') }}
                                                </button>
                                            </div>

                                            <div class="col-md-12">
                                                <div id="aiImageGenerationStatus" class="mt-2"></div>
                                            </div>

                                            <!-- Generated Images Display -->
                                            <div class="col-md-12 mt-3">
                                                <h5>{{ __('dashboard.generated_images') }}</h5>
                                                <div id="generatedImages" class="row">
                                                    <div class="col-12 text-center text-muted">
                                                        <p>{{ __('dashboard.no_images_generated') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                          
                           

                            <div class="row mt-3">
                                <div class="form-group col-md-3">
                                    <div class="d-flex flex-wrap gap-2">
                                        <h5 class="font-size-14 mb-3">{{ __('dashboard.publish/unpublish') }}</h5>
                                        <input type="checkbox" id="switch1" switch="none" value="1"
                                            name="status" {{ old('status', $service->status) ? 'checked' : '' }} />
                                        <label for="switch1" data-on-label="{{ __('dashboard.yes') }}"
                                            data-off-label="{{ __('dashboard.no') }}"></label>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="d-flex flex-wrap gap-2">
                                        <h5 class="font-size-14 mb-3">{{ __('dashboard.show_in_home') }}</h5>
                                        <input type="checkbox" id="switch2" switch="none" value="1"
                                            name="show_in_home"
                                            {{ old('show_in_home', $service->show_in_home) ? 'checked' : '' }} />
                                        <label for="switch2" data-on-label="{{ __('dashboard.yes') }}"
                                            data-off-label="{{ __('dashboard.no') }}"></label>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="d-flex flex-wrap gap-2">
                                        <h5 class="font-size-14 mb-3">{{ __('dashboard.show_in_header') }}</h5>
                                        <input type="checkbox" id="switch3" switch="none" value="1"
                                            name="show_in_header"
                                            {{ old('show_in_header', $service->show_in_header) ? 'checked' : '' }} />
                                        <label for="switch3" data-on-label="{{ __('dashboard.yes') }}"
                                            data-off-label="{{ __('dashboard.no') }}"></label>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="d-flex flex-wrap gap-2">
                                        <h5 class="font-size-14 mb-3">{{ __('dashboard.show_in_footer') }}</h5>
                                        <input type="checkbox" id="switch4" switch="none" value="1"
                                            name="show_in_footer"
                                            {{ old('show_in_footer', $service->show_in_footer) ? 'checked' : '' }} />
                                        <label for="switch4" data-on-label="{{ __('dashboard.yes') }}"
                                            data-off-label="{{ __('dashboard.no') }}"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr>
                                <h4 class="card-title">{{ __('dashboard.seo') }}</h4>

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="slug_en">{{ __('dashboard.slug_en') }}</label>
                                        <input type="text" autocomplete="off" class="form-control"
                                            placeholder="{{ __('dashboard.slug_en') }}" name="slug_en"
                                            value="{{ old('slug_en', $service->slug_en) }}">
                                        @error('slug_en')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>{{ __('dashboard.meta_title_en') }}</label>
                                        <textarea class="form-control" name="meta_title_en" rows="2"
                                            placeholder="{{ __('dashboard.meta_title_en') }}">{{ old('meta_title_en', $service->meta_title_en) }}</textarea>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="meta_desc_en">{{ __('dashboard.meta_desc_en') }}</label>
                                        <textarea class="form-control" name="meta_desc_en" rows="2"
                                            placeholder="{{ __('dashboard.meta_desc_en') }}">{{ old('meta_desc_en', $service->meta_desc_en) }}</textarea>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>{{ __('dashboard.slug_ar') }}</label>
                                        <input type="text" autocomplete="off" class="form-control"
                                            placeholder="{{ __('dashboard.slug_ar') }}" name="slug_ar"
                                            value="{{ old('slug_ar', $service->slug_ar) }}">
                                        @error('slug_ar')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>{{ __('dashboard.meta_title_ar') }}</label>
                                        <textarea class="form-control" name="meta_title_ar" rows="2"
                                            placeholder="{{ __('dashboard.meta_title_ar') }}">{{ old('meta_title_ar', $service->meta_title_ar) }}</textarea>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>{{ __('dashboard.meta_desc_ar') }}</label>
                                        <textarea class="form-control" name="meta_desc_ar" rows="2"
                                            placeholder="{{ __('dashboard.meta_desc_ar') }}">{{ old('meta_desc_ar', $service->meta_desc_ar) }}</textarea>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="d-flex flex-wrap gap-2">
                                            <h5 class="font-size-14 mb-3">{{ __('dashboard.meta_robots') }} (index)
                                            </h5>
                                            <input type="checkbox" id="switch5" switch="none" value="1"
                                                name="index"
                                                {{ old('index', $service->index) ? 'checked' : '' }} />
                                            <label for="switch5" data-on-label="{{ __('dashboard.yes') }}"
                                                data-off-label="{{ __('dashboard.no') }}"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-success">
                                    <i class="icon-note"></i> {{ __('dashboard.update') }}
                                </button>
                                <button type="reset" class="btn btn-danger ms-2">
                                    <i class="icon-trash"></i> {{ __('dashboard.cancel') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->

    @section('script')
       


        {{-- إعداد المتغيرات العامة --}}
        <script type="text/javascript">
            // إعداد البيانات الأساسية
            window.serviceId = "{{ $service->id ?? '' }}";
            window.routes = {
               
              
                generateAI: "{{ route('dashboard.ai-content.generate') }}",
                saveImageToService: "{{ route('dashboard.ai-content.save-image-to-service') }}"
            };

            // ترجمات للاستخدام في JavaScript
            window.translations = {
                select_all: "{{ __('dashboard.select_all') }}",
                unselect_all: "{{ __('dashboard.unselect_all') }}",
                please_select_images_to_delete: "{{ __('dashboard.please_select_images_to_delete') }}",
                confirm_delete_selected_images: "{{ __('dashboard.confirm_delete_selected_images') }}",
                confirm_delete_all_images: "{{ __('dashboard.confirm_delete_all_images') }}",
                confirm_delete_this_image: "{{ __('dashboard.confirm_delete_this_image') }}",
                order_changed: "{{ __('dashboard.order_changed') }}",
                no_images_to_save_order: "{{ __('dashboard.no_images_to_save_order') }}",
                order_saved_successfully: "{{ __('dashboard.order_saved_successfully') }}",
                error_saving_order: "{{ __('dashboard.error_saving_order') }}",
                error_occurred_during_deletion: "{{ __('dashboard.error_occurred_during_deletion') }}",
                max_image_size_1mb: "{{ __('dashboard.max_image_size_1mb') }}",
                please_choose_content_type: "{{ __('dashboard.please_choose_content_type') }}",
                please_enter_service_description: "{{ __('dashboard.please_enter_service_description') }}",
                generating: "{{ __('dashboard.generating') }}",
                generating_content: "{{ __('dashboard.generating_content') }}",
                content_generated_successfully: "{{ __('dashboard.content_generated_successfully') }}",
                failed_to_generate_content: "{{ __('dashboard.failed_to_generate_content') }}",
                content_generation_error: "{{ __('dashboard.content_generation_error') }}",
                session_expired_reload_page: "{{ __('dashboard.session_expired_reload_page') }}",
                server_error: "{{ __('dashboard.server_error') }}",
                service_not_available: "{{ __('dashboard.service_not_available') }}",
                please_enter_image_description: "{{ __('dashboard.please_enter_image_description') }}",
                please_choose_image_style: "{{ __('dashboard.please_choose_image_style') }}",
                generating_image: "{{ __('dashboard.generating_image') }}",
                image_generated_successfully: "{{ __('dashboard.image_generated_successfully') }}",
                failed_to_generate_image: "{{ __('dashboard.failed_to_generate_image') }}",
                image_generation_error: "{{ __('dashboard.image_generation_error') }}",
                download_image: "{{ __('dashboard.download_image') }}",
                use_as_service_image: "{{ __('dashboard.use_as_service_image') }}",
                use_as_service_icon: "{{ __('dashboard.use_as_service_icon') }}",
                saving: "{{ __('dashboard.saving') }}",
                saved: "{{ __('dashboard.saved') }}",
                save_failed: "{{ __('dashboard.save_failed') }}",
                error_during_save: "{{ __('dashboard.error_during_save') }}",
                success: "{{ __('dashboard.success') }}",
                page_reload_to_show_updates: "{{ __('dashboard.page_reload_to_show_updates') }}",
                page_will_reload: "{{ __('dashboard.page_will_reload') }}",
                reloading: "{{ __('dashboard.reloading') }}"
            };

            // إعداد CSRF token
            window.csrfToken = "{{ csrf_token() }}";

            // تفعيل وضع التشخيص إذا كان في URL
            window.debugMode = new URLSearchParams(window.location.search).has('debug');
        </script>

      

        <script>
            // CSRF Token
            var token = $('meta[name="csrf-token"]').attr('content') || '{{ csrf_token() }}';

            // AI Content Generation
            $('#generateServiceContent').on('click', function(e) {
                e.preventDefault();

                // Get form values
                var contentType = $('#aiContentType').val();
                var prompt = $('#aiPrompt').val().trim();
                var language = $('#aiLanguage').val();
                var length = $('#aiLength').val();

                // Auto-fill prompt from service names if empty
                if (!prompt) {
                    var nameEn = $('input[name="name_en"]').val();
                    var nameAr = $('input[name="name_ar"]').val();
                    if (nameAr) {
                        prompt = nameAr;
                        $('#aiPrompt').val(prompt);
                    } else if (nameEn) {
                        prompt = nameEn;
                        $('#aiPrompt').val(prompt);
                    }
                }

                // Validation
                if (!contentType) {
                    alert('يرجى اختيار نوع المحتوى');
                    return;
                }

                if (!prompt) {
                    alert('يرجى إدخال وصف الخدمة أو اسم الخدمة أولاً');
                    return;
                }

                // Show loading state
                var $btn = $(this);
                var originalText = $btn.html();
                $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>جاري التوليد...');

                // Add loading class to the form
                $('.card').addClass('ai-loading');

                // Create the prompt based on content type and language
                var fullPrompt = createAIPrompt(contentType, prompt, language, length);

                // Show status
                showStatus('جاري توليد المحتوى...', 'info');

                // AJAX request to generate content
                $.ajax({
                    url: '{{ route('dashboard.ai-content.generate') }}',
                    method: 'POST',
                    data: {
                        type: 'service_content',
                        prompt: fullPrompt,
                        content_type: contentType,
                        language: language,
                        length: length,
                        options: {
                            max_tokens: getTokensByLength(length),
                            temperature: 0.7
                        },
                        _token: token
                    },
                    success: function(response) {
                        console.log('AI Response:', response);

                        if (response.success && response.content) {
                            var content = response.content.content || response.content;

                            // Apply content based on language selection
                            applyGeneratedContent(content, language, contentType);

                            showStatus('تم توليد المحتوى بنجاح!', 'success');

                        } else {
                            var errorMsg = response.error || response.message || 'فشل في توليد المحتوى';
                            showStatus(errorMsg, 'danger');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AI Generation Error:', {
                            xhr,
                            status,
                            error
                        });

                        var errorMsg = 'حدث خطأ في توليد المحتوى';

                        if (xhr.status === 419) {
                            errorMsg = 'انتهت صلاحية الصفحة، يرجى إعادة تحميل الصفحة';
                        } else if (xhr.status === 500) {
                            errorMsg = 'خطأ في الخادم';
                        } else if (xhr.status === 404) {
                            errorMsg = 'الخدمة غير متوفرة حالياً';
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }

                        showStatus(errorMsg, 'danger');
                    },
                    complete: function() {
                        // Restore button state
                        $btn.prop('disabled', false).html(originalText);
                        $('.card').removeClass('ai-loading');
                    }
                });
            });

            // Helper function to create AI prompt
            function createAIPrompt(contentType, prompt, language, length) {
                var basePrompt = '';
                var languageInstruction = '';
                var formattingInstruction =
                    'نسق النص باستخدام HTML tags مناسبة مثل <h2>, <h3>, <p>, <ul>, <li>, <strong>, <em> لجعل المحتوى منظم وسهل القراءة.';

                // Set language instruction
                if (language === 'ar') {
                    languageInstruction = 'اكتب النص باللغة العربية فقط.';
                } else if (language === 'en') {
                    languageInstruction =
                        'Write the text in English only. Format the text using appropriate HTML tags like <h2>, <h3>, <p>, <ul>, <li>, <strong>, <em> to make the content organized and easy to read.';
                    formattingInstruction = ''; // Already included in English instruction
                } else {
                    languageInstruction = 'اكتب النص باللغة العربية أولاً، ثم بالإنجليزية.';
                }

                // Create prompt based on content type
                switch (contentType) {
                    case 'detailed_description':
                        basePrompt =
                            `اكتب وصف تفصيلي ومفصل لخدمة: ${prompt}. يجب أن يكون الوصف جذاب ومفيد للعملاء المحتملين، يشرح طبيعة الخدمة وفوائدها. استخدم عناوين فرعية وقوائم منظمة.`;
                        break;
                    case 'benefits_features':
                        basePrompt =
                            `اكتب عن فوائد ومميزات خدمة: ${prompt}. ركز على القيمة المضافة والمزايا التنافسية التي تقدمها هذه الخدمة للعملاء. استخدم قوائم نقطية لعرض الفوائد بوضوح.`;
                        break;
                    case 'technical_details':
                        basePrompt =
                            `اكتب التفاصيل التقنية والمواصفات لخدمة: ${prompt}. يجب أن يكون النص دقيق ومفصل تقنياً ومفهوم للمختصين. استخدم عناوين فرعية وقوائم للمواصفات.`;
                        break;
                    case 'seo_content':
                        basePrompt =
                            `اكتب محتوى محسن لمحركات البحث عن خدمة: ${prompt}. استخدم الكلمات المفتاحية بشكل طبيعي ومفيد للعملاء. استخدم عناوين H2 و H3 وقوائم منظمة لتحسين SEO.`;
                        break;
                    default:
                        basePrompt = `اكتب وصف شامل عن خدمة: ${prompt}. استخدم تنسيق HTML مناسب.`;
                }

                return `${basePrompt} ${languageInstruction} ${formattingInstruction}`;
            }

            // Helper function to get tokens by length
            function getTokensByLength(length) {
                switch (length) {
                    case 'short':
                        return 300; // زيادة من 150 إلى 300
                    case 'medium':
                        return 800; // زيادة من 400 إلى 800
                    case 'long':
                        return 2000; // زيادة من 600 إلى 1500
                    default:
                        return 1500;
                }
            }

            // Helper function to apply generated content
            function applyGeneratedContent(content, language, contentType) {
                console.log('Applying generated content:', {
                    content,
                    language,
                    contentType
                });

                if (language === 'both') {
                    // Try to split content for both languages
                    var splitContent = splitBilingualContent(content);
                    if (splitContent.ar && splitContent.en) {
                        applyToFields(formatContentForEditor(splitContent.ar), 'ar', contentType);
                        applyToFields(formatContentForEditor(splitContent.en), 'en', contentType);
                    } else {
                        // If splitting fails, apply to Arabic fields
                        applyToFields(formatContentForEditor(content), 'ar', contentType);
                    }
                } else {
                    applyToFields(formatContentForEditor(content), language, contentType);
                }
            }

            // Helper function to format content for better display in TinyMCE
            function formatContentForEditor(content) {
                if (!content) return content;

                // If content doesn't have HTML tags, add basic formatting
                if (!content.includes('<') && !content.includes('>')) {
                    // Split by double line breaks for paragraphs
                    let paragraphs = content.split(/\n\n+/);
                    let formattedContent = '';

                    for (let para of paragraphs) {
                        if (para.trim()) {
                            // Check if it looks like a heading (short line, often ends with :)
                            if (para.length < 100 && (para.includes(':') || para.match(/^[\u0600-\u06FF\s]+$/))) {
                                formattedContent += `<h3>${para.trim()}</h3>\n`;
                            }
                            // Check if it looks like a list item (starts with • or -)
                            else if (para.includes('•') || para.includes('-')) {
                                let listItems = para.split(/[•-]/);
                                if (listItems.length > 1) {
                                    formattedContent += '<ul>\n';
                                    for (let item of listItems) {
                                        if (item.trim()) {
                                            formattedContent += `<li>${item.trim()}</li>\n`;
                                        }
                                    }
                                    formattedContent += '</ul>\n';
                                } else {
                                    formattedContent += `<p>${para.trim()}</p>\n`;
                                }
                            } else {
                                formattedContent += `<p>${para.trim()}</p>\n`;
                            }
                        }
                    }

                    return formattedContent;
                } else {
                    // Content already has HTML tags, just clean it up
                    return content.replace(/\n\n+/g, '\n').trim();
                }
            }

            // Helper function to split bilingual content
            function splitBilingualContent(content) {
                // Try to split by common patterns
                var patterns = [
                    /(?:\n\n|\n|^)(?:English|الإنجليزية|الانجليزية|In English)/i,
                    /(?:\n\n|\n|^)(?:EN:|English:|الإنجليزية:|انجليزي:)/i
                ];

                for (var pattern of patterns) {
                    var parts = content.split(pattern);
                    if (parts.length >= 2) {
                        return {
                            ar: parts[0].trim(),
                            en: parts[1].trim()
                        };
                    }
                }

                return {
                    ar: content,
                    en: null
                };
            }

            // Helper function to apply content to specific fields with TinyMCE support
            function applyToFields(content, lang, contentType) {
                const fieldName = `long_desc_${lang}`;
                console.log(`Applying content to field: ${fieldName}`);

                // First, always update the textarea directly
                const $textarea = $(`textarea[name="${fieldName}"]`);
                if ($textarea.length > 0) {
                    $textarea.val(content);
                    console.log(`Content applied directly to textarea ${fieldName}`);
                } else {
                    console.error(`Textarea with name ${fieldName} not found!`);
                    return;
                }

                // Then try to update TinyMCE with multiple attempts
                let attemptCount = 0;
                const maxAttempts = 3;

                function tryUpdateTinyMCE() {
                    attemptCount++;
                    console.log(`TinyMCE update attempt ${attemptCount} for ${fieldName}`);

                    if (typeof tinymce !== 'undefined') {
                        console.log('TinyMCE object exists');

                        // Try different approaches to find the editor
                        let editorFound = false;

                        // Approach 1: Try to find editor by the new unique IDs
                        const possibleIds = [
                            `tinymce_editor_0_${fieldName}`,
                            `tinymce_editor_1_${fieldName}`,
                            `tinymce_editor_2_${fieldName}`
                        ];

                        for (const editorId of possibleIds) {
                            console.log(`Trying to get editor by ID: ${editorId}`);
                            try {
                                const editor = tinymce.get(editorId);
                                if (editor) {
                                    console.log(`Found editor with ID: ${editorId}`);
                                    editor.setContent(content);
                                    console.log('Content applied to TinyMCE editor successfully');
                                    return true;
                                }
                            } catch (error) {
                                console.log(`Editor ${editorId} not found or error:`, error);
                            }
                        }

                        // Approach 2: Try to find by textarea element
                        const $textarea = $(`textarea[name="${fieldName}"]`);
                        if ($textarea.length > 0) {
                            const textareaId = $textarea.attr('id');
                            console.log(`Trying to get editor by textarea ID: ${textareaId}`);

                            try {
                                const editor = tinymce.get(textareaId);
                                if (editor) {
                                    console.log(`Found editor with textarea ID: ${textareaId}`);
                                    editor.setContent(content);
                                    console.log('Content applied to TinyMCE editor successfully');
                                    return true;
                                }
                            } catch (error) {
                                console.log(`Editor with textarea ID ${textareaId} not found:`, error);
                            }
                        }

                        // Approach 3: Check all active editors (if tinymce.editors exists)
                        if (tinymce.editors) {
                            console.log('tinymce.editors:', tinymce.editors);
                            console.log('Available editors keys:', Object.keys(tinymce.editors));

                            for (let editorId in tinymce.editors) {
                                const editor = tinymce.editors[editorId];
                                if (editor && editor.getElement()) {
                                    console.log(`Editor ${editorId} element name:`, editor.getElement().name);

                                    if (editor.getElement().name === fieldName) {
                                        console.log(`Found matching editor for ${fieldName}, updating content`);
                                        try {
                                            editor.setContent(content);
                                            console.log('Content applied to TinyMCE editor successfully');
                                            return true;
                                        } catch (error) {
                                            console.error('Error setting TinyMCE content:', error);
                                        }
                                    }
                                }
                            }
                        } else {
                            console.log('tinymce.editors is undefined');
                        }

                        // Approach 4: Try to trigger load from textarea
                        console.log('All approaches failed, trying to trigger editor refresh');
                        if ($textarea.length > 0) {
                            $textarea.trigger('change');
                            console.log('Triggered change event on textarea');
                        }

                    } else {
                        console.log(`TinyMCE not defined (attempt ${attemptCount})`);
                    }

                    // If not successful and we have attempts left, try again
                    if (attemptCount < maxAttempts) {
                        setTimeout(tryUpdateTinyMCE, 1000 * attemptCount); // Increasing delay
                    } else {
                        console.log(`Failed to update TinyMCE after ${maxAttempts} attempts for ${fieldName}`);
                    }

                    return false;
                }

                // Start the TinyMCE update attempts
                setTimeout(tryUpdateTinyMCE, 500);

                // For SEO content, also apply to meta fields
                if (contentType === 'seo_content') {
                    var firstSentence = content.replace(/<[^>]*>/g, '').split(/[.!?]+/)[0]; // Remove HTML tags
                    if (firstSentence && firstSentence.length > 10) {
                        $(`textarea[name="meta_desc_${lang}"]`).val(firstSentence + '.');
                        $(`textarea[name="meta_title_${lang}"]`).val(firstSentence);
                    }
                }

                // For detailed description, also apply short description
                if (contentType === 'detailed_description') {
                    var plainText = content.replace(/<[^>]*>/g, ''); // Remove HTML tags
                    var sentences = plainText.split(/[.!?]+/).filter(s => s.trim());
                    if (sentences.length >= 2) {
                        var shortDesc = sentences.slice(0, 2).join('. ') + '.';
                        $(`textarea[name="short_desc_${lang}"]`).val(shortDesc);
                    }
                }

                // Trigger change event for any text editors
                $(`textarea[name*="${lang}"]`).trigger('change');

                console.log(`Content application completed for ${fieldName}`);
            }

            // Helper function to show status messages
            function showStatus(message, type) {
                var alertClass = {
                    'success': 'alert-success',
                    'danger': 'alert-danger',
                    'info': 'alert-info',
                    'warning': 'alert-warning'
                };

                var html = `<div class="alert ${alertClass[type] || 'alert-info'} alert-dismissible fade show" role="alert">
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>`;

                $('#aiGenerationStatus').html(html);

                // Auto hide after 5 seconds for success messages
                if (type === 'success') {
                    setTimeout(function() {
                        $('#aiGenerationStatus .alert').fadeOut();
                    }, 5000);
                }
            }
        </script>
        <script>
            // دوال للتوافق مع الكود القديم
            window.addEventListener('DOMContentLoaded', function() {
                // إضافة دوال عامة للاستخدام في أماكن أخرى
                window.showNotification = function(message, type = 'info') {
                    if (window.serviceApp) {
                        return window.serviceApp.showGlobalAlert(message, type);
                    } else {
                        alert(message);
                    }
                };

                window.confirmAction = function(message, callback) {
                    if (confirm(message)) {
                        if (typeof callback === 'function') {
                            callback();
                        }
                    }
                };

                // إضافة وظائف مساعدة للنماذج
                window.validateForm = function(formSelector) {
                    const form = document.querySelector(formSelector);
                    if (!form) return false;

                    return form.checkValidity();
                };

                window.resetForm = function(formSelector) {
                    const form = document.querySelector(formSelector);
                    if (form) {
                        form.reset();
                        // إعادة تعيين محررات TinyMCE
                        if (typeof tinymce !== 'undefined') {
                            tinymce.editors.forEach(editor => {
                                editor.setContent('');
                            });
                        }
                    }
                };

                // إضافة وظائف للتعامل مع الملفات
                window.previewImage = function(input, previewId) {
                    if (input.files && input.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById(previewId).src = e.target.result;
                        };
                        reader.readAsDataURL(input.files[0]);
                    }
                };

                // إضافة وظائف للتعامل مع الجدولة
                window.scheduleAction = function(action, delay = 1000) {
                    setTimeout(action, delay);
                };

                // إضافة دعم للاختصارات
                document.addEventListener('keydown', function(e) {
                    // Alt + H: إظهار المساعدة
                    if (e.altKey && e.key === 'h') {
                        e.preventDefault();
                        showKeyboardShortcuts();
                    }
                });

                function showKeyboardShortcuts() {
                    const shortcuts = `
            <div class="modal fade" id="shortcutsModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">اختصارات لوحة المفاتيح</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>الاختصارات العامة:</h6>
                                    <ul class="list-unstyled">
                                        <li><kbd>Ctrl</kbd> + <kbd>S</kbd> - حفظ النموذج</li>
                                        <li><kbd>Ctrl</kbd> + <kbd>G</kbd> - توليد محتوى AI</li>
                                        <li><kbd>Ctrl</kbd> + <kbd>I</kbd> - توليد صورة AI</li>
                                        <li><kbd>Esc</kbd> - إغلاق النوافذ المنبثقة</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6>المساعدة:</h6>
                                    <ul class="list-unstyled">
                                        <li><kbd>Alt</kbd> + <kbd>H</kbd> - إظهار هذه النافذة</li>
                                        <li><kbd>F5</kbd> - إعادة تحميل الصفحة</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                        </div>
                    </div>
                </div>
            </div>
        `;

                    // إضافة النافذة إذا لم تكن موجودة
                    if (!document.getElementById('shortcutsModal')) {
                        document.body.insertAdjacentHTML('beforeend', shortcuts);
                    }

                    // إظهار النافذة
                    const modal = new bootstrap.Modal(document.getElementById('shortcutsModal'));
                    modal.show();
                }

                // تسجيل أن التطبيق جاهز
                console.log('🚀 تم تحميل جميع ملفات JavaScript بنجاح');

                // إشعار المطور
                if (window.debugMode) {
                    console.log('🔧 وضع التطوير مفعل - استخدم window.devHelpers للأدوات');
                }
            });
        </script>
    @endsection

</x-dashboard.layout>
