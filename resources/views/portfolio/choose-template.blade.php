@php
    $previewName = trim((string) ($portfolio->full_name ?? '')) ?: 'Your Name';
    $previewInitial = mb_strtoupper(mb_substr($previewName, 0, 1));
    $previewPhoto = !empty($portfolio->profile_picture)
        ? asset('storage/' . ltrim($portfolio->profile_picture, '/'))
        : null;
    $previewData = [
        'name' => $previewName,
        'email' => (string) ($portfolio->email ?? ''),
        'phone' => (string) ($portfolio->contact_number ?? ''),
        'address' => (string) ($portfolio->address ?? ''),
        'about' => (string) ($portfolio->about_me ?? ''),
        'education' => (string) ($portfolio->education ?? ''),
        'skills' => (string) ($portfolio->skills ?? ''),
        'experience' => (string) ($portfolio->work_experience ?? ''),
        'projects' => (string) ($portfolio->projects ?? ''),
        'links' => (string) ($portfolio->social_links ?? ''),
        'photo' => $previewPhoto,
    ];
@endphp

<!DOCTYPE html>
<html data-theme="dark" lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   PortGen - Choose Your Portfolio Template
  </title>
  <link href="https://fonts.googleapis.com/" rel="preconnect"/>
  <link crossorigin="" href="https://fonts.gstatic.com/" rel="preconnect"/>
  <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&amp;family=Mako&amp;family=Sansation:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&amp;display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
  <style>
   
:root[data-theme="dark"] {
    --bg-color:#0c0e12;
    --grid-line:rgba(255,255,255,.08);
    --text-main:#fff;
    --text-muted:#d1d5db;
    --accent-blue:#38bdf8;
    --accent-glow:rgba(56,189,248,.35);
    --nav-bg:rgba(12,14,18,.85);
    --nav-border:#38bdf8;
    --btn-bg:rgba(20,20,25,.85);
    --btn-border:rgba(56,189,248,.4);
    --card-bg:rgba(18,20,26,.45);
    --card-border:rgba(56,189,248,.35);

}

:root[data-theme="light"] {
    --bg-color:#f8fafc;
    --grid-line:rgba(0,0,0,.08);
    --text-main:#0f172a;
    --text-muted:#475569;
    --accent-blue:#0284c7;
    --accent-glow:rgba(2,132,199,.25);
    --nav-bg:rgba(255,255,255,.9);
    --nav-border:#0284c7;
    --btn-bg:rgba(255,255,255,.9);
    --btn-border:rgba(2,132,199,.4);
    --card-bg:rgba(255,255,255,.75);
    --card-border:rgba(2,132,199,.3);

}

* {
    box-sizing:border-box;
    margin:0;
    padding:0;
    transition:background-color .3s ease,color .3s ease,border-color .3s ease
}

html {
    overflow-y:scroll;
    scrollbar-gutter:stable
}

body {
    background:var(--bg-color);
    color:var(--text-main);
    font-family:'Lora',serif;
    min-height:100vh;
    display:flex;
    flex-direction:column;
    align-items:center;
    overflow-x:hidden;
    position:relative
}

/* Animated background */ .grid-container {
    position:fixed;
    inset:0;
    z-index:1;
    pointer-events:none;
    overflow:hidden
}

.animated-grid {
    position:absolute;
    width:200%;
    height:200%;
    left:-50%;
    top:-50%;
    background-image:linear-gradient(to right,var(--grid-line) 1px,transparent 1px),linear-gradient(to bottom,var(--grid-line) 1px,transparent 1px);
    background-size:48px 48px;
    animation:scrollGrid 18s linear infinite
}

@keyframes scrollGrid {
    to {
        transform:translate(48px,48px)
    }

}

#waveCanvas {
    display:block;
    position:fixed;
    inset:0;
    width:100vw;
    height:100vh;
    z-index:2;
    pointer-events:none
}

/* The main PortGen navbar is styled by the shared .pg-navbar partial.
   Do not style generic header/nav elements here: the live portfolio previews
   contain their own headers and navigation bars. */

.logo {
    font-family:'Sansation',sans-serif;
    font-size:26px;
    font-weight:700;
    color:var(--accent-blue);
    letter-spacing:.5px;
    text-decoration:none
}

.nav-links {
    display:flex;
    align-items:center;
    gap:32px;
    list-style:none
}

.nav-links a {
    color:var(--text-main);
    text-decoration:none;
    font-family:'Sansation',sans-serif;
    font-size:16px;
    font-weight:700;
    position:relative;
    padding:4px 0
}

.nav-links a:hover,.nav-links a.active {
    color:var(--accent-blue)
}

.nav-links a::after {
    content:'';
    position:absolute;
    bottom:-2px;
    left:0;
    width:100%;
    height:2px;
    background:var(--accent-blue);
    border-radius:2px;
    transform:scaleX(0);
    transform-origin:left;
    transition:transform .35s ease
}

.nav-links a.active::after {
    transform:scaleX(1)
}

/* Theme toggle */ .theme-toggle {
    width:42px;
    height:42px;
    border-radius:50%;
    border:1px solid var(--card-border);
    background:var(--card-bg);
    color:var(--text-main);
    cursor:pointer;
    display:grid;
    place-items:center;
    padding:0;
    position:relative
}

.theme-toggle svg {
    width:20px;
    height:20px;
    position:absolute;
    fill:none;
    stroke:currentColor;
    stroke-width:2;
    stroke-linecap:round;
    stroke-linejoin:round;
    transition:opacity .3s ease,transform .5s ease
}

.theme-toggle .icon-moon {
    opacity:0;
    transform:rotate(-90deg) scale(.5)
}

:root[data-theme="light"] .theme-toggle .icon-sun {
    opacity:0;
    transform:rotate(90deg) scale(.5)
}

:root[data-theme="light"] .theme-toggle .icon-moon {
    opacity:1;
    transform:none
}

.theme-toggle:hover {
    transform:scale(1.08);
    color:var(--accent-blue);
    border-color:var(--accent-blue);
    box-shadow:0 0 14px var(--accent-glow)
}

/* Shared */ .glass-card {
    position:relative;
    background:var(--card-bg);
    backdrop-filter:blur(16px);
    -webkit-backdrop-filter:blur(16px);
    border:1.5px solid var(--card-border);
    box-shadow:0 30px 60px rgba(0,0,0,.3),0 0 25px var(--accent-glow);
    border-radius:24px;
    overflow:hidden
}

.btn-primary {
    font-family:'Sansation',sans-serif;
    font-size:15px;
    font-weight:700;
    color:var(--text-main);
    background:var(--btn-bg);
    border:1px solid var(--btn-border);
    padding:12px 36px;
    border-radius:8px;
    cursor:pointer;
    transition:all .3s ease;
    box-shadow:0 4px 20px rgba(0,0,0,.4)
}

.btn-primary:hover {
    border-color:var(--accent-blue);
    color:var(--accent-blue);
    box-shadow:0 0 20px var(--accent-glow);
    transform:translateY(-2px)
}

@keyframes fadeUp {
    from {
        opacity:0;
        transform:translateY(8px)
    }

    to {
        opacity:1;
        transform:none
    }

}

/* Templates */ .templates-wrapper {
    position:relative;
    z-index:10;
    max-width:1180px;
    width:100%;
    margin:40px auto;
    padding:0 20px 80px;
    display:flex;
    flex-direction:column;
    gap:28px;
    animation:fadeUp .4s ease
}

.hero-text-create {
    text-align:center;
    margin-bottom:10px
}

.hero-text-create h1 {
    font-size:2.2rem;
    font-weight:700;
    margin-bottom:8px;
    font-family:'Sansation',sans-serif
}

.tpl-grid {
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:28px
}

.tpl-card {
    padding:24px;
    display:flex;
    flex-direction:column;
    gap:24px;
    transition:transform .3s ease,border-color .3s ease,box-shadow .3s ease
}

.tpl-card:hover,.tpl-card.selected {
    border-color:var(--accent-blue);
    transform:translateY(-4px);
    box-shadow:0 0 25px var(--accent-glow)
}

.tpl-card h3 {
    font-family:'Sansation',sans-serif;
    font-size:1.25rem;
    margin-bottom:6px
}

.tpl-card p.desc {
    font-size:.8rem;
    line-height:1.6;
    color:var(--text-muted);
    min-height:4.8em
}

.tpl-info {
    display:flex;
    flex-direction:column
}

.tpl-frame {
    flex:1;
    display:flex;
    flex-direction:column;
    background:#10141d;
    border:1px solid rgba(56,189,248,.25);
    border-radius:12px;
    padding:14px;
    cursor:pointer
}

.tpl-btns {
    display:flex;
    gap:10px;
    margin-top:18px
}

.tpl-btns .btn-primary {
    flex:1;
    padding:12px 8px;
    white-space:nowrap
}

.back-link {
    align-self:flex-start;
    font-size:.85rem;
    color:var(--text-muted);
    text-decoration:none
}

.back-link:hover {
    color:var(--accent-blue);
    text-decoration:underline
}

/* Mini previews on the cards */ .pv {
    flex:1;
    border-radius:8px;
    overflow:hidden;
    font-family:Arial,sans-serif;
    font-size:8px;
    line-height:1.4;
    display:flex;
    flex-direction:column;
    gap:8px;
    padding:12px
}

.pv-nav {
    display:flex;
    justify-content:space-between;
    align-items:center;
    font-weight:700;
    font-size:9px
}

.pv-nav i {
    font-style:normal;
    font-weight:400;
    font-size:7px;
    margin-left:6px
}

.pv-brand {
    display:flex;
    align-items:center;
    gap:5px
}

.pv-av {
    display:grid;
    place-items:center;
    font-weight:900;
    flex-shrink:0
}

.pv .ln {
    height:4px;
    border-radius:3px;
    margin-top:5px
}

.pv strong {
    display:block;
    font-size:12px;
    font-weight:800
}

.pv small {
    display:block;
    font-size:7px;
    font-weight:700;
    letter-spacing:1px
}

.pv-g {
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:6px
}

.pv-g3 {
    display:grid;
    grid-template-columns:1fr 1fr 1fr;
    gap:6px
}

.pv-box {
    padding:7px;
    border:1px solid;
    font-weight:700;
    font-size:7px
}

.pv-pill {
    display:inline-block;
    padding:2px 7px;
    border-radius:99px;
    font-size:7px;
    margin:0 3px 0 0
}

.pv-btn {
    display:inline-block;
    width:max-content;
    padding:4px 9px;
    border-radius:5px;
    font-size:7px;
    font-weight:700
}

.pv-photo {
    flex-shrink:0;
    display:grid;
    place-items:center;
    font-weight:700
}

/* Professional */ .pv-pro {
    background:#fff;
    color:#26364d;
    border:1px solid #e8edf4
}

.pv-pro .pv-nav {
    padding-bottom:7px;
    border-bottom:1px solid #e8edf4;
    color:#183153
}

.pv-pro .pv-nav i {
    color:#536176
}

.pv-pro .pv-av {
    width:16px;
    height:16px;
    border-radius:50%;
    background:#183153;
    color:#fff;
    font-size:8px
}

.pv-pro .pv-hero {
    display:flex;
    gap:9px;
    align-items:center;
    padding:9px;
    background:linear-gradient(120deg,#f8fbff,#fff);
    border-radius:6px
}

.pv-pro .pv-photo {
    width:34px;
    height:40px;
    border-radius:6px;
    background:#dce7f5;
    color:#183153;
    font-size:15px
}

.pv-pro small {
    color:#2875e8
}

.pv-pro strong {
    color:#183153
}

.pv-pro .ln {
    background:#e5edf7
}

.pv-pro .pv-box {
    border-color:#e5edf7;
    border-radius:6px;
    color:#183153
}

.pv-pro .pv-pill {
    background:#edf4ff;
    color:#245da8
}

.pv-pro .pv-share {
    margin-top:auto;
    padding:7px 9px;
    border-radius:6px;
    background:#203d60;
    color:#fff;
    font-weight:700;
    font-size:8px
}

/* Modern */ .pv-mod {
    background:#fff;
    color:#202938;
    border:1px solid #eee
}

.pv-mod .pv-nav {
    padding-bottom:7px;
    border-bottom:1px solid #eee;
    color:#111827
}

.pv-mod .pv-nav i {
    color:#4b5563
}

.pv-mod .pv-hero {
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:8px;
    padding:10px;
    background:#f8f9ff;
    border-radius:6px
}

.pv-mod small {
    color:#635bff;
    text-transform:uppercase
}

.pv-mod .pv-photo {
    width:38px;
    height:38px;
    border-radius:11px;
    background:#e0ddff;
    color:#5146d8;
    border:2px solid #fff;
    box-shadow:0 5px 14px #dfe3f5;
    font-size:15px
}

.pv-mod .pv-btn {
    background:#635bff;
    color:#fff;
    margin-top:5px
}

.pv-mod .pv-head {
    font-weight:700;
    font-size:9px
}

.pv-mod .pv-box {
    background:#f8f9fc;
    border-color:#eceef4;
    border-top:3px solid #635bff;
    border-radius:6px;
    color:#202938
}

.pv-mod .ln {
    background:#d6d9e4
}

.pv-mod .pv-pill {
    background:#f3f1ff;
    color:#5146d8;
    border:1px solid #e0ddff
}

/* Creative */ .pv-cre {
    background:#f8f5ef;
    color:#242424;
    border:1px solid #e7e0d5
}

.pv-cre .pv-brand span {
    color:#ff5b35
}

.pv-cre .pv-nav i {
    color:#444;
    font-weight:700
}

.pv-cre .pv-tag {
    display:inline-block;
    width:max-content;
    background:#d7f36b;
    padding:3px 8px;
    border-radius:99px;
    font-size:7px;
    font-weight:700;
    transform:rotate(-2deg)
}

.pv-cre .pv-hero {
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:8px
}

.pv-cre strong {
    font-size:15px;
    line-height:1;
    letter-spacing:-1px;
    font-weight:900
}

.pv-cre strong span {
    color:#ff5b35
}

.pv-cre .pv-photo {
    width:40px;
    height:44px;
    border-radius:50% 50% 5px 5px;
    background:#d7f36b;
    border:5px solid #ffccba;
    font-size:15px;
    font-weight:900;
    transform:rotate(2deg)
}

.pv-cre .pv-btn {
    background:#242424;
    color:#fff;
    border:1.5px solid #242424
}

.pv-cre .pv-btn.o {
    background:transparent;
    color:#242424;
    margin-left:4px
}

.pv-cre .pv-head {
    font-weight:900;
    font-size:10px
}

.pv-cre .pv-box {
    border:1.5px solid #242424;
    border-radius:6px;
    color:#242424
}

.pv-cre .b1 {
    background:#ffccba;
    transform:rotate(-1deg)
}

.pv-cre .b2 {
    background:#dce7ff;
    transform:rotate(1deg)
}

.pv-cre .ln {
    background:#242424
}

.pv-cre .pv-pill {
    border:1.5px solid #242424;
    border-radius:5px;
    background:#d7f36b;
    font-weight:700
}

/* Full preview window: place it above the shared sticky navbar while open. */
.pv-overlay {
    position:fixed;
    inset:0;
    z-index:10001;
    background:rgba(0,0,0,.75);
    backdrop-filter:blur(8px);
    display:flex;
    align-items:center;
    justify-content:center;
    padding:20px;
    opacity:0;
    pointer-events:none;
    transition:opacity .3s ease
}

.pv-overlay.open {
    opacity:1;
    pointer-events:auto
}

.pv-win {
    width:min(1000px,100%);
    height:min(88vh,100%);
    display:flex;
    flex-direction:column;
    transform:translateY(12px);
    transition:transform .3s ease
}

.pv-overlay.open .pv-win {
    transform:none
}

.pv-top {
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:12px;
    padding:14px 20px;
    border-bottom:1px solid var(--card-border);
    flex-wrap:wrap
}

.pv-top h3 {
    font-family:'Sansation',sans-serif;
    font-size:1.1rem
}

.pv-top small {
    display:block;
    color:var(--text-muted);
    font-size:.75rem;
    margin-top:2px
}

.pv-actions {
    display:flex;
    gap:10px
}

.pv-actions .btn-primary {
    padding:9px 20px;
    font-size:14px
}

.pv-body {
    flex:1;
    overflow-y:auto;
    background:#fff
}

.pv-body {
    overflow-x:hidden
}

.pp {
    min-height:100%;
    font-family:Arial,sans-serif;
    line-height:1.6
}

.pp a {
    text-decoration:none;
    cursor:default
}

/* Professional */ .pp-pro {
    background:#fff;
    color:#26364d
}

.pp-pro .nav {
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:16px;
    padding:18px 5%;
    border-bottom:1px solid #e8edf4;
    flex-wrap:wrap
}

.pp-pro .brand {
    display:flex;
    align-items:center;
    gap:12px;
    font-weight:700;
    font-size:18px;
    color:#183153;
    overflow-wrap:anywhere
}

.pp-pro .bi {
    width:40px;
    height:40px;
    border-radius:50%;
    background:#183153;
    color:#fff;
    display:grid;
    place-items:center;
    flex-shrink:0
}

.pp-pro .nl {
    display:flex;
    gap:18px;
    flex-wrap:wrap;
    font-size:13px;
    color:#536176
}

.pp-pro .hero {
    display:grid;
    grid-template-columns:.85fr 1.4fr .8fr;
    gap:30px;
    align-items:center;
    padding:44px 5%;
    background:linear-gradient(120deg,#f8fbff,#fff)
}

.pp-pro .pw {
    background:#eaf1fb;
    padding:14px;
    border-radius:25px;
    width:fit-content;
    max-width:100%
}

.pp-pro .ph {
    width:170px;
    height:200px;
    display:grid;
    place-items:center;
    border-radius:12px;
    background:#dce7f5;
    color:#183153;
    font-size:56px;
    font-weight:700
}

.pp-pro .eb {
    color:#2875e8;
    font-size:12px;
    letter-spacing:2px;
    font-weight:700
}

.pp-pro h1 {
    font-size:clamp(28px,4vw,40px);
    line-height:1.2;
    color:#183153;
    margin:8px 0;
    overflow-wrap:anywhere
}

.pp-pro .hd {
    color:#61718a;
    margin:10px 0 16px;
    white-space:pre-line;
    overflow-wrap:anywhere
}

.pp-pro .ci {
    display:flex;
    flex-wrap:wrap;
    gap:6px 16px;
    font-size:13px;
    color:#455670;
    overflow-wrap:anywhere
}

.pp-pro .hn {
    color:#2875e8;
    font-size:22px;
    font-weight:700;
    line-height:1.4
}

.pp-pro .hn span {
    display:block;
    margin-top:10px;
    width:75px;
    height:4px;
    background:#2875e8
}

.pp-pro .cg {
    display:grid;
    grid-template-columns:repeat(3,minmax(0,1fr));
    gap:16px;
    padding:8px 5% 24px
}

.pp-pro .card {
    padding:20px;
    border:1px solid #e5edf7;
    border-radius:12px;
    box-shadow:0 4px 14px rgba(30,60,100,.04);
    overflow-wrap:anywhere
}

.pp-pro .card h2 {
    display:flex;
    align-items:center;
    gap:10px;
    margin-bottom:12px;
    color:#183153;
    font-size:16px
}

.pp-pro .card h2 b {
    color:#2875e8;
    font-size:20px
}

.pp-pro .card p {
    color:#61718a;
    font-size:14px;
    white-space:pre-line
}

.pp-pro .sk {
    display:inline-block;
    margin:0 6px 6px 0;
    padding:6px 12px;
    border-radius:20px;
    background:#edf4ff;
    color:#245da8;
    font-size:12px
}

.pp-pro .pi {
    padding:10px 0
}

.pp-pro .pi+.pi {
    border-top:1px solid #e7edf5
}

.pp-pro .pi:first-of-type {
    padding-top:0
}

.pp-pro .pi h3 {
    color:#334b6d;
    font-size:14px;
    margin-bottom:3px
}

.pp-pro .pi p {
    font-size:12px
}

.pp-pro .sl {
    display:flex;
    flex-direction:column;
    gap:10px
}

.pp-pro .sl a {
    color:#2875e8;
    font-size:13px;
    overflow-wrap:anywhere
}

.pp-pro .share {
    display:grid;
    grid-template-columns:1fr 1.5fr auto;
    align-items:center;
    gap:18px;
    margin:0 5% 24px;
    padding:20px;
    border-radius:10px;
    background:#203d60;
    color:#fff
}

.pp-pro .share h2 {
    font-size:16px;
    margin-bottom:4px
}

.pp-pro .share p {
    font-size:12px;
    color:#d5e0ee
}

.pp-pro .sr {
    display:flex;
    gap:8px
}

.pp-pro .sr i {
    flex:1;
    min-width:0;
    padding:10px;
    border-radius:5px;
    background:#fff;
    color:#26364d;
    font-style:normal;
    font-size:12px;
    overflow:hidden;
    text-overflow:ellipsis;
    white-space:nowrap
}

.pp-pro .btn {
    display:inline-block;
    padding:10px 13px;
    border-radius:5px;
    background:#2875e8;
    color:#fff;
    font-size:12px;
    white-space:nowrap
}

.pp-pro .btn.ed {
    background:transparent;
    border:1px solid #7fb0ff
}

.pp-pro .foot {
    padding:18px;
    background:#172d48;
    color:#d5e0ee;
    text-align:center;
    font-size:12px
}

/* Modern */ .pp-mod {
    background:#fff;
    color:#202938
}

.pp-mod .nav {
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:16px;
    padding:18px 7%;
    border-bottom:1px solid #eee;
    flex-wrap:wrap
}

.pp-mod .logo {
    font-size:21px;
    font-weight:700;
    color:#111827;
    overflow-wrap:anywhere
}

.pp-mod .nl {
    display:flex;
    gap:18px;
    flex-wrap:wrap;
    font-size:14px;
    color:#4b5563
}

.pp-mod .hero {
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:36px;
    padding:56px 9%;
    background:#f8f9ff
}

.pp-mod .ht {
    max-width:620px
}

.pp-mod .eb {
    color:#635bff;
    font-weight:700;
    letter-spacing:2px;
    font-size:13px;
    text-transform:uppercase
}

.pp-mod h1 {
    font-size:clamp(32px,5vw,50px);
    line-height:1.15;
    margin:12px 0;
    overflow-wrap:anywhere
}

.pp-mod .ht p {
    color:#626b7a;
    font-size:16px;
    white-space:pre-line;
    overflow-wrap:anywhere
}

.pp-mod .ci {
    display:flex;
    flex-wrap:wrap;
    gap:8px 18px;
    margin-top:18px;
    color:#555e6d;
    font-size:14px;
    overflow-wrap:anywhere
}

.pp-mod .btn {
    display:inline-block;
    margin-top:16px;
    background:#635bff;
    color:#fff;
    border-radius:7px;
    padding:11px 17px;
    font-size:14px
}

.pp-mod .ph {
    width:190px;
    height:190px;
    border-radius:28px;
    border:5px solid #fff;
    box-shadow:0 12px 35px #dfe3f5;
    background:#e0ddff;
    color:#5146d8;
    display:grid;
    place-items:center;
    font-size:64px;
    font-weight:700;
    flex-shrink:0
}

.pp-mod .sec {
    padding:38px 9%
}

.pp-mod .sh span {
    color:#635bff;
    font-size:12px;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:2px
}

.pp-mod .sh h2 {
    font-size:28px;
    margin:5px 0
}

.pp-mod .sh p {
    color:#6b7280;
    margin-bottom:20px
}

.pp-mod .g2 {
    display:grid;
    grid-template-columns:repeat(2,minmax(0,1fr));
    gap:16px
}

.pp-mod .pc {
    padding:22px;
    background:#f8f9fc;
    border:1px solid #eceef4;
    border-radius:12px;
    overflow-wrap:anywhere
}

.pp-mod .pc.top {
    border-top:4px solid #635bff
}

.pp-mod .pc h3 {
    font-size:19px;
    margin-bottom:8px
}

.pp-mod .pc p {
    color:#606a79;
    white-space:pre-line
}

.pp-mod .sk {
    display:inline-block;
    margin:0 8px 8px 0;
    padding:9px 15px;
    border:1px solid #e0ddff;
    border-radius:20px;
    background:#f3f1ff;
    color:#5146d8;
    font-size:14px
}

.pp-mod .sl a {
    display:inline-block;
    color:#635bff;
    margin:5px 14px 5px 0;
    overflow-wrap:anywhere
}

.pp-mod .share {
    margin:10px 9% 38px;
    padding:24px;
    border-radius:12px;
    background:#202938;
    color:#fff
}

.pp-mod .share p {
    color:#d1d5db;
    margin:6px 0 12px
}

.pp-mod .sr {
    display:flex;
    gap:10px
}

.pp-mod .sr i {
    flex:1;
    min-width:0;
    padding:11px;
    border-radius:6px;
    background:#fff;
    color:#202938;
    font-style:normal;
    font-size:13px;
    overflow:hidden;
    text-overflow:ellipsis;
    white-space:nowrap
}

.pp-mod .sr .btn {
    margin-top:0
}

.pp-mod .foot {
    text-align:center;
    padding:20px;
    color:#6b7280;
    border-top:1px solid #eee;
    font-size:13px
}

/* Creative */ .pp-cre {
    background:#f8f5ef;
    color:#242424;
    padding:24px
}

.pp-cre .nav {
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:16px;
    padding:10px 0 20px;
    flex-wrap:wrap
}

.pp-cre .brand {
    font-size:19px;
    font-weight:900;
    overflow-wrap:anywhere
}

.pp-cre .brand span {
    color:#ff5b35
}

.pp-cre .nl {
    display:flex;
    gap:18px;
    flex-wrap:wrap;
    font-size:13px;
    font-weight:700;
    color:#444
}

.pp-cre .hero {
    display:grid;
    grid-template-columns:1fr .9fr;
    gap:30px;
    align-items:center;
    padding:30px 0 44px
}

.pp-cre .tag {
    display:inline-block;
    background:#d7f36b;
    padding:7px 13px;
    border-radius:20px;
    font-size:12px;
    font-weight:700;
    transform:rotate(-2deg)
}

.pp-cre h1 {
    font-size:clamp(40px,6vw,70px);
    line-height:.98;
    letter-spacing:-3px;
    margin:18px 0;
    overflow-wrap:anywhere
}

.pp-cre h1 span {
    color:#ff5b35
}

.pp-cre .hd {
    max-width:520px;
    color:#666;
    white-space:pre-line;
    overflow-wrap:anywhere
}

.pp-cre .btns {
    display:flex;
    flex-wrap:wrap;
    gap:10px;
    margin-top:20px
}

.pp-cre .btn {
    display:inline-block;
    padding:11px 16px;
    border:2px solid #242424;
    border-radius:7px;
    background:#242424;
    color:#fff;
    font-size:13px;
    font-weight:700
}

.pp-cre .btn.o {
    background:transparent;
    color:#242424
}

.pp-cre .ci {
    margin-top:16px;
    font-size:13px;
    color:#666;
    overflow-wrap:anywhere
}

.pp-cre .ci span {
    display:block
}

.pp-cre .pa {
    position:relative;
    padding:18px;
    background:#ffccba;
    border-radius:48% 48% 15px 15px;
    transform:rotate(2deg)
}

.pp-cre .ph {
    height:300px;
    display:grid;
    place-items:center;
    border-radius:48% 48% 12px 12px;
    background:#d7f36b;
    font-size:84px;
    font-weight:900;
    transform:rotate(-2deg)
}

.pp-cre .stk {
    position:absolute;
    right:-10px;
    bottom:22px;
    padding:12px;
    background:#d7f36b;
    border:2px solid #242424;
    border-radius:50%;
    font-size:12px;
    font-weight:900;
    text-align:center;
    transform:rotate(9deg)
}

.pp-cre .sec {
    padding:36px 0
}

.pp-cre .sh {
    display:flex;
    align-items:flex-end;
    justify-content:space-between;
    gap:12px;
    margin-bottom:20px;
    flex-wrap:wrap
}

.pp-cre .sh h2 {
    font-size:clamp(26px,4vw,38px);
    letter-spacing:-1px
}

.pp-cre .sh p {
    color:#777;
    font-size:13px
}

.pp-cre .about {
    padding:28px;
    background:#d7f36b;
    border:2px solid #242424;
    border-radius:12px
}

.pp-cre .about h2 {
    font-size:24px;
    margin-bottom:8px
}

.pp-cre .about p {
    white-space:pre-line;
    overflow-wrap:anywhere
}

.pp-cre .g2 {
    display:grid;
    grid-template-columns:repeat(2,minmax(0,1fr));
    gap:18px
}

.pp-cre .pc {
    padding:24px;
    border:2px solid #242424;
    border-radius:12px;
    background:#fff;
    overflow-wrap:anywhere
}

.pp-cre .pj:nth-child(odd) {
    background:#ffccba;
    transform:rotate(-1deg)
}

.pp-cre .pj:nth-child(even) {
    background:#dce7ff;
    transform:rotate(1deg)
}

.pp-cre .pn {
    color:#ff5b35;
    font-size:13px;
    font-weight:900
}

.pp-cre .pc h3 {
    font-size:20px;
    margin:8px 0
}

.pp-cre .pc p {
    color:#555;
    font-size:13px;
    white-space:pre-line
}

.pp-cre .sk {
    display:inline-block;
    margin:0 8px 8px 0;
    padding:10px 15px;
    background:#fff;
    border:2px solid #242424;
    border-radius:7px;
    font-size:13px;
    font-weight:700
}

.pp-cre .sk:nth-child(3n+1) {
    background:#d7f36b
}

.pp-cre .sk:nth-child(3n+2) {
    background:#ffccba
}

.pp-cre .sl {
    display:flex;
    flex-wrap:wrap;
    gap:10px
}

.pp-cre .sl a {
    padding:11px 15px;
    border:2px solid #242424;
    border-radius:7px;
    background:#fff;
    font-size:13px;
    overflow-wrap:anywhere
}

.pp-cre .share {
    margin:30px 0 16px;
    padding:26px;
    border:2px solid #242424;
    border-radius:12px;
    background:#242424;
    color:#fff
}

.pp-cre .share h2 {
    font-size:22px;
    margin-bottom:4px
}

.pp-cre .share p {
    color:#ddd;
    font-size:13px;
    margin-bottom:12px
}

.pp-cre .sr {
    display:flex;
    gap:10px
}

.pp-cre .sr i {
    flex:1;
    min-width:0;
    padding:11px;
    border-radius:6px;
    background:#fff;
    color:#242424;
    font-style:normal;
    font-size:13px;
    overflow:hidden;
    text-overflow:ellipsis;
    white-space:nowrap
}

.pp-cre .sr .btn {
    background:#d7f36b;
    color:#242424;
    border-color:#d7f36b
}

.pp-cre .foot {
    padding:18px 0;
    text-align:center;
    color:#777;
    font-size:12px
}

@media(max-width:900px) {
    .pp-pro .cg {
        grid-template-columns:repeat(2,minmax(0,1fr))
    }

    .pp-pro .hn {
        display:none
    }

    .pp-pro .hero {
        grid-template-columns:.8fr 1.2fr
    }

    .pp-pro .share {
        grid-template-columns:1fr
    }

}

@media(max-width:700px) {
    .pp-pro .hero,.pp-cre .hero {
        grid-template-columns:1fr
    }

    .pp-pro .hero {
        text-align:center
    }

    .pp-pro .pw {
        margin:auto
    }

    .pp-pro .ci {
        justify-content:center
    }

    .pp-pro .cg,.pp-mod .g2,.pp-cre .g2 {
        grid-template-columns:1fr
    }

    .pp-mod .hero {
        flex-direction:column-reverse;
        align-items:flex-start;
        padding:40px 6%
    }

    .pp-mod .sec {
        padding:32px 6%
    }

    .pp-mod .share {
        margin:10px 6% 30px
    }

    .pp-cre .pj:nth-child(n) {
        transform:none
    }

    .pp-cre .pa {
        max-width:380px;
        width:90%;
        margin:auto
    }

    .pp-cre .sr,.pp-mod .sr {
        flex-direction:column
    }

}

/* Selection modal */ .modal {
    position:fixed;
    inset:0;
    z-index:50;
    display:flex;
    align-items:center;
    justify-content:center;
    background:rgba(0,0,0,.7);
    backdrop-filter:blur(8px);
    opacity:0;
    pointer-events:none;
    transition:opacity .3s ease;
    padding:16px
}

.modal.open {
    opacity:1;
    pointer-events:auto
}

.modal-box {
    max-width:420px;
    width:100%;
    padding:32px;
    text-align:center;
    display:flex;
    flex-direction:column;
    align-items:center;
    gap:16px;
    transform:scale(.95);
    transition:transform .3s ease
}

.modal.open .modal-box {
    transform:scale(1)
}

.modal-box h2 {
    font-family:'Sansation',sans-serif;
    font-size:1.3rem
}

.modal-box p {
    font-size:.85rem;
    line-height:1.6;
    color:var(--text-muted)
}

.check svg {
    fill:none;
    stroke:currentColor;
    stroke-linecap:round;
    stroke-linejoin:round
}

.check {
    width:48px;
    height:48px;
    border-radius:50%;
    display:grid;
    place-items:center;
    color:var(--accent-blue);
    background:var(--accent-glow);
    border:1px solid var(--accent-blue)
}

@media(max-width:900px) {
    .tpl-grid {
        grid-template-columns:1fr
    }

}

@media(max-width:768px) {
    /* Responsive rules for the shared navbar live in its partial. */

    .nav-links {
        gap:14px
    }

    .nav-links a {
        font-size:13px
    }

}

  
/* --------------------------------------------------------------------------
   Accurate design previews for the latest saved Template 1 and Template 2.
   These classes intentionally mirror the real portfolio Blade templates.
   -------------------------------------------------------------------------- */
.pv-pro {
    display:flex;
    flex-direction:column;
    gap:0;
    padding:0;
    background:#fff;
    color:#2b2f4a;
    border:1px solid #c5c9d5;
    border-radius:8px;
}
.pv-pro .mini-pro-banner {
    min-height:46px;
    padding:8px 12px 8px 33%;
    display:flex;
    flex-direction:column;
    justify-content:center;
    background:#262a5c;
    color:#fff;
}
.pv-pro .mini-pro-banner strong {font-size:11px;letter-spacing:1px;text-transform:uppercase;line-height:1.2;}
.pv-pro .mini-pro-banner small {font-size:6px;letter-spacing:1px;color:#e2e5f7;margin-top:3px;}
.pv-pro .mini-pro-layout {display:grid;grid-template-columns:31% minmax(0,1fr);flex:1;min-height:155px;}
.pv-pro .mini-pro-sidebar {padding:0 8px 10px;background:#edf1f3;min-width:0;}
.pv-pro .mini-pro-photo {width:50px;height:50px;margin:-18px auto 9px;display:grid;place-items:center;border:3px solid #fff;border-radius:50%;background:#dbe6f5;color:#262a5c;font-size:19px;font-weight:800;position:relative;z-index:1;}
.pv-pro .mini-pro-sidegroup {margin-bottom:9px;overflow-wrap:anywhere;}
.pv-pro .mini-pro-sidegroup b {display:block;padding-bottom:3px;margin-bottom:3px;border-bottom:1px solid #c5c9d5;color:#262a5c;font-size:7px;text-transform:uppercase;letter-spacing:.6px;}
.pv-pro .mini-pro-sidegroup span {display:block;margin:2px 0;color:#5a5f7a;font-size:6px;line-height:1.4;}
.pv-pro .mini-pro-main {padding:10px 12px 8px;min-width:0;}
.pv-pro .mini-pro-section {position:relative;padding:0 0 8px 18px;margin:0 0 10px;border-bottom:1px solid #edf1f3;}
.pv-pro .mini-pro-section:last-child {border-bottom:0;}
.pv-pro .mini-pro-section:before {content:"";position:absolute;left:5px;top:12px;bottom:-1px;width:1px;background:#c5c9d5;}
.pv-pro .mini-pro-section:after {content:"";position:absolute;left:0;top:0;width:11px;height:11px;border-radius:50%;background:#262a5c;}
.pv-pro .mini-pro-section b {display:block;margin-bottom:3px;color:#262a5c;font-size:7px;letter-spacing:.6px;text-transform:uppercase;}
.pv-pro .mini-pro-section span {display:block;height:3px;margin-top:4px;border-radius:2px;background:#e2e5ef;}
.pv-pro .mini-pro-share {padding:7px 10px;background:#1d2048;color:#fff;font-size:7px;font-weight:700;}
.pv-pro .mini-pro-share em {float:right;font-style:normal;font-weight:400;opacity:.85;}

.pv-mod {
    display:flex;
    flex-direction:column;
    gap:0;
    padding:0;
    background:#f5f7fb;
    color:#151a2d;
    border:1px solid #e2e6f0;
    border-radius:8px;
}
.pv-mod .mini-mod-nav {display:flex;align-items:center;justify-content:space-between;gap:5px;margin:7px 8px 0;padding:5px 7px;border:1px solid #e2e6f0;border-radius:9px;background:rgba(255,255,255,.92);font-size:6px;font-weight:700;}
.pv-mod .mini-mod-brand {display:flex;align-items:center;gap:4px;min-width:0;}
.pv-mod .mini-mod-mark {display:grid;place-items:center;width:15px;height:15px;border-radius:5px;background:#555cf4;color:#fff;font-size:6px;}
.pv-mod .mini-mod-links {white-space:nowrap;color:#687087;font-size:5px;}
.pv-mod .mini-mod-hero {display:grid;grid-template-columns:minmax(0,1fr) 48px;align-items:center;gap:9px;margin:7px 8px 8px;padding:11px 9px;background:radial-gradient(circle at 90% 15%,#e7e9ff,transparent 50%),#fff;border-radius:10px;}
.pv-mod .mini-mod-kicker {display:block;color:#555cf4;font-size:5px;font-weight:800;text-transform:uppercase;letter-spacing:.8px;}
.pv-mod .mini-mod-title {display:block;margin:3px 0;color:#151a2d;font-size:11px;font-weight:800;line-height:1.1;letter-spacing:-.4px;}
.pv-mod .mini-mod-accent {color:#555cf4;}
.pv-mod .mini-mod-copy {display:block;color:#687087;font-size:5px;line-height:1.45;}
.pv-mod .mini-mod-photo {width:44px;height:49px;border:3px solid #fff;border-radius:12px;background:#e7e9ff;box-shadow:0 4px 12px rgba(26,34,71,.12);display:grid;place-items:center;color:#555cf4;font-weight:800;font-size:19px;}
.pv-mod .mini-mod-section {padding:0 9px 8px;}
.pv-mod .mini-mod-label {display:block;color:#555cf4;font-size:5px;font-weight:800;letter-spacing:.7px;text-transform:uppercase;}
.pv-mod .mini-mod-heading {margin:2px 0 5px;font-size:9px;font-weight:800;letter-spacing:-.3px;}
.pv-mod .mini-mod-grid {display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:5px;}
.pv-mod .mini-mod-card {padding:6px;background:#fff;border:1px solid #e2e6f0;border-radius:6px;min-width:0;}
.pv-mod .mini-mod-card:first-child {border-top:3px solid #555cf4;}
.pv-mod .mini-mod-card b {display:block;font-size:6px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
.pv-mod .mini-mod-card span {display:block;height:3px;margin-top:4px;border-radius:2px;background:#e2e6f0;}
.pv-mod .mini-mod-skills {padding:0 9px 8px;}
.pv-mod .mini-mod-pill {display:inline-block;margin:2px 2px 0 0;padding:2px 5px;border:1px solid #e0ddff;border-radius:99px;background:#f3f1ff;color:#5146d8;font-size:5px;}
.pv-mod .mini-mod-share {margin:auto 8px 8px;padding:7px 8px;border-radius:6px;background:#202938;color:#fff;font-size:6px;}
.pv-mod .mini-mod-share span {display:block;color:#d1d5db;font-size:5px;}

/* Full preview: Template 1 mirrors the actual navy banner + gray sidebar layout. */
.pp-pro {padding:0;background:#e6e8ee;color:#2b2f4a;font-family:"Segoe UI",Arial,sans-serif;line-height:1.5;}
.pp-pro .simple-page {max-width:960px;margin:0 auto;background:#fff;overflow:hidden;box-shadow:0 18px 50px rgba(29,32,72,.1);}
.pp-pro .simple-banner {min-height:150px;padding:28px 40px 28px 300px;display:flex;flex-direction:column;align-items:flex-start;justify-content:center;background:#262a5c;color:#fff;}
.pp-pro .simple-banner h1 {font-size:clamp(1.8rem,4vw,2.6rem);letter-spacing:3px;line-height:1.15;text-transform:uppercase;overflow-wrap:anywhere;margin:0;color:#fff;align-self:flex-start;}
.pp-pro .simple-banner p {margin-top:8px;color:#e2e5f7;font-size:1rem;letter-spacing:1.5px;text-transform:uppercase;}
.pp-pro .simple-layout {display:grid;grid-template-columns:260px minmax(0,1fr);}
.pp-pro .simple-sidebar {min-width:0;padding:0 24px 32px;background:#edf1f3;overflow-wrap:anywhere;}
.pp-pro .simple-photo {width:190px;height:190px;margin:-95px 0 28px 10px;display:flex;align-items:center;justify-content:center;overflow:hidden;border:5px solid #fff;border-radius:50%;background:#dbe6f5;color:#262a5c;font-size:4.5rem;font-weight:700;position:relative;z-index:2;}
.pp-pro .simple-side {margin-bottom:26px;font-size:.85rem;}
.pp-pro .simple-side h3 {margin-bottom:12px;padding-bottom:5px;border-bottom:1px solid #c5c9d5;color:#262a5c;font-size:1.05rem;letter-spacing:1.5px;text-transform:uppercase;}
.pp-pro .simple-side p,.pp-pro .simple-side li {font-size:.82rem;color:#5a5f7a;overflow-wrap:anywhere;white-space:pre-line;}
.pp-pro .simple-side ul {margin-left:19px;}
.pp-pro .simple-side li {margin-bottom:6px;}
.pp-pro .simple-side a {display:block;margin-bottom:7px;color:#2b2f4a;text-decoration:none;overflow-wrap:anywhere;}
.pp-pro .simple-main {min-width:0;padding:36px 40px 32px 20px;}
.pp-pro .simple-section {position:relative;margin-bottom:30px;padding-left:44px;min-width:0;overflow-wrap:anywhere;}
.pp-pro .simple-section:before {content:"";position:absolute;left:14px;top:30px;bottom:-30px;width:2px;background:#c5c9d5;}
.pp-pro .simple-section:last-child:before {display:none;}
.pp-pro .simple-dot {position:absolute;left:0;top:0;width:30px;height:30px;border-radius:50%;display:grid;place-items:center;background:#262a5c;color:#fff;font-size:12px;}
.pp-pro .simple-section h2 {font-size:1.2rem;letter-spacing:2px;text-transform:uppercase;color:#262a5c;border-bottom:1px solid #c5c9d5;padding-bottom:5px;margin-bottom:12px;}
.pp-pro .simple-section p {font-size:.85rem;color:#5a5f7a;white-space:pre-line;overflow-wrap:anywhere;}
.pp-pro .simple-entry {margin-bottom:15px;font-size:.88rem;white-space:pre-line;overflow-wrap:anywhere;}
.pp-pro .simple-share {display:flex;flex-wrap:wrap;align-items:center;gap:12px;padding:20px 32px;background:#1d2048;color:#fff;}
.pp-pro .simple-share-copy {min-width:170px;flex:1;}
.pp-pro .simple-share-copy strong {display:block;font-size:1rem;}
.pp-pro .simple-share-copy small {display:block;margin-top:3px;color:#d8dced;font-size:.75rem;}
.pp-pro .simple-share-url {flex:1 1 220px;min-width:0;padding:9px 12px;border:0;border-radius:4px;background:#fff;color:#262a5c;font-size:.78rem;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
.pp-pro .simple-action {display:inline-block;padding:9px 13px;border:1px solid #8fa4d8;border-radius:4px;color:#fff;font-size:.78rem;white-space:nowrap;}
.pp-pro .simple-action.primary {background:#2f6fe0;border-color:#2f6fe0;}
.pp-pro .simple-action.danger {background:#b42336;border-color:#b42336;}
.pp-pro .simple-footer {padding:12px;background:#f4f5f9;color:#5a5f7a;text-align:center;font-size:.75rem;}

/* Full preview: Template 2 mirrors the real soft gradient + indigo card design. */
.pp-mod {padding:16px;background:radial-gradient(circle at 8% 10%,rgba(189,245,220,.35),transparent 23rem),radial-gradient(circle at 92% 25%,rgba(221,224,255,.65),transparent 28rem),#f5f7fb;color:#151a2d;font-family:"DM Sans",Arial,sans-serif;line-height:1.65;}
.pp-mod .modern-page {max-width:1160px;margin:0 auto;}
.pp-mod .modern-site-nav {display:flex;align-items:center;justify-content:space-between;gap:24px;width:calc(100% - 12px);min-height:72px;margin:0 auto 12px;padding:12px 18px 12px 24px;border:1px solid #e2e6f0;border-radius:22px;background:rgba(255,255,255,.86);box-shadow:0 10px 35px rgba(26,34,71,.07);}
.pp-mod .modern-brand {display:inline-flex;align-items:center;gap:9px;color:#151a2d;font-size:1rem;font-weight:800;letter-spacing:-.04em;}
.pp-mod .modern-mark {display:grid;width:36px;height:36px;place-items:center;border-radius:12px;background:#555cf4;color:#fff;font-size:.8rem;font-weight:800;}
.pp-mod .modern-nav-links {display:flex;flex-wrap:wrap;justify-content:flex-end;gap:6px;color:#687087;font-size:.78rem;}
.pp-mod .modern-hero {display:grid;grid-template-columns:minmax(0,1.1fr) minmax(170px,.7fr);gap:34px;align-items:center;padding:64px 9% 70px;}
.pp-mod .modern-eyebrow {color:#555cf4;font-size:.76rem;font-weight:800;letter-spacing:2px;text-transform:uppercase;}
.pp-mod .modern-hero h1 {margin:10px 0 14px;font-size:clamp(2rem,4vw,3.6rem);line-height:1.1;letter-spacing:-.055em;overflow-wrap:anywhere;color:#151a2d;}
.pp-mod .modern-hero h1 span {color:#555cf4;}
.pp-mod .modern-hero p {color:#687087;font-size:.92rem;white-space:pre-line;overflow-wrap:anywhere;}
.pp-mod .modern-contact {display:flex;flex-wrap:wrap;gap:7px 13px;margin-top:18px;color:#555e6d;font-size:.78rem;overflow-wrap:anywhere;}
.pp-mod .modern-portrait-wrap {position:relative;justify-self:center;width:min(100%,220px);padding:10px;border-radius:26px;background:#e7e9ff;transform:rotate(2deg);}
.pp-mod .modern-portrait {height:220px;display:grid;place-items:center;border:5px solid #fff;border-radius:20px;background:#e0ddff;color:#5146d8;box-shadow:0 12px 35px #dfe3f5;font-size:5rem;font-weight:800;}
.pp-mod .modern-section {padding:36px 9%;}
.pp-mod .modern-kicker {color:#555cf4;font-size:.74rem;font-weight:800;letter-spacing:2px;text-transform:uppercase;}
.pp-mod .modern-section h2 {margin:5px 0;font-size:clamp(1.5rem,3vw,2rem);letter-spacing:-.04em;color:#151a2d;}
.pp-mod .modern-section-intro {margin-bottom:20px;color:#6b7280;font-size:.88rem;}
.pp-mod .modern-grid {display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px;}
.pp-mod .modern-card {min-width:0;padding:22px;background:#fff;border:1px solid #eceef4;border-radius:12px;overflow-wrap:anywhere;}
.pp-mod .modern-card.project {border-top:4px solid #635bff;}
.pp-mod .modern-card h3 {margin-bottom:8px;color:#151a2d;font-size:1rem;letter-spacing:-.025em;}
.pp-mod .modern-card p {color:#606a79;font-size:.85rem;white-space:pre-line;}
.pp-mod .modern-project-number {display:block;margin-bottom:8px;color:#555cf4;font-size:.68rem;font-weight:800;letter-spacing:1px;}
.pp-mod .modern-skill {display:inline-block;margin:0 7px 8px 0;padding:8px 13px;border:1px solid #e0ddff;border-radius:20px;background:#f3f1ff;color:#5146d8;font-size:.8rem;}
.pp-mod .modern-social a {display:inline-block;margin:5px 14px 5px 0;color:#635bff;font-size:.85rem;overflow-wrap:anywhere;}
.pp-mod .modern-share {display:grid;grid-template-columns:1fr 1.4fr;align-items:center;gap:18px;margin:10px 9% 30px;padding:24px;border-radius:12px;background:#202938;color:#fff;}
.pp-mod .modern-share h2 {margin:0 0 5px;color:#fff;font-size:1.15rem;letter-spacing:-.03em;}
.pp-mod .modern-share p {color:#d1d5db;font-size:.8rem;}
.pp-mod .modern-share-actions {display:flex;flex-wrap:wrap;align-items:center;gap:8px;}
.pp-mod .modern-share-url {flex:1 1 150px;min-width:0;padding:10px;border-radius:6px;background:#fff;color:#202938;font-size:.75rem;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
.pp-mod .modern-action {display:inline-block;padding:9px 11px;border:1px solid #a5abff;border-radius:7px;background:#555cf4;color:#fff;font-size:.72rem;white-space:nowrap;}
.pp-mod .modern-action.secondary {background:transparent;color:#fff;}
.pp-mod .modern-action.danger {background:#b42336;border-color:#b42336;}
.pp-mod .modern-footer {padding:18px;text-align:center;border-top:1px solid #e2e6f0;color:#6b7280;font-size:.78rem;}

@media (max-width:760px) {
  .pp-pro .simple-banner {padding:24px;text-align:center;}
  .pp-pro .simple-layout {grid-template-columns:1fr;}
  .pp-pro .simple-photo {margin:-10px auto 24px;}
  .pp-pro .simple-main {padding:24px 20px;}
  .pp-mod .modern-site-nav {flex-wrap:wrap;padding:10px 12px;}
  .pp-mod .modern-hero {grid-template-columns:1fr;padding:35px 7%;}
  .pp-mod .modern-portrait-wrap {grid-row:1;width:170px;}
  .pp-mod .modern-portrait {height:170px;}
  .pp-mod .modern-grid {grid-template-columns:1fr;}
  .pp-mod .modern-share {grid-template-columns:1fr;margin:10px 5% 25px;padding:18px;}
}


.pp-pro .simple-skill {display:inline-block;margin:0 5px 5px 0;padding:4px 8px;border-radius:20px;background:#edf4ff;color:#245da8;font-size:.7rem;}
.pp-mod .modern-entry {margin:5px 0 9px;color:#606a79;font-size:.83rem;white-space:pre-line;overflow-wrap:anywhere;}


/* Keep preview portraits and miniature thumbnail photos consistent with the saved templates. */
.pv-pro .mini-pro-photo img,
.pv-mod .mini-mod-photo img,
.mini-creative-portrait img,
.pp-pro .simple-photo img,
.pp-mod .modern-portrait img,
.pp-cre .creative-portrait img {
    display:block;
    width:100%;
    height:100%;
    object-fit:cover;
}
.pv-pro .mini-pro-photo img { border-radius:50%; }
.pv-mod .mini-mod-photo img { border-radius:9px; }
.pp-pro .simple-photo img { border-radius:50%; }
.pp-mod .modern-portrait img { border-radius:14px; }

/* Template 3 preview mirrors the current cream, mint, lilac, coral and yellow design. */
.pv-cre.mini-creative-page {
    display:block;
    padding:0;
    border:1px solid #d8dfd5;
    border-radius:7px;
    overflow:hidden;
    background:#fbf8f0;
    color:#27332d;
    font-family:Inter,Arial,sans-serif;
}
.mini-creative-nav { display:flex; justify-content:space-between; align-items:center; gap:5px; padding:7px 9px; border-bottom:1px solid #d8dfd5; font-size:6px; }
.mini-creative-nav strong { letter-spacing:.6px; }
.mini-creative-nav strong span { color:#e76b50; }
.mini-creative-nav small { color:#657168; font-size:4px; text-align:right; }
.mini-creative-hero { display:grid; grid-template-columns:1.12fr .88fr; gap:5px; padding:7px; }
.mini-creative-copy { display:flex; flex-direction:column; align-items:flex-start; justify-content:center; min-height:118px; padding:10px; border-radius:3px 18px 3px 3px; background:#cbe7d6; }
.mini-creative-copy small { margin-bottom:9px; color:#657168; font-size:5px; font-weight:800; letter-spacing:.5px; }
.mini-creative-copy strong { font-family:Georgia,serif; font-size:18px; line-height:1; overflow-wrap:anywhere; }
.mini-creative-copy span { margin-top:8px; font-size:5px; color:#42564a; }
.mini-creative-copy i { margin-top:9px; padding-top:5px; border-top:1px solid rgba(39,51,45,.2); color:#657168; font-size:4px; font-style:normal; }
.mini-creative-art { position:relative; min-height:118px; padding:11px; overflow:hidden; border-radius:18px 3px 3px 3px; background:#e7def7; }
.mini-creative-art b { position:absolute; top:9px; right:10px; width:22px; height:22px; border-radius:50%; background:#f4cc68; }
.mini-creative-portrait { position:absolute; inset:22px 16px 18px; z-index:1; display:grid; place-items:center; overflow:hidden; border:4px solid #fffefa; border-radius:45% 45% 3px 3px; background:#e8a997; color:#27332d; font:700 22px Georgia,serif; transform:rotate(-3deg); }
.mini-creative-portrait img { transform:rotate(3deg) scale(1.05); }
.mini-creative-art em { position:absolute; right:5px; bottom:5px; z-index:2; padding:4px 5px; background:#e76b50; color:#fffefa; font:italic 5px Georgia,serif; }
.mini-creative-marquee { padding:5px; border-top:1px solid #d8dfd5; border-bottom:1px solid #d8dfd5; color:#657168; font-size:5px; font-weight:800; letter-spacing:.5px; text-align:center; }
.mini-creative-marquee span { color:#e76b50; }
.mini-creative-cards { display:grid; grid-template-columns:1.3fr .8fr 1fr; gap:4px; padding:7px; }
.mini-creative-cards div { min-height:35px; padding:6px 5px; background:#fffefa; border:1px solid #d8dfd5; color:#657168; font-size:4px; font-weight:800; }
.mini-creative-cards div:nth-child(2) { margin-top:5px; background:#f4cc68; border:0; }
.mini-creative-cards div:nth-child(3) { margin-top:-3px; background:#e76b50; color:#fffefa; border:0; }

.pp-cre { padding:0; background:#fbf8f0; color:#27332d; font-family:Inter,"Segoe UI",Arial,sans-serif; line-height:1.6; }
.pp-cre .creative-page { max-width:1240px; margin:0 auto; background:#fbf8f0; }
.pp-cre .creative-header { display:flex; align-items:center; justify-content:space-between; gap:14px; padding:18px clamp(16px,4vw,42px); border-bottom:1px solid #d8dfd5; background:rgba(255,254,250,.72); }
.pp-cre .creative-brand { color:#27332d; font-size:11px; font-weight:900; letter-spacing:1px; white-space:nowrap; }
.pp-cre .creative-brand span { color:#e76b50; }
.pp-cre .creative-header-links { display:flex; flex-wrap:wrap; justify-content:center; gap:15px; color:#657168; font-size:8px; font-weight:800; letter-spacing:.8px; }
.pp-cre .creative-header small { color:#657168; font-size:7px; text-align:right; }
.pp-cre .creative-header small strong { display:block; color:#e76b50; font-size:8px; }
.pp-cre .creative-content { width:min(calc(100% - 32px),1160px); margin:22px auto 34px; }
.pp-cre .creative-hero { display:grid; grid-template-columns:minmax(0,1.12fr) minmax(220px,.88fr); gap:14px; align-items:stretch; }
.pp-cre .creative-hero-copy { position:relative; display:flex; min-height:330px; flex-direction:column; align-items:flex-start; justify-content:center; padding:clamp(22px,4vw,48px); background:#cbe7d6; border-radius:4px 58px 4px 4px; overflow:hidden; }
.pp-cre .creative-eyebrow { display:flex; align-items:center; gap:8px; margin-bottom:16px; color:#657168; font-size:8px; font-weight:800; letter-spacing:1px; text-transform:uppercase; }
.pp-cre .creative-eyebrow:before { width:18px; height:2px; content:""; background:#e76b50; }
.pp-cre .creative-hero-copy h1 { max-width:100%; margin:0; color:#27332d; font:700 clamp(34px,5.5vw,68px)/.98 Georgia,"Times New Roman",serif; letter-spacing:-.06em; overflow-wrap:anywhere; }
.pp-cre .creative-hero-copy h1 span { color:#e76b50; font-style:italic; font-weight:500; }
.pp-cre .creative-hero-copy p { margin-top:16px; color:#42564a; font-size:11px; white-space:pre-line; overflow-wrap:anywhere; }
.pp-cre .creative-footnote { display:flex; flex-wrap:wrap; justify-content:space-between; gap:8px; width:100%; margin-top:22px; padding-top:8px; border-top:1px solid rgba(39,51,45,.2); color:#657168; font-size:6px; font-weight:800; letter-spacing:.5px; }
.pp-cre .creative-hero-art { position:relative; min-height:330px; padding:20px; overflow:hidden; background:#e7def7; border-radius:58px 4px 4px 4px; }
.pp-cre .creative-art-shape { position:absolute; top:22px; right:22px; width:68px; height:68px; border-radius:50%; background:#f4cc68; }
.pp-cre .creative-portrait { position:absolute; inset:44px 32px 42px; z-index:1; display:grid; place-items:center; overflow:hidden; border:8px solid #fffefa; border-radius:46% 46% 4px 4px; background:#e8a997; color:#27332d; font:italic 86px Georgia,serif; transform:rotate(-3deg); box-shadow:0 12px 28px rgba(39,51,45,.09); }
.pp-cre .creative-portrait img { transform:rotate(3deg) scale(1.05); }
.pp-cre .creative-art-note { position:absolute; right:10px; bottom:10px; z-index:2; max-width:110px; padding:8px 9px; background:#e76b50; color:#fffefa; font:italic 10px/1.2 Georgia,serif; transform:rotate(3deg); }
.pp-cre .creative-marquee { display:flex; flex-wrap:wrap; justify-content:center; gap:8px 14px; margin:12px 0 16px; padding:9px 6px; border-top:1px solid #d8dfd5; border-bottom:1px solid #d8dfd5; color:#657168; font-size:7px; font-weight:800; letter-spacing:1px; text-align:center; }
.pp-cre .creative-marquee span { color:#e76b50; font-size:11px; }
.pp-cre .creative-story-grid { display:grid; grid-template-columns:repeat(12,minmax(0,1fr)); gap:10px; align-items:start; }
.pp-cre .creative-story-card { min-width:0; padding:clamp(16px,2.5vw,28px); overflow-wrap:anywhere; }
.pp-cre .creative-meta { display:flex; flex-wrap:wrap; justify-content:space-between; gap:6px; margin-bottom:16px; color:#657168; font-size:6px; font-weight:800; letter-spacing:.6px; }
.pp-cre .creative-story-card h2 { margin:0 0 10px; color:#27332d; font:600 clamp(18px,2.4vw,30px)/1.05 Georgia,"Times New Roman",serif; letter-spacing:-.04em; }
.pp-cre .creative-story-card p { margin:0; color:inherit; font-size:10px; white-space:pre-line; overflow-wrap:anywhere; }
.pp-cre .creative-about { grid-column:span 7; min-height:165px; background:#fffefa; border:1px solid #d8dfd5; border-radius:4px 4px 50px 4px; }
.pp-cre .creative-education { grid-column:span 5; min-height:165px; margin-top:14px; background:#f4cc68; }
.pp-cre .creative-experience { grid-column:span 5; min-height:155px; background:#e7def7; border-radius:4px 50px 4px 4px; }
.pp-cre .creative-projects { grid-column:span 7; min-height:185px; background:#e76b50; color:#fffefa; }
.pp-cre .creative-projects h2 { color:#fffefa; }
.pp-cre .creative-projects .creative-meta { color:rgba(255,254,250,.85); }
.pp-cre .creative-project-list { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:8px; }
.pp-cre .creative-project-list .creative-project-item { padding:10px; min-height:0; background:rgba(255,254,250,.14); border:1px solid rgba(255,254,250,.35); }
.pp-cre .creative-project-list .creative-project-item h2 { font-size:13px; margin-bottom:5px; }
.pp-cre .creative-project-list .creative-project-item p { font-size:8px; }
.pp-cre .creative-project-list .creative-project-item .creative-meta { font-size:5px; margin-bottom:6px; }
.pp-cre .creative-skills { grid-column:span 4; min-height:135px; background:#cbe7d6; }
.pp-cre .creative-skills-list { display:flex; flex-wrap:wrap; gap:6px; }
.pp-cre .creative-skill { padding:5px 8px; border:1px solid rgba(39,51,45,.35); border-radius:999px; font-size:8px; font-weight:700; }
.pp-cre .creative-contact { grid-column:span 8; min-height:135px; background:#fffefa; border:1px solid #d8dfd5; }
.pp-cre .creative-contact-list { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:10px; }
.pp-cre .creative-contact-item { min-width:0; padding-top:7px; border-top:1px solid #d8dfd5; overflow-wrap:anywhere; font-size:8px; }
.pp-cre .creative-contact-item strong { display:block; color:#e76b50; font-size:6px; letter-spacing:.7px; margin-bottom:3px; }
.pp-cre .creative-actions { display:flex; flex-wrap:wrap; align-items:center; gap:7px; margin-top:18px; padding:14px; background:#27332d; color:#fffefa; }
.pp-cre .creative-actions div { flex:1; min-width:180px; }
.pp-cre .creative-actions strong { display:block; font-size:8px; letter-spacing:.7px; }
.pp-cre .creative-actions p { margin-top:3px; color:#d7e0d8; font-size:8px; overflow-wrap:anywhere; }
.pp-cre .creative-actions > span { padding:7px 9px; border:1px solid rgba(255,254,250,.55); font-size:7px; white-space:nowrap; }
.pp-cre .creative-actions > span.danger { background:#b42336; border-color:#b42336; }
.pp-cre .creative-footer { display:flex; flex-wrap:wrap; justify-content:space-between; gap:10px; margin-top:17px; padding-top:12px; border-top:1px solid #d8dfd5; color:#657168; font-size:7px; letter-spacing:.6px; }
@media (max-width:760px) {
 .pp-cre .creative-header { flex-wrap:wrap; }
 .pp-cre .creative-header small { display:none; }
 .pp-cre .creative-hero { grid-template-columns:1fr; }
 .pp-cre .creative-hero-art { min-height:270px; }
 .pp-cre .creative-story-grid { display:block; }
 .pp-cre .creative-story-card { margin-bottom:10px; }
 .pp-cre .creative-project-list,.pp-cre .creative-contact-list { grid-template-columns:1fr; }
 .mini-creative-header { flex-wrap:wrap; }
}

</style>
 </head>
 <body>
  <form action="{{ route('portfolio.select-template', $portfolio->id) }}" id="templateSelectionForm" method="POST" style="display:none">
   @csrf
   <input id="selectedTemplateInput" name="template" type="hidden" value="template1"/>
  </form>
  <div class="grid-container">
   <div class="animated-grid">
   </div>
  </div>
  <canvas id="waveCanvas">
  </canvas>
  @include('partials.portgen-navbar')
  <div class="templates-wrapper">
   <div class="hero-text-create">
    <h1>
     Choose Your Portfolio Template
    </h1>
    <p style="color:var(--text-muted)">
     Choose a design for your portfolio. You can edit your details anytime.
    </p>
   </div>
   <div class="tpl-grid">
    <!-- Simple (Template 1) -->
    <div class="glass-card tpl-card" id="tpl-pro">
     <div class="tpl-frame" onclick="openPreview('Simple')" title="Click to preview">
      <div class="pv pv-pro">
       <div class="mini-pro-banner"><strong>{{ $previewName }}</strong><small>PERSONAL PORTFOLIO</small></div>
       <div class="mini-pro-layout">
        <aside class="mini-pro-sidebar">
         <div class="mini-pro-photo">@if ($previewPhoto)<img src="{{ $previewPhoto }}" alt="">@else{{ $previewInitial }}@endif</div>
         <div class="mini-pro-sidegroup"><b>Contact</b><span>hello@example.com</span><span>+63 900 000 0000</span></div>
         <div class="mini-pro-sidegroup"><b>Skills</b><span>HTML · CSS · PHP</span></div>
         <div class="mini-pro-sidegroup"><b>Projects</b><span>My project</span></div>
        </aside>
        <main class="mini-pro-main">
         <div class="mini-pro-section"><b>1 &nbsp; About Me</b><span></span><span style="width:80%"></span></div>
         <div class="mini-pro-section"><b>2 &nbsp; Work Experience</b><span></span><span style="width:68%"></span></div>
         <div class="mini-pro-section"><b>3 &nbsp; Education</b><span></span><span style="width:73%"></span></div>
        </main>
       </div>
       <div class="mini-pro-share">Share Your Portfolio <em>Copy&nbsp; Edit&nbsp; Delete</em></div>
      </div>
     </div>
     <div class="tpl-info">
      <h3>Simple</h3>
      <p class="desc">A straightforward navy banner, soft gray sidebar, round profile photo, and simple timeline sections.</p>
      <div class="tpl-btns">
       <button class="btn-primary" onclick="openPreview('Simple')">Preview</button>
       <button class="btn-primary" onclick="selectTemplate('Simple')">Choose</button>
      </div>
     </div>
    </div>
    <!-- Modern (Template 2) -->
    <div class="glass-card tpl-card" id="tpl-mod">
     <div class="tpl-frame" onclick="openPreview('Modern')" title="Click to preview">
      <div class="pv pv-mod">
       <div class="mini-mod-nav">
        <strong class="mini-mod-brand"><span class="mini-mod-mark">PG</span>{{ $previewName }}</strong>
        <span class="mini-mod-links">About &nbsp; Projects &nbsp; Skills</span>
       </div>
       <section class="mini-mod-hero">
        <div>
         <span class="mini-mod-kicker">Personal portfolio</span>
         <strong class="mini-mod-title">Hello, I'm<br><span class="mini-mod-accent">Your Name.</span></strong>
         <span class="mini-mod-copy">A snapshot of my work and the things I love creating.</span>
        </div>
        <div class="mini-mod-photo">@if ($previewPhoto)<img src="{{ $previewPhoto }}" alt="">@else{{ $previewInitial }}@endif</div>
       </section>
       <section class="mini-mod-section">
        <span class="mini-mod-label">Selected work</span>
        <div class="mini-mod-heading">Projects I've built.</div>
        <div class="mini-mod-grid">
         <div class="mini-mod-card"><b>Project title</b><span></span><span style="width:70%"></span></div>
         <div class="mini-mod-card"><b>Another project</b><span></span><span style="width:62%"></span></div>
        </div>
       </section>
       <div class="mini-mod-skills"><span class="mini-mod-pill">HTML</span><span class="mini-mod-pill">CSS</span><span class="mini-mod-pill">PHP</span></div>
       <div class="mini-mod-share">Pass it along.<span>Share · Edit · Delete</span></div>
      </div>
     </div>
     <div class="tpl-info">
      <h3>Modern</h3>
      <p class="desc">A soft gradient backdrop, rounded navigation, bold indigo introduction, and project cards with crisp accent borders.</p>
      <div class="tpl-btns">
       <button class="btn-primary" onclick="openPreview('Modern')">Preview</button>
       <button class="btn-primary" onclick="selectTemplate('Modern')">Choose</button>
      </div>
     </div>
    </div>
    <!-- Creative -->
    <div class="glass-card tpl-card" id="tpl-cre">
     <div class="tpl-frame" onclick="openPreview('Creative')" title="Click to preview">
      <div class="pv pv-cre mini-creative-page">
       <div class="mini-creative-nav"><strong>MYFOLIO <span>/ CREATIVE</span></strong><small>CREATIVE EDITION / 03</small></div>
       <div class="mini-creative-hero">
        <div class="mini-creative-copy"><small>A LITTLE ABOUT ME</small><strong>{{ $previewName }}</strong><span>A collection of ideas and things worth sharing.</span><i>PORTFOLIO NO. {{ str_pad((string) $portfolio->id, 3, '0', STR_PAD_LEFT) }}</i></div>
        <div class="mini-creative-art"><b></b><div class="mini-creative-portrait">@if ($previewPhoto)<img src="{{ $previewPhoto }}" alt="">@else{{ $previewInitial }}@endif</div><em>A work in progress</em></div>
       </div>
       <div class="mini-creative-marquee">✳ STAY CURIOUS　✳ MAKE THINGS　✳ KEEP LEARNING</div>
       <div class="mini-creative-cards"><div>01 / THE INTRODUCTION</div><div>02 / EDUCATION</div><div>03 / PROJECTS</div></div>
      </div>
     </div>
     <div class="tpl-info">
      <h3>
       Creative
      </h3>
      <p class="desc">
       An editorial layout with a mint introduction panel, lilac portrait panel, yellow accents, and staggered story cards.
      </p>
      <div class="tpl-btns">
       <button class="btn-primary" onclick="openPreview('Creative')">
        Preview
       </button>
       <button class="btn-primary" onclick="selectTemplate('Creative')">
        Choose
       </button>
      </div>
     </div>
    </div>
   </div>
   <a class="back-link" href="{{ route('portfolio.edit', $portfolio->id) }}">
    &larr; Back to Edit Portfolio
   </a>
  </div>
  <!-- Full preview window -->
  <div class="pv-overlay" id="previewOverlay" onclick="if(event.target===this)closePreview()">
   <div class="glass-card pv-win">
    <div class="pv-top">
     <div>
      <h3 id="pvTitle">
      </h3>
      <small>
       Preview using your details. Empty fields show sample text.
      </small>
     </div>
     <div class="pv-actions">
      <button class="btn-primary" onclick="closePreview()">
       Close
      </button>
      <button class="btn-primary" id="pvChoose">
       Choose this template
      </button>
     </div>
    </div>
    <div class="pv-body" id="pvBody">
    </div>
   </div>
  </div>
  <!-- Selection modal -->
  <div class="modal" id="selectionModal">
   <div class="glass-card modal-box">
    <div class="check">
     <svg style="width:22px;height:22px;stroke-width:3" viewbox="0 0 24 24">
      <path d="M5 12.5l4.5 4.5L19 7.5">
      </path>
     </svg>
    </div>
    <h2>
     Template Selected
    </h2>
    <p id="modalDesc">
    </p>
    <button class="btn-primary" onclick="closeModal()">
     Continue
    </button>
   </div>
  </div>
  <script>
   
// ---- Live previews follow the current Template 1, Template 2, and Template 3 layouts ----
const esc = (value) => String(value ?? '').replace(/[&<>"']/g, (char) => ({
    '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
}[char]));

const portgenPreviewSource = @json($previewData);

function getData() {
    const source = portgenPreviewSource || {};
    const get = (key) => String(source[key] ?? '').trim();

    return {
        name: get('name') || 'Your Name',
        email: get('email'),
        phone: get('phone'),
        address: get('address'),
        about: get('about') || 'A short introduction about yourself, your interests, and what you enjoy creating.',
        education: get('education') || 'Your education details will appear here.',
        skills: get('skills') || 'HTML, CSS, PHP',
        experience: get('experience') || 'Your work or volunteer experience will appear here.',
        projects: get('projects') || 'A project you have worked on.',
        links: get('links') || 'GitHub, LinkedIn, Personal Website',
        photo: get('photo')
    };
}

function renderTemplate(key, data) {
    const name = esc(data.name);
    const initial = esc((data.name || 'Y').charAt(0).toUpperCase());
    const portraitMarkup = data.photo ? `<img src="${esc(data.photo)}" alt="${name}">` : initial;
    const lines = (value, regex = /[\r\n]+/) => String(value || '').split(regex).map((item) => item.trim()).filter(Boolean);
    const skills = lines(data.skills, /[,;\r\n]+/);
    const projects = lines(data.projects);
    const education = lines(data.education);
    const experience = lines(data.experience);
    const links = lines(data.links, /[\r\n,]+/);
    const location = data.address && data.address.toUpperCase() !== 'NONE' ? data.address : '';
    const contacts = [data.email, data.phone, location].filter(Boolean);
    const portfolioUrl = window.location.origin + '/portfolio/' + {{ (int) $portfolio->id }};
    const year = new Date().getFullYear();
    const skillTags = skills.map((skill) => `<span class="${key === 'Modern' ? 'modern-skill' : 'simple-skill'}">${esc(skill)}</span>`).join('');

    if (key === 'Simple' || key === 'Professional') {
        const sideContacts = contacts.length
            ? contacts.map((item) => `<p>${esc(item)}</p>`).join('')
            : '<p>Add your contact information to show it here.</p>';
        const sideProjects = projects.map((project) => `<p>${esc(project)}</p>`).join('') || '<p>Your projects will appear here.</p>';
        const sideLinks = links.map((link) => `<a href="#social">${esc(link)}</a>`).join('') || '<p>Add social links to connect with visitors.</p>';
        const workItems = experience.map((item) => `<div class="simple-entry">${esc(item)}</div>`).join('') || '<p>Your work experience will appear here.</p>';
        const educationItems = education.map((item) => `<div class="simple-entry">${esc(item)}</div>`).join('') || '<p>Your educational background will appear here.</p>';

        return `<div class="pp pp-pro"><div class="simple-page">
            <header class="simple-banner"><h1>${name}</h1><p>Personal Portfolio</p></header>
            <div class="simple-layout">
                <aside class="simple-sidebar">
                    <div class="simple-photo">${portraitMarkup}</div>
                    <div class="simple-side"><h3>Contact</h3>${sideContacts}</div>
                    <div class="simple-side"><h3>Skills</h3>${skillTags ? `<ul>${skills.map((skill) => `<li>${esc(skill)}</li>`).join('')}</ul>` : '<p>Your skills will appear here.</p>'}</div>
                    <div class="simple-side"><h3>Projects</h3>${sideProjects}</div>
                    <div class="simple-side" id="social"><h3>Social Links</h3>${sideLinks}</div>
                </aside>
                <main class="simple-main">
                    <section class="simple-section"><span class="simple-dot">1</span><h2>About Me</h2><p>${esc(data.about)}</p></section>
                    <section class="simple-section"><span class="simple-dot">2</span><h2>Work Experience</h2>${workItems}</section>
                    <section class="simple-section"><span class="simple-dot">3</span><h2>Educational Background</h2>${educationItems}</section>
                </main>
            </div>
            <div class="simple-share"><div class="simple-share-copy"><strong>Share Your Portfolio</strong><small>Copy your portfolio link to share it with others.</small></div><span class="simple-share-url">${esc(portfolioUrl)}</span><span class="simple-action primary">Copy Link</span><span class="simple-action">Edit Portfolio</span><span class="simple-action danger">Delete Portfolio</span></div>
            <footer class="simple-footer">© ${year} ${name}. All rights reserved.</footer>
        </div></div>`;
    }

    if (key === 'Modern') {
        const projectCards = projects.map((project, index) => `<article class="modern-card project"><span class="modern-project-number">PROJECT ${String(index + 1).padStart(2, '0')}</span><h3>${esc(project.split(/\s*[:|]\s*/, 1)[0])}</h3><p>${esc(project.includes(':') ? project.slice(project.indexOf(':') + 1).trim() : 'A project included in my portfolio.')}</p></article>`).join('') || '<article class="modern-card project"><span class="modern-project-number">YOUR WORK</span><h3>Featured project</h3><p>Your project description will appear here.</p></article>';
        const contactList = contacts.map((item) => `<span>${esc(item)}</span>`).join('');
        const educationText = education.map((item) => `<div class="modern-entry">${esc(item)}</div>`).join('') || '<p>Add your degree, school, and graduation year to complete this section.</p>';
        const experienceText = experience.map((item) => `<div class="modern-entry">${esc(item)}</div>`).join('') || '<p>Add your previous roles or relevant experience here.</p>';
        const socialLinks = links.map((link) => `<a href="#social">${esc(link)}</a>`).join('') || '<a href="#social">Add your social links</a>';

        return `<div class="pp pp-mod"><div class="modern-page">
            <nav class="modern-site-nav"><div class="modern-brand"><span class="modern-mark">PG</span>${name}</div><div class="modern-nav-links"><span>About</span><span>Projects</span><span>Background</span><span>Skills</span><span>Social</span></div></nav>
            <section class="modern-hero"><div><span class="modern-eyebrow">Personal portfolio</span><h1>Hello, I'm <span>${name}.</span></h1><p>A snapshot of my work, experience, and the things I love creating.</p><p>${esc(data.about)}</p><div class="modern-contact">${contactList}</div></div><div class="modern-portrait-wrap"><div class="modern-portrait">${portraitMarkup}</div></div></section>
            <section class="modern-section"><span class="modern-kicker">Selected work</span><h2>Projects I've built.</h2><p class="modern-section-intro">A few projects that highlight my skills, ideas, and creativity.</p><div class="modern-grid">${projectCards}</div></section>
            <section class="modern-section"><span class="modern-kicker">The journey</span><h2>Background &amp; experience.</h2><p class="modern-section-intro">The education and experiences that have helped me grow.</p><div class="modern-grid"><article class="modern-card"><h3>01 &nbsp; Education</h3>${educationText}</article><article class="modern-card"><h3>02 &nbsp; Experience</h3>${experienceText}</article></div></section>
            <section class="modern-section"><span class="modern-kicker">What I work with</span><h2>Skills &amp; tools.</h2><p class="modern-section-intro">The tools, technologies, and abilities I bring to a project.</p>${skillTags}</section>
            <section class="modern-section modern-social" id="social"><span class="modern-kicker">Around the web</span><h2>Let's connect.</h2><div>${socialLinks}</div></section>
            <section class="modern-share"><div><h2>Pass it along.</h2><p>Share your portfolio with classmates, recruiters, or collaborators.</p></div><div class="modern-share-actions"><span class="modern-share-url">${esc(portfolioUrl)}</span><span class="modern-action">Copy link</span><span class="modern-action secondary">Edit portfolio</span><span class="modern-action danger">Delete portfolio</span></div></section>
            <footer class="modern-footer">© ${year} ${name}. Built with care.</footer>
        </div></div>`;
    }

    const projectCards = projects.map((project, index) => `<article class="creative-project-item"><div class="creative-meta"><span>PROJECT ${String(index + 1).padStart(2, '0')}</span><span>SELECTED WORK</span></div><h2>${esc(project.split(/\s*[:|]\s*/, 1)[0])}</h2><p>${esc(project.includes(':') ? project.slice(project.indexOf(':') + 1).trim() : 'A project included in my portfolio.')}</p></article>`).join('') || '<article class="creative-project-item"><div class="creative-meta"><span>PROJECT 01</span><span>SELECTED WORK</span></div><h2>Things I have made.</h2><p>Your project details will appear here.</p></article>';
    const creativeSkills = skills.map((skill) => `<span class="creative-skill">${esc(skill)}</span>`).join('') || '<span class="creative-skill">Add your skills</span>';
    const contactItems = [
        data.email ? `<div class="creative-contact-item"><strong>EMAIL</strong><span>${esc(data.email)}</span></div>` : '',
        data.phone ? `<div class="creative-contact-item"><strong>PHONE</strong><span>${esc(data.phone)}</span></div>` : '',
        location ? `<div class="creative-contact-item"><strong>LOCATION</strong><span>${esc(location)}</span></div>` : '',
        links.length ? `<div class="creative-contact-item"><strong>ELSEWHERE</strong><span>${links.map(esc).join(' · ')}</span></div>` : ''
    ].filter(Boolean).join('');
    const nameParts = String(data.name || 'Your Name').trim().split(/\s+/);
    const firstName = esc(nameParts.shift() || 'Your');
    const restName = esc(nameParts.join(' '));

    return `<div class="pp pp-cre"><div class="creative-page">
        <header class="creative-header"><a class="creative-brand" href="#">MYFOLIO <span>/ CREATIVE</span></a><div class="creative-header-links"><span>MY STORY</span><span>CONTACT</span><span>NEW PORTFOLIO</span></div><small>PERSONAL PORTFOLIO <strong>CREATIVE EDITION / 03</strong></small></header>
        <main class="creative-content">
            <section class="creative-hero"><div class="creative-hero-copy"><span class="creative-eyebrow">A LITTLE ABOUT ME</span><h1>${firstName}${restName ? `<br><span>${restName}</span>` : ''}</h1><p>${esc(data.about)}</p><div class="creative-footnote"><span>PORTFOLIO NO. {{ str_pad((string) $portfolio->id, 3, '0', STR_PAD_LEFT) }}</span><span>MADE TO BE PERSONAL</span></div></div><div class="creative-hero-art"><b class="creative-art-shape"></b><div class="creative-portrait">${portraitMarkup}</div><span class="creative-art-note">A work in progress, in the best way.</span></div></section>
            <div class="creative-marquee"><span>✳</span> STAY CURIOUS <span>✳</span> MAKE THINGS <span>✳</span> KEEP LEARNING <span>✳</span> STAY CURIOUS</div>
            <section class="creative-story-grid"><article class="creative-story-card creative-about"><div class="creative-meta"><span>01 / THE INTRODUCTION</span><span>A LITTLE CONTEXT</span></div><h2>The person behind the projects.</h2><p>${esc(data.about || 'Add a short introduction to tell people who you are and what matters to you.')}</p></article><article class="creative-story-card creative-education"><div class="creative-meta"><span>02 / WHERE I LEARNED</span><span>BACKGROUND</span></div><h2>Learning along the way.</h2><p>${esc(data.education)}</p></article><article class="creative-story-card creative-experience"><div class="creative-meta"><span>03 / WHAT I HAVE DONE</span><span>EXPERIENCE</span></div><h2>Growing with every project.</h2><p>${esc(data.experience)}</p></article><article class="creative-story-card creative-projects"><div class="creative-meta"><span>04 / SELECTED WORK</span><span>PROJECTS</span></div><h2>Things I've made.</h2><div class="creative-project-list">${projectCards}</div></article><article class="creative-story-card creative-skills"><div class="creative-meta"><span>05 / MY TOOLKIT</span><span>SKILLS</span></div><h2>Things I use.</h2><div class="creative-skills-list">${creativeSkills}</div></article><article class="creative-story-card creative-contact"><div class="creative-meta"><span>06 / SAY HELLO</span><span>CONTACT</span></div><h2>Let's keep in touch.</h2><div class="creative-contact-list">${contactItems || '<p>Add your contact details and social links to complete this section.</p>'}</div></article></section>
            <div class="creative-actions"><div><strong>YOUR PORTFOLIO, READY TO SHARE</strong><p>${esc(portfolioUrl)}</p></div><span>Copy link</span><span>Edit portfolio</span><span class="danger">Delete portfolio</span></div>
            <footer class="creative-footer"><span>MADE TO BE PERSONAL ✳</span><span>© ${year} ${name}</span></footer>
        </main></div></div>`;
}

function openPreview(name){ document.getElementById('pvTitle').textContent=name+' template'; const body=document.getElementById('pvBody'); body.innerHTML=renderTemplate(name,getData()); body.scrollTop=0; document.getElementById('pvChoose').onclick=()=>{closePreview();selectTemplate(name)}; document.getElementById('previewOverlay').classList.add('open'); } function closePreview(){document.getElementById('previewOverlay').classList.remove('open')} addEventListener('keydown',e=>{if(e.key==='Escape')closePreview()});  // ---- Template selection ----
let selectedTemplate=null; function selectTemplate(name){ selectedTemplate=name; const ids={Simple:'template1',Professional:'template1',Modern:'template2',Creative:'template3'}; document.getElementById('selectedTemplateInput').value=ids[name]||'template1'; document.querySelectorAll('.tpl-card').forEach(c=>c.classList.remove('selected')); const card=document.getElementById('tpl-'+({Simple:'pro',Professional:'pro',Modern:'mod',Creative:'cre'}[name]||'pro')); if(card) card.classList.add('selected'); document.getElementById('modalDesc').textContent='You selected the '+name+' template. Continue to apply it to your portfolio.'; document.getElementById('selectionModal').classList.add('open'); } function closeModal(){ document.getElementById('selectionModal').classList.remove('open'); document.getElementById('templateSelectionForm').requestSubmit(); }
// ---- Theme toggle (remembered between visits) ----
const html=document.documentElement; function setTheme(t){ html.setAttribute('data-theme',t); try{localStorage.setItem('portgen_theme',t)}catch(e){} } let saved='dark'; try{saved=localStorage.getItem('portgen_theme')||'dark'}catch(e){} setTheme(saved);
 // Theme button handling lives in the shared PortGen navbar partial.
// ---- Wave canvas ----
const canvas = document.getElementById('waveCanvas');

if (canvas) {
    const ctx = canvas.getContext('2d');
    let waveWidth = 0;
    let waveHeight = 0;
    let mouseX = window.innerWidth / 2;
    let mouseY = window.innerHeight / 2;
    let targetX = mouseX;
    let targetY = mouseY;
    let waveTime = 0;

    function resizeCanvas() {
        const pixelRatio = window.devicePixelRatio || 1;

        waveWidth = window.innerWidth;
        waveHeight = window.innerHeight;
        canvas.width = Math.floor(waveWidth * pixelRatio);
        canvas.height = Math.floor(waveHeight * pixelRatio);
        canvas.style.width = `${waveWidth}px`;
        canvas.style.height = `${waveHeight}px`;
        ctx.setTransform(pixelRatio, 0, 0, pixelRatio, 0, 0);
    }

    window.addEventListener('resize', resizeCanvas);
    window.addEventListener('mousemove', event => {
        targetX = event.clientX;
        targetY = event.clientY;
    });

    function drawWaves() {
        mouseX += (targetX - mouseX) * 0.025;
        mouseY += (targetY - mouseY) * 0.025;
        ctx.clearRect(0, 0, waveWidth, waveHeight);

        const isLight = document.documentElement.getAttribute('data-theme') === 'light';
        const waveColor = isLight ? '2, 132, 199' : '56, 189, 248';
        const lineCount = 30;

        for (let i = 0; i < lineCount; i++) {
            ctx.beginPath();
            ctx.lineWidth = i === 15 ? 2.2 : 1.25;
            ctx.strokeStyle = `rgba(${waveColor}, ${0.32 + (i / lineCount) * 0.48})`;

            const baseY = waveHeight * 0.48 + (i - lineCount / 2) * 10;

            for (let x = 0; x <= waveWidth; x += 3) {
                const mouseInfluence = Math.sin((x - mouseX) * 0.002)
                    * ((mouseY - waveHeight / 2) * 0.06);
                const y = baseY
                    + Math.sin(x * 0.0025 + waveTime + i * 0.12) * 105
                    + Math.sin(x * 0.0015 - waveTime * 0.7) * 55
                    + mouseInfluence;

                if (x === 0) {
                    ctx.moveTo(x, y);
                } else {
                    ctx.lineTo(x, y);
                }
            }

            ctx.stroke();
        }

        waveTime += 0.012;
        window.requestAnimationFrame(drawWaves);
    }

    resizeCanvas();
    drawWaves();
}

  </script>
 </body>
</html>
