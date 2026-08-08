<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$icpNumber = ato_option($this->options, 'icpNumber');
$policeNumber = ato_option($this->options, 'policeNumber');
$policeUrl = ato_http_url(
    ato_option($this->options, 'policeUrl', 'https://beian.mps.gov.cn/#/query/webSearch'),
    'https://beian.mps.gov.cn/#/query/webSearch'
);
?>
    <footer class="site-footer">
        <div class="wrap footer-main">
            <p><?php ato_e(ato_option($this->options, 'footerClosing', '谢谢你读到这里。')); ?></p>
            <div>
                <span>© <?php echo date('Y'); ?> <?php $this->options->title(); ?></span>
                <span><?php ato_e(ato_option($this->options, 'footerTagline', '在自己的小角落，慢慢写。')); ?></span>
            </div>
        </div>
        <div class="filing-strip">
            <div class="wrap filing-inner">
                <span class="filing-label"><?php ato_e(ato_option($this->options, 'footerCredit', 'Ato Paper：骄傲的由Ato和Codex构建')); ?></span>
                <?php if ($icpNumber !== '' || $policeNumber !== ''): ?>
                    <div class="filing-links">
                        <?php if ($icpNumber !== ''): ?>
                            <a href="https://beian.miit.gov.cn/" target="_blank" rel="noopener noreferrer">
                                <i aria-hidden="true"></i><?php ato_e($icpNumber); ?>
                            </a>
                        <?php endif; ?>
                        <?php if ($policeNumber !== ''): ?>
                            <a href="<?php ato_e($policeUrl); ?>" target="_blank" rel="noopener noreferrer">
                                <i aria-hidden="true"></i><?php ato_e($policeNumber); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </footer>
</div>

<script src="<?php $this->options->themeUrl('assets/vendor/highlight.min.js?v=11.11.1'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/vendor/glightbox.min.js?v=3.3.1'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/main.js?v=' . rawurlencode(ato_theme_version())); ?>"></script>
<?php $this->footer(); ?>
</body>
</html>
