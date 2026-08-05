<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
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
            } catch (error) {}
        }());
    </script>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('style.css'); ?>">
    <?php $this->header(); ?>
</head>
<body>
<?php
$atoNavPages = [];
\Widget\Contents\Page\Rows::alloc()->to($navPages);
while ($navPages->next()) {
    $atoNavPages[] = [
        'slug' => (string) $navPages->slug,
        'url' => (string) $navPages->permalink,
        'title' => (string) $navPages->title,
    ];
}
?>
<div class="site-shell">
    <header class="site-header">
        <div class="wrap header-inner">
            <a class="brand" href="<?php $this->options->siteUrl(); ?>" aria-label="<?php $this->options->title(); ?>首页">
                <strong><?php $this->options->title(); ?></strong><span>✿</span>
            </a>

            <nav class="desktop-nav" aria-label="主导航">
                <a<?php if ($this->is('index')): ?> class="current"<?php endif; ?> href="<?php $this->options->siteUrl(); ?>">首页</a>
                <a href="<?php $this->options->siteUrl(); ?>#posts">文章</a>
                <a href="<?php $this->options->siteUrl(); ?>#categories">分类</a>
                <?php foreach ($atoNavPages as $navPage): ?>
                    <a<?php if ($this->is('page', $navPage['slug'])): ?> class="current"<?php endif; ?> href="<?php ato_e($navPage['url']); ?>"><?php ato_e($navPage['title']); ?></a>
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
                    <summary aria-label="打开菜单">菜单</summary>
                    <nav>
                        <a href="<?php $this->options->siteUrl(); ?>">首页</a>
                        <a href="<?php $this->options->siteUrl(); ?>#posts">文章</a>
                        <a href="<?php $this->options->siteUrl(); ?>#categories">分类</a>
                        <?php foreach ($atoNavPages as $navPage): ?><a href="<?php ato_e($navPage['url']); ?>"><?php ato_e($navPage['title']); ?></a><?php endforeach; ?>
                    </nav>
                </details>
            </div>
        </div>
    </header>

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
