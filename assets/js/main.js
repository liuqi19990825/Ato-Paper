(function () {
  'use strict';

  var root = document.documentElement;
  var themeButton = document.getElementById('theme-toggle');
  var themeLabel = themeButton ? themeButton.querySelector('.theme-label') : null;

  function currentTheme() {
    return root.getAttribute('data-theme') === 'dark' ? 'dark' : 'light';
  }

  function updateThemeButton() {
    if (!themeButton) return;
    var isDark = currentTheme() === 'dark';
    themeButton.setAttribute('aria-pressed', isDark ? 'true' : 'false');
    themeButton.setAttribute('aria-label', isDark ? '切换到浅色模式' : '切换到深色模式');
    if (themeLabel) themeLabel.textContent = isDark ? '浅色' : '深色';
  }

  if (themeButton) {
    updateThemeButton();
    themeButton.addEventListener('click', function () {
      var next = currentTheme() === 'dark' ? 'light' : 'dark';
      if (next === 'dark') root.setAttribute('data-theme', 'dark');
      else root.removeAttribute('data-theme');

      try { localStorage.setItem('ato-paper-theme', next); } catch (error) {}
      updateThemeButton();
    });
  }

  var searchButton = document.getElementById('search-open');
  var searchPanel = document.getElementById('search-panel');
  var searchInput = document.getElementById('search-input');

  function setSearch(open) {
    if (!searchPanel || !searchButton) return;
    searchPanel.classList.toggle('is-open', open);
    searchPanel.setAttribute('aria-hidden', open ? 'false' : 'true');
    searchButton.setAttribute('aria-expanded', open ? 'true' : 'false');
    document.body.classList.toggle('search-open', open);
    if (open && searchInput) window.setTimeout(function () { searchInput.focus(); }, 80);
    if (!open) searchButton.focus();
  }

  if (searchButton && searchPanel) {
    searchButton.addEventListener('click', function () { setSearch(true); });
    searchPanel.querySelectorAll('[data-search-close]').forEach(function (button) {
      button.addEventListener('click', function () { setSearch(false); });
    });
    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape' && searchPanel.classList.contains('is-open')) setSearch(false);
    });
  }

  document.querySelectorAll('.mobile-menu').forEach(function (menu) {
    var summary = menu.querySelector('summary');
    menu.addEventListener('toggle', function () {
      if (summary) summary.setAttribute('aria-label', menu.open ? '关闭菜单' : '打开菜单');
    });

    menu.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        menu.open = false;
      });
    });
  });

  var likeButton = document.querySelector('[data-like]');
  if (likeButton) {
    var likeKey = 'ato-paper-liked-' + likeButton.getAttribute('data-post-id');
    try {
      if (localStorage.getItem(likeKey) === '1') {
        likeButton.classList.add('is-liked');
        likeButton.textContent = '♥ 已经喜欢';
      }
    } catch (error) {}

    likeButton.addEventListener('click', function () {
      var liked = likeButton.classList.toggle('is-liked');
      likeButton.textContent = liked ? '♥ 已经喜欢' : '♡ 喜欢这篇文章';
      try { localStorage.setItem(likeKey, liked ? '1' : '0'); } catch (error) {}
    });
  }
}());
