<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithPagination;

    public $post_id, $title, $slug;
    public $isOpen = 0;

    public function render()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(15);

        return view('livewire.posts', ['posts' => $posts]);
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
        $this->title = '';
        $this->slug = '';
        $this->post_id = '';
    }

    public function store()
    {
        $this->validate([
            'title' => 'required'
        ]);

        Post::updateOrCreate(['id' => $this->post_id], [
            'title' => $this->title,
            'slug' => Str::slug($this->title, '-'),
        ]);

        session()->flash('message',
            $this->post_id ? 'Post actualizado correctamente.' : 'Post creado correctamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->post_id = $id;
        $this->title = $post->title;
        $this->slug = $post->slug;

        $this->openModal();
    }

    public function delete($id)
    {
        Post::find($id)->delete();
        session()->flash('message', 'Post eliminado correctamente.');
    }
}
