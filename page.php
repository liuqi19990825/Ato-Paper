<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$showToc = trim((string) $this->fields->showToc) === '1';
$dropCap = trim((string) $this->fields->dropCap) === '1';
$this->need('header.php');
?>

<main class="reading-page wrap<?php echo $showToc ? ' has-toc' : ''; ?>" data-ato-pjax-main>
    <div class="reading-column">
        <a href="<?php $this->options->siteUrl(); ?>" class="back-link">← 回到首页</a>
        <article class="diary-article page-article">
            <header class="diary-header">
                <span class="little-mark">PAGE · 小小一页</span>
                <h1><?php $this->title(); ?></h1>
            </header>
            <div class="diary-content<?php echo $dropCap ? ' has-drop-cap' : ''; ?>"><?php $this->content(); ?></div>
        </article>
        <?php $this->need('comments.php'); ?>
    </div>

    <?php if ($showToc): ?>
        <aside class="article-toc" data-article-toc aria-label="页面章节目录">
            <div class="article-toc-inner">
                <span>本页目录</span>
                <nav data-article-toc-list></nav>
            </div>
        </aside>
    <?php endif; ?>
</main>

<?php $this->need('footer.php'); ?>
