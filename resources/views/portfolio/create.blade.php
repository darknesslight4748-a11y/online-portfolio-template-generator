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
        :root{--bg-color:#060709;--text-color:#fff;--subtext-color:#9ba1b0;--card-bg:rgba(16,18,27,.82);--card-border:rgba(255,255,255,.12);--input-bg:rgba(255,255,255,.04);--input-border:rgba(255,255,255,.17);--input-focus:#8a9eff;--btn-bg:#5b5feF;--btn-text:#fff;--error:#ff9b9b}
        [data-theme="light"]{--bg-color:#f0f3f9;--text-color:#0f172a;--subtext-color:#475569;--card-bg:rgba(255,255,255,.9);--card-border:rgba(0,0,0,.1);--input-bg:rgba(0,0,0,.02);--input-border:rgba(0,0,0,.16);--input-focus:#4f46e5;--btn-bg:#4f46e5;--btn-text:#fff;--error:#b91c1c}
        html,body{min-height:100%;width:100%;background:var(--bg-color);color:var(--text-color);font-family:Arial,Helvetica,sans-serif;overflow-x:hidden}
        body{position:relative} canvas{position:fixed;inset:0;width:100%;height:100%;z-index:0;pointer-events:none}
        .container{position:relative;z-index:1;width:100%;min-height:100vh;display:flex;flex-direction:column;padding:32px 20px 70px}
        header{display:flex;align-items:center;justify-content:space-between;width:100%;max-width:820px;margin:0 auto 36px}
        .logo-group{display:flex;align-items:center;gap:12px}.logo-icon{width:40px;height:40px;border:1px solid var(--card-border);border-radius:50%;display:grid;place-items:center;background:var(--card-bg);backdrop-filter:blur(10px)}.logo-icon svg{width:21px;height:21px;fill:var(--text-color)}.logo-text{font:700 1.7rem 'Sansation',sans-serif;letter-spacing:-.5px}
        .theme-toggle-btn{width:44px;height:44px;border:1px solid var(--card-border);border-radius:50%;display:grid;place-items:center;background:var(--card-bg);color:var(--text-color);cursor:pointer}.theme-toggle-btn svg{width:20px;height:20px;fill:currentColor}
        .hero-text{text-align:center;margin:0 auto 34px;max-width:820px}.hero-text h1{font:400 clamp(1.8rem,5vw,2.5rem) 'Mako',sans-serif;letter-spacing:-.5px;margin-bottom:10px;text-transform:uppercase}.hero-text p{font:1rem 'Lora',serif;color:var(--subtext-color);line-height:1.6}
        .form-wrapper{max-width:820px;width:100%;margin:0 auto;display:flex;flex-direction:column;gap:22px}
        .form-card{background:var(--card-bg);border:1px solid var(--card-border);backdrop-filter:blur(16px);-webkit-backdrop-filter:blur(16px);border-radius:18px;padding:30px;box-shadow:0 15px 35px rgba(0,0,0,.18);position:relative;overflow:hidden}
        .form-card:before{content:'';position:absolute;top:0;left:0;width:4px;height:100%;background:linear-gradient(to bottom,#8a9eff,#4f46e5);opacity:.9}
        .form-card h3{font:600 1.15rem 'Mako',sans-serif;margin-bottom:22px;color:var(--text-color);border-bottom:1px solid var(--card-border);padding-bottom:12px;letter-spacing:.3px}
        .form-row{display:grid;grid-template-columns:1fr 1fr;gap:18px}.form-group{margin-bottom:17px;display:flex;flex-direction:column;min-width:0}.form-group:last-child{margin-bottom:0}.form-group.full-width{grid-column:1/-1}
        label{font: .9rem 'Lora',serif;color:var(--subtext-color);margin-bottom:8px}label .required{color:#a5b4fc}
        input[type=text],input[type=email],input[type=tel],input[type=url],input[type=file],textarea{background:var(--input-bg);border:1px solid var(--input-border);border-radius:10px;padding:13px 15px;color:var(--text-color);font: .95rem Arial,sans-serif;outline:none;width:100%}
        input:focus,textarea:focus{border-color:var(--input-focus);box-shadow:0 0 0 3px rgba(138,158,255,.16)}textarea{resize:vertical;min-height:110px;line-height:1.5}input[type=file]{padding:10px;cursor:pointer;color:var(--subtext-color)}input::placeholder,textarea::placeholder{color:var(--subtext-color);opacity:.8}
        .help-text{color:var(--subtext-color);font-size:.8rem;margin-top:7px;line-height:1.4}.error-box{background:rgba(220,38,38,.12);border:1px solid rgba(248,113,113,.4);color:var(--error);border-radius:12px;padding:15px 18px}.error-box ul{padding-left:20px;margin-top:8px}.field-error{color:var(--error);font-size:.82rem;margin-top:6px}
        .submit-btn{display:block;width:100%;background:var(--btn-bg);border:1px solid transparent;color:var(--btn-text);padding:17px 24px;border-radius:12px;font-size:1rem;font-weight:700;cursor:pointer;text-align:center;margin-top:3px;box-shadow:0 10px 25px rgba(79,70,229,.2)}.submit-btn:hover{filter:brightness(1.1);transform:translateY(-2px)}.submit-btn:disabled{opacity:.7;cursor:wait;transform:none}
        @media(max-width:768px){.container{padding:20px 13px 45px}header{margin-bottom:28px}.form-card{padding:22px 19px}.form-row{grid-template-columns:1fr;gap:0}.form-group.full-width{grid-column:1}.hero-text{margin-bottom:26px}}
    </style>
</head>
<body>
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

    <canvas id="canvas" aria-hidden="true"></canvas>
    <script>
        const canvas = document.getElementById('canvas');
        const ctx = canvas.getContext('2d');
        let width, height, phase = 0, gridOffset = 0, currentTheme = 'dark';
        let mouseX = window.innerWidth / 2, mouseY = window.innerHeight / 2;
        let targetMouseX = mouseX, targetMouseY = mouseY;
        function resize(){ width = canvas.width = window.innerWidth; height = canvas.height = window.innerHeight; }
        window.addEventListener('resize', resize); resize();
        window.addEventListener('mousemove', e => { targetMouseX = e.clientX; targetMouseY = e.clientY; });
        function drawBackgroundHighlight(){
            mouseX += (targetMouseX - mouseX) * .08; mouseY += (targetMouseY - mouseY) * .08;
            const grad = ctx.createRadialGradient(mouseX, mouseY, 0, mouseX, mouseY, 500);
            if(currentTheme === 'dark'){ grad.addColorStop(0,'rgba(120,140,255,.12)'); grad.addColorStop(.5,'rgba(79,70,229,.05)'); grad.addColorStop(1,'rgba(0,0,0,0)'); }
            else { grad.addColorStop(0,'rgba(79,70,229,.08)'); grad.addColorStop(.5,'rgba(120,140,255,.03)'); grad.addColorStop(1,'rgba(255,255,255,0)'); }
            ctx.fillStyle = grad; ctx.fillRect(0,0,width,height);
        }
        function drawGrid(){
            const size=45; ctx.strokeStyle=currentTheme==='dark'?'rgba(255,255,255,.04)':'rgba(0,0,0,.05)'; ctx.lineWidth=1; gridOffset=(gridOffset+.3)%size; ctx.beginPath();
            for(let x=0;x<width;x+=size){ctx.moveTo(x,0);ctx.lineTo(x,height)}
            for(let y=gridOffset-size;y<height+size;y+=size){ctx.moveTo(0,y);ctx.lineTo(width,y)} ctx.stroke();
        }
        function drawWaves(){
            const count=5, rgb=currentTheme==='dark'?'130,160,255':'79,70,229';
            for(let i=0;i<count;i++){ctx.beginPath();ctx.strokeStyle=`rgba(${rgb}, ${(i/count)*.35+.15})`;ctx.lineWidth=2.2-i*.2;const freq=.0018,amp=120+i*20,offset=height*.5+(i-count/2)*45;
                for(let x=0;x<=width;x+=4){const a=Math.sin(x*freq+phase+i*.3)*amp;const b=Math.cos(x*(freq*.7)-phase*.6)*(amp*.6);const envelope=Math.sin((x/Math.max(width,1))*Math.PI);const y=offset+(a+b)*envelope;if(x===0)ctx.moveTo(x,y);else ctx.lineTo(x,y)}ctx.stroke();}
        }
        function animate(){ctx.clearRect(0,0,width,height);drawBackgroundHighlight();drawGrid();drawWaves();phase+=.012;requestAnimationFrame(animate)} animate();
        function toggleTheme(){
            const body=document.body;
            if(currentTheme==='dark'){body.setAttribute('data-theme','light');currentTheme='light';}
            else{body.removeAttribute('data-theme');currentTheme='dark';}
        }
        document.getElementById('portfolioForm').addEventListener('submit', function(){
            const button=document.getElementById('submitBtn');
            button.disabled=true; button.textContent='Submitting...';
        });
    </script>
</body>
</html>
