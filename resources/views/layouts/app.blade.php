<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'BE-opdracht 07' }}</title>
    <style>
        :root {
            --bg: #f7f3ea;
            --panel: #fffdf9;
            --ink: #1a1a1a;
            --soft-ink: #555;
            --line: #d9d1c6;
            --accent: #17456f;
            --accent-2: #b43a2f;
            --ok: #0e7a3f;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Georgia, 'Times New Roman', serif;
            color: var(--ink);
            background:
                radial-gradient(circle at 85% 10%, rgba(180, 58, 47, 0.12), transparent 35%),
                radial-gradient(circle at 0% 100%, rgba(23, 69, 111, 0.12), transparent 40%),
                var(--bg);
            min-height: 100vh;
        }

        .shell {
            max-width: 1200px;
            margin: 0 auto;
            padding: 24px;
            animation: fade-in .3s ease-out;
        }

        .topnav {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 16px;
        }

        .topnav a {
            text-decoration: none;
            color: var(--accent);
            border: 1px solid var(--line);
            background: #fff;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 14px;
        }

        .panel {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 10px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
            padding: 20px;
            overflow-x: auto;
        }

        h1 {
            margin: 0 0 6px;
            font-size: clamp(24px, 3vw, 34px);
            color: var(--accent);
        }

        .subtitle {
            margin: 0 0 18px;
            color: var(--soft-ink);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 720px;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border: 1px solid var(--line);
            border-radius: 8px;
            background: #fff;
        }

        th, td {
            border: 1px solid var(--line);
            padding: 10px;
            text-align: left;
            vertical-align: middle;
            font-size: 14px;
        }

        th {
            background: #f2ebe0;
        }

        .actions a,
        .actions button,
        .btn {
            display: inline-block;
            border: 1px solid var(--accent);
            color: white;
            background: var(--accent);
            padding: 7px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
            cursor: pointer;
        }

        .btn.secondary {
            background: white;
            color: var(--accent);
        }

        .row {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 6px;
            flex: 1 1 270px;
        }

        input, select {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 6px;
            padding: 9px;
            font-size: 14px;
            background: #fff;
        }

        .radio-group {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            font-size: 14px;
        }

        .notice {
            border: 1px solid #bde2cc;
            background: #e9f9f0;
            color: var(--ok);
            border-radius: 6px;
            padding: 10px;
            margin-bottom: 14px;
        }

        .errors {
            border: 1px solid #f0b4aa;
            background: #fde9e5;
            color: #8c2d20;
            border-radius: 6px;
            padding: 10px;
            margin-bottom: 14px;
        }

        .pagination {
            margin-top: 16px;
        }

        .pager {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .pager-meta {
            margin: 0;
            color: var(--soft-ink);
            font-size: 14px;
        }

        .pager-list {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            align-items: center;
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .pager-list a,
        .pager-list span {
            border: 1px solid var(--line);
            background: #fff;
            color: var(--ink);
            text-decoration: none;
            padding: 6px 10px;
            border-radius: 4px;
            font-size: 13px;
            display: inline-block;
        }

        .pager-list .is-active {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
        }

        .pager-list .is-disabled {
            color: #8e8e8e;
            background: #f6f6f6;
        }

        @keyframes fade-in {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .shell { padding: 14px; }
            .panel { padding: 14px; }
            .topnav a { flex: 1 1 100%; text-align: center; }
            table { min-width: 620px; }
            th, td { padding: 8px; font-size: 13px; }
            .row { gap: 10px; }
            .field { flex: 1 1 100%; }
            .btn, .actions a, .actions button { width: 100%; text-align: center; margin-bottom: 6px; }
            .pager-list a, .pager-list span { padding: 8px 10px; }
        }
    </style>
</head>
<body>
<div class="shell">
    <nav class="topnav">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('instructeurs.index') }}">Instructeurs in dienst</a>
        <a href="{{ route('allergenen.index') }}">Overzicht allergenen</a>
    </nav>

    <main class="panel" id="main-panel">
        @yield('content')
    </main>
</div>

<script>
    document.addEventListener('click', function (event) {
        const link = event.target.closest('a[href*="page="]');
        if (!link) {
            return;
        }

        const panel = document.getElementById('main-panel');
        if (panel) {
            panel.style.opacity = '0.45';
            panel.style.transition = 'opacity .18s ease';
        }
    });
</script>
</body>
</html>
