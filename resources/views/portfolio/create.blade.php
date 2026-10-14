<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PortGen - Create Your Portfolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600;700&family=Mako&family=Sansation:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        *{margin:0;padding:0;box-sizing:border-box;transition:background-color .3s ease,color .3s ease,border-color .3s ease}
        :root{--bg-color:#060709;--grid-line:rgba(255,255,255,.08);--text-color:#fff;--subtext-color:#9ba1b0;--card-bg:rgba(16,18,27,.82);--card-border:rgba(255,255,255,.12);--input-bg:rgba(255,255,255,.04);--input-border:rgba(255,255,255,.17);--input-focus:#8a9eff;--btn-bg:#5b5feF;--btn-text:#fff;--error:#ff9b9b}
        [data-theme="light"]{--bg-color:#f0f3f9;--grid-line:rgba(0,0,0,.08);--text-color:#0f172a;--subtext-color:#475569;--card-bg:rgba(255,255,255,.9);--card-border:rgba(0,0,0,.1);--input-bg:rgba(0,0,0,.02);--input-border:rgba(0,0,0,.16);--input-focus:#4f46e5;--btn-bg:#4f46e5;--btn-text:#fff;--error:#b91c1c}
        html, body {
            min-height: 100%;
            width: 100%;
            background: var(--bg-color);
            color: var(--text-color);
            font-family: Arial, Helvetica, sans-serif;
            overflow-x: hidden;
        }

        body {
            position: relative;
        }

        /* Animated grid background */
        .grid-container {
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .animated-grid {
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background-image:
                linear-gradient(to right, var(--grid-line) 1px, transparent 1px),
                linear-gradient(to bottom, var(--grid-line) 1px, transparent 1px);
            background-size: 48px 48px;
            animation: scrollGrid 18s linear infinite;
        }

        @keyframes scrollGrid {
            to {
                transform: translate(48px, 48px);
            }
        }

        canvas {
            display: block;
            position: fixed;
            inset: 0;
            width: 100vw;
            height: 100vh;
            z-index: 1;
            pointer-events: none;
        }

        .container {
            position: relative;
            z-index: 2;
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 32px 20px 70px;
        }
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            max-width: 820px;
            margin: 0 auto 36px;
        }
        .logo-group { display: flex; align-items: center; gap: 12px; }
        .logo-icon { width: 40px; height: 40px; border: 1px solid var(--card-border); border-radius: 50%; display: grid; place-items: center; background: var(--card-bg); backdrop-filter: blur(10px); }
        .logo-icon svg { width: 21px; height: 21px; fill: var(--text-color); }
        .logo-text { font: 700 1.7rem 'Sansation', sans-serif; letter-spacing: -.5px; }
        .theme-toggle-btn{width:44px;height:44px;border:1px solid var(--card-border);border-radius:50%;display:grid;place-items:center;background:var(--card-bg);color:var(--text-color);cursor:pointer}.theme-toggle-btn svg{width:20px;height:20px;fill:currentColor}
        .hero-text{text-align:center;margin:0 auto 34px;max-width:820px}.hero-text h1{font:400 clamp(1.8rem,5vw,2.5rem) 'Mako',sans-serif;letter-spacing:-.5px;margin-bottom:10px;text-transform:uppercase}.hero-text p{font:1rem 'Lora',serif;color:var(--subtext-color);line-height:1.6}
        .form-wrapper {
            max-width: 820px;
            width: 100%;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 22px;
        }
        .form-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, .18);
            position: relative;
            overflow: hidden;
        }
        .form-card:before{content:'';position:absolute;top:0;left:0;width:4px;height:100%;background:linear-gradient(to bottom,#8a9eff,#4f46e5);opacity:.9}
        .form-card h3{font:600 1.15rem 'Mako',sans-serif;margin-bottom:22px;color:var(--text-color);border-bottom:1px solid var(--card-border);padding-bottom:12px;letter-spacing:.3px}
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
        .form-group { margin-bottom: 17px; display: flex; flex-direction: column; min-width: 0; }
        .form-group:last-child { margin-bottom: 0; }
        .form-group.full-width { grid-column: 1 / -1; }
        label{font: .9rem 'Lora',serif;color:var(--subtext-color);margin-bottom:8px}label .required{color:#a5b4fc}
        input[type=text],input[type=email],input[type=tel],input[type=url],input[type=file],textarea{background:var(--input-bg);border:1px solid var(--input-border);border-radius:10px;padding:13px 15px;color:var(--text-color);font: .95rem Arial,sans-serif;outline:none;width:100%}
        input:focus,textarea:focus{border-color:var(--input-focus);box-shadow:0 0 0 3px rgba(138,158,255,.16)}textarea{resize:vertical;min-height:110px;line-height:1.5}input[type=file]{padding:10px;cursor:pointer;color:var(--subtext-color)}input::placeholder,textarea::placeholder{color:var(--subtext-color);opacity:.8}
        .help-text{color:var(--subtext-color);font-size:.8rem;margin-top:7px;line-height:1.4}.error-box{background:rgba(220,38,38,.12);border:1px solid rgba(248,113,113,.4);color:var(--error);border-radius:12px;padding:15px 18px}.error-box ul{padding-left:20px;margin-top:8px}.field-error{color:var(--error);font-size:.82rem;margin-top:6px}
        .submit-btn{display:block;width:100%;background:var(--btn-bg);border:1px solid transparent;color:var(--btn-text);padding:17px 24px;border-radius:12px;font-size:1rem;font-weight:700;cursor:pointer;text-align:center;margin-top:3px;box-shadow:0 10px 25px rgba(79,70,229,.2)}.submit-btn:hover{filter:brightness(1.1);transform:translateY(-2px)}.submit-btn:disabled{opacity:.7;cursor:wait;transform:none}
        @media(max-width:768px){.container{padding:20px 13px 45px}header{margin-bottom:28px}.form-card{padding:22px 19px}.form-row{grid-template-columns:1fr;gap:0}.form-group.full-width{grid-column:1}.hero-text{margin-bottom:26px}}

        /* Shared PortGen homepage theme */
        :root { --bg-color:#0c0e12; --text-color:#ffffff; --subtext-color:#d1d5db; --card-bg:rgba(18,20,26,.72); --card-border:rgba(56,189,248,.35); --input-bg:rgba(12,14,18,.72); --input-border:rgba(56,189,248,.28); --input-focus:#38bdf8; --btn-bg:rgba(20,20,25,.9); --btn-text:#ffffff; --error:#fecaca; }
        [data-theme="light"] { --bg-color:#f8fafc; --text-color:#0f172a; --subtext-color:#475569; --card-bg:rgba(255,255,255,.82); --card-border:rgba(2,132,199,.3); --input-bg:rgba(255,255,255,.8); --input-border:rgba(2,132,199,.25); --input-focus:#0284c7; --btn-bg:#0284c7; --btn-text:#ffffff; --error:#b91c1c; }
        body { background:var(--bg-color); color:var(--text-color); font-family:'Lora',serif; }
        .container, .form-wrapper, .hero-text, header { position:relative; z-index:2; }
        header { max-width:1280px; padding:16px 22px; border:2px solid var(--input-focus); border-radius:8px; background:var(--card-bg); box-shadow:0 0 15px rgba(56,189,248,.16); backdrop-filter:blur(12px); }
        .logo-icon { border-color:var(--input-focus); color:var(--input-focus); }
        .logo-text { color:var(--input-focus); }
        .hero-text h1 { font-family:'Mako',sans-serif; }
        .form-card { border-color:var(--card-border); background:var(--card-bg); box-shadow:0 16px 48px rgba(0,0,0,.2),0 0 18px rgba(56,189,248,.06); }
        .form-card:before { background:linear-gradient(to bottom,#38bdf8,#0284c7); }
        .submit-btn { background:var(--btn-bg); border:1px solid var(--input-focus); box-shadow:0 0 18px rgba(56,189,248,.16); }
        .theme-toggle-btn { border-color:var(--input-focus); }
    </style>
</head>
<body>
    <div class="grid-container" aria-hidden="true">
        <div class="animated-grid"></div>
    </div>
    <canvas id="canvas" aria-hidden="true"></canvas>

    <div class="container">
        <header>
            <div class="logo-group">
                <div class="logo-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-14a6 6 0 100 12 6 6 0 000-12z"/></svg></div>
                <div class="logo-text">PortGen</div>
            </div>
            <button class="theme-toggle-btn" id="themeToggleBtn" type="button" onclick="toggleTheme()" title="Toggle light/dark theme" aria-label="Toggle light and dark theme"><svg id="themeIcon" viewBox="0 0 24 24"><path d="M12 7a5 5 0 100 10 5 5 0 000-10zM11 1h2v4h-2zm0 18h2v4h-2zM1 11h4v2H1zm18 0h4v2h-4zM4.22 5.64l1.42-1.42 2.12 2.12-1.42 1.42zm12.02 12.02 1.42-1.42 2.12 2.12-1.42 1.42zm1.42-11.32 2.12-2.12 1.42 1.42-2.12 2.12zM4.22 19.07l2.12-2.12 1.42 1.42-2.12 2.12z"/></svg></button>
        </header>

        <div class="hero-text">
            <h1>Create Your Portfolio</h1>
            <p>Enter your information below in distinct sections to build your personal portfolio.</p>
        </div>

        @if ($errors->any())
            <div class="error-box" style="max-width:820px;width:100%;margin:0 auto 22px;position:relative;z-index:2;">
                <strong>Please correct the following:</strong>
                <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <form action="{{ route('portfolio.store') }}" method="POST" enctype="multipart/form-data" id="portfolioForm">
            @csrf
            <div class="form-wrapper">
                <section class="form-card">
                    <h3>1. Personal Information</h3>
                    <div class="form-group full-width">
                        <label for="full_name">Full Name <span class="required">*</span></label>
                        <input id="full_name" name="full_name" type="text" value="{{ old('full_name') }}" placeholder="e.g. Ria Angel" required maxlength="255" autocomplete="name">
                        @error('full_name')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email <span class="required">*</span></label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="ria@example.com" required maxlength="255" autocomplete="email">
                            @error('email')<span class="field-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="contact_number">Contact Number</label>
                            <input id="contact_number" name="contact_number" type="tel" value="{{ old('contact_number') }}" placeholder="e.g. 09123456789" maxlength="30" autocomplete="tel">
                            @error('contact_number')<span class="field-error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="form-group full-width">
                        <label for="address">Address</label>
                        <input id="address" name="address" type="text" value="{{ old('address') }}" placeholder="City, Country" maxlength="255" autocomplete="street-address">
                        @error('address')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group full-width">
                        <label for="profile_picture">Profile Picture</label>
                        <input id="profile_picture" name="profile_picture" type="file" accept="image/*">
                        <span class="help-text">Optional. Choose an image file for your portfolio profile.</span>
                        @error('profile_picture')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </section>

                <section class="form-card">
                    <h3>2. About Me</h3>
                    <div class="form-group full-width">
                        <label for="about_me">Introduction</label>
                        <textarea id="about_me" name="about_me" placeholder="Write a short bio about yourself, your passion, and what drives you...">{{ old('about_me') }}</textarea>
                        @error('about_me')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </section>

                <section class="form-card">
                    <h3>3. Education and Skills</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="education">Educational Background</label>
                            <textarea id="education" name="education" placeholder="Your degree, school or university, and graduation year...">{{ old('education') }}</textarea>
                            @error('education')<span class="field-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="skills">Skills</label>
                            <textarea id="skills" name="skills" placeholder="HTML, CSS, JavaScript, PHP, Laravel...">{{ old('skills') }}</textarea>
                            @error('skills')<span class="field-error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </section>

                <section class="form-card">
                    <h3>4. Experience and Projects</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="work_experience">Work Experience</label>
                            <textarea id="work_experience" name="work_experience" placeholder="Previous roles, organizations, and companies...">{{ old('work_experience') }}</textarea>
                            @error('work_experience')<span class="field-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="projects">Projects</label>
                            <textarea id="projects" name="projects" placeholder="Notable projects you have built...">{{ old('projects') }}</textarea>
                            @error('projects')<span class="field-error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </section>

                <section class="form-card">
                    <h3>5. Social Links</h3>
                    <div class="form-group full-width">
                        <label for="social_links">Social Media or Website Links</label>
                        <textarea id="social_links" name="social_links" placeholder="GitHub, LinkedIn, or personal website URL...">{{ old('social_links') }}</textarea>
                        @error('social_links')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </section>

                <button type="submit" class="submit-btn" id="submitBtn">Continue to Templates →</button>
            </div>
        </form>
    </div>

    <script>
        // Animated background matching the Choose Template page.
        const canvas = document.getElementById('canvas');
        const ctx = canvas ? canvas.getContext('2d') : null;

        let waveWidth = 0;
        let waveHeight = 0;
        let waveTime = 0;
        let mouseX = window.innerWidth / 2;
        let mouseY = window.innerHeight / 2;
        let targetX = mouseX;
        let targetY = mouseY;

        function resizeCanvas() {
            if (!canvas || !ctx) return;

            const pixelRatio = window.devicePixelRatio || 1;
            waveWidth = window.innerWidth;
            waveHeight = window.innerHeight;
            canvas.width = Math.floor(waveWidth * pixelRatio);
            canvas.height = Math.floor(waveHeight * pixelRatio);
            canvas.style.width = waveWidth + 'px';
            canvas.style.height = waveHeight + 'px';
            ctx.setTransform(pixelRatio, 0, 0, pixelRatio, 0, 0);
        }

        function drawWaves() {
            if (!canvas || !ctx) return;

            mouseX += (targetX - mouseX) * 0.025;
            mouseY += (targetY - mouseY) * 0.025;
            ctx.clearRect(0, 0, waveWidth, waveHeight);

            const isLight = document.body.getAttribute('data-theme') === 'light';
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

        window.addEventListener('resize', resizeCanvas);
        window.addEventListener('mousemove', (event) => {
            targetX = event.clientX;
            targetY = event.clientY;
        });

        resizeCanvas();
        drawWaves();

        let currentTheme = 'dark';

        function toggleTheme() {
            const body = document.body;
            const isLight = body.getAttribute('data-theme') === 'light';

            if (isLight) {
                body.removeAttribute('data-theme');
                currentTheme = 'dark';
            } else {
                body.setAttribute('data-theme', 'light');
                currentTheme = 'light';
            }
        }

        document.getElementById('portfolioForm').addEventListener('submit', function () {
            const button = document.getElementById('submitBtn');
            button.disabled = true;
            button.textContent = 'Submitting...';
        });
    </script>
</body>
</html>
