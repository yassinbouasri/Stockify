<div>
    <form class="" wire:submit="save">
        <div class=" mx-4 my-4">
            <x-label class="p-1">Product Name:</x-label>
            <x-input class="w-1/4 p-1"
                     wire:model="form.name"
            />
        </div>
        <div class=" mx-4 my-4">
            <x-label class="p-1">Category:</x-label>
            <select class="w-1/4 p-1" wire:model.defer="form.category_id">
                @foreach($this->categories as $category)
                    <option value="{{(int) $category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div class=" mx-4 my-4">
            <x-label class="p-1">SKU:</x-label>
            <x-input class="w-1/4 p-1"
                     wire:model="form.sku"
            />
        </div>
        <div class=" mx-4 my-4">
            <x-label class="p-1">Price:</x-label>
            <x-input type="number" class="w-1/4 p-1"
                     wire:model="form.price"
            />
        </div>
        <div class=" mx-4 my-4">
            <x-label class="p-1">Description:</x-label>

            <textarea wire:model="form.description" class="font-medium text-sm text-gray-700 dark:text-gray-300 dark:bg-gray-900 dark:border-gray-600 w-1/4 p-4">

            </textarea>
        </div>
        <div class=" mx-4 my-4">
            <x-label class="p-1">Image:</x-label>

            <x-input  type="file" class="w-1/4 p-1"
                     wire:model="form.photo"
            />
        </div>

        <x-validation-errors class="mx-4 my-4"/>
        <div class=" mx-4 my-4">
            <x-button>Create</x-button>
        </div>


    </form>
</div>
