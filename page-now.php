<?php
/**
 * 碎碎念
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

$murmurCategoryId = ato_murmur_category_id($this->options);
$murmurPageSize = ato_murmur_page_size($this->options);
$murmurCurrentPage = max(1, (int) $this->request->filter('int')->get('murmur_page', 1));
$murmurPosts = null;
$latestMurmur = null;
if ($murmurCategoryId > 0) {
    $murmurPosts = ato_murmur_posts(
        $murmurCategoryId,
        'include',
        $murmurCurrentPage,
        $murmurPageSize
    );
    $latestMurmur = ato_latest_murmur($this->options);
}

$legacyMoments = ato_now_items(ato_option($this->options, 'nowItems'));
$lastUpdated = $latestMurmur['date'] ?? ($legacyMoments[0]['date'] ?? date('Y-m-d'));
$pageIntro = trim((string) $this->content);
$this->need('header.php');
?>

<main class="now-page wrap" data-ato-pjax-main>
    <a href="<?php $this->options->siteUrl(); ?>" class="back-link">← 回到首页</a>

    <header class="now-page-header">
        <span class="little-mark">MURMURS · 没写成文章的小事</span>
        <h1><?php $this->title(); ?></h1>
        <div class="now-page-intro">
            <?php if ($pageIntro !== ''): ?>
                <?php echo $pageIntro; ?>
            <?php else: ?>
                <p>一些还不够写成文章，却想顺手记下来的事情。没有严格的更新频率，想起什么，就往这里放一张小纸条。</p>
            <?php endif; ?>
        </div>
        <div class="now-status"><i aria-hidden="true"></i>最后更新于 <?php ato_e($lastUpdated); ?></div>
    </header>

    <section class="moment-timeline" aria-label="碎碎念列表">
        <?php if ($murmurCategoryId > 0 && $murmurPosts && $murmurPosts->have()): ?>
            <?php while ($murmurPosts->next()): ?>
                <article class="moment-entry murmur-entry<?php echo $murmurPosts->getCurrentPageNumber() === 1 && $murmurPosts->sequence === 1 ? ' is-current' : ''; ?>">
                    <time class="moment-date" datetime="<?php $murmurPosts->date('c'); ?>">
                        <strong><?php $murmurPosts->date('m.d'); ?></strong><span><?php $murmurPosts->date('Y'); ?></span>
                    </time>
                    <span class="moment-dot" aria-hidden="true"></span>
                    <div class="moment-paper">
                        <span class="moment-tag">碎碎念</span>
                        <h2><a href="<?php $murmurPosts->permalink(); ?>"><?php $murmurPosts->title(); ?></a></h2>
                        <div class="moment-body"><?php $murmurPosts->content(); ?></div>
                        <footer class="moment-foot">
                            <a href="<?php $murmurPosts->permalink(); ?>">单独打开这张纸条 →</a>
                            <a href="<?php $murmurPosts->permalink(); ?>#comments"><?php $murmurPosts->commentsNum('还没有回应', '1 条回应', '%d 条回应'); ?></a>
                        </footer>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php elseif ($murmurCategoryId > 0): ?>
            <article class="empty-paper">
                <h2>这里还没有碎碎念。</h2>
                <p>在 Typecho 后台新建文章并放入已选择的“碎碎念分类”，发布后便会自动出现在这里。</p>
            </article>
        <?php elseif (!empty($legacyMoments)): ?>
            <?php foreach ($legacyMoments as $index => $moment): ?>
                <article class="moment-entry<?php echo $index === 0 ? ' is-current' : ''; ?>">
                    <time class="moment-date" datetime="<?php ato_e($moment['date']); ?>">
                        <strong><?php ato_e($moment['dateLabel']); ?></strong><span><?php ato_e($moment['year']); ?></span>
                    </time>
                    <span class="moment-dot" aria-hidden="true"></span>
                    <div class="moment-paper">
                        <span class="moment-tag"><?php ato_e($moment['tag']); ?></span>
                        <h2><?php ato_e($moment['title']); ?></h2>
                        <p><?php ato_e($moment['body']); ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <article class="empty-paper">
                <h2>这里还没有碎碎念。</h2>
                <p>先在主题设置中选择一个“碎碎念分类”，再像平常写文章一样发布第一条记录吧。</p>
            </article>
        <?php endif; ?>
    </section>

    <?php if ($murmurCategoryId > 0 && $murmurPosts): ?>
        <nav class="page-nav murmur-page-nav" aria-label="碎碎念分页">
            <?php
            ato_page_nav(
                $murmurPosts->getTotalCount(),
                $murmurPosts->getCurrentPageNumber(),
                $murmurPosts->getPageSizeNumber(),
                ato_query_page_template($this->permalink, 'murmur_page')
            );
            ?>
        </nav>
    <?php endif; ?>

    <p class="timeline-ending">翻到底了。下次想起什么，再来添一张纸条。<span>✦</span></p>
</main>

<?php $this->need('footer.php'); ?>
