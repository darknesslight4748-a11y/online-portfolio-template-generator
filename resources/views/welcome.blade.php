<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PortGen - Online Portfolio Template Generator</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600;700&family=Mako&family=Sansation:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        :root[data-theme="dark"] {
            --bg-color: #0c0e12;
            --grid-line: rgba(255, 255, 255, 0.08);
            --text-main: #ffffff;
            --text-muted: #d1d5db;
            --accent-blue: #38bdf8;
            --accent-glow: rgba(56, 189, 248, 0.35);
            --nav-bg: rgba(12, 14, 18, 0.85);
            --nav-border: #38bdf8;
            --card-bg: rgba(18, 20, 26, 0.62);
            --card-border: rgba(56, 189, 248, 0.35);
            --button-bg: rgba(20, 20, 25, 0.85);
        }

        :root[data-theme="light"] {
            --bg-color: #f8fafc;
            --grid-line: rgba(0, 0, 0, 0.08);
            --text-main: #0f172a;
            --text-muted: #475569;
            --accent-blue: #0284c7;
            --accent-glow: rgba(2, 132, 199, 0.25);
            --nav-bg: rgba(255, 255, 255, 0.9);
            --nav-border: #0284c7;
            --card-bg: rgba(255, 255, 255, 0.78);
            --card-border: rgba(2, 132, 199, 0.3);
            --button-bg: rgba(255, 255, 255, 0.9);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
            background: var(--bg-color);
            color: var(--text-main);
            font-family: 'Lora', serif;
        }

        .grid-container {
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .animated-grid {
            position: absolute;
            width: 200%;
            height: 200%;
            left: -50%;
            top: -50%;
            background-image: linear-gradient(to right, var(--grid-line) 1px, transparent 1px),
                              linear-gradient(to bottom, var(--grid-line) 1px, transparent 1px);
            background-size: 48px 48px;
            animation: scrollGrid 18s linear infinite;
        }

        @keyframes scrollGrid {
            to { transform: translate(48px, 48px); }
        }

        #waveCanvas {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            pointer-events: none;
            opacity: 1;
        }

        header,
        main,
        footer {
            position: relative;
            z-index: 2;
        }

        header {
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;
            padding: 24px 20px 0;
        }

        header > nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 12px 28px;
            border: 2px solid var(--nav-border);
            border-radius: 8px;
            background: var(--nav-bg);
            box-shadow: 0 0 15px var(--accent-glow);
            backdrop-filter: blur(12px);
        }

        /* Keep the whole navbar in sync with the selected theme. */
        :root[data-theme="dark"] header > nav {
            color: #ffffff;
            background: rgba(12, 14, 18, 0.92);
            border-color: #38bdf8;
            box-shadow: 0 0 18px rgba(56, 189, 248, 0.22);
        }

        :root[data-theme="light"] header > nav {
            color: #0f172a;
            background: rgba(255, 255, 255, 0.94);
            border-color: #0284c7;
            box-shadow: 0 0 18px rgba(2, 132, 199, 0.16);
        }

        .logo {
            color: var(--accent-blue);
            font-family: 'Sansation', sans-serif;
            font-size: 26px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 30px;
            list-style: none;
        }

        .nav-links a {
            position: relative;
            padding: 4px 0;
            color: var(--text-main);
            font-family: 'Sansation', sans-serif;
            font-size: 15px;
            font-weight: 700;
            text-decoration: none;
        }

        .nav-links a:hover {
            color: var(--accent-blue);
        }

        .theme-toggle {
            display: grid;
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            place-items: center;
            border: 1px solid var(--card-border);
            border-radius: 50%;
            background: var(--card-bg);
            color: var(--text-main);
            cursor: pointer;
        }

        .theme-toggle svg {
            width: 20px;
            height: 20px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        :root[data-theme="dark"] .theme-toggle .sun-icon { display: block; }
        :root[data-theme="dark"] .theme-toggle .moon-icon { display: none; }
        :root[data-theme="light"] .theme-toggle .sun-icon { display: none; }
        :root[data-theme="light"] .theme-toggle .moon-icon { display: block; }

        .theme-toggle:hover {
            color: var(--accent-blue);
            box-shadow: 0 0 14px var(--accent-glow);
        }

        main {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
            padding: 0 20px 70px;
        }

        .hero {
            display: grid;
            grid-template-columns: minmax(0, 1.2fr) minmax(280px, 0.8fr);
            align-items: center;
            gap: 56px;
            min-height: 590px;
            padding: 70px 10px;
        }

        .eyebrow {
            display: inline-block;
            margin-bottom: 20px;
            padding: 8px 14px;
            border: 1px solid var(--card-border);
            border-radius: 999px;
            background: var(--card-bg);
            color: var(--accent-blue);
            font-family: 'Sansation', sans-serif;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.5px;
        }

        .hero h1 {
            max-width: 720px;
            margin-bottom: 22px;
            font-family: 'Sansation', sans-serif;
            font-size: clamp(42px, 6vw, 70px);
            line-height: 1.08;
        }

        .hero h1 span {
            color: var(--accent-blue);
        }

        .hero-copy {
            max-width: 630px;
            margin-bottom: 30px;
            color: var(--text-muted);
            font-size: 17px;
            line-height: 1.8;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 46px;
            padding: 12px 25px;
            border: 1px solid var(--card-border);
            border-radius: 8px;
            background: var(--button-bg);
            color: var(--text-main);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.22);
            cursor: pointer;
            font-family: 'Sansation', sans-serif;
            font-size: 15px;
            font-weight: 700;
            text-decoration: none;
        }

        .button.primary {
            border-color: var(--accent-blue);
            background: var(--accent-blue);
            color: #07111a;
        }

        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 20px var(--accent-glow);
        }

        .hero-card {
            padding: 24px;
            border: 1.5px solid var(--card-border);
            border-radius: 24px;
            background: var(--card-bg);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.25), 0 0 25px var(--accent-glow);
            backdrop-filter: blur(16px);
        }

        .mock-window {
            overflow: hidden;
            border: 1px solid var(--card-border);
            border-radius: 13px;
            background: var(--bg-color);
        }

        .mock-top {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 13px;
            border-bottom: 1px solid var(--card-border);
        }

        .mock-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--accent-blue);
            opacity: 0.8;
        }

        .mock-content {
            padding: 24px 20px;
        }

        .mock-label {
            margin-bottom: 8px;
            color: var(--accent-blue);
            font-family: 'Sansation', sans-serif;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
        }

        .mock-name {
            margin-bottom: 8px;
            font-family: 'Sansation', sans-serif;
            font-size: 27px;
            font-weight: 700;
        }

        .mock-line {
            height: 7px;
            margin-top: 9px;
            border-radius: 5px;
            background: var(--card-border);
        }

        .mock-line.short { width: 55%; }
        .mock-line.medium { width: 78%; }

        .mock-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 22px;
        }

        .mock-tags span {
            padding: 6px 10px;
            border: 1px solid var(--card-border);
            border-radius: 20px;
            color: var(--accent-blue);
            font-family: 'Sansation', sans-serif;
            font-size: 11px;
        }

        .section {
            padding: 45px 0;
        }

        .section-heading {
            max-width: 700px;
            margin: 0 auto 32px;
            text-align: center;
        }

        .section-heading p {
            margin-bottom: 10px;
            color: var(--accent-blue);
            font-family: 'Sansation', sans-serif;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .section-heading h2 {
            margin-bottom: 12px;
            font-family: 'Sansation', sans-serif;
            font-size: clamp(30px, 4vw, 42px);
        }

        .section-heading .muted {
            color: var(--text-muted);
            line-height: 1.7;
        }

        .steps {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
        }

        .step-card {
            padding: 28px;
            border: 1.5px solid var(--card-border);
            border-radius: 18px;
            background: var(--card-bg);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
            backdrop-filter: blur(12px);
        }

        .step-number {
            display: grid;
            width: 44px;
            height: 44px;
            margin-bottom: 20px;
            place-items: center;
            border-radius: 12px;
            background: var(--accent-glow);
            color: var(--accent-blue);
            font-family: 'Sansation', sans-serif;
            font-size: 18px;
            font-weight: 700;
        }

        .step-card h3 {
            margin-bottom: 12px;
            font-family: 'Sansation', sans-serif;
            font-size: 20px;
        }

        .step-card p {
            color: var(--text-muted);
            font-size: 14px;
            line-height: 1.8;
        }

        .bottom-cta {
            margin-top: 45px;
            padding: 40px 25px;
            border: 1.5px solid var(--card-border);
            border-radius: 20px;
            background: var(--card-bg);
            text-align: center;
            box-shadow: 0 0 25px var(--accent-glow);
            backdrop-filter: blur(12px);
        }

        .bottom-cta h2 {
            margin-bottom: 12px;
            font-family: 'Sansation', sans-serif;
            font-size: clamp(26px, 4vw, 36px);
        }

        .bottom-cta p {
            margin-bottom: 22px;
            color: var(--text-muted);
            line-height: 1.7;
        }

        footer {
            padding: 24px 20px 30px;
            color: var(--text-muted);
            font-size: 13px;
            text-align: center;
        }

        @media (max-width: 850px) {
            .hero {
                grid-template-columns: 1fr;
                gap: 32px;
                min-height: auto;
                padding: 70px 10px 45px;
            }

            .hero-card {
                max-width: 560px;
                width: 100%;
                margin: 0 auto;
            }

            .steps {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 650px) {
            header { padding: 14px 12px 0; }
            header > nav { flex-wrap: wrap; padding: 12px 15px; }
            .nav-links { order: 3; width: 100%; justify-content: space-between; gap: 10px; }
            .nav-links a { font-size: 12px; }
            .logo { font-size: 23px; }
            main { padding-right: 16px; padding-left: 16px; }
            .hero { padding-top: 55px; }
            .hero-copy { font-size: 15px; }
            .button { width: 100%; }
            .section { padding: 30px 0; }
        }
    </style>
</head>
<body>
    <div class="grid-container" aria-hidden="true">
        <div class="animated-grid"></div>
    </div>
    <canvas id="waveCanvas" aria-hidden="true"></canvas>

    @include('partials.portgen-navbar')

    <main>
        <section class="hero">
            <div class="hero-text">
                <span class="eyebrow">YOUR PORTFOLIO, YOUR STYLE</span>
                <h1>Build a portfolio that <span>shows who you are.</span></h1>
                <p class="hero-copy">
                    Create your own online portfolio without starting from scratch. Add your information,
                    choose a design, and share your work through a public portfolio link.
                </p>
                <div class="hero-actions">
                    <a class="button primary" href="{{ route('portfolio.create') }}">Create My Portfolio <span aria-hidden="true">&nbsp;→</span></a>
                    <a class="button" href="#how-it-works">How It Works</a>
                </div>
            </div>

            <div class="hero-card" aria-label="Portfolio design preview">
                <div class="mock-window">
                    <div class="mock-top">
                        <span class="mock-dot"></span>
                        <span class="mock-dot"></span>
                        <span class="mock-dot"></span>
                    </div>
                    <div class="mock-content">
                        <p class="mock-label">PERSONAL PORTFOLIO</p>
                        <div class="mock-name">Your Name</div>
                        <p style="color: var(--text-muted); font-size: 13px; line-height: 1.7;">Showcase your skills, projects, education, and experience in one place.</p>
                        <div class="mock-line"></div>
                        <div class="mock-line medium"></div>
                        <div class="mock-line short"></div>
                        <div class="mock-tags">
                            <span>About Me</span>
                            <span>Projects</span>
                            <span>Skills</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section" id="how-it-works">
            <div class="section-heading">
                <p>Simple steps</p>
                <h2>How It Works</h2>
                <div class="muted">Make your portfolio in three simple steps.</div>
            </div>

            <div class="steps">
                <article class="step-card">
                    <div class="step-number">01</div>
                    <h3>Add Your Details</h3>
                    <p>Enter your personal information, education, skills, projects, work experience, and links.</p>
                </article>

                <article class="step-card">
                    <div class="step-number">02</div>
                    <h3>Choose a Template</h3>
                    <p>Pick from three portfolio designs and use the style that best fits your personality and work.</p>
                </article>

                <article class="step-card">
                    <div class="step-number">03</div>
                    <h3>Share Your Portfolio</h3>
                    <p>Preview your portfolio and share its public link with classmates, employers, or clients.</p>
                </article>
            </div>

            <div class="bottom-cta">
                <h2>Ready to create your portfolio?</h2>
                <p>Start with your details and turn them into a portfolio you can share online.</p>
                <a class="button primary" href="{{ route('portfolio.create') }}">Get Started <span aria-hidden="true">&nbsp;→</span></a>
            </div>
        </section>
    </main>

    <footer>© {{ date('Y') }} PortGen. Create a portfolio that represents you.</footer>

    <script>
        // Keep the page and navbar on the same saved light/dark theme.
        const html = document.documentElement;
        const themeButton = document.getElementById('themeToggleBtn');

        function setTheme(theme) {
            html.setAttribute('data-theme', theme);
            document.body.setAttribute('data-theme', theme);
            html.classList.toggle('dark', theme === 'dark');
            html.classList.toggle('light', theme === 'light');

            if (themeButton) {
                const nextTheme = theme === 'dark' ? 'light' : 'dark';
                themeButton.setAttribute('aria-label', `Switch to ${nextTheme} mode`);
                themeButton.setAttribute('title', `Switch to ${nextTheme} mode`);
            }

            try {
                localStorage.setItem('portgen_theme', theme);
            } catch (error) {
                // The page still works if browser storage is unavailable.
            }
        }

        let savedTheme = 'dark';
        try {
            savedTheme = localStorage.getItem('portgen_theme') || 'dark';
        } catch (error) {
            savedTheme = 'dark';
        }
        setTheme(savedTheme);

        // The shared navbar partial handles clicks, so the theme is not toggled twice.

        // More visible animated wave background, matching the other PortGen pages.
        const canvas = document.getElementById('waveCanvas');
        const context = canvas ? canvas.getContext('2d') : null;

        let waveWidth = 0;
        let waveHeight = 0;
        let waveTime = 0;
        let mouseX = window.innerWidth / 2;
        let mouseY = window.innerHeight / 2;
        let targetX = mouseX;
        let targetY = mouseY;

        function resizeCanvas() {
            if (!canvas || !context) return;

            const pixelRatio = window.devicePixelRatio || 1;
            waveWidth = window.innerWidth;
            waveHeight = window.innerHeight;
            canvas.width = Math.floor(waveWidth * pixelRatio);
            canvas.height = Math.floor(waveHeight * pixelRatio);
            canvas.style.width = `${waveWidth}px`;
            canvas.style.height = `${waveHeight}px`;
            context.setTransform(pixelRatio, 0, 0, pixelRatio, 0, 0);
        }

        function drawWaves() {
            if (!canvas || !context) return;

            mouseX += (targetX - mouseX) * 0.025;
            mouseY += (targetY - mouseY) * 0.025;
            context.clearRect(0, 0, waveWidth, waveHeight);

            const isLight = html.getAttribute('data-theme') === 'light';
            const waveColor = isLight ? '2, 132, 199' : '56, 189, 248';
            const lineCount = 30;

            for (let line = 0; line < lineCount; line++) {
                context.beginPath();
                context.lineWidth = line === 15 ? 2.2 : 1.25;
                context.strokeStyle = `rgba(${waveColor}, ${0.32 + (line / lineCount) * 0.48})`;

                const baseY = waveHeight * 0.48 + (line - lineCount / 2) * 10;

                for (let x = 0; x <= waveWidth; x += 3) {
                    const mouseInfluence = Math.sin((x - mouseX) * 0.002)
                        * ((mouseY - waveHeight / 2) * 0.06);
                    const y = baseY
                        + Math.sin(x * 0.0025 + waveTime + line * 0.12) * 105
                        + Math.sin(x * 0.0015 - waveTime * 0.7) * 55
                        + mouseInfluence;

                    if (x === 0) {
                        context.moveTo(x, y);
                    } else {
                        context.lineTo(x, y);
                    }
                }

                context.stroke();
            }

            waveTime += 0.012;
            window.requestAnimationFrame(drawWaves);
        }

        window.addEventListener('resize', resizeCanvas);
        window.addEventListener('mousemove', event => {
            targetX = event.clientX;
            targetY = event.clientY;
        });

        resizeCanvas();
        drawWaves();
    </script>
</body>
</html>
