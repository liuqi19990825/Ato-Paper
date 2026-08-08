<?php
/**
 * Ato Paper：一款侧重日常阅读的 Typecho 纸张风主题。
 *
 * @package Ato Paper
 * @author Ato & Codex
 * @version 0.7.1
 * @link https://atowo.work/
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');

$heroImage = ato_option($this->options, 'heroImage');
$heroSoft = ato_option($this->options, 'heroSoft', '如果其中某一篇刚好让你停下来读了一会儿，那就很好。');
$heroSoftSource = ato_option($this->options, 'heroSoftSource', 'manual');
$aboutPageUrl = ato_site_url($this->options, ato_option($this->options, 'aboutPageUrl', 'about-me.html'));
$legacyMoments = ato_now_items(ato_option($this->options, 'nowItems'));
$murmurCategoryId = ato_murmur_category_id($this->options);
$latestMoment = ato_latest_murmur($this->options);
if ($latestMoment === null) {
    if ($murmurCategoryId > 0) {
        $latestMoment = [
            'dateLabel' => '',
            'title' => '等待第一条记录',
            'body' => '碎碎念还没有写下第一句话，等想起什么时再慢慢添上。',
            'statusLabel' => '等待第一条记录',
        ];
    } else {
        $latestMoment = $legacyMoments[0] ?? [
            'dateLabel' => date('m.d'),
            'title' => '博客正在慢慢长大',
            'body' => '最近在整理这个小世界，也给未来想写的东西留出一些位置。',
        ];
    }
}
$latestMomentStatus = isset($latestMoment['statusLabel'])
    ? $latestMoment['statusLabel']
    : '更新于 ' . $latestMoment['dateLabel'];
$isFilteredHome = $this->is('index') && $murmurCategoryId > 0;
$stream = $this;
$streamPageSize = max(1, (int) $this->options->postsListSize);
if ($isFilteredHome) {
    $stream = ato_murmur_posts(
        $murmurCategoryId,
        'exclude',
        $this->getCurrentPage(),
        $streamPageSize
    );
}
$entryIndex = 0;
?>

<main class="blog-main wrap" data-ato-pjax-main>
    <section class="hello" aria-labelledby="hello-title">
        <div class="hello-copy">
            <span class="little-mark">你好呀 👋</span>
            <h1 id="hello-title"><?php ato_e(ato_option($this->options, 'heroTitle', '这里是 Ato 的小世界。')); ?></h1>
            <p><?php ato_e(ato_option($this->options, 'heroIntro')); ?></p>
            <?php if ($heroSoftSource === 'hitokoto'): ?>
                <p class="hello-soft" data-hitokoto aria-live="polite">
                    <span data-hitokoto-text><?php ato_e($heroSoft); ?></span>
                    <small data-hitokoto-from hidden></small>
                </p>
            <?php else: ?>
                <p class="hello-soft"><?php ato_e($heroSoft); ?></p>
            <?php endif; ?>
        </div>
        <figure class="hello-postcard">
            <?php if ($heroImage !== ''): ?>
                <img src="<?php ato_e($heroImage); ?>" alt="首页插图" decoding="async">
            <?php else: ?>
                <img src="<?php $this->options->themeUrl('assets/images/hero.png'); ?>" width="1024" height="1536" alt="戴着耳机坐在桌前阅读手稿的插画" decoding="async" fetchpriority="high">
            <?php endif; ?>
            <figcaption><?php ato_e(ato_option($this->options, 'heroCaption', '想象中的书桌一角 · 2026 夏')); ?></figcaption>
        </figure>
    </section>

    <div class="home-layout">
        <section class="post-stream" id="posts" aria-labelledby="posts-title">
            <header class="stream-heading">
                <h2 id="posts-title"><?php echo $this->is('index') ? '最近写的' : '文章列表'; ?></h2>
                <span>随缘更新，慢慢记录</span>
            </header>

            <?php if ($stream->have()): ?>
                <?php while ($stream->next()): $entryIndex++; $manualSnippet = trim((string) $stream->fields->homeSnippet); ?>
                    <article class="post-entry<?php echo $entryIndex === 1 ? ' post-entry-first' : ''; ?>" itemscope itemtype="https://schema.org/BlogPosting">
                        <div class="post-entry-meta">
                            <time datetime="<?php $stream->date('c'); ?>" itemprop="datePublished"><?php $stream->date('Y 年 m 月 d 日'); ?></time>
                            <span>·</span>
                            <span class="meta-category"><?php $stream->category('、'); ?></span>
                        </div>
                        <h2 itemprop="headline"><a href="<?php $stream->permalink(); ?>" itemprop="url"><?php $stream->title(); ?></a></h2>
                        <div class="post-excerpt" itemprop="description"><?php $stream->excerpt(120, '…'); ?></div>

                        <?php if ($entryIndex === 1): ?>
                            <a href="<?php $stream->permalink(); ?>" class="diary-slip" aria-label="阅读：<?php $stream->title(); ?>">
                                <span>今天的片段</span>
                                <blockquote><?php if ($manualSnippet !== ''): ?><?php ato_e($manualSnippet); ?><?php else: ?><?php $stream->excerpt(62, '…'); ?><?php endif; ?></blockquote>
                                <b>继续读下去 →</b>
                            </a>
                        <?php endif; ?>
                    </article>
                <?php endwhile; ?>
            <?php else: ?>
                <article class="empty-paper"><h2>这里暂时还没有文章。</h2><p>等写下第一句话以后，再回来看看吧。</p></article>
            <?php endif; ?>

            <nav class="page-nav" aria-label="文章分页">
                <?php if ($isFilteredHome): ?>
                    <?php
                    $homePageTemplate = \Typecho\Router::url(
                        'index_page',
                        ['page' => '{page}'],
                        $this->options->index
                    );
                    ato_page_nav(
                        $stream->getTotalCount(),
                        $stream->getCurrentPageNumber(),
                        $stream->getPageSizeNumber(),
                        $homePageTemplate
                    );
                    ?>
                <?php else: ?>
                    <?php $this->pageNav('← 新一点', '旧一点 →', 2, '...'); ?>
                <?php endif; ?>
            </nav>
        </section>

        <aside class="blog-sidebar">
            <a class="now-note now-note-link" href="<?php ato_e(ato_site_url($this->options, ato_option($this->options, 'nowPageUrl', 'now.html'))); ?>" aria-label="查看碎碎念">
                <span class="tape" aria-hidden="true"></span>
                <small>最近在做</small>
                <p><?php ato_e($latestMoment['body']); ?></p>
                <span class="now-note-foot"><time><?php ato_e($latestMomentStatus); ?></time><b>查看碎碎念 →</b></span>
            </a>

            <section class="side-section" id="categories">
                <h2>随便逛逛</h2>
                <div class="category-list">
                    <?php \Widget\Metas\Category\Rows::alloc()->to($categories); ?>
                    <?php while ($categories->next()): ?>
                        <?php if ($murmurCategoryId > 0 && (int) $categories->mid === $murmurCategoryId) continue; ?>
                        <a href="<?php $categories->permalink(); ?>"><?php $categories->name(); ?><span><?php echo str_pad((string) $categories->count, 2, '0', STR_PAD_LEFT); ?></span></a>
                    <?php endwhile; ?>
                </div>
            </section>

            <section class="side-section side-about">
                <a class="side-about-main" href="<?php ato_e($aboutPageUrl); ?>" aria-label="前往关于页面">
                    <h2>关于 <?php $this->options->title(); ?><span aria-hidden="true">→</span></h2>
                    <p><?php $this->options->description(); ?></p>
                </a>
                <div class="side-links">
                    <?php if (ato_option($this->options, 'bilibiliUrl') !== ''): ?><a href="<?php ato_e(ato_option($this->options, 'bilibiliUrl')); ?>" target="_blank" rel="noreferrer">Bilibili</a><?php endif; ?>
                    <?php if (ato_option($this->options, 'githubUrl') !== ''): ?><a href="<?php ato_e(ato_option($this->options, 'githubUrl')); ?>" target="_blank" rel="noreferrer">GitHub</a><?php endif; ?>
                    <a href="<?php $this->options->feedUrl(); ?>">RSS</a>
                    <a href="<?php $this->options->adminUrl(); ?>" data-no-pjax>进入后台</a>
                </div>
            </section>
        </aside>
    </div>
</main>

<?php $this->need('footer.php'); ?>
