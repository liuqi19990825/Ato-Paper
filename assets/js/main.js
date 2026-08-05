(function () {
  'use strict';

  var root = document.documentElement;
  var body = document.body;
  var themeButton = document.getElementById('theme-toggle');
  var themeLabel = themeButton ? themeButton.querySelector('.theme-label') : null;
  var searchButton = document.getElementById('search-open');
  var searchPanel = document.getElementById('search-panel');
  var searchInput = document.getElementById('search-input');
  var pjaxProgress = document.getElementById('pjax-progress');
  var pjaxAnnouncer = document.getElementById('pjax-announcer');
  var tocCleanup = null;
  var pjaxEnabled = root.getAttribute('data-ato-pjax') === 'true'
    && typeof window.fetch === 'function'
    && typeof window.DOMParser === 'function'
    && typeof window.AbortController === 'function'
    && window.history
    && typeof window.history.pushState === 'function';

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

  function setSearch(open) {
    if (!searchPanel || !searchButton) return;
    searchPanel.classList.toggle('is-open', open);
    searchPanel.setAttribute('aria-hidden', open ? 'false' : 'true');
    searchButton.setAttribute('aria-expanded', open ? 'true' : 'false');
    body.classList.toggle('search-open', open);
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
      link.addEventListener('click', function () { menu.open = false; });
    });
  });

  function dispatch(name, detail) {
    var event;
    try {
      event = new CustomEvent(name, { detail: detail });
    } catch (error) {
      event = document.createEvent('CustomEvent');
      event.initCustomEvent(name, false, false, detail);
    }
    document.dispatchEvent(event);
  }

  function currentResponse() {
    return document.querySelector('.respond-paper[id]');
  }

  var commentController = {
    dom: function (selector) {
      return document.querySelector(selector);
    },

    visiable: function (element, show) {
      if (element) element.style.display = show ? '' : 'none';
    },

    create: function (tag, attributes) {
      var element = document.createElement(tag);
      Object.keys(attributes).forEach(function (key) {
        element.setAttribute(key, attributes[key]);
      });
      return element;
    },

    inputParent: function (response, commentId) {
      var form = response.tagName === 'FORM' ? response : response.querySelector('form');
      if (!form) return;
      var input = form.querySelector('input[name="parent"]');

      if (!input && commentId) {
        input = this.create('input', { type: 'hidden', name: 'parent' });
        form.appendChild(input);
      }

      if (input && commentId) input.value = commentId;
      else if (input) input.remove();
    },

    getChild: function (rootNode, node) {
      if (!node || !node.parentNode) return null;
      if (node.parentNode === rootNode) return node;
      return this.getChild(rootNode, node.parentNode);
    },

    reply: function (htmlId, commentId, button) {
      var response = currentResponse();
      var comment = document.getElementById(htmlId);
      if (!response || !comment) return true;

      this.inputParent(response, commentId);
      var holderId = response.id + '-holder';
      var holder = document.getElementById(holderId);
      if (!holder) {
        holder = this.create('div', { id: holderId, hidden: 'hidden' });
        response.parentNode.insertBefore(holder, response);
      }

      var child = this.getChild(comment, button);
      if (child) comment.insertBefore(response, child.nextSibling);
      else comment.appendChild(response);

      this.visiable(response.querySelector('.cancel-comment-reply a'), true);
      var textarea = response.querySelector('textarea[name="text"]');
      if (textarea) textarea.focus();
      return false;
    },

    cancelReply: function () {
      var response = currentResponse();
      if (!response) return true;
      var holder = document.getElementById(response.id + '-holder');
      this.inputParent(response, false);
      this.visiable(response.querySelector('.cancel-comment-reply a'), false);
      if (!holder || !holder.parentNode) return true;
      holder.parentNode.insertBefore(response, holder);
      return false;
    }
  };

  function initLikeButton(scope) {
    var likeButton = scope.querySelector('[data-like]');
    if (!likeButton || likeButton.getAttribute('data-ato-ready') === 'true') return;
    likeButton.setAttribute('data-ato-ready', 'true');
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

  function initCommentSecurity(scope) {
    var form = scope.querySelector('#comment-form');
    var token = window.atoPaperCommentToken;
    if (!form || !token || form.getAttribute('data-ato-security-ready') === 'true') return;
    form.setAttribute('data-ato-security-ready', 'true');

    function appendToken() {
      if (form.querySelector('input[name="_"]')) return;
      var input = document.createElement('input');
      input.type = 'hidden';
      input.name = '_';
      input.value = token;
      form.appendChild(input);
    }

    ['pointerdown', 'touchstart', 'keydown', 'focusin'].forEach(function (eventName) {
      form.addEventListener(eventName, appendToken, { once: true, passive: eventName === 'touchstart' });
    });
    form.addEventListener('submit', appendToken, { capture: true });
  }

  function initHitokoto(scope) {
    var container = scope.querySelector('[data-hitokoto]');
    if (!container || container.getAttribute('data-ato-ready') === 'true') return;
    container.setAttribute('data-ato-ready', 'true');

    var textNode = container.querySelector('[data-hitokoto-text]');
    var fromNode = container.querySelector('[data-hitokoto-from]');
    var cacheKey = 'ato-paper-hitokoto-v1';

    function render(data) {
      if (!data || typeof data.hitokoto !== 'string' || !data.hitokoto.trim() || !textNode) return false;
      textNode.textContent = '“' + data.hitokoto.trim() + '”';
      var author = typeof data.from_who === 'string' ? data.from_who.trim() : '';
      var work = typeof data.from === 'string' ? data.from.trim() : '';
      var source = author && work ? author + ' · ' + work : (author || work);
      if (fromNode && source) {
        fromNode.textContent = '—— ' + source;
        fromNode.hidden = false;
      }
      return true;
    }

    try {
      var cached = JSON.parse(sessionStorage.getItem(cacheKey) || 'null');
      if (render(cached)) return;
    } catch (error) {}

    if (typeof window.fetch !== 'function' || typeof window.AbortController !== 'function') return;
    var controller = new AbortController();
    var timeout = window.setTimeout(function () { controller.abort(); }, 5000);

    window.fetch('https://v1.hitokoto.cn/?encode=json&charset=utf-8', {
      method: 'GET',
      mode: 'cors',
      signal: controller.signal,
      headers: { Accept: 'application/json' }
    }).then(function (response) {
      if (!response.ok) throw new Error('Hitokoto request failed.');
      return response.json();
    }).then(function (data) {
      window.clearTimeout(timeout);
      if (!render(data)) return;
      try { sessionStorage.setItem(cacheKey, JSON.stringify(data)); } catch (error) {}
    }).catch(function () {
      window.clearTimeout(timeout);
    });
  }

  function initArticleToc(scope) {
    if (tocCleanup) {
      tocCleanup();
      tocCleanup = null;
    }

    var toc = scope.querySelector('[data-article-toc]');
    if (!toc) return;
    var list = toc.querySelector('[data-article-toc-list]');
    var headings = Array.prototype.slice.call(scope.querySelectorAll('.diary-content h2, .diary-content h3'));
    if (!list || !headings.length) {
      toc.hidden = true;
      scope.classList.remove('has-toc');
      return;
    }

    list.textContent = '';
    var links = [];
    headings.forEach(function (heading, index) {
      if (!heading.id) {
        var base = heading.textContent.trim().toLowerCase()
          .replace(/\s+/g, '-')
          .replace(/[^\w\u3400-\u9fff-]/g, '')
          .replace(/^-+|-+$/g, '') || 'section-' + (index + 1);
        var candidate = base;
        var suffix = 2;
        while (document.getElementById(candidate)) {
          candidate = base + '-' + suffix;
          suffix += 1;
        }
        heading.id = candidate;
      }

      var link = document.createElement('a');
      link.href = '#' + encodeURIComponent(heading.id);
      link.textContent = heading.textContent.trim();
      link.setAttribute('data-toc-target', heading.id);
      link.className = heading.tagName === 'H3' ? 'toc-level-3' : 'toc-level-2';
      list.appendChild(link);
      links.push(link);
    });

    function setActive(id) {
      links.forEach(function (link) {
        var active = link.getAttribute('data-toc-target') === id;
        link.classList.toggle('is-active', active);
        if (active) link.setAttribute('aria-current', 'location');
        else link.removeAttribute('aria-current');
      });
    }

    var scheduled = false;
    function update() {
      scheduled = false;
      var current = headings[0];
      headings.forEach(function (heading) {
        if (heading.getBoundingClientRect().top <= 150) current = heading;
      });
      if (window.innerHeight + window.scrollY >= document.documentElement.scrollHeight - 4) current = headings[headings.length - 1];
      setActive(current.id);
    }

    function scheduleUpdate() {
      if (scheduled) return;
      scheduled = true;
      window.requestAnimationFrame(update);
    }

    window.addEventListener('scroll', scheduleUpdate, { passive: true });
    window.addEventListener('resize', scheduleUpdate);
    tocCleanup = function () {
      window.removeEventListener('scroll', scheduleUpdate);
      window.removeEventListener('resize', scheduleUpdate);
    };
    update();
  }

  function initPage(scope) {
    window.TypechoComment = commentController;
    initLikeButton(scope);
    initCommentSecurity(scope);
    initHitokoto(scope);
    initArticleToc(scope);
    dispatch('ato:page-ready', { main: scope, url: window.location.href });
  }

  function activateMainScripts(scope) {
    scope.querySelectorAll('script').forEach(function (oldScript) {
      var script = document.createElement('script');
      Array.prototype.slice.call(oldScript.attributes).forEach(function (attribute) {
        script.setAttribute(attribute.name, attribute.value);
      });
      if (oldScript.src) script.async = false;
      script.textContent = oldScript.textContent;
      oldScript.parentNode.replaceChild(script, oldScript);
    });
  }

  var activeMain = document.querySelector('[data-ato-pjax-main]');
  if (activeMain) initPage(activeMain);

  if (!pjaxEnabled || !activeMain) return;

  var activeRequest = null;
  var navigationSequence = 0;
  var scrollFrame = null;
  var finishTimer = null;
  var dynamicHeadSelector = [
    'meta[name="description"]',
    'meta[name="keywords"]',
    'meta[property^="og:"]',
    'meta[name^="twitter:"]',
    'link[rel="canonical"]',
    'link[rel="prev"]',
    'link[rel="next"]'
  ].join(',');

  try { window.history.scrollRestoration = 'manual'; } catch (error) {}

  function historyState(scrollY) {
    var state = {};
    var current = window.history.state;
    if (current && typeof current === 'object') {
      Object.keys(current).forEach(function (key) { state[key] = current[key]; });
    }
    state.atoPaperPjax = true;
    state.scrollY = Math.max(0, Math.round(scrollY || 0));
    return state;
  }

  function saveScrollPosition() {
    try {
      window.history.replaceState(historyState(window.scrollY), '', window.location.href);
    } catch (error) {}
  }

  saveScrollPosition();
  window.addEventListener('scroll', function () {
    if (scrollFrame !== null) return;
    scrollFrame = window.requestAnimationFrame(function () {
      scrollFrame = null;
      saveScrollPosition();
    });
  }, { passive: true });

  function reducedMotion() {
    return window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  }

  function wait(milliseconds) {
    return new Promise(function (resolve) { window.setTimeout(resolve, milliseconds); });
  }

  function startLoading(main) {
    if (finishTimer !== null) {
      window.clearTimeout(finishTimer);
      finishTimer = null;
    }
    if (pjaxProgress) pjaxProgress.classList.remove('is-finishing');
    body.classList.add('ato-pjax-loading', 'ato-pjax-leaving');
    main.setAttribute('aria-busy', 'true');
  }

  function finishLoading() {
    body.classList.remove('ato-pjax-leaving');
    if (pjaxProgress) pjaxProgress.classList.add('is-finishing');
    finishTimer = window.setTimeout(function () {
      body.classList.remove('ato-pjax-loading');
      if (pjaxProgress) pjaxProgress.classList.remove('is-finishing');
      finishTimer = null;
    }, reducedMotion() ? 0 : 280);
  }

  function syncHead(nextDocument) {
    document.title = nextDocument.title || document.title;
    if (nextDocument.documentElement.lang) root.lang = nextDocument.documentElement.lang;
    document.head.querySelectorAll(dynamicHeadSelector).forEach(function (node) { node.remove(); });
    nextDocument.head.querySelectorAll(dynamicHeadSelector).forEach(function (node) {
      document.head.appendChild(document.importNode(node, true));
    });
  }

  function syncNavigation(nextDocument) {
    var currentLinks = document.querySelectorAll('.desktop-nav a');
    var nextLinks = nextDocument.querySelectorAll('.desktop-nav a');
    currentLinks.forEach(function (link, index) {
      var current = nextLinks[index] && nextLinks[index].classList.contains('current');
      link.classList.toggle('current', Boolean(current));
      if (current) link.setAttribute('aria-current', 'page');
      else link.removeAttribute('aria-current');
    });
  }

  function announcePage() {
    if (!pjaxAnnouncer) return;
    pjaxAnnouncer.textContent = '';
    window.setTimeout(function () {
      pjaxAnnouncer.textContent = '已载入：' + document.title;
    }, 40);
  }

  function focusAndScroll(main, url, restoreScroll) {
    main.setAttribute('tabindex', '-1');
    try { main.focus({ preventScroll: true }); } catch (error) { main.focus(); }

    var hash = '';
    try { hash = url.hash ? decodeURIComponent(url.hash.slice(1)) : ''; } catch (error) { hash = url.hash.slice(1); }
    var target = hash ? document.getElementById(hash) : null;
    if (target) target.scrollIntoView();
    else window.scrollTo(0, typeof restoreScroll === 'number' ? restoreScroll : 0);
  }

  function isPjaxLink(link, url) {
    if (!link || !url || url.origin !== window.location.origin) return false;
    if (link.hasAttribute('download') || link.hasAttribute('data-no-pjax') || link.closest('[data-no-pjax]')) return false;
    var target = link.getAttribute('target');
    if (target && target.toLowerCase() !== '_self') return false;
    if ((link.getAttribute('rel') || '').split(/\s+/).indexOf('external') !== -1) return false;
    if (!/^https?:$/.test(url.protocol)) return false;
    if (/(^|\/)(admin|action)(\/|$)/i.test(url.pathname)) return false;
    if (/\.(?:zip|rar|7z|pdf|xml|json|mp3|mp4|webm|jpe?g|png|gif|webp|avif)$/i.test(url.pathname)) return false;
    if (url.pathname === window.location.pathname && url.search === window.location.search && url.hash) return false;
    if (url.href === window.location.href) return false;
    return true;
  }

  async function navigate(requestUrl, mode, restoreScroll) {
    var sequence = ++navigationSequence;
    var currentMain = document.querySelector('[data-ato-pjax-main]');
    if (!currentMain) {
      window.location.assign(requestUrl.href);
      return;
    }

    if (activeRequest) activeRequest.abort();
    activeRequest = new AbortController();
    var requestController = activeRequest;
    var requestTimedOut = false;
    var requestTimeout = window.setTimeout(function () {
      requestTimedOut = true;
      requestController.abort();
    }, 12000);
    startLoading(currentMain);
    dispatch('ato:pjax:before', { url: requestUrl.href, main: currentMain });

    var fade = wait(reducedMotion() ? 0 : 110);

    try {
      var response = await window.fetch(requestUrl.href, {
        credentials: 'same-origin',
        redirect: 'follow',
        signal: requestController.signal,
        headers: {
          Accept: 'text/html,application/xhtml+xml',
          'X-Requested-With': 'AtoPaper-PJAX'
        }
      });

      var contentType = response.headers.get('content-type') || '';
      if (!response.ok || contentType.indexOf('text/html') === -1) throw new Error('PJAX response is not HTML.');

      var html = await response.text();
      var nextDocument = new DOMParser().parseFromString(html, 'text/html');
      var parsedMain = nextDocument.querySelector('[data-ato-pjax-main]');
      if (!parsedMain) throw new Error('PJAX main container is missing.');

      await fade;
      window.clearTimeout(requestTimeout);
      if (sequence !== navigationSequence) return;

      var finalUrl = new URL(response.url || requestUrl.href, window.location.href);
      if (finalUrl.origin !== window.location.origin) throw new Error('PJAX redirected outside this site.');
      finalUrl.hash = requestUrl.hash;

      if (mode === 'push') {
        window.history.pushState(historyState(0), '', finalUrl.href);
      } else if (finalUrl.href !== window.location.href) {
        window.history.replaceState(historyState(restoreScroll || 0), '', finalUrl.href);
      }

      syncHead(nextDocument);
      syncNavigation(nextDocument);
      window.atoPaperCommentToken = null;

      var nextMain = document.importNode(parsedMain, true);
      currentMain.parentNode.replaceChild(nextMain, currentMain);
      activateMainScripts(nextMain);
      initPage(nextMain);
      nextMain.removeAttribute('aria-busy');
      nextMain.classList.add('ato-pjax-entering');

      body.classList.remove('ato-pjax-leaving');
      focusAndScroll(nextMain, finalUrl, restoreScroll);
      announcePage();
      activeRequest = null;
      finishLoading();
      dispatch('ato:pjax:complete', { url: finalUrl.href, main: nextMain });

      window.setTimeout(function () { nextMain.classList.remove('ato-pjax-entering'); }, 360);
    } catch (error) {
      window.clearTimeout(requestTimeout);
      if (sequence !== navigationSequence || (error.name === 'AbortError' && !requestTimedOut)) return;
      body.classList.remove('ato-pjax-leaving');
      currentMain.removeAttribute('aria-busy');
      activeRequest = null;
      finishLoading();
      dispatch('ato:pjax:error', { url: requestUrl.href, error: error });
      if (mode === 'pop') window.location.reload();
      else window.location.assign(requestUrl.href);
    }
  }

  document.addEventListener('click', function (event) {
    if (event.defaultPrevented || event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;
    var target = event.target;
    var link = target && target.closest ? target.closest('a[href]') : null;
    if (!link) return;

    var url;
    try { url = new URL(link.href, window.location.href); } catch (error) { return; }
    if (!isPjaxLink(link, url)) return;

    event.preventDefault();
    saveScrollPosition();
    navigate(url, 'push', null);
  });

  window.addEventListener('popstate', function (event) {
    var restoreScroll = event.state && typeof event.state.scrollY === 'number' ? event.state.scrollY : 0;
    navigate(new URL(window.location.href), 'pop', restoreScroll);
  });

  window.addEventListener('pagehide', saveScrollPosition);
}());
