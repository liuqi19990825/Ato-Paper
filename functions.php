<?php
if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
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

    $nowPageUrl = new \Typecho\Widget\Helper\Form\Element\Text(
        'nowPageUrl',
        null,
        'now.html',
        _t('近况页面地址'),
        _t('创建“近况”独立页面并选择“近况时间轴”模板后，填写它的相对地址或完整 URL。')
    );
    $form->addInput($nowPageUrl);

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
 * 评论列表单项。
 */
function threadedComments($comments, $options)
{
    $commentClass = $comments->authorId == $comments->ownerId ? ' comment-by-author' : '';
?>
    <li id="li-<?php $comments->theId(); ?>" class="comment-item<?php echo $commentClass; ?>">
        <article id="<?php $comments->theId(); ?>" class="comment-card">
            <header>
                <?php $comments->gravatar(42, null, true); ?>
                <div>
                    <strong><?php $comments->author(); ?></strong>
                    <a href="<?php $comments->permalink(); ?>"><time><?php $comments->date('Y.m.d'); ?> · <?php $comments->date('H:i'); ?></time></a>
                </div>
                <?php $comments->reply('<span class="comment-reply">回复</span>'); ?>
            </header>
            <div class="comment-text"><?php $comments->content(); ?></div>
        </article>
        <?php if ($comments->children): ?>
            <div class="comment-children"><?php $comments->threadedComments(); ?></div>
        <?php endif; ?>
    </li>
<?php
}
