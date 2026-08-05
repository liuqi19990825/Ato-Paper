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
