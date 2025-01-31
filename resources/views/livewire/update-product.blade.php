<div class="grid grid-cols-2 gap-8">
    <div>
        <div class="mb-4 text-center text-xl">
            <h3>Edit Product ID:({{ $this->form->id }})</h3>
        </div>
        <form wire:submit="save">
            <div class=" mx-4 my-4">
                <x-label class="p-1">Product Name:</x-label>
                <x-input class="w-1/2 p-1"
                         wire:model="form.name"
                         autofocus
                />
            </div>
            <div class=" mx-4 my-4">
                <x-label class="p-1">Category:</x-label>
                <select
                    class="w-1/2 p-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    wire:model.defer="form.category_id">
                    @foreach($this->categories as $category)
                        <option value="{{(int) $category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class=" mx-4 my-4">
                <x-label class="p-1">SKU:</x-label>
                <x-input class="w-1/2 p-1"
                         wire:model="form.sku"
                />
            </div>
            <div class=" mx-4 my-4">
                <x-label class="p-1">Price:</x-label>
                <x-input type="number" class="w-1/2 p-1"
                         wire:model="form.price"
                />
            </div>
            <div class=" mx-4 my-4">
                <x-label class="p-1">Description:</x-label>

                <textarea wire:model="form.description"
                          class="font-medium text-sm text-gray-700 dark:text-gray-300 dark:bg-gray-900 dark:border-gray-600 w-1/2 p-4">

            </textarea>
            </div>
            <div class=" mx-4 my-4">
                <x-label class="p-1">Image:</x-label>

                <x-input type="file" class="w-1/2 p-1"
                         wire:model="form.photo"
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
