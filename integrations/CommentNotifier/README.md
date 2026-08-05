# Ato Paper × CommentNotifier

这里提供 Ato Paper 为 `jrotty/CommentNotifier` 设计的纸张风邮件模板，不包含插件本体。

## 安装模板

1. 安装并启用 CommentNotifier，确认插件目录名为 `CommentNotifier`。
2. 将本目录中的 `AtoPaper` 文件夹上传到 `/usr/plugins/CommentNotifier/template/`。
3. 进入 Typecho 后台“控制台 → 评论邮件模板”，找到 `Ato Paper` 并点击“启用”。
4. 进入 CommentNotifier 设置，将“表情重载”填写为 `ato_comment_notifier_emotes`。

主题回调会把贴吧泡泡和 Bilibili 表情转换为邮件可显示的绝对地址图片。邮件客户端不适合播放长图动画，因此 Bilibili 动态表情在邮件中只显示第一帧。

## 兼容信息

- 按 CommentNotifier 1.9.2、仓库提交 `907c19eedbce1cdb4b02f7449286c557223e2774` 的模板变量设计。
- 模板本身不依赖外部字体、JavaScript 或图片；评论表情图片仍从博客的 Ato Paper 主题目录加载。
- SMTP 密码或授权码只填写在插件设置中，不要写入模板文件或提交到版本库。
