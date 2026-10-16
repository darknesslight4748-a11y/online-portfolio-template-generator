{{--
    PortGen Template 2 — Modern
    This page uses the Portfolio model passed by PortfolioController@show.
    The form stores most information as text, so normalize it for display here.
--}}
@php
    $name = $portfolio->full_name ?: 'Your Name';
    $about = $portfolio->about_me ?: 'A snapshot of my work, experience, and the things I love creating.';
    $email = $portfolio->email ?? '';
    $phone = $portfolio->contact_number ?? '';
    $location = $portfolio->address ?? '';
    $photo = $portfolio->profile_picture
        ? asset('storage/' . $portfolio->profile_picture)
        : null;

    // Convert the project's multiline text field into displayable project cards.
    $projects = [];
    $projectText = trim((string) ($portfolio->projects ?? ''));
    if ($projectText !== '') {
        foreach (preg_split('/\\R+/', $projectText, -1, PREG_SPLIT_NO_EMPTY) as $projectLine) {
            $projectLine = trim($projectLine);
            if ($projectLine === '') {
                continue;
            }

            $parts = preg_split('/\\s*[:|]\\s*/', $projectLine, 2);
            $projects[] = [
                'title' => trim($parts[0] ?? 'Project'),
                'description' => trim($parts[1] ?? 'A project included in my portfolio.'),
                'image' => null,
            ];
        }
    }

    // Education and work experience are stored as textareas in this project.
    $educationText = trim((string) ($portfolio->education ?? ''));
    $education = $educationText !== '' ? [['text' => $educationText]] : [];

    $workText = trim((string) ($portfolio->work_experience ?? ''));
    $work = $workText !== '' ? [['text' => $workText]] : [];

    // Skills can be separated by commas or new lines.
    $skillsText = trim((string) ($portfolio->skills ?? ''));
    $skills = $skillsText !== ''
        ? array_values(array_filter(array_map('trim', preg_split('/[,\\r\\n]+/', $skillsText))))
        : [];

    // Accept URLs on their own or entries written as "Label: URL".
    $socials = [];
    $socialText = trim((string) ($portfolio->social_links ?? ''));
    if ($socialText !== '') {
        $socialEntries = preg_split('/[\\r\\n,]+/', $socialText, -1, PREG_SPLIT_NO_EMPTY);
        foreach ($socialEntries as $socialEntry) {
            $socialEntry = trim($socialEntry);
            if ($socialEntry === '') {
                continue;
            }

            if (preg_match('/^(.+?)\\s*:\\s*(https?:\\/\\/\\S+|www\\.\\S+)$/i', $socialEntry, $matches)) {
                $label = trim($matches[1]);
                $url = trim($matches[2]);
                if (str_starts_with(strtolower($url), 'www.')) {
                    $url = 'https://' . $url;
                }
            } else {
                $label = $socialEntry;
                if (preg_match('~^https?://~i', $socialEntry)) {
                    $url = $socialEntry;
                } elseif (preg_match('/^(www\\.|[a-z0-9.-]+\\.[a-z]{2,})(\\/.*)?$/i', $socialEntry)) {
                    $url = 'https://' . $socialEntry;
                } else {
                    $url = '#social';
                }
            }

            $socials[] = ['label' => $label, 'url' => $url];
        }
    }

    $shareUrl = route('portfolio.show', $portfolio->id);
    $editUrl = route('portfolio.edit', $portfolio->id);
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f5f7fb">
    <title><?= e($name) ?> | Portfolio</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            color-scheme: light;
            --page: #f5f7fb;
            --surface: #ffffff;
            --surface-soft: #eef1fb;
            --ink: #151a2d;
            --muted: #687087;
            --line: #e2e6f0;
            --accent: #555cf4;
            --accent-dark: #3f46d6;
            --accent-soft: #e7e9ff;
            --mint: #bdf5dc;
            --shadow: 0 22px 60px rgba(26, 34, 71, 0.09);
            --radius-lg: 28px;
            --radius-md: 18px;
            --content-width: 1160px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 100px;
        }

        body {
            background:
                radial-gradient(circle at 8% 10%, rgba(189, 245, 220, 0.35), transparent 23rem),
                radial-gradient(circle at 92% 25%, rgba(221, 224, 255, 0.65), transparent 28rem),
                var(--page);
            color: var(--ink);
            font-family: "DM Sans", Arial, sans-serif;
            line-height: 1.65;
            -webkit-font-smoothing: antialiased;
        }

        a {
            color: inherit;
        }

        img {
            display: block;
            max-width: 100%;
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: "Manrope", Arial, sans-serif;
            letter-spacing: -0.04em;
            line-height: 1.15;
        }

        .site-nav {
            position: sticky;
            top: 12px;
            z-index: 50;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            width: min(calc(100% - 36px), var(--content-width));
            min-height: 72px;
            margin: 12px auto 0;
            padding: 12px 18px 12px 24px;
            border: 1px solid rgba(226, 230, 240, 0.9);
            border-radius: 22px;
            background: rgba(255, 255, 255, 0.86);
            box-shadow: 0 10px 35px rgba(26, 34, 71, 0.07);
            backdrop-filter: blur(18px);
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--ink);
            font-family: "Manrope", sans-serif;
            font-size: 1rem;
            font-weight: 800;
            letter-spacing: -0.04em;
            text-decoration: none;
        }

        .brand-mark {
            display: grid;
            width: 36px;
            height: 36px;
            place-items: center;
            border-radius: 12px;
            background: var(--accent);
            color: #fff;
            font-size: 0.9rem;
            letter-spacing: -0.05em;
        }

        .nav-links {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: flex-end;
            gap: 6px;
        }

        .nav-links a {
            padding: 9px 12px;
            border-radius: 11px;
            color: var(--muted);
            font-size: 0.88rem;
            font-weight: 600;
            text-decoration: none;
            transition: background 180ms ease, color 180ms ease;
        }

        .nav-links a:hover,
        .nav-links a.active {
            background: var(--accent-soft);
            color: var(--accent-dark);
        }

        main {
            overflow: hidden;
        }

        .container {
            width: min(calc(100% - 40px), var(--content-width));
            margin-inline: auto;
        }

        .hero {
            display: grid;
            grid-template-columns: minmax(0, 1.2fr) minmax(280px, 0.8fr);
            align-items: center;
            gap: clamp(40px, 7vw, 100px);
            min-height: min(720px, calc(100vh - 100px));
            padding-block: 96px 90px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 24px;
            color: var(--accent-dark);
            font-size: 0.76rem;
            font-weight: 800;
            letter-spacing: 0.13em;
            text-transform: uppercase;
        }

        .eyebrow::before {
            width: 26px;
            height: 2px;
            background: var(--accent);
            content: "";
        }

        .hero h1 {
            max-width: 760px;
            font-size: clamp(3rem, 6.5vw, 5.8rem);
            font-weight: 800;
            letter-spacing: -0.075em;
            line-height: 1.02;
            overflow-wrap: anywhere;
        }

        .hero h1 .accent-text {
            color: var(--accent);
        }

        .hero-lead {
            max-width: 650px;
            margin-top: 24px;
            color: var(--muted);
            font-size: clamp(1rem, 1.6vw, 1.13rem);
        }

        .hero-about {
            max-width: 650px;
            margin-top: 15px;
            color: #454d64;
        }

        .contact-list {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 30px;
        }

        .contact-item {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 10px 13px;
            border: 1px solid var(--line);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.72);
            color: #424a61;
            font-size: 0.84rem;
            overflow-wrap: anywhere;
        }

        .contact-item svg {
            width: 16px;
            height: 16px;
            flex: 0 0 auto;
            fill: var(--accent);
        }

        .portrait-wrap {
            position: relative;
            width: min(100%, 370px);
            aspect-ratio: 0.88;
            justify-self: center;
        }

        .portrait-backdrop {
            position: absolute;
            inset: 16px 0 0 20px;
            border-radius: 40px;
            background: var(--mint);
            transform: rotate(5deg);
        }

        .portrait-frame {
            position: absolute;
            inset: 0 18px 18px 0;
            display: grid;
            overflow: hidden;
            place-items: center;
            border: 8px solid #fff;
            border-radius: 36px;
            background: linear-gradient(145deg, #e5e8ff, #d2f7e6);
            box-shadow: var(--shadow);
            color: var(--accent);
            font-family: "Manrope", sans-serif;
            font-size: 7rem;
            font-weight: 800;
        }

        .portrait-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .portrait-label {
            position: absolute;
            right: -2px;
            bottom: 0;
            padding: 12px 16px;
            border: 1px solid var(--line);
            border-radius: 15px;
            background: #fff;
            box-shadow: 0 12px 28px rgba(26, 34, 71, 0.1);
            color: var(--muted);
            font-size: 0.76rem;
            font-weight: 700;
        }

        .section {
            padding-block: 72px;
        }

        .section-heading {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 32px;
        }

        .section-kicker {
            display: block;
            margin-bottom: 10px;
            color: var(--accent-dark);
            font-size: 0.74rem;
            font-weight: 800;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .section-heading h2 {
            font-size: clamp(2rem, 4vw, 3.25rem);
            font-weight: 800;
        }

        .section-heading p {
            max-width: 420px;
            color: var(--muted);
            font-size: 0.95rem;
        }

        .project-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
        }

        .project-card {
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: var(--radius-lg);
            background: var(--surface);
            box-shadow: 0 8px 28px rgba(26, 34, 71, 0.04);
            transition: transform 200ms ease, box-shadow 200ms ease;
        }

        .project-card:hover {
            box-shadow: var(--shadow);
            transform: translateY(-5px);
        }

        .project-image {
            display: grid;
            height: 210px;
            overflow: hidden;
            place-items: center;
            background: var(--surface-soft);
            color: var(--accent);
            font-family: "Manrope", sans-serif;
            font-size: 2.3rem;
            font-weight: 800;
        }

        .project-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .project-body {
            padding: 23px;
        }

        .project-number {
            display: inline-block;
            margin-bottom: 12px;
            color: var(--accent);
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.12em;
        }

        .project-body h3 {
            margin-bottom: 10px;
            font-size: 1.25rem;
        }

        .project-body p {
            color: var(--muted);
            font-size: 0.91rem;
            overflow-wrap: anywhere;
        }

        .background-section {
            padding-block: 76px;
            background: rgba(232, 236, 249, 0.68);
            border-block: 1px solid rgba(226, 230, 240, 0.85);
        }

        .background-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        .background-card {
            padding: clamp(24px, 4vw, 36px);
            border: 1px solid var(--line);
            border-radius: var(--radius-lg);
            background: var(--surface);
        }

        .background-card h3 {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 26px;
            font-size: 1.35rem;
            letter-spacing: -0.03em;
        }

        .background-card h3 span {
            display: grid;
            width: 38px;
            height: 38px;
            flex: 0 0 auto;
            place-items: center;
            border-radius: 12px;
            background: var(--accent-soft);
            color: var(--accent-dark);
            font-size: 0.85rem;
        }

        .timeline-entry {
            position: relative;
            padding: 0 0 24px 20px;
            border-left: 2px solid var(--line);
        }

        .timeline-entry:last-child {
            padding-bottom: 0;
            border-left-color: transparent;
        }

        .timeline-entry::before {
            position: absolute;
            top: 5px;
            left: -6px;
            width: 10px;
            height: 10px;
            border: 2px solid #fff;
            border-radius: 50%;
            background: var(--accent);
            box-shadow: 0 0 0 1px var(--accent);
            content: "";
        }

        .entry-topline {
            display: flex;
            flex-wrap: wrap;
            align-items: baseline;
            justify-content: space-between;
            gap: 8px 14px;
            margin-bottom: 5px;
        }

        .entry-topline strong {
            font-size: 0.98rem;
        }

        .entry-period {
            color: var(--accent-dark);
            font-size: 0.78rem;
            font-weight: 700;
        }

        .entry-detail {
            color: var(--muted);
            font-size: 0.9rem;
            overflow-wrap: anywhere;
        }

        .skills-section {
            text-align: center;
        }

        .skills-section .section-heading {
            display: block;
            text-align: center;
        }

        .skills-section .section-heading p {
            margin: 12px auto 0;
        }

        .skill-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 11px;
            margin-top: 30px;
        }

        .skill-tag {
            padding: 10px 16px;
            border: 1px solid #d8dcff;
            border-radius: 12px;
            background: #fff;
            color: #3d43b5;
            font-size: 0.88rem;
            font-weight: 700;
        }

        .social-section {
            padding-top: 28px;
            padding-bottom: 80px;
        }

        .social-list {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            list-style: none;
        }

        .social-list a {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border: 1px solid var(--line);
            border-radius: 13px;
            background: #fff;
            color: var(--ink);
            font-size: 0.9rem;
            font-weight: 700;
            text-decoration: none;
            transition: border-color 180ms ease, transform 180ms ease;
        }

        .social-list a::after {
            color: var(--accent);
            content: "↗";
            font-size: 1rem;
        }

        .social-list a:hover {
            border-color: var(--accent);
            transform: translateY(-2px);
        }

        .share-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 26px;
            margin-top: 50px;
            padding: clamp(24px, 4vw, 36px);
            border-radius: var(--radius-lg);
            background: #171d34;
            color: #fff;
        }

        .share-copy h3 {
            margin-bottom: 7px;
            color: #fff;
            font-size: 1.45rem;
        }

        .share-copy p {
            color: #c1c7dc;
            font-size: 0.9rem;
        }

        .share-actions {
            display: flex;
            flex: 1 1 430px;
            flex-wrap: wrap;
            justify-content: flex-end;
            gap: 10px;
        }

        .share-input {
            min-width: 160px;
            flex: 1 1 180px;
            padding: 12px 14px;
            border: 1px solid #414863;
            border-radius: 12px;
            outline: none;
            background: #232a45;
            color: #fff;
            font: inherit;
            font-size: 0.85rem;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            padding: 11px 17px;
            border: 1px solid transparent;
            border-radius: 12px;
            background: var(--accent);
            color: #fff;
            cursor: pointer;
            font: inherit;
            font-size: 0.88rem;
            font-weight: 700;
            text-decoration: none;
            transition: background 180ms ease, transform 180ms ease;
        }

        .button:hover {
            background: var(--accent-dark);
            transform: translateY(-1px);
        }

        .button.secondary {
            border-color: #4b536f;
            background: transparent;
            color: #fff;
        }

        .button.secondary:hover {
            background: #2a3150;
        }

        .button.danger {
            border-color: #f87171;
            background: #dc2626;
            color: #ffffff;
        }

        .button.danger:hover {
            border-color: #ef4444;
            background: #b91c1c;
        }

        .delete-form {
            display: inline-flex;
            margin: 0;
        }


        .site-footer {
            padding: 24px 20px;
            border-top: 1px solid var(--line);
            color: var(--muted);
            font-size: 0.84rem;
            text-align: center;
        }

        @media (max-width: 900px) {
            .hero {
                grid-template-columns: minmax(0, 1fr) minmax(220px, 0.72fr);
                gap: 35px;
            }

            .project-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .share-card {
                align-items: flex-start;
                flex-direction: column;
            }

            .share-actions {
                width: 100%;
                justify-content: flex-start;
            }
        }

        @media (max-width: 680px) {
            html {
                scroll-padding-top: 130px;
            }

            .site-nav {
                top: 6px;
                width: calc(100% - 20px);
                min-height: auto;
                margin-top: 6px;
                padding: 12px;
                flex-direction: column;
                align-items: stretch;
                gap: 8px;
                border-radius: 18px;
            }

            .brand {
                align-self: center;
            }

            .nav-links {
                justify-content: center;
                gap: 2px;
            }

            .nav-links a {
                padding: 8px 9px;
                font-size: 0.78rem;
            }

            .container {
                width: min(calc(100% - 28px), var(--content-width));
            }

            .hero {
                min-height: 0;
                grid-template-columns: 1fr;
                gap: 42px;
                padding-block: 68px 56px;
                text-align: center;
            }

            .eyebrow {
                justify-content: center;
            }

            .hero h1 {
                font-size: clamp(2.7rem, 13vw, 4.4rem);
            }

            .hero-lead,
            .hero-about {
                margin-right: auto;
                margin-left: auto;
            }

            .contact-list {
                justify-content: center;
            }

            .portrait-wrap {
                width: min(78%, 320px);
            }

            .section,
            .background-section {
                padding-block: 54px;
            }

            .section-heading {
                align-items: flex-start;
                flex-direction: column;
                gap: 10px;
                margin-bottom: 24px;
            }

            .project-grid,
            .background-grid {
                grid-template-columns: 1fr;
            }

            .project-image {
                height: 230px;
            }

            .share-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .share-input,
            .share-actions .button {
                width: 100%;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                transition-duration: 0.01ms !important;
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
            }
        }
    </style>
</head>
<body>
    <nav class="site-nav" aria-label="Main navigation">
        <a class="brand" href="#about" aria-label="Back to introduction">
            <span class="brand-mark" aria-hidden="true">PG</span>
            <span><?= e($name) ?></span>
        </a>

        <div class="nav-links">
            <a href="#about" class="active">About</a>
            <a href="#projects">Projects</a>
            <a href="#background">Background</a>
            <a href="#skills">Skills</a>
            <a href="#social">Social</a>
        </div>
    </nav>

    <main>
        <!-- INTRODUCTION -->
        <section id="about" class="hero container">
            <div class="hero-copy">
                <p class="eyebrow">Personal portfolio</p>
                <h1>Hello, I'm <span class="accent-text"><?= e($name) ?>.</span></h1>
                <p class="hero-lead">A snapshot of my work, experience, and the things I love creating.</p>
                <p class="hero-about"><?= e($about) ?></p>

                <div class="contact-list">
                    <?php if (!empty($email)): ?>
                        <span class="contact-item">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 5h18a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Zm9 7L4 7v10h16V7l-8 5Zm0-2 7-4H5l7 4Z"/></svg>
                            <?= e($email) ?>
                        </span>
                    <?php endif; ?>

                    <?php if (!empty($phone)): ?>
                        <span class="contact-item">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6.6 10.8a15 15 0 0 0 6.6 6.6l2.2-2.2a1 1 0 0 1 1-.25 11 11 0 0 0 3.6.6 1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1 11 11 0 0 0 .6 3.6 1 1 0 0 1-.25 1l-1.25 1.2Z"/></svg>
                            <?= e($phone) ?>
                        </span>
                    <?php endif; ?>

                    <?php if (!empty($location)): ?>
                        <span class="contact-item">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2a7 7 0 0 0-7 7c0 5 7 13 7 13s7-8 7-13a7 7 0 0 0-7-7Zm0 9.5A2.5 2.5 0 1 1 12 6.5a2.5 2.5 0 0 1 0 5Z"/></svg>
                            <?= e($location) ?>
                        </span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="portrait-wrap" aria-label="Profile photo">
                <div class="portrait-backdrop" aria-hidden="true"></div>
                <div class="portrait-frame">
                    <?php if (!empty($photo)): ?>
                        <img src="<?= e($photo) ?>" alt="Portrait of <?= e($name) ?>">
                    <?php else: ?>
                        <?= e(strtoupper(mb_substr($name, 0, 1))) ?>
                    <?php endif; ?>
                </div>
                <div class="portrait-label">A little about me&nbsp; ↘</div>
            </div>
        </section>

        <!-- PROJECTS -->
        <section id="projects" class="section container">
            <div class="section-heading">
                <div>
                    <span class="section-kicker">Selected work</span>
                    <h2>Projects I've built.</h2>
                </div>
                <p>A few projects that highlight my skills, ideas, and the problems I enjoy solving.</p>
            </div>

            <div class="project-grid">
                <?php if (!empty($projects)): ?>
                    <?php foreach ($projects as $index => $p): ?>
                        <article class="project-card">
                            <div class="project-image">
                                <?php if (!empty($p['image'])): ?>
                                    <img src="<?= e('uploads/' . $p['image']) ?>" alt="Project: <?= e($p['title'] ?? $p['name'] ?? 'Project') ?>">
                                <?php else: ?>
                                    <?= e(str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)) ?>
                                <?php endif; ?>
                            </div>
                            <div class="project-body">
                                <span class="project-number">PROJECT <?= e(str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)) ?></span>
                                <h3><?= e($p['title'] ?? $p['name'] ?? 'My Project') ?></h3>
                                <p><?= e($p['description'] ?? $p['text'] ?? '') ?></p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <article class="project-card">
                        <div class="project-image">01</div>
                        <div class="project-body">
                            <span class="project-number">YOUR WORK</span>
                            <h3>Featured project</h3>
                            <p>Your project description will appear here.</p>
                        </div>
                    </article>
                <?php endif; ?>
            </div>
        </section>

        <!-- EDUCATION AND EXPERIENCE -->
        <div id="background" class="background-section">
            <section class="container">
                <div class="section-heading">
                    <div>
                        <span class="section-kicker">The journey</span>
                        <h2>Background & experience.</h2>
                    </div>
                    <p>The education and experiences that have helped me grow.</p>
                </div>

                <div class="background-grid">
                    <article class="background-card">
                        <h3><span aria-hidden="true">01</span> Education</h3>

                        <?php if (!empty($education)): ?>
                            <?php foreach ($education as $ed): ?>
                                <div class="timeline-entry">
                                    <?php if (isset($ed['text'])): ?>
                                        <p class="entry-detail"><?= e($ed['text']) ?></p>
                                    <?php else: ?>
                                        <div class="entry-topline">
                                            <strong><?= e($ed['degree'] ?? '') ?></strong>
                                            <span class="entry-period"><?= e($ed['period'] ?? $ed['year'] ?? '') ?></span>
                                        </div>
                                        <p class="entry-detail"><?= e($ed['school'] ?? $ed['university'] ?? '') ?></p>
                                        <?php if (!empty($ed['gpa'])): ?>
                                            <p class="entry-detail">GPA: <?= e($ed['gpa']) ?></p>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="entry-detail">Add your degree, school, and graduation year to complete this section.</p>
                        <?php endif; ?>
                    </article>

                    <article class="background-card">
                        <h3><span aria-hidden="true">02</span> Experience</h3>

                        <?php if (!empty($work)): ?>
                            <?php foreach ($work as $w): ?>
                                <div class="timeline-entry">
                                    <?php if (isset($w['text'])): ?>
                                        <p class="entry-detail"><?= e($w['text']) ?></p>
                                    <?php else: ?>
                                        <div class="entry-topline">
                                            <strong><?= e($w['position'] ?? $w['role'] ?? '') ?></strong>
                                            <span class="entry-period"><?= e($w['period'] ?? '') ?></span>
                                        </div>
                                        <p class="entry-detail"><?= e($w['company'] ?? '') ?></p>
                                        <?php if (!empty($w['description'])): ?>
                                            <p class="entry-detail"><?= e($w['description']) ?></p>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="entry-detail">Add your previous roles, organizations, or relevant experience here.</p>
                        <?php endif; ?>
                    </article>
                </div>
            </section>
        </div>

        <!-- SKILLS -->
        <section id="skills" class="section skills-section container">
            <div class="section-heading">
                <span class="section-kicker">What I work with</span>
                <h2>Skills & tools.</h2>
                <p>The tools, technologies, and abilities I bring to a project.</p>
            </div>

            <div class="skill-list">
                <?php if (!empty($skills)): ?>
                    <?php foreach ($skills as $s): ?>
                        <span class="skill-tag"><?= e(is_array($s) ? ($s['name'] ?? '') : $s) ?></span>
                    <?php endforeach; ?>
                <?php else: ?>
                    <span class="skill-tag">Add your skills</span>
                <?php endif; ?>
            </div>
        </section>

        <!-- SOCIAL LINKS AND SHARE -->
        <section id="social" class="social-section container">
            <div class="section-heading">
                <div>
                    <span class="section-kicker">Around the web</span>
                    <h2>Let's connect.</h2>
                </div>
                <p>Find me online or share this portfolio with someone.</p>
            </div>

            <ul class="social-list">
                <?php if (!empty($socials)): ?>
                    <?php foreach ($socials as $key => $l): ?>
                        <?php
                            $u = is_array($l) ? ($l['url'] ?? '#') : $l;
                            $t = is_array($l)
                                ? ($l['label'] ?? $l['platform'] ?? $u)
                                : (is_string($key) ? $key : $u);
                        ?>
                        <li>
                            <a href="<?= e($u) ?>" target="_blank" rel="noopener noreferrer">
                                <?= e($t) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li><a href="#social">Add your social links</a></li>
                <?php endif; ?>
            </ul>

            <div class="share-card">
                <div class="share-copy">
                    <h3>Pass it along.</h3>
                    <p>Share your portfolio with classmates, recruiters, or collaborators.</p>
                </div>

                <div class="share-actions">
                    <input class="share-input" type="text" id="shareLink" value="<?= e($shareUrl) ?>" readonly aria-label="Portfolio share link">
                    <button class="button" type="button" id="copyLinkButton" onclick="copyLink(this)">Copy link</button>
                    <a class="button secondary" href="<?= e($editUrl) ?>">Edit portfolio</a>

                    <form
                        class="delete-form"
                        action="{{ route('portfolio.destroy', $portfolio->id) }}"
                        method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this portfolio? This action cannot be undone.');"
                    >
                        @csrf
                        @method('DELETE')
                        <button class="button danger" type="submit">Delete portfolio</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        &copy; <?= date('Y') ?> <?= e($name) ?>. Built with care.
    </footer>

    <script>
        // Highlight the navigation item that matches the section currently in view.
        const navLinks = [...document.querySelectorAll('.nav-links a')];
        const observedSections = navLinks
            .map((link) => document.querySelector(link.getAttribute('href')))
            .filter(Boolean);

        if ('IntersectionObserver' in window) {
            const sectionObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) return;

                    navLinks.forEach((link) => {
                        const isActive = link.getAttribute('href') === `#${entry.target.id}`;
                        link.classList.toggle('active', isActive);
                    });
                });
            }, {
                rootMargin: '-32% 0px -56% 0px',
                threshold: 0
            });

            observedSections.forEach((section) => sectionObserver.observe(section));
        }

        // Copy the public portfolio URL, with a fallback for browsers without Clipboard API access.
        async function copyLink(button) {
            const input = document.getElementById('shareLink');
            if (!input) return;

            const originalText = button.textContent;

            try {
                if (navigator.clipboard && window.isSecureContext) {
                    await navigator.clipboard.writeText(input.value);
                } else {
                    input.focus();
                    input.select();
                    const copied = document.execCommand('copy');
                    if (!copied) throw new Error('Copy command failed');
                }

                button.textContent = 'Copied!';
            } catch (error) {
                input.focus();
                input.select();
                button.textContent = 'Select and copy';
            }

            window.setTimeout(() => {
                button.textContent = originalText;
            }, 1800);
        }
    </script>
</body>
</html>
