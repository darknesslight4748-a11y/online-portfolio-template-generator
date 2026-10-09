<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $portfolio->full_name }} - Portfolio</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 30px;
        }

        .portfolio {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        h1 {
            margin-bottom: 5px;
        }

        h2 {
            margin-top: 30px;
        }

        .section {
            margin-top: 15px;
        }
    </style>
</head>

<body>

<div class="portfolio">

    @if($portfolio->profile_picture)
    <img
        src="{{ asset('storage/' . $portfolio->profile_picture) }}"
        alt="Profile Picture"
        width="150"
        height="150"
        style="object-fit: cover; border-radius: 50%;"
    >
    @endif
    
    <h1>{{ $portfolio->full_name }}</h1>

    <p>{{ $portfolio->email }}</p>

    <p>{{ $portfolio->contact_number }}</p>

    <p>{{ $portfolio->address }}</p>

    <div class="section">
        <h2>About Me</h2>
        <p>{{ $portfolio->about_me }}</p>
    </div>

    <div class="section">
        <h2>Educational Background</h2>
        <p>{{ $portfolio->education }}</p>
    </div>

    <div class="section">
        <h2>Skills</h2>
        <p>{{ $portfolio->skills }}</p>
    </div>

    <div class="section">
        <h2>Projects</h2>
        <p>{{ $portfolio->projects }}</p>
    </div>

    <div class="section">
        <h2>Work Experience</h2>
        <p>{{ $portfolio->work_experience }}</p>
    </div>

    <div class="section">
        <h2>Social Media / Website</h2>
        <p>{{ $portfolio->social_links }}</p>
    </div>

</div>

</body>
</html>