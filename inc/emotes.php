<?php
/**
 * Sakura-compatible comment emote data and renderer integration.
 *
 * SPDX-License-Identifier: GPL-2.0-or-later
 * See THIRD_PARTY_NOTICES.md and licenses/Sakura-GPL-2.0.txt.
 */
if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}

/**
 * 评论表情清单。
 *
 * 颜文字与图像文件名参考 Sakura 3.x：
 * https://github.com/mashirozx/Sakura/tree/3.x
 */
function ato_kaomoji_list()
{
    return [
        '(⌒▽⌒)', '（￣▽￣）', '(=・ω・=)', '(｀・ω・´)', '(〜￣△￣)〜', '(･∀･)', '(°∀°)ﾉ', '(￣3￣)',
        '╮(￣▽￣)╭', '(´_ゝ｀)', '←_←', '→_→', '(<_<)', '(>_>)', '(;¬_¬)', '("▔□▔)/',
        '(ﾟДﾟ≡ﾟдﾟ)!?', 'Σ(ﾟдﾟ;)', 'Σ(￣□￣||)', '(’；ω；‘)', '（/TДT)/', '(^・ω・^ )', '(｡･ω･｡)',
        '(●￣(ｴ)￣●)', 'ε=ε=(ノ≧∇≦)ノ', '(’･_･‘)', '(-_-#)', '（￣へ￣）', '(￣ε(#￣)Σ', 'ヽ(‘Д’)ﾉ',
        '（#-_-)┯━┯', '(╯°口°)╯(┴—┴', '←◡←', '( ♥д♥)', '_(:3」∠)_', 'Σ>―(〃°ω°〃)♡→',
        '⁄(⁄ ⁄•⁄ω⁄•⁄ ⁄)⁄', '(╬ﾟдﾟ)▄︻┻┳═一', '･*･:≡(　ε:)', '(笑)', '(汗)', '(泣)', '(苦笑)',
    ];
}

function ato_tieba_emotes()
{
    return [
        'good' => ['file' => 'icon_good.gif', 'label' => '赞'],
        'han' => ['file' => 'icon_han.gif', 'label' => '汗'],
        'spray' => ['file' => 'icon_spray.gif', 'label' => '喷'],
        'Grievance' => ['file' => 'icon_Grievance.gif', 'label' => '委屈'],
        'shui' => ['file' => 'icon_shui.gif', 'label' => '睡觉'],
        'reluctantly' => ['file' => 'icon_reluctantly.gif', 'label' => '无奈'],
        'anger' => ['file' => 'icon_anger.gif', 'label' => '生气'],
        'tongue' => ['file' => 'icon_tongue.gif', 'label' => '吐舌'],
        'se' => ['file' => 'icon_se.gif', 'label' => '色'],
        'haha' => ['file' => 'icon_haha.gif', 'label' => '哈哈'],
        'rmb' => ['file' => 'icon_rmb.gif', 'label' => '金钱'],
        'doubt' => ['file' => 'icon_doubt.gif', 'label' => '疑问'],
        'tear' => ['file' => 'icon_tear.gif', 'label' => '流泪'],
        'surprised2' => ['file' => 'icon_surprised2.gif', 'label' => '震惊'],
        'Happy' => ['file' => 'icon_Happy.gif', 'label' => '开心'],
        'ku' => ['file' => 'icon_ku.gif', 'label' => '酷'],
        'surprised' => ['file' => 'icon_surprised.gif', 'label' => '惊讶'],
        'theblackline' => ['file' => 'icon_theblackline.gif', 'label' => '黑线'],
        'smilingeyes' => ['file' => 'icon_smilingeyes.gif', 'label' => '眯眼笑'],
        'spit' => ['file' => 'icon_spit.gif', 'label' => '吐槽'],
        'huaji' => ['file' => 'icon_huaji.gif', 'label' => '滑稽'],
        'bbd' => ['file' => 'icon_bbd.gif', 'label' => '棒棒哒'],
        'hu' => ['file' => 'icon_hu.gif', 'label' => '呼'],
        'shame' => ['file' => 'icon_shame.gif', 'label' => '害羞'],
        'naive' => ['file' => 'icon_naive.gif', 'label' => '天真'],
        'rbq' => ['file' => 'icon_rbq.gif', 'label' => '惹不起'],
        'britan' => ['file' => 'icon_britan.gif', 'label' => 'Britan'],
        'aa' => ['file' => 'icon_aa.gif', 'label' => '啊'],
        'niconiconi' => ['file' => 'icon_niconiconi.gif', 'label' => 'NicoNicoNi'],
        'niconiconi-t' => ['file' => 'icon_niconiconi_t.gif', 'label' => 'NicoNicoNi T'],
        'niconiconit' => ['file' => 'icon_niconiconit.gif', 'label' => 'NicoNicoNi T2'],
        'awesome' => ['file' => 'icon_awesome.gif', 'label' => '太棒了'],
    ];
}

function ato_bilibili_emotes()
{
    return [
        'baiyan' => ['label' => '白眼', 'height' => 1440],
        'bishi' => ['label' => '鄙视', 'height' => 288],
        'bizui' => ['label' => '闭嘴', 'height' => 992],
        'chan' => ['label' => '馋', 'height' => 1280],
        'daku' => ['label' => '大哭', 'height' => 256],
        'dalao' => ['label' => '大佬', 'height' => 1056],
        'dalian' => ['label' => '打脸', 'height' => 1184],
        'dianzan' => ['label' => '点赞', 'height' => 640],
        'doge' => ['label' => 'Doge', 'height' => 640],
        'facai' => ['label' => '发财', 'height' => 960],
        'fadai' => ['label' => '发呆', 'height' => 864],
        'fanu' => ['label' => '发怒', 'height' => 1056],
        'ganga' => ['label' => '尴尬', 'height' => 1216],
        'guilian' => ['label' => '鬼脸', 'height' => 32],
        'guzhang' => ['label' => '鼓掌', 'height' => 544],
        'haixiu' => ['label' => '害羞', 'height' => 992],
        'heirenwenhao' => ['label' => '黑人问号', 'height' => 832],
        'huaixiao' => ['label' => '坏笑', 'height' => 992],
        'jingxia' => ['label' => '惊吓', 'height' => 1024],
        'keai' => ['label' => '可爱', 'height' => 544],
        'koubi' => ['label' => '抠鼻', 'height' => 960],
        'kun' => ['label' => '困', 'height' => 1408],
        'lengmo' => ['label' => '冷漠', 'height' => 32],
        'liubixue' => ['label' => '流鼻血', 'height' => 1120],
        'liuhan' => ['label' => '流汗', 'height' => 864],
        'liulei' => ['label' => '流泪', 'height' => 32],
        'miantian' => ['label' => '腼腆', 'height' => 896],
        'mudengkoudai' => ['label' => '目瞪口呆', 'height' => 32],
        'nanguo' => ['label' => '难过', 'height' => 896],
        'outu' => ['label' => '呕吐', 'height' => 1344],
        'qinqin' => ['label' => '亲亲', 'height' => 224],
        'se' => ['label' => '色', 'height' => 320],
        'shengbing' => ['label' => '生病', 'height' => 1120],
        'shengqi' => ['label' => '生气', 'height' => 352],
        'shuizhao' => ['label' => '睡着', 'height' => 768],
        'sikao' => ['label' => '思考', 'height' => 1152],
        'tiaokan' => ['label' => '调侃', 'height' => 32],
        'tiaopi' => ['label' => '调皮', 'height' => 1600],
        'touxiao' => ['label' => '偷笑', 'height' => 192],
        'tuxue' => ['label' => '吐血', 'height' => 256],
        'weiqu' => ['label' => '委屈', 'height' => 640],
        'weixiao' => ['label' => '微笑', 'height' => 640],
        'wunai' => ['label' => '无奈', 'height' => 736],
        'xiaoku' => ['label' => '笑哭', 'height' => 480],
        'xieyanxiao' => ['label' => '斜眼笑', 'height' => 256],
        'yiwen' => ['label' => '疑问', 'height' => 672],
        'yun' => ['label' => '晕', 'height' => 384],
        'zaijian' => ['label' => '再见', 'height' => 768],
        'zhoumei' => ['label' => '皱眉', 'height' => 32],
        'zhuakuang' => ['label' => '抓狂', 'height' => 608],
    ];
}

function ato_emote_asset_url($options, $set, $file)
{
    $path = 'assets/emotes/' . trim($set, '/') . '/' . ltrim($file, '/');
    return \Typecho\Common::url($path, $options->themeUrl);
}

function ato_bilibili_sprite_style($height)
{
    $height = max(32, (int) $height);
    $frames = max(1, (int) floor($height / 32));
    $shift = max(0, $height - 32);
    $duration = max(240, $frames * 45);

    return '--emote-shift:-' . $shift . 'px;--emote-duration:' . $duration . 'ms;--emote-frames:' . $frames;
}

/**
 * 在 Typecho 已完成评论清理后，只替换主题认可的固定表情标记。
 */
function ato_render_comment_emotes($content, $options)
{
    static $replacementCache = [];
    $cacheKey = (string) $options->themeUrl;

    if (isset($replacementCache[$cacheKey])) {
        $replacements = $replacementCache[$cacheKey];
    } else {
        $replacements = [];

        foreach (ato_tieba_emotes() as $name => $emote) {
            $url = htmlspecialchars(ato_emote_asset_url($options, 'tieba', $emote['file']), ENT_QUOTES, 'UTF-8');
            $label = htmlspecialchars($emote['label'], ENT_QUOTES, 'UTF-8');
            $replacements[':' . $name . ':'] = '<img class="comment-emote-image comment-emote-tieba" src="' . $url
                . '" width="32" height="32" loading="lazy" decoding="async" alt="[贴吧：' . $label . ']" title="' . $label . '">';
        }

        foreach (ato_bilibili_emotes() as $name => $emote) {
            $url = htmlspecialchars(ato_emote_asset_url($options, 'bilibili', $name . '.png'), ENT_QUOTES, 'UTF-8');
            $label = htmlspecialchars($emote['label'], ENT_QUOTES, 'UTF-8');
            $height = max(32, (int) $emote['height']);

            if ($height === 32) {
                $markup = '<img class="comment-emote-image comment-emote-bilibili-static" src="' . $url
                    . '" width="32" height="32" loading="lazy" decoding="async" alt="[Bilibili：' . $label . ']" title="' . $label . '">';
            } else {
                $style = htmlspecialchars(ato_bilibili_sprite_style($height), ENT_QUOTES, 'UTF-8');
                $markup = '<span class="comment-emote comment-emote-bilibili is-animated" style="' . $style
                    . '" role="img" aria-label="Bilibili：' . $label . '" title="' . $label . '"><img src="' . $url
                    . '" width="32" height="' . $height . '" loading="lazy" decoding="async" alt=""></span>';
            }

            $replacements['{{' . $name . '}}'] = $markup;
        }

        $replacementCache[$cacheKey] = $replacements;
    }

    $parts = preg_split('/(<[^>]+>)/u', (string) $content, -1, PREG_SPLIT_DELIM_CAPTURE);
    if ($parts === false) {
        return (string) $content;
    }

    foreach ($parts as $index => $part) {
        if ($part !== '' && $part[0] !== '<') {
            $parts[$index] = strtr($part, $replacements);
        }
    }

    return implode('', $parts);
}

/**
 * CommentNotifier 的邮件表情回调。
 *
 * 在插件“表情重载”中填写 ato_comment_notifier_emotes。邮件客户端对动画
 * 与外部样式支持有限，因此 Bilibili 长图只展示第一帧。
 */
function ato_comment_notifier_emotes($content)
{
    $options = \Widget\Options::alloc();
    $replacements = [];

    foreach (ato_tieba_emotes() as $name => $emote) {
        $url = htmlspecialchars(ato_emote_asset_url($options, 'tieba', $emote['file']), ENT_QUOTES, 'UTF-8');
        $label = htmlspecialchars($emote['label'], ENT_QUOTES, 'UTF-8');
        $replacements[':' . $name . ':'] = '<img src="' . $url
            . '" width="30" height="30" style="display:inline-block;width:30px;height:30px;margin:0 2px;vertical-align:middle;border:0;" alt="[贴吧：' . $label . ']">';
    }

    foreach (ato_bilibili_emotes() as $name => $emote) {
        $url = htmlspecialchars(ato_emote_asset_url($options, 'bilibili', $name . '.png'), ENT_QUOTES, 'UTF-8');
        $label = htmlspecialchars($emote['label'], ENT_QUOTES, 'UTF-8');
        $height = max(32, (int) $emote['height']);
        $mailHeight = max(30, (int) round($height * 30 / 32));

        if ($height === 32) {
            $markup = '<img src="' . $url
                . '" width="30" height="30" style="display:inline-block;width:30px;height:30px;margin:0 2px;vertical-align:middle;border:0;" alt="[Bilibili：' . $label . ']">';
        } else {
            $markup = '<span style="display:inline-block;width:30px;height:30px;margin:0 2px;overflow:hidden;vertical-align:middle;">'
                . '<img src="' . $url . '" width="30" height="' . $mailHeight
                . '" style="display:block;width:30px;height:' . $mailHeight . 'px;margin:0;border:0;" alt="[Bilibili：' . $label . ']">'
                . '</span>';
        }

        $replacements['{{' . $name . '}}'] = $markup;
    }

    $parts = preg_split('/(<[^>]+>)/u', (string) $content, -1, PREG_SPLIT_DELIM_CAPTURE);
    if ($parts === false) {
        return (string) $content;
    }

    foreach ($parts as $index => $part) {
        if ($part !== '' && $part[0] !== '<') {
            $parts[$index] = strtr($part, $replacements);
        }
    }

    return implode('', $parts);
}
