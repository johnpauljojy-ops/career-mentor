@extends('layouts.templatemaster')

@section('content')
<style>
  /* =========================================================
     CAREER MENTOR — PAYMENT & CHECKOUT PAGE
     (Color palette strictly matched to CareerMentor Homepage)
  ========================================================= */
  .cm-pay-page {
    font-family: 'Poppins', sans-serif;
    background: #f8fafc;
    min-height: 100vh;
    padding-bottom: 90px;
    color: #0f172a;
  }

  /* Top Hero Header (matches Homepage Hero & Resume Banner) */
  .cm-pay-hero {
    position: relative;
    overflow: hidden;
    background: linear-gradient(135deg, #070f19 0%, #0f172a 55%, #1e293b 100%);
    padding-top: 140px;
    padding-bottom: 50px;
    color: #ffffff;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    margin-bottom: 40px;
  }

  /* 3px Accent Line matching homepage footer and header */
  .cm-pay-hero::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #16a34a, #22c55e, #4ade80);
    z-index: 2;
  }

  /* Ambient radial glow */
  .cm-pay-hero::after {
    content: "";
    position: absolute;
    width: 320px;
    height: 320px;
    right: -80px;
    bottom: -100px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(34, 197, 94, 0.12) 0%, transparent 70%);
    pointer-events: none;
  }

  .cm-pay-breadcrumb {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #94a3b8;
    font-size: 13.5px;
    font-weight: 500;
    text-decoration: none !important;
    margin-bottom: 18px;
    transition: color 0.2s ease;
  }

  .cm-pay-breadcrumb:hover {
    color: #4ade80;
  }

  /* Tag pill matching .cm-hero-tag */
  .cm-pay-tag {
    display: inline-block;
    padding: 6px 14px;
    border: 1px solid rgba(34, 197, 94, 0.5);
    border-radius: 50px;
    background: rgba(34, 197, 94, 0.12);
    color: #4ade80;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 12px;
  }

  .cm-pay-hero h1 {
    font-size: 32px;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 8px;
    line-height: 1.2;
  }

  .cm-pay-hero h1 span {
    color: #22c55e;
  }

  .cm-pay-hero p {
    color: #cbd5e1;
    font-size: 14.5px;
    margin: 0;
    max-width: 620px;
    line-height: 1.7;
  }

  /* Card Containers (matching .cm-profile-card) */
  .cm-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(15, 23, 42, 0.06);
    padding: 30px;
  }

  .cm-card-title {
    font-size: 18px;
    font-weight: 700;
    color: #0f172a;
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 22px;
  }

  .cm-icon-badge {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    background: rgba(34, 197, 94, 0.14);
    color: #16a34a;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
  }

  /* Payment Method Tabs */
  .cm-pay-tabs {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    border-bottom: 1px solid #f1f5f9;
    padding-bottom: 18px;
    margin-bottom: 24px;
  }

  .cm-tab-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 18px;
    border-radius: 8px;
    border: 1.5px solid #e2e8f0;
    background: #ffffff;
    color: #475569;
    font-size: 13.5px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .cm-tab-btn:hover {
    border-color: #cbd5e1;
    background: #f8fafc;
  }

  .cm-tab-btn.active {
    border-color: #22c55e;
    background: #f0fdf4;
    color: #15803d;
    box-shadow: 0 4px 12px rgba(34, 197, 94, 0.12);
  }

  .cm-tab-pane {
    display: none;
  }

  .cm-tab-pane.active {
    display: block;
    animation: cmFadeIn 0.25s ease;
  }

  @keyframes cmFadeIn {
    from { opacity: 0; transform: translateY(6px); }
    to { opacity: 1; transform: translateY(0); }
  }

  /* Virtual Card Preview (dark navy tone from homepage) */
  .cm-virtual-card {
    background: linear-gradient(135deg, #070f19 0%, #0f172a 55%, #1e293b 100%);
    border: 1px solid rgba(255, 255, 255, 0.14);
    border-radius: 16px;
    padding: 24px;
    color: #ffffff;
    position: relative;
    max-width: 380px;
    margin: 0 auto 26px;
    box-shadow: 0 14px 34px rgba(15, 23, 42, 0.24);
    overflow: hidden;
  }

  .cm-virtual-card::after {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, rgba(34, 197, 94, 0.22) 0%, transparent 70%);
    border-radius: 50%;
  }

  .cm-card-chip {
    width: 42px;
    height: 32px;
    background: linear-gradient(135deg, #ffd700 0%, #d4af37 100%);
    border-radius: 6px;
    margin-bottom: 22px;
  }

  .cm-card-number {
    font-size: 19px;
    letter-spacing: 2.5px;
    font-family: monospace;
    font-weight: 700;
    margin-bottom: 18px;
    color: #f8fafc;
  }

  .cm-card-foot {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
  }

  .cm-card-lbl {
    font-size: 10px;
    text-transform: uppercase;
    color: #94a3b8;
    letter-spacing: 0.5px;
  }

  .cm-card-val {
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    color: #ffffff;
  }

  /* Bank Grid */
  .cm-bank-box {
    border: 1.5px solid #e2e8f0;
    border-radius: 10px;
    padding: 13px;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s ease;
    background: #ffffff;
  }

  .cm-bank-box:hover {
    border-color: #cbd5e1;
    transform: translateY(-2px);
  }

  .cm-bank-box.selected {
    border-color: #22c55e;
    background: #f0fdf4;
    box-shadow: 0 4px 12px rgba(34, 197, 94, 0.12);
  }

  /* Form Controls */
  .cm-form-control {
    border: 1.5px solid #e2e8f0;
    border-radius: 8px;
    padding: 11px 14px;
    font-size: 14px;
    color: #0f172a;
    transition: border-color 0.2s, box-shadow 0.2s;
  }

  .cm-form-control:focus {
    border-color: #22c55e;
    box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.15);
    outline: none;
  }

  /* Order Summary Card */
  .cm-summary-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(15, 23, 42, 0.06);
    padding: 30px;
    position: sticky;
    top: 120px;
  }

  .cm-plan-tag {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 50px;
    background: rgba(34, 197, 94, 0.12);
    color: #16a34a;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    margin-bottom: 8px;
  }

  .cm-plan-name {
    font-size: 24px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 4px;
  }

  .cm-plan-dur {
    font-size: 13.5px;
    color: #64748b;
    margin-bottom: 20px;
    padding-bottom: 18px;
    border-bottom: 1px solid #f1f5f9;
  }

  .cm-features-list {
    list-style: none;
    padding: 0;
    margin: 0 0 24px 0;
  }

  .cm-features-list li {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 13.5px;
    color: #334155;
    margin-bottom: 11px;
    line-height: 1.45;
  }

  .cm-features-list li i {
    color: #22c55e;
    font-size: 14px;
    flex-shrink: 0;
  }

  .cm-calc-row {
    display: flex;
    justify-content: space-between;
    font-size: 14px;
    color: #64748b;
    margin-bottom: 10px;
  }

  .cm-calc-total {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    padding-top: 16px;
    border-top: 1.5px dashed #cbd5e1;
    margin-top: 16px;
    margin-bottom: 22px;
  }

  .cm-calc-total span {
    font-size: 15px;
    font-weight: 700;
    color: #0f172a;
  }

  .cm-calc-total strong {
    font-size: 28px;
    font-weight: 800;
    color: #16a34a;
  }

  /* Primary Button matching Homepage .cm-btn-primary */
  .cm-btn-pay {
    width: 100%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 14px 24px;
    border-radius: 8px;
    background: #ef4444; /* Signature Homepage Red CTA */
    color: #ffffff !important;
    text-decoration: none !important;
    font-size: 15px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
    box-shadow: 0 6px 18px rgba(239, 68, 68, 0.28);
  }

  .cm-btn-pay:hover {
    background: #dc2626;
    color: #ffffff !important;
    transform: translateY(-2px);
    box-shadow: 0 10px 24px rgba(239, 68, 68, 0.35);
  }

  /* Guarantee bar */
  .cm-trust-bar {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 16px;
    margin-top: 18px;
    color: #94a3b8;
    font-size: 12px;
  }

  .cm-security-strip {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 16px 20px;
    box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
  }
</style>

<div class="cm-pay-page">

  {{-- TOP HERO BANNER (Matches CareerMentor Homepage Tone) --}}
  <div class="cm-pay-hero">
    <div class="container">
      
      <a href="{{ route('student.subscription') }}" class="cm-pay-breadcrumb">
        <i class="fa fa-arrow-left"></i> Back to Subscription Plans
      </a>

      <div class="row align-items-center">
        <div class="col-lg-8">
          <div>
            <span class="cm-pay-tag">
              <i class="fa fa-shield-alt me-1"></i> 256-BIT SSL ENCRYPTED CHECKOUT
            </span>
          </div>
          <h1>Complete Your <span>Subscription</span></h1>
          <p>
            Unlock full access to ATS-friendly resume templates, personalized AI career guidance, and dedicated student mentorship.
          </p>
        </div>

        <div class="col-lg-4 text-lg-end d-none d-lg-block">
          <div class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-3" 
               style="background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(255, 255, 255, 0.18);">
            <i class="fa fa-check-circle" style="color: #22c55e;"></i>
            <span style="font-size: 13px; color: #e2e8f0; font-weight: 500;">Instant Activation Guaranteed</span>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="container">

    {{-- Error Alert --}}
    @if(session('error'))
      <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 12px; background: #fee2e2; color: #b91c1c;">
        <i class="fa fa-exclamation-circle me-1"></i> {{ session('error') }}
      </div>
    @endif

    <div class="row g-4">

      {{-- LEFT COLUMN: Payment Methods --}}
      <div class="col-lg-7">
        <div class="cm-card mb-4">
          
          <div class="cm-card-title">
            <span class="cm-icon-badge"><i class="fa fa-wallet"></i></span>
            <span>Select Payment Method</span>
          </div>

          {{-- Navigation Tabs --}}
          <div class="cm-pay-tabs">
            <button type="button" class="cm-tab-btn active" onclick="switchPayTab('upi', 'UPI', this)">
              <i class="fa fa-mobile-alt" style="color: #16a34a;"></i> UPI
            </button>
            <button type="button" class="cm-tab-btn" onclick="switchPayTab('card', 'Credit / Debit Card', this)">
              <i class="fa fa-credit-card" style="color: #0284c7;"></i> Card
            </button>
            <button type="button" class="cm-tab-btn" onclick="switchPayTab('netbanking', 'Net Banking', this)">
              <i class="fa fa-university" style="color: #d97706;"></i> Net Banking
            </button>
          </div>

          {{-- TAB 1: UPI --}}
          <div id="tab-upi" class="cm-tab-pane active">

            <div class="mb-3">
              <label class="form-label fw-semibold" style="font-size: 13px; color: #475569;">Enter UPI ID / VPA</label>
              <div class="input-group">
                <input type="text" class="form-control cm-form-control" id="upiIdInput" placeholder="e.g. yourname@okhdfcbank" value="student@upi">
                <button class="btn" type="button" style="background: #22c55e; color: #fff; font-weight: 600; border-radius: 0 8px 8px 0;" onclick="alert('UPI ID Verified!')">
                  Verify
                </button>
              </div>
              <small class="text-muted">A payment request will be sent to your mobile UPI application.</small>
            </div>

            <div class="d-flex justify-content-center align-items-center gap-2 pt-2 flex-wrap">
              <span class="badge border bg-light text-muted" style="font-weight: 500;">Google Pay</span>
              <span class="badge border bg-light text-muted" style="font-weight: 500;">PhonePe</span>
              <span class="badge border bg-light text-muted" style="font-weight: 500;">Paytm</span>
              <span class="badge border bg-light text-muted" style="font-weight: 500;">BHIM UPI</span>
            </div>
          </div>

          {{-- TAB 2: Card --}}
          <div id="tab-card" class="cm-tab-pane">
            
            <!-- Virtual Card Graphic -->
            <div class="cm-virtual-card">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-white-50" style="font-size: 11px; font-weight: 600; letter-spacing: 1px;">DEBIT / CREDIT</span>
                <span class="fw-bold" style="font-size: 15px; color: #22c55e;">CareerMentor</span>
              </div>
              <div class="cm-card-chip"></div>
              <div class="cm-card-number" id="previewCardNumber">•••• •••• •••• 4242</div>
              <div class="cm-card-foot">
                <div>
                  <div class="cm-card-lbl">Card Holder</div>
                  <div class="cm-card-val" id="previewCardName">{{ $user->name ?? 'STUDENT' }}</div>
                </div>
                <div>
                  <div class="cm-card-lbl">Expires</div>
                  <div class="cm-card-val" id="previewCardExpiry">12/28</div>
                </div>
              </div>
            </div>

            <!-- Card Inputs -->
            <div class="mb-3">
              <label class="form-label fw-semibold" style="font-size: 13px; color: #475569;">Card Number</label>
              <div class="input-group">
                <input type="text" class="form-control cm-form-control" id="inputCardNumber" 
                       placeholder="4532 0123 4567 8910" maxlength="19"
                       oninput="formatCardNumber(this)">
                <span class="input-group-text bg-white border-start-0 text-muted"><i class="fa fa-credit-card"></i></span>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold" style="font-size: 13px; color: #475569;">Name on Card</label>
              <input type="text" class="form-control cm-form-control" id="inputCardName" 
                     placeholder="Cardholder Name" value="{{ $user->name ?? '' }}"
                     oninput="document.getElementById('previewCardName').innerText = this.value.toUpperCase() || 'STUDENT'">
            </div>

            <div class="row g-3">
              <div class="col-6">
                <label class="form-label fw-semibold" style="font-size: 13px; color: #475569;">Expiry Date</label>
                <input type="text" class="form-control cm-form-control" id="inputCardExpiry" 
                       placeholder="MM/YY" maxlength="5"
                       oninput="formatExpiry(this)">
              </div>
              <div class="col-6">
                <label class="form-label fw-semibold" style="font-size: 13px; color: #475569;">CVV / CVC</label>
                <input type="password" class="form-control cm-form-control" maxlength="4" placeholder="•••">
              </div>
            </div>
          </div>

          {{-- TAB 3: Net Banking --}}
          <div id="tab-netbanking" class="cm-tab-pane">
            <p class="text-muted" style="font-size: 13.5px;">Select your bank to proceed with secure Net Banking authorization:</p>
            
            <div class="row g-2 mb-3">
              <div class="col-4">
                <div class="cm-bank-box selected" onclick="selectBank(this)">
                  <strong class="d-block text-dark" style="font-size: 13px;">SBI</strong>
                  <small class="text-muted">State Bank</small>
                </div>
              </div>
              <div class="col-4">
                <div class="cm-bank-box" onclick="selectBank(this)">
                  <strong class="d-block text-dark" style="font-size: 13px;">HDFC</strong>
                  <small class="text-muted">HDFC Bank</small>
                </div>
              </div>
              <div class="col-4">
                <div class="cm-bank-box" onclick="selectBank(this)">
                  <strong class="d-block text-dark" style="font-size: 13px;">ICICI</strong>
                  <small class="text-muted">ICICI Bank</small>
                </div>
              </div>
              <div class="col-4">
                <div class="cm-bank-box" onclick="selectBank(this)">
                  <strong class="d-block text-dark" style="font-size: 13px;">AXIS</strong>
                  <small class="text-muted">Axis Bank</small>
                </div>
              </div>
              <div class="col-4">
                <div class="cm-bank-box" onclick="selectBank(this)">
                  <strong class="d-block text-dark" style="font-size: 13px;">KOTAK</strong>
                  <small class="text-muted">Kotak Bank</small>
                </div>
              </div>
              <div class="col-4">
                <div class="cm-bank-box" onclick="selectBank(this)">
                  <strong class="d-block text-dark" style="font-size: 13px;">PNB</strong>
                  <small class="text-muted">Punjab National</small>
                </div>
              </div>
            </div>

            <div class="mb-2">
              <label class="form-label fw-semibold" style="font-size: 13px; color: #475569;">Or Select All Other Banks</label>
              <select class="form-select cm-form-control">
                <option value="">-- Choose Other Indian Bank --</option>
                <option>Bank of Baroda</option>
                <option>Canara Bank</option>
                <option>Union Bank of India</option>
                <option>IDFC FIRST Bank</option>
                <option>Federal Bank</option>
                <option>Yes Bank</option>
              </select>
            </div>
          </div>

        </div>

        {{-- Security Strip --}}
        <div class="cm-security-strip d-flex flex-wrap justify-content-around align-items-center gap-3">
          <div class="d-flex align-items-center gap-2" style="color: #475569; font-size: 13px;">
            <i class="fa fa-shield-alt text-success fs-5"></i>
            <span>256-Bit SSL Encryption</span>
          </div>
          <div class="d-flex align-items-center gap-2" style="color: #475569; font-size: 13px;">
            <i class="fa fa-check-circle fs-5" style="color: #22c55e;"></i>
            <span>Verified Payment Gateway</span>
          </div>
          <div class="d-flex align-items-center gap-2" style="color: #475569; font-size: 13px;">
            <i class="fa fa-bolt fs-5" style="color: #ef4444;"></i>
            <span>Instant Unlocking</span>
          </div>
        </div>
      </div>

      {{-- RIGHT COLUMN: Order Summary --}}
      <div class="col-lg-5">
        <div class="cm-summary-card">
          
          <div class="mb-3">
            <span class="cm-plan-tag">Selected Plan</span>
            <div class="cm-plan-name">{{ $plan->plan_name }}</div>
            <div class="cm-plan-dur">
              <i class="fa fa-calendar-check me-1" style="color: #16a34a;"></i> 
              Valid for <strong>{{ $plan->duration_days }} Days</strong>
            </div>
          </div>

          {{-- Features Included --}}
          <ul class="cm-features-list">
            <li><i class="fa fa-check-circle"></i><span>⭐ Premium ATS-Friendly Resume Templates</span></li>
            <li><i class="fa fa-check-circle"></i><span>AI-Powered Career &amp; Branch Recommendations</span></li>
            <li><i class="fa fa-check-circle"></i><span>In-Depth Academic &amp; Skill Gap Analysis</span></li>
            <li><i class="fa fa-check-circle"></i><span>Unlimited PDF &amp; Document Downloads</span></li>
            <li><i class="fa fa-check-circle"></i><span>Priority 24/7 Student Mentorship Support</span></li>
          </ul>

          {{-- Billing Breakdown --}}
          <div class="cm-calc-row">
            <span>Plan Price</span>
            <span class="fw-semibold text-dark">₹{{ number_format($plan->price, 2) }}</span>
          </div>
          <div class="cm-calc-row">
            <span>Processing &amp; Setup Fee</span>
            <span style="color: #16a34a; font-weight: 600;">FREE (₹0.00)</span>
          </div>
          <div class="cm-calc-row">
            <span>Taxes &amp; GST</span>
            <span class="text-muted">Included</span>
          </div>

          <div class="cm-calc-total">
            <span>Total Payable:</span>
            <strong>₹{{ number_format($plan->price, 2) }}</strong>
          </div>

          {{-- Account Identification --}}
          <div class="p-2 px-3 rounded-2 mb-3" style="background: #f8fafc; border: 1px solid #e2e8f0; font-size: 12.5px;">
            <div class="text-muted">Subscribing as:</div>
            <strong class="text-dark">{{ $user->name ?? 'Student' }}</strong> &bull; <span class="text-muted">{{ $user->email ?? '' }}</span>
          </div>

          {{-- The Payment Form --}}
          <form method="POST" action="{{ route('student.payment.process') }}" id="checkoutForm">
            @csrf
            <input type="hidden" name="plan_id" value="{{ $plan->id }}">
            <input type="hidden" name="payment_method" id="selectedPaymentMethod" value="UPI">

            <button type="submit" class="cm-btn-pay" id="btnSubmitPay">
              Pay ₹{{ number_format($plan->price, 0) }} &amp; Activate Plan &rarr;
            </button>
          </form>

          <div class="cm-trust-bar">
            <span><i class="fa fa-lock me-1"></i> 100% Safe Checkout</span>
            <span>&bull;</span>
            <span>Instant Access</span>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

<script>
  function switchPayTab(tabKey, methodName, btnElement) {
    document.querySelectorAll('.cm-tab-btn').forEach(function(btn) {
      btn.classList.remove('active');
    });
    btnElement.classList.add('active');

    document.querySelectorAll('.cm-tab-pane').forEach(function(pane) {
      pane.classList.remove('active');
    });
    var targetPane = document.getElementById('tab-' + tabKey);
    if (targetPane) {
      targetPane.classList.add('active');
    }

    document.getElementById('selectedPaymentMethod').value = methodName;
  }

  function formatCardNumber(input) {
    var val = input.value.replace(/\D/g, '').substring(0, 16);
    var formatted = val.match(/.{1,4}/g)?.join(' ') || val;
    input.value = formatted;
    document.getElementById('previewCardNumber').innerText = formatted || '•••• •••• •••• 4242';
  }

  function formatExpiry(input) {
    var val = input.value.replace(/\D/g, '').substring(0, 4);
    if (val.length >= 3) {
      input.value = val.substring(0, 2) + '/' + val.substring(2);
    } else {
      input.value = val;
    }
    document.getElementById('previewCardExpiry').innerText = input.value || '12/28';
  }

  function selectBank(boxElement) {
    document.querySelectorAll('.cm-bank-box').forEach(function(b) {
      b.classList.remove('selected');
    });
    boxElement.classList.add('selected');
    var bankName = boxElement.querySelector('strong').innerText;
    document.getElementById('selectedPaymentMethod').value = 'Net Banking (' + bankName + ')';
  }

  // Prevent multiple submits & show loading text
  document.getElementById('checkoutForm').addEventListener('submit', function() {
    var btn = document.getElementById('btnSubmitPay');
    btn.innerHTML = '<i class="fa fa-spinner fa-spin me-2"></i> Processing Payment...';
    btn.style.pointerEvents = 'none';
    btn.style.opacity = '0.85';
  });
</script>
@endsection