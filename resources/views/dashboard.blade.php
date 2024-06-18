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
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Path</th>
                        <th class="px-4 py-2">View</th>
                        <th class="px-4 py-2">Action</th>
                    </thead>
                    <tbody>
                        @foreach ($ebooks as $item)
                            <tr class="{{ $loop->even ? 'bg-gray-100' : '' }}">
                                <td class="border px-4 py-2">{{ $loop->index + 1 }}</td>
                                <td class="border px-4 py-2">{{ $item->name }}</td>
                                <td class="border px-4 py-2">{{ $item->path }}</td>
                                <td class="border px-4 py-2">
                                    <a href="" target="_blank" rel="noopener noreferrer"></a>
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        href="{{ $item->path }}/">
                                        {{ __('Open') }}
                                    </a>
                                </td>
                                <td class="border px-4 py2">
                                    <button>
                                        <i class="fa fa-address-book" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</x-app-layout>
