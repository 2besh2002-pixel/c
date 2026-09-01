@php
$typeConfig = [
    'law'         => ['icon'=>'ti-scale',      'color'=>'#1A237E','bg'=>'rgba(26,35,126,.10)','gradient'=>'linear-gradient(135deg,#1A237E,#283593)','name_ar'=>'مكاتب المحاماة','name_en'=>'Law Firms'],
    'services'    => ['icon'=>'ti-briefcase',  'color'=>'#1565C0','bg'=>'rgba(21,101,192,.10)','gradient'=>'linear-gradient(135deg,#1565C0,#1E88E5)','name_ar'=>'مكاتب الخدمات والتعقيب','name_en'=>'Service & Expediting Offices'],
    'customs'     => ['icon'=>'ti-truck',      'color'=>'#00695C','bg'=>'rgba(0,105,92,.10)','gradient'=>'linear-gradient(135deg,#00695C,#00897B)','name_ar'=>'شركات التخليص الجمركي','name_en'=>'Customs Clearance Companies'],
    'accounting'  => ['icon'=>'ti-calculator', 'color'=>'#2E7D32','bg'=>'rgba(46,125,50,.10)','gradient'=>'linear-gradient(135deg,#2E7D32,#43A047)','name_ar'=>'مكاتب المحاسبة والاستشارات المالية والضريبية','name_en'=>'Accounting & Tax Consulting'],
    'engineering' => ['icon'=>'ti-building',   'color'=>'#EF6C00','bg'=>'rgba(239,108,0,.10)','gradient'=>'linear-gradient(135deg,#EF6C00,#FB8C00)','name_ar'=>'الاستشارات الهندسية والتصميم والإشراف','name_en'=>'Engineering Consulting'],
    'freelance'   => ['icon'=>'ti-user',       'color'=>'#6A1B9A','bg'=>'rgba(106,27,154,.10)','gradient'=>'linear-gradient(135deg,#6A1B9A,#8E24AA)','name_ar'=>'أصحاب المهن الحرة','name_en'=>'Freelance Professionals'],
];
$cfg = $typeConfig[$type] ?? [
    'icon'=>'ti-briefcase','color'=>'#1A237E','bg'=>'rgba(26,35,126,.10)','gradient'=>'linear-gradient(135deg,#1A237E,#283593)',
    'name_ar'=>\App\Models\Business\Office::$typeLabels[$type]['ar'] ?? $type,
    'name_en'=>\App\Models\Business\Office::$typeLabels[$type]['en'] ?? $type
];
$user = auth('business')->user();
$specAr = $office->display_specialty_ar;
$specEn = $office->display_specialty_en;
@endphp
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $specAr }} | منصة آمر تم</title>
<link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css"/>
<style>
*{box-sizing:border-box;margin:0;padding:0;}
:root{--pri:#1A237E;--pri2:#283593;--pri3:#1565C0;--bg:#F4F6FB;--sur:#fff;--bc:rgba(26,35,126,.07);--t1:#0D1257;--t2:#3A4490;--t3:#7A82B8;--t4:#BDC2E0;--pd:rgba(26,35,126,.08);--sh:rgba(26,35,126,.08);--sh2:rgba(26,35,126,.18);}
html,body{background:var(--bg);color:var(--t1);min-height:100vh;overflow-x:hidden;}
body.ar,body.ar *:not(i){font-family:'Cairo',sans-serif;direction:rtl;}
body.en,body.en *:not(i){font-family:'Inter',sans-serif;direction:ltr;}

/* NAVBAR */
.nb{height:70px;display:flex;align-items:center;padding:0 2rem;gap:1rem;background:linear-gradient(135deg,#1A237E,#1565C0);box-shadow:0 2px 16px rgba(26,35,126,.3);position:sticky;top:0;z-index:200;}
.nb-logo{display:flex;align-items:center;gap:10px;cursor:pointer;text-decoration:none;}
.nb-logo-nm{font-size:20px;font-weight:900;color:#fff;}
.nb-mid{flex:1;}
.nb-right{display:flex;align-items:center;gap:7px;flex-shrink:0;}
.lng{display:flex;padding:2px;border-radius:8px;background:rgba(255,255,255,.15);gap:1px;}
.lt{padding:4px 8px;border-radius:6px;font-size:11px;font-weight:700;cursor:pointer;color:rgba(255,255,255,.55);transition:all .2s;}
.lt.on{background:rgba(255,255,255,.22);color:#fff;}
.nb-btn{display:inline-flex;align-items:center;gap:5px;padding:7px 14px;border-radius:8px;font-family:inherit;font-size:12.5px;font-weight:700;cursor:pointer;transition:all .2s;border:none;text-decoration:none;}
.nb-btn.out{background:rgba(255,255,255,.18);border:1px solid rgba(255,255,255,.25);color:#fff;}
.nb-btn.out:hover{background:rgba(255,255,255,.28);}
.nb-btn.sol{background:#fff;color:var(--pri);}
.nb-user{display:flex;align-items:center;gap:7px;padding:4px 10px;border-radius:9px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);cursor:pointer;}
.nb-user-nm{font-size:12px;font-weight:700;color:#fff;}
.nb-user-av{width:30px;height:30px;border-radius:50%;object-fit:cover;border:1.5px solid rgba(255,255,255,.35);}

/* BREADCRUMB */
.bc-bar{background:var(--sur);border-bottom:1px solid var(--bc);padding:.7rem 2rem;}
.bc{display:flex;align-items:center;gap:6px;max-width:1100px;margin:0 auto;font-size:12.5px;color:var(--t3);}
.bc a{color:var(--t3);text-decoration:none;transition:color .15s;}
.bc a:hover{color:var(--pri);}
.bc-sep{font-size:11px;}
.bc-cur{color:var(--t2);font-weight:700;}

/* HERO */
.hero{padding:2.2rem 2rem 1.8rem;max-width:1100px;margin:0 auto;}
.hero-inner{background:var(--sur);border-radius:22px;border:1.5px solid var(--bc);box-shadow:0 4px 20px var(--sh);padding:2rem;display:flex;gap:1.8rem;flex-wrap:wrap;align-items:flex-start;}
.hero-av{width:80px;height:80px;border-radius:20px;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:30px;font-weight:900;color:#fff;}
.hero-info{flex:1;min-width:0;}
.hero-name{font-size:24px;font-weight:900;color:var(--t1);margin-bottom:6px;}
.hero-badges{display:flex;gap:7px;flex-wrap:wrap;margin-bottom:10px;}
.badge{display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:20px;font-size:11.5px;font-weight:700;}
.badge-ver{background:rgba(16,185,129,.1);color:#059669;border:1px solid rgba(16,185,129,.2);}
.badge-type{background:var(--pd);color:var(--pri);}
.badge-city{background:rgba(99,102,241,.08);color:#4f46e5;}
.hero-desc{font-size:14px;color:var(--t3);line-height:1.7;max-width:600px;}
.hero-contacts{margin-top:14px;display:flex;gap:1.2rem;flex-wrap:wrap;}
.hero-contact{display:flex;align-items:center;gap:6px;font-size:13px;color:var(--t2);}
.hero-contact i{color:var(--t3);font-size:15px;}

/* SERVICES SECTION */
.sec-wrap{padding:0 2rem 3rem;max-width:1100px;margin:0 auto;}
.sec-title{font-size:18px;font-weight:900;color:var(--t1);margin-bottom:1.2rem;display:flex;align-items:center;gap:10px;}
.sec-title i{font-size:20px;color:var(--pri);}
.svc-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1.2rem;}

/* SERVICE CARD */
.svc-card{background:var(--sur);border-radius:18px;border:1.5px solid var(--bc);box-shadow:0 4px 18px var(--sh);overflow:hidden;display:flex;flex-direction:column;transition:all .25s;}
.svc-card:hover{transform:translateY(-4px);box-shadow:0 16px 40px var(--sh2);}
.svc-card-body{padding:1.5rem;flex:1;}
.svc-card-name{font-size:15px;font-weight:800;color:var(--t1);margin-bottom:6px;}
.svc-card-desc{font-size:13px;color:var(--t3);line-height:1.65;margin-bottom:12px;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;}
.svc-card-meta{display:flex;gap:10px;flex-wrap:wrap;}
.svc-meta-item{display:inline-flex;align-items:center;gap:5px;font-size:12px;color:var(--t3);}
.svc-meta-item i{font-size:13px;}
.svc-price{font-size:18px;font-weight:900;color:var(--pri);}
.svc-card-foot{padding:1rem 1.5rem;border-top:1px solid var(--bc);background:#F8F9FF;}
.svc-req-btn{width:100%;padding:10px;border:none;border-radius:11px;background:linear-gradient(135deg,var(--pri),var(--pri3));color:#fff;font-family:inherit;font-size:14px;font-weight:800;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;transition:opacity .2s;}
.svc-req-btn:hover{opacity:.88;}
.svc-req-btn:disabled{opacity:.45;cursor:not-allowed;}

/* LOGIN GATE */
.login-gate{background:var(--sur);border-radius:16px;border:1.5px dashed var(--bc);padding:1.8rem;text-align:center;margin-bottom:1.5rem;}
.login-gate i{font-size:32px;color:var(--t4);margin-bottom:10px;display:block;}
.login-gate h3{font-size:15px;font-weight:800;color:var(--t2);margin-bottom:6px;}
.login-gate p{font-size:13px;color:var(--t3);margin-bottom:14px;}
.login-gate-btn{display:inline-flex;align-items:center;gap:7px;padding:10px 20px;border-radius:10px;background:linear-gradient(135deg,var(--pri),var(--pri3));color:#fff;font-family:inherit;font-size:13.5px;font-weight:800;text-decoration:none;cursor:pointer;border:none;transition:opacity .2s;}
.login-gate-btn:hover{opacity:.88;}

/* EMPTY STATE */
.empty{text-align:center;padding:4rem 2rem;color:var(--t3);}
.empty-ico{width:70px;height:70px;border-radius:20px;display:flex;align-items:center;justify-content:center;background:var(--pd);margin:0 auto 1rem;font-size:30px;color:var(--t3);}
.empty h3{font-size:16px;font-weight:800;color:var(--t2);margin-bottom:6px;}
.empty p{font-size:13px;max-width:340px;margin:0 auto;line-height:1.7;}

/* REQUEST MODAL */
.overlay{position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:500;display:none;align-items:center;justify-content:center;padding:20px;}
.overlay.open{display:flex;}
.modal{background:var(--sur);border-radius:22px;width:100%;max-width:520px;max-height:90vh;display:flex;flex-direction:column;overflow:hidden;box-shadow:0 30px 80px rgba(0,0,0,.3);}
.modal-head{padding:18px 22px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid var(--bc);}
.modal-title{font-size:16px;font-weight:800;color:var(--pri);}
.modal-close{background:none;border:none;font-size:22px;cursor:pointer;color:#888;width:34px;height:34px;border-radius:8px;display:flex;align-items:center;justify-content:center;transition:.2s;}
.modal-close:hover{background:#F0F2F8;color:#333;}
.modal-body{padding:20px 22px;overflow-y:auto;flex:1;}
.modal-foot{padding:14px 22px;border-top:1px solid var(--bc);display:flex;gap:8px;justify-content:flex-end;}
.form-group{margin-bottom:16px;}
.form-label{display:block;font-size:13px;font-weight:700;color:var(--t2);margin-bottom:6px;}
.form-control{width:100%;padding:11px 14px;border:1.5px solid #E0E3FF;border-radius:11px;font-family:inherit;font-size:14px;color:var(--t1);outline:none;transition:.2s;background:#F8F9FF;}
.form-control:focus{border-color:var(--pri);background:#fff;box-shadow:0 0 0 3px rgba(26,35,126,.08);}
.svc-sel-info{background:var(--pd);border-radius:12px;padding:12px 16px;margin-bottom:16px;font-size:13px;}
.svc-sel-name{font-weight:800;color:var(--t1);margin-bottom:3px;}
.svc-sel-price{font-weight:900;color:var(--pri);font-size:16px;}
.btn{display:inline-flex;align-items:center;gap:7px;padding:11px 18px;border-radius:10px;font-family:inherit;font-size:14px;font-weight:800;cursor:pointer;border:none;transition:all .2s;}
.btn-pri{background:linear-gradient(135deg,var(--pri),var(--pri3));color:#fff;box-shadow:0 6px 18px rgba(26,35,126,.3);}
.btn-pri:hover{opacity:.88;}
.btn-pri:disabled{opacity:.5;cursor:not-allowed;}
.btn-ghost{background:#F0F2F8;color:#555;}
.btn-ghost:hover{background:#E0E3FF;color:var(--pri);}
.success-box{text-align:center;padding:1.5rem 1rem;}
.success-ico{width:60px;height:60px;border-radius:50%;background:rgba(16,185,129,.12);display:flex;align-items:center;justify-content:center;margin:0 auto 12px;font-size:26px;color:#059669;}
.success-ref{font-family:monospace;font-size:18px;font-weight:900;color:var(--pri);background:var(--pd);padding:8px 16px;border-radius:10px;display:inline-block;margin:8px 0;}
.spin{display:inline-block;width:18px;height:18px;border:2.5px solid rgba(255,255,255,.3);border-top-color:#fff;border-radius:50%;animation:spin .6s linear infinite;}
@keyframes spin{to{transform:rotate(360deg)}}

/* FOOTER */
.footer{background:linear-gradient(135deg,#1A237E,#1565C0);padding:1.2rem 2rem;text-align:center;}
.f-cp{font-size:12px;color:rgba(255,255,255,.55);}

::-webkit-scrollbar{width:5px;}
::-webkit-scrollbar-thumb{background:rgba(26,35,126,.2);border-radius:4px;}

@media(max-width:700px){
  .nb{padding:0 1rem;}
  .hero{padding:1.5rem 1rem 1.2rem;}
  .hero-inner{padding:1.5rem 1.2rem;gap:1rem;}
  .sec-wrap{padding:0 1rem 2rem;}
  .svc-grid{grid-template-columns:1fr;}
}
</style>
</head>
<body class="ar">

<!-- NAVBAR -->
<nav class="nb">
  <a class="nb-logo" href="{{ route('amrtm.index') }}">
    <div><div class="nb-logo-nm" id="nnm">آمر تم</div></div>
  </a>
  <div class="nb-mid"></div>
  <div class="nb-right">
    <div class="lng">
      <div class="lt on" id="la" onclick="setLang('ar')">AR</div>
      <div class="lt"    id="le" onclick="setLang('en')">EN</div>
    </div>
    @if($user)
    <div id="nb-auth" style="display:flex;gap:6px;align-items:center;">
      <a class="nb-btn out" href="{{ route('amrtm.user.dashboard') }}"><i class="ti ti-layout-dashboard"></i><span>حسابي</span></a>
      <div class="nb-user">
        <img class="nb-user-av" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=1A237E&color=fff&size=64" alt=""/>
        <span class="nb-user-nm">{{ $user->name }}</span>
      </div>
    </div>
    @else
    <div style="display:flex;gap:6px;">
      <a class="nb-btn out" href="{{ route('amrtm.login') }}"><i class="ti ti-login"></i><span>دخول</span></a>
      <a class="nb-btn sol" href="{{ route('amrtm.register') }}"><i class="ti ti-user-plus"></i><span>تسجيل</span></a>
    </div>
    @endif
  </div>
</nav>

<!-- BREADCRUMB -->
<div class="bc-bar">
  <div class="bc">
    <a href="{{ route('amrtm.index') }}"><i class="ti ti-home-2" style="font-size:13px;"></i> الرئيسية</a>
    <span class="bc-sep"><i class="ti ti-chevron-left" style="font-size:11px;"></i></span>
    <a href="{{ route('amrtm.offices.directory', $type) }}">{{ $cfg['name_ar'] }}</a>
    <span class="bc-sep"><i class="ti ti-chevron-left" style="font-size:11px;"></i></span>
    <span class="bc-cur">{{ $specAr }}</span>
  </div>
</div>

<!-- HERO -->
<div class="hero">
  <div class="hero-inner">
    <div class="hero-av" style="background:{{ $cfg['gradient'] }};">
      <i class="ti {{ $cfg['icon'] }}" style="font-size:36px;color:#fff;"></i>
    </div>
    <div class="hero-info">
      <div class="hero-name">{{ $specAr }}</div>
      <div class="hero-badges">
        <span class="badge badge-ver"><i class="ti ti-shield-check"></i> معتمد وموثّق من منصة آمر تم</span>
        <span class="badge badge-type">{{ $cfg['name_ar'] }}</span>
        @if($office->city)
          <span class="badge badge-city"><i class="ti ti-map-pin"></i> {{ $office->city }}</span>
        @endif
      </div>
      @if($office->description_ar)
        <div class="hero-desc">{{ $office->description_ar }}</div>
      @else
        <div class="hero-desc">خدمات واستشارات متخصصة ومعتمدة يتم إنجازها ومتابعتها بإشراف كامل وضمان من منصة آمر تم لقطاع الأعمال.</div>
      @endif
      <div class="hero-contacts">
        <div class="hero-contact"><i class="ti ti-shield-check" style="color:#059669;"></i> تقديم ومتابعة مباشرة عبر المنصة</div>
        <div class="hero-contact"><i class="ti ti-lock" style="color:var(--pri);"></i> سرية تامة وحماية لبيانات العميل</div>
      </div>
    </div>
  </div>
</div>

<!-- SERVICES SECTION -->
<div class="sec-wrap">
  <div class="sec-title">
    <i class="ti ti-list-details"></i>
    <span>الخدمات المتاحة</span>
    <span style="font-size:13px;font-weight:700;color:var(--t3);">({{ $office->services->count() }} خدمة)</span>
  </div>

  @if($office->services->isEmpty())
    <div class="empty">
      <div class="empty-ico"><i class="ti ti-list-details"></i></div>
      <h3>لم يتم إضافة خدمات تفصيلية بعد</h3>
      <p>يمكنك طلب الخدمة والاستفسار مباشرة عبر منصة آمر تم.</p>
    </div>
  @else
    @if(!$user)
      <div class="login-gate">
        <i class="ti ti-lock"></i>
        <h3>سجّل دخولك لطلب الخدمة</h3>
        <p>تحتاج إلى حساب في منصة آمر تم لإرسال طلبك ومتابعته بكل سهولة.</p>
        <a href="{{ route('amrtm.login') }}?redirect={{ urlencode(request()->url()) }}" class="login-gate-btn">
          <i class="ti ti-login"></i> تسجيل الدخول أو إنشاء حساب
        </a>
      </div>
    @endif

    <div class="svc-grid">
      @foreach($office->services as $svc)
      <div class="svc-card">
        <div class="svc-card-body">
          <div class="svc-card-name" data-ar="{{ $svc->name_ar }}" data-en="{{ $svc->name_en ?? $svc->name_ar }}">{{ $svc->name_ar }}</div>
          @if($svc->description_ar)
            <div class="svc-card-desc" data-ar="{{ $svc->description_ar }}" data-en="{{ $svc->description_en ?? $svc->description_ar }}">{{ $svc->description_ar }}</div>
          @endif
          <div class="svc-card-meta">
            <span class="svc-price">{{ number_format($svc->price, 0) }} ر.س</span>
            @if($svc->duration)
              <span class="svc-meta-item"><i class="ti ti-clock"></i> {{ $svc->duration }}</span>
            @endif
          </div>
        </div>
        <div class="svc-card-foot">
          @if($user)
            <button class="svc-req-btn" onclick="openRequestModal({{ $svc->id }}, '{{ addslashes($svc->name_ar) }}', {{ $svc->price }})">
              <i class="ti ti-send"></i> طلب هذه الخدمة
            </button>
          @else
            <a href="{{ route('amrtm.login') }}?redirect={{ urlencode(request()->url()) }}" class="svc-req-btn" style="text-decoration:none;">
              <i class="ti ti-login"></i> سجّل دخولك للطلب
            </a>
          @endif
        </div>
      </div>
      @endforeach
    </div>
  @endif
</div>

<!-- FOOTER -->
<footer class="footer">
  <div class="f-cp">© 2025 <b style="color:rgba(255,255,255,.85);">آمر تم</b> — جميع الحقوق محفوظة</div>
</footer>

<!-- REQUEST MODAL -->
@if($user)
<div class="overlay" id="req-overlay">
  <div class="modal">
    <div class="modal-head">
      <span class="modal-title">طلب خدمة</span>
      <button class="modal-close" onclick="closeModal()"><i class="ti ti-x"></i></button>
    </div>
    <div class="modal-body" id="modal-body">
      <!-- Service info -->
      <div class="svc-sel-info" id="svc-info"></div>

      <!-- Request form -->
      <div id="req-form">
        <div class="form-group">
          <label class="form-label">الاسم الكامل</label>
          <input type="text" class="form-control" id="f-name" value="{{ $user->name }}" placeholder="الاسم الكامل" required>
        </div>
        <div class="form-group">
          <label class="form-label">رقم الجوال</label>
          <input type="tel" class="form-control" id="f-phone" value="{{ $user->phone ?? '' }}" placeholder="05xxxxxxxx" required>
        </div>
        <div class="form-group">
          <label class="form-label">رقم الهوية <span style="color:var(--t4);font-weight:500;">(اختياري)</span></label>
          <input type="text" class="form-control" id="f-id" placeholder="1xxxxxxxxx">
        </div>
        <div class="form-group">
          <label class="form-label">ملاحظات إضافية <span style="color:var(--t4);font-weight:500;">(اختياري)</span></label>
          <textarea class="form-control" id="f-notes" rows="3" placeholder="أي تفاصيل إضافية تود إضافتها..."></textarea>
        </div>
      </div>

      <!-- Success state -->
      <div id="req-success" style="display:none;" class="success-box">
        <div class="success-ico"><i class="ti ti-circle-check"></i></div>
        <div style="font-size:16px;font-weight:800;color:var(--t1);margin-bottom:6px;">تم إرسال طلبك بنجاح!</div>
        <div style="font-size:13px;color:var(--t3);margin-bottom:10px;">رقم المرجع:</div>
        <div class="success-ref" id="success-ref"></div>
        <div style="font-size:13px;color:var(--t3);margin-top:10px;line-height:1.7;">تم استلام طلبك وستتم متابعته والتواصل معك عبر المنصة قريباً.</div>
      </div>
    </div>
    <div class="modal-foot" id="modal-foot">
      <button class="btn btn-ghost" onclick="closeModal()">إلغاء</button>
      <button class="btn btn-pri" id="submit-btn" onclick="doSubmit()">
        <i class="ti ti-send"></i> إرسال الطلب
      </button>
    </div>
  </div>
</div>
@endif

<script>
window.OFFICE_ID     = {{ $office->id }};
window.AMRTM_CSRF   = '{{ csrf_token() }}';
window.AMRTM_ROUTES = {
    login:        '{{ route("amrtm.login") }}',
    home:         '{{ route("amrtm.index") }}',
    officeReqs:   '{{ url("/amrtm/api/office-requests") }}',
};

let selectedServiceId = null;
let lang = localStorage.getItem('amrtm_lang') || 'ar';

function setLang(l) {
    lang = l;
    localStorage.setItem('amrtm_lang', l);
    document.body.className = l;
    document.getElementById('la').className = 'lt' + (l==='ar'?' on':'');
    document.getElementById('le').className = 'lt' + (l==='en'?' on':'');
    document.documentElement.lang = l;
    document.documentElement.dir  = l === 'ar' ? 'rtl' : 'ltr';
    document.querySelectorAll('[data-ar][data-en]').forEach(el => {
        el.textContent = l === 'ar' ? (el.dataset.ar || '') : (el.dataset.en || el.dataset.ar || '');
    });
}

function openRequestModal(serviceId, nameAr, price) {
    selectedServiceId = serviceId;
    document.getElementById('req-overlay').classList.add('open');
    document.getElementById('svc-info').innerHTML = `
        <div class="svc-sel-name">${nameAr}</div>
        <div class="svc-sel-price">${parseFloat(price).toLocaleString('ar-SA')} ر.س</div>
    `;
    document.getElementById('req-form').style.display = '';
    document.getElementById('req-success').style.display = 'none';
    document.getElementById('modal-foot').style.display = '';
    const btn = document.getElementById('submit-btn');
    if(btn){ btn.disabled = false; btn.innerHTML = '<i class="ti ti-send"></i> إرسال الطلب'; }
}

function closeModal() {
    document.getElementById('req-overlay').classList.remove('open');
    selectedServiceId = null;
}

async function doSubmit() {
    const name  = document.getElementById('f-name').value.trim();
    const phone = document.getElementById('f-phone').value.trim();
    if (!name)  { alert('الاسم مطلوب'); return; }
    if (!phone) { alert('رقم الجوال مطلوب'); return; }

    const btn = document.getElementById('submit-btn');
    btn.disabled = true;
    btn.innerHTML = '<span class="spin"></span> جاري الإرسال...';

    try {
        const res = await fetch(window.AMRTM_ROUTES.officeReqs, {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': window.AMRTM_CSRF,
            },
            body: JSON.stringify({
                office_id:         window.OFFICE_ID,
                office_service_id: selectedServiceId,
                client_name:       name,
                client_phone:      phone,
                client_id_number:  document.getElementById('f-id').value.trim() || null,
                notes:             document.getElementById('f-notes').value.trim() || null,
            }),
        });
        const data = await res.json();
        if (!res.ok) throw data;

        document.getElementById('req-form').style.display = 'none';
        document.getElementById('req-success').style.display = '';
        document.getElementById('success-ref').textContent = data.ref_number;
        document.getElementById('modal-foot').style.display = 'none';
    } catch(e) {
        alert(e.message || 'حدث خطأ. حاول مرة أخرى.');
        btn.disabled = false;
        btn.innerHTML = '<i class="ti ti-send"></i> إرسال الطلب';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const stored = localStorage.getItem('amrtm_lang') || 'ar';
    if (stored !== 'ar') setLang(stored);
});
</script>
</body>
</html>
