<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{ $category->title }}
                </div>
            </div>
        </div>

        <div class="max-w-4xl ml-6 md:ml-36 sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                
                <div class="grid grid-cols-12 md:grid-cols-3 gap-4">
                    @foreach( $category->posts as $post)
                        <article>{{ $post->title }}</article>
                    @endforeach
                </div>

            </div>

        </div>        

    </div>
</x-guest-layout>
