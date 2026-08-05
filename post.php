<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$showToc = trim((string) $this->fields->showToc) === '1';
$dropCap = trim((string) $this->fields->dropCap) === '1';
$this->need('header.php');
?>

<main class="reading-page wrap<?php echo $showToc ? ' has-toc' : ''; ?>" data-ato-pjax-main>
    <div class="reading-column">
        <a href="<?php $this->options->siteUrl(); ?>" class="back-link">← 回到首页</a>

        <article class="diary-article" itemscope itemtype="https://schema.org/BlogPosting">
            <header class="diary-header">
                <div class="diary-meta">
                    <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date('Y 年 m 月 d 日'); ?></time>
                    <span>·</span>
                    <span><?php $this->category('、'); ?></span>
                </div>
                <h1 itemprop="headline"><?php $this->title(); ?></h1>
                <?php if (trim((string) $this->fields->subtitle) !== ''): ?><p><?php ato_e($this->fields->subtitle); ?></p><?php endif; ?>
            </header>

            <?php if (trim((string) $this->fields->cover) !== ''): ?>
                <figure class="diary-photo">
                    <img src="<?php ato_e($this->fields->cover); ?>" alt="<?php $this->title(); ?>的题图">
                    <?php if (trim((string) $this->fields->coverCaption) !== ''): ?><figcaption><?php ato_e($this->fields->coverCaption); ?></figcaption><?php endif; ?>
                </figure>
            <?php endif; ?>

            <div class="diary-content<?php echo $dropCap ? ' has-drop-cap' : ''; ?>" itemprop="articleBody"><?php $this->content(); ?></div>

            <footer class="diary-footer">
                <div class="tags"><span>标签：</span><?php $this->tags('', true, '<span>暂时没有标签</span>'); ?></div>
                <button type="button" class="like-button" data-like data-post-id="<?php echo (int) $this->cid; ?>">♡ 喜欢这篇文章</button>
            </footer>
        </article>

        <nav class="simple-next" aria-label="文章导航">
            <div><small>上一篇</small><span><?php $this->thePrev('%s', '没有更早的文章了'); ?></span></div>
            <div class="next-link"><small>下一篇</small><span><?php $this->theNext('%s', '没有更新的文章了'); ?></span></div>
        </nav>

        <?php $this->need('comments.php'); ?>
    </div>

    <?php if ($showToc): ?>
        <aside class="article-toc" data-article-toc aria-label="文章章节目录">
            <div class="article-toc-inner">
                <span>本页目录</span>
                <nav data-article-toc-list></nav>
            </div>
        </aside>
    <?php endif; ?>
</main>

<?php $this->need('footer.php'); ?>
