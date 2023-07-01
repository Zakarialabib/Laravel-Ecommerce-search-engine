<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\DeviceModel;
use Http;
use Livewire\Component;

class ImeiCheck extends Component
{
    public $brand;
    public $device_model_name;
    public $device_model;

    public $search = '';

    public function mount(): void
    {
        $this->search = request()->query('search', $this->search);
        $this->device_model = DeviceModel::where('name', 'like', '%'.$this->device_model_name.'%')->first();
    }

    public function render()
    {
        $searchResults = [];
        $data = [];

        if (strlen($this->search) >= 2) {
            $searchResults = Http::withHeaders([
                'x-rapidapi-host' => 'kelpom-imei-checker1.p.rapidapi.com',
                'x-rapidapi-key' => 'ef09712d9dmsh86275e8132d8751p1cd2f8jsnfbe452f3cca4',
            ])->get('https://kelpom-imei-checker1.p.rapidapi.com/api?imei='.$this->search)
                ->json();

            $this->device_model_name = $searchResults['model']['device'];
            $this->brand = $searchResults['model']['brand'];
        }

        return view('livewire.front.imei-check', [
            'searchResults' => collect($searchResults)->take(3),
            'data' => collect($data)->take(2),
        ]);
    }
}
