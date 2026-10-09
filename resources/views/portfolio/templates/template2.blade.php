<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $portfolio->full_name }} | Modern Portfolio</title>

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
            background: #ffffff;
            color: #202938;
            line-height: 1.6;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            padding: 20px 7%;
            border-bottom: 1px solid #eeeeee;
        }

        .logo {
            font-size: 21px;
            font-weight: bold;
            color: #111827;
            overflow-wrap: anywhere;
        }

        nav a {
            color: #4b5563;
            text-decoration: none;
            margin-left: 18px;
            font-size: 14px;
        }

        nav a:hover {
            color: #635bff;
        }

        .hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
            padding: 75px 9%;
            background: #f8f9ff;
        }

        .hero-text {
            max-width: 650px;
        }

        .eyebrow {
            color: #635bff;
            font-weight: bold;
            letter-spacing: 2px;
            font-size: 13px;
            text-transform: uppercase;
        }

        .hero h1 {
            font-size: clamp(34px, 5vw, 55px);
            line-height: 1.15;
            margin: 12px 0;
            overflow-wrap: anywhere;
        }

        .hero p {
            color: #626b7a;
            font-size: 17px;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        .profile-picture {
            width: 210px;
            height: 210px;
            object-fit: cover;
            border-radius: 28px;
            border: 5px solid white;
            box-shadow: 0 12px 35px #dfe3f5;
            flex-shrink: 0;
        }

        .contact-info {
            display: flex;
            flex-wrap: wrap;
            gap: 10px 20px;
            margin-top: 20px;
            color: #555e6d;
            font-size: 14px;
            overflow-wrap: anywhere;
        }

        .contact-info a {
            color: #635bff;
        }

        .button {
            display: inline-block;
            background: #635bff;
            color: white;
            border: none;
            border-radius: 7px;
            padding: 11px 17px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .button:hover {
            opacity: 0.88;
        }

        .section {
            padding: 45px 9%;
        }

        .section-heading {
            margin-bottom: 22px;
        }

        .section-heading span {
            color: #635bff;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .section-heading h2 {
            font-size: 29px;
            margin: 5px 0;
        }

        .section-heading p {
            color: #6b7280;
            margin: 0;
        }

        .projects-grid,
        .details-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .project-card,
        .detail-card {
            padding: 24px;
            background: #f8f9fc;
            border: 1px solid #eceef4;
            border-radius: 12px;
            overflow-wrap: anywhere;
        }

        .project-card {
            border-top: 4px solid #635bff;
        }

        .project-card h3,
        .detail-card h3 {
            margin: 0 0 10px;
            font-size: 19px;
        }

        .project-card p,
        .detail-card p {
            margin: 0;
            color: #606a79;
            white-space: pre-line;
        }

        .skills {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .skill {
            padding: 9px 15px;
            border: 1px solid #e0ddff;
            border-radius: 20px;
            background: #f3f1ff;
            color: #5146d8;
            font-size: 14px;
        }

        .social-links a {
            display: inline-block;
            color: #635bff;
            margin: 5px 14px 5px 0;
            overflow-wrap: anywhere;
        }

        .share-section {
            margin: 20px 9% 45px;
            padding: 25px;
            border-radius: 12px;
            background: #202938;
            color: white;
        }

        .share-section h2 {
            margin-top: 0;
        }

        .share-section p {
            color: #d1d5db;
        }

        .share-row {
            display: flex;
            gap: 10px;
        }

        .share-row input {
            flex: 1;
            min-width: 0;
            padding: 11px;
            border-radius: 6px;
            border: 1px solid #d1d5db;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 16px;
        }

        .delete-button {
            background: #dc2626;
        }

        #copyMessage {
            display: none;
            color: #86efac;
        }

        footer {
            text-align: center;
            padding: 22px;
            color: #6b7280;
            border-top: 1px solid #eeeeee;
            font-size: 13px;
        }

        @media (max-width: 700px) {
            nav {
                padding: 16px 5%;
                align-items: flex-start;
                flex-direction: column;
            }

            nav a {
                margin: 0 12px 0 0;
            }

            .hero {
                padding: 45px 6%;
                flex-direction: column-reverse;
                align-items: flex-start;
                gap: 22px;
            }

            .profile-picture {
                width: 150px;
                height: 150px;
            }

            .section {
                padding: 35px 6%;
            }

            .projects-grid,
            .details-grid {
                grid-template-columns: 1fr;
            }

            .share-section {
                margin: 15px 6% 30px;
            }

            .share-row {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<nav>
    <div class="logo">{{ $portfolio->full_name }}</div>

    <div>
        <a href="#about">About</a>
        <a href="#projects">Projects</a>
        <a href="#background">Background</a>
        @if ($portfolio->skills)
            <a href="#skills">Skills</a>
        @endif
    </div>
</nav>

<header class="hero">
    <div class="hero-text">
        <div class="eyebrow">Welcome to my portfolio</div>

        <h1>Hello, I'm {{ $portfolio->full_name }}.</h1>

        @if ($portfolio->about_me)
            <p>{{ $portfolio->about_me }}</p>
        @else
            <p>Welcome to my personal portfolio. Explore my projects, skills, and background below.</p>
        @endif

        <div class="contact-info">
            @if ($portfolio->email)
                <span>{{ $portfolio->email }}</span>
            @endif

            @if ($portfolio->contact_number)
                <span>{{ $portfolio->contact_number }}</span>
            @endif

            @if ($portfolio->address)
                <span>{{ $portfolio->address }}</span>
            @endif
        </div>

        @if ($portfolio->email)
            <p>
                <a class="button" href="mailto:{{ $portfolio->email }}">
                    Contact Me
                </a>
            </p>
        @endif
    </div>

    @if ($portfolio->profile_picture)
        <img
            class="profile-picture"
            src="{{ asset('storage/' . $portfolio->profile_picture) }}"
            alt="Profile picture of {{ $portfolio->full_name }}"
        >
    @endif
</header>

@if ($portfolio->projects)
    <section class="section" id="projects">
        <div class="section-heading">
            <span>My work</span>
            <h2>Featured Projects</h2>
            <p>Some of the projects I have worked on.</p>
        </div>

        <div class="projects-grid">
            @foreach (preg_split('/[\r\n]+/', $portfolio->projects) as $project)
                @if (trim($project) !== '')
                    <article class="project-card">
                        <h3>{{ trim($project) }}</h3>
                        <p>Project included in my portfolio.</p>
                    </article>
                @endif
            @endforeach
        </div>
    </section>
@endif

@if ($portfolio->education || $portfolio->work_experience)
    <section class="section" id="background">
        <div class="section-heading">
            <span>My journey</span>
            <h2>Background</h2>
        </div>

        <div class="details-grid">
            @if ($portfolio->education)
                <article class="detail-card">
                    <h3>Educational Background</h3>
                    <p>{{ $portfolio->education }}</p>
                </article>
            @endif

            @if ($portfolio->work_experience)
                <article class="detail-card">
                    <h3>Work Experience</h3>
                    <p>{{ $portfolio->work_experience }}</p>
                </article>
            @endif
        </div>
    </section>
@endif

@if ($portfolio->skills)
    <section class="section" id="skills">
        <div class="section-heading">
            <span>What I can do</span>
            <h2>My Skills</h2>
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
        <div class="section-heading">
            <span>Find me online</span>
            <h2>Social Media and Websites</h2>
        </div>

        <div class="social-links">
            @foreach (preg_split('/[\r\n,]+/', $portfolio->social_links) as $link)
                @if (trim($link) !== '')
                    @php
                        $url = trim($link);
                        $href = preg_match('/^https?:\/\//i', $url)
                            ? $url
                            : 'https://' . $url;
                    @endphp

                    <a href="{{ $href }}" target="_blank"
                       rel="noopener noreferrer">{{ $url }}</a>
                @endif
            @endforeach
        </div>
    </section>
@endif

<section class="share-section">
    <h2>Share My Portfolio</h2>
    <p>Share this link with friends, classmates, or potential employers.</p>

    <div class="share-row">
        <input
            type="text"
            id="portfolioLink"
            value="{{ url('/portfolio/' . $portfolio->id) }}"
            readonly
        >

        <button class="button" type="button" onclick="copyLink()">
            Copy Link
        </button>
    </div>

    <p id="copyMessage">Portfolio link copied!</p>

    <div class="actions">
        <a class="button" href="{{ route('portfolio.edit', $portfolio->id) }}">
            Edit Portfolio
        </a>

        <form action="{{ route('portfolio.destroy', $portfolio->id) }}"
              method="POST"
              onsubmit="return confirm('Are you sure you want to delete this portfolio?');">
            @csrf
            @method('DELETE')

            <button type="submit" class="button delete-button">
                Delete Portfolio
            </button>
        </form>
    </div>
</section>

<footer>
    &copy; {{ date('Y') }} {{ $portfolio->full_name }}. All rights reserved.
</footer>

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