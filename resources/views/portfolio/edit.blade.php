<!DOCTYPE html>
<html lang="en" class="h-full dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PortGen - Edit Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600;700&family=Mako&family=Sansation:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>tailwind.config={darkMode:'class',theme:{extend:{fontFamily:{sansation:['Sansation','sans-serif'],mako:['Mako','sans-serif'],lora:['Lora','Georgia','serif']}}}};</script>
    <style>
        :root{--bg:#06080d;--text:#cbd5e1;--card:rgba(13,17,24,.9);--border:rgba(255,255,255,.1);--title:#fff;--sub:#94a3b8}
        html.light{--bg:#f1f5f9;--text:#334155;--card:rgba(255,255,255,.94);--border:rgba(203,213,225,.9);--title:#0f172a;--sub:#64748b}
        body{background:var(--bg);color:var(--text);font-family:system-ui,sans-serif;min-height:100vh;margin:0;transition:background-color .3s,color .3s}
        #bgCanvas{position:fixed;inset:0;width:100%;height:100%;z-index:0;pointer-events:none}
        .content{position:relative;z-index:1}.glass{background:var(--card);border:1px solid var(--border);border-radius:18px;backdrop-filter:blur(16px);box-shadow:0 24px 70px rgba(0,0,0,.22)}
        .field-label{display:block;color:var(--sub);font-size:.82rem;font-weight:600;margin-bottom:.45rem}
        .field{width:100%;box-sizing:border-box;background:rgba(100,116,139,.08);border:1px solid var(--border);border-radius:10px;padding:.75rem .85rem;color:var(--title);outline:none;transition:border-color .2s,box-shadow .2s}
        .field:focus{border-color:#818cf8;box-shadow:0 0 0 3px rgba(129,140,248,.15)}
        .field::placeholder{color:var(--sub);opacity:.75}
        textarea.field{resize:vertical;min-height:110px}
        .action{font-family:'Lora',Georgia,serif;background:rgba(79,70,229,.16);border:1px solid rgba(129,140,248,.55);color:var(--title);transition:.2s}
        .action:hover{background:rgba(99,102,241,.3);border-color:#818cf8}
        .theme-btn{width:42px;height:42px;border-radius:50%;border:1px solid var(--border);background:var(--card);color:var(--title);cursor:pointer}
        .section-title{color:var(--title);font-family:'Mako',sans-serif;font-size:1.1rem;letter-spacing:.04em}
    </style>
</head>
<body class="flex flex-col px-5 py-6 sm:px-8 lg:px-12">
<canvas id="bgCanvas"></canvas>
<header class="content flex items-center justify-between w-full max-w-5xl mx-auto">
    <a href="{{ route('portfolio.show', $portfolio->id) }}" class="flex items-center gap-3 no-underline" style="color:var(--title)">
        <div class="w-9 h-9 rounded-full border-2 border-current flex items-center justify-center"><div class="w-4 h-4 rounded-full border-2 border-current flex items-center justify-center"><div class="w-1.5 h-1.5 rounded-full bg-current"></div></div></div>
        <span class="text-2xl font-bold font-sansation tracking-tight">PortGen</span>
    </a>
    <button type="button" onclick="toggleTheme()" class="theme-btn" aria-label="Toggle theme"><i id="themeIcon" class="fa-regular fa-sun"></i></button>
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
            <h2 class="section-title flex items-center gap-3"><i class="fa-regular fa-id-card text-indigo-400"></i> Personal Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div><label class="field-label" for="full_name">Full Name *</label><input class="field" id="full_name" name="full_name" value="{{ old('full_name', $portfolio->full_name) }}" placeholder="Enter your full name" required></div>
                <div><label class="field-label" for="email">Email *</label><input class="field" type="email" id="email" name="email" value="{{ old('email', $portfolio->email) }}" placeholder="you@example.com" required></div>
                <div><label class="field-label" for="contact_number">Contact Number</label><input class="field" id="contact_number" name="contact_number" value="{{ old('contact_number', $portfolio->contact_number) }}" placeholder="Enter your contact number"></div>
                <div><label class="field-label" for="address">Address</label><input class="field" id="address" name="address" value="{{ old('address', $portfolio->address) }}" placeholder="City, Province"></div>
            </div>
            <div><label class="field-label" for="about_me">About Me</label><textarea class="field" id="about_me" name="about_me" placeholder="Write a short introduction about yourself">{{ old('about_me', $portfolio->about_me) }}</textarea></div>
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
                <div><label class="field-label" for="education">Educational Background</label><textarea class="field" id="education" name="education" placeholder="School, course, year, or qualifications">{{ old('education', $portfolio->education) }}</textarea></div>
            </div>
        </section>

        <div class="border-t" style="border-color:var(--border)"></div>
        <section class="space-y-5">
            <h2 class="section-title flex items-center gap-3"><i class="fa-solid fa-code text-indigo-400"></i> Skills & Experience</h2>
            <div><label class="field-label" for="skills">Skills</label><textarea class="field" id="skills" name="skills" placeholder="List your skills">{{ old('skills', $portfolio->skills) }}</textarea></div>
            <div><label class="field-label" for="projects">Projects</label><textarea class="field" id="projects" name="projects" placeholder="Describe your projects">{{ old('projects', $portfolio->projects) }}</textarea></div>
            <div><label class="field-label" for="work_experience">Work Experience</label><textarea class="field" id="work_experience" name="work_experience" placeholder="Describe your work experience or internships">{{ old('work_experience', $portfolio->work_experience) }}</textarea></div>
            <div><label class="field-label" for="social_links">Social Media / Website Links</label><textarea class="field" id="social_links" name="social_links" placeholder="Add your LinkedIn, GitHub, website, or other links">{{ old('social_links', $portfolio->social_links) }}</textarea></div>
        </section>

        <div class="flex flex-col-reverse sm:flex-row gap-3 justify-end border-t pt-6" style="border-color:var(--border)">
            <a href="{{ route('portfolio.show', $portfolio->id) }}" class="px-6 py-3 rounded-xl border text-center text-sm font-medium hover:bg-slate-500/10" style="border-color:var(--border);color:var(--sub)">Cancel</a>
            <button type="submit" class="action px-7 py-3 rounded-xl text-sm font-semibold"><i class="fa-solid fa-floppy-disk mr-2"></i>Save Changes</button>
        </div>
    </form>
</main>
<footer class="content w-full max-w-5xl mx-auto py-4 text-xs" style="color:var(--sub)">PortGen · Portfolio Template Generator</footer>

<script>
let isDarkMode=true;
function toggleTheme(){isDarkMode=!isDarkMode;document.documentElement.classList.toggle('dark',isDarkMode);document.documentElement.classList.toggle('light',!isDarkMode);document.getElementById('themeIcon').className=isDarkMode?'fa-regular fa-sun':'fa-regular fa-moon';}
const canvas=document.getElementById('bgCanvas'),ctx=canvas.getContext('2d');let width=0,height=0,phase=0,offset=0;const mouse={x:innerWidth/2,y:innerHeight/2,tx:innerWidth/2,ty:innerHeight/2};
function resizeCanvas(){const dpr=window.devicePixelRatio||1;canvas.width=innerWidth*dpr;canvas.height=innerHeight*dpr;canvas.style.width=innerWidth+'px';canvas.style.height=innerHeight+'px';ctx.setTransform(dpr,0,0,dpr,0,0);width=innerWidth;height=innerHeight;}
window.addEventListener('resize',resizeCanvas);window.addEventListener('mousemove',e=>{mouse.tx=e.clientX;mouse.ty=e.clientY;});window.addEventListener('touchmove',e=>{if(e.touches.length){mouse.tx=e.touches[0].clientX;mouse.ty=e.touches[0].clientY;}},{passive:true});
function renderBackground(){mouse.x+=(mouse.tx-mouse.x)*.05;mouse.y+=(mouse.ty-mouse.y)*.05;ctx.clearRect(0,0,width,height);offset=(offset+.25)%42;ctx.strokeStyle=isDarkMode?'rgba(255,255,255,.045)':'rgba(0,0,0,.06)';ctx.lineWidth=1;for(let x=offset;x<width;x+=42){ctx.beginPath();ctx.moveTo(x,0);ctx.lineTo(x,height);ctx.stroke();}for(let y=offset;y<height;y+=42){ctx.beginPath();ctx.moveTo(0,y);ctx.lineTo(width,y);ctx.stroke();}const g=ctx.createRadialGradient(mouse.x,mouse.y,0,mouse.x,mouse.y,420);g.addColorStop(0,isDarkMode?'rgba(110,150,235,.14)':'rgba(56,189,248,.12)');g.addColorStop(1,'transparent');ctx.fillStyle=g;ctx.fillRect(0,0,width,height);phase+=.015;for(let i=0;i<10;i++){ctx.beginPath();ctx.strokeStyle=isDarkMode?`rgba(160,185,235,${.1+i*.025})`:`rgba(80,110,170,${.1+i*.025})`;ctx.lineWidth=1.1;for(let x=0;x<=width;x+=6){const y=height*.38+i*35+Math.sin(x*(.002+i*.00028)+phase+i*.38)*(42+i*5.5+Math.sin((x-mouse.x)*.003)*20);if(x===0)ctx.moveTo(x,y);else ctx.lineTo(x,y);}ctx.stroke();}requestAnimationFrame(renderBackground);}
resizeCanvas();renderBackground();
</script>
</body>
</html>
