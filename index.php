<?php
/**
 * Ato Paper：一款侧重日常阅读的 Typecho 纸张风主题。
 *
 * @package Ato Paper
 * @author Ato & Codex
 * @version 0.1.7
 * @link https://atowo.work/
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');

$heroImage = ato_option($this->options, 'heroImage');
$moments = ato_now_items(ato_option($this->options, 'nowItems'));
$latestMoment = $moments[0] ?? [
    'dateLabel' => date('m.d'),
    'title' => '博客正在慢慢长大',
    'body' => '最近在整理这个小世界，也给未来想写的东西留出一些位置。',
];
$entryIndex = 0;
?>

<main class="blog-main wrap">
    <section class="hello" aria-labelledby="hello-title">
        <div class="hello-copy">
            <span class="little-mark">你好呀 👋</span>
            <h1 id="hello-title"><?php ato_e(ato_option($this->options, 'heroTitle', '这里是 Ato 的小世界。')); ?></h1>
            <p><?php ato_e(ato_option($this->options, 'heroIntro')); ?></p>
            <p class="hello-soft"><?php ato_e(ato_option($this->options, 'heroSoft')); ?></p>
        </div>
        <figure class="hello-postcard">
            <?php if ($heroImage !== ''): ?>
                <img src="<?php ato_e($heroImage); ?>" alt="首页插图">
            <?php else: ?>
                <img src="<?php $this->options->themeUrl('assets/images/hero.png'); ?>" alt="戴着耳机坐在桌前阅读手稿的插画">
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

            <?php if ($this->have()): ?>
                <?php while ($this->next()): $entryIndex++; $manualSnippet = trim((string) $this->fields->homeSnippet); ?>
                    <article class="post-entry<?php echo $entryIndex === 1 ? ' post-entry-first' : ''; ?>" itemscope itemtype="https://schema.org/BlogPosting">
                        <div class="post-entry-meta">
                            <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date('Y 年 m 月 d 日'); ?></time>
                            <span>·</span>
                            <span class="meta-category"><?php $this->category('、'); ?></span>
                        </div>
                        <h2 itemprop="headline"><a href="<?php $this->permalink(); ?>" itemprop="url"><?php $this->title(); ?></a></h2>
                        <div class="post-excerpt" itemprop="description"><?php $this->excerpt(120, '…'); ?></div>

                        <?php if ($entryIndex === 1): ?>
                            <a href="<?php $this->permalink(); ?>" class="diary-slip" aria-label="阅读：<?php $this->title(); ?>">
                                <span>今天的片段</span>
                                <blockquote><?php if ($manualSnippet !== ''): ?><?php ato_e($manualSnippet); ?><?php else: ?><?php $this->excerpt(62, '…'); ?><?php endif; ?></blockquote>
                                <b>继续读下去 →</b>
                            </a>
                        <?php endif; ?>
                    </article>
                <?php endwhile; ?>
            <?php else: ?>
                <article class="empty-paper"><h2>这里暂时还没有文章。</h2><p>等写下第一句话以后，再回来看看吧。</p></article>
            <?php endif; ?>

            <nav class="page-nav" aria-label="文章分页"><?php $this->pageNav('← 新一点', '旧一点 →', 2, '...'); ?></nav>
        </section>

        <aside class="blog-sidebar">
            <a class="now-note now-note-link" href="<?php ato_e(ato_site_url($this->options, ato_option($this->options, 'nowPageUrl', 'now.html'))); ?>" aria-label="查看最近在做的时间轴">
                <span class="tape" aria-hidden="true"></span>
                <small>最近在做</small>
                <p><?php ato_e($latestMoment['body']); ?></p>
                <span class="now-note-foot"><time>更新于 <?php ato_e($latestMoment['dateLabel']); ?></time><b>查看时间轴 →</b></span>
            </a>

            <section class="side-section" id="categories">
                <h2>随便逛逛</h2>
                <div class="category-list">
                    <?php \Widget\Metas\Category\Rows::alloc()->to($categories); ?>
                    <?php while ($categories->next()): ?>
                        <a href="<?php $categories->permalink(); ?>"><?php $categories->name(); ?><span><?php echo str_pad((string) $categories->count, 2, '0', STR_PAD_LEFT); ?></span></a>
                    <?php endwhile; ?>
                </div>
            </section>

            <section class="side-section side-about">
                <h2>关于 <?php $this->options->title(); ?></h2>
                <p><?php $this->options->description(); ?></p>
                <div class="side-links">
                    <?php if (ato_option($this->options, 'bilibiliUrl') !== ''): ?><a href="<?php ato_e(ato_option($this->options, 'bilibiliUrl')); ?>" target="_blank" rel="noreferrer">Bilibili</a><?php endif; ?>
                    <?php if (ato_option($this->options, 'githubUrl') !== ''): ?><a href="<?php ato_e(ato_option($this->options, 'githubUrl')); ?>" target="_blank" rel="noreferrer">GitHub</a><?php endif; ?>
                    <a href="<?php $this->options->feedUrl(); ?>">RSS</a>
                </div>
            </section>
        </aside>
    </div>
</main>

<?php $this->need('footer.php'); ?>
