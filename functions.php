<?php
if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}

require_once __DIR__ . '/inc/emotes.php';

/**
 * 用于静态资源缓存刷新的主题版本号。
 */
function ato_theme_version()
{
    return '0.6.0';
}

/**
 * Ato Paper 主题设置。
 */
function themeConfig($form)
{
    $heroTitle = new \Typecho\Widget\Helper\Form\Element\Text(
        'heroTitle',
        null,
        '这里是 Ato 的小世界。',
        _t('首页大标题'),
        _t('首页第一屏显示的大标题。')
    );
    $form->addInput($heroTitle);

    $heroIntro = new \Typecho\Widget\Helper\Form\Element\Textarea(
        'heroIntro',
        null,
        '没有固定的主题，也不追赶更新频率。写最近听的歌、玩的游戏、折腾的 AI，偶尔也放一些没头没尾的碎碎念。',
        _t('首页介绍'),
        _t('建议控制在两到三行。')
    );
    $form->addInput($heroIntro);

    $heroSoft = new \Typecho\Widget\Helper\Form\Element\Text(
        'heroSoft',
        null,
        '如果其中某一篇刚好让你停下来读了一会儿，那就很好。',
        _t('首页补充文字')
    );
    $form->addInput($heroSoft);

    $heroSoftSource = new \Typecho\Widget\Helper\Form\Element\Radio(
        'heroSoftSource',
        [
            'manual' => _t('使用手动文字'),
            'hitokoto' => _t('接入一言 API')
        ],
        'manual',
        _t('首页补充文字来源'),
        _t('选择一言 API 时，上方手动文字会作为接口不可用时的备用内容。')
    );
    $form->addInput($heroSoftSource);

    $heroImage = new \Typecho\Widget\Helper\Form\Element\Text(
        'heroImage',
        null,
        null,
        _t('首页插图地址'),
        _t('留空使用主题自带插图，也可以填写完整图片 URL。')
    );
    $form->addInput($heroImage);

    $heroCaption = new \Typecho\Widget\Helper\Form\Element\Text(
        'heroCaption',
        null,
        '想象中的书桌一角 · 2026 夏',
        _t('首页插图说明')
    );
    $form->addInput($heroCaption);

    $brandIcon = new \Typecho\Widget\Helper\Form\Element\Select(
        'brandIcon',
        [
            'flower' => _t('✿ 珊瑚小花'),
            'sakura' => _t('❀ 樱花'),
            'sparkle' => _t('✦ 星芒'),
            'heart' => _t('♥ 小爱心'),
            'clover' => _t('☘ 四叶草'),
            'ribbon' => _t('୨୧ 蝴蝶结'),
            'music' => _t('♪ 音符')
        ],
        'flower',
        _t('标题旁的小图标'),
        _t('显示在页头站点标题右侧。')
    );
    $form->addInput($brandIcon);

    $nowPageUrl = new \Typecho\Widget\Helper\Form\Element\Text(
        'nowPageUrl',
        null,
        'now.html',
        _t('近况页面地址'),
        _t('创建“近况”独立页面并选择“近况时间轴”模板后，填写它的相对地址或完整 URL。')
    );
    $form->addInput($nowPageUrl);

    $aboutPageUrl = new \Typecho\Widget\Helper\Form\Element\Text(
        'aboutPageUrl',
        null,
        'about-me.html',
        _t('关于页面地址'),
        _t('首页侧栏的“关于”区域会跳转到这里；可填写相对地址或完整 URL。')
    );
    $form->addInput($aboutPageUrl);

    $friendPageIntro = new \Typecho\Widget\Helper\Form\Element\Textarea(
        'friendPageIntro',
        null,
        '沿着这些小小的书签，去看看朋友们正在记录的生活。',
        _t('友链页面介绍'),
        _t('显示在“友链页面”标题下方，建议写一到两句话。')
    );
    $form->addInput($friendPageIntro);

    $friendLinks = new \Typecho\Widget\Helper\Form\Element\Textarea(
        'friendLinks',
        null,
        null,
        _t('友链列表'),
        _t('每行一个站点，格式为：名称|网址|头像网址|一句介绍。头像和介绍可留空。')
    );
    $form->addInput($friendLinks);

    $commentContactMode = new \Typecho\Widget\Helper\Form\Element\Radio(
        'commentContactMode',
        [
            'qq' => _t('自动识别 QQ 或 Email（推荐）'),
            'email' => _t('仅使用 Email')
        ],
        'qq',
        _t('评论联系方式'),
        _t('自动识别模式使用一个“联系方式”输入框：数字 QQ 会显示 QQ 头像，Email 会使用所选头像源。已有评论不受影响。')
    );
    $form->addInput($commentContactMode);

    $commentAvatarSource = new \Typecho\Widget\Helper\Form\Element\Select(
        'commentAvatarSource',
        [
            'cravatar' => _t('Cravatar 国内头像源（推荐）'),
            'gravatar' => _t('Gravatar 官方源'),
            'custom' => _t('自定义兼容头像源')
        ],
        'cravatar',
        _t('评论头像源'),
        _t('用于 Email 评论及 QQ 头像加载失败时的备用头像。QQ 评论仍优先读取 QQ 头像。')
    );
    $form->addInput($commentAvatarSource);

    $commentAvatarCustomBase = new \Typecho\Widget\Helper\Form\Element\Text(
        'commentAvatarCustomBase',
        null,
        null,
        _t('自定义头像源地址'),
        _t('仅在上方选择“自定义”时使用。填写兼容 Gravatar 的基础地址，例如：https://example.com/avatar/；也支持在地址中使用 {hash}。')
    );
    $form->addInput($commentAvatarCustomBase);

    $commentAvatarDefault = new \Typecho\Widget\Helper\Form\Element\Text(
        'commentAvatarDefault',
        null,
        'identicon',
        _t('无头像时的默认图'),
        _t('可填 identicon、mp、retro、monsterid、wavatar、robohash，或一张公开图片的完整 URL；这里可以使用 SM.MS 图片直链。')
    );
    $form->addInput($commentAvatarDefault);

    $defaultNow = "2026-08-05|博客|给这个小世界重新铺一层纸|整理歌单，补几篇拖了很久的文章，也在认真把博客装修得更舒服一点。\n"
        . "2026-07-29|正在听|最近总在循环一些有雨声的歌|安静的鼓点和稍远一点的人声，很适合七月底闷热的夜晚。\n"
        . "2026-07-21|游戏|慢慢体验姬子·启行|没有急着追进度，一边体验剧情和机甲演出，一边记下机制与手感。\n"
        . "2026-07-12|日常|把桌面清出了一小块空地|收起暂时用不到的线材，也给常用的耳机留了一个固定位置。";
    $nowItems = new \Typecho\Widget\Helper\Form\Element\Textarea(
        'nowItems',
        null,
        $defaultNow,
        _t('近况时间轴'),
        _t('每行一条，格式为：日期|标签|标题|正文。最新内容放在最上面。')
    );
    $form->addInput($nowItems);

    $bilibiliUrl = new \Typecho\Widget\Helper\Form\Element\Text(
        'bilibiliUrl',
        null,
        null,
        _t('Bilibili 地址')
    );
    $form->addInput($bilibiliUrl);

    $githubUrl = new \Typecho\Widget\Helper\Form\Element\Text(
        'githubUrl',
        null,
        null,
        _t('GitHub 地址')
    );
    $form->addInput($githubUrl);

    $icpNumber = new \Typecho\Widget\Helper\Form\Element\Text(
        'icpNumber',
        null,
        null,
        _t('ICP备案号'),
        _t('例如：京ICP备12345678号。留空时显示待填写。')
    );
    $form->addInput($icpNumber);

    $policeNumber = new \Typecho\Widget\Helper\Form\Element\Text(
        'policeNumber',
        null,
        null,
        _t('公安备案号'),
        _t('例如：京公网安备 11000000000000号。')
    );
    $form->addInput($policeNumber);

    $policeUrl = new \Typecho\Widget\Helper\Form\Element\Text(
        'policeUrl',
        null,
        'https://beian.mps.gov.cn/#/query/webSearch',
        _t('公安备案详情链接')
    );
    $form->addInput($policeUrl);

    $footerClosing = new \Typecho\Widget\Helper\Form\Element\Text(
        'footerClosing',
        null,
        '谢谢你读到这里。',
        _t('页脚左侧文字')
    );
    $form->addInput($footerClosing);

    $footerTagline = new \Typecho\Widget\Helper\Form\Element\Text(
        'footerTagline',
        null,
        '在自己的小角落，慢慢写。',
        _t('页脚右侧补充文字')
    );
    $form->addInput($footerTagline);

    $enablePjax = new \Typecho\Widget\Helper\Form\Element\Radio(
        'enablePjax',
        [
            '1' => _t('开启'),
            '0' => _t('关闭')
        ],
        '1',
        _t('PJAX 无刷新加载'),
        _t('在站内页面之间切换时保留页头与深色模式，并使用轻量纸张过渡。遇到不兼容的插件时可以在这里关闭。')
    );
    $form->addInput($enablePjax);

    $footerCredit = new \Typecho\Widget\Helper\Form\Element\Text(
        'footerCredit',
        null,
        'Ato Paper：骄傲的由Ato和Codex构建',
        _t('页脚署名')
    );
    $form->addInput($footerCredit);
}

/**
 * 文章高级选项：可选副标题与题图。
 */
function themeFields($layout)
{
    $homeSnippet = new \Typecho\Widget\Helper\Form\Element\Textarea(
        'homeSnippet',
        null,
        null,
        _t('首页“今天的片段”'),
        _t('可选。填写后优先显示这段文字；留空则自动截取正文前 62 个字符。')
    );
    $layout->addItem($homeSnippet);

    $subtitle = new \Typecho\Widget\Helper\Form\Element\Text(
        'subtitle',
        null,
        null,
        _t('文章副标题'),
        _t('可选，显示在文章标题下方。')
    );
    $layout->addItem($subtitle);

    $cover = new \Typecho\Widget\Helper\Form\Element\Text(
        'cover',
        null,
        null,
        _t('文章题图 URL'),
        _t('可选，建议使用宽幅图片。')
    );
    $layout->addItem($cover);

    $coverCaption = new \Typecho\Widget\Helper\Form\Element\Text(
        'coverCaption',
        null,
        null,
        _t('题图说明')
    );
    $layout->addItem($coverCaption);

    $showToc = new \Typecho\Widget\Helper\Form\Element\Radio(
        'showToc',
        [
            '0' => _t('不显示'),
            '1' => _t('显示右侧章节目录')
        ],
        '0',
        _t('文章章节目录'),
        _t('默认关闭。开启后会读取正文中的二级、三级标题，并在宽屏文章右侧生成目录。')
    );
    $layout->addItem($showToc);

    $dropCap = new \Typecho\Widget\Helper\Form\Element\Radio(
        'dropCap',
        [
            '0' => _t('不放大'),
            '1' => _t('放大正文首字')
        ],
        '0',
        _t('正文首字放大'),
        _t('默认关闭。只对当前文章正文的第一个段落生效。')
    );
    $layout->addItem($dropCap);
}

/**
 * 读取主题选项并提供默认值。
 */
function ato_option($options, $name, $default = '')
{
    $value = isset($options->{$name}) ? trim((string) $options->{$name}) : '';
    return $value !== '' ? $value : $default;
}

/**
 * 转义并输出普通文本。
 */
function ato_e($value)
{
    echo htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

/**
 * 返回页头标题旁的小图标。
 */
function ato_brand_icon($name)
{
    $icons = [
        'flower' => '✿',
        'sakura' => '❀',
        'sparkle' => '✦',
        'heart' => '♥',
        'clover' => '☘',
        'ribbon' => '୨୧',
        'music' => '♪',
    ];

    return $icons[$name] ?? $icons['flower'];
}

/**
 * 将主题设置中的相对路径转换为站点 URL。
 */
function ato_site_url($options, $path)
{
    $path = trim((string) $path);
    if (preg_match('/^https?:\/\//i', $path)) {
        return $path;
    }

    return \Typecho\Common::url(ltrim($path, '/'), $options->siteUrl);
}

/**
 * 解析“日期|标签|标题|正文”格式的近况数据。
 */
function ato_now_items($raw)
{
    $items = [];
    $lines = preg_split('/\r\n|\r|\n/', trim((string) $raw));

    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '') {
            continue;
        }

        $parts = array_map('trim', explode('|', $line, 4));
        if (count($parts) < 4) {
            continue;
        }

        $timestamp = strtotime($parts[0]);
        $items[] = [
            'date' => $parts[0],
            'dateLabel' => $timestamp ? date('m.d', $timestamp) : $parts[0],
            'year' => $timestamp ? date('Y', $timestamp) : '',
            'tag' => $parts[1],
            'title' => $parts[2],
            'body' => $parts[3],
        ];
    }

    return $items;
}

/**
 * 解析“名称|网址|头像|介绍”格式的友链数据。
 */
function ato_friend_links($raw)
{
    $items = [];
    $lines = preg_split('/\r\n|\r|\n/', trim((string) $raw));

    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '') {
            continue;
        }

        $parts = array_pad(array_map('trim', explode('|', $line, 4)), 4, '');
        if ($parts[0] === '' || !preg_match('/^https?:\/\//i', $parts[1]) || !filter_var($parts[1], FILTER_VALIDATE_URL)) {
            continue;
        }

        $avatar = $parts[2];
        if ($avatar !== '' && (!preg_match('/^https?:\/\//i', $avatar) || !filter_var($avatar, FILTER_VALIDATE_URL))) {
            $avatar = '';
        }

        $items[] = [
            'name' => $parts[0],
            'url' => $parts[1],
            'avatar' => $avatar,
            'description' => $parts[3] !== '' ? $parts[3] : '去这个小小的网络角落看看。',
        ];
    }

    return $items;
}

/**
 * 返回站点名称中适合作为头像占位符的第一个字符。
 */
function ato_friend_initial($name)
{
    $name = trim((string) $name);
    if ($name === '') {
        return '✦';
    }

    return function_exists('mb_substr') ? mb_substr($name, 0, 1, 'UTF-8') : substr($name, 0, 1);
}

/**
 * 从 Typecho 保存的 QQ 邮箱格式中还原 QQ 号。
 */
function ato_comment_qq($mail)
{
    if (preg_match('/^([1-9][0-9]{4,11})@qq\.com$/i', trim((string) $mail), $matches)) {
        return $matches[1];
    }

    return '';
}

/**
 * 返回经过校验的默认头像标识或外部图片地址。
 */
function ato_avatar_default($options)
{
    $default = ato_option($options, 'commentAvatarDefault', 'identicon');
    if (preg_match('/^https?:\/\//i', $default) && filter_var($default, FILTER_VALIDATE_URL)) {
        return $default;
    }

    $allowed = ['404', 'mp', 'identicon', 'monsterid', 'wavatar', 'retro', 'robohash', 'blank'];
    return in_array(strtolower($default), $allowed, true) ? strtolower($default) : 'identicon';
}

/**
 * 返回评论头像服务的基础地址。
 */
function ato_avatar_source_base($options)
{
    $source = ato_option($options, 'commentAvatarSource', 'cravatar');
    if ($source === 'gravatar') {
        return 'https://gravatar.com/avatar/';
    }

    if ($source === 'custom') {
        $custom = ato_option($options, 'commentAvatarCustomBase');
        $probe = str_replace(['{hash}', '{size}'], ['00000000000000000000000000000000', '42'], $custom);
        if (preg_match('/^https?:\/\//i', $probe) && filter_var($probe, FILTER_VALIDATE_URL)) {
            return $custom;
        }
    }

    return 'https://cravatar.cn/avatar/';
}

/**
 * 按 Gravatar 兼容格式生成邮箱头像地址。
 */
function ato_mail_avatar_url($options, $mail, $size = 42)
{
    $size = max(16, min(512, (int) $size));
    $hash = md5(strtolower(trim((string) $mail)));
    $base = ato_avatar_source_base($options);

    if (strpos($base, '{hash}') !== false) {
        $url = str_replace(['{hash}', '{size}'], [$hash, (string) $size], $base);
    } else {
        $queryPosition = strpos($base, '?');
        $basePath = $queryPosition === false ? $base : substr($base, 0, $queryPosition);
        $baseQuery = $queryPosition === false ? '' : substr($base, $queryPosition + 1);
        $url = rtrim($basePath, '/') . '/' . $hash . ($baseQuery !== '' ? '?' . $baseQuery : '');
        $url = str_replace('{size}', (string) $size, $url);
    }

    $query = http_build_query([
        's' => $size,
        'd' => ato_avatar_default($options),
        'r' => 'g',
    ], '', '&', PHP_QUERY_RFC3986);

    return $url . (strpos($url, '?') === false ? '?' : '&') . $query;
}

/**
 * QQ 邮箱评论优先使用 QQ 头像，其余评论使用后台选择的头像源。
 */
function ato_comment_avatar($comments, $size = 42)
{
    $options = \Widget\Options::alloc();
    $mail = (string) $comments->mail;
    $qq = ato_comment_qq($mail);
    $avatarUrl = $qq !== ''
        ? 'https://q2.qlogo.cn/headimg_dl?dst_uin=' . rawurlencode($qq) . '&spec=100'
        : ato_mail_avatar_url($options, $mail, $size);
    $fallbackUrl = $qq !== '' ? ato_mail_avatar_url($options, $mail, $size) : '';
    $defaultAvatar = ato_avatar_default($options);
    if ($fallbackUrl === '' && preg_match('/^https?:\/\//i', $defaultAvatar)) {
        $fallbackUrl = $defaultAvatar;
    }

    ?>
    <img class="avatar<?php echo $qq !== '' ? ' avatar-qq' : ''; ?>" src="<?php ato_e($avatarUrl); ?>"<?php if ($qq === ''): ?> srcset="<?php ato_e(ato_mail_avatar_url($options, $mail, $size * 2)); ?> 2x, <?php ato_e(ato_mail_avatar_url($options, $mail, $size * 3)); ?> 3x"<?php endif; ?><?php if ($fallbackUrl !== ''): ?> data-avatar-fallback="<?php ato_e($fallbackUrl); ?>"<?php endif; ?> width="<?php echo (int) $size; ?>" height="<?php echo (int) $size; ?>" loading="lazy" decoding="async" referrerpolicy="no-referrer" alt="<?php ato_e((string) $comments->author); ?>的头像">
    <?php
}

/**
 * 评论列表单项。
 */
function threadedComments($comments, $options)
{
    $commentClass = $comments->authorId == $comments->ownerId ? ' comment-by-author' : '';
?>
    <li id="li-<?php $comments->theId(); ?>" class="comment-item<?php echo $commentClass; ?>">
        <article id="<?php $comments->theId(); ?>" class="comment-card">
            <header>
                <?php ato_comment_avatar($comments, 42); ?>
                <div>
                    <strong><?php $comments->author(); ?></strong>
                    <a href="<?php $comments->permalink(); ?>"><time><?php $comments->date('Y.m.d'); ?> · <?php $comments->date('H:i'); ?></time></a>
                </div>
                <?php $comments->reply('<span class="comment-reply">回复</span>'); ?>
            </header>
            <div class="comment-text"><?php echo ato_render_comment_emotes((string) $comments->content, \Widget\Options::alloc()); ?></div>
        </article>
        <?php if ($comments->children): ?>
            <div class="comment-children"><?php $comments->threadedComments(); ?></div>
        <?php endif; ?>
    </li>
<?php
}
