<div>
    <x-slot:header>Create Product</x-slot:header>
    <form class="mt-4" wire:submit="save">
        <div class=" mx-4 my-4">
            <x-label class="p-1">Product Name:</x-label>
            <x-input class="w-1/2 p-1"
                     wire:model="form.name"
                     autofocus
                     placeholder="Type A Product Name"
            />
        </div>
        <div class=" mx-4 my-4">
            <x-label class="p-1">Category:</x-label>
            <select class="w-1/2 p-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    wire:model="form.category_id">
                @foreach($this->categories as $category)
                    <option value="{{(int) $category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div class=" mx-4 my-4">
            <x-label class="p-1">SKU:</x-label>
            <x-input class="w-1/2 p-1"
                     wire:model="form.sku"
                     placeholder="Type A Product SKU Or Id"
            />
        </div>
        <div class=" mx-4 my-4">

                <x-label class="p-1">Price:</x-label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none text-gray-500 dark:text-gray-300">
                        $
                    </div>
                    <x-input-money
                            type="number"
                            wire:model="form.price"
                            placeholder="100"/>
                </div>


        </div>
        <div class=" mx-4 my-4">
            <x-label class="p-1">Description:</x-label>

            <textarea wire:model="form.description" class="font-medium text-sm text-gray-700 dark:text-gray-300 dark:bg-gray-900 dark:border-gray-600 w-1/2 p-4 rounded-md" placeholder="Type Some product specifies..">

            </textarea>
        </div>
        <div class=" mx-4 my-4">
            <x-label wire:target="form.quantity" wire:dirty.class="text-orange-400 dark:text-orange-400" class="p-1 ">Quantity:<span wire:dirty wire:target="form.quantity">*</span></x-label>
            <x-input class="w-1/2 p-1"
                     wire:model="form.quantity"
                     type="number"
            />
        </div>
        <div class=" mx-4 my-4 mb-4">
            <x-label class="p-1">Image:</x-label>

            <x-input  type="file" class="w-1/2 p-1"
                     wire:model="form.photo"
            />
        </div>


        <x-validation-errors class="mx-4 my-4 mb-4"/>
        <div class=" mx-4 my-4">
            <x-button class="mx-4 my-4 mb-4">Create</x-button>
        </div>


    </form>
</div>
