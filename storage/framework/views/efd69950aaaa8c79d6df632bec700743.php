<?php $__env->startSection('title', 'Sequence Memory — Braintrainer'); ?>

<?php $__env->startSection('content'); ?>
<div class="page" style="max-width:760px">
    <a href="/mind" class="back">&larr; Mind Exercises</a>

    <div class="card" style="padding:34px;min-height:430px;display:flex;flex-direction:column">
        <div style="display:flex;align-items:center;justify-content:space-between;gap:16px;padding-bottom:20px;border-bottom:1px solid oklch(0.93 0.01 90)">
            <div style="font-size:20px;font-weight:700;letter-spacing:-0.01em">Sequence Memory</div>
            <div id="sq-meta" class="mono" style="font-size:12px;color:oklch(0.62 0.02 80)">level 0 &middot; best 0</div>
        </div>

        <div style="flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:28px;padding:30px 0;text-align:center">

            
            <div id="sq-grid" style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;width:300px;height:300px">
                
            </div>

            <div id="sq-msg" style="font-size:16px;line-height:1.5;color:oklch(0.5 0.02 80);max-width:380px">Watch the pattern, then repeat it. Each round adds one tile.</div>

            <div id="sq-actions" style="display:flex;gap:10px">
                <button id="sq-start" class="btn">Start</button>
            </div>

            <div id="sq-over" style="display:none;flex-direction:column;align-items:center;gap:8px">
                <div class="mono" style="font-size:12px;letter-spacing:0.16em;text-transform:uppercase;color:oklch(0.62 0.02 80)">You reached</div>
                <div id="sq-score" style="font-size:74px;font-weight:700;letter-spacing:-0.04em;line-height:1">0</div>
                <div style="display:flex;gap:10px;margin-top:12px">
                    <button id="sq-again" class="btn">Try again</button>
                    <a href="/mind" class="btn btn-ghost">Back to Exercises</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .sq-tile {
        border-radius: 16px;
        background: oklch(0.95 0.015 250);
        border: 1.5px solid oklch(0.9 0.01 250);
        cursor: pointer;
        transition: background .12s ease, transform .12s ease;
    }
    .sq-tile.lit   { background: oklch(0.65 0.16 250); border-color: oklch(0.55 0.16 250); }
    .sq-tile.press { transform: scale(0.95); }
    .sq-tile.wrong { background: oklch(0.65 0.18 25); border-color: oklch(0.55 0.18 25); }
    /* while the computer is showing the pattern, tiles aren't clickable */
    #sq-grid.locked .sq-tile { cursor: default; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
(function () {
    const el = id => document.getElementById(id);
    const KEY = 'braintrainer.best.sequence';
    let best = parseInt(localStorage.getItem(KEY) || '0', 10);

    const grid = el('sq-grid');
    const TILES = 9;
    const tiles = [];

    // build the 9 tiles
    for (let i = 0; i < TILES; i++) {
        const t = document.createElement('div');
        t.className = 'sq-tile';
        t.dataset.i = i;
        t.addEventListener('click', () => onTileClick(i));
        grid.appendChild(t);
        tiles.push(t);
    }

    let sequence = [];     // the pattern, e.g. [4, 1, 7]
    let inputPos = 0;      // how many the player has correctly repeated this round
    let accepting = false; // true only when it's the player's turn

    function meta() { el('sq-meta').textContent = 'level ' + sequence.length + ' · best ' + best; }

    function flash(i, cls, ms) {
        return new Promise(resolve => {
            tiles[i].classList.add(cls);
            setTimeout(() => { tiles[i].classList.remove(cls); resolve(); }, ms);
        });
    }

    function wait(ms) { return new Promise(r => setTimeout(r, ms)); }

    // play the whole sequence back to the player
    async function showSequence() {
        accepting = false;
        grid.classList.add('locked');
        el('sq-msg').textContent = 'Watch…';
        await wait(500);
        // speed up a little as the sequence grows
        const onMs = Math.max(260, 600 - sequence.length * 20);
        for (const i of sequence) {
            await flash(i, 'lit', onMs);
            await wait(180);
        }
        grid.classList.remove('locked');
        accepting = true;
        inputPos = 0;
        el('sq-msg').textContent = 'Your turn — repeat it.';
    }

    function nextRound() {
        sequence.push(Math.floor(Math.random() * TILES));
        meta();
        showSequence();
    }

    function onTileClick(i) {
        if (!accepting) return;
        // quick press feedback
        tiles[i].classList.add('press');
        setTimeout(() => tiles[i].classList.remove('press'), 120);

        if (i === sequence[inputPos]) {
            // correct so far
            flash(i, 'lit', 160);
            inputPos++;
            if (inputPos === sequence.length) {
                // finished the whole sequence this round -> next, longer one
                accepting = false;
                setTimeout(nextRound, 650);
            }
        } else {
            // wrong -> game over
            accepting = false;
            flash(i, 'wrong', 500);
            gameOver();
        }
    }

    function gameOver() {
        const score = sequence.length - 1 > 0 ? sequence.length - 1 : 0;
        if (score > best) { best = score; localStorage.setItem(KEY, String(best)); }
        meta();
        el('sq-score').textContent = score;
        el('sq-actions').style.display = 'none';
        el('sq-msg').style.display = 'none';
        el('sq-over').style.display = 'flex';
    }

    function startGame() {
        sequence = [];
        el('sq-over').style.display = 'none';
        el('sq-actions').style.display = 'none';
        el('sq-msg').style.display = 'block';
        meta();
        nextRound();
    }

    el('sq-start').addEventListener('click', startGame);
    el('sq-again').addEventListener('click', startGame);
    meta();
})();
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.baseline', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/baseline/games/sequence.blade.php ENDPATH**/ ?>