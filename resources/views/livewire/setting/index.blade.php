<div>
    <form wire:submit.prevent="save" class="mb-3">
        <div class="form-group">
            <label>Shop Name</label>
            <input type="text" class="form-control" wire:model.defer="shop_name">
        </div>
        <div class="form-group">
            <label>Currency</label>
            <input type="text" class="form-control" wire:model.defer="currency">
        </div>
        <div class="form-group">
            <label>Address</label>
            <textarea class="form-control" wire:model.defer="address"></textarea>
        </div>
        <button class="btn btn-primary" type="submit">Save</button>
        @if (session()->has('status'))
            <div class="text-success mt-2">{{ session('status') }}</div>
        @endif
    </form>
</div>
