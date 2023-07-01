<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Phone;
use Http;
use Livewire\Component;

class Phonesearch extends Component
{
    public $brand;
    public $phone_name;

    public $search = '';

    public function mount(): void
    {
        $this->search = request()->query('search', $this->search);
    }

    public function render()
    {
        $searchResults = [];

        if (strlen($this->search) >= 2) {
            $searchResults = Http::get('https://api-mobilespecs.azharimm.site/v2/search?query='.$this->search)->json();

            foreach ($searchResults['data']['phones'] as $item) {
                $phone_name = $item['phone_name'];
                $brand = $item['brand'];
                $slug = $item['slug'];
                $image = $item['image'];

                $phone = Phone::create([
                    'phone_name' => $phone_name,
                    'brand'      => $brand,
                    'slug'       => $slug,
                    'image'      => $image,
                ], $searchResults);
                $phone->save();
            }
        }

        return view('livewire.front.phonesearch', [
            'searchResults' => collect($searchResults)->take(2),
        ]);
    }
}
