<div class="container mx-auto">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear Post</button>
    @if($isOpen)
        @include('livewire.posts_form')
    @endif
    <table class="table-auto w-full">
        <thead>
        <tr>
            <th class="px-4 py-2"># ID</th>
            <th class="px-4 py-2">Titulo</th>
            <th class="px-4 py-2">slug</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr x-data="{open: false}" @close-gallery="open = false" class="hover:bg-gray-200">
                <td @click="open = !open" class="border px-4 py-2 cursor-pointer">{{ $post->id }}</td>
                <td @click="open = !open" class="border px-4 py-2 cursor-pointer">{{ $post->title }}</td>
                <td @click="open = !open" class="border px-4 py-2 cursor-pointer">{{ $post->slug }}</td>
                <td class="border px-4 py-2">
                    <button wire:click="edit({{ $post->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</button>
                    <button wire:click="delete({{ $post->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                </td>
                <td x-show="open" wire:load="loadImages({{$post->id}})">
                    <livewire:image-gallery :instance="$post"
                                            ig_title="Image Gallery for Post: {{$post->title}}"
                                            ig_back_text="Back To Posts List"
                                            :wire:key="$post->id"
                    />
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
        {{$posts->links()}}
</div>
