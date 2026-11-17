@extends('Layouts.adminmaster')

@section('content')

<style>
  /* =========================================================
     CAREER MENTOR DARK & EMERALD PAYMENTS THEME
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

  .badge-status-completed {
    background: rgba(34, 197, 94, 0.15) !important;
    color: #4ade80 !important;
    border: 1px solid rgba(34, 197, 94, 0.35) !important;
    padding: 5px 12px;
    border-radius: 50px;
    font-size: 11px;
    font-weight: 600;
  }

  .badge-status-pending {
    background: rgba(245, 158, 11, 0.15) !important;
    color: #fbbf24 !important;
    border: 1px solid rgba(245, 158, 11, 0.35) !important;
    padding: 5px 12px;
    border-radius: 50px;
    font-size: 11px;
    font-weight: 600;
  }

  .badge-status-failed {
    background: rgba(239, 68, 68, 0.15) !important;
    color: #f87171 !important;
    border: 1px solid rgba(239, 68, 68, 0.35) !important;
    padding: 5px 12px;
    border-radius: 50px;
    font-size: 11px;
    font-weight: 600;
  }

  .badge-method {
    background: rgba(255, 255, 255, 0.07);
    color: #e2e8f0;
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 6px;
    padding: 3px 8px;
    font-size: 11px;
    font-weight: 500;
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

  .search-input {
    background: rgba(15, 23, 42, 0.6) !important;
    border: 1px solid rgba(255, 255, 255, 0.12) !important;
    color: #ffffff !important;
    border-radius: 8px;
    font-size: 13.5px;
  }
  .search-input:focus {
    border-color: #22c55e !important;
    box-shadow: 0 0 0 2px rgba(34, 197, 94, 0.2) !important;
  }
</style>

<div class="page-inner">

  <!-- Header -->
  <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
    <div>
      <h3 class="fw-bold mb-1">Manage User Payments</h3>
      <h6 class="op-7 mb-2">Monitor all student subscription payments, transaction logs &amp; revenue details</h6>
    </div>
    <div class="ms-md-auto py-2 py-md-0">
      <a href="{{ route('admin.addplan') }}" class="btn btn-label-info btn-round me-2">
        <i class="fas fa-tags me-1"></i> Manage Plans
      </a>
      <a href="{{ route('admin.payments.index') }}" class="btn btn-primary btn-round">
        <i class="fas fa-sync-alt me-1"></i> Refresh Logs
      </a>
    </div>
  </div>

  <!-- SUMMARY METRICS ROW -->
  <div class="row">
    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-icon">
              <div class="icon-big text-center icon-primary">
                <i class="fas fa-hand-holding-usd"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">Total Revenue</p>
                <h4 class="card-title">₹{{ number_format($totalRevenue, 2) }}</h4>
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
                <i class="fas fa-check-double"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">Completed Transactions</p>
                <h4 class="card-title">{{ number_format($completedCount) }}</h4>
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
              <div class="icon-big text-center icon-warning">
                <i class="fas fa-hourglass-half"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">Pending Payments</p>
                <h4 class="card-title">{{ number_format($pendingCount) }}</h4>
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
                <p class="card-category">Active Subscribers</p>
                <h4 class="card-title">{{ number_format($activeSubscribers) }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- PAYMENTS DATA TABLE CARD -->
  <div class="row">
    <div class="col-md-12">
      <div class="card card-round">
        <div class="card-header">
          <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
              <div class="card-title">
                <i class="fas fa-receipt text-success me-2"></i> All User Payment Transactions
              </div>
              <p class="card-category mb-0">Showing comprehensive history of student subscription transactions</p>
            </div>

            <!-- Search & Filter Form -->
            <form action="{{ route('admin.payments.index') }}" method="GET" class="d-flex flex-wrap gap-2">
              <div class="input-group input-group-sm" style="width: 240px;">
                <input type="text" name="search" class="form-control search-input" placeholder="Search user or plan..." value="{{ request('search') }}">
                <button class="btn btn-primary btn-sm" type="submit">
                  <i class="fas fa-search"></i>
                </button>
              </div>

              <select name="status" class="form-select form-select-sm search-input" style="width: 140px;" onchange="this.form.submit()">
                <option value="all" {{ request('status') == 'all' || !request('status') ? 'selected' : '' }}>All Status</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
              </select>

              @if(request('search') || request('status'))
                <a href="{{ route('admin.payments.index') }}" class="btn btn-label-light btn-sm" title="Clear Filters">
                  <i class="fas fa-times"></i>
                </a>
              @endif
            </form>
          </div>
        </div>

        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th style="width: 70px;">Txn ID</th>
                  <th>Student / User</th>
                  <th>Plan Details</th>
                  <th>Amount</th>
                  <th>Payment Method</th>
                  <th>Status</th>
                  <th>Date &amp; Time</th>
                  <th class="text-end" style="min-width: 90px;">Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse($payments as $payment)
                  <tr>
                    <td>
                      <span class="fw-bold text-success font-monospace">#PAY-{{ str_pad($payment->id, 4, '0', STR_PAD_LEFT) }}</span>
                    </td>
                    <td>
                      @if($payment->user)
                        <div class="fw-bold text-white">{{ $payment->user->name }}</div>
                        <div class="text-muted" style="font-size: 12px;">{{ $payment->user->email }}</div>
                        @if($payment->user->student)
                          <div class="text-muted" style="font-size: 11px;">
                            <i class="fas fa-graduation-cap me-1"></i> {{ $payment->user->student->qualification->qualification_name ?? 'Student' }}
                            @if($payment->user->student->branch)
                              - {{ $payment->user->student->branch->branch_name }}
                            @endif
                          </div>
                        @endif
                      @else
                        <span class="text-muted">User Account Removed</span>
                      @endif
                    </td>
                    <td>
                      @if($payment->plan)
                        <div class="fw-semibold text-white">{{ $payment->plan->plan_name }}</div>
                        <small class="text-muted">{{ $payment->plan->duration_days }} Days Plan</small>
                      @else
                        <span class="text-muted">Custom / Archived Plan</span>
                      @endif
                    </td>
                    <td>
                      <span class="fw-bold text-success" style="font-size: 15px;">₹{{ number_format($payment->amount, 2) }}</span>
                    </td>
                    <td>
                      <span class="badge-method">
                        <i class="far fa-credit-card me-1"></i> {{ ucfirst(str_replace('_', ' ', $payment->payment_method ?? 'Online')) }}
                      </span>
                    </td>
                    <td>
                      @if($payment->payment_status === 'completed')
                        <span class="badge-status-completed">✓ Completed</span>
                      @elseif($payment->payment_status === 'pending')
                        <span class="badge-status-pending">⏳ Pending</span>
                      @else
                        <span class="badge-status-failed">✕ {{ ucfirst($payment->payment_status) }}</span>
                      @endif
                    </td>
                    <td>
                      <div class="text-white" style="font-size: 12.5px;">
                        {{ $payment->paid_at ? $payment->paid_at->format('M d, Y') : ($payment->created_at ? $payment->created_at->format('M d, Y') : 'N/A') }}
                      </div>
                      <small class="text-muted" style="font-size: 11px;">
                        {{ $payment->paid_at ? $payment->paid_at->format('h:i A') : ($payment->created_at ? $payment->created_at->format('h:i A') : '') }}
                      </small>
                    </td>
                    <td class="text-end">
                      <!-- View Receipt Modal Trigger -->
                      <button type="button" class="btn-action btn-view" data-bs-toggle="modal" data-bs-target="#paymentModal{{ $payment->id }}" title="View Payment Details">
                        <i class="fas fa-eye"></i>
                      </button>
                    </td>
                  </tr>

                  <!-- Modal for Payment Details -->
                  <div class="modal fade" id="paymentModal{{ $payment->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $payment->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title fw-bold" id="modalLabel{{ $payment->id }}">
                            <i class="fas fa-file-invoice-dollar text-success me-2"></i> Payment Receipt #PAY-{{ str_pad($payment->id, 4, '0', STR_PAD_LEFT) }}
                          </h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1);"></button>
                        </div>
                        <div class="modal-body">
                          <div style="background: rgba(15, 23, 42, 0.7); border: 1px solid rgba(255,255,255,0.06); border-radius: 12px; padding: 20px; margin-bottom: 20px; text-align: center;">
                            <span class="text-muted" style="font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">Amount Paid</span>
                            <h2 class="fw-bold text-success mb-2" style="font-size: 32px;">₹{{ number_format($payment->amount, 2) }}</h2>
                            @if($payment->payment_status === 'completed')
                              <span class="badge-status-completed">✓ Transaction Completed</span>
                            @elseif($payment->payment_status === 'pending')
                              <span class="badge-status-pending">⏳ Payment Pending</span>
                            @else
                              <span class="badge-status-failed">✕ {{ ucfirst($payment->payment_status) }}</span>
                            @endif
                          </div>

                          <div class="row g-3">
                            <div class="col-6">
                              <label class="text-muted" style="font-size: 11px; text-transform: uppercase;">Student / User</label>
                              <div class="fw-bold text-white">{{ $payment->user->name ?? 'N/A' }}</div>
                              <small class="text-muted">{{ $payment->user->email ?? '' }}</small>
                            </div>

                            <div class="col-6">
                              <label class="text-muted" style="font-size: 11px; text-transform: uppercase;">Subscription Plan</label>
                              <div class="fw-bold text-white">{{ $payment->plan->plan_name ?? 'Plan #' . $payment->plan_id }}</div>
                              <small class="text-muted">{{ $payment->plan->duration_days ?? 'N/A' }} Days Validity</small>
                            </div>

                            <div class="col-6">
                              <label class="text-muted" style="font-size: 11px; text-transform: uppercase;">Payment Gateway / Method</label>
                              <div class="fw-semibold text-white">{{ ucfirst(str_replace('_', ' ', $payment->payment_method ?? 'Online')) }}</div>
                            </div>

                            <div class="col-6">
                              <label class="text-muted" style="font-size: 11px; text-transform: uppercase;">Paid On</label>
                              <div class="fw-semibold text-white">
                                {{ $payment->paid_at ? $payment->paid_at->format('F d, Y \a\t h:i A') : ($payment->created_at ? $payment->created_at->format('F d, Y \a\t h:i A') : 'N/A') }}
                              </div>
                            </div>

                            @if($payment->user && $payment->user->student)
                              <div class="col-12 mt-3 pt-3 border-top border-secondary border-opacity-25">
                                <label class="text-muted" style="font-size: 11px; text-transform: uppercase;">Academic Profile</label>
                                <div class="text-white" style="font-size: 13.5px;">
                                  {{ $payment->user->student->qualification->qualification_name ?? '' }}
                                  @if($payment->user->student->branch)
                                    ({{ $payment->user->student->branch->branch_name }})
                                  @endif
                                  @if($payment->user->student->collegename)
                                    - {{ $payment->user->student->collegename }}
                                  @endif
                                </div>
                                @if($payment->user->student->phone)
                                  <small class="text-muted"><i class="fas fa-phone me-1"></i> {{ $payment->user->student->phone }}</small>
                                @endif
                              </div>
                            @endif
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary btn-sm btn-round" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>

                @empty
                  <tr>
                    <td colspan="8" class="text-center py-5 text-muted">
                      <i class="fas fa-credit-card fa-3x mb-3 text-secondary"></i>
                      <p class="mb-0">No payment records found matching criteria.</p>
                      <small class="text-muted">Student subscription payments will appear here as soon as orders are processed.</small>
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          @if($payments->hasPages())
            <div class="p-3 d-flex justify-content-center">
              {{ $payments->links() }}
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>

</div>

@endsection
