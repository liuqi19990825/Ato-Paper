<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
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
            <form method="post" action="<?php $this->commentUrl(); ?>" id="comment-form" role="form">
                <?php if ($this->user->hasLogin()): ?>
                    <p class="logged-in-note">以 <a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a> 的身份留言 · <a href="<?php $this->options->logoutUrl(); ?>">退出</a></p>
                <?php else: ?>
                    <div class="comment-fields">
                        <label>称呼<input name="author" type="text" value="<?php $this->remember('author'); ?>" required></label>
                        <label>Email<input name="mail" type="email" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?>></label>
                        <label>网站<input name="url" type="url" value="<?php $this->remember('url'); ?>" placeholder="https://"></label>
                    </div>
                <?php endif; ?>

                <label class="comment-textarea-label" for="textarea">留言内容</label>
                <textarea id="textarea" name="text" rows="6" placeholder="写下你的想法……" required><?php $this->remember('text'); ?></textarea>
                <button class="comment-submit" type="submit">把这句话留下来</button>
            </form>
        </div>
    <?php else: ?>
        <p class="comments-closed">这篇文章暂时关闭了留言。</p>
    <?php endif; ?>
</section>
