<div class="row justify-content-center">
    <div class="col-md-8">
        <!-- Card Container -->
        <div class="card card-primary shadow-lg">
            <div class="card-header">
                <h3 class="card-title">
                    {{ $brandId ? 'Edit Brand' : 'Add New Brand' }}
                </h3>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="{{ $brandId ? 'update' : 'create' }}">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               placeholder="Brand name" wire:model.defer="name">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-{{ $brandId ? 'edit' : 'plus' }}"></i>
                                {{ $brandId ? 'Update' : 'Add' }}
                            </button>
                        </div>
                        @error('name')
                            <div class="invalid-feedback d-block">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>
                </form>

                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <!-- Brands Table -->
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped mb-0">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th style="width: 60px;">ID</th>
                                <th>Name</th>
                                <th style="width: 160px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($brands as $brand)
                                <tr>
                                    <td class="align-middle">{{ $brand->id }}</td>
                                    <td class="align-middle">{{ $brand->name }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info mr-1"
                                                wire:click="edit({{ $brand->id }})"
                                                title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger"
                                                wire:click="delete({{ $brand->id }})"
                                                onclick="return confirm('Are you sure you want to delete this brand?')"
                                                title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">No brands found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /table-responsive -->
            </div>
        </div>
    </div>
</div>
