@php
    $authMode = old('_auth_mode', request()->query('mode', 'login'));
    $registerType = old('_register_type', request()->query('register_type', ''));

    // الوضع الافتراضي عند فتح الصفحة
    if (!in_array($authMode, ['login', 'register'])) {
        $authMode = 'login';
    }
@endphp

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="color-scheme" content="dark">

    <title>تسجيل الدخول — آمر تم</title>

    <link rel="icon"
          type="image/png"
          href="{{ asset('images/new-logo1.png') }}">

    <!-- Cairo -->
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


<style>
/* =========================================================
   RESET
========================================================= */

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

html {
    scroll-behavior: smooth;
}

body {
    font-family: 'Cairo', sans-serif;
    min-height: 100vh;

    background:
        radial-gradient(
            circle at 10% 15%,
            rgba(45, 154, 145, 0.08),
            transparent 25%
        ),
        radial-gradient(
            circle at 90% 85%,
            rgba(25, 111, 104, 0.07),
            transparent 30%
        ),
        linear-gradient(
            135deg,
            #ffffff 0%,
            #f8fcfb 50%,
            #edf7f5 100%
        ),
        url('/images/amrtm background.svg');

    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 35px 20px;

    color: #193f3b;

    position: relative;
    overflow-x: hidden;
}

body::before {
    content: "";

    position: fixed;
    inset: 0;

    background:
        linear-gradient(
            rgba(255,255,255,.88),
            rgba(255,255,255,.88)
        );

    pointer-events: none;
    z-index: -1;
}


/* =========================================================
   BACK HOME
========================================================= */

.back-home {
    position: fixed;

    top: 18px;
    right: 25px;

    color: #214b47;

    text-decoration: none;

    font-size: 13px;
    font-weight: 800;

    display: flex;
    align-items: center;

    gap: 8px;

    z-index: 100;

    transition:
        color .2s ease,
        transform .2s ease;
}

.back-home:hover {
    color: #258f87;

    transform: translateX(2px);
}


/* =========================================================
   MAIN CARD
========================================================= */

.auth-card {
    width: 100%;
    max-width: 1050px;

    min-height: 650px;

    display: flex;

    background:
        linear-gradient(
            145deg,
            #236f69 0%,
            #287a73 45%,
            #226963 100%
        );

    border-radius: 28px;

    overflow: hidden;

    border:
        1px solid rgba(28, 111, 103, .35);

    box-shadow:
        0 35px 90px rgba(26, 77, 73, .18),
        0 15px 35px rgba(26, 77, 73, .10);

    position: relative;
}


/* subtle main decoration */

.auth-card::before {
    content: "";

    position: absolute;

    width: 420px;
    height: 420px;

    top: -260px;
    right: -180px;

    border-radius: 50%;

    background:
        rgba(255,255,255,.045);

    pointer-events: none;
}

.auth-card::after {
    content: "";

    position: absolute;

    width: 300px;
    height: 300px;

    bottom: -210px;
    left: 30%;

    border-radius: 50%;

    background:
        rgba(255,255,255,.035);

    pointer-events: none;
}


/* =========================================================
   FORM PANEL
========================================================= */

.form-panel {
    flex: 1;

    min-width: 0;

    padding: 42px 48px;

    background:
        linear-gradient(
            145deg,
            #226e68 0%,
            #2b8179 52%,
            #256f69 100%
        );

    overflow-y: auto;

    max-height: 90vh;

    position: relative;
}


/* soft light */

.form-panel::before {
    content: "";

    position: absolute;

    width: 340px;
    height: 340px;

    top: -220px;
    right: -160px;

    border-radius: 50%;

    background:
        rgba(255,255,255,.045);

    pointer-events: none;
}


/* =========================================================
   BRAND PANEL
========================================================= */

.brand-panel {
    width: 35%;

    flex-shrink: 0;

    background:
        linear-gradient(
            160deg,
            #ffffff 0%,
            #f7fcfb 52%,
            #edf7f5 100%
        );

    position: relative;

    overflow: hidden;

    display: flex;

    flex-direction: column;

    align-items: center;

    justify-content: center;

    padding: 45px 30px;

    text-align: center;

    border-left:
        1px solid rgba(38, 121, 114, .10);
}


/* =========================================================
   BRAND DECORATIVE CIRCLES
========================================================= */

.brand-panel::before {
    content: '';

    position: absolute;

    width: 350px;
    height: 350px;

    top: -180px;
    right: -160px;

    border-radius: 50%;

    background:
        rgba(45, 154, 145, .07);
}

.brand-panel::after {
    content: '';

    position: absolute;

    width: 290px;
    height: 290px;

    bottom: -150px;
    left: -130px;

    border-radius: 50%;

    background:
        rgba(45, 154, 145, .055);
}


/* =========================================================
   LOGO
========================================================= */

.brand-logo-wrap {
    position: relative;

    z-index: 2;

    width: 155px;
    height: 155px;

    border-radius: 50%;

    display: flex;

    align-items: center;
    justify-content: center;

    background: #ffffff;

    border:
        1px solid rgba(45, 154, 145, .22);

    box-shadow:
        0 18px 45px rgba(33, 102, 96, .12);

    margin-bottom: 25px;

    transition:
        transform .25s ease,
        box-shadow .25s ease;
}

.brand-logo-wrap:hover {
    transform: translateY(-3px);

    box-shadow:
        0 22px 50px rgba(33, 102, 96, .16);
}

.brand-logo-wrap img {
    width: 120px;
    height: 120px;

    object-fit: contain;
}


/* =========================================================
   BRAND TEXT
========================================================= */

.brand-panel h2 {
    position: relative;

    z-index: 2;

    color: #19433f;

    font-size: 27px;

    font-weight: 800;

    line-height: 1.65;

    margin-bottom: 10px;
}

.brand-panel h2 span {
    color: #258f87;

    text-shadow:
        0 4px 18px rgba(45, 154, 145, .12);
}

.brand-panel p {
    position: relative;

    z-index: 2;

    color: #657e7a;

    font-size: 13px;

    line-height: 2;

    max-width: 250px;
}


/* =========================================================
   BRAND BADGE
========================================================= */

.brand-badge {
    position: relative;

    z-index: 2;

    margin-top: 25px;

    display: flex;

    align-items: center;
    justify-content: center;

    gap: 8px;

    padding: 9px 18px;

    border-radius: 30px;

    color: #247f78;

    font-size: 12px;

    font-weight: 800;

    background:
        rgba(45, 154, 145, .07);

    border:
        1px solid rgba(45, 154, 145, .20);
}


/* =========================================================
   AUTH TABS
========================================================= */

.auth-tabs {
    width: 100%;

    display: flex;

    padding: 4px;

    border-radius: 50px;

    background:
        rgba(255, 255, 255, .075);

    border:
        1px solid rgba(255, 255, 255, .18);

    margin-bottom: 32px;

    box-shadow:
        inset 0 1px 0 rgba(255,255,255,.05);
}

.auth-tab {
    flex: 1;

    border: none;

    background: transparent;

    color:
        rgba(255, 255, 255, .62);

    padding: 13px 10px;

    border-radius: 50px;

    font-family: 'Cairo', sans-serif;

    font-size: 14px;

    font-weight: 800;

    cursor: pointer;

    transition:
        color .25s ease,
        background .25s ease,
        box-shadow .25s ease,
        transform .2s ease;
}

.auth-tab:hover {
    color: #ffffff;

    background:
        rgba(255,255,255,.05);
}

.auth-tab.active {
    color: #ffffff;

    background:
        linear-gradient(
            135deg,
            #55b7ad 0%,
            #43a59c 100%
        );

    box-shadow:
        0 7px 20px rgba(19, 78, 74, .22),
        inset 0 1px 0 rgba(255,255,255,.18);
}


/* =========================================================
   TITLES
========================================================= */

.form-title {
    color: #ffffff;

    font-size: 27px;

    font-weight: 800;

    margin-bottom: 7px;

    line-height: 1.5;
}

.form-subtitle {
    color:
        rgba(255, 255, 255, .68);

    font-size: 13px;

    margin-bottom: 27px;

    line-height: 1.9;
}


/* =========================================================
   REGISTER CHOICE
========================================================= */

.register-choice {
    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 15px;

    margin-bottom: 25px;
}


/* =========================================================
   REGISTER CARD
========================================================= */

.register-card {
    display: block;

    text-decoration: none;

    color: inherit;

    border:
        1px solid rgba(255, 255, 255, .20);

    background:
        rgba(255, 255, 255, .085);

    border-radius: 17px;

    padding: 20px;

    cursor: pointer;

    text-align: right;

    transition:
        transform .25s ease,
        border-color .25s ease,
        background .25s ease,
        box-shadow .25s ease;

    min-height: 145px;

    position: relative;

    overflow: hidden;

    backdrop-filter: blur(8px);
}


/* card decoration */

.register-card::before {
    content: '';

    position: absolute;

    width: 110px;
    height: 110px;

    left: -40px;
    bottom: -50px;

    border-radius: 50%;

    background:
        rgba(255, 255, 255, .075);

    transition:
        transform .3s ease;
}

.register-card::after {
    content: '';

    position: absolute;

    width: 70px;
    height: 70px;

    right: -35px;
    top: -35px;

    border-radius: 50%;

    background:
        rgba(255,255,255,.025);
}

.register-card:hover {
    border-color:
        rgba(255, 255, 255, .42);

    background:
        rgba(255, 255, 255, .125);

    transform:
        translateY(-4px);

    box-shadow:
        0 16px 35px rgba(20, 70, 66, .20);
}

.register-card:hover::before {
    transform:
        scale(1.5);
}

.register-card.active {
    border-color:
        rgba(255, 255, 255, .65);

    background:
        rgba(255, 255, 255, .14);

    box-shadow:
        0 0 0 2px
        rgba(255,255,255,.08),
        0 14px 30px rgba(20, 70, 66, .16);
}


/* =========================================================
   REGISTER ICON
========================================================= */

.register-card-icon {
    width: 46px;
    height: 46px;

    border-radius: 13px;

    display: flex;

    align-items: center;
    justify-content: center;

    background:
        rgba(255, 255, 255, .12);

    color:
        rgba(255, 255, 255, .82);

    font-size: 18px;

    margin-bottom: 13px;

    transition:
        background .25s ease,
        color .25s ease,
        transform .25s ease;
}

.register-card:hover .register-card-icon,
.register-card.active .register-card-icon {
    background:
        rgba(255, 255, 255, .20);

    color: #ffffff;

    transform:
        translateY(-2px);
}


/* =========================================================
   REGISTER TEXT
========================================================= */

.register-card strong {
    display: block;

    color: #ffffff;

    font-size: 14px;

    margin-bottom: 5px;

    font-weight: 800;
}

.register-card small {
    display: block;

    color:
        rgba(255, 255, 255, .62);

    font-size: 11px;

    line-height: 1.7;
}


/* =========================================================
   BACK REGISTER
========================================================= */

.back-register {
    display: none;

    border: none;

    background: transparent;

    color: #b9ebe6;

    font-family: 'Cairo', sans-serif;

    font-size: 12px;

    font-weight: 800;

    cursor: pointer;

    margin-bottom: 18px;

    padding: 0;

    transition:
        color .2s ease;
}

.back-register:hover {
    color: #ffffff;
}


/* =========================================================
   FORMS
========================================================= */

.auth-form {
    display: none;
}

.auth-form.active {
    display: block;
}


/* =========================================================
   FORM ROW
========================================================= */

.form-row {
    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 15px;
}


/* =========================================================
   FORM GROUP
========================================================= */

.form-group {
    margin-bottom: 16px;
}


/* =========================================================
   LABEL
========================================================= */

.form-label {
    display: block;

    color:
        rgba(255, 255, 255, .90);

    font-size: 12.5px;

    font-weight: 800;

    margin-bottom: 9px;
}


/* =========================================================
   INPUT WRAP
========================================================= */

.input-wrap {
    position: relative;
}


/* =========================================================
   INPUT ICON
========================================================= */

.input-icon {
    position: absolute;

    right: 15px;

    top: 50%;

    transform:
        translateY(-50%);

    color:
        #9ee0da;

    pointer-events: none;

    z-index: 2;

    font-size: 14px;
}


/* =========================================================
   FORM CONTROL
========================================================= */

.form-control {
    width: 100%;

    min-height: 52px;

    padding:
        12px 48px 12px 45px;

    border-radius: 13px;

    border:
        1px solid rgba(255, 255, 255, .18);

    outline: none;

    background:
        rgba(255, 255, 255, .085);

    color: #ffffff;

    font-family: 'Cairo', sans-serif;

    font-size: 13px;

    font-weight: 600;

    transition:
        border-color .2s ease,
        background .2s ease,
        box-shadow .2s ease,
        transform .2s ease;
}

.form-control:hover {
    background:
        rgba(255, 255, 255, .115);

    border-color:
        rgba(255, 255, 255, .30);
}

.form-control:focus {
    border-color:
        #8edbd4;

    background:
        rgba(255, 255, 255, .13);

    box-shadow:
        0 0 0 3px
        rgba(142, 219, 212, .13);
}

.form-control::placeholder {
    color:
        rgba(255, 255, 255, .45);
}


/* =========================================================
   PASSWORD TOGGLE
========================================================= */

.toggle-pw {
    position: absolute;

    left: 12px;

    top: 50%;

    transform:
        translateY(-50%);

    background: none;

    border: none;

    color:
        rgba(255, 255, 255, .48);

    cursor: pointer;

    width: 30px;
    height: 30px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 7px;

    transition:
        color .2s ease,
        background .2s ease;
}

.toggle-pw:hover {
    color: #ffffff;

    background:
        rgba(255, 255, 255, .08);
}


/* =========================================================
   SECTION TITLE
========================================================= */

.section-title {
    display: flex;

    align-items: center;

    gap: 9px;

    color: #b8e8e3;

    font-size: 13px;

    font-weight: 800;

    margin:
        20px 0 16px;

    padding-bottom: 9px;

    border-bottom:
        1px solid
        rgba(255, 255, 255, .12);
}

.section-title i {
    width: 27px;
    height: 27px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 8px;

    background:
        rgba(255, 255, 255, .09);

    color: #b8e8e3;

    font-size: 12px;
}


/* =========================================================
   ALERT
========================================================= */

.alert {
    padding: 11px 13px;

    border-radius: 11px;

    margin-bottom: 16px;

    font-size: 12px;

    display: flex;

    align-items: center;

    gap: 8px;

    line-height: 1.7;
}

.alert-danger {
    color: #fecaca;

    background:
        rgba(239, 68, 68, .13);

    border:
        1px solid
        rgba(239, 68, 68, .25);
}

.alert-success {
    color: #bbf7d0;

    background:
        rgba(34, 197, 94, .11);

    border:
        1px solid
        rgba(34, 197, 94, .20);
}


/* =========================================================
   REMEMBER / TERMS
========================================================= */

.remember {
    display: flex;

    align-items: center;

    gap: 8px;

    color:
        rgba(255, 255, 255, .65);

    font-size: 11.5px;

    margin-bottom: 18px;

    line-height: 1.7;
}

.remember input {
    width: 16px;
    height: 16px;

    flex-shrink: 0;

    accent-color: #78cec6;

    cursor: pointer;
}


/* =========================================================
   SUBMIT BUTTON
========================================================= */

.btn-submit {
    width: 100%;

    border: none;

    border-radius: 13px;

    min-height: 53px;

    padding: 13px;

    background:
        linear-gradient(
            135deg,
            #63c4ba 0%,
            #43a79d 48%,
            #348f87 100%
        );

    color: #ffffff;

    font-family: 'Cairo', sans-serif;

    font-size: 14px;

    font-weight: 800;

    cursor: pointer;

    display: flex;

    align-items: center;
    justify-content: center;

    gap: 9px;

    border:
        1px solid rgba(255,255,255,.12);

    box-shadow:
        0 10px 28px
        rgba(17, 75, 70, .25),
        inset 0 1px 0 rgba(255,255,255,.14);

    transition:
        transform .2s ease,
        opacity .2s ease,
        box-shadow .2s ease;
}

.btn-submit:hover {
    transform:
        translateY(-2px);

    opacity: .97;

    box-shadow:
        0 14px 34px
        rgba(17, 75, 70, .32),
        inset 0 1px 0 rgba(255,255,255,.16);
}

.btn-submit:active {
    transform:
        translateY(0);
}


/* =========================================================
   SECURITY NOTE
========================================================= */

.security-note {
    display: flex;

    align-items: center;
    justify-content: center;

    gap: 6px;

    color:
        rgba(255, 255, 255, .43);

    font-size: 10.5px;

    margin-top: 11px;
}

.security-note i {
    color: #9ee0da;
}


/* =========================================================
   INVALID
========================================================= */

.invalid-feedback {
    color: #fecaca;

    font-size: 11px;

    margin-top: 5px;

    line-height: 1.6;
}


/* =========================================================
   AUTOFILL
========================================================= */

input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus {
    -webkit-text-fill-color: #ffffff;

    -webkit-box-shadow:
        0 0 0 1000px #286f69 inset;

    transition:
        background-color 9999s ease-in-out 0s;
}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 900px) {

    body {
        padding: 25px 15px;
    }

    .auth-card {
        max-width: 760px;
    }

    .brand-panel {
        width: 31%;
    }

    .form-panel {
        padding: 35px 32px;
    }

    .brand-logo-wrap {
        width: 120px;
        height: 120px;
    }

    .brand-logo-wrap img {
        width: 90px;
        height: 90px;
    }

    .brand-panel h2 {
        font-size: 22px;
    }
}


/* =========================================================
   MOBILE / SMALL TABLET
========================================================= */

@media (max-width: 760px) {

    body {
        padding:
            60px 12px 20px;

        align-items:
            flex-start;

        background:
            linear-gradient(
                rgba(255,255,255,.90),
                rgba(255,255,255,.90)
            ),
            url('/images/amrtm background.svg')
            center center / cover no-repeat fixed;
    }

    .back-home {
        top: 18px;
        right: 15px;

        font-size: 12px;
    }

    .auth-card {
        flex-direction: column;

        max-width: 600px;

        min-height: auto;

        border-radius: 22px;
    }

    .brand-panel {
        width: 100%;

        min-height: 205px;

        padding: 25px 20px;
    }

    .brand-logo-wrap {
        width: 82px;
        height: 82px;

        margin-bottom: 10px;
    }

    .brand-logo-wrap img {
        width: 62px;
        height: 62px;
    }

    .brand-panel h2 {
        font-size: 19px;

        line-height: 1.5;

        margin-bottom: 0;
    }

    .brand-panel p,
    .brand-badge {
        display: none;
    }

    .form-panel {
        max-height: none;

        overflow: visible;

        padding:
            25px 20px 30px;
    }

    .form-title {
        font-size: 22px;
    }

    .form-subtitle {
        font-size: 12px;
    }

    .register-choice {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 10px;
    }

    .register-card {
        min-height: 135px;

        padding: 15px;
    }

    .register-card strong {
        font-size: 13px;
    }

    .register-card small {
        font-size: 10px;
    }
}


/* =========================================================
   MOBILE PHONE
========================================================= */

@media (max-width: 520px) {

    body {
        padding:
            58px 9px 15px;
    }

    .auth-card {
        width: 100%;

        border-radius: 19px;
    }

    .brand-panel {
        min-height: 175px;

        padding:
            20px 15px;
    }

    .brand-logo-wrap {
        width: 70px;
        height: 70px;

        margin-bottom: 7px;
    }

    .brand-logo-wrap img {
        width: 53px;
        height: 53px;
    }

    .brand-panel h2 {
        font-size: 17px;
    }

    .form-panel {
        padding:
            22px 14px 25px;
    }

    .auth-tabs {
        margin-bottom: 24px;
    }

    .auth-tab {
        font-size: 12px;

        padding:
            10px 7px;
    }

    .form-title {
        font-size: 20px;
    }

    .form-subtitle {
        font-size: 11px;

        margin-bottom: 20px;
    }

    .register-choice {
        grid-template-columns: 1fr;

        gap: 10px;
    }

    .register-card {
        min-height: 115px;

        padding: 14px;
    }

    .register-card-icon {
        width: 40px;
        height: 40px;

        font-size: 16px;

        margin-bottom: 9px;
    }

    .form-row {
        grid-template-columns: 1fr;

        gap: 0;
    }

    .form-group {
        margin-bottom: 14px;
    }

    .form-label {
        font-size: 12px;
    }

    .form-control {
        min-height: 47px;

        font-size: 12px;

        padding:
            11px 40px 11px 40px;
    }

    .section-title {
        font-size: 12px;

        margin-top: 17px;
    }

    .btn-submit {
        min-height: 48px;

        font-size: 13px;
    }

    .remember {
        font-size: 10.5px;
    }
}


/* =========================================================
   VERY SMALL PHONES
========================================================= */

@media (max-width: 360px) {

    body {
        padding-left: 6px;
        padding-right: 6px;
    }

    .form-panel {
        padding-left: 11px;
        padding-right: 11px;
    }

    .auth-tab {
        font-size: 11px;
    }

    .form-title {
        font-size: 18px;
    }

    .form-control {
        font-size: 11px;
    }

    .btn-submit {
        font-size: 12px;
    }
}

</style>

</head>


<body>


<!-- =========================================================
     BACK HOME
========================================================= -->

<a href="{{ route('amrtm.index') }}"
   class="back-home">

    <i class="fa fa-arrow-right"></i>

    العودة للمنصة

</a>


<!-- =========================================================
     MAIN CARD
========================================================= -->

<div class="auth-card">


    <!-- =====================================================
         FORM PANEL
    ====================================================== -->

    <div class="form-panel">


        <!-- =================================================
             LOGIN / REGISTER TABS
        ================================================== -->

        <div class="auth-tabs">

            <button
                type="button"
                id="tab-login"
                class="auth-tab"
                onclick="showMode('login')">

                تسجيل الدخول

            </button>


            <button
                type="button"
                id="tab-register"
                class="auth-tab"
                onclick="showMode('register')">

                حساب جديد

            </button>

        </div>


        <!-- =================================================
             LOGIN
        ================================================== -->

        <div id="login-section">


            <h1 class="form-title">
                تسجيل الدخول
            </h1>


            <p class="form-subtitle">
                أدخل بيانات حسابك للوصول إلى منصة آمر تم
            </p>


            @if($errors->any() && $authMode === 'login')

                <div class="alert alert-danger">

                    <i class="fas fa-circle-exclamation"></i>

                    {{ $errors->first() }}

                </div>

            @endif


            @if(session('success'))

                <div class="alert alert-success">

                    <i class="fas fa-circle-check"></i>

                    {{ session('success') }}

                </div>

            @endif


            <form
                method="POST"
                action="{{ route('amrtm.login.submit') }}"
                autocomplete="on">

                @csrf


                <input
                    type="hidden"
                    name="_auth_mode"
                    value="login">


                <!-- EMAIL -->

                <div class="form-group">

                    <label class="form-label">
                        البريد الإلكتروني
                    </label>

                    <div class="input-wrap">

                        <i class="fas fa-envelope input-icon"></i>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            placeholder="example@email.com"
                            autocomplete="email"
                            required>

                    </div>

                </div>


                <!-- PASSWORD -->

                <div class="form-group">

                    <label class="form-label">
                        كلمة المرور
                    </label>

                    <div class="input-wrap">

                        <i class="fas fa-lock input-icon"></i>

                        <input
                            type="password"
                            id="login-password"
                            name="password"
                            class="form-control"
                            placeholder="أدخل كلمة المرور"
                            autocomplete="current-password"
                            value=""
                            required>

                        <button
                            type="button"
                            class="toggle-pw"
                            onclick="togglePassword(
                                'login-password',
                                'login-eye'
                            )">

                            <i
                                id="login-eye"
                                class="fas fa-eye">
                            </i>

                        </button>

                    </div>

                </div>


                <!-- REMEMBER -->

                <label class="remember">

                    <input
                        type="checkbox"
                        name="remember">

                    تذكرني

                </label>


                <!-- SUBMIT -->

                <button
                    type="submit"
                    class="btn-submit">

                    <i class="fas fa-right-to-bracket"></i>

                    تسجيل الدخول

                </button>


                <div class="security-note">

                    <i class="fas fa-shield-halved"></i>

                    اتصال آمن ومشفر

                </div>

            </form>

        </div>


        <!-- =================================================
             REGISTER
        ================================================== -->

        <div
            id="register-section"
            style="display:none;">


            <h1 class="form-title">
                إنشاء حساب جديد
            </h1>


            <p class="form-subtitle">
                اختر نوع الحساب الذي تريد إنشاءه
            </p>


            <!-- =================================================
                 REGISTER TYPES
            ================================================== -->

            <div
                id="register-choice"
                class="register-choice">


                <!-- =================================================
                     CLIENT
                ================================================== -->

                <div
                    class="register-card"
                    id="register-client-card"
                    onclick="showRegisterType('client')">

                    <div class="register-card-icon">

                        <i class="fas fa-user"></i>

                    </div>

                    <strong>
                        تسجيل عميل فردي
                    </strong>

                    <small>
                        للأفراد الراغبين في الاستفادة من خدمات المنصة
                    </small>

                </div>


                <!-- =================================================
                     SERVICE PROVIDER
                ================================================== -->
<a
    href="{{ route('amrtm.provider.account.create') }}"
    class="register-card"
    id="register-office-card">
                    <div class="register-card-icon">

                        <i class="fas fa-building"></i>

                    </div>

                    <strong>
                        تسجيل مقدم خدمة
                    </strong>

                    <small>
                        المستشارين والمكاتب وأصحاب المهن الحرة
                    </small>

                </a>

            </div>


            <!-- =================================================
                 BACK
            ================================================== -->

            <button
                type="button"
                id="back-register"
                class="back-register"
                onclick="backToRegisterChoice()">

                <i class="fas fa-arrow-right"></i>

                العودة لاختيار نوع الحساب

            </button>


            <!-- =================================================
                 CLIENT REGISTER FORM
            ================================================== -->

            <form
                id="client-register-form"
                class="auth-form"
                method="POST"
                action="{{ route('amrtm.register.submit') }}"
                autocomplete="off"
                novalidate>

                @csrf


                <input
                    type="hidden"
                    name="_auth_mode"
                    value="register">


                <input
                    type="hidden"
                    name="_register_type"
                    value="client">


                <!-- =================================================
                     CLIENT DATA
                ================================================== -->

                <div class="section-title">

                    <i class="fas fa-user"></i>

                    <span>
                        بيانات العميل
                    </span>

                </div>


                <!-- NAME / PHONE -->

                <div class="form-row">


                    <!-- NAME -->

                    <div class="form-group">

                        <label class="form-label">
                            الاسم الكامل
                        </label>

                        <div class="input-wrap">

                            <i class="fas fa-user input-icon"></i>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name') }}"
                                placeholder="مثال: محمد أحمد"
                                autocomplete="name"
                                required>

                        </div>

                    </div>


                    <!-- PHONE -->

                    <div class="form-group">

                        <label class="form-label">
                            رقم الجوال
                        </label>

                        <div class="input-wrap">

                            <i class="fas fa-phone input-icon"></i>

                            <input
                                type="tel"
                                name="phone"
                                class="form-control"
                                value="{{ old('phone') }}"
                                placeholder="05xxxxxxxx"
                                autocomplete="tel"
                                inputmode="tel"
                                required>

                        </div>

                    </div>

                </div>


                <!-- EMAIL -->

                <div class="form-group">

                    <label class="form-label">
                        البريد الإلكتروني
                    </label>

                    <div class="input-wrap">

                        <i class="fas fa-envelope input-icon"></i>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            placeholder="example@email.com"
                            autocomplete="email"
                            required>

                    </div>

                </div>


                <!-- =================================================
                     PASSWORD SECTION
                ================================================== -->

                <div class="section-title">

                    <i class="fas fa-lock"></i>

                    <span>
                        بيانات الدخول
                    </span>

                </div>


                <!-- PASSWORDS -->

                <div class="form-row">


                    <!-- PASSWORD -->

                    <div class="form-group">

                        <label class="form-label">
                            كلمة المرور
                        </label>

                        <div class="input-wrap">

                            <i class="fas fa-lock input-icon"></i>

                            <input
                                type="password"
                                id="client-password"
                                name="password"
                                class="form-control"
                                placeholder="أدخل كلمة المرور"
                                autocomplete="new-password"
                                value=""
                                required>

                            <button
                                type="button"
                                class="toggle-pw"
                                onclick="togglePassword(
                                    'client-password',
                                    'client-eye'
                                )">

                                <i
                                    id="client-eye"
                                    class="fas fa-eye">
                                </i>

                            </button>

                        </div>

                    </div>


                    <!-- CONFIRM PASSWORD -->

                    <div class="form-group">

                        <label class="form-label">
                            تأكيد كلمة المرور
                        </label>

                        <div class="input-wrap">

                            <i class="fas fa-lock input-icon"></i>

                            <input
                                type="password"
                                id="client-password-confirm"
                                name="password_confirmation"
                                class="form-control"
                                placeholder="أعد إدخال كلمة المرور"
                                autocomplete="new-password"
                                value=""
                                required>

                            <button
                                type="button"
                                class="toggle-pw"
                                onclick="togglePassword(
                                    'client-password-confirm',
                                    'client-eye2'
                                )">

                                <i
                                    id="client-eye2"
                                    class="fas fa-eye">
                                </i>

                            </button>

                        </div>

                    </div>

                </div>


                <!-- TERMS -->

                <label class="remember">

                    <input
                        type="checkbox"
                        name="terms"
                        required>

                    <span>
                        أوافق على شروط الاستخدام وسياسة الخصوصية
                    </span>

                </label>


                <!-- CREATE ACCOUNT -->

                <button
                    type="submit"
                    class="btn-submit">

                    <i class="fas fa-user-plus"></i>

                    إنشاء حساب العميل

                </button>


                <div class="security-note">

                    <i class="fas fa-shield-halved"></i>

                    بياناتك محمية ومشفرة

                </div>

            </form>

        </div>

    </div>


    <!-- =================================================
         BRAND PANEL
    ================================================== -->

    <div class="brand-panel">

        <div class="brand-logo-wrap">

            <img
                src="{{ asset('images/new-logo1.png') }}"
                alt="آمر تم">

        </div>


        <h2>

            أهلاً بك في

            <br>

            <span>
                آمر تم
            </span>

        </h2>


        <p>

            منصة متكاملة لإدارة الطلبات
            والخدمات الحكومية وقطاع الأعمال

        </p>


        <div class="brand-badge">

            <i class="fas fa-shield-halved"></i>

            منصة آمنة وموثوقة

        </div>

    </div>

</div>


<!-- =========================================================
     JAVASCRIPT
========================================================= -->

<script>


/* =========================================================
   CURRENT STATE
========================================================= */

let currentMode = @json($authMode);

let currentRegisterType = @json($registerType);


/* =========================================================
   SHOW LOGIN / REGISTER
========================================================= */

function showMode(mode) {

    currentMode = mode;

    const loginSection =
        document.getElementById('login-section');

    const registerSection =
        document.getElementById('register-section');

    const loginTab =
        document.getElementById('tab-login');

    const registerTab =
        document.getElementById('tab-register');


    if (mode === 'login') {

        loginSection.style.display = 'block';

        registerSection.style.display = 'none';

        loginTab.classList.add('active');

        registerTab.classList.remove('active');

    } else {

        loginSection.style.display = 'none';

        registerSection.style.display = 'block';

        loginTab.classList.remove('active');

        registerTab.classList.add('active');

    }
}


/* =========================================================
   SHOW CLIENT REGISTER
========================================================= */

function showRegisterType(type) {

    currentRegisterType = type;

    const choice =
        document.getElementById('register-choice');

    const back =
        document.getElementById('back-register');

    const clientForm =
        document.getElementById('client-register-form');

    const clientCard =
        document.getElementById('register-client-card');


    if (type === 'client') {

        choice.style.display = 'none';

        back.style.display = 'flex';

        clientForm.classList.add('active');

        clientCard.classList.add('active');

        /*
         * تنظيف الباسورد من أي قيمة
         * عند فتح نموذج العميل
         */

        const password =
            document.getElementById('client-password');

        const passwordConfirm =
            document.getElementById(
                'client-password-confirm'
            );

        if (password) {
            password.value = '';
        }

        if (passwordConfirm) {
            passwordConfirm.value = '';
        }
    }
}


/* =========================================================
   BACK TO REGISTER CHOICE
========================================================= */

function backToRegisterChoice() {

    const choice =
        document.getElementById('register-choice');

    const back =
        document.getElementById('back-register');

    const clientForm =
        document.getElementById('client-register-form');

    const clientCard =
        document.getElementById('register-client-card');


    choice.style.display = 'grid';

    back.style.display = 'none';

    clientForm.classList.remove('active');

    clientCard.classList.remove('active');
}


/* =========================================================
   PASSWORD TOGGLE
========================================================= */

function togglePassword(inputId, iconId) {

    const input =
        document.getElementById(inputId);

    const icon =
        document.getElementById(iconId);


    if (!input || !icon) {
        return;
    }


    if (input.type === 'password') {

        input.type = 'text';

        icon.classList.remove('fa-eye');

        icon.classList.add('fa-eye-slash');

    } else {

        input.type = 'password';

        icon.classList.remove('fa-eye-slash');

        icon.classList.add('fa-eye');
    }
}


/* =========================================================
   PAGE LOAD
========================================================= */

document.addEventListener(
    'DOMContentLoaded',
    function () {

        /*
         * الوضع الافتراضي:
         * تسجيل الدخول
         */

        showMode(currentMode);


        /*
         * لو رجعنا من validation
         * وكان نوع التسجيل عميل
         */

        if (
            currentMode === 'register' &&
            currentRegisterType === 'client'
        ) {

            showRegisterType('client');

        }

    }
);


/* =========================================================
   PREVENT PASSWORD AUTOFILL
========================================================= */

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const password =
            document.getElementById('client-password');

        const passwordConfirm =
            document.getElementById(
                'client-password-confirm'
            );


        if (password) {
            password.value = '';
        }

        if (passwordConfirm) {
            passwordConfirm.value = '';
        }

    }
);

</script>


</body>
</html>