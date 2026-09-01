<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>لوحة التحكم — {{ $office->name_ar }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
<style>
/* ══ RESET & BASE ══ */
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Cairo',sans-serif;background:#F0F2F8;min-height:100vh;color:#1a1a1a}
:root{--pri:#1A237E;--pri2:#3949AB;--sec:#E8EAFF;--ok:#1B5E20;--warn:#E65100;--info:#0277BD;--err:#C62828;--s1:#fff;--s2:#F8F9FF;--bd:#E8EAFF;--t1:#1a1a1a;--t2:#555;--t3:#999;--rad:14px;--sh:0 4px 20px rgba(26,35,126,.10)}

/* ══ LAYOUT ══ */
.layout{display:flex;min-height:100vh}

/* ══ SIDEBAR ══ */
.sidebar{width:240px;background:linear-gradient(180deg,#0d1b4b 0%,#1A237E 100%);position:fixed;top:0;right:0;height:100vh;display:flex;flex-direction:column;z-index:200;transition:.3s}
.sb-head{padding:22px 18px 16px;border-bottom:1px solid rgba(255,255,255,.1)}
.sb-logo{display:flex;align-items:center;gap:10px}
.sb-logo-ico{width:38px;height:38px;background:rgba(255,255,255,.15);border-radius:10px;display:flex;align-items:center;justify-content:center}
.sb-logo-ico i{color:#fff;font-size:20px}
.sb-brand{color:#fff;font-size:15px;font-weight:800;line-height:1.2}
.sb-sub{color:rgba(255,255,255,.55);font-size:11px}
.sb-office{padding:14px 18px;border-bottom:1px solid rgba(255,255,255,.08)}
.sb-office-nm{color:#fff;font-size:13px;font-weight:700;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.sb-office-type{font-size:11px;color:rgba(255,255,255,.5);margin-top:2px}
.sb-nav{flex:1;padding:12px 10px;overflow-y:auto}
.sb-lbl{font-size:10px;font-weight:800;color:rgba(255,255,255,.35);letter-spacing:.08em;text-transform:uppercase;padding:8px 10px 4px}
.sb-item{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:10px;color:rgba(255,255,255,.65);font-size:13px;font-weight:600;cursor:pointer;transition:.2s;margin-bottom:2px;text-decoration:none}
.sb-item:hover,.sb-item.active{background:rgba(255,255,255,.12);color:#fff}
.sb-item i{font-size:18px;flex-shrink:0}
.sb-badge{margin-right:auto;background:#E65100;color:#fff;font-size:10px;font-weight:800;padding:2px 7px;border-radius:20px;min-width:20px;text-align:center}
.sb-foot{padding:14px 18px;border-top:1px solid rgba(255,255,255,.08)}
.sb-logout{display:flex;align-items:center;gap:8px;color:rgba(255,255,255,.5);font-size:13px;cursor:pointer;background:none;border:none;font-family:'Cairo',sans-serif;font-weight:600;padding:8px 12px;border-radius:10px;width:100%;transition:.2s}
.sb-logout:hover{background:rgba(198,40,40,.2);color:#ff7070}

/* ══ MAIN ══ */
.main{margin-right:240px;flex:1;display:flex;flex-direction:column;min-height:100vh}
.topbar{background:#fff;padding:14px 28px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #E8EAFF;position:sticky;top:0;z-index:100;box-shadow:0 2px 12px rgba(26,35,126,.06)}
.topbar-title{font-size:17px;font-weight:800;color:var(--pri)}
.topbar-user{display:flex;align-items:center;gap:10px}
.topbar-av{width:36px;height:36px;border-radius:10px;background:var(--pri);color:#fff;display:flex;align-items:center;justify-content:center;font-size:15px;font-weight:800}
.topbar-nm{font-size:13px;font-weight:700;color:#333}
.topbar-role{font-size:11px;color:#888}
.page{padding:24px 28px;flex:1}

/* ══ STATS CARDS ══ */
.stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:14px;margin-bottom:24px}
.stat{background:#fff;border-radius:var(--rad);padding:18px;display:flex;align-items:center;gap:14px;box-shadow:var(--sh)}
.stat-ico{width:46px;height:46px;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.stat-ico i{font-size:22px}
.stat-val{font-size:24px;font-weight:800;color:var(--pri);line-height:1}
.stat-lbl{font-size:12px;color:var(--t2);margin-top:3px}

/* ══ REQUESTS TABLE ══ */
.panel{background:#fff;border-radius:var(--rad);box-shadow:var(--sh);overflow:hidden}
.panel-head{padding:16px 20px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #F0F2F8;flex-wrap:wrap;gap:10px}
.panel-title{font-size:15px;font-weight:800;color:var(--pri)}
.panel-tools{display:flex;align-items:center;gap:8px;flex-wrap:wrap}
.inp-search{padding:8px 12px;border:1.5px solid #E0E0E0;border-radius:8px;font-size:13px;font-family:'Cairo',sans-serif;outline:none;min-width:200px;transition:.2s}
.inp-search:focus{border-color:var(--pri)}
.btn{display:inline-flex;align-items:center;gap:6px;padding:8px 14px;border-radius:8px;font-size:13px;font-weight:700;font-family:'Cairo',sans-serif;cursor:pointer;border:none;transition:.2s}
.btn-pri{background:var(--pri);color:#fff}
.btn-pri:hover{background:var(--pri2)}
.btn-ghost{background:#F0F2F8;color:#555}
.btn-ghost:hover{background:#E0E3FF;color:var(--pri)}
.btn-sm{padding:6px 12px;font-size:12px}
.status-tabs{display:flex;gap:4px;flex-wrap:wrap}
.stab{padding:6px 12px;border-radius:8px;font-size:12px;font-weight:700;cursor:pointer;border:1.5px solid #E0E0E0;background:#fff;color:#666;transition:.2s;white-space:nowrap}
.stab.active,.stab:hover{border-color:var(--pri);color:var(--pri);background:var(--sec)}
table{width:100%;border-collapse:collapse}
th{background:#F8F9FF;font-size:12px;font-weight:800;color:#555;padding:11px 14px;text-align:right;white-space:nowrap}
td{padding:12px 14px;font-size:13px;border-bottom:1px solid #F5F5F5;vertical-align:middle}
tr:last-child td{border-bottom:none}
tr:hover td{background:#FAFCFF}
.ref{font-weight:800;color:var(--pri);font-size:12px;font-family:monospace}
.badge{display:inline-block;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:800}
.b-pending    {background:rgba(230,81,0,.1);   color:#E65100}
.b-accepted   {background:rgba(2,119,189,.1);   color:#0277BD}
.b-in_progress{background:rgba(249,168,37,.12); color:#F57F17}
.b-waiting_docs{background:rgba(106,27,154,.1); color:#6A1B9A}
.b-done       {background:rgba(27,94,32,.1);    color:#1B5E20}
.b-rejected   {background:rgba(198,40,40,.1);   color:#C62828}
.b-null,.b-   {background:#F0F0F0;color:#888}
.act-btn{background:none;border:none;cursor:pointer;color:#888;font-size:18px;padding:4px;border-radius:6px;transition:.2s}
.act-btn:hover{color:var(--pri);background:var(--sec)}
.empty{padding:48px;text-align:center;color:var(--t3)}
.empty i{font-size:48px;display:block;margin-bottom:10px}
.pager{display:flex;align-items:center;justify-content:flex-end;gap:8px;padding:14px 20px;border-top:1px solid #F0F2F8}
.pager-info{font-size:12px;color:var(--t3);margin-left:auto}
.pager-btn{padding:6px 12px;border-radius:7px;font-size:12px;font-weight:700;border:1.5px solid #E0E0E0;background:#fff;cursor:pointer;transition:.2s}
.pager-btn:disabled{opacity:.35;cursor:default}
.pager-btn:not(:disabled):hover{border-color:var(--pri);color:var(--pri)}

/* ══ MODAL ══ */
.overlay{position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:500;display:none;align-items:center;justify-content:center;padding:20px}
.overlay.open{display:flex}
.modal{background:#fff;border-radius:20px;width:100%;max-width:640px;max-height:90vh;display:flex;flex-direction:column;overflow:hidden}
.modal-head{padding:18px 22px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #F0F2F8;flex-shrink:0}
.modal-title{font-size:16px;font-weight:800;color:var(--pri)}
.modal-close{background:none;border:none;font-size:22px;cursor:pointer;color:#888;width:34px;height:34px;border-radius:8px;display:flex;align-items:center;justify-content:center;transition:.2s}
.modal-close:hover{background:#F0F2F8;color:#333}
.modal-body{padding:20px 22px;overflow-y:auto;flex:1}
.modal-foot{padding:14px 22px;border-top:1px solid #F0F2F8;display:flex;gap:8px;justify-content:flex-end;flex-shrink:0;flex-wrap:wrap}
.info-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:18px}
.info-item label{font-size:11px;font-weight:800;color:var(--t3);text-transform:uppercase;letter-spacing:.05em}
.info-item p{font-size:13.5px;color:var(--t1);font-weight:600;margin-top:3px}
.sec-sep{font-size:12px;font-weight:800;color:var(--pri);background:var(--sec);padding:7px 12px;border-radius:8px;margin:14px 0 10px}

/* ══ STATUS SELECTOR ══ */
.status-sel{display:grid;grid-template-columns:repeat(3,1fr);gap:8px;margin-bottom:14px}
.s-opt{border:2px solid #E0E0E0;border-radius:10px;padding:10px 8px;text-align:center;cursor:pointer;transition:.2s;background:#FAFAFA}
.s-opt:hover,.s-opt.active{border-color:var(--pri);background:var(--sec)}
.s-opt i{font-size:20px;display:block;margin-bottom:4px;color:var(--pri)}
.s-opt span{font-size:11px;font-weight:700;color:#444}
.s-opt input{display:none}

/* ══ MESSAGES ══ */
.chat{display:flex;flex-direction:column;gap:10px;max-height:300px;overflow-y:auto;padding:4px 0;margin-bottom:12px}
.msg{max-width:80%;padding:10px 14px;border-radius:14px;font-size:13px;line-height:1.6}
.msg-office{align-self:flex-end;background:linear-gradient(135deg,#1A237E,#3949AB);color:#fff;border-radius:14px 14px 4px 14px}
.msg-client{align-self:flex-start;background:#F0F2F8;color:#333;border-radius:14px 14px 14px 4px}
.msg-meta{font-size:10px;opacity:.65;margin-top:4px}
.msg-area{width:100%;border:1.5px solid #E0E0E0;border-radius:10px;padding:10px 13px;font-size:13px;font-family:'Cairo',sans-serif;resize:vertical;min-height:70px;outline:none;transition:.2s}
.msg-area:focus{border-color:var(--pri)}

/* ══ LOADER ══ */
.spin{display:inline-block;width:20px;height:20px;border:2.5px solid rgba(26,35,126,.2);border-top-color:var(--pri);border-radius:50%;animation:spin .6s linear infinite}
@keyframes spin{to{transform:rotate(360deg)}}
.loading-row td{text-align:center;padding:40px;color:var(--t3)}

/* ══ TOAST ══ */
#toast{position:fixed;bottom:24px;right:24px;z-index:9999;display:none;align-items:center;gap:10px;padding:12px 18px;border-radius:12px;font-size:13.5px;font-weight:700;box-shadow:0 8px 24px rgba(0,0,0,.2);animation:toastIn .3s ease;font-family:'Cairo',sans-serif}
@keyframes toastIn{from{opacity:0;transform:translateY(16px)}to{opacity:1;transform:translateY(0)}}

/* ══ RESPONSIVE ══ */
@media(max-width:768px){
  .sidebar{width:220px;transform:translateX(220px)}
  .sidebar.open{transform:translateX(0)}
  .main{margin-right:0}
  .mob-tog{display:flex}
  .info-grid{grid-template-columns:1fr}
  .status-sel{grid-template-columns:repeat(2,1fr)}
  .stats{grid-template-columns:repeat(2,1fr)}
}
.mob-tog{display:none;background:none;border:none;font-size:22px;cursor:pointer;color:var(--pri);padding:4px}

/* ══ FORM FIELDS ══ */
.form-grp{margin-bottom:14px}
.form-lbl{font-size:12px;font-weight:800;color:var(--t2);margin-bottom:5px;display:block}
.form-ctrl{width:100%;padding:9px 13px;border:1.5px solid #E0E0E0;border-radius:9px;font-size:13.5px;font-family:'Cairo',sans-serif;outline:none;transition:.2s;color:var(--t1)}
.form-ctrl:focus{border-color:var(--pri);box-shadow:0 0 0 3px rgba(26,35,126,.07)}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
@media(max-width:480px){.form-row{grid-template-columns:1fr}}
.toggle-wrap{display:flex;align-items:center;gap:10px;cursor:pointer;user-select:none}
.toggle{width:40px;height:22px;border-radius:11px;background:#E0E0E0;position:relative;transition:.2s;cursor:pointer;border:none;flex-shrink:0;padding:0}
.toggle.on{background:var(--pri)}
.toggle::after{content:'';position:absolute;top:2px;left:2px;width:18px;height:18px;border-radius:50%;background:#fff;transition:.25s;box-shadow:0 1px 3px rgba(0,0,0,.2)}
.toggle.on::after{transform:translateX(18px)}
.toggle-lbl{font-size:13px;font-weight:600;color:#555}
.del-btn{background:rgba(198,40,40,.08);border:none;cursor:pointer;color:#C62828;font-size:17px;padding:6px 8px;border-radius:8px;transition:.2s;font-family:'Cairo',sans-serif}
.del-btn:hover{background:rgba(198,40,40,.18)}
.edit-btn{background:rgba(26,35,126,.07);border:none;cursor:pointer;color:var(--pri);font-size:17px;padding:6px 8px;border-radius:8px;transition:.2s;font-family:'Cairo',sans-serif}
.edit-btn:hover{background:var(--sec)}
.price-tag{font-weight:800;color:var(--pri)}
</style>
</head>
<body>
@php
  $officeUser = auth('office')->user();
  $typeLabel  = \App\Models\Business\Office::$typeLabels[$office->type]['ar'] ?? $office->type;
@endphp

<!-- SIDEBAR -->
<div class="sidebar" id="sb">
  <div class="sb-head">
    <div class="sb-logo">
      <div class="sb-logo-ico"><i class="ti ti-building-skyscraper"></i></div>
      <div><div class="sb-brand">آمر تم</div><div class="sb-sub">منصة المكاتب المهنية</div></div>
    </div>
  </div>
  <div class="sb-office">
    <div class="sb-office-nm">{{ $office->name_ar }}</div>
    <div class="sb-office-type">{{ $typeLabel }}</div>
  </div>
  <nav class="sb-nav">
    <div class="sb-lbl">القائمة</div>
    <a class="sb-item active" onclick="showPage('dash')"><i class="ti ti-layout-dashboard"></i> الرئيسية</a>
    <a class="sb-item" onclick="showPage('reqs')"><i class="ti ti-file-text"></i> الطلبات <span class="sb-badge" id="sb-pending">0</span></a>
    <a class="sb-item" onclick="showPage('services')"><i class="ti ti-list-details"></i> خدماتي</a>
    <a class="sb-item" onclick="showPage('direct-reqs')"><i class="ti ti-inbox"></i> الطلبات المباشرة <span class="sb-badge" id="sb-direct" style="display:none">0</span></a>
    <a class="sb-item" onclick="showPage('finance')"><i class="ti ti-chart-bar"></i> التقرير المالي</a>

    <div class="sb-lbl" style="margin-top:8px">الحساب</div>
    <a class="sb-item" href="{{ route('amrtm.office.profile') }}"><i class="ti ti-user-circle"></i> ملف المكتب</a>
    <a class="sb-item" href="{{ route('amrtm.index') }}"><i class="ti ti-world"></i> المنصة الرئيسية</a>
  </nav>
  <div class="sb-foot">
    <form method="POST" action="{{ route('amrtm.office.logout') }}">
      @csrf
      <button type="submit" class="sb-logout"><i class="ti ti-logout"></i> تسجيل الخروج</button>
    </form>
  </div>
</div>

<!-- MAIN -->
<div class="main">
  <!-- Office Notification Panel -->
  <div id="office-notif-panel" style="position:fixed;top:66px;left:16px;width:320px;max-height:420px;background:#fff;border-radius:14px;border:1.5px solid #E8EAFF;box-shadow:0 8px 32px rgba(26,35,126,.18);z-index:500;display:none;flex-direction:column;overflow:hidden">
    <div style="padding:.85rem 1rem;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #F0F2F8">
      <span style="font-size:14px;font-weight:800;color:var(--pri)">الإشعارات</span>
      <span onclick="officeMarkAllRead()" style="font-size:11.5px;color:var(--pri);cursor:pointer;font-weight:600">تعليم الكل كمقروء</span>
    </div>
    <div id="office-notif-list" style="overflow-y:auto;flex:1;max-height:340px"></div>
  </div>

  <div class="topbar">
    <div style="display:flex;align-items:center;gap:10px">
      <button class="mob-tog" onclick="document.getElementById('sb').classList.toggle('open')">
        <i class="ti ti-menu-2"></i>
      </button>
      <div class="topbar-title" id="page-title">الرئيسية</div>
    </div>
    <div class="topbar-user">
      <div class="topbar-av" onclick="toggleOfficeNotifPanel()" id="notif-bell" title="الإشعارات" style="cursor:pointer;position:relative;margin-left:6px">
        <i class="ti ti-bell" style="font-size:18px"></i>
        <span id="off-notif-badge" style="display:none;position:absolute;top:-4px;right:-4px;background:#C62828;color:#fff;font-size:9px;font-weight:800;padding:2px 5px;border-radius:10px;min-width:16px;text-align:center;border:2px solid #fff;line-height:1.2">0</span>
      </div>
      <div class="topbar-av">{{ mb_substr($officeUser->name, 0, 1) }}</div>
      <div>
        <div class="topbar-nm">{{ $officeUser->name }}</div>
        <div class="topbar-role">{{ $officeUser->role === 'owner' ? 'المالك' : ($officeUser->role === 'manager' ? 'مدير' : 'موظف') }}</div>
      </div>
    </div>
  </div>

  <div class="page">

    <!-- ══ PAGE: DASHBOARD ══ -->
    <div id="pg-dash">
      <div class="stats" id="stats-grid">
        <div class="stat"><div class="stat-ico" style="background:rgba(26,35,126,.1)"><i class="ti ti-files" style="color:var(--pri)"></i></div><div><div class="stat-val" id="st-total">—</div><div class="stat-lbl">إجمالي الطلبات</div></div></div>
        <div class="stat"><div class="stat-ico" style="background:rgba(230,81,0,.1)"><i class="ti ti-clock" style="color:#E65100"></i></div><div><div class="stat-val" id="st-pending" style="color:#E65100">—</div><div class="stat-lbl">قيد الانتظار</div></div></div>
        <div class="stat"><div class="stat-ico" style="background:rgba(2,119,189,.1)"><i class="ti ti-loader" style="color:#0277BD"></i></div><div><div class="stat-val" id="st-ip" style="color:#0277BD">—</div><div class="stat-lbl">جاري التنفيذ</div></div></div>
        <div class="stat"><div class="stat-ico" style="background:rgba(27,94,32,.1)"><i class="ti ti-circle-check" style="color:#1B5E20"></i></div><div><div class="stat-val" id="st-done" style="color:#1B5E20">—</div><div class="stat-lbl">مكتملة</div></div></div>
        <div class="stat"><div class="stat-ico" style="background:rgba(106,27,154,.1)"><i class="ti ti-message-dots" style="color:#6A1B9A"></i></div><div><div class="stat-val" id="st-msgs" style="color:#6A1B9A">—</div><div class="stat-lbl">رسائل غير مقروءة</div></div></div>
      </div>

      @if(!$office->is_verified)
      <div style="background:rgba(230,81,0,.07);border:1px solid rgba(230,81,0,.25);border-radius:14px;padding:16px 20px;margin-bottom:20px;display:flex;align-items:center;gap:12px">
        <i class="ti ti-info-circle" style="font-size:22px;color:#E65100;flex-shrink:0"></i>
        <div>
          <div style="font-weight:800;color:#E65100">حسابك قيد المراجعة</div>
          <div style="font-size:13px;color:#666;margin-top:2px">سيتم تفعيل حسابك بشكل كامل بعد مراجعته من قِبل إدارة المنصة. قد يستغرق ذلك 24–48 ساعة.</div>
        </div>
      </div>
      @endif

      <!-- Quick requests preview -->
      <div class="panel">
        <div class="panel-head">
          <span class="panel-title"><i class="ti ti-file-text"></i> أحدث الطلبات</span>
          <button class="btn btn-ghost btn-sm" onclick="showPage('reqs')"><i class="ti ti-arrow-left"></i> عرض الكل</button>
        </div>
        <div id="dash-req-wrap">
          <table><thead><tr><th>المرجع</th><th>العميل</th><th>الخدمة</th><th>الحالة</th><th>التاريخ</th><th></th></tr></thead>
          <tbody id="dash-req-body"><tr class="loading-row"><td colspan="6"><span class="spin"></span></td></tr></tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ══ PAGE: REQUESTS ══ -->
    <div id="pg-reqs" style="display:none">
      <div class="panel">
        <div class="panel-head">
          <span class="panel-title"><i class="ti ti-files"></i> جميع الطلبات</span>
          <div class="panel-tools">
            <input class="inp-search" id="req-search" placeholder="ابحث باسم العميل أو رقم المرجع..." oninput="debSearch()">
            <button class="btn btn-ghost btn-sm" onclick="loadRequests()"><i class="ti ti-refresh"></i></button>
          </div>
        </div>
        <div style="padding:12px 16px;border-bottom:1px solid #F0F2F8">
          <div class="status-tabs" id="status-tabs">
            <span class="stab active" data-s="all" onclick="setStatus(this)">الكل</span>
            <span class="stab" data-s="pending"     onclick="setStatus(this)">انتظار</span>
            <span class="stab" data-s="accepted"    onclick="setStatus(this)">مقبول</span>
            <span class="stab" data-s="in_progress" onclick="setStatus(this)">جاري</span>
            <span class="stab" data-s="waiting_docs" onclick="setStatus(this)">ينتظر مستندات</span>
            <span class="stab" data-s="done"        onclick="setStatus(this)">مكتمل</span>
            <span class="stab" data-s="rejected"    onclick="setStatus(this)">مرفوض</span>
          </div>
        </div>
        <div style="overflow-x:auto">
          <table><thead><tr><th>المرجع</th><th>العميل</th><th>الجوال</th><th>الخدمة</th><th>الجهة</th><th>الحالة</th><th>التاريخ</th><th></th></tr></thead>
          <tbody id="req-body"><tr class="loading-row"><td colspan="8"><span class="spin"></span></td></tr></tbody>
          </table>
        </div>
        <div class="pager">
          <span class="pager-info" id="pager-info"></span>
          <button class="pager-btn" id="pager-prev" onclick="changePage(-1)" disabled>السابق</button>
          <button class="pager-btn" id="pager-next" onclick="changePage(1)">التالي</button>
        </div>
      </div>
    </div>

    <!-- ══ PAGE: SERVICES ══ -->
    <div id="pg-services" style="display:none">
      <div class="panel">
        <div class="panel-head">
          <span class="panel-title"><i class="ti ti-list-details"></i> خدماتي</span>
          <button class="btn btn-pri btn-sm" onclick="openSvcModal()"><i class="ti ti-plus"></i> إضافة خدمة</button>
        </div>
        <div style="overflow-x:auto">
          <table>
            <thead><tr><th>اسم الخدمة</th><th>السعر</th><th>المدة</th><th>الوصف</th><th>الحالة</th><th></th></tr></thead>
            <tbody id="svc-body"><tr class="loading-row"><td colspan="6"><span class="spin"></span></td></tr></tbody>
          </table>
        </div>
        <div id="svc-empty" style="display:none">
          <div class="empty"><i class="ti ti-list-details"></i><p style="margin-top:8px">لم تُضف أي خدمات بعد.<br>أضف خدماتك لتظهر للعملاء في صفحة مكتبك.</p></div>
        </div>
      </div>
    </div>

    <!-- ══ PAGE: FINANCIAL REPORT ══ -->
    <div id="pg-finance" style="display:none">
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:14px;margin-bottom:20px" id="fin-stats">
        <div class="stat"><div class="stat-ico" style="background:rgba(26,35,126,.1)"><i class="ti ti-files" style="color:var(--pri)"></i></div><div><div class="stat-val" id="fin-total">—</div><div class="stat-lbl">إجمالي الطلبات</div></div></div>
        <div class="stat"><div class="stat-ico" style="background:rgba(27,94,32,.1)"><i class="ti ti-coins" style="color:#1B5E20"></i></div><div><div class="stat-val" id="fin-gross" style="color:#1B5E20">—</div><div class="stat-lbl">إجمالي الإيرادات</div></div></div>
        <div class="stat"><div class="stat-ico" style="background:rgba(198,40,40,.1)"><i class="ti ti-percentage" style="color:#C62828"></i></div><div><div class="stat-val" id="fin-comm" style="color:#C62828">—</div><div class="stat-lbl">عمولة المنصة</div></div></div>
        <div class="stat"><div class="stat-ico" style="background:rgba(2,119,189,.1)"><i class="ti ti-wallet" style="color:#0277BD"></i></div><div><div class="stat-val" id="fin-net" style="color:#0277BD">—</div><div class="stat-lbl">الصافي بعد العمولة</div></div></div>
      </div>
      <div class="panel" style="margin-bottom:16px">
        <div class="panel-head">
          <span class="panel-title"><i class="ti ti-calendar"></i> الأداء الشهري</span>
          <div style="display:flex;gap:8px">
            <input type="date" id="fin-from" class="inp-search" style="min-width:auto;width:140px" onchange="loadFinancial()">
            <input type="date" id="fin-to"   class="inp-search" style="min-width:auto;width:140px" onchange="loadFinancial()">
            <button class="btn btn-ghost btn-sm" onclick="exportFinancialCSV()"><i class="ti ti-download"></i> تصدير</button>
          </div>
        </div>
        <div style="overflow-x:auto">
          <table>
            <thead><tr><th>الشهر</th><th>الطلبات</th><th>الإجمالي</th><th>العمولة</th><th>الصافي</th></tr></thead>
            <tbody id="fin-monthly"><tr class="loading-row"><td colspan="5"><span class="spin"></span></td></tr></tbody>
          </table>
        </div>
      </div>
      <div class="panel">
        <div class="panel-head"><span class="panel-title"><i class="ti ti-history"></i> آخر المعاملات</span></div>
        <div style="overflow-x:auto">
          <table>
            <thead><tr><th>المرجع</th><th>العميل</th><th>المبلغ</th><th>العمولة</th><th>الصافي</th><th>الحالة</th><th>التاريخ</th></tr></thead>
            <tbody id="fin-recent"><tr class="loading-row"><td colspan="7"><span class="spin"></span></td></tr></tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ══ PAGE: DIRECT REQUESTS ══ -->
    <div id="pg-direct-reqs" style="display:none">
      <div class="panel">
        <div class="panel-head">
          <span class="panel-title"><i class="ti ti-inbox"></i> الطلبات المباشرة</span>
          <button class="btn btn-ghost btn-sm" onclick="loadDirectReqs()"><i class="ti ti-refresh"></i></button>
        </div>
        <div style="padding:12px 16px;border-bottom:1px solid #F0F2F8">
          <div class="status-tabs" id="dr-tabs">
            <span class="stab active" data-s="all" onclick="setDRStatus(this)">الكل</span>
            <span class="stab" data-s="pending"     onclick="setDRStatus(this)">انتظار</span>
            <span class="stab" data-s="accepted"    onclick="setDRStatus(this)">مقبول</span>
            <span class="stab" data-s="in_progress" onclick="setDRStatus(this)">جاري</span>
            <span class="stab" data-s="done"        onclick="setDRStatus(this)">مكتمل</span>
            <span class="stab" data-s="rejected"    onclick="setDRStatus(this)">مرفوض</span>
          </div>
        </div>
        <div style="overflow-x:auto">
          <table>
            <thead><tr><th>المرجع</th><th>العميل</th><th>الجوال</th><th>الخدمة</th><th>السعر</th><th>الحالة</th><th>التاريخ</th><th></th></tr></thead>
            <tbody id="dr-body"><tr class="loading-row"><td colspan="8"><span class="spin"></span></td></tr></tbody>
          </table>
        </div>
        <div class="pager">
          <span class="pager-info" id="dr-pager-info"></span>
          <button class="pager-btn" id="dr-prev" onclick="changeDRPage(-1)" disabled>السابق</button>
          <button class="pager-btn" id="dr-next" onclick="changeDRPage(1)">التالي</button>
        </div>
      </div>
    </div>

  </div><!-- /page -->
</div><!-- /main -->

<!-- ══ REQUEST DETAIL MODAL ══ -->
<div class="overlay" id="req-modal">
  <div class="modal">
    <div class="modal-head">
      <span class="modal-title" id="m-title">تفاصيل الطلب</span>
      <button class="modal-close" onclick="closeModal()"><i class="ti ti-x"></i></button>
    </div>
    <div class="modal-body">
      <!-- Client info -->
      <div class="info-grid" id="m-info"></div>

      <!-- Status update -->
      <div class="sec-sep"><i class="ti ti-edit"></i> تحديث الحالة</div>
      <div class="status-sel" id="status-sel">
        <label class="s-opt" data-v="accepted"><input type="radio" name="ostatus" value="accepted"><i class="ti ti-check"></i><span>مقبول</span></label>
        <label class="s-opt" data-v="in_progress"><input type="radio" name="ostatus" value="in_progress"><i class="ti ti-loader"></i><span>جاري التنفيذ</span></label>
        <label class="s-opt" data-v="waiting_docs"><input type="radio" name="ostatus" value="waiting_docs"><i class="ti ti-file-upload"></i><span>ينتظر مستندات</span></label>
        <label class="s-opt" data-v="done"><input type="radio" name="ostatus" value="done"><i class="ti ti-circle-check"></i><span>تم التنفيذ</span></label>
        <label class="s-opt" data-v="rejected"><input type="radio" name="ostatus" value="rejected"><i class="ti ti-x"></i><span>مرفوض</span></label>
      </div>
      <textarea class="msg-area" id="status-note" placeholder="ملاحظة للعميل مع تحديث الحالة (اختياري)..." rows="2" style="margin-bottom:12px"></textarea>
      <button class="btn btn-pri" style="width:100%;margin-bottom:16px" onclick="doUpdateStatus()" id="upd-btn"><i class="ti ti-device-floppy"></i> حفظ الحالة</button>

      <!-- Messages -->
      <div class="sec-sep"><i class="ti ti-messages"></i> الرسائل مع العميل</div>
      <div class="chat" id="chat-box"></div>
      <textarea class="msg-area" id="msg-inp" placeholder="اكتب رسالة للعميل..." rows="3"></textarea>
    </div>
    <div class="modal-foot">
      <button class="btn btn-ghost" onclick="closeModal()">إغلاق</button>
      <button class="btn btn-pri" onclick="doSendMsg()" id="send-btn"><i class="ti ti-send"></i> إرسال</button>
    </div>
  </div>
</div>

<!-- ══ SERVICE CRUD MODAL ══ -->
<div class="overlay" id="svc-modal">
  <div class="modal">
    <div class="modal-head">
      <span class="modal-title" id="svc-modal-title">إضافة خدمة جديدة</span>
      <button class="modal-close" onclick="closeSvcModal()"><i class="ti ti-x"></i></button>
    </div>
    <div class="modal-body">
      <input type="hidden" id="svc-id" value="">
      <div class="form-row">
        <div class="form-grp">
          <label class="form-lbl">اسم الخدمة (عربي) *</label>
          <input class="form-ctrl" id="svc-name-ar" type="text" placeholder="اسم الخدمة بالعربية">
        </div>
        <div class="form-grp">
          <label class="form-lbl">اسم الخدمة (إنجليزي) *</label>
          <input class="form-ctrl" id="svc-name-en" type="text" placeholder="Service name in English">
        </div>
      </div>
      <div class="form-row">
        <div class="form-grp">
          <label class="form-lbl">السعر (ريال) *</label>
          <input class="form-ctrl" id="svc-price" type="number" min="0" step="0.01" placeholder="0.00">
        </div>
        <div class="form-grp">
          <label class="form-lbl">المدة الزمنية</label>
          <input class="form-ctrl" id="svc-duration" type="text" placeholder="مثال: 3–5 أيام عمل">
        </div>
      </div>
      <div class="form-grp">
        <label class="form-lbl">وصف الخدمة (عربي)</label>
        <textarea class="form-ctrl" id="svc-desc-ar" rows="2" placeholder="وصف مختصر للخدمة بالعربية"></textarea>
      </div>
      <div class="form-grp">
        <label class="form-lbl">وصف الخدمة (إنجليزي)</label>
        <textarea class="form-ctrl" id="svc-desc-en" rows="2" placeholder="Brief service description in English"></textarea>
      </div>
      <div class="form-grp">
        <label class="toggle-wrap">
          <button type="button" class="toggle on" id="svc-active-toggle" onclick="toggleSvcActive()"></button>
          <span class="toggle-lbl" id="svc-active-lbl">الخدمة مفعّلة (ستظهر للعملاء)</span>
        </label>
      </div>
    </div>
    <div class="modal-foot">
      <button class="btn btn-ghost" onclick="closeSvcModal()">إلغاء</button>
      <button class="btn btn-pri" id="svc-save-btn" onclick="saveSvc()"><i class="ti ti-device-floppy"></i> حفظ</button>
    </div>
  </div>
</div>

<!-- ══ DIRECT REQUEST STATUS MODAL ══ -->
<div class="overlay" id="dr-modal">
  <div class="modal" style="max-width:480px">
    <div class="modal-head">
      <span class="modal-title" id="dr-modal-title">تحديث حالة الطلب</span>
      <button class="modal-close" onclick="closeDRModal()"><i class="ti ti-x"></i></button>
    </div>
    <div class="modal-body">
      <input type="hidden" id="dr-req-id" value="">
      <div class="form-grp" style="margin-bottom:14px">
        <div id="dr-info" style="font-size:13px;color:#555;background:#F8F9FF;border:1px solid #E8EAFF;border-radius:10px;padding:12px 14px;line-height:1.8"></div>
      </div>
      <div class="sec-sep"><i class="ti ti-edit"></i> تحديث الحالة</div>
      <div class="status-sel" id="dr-status-sel">
        <label class="s-opt" data-v="accepted"><input type="radio" name="drstatus" value="accepted"><i class="ti ti-check"></i><span>مقبول</span></label>
        <label class="s-opt" data-v="in_progress"><input type="radio" name="drstatus" value="in_progress"><i class="ti ti-loader"></i><span>جاري التنفيذ</span></label>
        <label class="s-opt" data-v="waiting_docs"><input type="radio" name="drstatus" value="waiting_docs"><i class="ti ti-file-upload"></i><span>ينتظر مستندات</span></label>
        <label class="s-opt" data-v="done"><input type="radio" name="drstatus" value="done"><i class="ti ti-circle-check"></i><span>تم التنفيذ</span></label>
        <label class="s-opt" data-v="rejected"><input type="radio" name="drstatus" value="rejected"><i class="ti ti-x"></i><span>مرفوض</span></label>
      </div>
      <div class="form-grp" style="margin-top:14px">
        <label class="form-lbl">ملاحظة للعميل (اختياري)</label>
        <textarea class="form-ctrl" id="dr-note" rows="2" placeholder="ملاحظة أو تعليق على الطلب..."></textarea>
      </div>
    </div>
    <div class="modal-foot">
      <button class="btn btn-ghost" onclick="closeDRModal()">إلغاء</button>
      <button class="btn btn-pri" id="dr-save-btn" onclick="saveDRStatus()"><i class="ti ti-device-floppy"></i> حفظ الحالة</button>
    </div>
  </div>
</div>

<div id="toast"></div>

<script>
const CSRF   = '{{ csrf_token() }}';
const API    = '{{ url("/office/api") }}';
const ROUTES = { logout: '{{ route("amrtm.office.logout") }}' };

// ── Notifications SDK ──
window.Notifications = {
  _base: API + '/notifications',
  _h: () => ({ 'Accept':'application/json','X-CSRF-TOKEN':CSRF,'Content-Type':'application/json' }),
  getAll:     async function()    { const r = await fetch(this._base, {headers:this._h(),credentials:'same-origin'}); return r.json(); },
  unreadCount:async function()    { const r = await fetch(this._base+'/unread-count', {headers:this._h(),credentials:'same-origin'}); return r.json(); },
  markRead:   async function(id)  { await fetch(this._base+'/'+id+'/read', {method:'POST',headers:this._h(),credentials:'same-origin'}); },
  markAllRead:async function()    { await fetch(this._base+'/read-all',    {method:'POST',headers:this._h(),credentials:'same-origin'}); },
};

/* ══ HELPERS ══ */
async function req(method, url, body) {
  const opt = { method, credentials: 'same-origin', headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF } };
  if (body) { opt.headers['Content-Type'] = 'application/json'; opt.body = JSON.stringify(body); }
  const r = await fetch(url, opt);
  const j = await r.json().catch(() => ({}));
  if (!r.ok) throw j;
  return j;
}

function toast(msg, type='success') {
  const el = document.getElementById('toast');
  const colors = { success:'rgba(27,94,32,.95)', error:'rgba(198,40,40,.95)', info:'rgba(26,35,126,.95)', warning:'rgba(230,81,0,.95)' };
  const icons  = { success:'ti-circle-check', error:'ti-alert-circle', info:'ti-info-circle', warning:'ti-alert-triangle' };
  el.style.cssText = `position:fixed;bottom:24px;right:24px;z-index:9999;display:flex;align-items:center;gap:10px;padding:12px 18px;border-radius:12px;font-size:13.5px;font-weight:700;box-shadow:0 8px 24px rgba(0,0,0,.2);animation:toastIn .3s ease;font-family:'Cairo',sans-serif;background:${colors[type]||colors.info};color:#fff`;
  el.innerHTML = `<i class="ti ${icons[type]||icons.info}" style="font-size:18px"></i><span>${msg}</span>`;
  setTimeout(() => { el.style.opacity=0; el.style.transition='opacity .3s'; setTimeout(()=>el.style.display='none',300); }, 3500);
}

function fmtDate(s) {
  if (!s) return '—';
  return new Date(s).toLocaleDateString('ar-SA', { year:'numeric', month:'short', day:'numeric' });
}

const STATUS_LABELS = {
  pending:'قيد الانتظار', accepted:'مقبول', in_progress:'جاري التنفيذ',
  waiting_docs:'ينتظر مستندات', done:'تم التنفيذ', rejected:'مرفوض',
  null:'—', '':  '—',
};
function badge(s) {
  const k = s || '';
  return `<span class="badge b-${k}">${STATUS_LABELS[k]||k}</span>`;
}

/* ══ PAGES — defined below in FINANCIAL REPORT section ══ */

/* ══ STATS ══ */
async function loadStats() {
  try {
    const d = await req('GET', API+'/stats');
    const c = d.counts;
    document.getElementById('st-total').textContent   = c.total   || 0;
    document.getElementById('st-pending').textContent = (parseInt(c.pending)||0)+(parseInt(c.accepted)||0);
    document.getElementById('st-ip').textContent      = c.in_progress || 0;
    document.getElementById('st-done').textContent    = c.done    || 0;
    document.getElementById('st-msgs').textContent    = d.unread_messages || 0;
    document.getElementById('sb-pending').textContent = (parseInt(c.pending)||0)+(parseInt(c.accepted)||0);
    const dp = parseInt(d.direct_pending)||0;
    const sb = document.getElementById('sb-direct');
    sb.textContent = dp; sb.style.display = dp > 0 ? '' : 'none';
    loadDashRequests();
  } catch { }
}

/* ══ DASH QUICK LIST ══ */
async function loadDashRequests() {
  try {
    const d = await req('GET', API+'/requests?page=1');
    const tbody = document.getElementById('dash-req-body');
    if (!d.data.length) { tbody.innerHTML = '<tr><td colspan="6" style="text-align:center;padding:24px;color:#999">لا توجد طلبات</td></tr>'; return; }
    tbody.innerHTML = d.data.slice(0,5).map(r => `
      <tr>
        <td class="ref">${r.ref_number}</td>
        <td>${r.client_name}</td>
        <td style="font-size:12px;color:#666">${r.service_ar||'—'}</td>
        <td>${badge(r.office_status)}</td>
        <td style="font-size:12px;color:#999">${fmtDate(r.created_at)}</td>
        <td><button class="act-btn" onclick="openRequest(${r.id})" title="عرض"><i class="ti ti-eye"></i></button></td>
      </tr>`).join('');
  } catch { }
}

/* ══ REQUESTS LIST ══ */
let curStatus='all', curPage=1, lastPage=1, searchTimer;

function setStatus(el) {
  document.querySelectorAll('.stab').forEach(t=>t.classList.remove('active'));
  el.classList.add('active');
  curStatus = el.dataset.s;
  curPage   = 1;
  loadRequests();
}

function debSearch() {
  clearTimeout(searchTimer);
  searchTimer = setTimeout(() => { curPage=1; loadRequests(); }, 400);
}

function changePage(dir) {
  curPage = Math.max(1, Math.min(lastPage, curPage+dir));
  loadRequests();
}

async function loadRequests() {
  const tbody = document.getElementById('req-body');
  tbody.innerHTML = '<tr class="loading-row"><td colspan="8"><span class="spin"></span></td></tr>';
  const search = document.getElementById('req-search').value.trim();
  try {
    const d = await req('GET', `${API}/requests?status=${curStatus}&search=${encodeURIComponent(search)}&page=${curPage}`);
    lastPage = d.last_page;
    document.getElementById('pager-info').textContent = `${d.total} طلب — صفحة ${d.page} من ${d.last_page}`;
    document.getElementById('pager-prev').disabled = curPage <= 1;
    document.getElementById('pager-next').disabled = curPage >= lastPage;

    if (!d.data.length) {
      tbody.innerHTML = `<tr><td colspan="8"><div class="empty"><i class="ti ti-inbox"></i>لا توجد طلبات</div></td></tr>`;
      return;
    }
    tbody.innerHTML = d.data.map(r => `
      <tr>
        <td class="ref">${r.ref_number}</td>
        <td style="font-weight:600">${r.client_name}</td>
        <td style="font-size:12.5px;color:#555" dir="ltr">${r.client_phone}</td>
        <td style="font-size:12px;color:#666">${r.service_ar||'—'}</td>
        <td style="font-size:12px;color:#888">${r.entity_ar||'—'}</td>
        <td>${badge(r.office_status)}</td>
        <td style="font-size:12px;color:#999">${fmtDate(r.created_at)}</td>
        <td><button class="act-btn" onclick="openRequest(${r.id})" title="عرض / تعديل"><i class="ti ti-eye"></i></button></td>
      </tr>`).join('');
  } catch(e) {
    tbody.innerHTML = '<tr><td colspan="8" style="text-align:center;padding:24px;color:#C62828">حدث خطأ في التحميل</td></tr>';
  }
}

/* ══ REQUEST MODAL ══ */
let curReqId = null;

async function openRequest(id) {
  curReqId = id;
  document.getElementById('req-modal').classList.add('open');
  document.getElementById('m-info').innerHTML = '<div class="loading-row" style="grid-column:1/-1;text-align:center"><span class="spin"></span></div>';
  document.getElementById('chat-box').innerHTML = '';
  document.getElementById('status-note').value = '';
  document.getElementById('msg-inp').value = '';
  document.querySelectorAll('#status-sel .s-opt').forEach(o=>o.classList.remove('active'));

  try {
    const r = await req('GET', `${API}/requests/${id}`);
    document.getElementById('m-title').textContent = `طلب #${r.ref_number}`;

    document.getElementById('m-info').innerHTML = `
      <div class="info-item"><label>اسم العميل</label><p>${r.client_name}</p></div>
      <div class="info-item"><label>رقم الجوال</label><p dir="ltr">${r.client_phone}</p></div>
      <div class="info-item"><label>البريد الإلكتروني</label><p dir="ltr">${r.client_email}</p></div>
      <div class="info-item"><label>رقم الهوية</label><p>${r.client_id_number||'—'}</p></div>
      <div class="info-item"><label>اسم الشركة</label><p>${r.company_name||'—'}</p></div>
      <div class="info-item"><label>السجل التجاري</label><p>${r.company_cr||'—'}</p></div>
      <div class="info-item"><label>الخدمة المطلوبة</label><p>${r.service_ar||'—'}</p></div>
      <div class="info-item"><label>الجهة</label><p>${r.entity_ar||'—'}</p></div>
      <div class="info-item"><label>الحالة الحالية</label><p>${badge(r.office_status)}</p></div>
      <div class="info-item"><label>تاريخ الطلب</label><p>${fmtDate(r.created_at)}</p></div>
      ${r.notes ? `<div class="info-item" style="grid-column:1/-1"><label>ملاحظات العميل</label><p>${r.notes}</p></div>` : ''}
    `;

    // Pre-select current status
    if (r.office_status) {
      const opt = document.querySelector(`#status-sel .s-opt[data-v="${r.office_status}"]`);
      if (opt) { opt.classList.add('active'); opt.querySelector('input').checked = true; }
    }

    await loadMessages();
  } catch(e) {
    toast('حدث خطأ في تحميل الطلب', 'error');
    closeModal();
  }
}

function closeModal() {
  document.getElementById('req-modal').classList.remove('open');
  curReqId = null;
}

// Status option selection
document.querySelectorAll('#status-sel .s-opt').forEach(opt => {
  opt.addEventListener('click', () => {
    document.querySelectorAll('#status-sel .s-opt').forEach(o=>o.classList.remove('active'));
    opt.classList.add('active');
    opt.querySelector('input').checked = true;
  });
});

async function doUpdateStatus() {
  const sel = document.querySelector('#status-sel input[name="ostatus"]:checked');
  if (!sel) { toast('اختر الحالة أولاً', 'warning'); return; }
  const btn = document.getElementById('upd-btn');
  btn.disabled = true; btn.innerHTML = '<span class="spin"></span> جاري الحفظ...';
  try {
    await req('PUT', `${API}/requests/${curReqId}/status`, {
      office_status: sel.value,
      note: document.getElementById('status-note').value.trim() || undefined,
    });
    toast('تم تحديث الحالة بنجاح', 'success');
    document.getElementById('status-note').value = '';
    await loadMessages();
    loadRequests();
    loadStats();
  } catch(e) {
    toast(e.message || 'حدث خطأ', 'error');
  } finally {
    btn.disabled = false; btn.innerHTML = '<i class="ti ti-device-floppy"></i> حفظ الحالة';
  }
}

/* ══ MESSAGES ══ */
async function loadMessages() {
  const box = document.getElementById('chat-box');
  box.innerHTML = '<div style="text-align:center;padding:12px"><span class="spin"></span></div>';
  try {
    const msgs = await req('GET', `${API}/requests/${curReqId}/messages`);
    if (!msgs.length) { box.innerHTML = '<div style="text-align:center;font-size:13px;color:#999;padding:12px">لا توجد رسائل بعد</div>'; return; }
    box.innerHTML = msgs.map(m => `
      <div class="msg msg-${m.sender_type}">
        ${m.message}
        <div class="msg-meta">${fmtDate(m.created_at)} · ${m.sender_type==='office'?'المكتب':'العميل'}</div>
      </div>`).join('');
    box.scrollTop = box.scrollHeight;
  } catch { box.innerHTML = ''; }
}

async function doSendMsg() {
  const inp = document.getElementById('msg-inp');
  const msg = inp.value.trim();
  if (!msg) { toast('اكتب رسالة أولاً', 'warning'); return; }
  const btn = document.getElementById('send-btn');
  btn.disabled = true; btn.innerHTML = '<span class="spin"></span>';
  try {
    await req('POST', `${API}/requests/${curReqId}/messages`, { message: msg });
    inp.value = '';
    await loadMessages();
    toast('تم إرسال الرسالة', 'success');
  } catch(e) {
    toast(e.message || 'حدث خطأ', 'error');
  } finally {
    btn.disabled = false; btn.innerHTML = '<i class="ti ti-send"></i> إرسال';
  }
}

/* ══ SERVICES ══ */
async function loadServices() {
  const tbody = document.getElementById('svc-body');
  const empty = document.getElementById('svc-empty');
  tbody.innerHTML = '<tr class="loading-row"><td colspan="6"><span class="spin"></span></td></tr>';
  empty.style.display = 'none';
  try {
    const svcs = await req('GET', API+'/services');
    if (!svcs.length) {
      tbody.innerHTML = '';
      empty.style.display = '';
      return;
    }
    tbody.innerHTML = svcs.map(s => `
      <tr>
        <td style="font-weight:700">${s.name_ar}<br><span style="font-size:11px;color:#888;font-weight:400">${s.name_en||''}</span></td>
        <td class="price-tag">${parseFloat(s.price).toLocaleString('ar-SA')} ر.س</td>
        <td style="font-size:12px;color:#666">${s.duration||'—'}</td>
        <td style="font-size:12px;color:#666;max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">${s.description_ar||'—'}</td>
        <td>${s.is_active ? '<span class="badge b-done">مفعّلة</span>' : '<span class="badge b-rejected">متوقفة</span>'}</td>
        <td style="white-space:nowrap">
          <button class="edit-btn" onclick="openSvcModal(${s.id})" title="تعديل"><i class="ti ti-edit"></i></button>
          <button class="del-btn" onclick="deleteSvc(${s.id},'${s.name_ar.replace(/'/g,"\\'")}')"><i class="ti ti-trash"></i></button>
        </td>
      </tr>`).join('');
  } catch {
    tbody.innerHTML = '<tr><td colspan="6" style="text-align:center;padding:24px;color:#C62828">حدث خطأ في التحميل</td></tr>';
  }
}

let svcActive = true;

function openSvcModal(id = null) {
  document.getElementById('svc-id').value       = id || '';
  document.getElementById('svc-name-ar').value  = '';
  document.getElementById('svc-name-en').value  = '';
  document.getElementById('svc-price').value    = '';
  document.getElementById('svc-duration').value = '';
  document.getElementById('svc-desc-ar').value  = '';
  document.getElementById('svc-desc-en').value  = '';
  svcActive = true;
  const tog = document.getElementById('svc-active-toggle');
  tog.classList.add('on');
  document.getElementById('svc-active-lbl').textContent = 'الخدمة مفعّلة (ستظهر للعملاء)';

  if (id) {
    document.getElementById('svc-modal-title').textContent = 'تعديل الخدمة';
    req('GET', API+'/services').then(svcs => {
      const s = svcs.find(x => x.id === id);
      if (!s) return;
      document.getElementById('svc-name-ar').value  = s.name_ar  || '';
      document.getElementById('svc-name-en').value  = s.name_en  || '';
      document.getElementById('svc-price').value    = s.price    || '';
      document.getElementById('svc-duration').value = s.duration || '';
      document.getElementById('svc-desc-ar').value  = s.description_ar || '';
      document.getElementById('svc-desc-en').value  = s.description_en || '';
      svcActive = !!s.is_active;
      const t = document.getElementById('svc-active-toggle');
      if (svcActive) t.classList.add('on'); else t.classList.remove('on');
      document.getElementById('svc-active-lbl').textContent =
        svcActive ? 'الخدمة مفعّلة (ستظهر للعملاء)' : 'الخدمة متوقفة (مخفية عن العملاء)';
    });
  } else {
    document.getElementById('svc-modal-title').textContent = 'إضافة خدمة جديدة';
  }
  document.getElementById('svc-modal').classList.add('open');
}

function closeSvcModal() {
  document.getElementById('svc-modal').classList.remove('open');
}

function toggleSvcActive() {
  svcActive = !svcActive;
  const t = document.getElementById('svc-active-toggle');
  if (svcActive) t.classList.add('on'); else t.classList.remove('on');
  document.getElementById('svc-active-lbl').textContent =
    svcActive ? 'الخدمة مفعّلة (ستظهر للعملاء)' : 'الخدمة متوقفة (مخفية عن العملاء)';
}

async function saveSvc() {
  const id      = document.getElementById('svc-id').value;
  const nameAr  = document.getElementById('svc-name-ar').value.trim();
  const nameEn  = document.getElementById('svc-name-en').value.trim();
  const price   = document.getElementById('svc-price').value.trim();
  if (!nameAr) { toast('اسم الخدمة بالعربية مطلوب', 'warning'); return; }
  if (!nameEn) { toast('اسم الخدمة بالإنجليزية مطلوب', 'warning'); return; }
  if (!price || isNaN(price) || parseFloat(price) < 0) { toast('أدخل سعراً صحيحاً', 'warning'); return; }

  const btn = document.getElementById('svc-save-btn');
  btn.disabled = true; btn.innerHTML = '<span class="spin"></span> جاري الحفظ...';
  const body = {
    name_ar: nameAr, name_en: nameEn, price: parseFloat(price),
    duration:       document.getElementById('svc-duration').value.trim() || undefined,
    description_ar: document.getElementById('svc-desc-ar').value.trim() || undefined,
    description_en: document.getElementById('svc-desc-en').value.trim() || undefined,
    is_active: svcActive,
  };
  try {
    if (id) {
      await req('PUT', `${API}/services/${id}`, body);
      toast('تم تحديث الخدمة بنجاح', 'success');
    } else {
      await req('POST', API+'/services', body);
      toast('تم إضافة الخدمة بنجاح', 'success');
    }
    closeSvcModal();
    loadServices();
  } catch(e) {
    toast(e.message || 'حدث خطأ', 'error');
  } finally {
    btn.disabled = false; btn.innerHTML = '<i class="ti ti-device-floppy"></i> حفظ';
  }
}

async function deleteSvc(id, name) {
  if (!confirm(`هل تريد حذف الخدمة "${name}"؟`)) return;
  try {
    await req('DELETE', `${API}/services/${id}`);
    toast('تم حذف الخدمة', 'success');
    loadServices();
  } catch(e) {
    toast(e.message || 'حدث خطأ', 'error');
  }
}

/* ══ DIRECT REQUESTS ══ */
let drStatus='all', drPage=1, drLastPage=1;
const drStore = {};

function setDRStatus(el) {
  document.querySelectorAll('#dr-tabs .stab').forEach(t=>t.classList.remove('active'));
  el.classList.add('active');
  drStatus = el.dataset.s; drPage = 1;
  loadDirectReqs();
}

function changeDRPage(dir) {
  drPage = Math.max(1, Math.min(drLastPage, drPage+dir));
  loadDirectReqs();
}

async function loadDirectReqs() {
  const tbody = document.getElementById('dr-body');
  tbody.innerHTML = '<tr class="loading-row"><td colspan="8"><span class="spin"></span></td></tr>';
  try {
    const d = await req('GET', `${API}/direct-requests?status=${drStatus}&page=${drPage}`);
    drLastPage = d.last_page;
    document.getElementById('dr-pager-info').textContent = `${d.total} طلب — صفحة ${d.page} من ${d.last_page}`;
    document.getElementById('dr-prev').disabled = drPage <= 1;
    document.getElementById('dr-next').disabled = drPage >= drLastPage;
    if (!d.data.length) {
      tbody.innerHTML = `<tr><td colspan="8"><div class="empty"><i class="ti ti-inbox"></i><p style="margin-top:8px">لا توجد طلبات مباشرة</p></div></td></tr>`;
      return;
    }
    d.data.forEach(r => drStore[r.id] = r);
    tbody.innerHTML = d.data.map(r => `
      <tr>
        <td class="ref">${r.ref_number}</td>
        <td style="font-weight:600">${r.client_name}</td>
        <td style="font-size:12.5px;color:#555" dir="ltr">${r.client_phone}</td>
        <td style="font-size:12px;color:#666">${r.service_ar||'—'}</td>
        <td class="price-tag">${r.price ? parseFloat(r.price).toLocaleString('ar-SA')+' ر.س' : '—'}</td>
        <td>${badge(r.status)}</td>
        <td style="font-size:12px;color:#999">${fmtDate(r.created_at)}</td>
        <td><button class="act-btn" onclick="openDRModal(${r.id})" title="تحديث الحالة"><i class="ti ti-edit"></i></button></td>
      </tr>`).join('');
  } catch {
    tbody.innerHTML = '<tr><td colspan="8" style="text-align:center;padding:24px;color:#C62828">حدث خطأ في التحميل</td></tr>';
  }
}

function openDRModal(id) {
  const r = drStore[id];
  if (!r) return;
  document.getElementById('dr-req-id').value = r.id;
  document.getElementById('dr-modal-title').textContent = `طلب #${r.ref_number}`;
  document.getElementById('dr-note').value = r.office_note || '';
  document.getElementById('dr-info').innerHTML =
    `<b>${r.client_name}</b> &nbsp;·&nbsp; <span dir="ltr">${r.client_phone}</span><br>`+
    `<span style="color:#888">الخدمة:</span> ${r.service_ar||'—'} &nbsp;·&nbsp; `+
    `<span style="color:#888">السعر:</span> ${r.price ? parseFloat(r.price).toLocaleString('ar-SA')+' ر.س' : '—'}`;
  document.querySelectorAll('#dr-status-sel .s-opt').forEach(o=>o.classList.remove('active'));
  if (r.status) {
    const opt = document.querySelector(`#dr-status-sel .s-opt[data-v="${r.status}"]`);
    if (opt) { opt.classList.add('active'); opt.querySelector('input').checked = true; }
  }
  document.getElementById('dr-modal').classList.add('open');
}

function closeDRModal() {
  document.getElementById('dr-modal').classList.remove('open');
}

// Wire up DR status selector clicks
document.querySelectorAll('#dr-status-sel .s-opt').forEach(opt => {
  opt.addEventListener('click', () => {
    document.querySelectorAll('#dr-status-sel .s-opt').forEach(o=>o.classList.remove('active'));
    opt.classList.add('active');
    opt.querySelector('input').checked = true;
  });
});

async function saveDRStatus() {
  const id  = document.getElementById('dr-req-id').value;
  const sel = document.querySelector('#dr-status-sel input[name="drstatus"]:checked');
  if (!sel) { toast('اختر الحالة أولاً', 'warning'); return; }
  const btn = document.getElementById('dr-save-btn');
  btn.disabled = true; btn.innerHTML = '<span class="spin"></span> جاري الحفظ...';
  try {
    await req('PUT', `${API}/direct-requests/${id}/status`, {
      status:      sel.value,
      office_note: document.getElementById('dr-note').value.trim() || undefined,
    });
    toast('تم تحديث الحالة بنجاح', 'success');
    closeDRModal();
    loadDirectReqs();
    loadStats();
  } catch(e) {
    toast(e.message || 'حدث خطأ', 'error');
  } finally {
    btn.disabled = false; btn.innerHTML = '<i class="ti ti-device-floppy"></i> حفظ الحالة';
  }
}

/* ══ FINANCIAL REPORT ══ */
function showPage(id) {
  ['dash','reqs','services','direct-reqs','finance'].forEach(p => document.getElementById('pg-'+p).style.display = p===id ? '' : 'none');
  const titles = { dash:'الرئيسية', reqs:'الطلبات', services:'خدماتي', 'direct-reqs':'الطلبات المباشرة', finance:'التقرير المالي' };
  document.getElementById('page-title').textContent = titles[id] || '';
  document.querySelectorAll('.sb-item').forEach(el => el.classList.remove('active'));
  const map = { dash:0, reqs:1, services:2, 'direct-reqs':3, finance:4 };
  document.querySelectorAll('.sb-item')[map[id]]?.classList.add('active');
  if (id === 'reqs')        loadRequests();
  if (id === 'services')    loadServices();
  if (id === 'direct-reqs') loadDirectReqs();
  if (id === 'finance')     loadFinancial();
}

function riyals(v) { return parseFloat(v||0).toLocaleString('ar-SA',{minimumFractionDigits:2,maximumFractionDigits:2})+' ر.س'; }

let _finData = null;

async function loadFinancial() {
  document.getElementById('fin-monthly').innerHTML = '<tr class="loading-row"><td colspan="5"><span class="spin"></span></td></tr>';
  document.getElementById('fin-recent').innerHTML  = '<tr class="loading-row"><td colspan="7"><span class="spin"></span></td></tr>';
  const from = document.getElementById('fin-from').value;
  const to   = document.getElementById('fin-to').value;
  const params = new URLSearchParams();
  if (from) params.set('from', from);
  if (to)   params.set('to',   to);
  try {
    const d = await req('GET', `${API}/financial?${params}`);
    _finData = d;
    const s = d.summary;
    document.getElementById('fin-total').textContent = s.total         || 0;
    document.getElementById('fin-gross').textContent = riyals(s.gross);
    document.getElementById('fin-comm').textContent  = riyals(s.commission) + (d.office?.commission_rate ? ` (${d.office.commission_rate}%)` : '');
    document.getElementById('fin-net').textContent   = riyals(s.net);

    document.getElementById('fin-monthly').innerHTML = !d.monthly.length
      ? '<tr><td colspan="5" style="text-align:center;padding:20px;color:#999">لا توجد بيانات</td></tr>'
      : d.monthly.map(m => `<tr>
          <td style="font-weight:700">${m.month}</td>
          <td>${m.req_count}</td>
          <td class="price-tag">${riyals(m.gross)}</td>
          <td style="color:#C62828">${riyals(m.commission)}</td>
          <td style="color:#0277BD;font-weight:800">${riyals(m.net)}</td>
        </tr>`).join('');

    document.getElementById('fin-recent').innerHTML = !d.recent.length
      ? '<tr><td colspan="7" style="text-align:center;padding:20px;color:#999">لا توجد معاملات</td></tr>'
      : d.recent.map(r => `<tr>
          <td class="ref">${r.ref_number}</td>
          <td>${r.client_name}</td>
          <td class="price-tag">${riyals(r.price)}</td>
          <td style="color:#C62828">${riyals(r.commission_amount)}</td>
          <td style="color:#0277BD;font-weight:800">${riyals(parseFloat(r.price||0)-parseFloat(r.commission_amount||0))}</td>
          <td>${badge(r.status)}</td>
          <td style="font-size:12px;color:#999">${fmtDate(r.created_at)}</td>
        </tr>`).join('');
  } catch { document.getElementById('fin-monthly').innerHTML = '<tr><td colspan="5" style="text-align:center;padding:20px;color:#C62828">فشل في تحميل البيانات</td></tr>'; }
}

function exportFinancialCSV() {
  if (!_finData) return;
  const rows = [['الشهر','الطلبات','الإجمالي','العمولة','الصافي']];
  (_finData.monthly||[]).forEach(m => rows.push([m.month, m.req_count, m.gross, m.commission, m.net]));
  const csv = rows.map(r => r.join(',')).join('\n');
  const a = document.createElement('a');
  a.href = 'data:text/csv;charset=utf-8,﻿' + encodeURIComponent(csv);
  a.download = 'office-financial-report.csv';
  a.click();
}

/* ══ NOTIFICATIONS ══ */
let _offNotifLoaded = false;

function toggleOfficeNotifPanel() {
  const panel = document.getElementById('office-notif-panel');
  const isOpen = panel.style.display === 'flex';
  panel.style.display = isOpen ? 'none' : 'flex';
  panel.style.flexDirection = 'column';
  if (!isOpen && !_offNotifLoaded) loadOfficeNotifications();
}

async function loadOfficeNotifications() {
  _offNotifLoaded = true;
  const list = document.getElementById('office-notif-list');
  list.innerHTML = '<div style="text-align:center;padding:20px"><span class="spin"></span></div>';
  try {
    const d = await Notifications.getAll();
    const items = d.data || [];
    const unread = d.unread || 0;
    const badge = document.getElementById('off-notif-badge');
    badge.textContent = unread; badge.style.display = unread > 0 ? '' : 'none';
    if (!items.length) { list.innerHTML = '<div style="text-align:center;padding:24px;font-size:13px;color:#999">لا توجد إشعارات</div>'; return; }
    const typeIco = { new_office_request:'ti-inbox', status_changed:'ti-refresh', new_message:'ti-message', info:'ti-info-circle' };
    list.innerHTML = items.map(n => `
      <div onclick="officeReadNotif(${n.id},this)" style="display:flex;gap:.75rem;padding:.85rem 1rem;border-bottom:1px solid rgba(26,35,126,.05);cursor:pointer;transition:background .15s;${n.is_read?'':'background:rgba(26,35,126,.04)'}">
        <div style="width:8px;height:8px;border-radius:50%;background:${n.is_read?'#ccc':'var(--pri)'};margin-top:6px;flex-shrink:0"></div>
        <div>
          <div style="font-size:13px;font-weight:700;color:var(--t1)">${n.title}</div>
          <div style="font-size:12px;color:#666;margin-top:2px">${n.body||''}</div>
          <div style="font-size:11px;color:#aaa;margin-top:3px">${fmtDate(n.created_at)}</div>
        </div>
      </div>`).join('');
  } catch { list.innerHTML = '<div style="padding:16px;text-align:center;color:#C62828;font-size:13px">فشل في تحميل الإشعارات</div>'; }
}

async function officeReadNotif(id, el) {
  el?.style && (el.style.background = '');
  await Notifications.markRead(id);
  await refreshOfficeNotifCount();
}

async function officeMarkAllRead() {
  await Notifications.markAllRead();
  document.querySelectorAll('#office-notif-list > div').forEach(el => el.style.background = '');
  refreshOfficeNotifCount();
  _offNotifLoaded = false;
}

async function refreshOfficeNotifCount() {
  try {
    const r = await Notifications.unreadCount();
    const count = r.count || 0;
    const badge = document.getElementById('off-notif-badge');
    badge.textContent = count; badge.style.display = count > 0 ? '' : 'none';
  } catch {}
}

document.addEventListener('click', e => {
  const panel = document.getElementById('office-notif-panel');
  const bell  = document.getElementById('notif-bell');
  if (panel?.style.display === 'flex' && !panel.contains(e.target) && !bell?.contains(e.target)) {
    panel.style.display = 'none';
  }
});

/* ══ INIT ══ */
loadStats();
refreshOfficeNotifCount();
setInterval(refreshOfficeNotifCount, 60000);
</script>
</body>
</html>