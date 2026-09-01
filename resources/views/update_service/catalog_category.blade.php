<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $category->name_ar }} | منصة آمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css"/>
<style>
  /* ===============================
   RESET
=================================*/
*{
    margin:0;
    padding:3px;
    box-sizing:border-box;
}


:root{
    --pri:#1A237E;
    --pri2:#283593;
    --pri3:#1565C0;

    --bg:#F8F6F2;

    --sur:#ffffff;

    --text:#122056;
    --text2:#5E6B98;

    --border:rgba(26,35,126,.08);

    --shadow:
        0 12px 35px rgba(17,33,94,.08);

    --radius:22px;
}


html{
    scroll-behavior:smooth;
}

body{
    min-height:100vh;
    color:var(--text);

    background:
    linear-gradient(
        rgba(250,248,243,.65),
        rgba(250,248,243,.65)
    ),
    url('/images/bg-pattern.png');

    background-size:cover;
    background-position:center top;
    background-repeat:no-repeat;
    background-attachment:fixed;

    overflow-x:hidden;
}

body.ar,
body.ar *:not(i){

    font-family:'Cairo',sans-serif;
    direction:rtl;

}

body.en,
body.en *:not(i){

    font-family:'Inter',sans-serif;
    direction:rtl;

}
.nb-logo-img{
    width:46px;
    height:46px;
    object-fit:contain;
}
/* ===============================
   NAVBAR
=================================*/

.nb{
    width:100%;
    min-height:72px;
    display:flex;
    align-items:center;
    justify-content:space-between;

    padding:0 35px;

    background:#fff;
    border-bottom:1px solid #edf1f7;
    box-shadow:0 8px 25px rgba(0,0,0,.06);

    position:sticky;
    top:0;
    z-index:999;
}

.nb-logo{
    text-decoration:none;
    display:flex;
    align-items:center;
    gap:10px;
}

.nb-logo-nm{
    color:#1A237E;
    font-size:24px;
    font-weight:900;
}

.nb-mid{
    flex:1;
}

.nb-right{
    display:flex;
    align-items:center;
    gap:12px;
}

/* Language */

.lng{
    display:flex;
    background:#f2f5fb;
    border-radius:12px;
    padding:3px;
}

.lt{
    padding:6px 12px;
    border-radius:9px;
    cursor:pointer;
    transition:.3s;

    color:#1A237E;
    font-size:12px;
    font-weight:700;
}

.lt.on{
    background:#1A237E;
    color:#fff;
}

/* Buttons */

.nb-btn{
    display:flex;
    align-items:center;
    gap:6px;

    text-decoration:none;

    padding:10px 18px;

    border-radius:12px;

    font-size:13px;
    font-weight:700;

    transition:.3s;
}

.nb-btn.out{

    background:#fff;

    color:#1A237E;

    border:1px solid #dbe3f1;

}

.nb-btn.out:hover{

    background:#1A237E;

    color:#fff;

}

.nb-btn.sol{

    background:#1A237E;

    color:#fff;

}

.nb-btn.sol:hover{

    background:#2956d7;

}

/* User */

.nb-user{

    display:flex;

    align-items:center;

    gap:10px;

    padding:6px 10px;

    border-radius:14px;

    background:#f5f7fc;

    cursor:pointer;

}

.nb-user-av{

    width:38px;
    height:38px;

    border-radius:50%;

    object-fit:cover;

}

.nb-user-nm{

    color:#1A237E;

    font-size:13px;

    font-weight:700;

}

/* ===============================
        TABLET
=================================*/

@media(max-width:992px){

    .nb{

        padding:0 18px;

    }

    .nb-logo-nm{

        font-size:21px;

    }

    .nb-btn{

        padding:9px 14px;

    }

}

/* ===============================
        MOBILE
=================================*/

@media(max-width:768px){

    .nb{

        padding:12px;

        min-height:auto;

        flex-wrap:wrap;

        gap:12px;

    }

    .nb-logo{

        width:100%;

        justify-content:center;

    }

    .nb-mid{

        display:none;

    }

    .nb-right{

        width:100%;

        justify-content:center;

        flex-wrap:wrap;

        gap:10px;

    }

    #nb-guest,
    #nb-auth{

        width:100%;

        justify-content:center;

        flex-wrap:wrap;

    }

    .nb-btn{

        flex:1;

        justify-content:center;

        min-width:130px;

    }

    .lng{

        order:-1;

    }

}

/* ===============================
      SMALL PHONES
=================================*/

@media(max-width:480px){

    .nb-logo-nm{

        font-size:19px;

    }

    .nb-btn{

        width:100%;

        flex:none;

    }

    .nb-user{

        width:100%;

        justify-content:center;

    }

}

/* ===============================
   SEARCH
=================================*/
.services-search{

    width:100%;

    margin:0;

    padding:22px;

    background:transparent;

    box-shadow:none;

}
.search-box{

    position:relative;

}

.search-box input{

    width:100%;

    height:56px;

    border-radius:15px;

    border:1px solid #E3EAF8;

    padding:0 55px;

    background:#FAFBFF;

    font-size:15px;

    transition:.3s;

}

.search-box input:focus{

    outline:none;

    background:#fff;

    border-color:#2956D7;

    box-shadow:

    0 0 0 5px rgba(41,86,215,.08);

}

.search-box input::placeholder{

    color:#95A4C8;

}

.search-icon{

    position:absolute;

    top:50%;

    right:18px;

    transform:translateY(-50%);

    font-size:20px;

    color:#2956D7;

}

#clearSearch{

    position:absolute;

    left:16px;

    top:50%;

    transform:translateY(-50%);

    width:34px;

    height:34px;

    border:none;

    border-radius:50%;

    background:#EEF4FF;

    color:#2956D7;

    cursor:pointer;

}

#clearSearch:hover{

    background:#2956D7;

    color:#fff;

}


/* Suggestions */

.search-suggestions{

    position:absolute;

    top:calc(100% + 8px);

    right:0;

    left:0;

    display:none;

    background:#fff;

    border-radius:18px;

    overflow:hidden;

    box-shadow:0 18px 40px rgba(0,0,0,.12);

    border:1px solid #E9EDF7;

    z-index:9999;

    max-height:420px;

    overflow-y:auto;

}

.search-item{

    display:flex;

    align-items:center;

    gap:14px;

    padding:15px 18px;

    cursor:pointer;

    transition:.25s;

}

.search-item:hover{

    background:#F5F8FF;

}

.search-icon-box{

    width:46px;

    height:46px;

    border-radius:14px;

    background:#EEF3FF;

    display:flex;

    justify-content:center;

    align-items:center;

    color:#2956D7;

    font-size:20px;

}

.search-content{

    flex:1;

}

.search-content .title{

    font-size:15px;

    font-weight:800;

    color:#16245E;

}

.search-content .sub{

    font-size:13px;

    color:#7A86A5;

}

/* ===============================
   BREADCRUMB
=================================*/
.bc-bar{

    width:100%;

    margin:0;

    padding:0 24px 10px;

    background:transparent;

    box-shadow:none;

}

.bc{

    display:flex;

    align-items:center;

    justify-content:flex-start;

    gap:8px;

    font-size:13px;

    color:#7C89AA;

}

.bc a{

    color:#6C79A1;

    text-decoration:none;

    transition:.25s;

    font-weight:600;

}

.bc a:hover{

    color:#1A237E;

}

.bc-sep{

    color:#A7B1CF;

    font-size:11px;

}

.bc-cur{

    color:#1A237E;

    font-weight:800;

}


/* ===============================
   PAGE HEADER
=================================*/
.page-header-card{

    width:min(1200px,94%);

    margin:35px auto;

    background:#fff;

    border-radius:24px;

    overflow:hidden;

    box-shadow:0 18px 45px rgba(20,40,90,.08);

}
.ph{

    width:100%;

    margin:0;

    background:transparent;

    box-shadow:none;

    border-radius:0;

}

.ph-inner{

    display:flex;

    align-items:center;

    justify-content:space-between;

    gap:25px;

}

body.ar .ph-inner{

    flex-direction:row-reverse;

}

body.en .ph-inner{

    flex-direction:row;

}
.ph-ico{
    width: 170px;
    height: 170px;
    border-radius: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-shrink: 0;
    overflow: hidden;
    background: #fff;
}

.category-logo{
    width: 170px;
    height: 170px;
    object-fit: cover;
    display: block;
}
.ph-inner>div:last-child{

    flex:1;

    text-align:right;

}

body.en .ph-inner>div:last-child{

    text-align:left;

}

.ph-title{

    font-size:34px;

    font-weight:800;

    color:#16245E;

    margin-bottom:6px;

    line-height:1.2;

}

.ph-sub{

    font-size:15px;

    color:#7B87A8;

    margin-bottom:14px;

}

.ph-badge{

    display:inline-flex;

    align-items:center;

    gap:8px;

    background:#EEF3FF;

    color:#2956D7;

    padding:8px 15px;

    border-radius:50px;

    font-size:13px;

    font-weight:700;

}

.ph-badge i{

    font-size:16px;

}
.services-search,
.bc-bar,
.ph{

    border-left:1px solid rgba(26,35,126,.05);

    border-right:1px solid rgba(26,35,126,.05);

}
/* ==========================================
            ENTITY CARDS
========================================== */

.ents-wrap{

    width:min(1320px,94%);

    margin:0 auto 60px;

}

.ents-grid{
    display:grid;
    grid-template-columns:repeat(3,minmax(420px,1fr));
    gap:20px;
}
/* Card */

.ec{

    position:relative;

    display:flex;

    flex-direction:column;

    justify-content:space-between;

    min-height:150px;

    text-decoration:none;

    border-radius:22px;

    overflow:hidden;

    background:rgba(255,255,255,.96);

    border:1px solid rgba(35,63,148,.08);

    box-shadow:

    0 12px 35px rgba(20,40,90,.08);

    transition:.35s;

}

.ec::before{

    content:"";

    position:absolute;

    top:0;

    left:0;

    width:100%;

    height:5px;

    background:var(--ecc);

    transform:scaleX(0);

    transition:.35s;

}

.ec:hover{

    transform:translateY(-10px);

    box-shadow:

    0 25px 55px rgba(20,40,90,.16);

}

.ec:hover::before{

    transform:scaleX(1);

}


/* BODY */
.ec-body{

    display:flex;

    flex-direction:row-reverse;

    align-items:center;

    gap:18px;

    padding:18px;

}
.ec-info{

    flex:1;

    text-align:right;

}
.ec-nm{

    font-size:13px;

    font-weight:800;

    white-space:nowrap;
       color:#000 !important;

    overflow:hidden;

    text-overflow:ellipsis;

}
.ec-tag{

    margin-top:6px;

    font-size:14px;

    color:#7A86A8;

}
/* ICON */

.ec-ico{
    width:65px;
    height:65px;

    border-radius:14px;

    overflow:hidden;

    flex-shrink:0;
}

.ec:hover .ec-ico{

    transform:scale(1.08) rotate(-6deg);

}
.entity-logo{

    width:100%;
    height:100%;

    object-fit:cover;

    transform:scale(1.2);

}

/* FOOTER */

.ec-foot{

    display:flex;

    align-items:center;

    justify-content:space-between;

    padding:14px 20px;

    border-top:1px solid rgba(26,35,126,.07);

    background:#FAFBFF;

}

.ec-svcs{

    color:#2956D7;

    font-size:14px;

    font-weight:700;

}

.ec-arr{

    font-size:23px;

    transition:.35s;

}

.ec:hover .ec-arr{

    transform:translateX(-8px);

}

body.en .ec:hover .ec-arr{

    transform:translateX(8px);

}


/* Animation */

.ec{

    animation:fadeCard .45s ease both;

}

.ec:nth-child(2){

    animation-delay:.05s;

}

.ec:nth-child(3){

    animation-delay:.10s;

}

.ec:nth-child(4){

    animation-delay:.15s;

}

.ec:nth-child(5){

    animation-delay:.20s;

}

.ec:nth-child(6){

    animation-delay:.25s;

}

@keyframes fadeCard{

    from{

        opacity:0;

        transform:translateY(25px);

    }

    to{

        opacity:1;

        transform:none;

    }

}


/* Responsive */

@media(max-width:1200px){

    .ents-grid{

        grid-template-columns:repeat(3,1fr);

    }

}

@media(max-width:992px){

    .ents-grid{

        grid-template-columns:repeat(2,1fr);

    }

}

@media(max-width:650px){

    .ents-grid{

        grid-template-columns:1fr;

    }

    .ec{

        min-height:185px;

    }

    .ec-body{

        padding:20px;

    }

    .ec-nm{

        font-size:18px;

    }

    .ec-ico{

        width:60px;

        height:60px;

    }

    .ec-ico i{

        font-size:28px;

    }

}
/* ==========================================
            EMPTY
========================================== */

.empty{

    width:min(1320px,94%);

    margin:40px auto;

    padding:80px 30px;

    background:#fff;

    border-radius:24px;

    text-align:center;

    box-shadow:
    0 12px 35px rgba(18,36,90,.08);

}

.empty i{

    font-size:70px;

    color:#B6C0DF;

    margin-bottom:18px;

}

.empty p{

    font-size:18px;

    color:#6F7DA4;

    font-weight:700;

}


/* ==========================================
            FOOTER
========================================== */
.footer{
    width:100%;
    background:#fff !important;
    border-top:1px solid #e5e7eb;
    box-shadow:0 -6px 20px rgba(0,0,0,.05);
}

.f-cp{
    padding:20px;
    text-align:center;
    color:#666;
    font-size:15px;
}

.f-cp b{
    color:#1A237E;
}

/* ==========================================
            SCROLLBAR
========================================== */

::-webkit-scrollbar{

    width:8px;

}

::-webkit-scrollbar-track{

    background:#EEF3FA;

}

::-webkit-scrollbar-thumb{

    background:#B8C5E7;

    border-radius:20px;

}

::-webkit-scrollbar-thumb:hover{

    background:#8FA5D8;

}


/* ==========================================
            RESPONSIVE
========================================== */

@media(max-width:992px){

    .services-search{

        width:95%;

        padding:18px;

    }

    .bc-bar{

        width:95%;

    }

    .ph{

        width:95%;

    }

}

@media(max-width:768px){

    .ph-inner{

        flex-direction:column-reverse;

        text-align:center;

    }

    .ph-inner>div:last-child{

        text-align:center;

    }

    .ph-badge{

        justify-content:center;

    }

    .bc{

        justify-content:center;

    }

}

@media(max-width:576px){

    .services-search{

        margin-top:20px;

        padding:14px;

    }

    .search-box input{

        height:50px;

        font-size:14px;

    }

    .search-icon{

        font-size:18px;

    }

    .ph-title{

        font-size:23px;

    }

    .ph-sub{

        font-size:13px;

    }

    .ph-ico{

        width:62px;

        height:62px;

    }

    .ph-ico i{

        font-size:28px;

    }

}
</style>
</style>
</head>
<body class="ar">

<!-- NAVBAR -->
<nav class="nb">
  <a class="nb-logo" href="{{ route('amrtm.index') }}">
    <img src="{{ asset('images/new-logo1.png') }}" alt="Logo" class="nb-logo-img">

    <div class="nb-logo-nm" id="nnm">
        آمر تم
    </div>
</a>
  <div class="nb-mid"></div>
  <div class="nb-right">
    <div class="lng"><div class="lt on" id="la" onclick="setLang('ar')">AR</div><div class="lt" id="le" onclick="setLang('en')">EN</div></div>
    <div id="nb-guest" style="display:flex;gap:6px;">
      <a class="nb-btn out" href="{{ route('amrtm.login') }}"><i class="ti ti-login"></i><span id="nl-li">دخول</span></a>
      <a class="nb-btn sol" href="{{ route('amrtm.register') }}"><i class="ti ti-user-plus"></i><span id="nl-re">تسجيل</span></a>
    </div>
    <div id="nb-auth" style="display:none;gap:6px;align-items:center;">
      <a class="nb-btn out" id="nb-dash-lnk" href="{{ route('amrtm.user.dashboard') }}"><i class="ti ti-layout-dashboard"></i><span id="nl-da">حسابي</span></a>
      <div class="nb-user" id="nb-user-chip">
        <img class="nb-user-av" id="nb-av" src="" alt=""/>
        <span class="nb-user-nm" id="nb-un"></span>
      </div>
    </div>
  </div>
</nav>

<div class="page-header-card">

    <!-- البحث -->
    <div class="services-search">

        <div class="search-box">

            <i class="ti ti-search search-icon"></i>

            <input
                type="text"
                id="serviceSearch"
                placeholder=""
                autocomplete="off"
                oninput="searchServices(this.value)"
            />

            <button
                type="button"
                id="clearSearch"
                style="display:none;"
                onclick="clearSearch()">

                <i class="ti ti-x"></i>

            </button>
        <div id="searchSuggestions" class="search-suggestions"></div>

        </div>


    </div>
<!-- BREADCRUMB -->
<div class="bc-bar">
  <div class="bc">
    <a href="{{ route('amrtm.index') }}" id="bc-home"><i class="ti ti-home-2" style="font-size:13px;"></i> الرئيسية</a>
    <span class="bc-sep">
        <i class="ti ti-chevron-left" style="font-size:11px;"></i>
    </span>
    <span class="bc-cur" id="bc-cat">{{ $category->name_ar }}</span>
  </div>
</div>

    <div class="ph">

       
                <div class="ph-title"id="ph-title">
                    {{ $category->name_ar }}
                </div>

                <div class="ph-sub"id="ph-sub">
                    اختر الجهة المطلوبة لتقديم طلبك
                </div>

                <div class="ph-badge"id="ph-cnt">
                    {{ $category->entities->count() }} جهة متاحة
                </div>

            </div>

        </div>

    </div>

</div>


<!-- ENTITIES GRID -->
<div class="ents-wrap">
  @if($category->entities->isEmpty())
    <div class="empty">
      <i class="ti ti-inbox"></i>
      <p id="empty-txt">لا توجد جهات متاحة في هذا القطاع حالياً</p>
    </div>
  @else
    <div class="ents-grid">
      @foreach($category->entities as $entity)
        @php
          $minPrice = $entity->govServices->min('price');
          $svcCount = $entity->govServices->count();
        @endphp
        <a class="ec"
             href="{{ route('amrtm.catalog.entity', [$category->key, $entity->id]) }}"
             data-name-ar="{{ strtolower($entity->name_ar) }}"
             data-name-en="{{ strtolower($entity->name_en) }}"
             data-tag-ar="{{ strtolower($entity->tag_ar ?? '') }}"
             data-tag-en="{{ strtolower($entity->tag_en ?? '') }}"
             data-services-ar='@json($entity->govServices->pluck("name_ar")->values())'
             data-services-en='@json($entity->govServices->pluck("name_en")->values())'
             style="--ecc:{{ $entity->color ?? $category->color }}">


          <div class="ec-body">

            <div class="ec-ico"
            style="background:{{ $entity->bg ?? $category->bg }};
            border:1.5px solid {{ $entity->color ?? $category->color }}33;">
@if(!empty($entity->images))
    <img src="{{ asset('images/uploads/' . $entity->images) }}"
         alt="{{ $entity->name_ar }}"
         class="entity-logo">
@else
    <i class="ti {{ $entity->icon ?? 'ti-building' }}"
       style="color:{{ $entity->color ?? $category->color }};"></i>
@endif
             </div>
            <div class="ec-info">
              <div class="ec-nm" data-ar="{{ $entity->name_ar }}" data-en="{{ $entity->name_en }}">{{ $entity->name_ar }}</div>
              <div class="ec-tag" data-ar="{{ $entity->tag_ar ?? '' }}" data-en="{{ $entity->tag_en ?? '' }}">{{ $entity->tag_ar ?? '' }}</div>
            </div>
          </div>

          <div class="ec-foot">
            <span class="ec-svcs" id="svc-cnt-{{ $entity->id }}">{{ $svcCount }} خدمة متاحة</span>
            @if($minPrice)
              {{-- <span class="ec-price" id="min-price-{{ $entity->id }}">من {{ $minPrice }} ر.س</span> --}}
            @endif
            <i class="ti ti-arrow-left ec-arr" style="color:{{ $entity->color ?? $category->color }};"></i>
          </div>
        </a>
      @endforeach
    </div>
  @endif
</div>


<!-- FOOTER -->
<footer class="footer">
    <div class="f-cp" id="fcp">
        © 2025
        <b>آمر تم</b>
        — جميع الحقوق محفوظة
    </div>
</footer>
<script>
window.AMRTM_USER = {!! auth('business')->check() ? json_encode([
    'id'    => auth('business')->id(),
    'name'  => auth('business')->user()->name,
    'role'  => auth('business')->user()->role,
]) : 'null' !!};
window.AMRTM_CSRF       = '{{ csrf_token() }}';
window.AMRTM_API_BASE   = '{{ url("/amrtm/api") }}';
window.AMRTM_ROUTES = {
    login:         '{{ route("amrtm.login") }}',
    logout:        '{{ route("amrtm.logout") }}',
    home:          '{{ route("amrtm.index") }}',
    userDashboard: '{{ route("amrtm.user.dashboard") }}',
    adminDashboard:'{{ route("amrtm.admin.dashboard") }}',
};

const catData = {
    key:    '{{ $category->key }}',
    name_ar:'{{ $category->name_ar }}',
    name_en:'{{ $category->name_en }}',
};

const T = {

ar:{
    li:'دخول',
    re:'تسجيل',
    da:'حسابي',
    dash:'لوحة التحكم',

    searchPlaceholder:'ابحث عن جهة أو خدمة...',

    home:'الرئيسية',
    svcAvail:'خدمة متاحة',
    entAvail:'جهة متاحة',
    chooseEnt:'اختر الجهة المطلوبة لتقديم طلبك',
    from:'من',
    sar:'ر.س',
    empty:'لا توجد جهات متاحة في هذا القطاع حالياً',
    fcp:'© 2025 آمر تم — جميع الحقوق محفوظة'
},
en:{
    li:'Sign In',
    re:'Register',
    da:'My Account',
    dash:'Dashboard',

    searchPlaceholder:'Search for an entity or service...',

    home:'Home',
    svcAvail:'services',
    entAvail:'entities available',
    chooseEnt:'Select the entity to submit your request',
    from:'from',
    sar:'SAR',
    empty:'No entities available in this sector currently',
    fcp:'© 2025 Amrtm — All Rights Reserved'
},
};

let lang = localStorage.getItem('amrtm_lang') || 'ar';

function setLang(l) {
  lang = l;
  localStorage.setItem('amrtm_lang', l);
  document.body.className = l;
  document.getElementById('la').className = 'lt' + (l==='ar'?' on':'');
  document.getElementById('le').className = 'lt' + (l==='en'?' on':'');
  applyLang();
}

function applyLang() {
  const t = T[lang];
  document.documentElement.lang = lang;
  document.documentElement.dir  = lang === 'ar' ? 'rtl' : 'ltr';

  document.getElementById('nl-li').textContent  = t.li;
  document.getElementById('nl-re').textContent  = t.re;
  document.getElementById('nl-da').textContent  = t.da;
  document.getElementById('bc-home').childNodes[1].textContent = ' ' + t.home;
  document.getElementById('bc-cat').textContent = lang==='ar' ? catData.name_ar : catData.name_en;
  document.getElementById('ph-title').textContent = lang==='ar' ? catData.name_ar : catData.name_en;
  document.getElementById('ph-sub').textContent  = t.chooseEnt;
  document.getElementById("serviceSearch").placeholder = t.searchPlaceholder;
  document.getElementById('fcp').innerHTML = t.fcp.replace('آمر تم','<b style="color:rgba(255,255,255,.85);">آمر تم</b>').replace('Amrtm','<b style="color:rgba(255,255,255,.85);">Amrtm</b>');

  // Entity cards text
  document.querySelectorAll('.ec-nm').forEach(el => {
    el.textContent = lang==='ar' ? el.dataset.ar : el.dataset.en;
  });
  document.querySelectorAll('.ec-tag').forEach(el => {
    el.textContent = lang==='ar' ? el.dataset.ar : el.dataset.en;
  });
  document.querySelectorAll('[id^="svc-cnt-"]').forEach(el => {
    const n = el.textContent.match(/\d+/)?.[0] || '0';
    el.textContent = n + ' ' + t.svcAvail;
  });
  document.querySelectorAll('[id^="min-price-"]').forEach(el => {
    const n = el.textContent.match(/[\d.]+/)?.[0] || '0';
    el.textContent = t.from + ' ' + n + ' ' + t.sar;
  });
  if(document.getElementById('empty-txt'))
    document.getElementById('empty-txt').textContent = t.empty;
  if(document.getElementById('ph-cnt')) {
    const cnt = document.querySelectorAll('.ec').length;
    document.getElementById('ph-cnt').textContent = cnt + ' ' + t.entAvail;
  }
}

function updateNavAuth() {
  const u = window.AMRTM_USER;
  if (u) {
    document.getElementById('nb-guest').style.display = 'none';
    const a = document.getElementById('nb-auth'); a.style.display = 'flex';
    document.getElementById('nb-un').textContent = u.name.split(' ')[0];
    const av = document.getElementById('nb-av');
    av.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(u.name)}&background=1A237E&color=fff&size=64`;
    const dashUrl = u.role==='admin' ? (AMRTM_ROUTES.adminDashboard||'/amrtm/admin') : (AMRTM_ROUTES.userDashboard||'/amrtm/dashboard');
    document.getElementById('nb-dash-lnk').href = dashUrl;
    document.getElementById('nb-user-chip').onclick = () => location.href = dashUrl;
    document.getElementById('nl-da').textContent = u.role==='admin' ? (lang==='ar'?'لوحة التحكم':'Dashboard') : (lang==='ar'?'حسابي':'My Account');
  }
}

document.addEventListener('DOMContentLoaded', () => {
  applyLang();
  updateNavAuth();
  const stored = localStorage.getItem('amrtm_lang') || 'ar';
  if (stored !== 'ar') setLang(stored);
});

function searchServices(value) {

    const q = value.trim().toLowerCase();

    const suggestions = document.getElementById("searchSuggestions");

    suggestions.innerHTML = "";

    if (q === "") {

        suggestions.style.display = "none";

        document.querySelectorAll(".ec").forEach(card => {

            card.style.display = "";

        });

        return;

    }

    const cards = document.querySelectorAll(".ec");

    let html = "";

    cards.forEach(card => {

        const name = (
            lang === "ar"
                ? card.dataset.nameAr
                : card.dataset.nameEn
        ) || "";

        const tag = (
            lang === "ar"
                ? card.dataset.tagAr
                : card.dataset.tagEn
        ) || "";

        const services = JSON.parse(
            lang === "ar"
                ? (card.dataset.servicesAr || "[]")
                : (card.dataset.servicesEn || "[]")
        );

        let matchedService = "";

        const serviceFound = services.some(service => {

            if (service.toLowerCase().includes(q)) {

                matchedService = service;
                return true;

            }

            return false;

        });

        if (

            name.includes(q) ||

            tag.includes(q) ||

            serviceFound

        ) {

            card.style.display = "";
            const icon = matchedService ? "ti-file-text" : "ti-building";

            html += `

                <div class="search-item"
                     onclick="location.href='${card.href}'">

                    <div class="search-icon-box">

                        <i class="ti ${matchedService ? "ti-file-text" : "ti-building"}"></i>

                    </div>

                    <div class="search-content">

                        <div class="title">

                            ${
                                matchedService
                                    ? matchedService
                                    : (
                                        lang === "ar"
                                            ? card.querySelector(".ec-nm").dataset.ar
                                            : card.querySelector(".ec-nm").dataset.en
                                    )
                            }

                        </div>

                        <div class="sub">

                            ${
                                lang === "ar"
                                    ? card.querySelector(".ec-nm").dataset.ar
                                    : card.querySelector(".ec-nm").dataset.en
                            }

                        </div>

                    </div>

                </div>

            `;

        } else {

            card.style.display = "none";

        }

    });

    suggestions.innerHTML = html;

    suggestions.style.display = html ? "block" : "none";

}

document.getElementById("serviceSearch").addEventListener("input", function () {
    searchServices(this.value);
});

document.getElementById("clearSearch").addEventListener("click", function () {

    serviceSearch.value = "";

    searchServices("");

});

document.addEventListener("click", function (e) {

    if (!e.target.closest(".services-search")) {

        document.getElementById("searchSuggestions").style.display = "none";

    }

});


function clearSearch(){

    document.getElementById("serviceSearch").value = "";

    searchServices("");

}

</script>
</body>
</html>