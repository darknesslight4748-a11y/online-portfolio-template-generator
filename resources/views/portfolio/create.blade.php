<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Portfolio</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 30px 15px;
        }

        .container {
            max-width: 850px;
            margin: auto;
        }

        h1 {
            margin-bottom: 8px;
        }

        .description {
            color: #666;
            margin-bottom: 25px;
        }

        .form-card {
            background: white;
            padding: 25px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .section {
            margin-bottom: 25px;
        }

        .section h2 {
            font-size: 18px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 18px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .field {
            margin-bottom: 16px;
        }

        .full {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            font-size: 14px;
        }

        input, textarea {
            width: 100%;
            padding: 11px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font: inherit;
        }

        input:focus, textarea:focus {
            outline: 2px solid #bfdbfe;
            border-color: #2563eb;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .errors {
            color: #b91c1c;
            background: #fee2e2;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .button {
            width: 100%;
            padding: 13px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .button:hover {
            background: #1d4ed8;
        }

        @media (max-width: 600px) {
            .grid {
                grid-template-columns: 1fr;
            }

            .full {
                grid-column: auto;
            }

            .form-card {
                padding: 18px;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <h1>Create Your Portfolio</h1>
    <p class="description">
        Enter your information to create your personal portfolio.
    </p>

    <div class="form-card">

        @if ($errors->any())
            <div class="errors">
                <strong>Please check your information:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('portfolio.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="section">
                <h2>1. Personal Information</h2>

                <div class="grid">
                    <div class="field full">
                        <label>Full Name *</label>
                        <input type="text" name="full_name"
                               value="{{ old('full_name') }}" required>
                    </div>

                    <div class="field">
                        <label>Email *</label>
                        <input type="email" name="email"
                               value="{{ old('email') }}" required>
                    </div>

                    <div class="field">
                        <label>Contact Number</label>
                        <input type="text" name="contact_number"
                               value="{{ old('contact_number') }}">
                    </div>

                    <div class="field full">
                        <label>Address</label>
                        <input type="text" name="address"
                               value="{{ old('address') }}">
                    </div>

                    <div class="field full">
                        <label>Profile Picture</label>
                        <input type="file" name="profile_picture"
                               accept=".jpg,.jpeg,.png,.webp">
                    </div>
                </div>
            </div>

            <div class="section">
                <h2>2. About Me</h2>

                <div class="field">
                    <label>Introduction</label>
                    <textarea name="about_me">{{ old('about_me') }}</textarea>
                </div>
            </div>

            <div class="section">
                <h2>3. Education and Skills</h2>

                <div class="grid">
                    <div class="field">
                        <label>Educational Background</label>
                        <textarea name="education">{{ old('education') }}</textarea>
                    </div>

                    <div class="field">
                        <label>Skills</label>
                        <textarea name="skills">{{ old('skills') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="section">
                <h2>4. Experience and Projects</h2>

                <div class="grid">
                    <div class="field">
                        <label>Work Experience</label>
                        <textarea name="work_experience">{{ old('work_experience') }}</textarea>
                    </div>

                    <div class="field">
                        <label>Projects</label>
                        <textarea name="projects">{{ old('projects') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="section">
                <h2>5. Social Links</h2>

                <div class="field">
                    <label>Social Media or Website Links</label>
                    <textarea name="social_links">{{ old('social_links') }}</textarea>
                </div>
            </div>

            <button type="submit" class="button">
                Continue to Templates
            </button>

        </form>
    </div>
</div>
</body>
</html>
