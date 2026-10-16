{{--
    PortGen Template 1 — Simple Navy Layout
    Keeps the original banner, left sidebar, round profile photo, and timeline sections.
    Portfolio data is read from the $portfolio model passed by PortfolioController.
--}}

@php
    $name = trim((string) ($portfolio->full_name ?? '')) ?: 'Your Name';
    $about = trim((string) ($portfolio->about_me ?? ''));
    $email = trim((string) ($portfolio->email ?? ''));
    $phone = trim((string) ($portfolio->contact_number ?? ''));
    $location = trim((string) ($portfolio->address ?? ''));

    $photo = !empty($portfolio->profile_picture)
        ? asset('storage/' . ltrim($portfolio->profile_picture, '/'))
        : null;

    // Split textarea content into lines so the saved form data is easy to read.
    $splitLines = static function ($value): array {
        $value = trim((string) $value);

        if ($value === '') {
            return [];
        }

        return array_values(array_filter(
            array_map('trim', preg_split('/\R+/', $value) ?: []),
            static fn ($line) => $line !== ''
        ));
    };

    $projects = [];
    foreach ($splitLines($portfolio->projects ?? '') as $projectLine) {
        $parts = preg_split('/\s*[:|]\s*/', $projectLine, 2) ?: [];
        $projects[] = [
            'title' => trim($parts[0] ?? '') ?: 'My Project',
            'description' => trim($parts[1] ?? ''),
        ];
    }

    $education = $splitLines($portfolio->education ?? '');
    $work = $splitLines($portfolio->work_experience ?? '');

    $skills = [];
    $skillsText = trim((string) ($portfolio->skills ?? ''));
    if ($skillsText !== '') {
        $skills = array_values(array_filter(array_map(
            'trim',
            preg_split('/[,;\r\n]+/', $skillsText) ?: []
        ), static fn ($skill) => $skill !== ''));
    }

    // Social links accept one entry per line, either "Label: https://..." or a URL.
    $socials = [];
    foreach ($splitLines($portfolio->social_links ?? '') as $socialLine) {
        if (preg_match('/^(.+?)\s*:\s*(https?:\/\/\S+|www\.\S+)$/i', $socialLine, $matches)) {
            $label = trim($matches[1]);
            $url = trim($matches[2]);
        } else {
            $label = $socialLine;
            $url = $socialLine;
        }

        if (str_starts_with(strtolower($url), 'www.')) {
            $url = 'https://' . $url;
        } elseif (!preg_match('~^https?://~i', $url) && preg_match('/^[a-z0-9.-]+\.[a-z]{2,}(\/.*)?$/i', $url)) {
            $url = 'https://' . $url;
        } elseif (!preg_match('~^https?://~i', $url)) {
            $url = '#contact';
        }

        $socials[] = ['label' => $label, 'url' => $url];
    }

    $shareUrl = route('portfolio.show', $portfolio->id);
    $editUrl = route('portfolio.edit', $portfolio->id);
    $initial = mb_strtoupper(mb_substr($name, 0, 1));
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#262a5c">
    <title>{{ $name }} | Portfolio</title>

    <style>
        :root {
            --navy: #262a5c;
            --navy-dark: #1d2048;
            --sidebar: #edf1f3;
            --text: #2b2f4a;
            --muted: #5a5f7a;
            --line: #c5c9d5;
            --bg: #e6e8ee;
            --paper: #ffffff;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 16px;
        }

        body {
            padding: env(safe-area-inset-top, 0px) 0 env(safe-area-inset-bottom, 0px);
            background: var(--bg);
            color: var(--text);
            font-family: "Segoe UI", Arial, sans-serif;
            line-height: 1.5;
        }

        a {
            color: inherit;
        }

        .page {
            max-width: 960px;
            margin: 24px auto;
            overflow: hidden;
            background: var(--paper);
            box-shadow: 0 18px 50px rgba(29, 32, 72, 0.10);
        }

        .banner {
            min-height: 150px;
            padding: 28px 40px 28px 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: #ffffff;
            background: var(--navy);
        }

        .banner h1 {
            overflow-wrap: anywhere;
            font-size: clamp(1.8rem, 4vw, 2.6rem);
            letter-spacing: 3px;
            line-height: 1.15;
            text-transform: uppercase;
        }

        .banner p {
            margin-top: 8px;
            color: #e2e5f7;
            font-size: 1rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .body-layout {
            display: grid;
            grid-template-columns: 260px minmax(0, 1fr);
        }

        .sidebar {
            min-width: 0;
            padding: 0 24px 32px;
            background: var(--sidebar);
        }

        .photo {
            width: 190px;
            height: 190px;
            margin: -95px 0 28px 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 5px solid #ffffff;
            border-radius: 50%;
            background: #dbe6f5;
            color: var(--navy);
            font-size: 4.5rem;
            font-weight: 700;
            position: relative;
            z-index: 2;
        }

        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .side {
            margin-bottom: 26px;
            font-size: 0.85rem;
            overflow-wrap: anywhere;
        }

        .side h3 {
            margin-bottom: 12px;
            padding-bottom: 5px;
            border-bottom: 1px solid var(--line);
            color: var(--navy);
            font-size: 1.05rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .side p {
            color: var(--muted);
            font-size: 0.82rem;
        }

        .side ul {
            margin-left: 19px;
        }

        .side li {
            margin-bottom: 7px;
        }

        .side a {
            display: block;
            margin-bottom: 8px;
            color: var(--text);
            text-decoration: none;
            overflow-wrap: anywhere;
        }

        .side a:hover {
            color: var(--navy);
            text-decoration: underline;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 10px;
            overflow-wrap: anywhere;
        }

        .contact-item svg {
            flex: 0 0 14px;
            width: 14px;
            height: 14px;
            margin-top: 4px;
            fill: var(--navy);
        }

        .main-content {
            min-width: 0;
            padding: 36px 40px 32px 20px;
        }

        .section {
            position: relative;
            margin-bottom: 30px;
            padding-left: 44px;
        }

        .section::before {
            position: absolute;
            top: 30px;
            bottom: -30px;
            left: 14px;
            width: 2px;
            background: var(--line);
            content: "";
        }

        .section:last-child::before {
            display: none;
        }

        .dot {
            position: absolute;
            top: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--navy);
            color: #ffffff;
            font-size: 0.8rem;
        }

        .section h2 {
            margin-bottom: 12px;
            padding-bottom: 5px;
            border-bottom: 1px solid var(--line);
            color: var(--navy);
            font-size: 1.12rem;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .section p,
        .entry-description {
            color: var(--muted);
            font-size: 0.88rem;
            overflow-wrap: anywhere;
        }

        .entry {
            margin-bottom: 18px;
        }

        .entry:last-child {
            margin-bottom: 0;
        }

        .entry-title {
            font-size: 0.95rem;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .entry-description {
            margin-top: 4px;
            white-space: pre-line;
        }

        .project-list {
            display: grid;
            gap: 10px;
        }

        .project-item {
            padding: 10px 12px;
            border-left: 3px solid var(--navy);
            background: rgba(255, 255, 255, 0.68);
        }

        .project-item strong {
            display: block;
            font-size: 0.84rem;
        }

        .project-item p {
            margin-top: 3px;
            font-size: 0.78rem;
        }

        .share {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 16px;
            padding: 20px 32px;
            background: var(--navy-dark);
            color: #ffffff;
        }

        .share-copy {
            flex: 1 1 180px;
        }

        .share small {
            display: block;
            margin-top: 3px;
            color: #e0e3f4;
            font-size: 0.75rem;
        }

        .share input {
            flex: 1 1 220px;
            min-width: 0;
            padding: 10px 12px;
            border: 1px solid #d8dcef;
            border-radius: 4px;
            background: #ffffff;
            color: #25294b;
            font-size: 0.8rem;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 38px;
            padding: 9px 16px;
            border: 1px solid #8fa4d8;
            border-radius: 4px;
            background: transparent;
            color: #ffffff;
            font: inherit;
            font-size: 0.8rem;
            text-decoration: none;
            cursor: pointer;
            white-space: nowrap;
        }

        .button.primary {
            border-color: #2f6fe0;
            background: #2f6fe0;
        }

        .button:hover {
            filter: brightness(1.08);
        }

        .button.danger {
            border-color: #e36a72;
            background: #b92f3a;
            color: #ffffff;
        }

        .button.danger:hover {
            background: #9f2530;
        }

        .delete-form {
            display: inline-flex;
            margin: 0;
        }


        .footer {
            padding: 12px;
            background: #f4f5f9;
            color: var(--muted);
            font-size: 0.75rem;
            text-align: center;
        }

        .empty-note {
            color: var(--muted);
            font-size: 0.82rem;
            font-style: italic;
        }

        @media (max-width: 720px) {
            .page {
                margin: 0 auto;
            }

            .banner {
                min-height: 0;
                padding: 28px 24px;
                text-align: center;
            }

            .banner h1 {
                font-size: 1.8rem;
                letter-spacing: 1.5px;
            }

            .banner p {
                font-size: 0.85rem;
            }

            .body-layout {
                grid-template-columns: 1fr;
            }

            .sidebar {
                padding: 0 24px 10px;
            }

            .photo {
                margin: -10px auto 24px;
            }

            .main-content {
                padding: 28px 22px 30px;
            }

            .section {
                padding-left: 40px;
            }

            .share {
                padding: 20px;
            }

            .share input,
            .share .button {
                flex: 1 1 100%;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <header class="banner">
            <h1>{{ $name }}</h1>
            <p>Personal Portfolio</p>
        </header>

        <div class="body-layout">
            <aside class="sidebar" id="contact">
                <div class="photo">
                    @if ($photo)
                        <img src="{{ $photo }}" alt="{{ $name }} profile photo">
                    @else
                        {{ $initial }}
                    @endif
                </div>

                <div class="side">
                    <h3>Contact</h3>

                    @if ($phone !== '')
                        <div class="contact-item">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6.6 10.8a15 15 0 0 0 6.6 6.6l2.2-2.2a1 1 0 0 1 1-.25 11 11 0 0 0 3.6.6 1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1 11 11 0 0 0 .6 3.6 1 1 0 0 1-.25 1z"/></svg>
                            <span>{{ $phone }}</span>
                        </div>
                    @endif

                    @if ($email !== '')
                        <div class="contact-item">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M2 5h20v14H2zm2 2v.5l8 5 8-5V7zm16 3-8 5-8-5v7h16z"/></svg>
                            <span>{{ $email }}</span>
                        </div>
                    @endif

                    @if ($location !== '')
                        <div class="contact-item">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2a7 7 0 0 0-7 7c0 5 7 13 7 13s7-8 7-13a7 7 0 0 0-7-7zm0 9.5A2.5 2.5 0 1 1 12 6.5a2.5 2.5 0 0 1 0 5z"/></svg>
                            <span>{{ $location }}</span>
                        </div>
                    @endif

                    @if ($phone === '' && $email === '' && $location === '')
                        <p class="empty-note">Add your contact information to show it here.</p>
                    @endif
                </div>

                <div class="side">
                    <h3>Skills</h3>
                    @if (count($skills))
                        <ul>
                            @foreach ($skills as $skill)
                                <li>{{ $skill }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="empty-note">Your skills will appear here.</p>
                    @endif
                </div>

                <div class="side">
                    <h3>Projects</h3>
                    @if (count($projects))
                        <div class="project-list">
                            @foreach ($projects as $project)
                                <div class="project-item">
                                    <strong>{{ $project['title'] }}</strong>
                                    @if ($project['description'] !== '')
                                        <p>{{ $project['description'] }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="empty-note">Your projects will appear here.</p>
                    @endif
                </div>

                <div class="side">
                    <h3>Social Links</h3>
                    @if (count($socials))
                        @foreach ($socials as $social)
                            <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer">{{ $social['label'] }}</a>
                        @endforeach
                    @else
                        <p class="empty-note">Add social links to connect with visitors.</p>
                    @endif
                </div>
            </aside>

            <main class="main-content">
                <section class="section" id="about">
                    <span class="dot" aria-hidden="true">1</span>
                    <h2>About Me</h2>
                    @if ($about !== '')
                        <p>{{ $about }}</p>
                    @else
                        <p class="empty-note">Add a short introduction about yourself.</p>
                    @endif
                </section>

                <section class="section" id="experience">
                    <span class="dot" aria-hidden="true">2</span>
                    <h2>Work Experience</h2>
                    @forelse ($work as $workItem)
                        <div class="entry">
                            <div class="entry-title">{{ $workItem }}</div>
                        </div>
                    @empty
                        <p class="empty-note">Your work experience will appear here.</p>
                    @endforelse
                </section>

                <section class="section" id="education">
                    <span class="dot" aria-hidden="true">3</span>
                    <h2>Educational Background</h2>
                    @forelse ($education as $educationItem)
                        <div class="entry">
                            <div class="entry-title">{{ $educationItem }}</div>
                        </div>
                    @empty
                        <p class="empty-note">Your educational background will appear here.</p>
                    @endforelse
                </section>
            </main>
        </div>

        <div class="share">
            <div class="share-copy">
                <strong>Share Your Portfolio</strong>
                <small>Copy your portfolio link to share it with others.</small>
            </div>
            <input id="shareLink" type="text" value="{{ $shareUrl }}" aria-label="Portfolio share link" readonly>
            <button class="button primary" type="button" onclick="copyPortfolioLink(this)">Copy Link</button>
            <a class="button" href="{{ $editUrl }}">Edit Portfolio</a>

            <form
                class="delete-form"
                action="{{ route('portfolio.destroy', $portfolio->id) }}"
                method="POST"
                onsubmit="return confirm('Are you sure you want to delete this portfolio? This action cannot be undone.');"
            >
                @csrf
                @method('DELETE')
                <button class="button danger" type="submit">Delete Portfolio</button>
            </form>
        </div>

        <footer class="footer">
            &copy; {{ date('Y') }} {{ $name }}. All rights reserved.
        </footer>
    </div>

    <script>
        async function copyPortfolioLink(button) {
            const input = document.getElementById('shareLink');
            const originalLabel = button.textContent;

            try {
                if (navigator.clipboard && window.isSecureContext) {
                    await navigator.clipboard.writeText(input.value);
                } else {
                    input.focus();
                    input.select();
                    const copied = document.execCommand('copy');
                    if (!copied) {
                        throw new Error('Copy command was not successful.');
                    }
                }

                button.textContent = 'Copied!';
            } catch (error) {
                input.focus();
                input.select();
                button.textContent = 'Select and copy';
            }

            window.setTimeout(() => {
                button.textContent = originalLabel;
            }, 1800);
        }
    </script>
</body>
</html>
