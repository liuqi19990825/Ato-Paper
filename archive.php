<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<main class="archive-page wrap" data-ato-pjax-main>
    <a href="<?php $this->options->siteUrl(); ?>" class="back-link">← 回到首页</a>
    <header class="archive-header">
        <span class="little-mark">ARCHIVE · 慢慢翻阅</span>
        <h1><?php $this->archiveTitle([
            'category' => _t('分类：%s'),
            'search' => _t('搜索：%s'),
            'tag' => _t('标签：%s'),
            'author' => _t('%s 写下的文章')
        ], '', ''); ?></h1>
        <p>把散落在不同时间里的文字，重新放回同一张桌面。</p>
    </header>

    <section class="archive-list" aria-label="文章列表">
        <?php if ($this->have()): ?>
            <?php while ($this->next()): ?>
                <article class="post-entry">
                    <div class="post-entry-meta">
                        <time datetime="<?php $this->date('c'); ?>"><?php $this->date('Y 年 m 月 d 日'); ?></time><span>·</span><span class="meta-category"><?php $this->category('、'); ?></span>
                    </div>
                    <h2><a href="<?php $this->permalink(); ?>"><?php $this->title(); ?></a></h2>
                    <div class="post-excerpt"><?php $this->excerpt(130, '…'); ?></div>
                </article>
            <?php endwhile; ?>
        <?php else: ?>
            <article class="empty-paper"><h2>没有找到对应的内容。</h2><p>换一个关键词，或者回首页随便看看吧。</p></article>
        <?php endif; ?>
    </section>

    <nav class="page-nav" aria-label="文章分页"><?php $this->pageNav('← 新一点', '旧一点 →', 2, '...'); ?></nav>
</main>

<?php $this->need('footer.php'); ?>
