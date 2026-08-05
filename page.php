<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<main class="reading-page wrap">
    <a href="<?php $this->options->siteUrl(); ?>" class="back-link">← 回到首页</a>
    <article class="diary-article page-article">
        <header class="diary-header">
            <span class="little-mark">PAGE · 小小一页</span>
            <h1><?php $this->title(); ?></h1>
        </header>
        <div class="diary-content"><?php $this->content(); ?></div>
    </article>
    <?php $this->need('comments.php'); ?>
</main>

<?php $this->need('footer.php'); ?>

