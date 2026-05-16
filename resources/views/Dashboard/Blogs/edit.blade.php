<x-dashboard.layout :title="__('dashboard.edit') . $blog->name">

    <!-- Page Header -->
    <x-dashboard.partials.page-header :header="__('dashboard.edit') . $blog->name" :label_url="route('dashboard.blogs.index')" :label="__('dashboard.blogs')" />
    <!-- End Page Header -->


    <!-- Row-->
    <div class="row">
        <div class="col-sm-12 col-xl-12 col-lg-12">
            <div class="card ">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title pt-3">{{ __('dashboard.edit').$blog->name }}</h4>

                    <div class="btn btn-list">
                        <a href="{{ route('dashboard.blogs.images.index',$blog->id) }}"><button class="btn ripple btn-primary"><i class="fas fa-plus-circle"></i>
                                {{__('dashboard.upload_images')}}</button></a>
                        <a href="{{ route('dashboard.blogs.faqs.index',$blog->id) }}"><button class="btn ripple btn-primary"><i class="fas fa-plus-circle"></i>
                                    {{__('dashboard.faqs')}}</button>
                        </a>
    
                    </div>
                  
                </div>

                <div class="card-body">

                    <form action="{{ route('dashboard.blogs.update', [$blog->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.name_en') }}</label>
                                <input class="form-control" name="name_en" type="text" value="{{ $blog->name_en }}" placeholder="{{ __('dashboard.name_en') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.name_ar') }}</label>
                                <input class="form-control" name="name_ar" type="text" value="{{ $blog->name_ar }}" placeholder="{{ __('dashboard.name_ar') }}">
                            </div>


                            <div class="form-group col-md-3">
                                <label class="">{{ __('dashboard.order') }}</label>
                                <input class="form-control" name="order" type="number" value="{{ $blog->order }}" placeholder="{{ __('dashboard.order') }}">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="category">{{ __('dashboard.category') }}</label>
                                <select class="form-control select2" name="category_id">
                                    <option value="">{{ __('dashboard.select_category') }}</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id', $blog->category_id ?? '') == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="author">{{ __('dashboard.author') }}</label>
                                <select class="form-control select2" name="author_id">
                                    <option value="">{{ __('dashboard.select_author') }}</option>

                                    @foreach ($authors as $author)
                                    <option @selected(old('author_id')==$author->id) value="{{ $author->id }}">
                                        {{ $author->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group col-md-3">
                                <label for="date" class="form-label">{{ __('dashboard.date') }}</label>
                                <input class="form-control" type="date" name="date" value="{{ old('date') ?? $blog->date }}" placeholder="{{ __('dashboard.date') }}">
                            </div>

                            <div class=" form-group  col-md-6">
                                <label>{{ __('dashboard.image') }} (225px * 225px max 1mb)</label>
                                <input type="file" class="form-control" name="image">
                            </div>

                            <div class=" form-group  col-md-2">
                                <label for="">{{ __('dashboard.image') }}</label>
                                <img src="{{ $blog->image_path }}" width="150">
                            </div>

                            <div class="form-group col-md-4">
                                <label class="">{{ __('dashboard.alt_image') }}</label>
                                <input class="form-control" name="alt_image" type="text" placeholder="{{ __('dashboard.alt_image') }}" value="{{ $blog->alt_image }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ __('dashboard.icon') }} (50px * 50px max 1mb)</label>
                                <input type="file" class="form-control" name="icon">

                            </div>

                            <div class=" form-group  col-md-2">
                                <label for="">{{ __('dashboard.icon') }}</label>
                                <img src="{{ $blog->icon_path }}" width="150">
                            </div>

                            <div class="form-group col-md-4">
                                <label class="">{{ __('dashboard.alt_icon') }}</label>
                                <input class="form-control" name="alt_icon" type="text" placeholder="{{ __('dashboard.alt_icon') }}" value="{{ $blog->alt_icon }}">
                            </div>


                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.short_desc_en') }}</label>
                                <textarea class="form-control" name="short_desc_en" type="text" placeholder="{{ __('dashboard.short_desc_en') }}">{!! $blog->short_desc_en !!}</textarea>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.short_desc_ar') }}</label>
                                <textarea class="form-control" name="short_desc_ar" type="text" placeholder="{{ __('dashboard.short_desc_ar') }}">{!! $blog->short_desc_ar !!}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.long_desc_en') }}</label>
                                <textarea class="form-control" id="myeditorinstance" name="long_desc_en" rows="6" placeholder="{{ __('dashboard.long_desc_en') }}">{!! $blog->long_desc_en !!}</textarea>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.long_desc_ar') }}</label>
                                <textarea class="form-control" id="myeditorinstance" name="long_desc_ar" rows="6" placeholder="{{ __('dashboard.long_desc_ar') }}">{!! $blog->long_desc_ar !!}</textarea>
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
                                                <label class="form-label">{{ __('dashboard.content_type_for_long_description') }}</label>
                                                <select class="form-control" id="aiContentType">
                                                    <option value="">{{ __('dashboard.choose_content_type') }}
                                                    </option>
                                                    <option value="detailed_article">
                                                        {{ __('dashboard.detailed_article_content') }}</option>
                                                    <option value="news_article">
                                                        {{ __('dashboard.news_article_format') }}</option>
                                                    <option value="tutorial_guide">
                                                        {{ __('dashboard.tutorial_guide') }}</option>
                                                    <option value="seo_article">
                                                        {{ __('dashboard.seo_optimized_article') }}</option>
                                                    <option value="blog_post">{{ __('dashboard.blog_post_format') }}
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">{{ __('dashboard.required_language') }}</label>
                                                <select class="form-control" id="aiLanguage">
                                                    <option value="ar">{{ __('dashboard.arabic') }}</option>
                                                    <option value="en">English</option>
                                                    <option value="both">{{ __('dashboard.both_languages') }}
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">{{ __('dashboard.article_topic_or_keywords') }}</label>
                                                <textarea class="form-control" id="aiPrompt" rows="3" placeholder="{{ __('dashboard.article_topic_placeholder') }}">{{ $blog->name_ar ?: $blog->name_en }}</textarea>
                                                <small class="form-text text-muted">{{ __('dashboard.article_topic_help_text') }}</small>
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
                                                <button type="button" class="btn btn-primary w-100" id="generateBlogContent">
                                                    <i class="fas fa-magic me-2"></i>{{ __('dashboard.generate_content') }}
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
                                                <label class="form-label">{{ __('dashboard.image_description') }}</label>
                                                <textarea class="form-control" id="aiImagePrompt" rows="3" placeholder="{{ __('dashboard.article_image_description_placeholder') }}">{{ $blog->name_ar ?: $blog->name_en }}</textarea>
                                                <small class="form-text text-muted">{{ __('dashboard.article_image_description_help_text') }}</small>
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
                                                <button type="button" class="btn btn-success w-100" id="generateBlogImage">
                                                    <i class="fas fa-magic me-2"></i>{{ __('dashboard.generate_image') }}
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

                            <div class="col-12">
                                <hr>
                            </div>

                            <div class="row mt-3">
                                <div class="form-group col-md-3">
                                    <div class="d-flex flex-wrap gap-2">
                                        <h5 class="font-size-14 mb-3">{{ __('dashboard.publish/unpublish') }} </h5>
                                        <input type="checkbox" id="switch1" switch="none" value="1" name="status" @checked(old('status', $blog->status)) />
                                        <label for="switch1" data-on-label="{{ __('dashboard.yes') }}" data-off-label="{{ __('dashboard.no') }}"></label>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="d-flex flex-wrap gap-2">
                                        <h5 class="font-size-14 mb-3">{{ __('dashboard.show_in_home') }}</h5>
                                        <input type="checkbox" id="switch2" switch="none" value="1" name="show_in_home" @checked(old('show_in_home', $blog->show_in_home)) />
                                        <label for="switch2" data-on-label="{{ __('dashboard.yes') }}" data-off-label="{{ __('dashboard.no') }}"></label>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="d-flex flex-wrap gap-2">
                                        <h5 class="font-size-14 mb-3">{{ __('dashboard.show_in_header') }} </h5>
                                        <input type="checkbox" id="switch3" switch="none" value="1" name="show_in_header" @checked(old('show_in_header', $blog->show_in_header)) />
                                        <label for="switch3" data-on-label="{{ __('dashboard.yes') }}" data-off-label="{{ __('dashboard.no') }}"></label>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="d-flex flex-wrap gap-2">
                                        <h5 class="font-size-14 mb-3">{{ __('dashboard.show_in_footer') }} </h5>
                                        <input type="checkbox" id="switch4" switch="none" value="1" name="show_in_footer" @checked(old('show_in_footer', $blog->show_in_footer)) />
                                        <label for="switch4" data-on-label="{{ __('dashboard.yes') }}" data-off-label="{{ __('dashboard.no') }}"></label>
                                    </div>
                                </div>

                            </div>


                            <div class="col-12">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <hr>
                                        <h4 class="card-title">{{ __('dashboard.seo') }}</h4>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="name_ar">{{ __('dashboard.slug_en') }}</label>
                                        <input type="text" autocomplete="off" class="form-control" placeholder="{{ __('dashboard.slug_en') }}" name="slug_en" value="{{ $blog->slug_en }}">
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label> {{ __('dashboard.meta_title_en') }}</label>
                                        <textarea class="form-control" name="meta_title_en" placeholder="{{ __('dashboard.meta_title_en') }}"> {!! $blog->meta_title_en !!}</textarea>
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label for="meta_desc"> {{ __('dashboard.meta_desc_en') }}</label>
                                        <textarea class="form-control" name="meta_desc_en" placeholder="{{ __('dashboard.meta_desc_en') }}"> {!! $blog->meta_desc_en !!}</textarea>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <hr>

                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>{{ __('dashboard.slug_ar') }}</label>
                                        <input type="text" autocomplete="off" class="form-control" placeholder="{{ __('dashboard.slug_ar') }}" name="slug_ar" value="{{ $blog->slug_ar }}">
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label> {{ __('dashboard.meta_title_ar') }}</label>
                                        <textarea class="form-control" name="meta_title_ar" placeholder="{!! __('dashboard.meta_title_ar') !!}">{{ $blog->meta_title_ar }}</textarea>
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label> {{ __('dashboard.meta_desc_ar') }}</label>
                                        <textarea class="form-control" name="meta_desc_ar" placeholder="{!! __('dashboard.meta_desc') !!}">{!! $blog->meta_desc_ar !!}</textarea>
                                    </div>


                                    <div class="d-flex flex-wrap gap-2">
                                        <h5 class="font-size-14 mb-3">{{ __('dashboard.meta_robots') }} (index)</h5>
                                        <input type="checkbox" id="switch5" switch="none" value="1" name="index" @checked(old('index', $blog->index)) />
                                        <label for="switch5" data-on-label="{{ __('dashboard.yes') }}" data-off-label="{{ __('dashboard.no') }}"></label>

                                    </div>
                                </div>
                            </div>


                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-success"><i class="icon-note"></i>
                                    {{ __('dashboard.update') }} </button>
                                <a href="{{ route('dashboard.blogs.index') }}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i>
                                        {{ __('dashboard.cancel') }}</button></a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->

    @section('style')
    <style>
        img {
            display: block !important;
        }

        .ai-loading {
            opacity: 0.6;
            pointer-events: none;
        }

        .generated-image-card {
            transition: transform 0.2s ease-in-out;
            border: 1px solid #dee2e6;
        }

        .generated-image-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .use-as-image {
            position: relative;
            overflow: hidden;
        }

        .use-as-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .use-as-image:hover::before {
            left: 100%;
        }

    </style>
    @endsection

    @section('script')
    <!-- Rich Text Editor (TinyMCE 6 - Latest Version) -->
    <script type="text/javascript">
        // إعداد البيانات الأساسية
        window.blogId = "{{ $blog->id ?? '' }}";
        window.routes = {
            generateAI: "{{ route('dashboard.ai-content.generate') }}"
            , saveImageToBlog: "{{ route('dashboard.ai-content.save-image-to-blog') }}"
        };

        // ترجمات للاستخدام في JavaScript
        window.translations = {
            please_choose_content_type: "{{ __('dashboard.please_choose_content_type') }}"
            , please_enter_article_topic: "{{ __('dashboard.please_enter_article_topic') }}"
            , generating: "{{ __('dashboard.generating') }}"
            , generating_content: "{{ __('dashboard.generating_content') }}"
            , content_generated_successfully: "{{ __('dashboard.content_generated_successfully') }}"
            , failed_to_generate_content: "{{ __('dashboard.failed_to_generate_content') }}"
            , content_generation_error: "{{ __('dashboard.content_generation_error') }}"
            , session_expired_reload_page: "{{ __('dashboard.session_expired_reload_page') }}"
            , server_error: "{{ __('dashboard.server_error') }}"
            , service_not_available: "{{ __('dashboard.service_not_available') }}"
            , please_enter_image_description: "{{ __('dashboard.please_enter_image_description') }}"
            , please_choose_image_style: "{{ __('dashboard.please_choose_image_style') }}"
            , generating_image: "{{ __('dashboard.generating_image') }}"
            , image_generated_successfully: "{{ __('dashboard.image_generated_successfully') }}"
            , failed_to_generate_image: "{{ __('dashboard.failed_to_generate_image') }}"
            , image_generation_error: "{{ __('dashboard.image_generation_error') }}"
            , download_image: "{{ __('dashboard.download_image') }}"
            , use_as_blog_image: "{{ __('dashboard.use_as_blog_image') }}"
            , use_as_blog_icon: "{{ __('dashboard.use_as_blog_icon') }}"
            , saving: "{{ __('dashboard.saving') }}"
            , saved: "{{ __('dashboard.saved') }}"
            , save_failed: "{{ __('dashboard.save_failed') }}"
            , error_during_save: "{{ __('dashboard.error_during_save') }}"
            , success: "{{ __('dashboard.success') }}"
            , page_reload_to_show_updates: "{{ __('dashboard.page_reload_to_show_updates') }}"
            , page_will_reload: "{{ __('dashboard.page_will_reload') }}"
            , reloading: "{{ __('dashboard.reloading') }}"
        };

        // إعداد CSRF token
        window.csrfToken = "{{ csrf_token() }}";

        // تفعيل وضع التشخيص إذا كان في URL
        window.debugMode = new URLSearchParams(window.location.search).has('debug');

    </script>

    <!-- TinyMCE Editor Component -->
    <x-dashboard.tinymce-config />

    <!-- Blog AI Content Generation -->
    <script src="{{ asset('js/blog-ai-content.js') }}" defer></script>
    @endsection

</x-dashboard.layout>
