<?php

namespace App\Livewire\Setting;

use Livewire\Component;
use App\Models\Setting;

class Index extends Component
{
    public $shop_name = '';
    public $currency = '';
    public $address = '';

    public function mount()
    {
        $this->shop_name = Setting::where('key', 'shop_name')->value('value') ?? '';
        $this->currency = Setting::where('key', 'currency')->value('value') ?? '';
        $this->address = Setting::where('key', 'address')->value('value') ?? '';
    }

    public function save()
    {
        Setting::updateOrCreate(['key' => 'shop_name'], ['value' => $this->shop_name]);
        Setting::updateOrCreate(['key' => 'currency'], ['value' => $this->currency]);
        Setting::updateOrCreate(['key' => 'address'], ['value' => $this->address]);

        cache()->forget('setting_shop_name');
        cache()->forget('setting_currency');
        cache()->forget('setting_address');

        session()->flash('status', 'Settings updated');
    }

    public function render()
    {
        return view('livewire.setting.index')
            ->layout('layouts.adminlte', ['title' => 'System Settings']);
    }
}
