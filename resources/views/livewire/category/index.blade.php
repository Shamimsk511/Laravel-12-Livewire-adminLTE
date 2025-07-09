<div>
    <form wire:submit.prevent="{{ $categoryId ? 'update' : 'create' }}" class="mb-3">
        <div class="row align-items-end">
            <div class="col">
                <input type="text" class="form-control" placeholder="Name" wire:model.defer="name">
            </div>
            <div class="col">
                <input type="number" class="form-control" placeholder="Pcs per Box" wire:model.defer="pcs_per_box" @if($noBox) disabled @endif>
            </div>
            <div class="col">
                <input type="number" step="0.01" class="form-control" placeholder="Sft per Pcs" wire:model.defer="sft_per_pcs" @if($noBox) disabled @endif>
            </div>
            <div class="col-auto form-check">
                <input type="checkbox" class="form-check-input" wire:model="noBox" id="noBoxCheck">
                <label class="form-check-label" for="noBoxCheck">No box and pcs</label>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" type="submit">{{ $categoryId ? 'Update' : 'Add' }}</button>
            </div>
        </div>
        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Pcs/Box</th>
                <th>Sft/Pcs</th>
                <th style="width:150px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $cat)
                <tr>
                    <td>{{ $cat->id }}</td>
                    <td>{{ $cat->name }}</td>
                    <td>{{ $cat->pcs_per_box }}</td>
                    <td>{{ $cat->sft_per_pcs }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" wire:click="edit({{ $cat->id }})">Edit</button>
                        <button class="btn btn-sm btn-danger" wire:click="delete({{ $cat->id }})" onclick="confirm('Are you sure?')||event.stopImmediatePropagation()">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
