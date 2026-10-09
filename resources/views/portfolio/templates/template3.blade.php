<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $portfolio->full_name }} | Creative Portfolio</title>

    <style>
        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f8f5ef;
            color: #242424;
            line-height: 1.6;
        }

        a {
            text-decoration: none;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 25px;
        }

        /* Navigation */

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            padding: 15px 0 25px;
        }

        .brand {
            font-size: 19px;
            font-weight: 900;
            overflow-wrap: anywhere;
        }

        .brand span {
            color: #ff5b35;
        }

        .nav-links {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .nav-links a {
            color: #444;
            font-size: 13px;
            font-weight: bold;
        }

        .nav-links a:hover {
            color: #ff5b35;
        }

        /* Creative introduction */

        .hero {
            display: grid;
            grid-template-columns: 1fr 0.9fr;
            gap: 35px;
            align-items: center;
            padding: 45px 0 60px;
        }

        .tag {
            display: inline-block;
            background: #d7f36b;
            padding: 7px 13px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            transform: rotate(-2deg);
        }

        .hero h1 {
            font-size: clamp(42px, 7vw, 82px);
            line-height: 0.98;
            letter-spacing: -3px;
            margin: 20px 0;
            overflow-wrap: anywhere;
        }

        .hero h1 span {
            color: #ff5b35;
        }

        .hero-description {
            max-width: 530px;
            color: #666;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        .contact-row {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 22px;
        }

        .button {
            display: inline-block;
            padding: 12px 17px;
            border: 2px solid #242424;
            border-radius: 7px;
            background: #242424;
            color: white;
            cursor: pointer;
            font-size: 13px;
            font-weight: bold;
            text-align: center;
        }

        .button-outline {
            background: transparent;
            color: #242424;
        }

        .button:hover {
            opacity: 0.8;
        }

        .portrait-area {
            position: relative;
            padding: 20px;
            background: #ffccba;
            border-radius: 48% 48% 15px 15px;
            transform: rotate(2deg);
        }

        .profile-picture {
            display: block;
            width: 100%;
            height: 340px;
            object-fit: cover;
            object-position: center;
            border-radius: 48% 48% 12px 12px;
            transform: rotate(-2deg);
        }

        .photo-placeholder {
            height: 340px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 48% 48% 12px 12px;
            background: #d7f36b;
            color: #242424;
            font-size: 90px;
            font-weight: 900;
            transform: rotate(-2deg);
        }

        .sticker {
            position: absolute;
            right: -12px;
            bottom: 25px;
            padding: 13px;
            background: #d7f36b;
            border: 2px solid #242424;
            border-radius: 50%;
            font-size: 12px;
            font-weight: 900;
            transform: rotate(9deg);
        }

        /* Main sections */

        .section {
            padding: 45px 0;
            scroll-margin-top: 20px;
        }

        .section-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 22px;
        }

        .section-header h2 {
            margin: 0;
            font-size: clamp(27px, 4vw, 40px);
            letter-spacing: -1px;
        }

        .section-header p {
            color: #777;
            font-size: 13px;
            margin: 0;
        }

        .about-card {
            padding: 30px;
            background: #d7f36b;
            border: 2px solid #242424;
            border-radius: 12px;
        }

        .about-card h2 {
            margin-top: 0;
            font-size: 25px;
        }

        .about-card p {
            margin-bottom: 0;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        .project-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .project-card {
            min-height: 160px;
            padding: 25px;
            border: 2px solid #242424;
            border-radius: 12px;
            background: white;
            overflow-wrap: anywhere;
        }

        .project-card:nth-child(odd) {
            background: #ffccba;
            transform: rotate(-1deg);
        }

        .project-card:nth-child(even) {
            background: #dce7ff;
            transform: rotate(1deg);
        }

        .project-number {
            color: #ff5b35;
            font-size: 13px;
            font-weight: 900;
        }

        .project-card h3 {
            font-size: 21px;
            margin: 10px 0;
        }

        .project-card p {
            color: #555;
            font-size: 13px;
            margin: 0;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .detail-card {
            padding: 25px;
            background: white;
            border: 2px solid #242424;
            border-radius: 12px;
            overflow-wrap: anywhere;
        }

        .detail-card h3 {
            font-size: 20px;
            margin: 0 0 12px;
        }

        .detail-card p {
            color: #666;
            white-space: pre-line;
            margin: 0;
        }

        .skills {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .skill {
            padding: 10px 15px;
            background: white;
            border: 2px solid #242424;
            border-radius: 7px;
            font-size: 13px;
            font-weight: bold;
        }

        .skill:nth-child(3n + 1) {
            background: #d7f36b;
        }

        .skill:nth-child(3n + 2) {
            background: #ffccba;
        }

        .social-list {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .social-list a {
            padding: 11px 15px;
            border: 2px solid #242424;
            border-radius: 7px;
            background: white;
            color: #242424;
            font-size: 13px;
            overflow-wrap: anywhere;
        }

        .social-list a:hover {
            background: #d7f36b;
        }

        /* Portfolio controls */

        .share-section {
            margin: 35px 0 20px;
            padding: 28px;
            border: 2px solid #242424;
            border-radius: 12px;
            background: #242424;
            color: white;
        }

        .share-section h2 {
            margin: 0 0 5px;
            font-size: 23px;
        }

        .share-section p {
            color: #ddd;
            font-size: 13px;
        }

        .share-row {
            display: flex;
            gap: 10px;
        }

        .share-row input {
            flex: 1;
            min-width: 0;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        .share-row .button {
            background: #d7f36b;
            color: #242424;
            border-color: #d7f36b;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 18px;
        }

        .edit-button {
            background: transparent;
            border-color: white;
        }

        .delete-button {
            background: #ff5b35;
            border-color: #ff5b35;
        }

        #copyMessage {
            display: none;
            color: #d7f36b;
        }

        footer {
            padding: 22px 0;
            text-align: center;
            color: #777;
            font-size: 12px;
        }

        @media (max-width: 700px) {
            .container {
                padding: 18px;
            }

            nav {
                align-items: flex-start;
                flex-direction: column;
            }

            .nav-links {
                gap: 12px;
            }

            .hero {
                grid-template-columns: 1fr;
                padding: 30px 0 45px;
            }

            .hero h1 {
                letter-spacing: -2px;
            }

            .portrait-area {
                max-width: 380px;
                width: 90%;
                margin: auto;
            }

            .profile-picture,
            .photo-placeholder {
                height: 300px;
            }

            .project-grid,
            .details-grid {
                grid-template-columns: 1fr;
            }

            .project-card:nth-child(n) {
                transform: none;
            }

            .section-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .share-row {
                flex-direction: column;
            }

            .actions {
                flex-direction: column;
            }

            .actions .button {
                width: 100%;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <nav>
        <a class="brand" href="#home">
            <span>✳</span> {{ $portfolio->full_name }}
        </a>

        <div class="nav-links">
            <a href="#home">Home</a>
            @if ($portfolio->about_me)
                <a href="#about">About</a>
            @endif
            @if ($portfolio->projects)
                <a href="#projects">Projects</a>
            @endif
            @if ($portfolio->skills)
                <a href="#skills">Skills</a>
            @endif
            @if ($portfolio->education || $portfolio->work_experience)
                <a href="#background">My Journey</a>
            @endif
        </div>
    </nav>

    <header class="hero" id="home">
        <div>
            <span class="tag">CREATIVE PORTFOLIO ✦</span>

            <h1>Hey, I'm<br><span>{{ $portfolio->full_name }}</span></h1>

            <p class="hero-description">
                {{ $portfolio->about_me ?: 'Welcome to my creative portfolio. Explore my work, skills, and experience.' }}
            </p>

            <div class="contact-row">
                @if ($portfolio->email)
                    <a class="button" href="mailto:{{ $portfolio->email }}">
                        Let's Connect ↗
                    </a>
                @endif

                @if ($portfolio->projects)
                    <a class="button button-outline" href="#projects">
                        Explore My Work
                    </a>
                @endif
            </div>

            @if ($portfolio->contact_number)
                <p style="margin-top:18px;font-size:13px;color:#666;">
                    Contact: {{ $portfolio->contact_number }}
                </p>
            @endif

            @if ($portfolio->address && strtoupper(trim($portfolio->address)) !== 'NONE')
                <p style="font-size:13px;color:#666;">
                    {{ $portfolio->address }}
                </p>
            @endif
        </div>

        <div class="portrait-area">
            @if ($portfolio->profile_picture)
                <img
                    class="profile-picture"
                    src="{{ asset('storage/' . $portfolio->profile_picture) }}"
                    alt="Profile picture"
                >
            @else
                <div class="photo-placeholder">
                    {{ strtoupper(substr($portfolio->full_name, 0, 1)) }}
                </div>
            @endif

            <div class="sticker">LET'S<br>CREATE!</div>
        </div>
    </header>

    @if ($portfolio->about_me)
        <section class="section" id="about">
            <div class="section-header">
                <h2>A Little About Me</h2>
                <p>THE PERSON BEHIND THE WORK</p>
            </div>

            <div class="about-card">
                <h2>Curious mind. Creative ideas.</h2>
                <p>{{ $portfolio->about_me }}</p>
            </div>
        </section>
    @endif

    @if ($portfolio->projects)
        <section class="section" id="projects">
            <div class="section-header">
                <h2>Things I've Created ✳</h2>
                <p>A SELECTION OF MY PROJECTS</p>
            </div>

            <div class="project-grid">
                @php $projectNumber = 1; @endphp

                @foreach (preg_split('/[\r\n]+/', $portfolio->projects) as $project)
                    @if (trim($project) !== '')
                        <article class="project-card">
                            <span class="project-number">
                                PROJECT {{ str_pad($projectNumber, 2, '0', STR_PAD_LEFT) }}
                            </span>

                            <h3>{{ trim($project) }}</h3>
                            <p>A project featured in my portfolio.</p>
                        </article>

                        @php $projectNumber++; @endphp
                    @endif
                @endforeach
            </div>
        </section>
    @endif

    @if ($portfolio->education || $portfolio->work_experience)
        <section class="section" id="background">
            <div class="section-header">
                <h2>My Journey</h2>
                <p>LEARNING, GROWING, CREATING</p>
            </div>

            <div class="details-grid">
                @if ($portfolio->education)
                    <article class="detail-card">
                        <h3>🎓 Education</h3>
                        <p>{{ $portfolio->education }}</p>
                    </article>
                @endif

                @if ($portfolio->work_experience)
                    <article class="detail-card">
                        <h3>✦ Work Experience</h3>
                        <p>{{ $portfolio->work_experience }}</p>
                    </article>
                @endif
            </div>
        </section>
    @endif

    @if ($portfolio->skills)
        <section class="section" id="skills">
            <div class="section-header">
                <h2>My Creative Toolkit</h2>
                <p>SKILLS AND THINGS I KNOW</p>
            </div>

            <div class="skills">
                @foreach (explode(',', $portfolio->skills) as $skill)
                    @if (trim($skill) !== '')
                        <span class="skill">{{ trim($skill) }}</span>
                    @endif
                @endforeach
            </div>
        </section>
    @endif

    @if ($portfolio->social_links)
        <section class="section">
            <div class="section-header">
                <h2>Find Me Online ↗</h2>
                <p>LET'S STAY CONNECTED</p>
            </div>

            <div class="social-list">
                @foreach (preg_split('/[\r\n,]+/', $portfolio->social_links) as $link)
                    @if (trim($link) !== '')
                        @php
                            $url = trim($link);
                            $href = preg_match('/^https?:\/\//i', $url)
                                ? $url
                                : 'https://' . $url;
                        @endphp

                        <a href="{{ $href }}" target="_blank"
                           rel="noopener noreferrer">{{ $url }} ↗</a>
                    @endif
                @endforeach
            </div>
        </section>
    @endif

    <section class="share-section">
        <h2>Like What You See? ✳</h2>
        <p>Share this portfolio with others.</p>

        <div class="share-row">
            <input
                id="portfolioLink"
                type="text"
                value="{{ url('/portfolio/' . $portfolio->id) }}"
                readonly
            >

            <button type="button" class="button" onclick="copyLink()">
                Copy Portfolio Link
            </button>
        </div>

        <p id="copyMessage">Link copied successfully!</p>

        <div class="actions">
            <a class="button edit-button"
               href="{{ route('portfolio.edit', $portfolio->id) }}">
                Edit Portfolio
            </a>

            <form action="{{ route('portfolio.destroy', $portfolio->id) }}"
                  method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this portfolio?');">
                @csrf
                @method('DELETE')

                <button class="button delete-button" type="submit">
                    Delete Portfolio
                </button>
            </form>
        </div>
    </section>

    <footer>
        Made with creativity ✳ | &copy; {{ date('Y') }}
        {{ $portfolio->full_name }}
    </footer>

</div>

<script>
    function copyLink() {
        const input = document.getElementById('portfolioLink');

        input.select();
        input.setSelectionRange(0, 99999);

        navigator.clipboard.writeText(input.value)
            .then(() => {
                document.getElementById('copyMessage').style.display = 'block';
            })
            .catch(() => {
                if (document.execCommand('copy')) {
                    document.getElementById('copyMessage').style.display = 'block';
                } else {
                    alert('Please copy the link manually.');
                }
            });
    }
</script>

</body>
</html>