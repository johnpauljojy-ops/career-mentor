@extends('layouts.templatemaster')

@section('content')
<style>
  /* SUBSCRIPTION PLANS - matches CareerMentor home page tones */
  .sp-page { font-family: 'Poppins', sans-serif; background: #f8fafc; color: #0f172a; }

  /* HERO */
  .sp-hero {
    position: relative; overflow: hidden;
    padding: 150px 0 10px;
    background: linear-gradient(135deg, #070f19 0%, #0f172a 60%, #1e293b 100%);
  }
  .sp-hero::before, .sp-hero::after { content: ""; position: absolute; border-radius: 50%; pointer-events: none; }
  .sp-hero::before { width: 420px; height: 420px; left: -160px; bottom: -180px; background: radial-gradient(circle, rgba(34,197,94,.14) 0%, transparent 70%); }
  .sp-hero::after { width: 320px; height: 320px; right: -100px; top: -100px; background: radial-gradient(circle, rgba(37,99,235,.14) 0%, transparent 70%); }
  .sp-hero .container { position: relative; z-index: 1; }
  .sp-tag {
    display: inline-block; margin-bottom: 20px; padding: 8px 16px;
    border: 1px solid rgba(34,197,94,.5); border-radius: 50px;
    background: rgba(34,197,94,.12); color: #4ade80;
    font-size: 12px; font-weight: 700; letter-spacing: 1px;
  }
  .sp-hero h1 { margin: 0 0 18px; color: #fff; font-size: 48px; line-height: 1.15; font-weight: 700; }
  .sp-hero h1 span { color: #22c55e; }
  .sp-hero p { max-width: 640px; margin: 0 auto; color: #dbe4ee; font-size: 16px; line-height: 1.8; }

  /* ALERTS */
  .sp-alert { display: flex; align-items: center; gap: 10px; margin-bottom: 18px; padding: 14px 18px; border-radius: 12px; font-size: 14px; text-align: left; }

  /* SECTIONS */
  .sp-section { padding: 70px 0; }
  .sp-section-white { background: #fff; }
  .sp-heading { max-width: 700px; margin: 0 auto 42px; text-align: center; }
  .sp-label { display: inline-block; margin-bottom: 8px; color: #16a34a; font-size: 11px; font-weight: 700; letter-spacing: 1px; }
  .sp-heading h2 { margin: 0 0 12px; color: #0f172a; font-size: 32px; line-height: 1.2; font-weight: 700; }
  .sp-heading p { margin: 0; color: #64748b; font-size: 14px; line-height: 1.8; }

  /* ACTIVE SUBSCRIPTION */
  .sp-active {
    position: relative; overflow: hidden; margin-bottom: 45px; padding: 32px 36px;
    border-radius: 17px; color: #fff;
    background: linear-gradient(135deg, #0f172a, #1e293b);
  }
  .sp-active::after { content: ""; position: absolute; width: 230px; height: 230px; right: -80px; top: -80px; border-radius: 50%; background: rgba(34,197,94,.1); }
  .sp-active > .row { position: relative; z-index: 1; }
  .sp-active-badge { padding: 5px 13px; border-radius: 20px; background: #22c55e; color: #fff; font-size: 11px; font-weight: 700; letter-spacing: .5px; text-transform: uppercase; }
  .sp-active-name { margin: 10px 0 4px; font-size: 26px; font-weight: 700; }
  .sp-btn-light { display: inline-flex; padding: 11px 22px; border-radius: 7px; background: #22c55e; color: #fff !important; text-decoration: none !important; font-size: 13px; font-weight: 600; transition: .2s ease; }
  .sp-btn-light:hover { background: #16a34a; }
  .sp-btn-ghost { padding: 10px 20px; border: 1px solid rgba(255,255,255,.45); border-radius: 7px; background: rgba(255,255,255,.06); color: #fff; font-size: 13px; font-weight: 600; transition: .2s ease; }
  .sp-btn-ghost:hover { background: rgba(255,255,255,.14); }

  /* PLAN CARDS */
  .sp-card {
    position: relative; display: flex; flex-direction: column; height: 100%;
    padding: 34px 28px; border: 1px solid #e2e8f0; border-radius: 15px; background: #fff;
    transition: .2s ease;
  }
  .sp-card:hover { transform: translateY(-5px); border-color: #bbf7d0; box-shadow: 0 12px 30px rgba(15,23,42,.08); }
  .sp-card.is-featured { border: 2px solid #22c55e; box-shadow: 0 12px 32px rgba(34,197,94,.14); }
  .sp-ribbon {
    position: absolute; top: -14px; left: 50%; transform: translateX(-50%);
    padding: 5px 16px; border-radius: 30px; white-space: nowrap;
    background: linear-gradient(135deg, #22c55e, #16a34a); color: #fff;
    font-size: 11px; font-weight: 700; letter-spacing: .8px; text-transform: uppercase;
  }
  .sp-plan-name { margin: 0; color: #0f172a; font-size: 20px; font-weight: 700; }
  .sp-plan-desc { min-height: 44px; margin: 8px 0 20px; color: #64748b; font-size: 13px; line-height: 1.7; }
  .sp-price { display: flex; align-items: baseline; gap: 6px; margin-bottom: 22px; padding-bottom: 20px; border-bottom: 1px solid #e2e8f0; }
  .sp-price-cur { color: #0f172a; font-size: 22px; font-weight: 700; }
  .sp-price-amt { color: #0f172a; font-size: 44px; font-weight: 700; line-height: 1; }
  .sp-price-dur { color: #94a3b8; font-size: 14px; font-weight: 500; }
  .sp-features { flex-grow: 1; margin: 0 0 28px; padding: 0; list-style: none; }
  .sp-features li { display: flex; align-items: flex-start; gap: 10px; margin-bottom: 12px; color: #334155; font-size: 13px; line-height: 1.6; }
  .sp-features i { margin-top: 3px; color: #22c55e; flex-shrink: 0; }
  .sp-btn { display: block; width: 100%; padding: 13px 20px; border: 0; border-radius: 7px; text-align: center; text-decoration: none !important; font-size: 14px; font-weight: 600; cursor: pointer; transition: .2s ease; }
  .sp-btn-red { background: #ef4444; color: #fff !important; }
  .sp-btn-red:hover { background: #dc2626; transform: translateY(-2px); }
  .sp-btn-dark { background: #0f172a; color: #fff !important; }
  .sp-btn-dark:hover { background: #1e293b; transform: translateY(-2px); }
  .sp-btn-active { background: #e2e8f0; color: #64748b !important; cursor: default; pointer-events: none; }

  /* BENEFITS */
  .sp-benefit { height: 100%; padding: 28px 25px; border: 1px solid #e2e8f0; border-radius: 13px; background: #fff; transition: .2s ease; }
  .sp-benefit:hover { transform: translateY(-5px); border-color: #bbf7d0; box-shadow: 0 12px 30px rgba(15,23,42,.08); }
  .sp-benefit-icon { display: flex; align-items: center; justify-content: center; width: 51px; height: 51px; margin-bottom: 19px; border-radius: 11px; font-size: 21px; }
  .sp-benefit h3 { margin: 0 0 9px; color: #0f172a; font-size: 18px; font-weight: 700; }
  .sp-benefit p { margin: 0; color: #64748b; font-size: 13px; line-height: 1.75; }

  /* HISTORY */
  .sp-history { padding: 28px; border: 1px solid #e2e8f0; border-radius: 16px; background: #fff; box-shadow: 0 8px 30px rgba(15,23,42,.06); }
  .sp-table thead th { padding: 12px 16px; border: 0; background: #f8fafc; color: #64748b; font-size: 11px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; }
  .sp-table tbody td { padding: 14px 16px; border-top: 1px solid #e2e8f0; vertical-align: middle; color: #334155; font-size: 13px; }

  /* MODAL */
  .sp-modal { overflow: hidden; border: 0; border-radius: 16px; box-shadow: 0 20px 45px rgba(15,23,42,.2); }
  .sp-modal-head { padding: 22px 28px; background: linear-gradient(135deg, #0f172a, #1e293b); }
  .payment-method-box { display: flex; align-items: center; gap: 14px; margin-bottom: 12px; padding: 14px 18px; border: 1.5px solid #e2e8f0; border-radius: 12px; cursor: pointer; transition: .2s ease; }
  .payment-method-box:hover, .payment-method-box.selected { border-color: #22c55e; background: #f0fdf4; }
  .payment-method-box input[type="radio"] { width: 18px; height: 18px; accent-color: #22c55e; }

  @media (max-width: 991px) { .sp-hero h1 { font-size: 38px; } }
  @media (max-width: 576px) {
    .sp-hero { padding: 130px 0 60px; }
    .sp-hero h1 { font-size: 31px; }
    .sp-section { padding: 55px 0; }
    .sp-heading h2 { font-size: 26px; }
    .sp-active { padding: 26px 22px; }
  }
</style>

<div class="sp-page">

  {{-- HERO + FLASH MESSAGES --}}
  <section class="sp-hero">
    <div class="container">

      @php
        $flash = [
          'success' => ['#dcfce7', '#15803d', 'fa-check-circle', 'Success!'],
          'warning' => ['#fef3c7', '#92400e', 'fa-lock', 'Subscription Required:'],
          'info'    => ['#e0f2fe', '#0369a1', 'fa-info-circle', ''],
          'error'   => ['#fee2e2', '#b91c1c', 'fa-exclamation-triangle', ''],
        ];
      @endphp
      @foreach($flash as $key => [$bg, $color, $icon, $title])
        @if(session($key))
          <div class="sp-alert" style="background: {{ $bg }}; color: {{ $color }};" role="alert">
            <i class="fa {{ $icon }}" style="font-size: 1.2rem;"></i>
            <span>@if($title)<strong>{{ $title }}</strong> @endif{{ session($key) }}</span>
          </div>
        @endif
      @endforeach

      <div class="text-center">
        <span class="sp-tag">PREMIUM CAREER MENTORING</span>
        <h1><span>Simple, Transparent </span>Plans<br>for Your Career</h1>
        <p>
          Unlock premium ATS-friendly resume templates, AI recommendations,
          skill guidance and priority assistance.
        </p>
      </div>
    </div>
  </section>

  {{-- PLANS --}}
  <section class="sp-section">
    <div class="container">

      {{-- CURRENT ACTIVE SUBSCRIPTION --}}
      @if(isset($activeSubscription) && $activeSubscription)
        <div class="sp-active">
          <div class="row align-items-center gy-3">
            <div class="col-lg-7">
              <div class="d-flex flex-wrap align-items-center gap-2">
                <span class="sp-active-badge"><i class="fa fa-check me-1"></i> Active Subscription</span>
                <span style="color: #94a3b8; font-size: 13px;">Subscription ID: #{{ $activeSubscription->id }}</span>
              </div>
              <div class="sp-active-name">{{ $activeSubscription->plan->plan_name ?? 'Premium Plan' }}</div>
              <p class="mb-0" style="color: #cbd5e1; font-size: 14px; line-height: 1.8;">
                Started on <strong>{{ $activeSubscription->start_date ? $activeSubscription->start_date->format('d M, Y') : '-' }}</strong> &bull;
                Valid until <strong>{{ $activeSubscription->end_date ? $activeSubscription->end_date->format('d M, Y') : '-' }}</strong>
                <span class="badge bg-success ms-2">{{ $activeSubscription->days_remaining }} days remaining</span>
              </p>
            </div>
            <div class="col-lg-5 text-lg-end">
              <div class="d-inline-flex flex-wrap gap-2">
                <a href="{{ route('student.resume.premium') }}" class="sp-btn-light">⭐ Open Premium Resume</a>
                <form action="{{ route('student.subscription.cancel', $activeSubscription->id) }}" method="POST"
                      onsubmit="return confirm('Are you sure you want to cancel your active subscription?');" style="display: inline;">
                  @csrf
                  <button type="submit" class="sp-btn-ghost">Cancel Plan</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      @endif

      <div class="sp-heading">
        <span class="sp-label">CHOOSE YOUR PLAN</span>
        <h2>Pick the Plan That Fits Your Journey</h2>
        <p>Every plan includes full access to premium career tools. Choose the duration that works for you.</p>
      </div>

      <div class="row g-4 justify-content-center">
        @forelse($plans as $index => $plan)
          @php
            $isCurrent = isset($activeSubscription) && $activeSubscription && $activeSubscription->plan_id == $plan->id;
            $isFeatured = ($index === 1 || count($plans) === 1);
          @endphp
          <div class="col-lg-4 col-md-6">
            <div class="sp-card {{ $isFeatured ? 'is-featured' : '' }}">

              @if($isFeatured)
                <div class="sp-ribbon">⭐ Most Popular</div>
              @endif

              <div class="d-flex justify-content-between align-items-center">
                <h3 class="sp-plan-name">{{ $plan->plan_name }}</h3>
                @if($isCurrent)
                  <span class="badge bg-success" style="border-radius: 20px; font-size: 11px; padding: 5px 10px;">CURRENT</span>
                @endif
              </div>

              <p class="sp-plan-desc">
                {{ $plan->description ?? 'Full access to premium career guidance and advanced resume templates.' }}
              </p>

              <div class="sp-price">
                <span class="sp-price-cur">₹</span>
                <span class="sp-price-amt">{{ number_format($plan->price, 0) }}</span>
                <span class="sp-price-dur">/ {{ $plan->duration_days }} days</span>
              </div>

              <ul class="sp-features">
                <li><i class="fa fa-check-circle"></i><span><strong>Premium Resume Templates</strong> (full access)</span></li>
                <li><i class="fa fa-check-circle"></i><span>AI-driven career recommendations</span></li>
                <li><i class="fa fa-check-circle"></i><span>ATS resume optimization &amp; export</span></li>
                <li><i class="fa fa-check-circle"></i><span>Skill gap analysis &amp; course suggestions</span></li>
                <li><i class="fa fa-check-circle"></i><span>Priority student support (24/7)</span></li>
              </ul>

              <div class="mt-auto">
                @if($isCurrent)
                  <button class="sp-btn sp-btn-active"><i class="fa fa-check-circle me-1"></i> Active Plan</button>
                @elseif(!Auth::check())
                  <a href="{{ route('loginn') }}" class="sp-btn {{ $isFeatured ? 'sp-btn-red' : 'sp-btn-dark' }}">Login to Subscribe</a>
                @else
                  <a href="{{ route('student.payment', $plan->id) }}" class="sp-btn {{ $isFeatured ? 'sp-btn-red' : 'sp-btn-dark' }}">
                    {{ (isset($activeSubscription) && $activeSubscription) ? 'Switch to this Plan' : 'Subscribe Now' }} &rarr;
                  </a>
                @endif
              </div>

            </div>
          </div>
        @empty
          <div class="col-12 text-center">
            <div class="sp-benefit py-5">
              <i class="fa fa-calendar-times text-muted mb-3" style="font-size: 3rem;"></i>
              <h3>No Subscription Plans Available</h3>
              <p>Please check back soon. New plans will be added by the administrator.</p>
            </div>
          </div>
        @endforelse
      </div>
    </div>
  </section>



  {{-- SUBSCRIPTION HISTORY & PAYMENT HISTORY --}}
  @if(Auth::check() && ((isset($history) && $history->count() > 0) || (isset($payments) && $payments->count() > 0)))
    <section class="sp-section">
      <div class="container">
        @if(isset($history) && $history->count() > 0)
        <div class="sp-history mb-4">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0" style="font-size: 20px; color: #0f172a;">Your Subscription History</h4>
            <span style="color: #64748b; font-size: 13px;">{{ $history->count() }} Record(s)</span>
          </div>
          <div class="table-responsive">
            <table class="table sp-table align-middle mb-0">
              <thead>
                <tr>
                  <th>Subscription ID</th>
                  <th>Plan</th>
                  <th>Duration</th>
                  <th>Period</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach($history as $item)
                  <tr>
                    <td><code style="font-size: 13px;">#{{ $item->id }}</code></td>
                    <td><strong>{{ $item->plan->plan_name ?? 'Subscription Plan' }}</strong></td>
                    <td>{{ $item->plan->duration_days ?? '-' }} Days</td>
                    <td>
                      {{ $item->start_date ? $item->start_date->format('d M, Y') : '-' }} &rarr;
                      {{ $item->end_date ? $item->end_date->format('d M, Y') : '-' }}
                    </td>
                    <td>
                      @if($item->status === 'active' && $item->isCurrentlyActive())
                        <span class="badge bg-success" style="border-radius: 20px;">Active</span>
                      @elseif($item->status === 'cancelled')
                        <span class="badge bg-warning text-dark" style="border-radius: 20px;">Cancelled</span>
                      @else
                        <span class="badge bg-secondary" style="border-radius: 20px;">Expired</span>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        @endif

        @if(isset($payments) && $payments->count() > 0)
        <div class="sp-history">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0" style="font-size: 20px; color: #0f172a;">Payment Transactions</h4>
            <span style="color: #64748b; font-size: 13px;">{{ $payments->count() }} Payment(s)</span>
          </div>
          <div class="table-responsive">
            <table class="table sp-table align-middle mb-0">
              <thead>
                <tr>
                  <th>Payment ID</th>
                  <th>Plan</th>
                  <th>Amount</th>
                  <th>Payment Method</th>
                  <th>Date &amp; Time</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach($payments as $pay)
                  <tr>
                    <td><code style="font-size: 13px;">PAY-{{ str_pad($pay->id, 6, '0', STR_PAD_LEFT) }}</code></td>
                    <td><strong>{{ $pay->plan->plan_name ?? 'Subscription Plan' }}</strong></td>
                    <td><strong>₹{{ number_format($pay->amount, 2) }}</strong></td>
                    <td><span class="badge bg-light text-dark">{{ $pay->payment_method ?? 'Online' }}</span></td>
                    <td>{{ $pay->paid_at ? $pay->paid_at->format('d M, Y h:i A') : ($pay->created_at ? $pay->created_at->format('d M, Y h:i A') : '-') }}</td>
                    <td>
                      @if($pay->payment_status === 'completed')
                        <span class="badge bg-success" style="border-radius: 20px;">Completed</span>
                      @elseif($pay->payment_status === 'failed')
                        <span class="badge bg-danger" style="border-radius: 20px;">Failed</span>
                      @else
                        <span class="badge bg-warning text-dark" style="border-radius: 20px;">{{ ucfirst($pay->payment_status) }}</span>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        @endif
      </div>
    </section>
  @endif

</div>

{{-- MODAL: SUBSCRIBE / CHECKOUT --}}
<div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content sp-modal">
      <div class="sp-modal-head d-flex justify-content-between align-items-center">
        <div>
          <h5 class="modal-title fw-bold mb-0 text-white" id="subscribeModalLabel">Checkout &amp; Activate Plan</h5>
          <small style="color: #94a3b8;">Complete your subscription to unlock premium perks</small>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">

        <form method="POST" action="{{ route('student.subscribe') }}" id="subscribeForm">
          @csrf
          <input type="hidden" name="plan_id" id="modalPlanId" value="">

          <div class="p-3 mb-4 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
            <div class="d-flex justify-content-between align-items-center mb-1">
              <span style="color: #64748b; font-size: 14px;">Selected Plan:</span>
              <strong id="modalPlanName" style="color: #0f172a; font-size: 16px;">-</strong>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-1">
              <span style="color: #64748b; font-size: 14px;">Duration:</span>
              <span id="modalPlanDuration" class="fw-semibold text-dark">-</span>
            </div>
            <div class="d-flex justify-content-between align-items-center pt-2 mt-2" style="border-top: 1px dashed #cbd5e1;">
              <span class="fw-bold" style="color: #0f172a;">Total Payable:</span>
              <span class="fw-bold fs-4" style="color: #16a34a;" id="modalPlanPrice">₹0.00</span>
            </div>
          </div>

          <label class="form-label fw-bold mb-2" style="font-size: 14px; color: #334155;">Select Payment Method</label>

          <label class="payment-method-box selected w-100" onclick="selectPaymentMethod(this)">
            <input type="radio" name="payment_method" value="UPI / QR Code (Google Pay, PhonePe, Paytm)" checked>
            <div>
              <div class="fw-semibold text-dark" style="font-size: 14px;">📱 UPI / QR Code</div>
              <small class="text-muted">Instant payment via GPay, PhonePe, Paytm, or BHIM</small>
            </div>
          </label>

          <label class="payment-method-box w-100" onclick="selectPaymentMethod(this)">
            <input type="radio" name="payment_method" value="Debit / Credit Card">
            <div>
              <div class="fw-semibold text-dark" style="font-size: 14px;">💳 Debit / Credit Card</div>
              <small class="text-muted">Visa, Mastercard, RuPay, Maestro</small>
            </div>
          </label>

          <label class="payment-method-box w-100" onclick="selectPaymentMethod(this)">
            <input type="radio" name="payment_method" value="Instant One-Click Demo Pay">
            <div>
              <div class="fw-semibold text-dark" style="font-size: 14px;">⚡ Instant Demo Checkout</div>
              <small class="text-muted">Simulate instant successful payment for testing</small>
            </div>
          </label>

          <button type="submit" class="sp-btn sp-btn-red mt-3 py-3">
            <i class="fa fa-lock me-1"></i> Pay &amp; Activate Subscription
          </button>
        </form>

      </div>
    </div>
  </div>
</div>

<script>
  function openSubscribeModal(planId, planName, planPrice, durationDays) {
    document.getElementById('modalPlanId').value = planId;
    document.getElementById('modalPlanName').innerText = planName;
    document.getElementById('modalPlanDuration').innerText = durationDays + ' Days';
    document.getElementById('modalPlanPrice').innerText = '₹' + planPrice;

    var modalEl = document.getElementById('subscribeModal');
    if (window.bootstrap && window.bootstrap.Modal) {
      new bootstrap.Modal(modalEl).show();
    } else {
      $(modalEl).modal('show'); // Bootstrap 4 / jQuery fallback
    }
  }

  function selectPaymentMethod(labelEl) {
    document.querySelectorAll('.payment-method-box').forEach(function (box) {
      box.classList.remove('selected');
    });
    labelEl.classList.add('selected');
    var radio = labelEl.querySelector('input[type="radio"]');
    if (radio) radio.checked = true;
  }
</script>
@endsection