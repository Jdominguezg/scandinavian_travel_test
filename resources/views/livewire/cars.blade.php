<div class="container mx-auto">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear Vehículo</button>
    @if($isOpen)
        @include('livewire.cars_form')
    @endif
    <table class="table-auto w-full">
        <thead>
        <tr>
            <th class="px-4 py-2"># ID</th>
            <th class="px-4 py-2">Marca</th>
            <th class="px-4 py-2">Modelo</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cars as $car)
            <tr>
                <td class="border px-4 py-2">{{ $car->id }}</td>
                <td class="border px-4 py-2">{{ $car->brand }}</td>
                <td class="border px-4 py-2">{{ $car->model }}</td>
                <td class="border px-4 py-2">
                    <button wire:click="edit({{ $car->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</button>
                    <button wire:click="delete({{ $car->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
