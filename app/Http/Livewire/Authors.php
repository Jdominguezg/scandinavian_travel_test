<?php

namespace App\Http\Livewire;

use App\Models\Author;
use Livewire\Component;
use Livewire\WithPagination;

class Authors extends Component
{
    use WithPagination;

    public $author_id, $name, $age;
    public $isOpen = 0;

    public function render()
    {
        $authors = Author::orderBy('id', 'DESC')->paginate(15);

        return view('livewire.authors', ['authors' => $authors]);
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
        $this->age = '';
        $this->author_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'age' => 'required|integer|min:0',
        ]);

        Author::updateOrCreate(['id' => $this->author_id], [
            'name' => $this->name,
            'age' => $this->age,
        ]);

        session()->flash('message',
            $this->author_id ? 'Autor actualizado correctamente.' : 'Autor creado correctamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $author = Author::findOrFail($id);
        $this->author_id = $id;
        $this->name = $author->name;
        $this->age = $author->age;

        $this->openModal();
    }

    public function delete($id)
    {
        Author::find($id)->delete();
        session()->flash('message', 'Autor eliminado correctamente.');
    }
}
