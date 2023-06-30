<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Settings;

use Illuminate\Http\RedirectResponse;
use Livewire\Redirector;
use App\Helpers;
use App\Jobs\UnderMaintenanceJob;
use App\Models\Settings;
use Illuminate\Support\Facades\Artisan;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Mail\MaintenanceModeNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MaintenanceMode extends Component
{
    use LivewireAlert;

    public $site_maintenance_message;
    public $status;
    public $secret;
    public $refresh;

    public function mount()
    {
        $this->site_maintenance_message = Helpers::settings('site_maintenance_message');
        $this->status = Helpers::settings('site_maintenance_status');
        $this->refresh = Helpers::settings('site_refresh');
        $this->secret = Str::uuid()->toString();
    }

    public function saveSettings()
    {
        $this->validate([
            'site_maintenance_message' => 'required',
            'site_maintenance_message' => 'required',
        ]);

        Settings::set('site_maintenance_message', $this->site_maintenance_message);
        Settings::set('site_refresh', $this->refresh);

        $this->alert('success', __('Settings saved successfully.'));
    }

    public function turnOff(): Redirector|RedirectResponse
    {
        Settings::set('site_maintenance_status', false);

        Settings::set('site_maintenance__secret', $this->secret);

        UnderMaintenanceJob::dispatch($this->secret, $this->refresh);

        $this->alert('success', implode(' ', ['status' => $this->status ? __('System turned on') : __('System turned off')]));

        return  redirect()->route('front.index', ['secret' => $this->secret]);
        // Send email notification
        // Mail::to($user)->send(new MaintenanceModeNotification(false));
    }

    public function turnOn()
    {
        $this->site_maintenance_status = true;

        Artisan::call('up');

        Settings::set('site_maintenance', $this->site_maintenance_status);

        $this->alert('success', __('System turned on.'));

        // $user = auth()->user()->email;
        // Send email notification
        // Mail::to($user)->send(new MaintenanceModeNotification(true));
    }

    public function render()
    {
        return view('livewire.admin.settings.maintenance-mode');
    }
}
