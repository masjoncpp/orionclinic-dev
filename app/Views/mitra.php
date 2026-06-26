<!doctype html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bermitra dengan Orion Clinic — Peluang untuk Dokter</title>
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
                            <svg class="w-4 h-4 mr-2 text-[#003E7E]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zM9 11a1 1 0 112 0 1 1 0 01-2 0zm1-7a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            Peluang Karir Dokter
                        </div>

                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-[#111111] leading-tight mb-6">
                            Bergabunglah Bersama
                            <span class="text-[#003E7E]">Orion Clinic</span>
                        </h1>

                        <p class="text-lg text-[#626260] leading-relaxed mb-8">
                            Bantu ribuan pasien mendapatkan layanan kesehatan terbaik. Buka praktik digital Anda, jangkau lebih banyak pasien, dan atur jadwal secara fleksibel melalui platform Orion Clinic.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-4 mb-10">
                            <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Orion%20Clinic,%20saya%20tertarik%20untuk%20bergabung%20sebagai%20dokter%20mitra." target="_blank"
                               class="bg-[#1BA098] text-[#ffffff] px-[18px] py-[10px] rounded-[8px] font-medium transition-all hover:bg-[#14857d] inline-flex items-center justify-center px-8 py-4 rounded-[24px] text-white font-bold text-base transition-all">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                                Hubungi Admin via WhatsApp
                            </a>
                            <a href="#syarat"
                               class="inline-flex items-center justify-center px-8 py-4 rounded-[24px] border-2 border-[#d3cec6] text-[#111111] font-bold text-base bg-[#ebe7e1] transition-all">
                                Lihat Persyaratan
                            </a>
                        </div>
                    </div>

                    <!-- Illustration -->
                    <div class="order-1 lg:order-2 flex justify-center items-center">
                        <div class="relative w-full max-w-sm lg:max-w-md">
                            <!-- Background circles -->
                            <div class="pulse-ring absolute inset-0 rounded-full border-4 border-blue-200 opacity-40 scale-110"></div>
                            <div class="pulse-ring absolute inset-0 rounded-full border-4 border-teal-200 opacity-30 scale-125" style="animation-delay: 1s;"></div>

                            <!-- Main illustration card -->
                            <div class="hero-float relative bg-[#ffffff] rounded-[24px] p-6 mx-4">
                                <!-- Doctor illustration SVG -->
                                <svg viewBox="0 0 400 340" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                                    <circle cx="200" cy="170" r="150" fill="#eff6ff" opacity="0.6"/>
                                    <!-- Desk / Monitor base -->
                                    <rect x="100" y="240" width="200" height="12" rx="6" fill="#e2e8f0"/>
                                    <rect x="185" y="252" width="30" height="20" fill="#cbd5e1"/>
                                    <rect x="155" y="268" width="90" height="8" rx="4" fill="#e2e8f0"/>
                                    <!-- Monitor screen -->
                                    <rect x="110" y="150" width="180" height="95" rx="12" fill="#1e293b"/>
                                    <rect x="116" y="156" width="168" height="83" rx="9" fill="#0f172a"/>
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
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ ABOUT SECTION ============ -->
        <section id="manfaat" class="py-20 px-6 md:px-12 bg-[#ffffff]">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                    <div class="section-fade">
                        <div class="inline-flex items-center bg-[#ebe7e1] text-[#111111] px-4 py-1.5 rounded-full text-sm font-semibold mb-4">
                            Keuntungan
                        </div>
                        <h2 class="text-3xl md:text-4xl font-extrabold text-[#111111] mb-6 leading-tight">
                            Mengapa Praktik di
                            <span class="text-[#003E7E]">Orion Clinic?</span>
                        </h2>
                        <p class="text-[#626260] text-lg leading-relaxed mb-6">
                            Kami menyediakan platform modern yang membantu Anda fokus melayani pasien tanpa dipusingkan oleh urusan administratif.
                        </p>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-[#ebe7e1] rounded-[24px] p-4">
                                <h4 class="font-bold text-[#111111] text-sm mb-1">Jangkauan Luas</h4>
                                <p class="text-xs text-[#626260]">Akses ribuan pasien di seluruh Indonesia.</p>
                            </div>
                            <div class="bg-teal-50 rounded-[24px] p-4">
                                <h4 class="font-bold text-[#111111] text-sm mb-1">Jadwal Fleksibel</h4>
                                <p class="text-xs text-[#626260]">Atur jadwal online Anda sendiri.</p>
                            </div>
                            <div class="bg-purple-50 rounded-[24px] p-4">
                                <h4 class="font-bold text-[#111111] text-sm mb-1">Manajemen Pasien</h4>
                                <p class="text-xs text-[#626260]">Rekam medis & resep digital yang rapi.</p>
                            </div>
                            <div class="bg-green-50 rounded-[24px] p-4">
                                <h4 class="font-bold text-[#111111] text-sm mb-1">Pembayaran Aman</h4>
                                <p class="text-xs text-[#626260]">Sistem pembayaran transparan dan lancar.</p>
                            </div>
                        </div>
                    </div>

                    <div class="section-fade hidden lg:block">
                        <img src="<?= base_url('assets/img/logoorion.png') ?>" alt="Orion Clinic" class="w-full max-w-xs mx-auto object-contain hero-float opacity-80">
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ SYARAT SECTION ============ -->
        <section id="syarat" class="py-20 px-6 md:px-12 bg-[#f5f1ec]">
            <div class="max-w-4xl mx-auto text-center">
                <div class="text-center mb-14 section-fade">
                    <div class="inline-flex items-center bg-[#ffffff] text-[#111111] px-4 py-1.5 rounded-full text-sm font-semibold mb-4">
                        Persyaratan
                    </div>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-[#111111] mb-4">
                        Syarat Bergabung
                    </h2>
                    <p class="text-[#626260] text-lg">
                        Untuk menjaga kualitas pelayanan, kami melakukan proses verifikasi yang ketat.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-left section-fade">
                    <div class="bg-white p-6 rounded-[24px] shadow-sm border border-[#ebe7e1]">
                        <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-[#111111] mb-2">1. Dokumen Legalitas</h3>
                        <p class="text-sm text-[#626260]">Memiliki Surat Tanda Registrasi (STR) dan Surat Izin Praktik (SIP) yang masih aktif dan valid.</p>
                    </div>
                    <div class="bg-white p-6 rounded-[24px] shadow-sm border border-[#ebe7e1]">
                        <div class="w-12 h-12 bg-green-50 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-[#111111] mb-2">2. Identitas Diri</h3>
                        <p class="text-sm text-[#626260]">Scan/Foto Kartu Tanda Penduduk (KTP) dan Nomor Pokok Wajib Pajak (NPWP).</p>
                    </div>
                </div>

                <div class="mt-14 section-fade">
                    <h3 class="text-xl font-bold text-[#111111] mb-4">Langkah Pendaftaran:</h3>
                    <ul class="text-[#626260] text-sm md:text-base inline-block text-left space-y-3">
                        <li class="flex items-start"><span class="bg-[#111111] text-white w-6 h-6 rounded-full inline-flex items-center justify-center text-xs mr-3 mt-0.5">1</span> Hubungi tim Admin kami melalui WhatsApp.</li>
                        <li class="flex items-start"><span class="bg-[#111111] text-white w-6 h-6 rounded-full inline-flex items-center justify-center text-xs mr-3 mt-0.5">2</span> Kirimkan soft-copy kelengkapan dokumen persyaratan.</li>
                        <li class="flex items-start"><span class="bg-[#111111] text-white w-6 h-6 rounded-full inline-flex items-center justify-center text-xs mr-3 mt-0.5">3</span> Tunggu proses verifikasi oleh tim internal kami (1-3 hari kerja).</li>
                        <li class="flex items-start"><span class="bg-[#111111] text-white w-6 h-6 rounded-full inline-flex items-center justify-center text-xs mr-3 mt-0.5">4</span> Akun akan didaftarkan oleh Admin dan Anda akan menerima kredensial login.</li>
                    </ul>
                </div>
            </div>
        </section>

    </main>

    <!-- ============ FOOTER ============ -->
    <footer class="bg-[#ffffff] pt-16 pb-8 border-t border-[#d3cec6]">
        <div class="max-w-6xl mx-auto px-6 md:px-12">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-8 md:mb-0">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-[#ebe7e1] rounded-[8px] flex items-center justify-center mr-3">
                            <img src="<?= base_url('assets/img/logoorion.png') ?>" alt="Orion Clinic" class="w-full h-full object-contain p-1">
                        </div>
                        <h2 class="text-xl font-bold text-[#111111]">Orion Clinic</h2>
                    </div>
                    <p class="text-[#626260] text-sm max-w-xs">
                        Layanan telemedisin inovatif untuk masa depan kesehatan yang lebih baik.
                    </p>
                </div>
            </div>
            <div class="border-t border-[#d3cec6] mt-12 pt-8 text-center text-[#626260] text-sm">
                &copy; <?= date('Y') ?> Orion Clinic. All rights reserved.
            </div>
        </div>
    </footer>
</div>

<script>
    // Scroll reveal animation
    document.addEventListener("DOMContentLoaded", () => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.section-fade').forEach(el => observer.observe(el));
    });

    // Mobile Menu Toggle
    const btnMenu = document.getElementById('btn-mobile-menu');
    const menuLayer = document.getElementById('mobile-menu');
    const btnCloseMenu = document.getElementById('btn-close-menu');

    if(btnMenu && menuLayer && btnCloseMenu) {
        btnMenu.addEventListener('click', () => {
            menuLayer.classList.remove('hidden');
            // Sedikit delay agar transisi jalan
            setTimeout(() => {
                menuLayer.classList.add('open');
            }, 10);
        });

        const closeMenu = () => {
            menuLayer.classList.remove('open');
            // Tunggu transisi selesai sebelum hide penuh
            setTimeout(() => {
                menuLayer.classList.add('hidden');
            }, 300);
        };

        btnCloseMenu.addEventListener('click', closeMenu);
        menuLayer.addEventListener('click', (e) => {
            if (e.target === menuLayer) {
                closeMenu();
            }
        });

        // Close on link click
        const mobileLinks = menuLayer.querySelectorAll('a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', closeMenu);
        });
    }
</script>

</body>
</html>
