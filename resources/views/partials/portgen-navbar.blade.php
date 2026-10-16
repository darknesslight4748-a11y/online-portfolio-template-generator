{{-- Shared PortGen navbar. Use @include('partials.portgen-navbar') on Home, Create, Edit, and Choose Template. --}}
@php($navbarSticky = $sticky ?? true)
<div class="pg-navbar {{ $navbarSticky ? '' : 'pg-navbar--static' }}" role="banner">
    <a class="pg-navbar__brand" href="{{ route('home') }}" aria-label="PortGen home">PortGen</a>

    <nav class="pg-navbar__links" aria-label="Main navigation">
        <a href="{{ route('home') }}" @if (request()->routeIs('home')) aria-current="page" @endif>Home</a>
        <a href="{{ route('portfolio.create') }}" @if (request()->routeIs('portfolio.create')) aria-current="page" @endif>Create Portfolio</a>
    </nav>

    <button class="pg-navbar__theme-toggle" id="themeToggleBtn" type="button"
            aria-label="Switch to light mode" title="Switch to light mode" aria-pressed="false">
        <svg class="pg-icon-sun" viewBox="0 0 24 24" width="21" height="21" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true">
            <circle cx="12" cy="12" r="4"></circle><path d="M12 2v2m0 16v2M4.93 4.93l1.42 1.42m11.3 11.3 1.42 1.42M2 12h2m16 0h2M4.93 19.07l1.42-1.42m11.3-11.3 1.42-1.42"></path>
        </svg>
        <svg class="pg-icon-moon" viewBox="0 0 24 24" width="21" height="21" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M20.8 14.2A8.8 8.8 0 0 1 9.8 3.2 9 9 0 1 0 20.8 14.2Z"></path>
        </svg>
    </button>
</div>

<style>
    .pg-navbar, .pg-navbar * { box-sizing: border-box; }
    .pg-navbar {
        position: sticky;
        top: 7px;
        z-index: 1000;
        display: grid;
        grid-template-columns: minmax(0, 1fr) auto minmax(0, 1fr);
        align-items: center;
        gap: 20px;
        width: calc(100% - 10px);
        max-width: 1280px;
        min-height: 70px;
        margin: 7px auto 18px;
        padding: 10px 28px;
        border: 2px solid #25c9ff;
        border-radius: 9px;
        background: rgba(9, 13, 16, .97);
        color: #f7f9fc;
        box-shadow: 0 0 0 1px rgba(37, 201, 255, .08);
        font-family: inherit;
        isolation: isolate;
        transition: background-color .2s ease, color .2s ease, border-color .2s ease, box-shadow .2s ease;
    }
    .pg-navbar--static { position: relative; top: auto; }
    .pg-navbar__brand {
        justify-self: start;
        color: #25c9ff;
        font-size: 24px;
        font-weight: 750;
        letter-spacing: -.045em;
        line-height: 1;
        text-decoration: none;
        white-space: nowrap;
    }
    .pg-navbar__links { display: flex; align-items: center; justify-content: center; gap: clamp(20px, 3vw, 36px); }
    .pg-navbar__links a {
        padding: 8px 0;
        color: #f2f5f7;
        font-size: 14px;
        font-weight: 600;
        line-height: 1.2;
        text-decoration: none;
        white-space: nowrap;
        transition: color 160ms ease;
    }
    .pg-navbar__links a:hover, .pg-navbar__links a:focus-visible, .pg-navbar__links a[aria-current="page"] { color: #25c9ff; }
    .pg-navbar__theme-toggle {
        display: inline-grid;
        place-items: center;
        justify-self: end;
        width: 42px;
        height: 42px;
        padding: 0;
        border: 1px solid rgba(37, 201, 255, .45);
        border-radius: 50%;
        background: #0e151b;
        color: #f7f9fc;
        cursor: pointer;
        transition: background-color 160ms ease, color 160ms ease, border-color 160ms ease, transform 160ms ease;
    }
    .pg-navbar__theme-toggle:hover { transform: translateY(-1px); border-color: #25c9ff; background: rgba(37, 201, 255, .1); color: #25c9ff; }
    .pg-navbar__theme-toggle .pg-icon-moon { display: none; }

    /* Light mode changes the navbar itself, not only the page content. */
    :root[data-theme="light"] .pg-navbar,
    body[data-theme="light"] .pg-navbar {
        background: rgba(248, 250, 252, .97);
        color: #0f172a;
        border-color: #0284c7;
        box-shadow: 0 0 18px rgba(2, 132, 199, .15);
    }
    :root[data-theme="light"] .pg-navbar__brand,
    body[data-theme="light"] .pg-navbar__brand { color: #0284c7; }
    :root[data-theme="light"] .pg-navbar__links a,
    body[data-theme="light"] .pg-navbar__links a { color: #0f172a; }
    :root[data-theme="light"] .pg-navbar__links a:hover,
    :root[data-theme="light"] .pg-navbar__links a:focus-visible,
    :root[data-theme="light"] .pg-navbar__links a[aria-current="page"],
    body[data-theme="light"] .pg-navbar__links a:hover,
    body[data-theme="light"] .pg-navbar__links a:focus-visible,
    body[data-theme="light"] .pg-navbar__links a[aria-current="page"] { color: #0284c7; }
    :root[data-theme="light"] .pg-navbar__theme-toggle,
    body[data-theme="light"] .pg-navbar__theme-toggle { background: #fff; color: #0f172a; border-color: rgba(2, 132, 199, .45); }
    :root[data-theme="light"] .pg-navbar__theme-toggle:hover,
    body[data-theme="light"] .pg-navbar__theme-toggle:hover { background: #eaf7ff; color: #0369a1; border-color: #0284c7; }
    :root[data-theme="light"] .pg-navbar__theme-toggle .pg-icon-sun,
    body[data-theme="light"] .pg-navbar__theme-toggle .pg-icon-sun { display: none; }
    :root[data-theme="light"] .pg-navbar__theme-toggle .pg-icon-moon,
    body[data-theme="light"] .pg-navbar__theme-toggle .pg-icon-moon { display: block; }
    .pg-navbar__theme-toggle:focus-visible, .pg-navbar__links a:focus-visible, .pg-navbar__brand:focus-visible { outline: 2px solid #25c9ff; outline-offset: 4px; }
    @media (max-width: 620px) {
        .pg-navbar { grid-template-columns: minmax(0, 1fr) auto; gap: 8px 14px; padding: 12px 16px; }
        .pg-navbar__brand { font-size: 22px; }
        .pg-navbar__links { grid-column: 1 / -1; grid-row: 2; justify-content: flex-start; gap: 24px; padding-top: 2px; }
        .pg-navbar__links a { font-size: 13px; }
        .pg-navbar__theme-toggle { grid-column: 2; grid-row: 1; width: 38px; height: 38px; }
    }
    @media (prefers-reduced-motion: reduce) { .pg-navbar, .pg-navbar__links a, .pg-navbar__theme-toggle { transition: none; } }
</style>

<script>
(() => {
    const root = document.documentElement;
    const body = document.body;
    const button = document.getElementById('themeToggleBtn');

    function applyPortGenTheme(theme) {
        const normalizedTheme = theme === 'light' ? 'light' : 'dark';
        root.setAttribute('data-theme', normalizedTheme);
        body.setAttribute('data-theme', normalizedTheme);
        root.classList.toggle('dark', normalizedTheme === 'dark');
        root.classList.toggle('light', normalizedTheme === 'light');

        if (button) {
            const nextMode = normalizedTheme === 'dark' ? 'light' : 'dark';
            button.setAttribute('aria-label', `Switch to ${nextMode} mode`);
            button.setAttribute('title', `Switch to ${nextMode} mode`);
            button.setAttribute('aria-pressed', String(normalizedTheme === 'light'));
        }

        try { localStorage.setItem('portgen_theme', normalizedTheme); } catch (error) { /* Storage may be disabled. */ }
        document.dispatchEvent(new CustomEvent('portgen:themechange', { detail: { theme: normalizedTheme } }));
    }

    let savedTheme = 'dark';
    try { savedTheme = localStorage.getItem('portgen_theme') || 'dark'; } catch (error) { /* Use dark mode by default. */ }
    applyPortGenTheme(savedTheme);

    if (button && button.dataset.themeBound !== 'true') {
        button.dataset.themeBound = 'true';
        button.addEventListener('click', () => {
            const current = root.getAttribute('data-theme') || 'dark';
            applyPortGenTheme(current === 'dark' ? 'light' : 'dark');
        });
    }

    window.setPortGenTheme = applyPortGenTheme;
})();
</script>
