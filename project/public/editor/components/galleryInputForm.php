<div id="galleryModal"
    class="invisible z-50 fixed inset-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Dodaj Novu Galeriju</h2>

        <form id="galleryForm" class="gallery-form" enctype="multipart/form-data">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Image Upload -->
                <div class="md:col-span-2" id="galleryUpload">
                    <label for="galleryImage" class="block text-sm font-medium text-gray-700 mb-1">
                        Odaberite sliku
                    </label>
                    <label for="galleryImage"
                        class="group flex flex-col items-center justify-center w-full h-40 px-4 transition-colors border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50">
                        <i
                            class="fas fa-image text-4xl text-gray-400 group-hover:text-blue-500 mb-3 transition-colors"></i>
                        <span class="text-gray-600 group-hover:text-blue-600">Kliknite ili prevucite sliku ovde</span>
                        <input type="file" id="galleryImage" name="galleryImage" accept=".jpg,.jpeg,.png"
                            class="hidden" />
                    </label>
                </div>

                <!-- Title -->
                <div class="md:col-span-2">
                    <label for="galleryTitle" class="block text-sm font-medium text-gray-700 mb-1">Naziv
                        galerije*</label>
                    <input type="text" id="galleryTitle" name="galleryTitle" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Unesite naziv galerije" />
                </div>



                <!-- Description -->
                <div class="md:col-span-2">
                    <label for="galleryDescription" class="block text-sm font-medium text-gray-700 mb-1">Opis
                        galerije</label>
                    <textarea id="galleryDescription" name="galleryDescription" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Detaljan opis galerije"></textarea>
                </div>


            </div>

            <!-- Hidden Inputs -->
            <input type="hidden" id="galleryMethod" value="POST" />
            <input type="hidden" id="galleryEndpoint" value="/gallery" />

            <!-- Form Actions -->
            <div class="flex justify-end space-x-4 mt-8">
                <button id="galleryCancelButton" type="button"
                    class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Odustani
                </button>
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Sačuvaj Galeriju
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('galleryForm');
        const modal = document.getElementById('galleryModal');
        const cancelBtn = document.getElementById('galleryCancelButton');
        const requiredFields = ['galleryTitle', 'galleryCategory'];
        const galleryItems = document.querySelectorAll('.gallery-item');

        // Form submission handler
        form.addEventListener('submit', async e => {
            e.preventDefault();

            const method = form.querySelector('#galleryMethod').value;
            const endpoint = form.querySelector('#galleryEndpoint').value;
            let options = { method };

            // File handling
            const fileInput = form.querySelector('input[type=file]');
            const hasFile = fileInput && fileInput.files.length && fileInput.files[0].name;

            if (hasFile || method === 'POST') {
                const payload = new FormData(form);
                options.body = payload;
            } else {
                const json = {};
                new FormData(form).forEach((v, k) => { json[k] = v; });
                options.headers = { 'Content-Type': 'application/json' };
                options.body = JSON.stringify(json);
            }

            try {
                const res = await fetch(endpoint, options);
                if (!res.ok) throw new Error(res.statusText);
                alert(method === 'POST'
                    ? 'Galerija uspešno sačuvana!'
                    : 'Galerija uspešno izmenjena!'
                );
                form.reset();
                closeModal();
                location.reload();
            } catch (err) {
                console.error(err);
                alert('Došlo je do greške. Pokušajte ponovo.');
            }
        });

        galleryItems.forEach(item => {
            const id = item.dataset.id;
            const category = item.dataset.category;
            const title = item.dataset.title;
            const description = item.dataset.description;
            const tags = item.dataset.tags;

            const editBtn = item.querySelector('.gallery-edit');

            editBtn.addEventListener('click', () => {
                form.querySelector('#galleryTitle').value = title;
                form.querySelector('#galleryDescription').value = description;

                form.querySelector('#galleryMethod').value = 'PUT';
                form.querySelector('#galleryEndpoint').value = `/gallery/${id}`;

                form.insertAdjacentHTML('beforeend', `<input type="hidden" name="id" value="${id}" />`);

                modal.classList.remove('invisible');
                document.body.classList.add('overflow-hidden');
            });
        });

        // Cancel button handler
        cancelBtn.addEventListener('click', () => {
            form.reset();
            closeModal();
        });

        // Close modal when clicking outside content
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModal();
            }
        });

        // Form validation
        function validateForm() {
            return requiredFields.every(field => {
                const element = document.getElementById(field);
                return element && element.value.trim() !== '';
            });
        }

        function closeModal() {
            modal.classList.add('invisible');
            document.body.classList.remove('overflow-hidden');
        }
    });
</script>