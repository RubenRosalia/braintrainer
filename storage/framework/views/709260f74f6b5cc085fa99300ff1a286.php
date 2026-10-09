<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'Braintrainer'); ?></title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            background: oklch(0.97 0.006 95);
            color: oklch(0.24 0.02 80);
            font-family: 'Space Grotesk', Helvetica, Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
        }
        a { color: inherit; text-decoration: none; }
        .mono { font-family: 'IBM Plex Mono', monospace; }
        .wrap { display: flex; flex-direction: column; align-items: center; padding: 0 20px 64px; }
        .page { width: 100%; max-width: 1040px; }

        /* header */
        .hdr { width: 100%; max-width: 1040px; display: flex; align-items: center; justify-content: space-between; padding: 22px 0 34px; gap: 16px; }
        .logo { display: flex; align-items: center; gap: 10px; cursor: pointer; }
        .logo-mark { width: 30px; height: 30px; border-radius: 9px; background: oklch(0.24 0.02 80); color: oklch(0.97 0.006 95); display: flex; align-items: center; justify-content: center; font-family: 'IBM Plex Mono', monospace; font-size: 15px; font-weight: 600; }
        .logo-name { font-size: 17px; font-weight: 700; letter-spacing: -0.01em; }
        .nav { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; justify-content: flex-end; }
        .nav-link { padding: 8px 14px; border-radius: 999px; font-size: 14px; font-weight: 500; cursor: pointer; color: oklch(0.45 0.02 80); white-space: nowrap; transition: background .15s, color .15s; }
        .nav-link:hover { background: oklch(0.93 0.01 90); color: oklch(0.24 0.02 80); }
        .nav-badge { padding: 8px 14px; border-radius: 999px; font-size: 13px; font-weight: 500; font-family: 'IBM Plex Mono', monospace; color: oklch(0.62 0.02 80); border: 1px solid oklch(0.9 0.01 90); white-space: nowrap; }

        /* cards */
        .card { border: 1px solid oklch(0.9 0.01 90); background: #fff; border-radius: 20px; transition: transform .16s ease, box-shadow .16s ease; }
        .card-hover:hover { transform: translateY(-3px); box-shadow: 0 14px 30px oklch(0.24 0.02 80 / 0.09); }

        .btn { padding: 15px 34px; border-radius: 14px; background: oklch(0.55 0.14 250); color: #fff; font-size: 16px; font-weight: 600; cursor: pointer; border: none; font-family: inherit; display: inline-block; }
        .btn:hover { background: oklch(0.47 0.14 250); }
        .btn-dark { background: oklch(0.24 0.02 80); }
        .btn-dark:hover { background: oklch(0.16 0.02 80); }
        .btn-ghost { background: transparent; border: 1px solid oklch(0.88 0.01 90); color: oklch(0.4 0.02 80); }
        .btn-ghost:hover { background: oklch(0.95 0.01 90); }
        .btn-orange { background: oklch(0.58 0.16 35); }

        .back { display: inline-flex; align-items: center; gap: 8px; font-size: 14px; color: oklch(0.5 0.02 80); cursor: pointer; margin-bottom: 18px; }
        .back:hover { color: oklch(0.24 0.02 80); }

        input { font-family: inherit; }
        @keyframes bpulse { 0%,100% { opacity: 1; } 50% { opacity: .3; } }
    </style>
    <?php echo $__env->yieldPushContent('head'); ?>
</head>
<body>
    <div class="wrap">
        <div class="hdr">
            <a href="/" class="logo">
                <div class="logo-mark">B</div>
                <div class="logo-name">Braintrainer</div>
            </a>
            <div class="nav">
                <a href="/mind" class="nav-link">Mind</a>
                <a href="/body" class="nav-link">Body</a>
            </div>
        </div>

        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /var/www/html/resources/views/layouts/baseline.blade.php ENDPATH**/ ?>