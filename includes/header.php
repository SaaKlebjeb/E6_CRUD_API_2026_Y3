<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --navy:   #0d1b2a;
            --navy2:  #1b2d42;
            --gold:   #e8a020;
            --gold2:  #f5c452;
            --cream:  #f7f4ef;
            --muted:  #8a95a3;
            --card-bg:#ffffff;
            --border: #e3e8ee;
            --success:#1da66e;
            --danger: #e04b4b;
            --radius: 14px;
            --shadow: 0 4px 24px rgba(13,27,42,.10);
            --shadow-lg: 0 8px 40px rgba(13,27,42,.16);
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--navy);
            min-height: 100vh;
            margin: 0;
        }

        /* ── TOP NAV ── */
        .sms-navbar {
            background: var(--navy);
            padding: 0 2rem;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 16px rgba(0,0,0,.25);
        }
        .sms-navbar .brand {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.25rem;
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: .6rem;
            letter-spacing: -.01em;
        }
        .sms-navbar .brand span {
            display: inline-block;
            background: var(--gold);
            color: var(--navy);
            border-radius: 6px;
            padding: 2px 8px;
            font-size: .78rem;
            font-weight: 700;
            letter-spacing: .04em;
            text-transform: uppercase;
        }
        .sms-navbar .nav-links a {
            color: rgba(255,255,255,.65);
            text-decoration: none;
            font-size: .9rem;
            margin-left: 1.5rem;
            transition: color .2s;
        }
        .sms-navbar .nav-links a:hover { color: var(--gold); }

        /* ── PAGE WRAPPER ── */
        .page-wrap {
            max-width: 1100px;
            margin: 0 auto;
            padding: 2.5rem 1.5rem 4rem;
        }

        /* ── STAT STRIP ── */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .page-header h1 {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: clamp(1.4rem, 3vw, 2rem);
            margin: 0;
            color: var(--navy);
        }
        .page-header h1 small {
            display: block;
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
            font-size: .85rem;
            color: var(--muted);
            margin-top: 2px;
        }

        /* ── CARDS ── */
        .sms-card {
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            overflow: hidden;
        }
        .sms-card .card-head {
            background: var(--navy);
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            gap: .75rem;
        }
        .sms-card .card-head h5 {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            color: #fff;
            margin: 0;
        }
        .sms-card .card-head .bi {
            color: var(--gold);
            font-size: 1.1rem;
        }
        .sms-card .card-body-pad { padding: 1.75rem; }

        /* ── TOOLBAR ── */
        .toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border);
            background: #fff;
        }

        /* ── SEARCH BOX ── */
        .search-wrap {
            position: relative;
            flex: 1;
            max-width: 380px;
        }
        .search-wrap .bi-search {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: .95rem;
            pointer-events: none;
        }
        .search-wrap input {
            width: 100%;
            padding: .55rem 2.8rem .55rem 2.6rem;
            border: 1.5px solid var(--border);
            border-radius: 50px;
            font-family: 'DM Sans', sans-serif;
            font-size: .9rem;
            background: var(--cream);
            color: var(--navy);
            transition: border .2s, box-shadow .2s;
            outline: none;
        }
        .search-wrap input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(232,160,32,.15);
            background: #fff;
        }
        .search-wrap input::placeholder { color: var(--muted); }
        .search-wrap .btn-search {
            position: absolute;
            right: 6px;
            top: 50%;
            transform: translateY(-50%);
            background: var(--gold);
            color: var(--navy);
            border: none;
            border-radius: 50px;
            padding: .3rem .85rem;
            font-size: .8rem;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s;
        }
        .search-wrap .btn-search:hover { background: var(--gold2); }

        /* ── BUTTONS ── */
        .btn-sms-primary {
            background: var(--navy);
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: .55rem 1.4rem;
            font-family: 'DM Sans', sans-serif;
            font-size: .88rem;
            font-weight: 500;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            text-decoration: none;
            transition: background .2s, transform .15s;
        }
        .btn-sms-primary:hover { background: var(--navy2); color: var(--gold); transform: translateY(-1px); }

        .btn-sms-success {
            background: var(--success);
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: .6rem 1.6rem;
            font-family: 'DM Sans', sans-serif;
            font-size: .9rem;
            font-weight: 500;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            text-decoration: none;
            transition: background .2s, transform .15s;
        }
        .btn-sms-success:hover { background: #179960; color: #fff; transform: translateY(-1px); }

        .btn-sms-secondary {
            background: transparent;
            color: var(--muted);
            border: 1.5px solid var(--border);
            border-radius: 50px;
            padding: .58rem 1.4rem;
            font-family: 'DM Sans', sans-serif;
            font-size: .88rem;
            font-weight: 500;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            text-decoration: none;
            transition: border .2s, color .2s;
        }
        .btn-sms-secondary:hover { border-color: var(--navy); color: var(--navy); }

        /* ── TABLE ── */
        .sms-table-wrap { overflow-x: auto; }
        .sms-table {
            width: 100%;
            border-collapse: collapse;
            font-size: .88rem;
        }
        .sms-table thead tr {
            background: var(--navy);
        }
        .sms-table thead th {
            color: rgba(255,255,255,.7);
            font-family: 'Syne', sans-serif;
            font-weight: 600;
            font-size: .78rem;
            letter-spacing: .07em;
            text-transform: uppercase;
            padding: .85rem 1.2rem;
            white-space: nowrap;
            border: none;
        }
        .sms-table thead th:first-child { color: var(--gold); }
        .sms-table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background .15s;
        }
        .sms-table tbody tr:last-child { border-bottom: none; }
        .sms-table tbody tr:hover { background: #f0f4f8; }
        .sms-table tbody td {
            padding: .85rem 1.2rem;
            color: var(--navy);
            vertical-align: middle;
        }
        .sms-table .id-cell {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            color: var(--muted);
            font-size: .8rem;
        }
        .sms-table .name-cell { font-weight: 500; }
        .sms-table .course-badge {
            display: inline-block;
            background: rgba(13,27,42,.07);
            color: var(--navy2);
            border-radius: 50px;
            padding: 2px 10px;
            font-size: .8rem;
            font-weight: 500;
        }
        .action-wrap { display: flex; gap: .5rem; flex-wrap: wrap; }
        .btn-edit {
            background: rgba(232,160,32,.15);
            color: #b37800;
            border: 1px solid rgba(232,160,32,.3);
            border-radius: 50px;
            padding: .3rem .85rem;
            font-size: .8rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: .3rem;
            transition: background .2s;
        }
        .btn-edit:hover { background: rgba(232,160,32,.3); color: #7a5200; }
        .btn-delete {
            background: rgba(224,75,75,.1);
            color: var(--danger);
            border: 1px solid rgba(224,75,75,.25);
            border-radius: 50px;
            padding: .3rem .85rem;
            font-size: .8rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: .3rem;
            transition: background .2s;
        }
        .btn-delete:hover { background: rgba(224,75,75,.2); }

        /* ── EMPTY STATE ── */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--muted);
        }
        .empty-state .bi { font-size: 3rem; display: block; margin-bottom: 1rem; opacity: .4; }
        .empty-state p { margin: 0; font-size: .95rem; }

        /* ── FORM PAGE ── */
        .form-page-wrap {
            max-width: 560px;
            margin: 0 auto;
        }
        .sms-form-label {
            font-size: .82rem;
            font-weight: 600;
            letter-spacing: .04em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: .4rem;
            display: block;
        }
        .sms-input {
            width: 100%;
            padding: .65rem 1rem;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: .95rem;
            color: var(--navy);
            background: var(--cream);
            transition: border .2s, box-shadow .2s;
            outline: none;
        }
        .sms-input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(232,160,32,.15);
            background: #fff;
        }
        .sms-input::placeholder { color: var(--muted); }
        .form-field { margin-bottom: 1.25rem; }
        .form-footer {
            display: flex;
            gap: .75rem;
            padding-top: .5rem;
            flex-wrap: wrap;
        }

        /* ── ALERT ── */
        .sms-alert {
            background: rgba(224,75,75,.08);
            border: 1px solid rgba(224,75,75,.25);
            color: var(--danger);
            border-radius: 10px;
            padding: .75rem 1rem;
            font-size: .9rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        /* ── SEARCH RESULT BADGE ── */
        .search-result-info {
            padding: .6rem 1.5rem;
            background: rgba(232,160,32,.08);
            border-bottom: 1px solid rgba(232,160,32,.2);
            font-size: .85rem;
            color: #8a6200;
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .search-result-info a {
            color: var(--navy);
            font-weight: 600;
            text-decoration: none;
            margin-left: auto;
        }
        .search-result-info a:hover { color: var(--gold); }

        /* ── RESPONSIVE ── */
        @media (max-width: 600px) {
            .sms-navbar { padding: 0 1rem; }
            .sms-navbar .nav-links { display: none; }
            .page-wrap { padding: 1.5rem 1rem 3rem; }
            .toolbar { flex-direction: column; align-items: stretch; }
            .search-wrap { max-width: 100%; }
            .sms-table thead th,
            .sms-table tbody td { padding: .7rem .85rem; }
        }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .sms-card { animation: fadeUp .35s ease both; }
        .sms-table tbody tr {
            animation: fadeUp .25s ease both;
        }
        .sms-table tbody tr:nth-child(1) { animation-delay: .04s; }
        .sms-table tbody tr:nth-child(2) { animation-delay: .08s; }
        .sms-table tbody tr:nth-child(3) { animation-delay: .12s; }
        .sms-table tbody tr:nth-child(4) { animation-delay: .16s; }
        .sms-table tbody tr:nth-child(5) { animation-delay: .20s; }
    </style>
</head>
<body>

<nav class="sms-navbar">
    <a href="index.php" class="brand">
        <i class="bi bi-mortarboard-fill"></i>
        StudentMS <span>Portal</span>
    </a>
    <div class="nav-links">
        <a href="index.php"><i class="bi bi-house me-1"></i>Dashboard</a>
        <a href="create.php"><i class="bi bi-person-plus me-1"></i>Add Student</a>
    </div>
</nav>

<div class="page-wrap">