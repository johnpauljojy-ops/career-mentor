@extends('layouts.adminmaster')

@section('content')
<style>
    /* Page & Card Styling */
    .plan-page-title {
        color: #1a2035;
        font-weight: 700;
        font-size: 1.6rem;
        letter-spacing: -0.01em;
    }
    .plan-page-subtitle {
        color: #7d879c;
        font-size: 0.92rem;
    }
    .plan-card {
        border: 0;
        border-radius: 14px;
        background: #ffffff;
        box-shadow: 0 4px 20px rgba(30, 40, 90, 0.05);
        margin-bottom: 24px;
    }
    
    /* Left Card: Add/Update Form */
    .form-card .card-header {
        background: #ffffff;
        border-bottom: 1px solid #f1f3f7;
        padding: 1.35rem 1.6rem 1.15rem;
    }
    .form-card .card-title {
        margin: 0;
        font-size: 1.15rem;
        font-weight: 600;
        color: #1a2035;
    }
    .form-card .card-body {
        padding: 1.6rem;
    }
    .form-card .form-label {
        font-size: 0.86rem;
        font-weight: 500;
        color: #495057;
        margin-bottom: 0.45rem;
    }
    .form-card .form-control {
        border-radius: 8px;
        border: 1px solid #e2e7f1;
        font-size: 0.88rem;
        padding: 0.65rem 0.95rem;
        color: #2b3350;
        background-color: #ffffff;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .form-card .form-control:focus {
        border-color: #1572e8;
        box-shadow: 0 0 0 3px rgba(21, 114, 232, 0.12);
        outline: none;
    }
    .form-card .form-control::placeholder {
        color: #9aa5b8;
        font-size: 0.87rem;
    }
    .form-card .btn-save-plan {
        background-color: #1572e8;
        border: none;
        color: #ffffff;
        font-weight: 600;
        font-size: 0.92rem;
        padding: 0.72rem 1.5rem;
        border-radius: 50px;
        width: 100%;
        transition: background-color 0.2s ease, transform 0.1s ease;
    }
    .form-card .btn-save-plan:hover {
        background-color: #1263c9;
        color: #ffffff;
    }

    /* Right Card: Plan Table */
    .list-card .card-header {
        background: #ffffff;
        border-bottom: none;
        padding: 1.4rem 1.6rem 0.6rem;
    }
    .list-card .card-title {
        margin: 0;
        font-size: 1.15rem;
        font-weight: 600;
        color: #1a2035;
    }
    .plan-table {
        margin-bottom: 0;
    }
    .plan-table thead th {
        background: transparent;
        color: #8391a7;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.07em;
        text-transform: uppercase;
        border-top: 0;
        border-bottom: 1px solid #f0f2f7;
        padding: 1rem 1.5rem;
    }
    .plan-table tbody td {
        padding: 1.15rem 1.5rem;
        vertical-align: middle;
        border-top: 1px solid #f1f3f8;
        border-bottom: 0;
        color: #4b5568;
        font-size: 0.88rem;
    }
    .plan-table tbody tr:hover {
        background-color: #fafbfd;
    }
    .plan-name-cell {
        font-weight: 600;
        color: #1a2035;
    }

    /* Soft Pill Badges */
    .badge-soft {
        font-size: 0.74rem;
        font-weight: 600;
        padding: 0.35rem 0.75rem;
        border-radius: 30px;
        display: inline-block;
    }
    .badge-soft-success {
        background-color: #eaf8ee;
        color: #28a745;
    }
    .badge-soft-secondary {
        background-color: #f1f3f7;
        color: #808c9f;
    }

    /* Action Links (clean, no-underline) */
    .plan-actions {
        white-space: nowrap;
        text-align: right;
    }
    .plan-actions a,
    .plan-actions button {
        font-size: 0.82rem;
        font-weight: 600;
        text-decoration: none !important;
        background: none;
        border: 0;
        padding: 0;
        margin-left: 0.75rem;
        cursor: pointer;
        display: inline-block;
        transition: opacity 0.2s ease;
    }
    .plan-actions a:hover,
    .plan-actions button:hover {
        opacity: 0.75;
    }
    .plan-actions .act-update { color: #1572e8; }
    .plan-actions .act-activate { color: #28a745; }
    .plan-actions .act-deactivate { color: #ff9800; }
    .plan-actions .act-delete { color: #f25961; }
    .plan-actions form { display: inline; margin: 0; }
</style>

<div class="container">
    <div class="page-inner">

        {{-- Page Header --}}
        <div class="mb-4">
            <h2 class="plan-page-title mb-1">Manage Plans</h2>
            <p class="plan-page-subtitle mb-0">Add, update, and organize subscription plans</p>
        </div>

        {{-- Alerts --}}
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm" style="border-radius: 10px;">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger border-0 shadow-sm" style="border-radius: 10px;">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">

            {{-- LEFT: Add / Edit Form --}}
            <div class="col-lg-4">
                <div class="card plan-card form-card">
                    <div class="card-header">
                        <h4 class="card-title">{{ isset($plan) ? 'Update Plan' : 'Add New Plan' }}</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST"
                              action="{{ isset($plan) ? route('admin.plans.update', $plan->id) : route('admin.plans.store') }}">
                            @csrf
                            @if(isset($plan)) @method('PUT') @endif

                            <div class="mb-3">
                                <label for="plan_name" class="form-label">Plan Name</label>
                                <input type="text" id="plan_name" name="plan_name" class="form-control"
                                       placeholder="e.g. Premium Monthly"
                                       value="{{ old('plan_name', $plan->plan_name ?? '') }}">
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Price (₹)</label>
                                <input type="number" step="0.01" id="price" name="price" class="form-control"
                                       placeholder="e.g. 499"
                                       value="{{ old('price', $plan->price ?? '') }}">
                            </div>

                            <div class="mb-3">
                                <label for="duration_days" class="form-label">Duration (days)</label>
                                <input type="number" id="duration_days" name="duration_days" class="form-control"
                                       placeholder="e.g. 30"
                                       value="{{ old('duration_days', $plan->duration_days ?? '') }}">
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" name="description" rows="3" class="form-control"
                                          placeholder="Short description">{{ old('description', $plan->description ?? '') }}</textarea>
                            </div>

                            <div class="form-check mb-4">
                                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
                                       {{ old('is_active', $plan->is_active ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label text-muted" for="is_active">Active</label>
                            </div>

                            <button type="submit" class="btn btn-save-plan">
                                {{ isset($plan) ? 'Update Plan' : 'Save Plan' }}
                            </button>

                            @if(isset($plan))
                                <a href="{{ route('admin.addplan') }}" class="btn btn-link w-100 mt-2 text-muted text-decoration-none">
                                    Cancel
                                </a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Plan List --}}
            <div class="col-lg-8">
                <div class="card plan-card list-card">
                    <div class="card-header">
                        <h4 class="card-title">Plan List</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table plan-table align-middle">
                            <thead>
                                <tr>
                                    <th style="width: 80px;"># ID</th>
                                    <th>Plan Name</th>
                                    <th>Price</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($plans as $p)
                                    <tr>
                                        <td class="text-muted fw-semibold">{{ $p->id }}</td>
                                        <td class="plan-name-cell">{{ $p->plan_name }}</td>
                                        <td>₹{{ number_format($p->price, 2) }}</td>
                                        <td>{{ $p->duration_days }} days</td>
                                        <td>
                                            <span class="badge-soft {{ $p->is_active ? 'badge-soft-success' : 'badge-soft-secondary' }}">
                                                {{ $p->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="plan-actions">
                                            <a href="{{ route('admin.plans.edit', $p->id) }}" class="act-update">Update</a>

                                            @if($p->is_active)
                                                <form action="{{ route('admin.plans.deactivate', $p->id) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="act-deactivate">Deactivate</button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.plans.activate', $p->id) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="act-activate">Activate</button>
                                                </form>
                                            @endif

                                            <form action="{{ route('admin.plans.destroy', $p->id) }}" method="POST"
                                                  onsubmit="return confirm('Delete this plan?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="act-delete">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">No plans added yet.</td>
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