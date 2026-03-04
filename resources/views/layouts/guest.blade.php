<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mr. and Ms IT 2026') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* =========================
           STAR LAYERS (PARALLAX)
        ========================== */

        .stars-layer-1,
        .stars-layer-2,
        .stars-layer-3 {
            position: absolute;
            inset: 0;
            background-repeat: repeat;
            pointer-events: none;
        }

        /* Large / Far stars (slowest) */
        .stars-layer-1 {
            background-image:
                radial-gradient(2.5px 2.5px at 20% 30%, #ffffff, transparent),
                radial-gradient(2px 2px at 70% 60%, #ffffff, transparent),
                radial-gradient(2.5px 2.5px at 40% 80%, #ffffff, transparent),
                radial-gradient(2px 2px at 15% 55%, #ffffff, transparent),
                radial-gradient(2px 2px at 85% 25%, #ffffff, transparent),
                radial-gradient(2px 2px at 45% 15%, #ffffff, transparent),
                radial-gradient(2px 2px at 60% 85%, #ffffff, transparent),
                radial-gradient(2px 2px at 5% 95%, #ffffff, transparent);
            background-size: 900px 900px;
            animation: moveStarsSlow 10s linear infinite;
            opacity: 0.95;
        }

        /* Medium stars */
        .stars-layer-2 {
            background-image:
                radial-gradient(1.5px 1.5px at 20% 30%, #ffffff, transparent),
                radial-gradient(1px 1px at 70% 60%, #ffffff, transparent),
                radial-gradient(1.5px 1.5px at 40% 80%, #ffffff, transparent),
                radial-gradient(1.5px 1.5px at 15% 55%, #ffffff, transparent),
                radial-gradient(1.5px 1.5px at 85% 25%, #ffffff, transparent),
                radial-gradient(1.5px 1.5px at 45% 15%, #ffffff, transparent),
                radial-gradient(1.5px 1.5px at 60% 85%, #ffffff, transparent),
                radial-gradient(1.5px 1.5px at 5% 95%, #ffffff, transparent);
            background-size: 700px 700px;
            animation: moveStarsMedium 90s linear infinite;
            opacity: 0.75;
        }

        /* Small / Near stars (fastest) */
        .stars-layer-3 {
            background-image:
                radial-gradient(2.5px 2.5px at 20% 30%, #ffffff, transparent),
                radial-gradient(2px 2px at 70% 60%, #ffffff, transparent),
                radial-gradient(2.5px 2.5px at 40% 80%, #ffffff, transparent),
                radial-gradient(2px 2px at 15% 55%, #ffffff, transparent),
                radial-gradient(2px 2px at 85% 25%, #ffffff, transparent),
                radial-gradient(2px 2px at 45% 15%, #ffffff, transparent),
                radial-gradient(2px 2px at 60% 85%, #ffffff, transparent),
                radial-gradient(2.5px 2.5px at 20% 30%, #ffffff, transparent),
                radial-gradient(2px 2px at 70% 60%, #ffffff, transparent),
                radial-gradient(2.5px 2.5px at 40% 80%, #ffffff, transparent),
                radial-gradient(2px 2px at 15% 55%, #ffffff, transparent),
                radial-gradient(2px 2px at 85% 25%, #ffffff, transparent),
                radial-gradient(2px 2px at 45% 15%, #ffffff, transparent),
                radial-gradient(2px 2px at 60% 85%, #ffffff, transparent),
                radial-gradient(2px 2px at 5% 95%, #ffffff, transparent);
            background-size: 500px 500px;
            animation: moveStarsFast 30s linear infinite;
            opacity: 0.6;
        }

        /* Parallax animations */
        @keyframes moveStarsSlow {
            from { transform: translateY(0); }
            to   { transform: translateY(-700px); }
        }

        @keyframes moveStarsMedium {
            from { transform: translateY(0); }
            to   { transform: translateY(-500px); }
        }

        @keyframes moveStarsFast {
            from { transform: translateY(0); }
            to   { transform: translateY(-300px); }
        }

        /* =========================
           TWINKLE EFFECT
        ========================== */

        .twinkle {
            animation: twinkle 4s ease-in-out infinite alternate;
        }

        @keyframes twinkle {
            from { opacity: 0.7; }
            to   { opacity: 1; }
        }

        /* =========================
           LOGO SHIMMER GLOW
        ========================== */

        .logo-glow {
            animation: shimmerGlow 3s ease-in-out infinite alternate;
        }

        @keyframes shimmerGlow {
            from {
                filter:
                    drop-shadow(0 0 6px rgba(255,255,255,0.3))
                    drop-shadow(0 0 18px rgba(255,0,0,0.5));
            }
            to {
                filter:
                    drop-shadow(0 0 12px rgba(255,255,255,0.7))
                    drop-shadow(0 0 30px rgba(255,0,0,0.9));
            }
        }
    </style>
</head>

<body class="font-sans antialiased text-white">

    <!-- Dark Crimson Cinematic Background -->
    <div class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-red-950 via-red-900 to-black">

        <!-- Multi-layer Parallax Stars -->
        <div class="stars-layer-1 twinkle"></div>
        <div class="stars-layer-2"></div>
        <div class="stars-layer-3"></div>

        <!-- Subtle Center Glow -->
        <div class="absolute w-[900px] h-[900px] bg-red-500/10 blur-3xl rounded-full"></div>

        <!-- Content Wrapper -->
        <div class="relative w-full max-w-md px-6">

            <!-- Logo -->
            <div class="text-center mb-8">
                <a href="/">
                    <img src="/images/BSIT.png"
                         alt="BSIT Logo"
                         class="w-40 mx-auto mb-4 logo-glow">
                </a>

                <h1 class="text-2xl font-bold tracking-wide text-white">
                    MR. and MS. IT 2026
                </h1>

                <p class="text-sm text-red-200 mt-1">
                    Official Judge Access Portal
                </p>
            </div>

            <!-- Glass Login Card -->
            <div class="bg-white/10 backdrop-blur-xl border border-white/20 shadow-2xl rounded-2xl px-6 py-6">
                {{ $slot }}
            </div>

            <!-- Footer -->
            <div class="text-center mt-6 text-xs text-red-200/70">
                © {{ date('Y') }} BSIT Department, Madridejos Community College.
            </div>

        </div>
    </div>

</body>
</html>