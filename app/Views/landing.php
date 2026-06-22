<!doctype html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orion Clinic — Platform Telemedisin Terpercaya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('style.css') ?>">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }

        .gradient-hero {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 40%, #e0f2fe 100%);
        }
        .gradient-btn {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            box-shadow: 0 4px 14px -2px rgba(37,99,235,0.35);
        }
        .gradient-btn:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
            box-shadow: 0 6px 20px -2px rgba(37,99,235,0.45);
            transform: translateY(-1px);
        }
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px -8px rgba(37,99,235,0.15);
        }
        .sidebar-link {
            position: relative;
            transition: color 0.2s ease;
        }
        .sidebar-link::after {
            content: "";
            position: absolute;
            left: 1rem;
            right: 1rem;
            bottom: 0.35rem;
            height: 2px;
            background: #2563eb;
            border-radius: 2px;
            transform: scaleX(0);
            transform-origin: center;
            transition: transform 0.25s ease;
        }
        .sidebar-link:hover,
        .sidebar-link.active {
            color: #2563eb;
        }
        .sidebar-link:hover::after,
        .sidebar-link.active::after {
            transform: scaleX(1);
        }
        .sidebar-link:active {
            transform: scale(0.97);
        }
        .hero-float {
            animation: heroFloat 4s ease-in-out infinite;
        }
        @keyframes heroFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
        }
        .pulse-ring {
            animation: pulseRing 2s ease-in-out infinite;
        }
        @keyframes pulseRing {
            0%, 100% { opacity: 0.4; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.08); }
        }
        .section-fade {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .section-fade.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .gradient-text {
            background: linear-gradient(135deg, #2563eb, #0891b2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        html { scroll-behavior: smooth; }

        /* Mobile nav toggle (slide dari kanan, selaras dgn tombol hamburger) */
        #mobile-menu .mobile-panel { transition: transform 0.3s ease; }
        #mobile-menu.hidden .mobile-panel { transform: translateX(100%); }
        #mobile-menu.open .mobile-panel { transform: translateX(0); }
        #mobile-menu { transition: opacity 0.3s ease; }
        #mobile-menu.hidden { opacity: 0; pointer-events: none; }
        #mobile-menu.open { opacity: 1; pointer-events: all; }
    </style>
</head>
<body class="h-full bg-[#f5f1ec] overflow-x-hidden">

<div class="h-full flex flex-col">

    <?= view('components/landing_sidebar') ?>

    <!-- ===== MAIN CONTENT ===== -->
    <main class="flex-grow">

        <!-- ============ HERO SECTION ============ -->
        <section id="hero" class="bg-[#f5f1ec] min-h-screen flex items-center px-6 md:px-12 pt-16 md:pt-0 pb-12">
            <div class="w-full max-w-6xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                    <!-- Text -->
                    <div class="order-2 lg:order-1">
                        <div class="inline-flex items-center bg-[#ebe7e1] text-white-700 px-4 py-1.5 rounded-full text-sm font-semibold mb-6 border-radius-50">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Platform Telemedisin Terpercaya
                        </div>

                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-[#111111] leading-tight mb-6">
                            Kesehatan Anda,
                            <span class="text-[#111111]">Prioritas Kami</span>
                        </h1>

                        <p class="text-lg text-[#626260] leading-relaxed mb-8">
                            Konsultasi dokter kapan saja dan di mana saja. Orion Clinic menghadirkan layanan kesehatan digital yang mudah, cepat, dan terpercaya langsung dari genggaman Anda.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-4 mb-10">
                            <a href="<?= base_url('register') ?>"
                               class="bg-[#1BA098] text-[#ffffff] px-[18px] py-[10px] rounded-[8px] font-medium transition-all hover:bg-[#14857d] inline-flex items-center justify-center px-8 py-4 rounded-[24px] text-white font-bold text-base transition-all">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                </svg>
                                Mulai Sekarang — Gratis
                            </a>
                            <a href="#tentang"
                               class="inline-flex items-center justify-center px-8 py-4 rounded-[24px] border-2 border-blue-200 text-[#111111] font-bold text-base bg-[#ebe7e1] transition-all">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Pelajari Lebih Lanjut
                            </a>
                        </div>

                        <!-- Trust badges -->
                        <div class="flex items-center flex-wrap gap-6">
                            <div class="flex items-center space-x-2 text-sm text-[#626260]">
                                <svg class="w-5 h-5 text-[#4CAF50]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="font-medium">Dokter Bersertifikat</span>
                            </div>
                            <div class="flex items-center space-x-2 text-sm text-[#626260]">
                                <svg class="w-5 h-5 text-[#4CAF50]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="font-medium">Data Aman & Terenkripsi</span>
                            </div>
                            <div class="flex items-center space-x-2 text-sm text-[#626260]">
                                <svg class="w-5 h-5 text-[#4CAF50]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="font-medium">Tersedia 24/7</span>
                            </div>
                        </div>
                    </div>

                    <!-- Illustration -->
                    <div class="order-1 lg:order-2 flex justify-center items-center">
                        <div class="relative w-full max-w-sm lg:max-w-md">
                            <!-- Background circles -->
                            <div class="pulse-ring absolute inset-0 rounded-full border-4 border-blue-200 opacity-40 scale-110"></div>
                            <div class="pulse-ring absolute inset-0 rounded-full border-4 border-teal-200 opacity-30 scale-125" style="animation-delay: 1s;"></div>

                            <!-- Main illustration card -->
                            <div class="hero-float relative bg-[#ffffff] rounded-[24px]  p-6 mx-4">

                                <!-- Doctor illustration SVG -->
                                <svg viewBox="0 0 400 340" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                                    <!-- Background gradient circle -->
                                    <circle cx="200" cy="170" r="150" fill="#eff6ff" opacity="0.6"/>

                                    <!-- Desk / Monitor base -->
                                    <rect x="100" y="240" width="200" height="12" rx="6" fill="#e2e8f0"/>
                                    <rect x="185" y="252" width="30" height="20" fill="#cbd5e1"/>
                                    <rect x="155" y="268" width="90" height="8" rx="4" fill="#e2e8f0"/>

                                    <!-- Monitor screen -->
                                    <rect x="110" y="150" width="180" height="95" rx="12" fill="#1e293b"/>
                                    <rect x="116" y="156" width="168" height="83" rx="9" fill="#0f172a"/>

                                    <!-- Screen content - Video call UI -->
                                    <rect x="116" y="156" width="168" height="83" rx="9" fill="#1d4ed8" opacity="0.15"/>

                                    <!-- Patient face on screen (circle) -->
                                    <circle cx="175" cy="192" r="22" fill="#dbeafe"/>
                                    <circle cx="175" cy="183" r="10" fill="#93c5fd"/>
                                    <path d="M155 205 Q175 220 195 205" stroke="#93c5fd" stroke-width="2" fill="#bfdbfe" opacity="0.8"/>

                                    <!-- Screen UI elements -->
                                    <rect x="202" y="176" width="70" height="8" rx="4" fill="#60a5fa" opacity="0.7"/>
                                    <rect x="202" y="190" width="50" height="6" rx="3" fill="#93c5fd" opacity="0.5"/>
                                    <rect x="202" y="202" width="60" height="6" rx="3" fill="#93c5fd" opacity="0.5"/>
                                    <circle cx="209" cy="225" r="7" fill="#22c55e" opacity="0.8"/>
                                    <circle cx="225" cy="225" r="7" fill="#ef4444" opacity="0.8"/>
                                    <circle cx="241" cy="225" r="7" fill="#3b82f6" opacity="0.8"/>

                                    <!-- Doctor body -->
                                    <!-- Lab coat -->
                                    <ellipse cx="200" cy="135" rx="28" ry="32" fill="#f1f5f9"/>
                                    <!-- Shirt collar -->
                                    <path d="M188 115 L200 125 L212 115 L208 105 L200 108 L192 105Z" fill="#e2e8f0"/>
                                    <!-- Stethoscope -->
                                    <path d="M185 120 Q175 135 177 148 Q179 155 186 155 Q193 155 193 148" stroke="#1d4ed8" stroke-width="3" fill="none" stroke-linecap="round"/>
                                    <circle cx="193" cy="148" r="5" fill="#1d4ed8"/>
                                    <!-- Doctor head -->
                                    <circle cx="200" cy="98" r="26" fill="#fde68a"/>
                                    <!-- Hair -->
                                    <path d="M176 92 Q180 70 200 68 Q220 70 224 92" fill="#1e293b"/>
                                    <!-- Eyes -->
                                    <circle cx="192" cy="96" r="3" fill="#1e293b"/>
                                    <circle cx="208" cy="96" r="3" fill="#1e293b"/>
                                    <!-- Smile -->
                                    <path d="M193 106 Q200 112 207 106" stroke="#92400e" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                                    <!-- Glasses -->
                                    <rect x="187" y="93" width="10" height="7" rx="3.5" stroke="#475569" stroke-width="1.5" fill="none"/>
                                    <rect x="203" y="93" width="10" height="7" rx="3.5" stroke="#475569" stroke-width="1.5" fill="none"/>
                                    <line x1="197" y1="96" x2="203" y2="96" stroke="#475569" stroke-width="1.5"/>

                                    <!-- Floating cards -->
                                    <!-- Heartrate card -->
                                    <rect x="40" y="100" width="90" height="50" rx="12" fill="white" filter="url(#shadow1)"/>
                                    <defs>
                                        <filter id="shadow1" x="-20%" y="-20%" width="140%" height="140%">
                                            <feDropShadow dx="0" dy="4" stdDeviation="6" flood-color="#2563eb" flood-opacity="0.12"/>
                                        </filter>
                                        <filter id="shadow2" x="-20%" y="-20%" width="140%" height="140%">
                                            <feDropShadow dx="0" dy="4" stdDeviation="6" flood-color="#0891b2" flood-opacity="0.12"/>
                                        </filter>
                                    </defs>
                                    <circle cx="55" cy="119" r="10" fill="#fee2e2"/>
                                    <path d="M50 119 L53 113 L56 124 L59 116 L62 119 L65 119" stroke="#ef4444" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                    <text x="70" y="116" font-size="9" fill="#64748b" font-family="Plus Jakarta Sans">Detak</text>
                                    <text x="70" y="128" font-size="11" font-weight="700" fill="#1e293b" font-family="Plus Jakarta Sans">78 BPM</text>

                                    <!-- Prescription card -->
                                    <rect x="270" y="90" width="92" height="55" rx="12" fill="white" filter="url(#shadow2)"/>
                                    <circle cx="285" cy="112" r="10" fill="#e0f2fe"/>
                                    <path d="M280 112 L285 107 L285 117 M280 110 L290 110" stroke="#0891b2" stroke-width="1.5" stroke-linecap="round"/>
                                    <text x="300" y="108" font-size="9" fill="#64748b" font-family="Plus Jakarta Sans">Resep</text>
                                    <text x="300" y="120" font-size="9" font-weight="700" fill="#1e293b" font-family="Plus Jakarta Sans">Paracetamol</text>
                                    <text x="300" y="131" font-size="8" fill="#94a3b8" font-family="Plus Jakarta Sans">500mg • 3x/hari</text>

                                    <!-- Online badge -->
                                    <rect x="270" y="200" width="82" height="32" rx="10" fill="white" filter="url(#shadow1)"/>
                                    <circle cx="284" cy="216" r="6" fill="#22c55e"/>
                                    <circle cx="284" cy="216" r="3" fill="white"/>
                                    <text x="295" y="213" font-size="8.5" fill="#64748b" font-family="Plus Jakarta Sans">Status</text>
                                    <text x="295" y="224" font-size="9" font-weight="700" fill="#16a34a" font-family="Plus Jakarta Sans">Online ✓</text>
                                </svg>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ ABOUT SECTION ============ -->
        <section id="tentang" class="py-20 px-6 md:px-12 bg-[#ffffff]">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                    <!-- Illustration kiri -->
                    <div class="section-fade">
                        <div class="relative">
                            <div class="absolute -top-4 -left-4 w-24 h-24 bg-[#ebe7e1] rounded-full opacity-60"></div>
                            <div class="absolute -bottom-4 -right-4 w-32 h-32 bg-[#ebe7e1] rounded-full opacity-50"></div>
                            <div class="relative    rounded-[24px] p-12  flex items-center justify-center">
                                <img src="<?= base_url('assets/img/logoorion.png') ?>"
                                     alt="Orion Clinic"
                                     class="w-full max-w-sm object-contain drop-shadow-xlshadow-xl hero-float">
                            </div>
                        </div>
                    </div>

                    <!-- Text kanan -->
                    <div class="section-fade">
                        <div class="inline-flex items-center bg-[#ebe7e1] text-[#111111] px-4 py-1.5 rounded-full text-sm font-semibold mb-4">
                            Tentang Kami
                        </div>
                        <h2 class="text-3xl md:text-4xl font-extrabold text-[#111111] mb-6 leading-tight">
                            Mengapa Memilih
                            <span class="text-[#111111]">Orion Clinic?</span>
                        </h2>
                        <p class="text-[#626260] text-lg leading-relaxed mb-6">
                            Orion Clinic adalah platform telemedisin inovatif yang menghubungkan pasien dengan dokter berpengalaman secara digital. Kami percaya bahwa layanan kesehatan berkualitas harus mudah dijangkau oleh semua orang.
                        </p>
                        <p class="text-[#626260] leading-relaxed mb-8">
                            Dengan teknologi terkini, kami memastikan setiap interaksi antara dokter dan pasien berlangsung secara aman, nyaman, dan efisien. Dari konsultasi hingga penerbitan resep digital, semua tersedia dalam satu platform terintegrasi.
                        </p>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-[#ebe7e1] rounded-[24px] p-4">
                                <div class="w-10 h-10 bg-[#ebe7e1] rounded-[16px] flex items-center justify-center mb-3">
                                    <svg class="w-5 h-5 text-[#111111]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-[#111111] text-sm mb-1">Terpercaya</h4>
                                <p class="text-xs text-[#626260]">Dokter bersertifikat & terverifikasi</p>
                            </div>
                            <div class="bg-teal-50 rounded-[24px] p-4">
                                <div class="w-10 h-10 bg-[#ebe7e1] rounded-[16px] flex items-center justify-center mb-3">
                                    <svg class="w-5 h-5 text-[#111111]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-[#111111] text-sm mb-1">Cepat & Mudah</h4>
                                <p class="text-xs text-[#626260]">Konsultasi dalam hitungan menit</p>
                            </div>
                            <div class="bg-purple-50 rounded-[24px] p-4">
                                <div class="w-10 h-10 bg-[#ebe7e1] rounded-[16px] flex items-center justify-center mb-3">
                                    <svg class="w-5 h-5 text-[#111111]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-[#111111] text-sm mb-1">Data Aman</h4>
                                <p class="text-xs text-[#626260]">Privasi & keamanan terjamin</p>
                            </div>
                            <div class="bg-green-50 rounded-[24px] p-4">
                                <div class="w-10 h-10 bg-[#ebe7e1] rounded-[16px] flex items-center justify-center mb-3">
                                    <svg class="w-5 h-5 text-[#111111]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-[#111111] text-sm mb-1">24/7 Aktif</h4>
                                <p class="text-xs text-[#626260]">Layanan sepanjang waktu</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ LAYANAN SECTION ============ -->
        <section id="layanan" class="py-20 px-6 md:px-12" style="background: linear-gradient(180deg, #f8faff 0%, #eff6ff 100%);">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-14 section-fade">
                    <div class="inline-flex items-center bg-[#ebe7e1] text-[#111111] px-4 py-1.5 rounded-full text-sm font-semibold mb-4">
                        Layanan Kami
                    </div>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-[#111111] mb-4">
                        Semua Kebutuhan Kesehatan
                        <br><span class="text-[#111111]">dalam Satu Platform</span>
                    </h2>
                    <p class="text-[#626260] text-lg max-w-2xl mx-auto">
                        Kami menyediakan berbagai layanan kesehatan digital yang komprehensif untuk mendukung kesehatan Anda sehari-hari.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                    <!-- Konsultasi Dokter -->
                    <div class="card-hover bg-[#ffffff] rounded-[24px] p-7  border border-blue-50 section-fade">
                        <div class="w-14 h-14 bg-[#ebe7e1] rounded-[24px] flex items-center justify-center mb-5">
                            <?= icon('appointments', 32, 'w-7 h-7 text-[#111111]') ?>
                        </div>
                        <h3 class="text-xl font-bold text-[#111111] mb-3">Konsultasi Dokter</h3>
                        <p class="text-[#626260] leading-relaxed text-sm mb-4">
                            Chat langsung dengan dokter berpengalaman kapan saja. Dapatkan jawaban atas keluhan kesehatan Anda dengan cepat dan akurat.
                        </p>
                        <div class="flex items-center text-[#111111] font-semibold text-sm">
                            <span>Mulai konsultasi</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Resep Digital -->
                    <div class="card-hover bg-[#ffffff] rounded-[24px] p-7  border border-[#d3cec6] section-fade">
                        <div class="w-14 h-14 bg-[#ebe7e1] rounded-[24px] flex items-center justify-center mb-5">
                            <?= icon('prescription', 32, 'w-7 h-7 text-[#111111]') ?>
                        </div>
                        <h3 class="text-xl font-bold text-[#111111] mb-3">Resep & Obat Digital</h3>
                        <p class="text-[#626260] leading-relaxed text-sm mb-4">
                            Terima resep dokter secara digital langsung di aplikasi. Pantau penggunaan obat dan jadwal minum obat dengan mudah.
                        </p>
                        <div class="flex items-center text-[#111111] font-semibold text-sm">
                            <span>Lihat resep</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Wellness Tracking -->
                    <div class="card-hover bg-[#ffffff] rounded-[24px] p-7  border border-[#d3cec6] section-fade">
                        <div class="w-14 h-14 bg-[#ebe7e1] rounded-[24px] flex items-center justify-center mb-5">
                            <?= icon('wellness', 32, 'w-7 h-7 text-[#111111]') ?>
                        </div>
                        <h3 class="text-xl font-bold text-[#111111] mb-3">Wellness Tracking</h3>
                        <p class="text-[#626260] leading-relaxed text-sm mb-4">
                            Pantau kondisi kesehatan Anda setiap hari. Catat aktivitas, pola tidur, dan parameter kesehatan untuk hidup yang lebih sehat.
                        </p>
                        <div class="flex items-center text-[#111111] font-semibold text-sm">
                            <span>Mulai tracking</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Riwayat Kesehatan -->
                    <div class="card-hover bg-[#ffffff] rounded-[24px] p-7  border border-[#d3cec6] section-fade">
                        <div class="w-14 h-14 bg-[#ebe7e1] rounded-[24px] flex items-center justify-center mb-5">
                            <?= icon('medical_records', 32, 'w-7 h-7 text-[#111111]') ?>
                        </div>
                        <h3 class="text-xl font-bold text-[#111111] mb-3">Riwayat Kesehatan</h3>
                        <p class="text-[#626260] leading-relaxed text-sm mb-4">
                            Akses rekam medis digital Anda kapan saja. Semua riwayat konsultasi, diagnosis, dan resep tersimpan aman dan terorganisir.
                        </p>
                        <div class="flex items-center text-[#111111] font-semibold text-sm">
                            <span>Lihat riwayat</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Chat Dokter -->
                    <div class="card-hover bg-[#ffffff] rounded-[24px] p-7  border border-[#d3cec6] section-fade">
                        <div class="w-14 h-14 bg-[#ebe7e1] rounded-[24px] flex items-center justify-center mb-5">
                            <?= icon('chat', 32, 'w-7 h-7 text-[#111111]') ?>
                        </div>
                        <h3 class="text-xl font-bold text-[#111111] mb-3">Live Chat Dokter</h3>
                        <p class="text-[#626260] leading-relaxed text-sm mb-4">
                            Komunikasi real-time dengan dokter Anda melalui fitur chat terintegrasi. Tanya jawab langsung tanpa perlu menunggu antrian.
                        </p>
                        <div class="flex items-center text-[#111111] font-semibold text-sm">
                            <span>Chat sekarang</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Profil Kesehatan -->
                    <div class="card-hover bg-[#ffffff] rounded-[24px] p-7  border border-[#d3cec6] section-fade">
                        <div class="w-14 h-14 bg-[#ebe7e1] rounded-[24px] flex items-center justify-center mb-5">
                            <?= icon('profile', 32, 'w-7 h-7 text-[#111111]') ?>
                        </div>
                        <h3 class="text-xl font-bold text-[#111111] mb-3">Profil Kesehatan</h3>
                        <p class="text-[#626260] leading-relaxed text-sm mb-4">
                            Kelola profil kesehatan personal Anda. Simpan informasi medis penting untuk memudahkan dokter memberikan penanganan terbaik.
                        </p>
                        <div class="flex items-center text-[#111111] font-semibold text-sm">
                            <span>Kelola profil</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- ============ CARA KERJA SECTION ============ -->
        <section id="cara-kerja" class="py-20 px-6 md:px-12 bg-[#ffffff]">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-14 section-fade">
                    <div class="inline-flex items-center bg-[#ebe7e1] text-[#111111] px-4 py-1.5 rounded-full text-sm font-semibold mb-4">
                        Cara Kerja
                    </div>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-[#111111] mb-4">
                        Mudah dalam
                        <span class="text-[#111111]">3 Langkah Sederhana</span>
                    </h2>
                    <p class="text-[#626260] text-lg max-w-xl mx-auto">
                        Mulai perjalanan kesehatan digital Anda bersama Orion Clinic dengan cara yang sangat mudah.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">

                    <!-- Connector line (desktop) -->
                    <div class="hidden md:block absolute top-14 left-1/4 right-1/4 h-0.5    " style="top: 56px; left: 22%; right: 22%;"></div>

                    <!-- Step 1 -->
                    <div class="text-center section-fade">
                        <div class="relative inline-flex mb-6">
                            <div class="w-28 h-28 bg-[#ebe7e1] rounded-[24px] flex items-center justify-center mx-auto">
                                <svg viewBox="0 0 80 80" class="w-20 h-20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="40" cy="40" r="35" fill="#dbeafe"/>
                                    <circle cx="40" cy="30" r="12" fill="#93c5fd"/>
                                    <path d="M20 62 Q40 48 60 62" fill="#60a5fa"/>
                                    <rect x="30" y="50" width="20" height="14" rx="4" fill="#3b82f6"/>
                                    <rect x="50" y="42" width="18" height="22" rx="4" fill="#1d4ed8"/>
                                    <circle cx="59" cy="38" r="8" fill="#22c55e"/>
                                    <path d="M55 38 L58 41 L63 35" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="absolute -top-2 -right-2 w-8 h-8 bg-[#003E7E] text-[#ffffff] rounded-full flex items-center justify-center text-sm font-bold ">1</div>
                        </div>
                        <h3 class="text-xl font-bold text-[#111111] mb-3">Daftar Akun</h3>
                        <p class="text-[#626260] text-sm leading-relaxed">
                            Buat akun Orion Clinic secara gratis dalam hitungan menit. Isi data diri dan profil kesehatan dasar Anda.
                        </p>
                    </div>

                    <!-- Step 2 -->
                    <div class="text-center section-fade">
                        <div class="relative inline-flex mb-6">
                            <div class="w-28 h-28 bg-[#ebe7e1] rounded-[24px] flex items-center justify-center mx-auto">
                                <svg viewBox="0 0 80 80" class="w-20 h-20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="40" cy="40" r="35" fill="#ccfbf1"/>
                                    <!-- Phone -->
                                    <rect x="26" y="18" width="28" height="46" rx="6" fill="#0d9488"/>
                                    <rect x="29" y="22" width="22" height="36" rx="4" fill="#99f6e4"/>
                                    <circle cx="40" cy="61" r="2.5" fill="#99f6e4"/>
                                    <!-- Screen content - chat bubbles -->
                                    <rect x="31" y="26" width="14" height="7" rx="3.5" fill="#0d9488"/>
                                    <rect x="35" y="36" width="13" height="7" rx="3.5" fill="#0d9488"/>
                                    <rect x="31" y="46" width="14" height="7" rx="3.5" fill="#0d9488"/>
                                    <!-- Doctor icon -->
                                    <circle cx="60" cy="28" r="10" fill="#f0fdfa"/>
                                    <circle cx="60" cy="24" r="5" fill="#5eead4"/>
                                    <path d="M52 36 Q60 30 68 36" fill="#99f6e4"/>
                                </svg>
                            </div>
                            <div class="absolute -top-2 -right-2 w-8 h-8 bg-teal-600 text-white rounded-full flex items-center justify-center text-sm font-bold ">2</div>
                        </div>
                        <h3 class="text-xl font-bold text-[#111111] mb-3">Pilih & Chat Dokter</h3>
                        <p class="text-[#626260] text-sm leading-relaxed">
                            Ceritakan keluhan Anda kepada dokter pilihan. Konsultasi berjalan melalui chat real-time yang mudah dan nyaman.
                        </p>
                    </div>

                    <!-- Step 3 -->
                    <div class="text-center section-fade">
                        <div class="relative inline-flex mb-6">
                            <div class="w-28 h-28 bg-[#ebe7e1] rounded-[24px] flex items-center justify-center mx-auto">
                                <svg viewBox="0 0 80 80" class="w-20 h-20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="40" cy="40" r="35" fill="#dcfce7"/>
                                    <!-- Document -->
                                    <rect x="22" y="15" width="36" height="50" rx="6" fill="#86efac"/>
                                    <rect x="22" y="15" width="36" height="50" rx="6" fill="none" stroke="#4ade80" stroke-width="1.5"/>
                                    <!-- Lines on document -->
                                    <rect x="28" y="26" width="24" height="3" rx="1.5" fill="white"/>
                                    <rect x="28" y="33" width="18" height="3" rx="1.5" fill="white"/>
                                    <rect x="28" y="40" width="20" height="3" rx="1.5" fill="white"/>
                                    <rect x="28" y="47" width="14" height="3" rx="1.5" fill="white"/>
                                    <!-- Checkmark badge -->
                                    <circle cx="56" cy="22" r="12" fill="#16a34a"/>
                                    <path d="M50 22 L54 26 L62 18" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <!-- Pill icons -->
                                    <ellipse cx="35" cy="58" rx="8" ry="5" fill="#4ade80" transform="rotate(-30 35 58)"/>
                                    <line x1="33" y1="54" x2="37" y2="62" stroke="white" stroke-width="1.5"/>
                                </svg>
                            </div>
                            <div class="absolute -top-2 -right-2 w-8 h-8 bg-[#4CAF50] text-white rounded-full flex items-center justify-center text-sm font-bold ">3</div>
                        </div>
                        <h3 class="text-xl font-bold text-[#111111] mb-3">Terima Resep & Pantau</h3>
                        <p class="text-[#626260] text-sm leading-relaxed">
                            Dapatkan resep digital dan panduan kesehatan. Pantau perkembangan kesehatan Anda melalui fitur wellness tracking.
                        </p>
                    </div>

                </div>

                <!-- CTA mini -->
                <div class="mt-14 text-center section-fade">
                    <a href="<?= base_url('register') ?>"
                       class="bg-[#1BA098] text-[#ffffff] px-[18px] py-[10px] rounded-[8px] font-medium transition-all hover:bg-[#14857d] inline-flex items-center px-10 py-4 rounded-[24px] text-white font-bold text-base transition-all">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Coba Sekarang — Gratis
                    </a>
                </div>
            </div>
        </section>

        <!-- ============ STATISTIK SECTION ============ -->
        <section id="statistik" class="py-20 px-6 md:px-12" style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 60%, #0891b2 100%);">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-14 section-fade">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4">
                        Dipercaya Ribuan Pengguna
                    </h2>
                    <p class="text-blue-200 text-lg">
                        Bergabunglah dengan komunitas yang terus berkembang bersama Orion Clinic
                    </p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-16">
                    <div class="text-center section-fade">
                        <div class="text-4xl md:text-5xl font-extrabold text-white mb-2">5K+</div>
                        <div class="text-blue-200 font-medium text-sm">Pasien Aktif</div>
                    </div>
                    <div class="text-center section-fade">
                        <div class="text-4xl md:text-5xl font-extrabold text-white mb-2">200+</div>
                        <div class="text-blue-200 font-medium text-sm">Dokter Terverifikasi</div>
                    </div>
                    <div class="text-center section-fade">
                        <div class="text-4xl md:text-5xl font-extrabold text-white mb-2">98%</div>
                        <div class="text-blue-200 font-medium text-sm">Tingkat Kepuasan</div>
                    </div>
                    <div class="text-center section-fade">
                        <div class="text-4xl md:text-5xl font-extrabold text-white mb-2">24/7</div>
                        <div class="text-blue-200 font-medium text-sm">Layanan Aktif</div>
                    </div>
                </div>

                <!-- Illustration row -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                    <div class="section-fade">
                        <svg viewBox="0 0 440 260" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full max-w-md mx-auto">
                            <!-- Chart background -->
                            <rect x="20" y="20" width="400" height="220" rx="16" fill="rgba(255,255,255,0.08)"/>

                            <!-- Chart title -->
                            <text x="40" y="52" font-size="13" font-weight="600" fill="rgba(255,255,255,0.9)" font-family="Plus Jakarta Sans">Pertumbuhan Pengguna 2025-2026</text>

                            <!-- Grid lines -->
                            <line x1="60" y1="80" x2="400" y2="80" stroke="rgba(255,255,255,0.1)" stroke-width="1"/>
                            <line x1="60" y1="110" x2="400" y2="110" stroke="rgba(255,255,255,0.1)" stroke-width="1"/>
                            <line x1="60" y1="140" x2="400" y2="140" stroke="rgba(255,255,255,0.1)" stroke-width="1"/>
                            <line x1="60" y1="170" x2="400" y2="170" stroke="rgba(255,255,255,0.1)" stroke-width="1"/>
                            <line x1="60" y1="200" x2="400" y2="200" stroke="rgba(255,255,255,0.15)" stroke-width="1"/>

                            <!-- Bar chart -->
                            <rect x="75"  y="175" width="30" height="25" rx="4" fill="rgba(147,197,253,0.5)"/>
                            <rect x="120" y="155" width="30" height="45" rx="4" fill="rgba(147,197,253,0.6)"/>
                            <rect x="165" y="130" width="30" height="70" rx="4" fill="rgba(147,197,253,0.7)"/>
                            <rect x="210" y="115" width="30" height="85" rx="4" fill="rgba(147,197,253,0.8)"/>
                            <rect x="255" y="100" width="30" height="100" rx="4" fill="rgba(147,197,253,0.85)"/>
                            <rect x="300" y="85"  width="30" height="115" rx="4" fill="#93c5fd"/>
                            <rect x="345" y="68"  width="30" height="132" rx="4" fill="white"/>

                            <!-- Value labels -->
                            <text x="90"  y="170" text-anchor="middle" font-size="9" fill="rgba(255,255,255,0.7)" font-family="Plus Jakarta Sans">500</text>
                            <text x="135" y="150" text-anchor="middle" font-size="9" fill="rgba(255,255,255,0.7)" font-family="Plus Jakarta Sans">1K</text>
                            <text x="180" y="125" text-anchor="middle" font-size="9" fill="rgba(255,255,255,0.7)" font-family="Plus Jakarta Sans">1.8K</text>
                            <text x="225" y="110" text-anchor="middle" font-size="9" fill="rgba(255,255,255,0.7)" font-family="Plus Jakarta Sans">2.5K</text>
                            <text x="270" y="95"  text-anchor="middle" font-size="9" fill="rgba(255,255,255,0.7)" font-family="Plus Jakarta Sans">3.2K</text>
                            <text x="315" y="80"  text-anchor="middle" font-size="9" fill="rgba(255,255,255,0.85)" font-family="Plus Jakarta Sans">4K</text>
                            <text x="360" y="63"  text-anchor="middle" font-size="9" fill="white" font-weight="600" font-family="Plus Jakarta Sans">5K+</text>

                            <!-- Month labels -->
                            <text x="90"  y="215" text-anchor="middle" font-size="9" fill="rgba(255,255,255,0.5)" font-family="Plus Jakarta Sans">Okt</text>
                            <text x="135" y="215" text-anchor="middle" font-size="9" fill="rgba(255,255,255,0.5)" font-family="Plus Jakarta Sans">Nov</text>
                            <text x="180" y="215" text-anchor="middle" font-size="9" fill="rgba(255,255,255,0.5)" font-family="Plus Jakarta Sans">Des</text>
                            <text x="225" y="215" text-anchor="middle" font-size="9" fill="rgba(255,255,255,0.5)" font-family="Plus Jakarta Sans">Jan</text>
                            <text x="270" y="215" text-anchor="middle" font-size="9" fill="rgba(255,255,255,0.5)" font-family="Plus Jakarta Sans">Feb</text>
                            <text x="315" y="215" text-anchor="middle" font-size="9" fill="rgba(255,255,255,0.5)" font-family="Plus Jakarta Sans">Mar</text>
                            <text x="360" y="215" text-anchor="middle" font-size="9" fill="rgba(255,255,255,0.8)" font-weight="600" font-family="Plus Jakarta Sans">Mei</text>
                        </svg>
                    </div>

                    <div class="space-y-5 section-fade">
                        <div class="bg-[#ffffff] bg-opacity-10 rounded-[24px] p-5 flex items-center space-x-4">
                            <div class="w-12 h-12 bg-[#ffffff] bg-opacity-20 rounded-[16px] flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-white font-bold text-lg">Rating 4.9/5.0</div>
                                <div class="text-blue-200 text-sm">Berdasarkan ulasan pengguna aktif</div>
                            </div>
                        </div>
                        <div class="bg-[#ffffff] bg-opacity-10 rounded-[24px] p-5 flex items-center space-x-4">
                            <div class="w-12 h-12 bg-[#ffffff] bg-opacity-20 rounded-[16px] flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-white font-bold text-lg">Rata-rata Respon 3 Menit</div>
                                <div class="text-blue-200 text-sm">Dokter kami merespons dengan cepat</div>
                            </div>
                        </div>
                        <div class="bg-[#ffffff] bg-opacity-10 rounded-[24px] p-5 flex items-center space-x-4">
                            <div class="w-12 h-12 bg-[#ffffff] bg-opacity-20 rounded-[16px] flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-white font-bold text-lg">Keamanan Data Terjamin</div>
                                <div class="text-blue-200 text-sm">Enkripsi end-to-end di setiap sesi</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ CTA SECTION ============ -->
        <section class="py-20 px-6 md:px-12 bg-[#ffffff]">
            <div class="max-w-4xl mx-auto text-center section-fade">
                <div class="bg-[#003E7E] rounded-[24px] p-12 border border-[#d3cec6]">
                    <!-- Illustration -->
                    <div class="flex justify-center mb-8">
                        <svg viewBox="0 0 200 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-48">
                            <!-- Phone -->
                            <rect x="65" y="10" width="70" height="100" rx="12" fill="#dbeafe"/>
                            <rect x="70" y="20" width="60" height="80" rx="8" fill="white"/>
                            <circle cx="100" cy="105" r="4" fill="#93c5fd"/>
                            <!-- App content on phone -->
                            <rect x="76" y="28" width="48" height="8" rx="4" fill="#60a5fa"/>
                            <rect x="76" y="40" width="36" height="6" rx="3" fill="#bfdbfe"/>
                            <rect x="76" y="50" width="42" height="6" rx="3" fill="#bfdbfe"/>
                            <!-- Heart icon in app -->
                            <path d="M90 70 C90 67 85 62 80 65 C76 68 76 74 80 78 L90 87 L100 78 C104 74 104 68 100 65 C95 62 90 67 90 70Z" fill="#fca5a5" opacity="0.8"/>
                            <!-- Stars left -->
                            <circle cx="30" cy="35" r="4" fill="#fbbf24"/>
                            <circle cx="20" cy="55" r="3" fill="#93c5fd" opacity="0.7"/>
                            <circle cx="45" cy="70" r="2.5" fill="#34d399" opacity="0.8"/>
                            <!-- Stars right -->
                            <circle cx="170" cy="30" r="4" fill="#c4b5fd" opacity="0.8"/>
                            <circle cx="180" cy="55" r="3" fill="#60a5fa" opacity="0.6"/>
                            <circle cx="158" cy="72" r="2.5" fill="#fbbf24" opacity="0.9"/>
                        </svg>
                    </div>

                    <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4">
                        Siap Menjaga Kesehatan Anda?
                    </h2>
                    <p class="text-blue-100 text-lg mb-8 max-w-2xl mx-auto">
                        Bergabung dengan ribuan pengguna yang sudah mempercayakan kesehatan mereka kepada Orion Clinic. Daftar gratis dan mulai konsultasi hari ini.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="<?= base_url('register') ?>"
                           class="bg-[#1BA098] text-[#ffffff] px-[18px] py-[10px] rounded-[8px] font-medium transition-all hover:bg-[#14857d] inline-flex items-center justify-center px-10 py-4 rounded-[24px] text-white font-bold text-base transition-all">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            Daftar Gratis Sekarang
                        </a>
                        <a href="<?= base_url('auth/login') ?>"
                           class="inline-flex items-center justify-center px-10 py-4 rounded-[24px] border-2 border-blue-200 text-[#111111] font-bold text-base bg-[#ebe7e1] transition-all">
                            Sudah Punya Akun? Masuk
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ FOOTER ============ -->
        <footer class="bg-gray-900 text-[#7b7b78] py-12 px-6 md:px-12">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-10">
                    <!-- Brand -->
                    <div>
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-10 h-10 bg-[#003E7E] rounded-[16px] flex items-center justify-center">
                                <img src="<?= base_url('assets/img/logoorion.png') ?>" alt="Orion Clinic" class="w-8 h-8 object-contain">
                            </div>
                            <div>
                                <div class="text-white font-bold text-base">Orion Clinic</div>
                                <div class="text-[#2196F3] text-xs">Platform Telemedisin</div>
                            </div>
                        </div>
                        <p class="text-sm leading-relaxed">
                            Platform telemedisin terpercaya yang menghadirkan layanan kesehatan digital untuk semua kalangan.
                        </p>
                    </div>

                    <!-- Layanan -->
                    <div>
                        <h4 class="text-white font-semibold mb-4 text-sm">Layanan</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#layanan" class="hover:text-white transition-colors">Konsultasi Dokter</a></li>
                            <li><a href="#layanan" class="hover:text-white transition-colors">Resep & Obat</a></li>
                            <li><a href="#layanan" class="hover:text-white transition-colors">Wellness Tracking</a></li>
                            <li><a href="#layanan" class="hover:text-white transition-colors">Riwayat Kesehatan</a></li>
                            <li><a href="#layanan" class="hover:text-white transition-colors">Live Chat Dokter</a></li>
                        </ul>
                    </div>

                    <!-- Akses -->
                    <div>
                        <h4 class="text-white font-semibold mb-4 text-sm">Akses Platform</h4>
                        <ul class="space-y-2 text-sm">
                            <li>
                                <a href="<?= base_url('register') ?>" class="hover:text-white transition-colors flex items-center space-x-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                    </svg>
                                    <span>Daftar Pasien</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('auth/login') ?>" class="hover:text-white transition-colors flex items-center space-x-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                    </svg>
                                    <span>Masuk Pasien</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('auth/login') ?>" class="hover:text-white transition-colors flex items-center space-x-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span>Portal Dokter</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row items-center justify-between text-sm gap-4">
                    <p>&copy; <?= date('Y') ?> Orion Clinic. Hak cipta dilindungi.</p>
                    <p class="text-[#626260]">Dibuat dengan <span class="text-red-400">♥</span> untuk kesehatan Indonesia</p>
                </div>
            </div>
        </footer>

    </main>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    // Mobile menu toggle
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        if (menu.classList.contains('hidden')) {
            menu.classList.remove('hidden');
            setTimeout(() => menu.classList.add('open'), 10);
        } else {
            menu.classList.remove('open');
            setTimeout(() => menu.classList.add('hidden'), 300);
        }
    }

    // Scroll animation
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.classList.add('visible');
                }, i * 100);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.section-fade').forEach(el => observer.observe(el));

    // Active sidebar link on scroll
    const sections = ['hero', 'tentang', 'layanan', 'cara-kerja', 'statistik'];
    const sidebarLinks = document.querySelectorAll('aside a[href^="#"]');

    window.addEventListener('scroll', () => {
        let current = 'hero';
        sections.forEach(id => {
            const el = document.getElementById(id);
            if (el && window.scrollY >= el.offsetTop - 120) current = id;
        });
        sidebarLinks.forEach(link => {
            link.classList.remove('bg-[#ebe7e1]', 'text-[#111111]');
            if (link.getAttribute('href') === '#' + current) {
                link.classList.add('bg-[#ebe7e1]', 'text-[#111111]');
            }
        });
    }, { passive: true });
</script>
</body>
</html>
