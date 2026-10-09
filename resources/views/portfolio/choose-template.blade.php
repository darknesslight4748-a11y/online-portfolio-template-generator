<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Portfolio Template</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 40px 20px;
            font-family: Arial, sans-serif;
            background: #f4f5f7;
            color: #303846;
        }

        .container {
            max-width: 1100px;
            margin: auto;
        }

        h1 {
            margin: 0 0 8px;
            font-size: 32px;
        }

        .subtitle {
            margin-bottom: 30px;
            color: #737b88;
        }

        .templates {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
        }

        .template-card {
            padding: 20px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            min-width: 0;
        }

        /* Preview frame */

        .preview {
            height: 260px;
            overflow: hidden;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 18px;
        }

        .mini-nav {
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 10px;
            font-size: 7px;
            font-weight: bold;
        }

        .mini-links {
            display: flex;
            gap: 8px;
            font-size: 6px;
        }

        .mini-content {
            padding: 12px;
        }

        .mini-title {
            font-size: 17px;
            font-weight: bold;
            line-height: 1.2;
        }

        .mini-text {
            margin-top: 7px;
            font-size: 7px;
            line-height: 1.6;
        }

        .mini-line {
            height: 5px;
            margin-top: 6px;
            border-radius: 4px;
        }

        .mini-cards {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 7px;
            margin-top: 12px;
        }

        .mini-card {
            min-height: 42px;
            padding: 8px;
            border-radius: 4px;
            font-size: 7px;
        }

        .mini-button {
            display: inline-block;
            margin-top: 10px;
            padding: 5px 9px;
            border-radius: 3px;
            font-size: 7px;
            font-weight: bold;
        }

        /* Template 1: Professional */

        .professional {
            background: #fff;
            color: #183153;
        }

        .professional .mini-nav {
            border-bottom: 1px solid #e6edf6;
        }

        .professional .mini-hero {
            display: grid;
            grid-template-columns: 75px 1fr;
            gap: 10px;
            align-items: center;
            padding: 14px 10px;
            background: #f3f8ff;
        }

        .professional .mini-photo {
            height: 85px;
            border-radius: 5px;
            background: #dce9f9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            font-weight: bold;
            color: #2875e8;
        }

        .professional .mini-line {
            background: #d4e0ef;
        }

        .professional .mini-card {
            border: 1px solid #e0e8f2;
            background: #fff;
        }

        .professional .mini-button {
            color: white;
            background: #2875e8;
        }

        /* Template 2: Modern */

        .modern {
            background: #151b2b;
            color: #f5f7ff;
        }

        .modern .mini-nav {
            border-bottom: 1px solid #333d52;
        }

        .modern .mini-hero {
            display: grid;
            grid-template-columns: 1fr 85px;
            align-items: center;
            gap: 8px;
            padding: 18px 12px;
            background: #1d263a;
        }

        .modern .mini-photo {
            height: 85px;
            border-radius: 50%;
            background: linear-gradient(135deg, #a6a7ff, #4c5b98);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: bold;
        }

        .modern .mini-line {
            background: #46516a;
        }

        .modern .mini-card {
            background: #263249;
            border: 1px solid #3c4964;
        }

        .modern .mini-button {
            background: #a6a7ff;
            color: #151b2b;
        }

        .modern .accent {
            color: #a6a7ff;
        }

        /* Template 3: Creative */

        .creative {
            background: #fff9f0;
            color: #242424;
        }

        .creative .mini-nav {
            border-bottom: 1px solid #eee0d0;
        }

        .creative .mini-hero {
            display: grid;
            grid-template-columns: 1fr 85px;
            align-items: center;
            gap: 8px;
            padding: 15px 12px;
        }

        .creative .mini-title {
            font-size: 19px;
            font-weight: 900;
        }

        .creative .mini-title span {
            color: #ff5b35;
        }

        .creative .mini-photo {
            height: 100px;
            border-radius: 45% 45% 8px 8px;
            background: #ffccba;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #242424;
            font-size: 28px;
            font-weight: bold;
            border: 2px solid #242424;
        }

        .creative .mini-line {
            background: #ead8c8;
        }

        .creative .mini-card {
            border: 1px solid #242424;
            background: #d7f36b;
        }

        .creative .mini-card:nth-child(2) {
            background: #ffccba;
        }

        .creative .mini-button {
            background: #242424;
            color: white;
        }

        /* Shared bottom preview */

        .mini-skills {
            display: flex;
            gap: 4px;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .mini-skill {
            padding: 4px 6px;
            border-radius: 8px;
            font-size: 6px;
        }

        .professional .mini-skill {
            background: #e6effc;
        }

        .modern .mini-skill {
            background: #303d58;
        }

        .creative .mini-skill {
            background: #e4e1ff;
        }

        .card-title {
            margin: 0 0 10px;
            font-size: 20px;
        }

        .description {
            min-height: 42px;
            margin: 0 0 15px;
            color: #737b88;
            font-size: 13px;
            line-height: 1.6;
        }

        .choose-button {
            display: block;
            width: 100%;
            padding: 12px;
            border: 0;
            border-radius: 5px;
            background: #2864e8;
            color: white;
            text-align: center;
            font-size: 13px;
            cursor: pointer;
        }

        .choose-button:hover {
            background: #194fc8;
        }

        form {
            margin: 0;
        }

        @media (max-width: 850px) {
            .templates {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 580px) {
            body {
                padding: 25px 15px;
            }

            h1 {
                font-size: 27px;
            }

            .templates {
                grid-template-columns: 1fr;
            }

            .preview {
                height: 280px;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <h1>Choose Your Portfolio Template</h1>
    <p class="subtitle">
        Select a design for your portfolio. You can update your information later.
    </p>

    <div class="templates">

        <!-- TEMPLATE 1: PROFESSIONAL -->
        <div class="template-card">
            <div class="preview professional">
                <div class="mini-nav">
                    <span>● {{ $portfolio->full_name }}</span>
                    <div class="mini-links">
                        <span>About</span>
                        <span>Skills</span>
                        <span>Projects</span>
                    </div>
                </div>

                <div class="mini-hero">
                    <div class="mini-photo">
                        {{ strtoupper(substr($portfolio->full_name, 0, 1)) }}
                    </div>

                    <div>
                        <div style="font-size:7px;color:#2875e8;">HELLO, I'M</div>
                        <div class="mini-title">
                            {{ $portfolio->full_name }}
                        </div>
                        <div class="mini-text">
                            {{ Str::limit($portfolio->about_me ?: 'Welcome to my professional portfolio.', 90) }}
                        </div>
                        <div class="mini-line" style="width:90%;"></div>
                        <div class="mini-line" style="width:65%;"></div>
                    </div>
                </div>

                <div class="mini-content">
                    <div class="mini-cards">
                        <div class="mini-card">
                            <b>About Me</b>
                            <div class="mini-line" style="width:90%;"></div>
                            <div class="mini-line" style="width:65%;"></div>
                        </div>
                        <div class="mini-card">
                            <b>Education</b>
                            <div class="mini-line" style="width:90%;"></div>
                            <div class="mini-line" style="width:60%;"></div>
                        </div>
                        <div class="mini-card">
                            <b>Skills</b>
                            <div class="mini-skills">
                                <span class="mini-skill">HTML</span>
                                <span class="mini-skill">CSS</span>
                                <span class="mini-skill">PHP</span>
                            </div>
                        </div>
                        <div class="mini-card">
                            <b>Projects</b>
                            <div class="mini-line" style="width:90%;"></div>
                            <div class="mini-line" style="width:60%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <h2 class="card-title">Professional</h2>
            <p class="description">
                A clean, professional design with organized sections and a blue color scheme.
            </p>

            <form action="{{ route('portfolio.select-template', $portfolio->id) }}" method="POST">
                @csrf
                <input type="hidden" name="template" value="template1">
                <button class="choose-button" type="submit">
                    Choose Professional
                </button>
            </form>
        </div>

        <!-- TEMPLATE 2: MODERN -->
        <div class="template-card">
            <div class="preview modern">
                <div class="mini-nav">
                    <span>{{ $portfolio->full_name }}</span>
                    <div class="mini-links">
                        <span>Home</span>
                        <span>Work</span>
                        <span>Contact</span>
                    </div>
                </div>

                <div class="mini-hero">
                    <div>
                        <div class="accent" style="font-size:8px;">WELCOME TO MY SPACE</div>
                        <div class="mini-title">
                            Hello, I'm<br>{{ $portfolio->full_name }}
                        </div>
                        <div class="mini-text">
                            {{ Str::limit($portfolio->about_me ?: 'Explore my work and skills.', 75) }}
                        </div>
                        <span class="mini-button">View Projects ↗</span>
                    </div>

                    <div class="mini-photo">
                        {{ strtoupper(substr($portfolio->full_name, 0, 1)) }}
                    </div>
                </div>

                <div class="mini-content">
                    <b style="font-size:10px;">Featured Projects</b>

                    <div class="mini-cards">
                        <div class="mini-card">
                            <b>01 / Project</b>
                            <div class="mini-line" style="width:90%;"></div>
                            <div class="mini-line" style="width:60%;"></div>
                        </div>
                        <div class="mini-card">
                            <b>02 / Project</b>
                            <div class="mini-line" style="width:90%;"></div>
                            <div class="mini-line" style="width:60%;"></div>
                        </div>
                    </div>

                    <div class="mini-skills">
                        <span class="mini-skill">Skills</span>
                        <span class="mini-skill">Education</span>
                        <span class="mini-skill">Experience</span>
                    </div>
                </div>
            </div>

            <h2 class="card-title">Modern</h2>
            <p class="description">
                A dark, contemporary design with a bold introduction and featured project cards.
            </p>

            <form action="{{ route('portfolio.select-template', $portfolio->id) }}" method="POST">
                @csrf
                <input type="hidden" name="template" value="template2">
                <button class="choose-button" type="submit">
                    Choose Modern
                </button>
            </form>
        </div>

        <!-- TEMPLATE 3: CREATIVE -->
        <div class="template-card">
            <div class="preview creative">
                <div class="mini-nav">
                    <span>✳ {{ $portfolio->full_name }}</span>
                    <div class="mini-links">
                        <span>About</span>
                        <span>Work</span>
                        <span>Skills</span>
                    </div>
                </div>

                <div class="mini-hero">
                    <div>
                        <span style="font-size:7px;background:#d7f36b;padding:4px;border-radius:8px;">
                            CREATIVE PORTFOLIO
                        </span>

                        <div class="mini-title" style="margin-top:8px;">
                            Hey, I'm<br><span>{{ $portfolio->full_name }}</span>
                        </div>

                        <div class="mini-text">
                            {{ Str::limit($portfolio->about_me ?: 'Creative ideas and personal projects.', 75) }}
                        </div>

                        <span class="mini-button">Explore My Work ↗</span>
                    </div>

                    <div class="mini-photo">
                        {{ strtoupper(substr($portfolio->full_name, 0, 1)) }}
                    </div>
                </div>

                <div class="mini-content">
                    <b style="font-size:10px;">Things I've Created ✳</b>

                    <div class="mini-cards">
                        <div class="mini-card">
                            <b>Project 01</b>
                            <div class="mini-line" style="width:90%;"></div>
                            <div class="mini-line" style="width:60%;"></div>
                        </div>
                        <div class="mini-card">
                            <b>Project 02</b>
                            <div class="mini-line" style="width:90%;"></div>
                            <div class="mini-line" style="width:60%;"></div>
                        </div>
                    </div>

                    <div style="margin-top:12px;font-size:9px;font-weight:bold;">
                        My Creative Toolkit
                    </div>

                    <div class="mini-skills">
                        <span class="mini-skill">HTML</span>
                        <span class="mini-skill">CSS</span>
                        <span class="mini-skill">JavaScript</span>
                        <span class="mini-skill">PHP</span>
                    </div>
                </div>
            </div>

            <h2 class="card-title">Creative</h2>
            <p class="description">
                A playful design with colorful project cards, creative accents, and a unique layout.
            </p>

            <form action="{{ route('portfolio.select-template', $portfolio->id) }}" method="POST">
                @csrf
                <input type="hidden" name="template" value="template3">
                <button class="choose-button" type="submit">
                    Choose Creative
                </button>
            </form>
        </div>

    </div>
</div>
</body>
</html>