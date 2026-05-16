<x-dashboard.layout :title="__('dashboard.upload_images') . ' ' . __('dashboard.images')">
    @push('styles')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/image-uploader.css') }}">
    @endpush

    <!-- End Page Header -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h1>Upload blog Images</h1>

                    <div class="page-title-right">
                        <a href="{{ route('dashboard.blogs.edit' , $blog) }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-1"></i> {{ __('Back to blogs') }}
                        </a>
                    </div>

                </div>
            </div>
        </div>



        <div class="upload-container">
            {{-- Success Message --}}
            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Form --}}
            <form action="{{ route('dashboard.blogs.images.store', $blog) }}" method="POST" enctype="multipart/form-data" class="dropzone-form">
                @csrf

                <div class="dropzone" id="dropzone-blogs">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <h3>Drag & Drop Images Here</h3>
                    <p>or click to browse your files</p>
                    <input type="file" id="file-input-blogs" name="images[]" multiple accept="image/*" style="display: none;">
                </div>

                <button type="submit" class="upload-btn" id="upload-btn-blogs" disabled>
                    Upload Images
                </button>


            </form>

            <div id="image-preview-blogs" class="image-preview"></div>
            {{-- Uploaded Images --}}
            @if ($blog->images->count())
            <div class="uploaded-images">
                <h2>Uploaded Images</h2>
                
                <form action="{{ route('dashboard.blogs.images.destroyAll', $blog->id) }}" method="POST" class="confirm-delete-form mb-3">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger delete-btn">
                        <i class="fas fa-trash-alt me-1"></i> {{ __('Delete All Images') }}
                    </button>
                </form>

                
                <div class="image-preview">
                    @foreach ($blog->images as $image)
                    <div class="preview-item d-flex flex-column align-items-center justify-content-between py-3">
                        <img src="{{ $image->image_path('blogs/', $blog->id) }}" alt="blog Image" class="img-fluid rounded shadow-sm mb-3">

                        <form action="{{ route('dashboard.blogs.images.destroy', [$blog->id, $image->id]) }}" method="POST" class="confirm-delete-form">
                            @csrf
                            @method('DELETE')

                            <button type="button" class="btn btn-danger  delete-btn">
                                <i class="fas fa-trash-alt me-1"></i> {{ __('Delete') }}
                            </button>
                        </form>
                    </div>
                    @endforeach
                </div>

            </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script src="{{ asset('assets/dashboard/js/image-uploader.js') }}"></script>
    @endpush
</x-dashboard.layout>
