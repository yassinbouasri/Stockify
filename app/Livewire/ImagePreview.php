<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class ImagePreview extends Component
{
    public $showImageModal = false;

    public $previewImageUrl = '';

    #[On('preview-image')]
    public function previewImage($url)
    {
        $this->previewImageUrl = $url;
        $this->showImageModal = true;
    }

    public function closePreview()
    {
        $this->showImageModal = false;
        $this->previewImageUrl = '';
    }
    public function render()
    {
        return view('livewire.image-preview');
    }
}
