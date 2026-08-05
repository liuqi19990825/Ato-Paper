<?php
/**
 * 近况时间轴
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$moments = ato_now_items(ato_option($this->options, 'nowItems'));
$lastUpdated = $moments[0]['date'] ?? date('Y-m-d');
$this->need('header.php');
?>

<main class="now-page wrap">
    <a href="<?php $this->options->siteUrl(); ?>" class="back-link">← 回到首页</a>

    <header class="now-page-header">
        <span class="little-mark">NOW · 此刻的生活切片</span>
        <h1><?php $this->title(); ?></h1>
        <p><?php echo trim((string) $this->content) !== '' ? $this->content : '一些还不够写成文章，却想顺手记下来的事情。没有严格的更新频率，想起来就往这里放一张小纸条。'; ?></p>
        <div class="now-status"><i aria-hidden="true"></i>最后更新于 <?php ato_e($lastUpdated); ?></div>
    </header>

    <section class="moment-timeline" aria-label="近况时间轴">
        <?php if (!empty($moments)): ?>
            <?php foreach ($moments as $index => $moment): ?>
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
            <article class="empty-paper"><h2>近况还没有写下来。</h2><p>可以在主题设置的“近况时间轴”中添加第一条记录。</p></article>
        <?php endif; ?>
    </section>

    <p class="timeline-ending">更早以前的事情，等想起来再慢慢补上。<span>✦</span></p>
</main>

<?php $this->need('footer.php'); ?>

