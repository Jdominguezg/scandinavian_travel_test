<div class="container mx-auto">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear Localización</button>
    @if($isOpen)
        @include('livewire.locations_form')
    @endif
    <table class="table-auto w-full">
        <thead>
        <tr>
            <th class="px-4 py-2"># ID</th>
            <th class="px-4 py-2">Dirección</th>
        </tr>
        </thead>
        <tbody>
        @foreach($locations as $location)
            <tr>
                <td class="border px-4 py-2">{{ $location->id }}</td>
                <td class="border px-4 py-2">{{ $location->name }}</td>
                <td class="border px-4 py-2">
                    <button wire:click="edit({{ $location->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</button>
                    <button wire:click="delete({{ $location->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$locations->links()}}
</div>
