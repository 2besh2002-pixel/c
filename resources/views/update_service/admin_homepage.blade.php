<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>إدارة الواجهة | آمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css"/>
<style>
*{box-sizing:border-box;margin:0;padding:0;}
:root{--pri:#1A237E;--pri2:#283593;--pri3:#1565C0;--bg:#F0F2F8;--sur:#fff;--sur2:#F4F6FB;--b1:rgba(26,35,126,.1);--b2:rgba(26,35,126,.2);--bc:rgba(26,35,126,.07);--t1:#0D1257;--t2:#3A4490;--t3:#7A82B8;--t4:#BDC2E0;--pd:rgba(26,35,126,.08);--pd2:rgba(26,35,126,.14);--sh:rgba(26,35,126,.07);--sh2:rgba(26,35,126,.15);--red:#C62828;--green:#1B5E20;--sb-w:230px;}
html,body{height:100%;background:var(--bg);color:var(--t1);font-family:'Cairo',sans-serif;direction:rtl;}
.layout{display:flex;height:100vh;overflow:hidden;}

/* SIDEBAR */
.sb{width:var(--sb-w);flex-shrink:0;background:linear-gradient(180deg,#1A237E 0%,#0D1560 100%);display:flex;flex-direction:column;height:100vh;overflow-y:auto;}
.sb::-webkit-scrollbar{width:3px;}
.sb::-webkit-scrollbar-thumb{background:rgba(255,255,255,.15);border-radius:3px;}
.sb-logo{display:flex;align-items:center;gap:9px;padding:1.2rem 1rem;border-bottom:1px solid rgba(255,255,255,.08);}
.sb-logo-nm{font-size:15px;font-weight:900;color:#fff;}
.sb-logo-sb{font-size:9px;color:rgba(255,255,255,.55);}
.sb-nav{flex:1;padding:.7rem .6rem;}
.sb-sec{font-size:9.5px;text-transform:uppercase;letter-spacing:1.5px;color:rgba(255,255,255,.35);font-weight:700;padding:.4rem .6rem;margin-top:.5rem;}
.sb-item{display:flex;align-items:center;gap:9px;padding:.62rem .85rem;border-radius:10px;cursor:pointer;color:rgba(255,255,255,.55);font-size:13px;font-weight:600;margin-bottom:2px;text-decoration:none;transition:all .2s;}
.sb-item:hover{background:rgba(255,255,255,.08);color:rgba(255,255,255,.9);}
.sb-item.on{background:rgba(255,255,255,.15);color:#fff;}
.sb-item i{font-size:17px;flex-shrink:0;}

/* MAIN */
.main{flex:1;overflow-y:auto;display:flex;flex-direction:column;}
.topbar{height:60px;display:flex;align-items:center;padding:0 1.8rem;gap:1rem;background:var(--sur);border-bottom:1px solid var(--b1);position:sticky;top:0;z-index:40;box-shadow:0 2px 8px var(--sh);flex-shrink:0;}
.tb-back{display:flex;align-items:center;gap:6px;padding:7px 13px;border-radius:9px;border:1.5px solid var(--b1);background:transparent;color:var(--t2);font-family:inherit;font-size:13px;font-weight:600;cursor:pointer;text-decoration:none;transition:all .2s;}
.tb-back:hover{background:var(--pd);color:var(--pri);}
.tb-back i{font-size:16px;}
.tb-title{font-size:16px;font-weight:800;color:var(--t1);}
.content{padding:1.6rem 1.8rem;}
.pg-hd{display:flex;align-items:center;justify-content:space-between;margin-bottom:1.4rem;flex-wrap:wrap;gap:.8rem;}
.pg-ttl{font-size:19px;font-weight:800;color:var(--t1);}
.pg-sub{font-size:12.5px;color:var(--t3);margin-top:3px;}
.btn-pri{display:inline-flex;align-items:center;gap:6px;padding:9px 18px;border-radius:9px;background:var(--pri);color:#fff;font-family:inherit;font-size:13.5px;font-weight:700;cursor:pointer;border:none;box-shadow:0 3px 10px var(--sh2);transition:all .2s;}
.btn-pri:hover{background:var(--pri2);transform:translateY(-1px);}
.btn-ghost{display:inline-flex;align-items:center;gap:6px;padding:9px 16px;border-radius:9px;background:var(--sur);color:var(--t2);font-family:inherit;font-size:13px;font-weight:700;cursor:pointer;border:1.5px solid var(--b1);transition:all .2s;}
.btn-ghost:hover{background:var(--pd);color:var(--pri);}

/* CARDS / SECTIONS */
.card{background:var(--sur);border:1px solid var(--b1);border-radius:16px;padding:1.5rem;margin-bottom:1.6rem;box-shadow:0 3px 12px var(--sh);}
.card-hd{display:flex;align-items:center;gap:10px;margin-bottom:1.3rem;}
.card-hd i{font-size:20px;color:var(--pri);}
.card-ttl{font-size:15.5px;font-weight:800;color:var(--t1);}
.card-sub{font-size:12px;color:var(--t3);margin-top:2px;}
.grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem;}
.grid-1{grid-template-columns:1fr;}
.fld{display:flex;flex-direction:column;gap:6px;}
.fld label{font-size:13px;font-weight:700;color:var(--t2);}
.fld small{font-size:10.5px;color:var(--t4);}
.fld input,.fld select,.fld textarea{height:42px;padding:0 13px;border-radius:9px;border:1.5px solid var(--b1);background:var(--sur2);color:var(--t1);font-family:inherit;font-size:13.5px;outline:none;transition:border-color .2s;}
.fld textarea{height:auto;min-height:90px;padding:10px 13px;resize:vertical;}
.fld input:focus,.fld select:focus,.fld textarea:focus{border-color:var(--pri);background:var(--sur);}
.fld input[type=file]{padding:8px;height:auto;background:var(--sur);}
.fld-row{display:flex;gap:.8rem;flex-wrap:wrap;align-items:flex-end;}

/* PREVIEW MEDIA */
.media-prev{display:flex;align-items:center;gap:1rem;margin-top:1rem;flex-wrap:wrap;}
.media-box{width:210px;border-radius:12px;overflow:hidden;border:1.5px solid var(--b1);background:var(--sur2);}
.media-box img{width:100%;height:130px;object-fit:cover;display:block;}
.media-box.video video{width:100%;height:130px;object-fit:cover;display:block;}
.media-cap{font-size:12px;font-weight:700;color:var(--t2);text-align:center;padding:8px;}
.media-name{font-size:11px;color:var(--t3);text-align:center;padding:0 8px 8px;word-break:break-all;}

/* SLIDES */
.slides-list{display:flex;flex-direction:column;gap:.8rem;}
.slide-row{display:flex;align-items:center;gap:1rem;padding:.9rem;border-radius:12px;border:1.5px solid var(--b1);background:var(--sur2);}
.slide-thumb{width:120px;height:70px;border-radius:9px;object-fit:cover;border:1px solid var(--b1);flex-shrink:0;background:var(--sur);}
.slide-info{flex:1;min-width:0;}
.slide-ttl{font-size:13.5px;font-weight:700;color:var(--t1);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.slide-meta{font-size:11px;color:var(--t3);margin-top:3px;}
.slide-actions{display:flex;gap:6px;flex-shrink:0;}
.ic-btn{width:34px;height:34px;border-radius:8px;border:1.5px solid var(--b1);background:var(--sur);color:var(--t2);font-size:16px;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;transition:all .2s;}
.ic-btn:hover{background:var(--pd);color:var(--pri);border-color:var(--pri);}
.ic-btn.up:disabled,.ic-btn.down:disabled{opacity:.35;cursor:not-allowed;}
.ic-btn.del{color:var(--red);}
.ic-btn.del:hover{background:rgba(198,40,40,.09);border-color:var(--red);color:var(--red);}
.ic-btn.active{background:var(--green);border-color:var(--green);color:#fff;}
.ic-btn.inactive{color:var(--t3);}
.status-pill{font-size:11px;font-weight:700;padding:3px 10px;border-radius:20px;display:inline-block;}
.status-pill.on{background:rgba(27,94,32,.12);color:#1B5E20;}
.status-pill.off{background:rgba(125,130,184,.14);color:var(--t3);}

/* MODAL */
.modal{position:fixed;inset:0;background:rgba(10,12,35,.55);backdrop-filter:blur(4px);display:none;align-items:center;justify-content:center;z-index:1000;padding:1rem;}
.modal.show{display:flex;}
.modal-box{background:var(--sur);border-radius:18px;width:100%;max-width:560px;max-height:92vh;overflow-y:auto;padding:1.6rem;box-shadow:0 20px 60px rgba(0,0,0,.25);}
.modal-hd{display:flex;align-items:center;justify-content:space-between;margin-bottom:1.2rem;}
.modal-ttl{font-size:16px;font-weight:800;color:var(--t1);}
.modal-x{width:32px;height:32px;border-radius:8px;border:none;background:var(--pd);color:var(--t2);font-size:16px;cursor:pointer;}
.modal-x:hover{background:var(--pd2);}
.modal-ft{display:flex;gap:.7rem;justify-content:flex-end;align-items:center;margin-top:1.4rem;}

/* TOAST */
.toast{position:fixed;bottom:1.5rem;left:50%;transform:translateX(-50%);padding:11px 22px;border-radius:12px;font-size:13.5px;font-weight:700;color:#fff;z-index:9999;opacity:0;transition:opacity .3s;pointer-events:none;white-space:nowrap;}
.toast.show{opacity:1;}
.toast.ok{background:#1B5E20;}
.toast.err{background:#C62828;}

/* EMPTY */
.empty{text-align:center;padding:3rem 1rem;color:var(--t3);}
.empty i{font-size:48px;display:block;margin-bottom:.8rem;opacity:.35;}
.empty-ttl{font-size:14.5px;font-weight:700;color:var(--t2);margin-bottom:.3rem;}
.empty-sub{font-size:12.5px;}

@media (max-width:820px){ .grid{grid-template-columns:1fr;} .content{padding:1.2rem;} }
@media (max-width:640px){ .sb{display:none;} }
</style>
</head>
<body>
<div class="layout">

  <!-- SIDEBAR -->
  <aside class="sb">
    <div class="sb-logo">
      <div>
        <div class="sb-logo-nm">آمر تم</div>
        <div class="sb-logo-sb">إدارة الواجهة</div>
      </div>
    </div>
    <nav class="sb-nav">
      <div class="sb-sec">التنقل</div>
      <a class="sb-item" href="{{ route('amrtm.admin.dashboard') }}">
        <i class="ti ti-layout-dashboard"></i> لوحة التحكم
      </a>
      <a class="sb-item on" href="{{ route('amrtm.admin.homepage') }}">
        <i class="ti ti-home"></i> إدارة الواجهة
      </a>
      <a class="sb-item" href="{{ route('amrtm.admin.icons') }}">
        <i class="ti ti-icons"></i> مكتبة الأيقونات
      </a>
    </nav>
  </aside>

  <!-- MAIN -->
  <div class="main">
    <div class="topbar">
      <a class="tb-back" href="{{ route('amrtm.admin.dashboard') }}">
        <i class="ti ti-arrow-right"></i> رجوع للوحة التحكم
      </a>
      <span class="tb-title">إدارة الواجهة والمحتوى</span>
    </div>

    <div class="content">
      <div class="pg-hd">
        <div>
          <div class="pg-ttl">إدارة الواجهة ومحتواها</div>
          <div class="pg-sub">تحكم في نصوص الواجهة الرئيسية، الفيديو، وشرائح السلايدر</div>
        </div>
        <button class="btn-pri" onclick="saveSettings()"><i class="ti ti-device-floppy"></i> حفظ الإعدادات</button>
      </div>

      <!-- ── Section: أساسي ── -->
      <div class="card">
        <div class="card-hd"><i class="ti ti-letter-case"></i><div><div class="card-ttl">المحتوى الأساسي</div><div class="card-sub">العنوان والوصف ونصوص الأقسام الرئيسية</div></div></div>
        <div class="grid">
          <div class="fld"><label>عنوان المنصة</label><input id="set_site_title" placeholder="مثال: منصة آمر تم لخدمات قطاع الأعمال"/></div>
          <div class="fld"><label>السطر الترحيبي (نجمة/تاغلاين)</label><input id="set_site_tagline" placeholder="مثال: أختر الخدمة المطلوبة من خلال الجهات التالية"/></div>
          <div class="fld" style="grid-column:1/-1"><label>وصف المنصة</label><textarea id="set_site_subtitle" placeholder="اكتب وصفاً تعريفياً مختصراً للمنصة..."></textarea></div>
          <div class="fld"><label>تسمية المكتب الرئيسي</label><input id="set_main_office_label" placeholder="مثال: المكتب الرئيسي"/></div>
        </div>
      </div>

      <!-- ── Section: تواصل ── -->
      <div class="card">
        <div class="card-hd"><i class="ti ti-phone"></i><div><div class="card-ttl">بيانات التواصل</div><div class="card-sub">رقم الاتصال والواتساب والعنوان الظاهر في الواجهة</div></div></div>
        <div class="grid">
          <div class="fld"><label>رقم الاتصال</label><input id="set_contact_phone" dir="ltr" style="text-align:left" placeholder="966920002164"/><small>بالصيغة الدولية بدون +</small></div>
          <div class="fld"><label>رقم الواتساب</label><input id="set_contact_whatsapp" dir="ltr" style="text-align:left" placeholder="966504915222"/><small>بالصيغة الدولية بدون + (يُستخدم في رابط wa.me)</small></div>
          <div class="fld" style="grid-column:1/-1"><label>العنوان / الموقع</label><input id="set_contact_address" placeholder="مثال: الرياض، المملكة العربية السعودية"/></div>
        </div>
      </div>

      <!-- ── Section: الفيديو ── -->
      <div class="card">
        <div class="card-hd"><i class="ti ti-video"></i><div><div class="card-ttl">الفيديو التعريفي</div><div class="card-sub">ملف الفيديو وصورة الغلاف الظاهرين عند ضغط زر التشغيل</div></div></div>
        <div class="grid">
          <div class="fld"><label>ملف الفيديو (MP4)</label><input type="file" id="set_video_file" accept="video/mp4,video/quicktime,video/webm"/><small>اتركه فارغاً للإبقاء على الفيديو الحالي</small></div>
          <div class="fld"><label>صورة الغلاف (Poster)</label><input type="file" id="set_video_poster" accept="image/png,image/jpeg,image/webp"/><small>اتركه فارغاً للإبقاء على الغلاف الحالي</small></div>
        </div>
        <div class="media-prev" id="videoPreview"></div>
      </div>

      <!-- ── Section: السلايدات ── -->
      <div class="card">
        <div class="card-hd">
          <i class="ti ti-photo"></i>
          <div><div class="card-ttl">شرائح السلايدر الرئيسية</div><div class="card-sub">اضف، رتّب، عدّل أو أزل صور الخلفية العلوية — ظاهر مباشرة في الواجهة</div></div>
          <div style="margin-right:auto"><button class="btn-pri" onclick="openSlideModal()"><i class="ti ti-plus"></i> إضافة سلايد</button></div>
        </div>
        <div class="slides-list" id="slidesList"></div>
      </div>

    </div>
  </div>
</div>

<!-- Slide Modal -->
<div class="modal" id="slideModal">
  <div class="modal-box">
    <div class="modal-hd">
      <div class="modal-ttl" id="slideModalTitle">إضافة سلايد</div>
      <button class="modal-x" onclick="closeSlideModal()"><i class="ti ti-x"></i></button>
    </div>
    <div style="display:flex;flex-direction:column;gap:1rem;">
      <div class="fld"><label>عنوان السلايد (اختياري)</label><input id="sl_title" placeholder="مثال: قطاع الأعمال"/></div>
      <div class="fld"><label>رابط (اختياري)</label><input id="sl_link" placeholder="https://..."/></div>
      <div class="fld"><label>صورة الخلفية</label><input type="file" id="sl_image" accept="image/png,image/jpeg,image/webp"/><small>يفضل بحجم واسع عريض (16:9)</small></div>
      <div class="fld">
        <label>الحالة</label>
        <div style="display:flex;gap:8px;">
          <button type="button" class="btn-ghost" id="sl_active_btn" onclick="toggleSlideStatusModal()"><span id="sl_active_label">مفعل</span></button>
        </div>
      </div>
    </div>
    <div class="modal-ft">
      <button class="btn-ghost" onclick="closeSlideModal()">إلغاء</button>
      <button class="btn-pri" id="slideSaveBtn" onclick="saveSlideForm()"><i class="ti ti-check"></i> حفظ</button>
    </div>
  </div>
</div>

<!-- TOAST -->
<div class="toast" id="toast"></div>

<script>
const API_SETTINGS     = '{{ route('amrtm.admin.api.homepage.settings') }}';
const API_SETTINGS_SAVE= '{{ route('amrtm.admin.api.homepage.settings.save') }}';
const API_SLIDES       = '{{ route('amrtm.admin.api.homepage.slides') }}';
const API_SLIDES_STORE = '{{ route('amrtm.admin.api.homepage.slides.store') }}';
const API_SLIDES_REORDER = '{{ route('amrtm.admin.api.homepage.slides.reorder') }}';
const CSRF             = document.querySelector('meta[name="csrf-token"]').content;

let slides = [];
let editingSlideId = null;
const EMPTY_VIDEO = 'videos/0829.mp4';
const EMPTY_POSTER = 'images/logo2.jpg';

/* ══════════ LOAD ══════════ */
async function loadAll() {
  await loadSettings();
  await loadSlides();
}

async function loadSettings() {
  try {
    const res     = await fetch(API_SETTINGS);
    const data    = await res.json();
    const s       = data.settings || {};
    setVal('set_site_title',           s.site_title);
    setVal('set_site_tagline',         s.site_tagline);
    setVal('set_site_subtitle',        s.site_subtitle);
    setVal('set_main_office_label',    s.main_office_label);
    setVal('set_contact_phone',        s.contact_phone);
    setVal('set_contact_whatsapp',     s.contact_whatsapp);
    setVal('set_contact_address',      s.contact_address);
    renderVideoPreview(data.defaults || {});
    document.getElementById('set_video_poster').dataset.videoPoster = s.video_poster || EMPTY_POSTER;
    document.getElementById('set_video_file').dataset.videoFile    = s.video_file   || EMPTY_VIDEO;
  } catch {
    toast('تعذر تحميل الإعدادات', 'err');
  }
}

function setVal(id, v) { document.getElementById(id).value = v || ''; }

function renderVideoPreview(defaults) {
  const poster = document.getElementById('set_video_poster').dataset.videoPoster || defaults.video_poster || EMPTY_POSTER;
  const file   = document.getElementById('set_video_file').dataset.videoFile   || defaults.video_file   || EMPTY_VIDEO;
  const box = document.getElementById('videoPreview');
  box.innerHTML = `
    <div class="media-box">
      <video id="vp-vid" src="${asset(file)}" poster="${asset(poster)}" muted controls style="width:100%;height:130px;object-fit:cover;"></video>
      <div class="media-cap">معاينة الفيديو</div>
      <div class="media-name">${file}</div>
    </div>
    <div class="media-box">
      <img src="${asset(poster)}" alt="غلاف"/>
      <div class="media-cap">صورة الغلاف</div>
      <div class="media-name">${poster}</div>
    </div>`;
}

/* ══════════ SAVE SETTINGS ══════════ */
function collectSettingsForm() {
  const fd = new FormData();
  const map = {
    site_title:           'set_site_title',
    site_tagline:         'set_site_tagline',
    site_subtitle:        'set_site_subtitle',
    main_office_label:    'set_main_office_label',
    contact_phone:        'set_contact_phone',
    contact_whatsapp:     'set_contact_whatsapp',
    contact_address:      'set_contact_address',
  };
  for (const k in map) fd.append(k, document.getElementById(map[k]).value);
  const vf = document.getElementById('set_video_file');
  const pf = document.getElementById('set_video_poster');
  if (vf.files.length) fd.append('video_file', vf.files[0]);
  if (pf.files.length) fd.append('video_poster', pf.files[0]);
  fd.append('_token', CSRF);
  return fd;
}

async function saveSettings() {
  const btn = document.querySelector('.btn-pri');
  btn.disabled = true;
  try {
    const res  = await fetch(API_SETTINGS_SAVE, { method: 'POST', body: collectSettingsForm() });
    const data = await res.json();
    if (res.ok) { toast(data.message || 'تم الحفظ', 'ok'); await loadSettings(); }
    else        { toast(data.message || 'تعذر الحفظ', 'err'); }
  } catch {
    toast('فشل الاتصال بالسيرفر', 'err');
  } finally {
    btn.disabled = false;
  }
}

/* ══════════ SLIDES ══════════ */
async function loadSlides() {
  try {
    const res  = await fetch(API_SLIDES);
    const data = await res.json();
    slides = data.slides || [];
    renderSlides();
  } catch {
    toast('تعذر تحميل السلايدات', 'err');
  }
}

function renderSlides() {
  const el = document.getElementById('slidesList');
  if (!slides.length) {
    el.innerHTML = `<div class="empty">
      <i class="ti ti-photo-off"></i>
      <div class="empty-ttl">لا توجد شرائح بعد</div>
      <div class="empty-sub">أضف أول سلايد ليظهر في أعلى الواجهة</div>
    </div>`;
    return;
  }
  el.innerHTML = slides.map((s, i) => `
    <div class="slide-row" data-id="${s.id}">
      <img class="slide-thumb" src="${s.image_url || asset('images/slide-riyadh-business.jpg')}" alt="${s.title || 'سلايد'}" onerror="this.src='${asset('images/slide-riyadh-business.jpg')}'"/>
      <div class="slide-info">
        <div class="slide-ttl">${escapeHtml(s.title || 'سلايد بدون عنوان')}</div>
        <div class="slide-meta">${s.link_url ? 'الرابط: ' + escapeHtml(s.link_url) : ''} — <span class="status-pill ${s.is_active ? 'on' : 'off'}">${s.is_active ? 'مفعل' : 'غير مفعل'}</span></div>
      </div>
      <div class="slide-actions">
        <button class="ic-btn up" title="تحريك لأعلى" onclick="moveSlide(${i}, -1)" ${i === 0 ? 'disabled' : ''}><i class="ti ti-chevron-up"></i></button>
        <button class="ic-btn down" title="تحريك لأسفل" onclick="moveSlide(${i}, 1)" ${i === slides.length - 1 ? 'disabled' : ''}><i class="ti ti-chevron-down"></i></button>
        <button class="ic-btn ${s.is_active ? 'active' : 'inactive'}" title="${s.is_active ? 'إلغاء التفعيل' : 'تفعيل'}" onclick="toggleSlide(${s.id}, this)"><i class="ti ${s.is_active ? 'ti-eye' : 'ti-eye-off'}"></i></button>
        <button class="ic-btn" title="تعديل" onclick="openSlideModal(${s.id})"><i class="ti ti-edit"></i></button>
        <button class="ic-btn del" title="حذف" onclick="deleteSlide(${s.id})"><i class="ti ti-trash"></i></button>
      </div>
    </div>
  `).join('');
}

function moveSlide(i, dir) {
  const j = i + dir;
  if (j < 0 || j >= slides.length) return;
  [slides[i], slides[j]] = [slides[j], slides[i]];
  renderSlides();
  persistOrder();
}

async function persistOrder() {
  try {
    await fetch(API_SLIDES_REORDER, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
      body: JSON.stringify({ order: slides.map(s => s.id), _token: CSRF }),
    });
  } catch {
    toast('فشل حفظ الترتيب', 'err');
  }
}

async function toggleSlide(id, btn) {
  try {
    const res  = await fetch(API_SLIDES + '/' + id + '/toggle', { method: 'POST', headers: { 'X-CSRF-TOKEN': CSRF } });
    const data = await res.json();
    if (res.ok) { toast(data.message, 'ok'); await loadSlides(); }
    else        { toast(data.message || 'تعذر التغيير', 'err'); }
  } catch {
    toast('فشل الاتصال', 'err');
  }
}

async function deleteSlide(id) {
  if (!confirm('هل تريد حذف هذا السلايد؟')) return;
  try {
    const res  = await fetch(API_SLIDES + '/' + id, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': CSRF } });
    const data = await res.json();
    if (res.ok) { toast(data.message, 'ok'); await loadSlides(); }
    else        { toast(data.message || 'تعذر الحذف', 'err'); }
  } catch {
    toast('فشل الاتصال', 'err');
  }
}

/* ══════════ SLIDE MODAL ══════════ */
let slideModalActive = true;

function openSlideModal(id) {
  editingSlideId = id || null;
  slideModalActive = true;
  document.getElementById('sl_title').value = '';
  document.getElementById('sl_link').value = '';
  document.getElementById('sl_image').value = '';
  updateSlideModalStatus();
  if (id) {
    const s = slides.find(x => x.id === id);
    if (s) {
      document.getElementById('sl_title').value = s.title || '';
      document.getElementById('sl_link').value = s.link_url || '';
      slideModalActive = !!s.is_active;
      updateSlideModalStatus();
    }
    document.getElementById('slideModalTitle').textContent = 'تعديل السلايد';
  } else {
    document.getElementById('slideModalTitle').textContent = 'إضافة سلايد جديد';
  }
  document.getElementById('slideModal').classList.add('show');
}

function closeSlideModal() {
  document.getElementById('slideModal').classList.remove('show');
  editingSlideId = null;
}

function toggleSlideStatusModal() {
  slideModalActive = !slideModalActive;
  updateSlideModalStatus();
}

function updateSlideModalStatus() {
  const btn = document.getElementById('sl_active_btn');
  const lbl = document.getElementById('sl_active_label');
  lbl.textContent = slideModalActive ? 'مفعل' : 'غير مفعل';
  btn.style.borderColor = slideModalActive ? 'rgba(27,94,32,.5)' : 'rgba(125,130,184,.5)';
  btn.style.color = slideModalActive ? '#1B5E20' : 'var(--t3)';
}

async function saveSlideForm() {
  const title = document.getElementById('sl_title').value.trim();
  const link  = document.getElementById('sl_link').value.trim();
  const image = document.getElementById('sl_image').files[0];

  const fd = new FormData();
  fd.append('title', title);
  fd.append('link_url', link);
  fd.append('is_active', slideModalActive ? '1' : '0');
  fd.append('_token', CSRF);

  let url, method;
  if (editingSlideId) {
    url = API_SLIDES + '/' + editingSlideId;
    method = 'PUT';
  } else {
    if (!image) { toast('يرجى اختيار صورة للسلايد', 'err'); return; }
    url = API_SLIDES;
    method = 'POST';
  }
  if (image) fd.append('image', image);

  try {
    const res  = await fetch(url, { method, body: fd });
    const data = await res.json();
    if (res.ok) { toast(data.message, 'ok'); closeSlideModal(); await loadSlides(); }
    else        { toast(data.message || 'تعذر الحفظ', 'err'); }
  } catch {
    toast('فشل الاتصال', 'err');
  }
}

/* ══════════ HELPERS ══════════ */
function asset(p) {
  if (!p) return '';
  if (/^https?:\/\//.test(p)) return p;
  return window.__BASE__ + '/' + p;
}
window.__BASE__ = '{{ asset('') }}'.replace(/\/$/, '');

function escapeHtml(s) {
  return String(s).replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
}

function toast(msg, type='ok') {
  const t = document.getElementById('toast');
  t.textContent = msg;
  t.className   = 'toast show ' + type;
  setTimeout(() => t.classList.remove('show'), 3200);
}

/* ══════════ INIT ══════════ */
document.getElementById('slideModal').addEventListener('click', e => {
  if (e.target.id === 'slideModal') closeSlideModal();
});
loadAll();
</script>
</body>
</html>
