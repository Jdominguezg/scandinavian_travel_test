<?php

namespace App\Http\Livewire;

use App\Models\Car;
use Livewire\Component;

class Cars extends Component
{
    public $car_id, $brand, $model;
    public $isOpen = 0;

    public function render()
    {
        $cars = Car::all();

        return view('livewire.cars', ['cars' => $cars]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields(){
        $this->brand = '';
        $this->model = '';
        $this->car_id = '';
    }

    public function store()
    {
        $this->validate([
            'brand' => 'required',
            'model' => 'required',
        ]);

        Car::updateOrCreate(['id' => $this->car_id], [
            'brand' => $this->brand,
            'model' => $this->model,
        ]);

        session()->flash('message',
            $this->car_id ? 'Vehículo actualizado correctamente.' : 'Vehículo creado correctamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $car = Car::findOrFail($id);
        $this->car_id = $id;
        $this->brand = $car->brand;
        $this->model = $car->model;

        $this->openModal();
    }

    public function delete($id)
    {
        Car::find($id)->delete();
        session()->flash('message', 'Vehículo eliminado correctamente.');
    }
}
