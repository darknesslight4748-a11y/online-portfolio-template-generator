<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $portfolio->full_name }} | Professional Portfolio</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #26364d;
            line-height: 1.6;
        }

        a {
            text-decoration: none;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            background: white;
            min-height: 100vh;
        }

        /* Navigation */

        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 20px 5%;
            border-bottom: 1px solid #e8edf4;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 18px;
            font-weight: bold;
            color: #183153;
            overflow-wrap: anywhere;
        }

        .brand-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #183153;
            color: white;
            flex-shrink: 0;
        }

        .nav-links {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .nav-links a {
            font-size: 13px;
            color: #536176;
        }

        .nav-links a:hover {
            color: #2875e8;
        }

        /* Profile introduction */

        .hero {
            display: grid;
            grid-template-columns: 0.85fr 1.4fr 0.8fr;
            align-items: center;
            gap: 35px;
            padding: 55px 5%;
            background: linear-gradient(120deg, #f8fbff, #ffffff);
        }

        .photo-wrap {
            background: #eaf1fb;
            padding: 16px;
            border-radius: 25px;
            width: fit-content;
            max-width: 100%;
        }

        .profile-picture {
            display: block;
            width: 220px;
            height: 260px;
            object-fit: cover;
            object-position: center;
            border-radius: 12px;
        }

        .photo-placeholder {
            width: 220px;
            height: 260px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #dce7f5;
            color: #183153;
            font-size: 65px;
            font-weight: bold;
        }

        .eyebrow {
            color: #2875e8;
            font-size: 12px;
            letter-spacing: 2px;
            font-weight: bold;
        }

        .hero h1 {
            font-size: clamp(30px, 4vw, 44px);
            line-height: 1.2;
            margin: 8px 0;
            color: #183153;
            overflow-wrap: anywhere;
        }

        .hero-description {
            color: #61718a;
            margin: 12px 0 18px;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        .contact-info {
            display: flex;
            flex-wrap: wrap;
            gap: 8px 18px;
            font-size: 13px;
            color: #455670;
        }

        .hero-note {
            color: #2875e8;
            font-size: 25px;
            font-weight: bold;
            line-height: 1.4;
        }

        .hero-note span {
            display: block;
            margin-top: 12px;
            width: 75px;
            height: 4px;
            background: #2875e8;
        }

        /* Information sections */

        .content-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            padding: 5px 5% 20px;
        }

        .card {
            padding: 23px;
            border: 1px solid #e5edf7;
            border-radius: 12px;
            background: white;
            box-shadow: 0 4px 14px rgba(30, 60, 100, 0.04);
            overflow-wrap: anywhere;
        }

        .card h2 {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
            color: #183153;
            font-size: 17px;
        }

        .card-icon {
            color: #2875e8;
            font-size: 21px;
        }

        .card p {
            color: #61718a;
            font-size: 14px;
            white-space: pre-line;
        }

        .skills {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .skill {
            padding: 6px 12px;
            border-radius: 20px;
            background: #edf4ff;
            color: #245da8;
            font-size: 12px;
        }

        .project-item {
            padding: 10px 0;
            border-bottom: 1px solid #e7edf5;
        }

        .project-item:first-child {
            padding-top: 0;
        }

        .project-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .project-item h3 {
            color: #334b6d;
            font-size: 14px;
            margin-bottom: 3px;
        }

        .project-item p {
            font-size: 12px;
        }

        .social-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .social-list a {
            color: #2875e8;
            font-size: 13px;
            overflow-wrap: anywhere;
        }

        .social-list a:hover {
            text-decoration: underline;
        }

        /* Sharing controls */

        .share-section {
            display: grid;
            grid-template-columns: 1fr 1.5fr auto;
            align-items: center;
            gap: 20px;
            margin: 0 5% 25px;
            padding: 22px;
            border-radius: 10px;
            background: #203d60;
            color: white;
        }

        .share-section h2 {
            font-size: 16px;
            margin-bottom: 4px;
        }

        .share-section p {
            font-size: 12px;
            color: #d5e0ee;
        }

        .share-row {
            display: flex;
            gap: 8px;
        }

        .share-row input {
            width: 100%;
            min-width: 0;
            padding: 11px;
            border: none;
            border-radius: 5px;
            font-size: 12px;
        }

        .button {
            display: inline-block;
            padding: 10px 13px;
            border: none;
            border-radius: 5px;
            background: #2875e8;
            color: white;
            cursor: pointer;
            font-size: 12px;
            text-align: center;
            white-space: nowrap;
        }

        .button:hover {
            opacity: 0.88;
        }

        .edit-button {
            background: transparent;
            border: 1px solid #7fb0ff;
        }

        .delete-button {
            background: #dc3545;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        #copyMessage {
            display: none;
            margin-top: 6px;
            color: #a7f3c0;
        }

        footer {
            padding: 20px;
            background: #172d48;
            color: #d5e0ee;
            text-align: center;
            font-size: 12px;
        }

        @media (max-width: 900px) {
            .hero {
                grid-template-columns: 0.8fr 1.2fr;
            }

            .hero-note {
                display: none;
            }

            .content-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .share-section {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            nav {
                align-items: flex-start;
                flex-direction: column;
                padding: 18px 5%;
            }

            .nav-links {
                gap: 12px;
            }

            .hero {
                grid-template-columns: 1fr;
                text-align: center;
                padding: 35px 6%;
                gap: 22px;
            }

            .photo-wrap {
                margin: auto;
            }

            .profile-picture,
            .photo-placeholder {
                width: 190px;
                height: 220px;
            }

            .contact-info {
                justify-content: center;
            }

            .content-grid {
                grid-template-columns: 1fr;
                padding: 5px 5% 20px;
            }

            .share-section {
                margin: 0 5% 20px;
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
        <a href="#home" class="brand">
            <span class="brand-icon">
                {{ strtoupper(substr($portfolio->full_name, 0, 1)) }}
            </span>
            {{ $portfolio->full_name }}
        </a>

        <div class="nav-links">
            <a href="#home">Home</a>
            @if ($portfolio->about_me)
                <a href="#about">About</a>
            @endif
            @if ($portfolio->education)
                <a href="#education">Education</a>
            @endif
            @if ($portfolio->work_experience)
                <a href="#experience">Experience</a>
            @endif
            @if ($portfolio->skills)
                <a href="#skills">Skills</a>
            @endif
            @if ($portfolio->projects)
                <a href="#projects">Projects</a>
            @endif
        </div>
    </nav>

    <header class="hero" id="home">
        <div class="photo-wrap">
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
        </div>

        <div>
            <span class="eyebrow">HELLO, I'M</span>
            <h1>{{ $portfolio->full_name }}</h1>

            <p class="hero-description">
                {{ $portfolio->about_me ?: 'Welcome to my professional portfolio.' }}
            </p>

            <div class="contact-info">
                @if ($portfolio->email)
                    <span>{{ $portfolio->email }}</span>
                @endif

                @if ($portfolio->contact_number)
                    <span>{{ $portfolio->contact_number }}</span>
                @endif

                @if ($portfolio->address && strtoupper(trim($portfolio->address)) !== 'NONE')
                    <span>{{ $portfolio->address }}</span>
                @endif
            </div>
        </div>

        <div class="hero-note">
            Turning ideas<br>into real projects.
            <span></span>
        </div>
    </header>

    <main class="content-grid">

        @if ($portfolio->about_me)
            <section class="card" id="about">
                <h2><span class="card-icon">♙</span> About Me</h2>
                <p>{{ $portfolio->about_me }}</p>
            </section>
        @endif

        @if ($portfolio->education)
            <section class="card" id="education">
                <h2><span class="card-icon">◇</span> Educational Background</h2>
                <p>{{ $portfolio->education }}</p>
            </section>
        @endif

        @if ($portfolio->work_experience)
            <section class="card" id="experience">
                <h2><span class="card-icon">▣</span> Work Experience</h2>
                <p>{{ $portfolio->work_experience }}</p>
            </section>
        @endif

        @if ($portfolio->skills)
            <section class="card" id="skills">
                <h2><span class="card-icon">⚙</span> Skills</h2>

                <div class="skills">
                    @foreach (explode(',', $portfolio->skills) as $skill)
                        @if (trim($skill) !== '')
                            <span class="skill">{{ trim($skill) }}</span>
                        @endif
                    @endforeach
                </div>
            </section>
        @endif

        @if ($portfolio->projects)
            <section class="card" id="projects">
                <h2><span class="card-icon">&lt;/&gt;</span> Projects</h2>

                @foreach (preg_split('/[\r\n]+/', $portfolio->projects) as $project)
                    @if (trim($project) !== '')
                        <div class="project-item">
                            <h3>{{ trim($project) }}</h3>
                            <p>Project included in my portfolio.</p>
                        </div>
                    @endif
                @endforeach
            </section>
        @endif

        @if ($portfolio->social_links)
            <section class="card" id="contact">
                <h2><span class="card-icon">↗</span> Social Media and Websites</h2>

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
                               rel="noopener noreferrer">
                                {{ $url }}
                            </a>
                        @endif
                    @endforeach
                </div>
            </section>
        @endif

    </main>

    <section class="share-section">
        <div>
            <h2>Share Your Portfolio</h2>
            <p>Copy your portfolio link to share it with others.</p>
            <p id="copyMessage">Link copied successfully!</p>
        </div>

        <div class="share-row">
            <input
                id="portfolioLink"
                type="text"
                value="{{ url('/portfolio/' . $portfolio->id) }}"
                readonly
            >

            <button class="button" type="button" onclick="copyLink()">
                Copy Link
            </button>
        </div>

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
        &copy; {{ date('Y') }} {{ $portfolio->full_name }}. All rights reserved.
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