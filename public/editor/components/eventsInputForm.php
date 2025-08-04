<div id="newEvent"
    class="invisible z-50 fixed inset-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Unos Novog Događaja</h2>

        <form id="formEvent" class="event-form" enctype="multipart/form-data">


            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- File Upload (First Row, Full Width) -->
                <div class="md:col-span-2" id="fUpload">
                    <label for="file" class="block text-sm font-medium text-gray-700 mb-1">
                        Odaberite sliku
                    </label>
                    <label for="file"
                        class="group flex flex-col items-center justify-center w-full h-40 px-4 transition-colors border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50">
                        <i
                            class="fas fa-image text-4xl text-gray-400 group-hover:text-blue-500 mb-3 transition-colors"></i>
                        <span class="text-gray-600 group-hover:text-blue-600">Kliknite ili prevucite sliku ovde</span>
                        <input type="file" id="file" name="file" accept=".jpg,.jpeg,.png" class="hidden" />
                    </label>
                </div>

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Naziv događaja*</label>
                    <input type="text" id="title" name="title" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Unesite naziv događaja" />
                </div>

                <!-- Category -->
                <!-- File Path -->
                <div>
                    <label for="category" id="categoryForm" class="block text-sm font-medium text-gray-700 mb-1">
                        Kategorija*
                    </label>
                    <select id="category" name="category" required class="w-full px-4 py-2 border border-gray-300 rounded-lg
                 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">-- Odaberite kategoriju --</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>"><?= $category['naziv'] ?></option>

                        <?php endforeach; ?>

                    </select>
                </div>
                <!-- Date -->
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Datum*</label>
                    <input type="date" id="date" name="date" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>

                <!-- Time -->
                <div>
                    <label for="time" class="block text-sm font-medium text-gray-700 mb-1">Vreme*</label>
                    <input type="time" id="time" name="time" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
                <!-- Location -->
                <div class="md:col-span-2 relative">
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Lokacija*</label>
                    <div class="relative">
                        <input type="text" id="location" name="location" required
                            class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Unesite lokaciju događaja" />
                        <i class="fas fa-map-marker-alt absolute left-3 top-3 text-gray-400"></i>
                    </div>

                </div>
                <!-- Description -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Opis događaja</label>
                    <textarea id="description" name="description" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Detaljan opis događaja"></textarea>
                </div>
            </div>

            <!-- Hidden Inputs -->
            <input type="hidden" id="method" value="POST" />
            <input type="hidden" id="endpoint" value="/events" />

            <!-- Form Actions -->
            <div class="flex justify-end space-x-4 mt-8">
                <button id="eventCancelButton" type="button"
                    class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Odustani
                </button>
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Sačuvaj Događaj
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {


        const form = document.getElementById('formEvent');
        const modal = document.getElementById('newEvent');
        const cancelBtn = document.getElementById('eventCancelButton');
        const requiredFields = ['title', 'category', 'date', 'time'];
        const rows = document.querySelectorAll('tbody tr.dataCard');
        // Form submission handler
        form.addEventListener('submit', async e => {
            e.preventDefault();


            const method = form.method.value;       // 'POST' or 'PUT'
            const endpoint = form.endpoint.value;     // '/events' or '/events/:id'
            let options = { method };

            // If there's a file chosen or this is POST: use FormData
            const fileInput = form.querySelector('input[type=file]');
            const hasFile = fileInput && fileInput.files.length && fileInput.files[0].name;

            if (hasFile || method === 'POST') {
                // send as multipart/form-data
                const payload = new FormData(form);
                options.body = payload;
            } else {
                // send as JSON (no file upload)
                const json = {};
                new FormData(form).forEach((v, k) => { json[k] = v; });
                options.headers = { 'Content-Type': 'application/json' };
                options.body = JSON.stringify(json);
            }

            try {
                const res = await fetch(endpoint, options);
                if (!res.ok) throw new Error(res.statusText);
                alert(method === 'POST'
                    ? 'Događaj uspešno sačuvan!'
                    : 'Događaj uspešno izmenjen!'
                );
                form.reset(); close(); location.reload();
            } catch (err) {
                console.error(err);
                alert('Došlo je do greške. Pokušajte ponovo.');
            }
        });
        rows.forEach(row => {
            // You can use dataset to pull your data-* attributes:
            const id = row.dataset.id;
            const category = row.dataset.category;
            const title = row.dataset.title;
            const description = row.dataset.description;
            const date = row.dataset.date;
            const time = row.dataset.time;
            const location = row.dataset.location;

            // Now find the buttons within that same row
            const showBtn = row.querySelector('.show');
            const editBtn = row.querySelector('.edit');
            const deleteBtn = row.querySelector('.delete');
            console.log(category);
            // Example: wire up an edit click to populate & open the modal
            editBtn.addEventListener('click', () => {

                // Fill the form fields
                form.querySelector('#title').value = title;
                form.querySelector('#category').value = category;
                form.querySelector('#description').value = description;
                form.querySelector('#date').value = date;
                form.querySelector('#time').value = time;
                form.querySelector('#category').value = category;
                form.querySelector('#location').value = location;
                document.getElementById('method').value = 'PUT';
                document.getElementById('endpoint').value = `/events/${id}`;


                form.insertAdjacentHTML('beforeend', `<input type="hidden" name="id" value="${id}" />`);
                // Show the modal
                modal.classList.remove('invisible');
                document.body.classList.add('overflow-hidden');
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