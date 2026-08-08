<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$showToc = trim((string) $this->fields->showToc) === '1';
$dropCap = trim((string) $this->fields->dropCap) === '1';
$pageTree = ato_page_tree();
$pageNode = isset($pageTree['items'][(int) $this->cid]) ? $pageTree['items'][(int) $this->cid] : null;
$pageChildren = $pageNode ? $pageNode['children'] : [];
$pageAncestors = [];
$ancestorId = $pageNode ? (int) $pageNode['parent'] : 0;
$ancestorGuard = 0;
while ($ancestorId > 0 && isset($pageTree['items'][$ancestorId]) && $ancestorGuard < 8) {
    $ancestor = $pageTree['items'][$ancestorId];
    array_unshift($pageAncestors, $ancestor);
    $ancestorId = (int) $ancestor['parent'];
    $ancestorGuard++;
}
$this->need('header.php');
?>

<main class="reading-page wrap<?php echo $showToc ? ' has-toc' : ''; ?>" data-ato-pjax-main>
    <div class="reading-column">
        <a href="<?php $this->options->siteUrl(); ?>" class="back-link">← 回到首页</a>
        <article class="diary-article page-article">
            <header class="diary-header">
                <?php if (!empty($pageAncestors)): ?>
                    <nav class="page-breadcrumb" aria-label="页面路径">
                        <?php foreach ($pageAncestors as $ancestor): ?>
                            <a href="<?php ato_e($ancestor['url']); ?>"><?php ato_e($ancestor['title']); ?></a>
                            <span aria-hidden="true">/</span>
                        <?php endforeach; ?>
                        <span aria-current="page"><?php $this->title(); ?></span>
                    </nav>
                <?php else: ?>
                    <span class="little-mark">PAGE · 小小一页</span>
                <?php endif; ?>
                <h1><?php $this->title(); ?></h1>
            </header>
            <div class="diary-content<?php echo $dropCap ? ' has-drop-cap' : ''; ?>"><?php $this->content(); ?></div>

            <?php if (!empty($pageChildren)): ?>
                <nav class="page-children" aria-label="<?php ato_e($pageNode ? $pageNode['title'] : '当前页面'); ?>的子页面">
                    <span class="page-children-label">夹在这一页里的小纸条</span>
                    <div>
                        <?php foreach ($pageChildren as $childPage): ?>
                            <a href="<?php ato_e($childPage['url']); ?>">
                                <strong><?php ato_e($childPage['title']); ?></strong>
                                <span>继续翻阅 <i aria-hidden="true">→</i></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </nav>
            <?php endif; ?>
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
