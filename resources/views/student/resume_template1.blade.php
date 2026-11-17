@extends('layouts.resumetempmaster')

@section('content')

<style>
  /* Hover Effect on Card Thumbnails */
  .meeting-item .thumb {
    position: relative;
    cursor: pointer;
    overflow: hidden;
  }

  .meeting-item .thumb img {
    transition: transform 0.35s ease;
  }

  .meeting-item .thumb:hover img {
    transform: scale(1.06);
  }

  /* "Click to Preview" badge on hover */
  .meeting-item .thumb .thumb-hover-overlay {
    position: absolute;
    inset: 0;
    background: rgba(15, 23, 42, 0.45);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-size: 14px;
    font-weight: 600;
    opacity: 0;
    transition: opacity 0.25s ease;
    border-radius: 20px 20px 0 0;
    pointer-events: none;
    gap: 6px;
  }

  .meeting-item .thumb:hover .thumb-hover-overlay {
    opacity: 1;
  }

  /* Fullscreen Popup Modal */
  .resume-preview-overlay {
    display: none;
    position: fixed;
    z-index: 999999;
    left: 0;
    top: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(15, 23, 42, 0.88);
    backdrop-filter: blur(5px);
    justify-content: center;
    align-items: center;
    padding: 20px;
  }

  .resume-preview-box {
    position: relative;
    max-width: 90vw;
    max-height: 92vh;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7);
    padding: 18px 20px;
    text-align: center;
    animation: popupZoomIn 0.22s cubic-bezier(0.16, 1, 0.3, 1);
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  @keyframes popupZoomIn {
    from {
      opacity: 0;
      transform: scale(0.9);
    }
    to {
      opacity: 1;
      transform: scale(1);
    }
  }

  .resume-preview-img {
    max-width: 100%;
    max-height: 80vh;
    height: auto;
    object-fit: contain;
    border-radius: 6px;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.2);
  }

  .resume-preview-caption {
    margin-top: 12px;
    font-size: 15px;
    font-weight: 600;
    color: #1e293b;
  }

  /* Red Circle Close Button */
  .resume-preview-close {
    position: absolute;
    top: -14px;
    right: -14px;
    width: 36px;
    height: 36px;
    background: #ef4444;
    color: #ffffff;
    border: 2px solid #ffffff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.35);
    transition: background 0.2s, transform 0.2s;
    line-height: 1;
    z-index: 10;
  }

  .resume-preview-close:hover {
    background: #dc2626;
    transform: scale(1.12);
  }
</style>

<section class="upcoming-meetings" id="meetings">
  <div class="container">
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 12px; background-color: #dcfce7; color: #15803d; padding: 16px 20px; font-size: 15px; font-weight: 500;">
        <i class="fa fa-check-circle me-2" style="font-size: 1.2rem; vertical-align: middle;"></i>
        <span>{{ session('success') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right; background: none; border: none; font-size: 18px; cursor: pointer; color: #15803d;">&times;</button>
      </div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 12px; background-color: #fee2e2; color: #b91c1c; padding: 16px 20px; font-size: 15px; font-weight: 500;">
        <i class="fa fa-exclamation-triangle me-2" style="font-size: 1.2rem; vertical-align: middle;"></i>
        <span>{{ session('error') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right; background: none; border: none; font-size: 18px; cursor: pointer; color: #b91c1c;">&times;</button>
      </div>
    @endif

    <div class="row">
      <div class="col-lg-12">
        <div class="section-heading">
          <h2>Resume Builder</h2>
        </div>
      </div>

      @php
        $hasActiveSub = Auth::check() && \App\Models\Subscription::where('user_id', Auth::id())
            ->where('status', 'active')
            ->whereNotNull('end_date')
            ->where('end_date', '>=', now())
            ->exists();
        
        $templatesList = isset($resumeTemplates) && $resumeTemplates->count() > 0 
            ? $resumeTemplates 
            : \App\Models\ResumeTemplate::where('status', 'active')->orderBy('id', 'asc')->get();

        $userResumesMap = isset($userResumesByTemplate)
            ? $userResumesByTemplate
            : (Auth::check() ? \App\Models\Resume::where('user_id', Auth::id())->with('template')->get()->keyBy('template_id') : collect());

        $mySavedResumes = isset($savedResumes)
            ? $savedResumes
            : (Auth::check() ? \App\Models\Resume::where('user_id', Auth::id())->with('template')->latest()->get() : collect());
      @endphp

      <!-- Categories Sidebar -->
      <div class="col-lg-4">
        <div class="categories">
          <h4>Resume Templates</h4>
          <ul style="list-style: none; padding: 0; margin: 20px 0 25px 0;">
            @foreach($templatesList as $tmpl)
              @php
                $isPrem = $tmpl->isPremium();
                $isNorm = $tmpl->isNormal();
                $isStand = $tmpl->isStandard();
                $existing = $userResumesMap->get($tmpl->id);
                if ($isNorm) {
                    $targetRoute = $existing ? route('student.resume.preview', $existing->id) : route('student.resume.start', $tmpl->id);
                } else {
                    $targetRoute = $existing ? route('student.resume.edit', $existing->id) : route('student.resume.start', $tmpl->id);
                }
              @endphp
              <li style="display: block; padding: 12px 0; border-bottom: 1px solid #e2e8f0;">
                <a href="{{ $targetRoute }}" 
                   style="display: flex; align-items: center; justify-content: space-between; font-size: 15px; font-weight: 500; color: #1e293b; text-decoration: none; transition: color 0.2s;"
                   onmouseover="this.style.color='#dc2626'" 
                   onmouseout="this.style.color='#1e293b'">
                   <span>{{ $isPrem ? '⭐' : '📄' }} {{ $tmpl->template_name }}</span>
                   <div>
                     @if($isNorm)
                       <span style="background: #e0f2fe; color: #0369a1; font-size: 11px; padding: 2px 8px; border-radius: 12px; font-weight: 700;">👁️ View / Download</span>
                     @elseif($existing)
                       <span style="background: #dcfce7; color: #15803d; font-size: 11px; padding: 2px 8px; border-radius: 12px; font-weight: 700;">✏️ Edit</span>
                     @elseif($isPrem)
                       @if(!$hasActiveSub)
                         <span style="background: #fef3c7; color: #92400e; font-size: 11px; padding: 2px 8px; border-radius: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.04em;">🔒 Locked</span>
                       @else
                         <span style="background: #e0f2fe; color: #0369a1; font-size: 11px; padding: 2px 8px; border-radius: 12px; font-weight: 700; text-transform: uppercase;">Premium</span>
                       @endif
                     @else
                       <span style="background: #f1f5f9; color: #475569; font-size: 11px; padding: 2px 8px; border-radius: 12px; font-weight: 600;">Standard</span>
                     @endif
                   </div>
                </a>
              </li>
            @endforeach
          </ul>

          @if($mySavedResumes && $mySavedResumes->isNotEmpty())
            <div class="mt-4 pt-3 border-top">
              <h5 style="font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 12px;">
                📋 My Created Resumes ({{ $mySavedResumes->count() }})
              </h5>
              <div class="list-group list-group-flush">
                @foreach($mySavedResumes as $myRes)
                  <div class="p-2 mb-2 rounded" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                      <strong style="font-size: 13px; color: #1e293b; max-width: 170px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                        {{ $myRes->title }}
                      </strong>
                      <span style="font-size: 10px; color: #64748b;">
                        {{ $myRes->updated_at->diffForHumans(null, true) }}
                      </span>
                    </div>
                    <div style="font-size: 11px; color: #64748b; margin-bottom: 6px;">
                      Template: {{ $myRes->template->template_name ?? 'Custom' }}
                    </div>
                    <div class="d-flex gap-1">
                      @if($myRes->template && $myRes->template->isNormal())
                        <a href="{{ route('student.resume.preview', $myRes->id) }}" class="btn btn-outline-success btn-sm flex-fill fw-bold" style="font-size: 11px; padding: 4px 6px; border-radius: 4px;">
                          👁️ View / Download
                        </a>
                      @else
                        <a href="{{ route('student.resume.edit', $myRes->id) }}" class="btn btn-primary btn-sm flex-fill" style="font-size: 11px; padding: 3px 6px; border-radius: 4px;">
                          ✏️ Edit
                        </a>
                        <a href="{{ route('student.resume.preview', $myRes->id) }}" class="btn btn-outline-success btn-sm flex-fill" style="font-size: 11px; padding: 3px 6px; border-radius: 4px;">
                          👁️ Preview
                        </a>
                      @endif
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          @endif
        </div>
      </div>

      <!-- Cards Grid -->
      <div class="col-lg-8">
        <div class="row">
          @forelse($templatesList as $tmpl)
            @php
              $isPrem = $tmpl->isPremium();
              $isNorm = $tmpl->isNormal();
              $isStand = $tmpl->isStandard();
              $existingResume = $userResumesMap->get($tmpl->id);
              $editUrl = ($existingResume && !$isNorm) ? route('student.resume.edit', $existingResume->id) : '';
              $previewUrl = $existingResume ? route('student.resume.preview', $existingResume->id) : '';
              $createUrl = route('student.resume.start', $tmpl->id);
            @endphp
            <div class="col-lg-6 mb-4">
              <div class="meeting-item" style="border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.06); border: {{ $existingResume ? '2px solid #22c55e' : '1px solid #e2e8f0' }};">
                <div class="thumb" style="border-radius: 18px 18px 0 0;" onclick="openResumeModal('{{ $tmpl->preview_url }}', '{{ addslashes($tmpl->template_name) }}', '{{ $editUrl }}', '{{ $previewUrl }}', '{{ $createUrl }}', {{ $isPrem && !$hasActiveSub ? 'true' : 'false' }}, {{ $isNorm ? 'true' : 'false' }})">
                  <div class="price">
                    @if($isPrem)
                      <span style="background-color: #f59e0b;">⭐ Premium</span>
                    @elseif($isNorm)
                      <span style="background-color: #0284c7;">Display &amp; Download</span>
                    @else
                      <span>Standard</span>
                    @endif
                    @if($existingResume)
                      <span style="background-color: #16a34a; margin-left: 5px;">✓ Ready</span>
                    @endif
                  </div>
                  <img src="{{ $tmpl->preview_url }}" 
                       alt="{{ $tmpl->template_name }}" 
                       style="height: 240px; width: 100%; object-fit: cover; object-position: top; display: block;"
                       onerror="this.src='{{ asset('guest/assets/r1.jpeg') }}'">
                  <div class="thumb-hover-overlay">
                    <span>🔍 Click to Preview</span>
                  </div>
                </div>
                <div class="down-content" style="padding: 22px;">
                  <div class="d-flex justify-content-between align-items-center mb-2">
                    <a href="javascript:void(0)" onclick="openResumeModal('{{ $tmpl->preview_url }}', '{{ addslashes($tmpl->template_name) }}', '{{ $editUrl }}', '{{ $previewUrl }}', '{{ $createUrl }}', {{ $isPrem && !$hasActiveSub ? 'true' : 'false' }}, {{ $isNorm ? 'true' : 'false' }})">
                      <h4 style="margin: 0; font-size: 17px;">{{ $tmpl->template_name }}</h4>
                    </a>
                  </div>
                  <p style="margin-left: 0 !important; padding-left: 0 !important; font-size: 13px; color: #64748b; margin-bottom: 15px;">
                    @if($isNorm)
                      Clean, standard template ready to view and download directly. (Not editable)
                    @elseif($isStand)
                      Modern ATS design. Work Experience &amp; Projects and Achievements &amp; Certifications are editable.
                    @else
                      Exclusive ATS-optimized premium template with all fields fully editable and customizable.
                    @endif
                  </p>

                  <!-- PORTION FOR ACTION BUTTONS -->
                  @if($isNorm)
                    @if($existingResume)
                      <div class="mb-3 p-2 rounded" style="background: #f0fdf4; border: 1px solid #bbf7d0;">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                          <span style="font-size: 12px; font-weight: 700; color: #166534;">
                            <i class="fa fa-check-circle me-1"></i> Normal Resume
                          </span>
                          <span style="font-size: 11px; color: #64748b;">
                            Display &amp; Download Only
                          </span>
                        </div>
                        <div style="font-size: 12px; color: #1e293b; font-weight: 500; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                          {{ $existingResume->title }}
                        </div>
                      </div>

                      <div>
                        <a href="{{ route('student.resume.preview', $existingResume->id) }}" 
                           class="btn btn-success w-100 fw-bold" 
                           style="border-radius: 25px; padding: 9px 12px; font-size: 13px;">
                          <i class="fa fa-eye me-1"></i> View &amp; Download Resume
                        </a>
                      </div>
                    @else
                      <div>
                        <a href="{{ $createUrl }}" 
                           class="btn btn-success w-100 fw-bold" 
                           style="border-radius: 25px; padding: 9px 16px; font-size: 13px;">
                          <i class="fa fa-eye me-1"></i> View &amp; Download Resume &rarr;
                        </a>
                      </div>
                    @endif
                  @else
                    @if($existingResume)
                      <div class="mb-3 p-2 rounded" style="background: #f0fdf4; border: 1px solid #bbf7d0;">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                          <span style="font-size: 12px; font-weight: 700; color: #166534;">
                            <i class="fa fa-check-circle me-1"></i> Resume Created
                          </span>
                          <span style="font-size: 11px; color: #64748b;">
                            Updated {{ $existingResume->updated_at->diffForHumans() }}
                          </span>
                        </div>
                        <div style="font-size: 12px; color: #1e293b; font-weight: 500; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                          {{ $existingResume->title }}
                        </div>
                      </div>

                      <div class="d-flex gap-2">
                        <a href="{{ route('student.resume.edit', $existingResume->id) }}" 
                           class="btn btn-primary flex-fill fw-bold" 
                           style="border-radius: 25px; padding: 9px 12px; font-size: 13px;">
                          <i class="fa fa-pencil me-1"></i> Edit Resume
                        </a>
                        <a href="{{ route('student.resume.preview', $existingResume->id) }}" 
                           class="btn btn-outline-success flex-fill fw-bold" 
                           style="border-radius: 25px; padding: 9px 12px; font-size: 13px;">
                          <i class="fa fa-eye me-1"></i> Preview / Print
                        </a>
                      </div>
                    @else
                      <div>
                        <a href="{{ $createUrl }}" 
                           class="btn {{ $isPrem ? 'btn-warning text-dark' : 'btn-danger' }} w-100 fw-bold" 
                           style="border-radius: 25px; padding: 9px 16px; font-size: 13px;">
                          @if($isPrem && !$hasActiveSub)
                            <i class="fa fa-lock me-1"></i> Unlock with Plan &rarr;
                          @else
                            <i class="fa fa-magic me-1"></i> Use &amp; Create &rarr;
                          @endif
                        </a>
                      </div>
                    @endif
                  @endif

                </div>
              </div>
            </div>
          @empty
            <div class="col-12 text-center py-5">
              <p class="text-muted">No resume templates available at the moment.</p>
            </div>
          @endforelse
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Full Resume Preview Lightbox Modal -->
<div id="resumePreviewOverlay" class="resume-preview-overlay">
  <div class="resume-preview-box" id="resumePreviewBox">
    
    <!-- Close Button -->
    <span class="resume-preview-close" onclick="closeResumeModal()" title="Close">&times;</span>
    
    <img id="resumePreviewImg" src="" alt="Full Resume" class="resume-preview-img">
    <div id="resumePreviewCaption" class="resume-preview-caption"></div>

    <!-- Modal Action Buttons Bar -->
    <div id="resumeModalActions" class="mt-3 d-flex flex-wrap justify-content-center gap-2" style="width: 100%;">
      <!-- Populated dynamically by JS -->
    </div>
  </div>
</div>

<script>
  function openResumeModal(imgSrc, title, editUrl, previewUrl, createUrl, isLocked, isNormal) {
    const overlay = document.getElementById('resumePreviewOverlay');
    const img = document.getElementById('resumePreviewImg');
    const caption = document.getElementById('resumePreviewCaption');
    const actions = document.getElementById('resumeModalActions');

    img.src = imgSrc;
    caption.textContent = title + ' - Preview';

    let actionHtml = '';
    if (isLocked) {
      actionHtml = `
        <a href="{{ route('student.subscription') }}" class="btn btn-warning text-dark fw-bold px-4" style="border-radius: 20px;">
          🔒 Unlock with Plan &rarr;
        </a>
      `;
    } else if (isNormal) {
      actionHtml = `
        <a href="${previewUrl || createUrl}" class="btn btn-success fw-bold px-4" style="border-radius: 20px;">
          👁️ View &amp; Download Resume
        </a>
      `;
    } else if (editUrl) {
      actionHtml = `
        <a href="${editUrl}" class="btn btn-primary fw-bold px-4" style="border-radius: 20px;">
          ✏️ Edit Resume
        </a>
        <a href="${previewUrl}" class="btn btn-success fw-bold px-4" style="border-radius: 20px;">
          👁️ Preview &amp; Print
        </a>
      `;
    } else {
      actionHtml = `
        <a href="${createUrl}" class="btn btn-danger fw-bold px-4" style="border-radius: 20px;">
          🚀 Use This Template &rarr;
        </a>
      `;
    }

    actions.innerHTML = actionHtml;
    overlay.style.display = 'flex';
    document.body.style.overflow = 'hidden';
  }

  function closeResumeModal() {
    const overlay = document.getElementById('resumePreviewOverlay');
    overlay.style.display = 'none';
    document.body.style.overflow = '';
  }

  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      closeResumeModal();
    }
  });
</script>

@endsection