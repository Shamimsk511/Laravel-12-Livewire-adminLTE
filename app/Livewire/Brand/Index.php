<?php

namespace App\Livewire\Brand;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Validation\Rule;

class Index extends Component
{
    public $name = '';
    public $brandId = null;

    protected function rules()
    {
        return [
            'name' => ['required', Rule::unique('brands','name')->ignore($this->brandId)],
        ];
    }

    public function create()
    {
        $this->validate();
        Brand::create(['name' => $this->name]);
        $this->reset('name');
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        $this->brandId = $brand->id;
        $this->name = $brand->name;
    }

    public function update()
    {
        $this->validate();
        Brand::findOrFail($this->brandId)->update(['name' => $this->name]);
        $this->reset('brandId', 'name');
    }

    public function delete($id)
    {
        Brand::findOrFail($id)->delete();
    }

    public function render()
    {
        return view('livewire.brand.index', ['brands' => Brand::all()])
            ->layout('layouts.adminlte', ['title' => 'Brands']);
    }
}
