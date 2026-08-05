<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<main class="not-found wrap" data-ato-pjax-main>
    <section class="lost-paper" aria-labelledby="lost-title">
        <span class="lost-tape" aria-hidden="true"></span>
        <span class="lost-number" aria-hidden="true">404</span>

        <div class="lost-copy">
            <span class="little-mark">ERROR 404 · 这一页走丢了</span>
            <h1 id="lost-title">纸上什么也没有。</h1>
            <p>也许它被移动了，也许只是暂时藏了起来。没关系，我们可以换一条路继续逛。</p>

            <form class="lost-search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
                <label class="sr-only" for="lost-search-input">搜索文章</label>
                <input id="lost-search-input" name="s" type="search" placeholder="试着搜索一个关键词……" autocomplete="off">
                <button type="submit">在小世界里找找</button>
            </form>

            <div class="lost-actions">
                <a class="lost-home" href="<?php $this->options->siteUrl(); ?>">回到首页</a>
                <a href="<?php $this->options->siteUrl(); ?>#posts">看看最近写的 <span aria-hidden="true">→</span></a>
            </div>
        </div>

        <div class="lost-doodle" aria-hidden="true">
            <i></i><i></i><i></i><span>?</span>
        </div>
    </section>
</main>

<?php $this->need('footer.php'); ?>
