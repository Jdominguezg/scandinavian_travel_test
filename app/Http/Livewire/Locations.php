<?php

namespace App\Http\Livewire;

use App\Models\Location;
use Livewire\Component;
use Livewire\WithPagination;

class Locations extends Component
{
    use WithPagination;

    public $location_id, $name;
    public $isOpen = 0;

    public function render()
    {
        $locations = Location::orderBy('id', 'DESC')->paginate(15);

        return view('livewire.locations', ['locations' => $locations]);
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
        $this->name = '';
        $this->location_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required'
        ]);

        Location::updateOrCreate(['id' => $this->location_id], [
            'name' => $this->name,
        ]);

        session()->flash('message',
            $this->location_id ? 'Localización actualizada correctamente.' : 'Localización creada correctamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $location = Location::findOrFail($id);
        $this->location_id = $id;
        $this->name = $location->name;

        $this->openModal();
    }

    public function delete($id)
    {
        Location::find($id)->delete();
        session()->flash('message', 'Localización eliminada correctamente.');
    }
}
