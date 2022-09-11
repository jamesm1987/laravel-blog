<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a> >
            Posts
        </h2>
        <a  class="px-4 py-2 bg-blue-800 text-white" href="{{ route('admin.posts.create') }}">Add New Post</a>
    </x-slot>

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
                                        <th scope="col" class="text-sm font-medium px-6 py-4">STATUS</th>
                                        <th scope="col" class="text-sm font-medium px-6 py-4">Tags</th>
                                        <th scope="col" class="text-sm font-medium px-6 py-4">Categories</th>
                                        <th scope="col" class="text-sm font-medium px-6 py-4">Author</th>
                                        <th scope="col" class="rounded-tr-lg text-sm font-medium px-6 py-4"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($posts as $post)
                                    <tr class="border-b">
                                        <td class="text-sm font-normal px-6 py-4 whitespace-nowrap text-left">
                                        <div class="flex flex-col">
                                            <p class="mb-0.5">{{ $post->title }}</p>
                                        </div>
                                        </td>
                                        <td class="align-middle text-sm font-normal px-6 py-4 whitespace-nowrap text-left">
                                        <span class="text-xs py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-medium bg-green-200 text-green-600 rounded-full">{{ $post->status() }}</span>
                                        </td>
                                        <td class="align-middle text-gray-500 text-sm font-normal px-6 py-4 whitespace-nowrap text-left">
                                            @foreach ($post->tags as $tag )
                                                {{ $tag->title }}
                                           @endforeach 
                                        </td>
                                        <td class="align-middle text-gray-500 text-sm font-normal px-6 py-4 whitespace-nowrap text-left">
                                            @foreach ($post->categories as $category )
                                                {{ $category->title }}
                                           @endforeach 
                                        </td>

                                        <td class="text-sm font-normal px-6 py-4 whitespace-nowrap text-left">
                                            <div class="flex flex-col">
                                                <p class="mb-0.5">{{$post->author->name }}</p>
                                            </div>
                                        </td>                                        
                                        <td>
                                        <a href="#" class="font-medium text-blue-600 hover:text-blue-700 focus:text-blue-700 active:text-blue-800 transition duration-300 ease-in-out">View</a> | 
                                        <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}" class="font-medium text-blue-600 hover:text-blue-700 focus:text-blue-700 active:text-blue-800 transition duration-300 ease-in-out">Edit</a>
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
