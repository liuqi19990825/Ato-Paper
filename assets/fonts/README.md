# Ato Paper fonts

Ato Paper self-hosts the variable webfont builds of:

- Noto Serif SC (`200–900`) for articles, headings and the site brand
- Noto Sans SC (`100–900`) for navigation, metadata, forms and interface labels

The WOFF2 files and `unicode-range` declarations were obtained from the official Google Fonts CSS endpoints on 2026-08-08:

- Noto Serif SC v35
- Noto Sans SC v40

Each family is divided into 101 slices. The browser downloads only slices whose declared ranges intersect characters on the current page. `fonts.css` references only local files; visiting the blog does not contact Google Fonts.

Both families are distributed under the SIL Open Font License 1.1. See `../../licenses/Noto-SIL-OFL-1.1.txt` and the theme's `THIRD_PARTY_NOTICES.md`.
