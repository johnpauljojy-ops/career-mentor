@extends('Layouts.adminmaster')

@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Manage Qualifications</h3>
            <h6 class="op-7 mb-2">Add, update, and organize academic qualifications</h6>
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
                        {{ isset($qualification) ? 'Edit Qualification' : 'Add New Qualification' }}
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ isset($qualification) ? route('admin.qualifications.update', $qualification->qualification_id) : route('admin.qualifications.store') }}" method="POST">
                        @csrf
                        @if(isset($qualification))
                            @method('PUT')
                        @endif

                        <div class="form-group mb-3">
                            <label for="qualification_name">Qualification Name</label>
                            <input type="text" 
                                   class="form-control @error('qualification_name') is-invalid @enderror" 
                                   id="qualification_name" 
                                   name="qualification_name" 
                                   value="{{ old('qualification_name', $qualification->qualification_name ?? '') }}" 
                                   placeholder="e.g. Bachelor's Degree" 
                                   required>
                            @error('qualification_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-action">
                            <button type="submit" class="btn btn-primary btn-round w-100">
                                {{ isset($qualification) ? 'Update Qualification' : 'Save Qualification' }}
                            </button>
                            @if(isset($qualification))
                                <a href="{{ route('admin.addqualification') }}" class="btn btn-secondary btn-round w-100 mt-2">Cancel</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE: View List Table with Text Actions -->
        <div class="col-md-8">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Qualification List</div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" style="width: 10%;"># ID</th>
                                    <th scope="col" style="width: 60%;">Qualification Name</th>
                                    <th scope="col" class="text-end" style="width: 30%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($qualifications as $qual)
                                    <tr class="{{ isset($qualification) && $qualification->qualification_id == $qual->qualification_id ? 'table-active' : '' }}">
                                        <td>{{ $qual->qualification_id }}</td>
                                        <td class="fw-bold">{{ $qual->qualification_name }}</td>
                                        <td class="text-end">
                                            <!-- Update Button Text -->
                                            <a href="{{ route('admin.qualifications.edit', $qual->qualification_id) }}" class="btn btn-link btn-primary btn-sm fw-bold p-0 me-2">
                                                Update
                                            </a>
                                            
                                            <!-- Delete Button Text -->
                                            <form action="{{ route('admin.qualifications.destroy', $qual->qualification_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this qualification?');">
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
                                        <td colspan="3" class="text-center py-4 text-muted">No qualifications found. Add one using the form.</td>
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