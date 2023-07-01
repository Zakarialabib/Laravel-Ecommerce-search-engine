<?php

declare(strict_types=1);

namespace App\Http\Livewire\Tools;

use Livewire\Component;
use Laravel\Socialite\Facades\Socialite;
use Edbizarro\LaravelFacebookAds\Facades\FacebookAds;

class AdsManagement extends Component
{
    public function render()
    {
        //$accessToken = 'EAAMzfjwbeW0BAL6uyRKxq9Q5oN3f0EYUGPK6iygpfPj2qMBQkkjCKsT3oLZARCDC4UzwxI3KseJibv8oR5fZBS9q9XvWtCZB2yoWiWcNmOLYlqAfHw329AcPUkprTIX5ieT7Pi5AnNhLzBkvWxvuklaf9tzkMJkuxFNDM406TfKwhcsZBZC01uF9wxXSDstIZD';
        $user = Socialite::driver('facebook')->stateless()->user();
        $accessToken = $user->token; //yes bro

        $access = FacebookAds::init($accessToken);
        $ads = FacebookAds::adAccounts()->all()->map(function ($adAccount) {
            return $adAccount->ads(
                [
                    'name',
                    'account_id',
                    'account_status',
                    'balance',
                    'campaign',
                    'campaign_id',
                    'status',
                ]
            );
        });
        $adAccounts = FacebookAds::adAccounts()->all();

        return view('livewire.facebook-management')->with([
            'ads' => $ads,
        ]);
    }
}
