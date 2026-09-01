<!DOCTYPE html>
@php $locale = app()->getLocale(); $dir = $locale === 'ar' ? 'rtl' : 'ltr'; @endphp
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب — آمر تم للأعمال</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Cairo', sans-serif;
            min-height: 100vh;
            background: linear-gradient(160deg, #0d1f3c 0%, #1a3460 50%, #0d1f3c 100%);
            display: flex; align-items: center; justify-content: center;
            padding: 20px;
        }

        .auth-card {
            position: relative; z-index: 10;
            display: flex; width: 100%; max-width: 960px;
            border-radius: 28px; overflow: hidden;
            box-shadow: 0 40px 100px rgba(0,0,0,0.55);
            border: 1.5px solid rgba(56,189,248,0.18);
        }

        .brand-panel {
            width: 300px; flex-shrink: 0;
            background: linear-gradient(160deg, rgba(14,165,233,0.18) 0%, rgba(59,130,246,0.18) 100%),
                        rgba(10,25,55,0.95);
            backdrop-filter: blur(20px);
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            padding: 52px 32px; position: relative; overflow: hidden;
        }
        .brand-panel::before {
            content: ''; position: absolute; top: -80px; right: -80px;
            width: 300px; height: 300px; border-radius: 50%;
            background: rgba(56,189,248,0.07);
        }
        .brand-panel::after {
            content: ''; position: absolute; bottom: -60px; left: -60px;
            width: 220px; height: 220px; border-radius: 50%;
            background: rgba(59,130,246,0.08);
        }
        .brand-logo-wrap {
            position: relative; z-index: 1;
            width: 100px; height: 100px; border-radius: 50%;
            background: rgba(255,255,255,0.07);
            border: 2px solid rgba(56,189,248,0.3);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 24px; backdrop-filter: blur(8px);
        }
        .brand-logo-wrap img { width: 72px; height: 72px; object-fit: contain; }
        .brand-panel h2 {
            position: relative; z-index: 1;
            color: #fff; font-size: 22px; font-weight: 800;
            text-align: center; line-height: 1.4; margin-bottom: 8px;
        }
        .brand-panel h2 span {
            background: linear-gradient(135deg, #38bdf8, #60a5fa);
            -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent;
        }
        .brand-panel p {
            position: relative; z-index: 1;
            color: rgba(255,255,255,0.5); font-size: 13px;
            text-align: center; line-height: 1.8; max-width: 200px;
        }
        .brand-steps {
            position: relative; z-index: 1; margin-top: 24px;
            display: flex; flex-direction: column; gap: 12px; width: 100%;
        }
        .brand-step {
            display: flex; align-items: flex-start; gap: 10px;
            font-size: 12.5px; color: rgba(255,255,255,0.6);
        }
        .step-num {
            width: 22px; height: 22px; border-radius: 50%; flex-shrink: 0;
            background: rgba(56,189,248,0.2); border: 1px solid rgba(56,189,248,0.4);
            color: #38bdf8; font-size: 11px; font-weight: 800;
            display: flex; align-items: center; justify-content: center;
        }

        .form-panel {
            flex: 1; min-width: 0;
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(24px);
            border-right: 1.5px solid rgba(56,189,248,0.12);
            display: flex; flex-direction: column;
            padding: 40px 40px;
        }

        .auth-tabs {
            display: flex; border-radius: 50px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            padding: 4px; margin-bottom: 28px; gap: 4px;
        }
        .auth-tab {
            flex: 1; text-align: center; padding: 9px 10px;
            border-radius: 50px; font-size: 14px; font-weight: 700;
            cursor: pointer; text-decoration: none;
            color: rgba(255,255,255,0.5); transition: all 0.25s;
        }
        .auth-tab.active {
            background: linear-gradient(135deg, #0ea5e9, #3b82f6);
            color: #fff; box-shadow: 0 4px 14px rgba(14,165,233,0.3);
        }
        .auth-tab:not(.active):hover { color: #fff; background: rgba(255,255,255,0.08); }

        .form-title { font-size: 20px; font-weight: 800; color: #fff; margin-bottom: 4px; }
        .form-subtitle { font-size: 13px; color: rgba(255,255,255,0.4); margin-bottom: 22px; }

        .alert {
            padding: 12px 14px; border-radius: 12px; font-size: 13px; font-weight: 600;
            margin-bottom: 16px; display: flex; align-items: center; gap: 9px;
        }
        .alert-danger  { background: rgba(239,68,68,0.15); color: #fca5a5; border: 1px solid rgba(239,68,68,0.3); }
        .alert-success { background: rgba(74,222,128,0.12); color: #86efac; border: 1px solid rgba(74,222,128,0.25); }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

        .form-group { margin-bottom: 14px; }
        .form-label { display: block; font-size: 13px; font-weight: 700; color: rgba(255,255,255,0.7); margin-bottom: 6px; }
        .input-wrap { position: relative; }
        .input-wrap > i {
            position: absolute; right: 14px; top: 50%;
            transform: translateY(-50%); color: rgba(255,255,255,0.3);
            font-size: 14px; pointer-events: none;
        }
        .form-control {
            width: 100%; padding: 11px 42px 11px 14px;
            background: rgba(255,255,255,0.06);
            border: 1.5px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            font-family: 'Cairo', sans-serif; font-size: 14px;
            color: #fff; outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-control::placeholder { color: rgba(255,255,255,0.25); }
        .form-control:focus { border-color: #38bdf8; box-shadow: 0 0 0 3px rgba(56,189,248,0.12); }
        .form-control.is-invalid { border-color: #f87171; }
        .invalid-feedback { color: #fca5a5; font-size: 12px; margin-top: 4px; display: flex; align-items: center; gap: 5px; }

        .toggle-pw {
            position: absolute; left: 12px; top: 50%;
            transform: translateY(-50%); background: none; border: none;
            cursor: pointer; color: rgba(255,255,255,0.3); font-size: 14px;
            padding: 2px; transition: color 0.2s;
        }
        .toggle-pw:hover { color: #38bdf8; }

        .terms-row {
            display: flex; align-items: flex-start; gap: 8px;
            margin-bottom: 20px; font-size: 12.5px; color: rgba(255,255,255,0.5);
            cursor: pointer; user-select: none;
        }
        .terms-row input[type="checkbox"] { accent-color: #38bdf8; width: 16px; height: 16px; flex-shrink: 0; margin-top: 1px; }
        .terms-row a { color: #38bdf8; text-decoration: none; font-weight: 700; }
        .terms-row a:hover { text-decoration: underline; }
        .invalid-feedback.terms-err { display: block; margin-top: -12px; margin-bottom: 14px; }

        .btn-submit {
            width: 100%; padding: 13px; border: none; border-radius: 14px;
            background: linear-gradient(135deg, #0ea5e9, #3b82f6);
            color: #fff; font-family: 'Cairo', sans-serif;
            font-size: 15px; font-weight: 800; cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 10px;
            transition: opacity 0.2s, transform 0.15s;
            box-shadow: 0 8px 24px rgba(14,165,233,0.3);
        }
        .btn-submit:hover { opacity: 0.88; transform: translateY(-1px); }

        .form-footer {
            text-align: center; margin-top: 16px;
            font-size: 13px; color: rgba(255,255,255,0.4);
        }
        .form-footer a { color: #38bdf8; font-weight: 700; text-decoration: none; }
        .form-footer a:hover { text-decoration: underline; }

        .back-home {
            position: fixed; top: 20px; right: 24px; z-index: 100;
            display: flex; align-items: center; gap: 7px;
            color: rgba(255,255,255,0.5); font-size: 13px; font-weight: 700;
            text-decoration: none; transition: color 0.2s;
            font-family: 'Cairo', sans-serif;
        }
        .back-home:hover { color: #38bdf8; }

        @media (max-width: 760px) {
            .auth-card { flex-direction: column-reverse; }
            .brand-panel { width: 100%; padding: 24px; flex-direction: row; justify-content: center; gap: 16px; }
            .brand-logo-wrap { width: 60px; height: 60px; margin-bottom: 0; }
            .brand-logo-wrap img { width: 42px; height: 42px; }
            .brand-panel h2 { font-size: 16px; margin-bottom: 0; }
            .brand-panel p, .brand-steps, .brand-panel::before, .brand-panel::after { display: none; }
            .form-panel { padding: 28px 20px; border-right: none; border-bottom: 1.5px solid rgba(56,189,248,0.12); }
            .form-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<a href="{{ route('amrtm.index') }}" class="back-home">
    <i class="fa fa-arrow-right"></i>
    العودة لمنصة آمر تم
</a>

<div class="auth-card">

    <!-- FORM PANEL -->
    <div class="form-panel">
        <div class="auth-tabs">
            <a href="{{ route('amrtm.login') }}" class="auth-tab">تسجيل الدخول</a>
            <a href="{{ route('amrtm.register') }}" class="auth-tab active">حساب جديد</a>
        </div>

        <h1 class="form-title">إنشاء حساب في منصة آمر تم</h1>
        <p class="form-subtitle">أدخل بياناتك لبدء استخدام خدمات الأعمال</p>

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('amrtm.register') }}">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="name">الاسم الكامل</label>
                    <div class="input-wrap">
                        <i class="fas fa-user"></i>
                        <input type="text" id="name" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" placeholder="محمد أحمد"
                               required autofocus autocomplete="name">
                    </div>
                    @error('name')
                        <div class="invalid-feedback"><i class="fa fa-circle-exclamation"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="phone">رقم الجوال</label>
                    <div class="input-wrap">
                        <i class="fas fa-phone"></i>
                        <input type="tel" id="phone" name="phone"
                               class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone') }}" placeholder="05xxxxxxxx"
                               required autocomplete="tel">
                    </div>
                    @error('phone')
                        <div class="invalid-feedback"><i class="fa fa-circle-exclamation"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="email">البريد الإلكتروني</label>
                <div class="input-wrap">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="email" name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}" placeholder="example@email.com"
                           required autocomplete="email">
                </div>
                @error('email')
                    <div class="invalid-feedback"><i class="fa fa-circle-exclamation"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="password">كلمة المرور</label>
                    <div class="input-wrap">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="8 أحرف على الأقل" required autocomplete="new-password">
                        <button type="button" class="toggle-pw" onclick="togglePw('password','pw-icon')">
                            <i id="pw-icon" class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback"><i class="fa fa-circle-exclamation"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_confirmation">تأكيد كلمة المرور</label>
                    <div class="input-wrap">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="form-control" placeholder="أعد كتابة كلمة المرور"
                               required autocomplete="new-password">
                        <button type="button" class="toggle-pw" onclick="togglePw('password_confirmation','pw-icon2')">
                            <i id="pw-icon2" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-user-plus"></i>
                إنشاء الحساب والبدء
            </button>
        </form>

        <div class="form-footer">
            لديك حساب بالفعل؟
            <a href="{{ route('amrtm.login') }}">تسجيل الدخول</a>
        </div>
    </div>

    <!-- BRAND PANEL -->
    <div class="brand-panel">
        <div class="brand-logo-wrap">
            <img src="{{ asset('images/new-logo1.png') }}" alt="آمر تم">
        </div>
        <h2>انضم إلى<br><span>آمر تم</span></h2>
        <p>ابدأ رحلتك في إنجاز خدمات الأعمال بخطوات بسيطة</p>
        <div class="brand-steps">
            <div class="brand-step"><div class="step-num">1</div><span>أنشئ حسابك في أقل من دقيقة</span></div>
            <div class="brand-step"><div class="step-num">2</div><span>اختر الخدمة الحكومية المطلوبة</span></div>
            <div class="brand-step"><div class="step-num">3</div><span>قدّم طلبك وتابع حالته لحظة بلحظة</span></div>
        </div>
    </div>

</div>

<script>
function togglePw(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon  = document.getElementById(iconId);
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}
</script>

</body>
</html>
