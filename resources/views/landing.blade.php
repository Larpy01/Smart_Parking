<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Parking</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --primary: #f97316;
            --primary-light: #fff7ed;
            --blue: #2563eb;
            --text-main: #111827;
            --text-muted: #6b7280;
            --bg-gray: #f9fafb;
            --border: #f3f4f6;
        }

        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: white;
            color: var(--text-main);
            margin: 0;
            line-height: 1.5;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 80px 20px;
            text-align: center;
        }

        /* Hero Section */
        .badge {
            display: inline-flex;
            align-items: center;
            background-color: var(--primary-light);
            color: #c2410c;
            padding: 6px 16px;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 0.875rem;
            margin-bottom: 24px;
        }

        h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin: 0 0 20px 0;
            letter-spacing: -0.025em;
            line-height: 1.1;
        }

        .highlight { color: var(--primary); }

        .description {
            color: var(--text-muted);
            font-size: 1.125rem;
            max-width: 500px;
            margin: 0 auto 40px auto;
        }

        hr {
            border: 0;
            border-top: 1px solid var(--border);
            margin: 40px 0;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .stat-val {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--blue);
            margin: 0;
        }

        .stat-label {
            font-size: 0.75rem;
            color: var(--text-main);
            margin-top: 4px;
        }

        /* Features Grid */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            text-align: left;
        }

        .card {
            background: white;
            border: 1px solid #e5e7eb;
            padding: 24px;
            border-radius: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }

        .card:hover {
            border-color: var(--blue);
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }

        .card-title {
            font-weight: 600;
            font-size: 0.875rem;
            margin: 0 0 8px 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-text {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin: 0;
        }

        @media (max-width: 640px) {
            h1 { font-size: 2.5rem; }
            .stats-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <div class="container">
        <section>
            <div class="badge">🚗 Smart Parking System</div>
            <h1>Park smarter, <span class="highlight">not harder</span>.</h1>
            <p class="description">
                Find, reserve, and manage parking slots in real time. 
                No more guessing, circling, or wasting fuel.
            </p>
        </section>

        <hr>

        <section class="stats-grid">
            <div>
                <p class="stat-val">24/7</p>
                <p class="stat-label">Real-time availability</p>
            </div>
            <div>
                <p class="stat-val">100%</p>
                <p class="stat-label">Digital parking system</p>
            </div>
            <div>
                <p class="stat-val">Fast</p>
                <p class="stat-label">Reserve in a minute</p>
            </div>
        </section>

        <hr>

        <section class="features-grid">
            <div class="card">
                <p class="card-title">📡 Real-time slots</p>
                <p class="card-text">Instantly see which parking slots are available or occupied.</p>
            </div>

            <div class="card">
                <p class="card-title">🅿️ Easy reservations</p>
                <p class="card-text">Book your slot ahead of time and arrive stress-free.</p>
            </div>

            <div class="card">
                <p class="card-title">
                    <i class="fa-solid fa-bolt-lightning" style="color: #fbbf24;"></i>
                    Lightning-fast entry
                </p>
                <p class="card-text">Skip long queues with automated gate systems and QR code entry.</p>
            </div>
        </section>
    </div>

</body>
</html>