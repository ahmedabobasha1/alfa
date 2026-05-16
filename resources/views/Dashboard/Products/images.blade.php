<x-dashboard.layout :title="__('dashboard.upload_images') . ' ' . __('dashboard.images')">
    @push('styles')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/image-uploader.css') }}">
    @endpush

    <!-- End Page Header -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h1>Upload product Images</h1>

                    <div class="page-title-right">
                        <a href="{{ route('dashboard.products.edit' , $product) }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-1"></i> {{ __('Back to products') }}
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
            <form action="{{ route('dashboard.products.images.store', $product) }}" method="POST" enctype="multipart/form-data" class="dropzone-form">
                @csrf

                <div class="dropzone" id="dropzone-products">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <h3>Drag & Drop Images Here</h3>
                    <p>or click to browse your files</p>
                    <input type="file" id="file-input-products" name="images[]" multiple accept="image/*" style="display: none;">
                </div>

                <button type="submit" class="upload-btn" id="upload-btn-products" disabled>
                    Upload Images
                </button>


            </form>

            <div id="image-preview-products" class="image-preview"></div>
            {{-- Uploaded Images --}}
            @if ($product->images->count())
            <div class="uploaded-images">
                <h2>Uploaded Images</h2>
                
                <form action="{{ route('dashboard.products.images.destroyAll', $product->id) }}" method="POST" class="confirm-delete-form ">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger delete-btn  my-3">
                        <i class="fas fa-trash-alt me-1"></i> {{ __('Delete All Images') }}
                    </button>
                </form>

                
                <div class="image-preview">
                    @foreach ($product->images as $image)
                    <div class="preview-item d-flex flex-column align-items-center justify-content-between ">
                        <img src="{{ $image->image_path('products/', $product->id) }}" alt="product Image" class="img-fluid rounded shadow-sm ">

                        <form action="{{ route('dashboard.products.images.destroy', [$product->id, $image->id]) }}" method="POST" class="confirm-delete-form">
                            @csrf
                            @method('DELETE')

                            <button type="button" class="btn btn-danger  delete-btn my-3">
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
