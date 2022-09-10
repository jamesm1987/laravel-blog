<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a> > 
            <a href="{{ route('admin.tags.index') }}">{{ __('Tag') }}</a> > 
            New
        </h2>

    </x-slot>

    <div class="my-5 w-full flex flex-col space-y-4 md:flex-row md:space-y-0">
        <div class="md:w-2/3 lg:w-3/4 px-5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1>New Tag</h1>

                    <form class="pt-6 pb-8 mb-4" action="{{ route('admin.tags.store') }}" method="POST">
                        @csrf
                        <div class="my-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Title
                                <input 
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight 
                                        focus:outline-none focus:shadow-outline my-2" 
                                    name="title" id="title" value="" required />
                            </label>

                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Slug
                                <input 
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight 
                                    focus:outline-none focus:shadow-outline my-2" 
                                    name="slug" id="title" value="" />
                            </label>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-800 text-white" href="#">Add New Tag</button>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
