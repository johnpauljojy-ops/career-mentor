@extends('layouts.adminmaster')

@section('content')
<style>
    /* Page & Card Styling */
    .template-page-title {
        color: #1a2035;
        font-weight: 700;
        font-size: 1.6rem;
        letter-spacing: -0.01em;
    }
    .template-page-subtitle {
        color: #7d879c;
        font-size: 0.92rem;
    }
    .template-card {
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
    .form-card .form-control, .form-card .form-select {
        border-radius: 8px;
        border: 1px solid #e2e7f1;
        font-size: 0.88rem;
        padding: 0.65rem 0.95rem;
        color: #2b3350;
        background-color: #ffffff;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .form-card .form-control:focus, .form-card .form-select:focus {
        border-color: #1572e8;
        box-shadow: 0 0 0 3px rgba(21, 114, 232, 0.12);
        outline: none;
    }
    .form-card .form-control::placeholder {
        color: #9aa5b8;
        font-size: 0.87rem;
    }
    .form-card .btn-save-template {
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
    .form-card .btn-save-template:hover {
        background-color: #1263c9;
        color: #ffffff;
    }

    /* Right Card: Template Table */
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
    .template-table {
        margin-bottom: 0;
    }
    .template-table thead th {
        background: transparent;
        color: #8391a7;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.07em;
        text-transform: uppercase;
        border-bottom: 1px solid #edf2f9;
        padding: 0.85rem 1.2rem;
    }
    .template-table tbody td {
        padding: 1rem 1.2rem;
        vertical-align: middle;
        font-size: 0.88rem;
        color: #334155;
        border-bottom: 1px solid #f1f4f9;
    }
    .template-table tbody tr:hover {
        background-color: #fbfcfe;
    }
    
    .template-thumb-preview {
        width: 60px;
        height: 75px;
        border-radius: 6px;
        object-fit: cover;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    }
    
    /* Badges */
    .badge-status-active {
        background-color: #e8fadf;
        color: #31a24c;
        font-size: 0.76rem;
        font-weight: 600;
        padding: 0.35em 0.75em;
        border-radius: 50px;
        display: inline-block;
    }
    .badge-status-inactive {
        background-color: #fef0f0;
        color: #e53e3e;
        font-size: 0.76rem;
        font-weight: 600;
        padding: 0.35em 0.75em;
        border-radius: 50px;
        display: inline-block;
    }

    /* Action Buttons */
    .btn-action-icon {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        border: 1px solid #e2e7f1;
        background: #ffffff;
        color: #64748b;
        font-size: 0.82rem;
        transition: all 0.2s ease;
        margin: 0 2px;
    }
    .btn-action-icon:hover {
        border-color: #cbd5e1;
        color: #1e293b;
        background-color: #f8fafc;
    }
    .btn-action-icon.edit:hover {
        border-color: #38a169;
        color: #38a169;
        background-color: #f0fff4;
    }
    .btn-action-icon.delete:hover {
        border-color: #e53e3e;
        color: #e53e3e;
        background-color: #fff5f5;
    }
    .btn-action-icon.toggle-on:hover {
        border-color: #e53e3e;
        color: #e53e3e;
        background-color: #fff5f5;
    }
    .btn-action-icon.toggle-off:hover {
        border-color: #31a24c;
        color: #31a24c;
        background-color: #f0fff4;
    }

    /* Quick Preset Badges */
    .preset-pill {
        display: inline-block;
        padding: 3px 10px;
        background: #f1f5f9;
        color: #475569;
        border-radius: 12px;
        font-size: 11.5px;
        cursor: pointer;
        margin-right: 4px;
        margin-bottom: 6px;
        transition: all 0.15s ease;
        border: 1px solid #e2e8f0;
    }
    .preset-pill:hover {
        background: #1572e8;
        color: #ffffff;
        border-color: #1572e8;
    }
</style>

<div class="container-fluid py-4">

    <!-- Header Section -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="template-page-title mb-1">Resume Templates Management</h1>
            <p class="template-page-subtitle mb-0">Create, configure, and manage resume templates for students.</p>
        </div>
        <div>
            <a href="{{ route('student.resume.template1') }}" target="_blank" class="btn btn-outline-primary rounded-pill px-3" style="font-size: 13px; font-weight: 600;">
                <i class="fas fa-external-link-alt me-1"></i> Preview Student Builder
            </a>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert" style="border-radius: 10px; background-color: #d1e7dd; color: #0f5132;">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert" style="border-radius: 10px;">
            <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert" style="border-radius: 10px;">
            <i class="fas fa-exclamation-circle me-2"></i> <strong>Please fix the errors below:</strong>
            <ul class="mb-0 mt-2 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <!-- Left Column: Add/Edit Form -->
        <div class="col-lg-4">
            <div class="card template-card form-card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas {{ isset($template) ? 'fa-edit text-warning' : 'fa-plus-circle text-primary' }} me-2"></i>
                        {{ isset($template) ? 'Edit Resume Template' : 'Add New Resume Template' }}
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ isset($template) ? route('admin.resumetemplates.update', $template->id) : route('admin.resumetemplates.store') }}" 
                          method="POST" 
                          enctype="multipart/form-data">
                        @csrf
                        @if(isset($template))
                            @method('PUT')
                        @endif

                        <!-- Template Name -->
                        <div class="mb-3">
                            <label class="form-label">Template Name <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="template_name" 
                                   id="inputTemplateName"
                                   class="form-control @error('template_name') is-invalid @enderror" 
                                   value="{{ old('template_name', $template->template_name ?? '') }}" 
                                   placeholder="e.g. Normal Resume, Modern ATS, Premium Executive" 
                                   required>
                            @error('template_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Blade Template File -->
                        <div class="mb-3">
                            <label class="form-label">Blade View File Path <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="blade_file" 
                                   id="inputBladeFile"
                                   class="form-control @error('blade_file') is-invalid @enderror" 
                                   value="{{ old('blade_file', $template->blade_file ?? '') }}" 
                                   placeholder="e.g. student.resume_normal" 
                                   required>
                            <small class="text-muted d-block mt-1" style="font-size: 11.5px;">
                                Quick select existing blade:
                            </small>
                            <div class="mt-1">
                                <span class="preset-pill" onclick="selectBlade('Normal Resume', 'student.resume_normal')">Normal</span>
                                <span class="preset-pill" onclick="selectBlade('Standard Resume', 'student.resume_standard')">Standard</span>
                                <span class="preset-pill" onclick="selectBlade('Premium Resume', 'student.resume_premium')">Premium</span>
                            </div>
                            @error('blade_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        
                        <!-- Status -->
                        <div class="mb-3">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="active" {{ old('status', $template->status ?? 'active') === 'active' ? 'selected' : '' }}>Active (Visible to Students)</option>
                                <option value="inactive" {{ old('status', $template->status ?? '') === 'inactive' ? 'selected' : '' }}>Inactive (Hidden)</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Preview Image Upload -->
                        <div class="mb-4">
                            <label class="form-label">Preview Image <span class="text-muted">(Optional)</span></label>
                            <input type="file" 
                                   name="preview_img" 
                                   id="inputPreviewImg"
                                   class="form-control @error('preview_img') is-invalid @enderror" 
                                   accept="image/*"
                                   onchange="previewImageFile(this)">
                            <small class="text-muted d-block mt-1" style="font-size: 11.5px;">Upload JPG, PNG or WEBP (Max: 5MB)</small>
                            @error('preview_img')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <!-- Preview thumbnail container -->
                            <div id="imagePreviewContainer" class="mt-2 text-center p-2 rounded" style="background: #f8fafc; border: 1px dashed #cbd5e1; {{ isset($template) && $template->preview_img ? '' : 'display: none;' }}">
                                <img id="imagePreviewEl" 
                                     src="{{ isset($template) ? $template->preview_url : '' }}" 
                                     alt="Preview" 
                                     style="max-height: 120px; max-width: 100%; border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                <div class="text-muted mt-1" style="font-size: 11px;">Current / Selected Preview</div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-save-template">
                                <i class="fas {{ isset($template) ? 'fa-check' : 'fa-save' }} me-1"></i>
                                {{ isset($template) ? 'Update Template' : 'Save Resume Template' }}
                            </button>
                            @if(isset($template))
                                <a href="{{ route('admin.resumetemplates.index') }}" class="btn btn-light rounded-pill border text-muted" style="font-size: 0.88rem;">
                                    <i class="fas fa-times me-1"></i> Cancel Edit
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Column: Templates Table -->
        <div class="col-lg-8">
            <div class="card template-card list-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Available Resume Templates</h5>
                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill" style="font-size: 12px;">
                        Total: {{ $templates->count() }} Template(s)
                    </span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table template-table align-middle">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th style="width: 12%;">Preview</th>
                                    <th style="width: 28%;">Template Name</th>
                                    <th style="width: 25%;">Blade File</th>
                                    <th style="width: 12%;">Status</th>
                                    <th class="text-end" style="width: 18%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($templates as $item)
                                    <tr>
                                        <td class="text-muted fw-bold">{{ $item->id }}</td>
                                        <td>
                                            <img src="{{ $item->preview_url }}" 
                                                 alt="{{ $item->template_name }}" 
                                                 class="template-thumb-preview"
                                                 onerror="this.src='{{ asset('guest/assets/r1.jpeg') }}'">
                                        </td>
                                        <td>
                                            <div class="fw-bold text-dark">{{ $item->template_name }}</div>
                                            @if($item->isPremium())
                                                <span class="badge bg-warning text-dark" style="font-size: 10px; border-radius: 10px;">⭐ Premium Only</span>
                                            @else
                                                <span class="badge bg-light text-muted border" style="font-size: 10px; border-radius: 10px;">Free / Normal</span>
                                            @endif
                                        </td>
                                        <td>
                                            <code style="font-size: 12px; color: #0284c7; background: #e0f2fe; padding: 3px 8px; border-radius: 6px;">
                                                {{ $item->blade_file }}
                                            </code>
                                        </td>
                                        <td>
                                            @if($item->status === 'active')
                                                <span class="badge-status-active">
                                                    <i class="fas fa-circle me-1" style="font-size: 6px; vertical-align: middle;"></i> Active
                                                </span>
                                            @else
                                                <span class="badge-status-inactive">
                                                    <i class="fas fa-circle me-1" style="font-size: 6px; vertical-align: middle;"></i> Inactive
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <!-- Activate / Deactivate -->
                                            @if($item->status === 'active')
                                                <form action="{{ route('admin.resumetemplates.deactivate', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn-action-icon toggle-on" title="Deactivate Template">
                                                        <i class="fas fa-eye-slash"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.resumetemplates.activate', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn-action-icon toggle-off" title="Activate Template">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </form>
                                            @endif

                                            <!-- Edit -->
                                            <a href="{{ route('admin.resumetemplates.edit', $item->id) }}" class="btn-action-icon edit" title="Edit Template">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>

                                            <!-- Delete -->
                                            <form action="{{ route('admin.resumetemplates.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete the template \'{{ $item->template_name }}\'?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action-icon delete" title="Delete Template">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted">
                                            <i class="fas fa-folder-open mb-2" style="font-size: 2rem; color: #cbd5e1;"></i>
                                            <p class="mb-0">No resume templates found. Use the form on the left to add one.</p>
                                        </td>
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

<script>
    function selectBlade(name, bladePath) {
        var nameInput = document.getElementById('inputTemplateName');
        var bladeInput = document.getElementById('inputBladeFile');
        if (!nameInput.value) {
            nameInput.value = name;
        }
        bladeInput.value = bladePath;
    }

    function previewImageFile(input) {
        var container = document.getElementById('imagePreviewContainer');
        var img = document.getElementById('imagePreviewEl');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                container.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
