<div>
    @if($showImageModal)
        <div wire:transition class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center p-4">
            <div class="dark:bg-gray-800 bg-white dark:text-gray-500 rounded-lg shadow-xl max-w-3xl w-full">
                <!-- Modal Header -->
                <div class="flex justify-between items-center p-4">
                    <h3 class="text-lg font-semibold">Image Preview</h3>
                    <button
                        wire:click="closePreview"
                        class="text-gray-500 hover:text-gray-700"
                    >
                        ✕
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="p-4">
                    <img
                        src="{{ url($previewImageUrl) }}"
                        alt="Preview"
                        class="mx-auto max-h-[70vh] object-contain"
                    >
                </div>

                <!-- Modal Footer -->
                <div class="p-4 flex justify-end">
                    <x-button
                        wire:click="closePreview"
                        class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600"
                    >
                        Close
                    </x-button>
                </div>
            </div>
        </div>
    @endif
</div>

