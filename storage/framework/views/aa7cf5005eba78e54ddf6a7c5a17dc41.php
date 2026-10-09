<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'Posts'); ?></title>
</head>
<body>
    <nav style="padding:10px; border-bottom:1px solid #ccc;">
        <a href="/">Home</a> |
        <a href="/posts">Posts</a>
    </nav>

    <main style="padding:20px;">
        <?php echo $__env->yieldContent('content'); ?>
    </main>
</body>
</html>
<?php /**PATH /var/www/html/resources/views/layouts/posts.blade.php ENDPATH**/ ?>