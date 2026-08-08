# Third-party notices

## Sakura comment emotes

- Project: Sakura — A Wonderful WordPress Theme
- Authors: Mashiro and Sakura contributors
- Source: https://github.com/mashirozx/Sakura
- Branch: `3.x`
- Source commit: `9a7a597ac18219bf4202b76c150bec6c16664b7c`
- License: GNU General Public License version 2
- License copy: `licenses/Sakura-GPL-2.0.txt`

Files copied from Sakura:

- `images/smilies/*.gif` → `assets/emotes/tieba/*.gif`
- `images/smilies/bili/*.png` → `assets/emotes/bilibili/*.png`

The image files are redistributed locally without visual modification. Ato Paper reorganizes their paths and uses an original Typecho/PHP/JavaScript renderer and accessible picker UI. The kaomoji list and compatible token names were adapted from Sakura's comment panel so existing Sakura-style markers remain familiar.

Sakura's QQ comment flow was also consulted as an implementation reference. Ato Paper independently implements the Typecho-specific conversion from a QQ number to a synthetic QQ email and uses the QQ avatar endpoint when rendering matching comments; no Sakura PHP or JavaScript code is copied for this feature.

Thank you to Mashiro and every Sakura contributor for making these resources available.

## Highlight.js

- Project: Highlight.js
- Authors: Highlight.js contributors
- Source: https://github.com/highlightjs/highlight.js
- Browser build source: https://github.com/highlightjs/cdn-release
- Version: `11.11.1`
- License: BSD 3-Clause License
- License copy: `licenses/highlight.js-BSD-3-Clause.txt`

Bundled file:

- `assets/vendor/highlight.min.js`

Ato Paper uses the upstream browser build for syntax parsing and automatic language detection. The paper-style toolbar, token palette, copy interaction and PJAX initialization are original theme code.

## GLightbox

- Project: GLightbox
- Author: Biati Digital and GLightbox contributors
- Source: https://github.com/biati-digital/glightbox
- Version: `3.3.1`
- License: MIT License
- License copy: `licenses/GLightbox-MIT.txt`

Bundled files:

- `assets/vendor/glightbox.min.css`
- `assets/vendor/glightbox.min.js`

Ato Paper uses the unmodified upstream distribution files for image viewing, touch and keyboard navigation, and zooming. Automatic Markdown image grouping, PJAX lifecycle integration, captions, accessibility labels and the paper-style presentation are original theme code.

## Noto Serif SC and Noto Sans SC

- Project: Google Fonts / Noto CJK
- Sources: https://github.com/google/fonts/tree/main/ofl/notoserifsc and https://github.com/google/fonts/tree/main/ofl/notosanssc
- Webfont CSS snapshots: Noto Serif SC v35 and Noto Sans SC v40
- Format: Variable WOFF2, split by upstream `unicode-range`
- License: SIL Open Font License 1.1
- License copy: `licenses/Noto-SIL-OFL-1.1.txt`

The files under `assets/fonts/` are self-hosted copies of the Google Fonts variable webfont slices. Their URLs were rewritten to local relative paths without modifying glyph outlines. The theme preloads only the Latin base slices; browsers fetch additional slices according to the characters used by each page.

## CommentNotifier compatibility

The optional files under `integrations/CommentNotifier/` are original Ato Paper email templates designed for the public template-placeholder interface of [jrotty/CommentNotifier](https://github.com/jrotty/CommentNotifier). The CommentNotifier plugin itself is not bundled with this theme and remains licensed and distributed by its author under GPL-3.0.
