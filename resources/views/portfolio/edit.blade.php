<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Portfolio</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background:
                radial-gradient(circle at 10% 10%, rgba(124, 58, 237, 0.18), transparent 30%),
                radial-gradient(circle at 90% 20%, rgba(59, 130, 246, 0.15), transparent 30%),
                #09090d;
            color: #ffffff;
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 1050px;
            margin: auto;
        }

        /* TOP BAR */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 45px;
        }

        .logo {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .step {
            color: #a1a1aa;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        /* HEADER */
        .hero {
            margin-bottom: 30px;
        }

        .badge {
            display: inline-block;
            padding: 8px 13px;
            border: 1px solid rgba(168, 85, 247, 0.35);
            background: rgba(168, 85, 247, 0.10);
            color: #c084fc;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 18px;
        }

        h1 {
            font-size: clamp(38px, 6vw, 65px);
            line-height: 0.95;
            letter-spacing: -3px;
            margin-bottom: 15px;
        }

        .hero p {
            color: #a1a1aa;
            font-size: 16px;
            max-width: 600px;
            line-height: 1.6;
        }

        /* CARD */
        .form-card {
            background: rgba(18, 18, 24, 0.90);
            border: 1px solid #27272f;
            border-radius: 24px;
            padding: 35px;
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.35);
        }

        .section {
            margin-bottom: 38px;
        }

        .section:last-child {
            margin-bottom: 0;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 22px;
        }

        .number {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: linear-gradient(135deg, #7c3aed, #2563eb);
            font-size: 13px;
            font-weight: 800;
        }

        .section-title h2 {
            font-size: 18px;
        }

        .section-title span {
            color: #71717a;
            font-size: 13px;
            margin-left: auto;
        }

        /* GRID */
        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .full {
            grid-column: 1 / -1;
        }

        /* FORM */
        label {
            display: block;
            color: #d4d4d8;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        input,
        textarea {
            width: 100%;
            border: 1px solid #30303a;
            background: #111117;
            color: #ffffff;
            border-radius: 12px;
            padding: 14px 15px;
            font-size: 14px;
            outline: none;
            transition: 0.2s ease;
        }

        input:focus,
        textarea:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.12);
        }

        textarea {
            min-height: 125px;
            resize: vertical;
            line-height: 1.6;
        }

        input::placeholder,
        textarea::placeholder {
            color: #52525b;
        }

        /* CURRENT PHOTO */
        .photo-box {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 18px;
            background: #111117;
            border: 1px solid #30303a;
            border-radius: 15px;
        }

        .photo-box img {
            width: 75px;
            height: 75px;
            object-fit: cover;
            border-radius: 18px;
            border: 2px solid #8b5cf6;
        }

        .photo-info strong {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .photo-info span {
            color: #71717a;
            font-size: 12px;
        }

        /* FILE INPUT */
        input[type="file"] {
            padding: 10px;
        }

        input[type="file"]::file-selector-button {
            border: none;
            background: #27272f;
            color: white;
            padding: 9px 12px;
            border-radius: 8px;
            cursor: pointer;
            margin-right: 10px;
        }

        /* BUTTONS */
        .actions {
            display: flex;
            gap: 12px;
            margin-top: 35px;
            padding-top: 25px;
            border-top: 1px solid #27272f;
        }

        .btn {
            border: none;
            text-decoration: none;
            padding: 14px 22px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            transition: 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #7c3aed, #2563eb);
            color: white;
            flex: 1;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(124, 58, 237, 0.3);
        }

        .btn-secondary {
            background: #27272f;
            color: #d4d4d8;
        }

        .btn-secondary:hover {
            background: #34343e;
        }

        /* ERRORS */
        .errors {
            background: rgba(239, 68, 68, 0.10);
            border: 1px solid rgba(239, 68, 68, 0.30);
            color: #fca5a5;
            border-radius: 14px;
            padding: 15px 18px;
            margin-bottom: 25px;
            font-size: 13px;
            line-height: 1.6;
        }

        .errors ul {
            padding-left: 18px;
        }

        /* RESPONSIVE */
        @media (max-width: 700px) {

            body {
                padding: 25px 14px;
            }

            .topbar {
                margin-bottom: 35px;
            }

            .form-card {
                padding: 22px;
                border-radius: 18px;
            }

            .grid {
                grid-template-columns: 1fr;
            }

            .full {
                grid-column: auto;
            }

            .section-title span {
                display: none;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }

            h1 {
                letter-spacing: -2px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <!-- TOP BAR -->
    <div class="topbar">
        <div class="logo">PORTFOLIO.</div>
        <div class="step">EDIT MODE</div>
    </div>

    <!-- HERO -->
    <div class="hero">
        <div class="badge">✦ UPDATE YOUR PROFILE</div>

        <h1>Edit Your<br>Portfolio.</h1>

        <p>
            Update your information, improve your portfolio,
            and save your latest changes.
        </p>
    </div>

    <!-- FORM CARD -->
    <div class="form-card">

        @if ($errors->any())
            <div class="errors">
                <strong>Please fix the following:</strong>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('portfolio.update', $portfolio->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <!-- 01 PROFILE -->
            <div class="section">

                <div class="section-title">
                    <div class="number">01</div>
                    <h2>Profile</h2>
                    <span>Basic information</span>
                </div>

                <div class="grid">

                    <div class="full">
                        <label>Full Name</label>

                        <input
                            type="text"
                            name="full_name"
                            value="{{ old('full_name', $portfolio->full_name) }}"
                            placeholder="Enter your full name"
                            required
                        >
                    </div>

                    <div>
                        <label>Email</label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email', $portfolio->email) }}"
                            placeholder="you@example.com"
                            required
                        >
                    </div>

                    <div>
                        <label>Contact Number</label>

                        <input
                            type="text"
                            name="contact_number"
                            value="{{ old('contact_number', $portfolio->contact_number) }}"
                            placeholder="+63 9XX XXX XXXX"
                        >
                    </div>

                    <div class="full">
                        <label>Address</label>

                        <input
                            type="text"
                            name="address"
                            value="{{ old('address', $portfolio->address) }}"
                            placeholder="Enter your address"
                        >
                    </div>

                </div>
            </div>

            <!-- 02 PHOTO -->
            <div class="section">

                <div class="section-title">
                    <div class="number">02</div>
                    <h2>Profile Picture</h2>
                    <span>Optional</span>
                </div>

                <div class="grid">

                    @if ($portfolio->profile_picture)
                        <div class="full">

                            <div class="photo-box">

                                <img
                                    src="{{ asset('storage/' . $portfolio->profile_picture) }}"
                                    alt="Current Profile Picture"
                                >

                                <div class="photo-info">
                                    <strong>Current Profile Picture</strong>
                                    <span>Choose a new image below if you want to replace it.</span>
                                </div>

                            </div>

                        </div>
                    @endif

                    <div class="full">

                        <label>New Profile Picture</label>

                        <input
                            type="file"
                            name="profile_picture"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                    </div>

                </div>
            </div>

            <!-- 03 ABOUT -->
            <div class="section">

                <div class="section-title">
                    <div class="number">03</div>
                    <h2>About You</h2>
                    <span>Tell your story</span>
                </div>

                <div class="grid">

                    <div class="full">

                        <label>About Me</label>

                        <textarea
                            name="about_me"
                            placeholder="Write a short introduction about yourself..."
                        >{{ old('about_me', $portfolio->about_me) }}</textarea>

                    </div>

                </div>
            </div>

            <!-- 04 EDUCATION & SKILLS -->
            <div class="section">

                <div class="section-title">
                    <div class="number">04</div>
                    <h2>Education & Skills</h2>
                    <span>Your background</span>
                </div>

                <div class="grid">

                    <div>
                        <label>Educational Background</label>

                        <textarea
                            name="education"
                            placeholder="Example: Bachelor of Science in Information Technology..."
                        >{{ old('education', $portfolio->education) }}</textarea>

                    </div>

                    <div>
                        <label>Skills</label>

                        <textarea
                            name="skills"
                            placeholder="Example: HTML, CSS, PHP, Laravel..."
                        >{{ old('skills', $portfolio->skills) }}</textarea>

                    </div>

                </div>
            </div>

            <!-- 05 EXPERIENCE & PROJECTS -->
            <div class="section">

                <div class="section-title">
                    <div class="number">05</div>
                    <h2>Experience & Projects</h2>
                    <span>Show your work</span>
                </div>

                <div class="grid">

                    <div>
                        <label>Work Experience</label>

                        <textarea
                            name="work_experience"
                            placeholder="Describe your work experience..."
                        >{{ old('work_experience', $portfolio->work_experience) }}</textarea>

                    </div>

                    <div>
                        <label>Projects</label>

                        <textarea
                            name="projects"
                            placeholder="Describe your projects..."
                        >{{ old('projects', $portfolio->projects) }}</textarea>

                    </div>

                </div>
            </div>

            <!-- 06 SOCIAL -->
            <div class="section">

                <div class="section-title">
                    <div class="number">06</div>
                    <h2>Social Links</h2>
                    <span>Connect with people</span>
                </div>

                <div class="grid">

                    <div class="full">

                        <label>Social Media / Website Links</label>

                        <textarea
                            name="social_links"
                            placeholder="Facebook, LinkedIn, GitHub, personal website..."
                        >{{ old('social_links', $portfolio->social_links) }}</textarea>

                    </div>

                </div>
            </div>

            <!-- ACTIONS -->
            <div class="actions">

                <a
                    href="{{ route('portfolio.show', $portfolio->id) }}"
                    class="btn btn-secondary"
                >
                    ← Cancel
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Save Changes →
                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>