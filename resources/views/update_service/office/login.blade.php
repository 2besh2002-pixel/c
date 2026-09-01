<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>دخول المكاتب — آمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Cairo',sans-serif;background:linear-gradient(135deg,#0d1b4b 0%,#1A237E 60%,#283593 100%);min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px}
.card{background:#fff;border-radius:20px;width:100%;max-width:440px;padding:40px 36px;box-shadow:0 24px 64px rgba(0,0,0,.3)}
.logo{text-align:center;margin-bottom:28px}
.logo-icon{width:56px;height:56px;background:linear-gradient(135deg,#1A237E,#3949AB);border-radius:16px;display:inline-flex;align-items:center;justify-content:center;margin-bottom:12px}
.logo-icon i{color:#fff;font-size:28px}
.logo h1{font-size:22px;font-weight:800;color:#1A237E}
.logo p{font-size:13px;color:#666;margin-top:4px}
.tabs{display:flex;gap:6px;background:#F5F5F5;border-radius:12px;padding:5px;margin-bottom:28px}
.tab{flex:1;text-align:center;padding:9px;border-radius:9px;font-size:13px;font-weight:700;cursor:pointer;text-decoration:none;color:#666;transition:.2s}
.tab.active{background:#1A237E;color:#fff}
.fld{margin-bottom:16px}
.fld label{display:block;font-size:13px;font-weight:700;color:#444;margin-bottom:6px}
.fld input,.fld select{width:100%;padding:11px 14px;border:1.5px solid #E0E0E0;border-radius:10px;font-size:14px;font-family:'Cairo',sans-serif;color:#1a1a1a;outline:none;transition:.2s;background:#FAFAFA}
.fld input:focus,.fld select:focus{border-color:#1A237E;background:#fff;box-shadow:0 0 0 3px rgba(26,35,126,.1)}
.fld .err-msg{font-size:12px;color:#C62828;margin-top:4px;display:none}
.fld.has-err input,.fld.has-err select{border-color:#C62828}
.fld.has-err .err-msg{display:block}
.btn-main{width:100%;padding:13px;background:linear-gradient(135deg,#1A237E,#3949AB);color:#fff;border:none;border-radius:12px;font-size:15px;font-weight:700;font-family:'Cairo',sans-serif;cursor:pointer;transition:.2s;margin-top:4px}
.btn-main:hover{transform:translateY(-1px);box-shadow:0 6px 20px rgba(26,35,126,.35)}
.divider{text-align:center;margin:18px 0;color:#AAA;font-size:12px;position:relative}
.divider::before,.divider::after{content:'';position:absolute;top:50%;width:40%;height:1px;background:#E0E0E0}
.divider::before{right:0}.divider::after{left:0}
.link-row{text-align:center;margin-top:16px;font-size:13px;color:#666}
.link-row a{color:#1A237E;font-weight:700;text-decoration:none}
.alert{padding:12px 16px;border-radius:10px;font-size:13px;font-weight:600;margin-bottom:16px;display:flex;align-items:center;gap:8px}
.alert-err{background:rgba(198,40,40,.08);color:#C62828;border:1px solid rgba(198,40,40,.2)}
.alert-ok{background:rgba(27,94,32,.08);color:#1B5E20;border:1px solid rgba(27,94,32,.2)}
.remember{display:flex;align-items:center;gap:8px;font-size:13px;color:#555;cursor:pointer;margin-bottom:16px}
.remember input{width:16px;height:16px;accent-color:#1A237E;cursor:pointer}
</style>
</head>
<body>
<div class="card">
  <div class="logo">
    <div class="logo-icon"><i class="ti ti-building-skyscraper"></i></div>
    <h1>منصة المكاتب المهنية</h1>
    <p>آمر تم — قطاع الأعمال</p>
  </div>

  <!-- Tabs: client / office -->
  <div class="tabs">
    <a class="tab" href="{{ route('amrtm.login') }}">دخول العميل</a>
    <a class="tab active" href="{{ route('amrtm.office.login') }}">دخول المكاتب</a>
  </div>

  @if(session('error'))
    <div class="alert alert-err"><i class="ti ti-alert-circle"></i>{{ session('error') }}</div>
  @endif
  @if(session('success'))
    <div class="alert alert-ok"><i class="ti ti-circle-check"></i>{{ session('success') }}</div>
  @endif

  <form method="POST" action="{{ route('amrtm.office.login.submit') }}">
    @csrf

    <div class="fld {{ $errors->has('email') ? 'has-err' : '' }}">
      <label>البريد الإلكتروني</label>
      <input type="email" name="email" value="{{ old('email') }}" placeholder="office@example.com" autocomplete="email">
      <div class="err-msg">{{ $errors->first('email') }}</div>
    </div>

    <div class="fld {{ $errors->has('password') ? 'has-err' : '' }}">
      <label>كلمة المرور</label>
      <input type="password" name="password" placeholder="••••••••" autocomplete="current-password">
      <div class="err-msg">{{ $errors->first('password') }}</div>
    </div>

    <label class="remember">
      <input type="checkbox" name="remember"> تذكرني
    </label>

    <button type="submit" class="btn-main"><i class="ti ti-login"></i> دخول</button>
  </form>

  <div class="divider">أو</div>

  <div class="link-row">
    ليس لديك حساب؟ <a href="{{ route('amrtm.office.register') }}">سجّل مكتبك الآن</a>
  </div>
  <div class="link-row" style="margin-top:10px">
    <a href="{{ route('amrtm.index') }}" style="color:#888"><i class="ti ti-arrow-right"></i> العودة للمنصة</a>
  </div>
</div>
</body>
</html>