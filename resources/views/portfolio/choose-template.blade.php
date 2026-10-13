<!DOCTYPE html>
<html lang="en" class="h-full dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PortGen - Choose Your Portfolio Template</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600;700&family=Mako&family=Sansation:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>tailwind.config={darkMode:'class',theme:{extend:{fontFamily:{sansation:['Sansation','sans-serif'],mako:['Mako','sans-serif'],lora:['Lora','Georgia','serif']}}}};</script>
    <style>
        :root{--bg:#06080d;--text:#cbd5e1;--card:rgba(13,17,24,.88);--border:rgba(255,255,255,.1);--title:#fff;--sub:#94a3b8}
        html.light{--bg:#f1f5f9;--text:#334155;--card:rgba(255,255,255,.93);--border:rgba(203,213,225,.9);--title:#0f172a;--sub:#64748b}
        body{background:var(--bg);color:var(--text);font-family:system-ui,sans-serif;min-height:100vh;margin:0;transition:.3s}
        #bgCanvas{position:fixed;inset:0;width:100%;height:100%;z-index:0;pointer-events:none}
        .content{position:relative;z-index:1}.glass{background:var(--card);border:1px solid var(--border);border-radius:18px;backdrop-filter:blur(16px);transition:.25s}
        .glass:hover{transform:translateY(-4px);border-color:rgba(129,140,248,.65)}
        .action{font-family:'Lora',Georgia,serif;background:rgba(79,70,229,.14);border:1px solid rgba(129,140,248,.5);color:var(--title);transition:.2s}
        .action:hover{background:rgba(99,102,241,.3);border-color:#818cf8}
        .theme-btn{width:42px;height:42px;border-radius:50%;border:1px solid var(--border);background:var(--card);color:var(--title);cursor:pointer}
    </style>
</head>
<body class="flex flex-col px-5 py-6 sm:px-8 lg:px-12">
<canvas id="bgCanvas"></canvas>
<header class="content flex items-center justify-between w-full max-w-7xl mx-auto">
    <a href="{{ route('portfolio.show', $portfolio->id) }}" class="flex items-center gap-3 no-underline" style="color:var(--title)">
        <div class="w-9 h-9 rounded-full border-2 border-current flex items-center justify-center"><div class="w-4 h-4 rounded-full border-2 border-current flex items-center justify-center"><div class="w-1.5 h-1.5 rounded-full bg-current"></div></div></div>
        <span class="text-2xl font-bold font-sansation tracking-tight">PortGen</span>
    </a>
    <button id="themeBtn" type="button" onclick="toggleTheme()" class="theme-btn" aria-label="Toggle theme"><i id="themeIcon" class="fa-regular fa-sun"></i></button>
</header>
<main class="content w-full max-w-7xl mx-auto my-10 flex-1">
    <div class="mb-9 space-y-2">
        <h1 class="text-3xl sm:text-4xl md:text-5xl uppercase font-normal font-mako" style="color:var(--title)">Choose Your Portfolio Template</h1>
        <p class="text-sm sm:text-base font-lora" style="color:var(--sub)">Choose a design for your portfolio. You can change it anytime.</p>
        @if ($errors->any())
            <div class="mt-4 rounded-lg border border-red-400 bg-red-500/10 p-3 text-sm text-red-500" role="alert">
                @foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach
            </div>
        @endif
    </div>

    <form method="POST" action="{{ route('portfolio.select-template', $portfolio->id) }}" id="templateForm">
        @csrf
        <input type="hidden" name="template" id="selectedTemplate" value="{{ old('template', $portfolio->template ?? 'template1') }}">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-7">
            <!-- Professional -->
            <section class="glass p-5 sm:p-6 flex flex-col justify-between gap-6">
                <div class="rounded-xl bg-slate-100 p-3 border border-slate-300">
                    <div class="rounded-lg bg-white p-4 text-slate-800 shadow space-y-4 min-h-64">
                        <div class="flex justify-between text-[10px] text-slate-500 border-b pb-3"><strong>Your Name</strong><span>About&nbsp; Skills&nbsp; Projects</span></div>
                        <div class="flex items-center gap-3 rounded-lg bg-blue-50 p-3"><div class="w-12 h-12 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-lg">Y</div><div><p class="text-[9px] text-blue-700 font-bold">HELLO, I'M</p><p class="font-bold text-sm">Your Name</p><p class="text-[10px] text-slate-500">Your Profession</p></div></div>
                        <p class="text-xs font-bold">About Me</p><div class="h-1.5 rounded bg-slate-200 w-full"></div><div class="h-1.5 rounded bg-slate-200 w-4/5"></div>
                        <div class="grid grid-cols-2 gap-2"><div class="border rounded p-2"><p class="text-[10px] font-bold">Education</p><div class="h-1 bg-slate-200 rounded mt-2"></div></div><div class="border rounded p-2"><p class="text-[10px] font-bold">Skills</p><div class="h-1 bg-slate-200 rounded mt-2"></div></div></div>
                        <div class="flex gap-2 text-[9px]"><span class="bg-blue-100 text-blue-800 rounded px-2 py-1">HTML</span><span class="bg-blue-100 text-blue-800 rounded px-2 py-1">CSS</span><span class="bg-blue-100 text-blue-800 rounded px-2 py-1">PHP</span></div>
                    </div>
                </div>
                <div class="space-y-4"><div><h2 class="text-xl font-bold mb-2" style="color:var(--title)">Professional</h2><p class="text-sm leading-relaxed" style="color:var(--sub)">A clean, organized layout with a white background, blue accents, and clear portfolio sections.</p></div><button type="button" onclick="chooseTemplate('template1')" class="action w-full py-3 rounded-xl text-sm">Choose Professional</button></div>
            </section>
            <!-- Modern -->
            <section class="glass p-5 sm:p-6 flex flex-col justify-between gap-6">
                <div class="rounded-xl bg-slate-950 p-3 border border-purple-500/30">
                    <div class="rounded-lg bg-slate-900 p-4 text-slate-200 border border-purple-500/20 space-y-4 min-h-64">
                        <div class="flex justify-between text-[10px] text-slate-400 border-b border-slate-700 pb-3"><strong class="text-white">Your Name</strong><span>Home&nbsp; Work&nbsp; Contact</span></div>
                        <div class="flex items-center justify-between gap-3 py-3"><div><p class="text-[9px] text-purple-400 font-bold">WELCOME TO MY SPACE</p><p class="text-sm font-bold text-white mt-1">Hello, I'm</p><p class="text-lg font-bold text-purple-300">Your Name</p><p class="text-[10px] text-slate-400">Creative Professional</p></div><div class="w-14 h-14 rounded-full bg-indigo-600 flex items-center justify-center font-bold text-xl text-white">Y</div></div>
                        <span class="inline-block rounded bg-purple-500/20 text-purple-300 text-[10px] px-3 py-2">View Projects →</span><p class="text-xs font-bold text-slate-200">Featured Projects</p>
                        <div class="grid grid-cols-2 gap-2"><div class="rounded border border-slate-700 bg-slate-800 p-3"><p class="text-[9px] text-slate-400">01 / PROJECT</p><div class="h-1 bg-purple-500 rounded mt-3"></div></div><div class="rounded border border-slate-700 bg-slate-800 p-3"><p class="text-[9px] text-slate-400">02 / PROJECT</p><div class="h-1 bg-purple-500 rounded mt-3"></div></div></div>
                    </div>
                </div>
                <div class="space-y-4"><div><h2 class="text-xl font-bold mb-2" style="color:var(--title)">Modern</h2><p class="text-sm leading-relaxed" style="color:var(--sub)">A dark, contemporary layout with purple accents, a bold introduction, and featured project cards.</p></div><button type="button" onclick="chooseTemplate('template2')" class="action w-full py-3 rounded-xl text-sm">Choose Modern</button></div>
            </section>
            <!-- Creative -->
            <section class="glass p-5 sm:p-6 flex flex-col justify-between gap-6">
                <div class="rounded-xl bg-amber-50 p-3 border border-amber-200">
                    <div class="rounded-lg bg-[#faf8f5] p-4 text-slate-900 border border-amber-200 shadow space-y-4 min-h-64">
                        <div class="flex justify-between text-[10px] text-slate-600 border-b border-amber-200 pb-3"><strong>Your Name</strong><span>About&nbsp; Work&nbsp; Skills</span></div>
                        <span class="inline-block bg-lime-300 text-slate-900 font-black text-[9px] px-2 py-1 rounded-full">CREATIVE PORTFOLIO</span>
                        <div class="flex items-center justify-between gap-3"><div><p class="text-[10px] text-slate-500">Hey, I'm</p><p class="text-lg font-black text-rose-500">Your Name</p><p class="text-[10px] text-slate-500">Designer & Creator</p></div><div class="w-12 h-12 rounded-xl bg-orange-200 border border-orange-300 flex items-center justify-center font-black text-xl">Y</div></div>
                        <span class="inline-block bg-slate-900 text-white text-[10px] font-bold px-3 py-2 rounded">Explore My Work ↗</span><p class="text-xs font-bold">Things I've Created</p>
                        <div class="grid grid-cols-2 gap-2"><div class="bg-lime-300 p-3 rounded"><p class="text-[9px] font-bold">PROJECT 01</p><div class="h-1 bg-slate-900 rounded mt-3"></div></div><div class="bg-orange-200 p-3 rounded"><p class="text-[9px] font-bold">PROJECT 02</p><div class="h-1 bg-slate-900 rounded mt-3"></div></div></div>
                    </div>
                </div>
                <div class="space-y-4"><div><h2 class="text-xl font-bold mb-2" style="color:var(--title)">Creative</h2><p class="text-sm leading-relaxed" style="color:var(--sub)">A playful and expressive design with colorful cards, bold accents, and a unique layout.</p></div><button type="button" onclick="chooseTemplate('template3')" class="action w-full py-3 rounded-xl text-sm">Choose Creative</button></div>
            </section>
        </div>
    </form>
</main>
<footer class="content w-full max-w-7xl mx-auto pt-2 pb-4"><a href="{{ route('portfolio.show', $portfolio->id) }}" class="inline-flex items-center gap-2 text-sm hover:underline" style="color:var(--sub)">← <span>Back to Portfolio</span></a></footer>

<div id="selectionModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/75 backdrop-blur-sm p-4">
    <div class="bg-slate-900 border border-slate-700 text-white rounded-2xl p-7 max-w-md w-full shadow-2xl text-center space-y-4">
        <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center mx-auto text-xl border border-white/20"><i class="fa-solid fa-check"></i></div>
        <h2 class="text-xl font-bold font-mako">Confirm Template</h2><p id="modalDesc" class="text-sm text-slate-300 font-lora">Continue with this template?</p>
        <div class="flex gap-3 justify-center"><button type="button" onclick="closeModal()" class="px-5 py-2 rounded-lg border border-slate-600 hover:bg-slate-800">Cancel</button><button type="button" onclick="submitTemplate()" class="action px-5 py-2 rounded-lg">Confirm Selection</button></div>
    </div>
</div>
<script>
let isDarkMode=true, pendingTemplate='template1';
function toggleTheme(){isDarkMode=!isDarkMode;document.documentElement.classList.toggle('dark',isDarkMode);document.documentElement.classList.toggle('light',!isDarkMode);document.getElementById('themeIcon').className=isDarkMode?'fa-regular fa-sun':'fa-regular fa-moon';}
function chooseTemplate(template){pendingTemplate=template;const names={template1:'Professional',template2:'Modern',template3:'Creative'};document.getElementById('modalDesc').textContent='You selected the '+names[template]+' template. Apply this design to your portfolio?';const modal=document.getElementById('selectionModal');modal.classList.remove('hidden');modal.classList.add('flex');}
function closeModal(){const modal=document.getElementById('selectionModal');modal.classList.add('hidden');modal.classList.remove('flex');}
function submitTemplate(){document.getElementById('selectedTemplate').value=pendingTemplate;document.getElementById('templateForm').submit();}
const canvas=document.getElementById('bgCanvas'),ctx=canvas.getContext('2d');let width=0,height=0,phase=0,offset=0;const mouse={x:innerWidth/2,y:innerHeight/2,tx:innerWidth/2,ty:innerHeight/2};
function resizeCanvas(){const dpr=window.devicePixelRatio||1;canvas.width=innerWidth*dpr;canvas.height=innerHeight*dpr;canvas.style.width=innerWidth+'px';canvas.style.height=innerHeight+'px';ctx.setTransform(dpr,0,0,dpr,0,0);width=innerWidth;height=innerHeight;}
window.addEventListener('resize',resizeCanvas);window.addEventListener('mousemove',e=>{mouse.tx=e.clientX;mouse.ty=e.clientY;});window.addEventListener('touchmove',e=>{if(e.touches.length){mouse.tx=e.touches[0].clientX;mouse.ty=e.touches[0].clientY;}},{passive:true});
function renderBackground(){mouse.x+=(mouse.tx-mouse.x)*.05;mouse.y+=(mouse.ty-mouse.y)*.05;ctx.clearRect(0,0,width,height);offset=(offset+.25)%42;ctx.strokeStyle=isDarkMode?'rgba(255,255,255,.045)':'rgba(0,0,0,.06)';ctx.lineWidth=1;for(let x=offset;x<width;x+=42){ctx.beginPath();ctx.moveTo(x,0);ctx.lineTo(x,height);ctx.stroke();}for(let y=offset;y<height;y+=42){ctx.beginPath();ctx.moveTo(0,y);ctx.lineTo(width,y);ctx.stroke();}const g=ctx.createRadialGradient(mouse.x,mouse.y,0,mouse.x,mouse.y,420);g.addColorStop(0,isDarkMode?'rgba(110,150,235,.14)':'rgba(56,189,248,.12)');g.addColorStop(1,'transparent');ctx.fillStyle=g;ctx.fillRect(0,0,width,height);phase+=.015;for(let i=0;i<10;i++){ctx.beginPath();ctx.strokeStyle=isDarkMode?`rgba(160,185,235,${.1+i*.025})`:`rgba(80,110,170,${.1+i*.025})`;ctx.lineWidth=1.1;for(let x=0;x<=width;x+=6){const y=height*.38+i*35+Math.sin(x*(.002+i*.00028)+phase+i*.38)*(42+i*5.5+Math.sin((x-mouse.x)*.003)*20);if(x===0)ctx.moveTo(x,y);else ctx.lineTo(x,y);}ctx.stroke();}requestAnimationFrame(renderBackground);}
resizeCanvas();renderBackground();
</script>
</body>
</html>
