@extends('Layouts.adminmaster')

@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Manage Branches</h3>
            <h6 class="op-7 mb-2">Add, update, and organize branches under qualifications</h6>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <!-- LEFT SIDE: Form for Add / Edit -->
        <div class="col-md-4">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-title">
                        {{ isset($branch) ? 'Edit Branch' : 'Add New Branch' }}
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ isset($branch) ? route('admin.branches.update', $branch->branch_id) : route('admin.branches.store') }}" method="POST">
                        @csrf
                        @if(isset($branch))
                            @method('PUT')
                        @endif

                        <div class="form-group mb-3">
                            <label for="qualification_id">Select Qualification</label>
                            <select name="qualification_id" id="qualification_id" class="form-control @error('qualification_id') is-invalid @enderror" required>
                                <option value="">-- Choose Qualification --</option>
                                @foreach($qualifications as $qual)
                                    <option value="{{ $qual->qualification_id }}" {{ (old('qualification_id', $branch->qualification_id ?? '') == $qual->qualification_id) ? 'selected' : '' }}>
                                        {{ $qual->qualification_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('qualification_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="branch_name">Branch Name</label>
                            <input type="text" 
                                   class="form-control @error('branch_name') is-invalid @enderror" 
                                   id="branch_name" 
                                   name="branch_name" 
                                   value="{{ old('branch_name', $branch->branch_name ?? '') }}" 
                                   placeholder="e.g. Computer Science" 
                                   required>
                            @error('branch_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-action">
                            <button type="submit" class="btn btn-primary btn-round w-100">
                                {{ isset($branch) ? 'Update Branch' : 'Save Branch' }}
                            </button>
                            @if(isset($branch))
                                <a href="{{ route('admin.branches.index') }}" class="btn btn-secondary btn-round w-100 mt-2">Cancel</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE: View List Table with Actions -->
        <div class="col-md-8">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Branch List</div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" style="width: 10%;"># ID</th>
                                    <th scope="col" style="width: 35%;">Qualification</th>
                                    <th scope="col" style="width: 35%;">Branch Name</th>
                                    <th scope="col" class="text-end" style="width: 20%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($branches as $b)
                                    <tr class="{{ isset($branch) && $branch->branch_id == $b->branch_id ? 'table-active' : '' }}">
                                        <td>{{ $b->branch_id }}</td>
                                        <td class="text-muted">{{ $b->qualification->qualification_name ?? 'N/A' }}</td>
                                        <td class="fw-bold">{{ $b->branch_name }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('admin.branches.edit', $b->branch_id) }}" class="btn btn-link btn-primary btn-sm fw-bold p-0 me-2">
                                                Update
                                            </a>
                                            <form action="{{ route('admin.branches.destroy', $b->branch_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this branch?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link btn-danger btn-sm fw-bold p-0 border-0 bg-transparent">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">No branches found. Add one using the form.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection