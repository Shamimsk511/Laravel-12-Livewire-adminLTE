<div>
    <form wire:submit.prevent="{{ $userId ? 'update' : 'create' }}" class="mb-3">
        <div class="row">
            <div class="col">
                <input type="text" class="form-control" placeholder="Name" wire:model.defer="name">
            </div>
            <div class="col">
                <input type="email" class="form-control" placeholder="Email" wire:model.defer="email">
            </div>
            <div class="col">
                <input type="password" class="form-control" placeholder="Password" wire:model.defer="password">
            </div>
            <div class="col">
                <select class="form-control" wire:model.defer="role">
                    <option value="">Select role</option>
                    @foreach($roles as $r)
                        <option value="{{ $r }}">{{ $r }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" type="submit">{{ $userId ? 'Update' : 'Create' }}</button>
            </div>
        </div>
        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        @error('role') <small class="text-danger">{{ $message }}</small> @enderror
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th style="width:180px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->roles->pluck('name')->first() }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" wire:click="edit({{ $user->id }})">Edit</button>
                        <button class="btn btn-sm btn-danger" wire:click="delete({{ $user->id }})" onclick="confirm('Are you sure?')||event.stopImmediatePropagation()">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
