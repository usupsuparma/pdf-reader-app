<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="float-right my-3 mb-3 mx-3">
                    <a class="btn"
                        href="{{ route('ebooks.add') }}"><x-primary-button>{{ __('Add Ebook') }}</x-primary-button></a>
                </div>

                <table class="table-auto border-collapse min-w-full">
                    <thead>
                        <th>No</th>
                        <th>Name</th>
                        <th>Path</th>
                        <th>Action</th>
                    </thead>
                </table>

            </div>
        </div>
    </div>

</x-app-layout>
