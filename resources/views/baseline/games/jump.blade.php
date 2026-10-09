@extends('layouts.baseline')
@section('title', 'Jump — Baseline')

@section('content')
<div class="page" style="max-width:860px">
    <a href="/body" class="back">&larr; Body Exercises</a>

    {{-- ===== setup ===== --}}
    <div id="jr-setup" class="card" style="padding:30px">
        <div style="font-size:22px;font-weight:700;letter-spacing:-0.01em;margin-bottom:6px">Jump</div>
        <div style="font-size:15px;color:oklch(0.5 0.02 80);margin-bottom:24px">Move in front of your camera — every burst of movement counts as a jump.</div>

        <div class="mono" style="font-size:11px;letter-spacing:0.16em;text-transform:uppercase;color:oklch(0.6 0.02 80);margin-bottom:10px">Players</div>
        <div style="display:flex;gap:10px;margin-bottom:24px">
            <button class="jr-opt jr-players selected" data-val="solo">Solo</button>
            <button class="jr-opt jr-players" data-val="multi" disabled style="opacity:.45;cursor:not-allowed">Multiplayer <span class="mono" style="font-size:10px">soon</span></button>
        </div>

        <div class="mono" style="font-size:11px;letter-spacing:0.16em;text-transform:uppercase;color:oklch(0.6 0.02 80);margin-bottom:10px">Mode</div>
        <div style="display:flex;gap:10px;margin-bottom:24px">
            <button class="jr-opt jr-mode selected" data-val="free">Free</button>
            <button class="jr-opt jr-mode" data-val="time">Time</button>
        </div>

        <div id="jr-dur-row" style="display:none">
            <div class="mono" style="font-size:11px;letter-spacing:0.16em;text-transform:uppercase;color:oklch(0.6 0.02 80);margin-bottom:10px">Duration</div>
            <div style="display:flex;gap:10px;margin-bottom:24px">
                <button class="jr-opt jr-dur selected" data-val="30">30s</button>
                <button class="jr-opt jr-dur" data-val="60">60s</button>
                <button class="jr-opt jr-dur" data-val="90">90s</button>
            </div>
        </div>

        <button id="jr-begin" class="btn btn-orange" style="width:100%;padding:16px">Continue</button>
    </div>

    {{-- ===== game ===== --}}
    <div id="jr-game" style="display:none">
        <div class="card" style="padding:28px;min-height:470px;display:flex;flex-direction:column">
            <div style="display:flex;align-items:center;justify-content:space-between;gap:16px;padding-bottom:18px;border-bottom:1px solid oklch(0.93 0.01 90)">
                <div style="font-size:20px;font-weight:700;letter-spacing:-0.01em">Jump</div>
                <div style="display:flex;gap:18px;align-items:center">
                    <div id="jr-clock" class="mono" style="display:none;font-size:15px;font-weight:600;color:oklch(0.5 0.16 30)">0:30</div>
                    <div id="jr-meta" class="mono" style="font-size:12px;color:oklch(0.62 0.02 80)">best 0</div>
                </div>
            </div>

            <div style="display:flex;gap:22px;flex:1;min-height:0">
                {{-- stickman --}}
                <div style="position:relative;flex:1;display:flex;flex-direction:column;align-items:center;justify-content:flex-end;padding-bottom:18px">
                    <div style="display:flex;flex-direction:column;align-items:center;gap:2px;padding:14px 0 4px">
                        <div class="mono" style="font-size:11px;letter-spacing:0.18em;text-transform:uppercase;color:oklch(0.68 0.02 80)">Jumps</div>
                        <div id="jr-count" class="mono" style="font-size:54px;font-weight:600;line-height:1;color:oklch(0.24 0.02 80)">0</div>
                    </div>
                    <div style="position:relative;width:200px;height:260px;margin-top:auto">
                        <div style="position:absolute;left:0;right:0;bottom:20px;height:2px;background:oklch(0.85 0.01 90)"></div>
                        <div id="jr-shadow" style="position:absolute;left:50%;bottom:14px;width:70px;height:12px;margin-left:-35px;border-radius:50%;background:oklch(0.88 0.01 90)"></div>
                        <svg id="jr-man" width="90" height="150" viewBox="0 0 90 150" style="position:absolute;left:50%;bottom:24px;margin-left:-45px;transform:translateY(0)">
                            <g stroke="oklch(0.24 0.02 80)" stroke-width="5" stroke-linecap="round" fill="none">
                                <circle cx="45" cy="22" r="14" fill="oklch(0.24 0.02 80)" stroke="none"/>
                                <line x1="45" y1="36" x2="45" y2="95"/>
                                <line id="jr-armL" x1="45" y1="52" x2="20" y2="70"/>
                                <line id="jr-armR" x1="45" y1="52" x2="70" y2="70"/>
                                <line id="jr-legL" x1="45" y1="95" x2="30" y2="128"/>
                                <line id="jr-legR" x1="45" y1="95" x2="60" y2="128"/>
                            </g>
                        </svg>
                    </div>
                </div>

                {{-- camera runs for detection but is hidden from view --}}
                <video id="jr-video" autoplay playsinline muted style="display:none"></video>
                <div id="jr-cam-status" class="mono" style="display:none"></div>
            </div>

            <div style="text-align:center;min-height:50px">
                <div id="jr-over" style="display:none;flex-direction:column;align-items:center;gap:12px">
                    <div id="jr-over-text" style="font-size:16px;font-weight:600;color:oklch(0.4 0.14 150)"></div>
                    <div style="display:flex;gap:10px">
                        <button id="jr-again" class="btn btn-orange" style="font-size:15px;padding:12px 26px">Go again</button>
                        <button id="jr-change" class="btn btn-ghost" style="font-size:15px;padding:12px 26px">Change mode</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- hidden canvases used only for reading pixels --}}
    <canvas id="jr-cur" width="64" height="48" style="display:none"></canvas>
    <canvas id="jr-prev" width="64" height="48" style="display:none"></canvas>
</div>

<style>
    .jr-opt { padding:12px 18px; border-radius:12px; border:1.5px solid oklch(0.88 0.01 90); background:#fff; font-family:inherit; font-size:14px; font-weight:500; cursor:pointer; color:oklch(0.4 0.02 80); }
    .jr-opt.selected { border-color:oklch(0.58 0.16 35); background:oklch(0.97 0.03 40); color:oklch(0.4 0.14 35); }
    .jr-opt:disabled { pointer-events:none; }
</style>
@endsection

@push('scripts')
<script>
(function () {
    const el = id => document.getElementById(id);
    const KEY = 'baseline.best.jump';
    let best = parseInt(localStorage.getItem(KEY) || '0', 10);

    const cfg = { mode: 'free', dur: 30 };
    function wireGroup(cls, key, cast) {
        document.querySelectorAll('.' + cls).forEach(btn => btn.addEventListener('click', function () {
            if (btn.disabled) return;
            document.querySelectorAll('.' + cls).forEach(b => b.classList.remove('selected'));
            btn.classList.add('selected');
            cfg[key] = cast ? cast(btn.dataset.val) : btn.dataset.val;
            if (key === 'mode') el('jr-dur-row').style.display = (cfg.mode === 'time') ? 'block' : 'none';
        }));
    }
    wireGroup('jr-mode', 'mode');
    wireGroup('jr-dur', 'dur', v => parseInt(v, 10));
    el('jr-begin').addEventListener('click', startGameScreen);

    // ---------- stickman ----------
    const HOP_DUR = 420;
    let phase = 'idle', count = 0, jumpStart = null, deadline = 0, raf = null;

    function draw(ts) {
        const prog = jumpStart === null ? 2 : (ts - jumpStart) / HOP_DUR;
        const lift = (prog >= 0 && prog <= 1) ? Math.sin(Math.PI * prog) : 0;
        el('jr-man').style.transform = 'translateY(' + (-110 * lift).toFixed(1) + 'px)';
        el('jr-shadow').style.transform = 'scale(' + (1 - 0.4 * lift).toFixed(2) + ')';
        el('jr-legL').setAttribute('y2', (128 - 14 * lift).toFixed(0));
        el('jr-legR').setAttribute('y2', (128 - 14 * lift).toFixed(0));
        el('jr-armL').setAttribute('y2', (70 - 24 * lift).toFixed(0));
        el('jr-armR').setAttribute('y2', (70 - 24 * lift).toFixed(0));
        el('jr-count').textContent = count;
        el('jr-meta').textContent = 'best ' + best;
        if (cfg.mode === 'time' && phase === 'play') {
            const left = Math.max(0, Math.ceil((deadline - performance.now()) / 1000));
            el('jr-clock').textContent = Math.floor(left/60)+':'+String(left%60).padStart(2,'0');
        }
    }

    function hop() {
        if (phase === 'idle' || phase === 'over') { startRun(); count = 1; jumpStart = performance.now(); return; }
        const now = performance.now();
        if (jumpStart === null || now - jumpStart > HOP_DUR * 0.6) { jumpStart = now; count += 1; }
    }

    function startRun() {
        count = 0; jumpStart = null; phase = 'play'; el('jr-over').style.display = 'none';
        if (cfg.mode === 'time') { deadline = performance.now() + cfg.dur * 1000; el('jr-clock').style.display = 'block'; }
        else el('jr-clock').style.display = 'none';
    }

    function tickGame(ts) {
        if (cfg.mode === 'time' && phase === 'play' && performance.now() >= deadline) {
            if (count > best) { best = count; localStorage.setItem(KEY, String(best)); }
            phase = 'over';
            el('jr-over-text').textContent = 'Time! ' + count + ' jumps in ' + cfg.dur + 's.';
            el('jr-over').style.display = 'flex';
        }
        draw(ts);
    }

    el('jr-again').addEventListener('click', function () { startRun(); });
    el('jr-change').addEventListener('click', function () { stopCam(); el('jr-game').style.display='none'; el('jr-setup').style.display='block'; });

    // ---------- SIMPLE MOTION DETECTION ----------
    // Idea: shrink the webcam to a tiny 64x48 picture. Every frame, compare it
    // to the previous frame pixel-by-pixel. Add up how much changed. Big change
    // = you moved a lot = a jump.
    let video, curCtx, prevCtx, camOn = false, cooldownUntil = 0;

    async function startCam() {
        video = el('jr-video');
        curCtx  = el('jr-cur').getContext('2d', { willReadFrequently: true });
        prevCtx = el('jr-prev').getContext('2d', { willReadFrequently: true });
        try {
            const stream = await navigator.mediaDevices.getUserMedia({ video: { width: 320, height: 240 }, audio: false });
            video.srcObject = stream;
            await video.play();
            el('jr-cam-status').textContent = 'move to jump!';
            camOn = true;
            requestAnimationFrame(frame);
        } catch (e) {
            // camera denied — show it in the game area since the preview is hidden
            el('jr-over').style.display = 'flex';
            el('jr-over-text').textContent = 'Camera blocked — allow it and reload the page.';
        }
    }

    function frame(ts) {
        if (!camOn) return;

        // 1. draw the current webcam image, shrunk to 64x48, onto the hidden canvas
        curCtx.drawImage(video, 0, 0, 64, 48);
        const cur  = curCtx.getImageData(0, 0, 64, 48).data;   // pixel colors, now
        const prev = prevCtx.getImageData(0, 0, 64, 48).data;  // pixel colors, last frame

        // 2. add up how different the two frames are
        let diff = 0;
        for (let i = 0; i < cur.length; i += 4) {           // step 4 = r,g,b,a per pixel
            const dr = Math.abs(cur[i]   - prev[i]);
            const dg = Math.abs(cur[i+1] - prev[i+1]);
            const db = Math.abs(cur[i+2] - prev[i+2]);
            if (dr + dg + db > 60) diff++;                  // this pixel changed a lot
        }
        const movePct = (diff / (64 * 48)) * 100;           // % of pixels that changed

        // 3. save current frame as "previous" for next time
        prevCtx.drawImage(video, 0, 0, 64, 48);

        // 4. max sensitivity: the slightest movement counts as a jump
        const threshold = 18;  // % of picture that must change — needs a real jump, not a twitch
        if (movePct > threshold && ts > cooldownUntil) {
            cooldownUntil = ts + 350;   // wait 350ms before counting the next jump
            hop();
        }

        tickGame(ts);
        requestAnimationFrame(frame);
    }

    function stopCam() {
        camOn = false;
        if (video && video.srcObject) { video.srcObject.getTracks().forEach(t => t.stop()); video.srcObject = null; }
    }

    function startGameScreen() {
        el('jr-setup').style.display = 'none';
        el('jr-game').style.display = 'block';
        phase = 'idle'; count = 0; jumpStart = null;
        el('jr-over').style.display = 'none';
        el('jr-clock').style.display = 'none';
        draw(performance.now());
        startCam();
    }
})();
</script>
@endpush
