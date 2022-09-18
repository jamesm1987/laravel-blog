<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a> > Categories
        </h2>
        <a  class="px-4 py-2 bg-blue-800 text-white" href="{{ route('admin.categories.create') }}">Add New Category</a>
    </x-slot>

    @if (session('success'))
        <div class="pt-12 pb-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <div class="bg-blue-100 border border-blue-500 text-blue-700 px-4 py-3" role="alert">
                    <p class="font-bold">Success</p>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
                
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="block rounded-lg shadow-lg bg-white">
                        <div class="flex flex-col">
                            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                <table class="min-w-full mb-0">
                                    <thead class="border-b bg-gray-50 rounded-t-lg text-left">
                                    <tr>
                                        <th scope="col" class="text-sm font-medium px-6 py-4">TITLE</th>
                                        <th scope="col" class="text-sm font-medium px-6 py-4">SLUG</th>
                                        <th scope="col" class="text-sm font-medium px-6 py-4">POSTS</th>
                                        <th scope="col" class="rounded-tr-lg text-sm font-medium px-6 py-4"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($categories as $category)
                                    <tr class="border-b">
                                        <td class="text-sm font-normal px-6 py-4 whitespace-nowrap text-left">
                                        <div class="flex flex-col">
                                            <p class="mb-0.5">{{ $category->title }}</p>
                                        </div>
                                        </td>
                                        <td class="align-middle text-gray-500 text-sm font-normal px-6 py-4 whitespace-nowrap text-left">
                                            {{ $category->slug }}
                                        </td>
                                        <td class="align-middle text-gray-500 text-sm font-normal px-6 py-4 whitespace-nowrap text-left">
                                           {{ count($category->posts) }}
                                        </td>
                                      
                                        <td>
                                        <a href="{{ route('category', ['category_path' => $category->category_path()]) }}" class="font-medium text-blue-600 hover:text-blue-700 focus:text-blue-700 active:text-blue-800 transition duration-300 ease-in-out">View</a> | 
                                        <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}" class="font-medium text-blue-600 hover:text-blue-700 focus:text-blue-700 active:text-blue-800 transition duration-300 ease-in-out">Edit</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
</x-app-layout>
