@extends('Layouts.adminmaster')

@section('content')

<style>
  /* =========================================================
     CAREER MENTOR DARK & EMERALD REPORTS & FEEDBACK THEME
  ========================================================= */

  .page-inner {
    background: #0b132b !important;
    min-height: 100vh;
    color: #f1f5f9;
  }

  .page-inner h1, .page-inner h2, .page-inner h3, .page-inner h4, .page-inner h5, .page-inner h6,
  .page-inner .card-title, .page-inner .numbers .card-title {
    color: #ffffff !important;
    font-weight: 700;
  }

  .page-inner p, .page-inner .text-muted, .page-inner .card-category, .page-inner .op-7 {
    color: #94a3b8 !important;
  }

  .card-round, .card-stats {
    background: #1e293b !important;
    border: 1px solid rgba(255, 255, 255, 0.08) !important;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25) !important;
    border-radius: 14px !important;
  }

  .card-header {
    background: transparent !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
    padding: 18px 24px !important;
  }

  .icon-big {
    width: 54px;
    height: 54px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
  }

  .icon-primary {
    background: rgba(34, 197, 94, 0.15) !important;
    color: #22c55e !important;
    box-shadow: 0 0 15px rgba(34, 197, 94, 0.2) !important;
  }

  .icon-info {
    background: rgba(56, 189, 248, 0.15) !important;
    color: #38bdf8 !important;
    box-shadow: 0 0 15px rgba(56, 189, 248, 0.2) !important;
  }

  .icon-warning {
    background: rgba(245, 158, 11, 0.15) !important;
    color: #f59e0b !important;
    box-shadow: 0 0 15px rgba(245, 158, 11, 0.2) !important;
  }

  .icon-secondary {
    background: rgba(168, 85, 247, 0.15) !important;
    color: #c084fc !important;
    box-shadow: 0 0 15px rgba(168, 85, 247, 0.2) !important;
  }

  .table {
    color: #cbd5e1 !important;
    border-color: rgba(255, 255, 255, 0.06) !important;
  }

  .table thead th {
    background: rgba(15, 23, 42, 0.6) !important;
    color: #94a3b8 !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
    font-size: 12px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
  }

  .table tbody tr {
    border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
    vertical-align: middle;
  }

  .table tbody tr:hover {
    background: rgba(255, 255, 255, 0.03) !important;
  }

  .badge-unread {
    background: rgba(239, 68, 68, 0.15) !important;
    color: #f87171 !important;
    border: 1px solid rgba(239, 68, 68, 0.3) !important;
    padding: 5px 10px;
    border-radius: 50px;
    font-size: 11px;
    font-weight: 600;
  }

  .badge-read {
    background: rgba(34, 197, 94, 0.15) !important;
    color: #4ade80 !important;
    border: 1px solid rgba(34, 197, 94, 0.3) !important;
    padding: 5px 10px;
    border-radius: 50px;
    font-size: 11px;
    font-weight: 600;
  }

  .btn-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    transition: all 0.2s;
  }

  .btn-view {
    background: rgba(56, 189, 248, 0.15);
    color: #38bdf8;
  }
  .btn-view:hover {
    background: #38bdf8;
    color: #0f172a;
  }

  .btn-check {
    background: rgba(34, 197, 94, 0.15);
    color: #4ade80;
  }
  .btn-check:hover {
    background: #22c55e;
    color: #ffffff;
  }

  .btn-del {
    background: rgba(239, 68, 68, 0.15);
    color: #f87171;
  }
  .btn-del:hover {
    background: #ef4444;
    color: #ffffff;
  }

  /* Modal Styling */
  .modal-content {
    background: #1e293b !important;
    color: #f1f5f9 !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    border-radius: 16px !important;
  }
  .modal-header {
    border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
  }
  .modal-footer {
    border-top: 1px solid rgba(255, 255, 255, 0.08) !important;
  }
</style>

<div class="page-inner">

  <!-- Header -->
  <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
    <div>
      <h3 class="fw-bold mb-1">Reports &amp; Feedback Management</h3>
      <h6 class="op-7 mb-2">View student feedbacks, inquiries, and platform usage reports</h6>
    </div>
    <div class="ms-md-auto py-2 py-md-0">
      <a href="{{ route('adminhome') }}" class="btn btn-label-info btn-round me-2">
        <i class="fas fa-arrow-left me-1"></i> Dashboard
      </a>
      <a href="{{ route('admin.reports') }}" class="btn btn-primary btn-round">
        <i class="fas fa-sync-alt me-1"></i> Refresh
      </a>
    </div>
  </div>

  <!-- Session Alerts -->
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="background: rgba(34,197,94,0.15); border: 1px solid rgba(34,197,94,0.4); color: #4ade80; border-radius: 10px;">
      <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="filter: invert(1);"></button>
    </div>
  @endif

  <!-- SUMMARY STATS -->
  <div class="row">
    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-icon">
              <div class="icon-big text-center icon-warning">
                <i class="fas fa-comments"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">Total Feedbacks</p>
                <h4 class="card-title">{{ number_format($totalFeedbacks) }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-icon">
              <div class="icon-big text-center icon-primary">
                <i class="fas fa-envelope-open-text"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">Unread Inquiries</p>
                <h4 class="card-title">{{ number_format($unreadFeedbacks) }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-icon">
              <div class="icon-big text-center icon-info">
                <i class="fas fa-user-graduate"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">Registered Students</p>
                <h4 class="card-title">{{ number_format($totalStudents) }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-icon">
              <div class="icon-big text-center icon-secondary">
                <i class="fas fa-crown"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">Active Subscriptions</p>
                <h4 class="card-title">{{ number_format($activeMembers) }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- FEEDBACKS LIST TABLE -->
  <div class="row">
    <div class="col-md-12">
      <div class="card card-round">
        <div class="card-header">
          <div class="card-head-row card-tools-still-right">
            <div class="card-title">
              <i class="fas fa-inbox text-success me-2"></i> Received User Feedbacks &amp; Queries
            </div>
            <div class="card-tools">
              <span class="badge badge-success">{{ $feedbacks->total() }} Total</span>
            </div>
          </div>
          <p class="card-category">Feedbacks submitted by students from the homepage feedback portal</p>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th style="width: 50px;">#</th>
                  <th>User / Sender</th>
                  <th>Subject</th>
                  <th>Message Preview</th>
                  <th>Status</th>
                  <th>Submitted At</th>
                  <th class="text-end" style="min-width: 130px;">Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse($feedbacks as $index => $fb)
                  <tr>
                    <td>{{ $feedbacks->firstItem() + $index }}</td>
                    <td>
                      <div class="fw-bold text-white">{{ $fb->name }}</div>
                      <div class="text-muted" style="font-size: 12px;">{{ $fb->email }}</div>
                      @if($fb->user)
                        <span class="badge badge-read" style="font-size: 10px; padding: 2px 6px;">Student Account</span>
                      @else
                        <span class="badge badge-unread" style="font-size: 10px; padding: 2px 6px;">Guest</span>
                      @endif
                    </td>
                    <td>
                      <span class="fw-semibold text-white">{{ $fb->subject }}</span>
                    </td>
                    <td>
                      <span class="text-muted" style="font-size: 13px;" title="{{ $fb->message }}">
                        {{ \Illuminate\Support\Str::limit($fb->message, 60) }}
                      </span>
                    </td>
                    <td>
                      @if($fb->status === 'unread')
                        <span class="badge badge-unread">Unread</span>
                      @else
                        <span class="badge badge-read">Read</span>
                      @endif
                    </td>
                    <td>
                      <span class="text-muted" style="font-size: 12.5px;">
                        {{ $fb->created_at ? $fb->created_at->format('M d, Y h:i A') : 'N/A' }}
                      </span>
                    </td>
                    <td class="text-end">
                      <!-- View Details Modal Trigger -->
                      <button type="button" class="btn-action btn-view me-1" data-bs-toggle="modal" data-bs-target="#viewFeedbackModal{{ $fb->id }}" title="View Full Message">
                        <i class="fas fa-eye"></i>
                      </button>

                      <!-- Mark Read Button -->
                      @if($fb->status === 'unread')
                        <form action="{{ route('admin.feedbacks.markread', $fb->id) }}" method="POST" class="d-inline">
                          @csrf
                          @method('PATCH')
                          <button type="submit" class="btn-action btn-check me-1" title="Mark as Read">
                            <i class="fas fa-check"></i>
                          </button>
                        </form>
                      @endif

                      <!-- Delete Button -->
                      <form action="{{ route('admin.feedbacks.destroy', $fb->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this feedback?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-action btn-del" title="Delete Feedback">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                      </form>
                    </td>
                  </tr>

                  <!-- View Modal for this Feedback -->
                  <div class="modal fade" id="viewFeedbackModal{{ $fb->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $fb->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title fw-bold" id="modalLabel{{ $fb->id }}">
                            <i class="fas fa-comment-dots text-success me-2"></i> Feedback from {{ $fb->name }}
                          </h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1);"></button>
                        </div>
                        <div class="modal-body">
                          <div class="mb-3">
                            <label class="text-muted" style="font-size: 12px; text-transform: uppercase;">Sender Name &amp; Email</label>
                            <div class="fw-bold text-white">{{ $fb->name }} &lt;{{ $fb->email }}&gt;</div>
                          </div>
                          <div class="mb-3">
                            <label class="text-muted" style="font-size: 12px; text-transform: uppercase;">Subject</label>
                            <div class="fw-bold text-success">{{ $fb->subject }}</div>
                          </div>
                          <div class="mb-3">
                            <label class="text-muted" style="font-size: 12px; text-transform: uppercase;">Full Message Content</label>
                            <div style="background: rgba(15, 23, 42, 0.6); padding: 14px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.06); color: #e2e8f0; font-size: 14px; line-height: 1.6; white-space: pre-wrap;">{{ $fb->message }}</div>
                          </div>
                          <div class="text-muted" style="font-size: 12px;">
                            <i class="far fa-clock me-1"></i> Submitted on: {{ $fb->created_at ? $fb->created_at->format('F d, Y \a\t h:i A') : 'N/A' }}
                          </div>
                        </div>
                        <div class="modal-footer">
                          @if($fb->status === 'unread')
                            <form action="{{ route('admin.feedbacks.markread', $fb->id) }}" method="POST" class="d-inline">
                              @csrf
                              @method('PATCH')
                              <button type="submit" class="btn btn-success btn-sm btn-round">
                                <i class="fas fa-check me-1"></i> Mark as Read
                              </button>
                            </form>
                          @endif
                          <button type="button" class="btn btn-secondary btn-sm btn-round" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>

                @empty
                  <tr>
                    <td colspan="7" class="text-center py-5 text-muted">
                      <i class="fas fa-inbox fa-3x mb-3 text-secondary"></i>
                      <p class="mb-0">No feedbacks or queries submitted yet.</p>
                      <small class="text-muted">User submissions from the homepage feedback form will appear here in real-time.</small>
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          @if($feedbacks->hasPages())
            <div class="p-3 d-flex justify-content-center">
              {{ $feedbacks->links() }}
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>

</div>

@endsection
