<div class="container mx-auto">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear Autor</button>
    @if($isOpen)
        @include('livewire.authors_form')
    @endif
    <table class="table-auto w-full">
        <thead>
        <tr>
            <th class="px-4 py-2"># ID</th>
            <th class="px-4 py-2">Nombre</th>
            <th class="px-4 py-2">Edad</th>
        </tr>
        </thead>
        <tbody>
        @foreach($authors as $author)
            <tr>
                <td class="border px-4 py-2">{{ $author->id }}</td>
                <td class="border px-4 py-2">{{ $author->name }}</td>
                <td class="border px-4 py-2">{{ $author->age }}</td>
                <td class="border px-4 py-2">
                    <button wire:click="edit({{ $author->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</button>
                    <button wire:click="delete({{ $author->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
