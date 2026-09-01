<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>تسجيل منشأة جديدة — آمر تم</title>

    <link rel="icon"
          type="image/png"
          href="{{ asset('images/new-logo1.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --primary: #0f766e;
            --primary-dark: #115e59;
            --primary-light: #ecfdf5;

            --text: #172033;
            --muted: #718096;

            --border: #e5e7eb;
            --danger: #dc2626;
            --danger-bg: #fff7f7;

            --success: #059669;
            --success-bg: #ecfdf5;

            --white: #ffffff;
            --bg: #f4f7f8;

            --radius-lg: 18px;
            --radius-md: 12px;
            --radius-sm: 9px;

            --shadow:
                0 8px 30px rgba(15, 23, 42, .055);
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            background:
                linear-gradient(
                    180deg,
                    #f7fafb 0%,
                    #f3f6f8 100%
                );

            color: var(--text);

            font-family:
                "Cairo",
                sans-serif;
        }

        button,
        input,
        select {
            font-family: "Cairo", sans-serif;
        }

        /* =====================================================
           SUCCESS PAGE
        ===================================================== */

        .success-page {
            min-height: 100vh;

            display: flex;

            align-items: center;
            justify-content: center;

            padding: 30px 18px;
        }

        .success-card {
            width: min(620px, 100%);

            padding: 45px 30px;

            background: #fff;

            border:
                1px solid #e5e7eb;

            border-radius: 22px;

            text-align: center;

            box-shadow:
                0 15px 45px
                rgba(15, 23, 42, .08);
        }

        .success-icon {
            width: 82px;
            height: 82px;

            margin:
                0 auto 22px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background:
                #e8f8ef;

            color:
                #198754;

            font-size: 40px;
        }

        .success-card h1 {
            margin:
                0 0 12px;

            color:
                #198754;

            font-size: 27px;

            font-weight: 800;
        }

        .success-card p {
            margin: 0;

            color: #555;

            font-size: 15px;

            line-height: 2;
        }

        /* =====================================================
           PAGE
        ===================================================== */

        .page-container {
            width:
                min(
                    1240px,
                    calc(100% - 32px)
                );

            margin:
                24px auto 50px;
        }

        /* =====================================================
           HERO
        ===================================================== */

        .page-hero {
            position: relative;

            overflow: hidden;

            margin-bottom: 20px;

            padding:
                36px 35px;

            border-radius: 22px;

            color: #fff;

            background:
                linear-gradient(
                    135deg,
                    #0f766e 0%,
                    #116e68 48%,
                    #0d5d58 100%
                );

            box-shadow:
                0 15px 35px
                rgba(15,118,110,.15);
        }

        .page-hero::before {
            content: "";

            position: absolute;

            width: 300px;
            height: 300px;

            border-radius: 50%;

            background:
                rgba(255,255,255,.045);

            top: -170px;
            right: -80px;
        }

        .page-hero::after {
            content: "";

            position: absolute;

            width: 220px;
            height: 220px;

            border-radius: 50%;

            background:
                rgba(255,255,255,.035);

            bottom: -140px;
            left: -80px;
        }

        .hero-content {
            position: relative;

            z-index: 2;

            text-align: center;
        }

        .hero-icon {
            width: 64px;
            height: 64px;

            margin:
                0 auto 13px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 17px;

            background:
                rgba(255,255,255,.12);

            border:
                1px solid
                rgba(255,255,255,.16);

            font-size: 25px;
        }

        .page-hero h1 {
            margin:
                0 0 7px;

            font-size: 27px;

            font-weight: 800;
        }

        .page-hero p {
            max-width: 700px;

            margin: auto;

            color:
                rgba(255,255,255,.88);

            font-size: 13px;

            line-height: 1.9;
        }

        /* =====================================================
           ALERT
        ===================================================== */

        .alert {
            display: flex;

            align-items: flex-start;

            gap: 10px;

            margin-bottom: 15px;

            padding:
                13px 15px;

            border-radius: 12px;

            font-size: 12px;

            line-height: 1.8;
        }

        .alert i {
            margin-top: 4px;
        }

        .alert-danger {
            background:
                #fff7f7;

            border:
                1px solid #fecaca;

            color:
                #991b1b;
        }

        .alert-info {
            background:
                #eff6ff;

            border:
                1px solid #bfdbfe;

            color:
                #1e40af;
        }

        .error-list {
            margin:
                6px 0 0;

            padding-right:
                18px;
        }

        .error-list li {
            margin-bottom: 3px;
        }

        /* =====================================================
           SECTION CARD
        ===================================================== */

        .section-card {
            margin-bottom: 17px;

            padding: 22px;

            background:
                var(--white);

            border:
                1px solid var(--border);

            border-radius:
                var(--radius-lg);

            box-shadow:
                var(--shadow);
        }

        /* =====================================================
           SECTION HEADER
        ===================================================== */

        .section-header {
            display: flex;

            align-items: center;

            gap: 12px;

            margin-bottom: 18px;

            padding-bottom: 15px;

            border-bottom:
                1px solid #eef1f3;
        }

        .section-header-icon {
            width: 43px;
            height: 43px;

            min-width: 43px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 12px;

            color:
                var(--primary);

            background:
                var(--primary-light);

            font-size: 18px;
        }

        .section-header-text h2 {
            margin: 0;

            color:
                #172033;

            font-size: 17px;

            font-weight: 800;
        }

        .section-header-text p {
            margin:
                2px 0 0;

            color:
                var(--muted);

            font-size: 11px;
        }

        /* =====================================================
           FORM GRID
        ===================================================== */

        .form-grid {
            display: grid;

            grid-template-columns:
                repeat(
                    4,
                    minmax(0, 1fr)
                );

            gap:
                14px 15px;
        }

        .form-group {
            min-width: 0;
        }

        .form-label {
            display: block;

            margin-bottom: 6px;

            color:
                #374151;

            font-size: 12px;

            font-weight: 700;
        }

        .required {
            color:
                var(--danger);

            margin-right: 2px;
        }

        /* =====================================================
           INPUT
        ===================================================== */

        .input-wrapper {
            position: relative;

            width: 100%;
        }

        .input-icon {
            position: absolute;

            right: 13px;

            top: 50%;

            transform:
                translateY(-50%);

            color:
                var(--primary);

            font-size: 13px;

            z-index: 2;

            pointer-events: none;
        }

        .form-control {
            width: 100%;

            height: 43px;

            min-height: 43px;

            padding:
                8px 38px 8px 12px;

            border:
                1px solid #d8dee5;

            border-radius:
                var(--radius-sm);

            background:
                #fff;

            color:
                #1f2937;

            font-size: 12px;

            outline: none;

            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background .2s ease;
        }

        .form-control:hover {
            border-color:
                #b9c4ce;
        }

        .form-control:focus {
            border-color:
                var(--primary);

            box-shadow:
                0 0 0 3px
                rgba(15,118,110,.07);
        }

        .form-control::placeholder {
            color:
                #a0a8b3;
        }

        .form-control.invalid,
        .form-control.is-invalid {
            border-color:
                var(--danger) !important;

            background:
                var(--danger-bg);

            box-shadow:
                0 0 0 3px
                rgba(220,38,38,.07) !important;
        }

        .field-error {
            margin-top: 5px;

            color:
                var(--danger);

            font-size: 10px;

            line-height: 1.6;
        }

        select.form-control {
            appearance: none;

            cursor: pointer;

            padding-left:
                35px;
        }

        .select-arrow {
            position: absolute;

            left: 12px;

            top: 50%;

            transform:
                translateY(-50%);

            color:
                #7b8794;

            font-size: 10px;

            pointer-events:
                none;
        }

        /* =====================================================
           PASSWORD
        ===================================================== */

        .password-toggle {
            position: absolute;

            left: 10px;

            top: 50%;

            transform:
                translateY(-50%);

            border: 0;

            background: transparent;

            color:
                #7b8794;

            cursor: pointer;

            z-index: 3;
        }

        .password-toggle:hover {
            color:
                var(--primary);
        }

        /* =====================================================
           SPECIALTY
        ===================================================== */

        .specialty-box {
            padding:
                17px;

            border:
                1px solid #e6eaee;

            border-radius:
                14px;

            background:
                #fafcfc;
        }

        .specialty-box > .form-group {
            max-width:
                550px;
        }

        .specialty-info {
            display: flex;

            align-items: flex-start;

            gap: 9px;

            margin-top:
                12px;

            padding:
                10px 12px;

            color:
                #1e40af;

            background:
                #eff6ff;

            border:
                1px solid #bfdbfe;

            border-radius:
                10px;

            font-size:
                11px;

            line-height:
                1.8;
        }

        .specialty-info i {
            margin-top:
                4px;
        }

        .manual-specialty {
            display:
                none;

            margin-top:
                13px;

            max-width:
                550px;
        }

        .manual-specialty.show {
            display:
                block;
        }

        .manual-note {
            margin-top:
                8px;

            padding:
                9px 11px;

            border-radius:
                9px;

            background:
                #fff7ed;

            border:
                1px solid #fed7aa;

            color:
                #9a3412;

            font-size:
                10px;

            line-height:
                1.7;
        }

        /* =====================================================
           MULTI-SELECT SPECIALTIES & SERVICES
        ===================================================== */
        .multi-select-wrap {
            position: relative;
            width: 100%;
        }

        .multi-select-trigger {
            width: 100%;
            min-height: 48px;
            padding: 8px 14px;
            border: 1.5px solid #d8dee5;
            border-radius: var(--radius-sm);
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            cursor: pointer;
            transition: all .2s ease;
            outline: none;
        }

        .multi-select-trigger:hover {
            border-color: #b9c4ce;
        }

        .multi-select-trigger.active,
        .multi-select-trigger:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(15,118,110,.1);
        }

        .selected-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            align-items: center;
            flex: 1;
        }

        .placeholder-text {
            color: #a0a8b3;
            font-size: 13px;
        }

        .spec-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            background: var(--primary-light);
            color: var(--primary-dark);
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            line-height: 1.4;
            transition: all .15s ease;
        }

        .spec-tag .remove-tag {
            cursor: pointer;
            color: #0f766e;
            opacity: .7;
            font-size: 11px;
            transition: .15s;
        }

        .spec-tag .remove-tag:hover {
            opacity: 1;
            color: var(--danger);
        }

        .trigger-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .badge-count {
            background: var(--primary);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 12px;
        }

        .select-arrow-icon {
            color: var(--primary);
            font-size: 12px;
            transition: transform .2s ease;
        }

        .multi-select-wrap.open .select-arrow-icon {
            transform: rotate(180deg);
        }

        .multi-select-dropdown {
            position: absolute;
            top: calc(100% + 6px);
            right: 0;
            left: 0;
            background: #fff;
            border: 1px solid #d8dee5;
            border-radius: var(--radius-sm);
            box-shadow: 0 14px 35px rgba(15,23,42,.12);
            z-index: 100;
            display: none;
            flex-direction: column;
            overflow: hidden;
            max-height: 320px;
        }

        .multi-select-wrap.open .multi-select-dropdown {
            display: flex;
            animation: dropdownFade .2s ease;
        }

        @keyframes dropdownFade {
            from { opacity: 0; transform: translateY(-6px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .dropdown-search {
            padding: 10px 12px;
            border-bottom: 1px solid #edf2f7;
            position: relative;
            background: #f8fafc;
        }

        .dropdown-search i {
            position: absolute;
            right: 22px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 13px;
        }

        .dropdown-search input {
            width: 100%;
            height: 36px;
            padding: 6px 34px 6px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 7px;
            font-size: 12px;
            outline: none;
            background: #fff;
            transition: .2s;
        }

        .dropdown-search input:focus {
            border-color: var(--primary);
        }

        .dropdown-list {
            overflow-y: auto;
            max-height: 250px;
            padding: 6px;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: 7px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            transition: background .15s ease;
            user-select: none;
        }

        .dropdown-item:hover {
            background: #f1f5f9;
        }

        .dropdown-item.selected {
            background: var(--primary-light);
            color: var(--primary-dark);
        }

        .dropdown-item input[type="checkbox"] {
            width: 17px;
            height: 17px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        .dropdown-empty-hint {
            padding: 16px;
            text-align: center;
            color: #94a3b8;
            font-size: 12px;
        }

        /* Services container */
        .services-per-specialty-container {
            margin-top: 24px;
            border-top: 1.5px dashed #e2e8f0;
            padding-top: 20px;
        }

        .services-main-title {
            margin-bottom: 16px;
        }

        .title-with-icon {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
            font-weight: 800;
            color: var(--text);
        }

        .title-with-icon i {
            color: var(--primary);
            font-size: 17px;
        }

        .services-sub-hint {
            display: block;
            margin-top: 4px;
            font-size: 12px;
            color: var(--muted);
        }

        .spec-services-card {
            background: #fff;
            border: 1.5px solid #e2e8f0;
            border-radius: 14px;
            padding: 18px 20px;
            margin-bottom: 18px;
            box-shadow: 0 4px 14px rgba(15,23,42,.03);
            transition: all .2s ease;
        }

        .spec-services-card:hover {
            border-color: #cbd5e1;
            box-shadow: 0 6px 20px rgba(15,23,42,.06);
        }

        .spec-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f1f5f9;
            margin-bottom: 14px;
        }

        .spec-card-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 800;
            color: #0f172a;
        }

        .spec-card-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: var(--primary-light);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .spec-card-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-select-all-spec {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            color: #475569;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            transition: all .15s ease;
        }

        .btn-select-all-spec:hover {
            background: var(--primary-light);
            color: var(--primary-dark);
            border-color: #bbf7d0;
        }

        .services-grid-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 10px;
        }

        .service-checkbox-card {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px 14px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            cursor: pointer;
            transition: all .2s ease;
            user-select: none;
        }

        .service-checkbox-card:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
            transform: translateY(-1px);
        }

        .service-checkbox-card.checked {
            background: #f0fdf4;
            border-color: #86efac;
            box-shadow: 0 2px 8px rgba(34,197,94,.08);
        }

        .service-checkbox-card input[type="checkbox"] {
            margin-top: 3px;
            width: 17px;
            height: 17px;
            accent-color: var(--primary);
            cursor: pointer;
            flex-shrink: 0;
        }

        .service-card-info {
            flex: 1;
            min-width: 0;
        }

        .service-card-name {
            font-size: 12.5px;
            font-weight: 700;
            color: #1e293b;
            line-height: 1.5;
            margin-bottom: 4px;
        }

        .service-checkbox-card.checked .service-card-name {
            color: #14532d;
        }

        .service-card-meta {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            color: #64748b;
        }

        .service-badge-price {
            background: rgba(15,118,110,.1);
            color: var(--primary-dark);
            padding: 1px 6px;
            border-radius: 4px;
            font-weight: 700;
        }

        .service-badge-duration {
            background: #f1f5f9;
            padding: 1px 6px;
            border-radius: 4px;
        }

        /* Custom Service Adding section */
        .custom-services-global-card {
            background: #fafcfd;
            border: 1.5px dashed #cbd5e1;
            border-radius: 14px;
            padding: 16px 20px;
            margin-top: 16px;
        }

        .custom-service-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }

        .custom-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13.5px;
            font-weight: 800;
            color: #1e293b;
        }

        .btn-toggle-custom-add {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--primary-light);
            color: var(--primary-dark);
            border: 1px solid #bbf7d0;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
            transition: all .2s ease;
        }

        .btn-toggle-custom-add:hover {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        .custom-service-form-inline {
            margin-top: 14px;
            padding-top: 14px;
            border-top: 1px solid #e2e8f0;
            animation: dropdownFade .2s ease;
        }

        .custom-inputs-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: flex-end;
        }

        .btn-add-custom-service {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff;
            border: none;
            height: 43px;
            padding: 0 20px;
            border-radius: var(--radius-sm);
            font-family: inherit;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
            transition: opacity .2s;
            white-space: nowrap;
        }

        .btn-add-custom-service:hover {
            opacity: .9;
        }

        .custom-services-items-list {
            margin-top: 14px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .custom-service-row-item {
            background: #fff;
            border: 1px solid #a7f3d0;
            border-radius: 8px;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            animation: dropdownFade .2s ease;
        }

        .custom-row-info {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1;
            flex-wrap: wrap;
        }

        .custom-row-badge {
            background: #10b981;
            color: #fff;
            padding: 2px 7px;
            border-radius: 4px;
            font-size: 10.5px;
            font-weight: 700;
        }

        .custom-row-name {
            font-size: 13px;
            font-weight: 800;
            color: #0f172a;
        }

        .btn-remove-custom-svc {
            background: #fee2e2;
            color: #ef4444;
            border: none;
            width: 28px;
            height: 28px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 12px;
            transition: all .15s;
        }

        .btn-remove-custom-svc:hover {
            background: #ef4444;
            color: #fff;
        }


        /* =====================================================
           DOCUMENTS
        ===================================================== */

        .documents-grid {
            display: grid;

            grid-template-columns:
                repeat(
                    3,
                    minmax(0, 1fr)
                );

            gap:
                13px;
        }

        .file-box {
            min-width: 0;
        }

        .file-label {
            min-height:
                155px;

            display: flex;

            flex-direction:
                column;

            align-items: center;

            justify-content: center;

            padding:
                15px;

            text-align:
                center;

            background:
                #fafcfd;

            border:
                1.5px dashed #cbd5df;

            border-radius:
                14px;

            cursor:
                pointer;

            transition:
                .2s ease;
        }

        .file-label:hover {
            background:
                #f0fdfa;

            border-color:
                var(--primary);

            transform:
                translateY(-2px);

            box-shadow:
                0 7px 18px
                rgba(15,118,110,.07);
        }

        .file-label.invalid {
            background:
                #fff7f7;

            border-color:
                var(--danger);
        }

        .file-icon {
            width: 48px;
            height: 48px;

            margin-bottom:
                9px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius:
                13px;

            background:
                var(--primary-light);

            color:
                var(--primary);

            font-size:
                19px;
        }

        .file-title {
            color:
                #374151;

            font-size:
                12px;

            font-weight:
                800;
        }

        .file-hint {
            margin-top:
                4px;

            color:
                #9aa3ad;

            font-size:
                9px;

            line-height:
                1.6;
        }

        .file-input {
            display:
                none;
        }

        .file-name {
            min-height:
                17px;

            margin-top:
                5px;

            text-align:
                center;

            color:
                var(--primary);

            font-size:
                10px;

            font-weight:
                700;

            word-break:
                break-word;
        }

        /* =====================================================
           INFO
        ===================================================== */

        .info-note {
            display:
                flex;

            align-items:
                flex-start;

            gap:
                9px;

            margin-top:
                14px;

            padding:
                11px 13px;

            background:
                #f0fdfa;

            border:
                1px solid #ccfbf1;

            border-radius:
                10px;

            color:
                #115e59;

            font-size:
                11px;

            line-height:
                1.8;
        }

        .info-note i {
            margin-top:
                4px;
        }

        /* =====================================================
           ACTIONS
        ===================================================== */

        .form-actions {
            display:
                flex;

            align-items:
                center;

            justify-content:
                space-between;

            gap:
                20px;
        }

        .action-note {
            color:
                #6b7280;

            font-size:
                11px;

            line-height:
                1.9;
        }

        .action-note i {
            color:
                var(--primary);

            margin-left:
                4px;
        }

        .submit-btn {
            display:
                inline-flex;

            align-items:
                center;

            justify-content:
                center;

            gap:
                8px;

            min-height:
                45px;

            padding:
                8px 24px;

            border:
                0;

            border-radius:
                10px;

            background:
                linear-gradient(
                    135deg,
                    #0f766e,
                    #115e59
                );

            color:
                #fff;

            font-size:
                12px;

            font-weight:
                800;

            cursor:
                pointer;

            white-space:
                nowrap;

            box-shadow:
                0 6px 15px
                rgba(15,118,110,.16);

            transition:
                .2s ease;
        }

        .submit-btn:hover {
            transform:
                translateY(-2px);

            box-shadow:
                0 9px 20px
                rgba(15,118,110,.22);
        }

        .submit-btn:disabled {
            opacity:
                .7;

            cursor:
                not-allowed;

            transform:
                none;

            box-shadow:
                none;
        }

        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 1100px) {

            .form-grid {
                grid-template-columns:
                    repeat(
                        3,
                        minmax(0, 1fr)
                    );
            }
        }

        @media (max-width: 850px) {

            .page-container {
                width:
                    calc(100% - 24px);

                margin-top:
                    15px;
            }

            .form-grid {
                grid-template-columns:
                    repeat(
                        2,
                        minmax(0, 1fr)
                    );
            }

            .documents-grid {
                grid-template-columns:
                    repeat(
                        2,
                        minmax(0, 1fr)
                    );
            }
        }

        @media (max-width: 580px) {

            .page-container {
                width:
                    calc(100% - 14px);

                margin:
                    8px auto 25px;
            }

            .page-hero {
                padding:
                    27px 15px;

                border-radius:
                    15px;
            }

            .hero-icon {
                width:
                    50px;

                height:
                    50px;

                border-radius:
                    13px;

                font-size:
                    21px;
            }

            .page-hero h1 {
                font-size:
                    21px;
            }

            .page-hero p {
                font-size:
                    11px;

                line-height:
                    1.8;
            }

            .section-card {
                padding:
                    14px;

                border-radius:
                    13px;
            }

            .section-header {
                gap:
                    9px;

                margin-bottom:
                    13px;

                padding-bottom:
                    11px;
            }

            .section-header-icon {
                width:
                    37px;

                height:
                    37px;

                min-width:
                    37px;
            }

            .section-header-text h2 {
                font-size:
                    15px;
            }

            .section-header-text p {
                font-size:
                    9px;
            }

            .form-grid {
                grid-template-columns:
                    1fr;

                gap:
                    10px;
            }

            .documents-grid {
                grid-template-columns:
                    1fr;

                gap:
                    10px;
            }

            .specialty-box {
                padding:
                    11px;
            }

            .specialty-box > .form-group,
            .manual-specialty {
                max-width:
                    none;
            }

            .form-actions {
                flex-direction:
                    column;

                align-items:
                    stretch;
            }

            .submit-btn {
                width:
                    100%;
            }

            .success-card {
                padding:
                    35px 20px;
            }

            .success-card h1 {
                font-size:
                    23px;
            }

            .success-card p {
                font-size:
                    13px;
            }
        }


        /* ==============================================
           MULTI-SELECT SPECIALTIES WIDGET
        ============================================== */

        .multi-select-wrap {
            position: relative;
            width: 100%;
        }

        .multi-select-trigger {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 52px;
            padding: 8px 14px;
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: all .2s ease;
            gap: 8px;
        }

        .multi-select-trigger:hover {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(15, 118, 110, .08);
        }

        .multi-select-wrap.open .multi-select-trigger {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(15, 118, 110, .13);
        }

        .selected-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            flex: 1;
            align-items: center;
        }

        .placeholder-text {
            color: var(--muted);
            font-size: 13.5px;
        }

        .spec-tag {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: linear-gradient(135deg, var(--primary-light), #d1fae5);
            color: var(--primary-dark);
            font-size: 12.5px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
            border: 1px solid rgba(15, 118, 110, .15);
            animation: tagIn .25s ease;
        }

        @keyframes tagIn {
            from { transform: scale(.85); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .spec-tag .remove-tag {
            cursor: pointer;
            font-size: 10px;
            color: var(--danger);
            opacity: .65;
            transition: opacity .15s;
            margin-right: 2px;
        }

        .spec-tag .remove-tag:hover {
            opacity: 1;
        }

        .trigger-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }

        .badge-count {
            background: var(--primary);
            color: var(--white);
            font-size: 11px;
            font-weight: 800;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .select-arrow-icon {
            color: var(--muted);
            font-size: 13px;
            transition: transform .2s ease;
        }

        .multi-select-wrap.open .select-arrow-icon {
            transform: rotate(180deg);
        }

        /* Dropdown panel */
        .multi-select-dropdown {
            display: none;
            position: absolute;
            top: calc(100% + 6px);
            left: 0;
            right: 0;
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-md);
            box-shadow: 0 12px 40px rgba(15, 23, 42, .12);
            z-index: 120;
            max-height: 340px;
            overflow: hidden;
            animation: dropdownSlide .2s ease;
        }

        @keyframes dropdownSlide {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .multi-select-wrap.open .multi-select-dropdown {
            display: block;
        }

        .dropdown-search {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-bottom: 1px solid var(--border);
            background: #f8fafc;
        }

        .dropdown-search i {
            color: var(--muted);
            font-size: 13px;
        }

        .dropdown-search input {
            border: none;
            outline: none;
            background: transparent;
            flex: 1;
            font-size: 13.5px;
            color: var(--text);
            font-family: inherit;
        }

        .dropdown-list {
            overflow-y: auto;
            max-height: 270px;
            padding: 4px 0;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            cursor: pointer;
            transition: background .15s;
            font-size: 13.5px;
        }

        .dropdown-item:hover {
            background: var(--primary-light);
        }

        .dropdown-item.selected {
            background: #ecfdf5;
            font-weight: 700;
        }

        .dropdown-item input[type="checkbox"] {
            accent-color: var(--primary);
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            cursor: pointer;
        }

        .dropdown-empty-hint {
            padding: 20px;
            text-align: center;
            color: var(--muted);
            font-size: 13px;
        }


        /* ==============================================
           SERVICES PER SPECIALTY
        ============================================== */

        .services-per-specialty-container {
            margin-top: 20px;
            animation: fadeSlideIn .35s ease;
        }

        @keyframes fadeSlideIn {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .services-main-title {
            display: flex;
            flex-direction: column;
            gap: 4px;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--primary-light);
        }

        .services-main-title .title-with-icon {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
            font-weight: 800;
            color: var(--primary-dark);
        }

        .services-main-title .title-with-icon i {
            color: var(--primary);
        }

        .services-sub-hint {
            font-size: 12px;
            color: var(--muted);
            padding-right: 26px;
        }

        /* Specialty Service Card */
        .spec-services-card {
            background: #fafcfd;
            border: 1.5px solid #e8eef3;
            border-radius: var(--radius-md);
            padding: 0;
            margin-bottom: 14px;
            overflow: hidden;
            transition: border-color .2s;
        }

        .spec-services-card:hover {
            border-color: var(--primary);
        }

        .spec-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            background: linear-gradient(135deg, var(--primary-light), #d1fae5);
            border-bottom: 1px solid #e0f0ec;
        }

        .spec-card-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 800;
            color: var(--primary-dark);
        }

        .spec-card-icon {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: var(--primary);
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
        }

        .spec-card-actions {
            display: flex;
            gap: 6px;
        }

        .btn-select-all-spec {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: var(--white);
            color: var(--primary);
            border: 1px solid var(--primary);
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 11.5px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            transition: all .2s;
        }

        .btn-select-all-spec:hover {
            background: var(--primary);
            color: var(--white);
        }

        .services-grid-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 10px;
            padding: 14px;
        }

        /* Service Checkbox Card */
        .service-checkbox-card {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 12px 14px;
            background: var(--white);
            border: 1.5px solid #e8eef3;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: all .2s ease;
        }

        .service-checkbox-card:hover {
            border-color: var(--primary);
            box-shadow: 0 2px 10px rgba(15, 118, 110, .08);
        }

        .service-checkbox-card.checked {
            border-color: var(--primary);
            background: #ecfdf5;
            box-shadow: 0 0 0 2px rgba(15, 118, 110, .1);
        }

        .service-checkbox-card input[type="checkbox"] {
            accent-color: var(--primary);
            width: 16px;
            height: 16px;
            margin-top: 2px;
            flex-shrink: 0;
            cursor: pointer;
        }

        .service-card-info {
            flex: 1;
        }

        .service-card-name {
            font-size: 13px;
            font-weight: 700;
            color: var(--text);
            line-height: 1.4;
            margin-bottom: 4px;
        }

        .service-card-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .service-badge-price,
        .service-badge-duration {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 4px;
        }

        .service-badge-price {
            background: #fef3c7;
            color: #92400e;
        }

        .service-badge-duration {
            background: #e0f2fe;
            color: #0369a1;
        }


        /* ==============================================
           CUSTOM SERVICES GLOBAL CARD (+)
        ============================================== */

        .custom-services-global-card {
            margin-top: 16px;
            background: #fffbf0;
            border: 1.5px dashed #f59e0b;
            border-radius: var(--radius-md);
            padding: 0;
            overflow: hidden;
        }

        .custom-service-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
            padding: 12px 16px;
            background: linear-gradient(135deg, #fffbeb, #fef3c7);
            border-bottom: 1px solid #fde68a;
        }

        .custom-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13.5px;
            font-weight: 800;
            color: #92400e;
        }

        .btn-toggle-custom-add {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 16px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            transition: all .2s;
            box-shadow: 0 2px 8px rgba(15, 118, 110, .2);
        }

        .btn-toggle-custom-add:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(15, 118, 110, .3);
        }

        .custom-service-form-inline {
            padding: 16px;
            border-bottom: 1px solid #fde68a;
            animation: fadeSlideIn .25s ease;
        }

        .custom-inputs-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: flex-end;
        }

        .custom-add-btn-wrap {
            padding-bottom: 0;
        }

        .btn-add-custom-service {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 10px 22px;
            background: var(--primary);
            color: var(--white);
            border: none;
            border-radius: var(--radius-sm);
            font-size: 13px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            transition: all .2s;
            min-height: 44px;
        }

        .btn-add-custom-service:hover {
            background: var(--primary-dark);
        }

        .custom-services-items-list {
            padding: 0;
        }

        .custom-service-row-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 16px;
            border-bottom: 1px solid #fde68a;
            gap: 10px;
            transition: background .15s;
        }

        .custom-service-row-item:last-child {
            border-bottom: none;
        }

        .custom-service-row-item:hover {
            background: #fef9e7;
        }

        .custom-row-info {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
        }

        .custom-row-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #fbbf24;
            color: #78350f;
            font-size: 10.5px;
            font-weight: 800;
            padding: 3px 8px;
            border-radius: 4px;
        }

        .custom-row-name {
            font-size: 13px;
            font-weight: 700;
            color: var(--text);
        }

        .btn-remove-custom-svc {
            background: transparent;
            border: 1px solid var(--danger);
            color: var(--danger);
            width: 30px;
            height: 30px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all .2s;
            font-size: 12px;
            flex-shrink: 0;
        }

        .btn-remove-custom-svc:hover {
            background: var(--danger);
            color: var(--white);
        }


        /* ==============================================
           RESPONSIVE OVERRIDES FOR MULTI-SELECT
        ============================================== */

        @media (max-width: 600px) {
            .services-grid-list {
                grid-template-columns: 1fr;
            }

            .custom-inputs-grid {
                flex-direction: column;
            }

            .custom-inputs-grid .form-group {
                min-width: 100% !important;
                flex: 1 1 100% !important;
            }

            .spec-card-header {
                flex-direction: column;
                gap: 8px;
                align-items: flex-start;
            }

            .custom-service-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>

</head>


<body>

{{-- =========================================================
     SUCCESS
     مهم:
     لو نجح التسجيل، تظهر الرسالة فقط ولا تظهر الفورم.
========================================================= --}}

@if(session('success'))

    <div class="success-page">

        <div class="success-card">

            <div class="success-icon">
                <i class="fas fa-check"></i>
            </div>

            <h1>
                تم إرسال الطلب بنجاح
            </h1>

            <p>
                {{ session('success') }}
            </p>

        </div>

    </div>

@else

    <div class="page-container">

        {{-- =================================================
             HERO
        ================================================== --}}

        <section class="page-hero">

            <div class="hero-content">

                <div class="hero-icon">
                    <i class="fas fa-building-user"></i>
                </div>

                <h1>
                    تسجيل منشأة جديدة
                </h1>

                <p>
                    أدخل بيانات المكتب أو المنشأة والمستندات المطلوبة
                    لإرسال طلب التسجيل للمراجعة والاعتماد.
                </p>

            </div>

        </section>


        {{-- =================================================
             GENERAL ERRORS
        ================================================== --}}

        @if($errors->any())

            <div class="alert alert-danger">

                <i class="fas fa-circle-exclamation"></i>

                <div>

                    <strong>
                        يرجى مراجعة البيانات التالية:
                    </strong>

                    <ul class="error-list">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        @endif


        @if(session('info'))

            <div class="alert alert-info">

                <i class="fas fa-circle-info"></i>

                <div>
                    {{ session('info') }}
                </div>

            </div>

        @endif


        {{-- =================================================
             FORM
        ================================================== --}}

        <form
            method="POST"
            action="{{ route('amrtm.provider.account.store') }}"
            enctype="multipart/form-data"
            id="provider-form">

            @csrf


            {{-- =================================================
                 OFFICE DATA
            ================================================== --}}

            <section class="section-card">

                <div class="section-header">

                    <div class="section-header-icon">
                        <i class="fas fa-building"></i>
                    </div>

                    <div class="section-header-text">

                        <h2>
                            بيانات المنشأة
                        </h2>

                        <p>
                            البيانات الأساسية للمكتب أو مقدم الخدمة
                        </p>

                    </div>

                </div>


                <div class="form-grid">


                    {{-- الاسم العربي --}}

                    <div class="form-group">

                        <label class="form-label">

                            اسم المكتب (باللغة العربيه)

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-building input-icon"></i>

                            <input
                                type="text"
                                name="name_ar"
                                class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}"
                                placeholder="اسم المكتب بالعربية"
                                value="{{ old('name_ar') }}"
                                required>

                        </div>

                        @error('name_ar')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- الاسم الإنجليزي --}}

                    <div class="form-group">

                        <label class="form-label">

                            اسم المكتب (باللغة الانجليزيه)

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-building input-icon"></i>

                            <input
                                type="text"
                                name="name_en"
                                class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}"
                                placeholder="Office Name"
                                value="{{ old('name_en') }}"
                                dir="ltr"
                                required>

                        </div>

                        @error('name_en')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- المدير --}}

                    <div class="form-group">

                        <label class="form-label">

                            اسم مدير المكتب

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-user-tie input-icon"></i>

                            <input
                                type="text"
                                name="manager_name"
                                class="form-control {{ $errors->has('manager_name') ? 'is-invalid' : '' }}"
                                placeholder="أدخل اسم مدير المكتب"
                                value="{{ old('manager_name') }}"
                                required>

                        </div>

                        @error('manager_name')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- نوع المكتب --}}

                    <div class="form-group">

                        <label class="form-label">

                            إسم المنشأة

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-layer-group input-icon"></i>

                            <select
                                name="office_type"
                                id="office_type"
                                class="form-control {{ $errors->has('office_type') ? 'is-invalid' : '' }}"
                                required>

                                <option value="">
                                    اختر نوع المنشأة
                                </option>

                                <option
                                    value="law"
                                    {{ old('office_type') === 'law' ? 'selected' : '' }}>
                                    مكاتب المحاماة
                                </option>

                                <option
                                    value="services"
                                    {{ old('office_type') === 'services' ? 'selected' : '' }}>
                                    مكاتب الخدمات والتعقيب
                                </option>

                                <option
                                    value="customs"
                                    {{ old('office_type') === 'customs' ? 'selected' : '' }}>
                                    مكاتب التخليص الجمركي
                                </option>

                                <option
                                    value="accounting"
                                    {{ old('office_type') === 'accounting' ? 'selected' : '' }}>
                                    مكاتب الاستشارات المالية والضريبية
                                </option>

                                <option
                                    value="engineering"
                                    {{ old('office_type') === 'engineering' ? 'selected' : '' }}>
                                    مكاتب الاستشارات الهندسية
                                </option>

                                <option
                                    value="freelance"
                                    {{ old('office_type') === 'freelance' ? 'selected' : '' }}>
                                    أصحاب المهن الحرة
                                </option>

                            </select>

                            <i class="fas fa-chevron-down select-arrow"></i>

                        </div>

                        @error('office_type')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- الجوال --}}

                    <div class="form-group">

                        <label class="form-label">

                            رقم الجوال

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-phone input-icon"></i>

                            <input
                                type="tel"
                                name="phone"
                                class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                placeholder="05xxxxxxxx"
                                value="{{ old('phone') }}"
                                required>

                        </div>

                        @error('phone')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- البريد --}}

                    <div class="form-group">

                        <label class="form-label">

                            البريد الإلكتروني

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-envelope input-icon"></i>

                            <input
                                type="email"
                                name="email"
                                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                placeholder="example@email.com"
                                value="{{ old('email') }}"
                                dir="ltr"
                                autocomplete="off"
                                required>

                        </div>

                        @error('email')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- password --}}

                    <div class="form-group">

                        <label class="form-label">

                            كلمة المرور

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-lock input-icon"></i>

                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                placeholder="8 أحرف على الأقل"
                                autocomplete="new-password"
                                minlength="8"
                                required>

                            <button
                                type="button"
                                class="password-toggle"
                                data-target="password">

                                <i class="fas fa-eye"></i>

                            </button>

                        </div>

                        @error('password')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- confirmation --}}

                    <div class="form-group">

                        <label class="form-label">

                            تأكيد كلمة المرور

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-lock input-icon"></i>

                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                class="form-control"
                                placeholder="أعد إدخال كلمة المرور"
                                autocomplete="new-password"
                                minlength="8"
                                required>

                            <button
                                type="button"
                                class="password-toggle"
                                data-target="password_confirmation">

                                <i class="fas fa-eye"></i>

                            </button>

                        </div>

                    </div>


                    {{-- الدولة --}}

                    <div class="form-group">

                        <label class="form-label">

                            الدولة

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-globe input-icon"></i>

                            <input
                                type="text"
                                name="country"
                                class="form-control"
                                placeholder="المملكة العربية السعودية"
                                
                                required>

                        </div>

                        @error('country')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- المنطقة --}}

                    <div class="form-group">

                        <label class="form-label">

                            المنطقة

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-map input-icon"></i>

                            <input
                                type="text"
                                name="governorate"
                                class="form-control"
                                placeholder="منطقة مكة المكرمة"
                                value="{{ old('governorate') }}"
                                required>

                        </div>

                        @error('governorate')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- المدينة --}}

                    <div class="form-group">

                        <label class="form-label">

                            المدينة

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-location-dot input-icon"></i>

                            <input
                                type="text"
                                name="city"
                                class="form-control"
                                placeholder="جدة"
                                value="{{ old('city') }}"
                                required>

                        </div>

                        @error('city')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- الحي --}}

                    <div class="form-group">

                        <label class="form-label">

                            الحي

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-map-location-dot input-icon"></i>

                            <input
                                type="text"
                                name="district"
                                class="form-control"
                                placeholder="اسم الحي"
                                value="{{ old('district') }}"
                                required>

                        </div>

                        @error('district')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- الشارع --}}

                    <div class="form-group">

                        <label class="form-label">

                            الشارع

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-road input-icon"></i>

                            <input
                                type="text"
                                name="street"
                                class="form-control"
                                placeholder="اسم الشارع"
                                value="{{ old('street') }}"
                                required>

                        </div>

                        @error('street')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- رقم المبنى --}}

                    <div class="form-group">

                        <label class="form-label">

                            رقم المبنى

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-house input-icon"></i>

                            <input
                                type="text"
                                name="building_number"
                                class="form-control"
                                placeholder="رقم المبنى"
                                value="{{ old('building_number') }}"
                                required>

                        </div>

                        @error('building_number')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- رقم المكتب --}}

                    <div class="form-group">

                        <label class="form-label">
                            رقم المكتب
                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-door-open input-icon"></i>

                            <input
                                type="text"
                                name="office_number"
                                class="form-control"
                                placeholder="رقم المكتب"
                                value="{{ old('office_number') }}">

                        </div>

                    </div>


                    {{-- CR --}}

                    <div class="form-group">

                        <label class="form-label">

                            رقم السجل التجاري (الموحد)

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-file-invoice input-icon"></i>

                            <input
                                type="text"
                                name="cr_number"
                                id="cr_number"
                                class="form-control"
                                placeholder="رقم السجل التجاري"
                                value="{{ old('cr_number') }}"
                                required>

                        </div>

                        @error('cr_number')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- License --}}

                    <div class="form-group">

                        <label class="form-label">

                            رقم ترخيص المزاولة المهنية

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-id-card input-icon"></i>

                            <input
                                type="text"
                                name="license_number"
                                id="license_number"
                                class="form-control"
                                placeholder="رقم الترخيص"
                                value="{{ old('license_number') }}"
                                required>

                        </div>

                        @error('license_number')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Trademark --}}

                    <div class="form-group">

                        <label class="form-label">

                            رقم تسجيل العلامة التجارية

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-certificate input-icon"></i>

                            <input
                                type="text"
                                name="trademark_registration_number"
                                id="trademark_registration_number"
                                class="form-control"
                                placeholder="اختياري"
                                value="{{ old('trademark_registration_number') }}">

                        </div>

                        @error('trademark_registration_number')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                </div>

            </section>


            {{-- =================================================
                 SPECIALTY & SERVICES
            ================================================== --}}

            <section class="section-card" id="specialties-section">

                <div class="section-header">

                    <div class="section-header-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>

                    <div class="section-header-text">

                        <h2>
                            التخصص والخدمات المقدمة
                        </h2>

                        <p>
                            اختر تخصص المنشأة، وحدد الخدمات المناسبة أو أضف خدمات خاصة بك
                        </p>

                    </div>

                </div>


                <div class="specialty-box">

                    {{-- Single-select dropdown for specialty --}}
                    <div class="form-group">

                        <label class="form-label">
                            التخصص المهني
                            <span class="required">*</span>
                        </label>

                        <div class="input-wrapper">
                            <i class="fas fa-list-check input-icon"></i>
                            <select
                                name="specialty"
                                id="specialty"
                                class="form-control"
                                required
                                disabled>
                                <option value="">اختر نوع المنشأة أولاً</option>
                            </select>
                            <i class="fas fa-chevron-down select-arrow"></i>
                        </div>

                        @error('specialty')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="specialty-info" id="specialty-info-box">
                        <i class="fas fa-circle-info"></i>
                        <div id="specialty-message">
                            اختر نوع المنشأة أولاً لعرض التخصصات المتاحة.
                        </div>
                    </div>


                    {{-- Manual Specialty --}}
                    <div class="manual-specialty" id="manual-specialty">

                        <div class="form-group">

                            <label class="form-label">
                                اكتب التخصص الذي تمارسه حالياً
                                <span class="required">*</span>
                            </label>

                            <div class="input-wrapper">
                                <i class="fas fa-pen input-icon"></i>
                                <input
                                    type="text"
                                    name="manual_specialty"
                                    id="manual_specialty"
                                    class="form-control"
                                    placeholder="اكتب التخصص الإضافي هنا..."
                                    value="{{ old('manual_specialty') }}">
                            </div>

                            @error('manual_specialty')
                                <div class="field-error">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="manual-note">
                                <i class="fas fa-clock"></i>
                                التخصص المكتوب يدويًا سيتم إرساله للإدارة للمراجعة والاعتماد.
                            </div>

                        </div>

                    </div>

                    {{-- Dynamic Services Section for Selected Specialty --}}
                    <div class="services-per-specialty-container" id="services-container" style="display: none;">
                        <div class="services-main-title">
                            <div class="title-with-icon">
                                <i class="fas fa-list-check"></i>
                                <span>الخدمات المناسبة للتخصص المختار</span>
                            </div>
                            <span class="services-sub-hint">حدد الخدمات التي تقدمها أو أضف خدماتك الخاصة باستخدام أيقونة (+)</span>
                        </div>

                        {{-- Container for dynamically inserted service cards --}}
                        <div id="specialty-services-cards-list"></div>

                        {{-- Global Custom Services Adder (+) --}}
                        <div class="custom-services-global-card">
                            <div class="custom-service-header">
                                <div class="custom-title">
                                    <i class="fas fa-plus-circle" style="color: var(--primary);"></i>
                                    <span>إضافة خدمة خاصة / مخصصة للمنشأة (+)</span>
                                </div>
                                <button type="button" class="btn-toggle-custom-add" id="btn-toggle-global-custom" onclick="toggleGlobalCustomForm()">
                                    <i class="fas fa-plus"></i>
                                    <span>إضافة خدمة مخصصة</span>
                                </button>
                            </div>

                            {{-- Inline form to add custom service (name only) --}}
                            <div class="custom-service-form-inline" id="global-custom-form" style="display: none;">
                                <div class="custom-inputs-grid">
                                    <div class="form-group" style="flex: 3; min-width: 280px;">
                                        <label class="form-label">اسم الخدمة الخاصة <span class="required">*</span></label>
                                        <div class="input-wrapper">
                                            <i class="fas fa-file-signature input-icon"></i>
                                            <input type="text" id="custom-svc-name" class="form-control" placeholder="مثال: تقديم استشارة مخصصة للمشاريع">
                                        </div>
                                    </div>
                                    <div class="form-group custom-add-btn-wrap" style="align-self: flex-end;">
                                        <button type="button" class="btn-add-custom-service" onclick="addGlobalCustomService()">
                                            <i class="fas fa-plus"></i>
                                            <span>إضافة</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- Custom Services List --}}
                            <div class="custom-services-items-list" id="global-custom-services-list"></div>
                        </div>

                    </div>

                    {{-- Hidden container for all selected/custom services inputs --}}
                    <div id="hidden-services-inputs"></div>

                </div>

            </section>




            {{-- =================================================
                 DOCUMENTS
            ================================================== --}}

            <section class="section-card">

                <div class="section-header">

                    <div class="section-header-icon">
                        <i class="fas fa-paperclip"></i>
                    </div>

                    <div class="section-header-text">

                        <h2>
                            إرفاق المستندات التالية
                        </h2>

                        <p>
                            المستندات المطلوبة لإتمام طلب التسجيل
                        </p>

                    </div>

                </div>


                <div class="documents-grid">


                    {{-- CR FILE --}}

                    <div class="file-box">

                        <label
                            class="file-label"
                            id="commercial_register_image-label"
                            for="commercial_register_image">

                            <div class="file-icon">
                                <i class="fas fa-file-invoice"></i>
                            </div>

                            <div class="file-title">

                               إرفاق السجل التجاري

                                <span class="required">*</span>

                            </div>

                            <div class="file-hint">
                                جميع أنواع الملفات مسموحة
                            </div>

                        </label>

                        <input
                            type="file"
                            id="commercial_register_image"
                            name="commercial_register_image"
                            class="file-input"
                            required>

                        <div
                            class="file-name"
                            id="commercial_register_image-name">
                        </div>

                        @error('commercial_register_image')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- LICENSE FILE --}}

                    <div class="file-box">

                        <label
                            class="file-label"
                            id="license_image-label"
                            for="license_image">

                            <div class="file-icon">
                                <i class="fas fa-id-card"></i>
                            </div>

                            <div class="file-title">

                               إرفاق ترخيص المزاولة المهنية

                                <span class="required">*</span>

                            </div>

                            <div class="file-hint">
                                جميع أنواع الملفات مسموحة
                            </div>

                        </label>

                        <input
                            type="file"
                            id="license_image"
                            name="license_image"
                            class="file-input"
                            required>

                        <div
                            class="file-name"
                            id="license_image-name">
                        </div>

                        @error('license_image')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- TRADEMARK --}}

                    <div class="file-box">

                        <label
                            class="file-label"
                            id="trademark_certificate-label"
                            for="trademark_certificate">

                            <div class="file-icon">
                                <i class="fas fa-certificate"></i>
                            </div>

                            <div class="file-title">

                               إرفاق شهادة تسجيل العلامة التجارية

                                <span
                                    class="required"
                                    id="trademark-required-star"
                                    style="display:none;">

                                    *

                                </span>

                            </div>

                            <div
                                class="file-hint"
                                id="trademark-file-hint">

                                اختيارية — تصبح مطلوبة عند إدخال رقم العلامة

                            </div>

                        </label>

                        <input
                            type="file"
                            id="trademark_certificate"
                            name="trademark_certificate"
                            class="file-input">

                        <div
                            class="file-name"
                            id="trademark_certificate-name">
                        </div>

                        @error('trademark_certificate')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- CERTIFICATES --}}

                    <div class="file-box">

                        <label
                            class="file-label"
                            id="certificates-label"
                            for="certificates">

                            <div class="file-icon">
                                <i class="fas fa-award"></i>
                            </div>

                            <div class="file-title">
                               إرفاق الشهادات العملية
                            </div>

                            <div class="file-hint">
                                أكثر من ملف — اختيارية
                            </div>

                        </label>

                        <input
                            type="file"
                            id="certificates"
                            name="certificates[]"
                            class="file-input"
                            multiple>

                        <div
                            class="file-name"
                            id="certificates-name">
                        </div>

                    </div>


                    {{-- APPRECIATION --}}

                    <div class="file-box">

                        <label
                            class="file-label"
                            id="appreciation_certificates-label"
                            for="appreciation_certificates">

                            <div class="file-icon">
                                <i class="fas fa-medal"></i>
                            </div>

                            <div class="file-title">
                               إرفاق شهادات التقدير
                            </div>

                            <div class="file-hint">
                                أكثر من ملف — اختيارية
                            </div>

                        </label>

                        <input
                            type="file"
                            id="appreciation_certificates"
                            name="appreciation_certificates[]"
                            class="file-input"
                            multiple>

                        <div
                            class="file-name"
                            id="appreciation_certificates-name">
                        </div>

                    </div>


                    {{-- CV --}}

                    <div class="file-box">

                        <label
                            class="file-label"
                            id="cv-label"
                            for="cv">

                            <div class="file-icon">
                                <i class="fas fa-file-lines"></i>
                            </div>

                            <div class="file-title">
                               إرفاق السيرة الذاتية
                            </div>

                            <div class="file-hint">
                                اختيارية
                            </div>

                        </label>

                        <input
                            type="file"
                            id="cv"
                            name="cv"
                            class="file-input">

                        <div
                            class="file-name"
                            id="cv-name">
                        </div>

                    </div>


                </div>


                <div class="info-note">

                    <i class="fas fa-shield-halved"></i>

                    <div>

                        يتم حفظ المستندات بشكل آمن، ولن يظهر المكتب
                        بشكل نهائي على المنصة إلا بعد مراجعة واعتماد الإدارة.

                    </div>

                </div>

            </section>


            {{-- =================================================
                 SUBMIT
            ================================================== --}}

            <section class="section-card">

                <div class="form-actions">

                    <div class="action-note">

                        <i class="fas fa-circle-info"></i>

                        تأكد من صحة جميع البيانات قبل الإرسال.

                        <br>

                        الحقول التي تحمل
                        <span class="required">*</span>
                        إلزامية.

                    </div>


                    <button
                        type="submit"
                        class="submit-btn"
                        id="submit-btn">

                        <i class="fas fa-paper-plane"></i>

                        إرسال الطلب للمراجعة

                    </button>

                </div>

            </section>

        </form>

    </div>

@endif


<script>

document.addEventListener('DOMContentLoaded', function () {

    /* =====================================================
       ELEMENTS
    ===================================================== */

    const officeType = document.getElementById('office_type');
    const specialty = document.getElementById('specialty');
    const specialtyMessage = document.getElementById('specialty-message');
    const manualBox = document.getElementById('manual-specialty');
    const manualInput = document.getElementById('manual_specialty');
    const form = document.getElementById('provider-form');
    const submitButton = document.getElementById('submit-btn');

    const servicesContainer = document.getElementById('services-container');
    const specialtyServicesCardsList = document.getElementById('specialty-services-cards-list');
    const globalCustomServicesList = document.getElementById('global-custom-services-list');
    const hiddenServicesContainer = document.getElementById('hidden-services-inputs');

    const trademarkNumber = document.getElementById('trademark_registration_number');
    const trademarkCertificate = document.getElementById('trademark_certificate');
    const trademarkRequiredStar = document.getElementById('trademark-required-star');
    const trademarkFileHint = document.getElementById('trademark-file-hint');

    if (!form) {
        return;
    }

    /* =====================================================
       ROUTE
    ===================================================== */

    const specialtiesUrl = @json(route('amrtm.provider.account.specialties'));

    /* =====================================================
       STATE
    ===================================================== */

    let loadedSpecialties = [];
    let selectedServices = {};   // { 'service_name': { name_ar, name_en } }
    let customServices = [];     // [{ id, name_ar }]

    /* =====================================================
       OLD VALUES
    ===================================================== */

    const oldOfficeType = @json(old('office_type'));
    const oldSpecialty = @json(old('specialty'));
    const oldCustomServices = @json(old('custom_services', []));

    /* =====================================================
       MANUAL SPECIALTY
    ===================================================== */

    function showManualSpecialty() {
        if (!manualBox || !manualInput) return;
        manualBox.classList.add('show');
        manualInput.required = true;
    }

    function hideManualSpecialty() {
        if (!manualBox || !manualInput) return;
        manualBox.classList.remove('show');
        manualInput.required = false;
    }

    function handleSpecialtyChange() {
        if (!specialty) return;

        if (specialty.value === 'other') {
            showManualSpecialty();
        } else {
            hideManualSpecialty();
        }

        // Show services for the selected specialty
        renderServicesUI();
        syncHiddenInputs();
    }

    /* =====================================================
       LOAD SPECIALTIES (single-select)
    ===================================================== */

    async function loadSpecialties(selectedValue = '') {
        if (!officeType || !specialty) return;

        const officeTypeValue = officeType.value;

        if (!officeTypeValue) {
            specialty.innerHTML = '<option value="">اختر نوع المنشأة أولاً</option>';
            specialty.disabled = true;
            if (specialtyMessage) specialtyMessage.textContent = 'اختر نوع المنشأة أولاً لعرض التخصصات المتاحة.';
            hideManualSpecialty();
            selectedServices = {};
            if (servicesContainer) servicesContainer.style.display = 'none';
            syncHiddenInputs();
            return;
        }

        specialty.disabled = true;
        specialty.innerHTML = '<option value="">جاري تحميل التخصصات...</option>';
        if (specialtyMessage) specialtyMessage.textContent = 'جاري تحميل التخصصات...';

        try {
            const response = await fetch(specialtiesUrl + '?office_type=' + encodeURIComponent(officeTypeValue), {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (!response.ok) throw new Error('HTTP ' + response.status);

            const data = await response.json();

            specialty.innerHTML = '<option value="">اختر التخصص</option>';

            if (data.success && Array.isArray(data.specialties)) {
                loadedSpecialties = data.specialties;

                data.specialties.forEach(function (item) {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.textContent = item.name_ar;
                    if (String(item.id) === String(selectedValue)) {
                        option.selected = true;
                    }
                    specialty.appendChild(option);
                });

                // Add manual option
                const otherOption = document.createElement('option');
                otherOption.value = 'other';
                otherOption.textContent = 'تخصص آخر — سأكتبه يدويًا';
                if (String(selectedValue) === 'other') otherOption.selected = true;
                specialty.appendChild(otherOption);

                specialty.disabled = false;

                if (specialtyMessage) {
                    specialtyMessage.textContent = data.specialties.length
                        ? 'تم تحميل التخصصات المعتمدة لهذا النوع.'
                        : 'لا توجد تخصصات معتمدة حاليًا، يمكنك إضافة تخصص يدوي للمراجعة.';
                }

                handleSpecialtyChange();

            } else {
                specialty.innerHTML = '<option value="">اختر التخصص</option><option value="other">تخصص آخر — سأكتبه يدويًا</option>';
                specialty.disabled = false;
                specialty.value = 'other';
                showManualSpecialty();
                if (specialtyMessage) specialtyMessage.textContent = 'لا توجد تخصصات متاحة حاليًا. يمكنك كتابة التخصص يدويًا.';
            }

        } catch (error) {
            console.error('Specialties Error:', error);
            specialty.innerHTML = '<option value="">اختر التخصص</option><option value="other">تخصص آخر — سأكتبه يدويًا</option>';
            specialty.disabled = false;
            specialty.value = 'other';
            showManualSpecialty();
            if (specialtyMessage) specialtyMessage.textContent = 'تعذر تحميل التخصصات. يمكنك كتابة التخصص يدويًا.';
        }
    }

    /* =====================================================
       SERVICES UI (for single selected specialty)
    ===================================================== */

    function renderServicesUI() {
        if (!servicesContainer || !specialtyServicesCardsList) return;

        const selectedId = specialty ? specialty.value : '';

        // Find the selected specialty from loaded data
        const spec = loadedSpecialties.find(s => String(s.id) === String(selectedId));

        if (!spec || !Array.isArray(spec.services) || spec.services.length === 0) {
            if (customServices.length === 0) {
                servicesContainer.style.display = 'none';
            } else {
                servicesContainer.style.display = 'block';
            }
            specialtyServicesCardsList.innerHTML = '';
            renderGlobalCustomServicesList();
            return;
        }

        servicesContainer.style.display = 'block';
        specialtyServicesCardsList.innerHTML = '';

        const card = document.createElement('div');
        card.className = 'spec-services-card';

        const services = spec.services;
        const allSelected = services.every(s => selectedServices[s.name_ar] !== undefined);

        let servicesHtml = '';
        services.forEach((svc, sIdx) => {
            const isChecked = selectedServices[svc.name_ar] !== undefined;
            const safeKey = 'svc-' + spec.id + '-' + sIdx;

            servicesHtml += `
                <div class="service-checkbox-card ${isChecked ? 'checked' : ''}" onclick="toggleService('${spec.id}', '${encodeURIComponent(svc.name_ar)}', '${encodeURIComponent(svc.name_en || svc.name_ar)}')">
                    <input type="checkbox" id="${safeKey}" ${isChecked ? 'checked' : ''} onclick="event.stopPropagation(); toggleService('${spec.id}', '${encodeURIComponent(svc.name_ar)}', '${encodeURIComponent(svc.name_en || svc.name_ar)}')">
                    <div class="service-card-info">
                        <div class="service-card-name">${svc.name_ar}</div>
                    </div>
                </div>
            `;
        });

        card.innerHTML = `
            <div class="spec-card-header">
                <div class="spec-card-title">
                    <div class="spec-card-icon">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <span>خدمات تخصص: ${spec.name_ar}</span>
                </div>
                <div class="spec-card-actions">
                    <button type="button" class="btn-select-all-spec" onclick="toggleAllServices()">
                        <i class="fas ${allSelected ? 'fa-square-minus' : 'fa-check-double'}"></i>
                        <span>${allSelected ? 'إلغاء تحديد الكل' : 'تحديد الكل'}</span>
                    </button>
                </div>
            </div>
            <div class="services-grid-list">
                ${servicesHtml}
            </div>
        `;

        specialtyServicesCardsList.appendChild(card);
        renderGlobalCustomServicesList();
    }

    // Toggle individual service
    window.toggleService = function (specId, nameArEnc, nameEnEnc) {
        const nameAr = decodeURIComponent(nameArEnc);
        const nameEn = decodeURIComponent(nameEnEnc);

        if (selectedServices[nameAr]) {
            delete selectedServices[nameAr];
        } else {
            selectedServices[nameAr] = {
                name_ar: nameAr,
                name_en: nameEn
            };
        }

        renderServicesUI();
        syncHiddenInputs();
    };

    // Toggle all services
    window.toggleAllServices = function () {
        const selectedId = specialty ? specialty.value : '';
        const spec = loadedSpecialties.find(s => String(s.id) === String(selectedId));
        if (!spec || !Array.isArray(spec.services)) return;

        const allSelected = spec.services.every(s => selectedServices[s.name_ar] !== undefined);

        if (allSelected) {
            spec.services.forEach(s => delete selectedServices[s.name_ar]);
        } else {
            spec.services.forEach(s => {
                selectedServices[s.name_ar] = {
                    name_ar: s.name_ar,
                    name_en: s.name_en || s.name_ar
                };
            });
        }

        renderServicesUI();
        syncHiddenInputs();
    };

    /* =====================================================
       CUSTOM SERVICES (+)
    ===================================================== */

    window.toggleGlobalCustomForm = function () {
        const customForm = document.getElementById('global-custom-form');
        if (!customForm) return;
        if (customForm.style.display === 'none' || customForm.style.display === '') {
            customForm.style.display = 'block';
            const nameInput = document.getElementById('custom-svc-name');
            if (nameInput) nameInput.focus();
        } else {
            customForm.style.display = 'none';
        }
    };

    window.addGlobalCustomService = function () {
        const nameInput = document.getElementById('custom-svc-name');

        if (!nameInput || !nameInput.value.trim()) {
            alert('يرجى كتابة اسم الخدمة الخاصة.');
            if (nameInput) nameInput.focus();
            return;
        }

        customServices.push({
            id: 'custom_' + Date.now(),
            name_ar: nameInput.value.trim()
        });

        nameInput.value = '';

        renderGlobalCustomServicesList();
        syncHiddenInputs();

        // Show services container if hidden
        if (servicesContainer) servicesContainer.style.display = 'block';
    };

    window.removeCustomService = function (index) {
        customServices.splice(index, 1);
        renderGlobalCustomServicesList();
        syncHiddenInputs();

        // Hide container if nothing to show
        const selectedId = specialty ? specialty.value : '';
        const spec = loadedSpecialties.find(s => String(s.id) === String(selectedId));
        if ((!spec || !spec.services || spec.services.length === 0) && customServices.length === 0) {
            if (servicesContainer) servicesContainer.style.display = 'none';
        }
    };

    function renderGlobalCustomServicesList() {
        if (!globalCustomServicesList) return;
        globalCustomServicesList.innerHTML = '';

        if (customServices.length === 0) return;

        customServices.forEach((svc, index) => {
            const item = document.createElement('div');
            item.className = 'custom-service-row-item';
            item.innerHTML = `
                <div class="custom-row-info">
                    <span class="custom-row-badge"><i class="fas fa-star"></i> خدمة مخصصة</span>
                    <span class="custom-row-name">${svc.name_ar}</span>
                </div>
                <button type="button" class="btn-remove-custom-svc" onclick="removeCustomService(${index})" title="حذف الخدمة">
                    <i class="fas fa-trash-alt"></i>
                </button>
            `;
            globalCustomServicesList.appendChild(item);
        });
    }

    /* =====================================================
       SYNC HIDDEN INPUTS
    ===================================================== */

    function syncHiddenInputs() {
        if (!hiddenServicesContainer) return;
        hiddenServicesContainer.innerHTML = '';

        let svcIndex = 0;

        // Standard selected services
        Object.values(selectedServices).forEach(svc => {
            const inputName = document.createElement('input');
            inputName.type = 'hidden';
            inputName.name = `services[${svcIndex}][name_ar]`;
            inputName.value = svc.name_ar;
            hiddenServicesContainer.appendChild(inputName);

            const inputEn = document.createElement('input');
            inputEn.type = 'hidden';
            inputEn.name = `services[${svcIndex}][name_en]`;
            inputEn.value = svc.name_en;
            hiddenServicesContainer.appendChild(inputEn);

            svcIndex++;
        });

        // Custom services
        let customIndex = 0;
        customServices.forEach(svc => {
            const inputName = document.createElement('input');
            inputName.type = 'hidden';
            inputName.name = `custom_services[${customIndex}][name_ar]`;
            inputName.value = svc.name_ar;
            hiddenServicesContainer.appendChild(inputName);

            customIndex++;
        });
    }

    /* =====================================================
       EVENT LISTENERS
    ===================================================== */

    if (officeType) {
        officeType.addEventListener('change', function () {
            selectedServices = {};
            loadSpecialties();
        });
    }

    if (specialty) {
        specialty.addEventListener('change', function () {
            selectedServices = {};
            handleSpecialtyChange();
        });
    }

    /* =====================================================
       PASSWORD TOGGLE
    ===================================================== */

    document.querySelectorAll('.password-toggle').forEach(function (button) {
        button.addEventListener('click', function () {
            const targetId = this.dataset.target;
            const input = document.getElementById(targetId);
            if (!input) return;
            const icon = this.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                if (icon) icon.className = 'fas fa-eye-slash';
            } else {
                input.type = 'password';
                if (icon) icon.className = 'fas fa-eye';
            }
        });
    });

    /* =====================================================
       PASSWORD MATCH
    ===================================================== */

    const password = document.getElementById('password');
    const passwordConfirmation = document.getElementById('password_confirmation');

    function checkPasswordMatch() {
        if (!password || !passwordConfirmation) return true;
        if (!passwordConfirmation.value) {
            passwordConfirmation.classList.remove('is-invalid');
            return true;
        }
        const match = password.value === passwordConfirmation.value;
        if (!match) {
            passwordConfirmation.classList.add('is-invalid');
        } else {
            passwordConfirmation.classList.remove('is-invalid');
        }
        return match;
    }

    if (passwordConfirmation) {
        passwordConfirmation.addEventListener('input', checkPasswordMatch);
    }

    /* =====================================================
       TRADEMARK REQUIREMENT
    ===================================================== */

    function updateTrademarkRequirement() {
        if (!trademarkNumber || !trademarkCertificate) return;
        const numberEntered = trademarkNumber.value.trim().length > 0;
        if (numberEntered) {
            trademarkCertificate.required = true;
            if (trademarkRequiredStar) trademarkRequiredStar.style.display = 'inline';
            if (trademarkFileHint) trademarkFileHint.textContent = 'جميع أنواع الملفات مسموحة — إلزامية لأن رقم العلامة التجارية تم إدخاله';
        } else {
            trademarkCertificate.required = false;
            if (trademarkRequiredStar) trademarkRequiredStar.style.display = 'none';
            if (trademarkFileHint) trademarkFileHint.textContent = 'اختيارية — تصبح إلزامية إذا تم إدخال رقم العلامة التجارية';
        }
    }

    if (trademarkNumber) {
        trademarkNumber.addEventListener('input', updateTrademarkRequirement);
    }

    /* =====================================================
       FILE INPUTS
    ===================================================== */

    const fileInputs = [
        { id: 'commercial_register_image', label: 'السجل التجاري' },
        { id: 'license_image', label: 'ترخيص المزاولة المهنية' },
        { id: 'trademark_certificate', label: 'شهادة تسجيل العلامة التجارية' },
        { id: 'certificates', label: 'الشهادات العملية' },
        { id: 'appreciation_certificates', label: 'شهادات التقدير' },
        { id: 'cv', label: 'السيرة الذاتية' }
    ];

    fileInputs.forEach(function (config) {
        const input = document.getElementById(config.id);
        const nameBox = document.getElementById(config.id + '-name');
        if (!input || !nameBox) return;

        input.addEventListener('change', function () {
            const files = Array.from(this.files || []);
            nameBox.textContent = '';
            const label = document.getElementById(config.id + '-label');
            if (label) label.classList.remove('invalid');
            if (!files.length) return;
            if (files.length === 1) {
                nameBox.textContent = files[0].name;
            } else {
                nameBox.textContent = 'تم اختيار ' + files.length + ' ملفات';
            }
        });
    });

    /* =====================================================
       INITIAL LOAD
    ===================================================== */

    if (oldOfficeType) {
        officeType.value = oldOfficeType;
        loadSpecialties(oldSpecialty || '');
    }

    if (Array.isArray(oldCustomServices) && oldCustomServices.length > 0) {
        customServices = oldCustomServices.map((cs, idx) => ({
            id: 'custom_old_' + idx,
            name_ar: cs.name_ar || ''
        }));
        renderGlobalCustomServicesList();
    }

    updateTrademarkRequirement();

    /* =====================================================
       FORM SUBMIT
    ===================================================== */

    form.addEventListener('submit', function (event) {
        updateTrademarkRequirement();
        syncHiddenInputs();

        /* OFFICE TYPE */
        if (!officeType.value) {
            event.preventDefault();
            officeType.focus();
            alert('يرجى اختيار نوع المنشأة.');
            return;
        }

        /* SPECIALTY */
        if (!specialty.value) {
            event.preventDefault();
            specialty.focus();
            alert('يرجى اختيار التخصص.');
            return;
        }

        /* MANUAL SPECIALTY */
        if (specialty.value === 'other') {
            if (!manualInput.value.trim()) {
                event.preventDefault();
                showManualSpecialty();
                manualInput.focus();
                alert('يرجى كتابة التخصص اليدوي.');
                return;
            }
        }

        /* PASSWORD */
        if (!checkPasswordMatch()) {
            event.preventDefault();
            passwordConfirmation.focus();
            alert('كلمتا المرور غير متطابقتين.');
            return;
        }

        /* REQUIRED FILES */
        const requiredFileIds = ['commercial_register_image', 'license_image'];
        if (trademarkCertificate && trademarkCertificate.required) {
            requiredFileIds.push('trademark_certificate');
        }

        for (const fileId of requiredFileIds) {
            const input = document.getElementById(fileId);
            if (!input || !input.files || !input.files.length) {
                event.preventDefault();
                const label = document.querySelector('label[for="' + fileId + '"]');
                if (label) {
                    label.classList.add('invalid');
                    label.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
                const config = fileInputs.find(item => item.id === fileId);
                alert('يرجى إرفاق: ' + (config ? config.label : 'المرفق المطلوب'));
                return;
            }
        }

        /* SUBMIT */
        submitButton.disabled = true;
        submitButton.innerHTML = `
            <i class="fas fa-spinner fa-spin"></i>
            جاري إرسال الطلب...
        `;
    });

});

</script>


</body>

</html>