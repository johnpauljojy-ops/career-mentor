@extends('Layouts.adminmaster')

@section('content')

<style>
  /* =========================================================
     CAREER MENTOR DARK & EMERALD ADMIN THEME
  ========================================================= */

  /* Page Wrapper */
  .page-inner {
    background: #0b132b !important;
    min-height: 100vh;
    color: #f1f5f9;
  }

  /* Headings & Text */
  .page-inner h1, .page-inner h2, .page-inner h3, .page-inner h4, .page-inner h5, .page-inner h6,
  .page-inner .card-title, .page-inner .numbers .card-title {
    color: #ffffff !important;
    font-weight: 700;
  }

  .page-inner p, .page-inner .text-muted, .page-inner .card-category, .page-inner .op-7 {
    color: #94a3b8 !important;
  }

  /* Cards Styling */
  .card-round, .card-stats {
    background: #1e293b !important;
    border: 1px solid rgba(255, 255, 255, 0.08) !important;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25) !important;
    border-radius: 14px !important;
    transition: transform 0.2s ease, border-color 0.2s ease;
  }

  .card-round:hover, .card-stats:hover {
    border-color: rgba(34, 197, 94, 0.3) !important;
    transform: translateY(-2px);
  }

  .card-header {
    background: transparent !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
    padding: 18px 24px !important;
  }

  /* Primary Buttons & Accents */
  .btn-primary, .btn-label-success {
    background: #22c55e !important;
    border-color: #22c55e !important;
    color: #ffffff !important;
    font-weight: 600;
  }

  .btn-primary:hover, .btn-label-success:hover {
    background: #16a34a !important;
    border-color: #16a34a !important;
  }

  .btn-label-info {
    background: rgba(37, 99, 235, 0.15) !important;
    border: 1px solid rgba(37, 99, 235, 0.3) !important;
    color: #60a5fa !important;
  }

  .btn-label-info:hover {
    background: #2563eb !important;
    color: #ffffff !important;
  }

  /* Stat Card Icons */
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

  .icon-success {
    background: rgba(168, 85, 247, 0.15) !important;
    color: #c084fc !important;
    box-shadow: 0 0 15px rgba(168, 85, 247, 0.2) !important;
  }

  .icon-secondary {
    background: rgba(251, 146, 60, 0.15) !important;
    color: #fb923c !important;
    box-shadow: 0 0 15px rgba(251, 146, 60, 0.2) !important;
  }

  /* Special Dark Gradient Card for Daily Sales */
  .card-primary.card-round {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%) !important;
    border: 1px solid rgba(34, 197, 94, 0.35) !important;
  }

  .card-primary h1 {
    color: #22c55e !important;
  }

  /* Tables */
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
  }

  .table tbody tr:hover {
    background: rgba(255, 255, 255, 0.03) !important;
  }

  .table tbody tr th {
    color: #f8fafc !important;
  }

  .badge-success {
    background: rgba(34, 197, 94, 0.15) !important;
    color: #4ade80 !important;
    border: 1px solid rgba(34, 197, 94, 0.3) !important;
    padding: 6px 12px;
    border-radius: 50px;
  }

  /* List Items & User List */
  .item-list {
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    padding: 10px 0;
  }

  .item-list .username {
    color: #ffffff;
    font-weight: 600;
  }

  .item-list .status {
    color: #94a3b8;
    font-size: 12.5px;
  }

  .btn-clean {
    color: #94a3b8 !important;
  }

  .dropdown-menu {
    background: #1e293b !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    box-shadow: 0 10px 30px rgba(0,0,0,0.5) !important;
  }

  .dropdown-item {
    color: #cbd5e1 !important;
  }

  .dropdown-item:hover {
    background: rgba(34, 197, 94, 0.15) !important;
    color: #4ade80 !important;
  }
</style>

<div class="page-inner">
  <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
    <div>
      <h3 class="fw-bold mb-1">Admin Dashboard</h3>
      <h6 class="op-7 mb-2">Career Mentor System Overview &amp; Performance</h6>
    </div>
    
  </div>

  <!-- STATS CARDS ROW -->
  <div class="row">
    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-icon">
              <div class="icon-big text-center icon-primary">
                <i class="fas fa-users"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">Total Students</p>
                <h4 class="card-title">{{ number_format($totalStudents ?? 0) }}</h4>
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
                <i class="fas fa-crown"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">Active Members</p>
                <h4 class="card-title">{{ number_format($activeMembers ?? 0) }}</h4>
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
              <div class="icon-big text-center icon-success">
                <i class="fas fa-graduation-cap"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">Recommendations</p>
                <h4 class="card-title">{{ number_format($totalRecommendations ?? 0) }}</h4>
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
                <i class="far fa-file-alt"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">Resumes Built</p>
                <h4 class="card-title">{{ number_format($resumesBuilt ?? 0) }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- CHARTS ROW -->
  <div class="row">
    <div class="col-md-8">
      <div class="card card-round">
        <div class="card-header">
          <div class="card-head-row">
            <div class="card-title">User Registration & Activity</div>
            <div class="card-tools">
              <a href="#" class="btn btn-label-success btn-round btn-sm me-2">
                <span class="btn-label">
                  <i class="fa fa-pencil"></i>
                </span>
                Export Report
              </a>
              <a href="#" class="btn btn-label-info btn-round btn-sm">
                <span class="btn-label">
                  <i class="fa fa-print"></i>
                </span>
                Print
              </a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="chart-container" style="min-height: 375px">
            <canvas id="statisticsChart"></canvas>
          </div>
          <div id="myChartLegend"></div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-primary card-round">
        <div class="card-header">
          <div class="card-head-row">
            <div class="card-title">Career Placements</div>
            <div class="card-tools">
              <div class="dropdown">
                <button class="btn btn-sm btn-label-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Filter
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">This Week</a>
                  <a class="dropdown-item" href="#">This Month</a>
                  <a class="dropdown-item" href="#">This Year</a>
                </div>
              </div>
            </div>
          </div>
          <div class="card-category">Active Period</div>
        </div>
        <div class="card-body pb-0">
          <div class="mb-4 mt-2">
            <h1>458 Students</h1>
          </div>
          <div class="pull-in">
            <canvas id="dailySalesChart"></canvas>
          </div>
        </div>
      </div>
      <div class="card card-round">
        <div class="card-body pb-0">
          <div class="h1 fw-bold float-end" style="color: #22c55e;">+12%</div>
          <h2 class="mb-2">17</h2>
          <p class="text-muted">Students online now</p>
          <div class="pull-in sparkline-fix">
            <div id="lineChart"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- GEOLOCATION ROW -->
  <div class="row">
    <div class="col-md-12">
      <div class="card card-round">
        <div class="card-header">
          <div class="card-head-row card-tools-still-right">
            <h4 class="card-title">Student Distribution by Region</h4>
            <div class="card-tools">
              <button class="btn btn-icon btn-link btn-primary btn-xs">
                <span class="fa fa-sync-alt"></span>
              </button>
            </div>
          </div>
          <p class="card-category">Overview of active students enrolled from different states & campuses</p>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="table-responsive table-hover table-sales">
                <table class="table">
                  <tbody>
                    <tr>
                      <td><div class="flag"><img src="{{asset('admin/assets/img/flags/id.png')}}" alt="indonesia"/></div></td>
                      <td>Kerala</td>
                      <td class="text-end">2,320</td>
                      <td class="text-end" style="color: #22c55e;">42.18%</td>
                    </tr>
                    <tr>
                      <td><div class="flag"><img src="{{asset('admin/assets/img/flags/us.png')}}" alt="united states"/></div></td>
                      <td>Karnataka</td>
                      <td class="text-end">240</td>
                      <td class="text-end" style="color: #22c55e;">4.36%</td>
                    </tr>
                    <tr>
                      <td><div class="flag"><img src="{{asset('admin/assets/img/flags/au.png')}}" alt="australia"/></div></td>
                      <td>Tamil Nadu</td>
                      <td class="text-end">119</td>
                      <td class="text-end" style="color: #22c55e;">2.16%</td>
                    </tr>
                    <tr>
                      <td><div class="flag"><img src="{{asset('admin/assets/img/flags/ru.png')}}" alt="russia"/></div></td>
                      <td>Maharashtra</td>
                      <td class="text-end">1,081</td>
                      <td class="text-end" style="color: #22c55e;">19.65%</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mapcontainer">
                <div id="world-map" class="w-100" style="height: 300px"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- RECENT USERS & LOGS ROW -->
  <div class="row">
    <div class="col-md-4">
      <div class="card card-round">
        <div class="card-body">
          <div class="card-head-row card-tools-still-right">
            <div class="card-title">Newly Registered Students</div>
          </div>
          <div class="card-list py-3">
            @forelse($recentStudents as $student)
              <div class="item-list">
                <div class="avatar">
                  @if($student->photo)
                    <img src="{{ asset($student->photo) }}" alt="..." class="avatar-img rounded-circle"/>
                  @else
                    <span class="avatar-title rounded-circle border border-white bg-primary">
                      {{ strtoupper(substr($student->user->name ?? 'Student', 0, 2)) }}
                    </span>
                  @endif
                </div>
                <div class="info-user ms-3">
                  <div class="username">{{ $student->user->name ?? ('Student #' . $student->studentid) }}</div>
                  <div class="status">{{ $student->qualification->qualification_name ?? 'Student' }} {{ $student->branch ? '- ' . $student->branch->branch_name : '' }}</div>
                </div>
                <span class="badge badge-success text-end ms-auto" style="font-size: 10px;">Enrolled</span>
              </div>
            @empty
              <div class="text-center py-3 text-muted">
                <i class="fas fa-users-slash fa-2x mb-2"></i>
                <p class="mb-0" style="font-size: 13px;">No student records found</p>
              </div>
            @endforelse
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-8">
      <div class="card card-round">
        <div class="card-header">
          <div class="card-head-row card-tools-still-right">
            <div class="card-title">Recent Feedbacks &amp; Student Inquiries</div>
            <div class="card-tools">
              <a href="{{ route('admin.reports') }}" class="btn btn-label-success btn-round btn-sm">
                View All Feedbacks
              </a>
            </div>
          </div>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table align-items-center mb-0">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Student / Subject</th>
                  <th scope="col" class="text-end">Date &amp; Time</th>
                  <th scope="col" class="text-end">Status</th>
                  <th scope="col" class="text-end">Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse($recentFeedbacks as $rf)
                  <tr>
                    <th scope="row">
                      <button class="btn btn-icon btn-round btn-success btn-sm me-2" style="background: rgba(34, 197, 94, 0.2) !important; border: 1px solid rgba(34, 197, 94, 0.4); color: #4ade80;">
                        <i class="fas fa-envelope"></i>
                      </button>
                      <span class="text-white">{{ $rf->name }}</span>
                      <small class="text-muted d-block ms-5" style="margin-top: -8px;">{{ \Illuminate\Support\Str::limit($rf->subject, 40) }}</small>
                    </th>
                    <td class="text-end text-muted" style="font-size: 12px;">
                      {{ $rf->created_at ? $rf->created_at->diffForHumans() : 'Recently' }}
                    </td>
                    <td class="text-end">
                      @if($rf->status === 'unread')
                        <span class="badge" style="background: rgba(239, 68, 68, 0.2); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.3);">Unread</span>
                      @else
                        <span class="badge badge-success">Read</span>
                      @endif
                    </td>
                    <td class="text-end">
                      <a href="{{ route('admin.reports') }}" class="btn btn-icon btn-link btn-xs text-info" title="View In Reports">
                        <i class="fas fa-external-link-alt"></i>
                      </a>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4" class="text-center py-4 text-muted">
                      <p class="mb-0">No feedbacks submitted yet. User messages from the homepage form will appear here.</p>
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

@endsection