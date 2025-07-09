<div>
    <form wire:submit.prevent="{{ $brandId ? 'update' : 'create' }}" class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Brand name" wire:model.defer="name">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">{{ $brandId ? 'Update' : 'Add' }}</button>
            </div>
        </div>
        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th style="width:150px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($brands as $brand)
                <tr>
                    <td>{{ $brand->id }}</td>
                    <td>{{ $brand->name }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" wire:click="edit({{ $brand->id }})">Edit</button>
                        <button class="btn btn-sm btn-danger" wire:click="delete({{ $brand->id }})" onclick="confirm('Are you sure?')||event.stopImmediatePropagation()">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
