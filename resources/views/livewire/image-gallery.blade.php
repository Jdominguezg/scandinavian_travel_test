<div
    class="fixed z-10 w-full h-full left-0 top-0 bg-black bg-opacity-50 backdrop-filter backdrop-blur-[7.5px] flex flex-wrap justify-center items-center">
    <div x-data="{ isUploading: false, progress: 0 }"
         x-on:livewire-upload-start="isUploading = true"
         x-on:livewire-upload-finish="isUploading = false"
         x-on:livewire-upload-error="isUploading = false"
         x-on:livewire-upload-progress="progress = $event.detail.progress"
         class="relative w-[1248px] h-[720px] bg-white bg-opacity-20 backdrop-filter backdrop-blur-[25px] rounded-[8px] py-[40px] px-[60px]">
        <h2 class="absolute top-[-32px] text-white left-0 text-[20px] leading-[23.48px]">{{$ig_title}}</h2>
        <div @click="$dispatch('close-gallery')"
             class="absolute cursor-pointer top-[-32px] right-0 text-white inline-flex flex-wrap gap-3 items-center">
            <span
                class="material-symbols-rounded h-[25px] w-[25px] text-[12px] bg-blue-500 shadow-md flex flex-wrap justify-center items-center rounded-full">arrow_back_ios_new</span>
            <p class="text-[12px]">{{$ig_back_text}}</p>
        </div>
        @if($images && isset($images) && count($images) > 0)
            <div class="grid grid-cols-3 gap-[48px] w-full h-full overflow-y-auto">
                @foreach ($images as $image)
                    <div class="relative h-[300px] rounded-[8px] shadow-lg overflow-hidden">
                        <img class="w-full h-full object-cover object-center" src="{{ Storage::url($image->path) }}"
                             loading="lazy" alt="{{ $image->alt }}">
                        <div
                            class="absolute bottom-0 left-0 w-full h-[68px] gap-6 flex flex-wrap backdrop-blur-[5px] bg-[rgba(90,90,90,0.5)] justify-center items-center bg ">
                            <button
                                class="rounded-full w-[123px] h-[36px] text-[14px] flex items-center justify-center bg-white shadow-md"
                                wire:click="selectImage({{ $image->id }})">Manage
                            </button>
                            <button
                                class="rounded-full w-[123px] h-[36px] text-white text-[14px] flex items-center justify-center bg-[#ff7777] shadow-md"
                                wire:click="delete({{ $image->id }})">Delete
                            </button>
                        </div>
                        <i wire:click="favoriteImage({{$image->id}})"
                           class="absolute cursor-pointer top-[19px] right-[19px] text-white shadow-lg h-[42px] w-[42px] rounded-full {{$image->is_favorite ? "bg-[#3f54d1]" : "bg-[#9da0a3]"}} flex items-center justify-center">
                            <span class="material-symbols-rounded"
                                  @if($image->is_favorite)style="font-variation-settings: 'FILL' 1"@endif>
                                favorite
                            </span>
                        </i>
                    </div>
                @endforeach
            </div>

            <label for="images-{{$instance->id}}"
                   class="absolute bottom-[-56px] left-0 flex flex-wrap items-center gap-2">
                <div
                    class="rounded-[8px] bg-white h-[40px] text-white bg-opacity-20 border-0 flex items-center pl-2 w-[312px]">
                    Text
                </div>
                <div
                    class="cursor-pointer h-[42px] rounded-full w-[176px] bg-[#3F54D1] flex justify-center items-center text-white shadow-lg">
                    UPLOAD
                </div>
                @if($errors->has('uploading_images.*'))
                    <small class="text-[#ff9f9f]">{{$errors->first('uploading_images.*')}}</small>
                @endif

            </label>
            <input id="images-{{$instance->id}}" class="hidden" multiple type="file" wire:model="uploading_images"
                   accept=".jpg,.jpeg,.png,.gif,.svg,.webp">

        @else
            <form class="w-full h-full">
                <label for="images-{{$instance->id}}"
                       class="cursor-pointer w-full h-full flex flex-wrap justify-center items-center text-white rounded-[16px] border-[5px] border-dashed border-white border-opacity-50">
                    <div x-show="isUploading">
                        <progress max="100" x-bind:value="progress"></progress>
                        <div wire:loading wire:target="updatedUploadImages">Guardando...</div>
                        <div wire:loading.remove wire:target="updatedUploadImages">Guardando...</div>
                    </div>

                    <div x-show="!isUploading" class="text-center">
                        <span class="material-symbols-rounded w-full text-[64px]">add_photo_alternate</span>
                        <p class="w-full">Haz click para seleccionar las imágenes</p>
                        <small class="w-full">Formatos soportados (.jpg, .jpeg, .png, .gif, .svg, .webp)</small>
                        @if($errors->has('uploading_images.*'))
                            <br><small class="text-[#ff9f9f]">{{$errors->first('uploading_images.*')}}</small>
                        @endif
                    </div>

                    <input id="images-{{$instance->id}}" class="hidden" type="file" wire:model="uploading_images"
                           multiple
                           accept=".jpg,.jpeg,.png,.gif,.svg,.webp">
                </label>


            </form>
            @endif


            </small>
            @if($selectedImage)
                <div
                    class="fixed top-0 left-0 w-full h-full z-11 bg-black bg-opacity-80 backdrop-filter backdrop-blur-[5px] flex justify-center items-center">
                    <div
                        class="relative text-white w-[560px] h-[385px] rounded-[8px] bg-white bg-opacity-20 backdrop-filter backdrop-blur-[25px] p-[64px]">
                    <span wire:click="close"
                          class="cursor-pointer absolute top-[18px] right-[18px] material-symbols-rounded">
                        close
                    </span>

                        <h3 class="w-full mb-12">Image: {{$selectedImage->id}}</h3>
                        <div class="pl-8 flex flex-wrap gap-4">
                            <label class="w-full flex justify-between">Name <input
                                    class="w-80 bg-white bg-opacity-20 rounded-[8px]" type="text"
                                    wire:model="name"></label>
                            <label class="w-full flex justify-between">Alt <input
                                    class="w-80 bg-white bg-opacity-20 rounded-[8px]" type="text"
                                    wire:model="alt"></label>
                        </div>
                        <div class="flex flex-wrap gap-8 mt-12 items-center justify-center">
                            <button class=" h-[42px] w-[176px] rounded-full shadow-md text-white bg-[#3F54D1]"
                                    wire:click="save">Save
                            </button>
                            @if($errors->has('name'))
                                <small class="text-[#ff9f9f]">{{$errors->first('name')}}</small>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
                </small>
