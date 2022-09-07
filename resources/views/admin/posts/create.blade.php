<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a> > 
            <a href="{{ route('admin.posts.index') }}">{{ __('Posts') }}</a> > 
            Create
        </h2>
    </x-slot>

    <div class="my-5 w-full flex flex-col space-y-4 md:flex-row md:space-y-0">
        <div class="md:w-2/3 lg:w-3/4 px-5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1>New Post</h1>

                    <form class="pt-6 pb-8 mb-4">
                        <div class="my-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            Title
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2" name="title" id="title" value="" />
                        </label>
                    </div>
                        <textarea id="editor" editor class="" name="content"></textarea>
                    </form>
                </div>
            </div>
        </div>

        <aside class="md:w-1/3 lg:w-1/4">
            <div class="max-w-2xl mx-auto sm:px-6 lg:pl-0 lg:pr-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2>Publish</h2>
                    </div>
                </div>
            </div>      

            <div class="max-w-2xl mx-auto sm:px-6 lg:pl-0 lg:pr-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2>Categories</h2>
                    </div>
                </div>
            </div>    
            
            <div class="max-w-2xl mx-auto sm:px-6 lg:pl-0 lg:pr-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2>Tags</h2>
                    </div>
                </div>
            </div>            
        </aside>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    <script>
        const editor = document.querySelector('[editor]');

        console.log(editor);
        if (editor) {
            ClassicEditor
                .create( editor  )
                .catch( error => {
                    console.error( error );
            } );
        }
        </script>    
</x-app-layout>
