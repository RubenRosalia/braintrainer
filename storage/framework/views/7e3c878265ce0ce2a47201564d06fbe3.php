<?php $__env->startSection('title', 'All Posts'); ?>

<?php $__env->startSection('content'); ?>
    <h1>All Posts</h1>
    <a href="/posts/create">+ New Post</a>
    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <div>
            
            <h2><a href="/posts/<?php echo e($post->id); ?>"><?php echo e($post->title); ?></a></h2>
            <p>By: <?php echo e($post->author->name ?? 'Unknown'); ?></p>
            
            <a href="/posts/<?php echo e($post->id); ?>/edit">Edit</a>

            
            <form action="/posts/<?php echo e($post->id); ?>" method="POST" style="display:inline">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" onclick="return confirm('Delete this post?')">Delete</button>
            </form>

        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.posts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/posts/index.blade.php ENDPATH**/ ?>