中文 | [English](./README_EN.md)

<div align="center">
  <img src="./assets/icons/pwa-512.png" alt="Ato Paper 樱花 Logo" width="120">

  <h1>Typecho Theme — Ato Paper</h1>

  <p>一款侧重日常阅读的 Typecho 纸张风主题。</p>
  <p>写生活、写碎碎念，也写那些偶尔想认真读完的长文章。</p>

  <p>
    <a href="https://github.com/liuqi19990825/Ato-Paper/releases/latest">
      <img src="https://img.shields.io/github/v/release/liuqi19990825/Ato-Paper?color=d27364&label=Release&logo=github" alt="最新版本">
    </a>
    <img src="https://img.shields.io/badge/Typecho-1.3.0-d27364" alt="Typecho 1.3.0">
    <img src="https://img.shields.io/badge/PHP-7.4%2B-777BB4?logo=php&logoColor=white" alt="PHP 7.4+">
    <a href="./LICENSE">
      <img src="https://img.shields.io/badge/License-MIT-4f4b47" alt="MIT License">
    </a>
  </p>

  <p>
    <a href="https://atowo.work/">在线预览</a>
    ·
    <a href="https://github.com/liuqi19990825/Ato-Paper/releases/latest">下载主题</a>
    ·
    <a href="#安装与升级">安装说明</a>
  </p>

  <a href="https://atowo.work/">
    <img src="./assets/screenshots/device-showcase.webp" alt="Ato Paper 桌面、笔记本、平板与手机多设备预览" width="1080">
  </a>

  <sub>浅色与深色模式 · 桌面、平板和手机响应式布局</sub>
</div>

---

由 Ato 与 Codex 通过 **vibe coding** 共同构建。当前正式版本：**1.0.7**。

## 目录

- [主题定位](#主题定位)
- [功能一览](#功能一览)
- [安装与升级](#安装与升级)
- [开始使用](#开始使用)
- [文章高级选项](#文章高级选项)
- [评论、头像与通知](#评论头像与通知)
- [图片、代码与 PJAX](#图片代码与-pjax)
- [移动端安装](#移动端安装)
- [许可证与致谢](#许可证与致谢)
- [维护方式](#维护方式)

## 主题定位

Ato Paper 不试图把博客做成规整的产品官网，而是把空间留给内容：宽松的阅读行距、纸张般的底色、克制的珊瑚红强调色，以及适合桌面与手机的连续阅读体验。

它适合记录：

- 日常生活、观影、音乐、游戏与 AI 折腾
- 不想单独写成文章的短句和近况
- 需要目录、图片相册或代码高亮的长文
- 希望保留一点二次元气质、但不想牺牲阅读舒适度的个人博客

## 功能一览

### 阅读与视觉

- 纸张质感首页、文章页、独立页面与 404 页面
- 深色模式、本地偏好记忆、减少动效和键盘焦点支持
- 自托管 Noto Serif SC 与 Noto Sans SC，减少不同平台的字体差异
- 桌面端统一阅读框架；文章、关于、碎碎念、友链页面保持一致的阅读宽度
- 响应式手机布局、紧凑菜单、父子页面缩进和 L 形层级连接
- 可替换的页头图标：小花、樱花、星芒、爱心、四叶草、蝴蝶结和音符
- 原创纸张风 favicon，并提供 ICO、32px PNG 与 Apple Touch Icon
- Web App Manifest、安装图标、standalone 显示模式和移动设备安全区适配

### 内容组织

- 分类、标签、作者和搜索归档
- “碎碎念”独立时间流：使用 Typecho 原生文章发布，不再依赖主题设置里的大段文本
- 碎碎念分类自动从首页文章流、上一篇/下一篇和“随便逛逛”中排除
- 首页“最近在做”自动摘取最新碎碎念，并可跳转到独立页面
- 友链独立页面：书签式纸卡、头像、简介和交换友链说明
- Typecho 父子页面导航：桌面端下拉子菜单，移动端缩进展示，子页面自动显示面包屑
- 首页文案支持手动输入或接入一言 API；一言长句会使用独立引文排版
- 页脚结束语、补充文字、社交链接、备案信息和首页插图均可在后台设置
- ICP 与公安备案号按填写状态单独显示，空值不会输出占位文字

### 文章增强

- 自定义文章副标题、题图 URL、题图说明和首页“今天的片段”
- “今天的片段”支持手动摘录；未填写时自动截取正文
- 每篇文章和普通独立页都可单独开启章节目录或正文首字放大，默认关闭
- Markdown 图片自动组成灯箱相册，支持触摸、键盘、缩放、图注和缩略图链接原图
- 本地代码高亮、自动语言识别和一键复制，使用暖纸张风代码块
- 可选的正文复制出处：达到设定字数后，在剪贴板末尾追加作者、原文链接和转载协议
- 文章“喜欢”按钮使用浏览器本地记录，不上传访客数据，也不提供后台统计

### 评论与互动

- Typecho 原生评论和嵌套回复
- 颜文字、贴吧泡泡和 Bilibili 三类评论表情
- 单一联系方式输入框自动区分 QQ 或 Email
- QQ 号转换为对应 QQ 邮箱保存，并可显示 QQ 头像
- Email 头像默认使用 Cravatar 国内源，也可切换 Gravatar 或自定义头像源
- CommentNotifier 专用访客回复、站长新评论和待审核邮件模板
- 原生 PJAX 页面加载、纸张过渡和失败自动回退

## 安装与升级

### 全新安装

1. 从 [Releases](https://github.com/liuqi19990825/Ato-Paper/releases) 下载最新压缩包。
2. 解压后，将完整的 <code>AtoPaper</code> 文件夹上传到 Typecho 的 <code>/usr/themes/</code>。
3. 在 Typecho 后台进入“控制台 → 外观”，启用 **Ato Paper**。
4. 进入“设置外观”，填写首页内容、社交链接、备案号和需要的功能开关。

### 从旧版本升级

覆盖上传主题文件即可。主题设置保存在 Typecho 数据库中，通常不会因为替换文件而丢失。

升级前建议：

- 备份当前主题文件和 Typecho 数据库
- 记录自定义 CSS、模板修改和第三方插件配置
- 如果手机桌面已经安装过旧版本，升级后先卸载旧图标，再用 Chrome 重新安装

主题脚本和样式会自动附带当前版本号，覆盖升级后浏览器会请求新资源。

## 开始使用

### 创建碎碎念页面

1. 在“管理 → 分类”中新建分类，例如名称填写“碎碎念”，缩略名填写 <code>murmurs</code>。
2. 新建或编辑独立页面，标题填写“碎碎念”，选择自定义模板“碎碎念”。
3. 在“设置外观 → 碎碎念分类”中选择该分类，并确认“碎碎念页面地址”指向页面地址。
4. 以后像写普通文章一样发布内容，放入“碎碎念”分类即可。

碎碎念仍然是 Typecho 原生文章，因此可以使用 Markdown、图片、附件、评论和独立文章地址。“碎碎念每页条数”默认为 8。未选择分类时，主题仍兼容旧版的“日期|标签|标题|正文”文本格式。

如果碎碎念文章没有填写标题，时间流会隐藏 Typecho 的“未命名文档”占位标题。

### 创建友链页面

1. 新建独立页面，标题填写“友链”或“朋友们”。
2. 选择自定义模板“友链页面”。
3. 在“设置外观 → 友链列表”中每行维护一个站点：

~~~text
站点名称|https://example.com/|https://example.com/avatar.png|一句简短的介绍
~~~

头像网址和介绍可以留空。页面正文会作为“交换友链”纸条显示在卡片下方。

### 父子页面导航

在独立页面编辑界面为页面选择父级后，主题会自动建立两层导航。桌面端的父页面标题旁会出现展开入口；手机端会将子页面缩进到父页面下方，并用 L 形连接角表达层级。

普通父页面的正文下方会列出直接子页面，子页面顶部会显示返回父页面的面包屑。建议把常用页面控制在两层以内。

## 文章高级选项

编辑文章或普通独立页面时展开高级选项，可以填写：

- **首页“今天的片段”**：手动填写后优先显示；留空时自动截取正文
- **文章副标题**
- **文章题图 URL**
- **题图说明**
- **章节目录**：手动开启后读取正文中的二级、三级标题，在宽屏右侧显示
- **正文首字放大**：手动开启后只放大正文第一个段落的首字

这些字段都可以留空。目录和首字放大同样支持普通独立页面模板。

## 评论、头像与通知

### 评论联系方式与 QQ 头像

“设置外观 → 评论联系方式”默认使用“自动识别 QQ 或 Email”：

- 访客直接在“联系方式”输入框填写 QQ 号或 Email
- 有效 QQ 会提示“已识别为 QQ”，提交前转换为 <code>QQ号@qq.com</code>
- Email 会使用后台选择的邮箱头像源
- 合法 QQ 邮箱格式的评论会加载腾讯 QQ 头像
- 旧评论、记住的访客信息和嵌套回复不需要迁移

如果不希望接受 QQ，可切换为“仅使用 Email”。Email 提交带有 JavaScript 兜底；QQ 自动识别需要主题脚本。

### 评论表情

评论框下方的“表情”按钮提供三个分类：

- **颜文字**：插入可复制的文本颜文字
- **贴吧泡泡**：插入类似 <code>:huaji:</code> 的安全标记，显示时转换为本地图片
- **Bilibili**：插入类似 <code>{{doge}}</code> 的安全标记，显示时转换为本地精灵表情

标记会以纯文本保存，不需要开放任意评论 HTML。Bilibili 动态表情默认静止，悬停或键盘聚焦时才播放。

### CommentNotifier 回复邮件

主题在 <code>integrations/CommentNotifier/AtoPaper/</code> 中附带三份邮件模板：

- <code>guest.html</code>：访客收到评论回复
- <code>owner.html</code>：文章作者或站长收到新评论
- <code>notice.html</code>：站长收到待审核评论

安装步骤：

1. 从 [jrotty/CommentNotifier](https://github.com/jrotty/CommentNotifier) 获取插件，目录命名为 <code>CommentNotifier</code> 后上传到 <code>/usr/plugins/</code>。
2. 在 Typecho 后台启用插件，配置并测试 SMTP。
3. 将 <code>integrations/CommentNotifier/AtoPaper</code> 复制到 <code>/usr/plugins/CommentNotifier/template/AtoPaper</code>。
4. 在“控制台 → 评论邮件模板”中启用 **Ato Paper**。
5. 回到插件设置，将“表情重载”填写为 <code>ato_comment_notifier_emotes</code>。

QQ 联系方式会以对应 QQ 邮箱接收回复通知。SMTP 密码只保存在插件设置中，不要写进模板文件。

### 头像源

“设置外观 → 评论头像源”提供：

- **Cravatar 国内头像源**：默认选项
- **Gravatar 官方源**
- **自定义兼容头像源**：填写以 <code>/avatar/</code> 结尾的基础地址，或包含 <code>{hash}</code> 的完整模板

“无头像时的默认图”支持 <code>identicon</code>、<code>mp</code>、<code>retro</code> 等内置样式，也支持公开图片直链。SM.MS 适合作为默认图片图床，不提供按邮箱查询头像的能力。

## 图片、代码与 PJAX

### 图片灯箱与文章相册

文章和普通独立页面中的 Markdown 图片会自动组成相册：

~~~markdown
![窗边的下午](https://example.com/photo.jpg)
~~~

如果原图较大，可使用缩略图链接原图：

~~~markdown
[![窗边的下午](https://example.com/photo-thumb.jpg)](https://example.com/photo-original.jpg)
~~~

不需要灯箱的 HTML 图片可添加 <code>data-no-lightbox</code>。灯箱资源随主题本地提供，不依赖外部 CDN，并会在 PJAX 切换后重新初始化。

### 代码高亮

Markdown 代码围栏可以显式写语言，例如 <code>~~~php</code>。没有写语言时，主题会自动识别。Highlight.js 已随主题打包，不依赖 CDN。

### PJAX 页面加载

PJAX 默认开启，可在“设置外观 → PJAX 无刷新加载”中关闭。评论、搜索、下载、站外链接和 Typecho 后台仍使用标准跳转；加载失败时会自动回退到完整页面刷新。

插件如果必须整页执行脚本，可以为链接添加 <code>data-no-pjax</code>，或监听 <code>ato:page-ready</code> 与 <code>ato:pjax:complete</code> 事件。

## 启用主题 404 页面

如果浏览器显示 Nginx 默认 404，请确保当前站点的 <code>server { ... }</code> 使用：

~~~nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
~~~

已有 <code>location /</code> 时请修改原规则，不要重复添加。保存后先运行 <code>nginx -t</code>，确认无误再重新加载 Nginx。主题根目录附带 <code>nginx-typecho.conf.example</code> 供参考。

配置生效后，不存在的地址仍会返回正确的 HTTP 404 状态，但页面内容会使用 Ato Paper 的纸张风设计。

## 移动端安装

主题附带 <code>manifest.json</code>、192px/512px 安装图标；512px 图标同时声明为 maskable。Chrome 安装到桌面后会以 standalone 模式打开，并适配纸张色状态栏、启动背景和设备安全区域。

系统栏最终颜色仍可能受 Android 版本、手机厂商和手势导航设置影响。

## 许可证与致谢

Ato Paper 的原创代码与原创资源采用宽松的 [MIT License](LICENSE)，允许使用、修改、分发、再许可和商业使用，但必须保留版权与许可声明。

发行包不是“全部文件统一 MIT”：

- <code>inc/emotes.php</code>、<code>assets/emotes/tieba/</code> 和 <code>assets/emotes/bilibili/</code> 包含或适配 Sakura 的 GPL v2-or-later 内容
- Highlight.js、GLightbox 与 Noto 字体分别保留各自许可证
- 重新分发完整主题时，请保留 <code>LICENSE</code>、<code>THIRD_PARTY_NOTICES.md</code> 和 <code>licenses/</code> 目录

评论区颜文字清单、贴吧泡泡表情与 Bilibili 表情资源取自 [mashirozx/Sakura](https://github.com/mashirozx/Sakura) 3.x 分支，基于提交 <code>9a7a597ac18219bf4202b76c150bec6c16664b7c</code> 整理并改写为 Typecho 本地选择器。QQ 号转邮箱与 QQ 头像的实现思路也参考了 Sakura。感谢 Mashiro 与 Sakura 项目贡献者。

代码高亮使用 [Highlight.js](https://github.com/highlightjs/highlight.js) 11.11.1 的本地构建版，许可副本见 <code>licenses/highlight.js-BSD-3-Clause.txt</code>。第三方文件和修改边界见 <code>THIRD_PARTY_NOTICES.md</code>。

## 维护方式

本主题是 Ato 与 Codex 通过 vibe coding 完成的个人项目：

- Ato 负责需求、审美取向、内容和实际部署反馈
- Codex 协助设计、实现、检查和迭代
- 仓库不接受 Pull Request、补丁或其他形式的代码合并
- 感兴趣的朋友请直接 Fork，在自己的仓库中自由修改和维护

Issue 或 Discussions 可以用来分享使用情况和想法，但不承诺提供长期兼容性支持。

## 兼容性

- Typecho 1.3.0
- PHP 7.4 或更高版本
- 推荐使用较新的 Chrome、Edge、Firefox 或 Safari

如果你做出了自己的版本，欢迎在项目页面留下链接。
