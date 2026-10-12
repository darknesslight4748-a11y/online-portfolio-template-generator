
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PortGen - Choose Your Portfolio Template</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600;700&family=Mako&family=Sansation:wght@300;400;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bg-color: #0b0c10;
            --text-color: #ffffff;
            --subtext-color: #a0a6b8;
            --card-bg: rgba(20, 22, 30, 0.88);
            --card-border: rgba(255, 255, 255, 0.12);
            --btn-border: rgba(255, 255, 255, 0.3);
            --btn-text: #ffffff;
            --toggle-bg: rgba(255, 255, 255, 0.08);
            --toggle-border: rgba(255, 255, 255, 0.2);
        }

        [data-theme="light"] {
            --bg-color: #f5f7fb;
            --text-color: #111827;
            --subtext-color: #4b5563;
            --card-bg: rgba(255, 255, 255, 0.94);
            --card-border: rgba(0, 0, 0, 0.1);
            --btn-border: rgba(17, 24, 39, 0.35);
            --btn-text: #111827;
            --toggle-bg: rgba(0, 0, 0, 0.05);
            --toggle-border: rgba(0, 0, 0, 0.15);
        }

        html {
            min-height: 100%;
            background: var(--bg-color);
        }

        body {
            min-height: 100vh;
            overflow-x: hidden;
            background: var(--bg-color);
            color: var(--text-color);
            font-family: Arial, Helvetica, sans-serif;
            transition: background-color 0.3s, color 0.3s;
        }

        button {
            font: inherit;
        }

        canvas {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
        }

        .container {
            position: relative;
            z-index: 1;
            width: 100%;
            min-height: 100vh;
            padding: 35px 5%;
        }

        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 48px;
        }

        .logo-group {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 38px;
            height: 38px;
            border: 1px solid var(--toggle-border);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--toggle-bg);
        }

        .logo-icon svg {
            width: 20px;
            height: 20px;
            fill: var(--text-color);
        }

        .logo-text {
            font-family: 'Sansation', sans-serif;
            font-size: 1.6rem;
            font-weight: 700;
        }

        .theme-toggle-btn {
            width: 43px;
            height: 43px;
            border: 1px solid var(--toggle-border);
            border-radius: 50%;
            background: var(--toggle-bg);
            color: var(--text-color);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .theme-toggle-btn svg {
            width: 21px;
            height: 21px;
            fill: currentColor;
        }

        .hero-text {
            margin-bottom: 35px;
        }

        .hero-text h1 {
            margin-bottom: 10px;
            font-family: 'Mako', sans-serif;
            font-size: clamp(1.7rem, 4vw, 2.5rem);
            font-weight: 400;
            text-transform: uppercase;
        }

        .hero-text p {
            color: var(--subtext-color);
            font-family: 'Lora', serif;
            font-size: 0.95rem;
            line-height: 1.7;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 24px;
            max-width: 1280px;
            margin: 0 auto 35px;
        }

        .card {
            min-width: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 18px;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            backdrop-filter: blur(12px);
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.08);
        }

        .preview-box {
            width: 100%;
            height: 240px;
            padding: 12px;
            margin-bottom: 20px;
            overflow: hidden;
            border-radius: 10px;
            font-family: Arial, sans-serif;
            font-size: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        /* Professional preview */

        .preview-box.prof {
            background: #ffffff;
            color: #1a1a1a;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .prof .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 5px;
            font-weight: bold;
            font-size: 10px;
        }

        .prof .nav-links {
            display: flex;
            gap: 6px;
            color: #555;
            font-size: 8px;
            font-weight: normal;
        }

        .prof .hero-card {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            border-radius: 8px;
            background: #f4f7fe;
        }

        .prof .avatar {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            background: #dbe5ff;
            color: #2b6cb0;
            font-size: 20px;
            font-weight: bold;
        }

        .prof .skeleton-text {
            height: 5px;
            margin-top: 5px;
            border-radius: 3px;
            background: #dbe3f0;
        }

        .prof .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .prof .mini-card {
            min-width: 0;
            padding: 9px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            background: #fff;
        }

        .prof .tag {
            display: inline-block;
            margin: 5px 2px 0 0;
            padding: 3px 4px;
            border-radius: 3px;
            background: #edf2f7;
            font-size: 7px;
        }

        /* Modern preview */

        .preview-box.mod {
            display: flex;
            flex-direction: column;
            gap: 14px;
            background: #0f111a;
            color: #fff;
        }

        .mod .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 5px;
            font-size: 10px;
            font-weight: bold;
        }

        .mod .nav-links {
            display: flex;
            gap: 6px;
            color: #aaa;
            font-size: 7px;
            font-weight: normal;
        }

        .mod .hero-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
        }

        .mod .circle-avatar {
            width: 52px;
            height: 52px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: linear-gradient(135deg, #7986cb, #3949ab);
            font-size: 19px;
            font-weight: bold;
        }

        .mod .btn-sm {
            display: inline-block;
            margin-top: 7px;
            padding: 4px 8px;
            border-radius: 4px;
            background: #7986cb;
            color: white;
            font-size: 7px;
        }

        .mod .proj-box {
            padding: 10px;
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 6px;
            background: #1a1d2d;
        }

        /* Creative preview */

        .preview-box.creative {
            display: flex;
            flex-direction: column;
            gap: 12px;
            background: #fffdf5;
            color: #111;
        }

        .creative .badge {
            display: inline-block;
            padding: 3px 7px;
            border-radius: 10px;
            background: #d4ed31;
            font-size: 7px;
            font-weight: bold;
        }

        .creative .arch-avatar {
            width: 45px;
            height: 55px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #111;
            border-radius: 25px 25px 0 0;
            background: #ffcba4;
            font-size: 16px;
            font-weight: bold;
        }

        .creative .black-btn {
            display: inline-block;
            margin-top: 7px;
            padding: 4px 8px;
            border-radius: 4px;
            background: #111;
            color: white;
            font-size: 7px;
        }

        .creative .cards-row {
            display: flex;
            gap: 6px;
        }

        .creative .c-card-1,
        .creative .c-card-2 {
            flex: 1;
            padding: 10px;
            border: 1px solid #111;
            border-radius: 6px;
        }

        .creative .c-card-1 {
            background: #d4ed31;
        }

        .creative .c-card-2 {
            background: #ffcba4;
        }

        .card-info {
            flex: 1;
            margin-bottom: 20px;
        }

        .card-info h2 {
            margin-bottom: 8px;
            color: var(--text-color);
            font-size: 1.3rem;
            font-weight: 700;
        }

        .card-info p {
            color: var(--subtext-color);
            font-size: 0.88rem;
            line-height: 1.6;
        }

        .card form {
            width: 100%;
            margin-top: auto;
        }

        .card-btn {
            display: block;
            width: 100%;
            padding: 12px 18px;
            border: 1px solid var(--btn-border);
            border-radius: 8px;
            background: transparent;
            color: var(--btn-text);
            font-family: 'Lora', serif;
            font-size: 0.95rem;
            font-weight: 500;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.2s, color 0.2s, transform 0.2s;
        }

        .card-btn:hover {
            border-color: var(--text-color);
            background: var(--toggle-bg);
            transform: translateY(-2px);
        }

        .card-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .back-link {
            display: inline-block;
            margin-top: 8px;
            color: var(--subtext-color);
            font-size: 0.9rem;
            text-decoration: none;
        }

        .back-link:hover {
            color: var(--text-color);
            text-decoration: underline;
        }

        @media (max-width: 960px) {
            .cards-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .container {
                padding: 24px 18px;
            }

            header {
                margin-bottom: 35px;
            }

            .cards-grid {
                grid-template-columns: 1fr;
                max-width: 430px;
            }

            .preview-box {
                height: 250px;
            }

            .hero-text h1 {
                line-height: 1.3;
            }
        }
    </style>
</head>

<body>
    <canvas id="canvas" aria-hidden="true"></canvas>

    <div class="container">
        <header>
            <div class="logo-group">
                <div class="logo-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16zm0-14a6 6 0 1 0 0 12 6 6 0 0 0 0-12z"/>
                    </svg>
                </div>
                <div class="logo-text">PortGen</div>
            </div>

            <button
                type="button"
                class="theme-toggle-btn"
                id="themeToggleBtn"
                aria-label="Toggle light and dark theme"
                title="Toggle Light/Dark Theme"
            >
                <svg id="themeIcon" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 7a5 5 0 1 0 0 10 5 5 0 0 0 0-10zM11 1h2v3h-2zM11 20h2v3h-2zM1 11h3v2H1zM20 11h3v2h-3zM4.22 2.81l2.12 2.12-1.41 1.41L2.81 4.22zM17.66 17.66l1.41-1.41 2.12 2.12-1.41 1.41zM17.66 6.34l2.12-2.12 1.41 1.41-2.12 2.12zM2.81 19.78l2.12-2.12 1.41 1.41-2.12 2.12z"/>
                </svg>
            </button>
        </header>

        <section class="hero-text">
            <h1>Choose Your Portfolio Template</h1>
            <p>Choose a design for your portfolio. You can edit your details anytime.</p>
        </section>

        <div class="cards-grid">

            <!-- Professional Template -->
            <article class="card">
                <div class="preview-box prof">
                    <div class="nav">
                        <span>• Your Name</span>
                        <div class="nav-links">
                            <span>About</span>
                            <span>Skills</span>
                            <span>Projects</span>
                        </div>
                    </div>

                    <div class="hero-card">
                        <div class="avatar">Y</div>
                        <div style="flex: 1;">
                            <div style="font-size: 7px; color: #3182ce; font-weight: bold;">HELLO, I'M</div>
                            <div style="font-size: 11px; font-weight: bold; margin-top: 3px;">Your Name</div>
                            <div style="font-size: 7px; color: #888; margin-top: 3px;">Your Profession</div>
                            <div class="skeleton-text" style="width: 80%;"></div>
                            <div class="skeleton-text" style="width: 50%;"></div>
                        </div>
                    </div>

                    <div class="grid-2">
                        <div class="mini-card">
                            <strong>About Me</strong>
                            <div class="skeleton-text"></div>
                        </div>
                        <div class="mini-card">
                            <strong>Education</strong>
                            <div class="skeleton-text"></div>
                        </div>
                    </div>

                    <div class="grid-2">
                        <div class="mini-card">
                            <strong>Skills</strong><br>
                            <span class="tag">HTML</span>
                            <span class="tag">CSS</span>
                            <span class="tag">PHP</span>
                        </div>
                        <div class="mini-card">
                            <strong>Projects</strong>
                            <div class="skeleton-text"></div>
                        </div>
                    </div>
                </div>

                <div class="card-info">
                    <h2>Professional</h2>
                    <p>A clean and organized design with a white background, blue accents, and clear portfolio sections.</p>
                </div>

                <form action="{{ route('portfolio.select-template', $portfolio->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="template" value="template1">
                    <button type="submit" class="card-btn">Choose Professional</button>
                </form>
            </article>

            <!-- Modern Template -->
            <article class="card">
                <div class="preview-box mod">
                    <div class="nav">
                        <span>Your Name</span>
                        <div class="nav-links">
                            <span>Home</span>
                            <span>Work</span>
                            <span>Contact</span>
                        </div>
                    </div>

                    <div class="hero-section">
                        <div>
                            <div style="font-size: 7px; color: #9fa8ff;">WELCOME TO MY SPACE</div>
                            <div style="font-size: 12px; font-weight: bold; margin-top: 5px;">Hello, I'm<br>Your Name</div>
                            <div style="font-size: 7px; color: #aaa; margin-top: 4px;">Creative Professional</div>
                            <span class="btn-sm">View Projects ↗</span>
                        </div>
                        <div class="circle-avatar">Y</div>
                    </div>

                    <div style="font-size: 9px; font-weight: bold;">Featured Projects</div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6px;">
                        <div class="proj-box">
                            <div style="font-size: 7px; color: #aaa;">01 / PROJECT</div>
                            <div style="height: 4px; width: 75%; background: #7986cb; margin-top: 7px; border-radius: 2px;"></div>
                        </div>
                        <div class="proj-box">
                            <div style="font-size: 7px; color: #aaa;">02 / PROJECT</div>
                            <div style="height: 4px; width: 60%; background: #7986cb; margin-top: 7px; border-radius: 2px;"></div>
                        </div>
                    </div>

                    <div class="proj-box">
                        <div style="font-size: 8px; color: #aaa;">ABOUT ME</div>
                        <div style="height: 4px; width: 90%; background: #33364b; margin-top: 7px; border-radius: 2px;"></div>
                        <div style="height: 4px; width: 65%; background: #33364b; margin-top: 5px; border-radius: 2px;"></div>
                    </div>
                </div>

                <div class="card-info">
                    <h2>Modern</h2>
                    <p>A dark, contemporary layout with purple accents, a bold introduction, and featured project cards.</p>
                </div>

                <form action="{{ route('portfolio.select-template', $portfolio->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="template" value="template2">
                    <button type="submit" class="card-btn">Choose Modern</button>
                </form>
            </article>

            <!-- Creative Template -->
            <article class="card">
                <div class="preview-box creative">
                    <div style="display: flex; justify-content: space-between; align-items: center; gap: 5px;">
                        <span style="font-size: 8px; font-weight: bold;">✱ Your Name</span>
                        <div style="display: flex; gap: 6px; font-size: 7px;">
                            <span>About</span>
                            <span>Work</span>
                            <span>Skills</span>
                        </div>
                    </div>

                    <div>
                        <span class="badge">CREATIVE PORTFOLIO</span>

                        <div style="display: flex; justify-content: space-between; align-items: center; gap: 8px; margin-top: 8px;">
                            <div>
                                <div style="font-size: 13px; font-weight: bold; line-height: 1.2;">
                                    Hey, I'm<br>
                                    <span style="color: #ff6b4a;">Your Name</span>
                                </div>
                                <div style="font-size: 7px; color: #777; margin-top: 4px;">Designer & Creator</div>
                                <span class="black-btn">Explore My Work ↗</span>
                            </div>
                            <div class="arch-avatar">Y</div>
                        </div>
                    </div>

                    <div style="font-size: 9px; font-weight: bold;">Things I've Created ✱</div>

                    <div class="cards-row">
                        <div class="c-card-1">
                            <div style="font-size: 7px; font-weight: bold;">PROJECT 01</div>
                            <div style="height: 4px; background: #111; margin-top: 7px; width: 75%;"></div>
                        </div>
                        <div class="c-card-2">
                            <div style="font-size: 7px; font-weight: bold;">PROJECT 02</div>
                            <div style="height: 4px; background: #111; margin-top: 7px; width: 60%;"></div>
                        </div>
                    </div>
                </div>

                <div class="card-info">
                    <h2>Creative</h2>
                    <p>A playful and expressive design with colorful cards, bold accents, and a unique layout.</p>
                </div>

                <form action="{{ route('portfolio.select-template', $portfolio->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="template" value="template3">
                    <button type="submit" class="card-btn">Choose Creative</button>
                </form>
            </article>

        </div>

        <a class="back-link" href="{{ route('portfolio.show', $portfolio->id) }}">
            ← Back to Portfolio
        </a>
    </div>

    <script>
        // Light and dark theme toggle
        const themeToggleBtn = document.getElementById('themeToggleBtn');
        const themeIcon = document.getElementById('themeIcon');

        function toggleTheme() {
            const isLight = document.body.getAttribute('data-theme') === 'light';

            if (isLight) {
                document.body.removeAttribute('data-theme');
                themeIcon.innerHTML = '<path d="M12 7a5 5 0 1 0 0 10 5 5 0 0 0 0-10zM11 1h2v3h-2zM11 20h2v3h-2zM1 11h3v2H1zM20 11h3v2h-3zM4.22 2.81l2.12 2.12-1.41 1.41L2.81 4.22zM17.66 17.66l1.41-1.41 2.12 2.12-1.41 1.41zM17.66 6.34l2.12-2.12 1.41 1.41-2.12 2.12zM2.81 19.78l2.12-2.12 1.41 1.41-2.12 2.12z"/>';
            } else {
                document.body.setAttribute('data-theme', 'light');
                themeIcon.innerHTML = '<path d="M12.3 2a10 10 0 0 0-1.9 20 10 10 0 0 0 9.6-7 1 1 0 0 0-1.2-1.3 8 8 0 1 1-6.5-11.7 1 1 0 0 0 0-2z"/>';
            }
        }

        themeToggleBtn.addEventListener('click', toggleTheme);

        // Animated background
        const canvas = document.getElementById('canvas');
        const ctx = canvas.getContext('2d');

        let width = 0;
        let height = 0;
        let phase = 0;

        function resizeCanvas() {
            const pixelRatio = Math.min(window.devicePixelRatio || 1, 2);

            width = window.innerWidth;
            height = window.innerHeight;

            canvas.width = width * pixelRatio;
            canvas.height = height * pixelRatio;
            canvas.style.width = width + 'px';
            canvas.style.height = height + 'px';

            ctx.setTransform(pixelRatio, 0, 0, pixelRatio, 0, 0);
        }

        function drawBackground() {
            ctx.clearRect(0, 0, width, height);

            const isDark = document.body.getAttribute('data-theme') !== 'light';

            // Background grid
            const gridSize = 30;
            ctx.strokeStyle = isDark
                ? 'rgba(255,255,255,0.035)'
                : 'rgba(0,0,0,0.04)';

            ctx.lineWidth = 1;
            ctx.beginPath();

            for (let x = 0; x < width; x += gridSize) {
                ctx.moveTo(x, 0);
                ctx.lineTo(x, height);
            }

            for (let y = 0; y < height; y += gridSize) {
                ctx.moveTo(0, y);
                ctx.lineTo(width, y);
            }

            ctx.stroke();

            // Moving waves
            const numberOfLines = 12;
            const waveRGB = isDark ? '160,180,240' : '79,70,229';

            for (let i = 0; i < numberOfLines; i++) {
                ctx.beginPath();

                ctx.strokeStyle = `rgba(${waveRGB}, ${(i / numberOfLines) * 0.35 + 0.08})`;
                ctx.lineWidth = 1.2;

                const frequency = 0.002;
                const amplitude = 70;
                const verticalOffset = height * 0.45 + (i - numberOfLines / 2) * 6;

                for (let x = 0; x <= width; x += 5) {
                    const wave1 = Math.sin(x * frequency + phase + i * 0.15) * amplitude;
                    const wave2 = Math.cos(x * frequency * 0.5 - phase * 0.5) * (amplitude * 0.5);
                    const envelope = Math.sin((x / Math.max(width, 1)) * Math.PI);
                    const y = verticalOffset + (wave1 + wave2) * envelope;

                    if (x === 0) {
                        ctx.moveTo(x, y);
                    } else {
                        ctx.lineTo(x, y);
                    }
                }

                ctx.stroke();
            }

            phase += 0.012;
            requestAnimationFrame(drawBackground);
        }

        window.addEventListener('resize', resizeCanvas);
        resizeCanvas();
        requestAnimationFrame(drawBackground);

        // Prevent accidental double-click form submissions
        document.querySelectorAll('.card form').forEach(function (form) {
            form.addEventListener('submit', function () {
                const button = form.querySelector('button[type="submit"]');

                if (button) {
                    button.disabled = true;
                    button.textContent = 'Opening Template...';
                }
            });
        });
    </script>
</body>
</html>
