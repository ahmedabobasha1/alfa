<script src="{{ asset('assets/dashboard/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
    // Initialize TinyMCE for all textareas with id="myeditorinstance"
    document.addEventListener('DOMContentLoaded', function() {
        // Find all textareas with id="myeditorinstance"
        const textareas = document.querySelectorAll('textarea[id="myeditorinstance"]');

        textareas.forEach(function(textarea, index) {
            // Create unique ID for each textarea
            const uniqueId = 'tinymce_editor_' + index + '_' + textarea.name.replace(/[^a-zA-Z0-9]/g,
                '_');
            textarea.id = uniqueId;

            // Initialize TinyMCE for this specific textarea
            tinymce.init({
                selector: '#' + uniqueId,
                license_key: 'gpl', // Use GPL license for open source
                plugins: 'code table lists image media visualchars visualblocks directionality',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright alignjustify | ltr rtl | indent outdent | bullist numlist | visualchars visualblocks | image media | code | table',
                automatic_uploads: true,
                file_picker_types: 'image',
                file_picker_callback: function(cb, value, meta) {
                    if (meta.filetype === 'image') {
                        const input = document.createElement('input');
                        input.type = 'file';
                        input.accept = 'image/*';
                        input.onchange = function() {
                            const file = this.files[0];
                            const reader = new FileReader();
                            reader.onload = function() {
                                const id = 'blobid' + (new Date()).getTime();
                                const blobCache = tinymce.activeEditor.editorUpload.blobCache;
                                const base64 = reader.result.split(',')[1];
                                const blobInfo = blobCache.create(id, file, base64);
                                blobCache.add(blobInfo);
                                cb(blobInfo.blobUri(), { title: file.name });
                            };
                            reader.readAsDataURL(file);
                        };
                        input.click();
                    }
                },
                setup: function(editor) {
                    editor.on('init', function() {
                        console.log('TinyMCE initialized for:', textarea.name,
                            'with ID:', uniqueId);
                    });
                }
            });
        });
    });
</script>
