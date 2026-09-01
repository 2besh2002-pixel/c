<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>تسجيل مكتب جديد — آمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Cairo',sans-serif;background:linear-gradient(135deg,#0d1b4b 0%,#1A237E 60%,#283593 100%);min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px}
.card{background:#fff;border-radius:20px;width:100%;max-width:540px;padding:40px 36px;box-shadow:0 24px 64px rgba(0,0,0,.3)}
.logo{text-align:center;margin-bottom:24px}
.logo-icon{width:52px;height:52px;background:linear-gradient(135deg,#1A237E,#3949AB);border-radius:14px;display:inline-flex;align-items:center;justify-content:center;margin-bottom:10px}
.logo-icon i{color:#fff;font-size:26px}
.logo h1{font-size:20px;font-weight:800;color:#1A237E}
.logo p{font-size:12.5px;color:#666;margin-top:3px}
.sec-title{font-size:13px;font-weight:800;color:#1A237E;background:rgba(26,35,126,.06);border-right:3px solid #1A237E;padding:7px 12px;border-radius:6px;margin:20px 0 14px}
.row2{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.fld{margin-bottom:14px}
.fld label{display:block;font-size:12.5px;font-weight:700;color:#444;margin-bottom:5px}
.fld input,.fld select{width:100%;padding:10px 13px;border:1.5px solid #E0E0E0;border-radius:10px;font-size:13.5px;font-family:'Cairo',sans-serif;color:#1a1a1a;outline:none;transition:.2s;background:#FAFAFA}
.fld input:focus,.fld select:focus{border-color:#1A237E;background:#fff;box-shadow:0 0 0 3px rgba(26,35,126,.1)}
.fld .err-msg{font-size:11.5px;color:#C62828;margin-top:3px;display:none}
.fld.has-err input,.fld.has-err select{border-color:#C62828}
.fld.has-err .err-msg{display:block}
.type-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;margin-bottom:14px}
.type-card{border:2px solid #E0E0E0;border-radius:12px;padding:14px 10px;text-align:center;cursor:pointer;transition:.2s;background:#FAFAFA}
.type-card:hover{border-color:#1A237E;background:rgba(26,35,126,.04)}
.type-card.selected{border-color:#1A237E;background:rgba(26,35,126,.07)}
.type-card i{font-size:26px;color:#1A237E;display:block;margin-bottom:6px}
.type-card span{font-size:12px;font-weight:700;color:#333;display:block;line-height:1.4}
.type-card input[type=radio]{display:none}
.btn-main{width:100%;padding:13px;background:linear-gradient(135deg,#1A237E,#3949AB);color:#fff;border:none;border-radius:12px;font-size:15px;font-weight:700;font-family:'Cairo',sans-serif;cursor:pointer;transition:.2s;margin-top:8px}
.btn-main:hover{transform:translateY(-1px);box-shadow:0 6px 20px rgba(26,35,126,.35)}
.link-row{text-align:center;margin-top:14px;font-size:13px;color:#666}
.link-row a{color:#1A237E;font-weight:700;text-decoration:none}
.alert{padding:11px 14px;border-radius:10px;font-size:13px;font-weight:600;margin-bottom:14px;display:flex;align-items:center;gap:8px}
.alert-err{background:rgba(198,40,40,.08);color:#C62828;border:1px solid rgba(198,40,40,.2)}
@media(max-width:480px){.row2{grid-template-columns:1fr}.type-grid{grid-template-columns:1fr 1fr}}
</style>
</head>
<body>
<div class="card">
  <div class="logo">
    <div class="logo-icon"><i class="ti ti-building-skyscraper"></i></div>
    <h1>تسجيل مكتب / شركة جديدة</h1>
    <p>انضم إلى منصة آمر تم المهنية</p>
  </div>

  @if($errors->any())
    <div class="alert alert-err"><i class="ti ti-alert-circle"></i>{{ $errors->first() }}</div>
  @endif

  <form method="POST" action="{{ route('amrtm.office.register.submit') }}">
    @csrf

    <div class="sec-title"><i class="ti ti-building"></i> نوع المكتب / الشركة</div>
    <div class="type-grid">
      <label class="type-card {{ old('type') === 'law' ? 'selected' : '' }}">
        <input type="radio" name="type" value="law" {{ old('type') === 'law' ? 'checked' : '' }} onchange="selType(this)">
        <i class="ti ti-scale"></i>
        <span>مكتب محاماة</span>
      </label>
      <label class="type-card {{ old('type') === 'services' ? 'selected' : '' }}">
        <input type="radio" name="type" value="services" {{ old('type') === 'services' ? 'checked' : '' }} onchange="selType(this)">
        <i class="ti ti-briefcase"></i>
        <span>خدمات وتعقيب</span>
      </label>
      <label class="type-card {{ old('type') === 'customs' ? 'selected' : '' }}">
        <input type="radio" name="type" value="customs" {{ old('type') === 'customs' ? 'checked' : '' }} onchange="selType(this)">
        <i class="ti ti-truck"></i>
        <span>تخليص جمركي</span>
      </label>
    </div>

    <div class="sec-title"><i class="ti ti-info-circle"></i> بيانات المكتب</div>
    <div class="row2">
      <div class="fld {{ $errors->has('office_name_ar') ? 'has-err' : '' }}">
        <label>الاسم بالعربية *</label>
        <input type="text" name="office_name_ar" value="{{ old('office_name_ar') }}" placeholder="مكتب النور للمحاماة">
        <div class="err-msg">{{ $errors->first('office_name_ar') }}</div>
      </div>
      <div class="fld {{ $errors->has('office_name_en') ? 'has-err' : '' }}">
        <label>الاسم بالإنجليزية *</label>
        <input type="text" name="office_name_en" value="{{ old('office_name_en') }}" placeholder="Al-Noor Law Firm">
        <div class="err-msg">{{ $errors->first('office_name_en') }}</div>
      </div>
    </div>
    <div class="row2">
      <div class="fld {{ $errors->has('phone') ? 'has-err' : '' }}">
        <label>رقم الجوال *</label>
        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="05xxxxxxxx">
        <div class="err-msg">{{ $errors->first('phone') }}</div>
      </div>
      <div class="fld {{ $errors->has('city') ? 'has-err' : '' }}">
        <label>المدينة</label>
        <input type="text" name="city" value="{{ old('city') }}" placeholder="جدة">
        <div class="err-msg">{{ $errors->first('city') }}</div>
      </div>
    </div>
    <div class="fld {{ $errors->has('cr_number') ? 'has-err' : '' }}">
      <label>رقم السجل التجاري (اختياري)</label>
      <input type="text" name="cr_number" value="{{ old('cr_number') }}" placeholder="10xxxxxxxxx">
      <div class="err-msg">{{ $errors->first('cr_number') }}</div>
    </div>

    <div class="sec-title"><i class="ti ti-user"></i> بيانات المسؤول</div>
    <div class="fld {{ $errors->has('name') ? 'has-err' : '' }}">
      <label>الاسم الكامل *</label>
      <input type="text" name="name" value="{{ old('name') }}" placeholder="اسم صاحب المكتب">
      <div class="err-msg">{{ $errors->first('name') }}</div>
    </div>
    <div class="fld {{ $errors->has('email') ? 'has-err' : '' }}">
      <label>البريد الإلكتروني *</label>
      <input type="email" name="email" value="{{ old('email') }}" placeholder="office@example.com">
      <div class="err-msg">{{ $errors->first('email') }}</div>
    </div>
    <div class="row2">
      <div class="fld {{ $errors->has('password') ? 'has-err' : '' }}">
        <label>كلمة المرور *</label>
        <input type="password" name="password" placeholder="8 أحرف على الأقل">
        <div class="err-msg">{{ $errors->first('password') }}</div>
      </div>
      <div class="fld">
        <label>تأكيد كلمة المرور *</label>
        <input type="password" name="password_confirmation" placeholder="أعد كتابة المرور">
      </div>
    </div>

    <button type="submit" class="btn-main"><i class="ti ti-send"></i> إرسال طلب التسجيل</button>
  </form>

  <div class="link-row">
    لديك حساب بالفعل؟ <a href="{{ route('amrtm.office.login') }}">تسجيل الدخول</a>
  </div>
</div>

<script>
function selType(radio) {
  document.querySelectorAll('.type-card').forEach(c => c.classList.remove('selected'));
  radio.closest('.type-card').classList.add('selected');
}
</script>
</body>
</html>