@extends('layouts.baseline')
@section('title', 'Reaction Time — Braintrainer')

@section('content')
<div class="page" style="max-width:760px">
    <a href="/mind" class="back">&larr; Mind Exercises</a>

    <div id="rt-panel" style="border:1px solid oklch(0.9 0.01 90);border-radius:22px;padding:34px;min-height:430px;display:flex;flex-direction:column;cursor:pointer;user-select:none;background:#fff">
        <div style="display:flex;align-items:center;justify-content:space-between;gap:16px;padding-bottom:20px;border-bottom:1px solid oklch(0.93 0.01 90)">
            <div id="rt-ink-title" style="font-size:20px;font-weight:700;letter-spacing:-0.01em">Reaction Time</div>
            <div id="rt-meta" class="mono" style="font-size:12px;color:oklch(0.62 0.02 80)">trial 1/5 &middot; best &mdash;</div>
        </div>
        <div style="flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:16px;text-align:center">
            <div id="rt-big" class="mono" style="font-size:34px;font-weight:700;letter-spacing:-0.03em;line-height:1">Ready?</div>
            <div id="rt-hint" style="font-size:16px;line-height:1.5;max-width:400px;opacity:.75">Click anywhere in this panel to start. Five trials, then an average.</div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
    const panel = document.getElementById('rt-panel');
    const big   = document.getElementById('rt-big');
    const hint  = document.getElementById('rt-hint');
    const meta  = document.getElementById('rt-meta');
    const title = document.getElementById('rt-ink-title');

    const KEY = 'baseline.best.reaction';
    let best = parseInt(localStorage.getItem(KEY) || '0', 10);

    let phase = 'idle';   // idle | wait | go | result | early
    let trials = [];
    let goAt = 0;
    let timer = null;

    const bgMap = { idle:'#fff', wait:'oklch(0.96 0.01 90)', go:'oklch(0.88 0.13 150)', result:'#fff', early:'oklch(0.94 0.04 30)' };

    function bestLabel() { return best ? best + ' ms' : '—'; }

    function render() {
        panel.style.background = bgMap[phase] || '#fff';
        const ink = phase === 'go' ? 'oklch(0.22 0.06 150)' : 'oklch(0.24 0.02 80)';
        title.style.color = ink; big.style.color = ink; hint.style.color = ink;
        const trialNum = Math.min(5, trials.length + (phase === 'result' ? 0 : 1));
        meta.textContent = 'trial ' + trialNum + '/5 · best ' + bestLabel();

        if (phase === 'idle')  { big.textContent = 'Ready?'; big.style.fontSize = '34px'; hint.textContent = 'Click anywhere in this panel to start. Five trials, then an average.'; }
        if (phase === 'wait')  { big.textContent = 'Wait…';  big.style.fontSize = '34px'; hint.textContent = 'Green means go.'; }
        if (phase === 'go')    { big.textContent = 'Now!';   big.style.fontSize = '64px'; hint.textContent = 'Click.'; }
        if (phase === 'early') { big.textContent = 'Too soon'; big.style.fontSize = '34px'; hint.textContent = 'Click to try that trial again.'; }
        if (phase === 'result') {
            big.style.fontSize = '64px';
            if (trials.length >= 5) {
                const avg = Math.round(trials.reduce((a,b)=>a+b,0)/trials.length);
                big.textContent = avg + ' ms';
                hint.textContent = 'Average over five trials: ' + trials.join(' · ') + ' ms. Click to run a new set.';
            } else {
                big.textContent = trials[trials.length-1] + ' ms';
                hint.textContent = 'Trial ' + trials.length + ' of 5. Click for the next one.';
            }
        }
    }

    function arm() {
        if (trials.length >= 5) trials = [];
        phase = 'wait'; render();
        clearTimeout(timer);
        timer = setTimeout(function () { phase = 'go'; goAt = performance.now(); render(); }, 1100 + Math.random() * 2600);
    }

    function tap() {
        if (phase === 'idle' || phase === 'early') return arm();
        if (phase === 'result') {
            if (trials.length >= 5) { trials = []; phase = 'idle'; render(); return; }
            return arm();
        }
        if (phase === 'wait') { clearTimeout(timer); phase = 'early'; render(); return; }
        if (phase === 'go') {
            const ms = Math.round(performance.now() - goAt);
            trials.push(ms);
            if (trials.length >= 5) {
                const avg = Math.round(trials.reduce((a,b)=>a+b,0)/trials.length);
                if (best === 0 || avg < best) { best = avg; localStorage.setItem(KEY, String(best)); }
            }
            phase = 'result'; render();
        }
    }

    panel.addEventListener('click', tap);
    window.addEventListener('keydown', function (e) {
        if (e.code === 'Space' || e.key === ' ') { e.preventDefault(); tap(); }
    });
    render();
})();
</script>
@endpush
