<div>
    @if($this->show)

        <div
            wire:transition.100ms
            class="ml-4 absolute border border-indigo-700 rounded-lg dark:bg-gray-700 max-h-60 overflow-y-auto shadow-lg bg-gray-100 bg-opacity-50 dark:bg-opacity-50"
        >

            {{ $slot }}

        </div>
    @endif
</div>
