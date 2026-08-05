<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<main class="not-found wrap" data-ato-pjax-main>
    <span class="little-mark">404 · 这一页走丢了</span>
    <h1>纸上什么也没有。</h1>
    <p>也许它被移动了，也许只是暂时藏了起来。</p>
    <a href="<?php $this->options->siteUrl(); ?>">回到 Ato 的小世界 →</a>
</main>

<?php $this->need('footer.php'); ?>
