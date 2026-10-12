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
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --bg-color: #0b0c10;
            --text-color: #fff;
            --subtext-color: #a0a6b8;
            --card-bg: rgba(20,22,30,.88);
            --card-border: rgba(255,255,255,.12);
            --input-bg: rgba(255,255,255,.05);
            --input-border: rgba(255,255,255,.16);
            --input-focus: #9aaaf0;
            --toggle-bg: rgba(255,255,255,.08);
            --toggle-border: rgba(255,255,255,.2);
        }
        [data-theme="light"] {
            --bg-color: #f5f7fb;
            --text-color: #111827;
            --subtext-color: #4b5563;
            --card-bg: rgba(255,255,255,.94);
            --card-border: rgba(0,0,0,.1);
            --input-bg: rgba(0,0,0,.025);
            --input-border: rgba(0,0,0,.16);
            --input-focus: #4f46e5;
            --toggle-bg: rgba(0,0,0,.05);
            --toggle-border: rgba(0,0,0,.15);
        }
        html, body {
            min-height: 100%;
            width: 100%;
            background: var(--bg-color);
            color: var(--text-color);
            font-family: Arial, Helvetica, sans-serif;
            overflow-x: hidden;
        }
        body { transition: background-color .25s, color .25s; }
        canvas {
            position: fixed; inset: 0; width: 100%; height: 100%;
            z-index: 0; pointer-events: none;
        }
        .container {
            position: relative; z-index: 1; width: 100%; min-height: 100vh;
            padding: 32px 20px;
        }
        header {
            display: flex; align-items: center; justify-content: space-between;
            gap: 20px; max-width: 780px; margin: 0 auto 28px;
        }
        .logo-group { display: flex; align-items: center; gap: 12px; }
        .logo-icon {
            width: 38px; height: 38px; border: 1px solid var(--toggle-border);
            border-radius: 50%; display: flex; align-items: center;
            justify-content: center; background: var(--toggle-bg);
        }
        .logo-icon svg { width: 20px; height: 20px; fill: var(--text-color); }
        .logo-text { font: 700 1.6rem 'Sansation', sans-serif; }
        .theme-toggle-btn {
            width: 42px; height: 42px; border-radius: 50%;
            border: 1px solid var(--toggle-border); background: var(--toggle-bg);
            color: var(--text-color); display: flex; align-items: center;
            justify-content: center; cursor: pointer;
        }
        .theme-toggle-btn svg { width: 20px; height: 20px; fill: currentColor; }
        .form-card {
            max-width: 780px; width: 100%; margin: 0 auto 35px;
            padding: 36px; border: 1px solid var(--card-border);
            border-radius: 16px; background: var(--card-bg);
            backdrop-filter: blur(12px); box-shadow: 0 10px 30px rgba(0,0,0,.15);
        }
        .hero-text { margin-bottom: 28px; }
        .hero-text h1 {
            font: 400 clamp(1.7rem, 4vw, 2.25rem) 'Mako', sans-serif;
            margin-bottom: 8px; text-transform: uppercase;
        }
        .hero-text p { color: var(--subtext-color); font: .95rem/1.7 'Lora', serif; }
        .form-section { margin-bottom: 28px; }
        .form-section h3 {
            font: 600 1rem 'Mako', sans-serif; letter-spacing: .4px;
            margin-bottom: 16px; padding-bottom: 8px;
            border-bottom: 1px solid var(--card-border);
        }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .form-group { display: flex; flex-direction: column; min-width: 0; margin-bottom: 16px; }
        label { color: var(--subtext-color); font: .86rem 'Lora', serif; margin-bottom: 7px; }
        .required { color: #f87171; }
        input[type="text"], input[type="email"], input[type="tel"], input[type="url"],
        input[type="file"], textarea {
            width: 100%; border: 1px solid var(--input-border);
            border-radius: 8px; padding: 12px 13px; background: var(--input-bg);
            color: var(--text-color); font: .92rem Arial, sans-serif; outline: none;
        }
        input[type="file"] { cursor: pointer; padding: 10px; }
        input:focus, textarea:focus { border-color: var(--input-focus); }
        input::placeholder, textarea::placeholder { color: var(--subtext-color); opacity: .8; }
        input[type="file"]::file-selector-button {
            margin-right: 10px; padding: 7px 10px; border: 0; border-radius: 5px;
            background: var(--toggle-bg); color: var(--text-color); cursor: pointer;
        }
        textarea { min-height: 100px; resize: vertical; line-height: 1.5; }
        .hint { margin-top: 6px; color: var(--subtext-color); font-size: .78rem; line-height: 1.5; }
        .error-box {
            padding: 13px 15px; margin-bottom: 22px; border: 1px solid #ef4444;
            border-radius: 8px; background: rgba(239,68,68,.09); color: #fca5a5;
        }
        .error-box ul { padding-left: 20px; margin-top: 5px; }
        .field-error { color: #fca5a5; font-size: .8rem; margin-top: 6px; }
        .submit-btn {
            width: 100%; margin-top: 4px; padding: 14px 20px;
            border: 1px solid var(--toggle-border); border-radius: 8px;
            background: var(--toggle-bg); color: var(--text-color);
            font: 500 .95rem 'Lora', serif; cursor: pointer;
            transition: transform .2s, background .2s, border-color .2s;
        }
        .submit-btn:hover { border-color: var(--text-color); transform: translateY(-1px); }
        .submit-btn:disabled { opacity: .65; cursor: wait; transform: none; }
        @media (max-width: 640px) {
            .container { padding: 22px 14px; }
            .form-card { padding: 22px 17px; }
            .form-row { grid-template-columns: 1fr; gap: 0; }
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

            <button type="button" class="theme-toggle-btn" id="themeToggleBtn"
                    aria-label="Toggle light and dark theme" title="Toggle Light/Dark Theme">
                <svg id="themeIcon" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 7a5 5 0 1 0 0 10 5 5 0 0 0 0-10zM11 1h2v3h-2zM11 20h2v3h-2zM1 11h3v2H1zM20 11h3v2h-3zM4.22 2.81l2.12 2.12-1.41 1.41L2.81 4.22zM17.66 17.66l1.41-1.41 2.12 2.12-1.41 1.41zM17.66 6.34l2.12-2.12 1.41 1.41-2.12 2.12zM2.81 19.78l2.12-2.12 1.41 1.41-2.12 2.12z"/>
                </svg>
            </button>
        </header>

        <main class="form-card">
            <div class="hero-text">
                <h1>Create Your Portfolio</h1>
                <p>Enter your information below to build your personal portfolio.</p>
            </div>

            @if ($errors->any())
                <div class="error-box" role="alert">
                    <strong>Please check the following information:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="portfolioForm"
                  action="{{ route('portfolio.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                <section class="form-section">
                    <h3>1. Personal Information</h3>

                    <div class="form-group">
                        <label for="full_name">Full Name <span class="required">*</span></label>
                        <input id="full_name" name="full_name" type="text"
                               value="{{ old('full_name') }}" placeholder="e.g. Ria Angel"
                               autocomplete="name" required>
                        @error('full_name') <span class="field-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email <span class="required">*</span></label>
                            <input id="email" name="email" type="email"
                                   value="{{ old('email') }}" placeholder="you@example.com"
                                   autocomplete="email" required>
                            @error('email') <span class="field-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="contact_number">Contact Number</label>
                            <input id="contact_number" name="contact_number" type="tel"
                                   value="{{ old('contact_number') }}" placeholder="+63 912 345 6789"
                                   autocomplete="tel">
                            @error('contact_number') <span class="field-error">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input id="address" name="address" type="text"
                               value="{{ old('address') }}" placeholder="City, Country"
                               autocomplete="street-address">
                        @error('address') <span class="field-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="profile_picture">Profile Picture</label>
                        <input id="profile_picture" name="profile_picture" type="file"
                               accept="image/jpeg,image/png,image/webp">
                        <span class="hint">Optional. Choose a JPG, PNG, or WebP image.</span>
                        @error('profile_picture') <span class="field-error">{{ $message }}</span> @enderror
                    </div>
                </section>

                <section class="form-section">
                    <h3>2. About Me</h3>
                    <div class="form-group">
                        <label for="about_me">Introduction</label>
                        <textarea id="about_me" name="about_me"
                                  placeholder="Write a short introduction about yourself...">{{ old('about_me') }}</textarea>
                        @error('about_me') <span class="field-error">{{ $message }}</span> @enderror
                    </div>
                </section>

                <section class="form-section">
                    <h3>3. Education and Skills</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="education">Educational Background</label>
                            <textarea id="education" name="education"
                                      placeholder="Degree, school, course, or graduation year...">{{ old('education') }}</textarea>
                            @error('education') <span class="field-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="skills">Skills</label>
                            <textarea id="skills" name="skills"
                                      placeholder="HTML, CSS, PHP, Laravel...">{{ old('skills') }}</textarea>
                            @error('skills') <span class="field-error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </section>

                <section class="form-section">
                    <h3>4. Experience and Projects</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="work_experience">Work Experience</label>
                            <textarea id="work_experience" name="work_experience"
                                      placeholder="Previous roles, companies, internships, or experience...">{{ old('work_experience') }}</textarea>
                            @error('work_experience') <span class="field-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="projects">Projects</label>
                            <textarea id="projects" name="projects"
                                      placeholder="Describe projects you have created...">{{ old('projects') }}</textarea>
                            @error('projects') <span class="field-error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </section>

                <section class="form-section">
                    <h3>5. Social Links</h3>
                    <div class="form-group">
                        <label for="social_links">Social Media or Website Links</label>
                        <textarea id="social_links" name="social_links"
                                  placeholder="GitHub, LinkedIn, or personal website URL...">{{ old('social_links') }}</textarea>
                        @error('social_links') <span class="field-error">{{ $message }}</span> @enderror
                    </div>
                </section>

                <button type="submit" class="submit-btn" id="submitBtn">
                    Continue to Templates
                </button>
            </form>
        </main>
    </div>

    <script>
        // Light/dark theme toggle
        const themeToggleBtn = document.getElementById('themeToggleBtn');
        const themeIcon = document.getElementById('themeIcon');

        themeToggleBtn.addEventListener('click', function () {
            const isLight = document.body.getAttribute('data-theme') === 'light';

            if (isLight) {
                document.body.removeAttribute('data-theme');
                themeIcon.innerHTML = '<path d="M12 7a5 5 0 1 0 0 10 5 5 0 0 0 0-10zM11 1h2v3h-2zM11 20h2v3h-2zM1 11h3v2H1zM20 11h3v2h-3zM4.22 2.81l2.12 2.12-1.41 1.41L2.81 4.22zM17.66 17.66l1.41-1.41 2.12 2.12-1.41 1.41zM17.66 6.34l2.12-2.12 1.41 1.41-2.12 2.12zM2.81 19.78l2.12-2.12 1.41 1.41-2.12 2.12z"/>';
            } else {
                document.body.setAttribute('data-theme', 'light');
                themeIcon.innerHTML = '<path d="M12.3 2a10 10 0 0 0-1.9 20 10 10 0 0 0 9.6-7 1 1 0 0 0-1.2-1.3 8 8 0 1 1-6.5-11.7 1 1 0 0 0 0-2z"/>';
            }
        });

        // Animated grid and waves in the background
        const canvas = document.getElementById('canvas');
        const ctx = canvas.getContext('2d');
        let width = 0;
        let height = 0;
        let phase = 0;

        function resizeCanvas() {
            const ratio = Math.min(window.devicePixelRatio || 1, 2);
            width = window.innerWidth;
            height = window.innerHeight;
            canvas.width = width * ratio;
            canvas.height = height * ratio;
            canvas.style.width = width + 'px';
            canvas.style.height = height + 'px';
            ctx.setTransform(ratio, 0, 0, ratio, 0, 0);
        }

        function animateBackground() {
            ctx.clearRect(0, 0, width, height);
            const isDark = document.body.getAttribute('data-theme') !== 'light';

            ctx.strokeStyle = isDark ? 'rgba(255,255,255,0.035)' : 'rgba(0,0,0,0.04)';
            ctx.lineWidth = 1;
            ctx.beginPath();

            for (let x = 0; x < width; x += 30) {
                ctx.moveTo(x, 0);
                ctx.lineTo(x, height);
            }
            for (let y = 0; y < height; y += 30) {
                ctx.moveTo(0, y);
                ctx.lineTo(width, y);
            }
            ctx.stroke();

            const waveRGB = isDark ? '160,180,240' : '79,70,229';
            for (let i = 0; i < 12; i++) {
                ctx.beginPath();
                ctx.strokeStyle = `rgba(${waveRGB}, ${(i / 12) * 0.35 + 0.08})`;
                ctx.lineWidth = 1.2;

                const offset = height * 0.45 + (i - 6) * 6;
                for (let x = 0; x <= width; x += 6) {
                    const envelope = Math.sin((x / Math.max(width, 1)) * Math.PI);
                    const y = offset + (
                        Math.sin(x * 0.002 + phase + i * 0.15) * 65 +
                        Math.cos(x * 0.001 - phase * 0.5) * 32
                    ) * envelope;

                    if (x === 0) ctx.moveTo(x, y);
                    else ctx.lineTo(x, y);
                }
                ctx.stroke();
            }

            phase += 0.012;
            requestAnimationFrame(animateBackground);
        }

        window.addEventListener('resize', resizeCanvas);
        resizeCanvas();
        requestAnimationFrame(animateBackground);

        // Prevent repeated clicks while Laravel is receiving the form
        document.getElementById('portfolioForm').addEventListener('submit', function () {
            const button = document.getElementById('submitBtn');
            button.disabled = true;
            button.textContent = 'Saving Portfolio...';
        });
    </script>
</body>
</html>
