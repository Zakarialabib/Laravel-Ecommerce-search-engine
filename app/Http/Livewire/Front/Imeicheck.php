<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use Http;
use App\Models\Phone;

class Imeicheck extends Component
{
    public $brand, $phone_name;
    
    public $search = '';

    public function mount(){
        $this->search = request()->query('search', $this->search);
    }

    public function render()
    {
        $searchResults = [];
        $data  = [];
        if (strlen($this->search) >= 2) {

            $searchResults = Http::withHeaders([
                'x-rapidapi-host' => 'kelpom-imei-checker1.p.rapidapi.com',
                'x-rapidapi-key' => 'ef09712d9dmsh86275e8132d8751p1cd2f8jsnfbe452f3cca4'
                ])->get('https://kelpom-imei-checker1.p.rapidapi.com/api?imei='.$this->search)
                ->json();
                
            $this->phone_name = $searchResults['model']['device'];
            $this->brand = $searchResults['model']['brand'];   
                
            
            }
            
            return view('livewire.front.imeicheck', [
                'searchResults' => collect($searchResults)->take(3),
                'data' => collect($data)->take(2),
            ]);

    }

}
