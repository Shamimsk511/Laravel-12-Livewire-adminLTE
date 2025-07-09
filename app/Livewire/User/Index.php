<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    public $userId = null;
    public $name = '';
    public $email = '';
    public $password = '';
    public $role = '';
    public $roles = [];

    protected function rules()
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique('users','email')->ignore($this->userId)],
            'role' => ['required', Rule::in($this->roles)],
        ];
    }

    public function create()
    {
        $data = $this->validate();
        $data['password'] = Hash::make($this->password ?: 'password');
        $user = User::create($data);
        $user->assignRole($this->role);
        $this->resetFields();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->roles->pluck('name')->first();
    }

    public function update()
    {
        $data = $this->validate();
        $user = User::findOrFail($this->userId);
        $user->update($data);
        if ($this->password) {
            $user->update(['password' => Hash::make($this->password)]);
        }
        $user->syncRoles($this->role);
        $this->resetFields();
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
    }

    public function resetFields()
    {
        $this->reset('userId', 'name', 'email', 'password');
        $this->role = '';
    }

    public function render()
    {
        $this->roles = Role::pluck('name')->toArray();
        return view('livewire.user.index', [
            'users' => User::with('roles')->get(),
            'roles' => $this->roles,
        ])
            ->layout('layouts.adminlte', ['title' => 'Users']);
    }
}
