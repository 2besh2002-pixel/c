<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>حسابي | آمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css"/>
<link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.14.0/moyasar.css"/>
<style>
*{box-sizing:border-box;margin:0;padding:0;}
:root{--pri:#1A237E;--pri2:#283593;--pri3:#1565C0;--bg:#F0F2F8;--sur:#fff;--sur2:#F4F6FB;--b1:rgba(26,35,126,.1);--b2:rgba(26,35,126,.2);--bc:rgba(26,35,126,.07);--t1:#0D1257;--t2:#3A4490;--t3:#7A82B8;--t4:#BDC2E0;--pd:rgba(26,35,126,.08);--pd2:rgba(26,35,126,.14);--sh:rgba(26,35,126,.07);--sh2:rgba(26,35,126,.15);--hf:#1A237E;--ht:#1565C0;--sb-w:230px;--green:#1B5E20;--orange:#E65100;--red:#C62828;--blue:#0277BD;--yellow:#F9A825;}
html,body{height:100%;background:var(--bg);color:var(--t1);overflow:hidden;}
body.ar{font-family:'Cairo',sans-serif;direction:rtl;}
body.en{font-family:'Inter',sans-serif;direction:ltr;}

/* LAYOUT */
.layout{display:flex;height:100vh;overflow:hidden;}

/* SIDEBAR */
.sb{width:var(--sb-w);flex-shrink:0;background:linear-gradient(180deg,var(--hf) 0%,#0D1560 100%);display:flex;flex-direction:column;height:100vh;overflow-y:auto;transition:width .3s;z-index:50;}
.sb::-webkit-scrollbar{width:3px;}
.sb::-webkit-scrollbar-thumb{background:rgba(255,255,255,.15);border-radius:3px;}
.sb-logo{display:flex;align-items:center;gap:9px;padding:1.2rem 1rem;cursor:pointer;border-bottom:1px solid rgba(255,255,255,.08);}
.sb-logo-img{width:36px;height:36px;border-radius:9px;background:rgba(255,255,255,.15);border:1.5px solid rgba(255,255,255,.25);display:flex;align-items:center;justify-content:center;overflow:hidden;flex-shrink:0;}
.sb-logo-img img{width:30px;height:30px;object-fit:contain;}
.sb-logo-nm{font-size:15px;font-weight:900;color:#fff;}
.sb-logo-sb{font-size:9px;color:rgba(255,255,255,.55);}
.sb-nav{flex:1;padding:.7rem .6rem;}
.sb-sec{font-size:9.5px;text-transform:uppercase;letter-spacing:1.5px;color:rgba(255,255,255,.35);font-weight:700;padding:.4rem .6rem;margin-top:.5rem;}
.sb-item{display:flex;align-items:center;gap:9px;padding:.62rem .85rem;border-radius:10px;cursor:pointer;transition:all .2s;color:rgba(255,255,255,.55);font-size:13px;font-weight:600;margin-bottom:2px;position:relative;}
.sb-item:hover{background:rgba(255,255,255,.08);color:rgba(255,255,255,.9);}
.sb-item.on{background:rgba(255,255,255,.15);color:#fff;}
.sb-item i{font-size:17px;flex-shrink:0;}
.sb-bottom{padding:.7rem .6rem;border-top:1px solid rgba(255,255,255,.08);}
/* User profile in sidebar */
.sb-profile{display:flex;align-items:center;gap:8px;padding:.7rem .85rem;border-radius:10px;background:rgba(255,255,255,.08);cursor:pointer;}
.sb-av{width:36px;height:36px;border-radius:50%;object-fit:cover;border:2px solid rgba(255,255,255,.3);flex-shrink:0;}
.sb-un{font-size:12.5px;font-weight:700;color:#fff;flex:1;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
.sb-role{font-size:10px;color:rgba(255,255,255,.5);}
.sb-logout{font-size:16px;color:rgba(255,255,255,.4);cursor:pointer;transition:.2s;flex-shrink:0;}
.sb-logout:hover{color:#fff;}

/* MAIN */
.main{flex:1;overflow-y:auto;display:flex;flex-direction:column;}
/* Topbar */
.tb{height:60px;display:flex;align-items:center;padding:0 1.8rem;gap:1rem;background:var(--sur);border-bottom:1px solid var(--b1);position:sticky;top:0;z-index:40;box-shadow:0 2px 8px var(--sh);flex-shrink:0;}
.tb-title{font-size:16px;font-weight:800;color:var(--t1);}
.tb-right{margin-right:auto;display:flex;align-items:center;gap:7px;}
body.en .tb-right{margin-right:0;margin-left:auto;}
.lng{display:flex;padding:2px;border-radius:8px;background:var(--sur2);border:1px solid var(--b1);gap:1px;}
.lt{padding:4px 8px;border-radius:6px;font-size:11px;font-weight:700;cursor:pointer;color:var(--t3);transition:all .2s;}
.lt.on{background:var(--pri);color:#fff;}
.tb-btn{display:inline-flex;align-items:center;gap:5px;padding:7px 14px;border-radius:9px;background:var(--pri);color:#fff;font-family:inherit;font-size:12.5px;font-weight:700;cursor:pointer;border:none;text-decoration:none;transition:all .2s;}
.tb-btn:hover{background:var(--pri2);}
.tb-ham{display:none;width:34px;height:34px;border-radius:8px;border:1px solid var(--b1);background:transparent;cursor:pointer;align-items:center;justify-content:center;font-size:17px;color:var(--t2);}
.tb-icon{width:34px;height:34px;border-radius:8px;border:1px solid var(--b1);background:transparent;display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--t2);font-size:16px;transition:all .2s;position:relative;}
.tb-icon:hover{background:var(--pd);color:var(--pri);}
.notif-badge{position:absolute;top:-3px;right:-3px;width:16px;height:16px;border-radius:50%;background:var(--red);border:2px solid var(--sur);font-size:8px;color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;}
body.en .notif-badge{right:auto;left:-3px;}
/* NOTIFICATION PANEL */
.notif-panel{position:fixed;top:65px;right:1rem;width:340px;max-height:480px;background:var(--sur);border-radius:14px;border:1px solid var(--b1);box-shadow:0 8px 32px rgba(26,35,126,.18);z-index:200;display:none;flex-direction:column;overflow:hidden;}
body.en .notif-panel{right:auto;left:1rem;}
.notif-panel.show{display:flex;}
.notif-ph{padding:.9rem 1.1rem;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid var(--b1);}
.notif-ph-ttl{font-size:14px;font-weight:800;color:var(--t1);}
.notif-ph-ra{font-size:11.5px;color:var(--pri);cursor:pointer;font-weight:600;}
.notif-list{overflow-y:auto;flex:1;}
.notif-item{display:flex;gap:.75rem;padding:.85rem 1.1rem;border-bottom:1px solid rgba(26,35,126,.05);cursor:pointer;transition:background .15s;}
.notif-item:hover{background:var(--sur2);}
.notif-item.unread{background:rgba(26,35,126,.04);}
.notif-dot{width:9px;height:9px;border-radius:50%;flex-shrink:0;margin-top:5px;}
.notif-body{flex:1;min-width:0;}
.notif-title{font-size:12.5px;font-weight:700;color:var(--t1);margin-bottom:2px;}
.notif-text{font-size:11.5px;color:var(--t3);line-height:1.4;overflow:hidden;text-overflow:ellipsis;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;}
.notif-time{font-size:10px;color:var(--t4);margin-top:3px;}
.notif-empty{padding:2rem;text-align:center;color:var(--t3);font-size:13px;}

/* CONTENT */
.content{padding:1.6rem 1.8rem;flex:1;}
.page{display:none;}
.page.on{display:block;animation:fu .28s ease;}
@keyframes fu{from{opacity:0;transform:translateY(8px);}to{opacity:1;transform:translateY(0);}}
.pg-hd{display:flex;align-items:center;justify-content:space-between;margin-bottom:1.4rem;flex-wrap:wrap;gap:.8rem;}
.pg-ttl{font-size:19px;font-weight:800;color:var(--t1);}
.pg-sub{font-size:12.5px;color:var(--t3);margin-top:3px;}

/* STAT CARDS */
.stat-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:.9rem;margin-bottom:1.5rem;}
.sc{background:var(--sur);border-radius:14px;border:1px solid var(--b1);padding:1.2rem;box-shadow:0 2px 8px var(--sh);display:flex;align-items:center;gap:.9rem;transition:transform .2s;}
.sc:hover{transform:translateY(-3px);}
.sc-ico{width:46px;height:46px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:21px;flex-shrink:0;}
.sc-n{font-size:24px;font-weight:900;color:var(--t1);}
.sc-l{font-size:11.5px;color:var(--t3);margin-top:2px;}

/* REQUEST CARDS */
.req-list{display:flex;flex-direction:column;gap:.85rem;}
.req-card{background:var(--sur);border-radius:14px;border:1px solid var(--b1);overflow:hidden;box-shadow:0 2px 8px var(--sh);}
.req-hd{display:flex;align-items:center;gap:.9rem;padding:.95rem 1.2rem;cursor:pointer;}
.req-ico{width:42px;height:42px;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.req-ico i{font-size:19px;}
.req-info{flex:1;min-width:0;}
.req-nm{font-size:13px;font-weight:700;color:var(--t1);}
.req-meta{font-size:11px;color:var(--t3);margin-top:2px;display:flex;align-items:center;gap:.4rem;flex-wrap:wrap;}
.dot{width:3px;height:3px;border-radius:50%;background:var(--t4);}
.req-st{padding:4px 11px;border-radius:20px;font-size:11.5px;font-weight:700;flex-shrink:0;}
.req-st.pending   {background:rgba(230,81,0,.1);color:var(--orange);}
.req-st.processing{background:rgba(2,119,189,.1);color:var(--blue);}
.req-st.in_progress{background:rgba(249,168,37,.1);color:var(--yellow);}
.req-st.done      {background:rgba(27,94,32,.1);color:var(--green);}
.req-st.rejected  {background:rgba(198,40,40,.1);color:var(--red);}
.req-chv{font-size:15px;color:var(--t4);transition:transform .2s;}
.req-card.open .req-chv{transform:rotate(180deg);}
/* Detail */
.req-body{display:none;border-top:1px solid var(--b1);padding:1.1rem 1.2rem;}
.req-card.open .req-body{display:block;}
/* Timeline */
.timeline{margin-top:.8rem;}
.tl-item{display:flex;gap:.8rem;padding:.5rem 0;position:relative;}
.tl-item:not(:last-child)::after{content:'';position:absolute;right:11px;top:26px;width:1px;height:calc(100% - 10px);background:var(--b1);}
body.en .tl-item:not(:last-child)::after{right:auto;left:11px;}
.tl-dot{width:22px;height:22px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:10px;flex-shrink:0;margin-top:1px;}
.tl-txt{font-size:12px;color:var(--t2);flex:1;line-height:1.5;}
.tl-time{font-size:10.5px;color:var(--t3);}
/* Reject reason box */
.rej-box{background:rgba(198,40,40,.06);border:1px solid rgba(198,40,40,.2);border-radius:10px;padding:.8rem 1rem;margin-top:.8rem;font-size:12.5px;color:var(--red);display:flex;align-items:flex-start;gap:7px;}
.rej-box i{font-size:15px;flex-shrink:0;margin-top:1px;}
/* Estimated time */
.est-box{background:rgba(2,119,189,.07);border:1px solid rgba(2,119,189,.2);border-radius:10px;padding:.75rem 1rem;margin-top:.7rem;font-size:12.5px;color:var(--blue);display:flex;align-items:center;gap:7px;}

/* PROFILE PAGE */
.profile-grid{display:grid;grid-template-columns:1fr 2fr;gap:1.2rem;}
.prof-left{display:flex;flex-direction:column;gap:1rem;}
/* Avatar card */
.av-card{background:var(--sur);border-radius:16px;border:1px solid var(--b1);padding:1.8rem;text-align:center;box-shadow:0 2px 8px var(--sh);}
.av-wrap{position:relative;width:96px;height:96px;margin:0 auto 1rem;}
.av-img{width:96px;height:96px;border-radius:50%;object-fit:cover;border:3px solid var(--pri);box-shadow:0 4px 14px var(--sh2);}
.av-edit{position:absolute;bottom:2px;right:2px;width:28px;height:28px;border-radius:50%;background:var(--pri);border:2px solid #fff;display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:13px;color:#fff;transition:background .2s;}
body.en .av-edit{right:auto;left:2px;}
.av-edit:hover{background:var(--pri2);}
.av-file{display:none;}
.av-nm{font-size:16px;font-weight:800;color:var(--t1);}
.av-role{font-size:12px;color:var(--t3);margin-top:3px;}
/* Balance card */
.bal-card{background:linear-gradient(135deg,var(--hf),var(--ht));border-radius:16px;padding:1.4rem;box-shadow:0 4px 16px var(--sh2);}
.bal-lbl{font-size:12px;color:rgba(255,255,255,.7);margin-bottom:.3rem;}
.bal-val{font-size:28px;font-weight:900;color:#fff;}
.bal-sub{font-size:10.5px;color:rgba(255,255,255,.55);margin-top:3px;}
.charge-btn{width:100%;margin-top:1rem;height:42px;background:rgba(255,255,255,.2);border:1.5px solid rgba(255,255,255,.28);color:#fff;font-family:inherit;font-size:13px;font-weight:700;border-radius:10px;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:7px;transition:all .2s;}
.charge-btn:hover{background:rgba(255,255,255,.3);}
/* Profile form */
.prof-form{background:var(--sur);border-radius:16px;border:1px solid var(--b1);padding:1.5rem;box-shadow:0 2px 8px var(--sh);}
.pf-ttl{font-size:15px;font-weight:700;color:var(--t1);margin-bottom:1.2rem;padding-bottom:.7rem;border-bottom:1px solid var(--bc);}
.row2{display:grid;grid-template-columns:1fr 1fr;gap:1rem;}
.fld{margin-bottom:1rem;}
.fld label{display:block;font-size:12.5px;font-weight:700;color:var(--t1);margin-bottom:5px;}
.fld input{width:100%;height:44px;padding:0 13px;border-radius:10px;border:1.5px solid var(--b1);background:var(--sur);color:var(--t1);font-family:inherit;font-size:13px;outline:none;transition:all .2s;}
.fld input:focus{border-color:var(--pri);box-shadow:0 0 0 3px var(--pd);}
.save-btn{display:inline-flex;align-items:center;gap:6px;padding:9px 20px;border-radius:10px;background:var(--pri);color:#fff;font-family:inherit;font-size:13px;font-weight:700;cursor:pointer;border:none;transition:all .2s;}
.save-btn:hover{background:var(--pri2);}

/* CHARGE MODAL */
.charge-modal{display:none;position:fixed;inset:0;z-index:700;background:rgba(10,18,40,.5);backdrop-filter:blur(6px);align-items:center;justify-content:center;padding:1.2rem;}
.charge-modal.open{display:flex;animation:fu .25s ease;}
.cm-box{background:var(--sur);border-radius:20px;width:100%;max-width:400px;overflow:hidden;box-shadow:0 24px 64px rgba(0,0,0,.2);}
.cm-hd{background:linear-gradient(135deg,var(--hf),var(--ht));padding:1.3rem 1.7rem;display:flex;align-items:center;gap:.8rem;}
.cm-hd i{font-size:22px;color:#fff;}
.cm-hd-nm{font-size:16px;font-weight:800;color:#fff;}
.cm-x{margin-right:auto;width:32px;height:32px;border-radius:50%;background:rgba(255,255,255,.18);border:none;display:flex;align-items:center;justify-content:center;color:#fff;font-size:16px;cursor:pointer;}
body.en .cm-x{margin-right:0;margin-left:auto;}
.cm-body{padding:1.5rem 1.7rem;}
.amounts-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:.7rem;margin-bottom:1.2rem;}
.amt-btn{padding:.9rem;border-radius:10px;border:1.5px solid var(--b1);background:transparent;text-align:center;font-family:inherit;font-size:14px;font-weight:700;color:var(--t2);cursor:pointer;transition:all .2s;}
.amt-btn:hover,.amt-btn.on{background:var(--pd2);color:var(--pri);border-color:var(--b2);}
.custom-inp{width:100%;height:46px;padding:0 14px;border-radius:11px;border:1.5px solid var(--b1);background:var(--sur);color:var(--t1);font-family:inherit;font-size:14px;outline:none;margin-bottom:1.2rem;transition:border-color .2s;}
.custom-inp:focus{border-color:var(--pri);}
.cm-sub{width:100%;height:48px;background:linear-gradient(135deg,var(--hf),var(--ht));color:#fff;font-family:inherit;font-size:15px;font-weight:800;border:none;border-radius:12px;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:7px;box-shadow:0 4px 14px var(--sh2);transition:all .25s;}
.cm-sub:hover{transform:translateY(-1px);}
.cm-sub.ld{opacity:.75;pointer-events:none;}

/* PAYMENT HISTORY */
.pay-table{background:var(--sur);border-radius:14px;border:1px solid var(--b1);overflow:hidden;box-shadow:0 2px 8px var(--sh);}
.pay-row{display:flex;align-items:center;gap:.9rem;padding:.85rem 1.2rem;border-bottom:1px solid var(--bc);}
.pay-row:last-child{border-bottom:none;}
.pay-ico{width:38px;height:38px;border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:17px;flex-shrink:0;}
.pay-nm{font-size:12.5px;font-weight:700;color:var(--t1);flex:1;}
.pay-date{font-size:11px;color:var(--t3);}
.pay-amt{font-size:14px;font-weight:800;flex-shrink:0;}
.pay-amt.credit{color:var(--green);}
.pay-amt.debit{color:var(--red);}

/* RESPONSIVE */
@media(max-width:860px){
  .sb{width:60px;}
  .sb-logo-nm,.sb-logo-sb,.sb-item span,.sb-sec,.sb-un,.sb-role{display:none;}
  .sb-item{justify-content:center;padding:.65rem;}
  .sb-logo{justify-content:center;padding:.9rem .5rem;}
  .sb-profile{justify-content:center;padding:.5rem;}
  .profile-grid{grid-template-columns:1fr;}
  .content{padding:1.2rem 1rem;}
}
@media(max-width:580px){
  .tb{padding:0 1rem;height:54px;}
  .stat-grid{grid-template-columns:1fr 1fr;}
  .tb-ham{display:flex;}
  .row2{grid-template-columns:1fr;}
}
</style>
</head>
<body class="ar">
<div class="layout">

<!-- SIDEBAR -->
<aside class="sb" id="sb">
  <div class="sb-logo" onclick="location.href=(AMRTM_ROUTES&&AMRTM_ROUTES.home)||'/'">
    <div class="sb-logo-img"><img src="data:image/png;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/4gHYSUNDX1BST0ZJTEUAAQEAAAHIAAAAAAQwAABtbnRyUkdCIFhZWiAH4AABAAEAAAAAAABhY3NwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAA9tYAAQAAAADTLQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlkZXNjAAAA8AAAACRyWFlaAAABFAAAABRnWFlaAAABKAAAABRiWFlaAAABPAAAABR3dHB0AAABUAAAABRyVFJDAAABZAAAAChnVFJDAAABZAAAAChiVFJDAAABZAAAAChjcHJ0AAABjAAAADxtbHVjAAAAAAAAAAEAAAAMZW5VUwAAAAgAAAAcAHMAUgBHAEJYWVogAAAAAAAAb6IAADj1AAADkFhZWiAAAAAAAABimQAAt4UAABjaWFlaIAAAAAAAACSgAAAPhAAAts9YWVogAAAAAAAA9tYAAQAAAADTLXBhcmEAAAAAAAQAAAACZmYAAPKnAAANWQAAE9AAAApbAAAAAAAAAABtbHVjAAAAAAAAAAEAAAAMZW5VUwAAACAAAAAcAEcAbwBvAGcAbABlACAASQBuAGMALgAgADIAMAAxADb/2wBDAAUDBAQEAwUEBAQFBQUGBwwIBwcHBw8LCwkMEQ8SEhEPERETFhwXExQaFRERGCEYGh0dHx8fExciJCIeJBweHx7/2wBDAQUFBQcGBw4ICA4eFBEUHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh7/wAARCAK2ArkDASIAAhEBAxEB/8QAHQABAAICAwEBAAAAAAAAAAAAAAYHBQgDBAkBAv/EAEgQAAEDBAECAwQFCQYEBQUBAAABAgMEBQYRBxIhEzFBCCJRYRQVMnGBFhcjQlZXlaHSCYKRlLHBM1JiciRDorLRJURTdbPC/8QAGwEBAAIDAQEAAAAAAAAAAAAAAAIEAQMFBgf/xAA9EQEAAgECAwQHBgYABQUAAAAAAQIDBBEhMUEFElFhBhMicYGRoRRSscHR8BUjMkJT4QckM4LxJWJykrL/2gAMAwEAAhEDEQA/ANywAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA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AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAP/2Q==" alt="" onerror="this.style.display='none'"/></div>
    <div><div class="sb-logo-nm" id="sb-nm">آمر تم</div><div class="sb-logo-sb" id="sb-sb">حسابي</div></div>
  </div>
  <nav class="sb-nav">
    <div class="sb-sec" id="sb-s1">الرئيسية</div>
    <div class="sb-item on" onclick="showPage('overview')"><i class="ti ti-layout-dashboard"></i><span id="si-ov">نظرة عامة</span></div>
    <div class="sb-sec" id="sb-s2">الطلبات</div>
    <div class="sb-item" onclick="showPage('requests')"><i class="ti ti-file-text"></i><span id="si-req">طلباتي</span></div>
    <div class="sb-sec" id="sb-s3">الحساب</div>
    <div class="sb-item" onclick="showPage('profile')"><i class="ti ti-user-circle"></i><span id="si-prof">ملفي الشخصي</span></div>
    <div class="sb-item" onclick="showPage('payments')"><i class="ti ti-coin"></i><span id="si-pay">المدفوعات</span></div>
    <div class="sb-sec" id="sb-s4">أخرى</div>
    <div class="sb-item" onclick="location.href=(AMRTM_ROUTES&&AMRTM_ROUTES.home)||'/'"><i class="ti ti-home-2"></i><span id="si-home">الرئيسية</span></div>
    <div class="sb-item" id="sb-admin-link" style="display:none;" onclick="location.href=(AMRTM_ROUTES&&AMRTM_ROUTES.adminDashboard)||'/admin'"><i class="ti ti-layout-dashboard"></i><span id="si-admin">لوحة الأدمن</span></div>
  </nav>
  <div class="sb-bottom">
    <div class="sb-profile" onclick="showPage('profile')">
      <img class="sb-av" id="sb-av" src="" alt=""/>
      <div style="flex:1;min-width:0;"><div class="sb-un" id="sb-un">—</div><div class="sb-role" id="sb-role">مستخدم</div></div>
      <i class="ti ti-logout sb-logout" onclick="event.stopPropagation();doLogout()" title="خروج"></i>
    </div>
  </div>
</aside>

<!-- MAIN -->
<div class="main">
  <!-- Topbar -->
  <div class="tb">
    <div class="tb-title" id="tb-title">نظرة عامة</div>
    <div class="tb-right">
      <div class="tb-icon" onclick="toggleNotifPanel()" id="notif-btn">
        <i class="ti ti-bell"></i>
        <div class="notif-badge" id="notif-badge" style="display:none;">0</div>
      </div>
      <div class="lng"><div class="lt on" id="la" onclick="setLang('ar')">AR</div><div class="lt" id="le" onclick="setLang('en')">EN</div></div>
      <button class="tb-btn" onclick="openChargeModal()"><i class="ti ti-plus"></i><span id="tb-charge">شحن الرصيد</span></button>
    </div>
  </div>

  <!-- Notification Panel -->
  <div class="notif-panel" id="notif-panel">
    <div class="notif-ph">
      <span class="notif-ph-ttl" id="np-ttl">الإشعارات</span>
      <span class="notif-ph-ra" onclick="markAllRead()" id="np-ra">تعليم الكل كمقروء</span>
    </div>
    <div class="notif-list" id="notif-list">
      <div class="notif-empty" id="np-empty">لا توجد إشعارات</div>
    </div>
  </div>

  <div class="content">

    <!-- OVERVIEW PAGE -->
    <div class="page on" id="page-overview">
      <div class="pg-hd">
        <div>
        <div class="pg-ttl" id="ov-ttl">مرحباً! 👋</div>
        <div class="pg-sub" id="ov-sub">إليك ملخص حسابك</div></div>
        <a class="tb-btn" href="{{ route('amrtm.index') }}"><i class="ti ti-plus"></i><span id="ov-new">طلب جديد</span></a>
      </div>
      <!-- Stats -->
      <div class="stat-grid">
        <div class="sc"><div class="sc-ico" style="background:rgba(2,119,189,.1);"><i class="ti ti-file-text" style="color:var(--blue);"></i></div><div><div class="sc-n" id="sc-total">0</div><div class="sc-l" id="sc-total-l">إجمالي الطلبات</div></div></div>
        <div class="sc"><div class="sc-ico" style="background:rgba(230,81,0,.1);"><i class="ti ti-loader" style="color:var(--orange);"></i></div><div><div class="sc-n" id="sc-pend">0</div><div class="sc-l" id="sc-pend-l">قيد الانتظار</div></div></div>
        <div class="sc"><div class="sc-ico" style="background:rgba(27,94,32,.1);"><i class="ti ti-circle-check" style="color:var(--green);"></i></div><div><div class="sc-n" id="sc-done">0</div><div class="sc-l" id="sc-done-l">مكتملة</div></div></div>
        <div class="sc"><div class="sc-ico" style="background:linear-gradient(135deg,var(--hf),var(--ht));"><i class="ti ti-wallet" style="color:#fff;"></i></div><div><div class="sc-n" id="sc-bal">0</div><div class="sc-l" id="sc-bal-l">رصيدي (ر.س)</div></div></div>
      </div>
      <!-- Recent requests -->
      <div style="font-size:14px;font-weight:700;color:var(--t1);margin-bottom:.9rem;" id="ov-recent">آخر الطلبات</div>
      <div class="req-list" id="ov-req-list"></div>
    </div>

    <!-- REQUESTS PAGE -->
    <div class="page" id="page-requests">
      <div class="pg-hd">
        <div><div class="pg-ttl" id="req-ttl">طلباتي</div><div class="pg-sub" id="req-sub">جميع طلباتك المقدمة</div></div>
        <a class="tb-btn" href="{{ route('amrtm.index') }}"><i class="ti ti-plus"></i><span id="req-new">طلب جديد</span></a>
      </div>
      <!-- Filter -->
      <div style="display:flex;gap:.6rem;flex-wrap:wrap;margin-bottom:1.2rem;">
        <button class="filter-btn on" onclick="filterReqs('all',this)" id="rf-all">الكل</button>
        <button class="filter-btn" onclick="filterReqs('pending',this)" id="rf-pend">قيد الانتظار</button>
        <button class="filter-btn" onclick="filterReqs('processing',this)" id="rf-proc">جاري المعالجة</button>
        <button class="filter-btn" onclick="filterReqs('done',this)" id="rf-done">مكتملة</button>
        <button class="filter-btn" onclick="filterReqs('rejected',this)" id="rf-rej">مرفوضة</button>
      </div>
      <div class="req-list" id="req-list"></div>
    </div>

    <!-- PROFILE PAGE -->
    <div class="page" id="page-profile">
      <div class="pg-hd"><div><div class="pg-ttl" id="prof-ttl">ملفي الشخصي</div><div class="pg-sub" id="prof-sub">إدارة بياناتك الشخصية</div></div></div>
      <div class="profile-grid">
        <div class="prof-left">
          <!-- Avatar card -->
          <div class="av-card">
            <div class="av-wrap">
              <img class="av-img" id="av-img" src="" alt=""/>
              <div class="av-edit" onclick="document.getElementById('av-file').click()"><i class="ti ti-camera"></i></div>
              <input type="file" class="av-file" id="av-file" accept="image/*" onchange="uploadAvatar(this)"/>
            </div>
            <div class="av-nm" id="av-nm">—</div>
            <div class="av-role" id="av-role">مستخدم</div>
          </div>
          <!-- Balance -->
          <div class="bal-card">
            <div class="bal-lbl" id="bal-lbl">رصيدك الحالي</div>
            <div class="bal-val" id="bal-val">0.00</div>
            <div class="bal-sub" id="bal-sub">ريال سعودي</div>
            <button class="charge-btn" onclick="openChargeModal()"><i class="ti ti-plus"></i><span id="charge-lbl">شحن الرصيد</span></button>
          </div>
        </div>
        <!-- Profile form -->
        <div class="prof-form">
          <div class="pf-ttl" id="pf-ttl">تعديل البيانات الشخصية</div>
          <div class="row2">
            <div class="fld"><label id="pf-ln">الاسم الكامل</label><input type="text" id="pf-name"/></div>
            <div class="fld"><label id="pf-le">البريد الإلكتروني</label><input type="email" id="pf-email"/></div>
          </div>
          <div class="fld"><label id="pf-lp">رقم الهاتف</label><input type="tel" id="pf-phone"/></div>
          <button class="save-btn" onclick="saveProfile()" id="save-btn"><i class="ti ti-check"></i><span id="save-lbl">حفظ التغييرات</span></button>
          <div style="height:1px;background:var(--bc);margin:1.3rem 0;"></div>
          <div class="pf-ttl" id="pf-pass-ttl">تغيير كلمة المرور</div>
          <div class="fld"><label id="pf-lcp">كلمة المرور الحالية</label><input type="password" id="pf-old-pass" placeholder="••••••••"/></div>
          <div class="row2">
            <div class="fld"><label id="pf-lnp">كلمة المرور الجديدة</label><input type="password" id="pf-new-pass" placeholder="••••••••"/></div>
            <div class="fld"><label id="pf-lcp2">تأكيد كلمة المرور</label><input type="password" id="pf-conf-pass" placeholder="••••••••"/></div>
          </div>
          <button class="save-btn" onclick="changePass()" style="background:rgba(198,40,40,.1);color:var(--red);box-shadow:none;border:1px solid rgba(198,40,40,.2);" id="pass-btn"><i class="ti ti-lock"></i><span id="pass-lbl">تغيير كلمة المرور</span></button>
        </div>
      </div>
    </div>

    <!-- PAYMENTS PAGE -->
    <div class="page" id="page-payments">
      <div class="pg-hd">
        <div><div class="pg-ttl" id="pay-ttl">سجل المدفوعات</div><div class="pg-sub" id="pay-sub">جميع معاملاتك المالية</div></div>
        <button class="tb-btn" onclick="openChargeModal()"><i class="ti ti-plus"></i><span id="pay-charge">شحن الرصيد</span></button>
      </div>
      <!-- Balance summary -->
      <div class="sc" style="margin-bottom:1.2rem;max-width:300px;">
        <div class="sc-ico" style="background:linear-gradient(135deg,var(--hf),var(--ht));"><i class="ti ti-wallet" style="color:#fff;"></i></div>
        <div><div class="sc-n" id="pay-bal">0.00</div><div class="sc-l" id="pay-bal-l">رصيدك الحالي (ر.س)</div></div>
      </div>
      <div class="pay-table" id="pay-list"></div>
    </div>

  </div><!-- /content -->
</div><!-- /main -->
</div><!-- /layout -->

<!-- CHARGE MODAL -->
<div class="charge-modal" id="charge-modal" onclick="if(event.target===this&&!_moyasarActive)closeCharge()">
  <div class="cm-box" style="max-width:480px;">
    <div class="cm-hd">
      <i class="ti ti-wallet"></i>
      <div class="cm-hd-nm" id="cm-ttl">شحن الرصيد</div>
      <button class="cm-x" onclick="closeCharge()"><i class="ti ti-x"></i></button>
    </div>
    <!-- Step 1: Amount selection -->
    <div class="cm-body" id="cm-step1">
      <div style="font-size:12.5px;color:var(--t2);margin-bottom:.8rem;" id="cm-sub">اختر المبلغ أو أدخل مبلغاً مخصصاً</div>
      <div class="amounts-grid">
        <button class="amt-btn" onclick="setAmt(100)">100</button>
        <button class="amt-btn" onclick="setAmt(250)">250</button>
        <button class="amt-btn" onclick="setAmt(500)">500</button>
        <button class="amt-btn" onclick="setAmt(1000)">1000</button>
        <button class="amt-btn" onclick="setAmt(2000)">2000</button>
        <button class="amt-btn" onclick="setAmt(5000)">5000</button>
      </div>
      <input type="number" class="custom-inp" id="cm-amt" placeholder="أو أدخل مبلغاً مخصصاً..." min="10"/>
      <button class="cm-sub" id="cm-sub-btn" onclick="doCharge()">
        <i class="ti ti-credit-card"></i><span id="cm-btn-lbl">متابعة للدفع</span>
      </button>
    </div>
    <!-- Step 2: Moyasar payment form -->
    <div class="cm-body" id="cm-step2" style="display:none;">
      <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:.9rem;">
        <button onclick="backToAmount()" style="background:none;border:none;cursor:pointer;color:var(--t3);font-size:16px;padding:0;"><i class="ti ti-arrow-right"></i></button>
        <span style="font-size:13px;font-weight:700;color:var(--t2);" id="cm-pay-lbl">الدفع ببطاقتك</span>
        <span style="margin-right:auto;font-size:14px;font-weight:800;color:var(--pri);" id="cm-pay-amt"></span>
      </div>
      <div id="moyasar-form"></div>
      <div style="margin-top:.8rem;display:flex;align-items:center;justify-content:center;gap:.4rem;">
        <img src="https://cdn.moyasar.com/mpf/1.14.0/images/moyasar-logo.svg" alt="Moyasar" style="height:18px;opacity:.55;" onerror="this.style.display='none'"/>
        <span style="font-size:10px;color:var(--t4);">مدفوعات آمنة عبر موياسر</span>
      </div>
    </div>
  </div>
</div>

<style>
.filter-btn{padding:6px 14px;border-radius:8px;font-size:12.5px;font-weight:600;cursor:pointer;border:1.5px solid var(--b1);background:transparent;color:var(--t2);transition:all .2s;font-family:inherit;}
.filter-btn.on{background:var(--pri);color:#fff;border-color:var(--pri);}
.filter-btn:hover:not(.on){background:var(--pd);}
</style>

<script>
window.AMRTM_USER = {!! auth('business')->check() ? json_encode([
    'id'    => auth('business')->id(),
    'name'  => auth('business')->user()->name,
    'email' => auth('business')->user()->email,
    'phone' => auth('business')->user()->phone ?? '',
    'role'  => auth('business')->user()->role,
    'balance' => 0,
]) : 'null' !!};
window.AMRTM_CSRF = '{{ csrf_token() }}';
window.AMRTM_API_BASE = '{{ url("/api") }}';

// ── Notifications SDK ──
window.Notifications = {
  _base: window.AMRTM_API_BASE + '/notifications',
  _h: () => ({ 'Accept':'application/json','X-CSRF-TOKEN':window.AMRTM_CSRF,'Content-Type':'application/json' }),
  getAll:     async function()    { const r = await fetch(this._base, {headers:this._h(),credentials:'same-origin'}); return r.json(); },
  unreadCount:async function()    { const r = await fetch(this._base+'/unread-count', {headers:this._h(),credentials:'same-origin'}); return r.json(); },
  markRead:   async function(id)  { await fetch(this._base+'/'+id+'/read', {method:'POST',headers:this._h(),credentials:'same-origin'}); },
  markAllRead:async function()    { await fetch(this._base+'/read-all',   {method:'POST',headers:this._h(),credentials:'same-origin'}); },
};
window.AMRTM_ROUTES = {
    login:         '{{ route("amrtm.login") }}',
    register:      '{{ route("amrtm.register") }}',
    logout:        '{{ route("amrtm.logout") }}',
    home:          '{{ route("amrtm.index") }}',
    userDashboard: '{{ route("amrtm.user.dashboard") }}',
    adminDashboard:'{{ route("amrtm.admin.dashboard") }}',
    mainSite:      '{{ url("/") }}',
};
window.AMRTM_MOYASAR_KEY = '{{ config("services.moyasar.publishable_key") }}';
window.AMRTM_PAYMENT_CALLBACK = '{{ route("amrtm.payment.callback") }}';
@if(session('payment_success'))
window._paymentMsg = {type:'success', text: '{{ session("payment_success") }}'};
@elseif(session('payment_error'))
window._paymentMsg = {type:'error', text: '{{ session("payment_error") }}'};
@endif
</script>
<script src="{{ asset('js/amrtm-web.js') }}"></script>
<script src="https://cdn.moyasar.com/mpf/1.14.0/moyasar.js"></script>
<script>
const T={
  ar:{nm:'آمر تم',da:'حسابي',s1:'الرئيسية',s2:'الطلبات',s3:'الحساب',s4:'أخرى',siOv:'نظرة عامة',siReq:'طلباتي',siProf:'ملفي الشخصي',siPay:'المدفوعات',siHome:'الرئيسية',tbCharge:'شحن الرصيد',ovTtl:'مرحباً! 👋',ovSub:'إليك ملخص حسابك',ovNew:'طلب جديد',ovRecent:'آخر الطلبات',scTot:'إجمالي الطلبات',scPend:'قيد الانتظار',scDone:'مكتملة',scBal:'رصيدي (ر.س)',reqTtl:'طلباتي',reqSub:'جميع طلباتك المقدمة',reqNew:'طلب جديد',rfAll:'الكل',rfPend:'قيد الانتظار',rfProc:'جاري المعالجة',rfDone:'مكتملة',rfRej:'مرفوضة',profTtl:'ملفي الشخصي',profSub:'إدارة بياناتك الشخصية',pfTtl:'تعديل البيانات الشخصية',pfLn:'الاسم الكامل',pfLe:'البريد الإلكتروني',pfLp:'رقم الهاتف',saveLbl:'حفظ التغييرات',pfPassTtl:'تغيير كلمة المرور',pfLcp:'كلمة المرور الحالية',pfLnp:'كلمة المرور الجديدة',pfLcp2:'تأكيد كلمة المرور',passLbl:'تغيير كلمة المرور',balLbl:'رصيدك الحالي',balSub:'ريال سعودي',chargeLbl:'شحن الرصيد',payTtl:'سجل المدفوعات',paySub:'جميع معاملاتك المالية',payCharge:'شحن الرصيد',payBalL:'رصيدك الحالي (ر.س)',cmTtl:'شحن الرصيد',cmSub:'اختر المبلغ أو أدخل مبلغاً مخصصاً',cmBtnLbl:'شحن الآن',sar:'ر.س',tbTitle:'نظرة عامة',user:'مستخدم',
    stPend:'قيد الانتظار',stProc:'جاري المعالجة',stInprog:'قيد التنفيذ',stDone:'تمت العملية',stRej:'مرفوض',
    estLbl:'وقت الإنجاز المتوقع: ',rejLbl:'سبب الرفض: ',noReqs:'لا توجد طلبات',noPayments:'لا توجد معاملات',
    chargeSuccess:'تم شحن الرصيد بنجاح!',saveSuc:'تم حفظ البيانات',passOk:'تم تغيير كلمة المرور',
  },
  en:{nm:'Amrtm',da:'My Account',s1:'Main',s2:'Requests',s3:'Account',s4:'Other',siOv:'Overview',siReq:'My Requests',siProf:'My Profile',siPay:'Payments',siHome:'Home',tbCharge:'Top Up',ovTtl:'Welcome! 👋',ovSub:'Here is your account summary',ovNew:'New Request',ovRecent:'Recent Requests',scTot:'Total Requests',scPend:'Pending',scDone:'Completed',scBal:'Balance (SAR)',reqTtl:'My Requests',reqSub:'All your submitted requests',reqNew:'New Request',rfAll:'All',rfPend:'Pending',rfProc:'Processing',rfDone:'Completed',rfRej:'Rejected',profTtl:'My Profile',profSub:'Manage your personal information',pfTtl:'Edit Personal Information',pfLn:'Full Name',pfLe:'Email Address',pfLp:'Phone Number',saveLbl:'Save Changes',pfPassTtl:'Change Password',pfLcp:'Current Password',pfLnp:'New Password',pfLcp2:'Confirm Password',passLbl:'Change Password',balLbl:'Current Balance',balSub:'Saudi Riyal',chargeLbl:'Top Up Balance',payTtl:'Payment History',paySub:'All your financial transactions',payCharge:'Top Up',payBalL:'Current Balance (SAR)',cmTtl:'Top Up Balance',cmSub:'Choose an amount or enter a custom amount',cmBtnLbl:'Top Up Now',sar:'SAR',tbTitle:'Overview',user:'User',
    stPend:'Pending',stProc:'Processing',stInprog:'In Progress',stDone:'Completed',stRej:'Rejected',
    estLbl:'Estimated completion: ',rejLbl:'Rejection reason: ',noReqs:'No requests found',noPayments:'No transactions',
    chargeSuccess:'Balance topped up successfully!',saveSuc:'Data saved successfully',passOk:'Password changed successfully',
  }
};

let lang=localStorage.getItem('amrtm_lang')||'ar';
let curPage='overview';
let userData=null;
let allReqs=[];
let allPays=[];
let reqFilter='all';

/* ══ INIT ══ */
async function init(){
  // Require login
  if(typeof Auth!=='undefined'&&!Auth.isLoggedIn()){
    window.location.href=((AMRTM_ROUTES&&AMRTM_ROUTES.login)||'/login')+'?redirect='+encodeURIComponent(location.href);return;
  }
  const u=typeof Auth!=='undefined'?Auth.getUser():null;
  // If admin → show admin panel link
  if(u?.role==='admin'||u?.role==='supervisor'){
    const el=document.getElementById('sb-admin-link');
    if(el) el.style.display='flex';
  }
  applyLang(lang);
  await loadData();
}

async function loadData(){
  try{
    const data=await Dashboard.userStats();
    userData=data.user;
    allReqs=data.recent_requests||[];
    allPays=data.recent_payments||[];
    renderAll();
  }catch(e){
    console.error('Dashboard load error:',e);
    if(typeof showToast!=='undefined')showToast('حدث خطأ في تحميل البيانات','error');
  }
}

function renderAll(){
  const t=T[lang];
  // Sidebar profile
  const av=userData?.avatar_url||`https://ui-avatars.com/api/?name=${encodeURIComponent(userData?.name||'U')}&background=1A237E&color=fff&size=64`;
  setImgSrc('sb-av',av);setImgSrc('av-img',av);
  S('sb-un',userData?.name||'—');S('av-nm',userData?.name||'—');
  const roleMap={admin:{ar:'أدمن',en:'Admin'},supervisor:{ar:'مشرف',en:'Supervisor'},user:{ar:'مستخدم',en:'User'}};
  const roleLbl=(roleMap[userData?.role]||{})[lang]||t.user;
  S('sb-role',roleLbl);S('av-role',roleLbl);
  // Stats
  const stats=userData?.stats||{};
  S('sc-total',stats.total||0);S('sc-pend',stats.pending||0);S('sc-done',stats.done||0);
  const bal=(parseFloat(userData?.balance||0)).toFixed(2);
  S('sc-bal',bal);S('bal-val',bal);S('pay-bal',bal);
  // Profile form
  setVal('pf-name',userData?.name||'');setVal('pf-email',userData?.email||'');setVal('pf-phone',userData?.phone||'');
  // Title
  S('ov-ttl',(t.ovTtl.replace('!',''))+' '+((userData?.name||'').split(' ')[0])+'! 👋');
  renderRecentReqs();
  renderReqList();
  renderPayList();
}

/* ══ REQUESTS ══ */
function renderRecentReqs(){
  renderReqCards(allReqs.slice(0,3),'ov-req-list');
}

/* Full requests page (paginated from API) */
let _reqPage=1;
let _reqStatus='all';
let _reqLastPage=1;

async function loadAllRequests(page,status){
  page=page||1;status=status||'all';
  _reqPage=page;_reqStatus=status;
  const el=document.getElementById('req-list');
  if(el)el.innerHTML=`<div style="text-align:center;padding:2.5rem;color:var(--t3);"><i class="ti ti-loader-2" style="font-size:28px;animation:spin .7s linear infinite;display:inline-block;"></i></div>`;
  try{
    const qs='/requests?page='+page+(status!=='all'?'&status='+status:'');
    const res=await API.get(qs);
    const items=res.data||[];
    _reqLastPage=res.last_page||1;
    renderReqCards(items,'req-list');
    renderReqPagination();
  }catch(e){
    if(el)el.innerHTML=`<div style="text-align:center;padding:2rem;color:var(--red);">حدث خطأ في تحميل الطلبات. <span style="cursor:pointer;text-decoration:underline;" onclick="loadAllRequests()">إعادة المحاولة</span></div>`;
  }
}

function renderReqPagination(){
  let pc=document.getElementById('req-pagination');
  if(!pc){
    pc=document.createElement('div');
    pc.id='req-pagination';
    pc.style.cssText='display:flex;justify-content:center;align-items:center;gap:.6rem;margin-top:1.2rem;';
    document.getElementById('req-list')?.after(pc);
  }
  if(_reqLastPage<=1){pc.innerHTML='';return;}
  pc.innerHTML=`
    <button onclick="loadAllRequests(${_reqPage-1},'${_reqStatus}')" ${_reqPage<=1?'disabled':''} class="filter-btn" style="${_reqPage<=1?'opacity:.4;cursor:default;':''}"><i class="ti ti-chevron-${lang==='ar'?'right':'left'}"></i></button>
    <span style="font-size:13px;color:var(--t2);font-weight:600;">${_reqPage} / ${_reqLastPage}</span>
    <button onclick="loadAllRequests(${_reqPage+1},'${_reqStatus}')" ${_reqPage>=_reqLastPage?'disabled':''} class="filter-btn" style="${_reqPage>=_reqLastPage?'opacity:.4;cursor:default;':''}"><i class="ti ti-chevron-${lang==='ar'?'left':'right'}"></i></button>
  `;
}

function filterReqs(f,btn){
  reqFilter=f;
  document.querySelectorAll('.filter-btn').forEach(b=>b.classList.remove('on'));
  if(btn)btn.classList.add('on');
  loadAllRequests(1,f);
}
function renderReqCards(reqs,containerId){
  const t=T[lang];
  const el=document.getElementById(containerId);if(!el)return;
  if(!reqs||!reqs.length){
    el.innerHTML=`<div style="text-align:center;padding:2.5rem;color:var(--t3);">${t.noReqs}</div>`;return;
  }
  el.innerHTML=reqs.map((r,i)=>{
    const gs=r.gov_service||{};
    const ent=r.entity||{};
    const nm=lang==='ar'?(gs.name_ar||gs.name_en||'—'):(gs.name_en||gs.name_ar||'—');
    const entNm=lang==='ar'?(ent.name_ar||''):(ent.name_en||'');
    const {label,color,bg}=stInfo(r.status);
    const color2=ent.color||'#1A237E';
    const logs=r.logs||[];
    const est=r.estimated_completion;
    const rej=r.reject_reason;
    const cardId=`rc-${containerId}-${i}`;
    return `<div class="req-card" id="${cardId}">
      <div class="req-hd" onclick="togReq('${cardId}')">
        <div class="req-ico" style="background:${bg};border:1px solid ${color2}22;"><i class="ti ${gs.icon||'ti-file-text'}" style="color:${color2};"></i></div>
        <div class="req-info">
          <div class="req-nm">${nm}</div>
          <div class="req-meta"><span>${entNm}</span><div class="dot"></div><span>${r.ref_number||'—'}</span><div class="dot"></div><span>${fmtDate(r.created_at)}</span></div>
        </div>
        <div class="req-st ${r.status}">${label}</div>
        <i class="ti ti-chevron-down req-chv"></i>
      </div>
      <div class="req-body">
        ${est?`<div class="est-box"><i class="ti ti-clock"></i><span>${t.estLbl}<b>${est}</b></span></div>`:''}
        ${rej?`<div class="rej-box"><i class="ti ti-alert-circle"></i><span>${t.rejLbl}${rej}</span></div>`:''}
        ${logs.length?`<div class="timeline">${logs.map(l=>`<div class="tl-item"><div class="tl-dot" style="background:${stInfo(l.status).bg};"><i class="ti ti-circle-check" style="color:${stInfo(l.status).color};font-size:12px;"></i></div><div class="tl-txt">${l.note||stInfo(l.status).label}</div><div class="tl-time">${fmtDate(l.created_at)}</div></div>`).join('')}</div>`:''}
        <div style="margin-top:.8rem;font-size:12px;color:var(--t3);">المبلغ: <b style="color:var(--t1);">${parseFloat(r.price||0).toFixed(2)} ${t.sar}</b></div>
      </div>
    </div>`;
  }).join('');
}
function togReq(id){document.getElementById(id)?.classList.toggle('open');}

/* ══ PAYMENTS (overview summary — full page uses loadPayHistory) ══ */
function renderPayList(){}

/* ══ PROFILE ══ */
async function saveProfile(){
  const name=gV('pf-name'),phone=gV('pf-phone');
  if(!name){if(typeof showToast!=='undefined')showToast('الاسم مطلوب','warning');return;}
  const btn=document.getElementById('save-btn');
  if(btn){btn.disabled=true;btn.style.opacity='.7';}
  try{
    await Profile.update({name,phone});
    if(userData)userData.name=name;
    S('sb-un',name);S('av-nm',name);
    if(typeof showToast!=='undefined')showToast(T[lang].saveSuc,'success');
  }catch(e){
    if(typeof showToast!=='undefined')showToast(e?.data?.message||'حدث خطأ','error');
  }finally{if(btn){btn.disabled=false;btn.style.opacity='';}}
}
async function changePass(){
  const old=gV('pf-old-pass'),np=gV('pf-new-pass'),cp=gV('pf-conf-pass');
  if(!old||!np||np!==cp){if(typeof showToast!=='undefined')showToast('تحقق من كلمة المرور','error');return;}
  if(np.length<8){if(typeof showToast!=='undefined')showToast('كلمة المرور يجب أن تكون 8 أحرف على الأقل','warning');return;}
  const btn=document.getElementById('pass-btn');
  if(btn){btn.disabled=true;btn.style.opacity='.7';}
  try{
    await Profile.changePassword({current_password:old,new_password:np,new_password_confirmation:cp});
    if(typeof showToast!=='undefined')showToast(T[lang].passOk,'success');
    setVal('pf-old-pass','');setVal('pf-new-pass','');setVal('pf-conf-pass','');
  }catch(e){
    if(typeof showToast!=='undefined')showToast(e?.data?.message||'حدث خطأ','error');
  }finally{if(btn){btn.disabled=false;btn.style.opacity='';}}
}
function uploadAvatar(inp){
  const file=inp.files[0];if(!file)return;
  const reader=new FileReader();
  reader.onload=e=>{setImgSrc('av-img',e.target.result);setImgSrc('sb-av',e.target.result);};
  reader.readAsDataURL(file);
  if(typeof showToast!=='undefined')showToast('تم تحديث الصورة محلياً','info');
}

/* ══ CHARGE ══ */
let _moyasarActive = false;

function openChargeModal(){
  document.getElementById('charge-modal').classList.add('open');
  document.body.style.overflow='hidden';
  showStep1();
}
function closeCharge(){
  if(_moyasarActive) return; // prevent accidental close during payment
  document.getElementById('charge-modal').classList.remove('open');
  document.body.style.overflow='';
  _moyasarActive=false;
  showStep1();
}
function showStep1(){
  document.getElementById('cm-step1').style.display='';
  document.getElementById('cm-step2').style.display='none';
  _moyasarActive=false;
}
function backToAmount(){showStep1();}
function setAmt(v){
  document.getElementById('cm-amt').value=v;
  document.querySelectorAll('.amt-btn').forEach(b=>{b.classList.toggle('on',parseInt(b.textContent)===v);});
}
function doCharge(){
  const amt=parseFloat(document.getElementById('cm-amt').value||0);
  if(amt<10){if(typeof showToast!=='undefined')showToast('الحد الأدنى 10 ر.س','warning');return;}
  if(!window.AMRTM_MOYASAR_KEY){
    // Fallback: show message that payment gateway not configured
    if(typeof showToast!=='undefined')showToast('بوابة الدفع غير مفعّلة حالياً، تواصل مع الإدارة.','warning');
    return;
  }
  // Transition to step 2
  document.getElementById('cm-step1').style.display='none';
  document.getElementById('cm-step2').style.display='';
  document.getElementById('cm-pay-amt').textContent = amt.toFixed(2) + ' ر.س';
  _moyasarActive=true;
  // Clear previous form
  document.getElementById('moyasar-form').innerHTML='';
  // Init Moyasar widget
  Moyasar.init({
    element:             '#moyasar-form',
    amount:              Math.round(amt * 100),
    currency:            'SAR',
    description:         lang==='ar' ? 'شحن رصيد - منصة آمر تم' : 'Balance Top-up - Amrtm Platform',
    publishable_api_key: window.AMRTM_MOYASAR_KEY,
    callback_url:        window.AMRTM_PAYMENT_CALLBACK,
    methods:             ['creditcard', 'mada', 'applepay', 'stcpay'],
    metadata:            { user_id: window.AMRTM_USER?.id },
  });
}

/* ══ NAVIGATION ══ */
function showPage(p){
  curPage=p;
  document.querySelectorAll('.page').forEach(el=>el.classList.remove('on'));
  document.querySelectorAll('.sb-item').forEach(el=>el.classList.remove('on'));
  document.getElementById('page-'+p)?.classList.add('on');
  const map={overview:'si-ov',requests:'si-req',profile:'si-prof',payments:'si-pay'};
  document.getElementById(map[p])?.closest('.sb-item')?.classList.add('on');
  const titles={overview:T[lang].siOv,requests:T[lang].siReq,profile:T[lang].siProf,payments:T[lang].siPay};
  S('tb-title',titles[p]||'');
  if(p==='requests') loadAllRequests(_reqPage,_reqStatus);
  if(p==='payments') loadPayHistory();
}

/* ══ LANG ══ */
function setLang(l){
  lang=l;localStorage.setItem('amrtm_lang',l);
  document.documentElement.setAttribute('lang',l);document.documentElement.setAttribute('dir',l==='ar'?'rtl':'ltr');
  document.body.className=l;
  document.getElementById('la').classList.toggle('on',l==='ar');document.getElementById('le').classList.toggle('on',l==='en');
  applyLang(l);renderAll();
}
function applyLang(l){
  const t=T[l];
  [['sb-nm','nm'],['sb-da','da'],['sb-s1','s1'],['sb-s2','s2'],['sb-s3','s3'],['sb-s4','s4'],
   ['si-ov','siOv'],['si-req','siReq'],['si-prof','siProf'],['si-pay','siPay'],['si-home','siHome'],
   ['tb-charge','tbCharge'],['ov-sub','ovSub'],['ov-new','ovNew'],['ov-recent','ovRecent'],
   ['sc-total-l','scTot'],['sc-pend-l','scPend'],['sc-done-l','scDone'],['sc-bal-l','scBal'],
   ['req-ttl','reqTtl'],['req-sub','reqSub'],['req-new','reqNew'],
   ['rf-all','rfAll'],['rf-pend','rfPend'],['rf-proc','rfProc'],['rf-done','rfDone'],['rf-rej','rfRej'],
   ['prof-ttl','profTtl'],['prof-sub','profSub'],['pf-ttl','pfTtl'],
   ['pf-ln','pfLn'],['pf-le','pfLe'],['pf-lp','pfLp'],['save-lbl','saveLbl'],
   ['pf-pass-ttl','pfPassTtl'],['pf-lcp','pfLcp'],['pf-lnp','pfLnp'],['pf-lcp2','pfLcp2'],['pass-lbl','passLbl'],
   ['bal-lbl','balLbl'],['bal-sub','balSub'],['charge-lbl','chargeLbl'],
   ['pay-ttl','payTtl'],['pay-sub','paySub'],['pay-charge','payCharge'],['pay-bal-l','payBalL'],
   ['cm-ttl','cmTtl'],['cm-sub','cmSub'],['cm-btn-lbl','cmBtnLbl'],
  ].forEach(([id,k])=>S(id,t[k]));
}

/* ══ LOGOUT ══ */
function doLogout(){
  if(typeof Auth!=='undefined')Auth.logout();
  else{localStorage.removeItem('amrtm_token');localStorage.removeItem('amrtm_user');window.location.href=(AMRTM_ROUTES&&AMRTM_ROUTES.home)||'/';}
}

/* ══ HELPERS ══ */
function S(id,v){const el=document.getElementById(id);if(el)el.textContent=v;}
function gV(id){return document.getElementById(id)?.value?.trim()||'';}
function setVal(id,v){const el=document.getElementById(id);if(el)el.value=v;}
function setImgSrc(id,src){const el=document.getElementById(id);if(el)el.src=src;}
function fmtDate(d){if(!d)return'—';return new Date(d).toLocaleDateString(lang==='ar'?'ar-SA':'en-US',{year:'numeric',month:'short',day:'numeric'});}
function stInfo(status){
  const m={pending:{label:T[lang].stPend,color:'var(--orange)',bg:'rgba(230,81,0,.1)'},processing:{label:T[lang].stProc,color:'var(--blue)',bg:'rgba(2,119,189,.1)'},in_progress:{label:T[lang].stInprog,color:'var(--yellow)',bg:'rgba(249,168,37,.1)'},done:{label:T[lang].stDone,color:'var(--green)',bg:'rgba(27,94,32,.1)'},rejected:{label:T[lang].stRej,color:'var(--red)',bg:'rgba(198,40,40,.1)'}};
  return m[status]||{label:status,color:'#999',bg:'rgba(0,0,0,.05)'};
}

/* ══ PAYMENT HISTORY (full paginated load) ══ */
let _payPage=1;
let _payLastPage=1;

async function loadPayHistory(page){
  page=page||1;_payPage=page;
  const el=document.getElementById('pay-list');
  if(el)el.innerHTML=`<div style="text-align:center;padding:2rem;color:var(--t3);"><i class="ti ti-loader-2" style="font-size:28px;animation:spin .7s linear infinite;display:inline-block;"></i></div>`;
  try{
    const res=await Payments.history(page);
    const items=res.data||[];
    _payLastPage=res.last_page||1;
    renderPayListFull(items);
    renderPayPagination();
  }catch(e){
    if(el)el.innerHTML=`<div style="text-align:center;padding:2rem;color:var(--red);">حدث خطأ في تحميل المدفوعات</div>`;
  }
}

function renderPayListFull(pays){
  const t=T[lang];
  const el=document.getElementById('pay-list');if(!el)return;
  if(!pays||!pays.length){
    el.innerHTML=`<div style="text-align:center;padding:2rem;color:var(--t3);">${t.noPayments}</div>`;return;
  }
  el.innerHTML=pays.map(p=>{
    const isCharge=p.type==='charge';const isRefund=p.type==='refund';
    const ico=isCharge?'ti-arrow-down-circle':isRefund?'ti-arrow-up-circle':'ti-arrow-up-circle';
    const icoBg=isCharge?'rgba(27,94,32,.1)':'rgba(198,40,40,.1)';
    const icoColor=isCharge?'var(--green)':'var(--red)';
    const amtClass=isCharge?'credit':'debit';
    const sign=isCharge||isRefund?'+':'-';
    const desc=lang==='ar'?(p.description_ar||p.type):(p.description_en||p.type);
    return `<div class="pay-row">
      <div class="pay-ico" style="background:${icoBg};"><i class="ti ${ico}" style="color:${icoColor};"></i></div>
      <div style="flex:1;min-width:0;"><div class="pay-nm">${desc}</div><div class="pay-date">${fmtDate(p.created_at)}</div></div>
      <div class="pay-amt ${amtClass}">${sign}${parseFloat(p.amount||0).toFixed(2)} ${t.sar}</div>
    </div>`;
  }).join('');
}

function renderPayPagination(){
  let pc=document.getElementById('pay-pagination');
  if(!pc){
    pc=document.createElement('div');
    pc.id='pay-pagination';
    pc.style.cssText='display:flex;justify-content:center;align-items:center;gap:.6rem;margin-top:1.2rem;';
    document.getElementById('pay-list')?.after(pc);
  }
  if(_payLastPage<=1){pc.innerHTML='';return;}
  pc.innerHTML=`
    <button onclick="loadPayHistory(${_payPage-1})" ${_payPage<=1?'disabled':''} class="filter-btn" style="${_payPage<=1?'opacity:.4;cursor:default;':''}"><i class="ti ti-chevron-${lang==='ar'?'right':'left'}"></i></button>
    <span style="font-size:13px;color:var(--t2);font-weight:600;">${_payPage} / ${_payLastPage}</span>
    <button onclick="loadPayHistory(${_payPage+1})" ${_payPage>=_payLastPage?'disabled':''} class="filter-btn" style="${_payPage>=_payLastPage?'opacity:.4;cursor:default;':''}"><i class="ti ti-chevron-${lang==='ar'?'left':'right'}"></i></button>
  `;
}

/* RUN */
init();

// Show payment result flash message
if(window._paymentMsg){
  setTimeout(()=>{
    if(typeof showToast!=='undefined')showToast(window._paymentMsg.text, window._paymentMsg.type);
    window._paymentMsg=null;
  }, 800);
}

/* ══ NOTIFICATION PANEL ══ */
let _notifLoaded = false;

function toggleNotifPanel() {
  const panel = document.getElementById('notif-panel');
  if (!panel) return;
  const isOpen = panel.classList.contains('show');
  panel.classList.toggle('show', !isOpen);
  if (!isOpen && !_notifLoaded) loadNotifications();
}

async function loadNotifications() {
  if (typeof Notifications === 'undefined') return;
  _notifLoaded = true;
  try {
    const res = await Notifications.getAll();
    const items = res?.data || [];
    renderNotifList(items);
  } catch (_) {}
}

function renderNotifList(items) {
  const list = document.getElementById('notif-list');
  const empty = document.getElementById('np-empty');
  if (!list) return;
  if (!items.length) { if(empty) empty.style.display=''; return; }
  if(empty) empty.style.display='none';

  const typeColors = {
    status_update:      '#1565C0',
    admin_note:         '#6A1B9A',
    info_request:       '#E65100',
    request_submitted:  '#1B5E20',
  };

  list.innerHTML = items.map(n => `
    <div class="notif-item${n.is_read ? '' : ' unread'}" onclick="readNotif(${n.id}, this)">
      <div class="notif-dot" style="background:${typeColors[n.type]||'#1A237E'}"></div>
      <div class="notif-body">
        <div class="notif-title">${n.title}</div>
        <div class="notif-text">${n.body}</div>
        <div class="notif-time">${fmtDate(n.created_at)}</div>
      </div>
    </div>`).join('');
}

async function readNotif(id, el) {
  el?.classList.remove('unread');
  if (typeof Notifications !== 'undefined') {
    await Notifications.markRead(id);
    refreshNotifCount();
  }
}

async function markAllRead() {
  if (typeof Notifications !== 'undefined') {
    await Notifications.markAllRead();
    document.querySelectorAll('.notif-item.unread').forEach(el => el.classList.remove('unread'));
    refreshNotifCount();
  }
}

async function refreshNotifCount() {
  if (typeof Notifications === 'undefined') return;
  try {
    const res = await Notifications.unreadCount();
    const count = res?.count || 0;
    const badge = document.getElementById('notif-badge');
    if (badge) { badge.textContent = count; badge.style.display = count > 0 ? '' : 'none'; }
  } catch (_) {}
}

// Close panel when clicking outside
document.addEventListener('click', e => {
  const panel = document.getElementById('notif-panel');
  const btn   = document.getElementById('notif-btn');
  if (panel?.classList.contains('show') && !panel.contains(e.target) && !btn?.contains(e.target)) {
    panel.classList.remove('show');
  }
});

// Listen for polling updates
window.addEventListener('amrtm:notif-count', e => {
  const count = e.detail;
  const badge = document.getElementById('notif-badge');
  if (badge) { badge.textContent = count; badge.style.display = count > 0 ? '' : 'none'; }
  // Reset loaded flag so next open re-fetches
  if (count > 0) _notifLoaded = false;
});
</script>
</body>
</html>
