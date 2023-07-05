<?php

declare(strict_types=1);

namespace App\Http\Livewire\Tools\Ads;

use App\Models\Ads;
use Livewire\Component;
use Livewire\WithFileUploads;

class MyAdsList extends Component
{
    use WithFileUploads;

    public $type = 'views';
    public $ads_type_id;
    public $ads_url;
    public $ads_title;
    public $ads_notes;
    public $ads_photo;
    public $package;

    public $showModal = false;

    protected $listeners = [
        'getDataById', 'getId',
    ];

    public function mount($type = 'views')
    {
        $this->type = $type;
    }

    public function render()
    {
        return view('livewire.ads.views.my-ads-list');
    }

    public function getDataById($id)
    {
        $row = Ads::find($id);
        $this->ads_type_id = $row->id;
        $this->ads_url = $row->url;
        $this->ads_title = $row->title;
        $this->ads_notes = $row->notes;
        $this->package = $row->package;

        $this->showModal = true;
    }

    public function store()
    {
        $this->validate([
            'ads_type_id' => 'required',
            'ads_title'   => 'required',
        ]);
        $ads = Ads::find($this->ads_type_id);
        $ads->url = $this->ads_url;
        $ads->title = $this->ads_title;
        $ads->notes = $this->ads_notes;

        if ($this->ads_photo) {
            $file = $this->ads_photo->store('images/ads', 'public');
            $ads->photo = $file;
        }
        $this->_reset();
        $ads->save();
        $this->alert('success', 'Ads updated successfully!');
        $this->showModal = false;
    }

    public function _reset()
    {
        $this->emit('refreshTable');
        $this->ads_type_id = null;
        $this->ads_url = null;
        $this->ads_title = null;
        $this->ads_title = null;
        $this->ads_notes = null;
    }
}
