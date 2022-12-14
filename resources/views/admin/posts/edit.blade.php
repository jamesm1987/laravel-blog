<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a> > 
            <a href="{{ route('admin.posts.index') }}">{{ __('Posts') }}</a> > 
            Edit
        </h2>

        <div>
            <button class="px-4 py-2 bg-gray-300 text-gray-800" form="form-edit-post" data-action="save">
                Save
            </button>
            <button class="px-4 py-2 bg-blue-800 text-white" form="form-edit-post" data-set-action data-action="{{ $post->published_at ? 'update' : 'publish' }}">
                {{ $post->published_at ? 'Update' : 'Publish' }}
            </button>
        </div>
    </x-slot>

    <div class="my-5 w-full flex flex-col space-y-4 md:flex-row md:space-y-0" data-post-editor>
        <div class="md:w-2/3 lg:w-3/4 px-5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1>Edit Post</h1>

                    <form class="pt-6 pb-8 mb-4" id="form-edit-post" action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="my-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            Title
                            <input 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight 
                                focus:outline-none focus:shadow-outline my-2" 
                                name="title" 
                                id="title"
                                value="{{ $post->title }}" 
                            />
                        </label>

                        <label class="block text-gray-700 text-sm font-bold mb-2" for="slug">
                            Slug
                            <input 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight 
                                focus:outline-none focus:shadow-outline my-2" 
                                name="slug" 
                                id="slug" 
                                value="{{ $post->slug }}" 
                            />
                        </label>                        
                    </div>
                        <textarea id="editor" editor class="" name="body">{{ $post->body }}</textarea>
                        <input type="hidden" name="categories" value="{{ implode(',', $postCategories) }}" />
                        <input type="hidden" name="tags" value="{{ implode(',', $postTags) }}" />
                        <input type="hidden" name="action" value="save">
                    </form>
                </div>
            </div>
        </div>

        <aside class="md:w-1/3 lg:w-1/4">
            <div class="max-w-2xl mx-auto sm:px-6 lg:pl-0 lg:pr-6 mb-3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2>Status & Visibility</h2>
                        <ul>
                            <li>Visibility: {{ $post->published_at ? 'Published'  : 'Draft' }}</li>
                            <li>Publish: </li>
                        </ul>
                    </div>
                </div>
            </div>      

            <div class="max-w-2xl mx-auto sm:px-6 lg:pl-0 lg:pr-6 mb-3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200" data-categories-selector>
                        <h2>Categories</h2>

                        @foreach ($categories as $category)
                            <label class="block">
                            
                            <input type="checkbox" {{ in_array($category->id, $postCategories) ? 'checked' : '' }} value="{{ $category->id }}"/>
                                                    
                            {{ $category->title }}
                            </label>
                            
                            @foreach ($category->children as $child)
                                <label class="block pl-3">
                                    <input type="checkbox" {{ in_array($child->id, $postCategories) ? 'checked' : '' }}  value="{{ $child->id }}"/>
                                    {{ $child->title }}
                                </label>
                            @endforeach    

                        @endforeach
                    </div>
                </div>
            </div>    
            
            <div class="max-w-2xl mx-auto sm:px-6 lg:pl-0 lg:pr-6 mb-3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200" data-tags-selector>
                        <h2>Tags</h2>


                        @foreach ($tags as $id => $tag)
                            <label class="block">
                            <input type="checkbox" {{ in_array($id, $postTags) ? 'checked' : '' }} name="tags[]" value="{{ $id }}"/>
                            {{ $tag }}
                            </label>
                        
                        @endforeach                        
                    </div>
                </div>
            </div>            
            <div class="max-w-2xl mx-auto sm:px-6 lg:pl-0 lg:pr-6 mb-3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200" data-featured-image-selector>
                        <h2>Featured Image</h2>
                        <div></div>
                        <button 
                            class="px-2 py-1 bg-blue-800 text-white" 
                            data-model="Post" 
                            data-post-id="{{ $post->id }}"
                            data-bs-toggle="modal" data-bs-target="#featured-image-modal"
                        >
                            Add Image
                        </button>
                     
                    </div>
                </div>
            </div> 

        </aside>
    </div>

    @include('partials.modals.featured-image', ['id' => $post->id])

    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    <script>
        const editor = document.querySelector('[editor]');

        if (editor) {
            ClassicEditor
                .create( editor  )
                .catch( error => {
                    console.error( error );
            } );
        }
        </script>    
</x-app-layout>
