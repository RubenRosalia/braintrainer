<?php $__env->startSection('title', 'Number Memory — Braintrainer'); ?>

<?php $__env->startSection('content'); ?>
<div class="page" style="max-width:760px">
    <a href="/mind" class="back">&larr; Mind Exercises</a>

    <div class="card" style="padding:34px;min-height:430px;display:flex;flex-direction:column">
        <div style="display:flex;align-items:center;justify-content:space-between;gap:16px;padding-bottom:20px;border-bottom:1px solid oklch(0.93 0.01 90)">
            <div style="font-size:20px;font-weight:700;letter-spacing:-0.01em">Number Memory</div>
            <div id="nm-meta" class="mono" style="font-size:12px;color:oklch(0.62 0.02 80)">digits 1 &middot; best &mdash;</div>
        </div>

        <div style="flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:24px;padding:36px 0 10px;text-align:center">

            <div id="nm-ready">
                <div style="display:flex;flex-direction:column;align-items:center;gap:22px">
                    <div class="mono" style="width:78px;height:78px;border-radius:22px;background:oklch(0.95 0.02 250);color:oklch(0.48 0.13 250);display:flex;align-items:center;justify-content:center;font-size:24px;font-weight:600">123</div>
                    <div style="max-width:380px;font-size:16px;line-height:1.55;color:oklch(0.5 0.02 80)">A number flashes on screen. Type it back exactly. Every correct answer adds one digit.</div>
                    <button id="nm-start" class="btn">Start</button>
                </div>
            </div>

            <div id="nm-showing" style="display:none;width:100%;flex-direction:column;align-items:center;gap:30px">
                <div id="nm-number" class="mono" style="font-size:64px;font-weight:600;letter-spacing:0.06em"></div>
                <div style="width:min(420px,100%);height:6px;border-radius:999px;background:oklch(0.93 0.01 90);overflow:hidden">
                    <div id="nm-bar" style="height:100%;background:oklch(0.55 0.14 250);width:100%"></div>
                </div>
            </div>

            <div id="nm-input" style="display:none;flex-direction:column;align-items:center;gap:20px">
                <div style="font-size:17px;color:oklch(0.5 0.02 80)">What was the number?</div>
                <input id="nm-answer" inputmode="numeric" style="width:min(420px,80vw);padding:16px 18px;border-radius:14px;border:1.5px solid oklch(0.86 0.02 250);font-family:'IBM Plex Mono',monospace;font-size:30px;text-align:center;letter-spacing:0.08em;outline:none;color:oklch(0.24 0.02 80)">
                <button id="nm-submit" class="btn btn-dark" style="font-size:15px;padding:13px 30px">Submit</button>
            </div>

            <div id="nm-over" style="display:none;flex-direction:column;align-items:center;gap:8px;width:100%">
                <div class="mono" style="font-size:12px;letter-spacing:0.16em;text-transform:uppercase;color:oklch(0.62 0.02 80)">Digit span</div>
                <div id="nm-score" style="font-size:74px;font-weight:700;letter-spacing:-0.04em;line-height:1">0</div>
                <div class="mono" style="display:flex;gap:26px;margin:18px 0 6px;font-size:14px">
                    <div style="color:oklch(0.5 0.02 80)">number <span id="nm-was" style="color:oklch(0.24 0.02 80)"></span></div>
                    <div style="color:oklch(0.5 0.02 80)">you typed <span id="nm-typed" style="color:oklch(0.55 0.16 25)"></span></div>
                </div>
                <div style="display:flex;gap:10px;margin-top:10px">
                    <button id="nm-again" class="btn" style="font-size:15px;padding:13px 28px">Try again</button>
                    <a href="/mind" class="btn btn-ghost" style="font-size:15px;padding:13px 28px">Back to Exercises</a>
                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
(function () {
    const KEY = 'baseline.best.number';
    let best = parseInt(localStorage.getItem(KEY) || '0', 10);

    const el = id => document.getElementById(id);
    const panes = { ready: el('nm-ready'), showing: el('nm-showing'), input: el('nm-input'), over: el('nm-over') };

    let level = 1, num = '', showTimer = null, barTimer = null;

    function meta() { el('nm-meta').textContent = 'digits ' + level + ' · best ' + (best ? best : '—'); }
    function show(which) {
        for (const k in panes) panes[k].style.display = (k === which) ? 'flex' : 'none';
        if (which === 'ready') panes.ready.style.display = 'block';
    }

    function flash(lvl) {
        level = lvl; meta();
        num = '';
        for (let i = 0; i < lvl; i++) num += String(i === 0 ? 1 + Math.floor(Math.random()*9) : Math.floor(Math.random()*10));
        const showMs = 700 + lvl * 900;
        el('nm-number').textContent = num;
        el('nm-bar').style.width = '100%';
        show('showing');

        const startAt = Date.now();
        clearInterval(barTimer); clearTimeout(showTimer);
        barTimer = setInterval(function () {
            const pct = Math.max(0, 100 - ((Date.now() - startAt) / showMs) * 100);
            el('nm-bar').style.width = pct.toFixed(1) + '%';
        }, 50);
        showTimer = setTimeout(function () {
            clearInterval(barTimer);
            el('nm-answer').value = '';
            show('input');
            el('nm-answer').focus();
        }, showMs);
    }

    function submit() {
        const typed = (el('nm-answer').value || '').trim();
        if (typed === num) { flash(level + 1); return; }
        const score = level - 1 > 0 ? level - 1 : 0;
        if (score > best) { best = score; localStorage.setItem(KEY, String(best)); }
        meta();
        el('nm-score').textContent = score;
        el('nm-was').textContent = num;
        el('nm-typed').textContent = typed || '—';
        show('over');
    }

    el('nm-start').addEventListener('click', () => flash(1));
    el('nm-again').addEventListener('click', () => flash(1));
    el('nm-submit').addEventListener('click', submit);
    el('nm-answer').addEventListener('input', function (e) { e.target.value = e.target.value.replace(/[^0-9]/g, ''); });
    el('nm-answer').addEventListener('keydown', function (e) { if (e.key === 'Enter') submit(); });

    meta();
})();
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.baseline', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/baseline/games/number.blade.php ENDPATH**/ ?>