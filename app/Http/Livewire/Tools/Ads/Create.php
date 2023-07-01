<?php

namespace App\Http\Livewire\Ads\Views;

use App\Models\Ads;
use App\Models\AdsType;
use App\Models\Package;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $ads_type_id;
    public $ads_url;
    public $ads_title;
    public $ads_notes;
    public $ads_photo;
    public $ads_package_id;
    public $number_of_views;
    public $packages = [];
    public $package_label;
    public $adsType;
    public $package_amount = 0;
    public $amount_to_pay = 0;
    public $package = null;
    public $type = 'views';

    public function mount($id)
    {
        $this->ads_type_id = $id;
        $this->adsType = AdsType::find($id);
        $this->packages = Package::where('ads_type_id', $this->ads_type_id)->whereNotNull('updated_at')->get();
    }
    public function render(): View
    {
        if ($this->ads_package_id) {
            $package = Package::find($this->ads_package_id);
            $this->package = $package;
            if ($package->type == 'views') {
                $this->amount_to_pay = $this->number_of_views * $package->price;
            } else {
                $this->number_of_views = $package->benefits;
                $this->amount_to_pay = $package->price;
            }
        }
        return view('livewire.tools.ads.create', [
            'ads_types' => AdsType::whereNotNull('updated_at')->get(),
        ]);
    }

    public function store()
    {
        $this->validate([
            'ads_type_id' => 'required',
            'ads_title' => 'required',
            'ads_package_id' => 'required',
            'number_of_views' => 'numeric',
        ]);

        try {
            $user = auth()->user();
            
            $data = [
                'user_id' => $user->id,
                'package_id' => $this->ads_package_id,
                'title' => $this->ads_title,
                'notes' => $this->ads_notes,
                'url' => $this->ads_url ?? '#',
                'views' => $this->number_of_views,
                'amount' => $this->amount_to_pay,
                'type' => $this->type,
                'status' => 'active',
            ];

            if ($this->ads_photo) {
                $file = $this->ads_photo->store('images/ads', 'public');
                $data['photo'] = $file;
            }

            Ads::create($data);


            // translate to english 
            $this->alert('success', 'Ads successfully added', [
                'position' =>  'center',
                'timer' =>  3000,
                'toast' =>  false,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
            ]);
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            DB::rollback();
            $this->alert('error', 'Failed to add ads', [
                'position' =>  'center',
                'timer' =>  3000,
                'toast' =>  false,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
            ]);
            //throw $th;
        }
    }
}

 