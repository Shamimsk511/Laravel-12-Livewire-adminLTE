<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Validation\Rule;

class Index extends Component
{
    public $categoryId = null;
    public $name = '';
    public $pcs_per_box = 0;
    public $sft_per_pcs = 0;
    public $noBox = false;

    protected function rules()
    {
        return [
            'name' => 'required',
            'pcs_per_box' => 'required|integer|min:0',
            'sft_per_pcs' => 'required|numeric|min:0',
        ];
    }

    public function updatedNoBox($value)
    {
        if ($value) {
            $this->pcs_per_box = 1;
            $this->sft_per_pcs = 0;
        }
    }

    public function create()
    {
        $data = $this->validate();
        Category::create($data);
        $this->resetFields();
    }

    public function edit($id)
    {
        $cat = Category::findOrFail($id);
        $this->categoryId = $cat->id;
        $this->name = $cat->name;
        $this->pcs_per_box = $cat->pcs_per_box;
        $this->sft_per_pcs = $cat->sft_per_pcs;
        $this->noBox = $cat->pcs_per_box == 1 && $cat->sft_per_pcs == 0;
    }

    public function update()
    {
        $data = $this->validate();
        Category::findOrFail($this->categoryId)->update($data);
        $this->resetFields();
    }

    public function delete($id)
    {
        Category::findOrFail($id)->delete();
    }

    public function resetFields()
    {
        $this->reset('categoryId', 'name', 'pcs_per_box', 'sft_per_pcs', 'noBox');
    }

    public function render()
    {
        return view('livewire.category.index', [
            'categories' => Category::all(),
        ])->layout('layouts.adminlte', ['title' => 'Categories']);
    }
}
