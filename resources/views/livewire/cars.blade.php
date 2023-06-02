<div class="container mx-auto">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear
        Vehículo
    </button>
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
            <tr x-data="{open: false}" @close-gallery="open = false" class="hover:bg-gray-200">


                <td @click="open = !open" class="border px-4 py-2 cursor-pointer">{{ $car->id }}</td>
                <td @click="open = !open" class="border px-4 py-2 cursor-pointer">{{ $car->brand }}</td>
                <td @click="open = !open" class="border px-4 py-2 cursor-pointer">{{ $car->model }}</td>

                <td class="border px-4 py-2">
                    <button wire:click="edit({{ $car->id }})"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar
                    </button>
                    <button wire:click="delete({{ $car->id }})"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar
                    </button>
                </td>

                <td x-show="open" wire:load="loadImages({{$car->id}})">
                    <livewire:image-gallery :instance="$car"
                                            ig_title="Image Gallery for Car: {{$car->brand}} {{$car->model}}"
                                            ig_back_text="Back To Cars List"
                                            :wire:key="$car->id"
                                            open="true"
                    />
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
    {{$cars->links()}}
</div>
