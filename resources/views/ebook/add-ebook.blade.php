<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Ebook') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Add Ebook') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Pastikan file dalam format zip ') }}
                            </p>
                        </header>

                        <form id="upload-form" method="post" action="{{ route('ebooks.store') }}" class="mt-6 space-y-6"
                            enctype="multipart/form-data">
                            @csrf
                            @method('post')

                            <div>
                                <x-input-label for="add_name" :value="__('Name')" />
                                <x-text-input id="add_name" name="name" type="text" class="mt-1 block w-full"
                                    autocomplete="" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="add_file" :value="__('File')" />
                                <input
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-grey-300"
                                    id="file_input" type="file" name="file">
                                <x-input-error :messages="$errors->get('file')" class="mt-2" />
                            </div>

                            <div id="progress-container" class="hidden">
                                <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                                    <div id="progress-bar"
                                        class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                                        style="width: 0%"> 0%</div>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>

                                @if (session('status') === 'password-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('upload-form').addEventListener('submit', function(e) {
            e.preventDefault();

            let form = e.target;
            let formData = new FormData(form);
            let progressBar = document.getElementById('progress-bar');
            let progressContainer = document.getElementById('progress-container');

            // Show progress bar
            progressContainer.classList.remove('hidden');

            const xhr = new XMLHttpRequest();
            xhr.open('POST', form.action, true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

            xhr.upload.addEventListener('progress', function(e) {
                if (e.lengthComputable) {
                    let percentComplete = (e.loaded / e.total) * 100;
                    progressBar.style.width = percentComplete + '%';
                    progressBar.innerHTML = Math.floor(percentComplete) + '%';
                }
            });

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    progressBar.style.width = '0%';
                    progressBar.innerHTML = '0%';
                    // Hide progress bar after upload is complete
                    progressContainer.classList.add('hidden');
                    Swal.fire({
                        title: "Uploaded!",
                        text: "Your file has been uploaded.",
                        icon: "success"
                    });
                } else if (xhr.readyState == 4) {
                    Swal.fire({
                        title: "Upload!",
                        text: "Your upload is error",
                        icon: "error"
                    });
                    // Hide progress bar if upload fails
                    progressContainer.classList.add('hidden');
                }
            };

            xhr.send(formData);
        });
    </script>
</x-app-layout>
