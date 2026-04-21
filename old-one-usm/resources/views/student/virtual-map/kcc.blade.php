@extends('student.layouts.master')
@section('title', 'USM Virtual Tour')

@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/leaflet/leaflet.css') }}" />
    <style>
        html,
        body,
        #viewer {
            width: 100%;
            height: 100vh;
            margin: 0;
            padding: 0;
            font-family: "Poppins", sans-serif;
            overflow: hidden;
            background: #fff;
        }

        /* Hide Leaflet attribution */
        .leaflet-control-attribution {
            display: none !important;
        }

        /* Pulsing game marker */
        .game-marker {
            width: 16px;
            height: 16px;
            background: #00a34d;
            border-radius: 50%;
            border: 3px solid #004d26;
            box-shadow: 0 0 8px #00c060;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.3);
                opacity: .6;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Label style for light map */
        .game-label {
            background: rgba(0, 150, 80, 0.8);
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            color: #fff;
            border: 1px solid #006030;
            text-shadow: 0 0 2px #000;
            animation: fadeIn .8s ease-in-out;
            white-space: nowrap;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-4px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Compass overlay */
        #compassUI {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 80px;
            height: 80px;
            background: url('{{ asset('backend/assets/images/compass.png') }}') no-repeat center/contain;
            z-index: 5000;
            pointer-events: none;
        }

        /* Objective box */
        #objectiveBox {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 255, 160, 0.15);
            color: #006030;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 8px;
            border: 1px solid #00a36b;
            text-align: center;
            backdrop-filter: blur(4px);
            box-shadow: 0 0 10px #00c060;
        }

        /* Virtual tour overlay */
        #tourOverlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.95);
            display: none;
            z-index: 9999;
        }

        /* Frame effect around map when overlay opens */
        #tourOverlay.frame-effect {
            box-shadow: inset 0 0 0 8px #004d26;
            transition: box-shadow 0.5s;
        }

        #tourOverlay iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Floating USM Logo */
        #closeLogo {
            position: absolute;
            bottom: 10px;
            left: 10px;
            z-index: 10000;
            width: 250px;
            height: 250px;
            border-radius: 50%;
            cursor: pointer;
            transition: 0.2s;
        }

        #closeLogo.click-animate {
            animation: logoClose 0.4s forwards;
        }

        @keyframes logoClose {
            0% {
                transform: scale(1) rotate(0deg);
                opacity: 1;
            }

            50% {
                transform: scale(1.2) rotate(20deg);
                opacity: 0.8;
            }

            100% {
                transform: scale(0) rotate(360deg);
                opacity: 0;
            }
        }

        #closeLogo.enter-animate {
            animation: logoEnter 0.5s ease-out forwards;
        }

        @keyframes logoEnter {
            0% {
                transform: scale(0) rotate(-360deg);
                opacity: 0;
            }

            50% {
                transform: scale(1.2) rotate(15deg);
                opacity: 0.8;
            }

            100% {
                transform: scale(1) rotate(0deg);
                opacity: 1;
            }
        }

        #closeLogo:hover {
            transform: scale(1.05);
        }

        /* Splash screen inside overlay */
        #overlaySplash {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #0b2e13;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 10001;
            opacity: 1;
            transition: opacity 0.8s;
            text-align: center;
        }

        #overlaySplash .usm-title {
            font-size: 28px;
            font-weight: 700;
            color: #ffcc00;
            text-shadow: 0 0 12px #ffcc00;
            margin-bottom: 15px;
            letter-spacing: 1px;
        }

        #overlaySplash .usm-loader {
            border: 6px solid rgba(255, 255, 255, 0.3);
            border-top: 6px solid #ffcc00;
            border-radius: 50%;
            width: 55px;
            height: 55px;
            animation: spin 1.1s linear infinite;
            margin-bottom: 15px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #overlaySplash .usm-loading-text {
            font-size: 14px;
            color: #ffffffaa;
            letter-spacing: 1px;
        }

        /* ======================= USM THEME TOP BAR ======================= */
        .usm-topbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 55px;
            background: rgba(5, 20, 10, 0.95);
            /* darker, more opaque */
            color: #ffcc00;
            font-family: Arial, sans-serif;
            font-size: 20px;
            font-weight: bold;
            display: flex;
            align-items: center;
            padding-left: 20px;
            z-index: 10002;
            text-shadow: 0 0 6px #ffcc00;
            letter-spacing: 1px;
            border-bottom: 2px solid #ffcc00;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.5s ease-in-out;
        }


        .usm-logo {
            width: 38px;
            height: 38px;
            margin-right: 12px;
            background: url('{{ asset('backend/assets/images/usm.png') }}') no-repeat center;
            background-size: contain;
            cursor: pointer;
        }
    </style>
@endpush

@section('contents')
    <div id="viewer"></div>

    <!-- Compass + Objective HUD -->
    <div id="compassUI"></div>
    <div id="objectiveBox">Objective: Click a location to explore</div>

    <!-- Virtual Tour Overlay -->
    <div id="tourOverlay">
        <!-- USM Top Bar -->
        <div class="usm-topbar" id="topbar">
            <div class="usm-logo"></div>
            <span id="topbarText"></span>
        </div>

        <!-- Splash screen -->
        <div id="overlaySplash">
            <div class="usm-title">UNIVERSITY OF SOUTHERN MINDANAO</div>
            <div class="usm-loader"></div>
            <div class="usm-loading-text">Loading, please wait...</div>
        </div>

        <img id="closeLogo" src="{{ asset('backend/assets/images/usm.gif') }}" title="Return to Map">
        <iframe id="tourFrame" src=""></iframe>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('backend/assets/leaflet/leaflet.js') }}"></script>
    <script>
        var homeLocation = [7.0306384, 125.1131932];

// Get markers from Laravel
var markers = @json($markers);

var map = L.map('viewer', {
    zoomControl: false,
    minZoom: 17,
    maxZoom: 22,
    maxBounds: [
        [7.0290, 125.1120], // southwest corner (a little more left)
        [7.0330, 125.1170]  // northeast corner (a little more right)
    ]
}).setView(homeLocation, 18);





        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 22,
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Create animated game markers
        function gameMarker(label) {
            return L.divIcon({
                className: "",
                html: `<div style="display:flex;align-items:center;gap:15px;">
                        <div class="game-marker"></div>
                        <span class="game-label">${label}</span>
                    </div>`,
                iconSize: null,
            });
        }

        // Add markers dynamically from database
        markers.forEach(m => {
            L.marker([m.latitude, m.longitude], {
                    icon: gameMarker(m.label)
                }).addTo(map)
                .on("mouseover", function(e) {
                    e.target._icon.querySelector('.game-label').style.background = "rgba(0,180,100,0.9)";
                })
                .on("mouseout", function(e) {
                    e.target._icon.querySelector('.game-label').style.background = "rgba(0,150,80,0.8)";
                })
                .on("click", () => openTour(m.url, m.text));
        });

        function openTour(url, text) {
            const overlay = document.getElementById('tourOverlay');
            const splash = document.getElementById('overlaySplash');
            const iframe = document.getElementById('tourFrame');
            const topbar = document.getElementById('topbar');
            const topbarText = document.getElementById('topbarText');

            overlay.style.display = 'block';
            overlay.classList.add('frame-effect');

            topbar.style.opacity = 0;
            topbar.style.pointerEvents = "none";
            topbarText.textContent = "";

            splash.style.display = 'flex';
            splash.style.opacity = 1;
            iframe.style.display = 'none';
            iframe.src = url;

            setTimeout(() => {
                splash.style.opacity = 0;
                setTimeout(() => {
                    splash.style.display = 'none';
                    iframe.style.display = 'block';

                    topbarText.textContent = text;
                    topbar.style.pointerEvents = "auto";
                    topbar.style.opacity = 1;
                }, 800);
            }, 2000);
        }

        document.getElementById('closeLogo').addEventListener('click', function() {
            const logo = this;
            logo.classList.add('click-animate');

            logo.addEventListener('animationend', function() {
                const overlay = document.getElementById('tourOverlay');
                overlay.style.display = 'none';
                overlay.classList.remove('frame-effect');

                document.getElementById('tourFrame').src = "";

                logo.classList.remove('click-animate');
                logo.classList.add('enter-animate');
                logo.addEventListener('animationend', function() {
                    logo.classList.remove('enter-animate');
                }, {
                    once: true
                });
            }, {
                once: true
            });
        });
    </script>
@endpush
