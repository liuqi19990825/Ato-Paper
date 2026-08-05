<?php
/**
 * 友链页面
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

$friendLinks = ato_friend_links(ato_option($this->options, 'friendLinks'));
$friendIntro = ato_option($this->options, 'friendPageIntro', '沿着这些小小的书签，去看看朋友们正在记录的生活。');
$hasPageBody = trim(strip_tags((string) $this->content)) !== '';
$this->need('header.php');
?>

<main class="friends-page wrap" data-ato-pjax-main>
    <a href="<?php $this->options->siteUrl(); ?>" class="back-link">← 回到首页</a>

    <header class="friends-page-header">
        <span class="little-mark">LINKS · 偶然相遇的小世界</span>
        <h1><?php $this->title(); ?></h1>
        <div class="friends-page-lead">
            <p><?php ato_e($friendIntro); ?></p>
            <span><?php echo count($friendLinks); ?> 枚书签</span>
        </div>
    </header>

    <?php if (!empty($friendLinks)): ?>
        <section class="friend-grid" aria-label="友情链接">
            <?php foreach ($friendLinks as $index => $friend): ?>
                <a class="friend-card" href="<?php ato_e($friend['url']); ?>" target="_blank" rel="friend noopener" style="--friend-index: <?php echo (int) $index; ?>">
                    <span class="friend-card-tape" aria-hidden="true"></span>
                    <span class="friend-avatar">
                        <?php if ($friend['avatar'] !== ''): ?>
                            <img src="<?php ato_e($friend['avatar']); ?>" width="58" height="58" loading="lazy" decoding="async" referrerpolicy="no-referrer" alt="">
                        <?php else: ?>
                            <b aria-hidden="true"><?php ato_e(ato_friend_initial($friend['name'])); ?></b>
                        <?php endif; ?>
                    </span>
                    <span class="friend-copy">
                        <strong><?php ato_e($friend['name']); ?></strong>
                        <span><?php ato_e($friend['description']); ?></span>
                    </span>
                    <span class="friend-visit">去坐坐 <i aria-hidden="true">→</i></span>
                </a>
            <?php endforeach; ?>
        </section>
    <?php else: ?>
        <section class="empty-paper friend-empty">
            <h2>书签盒还空着。</h2>
            <p>在主题设置的“友链列表”里写下第一个朋友，页面就会在这里慢慢热闹起来。</p>
        </section>
    <?php endif; ?>

    <?php if ($hasPageBody): ?>
        <section class="friend-note">
            <span class="friend-note-label">交换友链 · 留张纸条</span>
            <div class="diary-content"><?php $this->content(); ?></div>
        </section>
    <?php endif; ?>

    <?php $this->need('comments.php'); ?>
</main>

<?php $this->need('footer.php'); ?>
