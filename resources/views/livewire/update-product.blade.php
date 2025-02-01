<div class="grid grid-cols-2 gap-8">
    <div>
        <div class="mb-4 mt-4 text-xl text-right">
            <h3 class="dark:text-gray-300 ">Edit Product ID:({{ $this->form->id }})</h3>
        </div>
        <form wire:submit="save">
            <div class=" mx-4 my-4">
                <x-label wire:target="form.name" wire:dirty.class="text-orange-400 dark:text-orange-400" class="p-1 ">Product Name:<span wire:dirty wire:target="form.name">*</span></x-label>
                <x-input class="w-1/2 p-1"
                         wire:model="form.name"
                         autofocus
                />
            </div>
            <div class=" mx-4 my-4">
                <x-label wire:target="form.category_id" wire:dirty.class="text-orange-400 dark:text-orange-400" class="p-1">Category:<span wire:dirty wire:target="form.category_id">*</span></x-label>
                <select
                    class="w-1/2 p-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    wire:model="form.category_id">
                    @foreach($this->categories as $category)
                        <option value="{{(int) $category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class=" mx-4 my-4">
                <x-label wire:target="form.sku" wire:dirty.class="text-orange-400 dark:text-orange-400" class="p-1">SKU:<span wire:dirty wire:target="form.sku">*</span></x-label>
                <x-input class="w-1/2 p-1"
                         wire:model="form.sku"
                />
            </div>
            <div class=" mx-4 my-4">
                <x-label wire:target="form.price" wire:dirty.class="text-orange-400 dark:text-orange-400" class="p-1">Price:<span wire:dirty wire:target="form.price">*</span></x-label>
                <x-input type="number" class="w-1/2 p-1"
                         wire:model="form.price"
                />
            </div>
            <div class=" mx-4 my-4">
                <x-label wire:target="form.description" wire:dirty.class="text-orange-400 dark:text-orange-400" class="p-1">Description:<span wire:dirty wire:target="form.description">*</span></x-label>
                <textarea wire:model="form.description"
                          class="font-medium text-sm text-gray-700 dark:text-gray-300 dark:bg-gray-900 dark:border-gray-600 w-1/2 p-4">

            </textarea>
            </div>
            <div class=" mx-4 my-4">
                <x-label wire:target="form.photo" wire:dirty.class="text-orange-400 dark:text-orange-400" class="p-1">Image:<span wire:dirty wire:target="form.photo">*</span></x-label>

                <x-input type="file" class="w-1/2 p-1"
                         wire:model="form.photo"
                />
            </div>

            <div class=" mx-4 my-4">
                <x-label wire:target="form.quantity" wire:dirty.class="text-orange-400 dark:text-orange-400" class="p-1 ">Quantity:<span wire:dirty wire:target="form.quantity">*</span></x-label>
                <x-input class="w-1/2 p-1"
                         wire:model="form.quantity"
                         type="number"
                />
            </div>

            <x-validation-errors class="mx-4 my-4"/>
            <div class=" mx-4 my-4">
                <x-button>Update</x-button>
            </div>
        </form>
    </div>


    <div class="flex justify-center items-center">
        @if(!empty($form->photo))
            <img class="w-full max-w-sm rounded-lg shadow-md" src="{{ $form->photo->temporaryUrl() }}" alt="Product Image">
        @else
            <img class="w-full max-w-sm rounded-lg shadow-md" src="{{ url($form->image) }}" alt="Product Image">
        @endif

    </div>
</div>
