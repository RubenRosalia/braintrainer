<?php $__env->startSection('title', $title . ' — Braintrainer'); ?>

<?php $__env->startSection('content'); ?>
<div class="page">
    <a href="/" class="back">&larr; All categories</a>
    <div style="display:flex;align-items:flex-end;justify-content:space-between;gap:20px;flex-wrap:wrap;margin-bottom:26px">
        <div>
            <h2 style="font-size:38px;font-weight:700;letter-spacing:-0.025em;margin:0 0 8px"><?php echo e($title); ?></h2>
            <div style="font-size:15px;color:oklch(0.5 0.02 80)"><?php echo e($blurb); ?></div>
        </div>
        <div class="mono" style="font-size:12px;color:oklch(0.62 0.02 80)"><?php echo e(count($games)); ?> Exercises</div>
    </div>

    
    <div style="display:flex;gap:10px;margin-bottom:22px">
        <div class="mode-pill selected">Solo</div>
        <div class="mode-pill" style="opacity:.45;cursor:not-allowed" title="Coming soon">Multiplayer <span class="mono" style="font-size:10px">soon</span></div>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(232px,1fr));gap:14px">
        <?php $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $playable = $g['playable'] ?? false; ?>

            <?php if($playable): ?>
                
                <a href="/games/<?php echo e($g['id']); ?>" class="card card-hover" style="position:relative;padding:22px 20px 18px;cursor:pointer;display:flex;flex-direction:column;align-items:center;text-align:center;gap:12px;min-height:212px">
                    <div class="mono" style="position:absolute;top:12px;right:12px;font-size:10px;letter-spacing:0.1em;text-transform:uppercase;padding:4px 8px;border-radius:999px;background:oklch(0.93 0.05 150);color:oklch(0.42 0.13 155)">Playable</div>
                    <div class="mono" style="width:58px;height:58px;margin-top:10px;border-radius:16px;background:oklch(0.95 0.02 250);color:oklch(0.48 0.13 250);display:flex;align-items:center;justify-content:center;font-size:19px;font-weight:600"><?php echo e($g['mark']); ?></div>
                    <div style="font-size:18px;font-weight:700;letter-spacing:-0.01em"><?php echo e($g['name']); ?></div>
                    <div style="font-size:13.5px;line-height:1.45;color:oklch(0.52 0.02 80)"><?php echo e($g['desc']); ?></div>
                    <div class="mono" style="margin-top:auto;font-size:11.5px;color:oklch(0.64 0.02 80)">playable</div>
                </a>
            <?php else: ?>
                
                <div class="card" style="position:relative;padding:22px 20px 18px;cursor:not-allowed;opacity:.5;display:flex;flex-direction:column;align-items:center;text-align:center;gap:12px;min-height:212px" title="Coming soon">
                    <div class="mono" style="position:absolute;top:12px;right:12px;font-size:10px;letter-spacing:0.1em;text-transform:uppercase;padding:4px 8px;border-radius:999px;background:oklch(0.94 0.008 90);color:oklch(0.6 0.02 80)">Soon</div>
                    <div class="mono" style="width:58px;height:58px;margin-top:10px;border-radius:16px;background:oklch(0.93 0.01 90);color:oklch(0.55 0.02 80);display:flex;align-items:center;justify-content:center;font-size:19px;font-weight:600"><?php echo e($g['mark']); ?></div>
                    <div style="font-size:18px;font-weight:700;letter-spacing:-0.01em"><?php echo e($g['name']); ?></div>
                    <div style="font-size:13.5px;line-height:1.45;color:oklch(0.52 0.02 80)"><?php echo e($g['desc']); ?></div>
                    <div class="mono" style="margin-top:auto;font-size:11.5px;color:oklch(0.64 0.02 80)">coming soon</div>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<style>
    .mode-pill { padding:9px 18px; border-radius:999px; border:1.5px solid oklch(0.88 0.01 90); background:#fff; font-size:14px; font-weight:500; color:oklch(0.45 0.02 80); }
    .mode-pill.selected { border-color:oklch(0.55 0.14 250); background:oklch(0.97 0.03 250); color:oklch(0.4 0.14 250); }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.baseline', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/baseline/list.blade.php ENDPATH**/ ?>