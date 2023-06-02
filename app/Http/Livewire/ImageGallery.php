<?php

namespace App\Http\Livewire;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImageGallery extends Component
{
    use WithFileUploads;

    public $instance;
    public $ig_title;
    public $ig_back_text;

    public $images = [];
    public $uploading_images = [];
    public $image;
    public $selectedImage = null;
    public $name;
    public $alt;
    public $isFavorite;




    public function mount($instance)
    {
        $this->instance = $instance;
        $this->images = $instance->images;
    }

    public function render()
    {
        return view('livewire.image-gallery');
    }

    public function updatedUploadingImages()
    {
        $this->validate([
            'uploading_images.*' => 'required|image|max:2048'
        ]);
        $instance_name = class_basename($this->instance);
        foreach ($this->uploading_images as $image) {
            $imageName = uniqid().'_'.$image->getClientOriginalName();

            $path = $image->storeAs("public/images/$instance_name", $imageName);

            $this->instance->images()->create([
                'name' => $imageName,
                'path' => $path
            ]);
        }

        $this->images = $this->instance->images()->get();

    }

    public function selectImage($id)
    {
        $this->selectedImage = $this->images->find($id);
        $this->name = $this->selectedImage->name;
        $this->alt = $this->selectedImage->alt;
        $this->isFavorite = $this->selectedImage->is_favorite;
    }

    public function favoriteImage($id)
    {
        $selectedImage = $this->images->find($id);
        $selectedImage->is_favorite = !$selectedImage->is_favorite;
        $selectedImage->save();

        $this->images = $this->instance->images()->get();
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
        ]);

        if ($this->name !== $this->selectedImage->name) {

            $instance_name = class_basename($this->instance);

            /**
             * Comprobamos que el nombre es único en la relación polimórfica para evitar problemas a la hora de editarlos o eliminarlos
             * si existe el nombre del fichero le añadimos un uniqid para evitar problemas.
            */
            if(Image::where('imageable_type', '=', get_class($this->instance))->where('imageable_id', '=', $this->instance->id)->where('name', '=', $this->name)->count() != 0){
                 $this->name = uniqid().'_'.$this->name;
            }

            $newPath = str_replace($this->selectedImage->name, $this->name, $this->selectedImage->path);

            if (Storage::move($this->selectedImage->path, $newPath)) {
                $this->selectedImage->update([
                    'name' => $this->name,
                    'alt' => $this->alt,
                    'path' => $newPath
                ]);
            }

        } else {
            $this->selectedImage->update([
                'alt' => $this->alt,
            ]);
        }

        $this->selectedImage = null;
        $this->images = $this->instance->images()->get();
        $this->instance->refresh();
    }

    public function close()
    {
        $this->resetValidation();
        $this->selectedImage = null;
        $this->images = $this->instance->images()->get();
        $this->instance->refresh();
    }


    public function delete($id)
    {
        $image = $this->images->find($id);
        unlink(storage_path('app/' . $image->path));
        $image->delete();

        $this->images = $this->instance->images()->get();
    }


}
