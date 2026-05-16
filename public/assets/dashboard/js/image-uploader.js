document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.dropzone-form').forEach(form => {
        const dropzone = form.querySelector('.dropzone');
        const type = dropzone.id.replace('dropzone-', ''); 
        // gives "products", "blogs", or "banners"
        
        const fileInput = document.getElementById('file-input-' + type);
        const uploadBtn = document.getElementById('upload-btn-' + type);
        const previewContainer = document.getElementById('image-preview-' + type);
        
        let files = [];

        dropzone.addEventListener('click', () => fileInput.click());

        dropzone.addEventListener('dragover', e => {
            e.preventDefault();
            dropzone.style.background = '#eef2ff';
            dropzone.style.borderColor = '#3b5be0';
        });

        dropzone.addEventListener('dragleave', () => {
            dropzone.style.background = '#f8faff';
            dropzone.style.borderColor = '#4a6cf7';
        });

        dropzone.addEventListener('drop', e => {
            e.preventDefault();
            dropzone.style.background = '#f8faff';
            dropzone.style.borderColor = '#4a6cf7';

            if (e.dataTransfer.files.length > 0) {
                fileInput.files = e.dataTransfer.files;
                handleFiles(fileInput.files);
                uploadBtn.disabled = false;
            }
        });

        fileInput.addEventListener('change', e => {
            if (e.target.files.length > 0) {
                handleFiles(e.target.files);
                uploadBtn.disabled = false;
            }
        });

        function handleFiles(fileList) {
            previewContainer.innerHTML = '';
            files = [];

            for (let i = 0; i < fileList.length; i++) {
                const file = fileList[i];
                if (!file.type.startsWith('image/')) continue;
                files.push(file);
                createPreview(file);
            }
        }

        function createPreview(file) {
            const previewItem = document.createElement('div');
            previewItem.className = 'preview-item';

            const img = document.createElement('img');
            const reader = new FileReader();
            reader.onload = e => img.src = e.target.result;
            reader.readAsDataURL(file);

            const fileInfo = document.createElement('div');
            fileInfo.className = 'file-info';

            const fileName = document.createElement('div');
            fileName.className = 'name';
            fileName.textContent = file.name;

            const fileSize = document.createElement('div');
            fileSize.className = 'size';
            fileSize.textContent = formatFileSize(file.size);

            fileInfo.appendChild(fileName);
            fileInfo.appendChild(fileSize);

            previewItem.appendChild(img);
            previewItem.appendChild(fileInfo);
            previewContainer.appendChild(previewItem);
        }

        function formatFileSize(bytes) {
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(1024));
            return (bytes / Math.pow(1024, i)).toFixed(2) + ' ' + sizes[i];
        }
    });
});
