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
  <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700\&amp;family=Mako\&amp;family=Sansation:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700\&amp;display=swap" rel="stylesheet"/>
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
    display: block;
    position: fixed;
    inset: 0;
    width: 100vw;
    height: 100vh;
    z-index: 2;
    pointer-events: none;
}

/* Navbar */ header {
    position:relative;
    z-index:10;
    width:100%;
    max-width:1280px;
    padding:24px 20px 0;
    display:flex;
    justify-content:center
}

nav {
    width:100%;
    background:var(--nav-bg);
    backdrop-filter:blur(12px);
    -webkit-backdrop-filter:blur(12px);
    border:2px solid var(--nav-border);
    border-radius:8px;
    padding:12px 32px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    box-shadow:0 0 15px var(--accent-glow)
}

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

/* Full preview window */ .pv-overlay {
    position:fixed;
    inset:0;
    z-index:60;
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
    nav {
        padding:12px 16px
    }

    .nav-links {
        gap:14px
    }

    .nav-links a {
        font-size:13px
    }

}

  

/* Compact PortGen logo and theme toggle header */
.portgen-header {
    position: relative;
    z-index: 10;
    width: 100%;
    max-width: 1280px;
    padding: 9px 12px 0;
    display: flex;
    justify-content: center;
}

.portgen-header nav {
    min-height: 70px;
    padding: 12px 32px;
}

@media (max-width: 600px) {
    .portgen-header nav {
        min-height: 62px;
        padding: 10px 16px;
    }

    .portgen-header .logo {
        font-size: 23px;
    }
}

/* Shared PortGen homepage theme refinements */
body { font-family:'Lora',serif; }
.logo, .brand, .logo-text { font-family:'Sansation',sans-serif; }
button, .btn, .choose-btn { transition:background-color .25s ease, border-color .25s ease, box-shadow .25s ease, transform .25s ease; }
button:hover, .btn:hover, .choose-btn:hover { box-shadow:0 0 16px var(--accent-glow, rgba(56,189,248,.25)); }

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

  <header class="portgen-header">
   <nav aria-label="Main navigation">
    <a class="logo" href="{{ route('home') }}">PortGen</a>
    <button class="theme-toggle" id="themeToggleBtn" type="button" title="Toggle light/dark mode" aria-label="Toggle light/dark mode">
     <svg class="icon-sun" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="4"></circle><path d="M12 2v2M12 20v2M4.93 4.93l1.42 1.42M17.65 17.65l1.42 1.42M2 12h2M20 12h2M4.93 19.07l1.42-1.42M17.65 6.35l1.42-1.42"></path></svg>
     <svg class="icon-moon" viewBox="0 0 24 24" aria-hidden="true"><path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z"></path></svg>
    </button>
   </nav>
  </header>

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
    <!-- Professional -->
    <div class="glass-card tpl-card" id="tpl-pro">
     <div class="tpl-frame" onclick="openPreview('Professional')" title="Click to preview">
      <div class="pv pv-pro">
       <div class="pv-nav">
        <span class="pv-brand">
         <span class="pv-av">
          Y
         </span>
         Your Name
        </span>
        <span>
         <i>
          Home
         </i>
         <i>
          About
         </i>
         <i>
          Skills
         </i>
        </span>
       </div>
       <div class="pv-hero">
        <div class="pv-photo">
         Y
        </div>
        <div>
         <small>
          HELLO, I'M
         </small>
         <strong>
          Your Name
         </strong>
         <div class="ln">
         </div>
         <div class="ln" style="width:70%">
         </div>
        </div>
       </div>
       <div class="pv-g3">
        <div class="pv-box">
         About Me
         <div class="ln">
         </div>
        </div>
        <div class="pv-box">
         Education
         <div class="ln">
         </div>
        </div>
        <div class="pv-box">
         Experience
         <div class="ln">
         </div>
        </div>
       </div>
       <div>
        <span class="pv-pill">
         HTML
        </span>
        <span class="pv-pill">
         CSS
        </span>
        <span class="pv-pill">
         PHP
        </span>
       </div>
       <div class="pv-share">
        Share Your Portfolio
       </div>
      </div>
     </div>
     <div class="tpl-info">
      <h3>
       Professional
      </h3>
      <p class="desc">
       A clean, organized layout with a navy and blue palette, a profile photo, and clear portfolio cards.
      </p>
      <div class="tpl-btns">
       <button class="btn-primary" onclick="openPreview('Professional')">
        Preview
       </button>
       <button class="btn-primary" onclick="selectTemplate('Professional')">
        Choose
       </button>
      </div>
     </div>
    </div>
    <!-- Modern -->
    <div class="glass-card tpl-card" id="tpl-mod">
     <div class="tpl-frame" onclick="openPreview('Modern')" title="Click to preview">
      <div class="pv pv-mod">
       <div class="pv-nav">
        <span>
         Your Name
        </span>
        <span>
         <i>
          About
         </i>
         <i>
          Projects
         </i>
         <i>
          Skills
         </i>
        </span>
       </div>
       <div class="pv-hero">
        <div>
         <small>
          Welcome to my portfolio
         </small>
         <strong>
          Hello, I'm Your Name.
         </strong>
         <span class="pv-btn">
          Contact Me
         </span>
        </div>
        <div class="pv-photo">
         Y
        </div>
       </div>
       <div class="pv-head">
        Featured Projects
       </div>
       <div class="pv-g">
        <div class="pv-box">
         Project
         <div class="ln">
         </div>
        </div>
        <div class="pv-box">
         Project
         <div class="ln">
         </div>
        </div>
       </div>
       <div>
        <span class="pv-pill">
         HTML
        </span>
        <span class="pv-pill">
         CSS
        </span>
        <span class="pv-pill">
         PHP
        </span>
       </div>
      </div>
     </div>
     <div class="tpl-info">
      <h3>
       Modern
      </h3>
      <p class="desc">
       A bright, minimal design with indigo accents, a bold introduction, and featured project cards.
      </p>
      <div class="tpl-btns">
       <button class="btn-primary" onclick="openPreview('Modern')">
        Preview
       </button>
       <button class="btn-primary" onclick="selectTemplate('Modern')">
        Choose
       </button>
      </div>
     </div>
    </div>
    <!-- Creative -->
    <div class="glass-card tpl-card" id="tpl-cre">
     <div class="tpl-frame" onclick="openPreview('Creative')" title="Click to preview">
      <div class="pv pv-cre">
       <div class="pv-nav">
        <span class="pv-brand">
         <span>
          ✳
         </span>
         Your Name
        </span>
        <span>
         <i>
          About
         </i>
         <i>
          Projects
         </i>
         <i>
          Skills
         </i>
        </span>
       </div>
       <span class="pv-tag">
        CREATIVE PORTFOLIO ✦
       </span>
       <div class="pv-hero">
        <div>
         <strong>
          Hey, I'm
          <br/>
          <span>
           Your Name
          </span>
         </strong>
         <div style="margin-top:7px">
          <span class="pv-btn">
           Let's Connect &nearrow;
          </span>
          <span class="pv-btn o">
           Explore
          </span>
         </div>
        </div>
        <div class="pv-photo">
         Y
        </div>
       </div>
       <div class="pv-head">
        Things I've Created ✳
       </div>
       <div class="pv-g">
        <div class="pv-box b1">
         PROJECT 01
         <div class="ln">
         </div>
        </div>
        <div class="pv-box b2">
         PROJECT 02
         <div class="ln">
         </div>
        </div>
       </div>
       <div>
        <span class="pv-pill">
         HTML
        </span>
        <span class="pv-pill">
         CSS
        </span>
       </div>
      </div>
     </div>
     <div class="tpl-info">
      <h3>
       Creative
      </h3>
      <p class="desc">
       A playful design on a warm cream background with lime and peach cards, bold type, and a unique layout.
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
   
// Template preview (uses the details saved on the Create Portfolio page)
const esc=t=>String(t).replace(/[&<>"']/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));  function getData(){ let f={}; try{f=JSON.parse(sessionStorage.getItem('portgen_data'))||{}}catch(e){} const g=k=>(f[k]||'').toString().trim(); return {name:g('fullName')||'Your Name',email:g('email'),phone:g('phone'),address:g('address'), about:g('about')||'A short bio about you, your passion, and what drives you will appear here.', education:g('education')||'Your degree, university, and graduation year.', skills:g('skills')||'HTML, CSS, JavaScript, PHP', experience:g('experience')||'Your previous roles and companies.', projects:g('projects')||'Notable projects you have built.', links:g('links')||'GitHub, LinkedIn, Personal Website'}; }  function renderTemplate(key,d){ const n=esc(d.name), ini=esc(d.name.charAt(0).toUpperCase()); const split=(t,re)=>t.split(re).map(x=>x.trim()).filter(Boolean); const skills=split(d.skills,/[,\n]/), projects=split(d.projects,/[\r\n]+/), links=split(d.links,/[\r\n,]+/); const addr=d.address&&d.address.toUpperCase()!=='NONE'?d.address:''; const contact=[d.email,d.phone,addr].filter(Boolean).map(x=>`<span>${esc(x)}</span>`).join(''); const sk=skills.map(x=>`<span class="sk">${esc(x)}</span>`).join(''); const lk=(suffix)=>links.map(x=>`<a>${esc(x)}${suffix||''}</a>`).join(''); const url=window.location.origin+'/portfolio/'+{{ (int) $portfolio->id }}, year=new Date().getFullYear();  if(key==='Professional'){ const pj=projects.map(x=>`<div class="pi"><h3>${esc(x)}</h3><p>Project included in my portfolio.</p></div>`).join(''); const card=(i,t,b)=>`<section class="card"><h2><b>${i}</b> ${t}</h2>${b}</section>`; return `<div class="pp pp-pro"> <div class="nav"><div class="brand"><span class="bi">${ini}</span>${n}</div><div class="nl"><span>Home</span><span>About</span><span>Education</span><span>Experience</span><span>Skills</span><span>Projects</span></div></div> <div class="hero"><div class="pw"><div class="ph">${ini}</div></div><div><div class="eb">HELLO, I'M</div><h1>${n}</h1><p class="hd">${esc(d.about)}</p><div class="ci">${contact}</div></div><div class="hn">Turning ideas<br>into real projects.<span></span></div></div> <div class="cg">${card('♙','About Me',`<p>${esc(d.about)}</p>`)}${card('◇','Educational Background',`<p>${esc(d.education)}</p>`)}${card('▣','Work Experience',`<p>${esc(d.experience)}</p>`)}${card('⚙','Skills',`<div>${sk}</div>`)}${card('&lt;/&gt;','Projects',pj)}${card('↗','Social Media and Websites',`<div class="sl">${lk()}</div>`)}</div> <section class="share"><div><h2>Share Your Portfolio</h2><p>Copy your portfolio link to share it with others.</p></div><div class="sr"><i>${url}</i><span class="btn">Copy Link</span></div><div><span class="btn ed">Edit Portfolio</span></div></section> <div class="foot">© ${year} ${n}. All rights reserved.</div></div>`; }  if(key==='Modern'){ const pj=projects.map(x=>`<article class="pc top"><h3>${esc(x)}</h3><p>Project included in my portfolio.</p></article>`).join(''); return `<div class="pp pp-mod"> <div class="nav"><div class="logo">${n}</div><div class="nl"><span>About</span><span>Projects</span><span>Background</span><span>Skills</span></div></div> <div class="hero"><div class="ht"><div class="eb">Welcome to my portfolio</div><h1>Hello, I'm ${n}.</h1><p>${esc(d.about)}</p><div class="ci">${contact}</div>${d.email ? '<span class="btn">Contact Me</span>' : ''}</div><div class="ph">${ini}</div></div> <section class="sec"><div class="sh"><span>My work</span><h2>Featured Projects</h2><p>Some of the projects I have worked on.</p></div><div class="g2">${pj}</div></section> <section class="sec"><div class="sh"><span>My journey</span><h2>Background</h2></div><div class="g2"><article class="pc"><h3>Educational Background</h3><p>${esc(d.education)}</p></article><article class="pc"><h3>Work Experience</h3><p>${esc(d.experience)}</p></article></div></section> <section class="sec"><div class="sh"><span>What I can do</span><h2>My Skills</h2></div><div>${sk}</div></section> <section class="sec"><div class="sh"><span>Find me online</span><h2>Social Media and Websites</h2></div><div class="sl">${lk()}</div></section> <section class="share"><h2>Share My Portfolio</h2><p>Share this link with friends, classmates, or potential employers.</p><div class="sr"><i>${url}</i><span class="btn">Copy Link</span></div></section> <div class="foot">© ${year} ${n}. All rights reserved.</div></div>`; }  const pj=projects.map((x,i)=>`<article class="pc pj"><span class="pn">PROJECT ${String(i+1).padStart(2,'0')}</span><h3>${esc(x)}</h3><p>A project featured in my portfolio.</p></article>`).join(''); return `<div class="pp pp-cre"> <div class="nav"><div class="brand"><span>✳</span> ${n}</div><div class="nl"><span>Home</span><span>About</span><span>Projects</span><span>Skills</span><span>My Journey</span></div></div> <div class="hero"><div><span class="tag">CREATIVE PORTFOLIO ✦</span><h1>Hey, I'm<br><span>${n}</span></h1><p class="hd">${esc(d.about)}</p><div class="btns">${d.email ? '<span class="btn">Let&apos;s Connect ↗</span>' : ''}<span class="btn o">Explore My Work</span></div><div class="ci">${d.phone ? `<span>Contact: ${esc(d.phone)}</span>` : ''}${addr?`<span>${esc(addr)}</span>`:''}</div></div><div class="pa"><div class="ph">${ini}</div><div class="stk">LET'S<br>CREATE!</div></div></div> <section class="sec"><div class="sh"><h2>A Little About Me</h2><p>THE PERSON BEHIND THE WORK</p></div><div class="about"><h2>Curious mind. Creative ideas.</h2><p>${esc(d.about)}</p></div></section> <section class="sec"><div class="sh"><h2>Things I've Created ✳</h2><p>A SELECTION OF MY PROJECTS</p></div><div class="g2">${pj}</div></section> <section class="sec"><div class="sh"><h2>My Journey</h2><p>LEARNING, GROWING, CREATING</p></div><div class="g2"><article class="pc"><h3>🎓 Education</h3><p>${esc(d.education)}</p></article><article class="pc"><h3>✦ Work Experience</h3><p>${esc(d.experience)}</p></article></div></section> <section class="sec"><div class="sh"><h2>My Creative Toolkit</h2><p>SKILLS AND THINGS I KNOW</p></div><div>${sk}</div></section> <section class="sec"><div class="sh"><h2>Find Me Online ↗</h2><p>LET'S STAY CONNECTED</p></div><div class="sl">${lk(' ↗')}</div></section> <section class="share"><h2>Like What You See? ✳</h2><p>Share this portfolio with others.</p><div class="sr"><i>${url}</i><span class="btn">Copy Portfolio Link</span></div></section> <div class="foot">Made with creativity ✳ | © ${year} ${n}</div></div>`; }  function openPreview(name){ document.getElementById('pvTitle').textContent=name+' template'; const body=document.getElementById('pvBody'); body.innerHTML=renderTemplate(name,getData()); body.scrollTop=0; document.getElementById('pvChoose').onclick=()=>{closePreview();selectTemplate(name)}; document.getElementById('previewOverlay').classList.add('open'); } function closePreview(){document.getElementById('previewOverlay').classList.remove('open')} addEventListener('keydown',e=>{if(e.key==='Escape')closePreview()});  
// Template selection
let selectedTemplate=null; function selectTemplate(name){ selectedTemplate=name; const ids={Professional:'template1',Modern:'template2',Creative:'template3'}; document.getElementById('selectedTemplateInput').value=ids[name]||'template1'; document.querySelectorAll('.tpl-card').forEach(c=>c.classList.remove('selected')); const card=document.getElementById('tpl-'+({Professional:'pro',Modern:'mod',Creative:'cre'}[name]||'pro')); if(card) card.classList.add('selected'); document.getElementById('modalDesc').textContent='You selected the '+name+' template. Continue to apply it to your portfolio.'; document.getElementById('selectionModal').classList.add('open'); } function closeModal() {
    document.getElementById('selectionModal').classList.remove('open');
    const form = document.getElementById('templateSelectionForm');
    if (form.requestSubmit) {
        form.requestSubmit();
    } else {
        form.submit();
    }
}  
// Theme toggle (remembered between visits)
const html = document.documentElement;
function setTheme(theme) {
    html.setAttribute('data-theme', theme);
    try { localStorage.setItem('portgen_theme', theme); } catch (error) {}
}
let savedTheme = 'dark';
try { savedTheme = localStorage.getItem('portgen_theme') || 'dark'; } catch (error) {}
setTheme(savedTheme);

// Theme toggle button is optional; the page still works if it is absent.
const themeToggleButton = document.getElementById('themeToggleBtn');
if (themeToggleButton) {
    themeToggleButton.addEventListener('click', () => {
        setTheme(html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark');
    });
}  
// Animated wave background
const canvas = document.getElementById('waveCanvas');
if (!canvas) {
    console.error('Wave canvas #waveCanvas was not found on the page.');
} else {
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
    canvas.style.width = waveWidth + 'px';
    canvas.style.height = waveHeight + 'px';
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
            const mouseInfluence = Math.sin((x - mouseX) * 0.002) * ((mouseY - waveHeight / 2) * 0.06);
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
    requestAnimationFrame(drawWaves);
}

resizeCanvas();
drawWaves();
}

  </script>
 </body>
</html>
