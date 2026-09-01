<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $entity->name_ar }} | منصة آمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css"/>
<style>
*{box-sizing:border-box;margin:0;padding:0;}
:root{--pri:#1A237E;--pri2:#283593;--pri3:#1565C0;--bg:#F4F6FB;--sur:#fff;--sur2:#F0F3FF;--b1:rgba(26,35,126,.1);--b2:rgba(26,35,126,.28);--bc:rgba(26,35,126,.07);--t1:#0D1257;--t2:#3A4490;--t3:#7A82B8;--t4:#BDC2E0;--pd:rgba(26,35,126,.08);--pd2:rgba(26,35,126,.15);--sh:rgba(26,35,126,.08);--sh2:rgba(26,35,126,.18);}

html{
    height:100%;
}

body{
    min-height:100vh;

    display:flex;
    flex-direction:column;

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
body.ar .ents-grid{
    direction: rtl;
}

body.en .ents-grid{
    direction: ltr;
}
.nb-logo-img{
    width:46px;
    height:46px;
    object-fit:contain;
}

/* NAVBAR */

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

.nb-mid{flex:1;}

.nb-right{display:flex;align-items:center;gap:7px;flex-shrink:0;}

.lng{display:flex;padding:2px;border-radius:8px;    background:#F2F5FF;gap:1px;}
.lt{padding:4px 8px;border-radius:6px;font-size:11px;font-weight:700;cursor:pointer; color:#6E77A8;transition:all .2s;}
.lt.on{  background:#1A237E;color:#fff;}

.nb-btn{display:inline-flex;align-items:center;gap:5px;padding:7px 14px;border-radius:8px;font-family:inherit;font-size:12.5px;font-weight:700;cursor:pointer;transition:all .2s;border:none;text-decoration:none;}
.nb-btn.out{
    background:#fff;
    color:#1A237E;
    border:1px solid rgba(26,35,126,.18);
}
.nb-btn.sol{
    background:#1A237E;
    color:#fff;
}

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

.nb-logo{
    display:flex;
    align-items:center;
    gap:12px;
}

.nb-logo-img{
    width:48px;
}
/* BREADCRUMB */

.bc-bar{
    width:100%;
    padding:0 5px 15px;
}

.bc{
    display:flex;
    align-items:center;
    gap:8px;
    font-size:13px;
    flex-wrap:wrap;
}
body.ar .bc{
    justify-content:flex-start;
    direction:rtl;
}

body.en .bc{
    justify-content:flex-end;
    direction:ltr;
}

.bc a{
    color:#6C79A1;
    text-decoration:none;
    font-weight:600;
    transition:.25s;
}

.bc a:hover{
    color:#1A237E;
}

.bc a:hover{
    color:#1A237E;
}

.bc-cur{
    color:#1A237E;
    font-weight:700;
}

/* ===========================
   HERO
=========================== */

.ent-hero{
    width:min(1200px,94%);
    margin:30px auto;
    padding:18px 28px;
    border-radius:24px;
    background:#fff;
    box-shadow:0 12px 35px rgba(18,36,90,.08);
}
.ent-hero-in{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:35px;
}
body.ar .ent-hero-in{
    flex-direction:row-reverse;
}

body.en .ent-hero-in{
    flex-direction:row;
}
.entity-text{
    flex:1;
}

body.ar .entity-text{
    text-align:right;
    margin-left:30px;
    margin-right:0;
}

body.en .entity-text{
    text-align:left;
    margin-right:30px;
    margin-left:0;
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
.ent-hero-in>div:last-child{
    flex:1;
}

body.ar .ent-hero-in > div:last-child{
    text-align:right;
}

body.en .ent-hero-in > div:last-child{
    text-align:left;
}
.ent-hero-nm{
    font-size:34px;
    font-weight:800;
    color:#16245E;
    margin-bottom:8px;
}

.ent-hero-tag{
    font-size:15px;
    color:#7B87A8;
        margin-bottom:30px;

}
.ent-hero-info{
    display:flex;
    align-items:center;
    gap:20px;
}

body.ar .ent-hero-info{
    flex-direction:row-reverse;
}
@media(max-width:768px){

    .ent-hero{
        width:95%;
        padding:25px 20px;
    }

    .ent-hero-in{
        flex-direction:column-reverse !important;
        text-align:center;
    }

    .ent-hero-in>div:last-child{
        text-align:center !important;
    }

    .ent-hero-ico{
        width:90px;
        height:90px;
    }

    .ent-hero-ico i{
        font-size:42px;
    }

    .ent-hero-nm{
        font-size:24px;
    }

    .ent-hero-tag{
        font-size:14px;
    }
}


/* ===============================
   SEARCH
=================================*/


.services-search{
    margin-bottom:22px;
}

.search-box{
    position:relative;
    width:100%;
}

.search-box input{
    width:100%;
    height:58px;
    border-radius:18px;
    border:1px solid #DDE6F7;
    background:#FAFBFF;
    font-size:15px;
    transition:.3s;
}

.search-box input:focus{
    outline:none;
    border-color:#2956D7;
    background:#fff;
    box-shadow:0 0 0 4px rgba(41,86,215,.08);
}
.search-icon{

    position:absolute;

    top:50%;

    transform:translateY(-50%);

    color:#2956D7;

    font-size:20px;
}

#clearSearch{

    position:absolute;

    top:50%;

    transform:translateY(-50%);

    width:34px;
    height:34px;

    border:none;

    border-radius:50%;

    cursor:pointer;

    background:#EEF4FF;

    color:#2956D7;
}

/* ---------- عربي ---------- */
body.ar .search-box input{
    padding:0 55px 0 55px;
    text-align:right;
    direction:rtl;
}

body.ar .search-icon{
    position:absolute;
    right:18px;
    top:50%;
    transform:translateY(-50%);
}

body.ar #clearSearch{
    position:absolute;
    left:15px;
    top:50%;
    transform:translateY(-50%);
}
/* ---------- انجليزي ---------- */
body.en .search-box input{
    padding:0 55px 0 55px;
    text-align:left;
    direction:ltr;
}

body.en .search-icon{
    position:absolute;
    left:18px;
    top:50%;
    transform:translateY(-50%);
}

body.en #clearSearch{
    position:absolute;
    right:15px;
    top:50%;
    transform:translateY(-50%);
}
/* =============================
   Suggestions
============================= */
.search-suggestions{

    position:absolute;

    top:calc(100% + 8px);

    left:0;
    right:0;

    display:none;

    background:#fff;

    border-radius:18px;

    overflow:hidden;

    box-shadow:0 18px 40px rgba(0,0,0,.15);

    z-index:99999;

    max-height:350px;

    overflow-y:auto;
}
.search-item{

    display:flex;
    align-items:center;

    gap:14px;

    padding:14px 18px;

    cursor:pointer;

    transition:.25s;
}

.search-item:hover{

    background:#F6F8FF;
}

body.ar .search-item{

    flex-direction:row-reverse;

    text-align:right;
}

body.en .search-item{

    flex-direction:row;

    text-align:left;
}
/*==============================
    SERVICES
==============================*/

.ents-wrap{
    width:min(1200px,94%);
    margin:0 auto 40px;
}

.ents-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:22px;
}
.ec{

    display:flex;
    flex-direction:column;
    justify-content:space-between;

    min-height:145px;

    background:#fff;

    border-radius:22px;

    overflow:hidden;

    border:1px solid rgba(26,35,126,.08);

    box-shadow:0 12px 35px rgba(20,40,90,.08);

    transition:.35s;

    cursor:pointer;

    position:relative;
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

    box-shadow:0 24px 55px rgba(20,40,90,.15);
}

.ec:hover::before{

    transform:scaleX(1);
}

.ec-body{

    display:flex;

    align-items:center;

    gap:18px;

    padding:18px;

    flex:1;
}

body.ar .ec-body{

    flex-direction:row-reverse;
}
body.en .ec-body{
    flex-direction:row;
}
.ec-ico{

    width:62px;
    height:62px;

    border-radius:18px;

    display:flex;
    justify-content:center;
    align-items:center;

    flex-shrink:0;

    transition:.3s;
}

.ec:hover .ec-ico{

    transform:scale(1.08) rotate(-5deg);
}

.ec-ico i{

    font-size:24px;
}

.ec-info{

    flex:1;
}

body.ar .ec-info{

    text-align:right;
}

.ec-nm{

    font-size:15px;

    font-weight:800;

    color:#16245E;

    margin-bottom:6px;
}

.ec-tag{

    font-size:13px;

    color:#7A86A8;

    line-height:1.8;
}

.ec-foot{

    display:flex;

    justify-content:space-between;

    align-items:center;

    padding:16px 22px;

    border-top:1px solid rgba(26,35,126,.07);

    background:#FAFBFF;
}

.ec-svcs{

    color:var(--ecc);

    font-size:15px;

    font-weight:700;
}

.ec-arr{

    font-size:24px;

    color:var(--ecc);

    transition:.3s;
}

.ec:hover .ec-arr{

    transform:translateX(-8px);
}

body.en .ec:hover .ec-arr{transform:translateX(4px);}
.ec-price{font-size:11.5px;font-weight:700;color:var(--pri3);}

/* FORM CARD */
.form-wrap{max-width:750px;margin:0 auto;padding:2rem;}
.form-card{background:var(--sur);border-radius:20px;box-shadow:0 8px 32px var(--sh);overflow:hidden;border:1.5px solid var(--bc);}
.ec.active{
    border:2px solid var(--ecc);
    box-shadow:0 15px 35px rgba(21,101,192,.18);
    transform:translateY(-4px);
}
/* Login gate */
.login-gate{padding:3rem 2rem;text-align:center;}
.lg-ico{width:72px;height:72px;border-radius:50%;background:var(--pd);border:2px solid var(--b1);display:flex;align-items:center;justify-content:center;font-size:30px;color:var(--pri);margin:0 auto 1.2rem;}
.lg-ttl{font-size:19px;font-weight:800;color:var(--t1);margin-bottom:.5rem;}
.lg-sub{font-size:13.5px;color:var(--t2);line-height:1.8;margin-bottom:1.6rem;}
.lg-btns{display:flex;flex-direction:column;gap:.75rem;max-width:360px;margin:0 auto;}
.lg-btn-pri{display:flex;align-items:center;justify-content:center;gap:8px;height:48px;border-radius:12px;background:linear-gradient(135deg,var(--pri),var(--pri3));color:#fff;font-family:inherit;font-size:14.5px;font-weight:800;text-decoration:none;}
.lg-btn-sec{display:flex;align-items:center;justify-content:center;gap:8px;height:48px;border-radius:12px;background:transparent;color:var(--pri);font-family:inherit;font-size:14px;font-weight:700;text-decoration:none;border:1.5px solid var(--b2);}


/**login gate highlighting */
.login-highlight{
    animation: loginHighlight .8s ease;
    border:2px solid var(--pri);
    border-radius:18px;
}

@keyframes loginHighlight{
    0%{
        transform:scale(.98);
        box-shadow:0 0 0 0 rgba(21,101,192,.45);
    }
    70%{
        transform:scale(1.02);
        box-shadow:0 0 0 18px rgba(21,101,192,0);
    }
    100%{
        transform:scale(1);
        box-shadow:0 0 0 0 rgba(21,101,192,0);
    }
}
/* SERVICE BAR */
.svc-sel-wrap{padding:1rem 1.5rem;border-bottom:1px solid var(--bc);}
.svc-sel-wrap select{width:100%;height:46px;padding:0 14px;border-radius:11px;border:1.5px solid var(--b1);background:var(--sur);color:var(--t1);font-family:inherit;font-size:13.5px;outline:none;cursor:pointer;transition:border-color .2s;}
.svc-sel-wrap select:focus{border-color:var(--pri);}
.svc-bar{display:flex;align-items:center;gap:.9rem;padding:.9rem 1.5rem;background:#F8F9FF;border-bottom:1px solid var(--bc);}
.svc-ico{width:42px;height:42px;border-radius:11px;flex-shrink:0;display:flex;align-items:center;justify-content:center;}
.svc-ico i{font-size:20px;}
.svc-nm{font-size:18px;font-weight:700;color:var(--t1);flex:1;}
.svc-cat{font-size:14px;color:var(--t3);margin-top:2px;}
.svc-price{font-size:18px;font-weight:900;color:var(--pri3);flex-shrink:0;}

/* BALANCE BAR */
.bal-bar{display:flex;align-items:center;justify-content:space-between;padding:.6rem 1.5rem;background:#fff;border-bottom:1px solid var(--b1);font-size:13px;flex-wrap:wrap;gap:.4rem;margin:8px;border-radius:10px;}
.bal-lbl{color:var(--t2);font-weight:600;}
.bal-val{font-weight:800;color:var(--pri);}
 
/**Account Info */

.verify-wrap{
    display:flex;
    justify-content:flex-start; /* في اليسار */
    margin:15px 0;
}

.verify-link{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:8px 14px;
    border-radius:8px;
    text-decoration:none;
    color:#0f2d5c;
    font-size:15px;
    font-weight:600;
    background:#f8fbff;
    border:1px solid #d8e4f1;
    transition:all .25s ease;
}

.verify-link i{
    font-size:18px;
    color:#0f2d5c;
}

.verify-link:hover{
    background:#eef5fc;
    border-color:#0f2d5c;
    color:#0f2d5c;
    box-shadow:0 4px 12px rgba(15,45,92,.08);
}


/** Are you company? */
.company-check input{
    display:none;
}

.company-label{
    display:flex;
    align-items:center;
    gap:15px;
    padding:16px 18px;
    border:1px solid #dbe4ef;
    border-radius:14px;
    background:#fff;
    cursor:pointer;
    transition:.3s;
    user-select:none;
}

.company-label:hover{
    border-color:#0f2d5c;
    box-shadow:0 8px 20px rgba(15,45,92,.08);
}

.company-icon{
    width:48px;
    height:48px;
    border-radius:12px;
    background:#f4f8fc;
    display:flex;
    align-items:center;
    justify-content:center;
    flex-shrink:0;
}

.company-icon i{
    font-size:24px;
    color:#0f2d5c;
}

.company-text{
    flex:1;
    display:flex;
    flex-direction:column;
}

.company-text strong{
    color:#0f2d5c;
    font-size:16px;
    font-weight:700;
}

.company-text small{
    color:#6b7280;
    font-size:13px;
    margin-top:2px;
}

/* زر التفعيل */
.company-switch{
    width:48px;
    height:26px;
    background:#d1d5db;
    border-radius:30px;
    position:relative;
    transition:.3s;
}



.company-switch::before{
    content:'';
    width:20px;
    height:20px;
    background:#fff;
    border-radius:50%;
    position:absolute;
    top:3px;
    left:3px;
    transition:.3s;
    box-shadow:0 2px 6px rgba(0,0,0,.15);
}

.company-check input:checked + .company-label{
    border-color:#0f2d5c;
    background:#f8fbff;
}

.company-check input:checked + .company-label .company-switch{
    background:#0f2d5c;
}

.company-check input:checked + .company-label .company-switch::before{
    left:25px;
}

.company-card{
    margin-top:20px;
    padding:22px;
    background:#fbfdff;
    border:1px solid #dbe4ef;
    border-right:5px solid #0f2d5c;
    border-radius:14px;
    animation:fadeIn .35s ease;
}

.company-card-header{
    display:flex;
    align-items:center;
    gap:10px;
    margin-bottom:18px;
    color:#0f2d5c;
    font-size:18px;
    font-weight:700;
}

.company-card-header i{
    width:42px;
    height:42px;
    border-radius:10px;
    background:#eef4fb;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:22px;
}

.company-card .fld label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
    color:#0f2d5c;
}

.company-card .fld input{
    width:100%;
    height:48px;
    border:1px solid #d8e2ee;
    border-radius:10px;
    padding:0 14px;
    transition:.25s;
    background:#fff;
}

.company-card .fld input:focus{
    border-color:#0f2d5c;
    box-shadow:0 0 0 4px rgba(15,45,92,.08);
    outline:none;
}

@keyframes fadeIn{
    from{
        opacity:0;
        transform:translateY(-10px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}
/* FORM FIELDS */
.fm-body{padding:1.5rem;}
.fm-row{display:grid;grid-template-columns:1fr 1fr;gap:1rem;}
.fld{margin-bottom:1rem;}
.fld label{display:block;font-size:12.5px;font-weight:700;color:var(--t1);margin-bottom:5px;}
.req{color:#C62828;margin-right:3px;}
body.en .req{margin-right:0;margin-left:3px;}
.fld input,.fld textarea,.fld select{width:100%;height:44px;padding:0 13px;border-radius:10px;border:1.5px solid var(--b1);background:var(--sur);color:var(--t1);font-family:inherit;font-size:13px;outline:none;transition:all .2s;box-shadow:0 1px 4px var(--sh);}
.fld textarea{height:80px;padding:10px 13px;resize:vertical;}
.fld input:focus,.fld textarea:focus,.fld select:focus{border-color:var(--pri);box-shadow:0 0 0 3px var(--pd);}
.fld input.err{border-color:#C62828;}
.ferr{font-size:11px;color:#C62828;margin-top:4px;display:none;align-items:center;gap:3px;}
.ferr.show{display:flex;}

/* FILE UPLOAD */
.f-area{border:2px dashed var(--b2);border-radius:12px;padding:1.2rem;text-align:center;background:#F8F9FF;cursor:pointer;transition:all .2s;position:relative;}
.f-area:hover{border-color:var(--pri);background:var(--pd);}
.f-area input{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%;}
.f-area-ico{font-size:26px;color:var(--t3);}
.f-area-t{font-size:12.5px;font-weight:700;color:var(--t2);margin-top:.4rem;}
.f-area-s{font-size:11px;color:var(--t3);margin-top:3px;}
.f-chips{display:flex;flex-wrap:wrap;gap:6px;margin-top:.7rem;justify-content:center;}
.chip{display:inline-flex;align-items:center;gap:5px;padding:3px 9px;border-radius:7px;background:var(--pd2);color:var(--pri);font-size:11px;font-weight:600;}
.chip-x{cursor:pointer;color:var(--t3);font-size:12px;}
.chip-x:hover{color:#C62828;}

/* PRIVACY */
.prv{display:flex;align-items:flex-start;gap:7px;padding:.8rem 1rem;border-radius:10px;background:var(--pd);border:1px solid var(--b1);margin-bottom:1rem;font-size:12px;color:var(--t2);line-height:1.7;}
.prv i{font-size:15px;color:var(--pri3);flex-shrink:0;margin-top:1px;}

/* SUBMIT */
.fm-sub{width:100%;height:50px;background:linear-gradient(135deg,var(--pri),var(--pri3));color:#fff;font-family:inherit;font-size:15px;font-weight:800;border:none;border-radius:12px;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;box-shadow:0 5px 18px var(--sh2);transition:all .25s;}
.fm-sub:hover{transform:translateY(-2px);}
.fm-sub.ld{opacity:.75;pointer-events:none;}
.spin{width:18px;height:18px;border:2.5px solid rgba(255,255,255,.35);border-top-color:#fff;border-radius:50%;animation:sp .7s linear infinite;display:none;}
.fm-sub.ld .spin{display:block;}
.fm-sub.ld .stxt{display:none;}
@keyframes sp{to{transform:rotate(360deg)}}

/* SUCCESS */
.succ{display:none;flex-direction:column;align-items:center;padding:3rem 2rem;text-align:center;}
.succ.on{display:flex;}
.succ-ico{width:72px;height:72px;border-radius:50%;background:rgba(27,94,32,.1);border:2px solid rgba(27,94,32,.2);display:flex;align-items:center;justify-content:center;font-size:32px;color:#1B5E20;margin-bottom:1.1rem;}
.succ-ttl{font-size:19px;font-weight:800;color:var(--t1);margin-bottom:.5rem;}
.succ-sub{font-size:13.5px;color:var(--t2);line-height:1.8;max-width:360px;}
.succ-ref{margin-top:1rem;padding:.7rem 1.4rem;border-radius:10px;background:var(--pd);border:1px solid var(--b1);font-size:13px;color:var(--pri);font-weight:700;}
.succ-btns{display:flex;gap:10px;margin-top:1.4rem;flex-wrap:wrap;justify-content:center;}
.s-b1{display:inline-flex;align-items:center;gap:6px;padding:9px 20px;border-radius:10px;background:var(--pri);color:#fff;font-family:inherit;font-size:13px;font-weight:700;cursor:pointer;border:none;text-decoration:none;}
.s-b2{display:inline-flex;align-items:center;gap:6px;padding:9px 20px;border-radius:10px;background:transparent;color:var(--pri);font-family:inherit;font-size:13px;font-weight:700;cursor:pointer;border:1.5px solid var(--b2);}

/* TOAST */
#amrtm-toast{display:none;}

/* FOOTER */
.footer{background:linear-gradient(135deg,#1A237E,#1565C0);margin-top:2rem;padding:1.2rem 2rem;text-align:center;}
.f-cp{font-size:12px;color:rgba(255,255,255,.55);}

::-webkit-scrollbar{width:5px;}
::-webkit-scrollbar-thumb{background:rgba(26,35,126,.2);border-radius:4px;}
@media(max-width:600px){
  .nb{padding:0 1rem;}
  .form-wrap{padding:1.2rem 1rem;}
  .fm-row{grid-template-columns:1fr;}
}

/* =========================
   CHANGE SERVICE BUTTON
========================= */

.change-service{
    display:flex;
    justify-content:flex-start;
    margin-bottom:1.5rem;
}

.fm-change{
    display:inline-flex;
    align-items:center;
    gap:.6rem;

    padding:.85rem 1.4rem;

    border:none;
    border-radius:14px;

    background:linear-gradient(
        135deg,
        var(--hf) 0%,
        var(--ht) 100%
    );

    color:#fff;

    font-size:14px;
    font-weight:700;

    cursor:pointer;

    box-shadow:0 8px 20px rgba(21,101,192,.25);

    transition:all .25s ease;
}

.fm-change i{
    font-size:18px;
    transition:transform .25s;
}

.fm-change:hover{
    transform:translateY(-3px);
    box-shadow:0 16px 35px rgba(21,101,192,.35);
}

.fm-change:hover i{
    transform:translateX(-4px);
}

.fm-change:active{
    transform:scale(.98);
}

.lg-btn-nafath{

    display:flex;
    align-items:center;
    justify-content:space-between;

    width:100%;

    padding:15px 18px;

    background:#1b8354;

    color:#fff;

    text-decoration:none;

    border-radius:16px;

    border:1px solid rgba(255,255,255,.12);

    box-shadow:
        0 10px 30px rgba(27,131,84,.18);

    transition:
        background .25s,
        transform .2s,
        box-shadow .25s;
}

.lg-btn-nafath:hover{

    background:#177148;

    color:#fff;

    transform:translateY(-2px);

    box-shadow:
        0 16px 38px rgba(27,131,84,.28);
}

.nf-icon{

    width:42px;
    height:42px;

    border-radius:12px;

    background:rgba(255,255,255,.14);

    display:flex;
    align-items:center;
    justify-content:center;

    flex-shrink:0;
}

.nf-icon i{

    font-size:22px;

    color:#fff;
}

.nf-text{

    flex:1;

    text-align:center;

    font-size:16px;

    font-weight:700;

    letter-spacing:.2px;

    color:#fff;
}

.nf-arrow{

    width:30px;

    display:flex;

    justify-content:flex-end;

    opacity:.9;
}

.nf-arrow i{

    font-size:20px;

    color:#fff;

    transition:transform .2s;
}

.lg-btn-nafath:hover .nf-arrow i{

    transform:translateX(-4px);
}

.usr-modal{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.45);
    display:none;
    align-items:center;
    justify-content:center;
    z-index:9999;
    backdrop-filter:blur(4px);
}

.usr-modal.show{
    display:flex;
}

.usr-modal-box{
    width:430px;
    max-width:92%;
    background:#fff;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 25px 60px rgba(0,0,0,.2);
    animation:pop .25s ease;
}

.form-check{
    background:#f8fafc;
    border:1px solid #e5e7eb;
    border-radius:12px;
    padding:14px 16px;
}

.form-check-input{
    margin-top:.3rem;
}

.form-check-label{
    font-size:14px;
    line-height:1.9;
    color:#374151;
}

.form-check-label a{
    color:#0f2d5c;
    font-weight:700;
    text-decoration:none;
}

.form-check-label a:hover{
    text-decoration:underline;
}

@keyframes pop{
    from{
        transform:translateY(20px) scale(.96);
        opacity:0;
    }
    to{
        transform:none;
        opacity:1;
    }
}

.usr-head{
    padding:18px 22px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    border-bottom:1px solid #eee;
}

.usr-head h3{
    margin:0;
    font-size:18px;
    display:flex;
    gap:8px;
    align-items:center;
}

.usr-close{
    border:none;
    background:none;
    font-size:22px;
    cursor:pointer;
}

.usr-body{
    padding:22px;
}

.usr-item{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:14px 0;
    border-bottom:1px solid #f1f1f1;
}

.usr-item span{
    color:#666;
}

.usr-item strong{
    color:#111;
}

.usr-note{
    margin-top:18px;
    padding:14px;
    background:#eef8ff;
    color:#2b5f88;
    border-radius:10px;
    display:flex;
    gap:8px;
    align-items:flex-start;
    font-size:14px;
}

.usr-foot{
    padding:18px;
    border-top:1px solid #eee;
}

.usr-ok{
    width:100%;
    height:46px;
    border:none;
    border-radius:10px;
    background:#1565C0;
    color:#fff;
    font-size:15px;
    cursor:pointer;
}

.verify-wrap{
    display:flex;
    justify-content:flex-end; 
    margin-bottom:16px;
    padding:10px;
}

.verify-link{
    display:inline-flex;
    align-items:center;
    gap:6px;

    color:#6991d1; 
    text-decoration:none;
    font-size:16px;
    font-weight:600;
    transition:.25s;
}

.verify-link:hover{
    color:#1a3460;
}

.verify-link i{
    font-size:18px;
}

.agreement-box{
    display:flex;
    gap:16px;
    align-items:flex-start;
    padding:18px;
    margin-top:20px;
    background:#fbfdff;
    border:1px solid #dbe4ef;
    border-right:5px solid #0f2d5c;
    border-radius:14px;
}

.agreement-icon{
    width:48px;
    height:48px;
    min-width:48px;
    border-radius:12px;
    background:#eef4fb;
    display:flex;
    align-items:center;
    justify-content:center;
}

.agreement-icon i{
    font-size:24px;
    color:#0f2d5c;
}

.agreement-label{
    display:flex;
    align-items:flex-start;
    gap:12px;
    margin:0;
    cursor:pointer;
    line-height:1.9;
    color:#374151;
    font-size:14px;
}

.agreement-label input[type="checkbox"]{
    width:20px;
    height:20px;
    margin-top:4px;
    accent-color:#0f2d5c;
    cursor:pointer;
    flex-shrink:0;
}

.agreement-label a{
    color:#0f2d5c;
    font-weight:700;
    text-decoration:none;
}

.agreement-label a:hover{
    text-decoration:underline;
}


/* ==========================================
   Responsive
========================================== */

/* Laptop */
@media (max-width:1200px){

    .ent-hero,
    .ents-wrap,
    .form-wrap{
        width:96%;
    }

    .ents-grid{
        grid-template-columns:repeat(2,1fr);
    }

}

/* Tablet */
@media (max-width:992px){

    .nb{
        padding:0 18px;
        min-height:68px;
        flex-wrap:wrap;
        gap:12px;
    }

    .nb-logo-nm{
        font-size:20px;
    }

    .ent-hero{
        padding:20px;
    }

    .ent-hero-in{
        flex-direction:column !important;
        text-align:center;
        gap:20px;
    }

    .ent-hero-in>div:last-child{
        text-align:center !important;
    }

    .category-logo{
        width:130px;
        height:130px;
    }

    .ent-hero-nm{
        font-size:28px;
    }

    .ents-grid{
        grid-template-columns:1fr 1fr;
        gap:18px;
    }

    .fm-row{
        grid-template-columns:1fr;
    }

}

/* Mobile */
@media (max-width:768px){

    .nb{
        padding:12px 14px;
    }

    .bc{
        font-size:12px;
    }

    .ent-hero{
        padding:18px;
        border-radius:18px;
    }

    .category-logo{
        width:100px;
        height:100px;
    }

    .ent-hero-nm{
        font-size:22px;
    }

    .ent-hero-tag{
        font-size:14px;
        margin-bottom:18px;
    }

    .search-box input{
        height:52px;
        font-size:14px;
    }

    .ents-grid{
        grid-template-columns:1fr;
    }

    .ec{
        min-height:auto;
    }

    .form-wrap{
        padding:1rem;
    }

    .svc-bar{
        flex-direction:column;
        text-align:center;
    }

    .svc-price{
        margin-top:8px;
    }

}

/* Small Mobile */
@media (max-width:480px){

    .nb-logo-nm{
        font-size:18px;
    }

    .nb-right{
        gap:5px;
    }

    .lt{
        font-size:10px;
        padding:3px 6px;
    }

    .nb-btn{
        padding:6px 10px;
        font-size:11px;
    }

    .ent-hero-nm{
        font-size:20px;
    }

    .ec-body{
        padding:14px;
        gap:12px;
    }

    .ec-ico{
        width:52px;
        height:52px;
    }

    .ec-ico i{
        font-size:20px;
    }

    .ec-nm{
        font-size:14px;
    }

    .ec-tag{
        font-size:12px;
    }

    .fm-body{
        padding:1rem;
    }

}

</style>
</head>
<body class="ar">

<!-- NAVBAR -->
<nav class="nb">
  <a class="nb-logo" href="{{ route('amrtm.index') }}">
    <div><div class="nb-logo-nm">آمر تم</div></div>
  </a>
  <div class="nb-mid"></div>
  <div class="nb-right">
    <div class="lng"><div class="lt on" id="la" onclick="setLang('ar')">AR</div><div class="lt" id="le" onclick="setLang('en')">EN</div></div>
    <div id="nb-guest" style="display:flex;gap:6px;">
      <a class="nb-btn out" href="{{ route('amrtm.login') }}?redirect={{ urlencode(request()->fullUrl()) }}"><i class="ti ti-login"></i><span id="nl-li">دخول</span></a>
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


<!-- ENTITY HERO -->
<div class="ent-hero">
     <!-- البحث -->
    <div class="services-search">

    <div class="search-box">

        <i class="ti ti-search search-icon"></i>

        <input
            type="text"
            id="searchInput"
            autocomplete="off"
            placeholder="ابحث عن خدمتك الآن"
            oninput="searchServices(this.value)"
        >

        <button
            id="clearSearch"
            type="button"
            onclick="clearSearch()"
            style="display:none;">

            <i class="ti ti-x"></i>

        </button>

        <div
            id="searchSuggestions"
            class="search-suggestions">
        </div>

    </div>

</div>
<!-- BREADCRUMB -->
<div class="bc-bar">
  <div class="bc">
    <a href="{{ route('amrtm.index') }}" id="bc-home"><i class="ti ti-home-2" style="font-size:13px;"></i> الرئيسية</a>
    <span class="bc-sep"><i class="ti ti-chevron-left" style="font-size:11px;"></i></span>
    <a href="{{ route('amrtm.catalog.category', $category->key) }}" id="bc-cat">{{ $category->name_ar }}</a>
    <span class="bc-sep"><i class="ti ti-chevron-left" style="font-size:11px;"></i></span>
    <span class="bc-cur" id="bc-ent">{{ $entity->name_ar }}</span>
  </div>
</div>
<div class="ent-hero-in">
    <div class="ent-hero-ico">

        @if(!empty($entity->images))
            <img
                src="{{ asset('images/uploads/' . $entity->images) }}"
                alt="{{ $entity->name_ar }}"
                class="category-logo">
        @else
            <i class="ti {{ $entity->icon ?? 'ti-building' }}"></i>
        @endif

    </div>

    <div>
        <div class="ent-hero-nm" id="ent-nm">
            {{ $entity->name_ar }}
        </div>

        <div class="ent-hero-tag" id="ent-tag">
            {{ $entity->tag_ar ?? '' }}
        </div>
    </div>
</div>
</div>

<!-- Maram--> 

<div class="ents-wrap" id="services-wrap">
 <div class="ents-grid">

        @foreach($entity->govServices as $svc)

        <div class="ec"
             style="
                --ecc: {{ $entity->color }};
                --ecbg: {{ $entity->bg }};    "
             onclick="selectService({{ $svc->id }})">

            <div class="ec-body">

                <div class="ec-ico"
                     style="
                        background: var(--ecbg);
                        color: var(--ecc);">
                    <i class="ti {{ $svc->icon ?? 'ti-file-text' }}"></i>
                </div>

              <div class="ec-info">

    <div class="ec-nm"
         data-ar="{{ $svc->name_ar }}"
         data-en="{{ $svc->name_en }}">
        {{ $svc->name_ar }}
    </div>

    <div class="ec-tag"
         data-ar="{{ \Illuminate\Support\Str::limit($svc->description_ar,60) }}"
         data-en="{{ \Illuminate\Support\Str::limit($svc->description_en,60) }}">
        {{ \Illuminate\Support\Str::limit($svc->description_ar,60) }}
    </div>

</div>

            </div>

            <div class="ec-foot">

          <span class="ec-svcs"
      data-ar="اطلب الخدمة"
      data-en="Request Service">
    اطلب الخدمة
        </span>
              <!--  <span class="ec-svcs">
                    {{ $svc->estimated_days }} يوم
                </span>

                <span class="ec-price" style="color: var(--ecc);">
                    {{ number_format($svc->price,2) }} ر.س
                </span> -->

                <i class="ti ti-arrow-left ec-arr"
                   style="color: var(--ecc);"></i>

            </div>

        </div>

        @endforeach

    </div> 
</div>


<!-- End maram -->

<!-- FORM CARD -->
<div class="form-wrap">
  <div class="form-card">

    @guest('business')
    <!-- LOGIN GATE (not logged in) -->
    <div class="login-gate" id="login-gate" style="display:none;">
      <div class="lg-ico"><i class="ti ti-lock"></i></div>
      <div class="lg-ttl" id="lg-ttl">تسجيل الدخول مطلوب</div>
      <p class="lg-sub" id="lg-sub">لتقديم طلب خدمة يجب أن يكون لديك حساب مسجل في المنصة. سجّل دخولك أو أنشئ حساباً جديداً مجاناً.</p>
  <div class="lg-btns">

    <a class="lg-btn-pri" href="{{ route('amrtm.login') }}?redirect={{ urlencode(request()->fullUrl()) }}">
        <i class="ti ti-login"></i>
        <span id="lg-login-lbl">تسجيل الدخول</span>
    </a>



    <a class="lg-btn-sec" href="{{ route('amrtm.register') }}">
        <i class="ti ti-user-plus"></i>
        <span id="lg-reg-lbl">إنشاء حساب جديد</span>
    </a>

   <!--    <a class="lg-btn-nafath" href="">
    <span class="nf-icon">
        <i class="ti ti-shield-lock"></i>
    </span>

    <span class="nf-text">
        الدخول عبر نفاذ
    </span>

    <span class="nf-arrow">
        <i class="ti ti-chevron-left"></i>
    </span>
</a>-->
</div>
    </div>
    @else
    <!-- SERVICE FORM (logged in) -->

    <!-- Success state -->
    <div class="succ" id="fm-succ">
      <div class="succ-ico"><i class="ti ti-circle-check"></i></div>
      <div class="succ-ttl" id="sc-t">تم تقديم طلبك بنجاح!</div>
      <div class="succ-sub" id="sc-s">سيتم مراجعة طلبك والتواصل معك خلال المدة المحددة.</div>
      <div class="succ-ref" id="sc-r">رقم الطلب: —</div>
      <div class="succ-btns">
        <a class="s-b1" href="{{ route('amrtm.user.dashboard') }}" id="sc-d">
          <i class="ti ti-layout-dashboard"></i><span id="sc-dl">تابع طلبك</span>
        </a>
        <button class="s-b2" onclick="rstFm()" id="sc-n"><span id="sc-nl">طلب جديد</span></button>
      </div>
    </div>



    <!-- Form inner -->
    <div id="fm-in" style="display:none;">
      <!-- Service selector -->
      <div class="svc-sel-wrap" style="display:none">
        <select id="fm-sel" onchange="onSelChange(this)">
          <option value="">اختر الخدمة المطلوبة...</option>
          @foreach($entity->govServices as $svc)
            <option value="{{ $svc->id }}" data-price="{{ $svc->price }}" data-icon="{{ $svc->icon ?? 'ti-file-text' }}"
                    data-name-ar="{{ $svc->name_ar }}" data-name-en="{{ $svc->name_en }}"
                    data-days="{{ $svc->estimated_days ?? 0 }}">
              {{ $svc->name_ar }} — {{ $svc->price }} ر.س
            </option>
          @endforeach
        </select>
      </div>


<div style="display:flex; justify-content:flex-end;">
    <button
        type="button"
        class="fm-change"
        style="
            background:linear-gradient(135deg,var(--pri),var(--pri3));
            color:#fff;
            padding:10px 20px;
            margin:12px;
            border:none;
            border-radius:10px;
            cursor:pointer;
            display:flex;
            align-items:center;
            gap:8px;
        "
        onclick="changeService()">

        <i class="ti ti-arrow-left"></i>
        <span id="chng-svc">تغيير الخدمة</span>

    </button>

</div>
      <!-- Service info bar -->
      <div class="svc-bar" id="svc-bar" style="display:none;">
        <div class="svc-ico" id="svc-ico"><i class="ti ti-file-text" id="svc-ico-i"></i></div>
        <div style="flex:1;">
          <div class="svc-nm" id="svc-nm">—</div>
          <div class="svc-cat" id="svc-days">—</div>
        </div>
        <div class="svc-price" id="svc-price" style="display:none;">—</div>
      </div>

      <!-- Balance bar -->
       
      <div class="bal-bar" id="bal-bar" style="display:none;">
        <span class="bal-lbl" id="bal-lbl">رصيدك الحالي:</span>
        <span class="bal-val" id="bal-val">...</span>
      </div>


<div class="verify-wrap">
    <a href="javascript:void(0)" class="verify-link" onclick="openUserModal()">
        <i class="ti ti-user-check"></i>
        <span>بيانات الحساب</span>
    </a>
</div>

<!-- Modal -->
<div class="usr-modal" id="usrModal">
    <div class="usr-modal-box">

        <div class="usr-head">
            <h3><i class="ti ti-user-check"></i> بيانات الحساب</h3>
            <button class="usr-close" onclick="closeUserModal()">
                <i class="ti ti-x"></i>
            </button>
        </div>

        <div class="usr-body">

            <div class="usr-item">
                <span>الاسم الكامل</span>
                <strong id="mName"></strong>
            </div>

            <div class="usr-item">
                <span>رقم الجوال</span>
                <strong id="mPhone"></strong>
            </div>

            <div class="usr-item">
                <span>البريد الإلكتروني</span>
                <strong id="mEmail"></strong>
            </div>

            <div class="usr-note">
                <i class="ti ti-info-circle"></i>
                سيتم استخدام هذه البيانات في تقديم الطلب. لتعديلها يرجى تحديث بيانات حسابك.
            </div>

        </div>

        <div class="usr-foot">
            <button class="usr-ok" onclick="closeUserModal()">
              البيانات صحيحة
            </button>
        </div>

    </div>
</div>


      <!-- Fields -->
      <div class="fm-body">
         <input type="hidden" id="fn" name="name">
        <input type="hidden" id="fph" name="phone">
        <input type="hidden" id="fem" name="email">
      
          <!--<div class="fld">
            <label><span class="req">*</span><span id="ln">الاسم الكامل</span></label>
            <input type="text" id="fn" value="{{ auth('business')->user()->name ?? '' }}"/>
            <div class="ferr" id="en"><i class="ti ti-alert-circle"></i><span id="ent">مطلوب</span></div>
          </div>-->
          <div class="fld">
            <label><span class="req">*</span><span id="lid">رقم الهوية / الإقامة</span></label>
            <input type="text" id="fid" maxlength="10"/>
            <div class="ferr" id="eid"><i class="ti ti-alert-circle"></i><span id="eidt">غير صحيح</span></div>
          </div>
       
       
       <!-- <div class="fm-row">
          <div class="fld">
            <label><span class="req">*</span><span id="lph">رقم الجوال</span></label>
            <input type="tel" id="fph" value="{{ auth('business')->user()->phone ?? '' }}"/>
            <div class="ferr" id="eph"><i class="ti ti-alert-circle"></i><span id="epht">غير صحيح</span></div>
          </div>
          <div class="fld">
            <label><span class="req">*</span><span id="lem">البريد الإلكتروني</span></label>
            <input type="email" id="fem" value="{{ auth('business')->user()->email ?? '' }}"/>
            <div class="ferr" id="eem"><i class="ti ti-alert-circle"></i><span id="eemt">غير صحيح</span></div>
          </div>
        </div>-->
      

<div class="company-check">
    <input type="checkbox" id="isCompany">
    <label for="isCompany" class="company-label">
        <span class="company-icon">
            <i class="ti ti-building"></i>
        </span>

        <span class="company-text">
            <strong>هل تمثل شركة؟</strong>
            <small>حدد هذا الخيار إذا كنت تسجل نيابةً عن شركة أو مؤسسة.</small>
        </span>

        <span class="company-switch"></span>
    </label>
</div>

<div id="companyFields" class="company-card" style="display:none;">

    <div class="company-card-header">
        <i class="ti ti-building"></i>
        <span>بيانات الشركة</span>
    </div>

    <div class="fm-row">

        <div class="fld">
            <label>اسم الشركة</label>
            <input type="text" id="fco" placeholder="أدخل اسم الشركة">
        </div>

        <div class="fld">
            <label>السجل التجاري</label>
            <input type="text" id="fcr" placeholder="أدخل رقم السجل التجاري">
        </div>

    </div>

</div>
<BR>
        <div class="fld">
          <label><span id="lno">ملاحظات</span></label>
          <textarea id="fno"></textarea>
        </div>
        <div class="fld">
          <label id="lfi">إرفاق ملفات</label>
          <div class="f-area" id="f-area">
            <input type="file" id="ffi" multiple accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" onchange="hndFiles(this)"/>
            <div class="f-area-ico"><i class="ti ti-cloud-upload"></i></div>
            <div class="f-area-t" id="fat">اضغط لرفع الملفات أو اسحبها هنا</div>
            <div class="f-area-s" id="fas">PDF, JPG, PNG — حد أقصى 10MB</div>
            <div class="f-chips" id="f-chips"></div>
          </div>
        </div>
       
       
        <div class="prv"><i class="ti ti-shield-check"></i><span id="prv-t">بياناتك محمية ومشفرة. لن يتم مشاركتها مع أي جهة خارجية دون موافقتك.</span></div>
        
      <div class="agreement-box">

    <div class="agreement-icon">
        <i class="ti ti-shield-check"></i>
    </div>

    <div class="agreement-content">

        <label for="agreeTerms" class="agreement-label">

            <input type="checkbox"
                   id="agreeTerms"
                   name="agree_terms"
                   required>

            <span>
                أتعهد بأن جميع البيانات والمعلومات التي قمت بإدخالها صحيحة ودقيقة وتخصني، وأتحمل كامل المسؤولية عن صحتها. كما أقر بأن المنصة غير مسؤولة عن أي بيانات غير صحيحة أو مضللة يتم تقديمها من قبلي، وأوافق على
                <a href="" target="_blank">سياسة الخصوصية</a>
                و
                <a href="" target="_blank">الشروط والأحكام</a>.
            </span>

        </label>

    </div>

</div>
<BR>
<BR>
        <button class="fm-sub" id="fm-sub" type="button" onclick="openInvoiceModal()">


        <!--<button class="fm-sub" id="fm-sub" onclick="sbmFm()">-->
          <span class="stxt" id="fm-st"><i class="ti ti-send"></i> مراجعة الطلب</span>
          <div class="spin"></div>
        </button>
      </div>
    </div><!-- /fm-in -->

    @endguest
  </div><!-- /form-card -->
</div><!-- /form-wrap -->


<!-- Ivoice Modal-->
<div class="usr-modal" id="invoiceModal">
    <div class="usr-modal-box">

        <div class="usr-head">
            <h3><i class="ti ti-receipt"></i> مراجعة الطلب</h3>

            <button class="usr-close" onclick="closeInvoiceModal()">
                <i class="ti ti-x"></i>
            </button>
        </div>

        <div class="usr-body">

            <h4 class="sec-title">بيانات مقدم الطلب</h4>

            <div class="usr-item">
                <span>الاسم</span>
                <strong id="rName"></strong>
            </div>

            <div class="usr-item">
                <span>الجوال</span>
                <strong id="rPhone"></strong>
            </div>

            <div class="usr-item">
                <span>البريد الإلكتروني</span>
                <strong id="rEmail"></strong>
            </div>

            <div class="usr-item">
                <span>رقم الهوية</span>
                <strong id="rNational"></strong>
            </div>

            <hr>

            <h4 class="sec-title">بيانات الخدمة</h4>

            <div class="usr-item">
                <span>الخدمة</span>
                <strong id="rService"></strong>
            </div>

            <div class="usr-item">
                <span>مدة التنفيذ</span>
                <strong id="rDays"></strong>
            </div>

            <div class="usr-item">
                <span>اسم الشركة</span>
                <strong id="rCompany"></strong>
            </div>

            <div class="usr-item">
                <span>السجل التجاري</span>
                <strong id="rCR"></strong>
            </div>

            <div class="usr-item">
                <span>الملاحظات</span>
                <strong id="rNotes"></strong>
            </div>

            <div class="usr-item">
                <span>المرفقات</span>
                <strong id="rFiles"></strong>
            </div>

            <hr>

            <div class="usr-item">
                <span style="font-size:18px;font-weight:700">
                    إجمالي قيمة الطلب
                </span>

                <strong id="rPrice"
                        style="font-size:22px;color:#1565C0">
                </strong>
            </div>

        </div>

        <div class="usr-foot"
             style="display:flex;gap:10px">

            <button class="usr-close-btn"
                    onclick="closeInvoiceModal()">
                رجوع
            </button>

            <button class="usr-ok"
                    onclick="confirmOrder()">
                <i class="ti ti-check"></i>
                تأكيد وإرسال الطلب
            </button>

        </div>

    </div>
</div>

<!-- FOOTER -->
<footer class="footer">
  <div class="f-cp" id="fcp">© 2025 <b style="color:rgba(255,255,255,.85);">آمر تم</b> — جميع الحقوق محفوظة</div>
</footer>

<script>
window.AMRTM_USER = {!! auth('business')->check() ? json_encode([
    'id'      => auth('business')->id(),
    'name'    => auth('business')->user()->name,
    'email'   => auth('business')->user()->email,
    'phone'   => auth('business')->user()->phone ?? '',
    'role'    => auth('business')->user()->role,
    'balance' => 0,
]) : 'null' !!};
window.AMRTM_CSRF     = '{{ csrf_token() }}';
window.AMRTM_API_BASE = '{{ url("/amrtm/api") }}';
window.AMRTM_ROUTES = {
    login:         '{{ route("amrtm.login") }}',
    logout:        '{{ route("amrtm.logout") }}',
    home:          '{{ route("amrtm.index") }}',
    userDashboard: '{{ route("amrtm.user.dashboard") }}',
    adminDashboard:'{{ route("amrtm.admin.dashboard") }}',
    catalogCat:    '{{ route("amrtm.catalog.category", $category->key) }}',
};

const pageData = {
    entityId:   {{ $entity->id }},
    entityKey:  '{{ $category->key }}',
    entityName: { ar:'{{ $entity->name_ar }}', en:'{{ $entity->name_en }}' },
    entityTag:  { ar:'{{ $entity->tag_ar ?? "" }}', en:'{{ $entity->tag_en ?? "" }}' },
    catName:    { ar:'{{ $category->name_ar }}', en:'{{ $category->name_en }}' },
};

const T = {
  ar:{
    home:'الرئيسية',li:'دخول',re:'تسجيل',da:'حسابي',dash:'لوحة التحكم',
    sel:'اختر الخدمة المطلوبة...',days:'مدة الإنجاز:',dayUnit:' يوم',
    bl:'رصيدك الحالي:',sar:'ر.س',
    ln:'الاسم الكامل',lid:'رقم الهوية / الإقامة',lph:'رقم الجوال',lem:'البريد الإلكتروني',
    lco:'اسم الشركة',lcr:'السجل التجاري',lno:'ملاحظات',lfi:'إرفاق ملفات',
    fat:'اضغط لرفع الملفات أو اسحبها هنا',fas:'PDF, JPG, PNG — حد أقصى 10MB',
    prv:'بياناتك محمية ومشفرة. لن يتم مشاركتها مع أي جهة خارجية دون موافقتك.',
    chngsvc:'تغيير الخدمة',
     search:"ابحث عن خدمتك الآن",
    sub:'تقديم الطلب',erq:'مطلوب',eid:'غير صحيح',eph:'غير صحيح',eem:'غير صحيح',
    sct:'تم تقديم طلبك بنجاح!',scs:'سيتم مراجعة طلبك والتواصل معك خلال المدة المحددة.',
    scr:'رقم الطلب: ',scd:'تابع طلبك',scn:'طلب جديد',
    noSvc:'اختر الخدمة أولاً',noBal:'رصيدك غير كافٍ — اشحن رصيدك من حسابك.',
    lgTtl:'تسجيل الدخول مطلوب',lgSub:'لتقديم طلب خدمة يجب أن يكون لديك حساب مسجل في المنصة.',
    lgLogin:'تسجيل الدخول',lgReg:'إنشاء حساب جديد',
  },
  en:{
    home:'Home',li:'Sign In',re:'Register',da:'My Account',dash:'Dashboard',
    sel:'Select required service...',days:'Completion time:',dayUnit:' days',
    bl:'Your balance:',sar:'SAR',
    search:"Search for your service...",
    ln:'Full Name',lid:'ID / Residency Number',lph:'Mobile Number',lem:'Email Address',
    lco:'Company Name',lcr:'Commercial Registration',lno:'Notes',lfi:'Attach Files',
    fat:'Click to upload or drag & drop',fas:'PDF, JPG, PNG — Max 10MB',
    prv:'Your data is protected and encrypted. It will not be shared with any third party.',
    chngsvc:'change service',
    sub:'Submit Application',erq:'Required',eid:'Invalid',eph:'Invalid',eem:'Invalid',
    sct:'Application Submitted Successfully!',scs:'Your application will be reviewed and we will contact you within the specified time.',
    scr:'Reference: ',scd:'Track Request',scn:'New Request',
    noSvc:'Select a service first',noBal:'Insufficient balance — top up from your account.',
    lgTtl:'Login Required',lgSub:'You need a registered account to submit a service request.',
    lgLogin:'Sign In',lgReg:'Create New Account',
  },
};

let lang = localStorage.getItem('amrtm_lang') || 'ar';
let files = [];
let curBalance = 0;

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
  document.documentElement.dir  = lang==='ar' ? 'rtl' : 'ltr';
  document.getElementById('nl-li').textContent  = t.li;
  document.getElementById('nl-re').textContent  = t.re;
  document.getElementById('nl-da').textContent  = t.da;
  document.getElementById('bc-home').childNodes[1].textContent = ' ' + t.home;
  document.getElementById('bc-cat').textContent  = pageData.catName[lang];
  document.getElementById('bc-ent').textContent  = pageData.entityName[lang];
  document.getElementById('ent-nm').textContent  = pageData.entityName[lang];
  document.getElementById('ent-tag').textContent = pageData.entityTag[lang];
      // ترجمة أسماء الخدمات والوصف
document.querySelectorAll(".ec-nm").forEach(el => {
    el.textContent = lang === "ar"
        ? el.dataset.ar
        : el.dataset.en;
});

document.querySelectorAll(".ec-tag").forEach(el => {
    el.textContent = lang === "ar"
        ? el.dataset.ar
        : el.dataset.en;
});
// ترجمة زر اطلب الخدمة
document.querySelectorAll(".ec-svcs").forEach(el => {
    el.textContent = lang === "ar"
        ? el.dataset.ar
        : el.dataset.en;
});
const inp=document.getElementById("searchInput");

inp.placeholder=T[lang].search;

if(lang==="ar"){

    inp.dir="rtl";
    inp.style.textAlign="right";

}else{

    inp.dir="ltr";
    inp.style.textAlign="left";

}
  // Form labels
  const ids = ['ln','lid','lph','lem','lco','lcr','lno','lfi','fat','fas','prv-t','chng-svc'];
  ids.forEach(id => { const el=document.getElementById(id); if(el) el.textContent=t[id]||t[id.replace('l','').toLowerCase()]||t[id]; });
  // Re-map specific ids
  if(document.getElementById('ln'))    document.getElementById('ln').textContent    = t.ln;
  if(document.getElementById('lid'))   document.getElementById('lid').textContent   = t.lid;
  if(document.getElementById('lph'))   document.getElementById('lph').textContent   = t.lph;
  if(document.getElementById('lem'))   document.getElementById('lem').textContent   = t.lem;
  if(document.getElementById('lco'))   document.getElementById('lco').textContent   = t.lco;
  if(document.getElementById('lcr'))   document.getElementById('lcr').textContent   = t.lcr;
  if(document.getElementById('lno'))   document.getElementById('lno').textContent   = t.lno;
  if(document.getElementById('lfi'))   document.getElementById('lfi').textContent   = t.lfi;
  if(document.getElementById('fat'))   document.getElementById('fat').textContent   = t.fat;
  if(document.getElementById('fas'))   document.getElementById('fas').textContent   = t.fas;
  if(document.getElementById('prv-t')) document.getElementById('prv-t').textContent = t.prv;
  if(document.getElementById('chng-svc')) document.getElementById('chng-svc').textContent = t.chngsvc;

  if(document.getElementById('fm-st')) document.getElementById('fm-st').innerHTML   = `<i class="ti ti-send"></i> ${t.sub}`;
  if(document.getElementById('bal-lbl')) document.getElementById('bal-lbl').textContent = t.bl;
  if(document.getElementById('sc-t'))  document.getElementById('sc-t').textContent  = t.sct;
  if(document.getElementById('sc-s'))  document.getElementById('sc-s').textContent  = t.scs;
  if(document.getElementById('sc-dl')) document.getElementById('sc-dl').textContent = t.scd;
  if(document.getElementById('sc-nl')) document.getElementById('sc-nl').textContent = t.scn;
  if(document.getElementById('ent'))   document.getElementById('ent').textContent   = t.erq;
  if(document.getElementById('eidt'))  document.getElementById('eidt').textContent  = t.eid;
  if(document.getElementById('epht'))  document.getElementById('epht').textContent  = t.eph;
  if(document.getElementById('eemt'))  document.getElementById('eemt').textContent  = t.eem;

  // Service select placeholder
  const sel = document.getElementById('fm-sel');
  if(sel && sel.options[0] && sel.options[0].value==='') sel.options[0].text = t.sel;
  // Update service option labels
  if(sel) {
    Array.from(sel.options).forEach(opt => {
      if(!opt.value) return;
      const nameAr = opt.dataset.nameAr;
      const nameEn = opt.dataset.nameEn;
      const price  = opt.dataset.price;
      opt.text = (lang==='ar' ? nameAr : nameEn) + ' — ' + price + ' ' + t.sar;
    });
  }
  // Re-render service bar if a service is selected
  const selEl = document.getElementById('fm-sel');
  if(selEl && selEl.value) onSelChange(selEl);
  // Login gate labels
  if(document.getElementById('lg-ttl'))      document.getElementById('lg-ttl').textContent      = t.lgTtl;
  if(document.getElementById('lg-sub'))      document.getElementById('lg-sub').textContent      = t.lgSub;
  if(document.getElementById('lg-login-lbl')) document.getElementById('lg-login-lbl').textContent = t.lgLogin;
  if(document.getElementById('lg-reg-lbl'))  document.getElementById('lg-reg-lbl').textContent  = t.lgReg;
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

async function loadBalance() {
  try {
    const res = await fetch(window.AMRTM_API_BASE + '/dashboard/user', {
      headers:{ 'Accept':'application/json', 'X-CSRF-TOKEN': window.AMRTM_CSRF },
      credentials:'same-origin',
    });
    if(res.ok) {
      const d = await res.json();
      //curBalance = parseFloat(d.balance ?? d.stats?.balance ?? 0);  #maram
      
      curBalance = parseFloat(  
    d.user?.balance ??
    d.balance ??
    d.stats?.balance ??
    0
);
      const el = document.getElementById('bal-val');
      if(el) el.textContent = curBalance.toFixed(2) + ' ' + T[lang].sar;
      if(window.AMRTM_USER) window.AMRTM_USER.balance = curBalance;
    }
  } catch(_) {}
}

function onSelChange(sel) {
  const t = T[lang];
  const opt = sel.options[sel.selectedIndex];
  const bar = document.getElementById('svc-bar');
  if(!opt || !opt.value) { if(bar) bar.style.display='none'; return; }
  if(bar) bar.style.display='flex';
  const icon  = opt.dataset.icon || 'ti-file-text';
  const price = parseFloat(opt.dataset.price||0);
  const days  = parseInt(opt.dataset.days||0);
  const nm    = lang==='ar' ? opt.dataset.nameAr : opt.dataset.nameEn;
  document.getElementById('svc-ico-i').className = 'ti ' + icon;
  document.getElementById('svc-ico').style.background = '{{ $entity->bg ?? "rgba(26,35,126,.09)" }}';
  document.getElementById('svc-nm').textContent    = nm;
  document.getElementById('svc-days').textContent  = days ? t.days + ' ' + days + t.dayUnit : '';
  document.getElementById('svc-price').textContent = price.toFixed(2) + ' ' + t.sar;
  document.getElementById('svc-price').style.color = '{{ $entity->color ?? "#1565C0" }}';
}
function selectService(id)
{
    // إضافة حالة جديدة للمتصفح حتى يعمل زر Back
    history.pushState({ service: id }, "", "#service");

    const sel = document.getElementById('fm-sel');

    if (sel) {
        sel.value = id;
        onSelChange(sel);
    }

    // إخفاء كروت الخدمات
    document.getElementById('services-wrap').style.display = 'none';

    @guest('business')

        // إظهار تسجيل الدخول
        const gate = document.getElementById('login-gate');

        gate.style.display = 'block';

        // إعادة تشغيل الأنيميشن
        gate.classList.remove('login-highlight');
        void gate.offsetWidth;
        gate.classList.add('login-highlight');

    @else

        // إظهار الفورم
        document.getElementById('fm-in').style.display = 'block';

    @endguest

    // الانتقال لأعلى الصفحة
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}


function changeService()
{
    document.getElementById('fm-in').style.display = 'none';

    document.getElementById('services-wrap').style.display = 'block';

    document.getElementById('services-wrap').scrollIntoView({
        behavior:'smooth',
        block:'start'
    });
}

/* ── FILE HANDLING ── */
function hndFiles(inp) {
  Array.from(inp.files).forEach(f => {
    if(f.size > 10*1024*1024) return;
    files.push(f);
  });
  renderChips();
  inp.value = '';
}
function renderChips() {
  document.getElementById('f-chips').innerHTML = files.map((f,i)=>
    `<div class="chip"><i class="ti ti-file"></i>${f.name.length>18?f.name.slice(0,15)+'...':f.name}<span class="chip-x" onclick="rmFile(${i})"><i class="ti ti-x"></i></span></div>`
  ).join('');
}
function rmFile(i) { files.splice(i,1); renderChips(); }

/* ── VALIDATION ── */
function validate() {
  const t = T[lang];
  let ok = true;
  const req = (id, errId, msg) => {
    const v = document.getElementById(id)?.value.trim();
    const e = document.getElementById(errId);
    if(!v){ if(e){e.querySelector('span').textContent=msg;e.classList.add('show');} document.getElementById(id)?.classList.add('err'); ok=false; }
    else  { if(e) e.classList.remove('show'); document.getElementById(id)?.classList.remove('err'); }
  };
  req('fn','en',t.erq);
  req('fid','eid',t.erq);
  req('fph','eph',t.erq);
  req('fem','eem',t.erq);
  const idv = document.getElementById('fid')?.value.trim();
  if(idv && !/^\d{10}$/.test(idv)){
    const e=document.getElementById('eid');
    if(e){e.querySelector('span').textContent=t.eid;e.classList.add('show');}
    document.getElementById('fid')?.classList.add('err');ok=false;
  }
  const phv = document.getElementById('fph')?.value.trim();
  if(phv && !/^[0-9+]{9,15}$/.test(phv)){
    const e=document.getElementById('eph');
    if(e){e.querySelector('span').textContent=t.eph;e.classList.add('show');}
    document.getElementById('fph')?.classList.add('err');ok=false;
  }
  return ok;
}
/* ── SUBMIT ── */
async function sbmFm() {

    const t = T[lang];

    const selEl = document.getElementById('fm-sel');

    if (!selEl.value) {
        showToast(t.noSvc, 'warning');
        return;
    }

    if (!validate()) return;

    const opt = selEl.options[selEl.selectedIndex];
    const price = parseFloat(opt.dataset.price || 0);

    if (price > 0 && curBalance < price) {
        showToast(t.noBal, 'error');
        return;
    }

    const btn = document.getElementById('fm-sub');
    btn.classList.add('ld');

    const fd = new FormData();

    // يجب أن تطابق أسماء الـ Validation
    fd.append('service_id', selEl.value);
    fd.append('client_name', document.getElementById('fn').value.trim());
    fd.append('client_email', document.getElementById('fem').value.trim());
    fd.append('client_phone', document.getElementById('fph').value.trim());
    fd.append('client_id_number', document.getElementById('fid').value.trim());
    fd.append('company_name', document.getElementById('fco').value.trim());
    fd.append('company_cr', document.getElementById('fcr').value.trim());
    fd.append('notes', document.getElementById('fno').value.trim());

    files.forEach((file) => {
        fd.append('attachments[]', file);
    });

    // للطباعة
    console.log("========= البيانات المرسلة =========");
    for (const [key, value] of fd.entries()) {
        console.log(key + " => ", value);
    }

    try {

        const res = await fetch(window.AMRTM_API_BASE + '/requests', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': window.AMRTM_CSRF
            },
            credentials: 'same-origin',
            body: fd
        });

        const d = await res.json();

        console.log("Response:", d);

        if (res.ok) {

            document.getElementById('fm-in').style.display = 'none';

            const succ = document.getElementById('fm-succ');

            succ.classList.add('on');

            document.getElementById('sc-r').textContent =
                "رقم الطلب: " + (d.ref_number ?? '---');

            succ.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });

        } else {

            console.log("Validation Errors:", d.errors);

            let msg = d.message || 'فشل تقديم الطلب';

            if (d.errors) {
                msg = Object.values(d.errors)
                    .flat()
                    .join('\n');
            }

            showToast(msg, 'error');
        }

    } catch (err) {

        console.error(err);

        showToast('حدث خطأ في الاتصال', 'error');

    }

    btn.classList.remove('ld');
}

function rstFm() {
  document.getElementById('fm-in').style.display='';
  document.getElementById('fm-succ').classList.remove('on');
  document.getElementById('fm-sel').value='';
  const bar = document.getElementById('svc-bar');
  if(bar) bar.style.display='none';
  ['fn','fid','fph','fem','fco','fcr','fno'].forEach(id => {
    const el = document.getElementById(id);
    if(el && id==='fn') el.value = window.AMRTM_USER?.name||'';
    else if(el && id==='fph') el.value = window.AMRTM_USER?.phone||'';
    else if(el && id==='fem') el.value = window.AMRTM_USER?.email||'';
    else if(el) el.value='';
  });
  files=[];renderChips();
}

/* ── TOAST ── */
function showToast(message, type='success', duration=3500) {
  const existing = document.getElementById('amrtm-toast');
  if(existing) existing.remove();
  const colors = {
    success:{bg:'rgba(27,94,32,.95)',icon:'ti-circle-check'},
    error:  {bg:'rgba(198,40,40,.95)',icon:'ti-alert-circle'},
    info:   {bg:'rgba(26,35,126,.95)',icon:'ti-info-circle'},
    warning:{bg:'rgba(230,81,0,.95)',icon:'ti-alert-triangle'},
  };
  const c = colors[type]||colors.info;
  const toast = document.createElement('div');
  toast.id='amrtm-toast';
  toast.style.cssText=`position:fixed;bottom:24px;${lang==='ar'?'right':'left'}:24px;z-index:9999;background:${c.bg};color:#fff;padding:12px 18px;border-radius:12px;font-size:13.5px;font-weight:600;display:flex;align-items:center;gap:9px;box-shadow:0 8px 24px rgba(0,0,0,.25);font-family:'Cairo',sans-serif;max-width:340px;`;
  toast.innerHTML=`<i class="ti ${c.icon}" style="font-size:18px;flex-shrink:0;"></i><span>${message}</span>`;
  document.body.appendChild(toast);
  setTimeout(()=>{toast.style.opacity='0';toast.style.transition='opacity .3s';setTimeout(()=>toast.remove(),300);},duration);
}

document.addEventListener('DOMContentLoaded', () => {
  applyLang();
  updateNavAuth();
  const stored = localStorage.getItem('amrtm_lang')||'ar';
  if(stored !== 'ar') setLang(stored);
  if(window.AMRTM_USER) loadBalance();
document.getElementById("fn").value  = window.AMRTM_USER.name || "";
    document.getElementById("fph").value = window.AMRTM_USER.phone || "";
    document.getElementById("fem").value = window.AMRTM_USER.email || "";

});


window.addEventListener('popstate', function () {

    // إظهار كروت الخدمات
    document.getElementById('services-wrap').style.display = 'block';

    // إخفاء الفورم
    const fm = document.getElementById('fm-in');
    if (fm) fm.style.display = 'none';

    // إخفاء شاشة تسجيل الدخول
    const gate = document.getElementById('login-gate');
    if (gate) gate.style.display = 'none';

    // إخفاء رسالة النجاح
    const succ = document.getElementById('fm-succ');
    if (succ) succ.classList.remove('on');

    // إلغاء اختيار الخدمة
    const sel = document.getElementById('fm-sel');
    if (sel) sel.selectedIndex = 0;

    // إخفاء شريط معلومات الخدمة
    const bar = document.getElementById('svc-bar');
    if (bar) bar.style.display = 'none';

    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

function openUserModal(){

    if(!window.AMRTM_USER) return;

    document.getElementById("mName").textContent  = window.AMRTM_USER.name;
    document.getElementById("mPhone").textContent = window.AMRTM_USER.phone;
    document.getElementById("mEmail").textContent = window.AMRTM_USER.email;

    document.getElementById("usrModal").classList.add("show");
}

function closeUserModal(){
    document.getElementById("usrModal").classList.remove("show");
}

// إغلاق النافذة عند الضغط خارجها
document.getElementById("usrModal").addEventListener("click",function(e){
    if(e.target===this){
        closeUserModal();
    }
});

function openInvoiceModal() {

    // بيانات الحساب
    document.getElementById("rName").textContent = window.AMRTM_USER.name;
    document.getElementById("rPhone").textContent = window.AMRTM_USER.phone;
    document.getElementById("rEmail").textContent = window.AMRTM_USER.email;

    // بيانات النموذج
    document.getElementById("rNational").textContent =
        document.getElementById("fid").value;

    document.getElementById("rCompany").textContent =
        document.getElementById("fco").value || "-";

    document.getElementById("rCR").textContent =
        document.getElementById("fcr").value || "-";

    document.getElementById("rNotes").textContent =
        document.getElementById("fno").value || "لا توجد";

    // الخدمة
    document.getElementById("rService").textContent =
        document.getElementById("svc-nm").textContent;

    document.getElementById("rDays").textContent =
        document.getElementById("svc-days").textContent;

    document.getElementById("rPrice").innerHTML =
        document.getElementById("svc-price").innerHTML;

    // عدد الملفات
    const files = document.getElementById("ffi").files.length;

    document.getElementById("rFiles").textContent =
        files ? files + " ملف" : "لا توجد";

    document.getElementById("invoiceModal").classList.add("show");
}

function closeInvoiceModal() {

    document.getElementById("invoiceModal")
        .classList.remove("show");

}

function confirmOrder(){

    closeInvoiceModal();

    sbmFm();

}

document.getElementById("invoiceModal")
.addEventListener("click",function(e){

    if(e.target===this){

        closeInvoiceModal();

    }

});

const isCompany = document.getElementById('isCompany');
const companyFields = document.getElementById('companyFields');

isCompany.addEventListener('change', function () {
    if (this.checked) {
        companyFields.style.display = 'block';
    } else {
        companyFields.style.display = 'none';
    }
});



function searchServices(value){

    value=value.trim().toLowerCase();

    clearBtn.style.display=value ? "block":"none";

    if(value===""){

        suggestions.style.display="none";

        document.querySelectorAll(".ec").forEach(card=>{

            card.style.display="flex";

        });

        return;
    }

    let found=0;

    let html="";

    document.querySelectorAll(".ec").forEach(card=>{

        const name=lang==="ar"
            ? card.querySelector(".ec-nm").dataset.ar.toLowerCase()
            : card.querySelector(".ec-nm").dataset.en.toLowerCase();

        const tag=lang==="ar"
            ? card.querySelector(".ec-tag").dataset.ar.toLowerCase()
            : card.querySelector(".ec-tag").dataset.en.toLowerCase();

        if(name.includes(value)||tag.includes(value)){

            found++;

            card.style.display="flex";

            html+=`
            <div class="search-item" onclick="openService(this)" data-id="${found}">

                <div class="search-icon-box">

                    ${card.querySelector(".ec-ico").innerHTML}

                </div>

                <div class="search-content">

                    <div class="title">

                        ${lang==="ar"
                            ? card.querySelector(".ec-nm").dataset.ar
                            : card.querySelector(".ec-nm").dataset.en}

                    </div>

                    <div class="sub">

                        ${lang==="ar"
                            ? card.querySelector(".ec-tag").dataset.ar
                            : card.querySelector(".ec-tag").dataset.en}

                    </div>

                </div>

            </div>`;
        }

        else{

            card.style.display="none";
        }

    });

    if(found){

        suggestions.innerHTML=html;

        suggestions.style.display="block";
    }

    else{

        suggestions.style.display="none";
    }
}

function clearSearch(){

    searchInput.value="";

    clearBtn.style.display="none";

    suggestions.style.display="none";

    document.querySelectorAll(".ec").forEach(card=>{

        card.style.display="flex";

    });

}

document.addEventListener("click",function(e){

    if(!e.target.closest(".search-box")){

        suggestions.style.display="none";
    }

});


</script>
</body>
</html>