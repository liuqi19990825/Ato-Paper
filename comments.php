<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$commentContactMode = ato_option($this->options, 'commentContactMode', 'qq');
?>
<section id="comments" class="comments-area">
    <?php $this->comments()->to($comments); ?>

    <div class="comments-heading">
        <h2>说点什么吧</h2>
        <span><?php $this->commentsNum('0 条留言', '1 条留言', '%d 条留言'); ?></span>
    </div>

    <?php if ($comments->have()): ?>
        <?php $comments->listComments(); ?>
        <nav class="comment-nav" aria-label="评论分页"><?php $comments->pageNav('← 较早', '较新 →'); ?></nav>
    <?php else: ?>
        <p class="comments-empty">这里还很安静。愿意的话，留下第一句话吧。</p>
    <?php endif; ?>

    <?php if ($this->allow('comment')): ?>
        <div id="<?php $this->respondId(); ?>" class="respond-paper">
            <div class="cancel-comment-reply"><?php $comments->cancelReply('取消回复'); ?></div>
            <?php if ($this->options->commentsAntiSpam): ?>
                <script data-ato-comment-security>
                    window.atoPaperCommentToken = <?php echo \Typecho\Common::shuffleScriptVar($this->security->getToken($this->request->getRequestUrl())); ?>;
                </script>
            <?php endif; ?>
            <form method="post" action="<?php $this->commentUrl(); ?>" id="comment-form" role="form">
                <?php if ($this->user->hasLogin()): ?>
                    <p class="logged-in-note">以 <a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a> 的身份留言 · <a href="<?php $this->options->logoutUrl(); ?>">退出</a></p>
                <?php else: ?>
                    <div class="comment-fields">
                        <label>称呼<input name="author" type="text" value="<?php $this->remember('author'); ?>" autocomplete="name" required></label>
                        <?php if ($commentContactMode === 'qq'): ?>
                            <label class="comment-contact-field">联系方式
                                <input name="ato_contact" type="text" maxlength="254" autocomplete="email" placeholder="QQ 号或 Email" data-comment-contact<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?>>
                                <input name="mail" type="hidden" value="<?php $this->remember('mail'); ?>" data-comment-mail>
                                <small data-comment-contact-hint>填写 QQ 将显示 QQ 头像，填写 Email 将使用邮箱头像。</small>
                            </label>
                        <?php else: ?>
                            <label>Email<input name="mail" type="email" value="<?php $this->remember('mail'); ?>" autocomplete="email"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?>></label>
                        <?php endif; ?>
                        <label>网站<input name="url" type="url" value="<?php $this->remember('url'); ?>" autocomplete="url" placeholder="https://"></label>
                    </div>
                <?php endif; ?>

                <label class="comment-textarea-label" for="textarea">留言内容</label>
                <textarea id="textarea" name="text" rows="6" placeholder="写下你的想法……" required><?php $this->remember('text'); ?></textarea>
                <div class="comment-emote-tools" data-comment-emotes>
                    <button class="comment-emote-toggle" type="button" data-emote-toggle aria-expanded="false" aria-controls="comment-emote-panel">
                        <span aria-hidden="true">☺</span><b>表情</b><i aria-hidden="true">＋</i>
                    </button>
                    <div class="comment-emote-popover" id="comment-emote-panel" data-emote-popover hidden>
                        <div class="comment-emote-tabs" role="tablist" aria-label="选择表情分类">
                            <button type="button" id="emote-tab-kaomoji" role="tab" aria-selected="true" aria-controls="emote-panel-kaomoji" data-emote-tab="kaomoji">颜文字</button>
                            <button type="button" id="emote-tab-tieba" role="tab" aria-selected="false" aria-controls="emote-panel-tieba" data-emote-tab="tieba" tabindex="-1">贴吧泡泡</button>
                            <button type="button" id="emote-tab-bilibili" role="tab" aria-selected="false" aria-controls="emote-panel-bilibili" data-emote-tab="bilibili" tabindex="-1">Bilibili</button>
                        </div>

                        <div class="comment-emote-grid comment-kaomoji-grid" id="emote-panel-kaomoji" role="tabpanel" aria-labelledby="emote-tab-kaomoji" data-emote-panel="kaomoji">
                            <?php foreach (ato_kaomoji_list() as $kaomoji): ?>
                                <button type="button" data-emote-value="<?php ato_e($kaomoji); ?>" title="插入 <?php ato_e($kaomoji); ?>"><?php ato_e($kaomoji); ?></button>
                            <?php endforeach; ?>
                        </div>

                        <div class="comment-emote-grid comment-image-emote-grid" id="emote-panel-tieba" role="tabpanel" aria-labelledby="emote-tab-tieba" data-emote-panel="tieba" hidden>
                            <?php foreach (ato_tieba_emotes() as $name => $emote): ?>
                                <button type="button" data-emote-value=" :<?php ato_e($name); ?>: " aria-label="插入贴吧表情：<?php ato_e($emote['label']); ?>" title="<?php ato_e($emote['label']); ?>">
                                    <img src="<?php ato_e(ato_emote_asset_url($this->options, 'tieba', $emote['file'])); ?>" width="32" height="32" loading="lazy" decoding="async" alt="">
                                </button>
                            <?php endforeach; ?>
                        </div>

                        <div class="comment-emote-grid comment-image-emote-grid" id="emote-panel-bilibili" role="tabpanel" aria-labelledby="emote-tab-bilibili" data-emote-panel="bilibili" hidden>
                            <?php foreach (ato_bilibili_emotes() as $name => $emote): ?>
                                <?php $biliAnimated = (int) $emote['height'] > 32; ?>
                                <button type="button" data-emote-value=" {{<?php ato_e($name); ?>}} " aria-label="插入 Bilibili 表情：<?php ato_e($emote['label']); ?>" title="<?php ato_e($emote['label']); ?>">
                                    <span class="comment-emote comment-emote-bilibili<?php echo $biliAnimated ? ' is-animated' : ''; ?>"<?php if ($biliAnimated): ?> style="<?php ato_e(ato_bilibili_sprite_style($emote['height'])); ?>"<?php endif; ?> aria-hidden="true">
                                        <img src="<?php ato_e(ato_emote_asset_url($this->options, 'bilibili', $name . '.png')); ?>" width="32" height="<?php echo (int) $emote['height']; ?>" loading="lazy" decoding="async" alt="">
                                    </span>
                                </button>
                            <?php endforeach; ?>
                        </div>
                        <small>点击即可插入到光标位置</small>
                    </div>
                </div>
                <button class="comment-submit" type="submit">把这句话留下来</button>
            </form>
        </div>
    <?php else: ?>
        <p class="comments-closed">这篇文章暂时关闭了留言。</p>
    <?php endif; ?>
</section>
