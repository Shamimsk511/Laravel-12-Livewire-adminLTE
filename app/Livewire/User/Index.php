<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Validation\Rule;

class Index extends Component
{
    public $userId = null;
    public $name = '';
    public $email = '';
    public $password = '';

    protected function rules()
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique('users','email')->ignore($this->userId)],
        ];
    }

    public function create()
    {
        $data = $this->validate();
        $data['password'] = Hash::make($this->password ?: 'password');
        User::create($data);
        $this->resetFields();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function update()
    {
        $data = $this->validate();
        $user = User::findOrFail($this->userId);
        $user->update($data);
        if ($this->password) {
            $user->update(['password' => Hash::make($this->password)]);
        }
        $this->resetFields();
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
    }

    public function resetFields()
    {
        $this->reset('userId', 'name', 'email', 'password');
    }

    public function render()
    {
        return view('livewire.user.index', ['users' => User::all()])
            ->layout('layouts.adminlte', ['title' => 'Users']);
    }
}
