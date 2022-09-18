<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a> > 
            <a href="{{ route('admin.categories.index') }}">{{ __('Categories') }}</a> > 
            New
        </h2>
    </x-slot>

    <div class="my-5 w-full flex flex-col space-y-4 md:flex-row md:space-y-0">
        <div class="md:w-2/3 lg:w-3/4 px-5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1>Edit Category</h1>

                    <form class="pt-6 pb-8 mb-4" action="{{ route('admin.categories.update', ['category' => $category->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="my-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Title
                                <input 
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight 
                                    focus:outline-none focus:shadow-outline my-2" 
                                    name="title" id="title" value="{{ $category->title }}" />
                            </label>
                            
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="slug">
                                Slug
                                <input 
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight 
                                    focus:outline-none focus:shadow-outline my-2" 
                                    name="slug" id="slugg" value="{{ $category->slug }}" />
                            </label>      
                            
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="parent_id">
                                Parent Category
                                <select id="parent_id" name="parent_id" 
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight 
                                    focus:outline-none focus:shadow-outline my-2" 
                                >
                                <option value="0" {{ $category->parent_id == 0 ? 'selected' : '' }}>None</option>

                                    @foreach ($categories as $id => $title)
                                        <option value="{{ $id }}" {{ $category->parent_id == $id ? 'selected' : '' }}>{{ $title }}</option>
                                    @endforeach

                                </select>
                            </label>                              
                        </div>
                    
                        <button type="submit" class="px-4 py-2 bg-blue-800 text-white">Save Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
