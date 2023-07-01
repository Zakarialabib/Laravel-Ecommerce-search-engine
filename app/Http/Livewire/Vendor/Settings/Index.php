<?php

declare(strict_types=1);

namespace App\Http\Livewire\Vendor\Settings;

use Livewire\Component;

class Index extends Component
{
    public $url;

    public function generateQRCode(): void
    {
        // Create a new QR code writer
        // $writer = new Writer(new Png());

        // Generate the QR code image
        // $qrCode = $writer->writeString($this->url);

        // Return the QR code image data
        // return 'data:image/png;base64,'.base64_encode($qrCode);
    }

    public function render()
    {
        return view('livewire.vendor.settings.index');
    }
}
