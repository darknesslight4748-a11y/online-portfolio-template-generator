<!DOCTYPE html>
<html lang="en" class="h-full dark">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PortGen - Edit Portfolio</title>
        <script src="https://cdn.tailwindcss.com">
        </script>
        <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600;700&family=Mako&family=Sansation:wght@300;400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <script>tailwind.config={darkMode:'class',theme:{extend:{fontFamily:{sansation:['Sansation','sans-serif'],mako:['Mako','sans-serif'],lora:['Lora','Georgia','serif']}}}};</script>
        <style>
:root {

    --grid-line:rgba(255,255,255,.08);

    --bg:#06080d;

    --text:#cbd5e1;

    --card:rgba(13,17,24,.9);

    --border:rgba(255,255,255,.1);

    --title:#fff;

    --sub:#94a3b8;

}

html.light {

    --grid-line:rgba(0,0,0,.08);

    --bg:#f8fafc;

    --text:#334155;

    --card:rgba(255,255,255,.82);

    --border:rgba(2,132,199,.3);

    --title:#0f172a;

    --sub:#475569;

}

body {

    background:var(--bg);

    color:var(--text);

    font-family:system-ui,sans-serif;

    min-height:100vh;

    margin:0;

    transition:background-color .3s,color .3s;

}

#bgCanvas {

    position:fixed;

    inset:0;

    width:100%;

    height:100%;

    z-index:1;

    pointer-events:none;

}

.content {

    position:relative;

    z-index:2;

}

.glass {

    background:var(--card);

    border:1px solid var(--border);

    border-radius:18px;

    backdrop-filter:blur(16px);

    box-shadow:0 24px 70px rgba(0,0,0,.22);

}

.field-label {

    display:block;

    color:var(--sub);

    font-size:.82rem;

    font-weight:600;

    margin-bottom:.45rem;

}

.field {

    width:100%;

    box-sizing:border-box;

    background:rgba(100,116,139,.08);

    border:1px solid var(--border);

    border-radius:10px;

    padding:.75rem .85rem;

    color:var(--title);

    outline:none;

    transition:border-color .2s,box-shadow .2s;

}

.field:focus {

    border-color:#818cf8;

    box-shadow:0 0 0 3px rgba(129,140,248,.15);

}

.field::placeholder {

    color:var(--sub);

    opacity:.75;

}

textarea.field {

    resize:vertical;

    min-height:110px;

}

.action {

    font-family:'Lora',Georgia,serif;

    background:rgba(79,70,229,.16);

    border:1px solid rgba(129,140,248,.55);

    color:var(--title);

    transition:.2s;

}

.action:hover {

    background:rgba(99,102,241,.3);

    border-color:#818cf8;

}

.theme-btn {

    width:42px;

    height:42px;

    border-radius:50%;

    border:1px solid var(--border);

    background:var(--card);

    color:var(--title);

    cursor:pointer;

}

.section-title {

    color:var(--title);

    font-family:'Mako',sans-serif;

    font-size:1.1rem;

    letter-spacing:.04em;

}/* PortGen navbar matching the Create Portfolio page */

.portgen-navbar {
    width: 100%;
    max-width: 1280px;
    min-height: 80px;
    margin: 0 auto;
    padding: 14px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border: 2px solid #38bdf8;
    border-radius: 9px;
    background: rgba(12, 14, 18, 0.88);
    box-shadow: 0 0 16px rgba(56, 189, 248, 0.12);
    position: relative;
    z-index: 5;
}

html.light .portgen-navbar {
    background: rgba(248, 250, 252, 0.9);
}

.portgen-logo {
    color: #38bdf8;
    font-family: 'Sansation', sans-serif;
    font-size: 1.65rem;
    font-weight: 700;
    letter-spacing: -0.03em;
    text-decoration: none;
}

.portgen-theme-toggle {
    width: 44px;
    height: 44px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #38bdf8;
    border-radius: 50%;
    background: transparent;
    color: var(--title);
    cursor: pointer;
    transition: background-color 0.2s ease, transform 0.2s ease;
}

.portgen-theme-toggle:hover {
    background: rgba(56, 189, 248, 0.12);
    transform: translateY(-1px);
}

@media (max-width: 600px) {
    .portgen-navbar {
        min-height: 68px;
        padding: 10px 14px;
    }

    .portgen-logo {
        font-size: 1.4rem;
    }
}

/* Shared PortGen homepage theme */

        :root {

    --bg:#0c0e12;

    --text:#d1d5db;

    --card:rgba(18,20,26,.72);

    --border:rgba(56,189,248,.35);

    --title:#ffffff;

    --sub:#d1d5db;

}

html.light {

    --bg:#f8fafc;

    --text:#334155;

    --card:rgba(255,255,255,.82);

    --border:rgba(2,132,199,.3);

    --title:#0f172a;

    --sub:#475569;

}

body {

    font-family:'Lora',serif;

}

.glass {

    border-color:var(--border);

    box-shadow:0 16px 48px rgba(0,0,0,.2),0 0 18px rgba(56,189,248,.06);

}

.action {

    background:rgba(20,20,25,.85);

    border-color:rgba(56,189,248,.5);

    color:var(--title);

}

html.light .action {

    background:#0284c7;

    color:#fff;

    border-color:#0284c7;

}

.action:hover {

    background:rgba(56,189,248,.18);

    border-color:#38bdf8;

}

.theme-btn {

    border-color:var(--border);

}

.field:focus {

    border-color:#38bdf8;

    box-shadow:0 0 0 3px rgba(56,189,248,.15);

}

.section-title {

    font-family:'Mako',sans-serif;

}/* Animated grid background */

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
    </style>
    </head>
    <body class="flex flex-col px-5 py-6 sm:px-8 lg:px-12">
        <div class="grid-container" aria-hidden="true">
            <div class="animated-grid">
            </div>
        </div>
        <canvas id="bgCanvas">
        </canvas>
        <header class="content portgen-navbar">
            <a href="{{ route('portfolio.show', $portfolio->id) }}" class="portgen-logo">
                PortGen
            </a>

            <button
                type="button"
                id="themeToggleButton"
                onclick="toggleTheme()"
                class="portgen-theme-toggle"
                aria-label="Toggle dark and light mode"
                title="Toggle dark/light mode"
            >
                <i id="themeIcon" class="fa-regular fa-sun" aria-hidden="true"></i>
            </button>
        </header>
    <main class="content w-full max-w-5xl mx-auto my-10 flex-1">
        <div class="mb-8">
            <p class="text-xs uppercase tracking-[.25em] text-indigo-400 font-bold mb-3">Portfolio Studio / Edit</p>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-mako uppercase" style="color:var(--title)">Edit Your Portfolio</h1>
            <p class="font-lora text-sm sm:text-base mt-3" style="color:var(--sub)">Update your information and keep your portfolio looking its best.</p>
        </div>
        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-400/40 bg-red-500/10 p-4 text-sm text-red-400" role="alert">
                <p class="font-bold mb-1">Please check the following:</p>
                <ul class="list-disc pl-5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif
        <form method="POST" action="{{ route('portfolio.update', $portfolio->id) }}" enctype="multipart/form-data" class="glass p-5 sm:p-8 space-y-8">
        @csrf
        @method('PUT')
        <section class="space-y-5">
            <h2 class="section-title flex items-center gap-3">
                <i class="fa-regular fa-id-card text-indigo-400">
                </i> Personal Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="field-label" for="full_name">Full Name *</label>
                        <input class="field" id="full_name" name="full_name" value="{{ old('full_name', $portfolio->full_name) }}" placeholder="Enter your full name" required>
                    </div>
                    <div>
                        <label class="field-label" for="email">Email *</label>
                        <input class="field" type="email" id="email" name="email" value="{{ old('email', $portfolio->email) }}" placeholder="you@example.com" required>
                    </div>
                    <div>
                        <label class="field-label" for="contact_number">Contact Number</label>
                        <input class="field" id="contact_number" name="contact_number" value="{{ old('contact_number', $portfolio->contact_number) }}" placeholder="Enter your contact number">
                    </div>
                    <div>
                        <label class="field-label" for="address">Address</label>
                        <input class="field" id="address" name="address" value="{{ old('address', $portfolio->address) }}" placeholder="City, Province">
                    </div>
                </div>
                <div>
                    <label class="field-label" for="about_me">About Me</label>
                    <textarea class="field" id="about_me" name="about_me" placeholder="Write a short introduction about yourself">{{ old('about_me', $portfolio->about_me) }}</textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="field-label" for="profile_picture">Profile Picture</label>
                        @if ($portfolio->profile_picture)
                            <div class="flex items-center gap-4 mb-3">
                                <img src="{{ asset('storage/' . $portfolio->profile_picture) }}" alt="Current profile picture" class="w-16 h-16 rounded-xl object-cover border border-slate-500/30">
                                <span class="text-xs" style="color:var(--sub)">Current profile picture</span>
                            </div>
                        @endif
                        <input class="field" type="file" id="profile_picture" name="profile_picture" accept="image/*">
                        <p class="text-xs mt-2" style="color:var(--sub)">Choose a new image only if you want to replace the current one.</p>
                    </div>
                    <div>
                        <label class="field-label" for="education">Educational Background</label>
                        <textarea class="field" id="education" name="education" placeholder="School, course, year, or qualifications">{{ old('education', $portfolio->education) }}</textarea>
                    </div>
                </div>
            </section>
            <div class="border-t" style="border-color:var(--border)">
            </div>
            <section class="space-y-5">
                <h2 class="section-title flex items-center gap-3">
                    <i class="fa-solid fa-code text-indigo-400">
                    </i> Skills & Experience</h2>
                    <div>
                        <label class="field-label" for="skills">Skills</label>
                        <textarea class="field" id="skills" name="skills" placeholder="List your skills">{{ old('skills', $portfolio->skills) }}</textarea>
                    </div>
                    <div>
                        <label class="field-label" for="projects">Projects</label>
                        <textarea class="field" id="projects" name="projects" placeholder="Describe your projects">{{ old('projects', $portfolio->projects) }}</textarea>
                    </div>
                    <div>
                        <label class="field-label" for="work_experience">Work Experience</label>
                        <textarea class="field" id="work_experience" name="work_experience" placeholder="Describe your work experience or internships">{{ old('work_experience', $portfolio->work_experience) }}</textarea>
                    </div>
                    <div>
                        <label class="field-label" for="social_links">Social Media / Website Links</label>
                        <textarea class="field" id="social_links" name="social_links" placeholder="Add your LinkedIn, GitHub, website, or other links">{{ old('social_links', $portfolio->social_links) }}</textarea>
                    </div>
                </section>
                <div class="flex flex-col-reverse sm:flex-row gap-3 justify-end border-t pt-6" style="border-color:var(--border)">
                    <a href="{{ route('portfolio.show', $portfolio->id) }}" class="px-6 py-3 rounded-xl border text-center text-sm font-medium hover:bg-slate-500/10" style="border-color:var(--border);color:var(--sub)">Cancel</a>
                    <button type="submit" class="action px-7 py-3 rounded-xl text-sm font-semibold">
                        <i class="fa-solid fa-floppy-disk mr-2">
                        </i>Save Changes</button>
                    </div>
                </form>
            </main>
            <footer class="content w-full max-w-5xl mx-auto py-4 text-xs" style="color:var(--sub)">PortGen · Portfolio Template Generator</footer>
<script>
let isDarkMode = !document.documentElement.classList.contains('light');

function toggleTheme() {
    isDarkMode = !isDarkMode;
    document.documentElement.classList.toggle('dark', isDarkMode);
    document.documentElement.classList.toggle('light', !isDarkMode);

    const themeIcon = document.getElementById('themeIcon');
    if (themeIcon) {
        themeIcon.className = isDarkMode ? 'fa-regular fa-sun' : 'fa-regular fa-moon';
    }
}

const canvas = document.getElementById('bgCanvas');
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

    const isLight = document.documentElement.classList.contains('light');
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
</script>
</body>
</html>
