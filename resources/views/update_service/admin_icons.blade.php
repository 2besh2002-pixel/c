<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>مكتبة الأيقونات | آمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css"/>
<style>
*{box-sizing:border-box;margin:0;padding:0;}
:root{--pri:#1A237E;--pri2:#283593;--bg:#F0F2F8;--sur:#fff;--sur2:#F4F6FB;--b1:rgba(26,35,126,.1);--bc:rgba(26,35,126,.07);--t1:#0D1257;--t2:#3A4490;--t3:#7A82B8;--t4:#BDC2E0;--pd:rgba(26,35,126,.08);--sh:rgba(26,35,126,.07);--sh2:rgba(26,35,126,.15);--red:#C62828;--green:#1B5E20;--sb-w:230px;}
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

/* UPLOAD ZONE */
.upload-zone{background:var(--sur);border:2px dashed var(--b1);border-radius:16px;padding:2.2rem;text-align:center;cursor:pointer;transition:all .25s;margin-bottom:1.5rem;}
.upload-zone:hover,.upload-zone.drag{border-color:var(--pri);background:rgba(26,35,126,.04);}
.upload-zone i{font-size:42px;color:var(--t4);display:block;margin-bottom:.7rem;}
.upload-zone.drag i{color:var(--pri);}
.uz-ttl{font-size:15px;font-weight:700;color:var(--t2);}
.uz-sub{font-size:12px;color:var(--t3);margin-top:.3rem;}
.uz-badge{display:inline-block;margin-top:.7rem;padding:4px 10px;border-radius:20px;background:var(--pd);color:var(--pri);font-size:11px;font-weight:700;}
#fileInput{display:none;}

/* PROGRESS */
.progress-bar{height:5px;border-radius:3px;background:var(--b1);overflow:hidden;margin-bottom:1rem;display:none;}
.progress-fill{height:100%;background:var(--pri);width:0;transition:width .3s;border-radius:3px;}

/* TOOLBAR */
.toolbar{display:flex;align-items:center;gap:.8rem;margin-bottom:1.2rem;flex-wrap:wrap;}
.search-box{flex:1;min-width:220px;position:relative;}
.search-box input{width:100%;height:40px;padding:0 40px 0 14px;border-radius:10px;border:1.5px solid var(--b1);background:var(--sur);color:var(--t1);font-family:inherit;font-size:13.5px;outline:none;transition:border-color .2s;}
.search-box input:focus{border-color:var(--pri);}
.search-box i{position:absolute;right:12px;top:50%;transform:translateY(-50%);color:var(--t3);font-size:16px;pointer-events:none;}
.count-badge{padding:7px 14px;border-radius:9px;background:var(--sur);border:1px solid var(--b1);font-size:12.5px;font-weight:700;color:var(--t2);white-space:nowrap;}

/* ICON GRID */
.icon-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(110px,1fr));gap:.8rem;}
.ic{background:var(--sur);border-radius:12px;border:1.5px solid var(--b1);padding:.85rem .5rem .7rem;display:flex;flex-direction:column;align-items:center;gap:.5rem;cursor:pointer;transition:all .2s;position:relative;overflow:hidden;}
.ic:hover{border-color:var(--pri);background:rgba(26,35,126,.04);transform:translateY(-2px);box-shadow:0 6px 18px var(--sh2);}
.ic img{width:38px;height:38px;object-fit:contain;}
.ic-name{font-size:10px;color:var(--t3);text-align:center;word-break:break-all;line-height:1.3;}
.ic-del{position:absolute;top:4px;left:4px;width:20px;height:20px;border-radius:6px;background:rgba(198,40,40,.85);border:none;color:#fff;font-size:11px;cursor:pointer;display:none;align-items:center;justify-content:center;}
.ic:hover .ic-del{display:flex;}

/* EMPTY STATE */
.empty{text-align:center;padding:4rem 2rem;color:var(--t3);}
.empty i{font-size:52px;display:block;margin-bottom:1rem;opacity:.35;}
.empty-ttl{font-size:15px;font-weight:700;color:var(--t2);margin-bottom:.4rem;}
.empty-sub{font-size:13px;}

/* TOAST */
.toast{position:fixed;bottom:1.5rem;left:50%;transform:translateX(-50%);padding:11px 22px;border-radius:12px;font-size:13.5px;font-weight:700;color:#fff;z-index:9999;opacity:0;transition:opacity .3s;pointer-events:none;white-space:nowrap;}
.toast.show{opacity:1;}
.toast.ok{background:#1B5E20;}
.toast.err{background:#C62828;}
</style>
</head>
<body>
<div class="layout">

  <!-- SIDEBAR -->
  <aside class="sb">
    <div class="sb-logo">
      <div>
        <div class="sb-logo-nm">آمر تم</div>
        <div class="sb-logo-sb">مكتبة الأيقونات</div>
      </div>
    </div>
    <nav class="sb-nav">
      <div class="sb-sec">التنقل</div>
      <a class="sb-item" href="{{ route('amrtm.admin.dashboard') }}">
        <i class="ti ti-layout-dashboard"></i> لوحة التحكم
      </a>
      <a class="sb-item on" href="{{ route('amrtm.admin.icons') }}">
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
      <span class="tb-title">مكتبة الأيقونات</span>
    </div>

    <div class="content">
      <div class="pg-hd">
        <div>
          <div class="pg-ttl">مكتبة الأيقونات المخصصة</div>
          <div class="pg-sub">ارفع أيقونات SVG تستخدمها في الفئات والجهات والخدمات</div>
        </div>
      </div>

      <!-- UPLOAD ZONE -->
      <div class="upload-zone" id="uploadZone" onclick="document.getElementById('fileInput').click()">
        <i class="ti ti-cloud-upload"></i>
        <div class="uz-ttl">اسحب الأيقونات هنا أو انقر للاختيار</div>
        <div class="uz-sub">يدعم SVG • PNG • يمكن رفع حتى 200 أيقونة دفعة واحدة</div>
        <div class="uz-badge">الحجم الأقصى: 512 كيلوبايت للأيقونة</div>
      </div>
      <input type="file" id="fileInput" multiple accept=".svg,.png,.jpg,.jpeg,.webp"/>

      <!-- PROGRESS -->
      <div class="progress-bar" id="progressBar">
        <div class="progress-fill" id="progressFill"></div>
      </div>

      <!-- TOOLBAR -->
      <div class="toolbar">
        <div class="search-box">
          <input type="text" id="searchInput" placeholder="ابحث عن أيقونة باسمها..." oninput="filterIcons()"/>
          <i class="ti ti-search"></i>
        </div>
        <div class="count-badge" id="countBadge">0 أيقونة</div>
      </div>

      <!-- ICON GRID -->
      <div class="icon-grid" id="iconGrid"></div>
    </div>
  </div>
</div>

<!-- TOAST -->
<div class="toast" id="toast"></div>

<script>
const API_LIST   = '{{ route('amrtm.api.admin.icons.list') }}';
const API_UPLOAD = '{{ route('amrtm.api.admin.icons.upload') }}';
const API_DELETE = '{{ route('amrtm.api.admin.icons.delete') }}';
const CSRF       = document.querySelector('meta[name="csrf-token"]').content;

let allIcons = [];

/* ── Load icons ── */
async function loadIcons() {
  const res  = await fetch(API_LIST);
  allIcons   = await res.json();
  renderGrid(allIcons);
}

function renderGrid(icons) {
  const grid = document.getElementById('iconGrid');
  document.getElementById('countBadge').textContent = icons.length + ' أيقونة';

  if (!icons.length) {
    grid.innerHTML = `<div class="empty" style="grid-column:1/-1">
      <i class="ti ti-mood-empty"></i>
      <div class="empty-ttl">لا توجد أيقونات بعد</div>
      <div class="empty-sub">ارفع أيقوناتك من المنطقة أعلاه</div>
    </div>`;
    return;
  }

  grid.innerHTML = icons.map(ic => `
    <div class="ic" title="${ic.name}" onclick="copyName('${ic.name}')">
      <button class="ic-del" title="حذف" onclick="event.stopPropagation();deleteIcon('${ic.file}',this)">
        <i class="ti ti-x"></i>
      </button>
      <img src="${ic.url}" alt="${ic.name}" loading="lazy" onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 24 24%22><text y=%2218%22 font-size=%2218%22>🖼</text></svg>'"/>
      <span class="ic-name">${ic.name}</span>
    </div>
  `).join('');
}

function filterIcons() {
  const q = document.getElementById('searchInput').value.toLowerCase();
  renderGrid(q ? allIcons.filter(ic => ic.name.toLowerCase().includes(q)) : allIcons);
}

/* ── Copy name ── */
function copyName(name) {
  navigator.clipboard.writeText(name).then(() => toast('تم نسخ الاسم: ' + name, 'ok'));
}

/* ── Upload ── */
document.getElementById('fileInput').addEventListener('change', function() {
  if (this.files.length) uploadFiles(this.files);
});

const zone = document.getElementById('uploadZone');
zone.addEventListener('dragover', e => { e.preventDefault(); zone.classList.add('drag'); });
zone.addEventListener('dragleave', () => zone.classList.remove('drag'));
zone.addEventListener('drop', e => {
  e.preventDefault();
  zone.classList.remove('drag');
  if (e.dataTransfer.files.length) uploadFiles(e.dataTransfer.files);
});

async function uploadFiles(files) {
  const bar  = document.getElementById('progressBar');
  const fill = document.getElementById('progressFill');
  bar.style.display = 'block';
  fill.style.width  = '30%';

  const fd = new FormData();
  Array.from(files).forEach(f => fd.append('icons[]', f));
  fd.append('_token', CSRF);

  try {
    fill.style.width = '70%';
    const res  = await fetch(API_UPLOAD, { method: 'POST', body: fd });
    const data = await res.json();
    fill.style.width = '100%';

    if (res.ok) {
      toast(data.message, 'ok');
      setTimeout(() => { bar.style.display='none'; fill.style.width='0'; }, 600);
      await loadIcons();
    } else {
      toast(data.message || 'حدث خطأ أثناء الرفع', 'err');
      bar.style.display = 'none';
    }
  } catch {
    toast('فشل الاتصال بالسيرفر', 'err');
    bar.style.display = 'none';
  }

  document.getElementById('fileInput').value = '';
}

/* ── Delete ── */
async function deleteIcon(file, btn) {
  if (!confirm('حذف هذه الأيقونة؟')) return;
  const res  = await fetch(API_DELETE, {
    method: 'DELETE',
    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
    body: JSON.stringify({ file }),
  });
  const data = await res.json();
  if (res.ok) {
    toast(data.message, 'ok');
    btn.closest('.ic').remove();
    allIcons = allIcons.filter(ic => ic.file !== file);
    document.getElementById('countBadge').textContent = allIcons.length + ' أيقونة';
  } else {
    toast(data.message || 'فشل الحذف', 'err');
  }
}

/* ── Toast ── */
function toast(msg, type='ok') {
  const t = document.getElementById('toast');
  t.textContent = msg;
  t.className   = 'toast show ' + type;
  setTimeout(() => t.classList.remove('show'), 3000);
}

loadIcons();
</script>
</body>
</html>