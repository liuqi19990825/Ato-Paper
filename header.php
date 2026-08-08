<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$atoPjaxEnabled = ato_option($this->options, 'enablePjax', '1') !== '0';
?>
<!doctype html>
<html lang="zh-CN" data-ato-pjax="<?php echo $atoPjaxEnabled ? 'true' : 'false'; ?>">
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="renderer" content="webkit">
    <meta name="theme-color" id="ato-theme-color" content="#f8f5ed">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="application-name" content="<?php ato_e((string) $this->options->title); ?>">
    <title><?php $this->archiveTitle([
        'category' => _t('分类 %s'),
        'search' => _t('搜索 %s'),
        'tag' => _t('标签 %s'),
        'author' => _t('%s 的文章')
    ], '', '｜'); ?><?php $this->options->title(); ?></title>
    <script>
        (function () {
            try {
                var saved = localStorage.getItem('ato-paper-theme');
                var dark = saved ? saved === 'dark' : window.matchMedia('(prefers-color-scheme: dark)').matches;
                if (dark) document.documentElement.setAttribute('data-theme', 'dark');
                var themeColor = document.getElementById('ato-theme-color');
                if (themeColor) themeColor.setAttribute('content', dark ? '#201f1c' : '#f8f5ed');
            } catch (error) {}
        }());
    </script>
    <link rel="manifest" href="<?php $this->options->themeUrl('manifest.json?v=' . rawurlencode(ato_theme_version())); ?>">
    <link rel="icon" href="<?php $this->options->themeUrl('assets/icons/favicon.ico'); ?>" sizes="any">
    <link rel="icon" type="image/png" href="<?php $this->options->themeUrl('assets/icons/favicon-32.png'); ?>" sizes="32x32">
    <link rel="apple-touch-icon" href="<?php $this->options->themeUrl('assets/icons/apple-touch-icon.png'); ?>" sizes="180x180">
    <link rel="preload" href="<?php $this->options->themeUrl('assets/fonts/noto-serif-sc/H4chBXePl9DZ0Xe7gG9cyOj7kqGWbg.woff2'); ?>" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?php $this->options->themeUrl('assets/fonts/noto-sans-sc/k3kXo84MPvpLmixcA63oeALRLoKI.woff2'); ?>" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/fonts/fonts.css?v=' . rawurlencode(ato_theme_version())); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('style.css?v=' . rawurlencode(ato_theme_version())); ?>">
    <?php $this->header(); ?>
</head>
<body>
<?php
$atoPageTree = ato_page_tree();
$atoNavPages = $atoPageTree['roots'];
$atoCurrentPageId = $this->is('page') ? (int) $this->cid : 0;
?>
<div class="site-shell">
    <header class="site-header">
        <div class="wrap header-inner">
            <a class="brand" href="<?php $this->options->siteUrl(); ?>" aria-label="<?php $this->options->title(); ?>首页">
                <strong><?php $this->options->title(); ?></strong><span class="brand-icon" aria-hidden="true"><?php ato_e(ato_brand_icon(ato_option($this->options, 'brandIcon', 'flower'))); ?></span>
            </a>

            <nav class="desktop-nav" data-site-nav aria-label="主导航">
                <div class="desktop-nav-item">
                    <a<?php if ($this->is('index')): ?> class="current" aria-current="page"<?php endif; ?> href="<?php $this->options->siteUrl(); ?>">首页</a>
                </div>
                <?php foreach ($atoNavPages as $navPage): ?>
                    <?php
                    $isCurrentPage = $atoCurrentPageId === $navPage['cid'];
                    $isCurrentParent = !$isCurrentPage && ato_page_node_contains($navPage, $atoCurrentPageId);
                    $hasChildren = !empty($navPage['children']);
                    $submenuId = 'nav-children-' . $navPage['cid'];
                    ?>
                    <div class="desktop-nav-item<?php echo $hasChildren ? ' has-children' : ''; ?>" data-nav-item>
                        <a<?php if ($isCurrentPage): ?> class="current" aria-current="page"<?php elseif ($isCurrentParent): ?> class="parent-current"<?php endif; ?> href="<?php ato_e($navPage['url']); ?>"><?php ato_e($navPage['title']); ?></a>
                        <?php if ($hasChildren): ?>
                            <button class="desktop-submenu-toggle" type="button" aria-expanded="false" aria-controls="<?php ato_e($submenuId); ?>" aria-label="展开<?php ato_e($navPage['title']); ?>的子页面">
                                <span class="nav-chevron" aria-hidden="true"></span>
                            </button>
                            <div class="desktop-submenu" id="<?php ato_e($submenuId); ?>">
                                <?php foreach ($navPage['children'] as $childPage): ?>
                                    <?php
                                    $isChildCurrent = $atoCurrentPageId === $childPage['cid'];
                                    $isChildParent = !$isChildCurrent && ato_page_node_contains($childPage, $atoCurrentPageId);
                                    ?>
                                    <a<?php if ($isChildCurrent): ?> class="current" aria-current="page"<?php elseif ($isChildParent): ?> class="parent-current"<?php endif; ?> href="<?php ato_e($childPage['url']); ?>"><?php ato_e($childPage['title']); ?></a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </nav>

            <div class="header-tools">
                <button class="search-button" id="search-open" type="button" aria-label="搜索文章" aria-expanded="false">
                    <span class="search-glyph" aria-hidden="true"></span>
                </button>
                <button class="theme-toggle" id="theme-toggle" type="button" aria-label="切换深浅色模式">
                    <span aria-hidden="true">◐</span><span class="theme-label">深色</span>
                </button>
                <details class="mobile-menu">
                    <summary aria-label="打开菜单"><span>菜单</span><span class="menu-glyph" aria-hidden="true"></span></summary>
                    <nav data-site-nav aria-label="手机端主导航">
                        <a<?php if ($this->is('index')): ?> class="current" aria-current="page"<?php endif; ?> href="<?php $this->options->siteUrl(); ?>">首页</a>
                        <?php foreach ($atoNavPages as $navPage): ?>
                            <?php
                            $isCurrentPage = $atoCurrentPageId === $navPage['cid'];
                            $isCurrentParent = !$isCurrentPage && ato_page_node_contains($navPage, $atoCurrentPageId);
                            ?>
                            <div class="mobile-nav-group<?php echo !empty($navPage['children']) ? ' has-children' : ''; ?>">
                                <a<?php if ($isCurrentPage): ?> class="current" aria-current="page"<?php elseif ($isCurrentParent): ?> class="parent-current"<?php endif; ?> href="<?php ato_e($navPage['url']); ?>"><?php ato_e($navPage['title']); ?></a>
                                <?php if (!empty($navPage['children'])): ?>
                                    <div class="mobile-subpages">
                                        <?php foreach ($navPage['children'] as $childPage): ?>
                                            <?php
                                            $isChildCurrent = $atoCurrentPageId === $childPage['cid'];
                                            $isChildParent = !$isChildCurrent && ato_page_node_contains($childPage, $atoCurrentPageId);
                                            ?>
                                            <a<?php if ($isChildCurrent): ?> class="current" aria-current="page"<?php elseif ($isChildParent): ?> class="parent-current"<?php endif; ?> href="<?php ato_e($childPage['url']); ?>"><?php ato_e($childPage['title']); ?></a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </nav>
                </details>
            </div>
        </div>
    </header>

    <?php if ($atoPjaxEnabled): ?>
        <div class="pjax-progress" id="pjax-progress" aria-hidden="true"></div>
        <div class="sr-only" id="pjax-announcer" aria-live="polite" aria-atomic="true"></div>
    <?php endif; ?>

    <div class="search-panel" id="search-panel" aria-hidden="true">
        <button class="search-backdrop" type="button" data-search-close aria-label="关闭搜索"></button>
        <form class="search-paper" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
            <label for="search-input">想找些什么？</label>
            <div>
                <input id="search-input" name="s" type="search" placeholder="输入关键词，然后按回车……" autocomplete="off">
                <button type="submit">搜索</button>
            </div>
            <small>按 Esc 也可以关掉这张纸。</small>
        </form>
    </div>
