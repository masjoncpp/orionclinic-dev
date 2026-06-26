<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="home-screen" class="flex flex-col h-full bg-[#f5f1ec] fade-in">

    <div class="flex-1 overflow-y-auto pb-20 md:pb-6">

        <!-- Header -->
        <div class="bg-[#003E7E] relative overflow-hidden  px-5 pt-8 pb-16 md:px-8 md:pt-10 md:pb-20">

                    <!-- Decorative Ornaments -->
                    <div class="absolute inset-0 pointer-events-none overflow-hidden z-0">
                        <!-- Soft Gradient Circles -->
                        <div class="absolute -top-24 -right-24 w-96 h-96 bg-white opacity-[0.03] rounded-full blur-3xl"></div>
                        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-[#1BA098] opacity-[0.15] rounded-full blur-3xl"></div>
                        
                        <!-- Wavy SVG Accent -->
                        <svg class="absolute top-0 right-0 w-full h-full opacity-[0.04]" viewBox="0 0 100 100" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0,50 Q25,20 50,50 T100,50 L100,0 L0,0 Z" fill="currentColor" class="text-white"/>
                            <path d="M0,80 Q25,50 50,80 T100,80 L100,100 L0,100 Z" fill="currentColor" class="text-[#1BA098]"/>
                        </svg>

                        <!-- Subtle Grid Pattern -->
                        <div class="absolute inset-0" style="background-image: radial-gradient(rgba(255,255,255,0.1) 1.5px, transparent 1.5px); background-size: 24px 24px;"></div>
                        
                        <!-- Accent Medical Crosses -->
                        <svg class="absolute top-10 right-1/4 w-8 h-8 text-white opacity-[0.08]" fill="currentColor" viewBox="0 0 24 24"><path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6v-2z"/></svg>
                        <svg class="absolute bottom-10 left-1/3 w-12 h-12 text-[#1BA098] opacity-[0.12] transform rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6v-2z"/></svg>
                    </div>

            <div class="max-w-5xl mx-auto">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <img src="<?= base_url('assets/profile.png') ?>" alt="Profile"
                            class="w-11 h-11 md:w-14 md:h-14 rounded-full mr-3 object-cover border-2 border-white/30">
                        <div>
                            <?php
                                $hour = date('H');
                                $greeting = ($hour >= 5 && $hour < 11) ? 'Selamat Pagi' : (($hour >= 11 && $hour < 15) ? 'Selamat Siang' : (($hour >= 15 && $hour < 18) ? 'Selamat Sore' : 'Selamat Malam'));
                            ?>
                            <p class="text-white/70 text-xs md:text-sm"><?= $greeting ?> 👋</p>
                            <h2 class="text-white font-bold text-base md:text-xl"><?= esc(session()->get('name') ?? 'Pengguna') ?></h2>
                        </div>
                    </div>
                    <a href="<?= base_url('patient/notifications') ?>" class="relative p-2.5 bg-[#ffffff]/10 rounded-full hover:bg-[#ffffff]/20 transition-all cursor-pointer">
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <?php if (isset($unread_count) && $unread_count > 0): ?>
                            <span class="absolute top-1.5 right-1.5 w-2.5 h-2.5 bg-red-400 rounded-full border-2 border-blue-600"></span>
                        <?php endif; ?>
                    </a>
                </div>

                <!-- Search -->
                <div class="relative">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-[#7b7b78]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" placeholder="Cari dokter, layanan, atau obat..."
                        class="w-full pl-12 pr-4 py-3 md:py-3.5 bg-[#ffffff] rounded-[24px] text-[#111111] text-sm  -blue-900/10 focus:outline-none focus:ring-2 focus:ring-blue-300">
                </div>
            </div>
        </div>

        <div class="max-w-5xl mx-auto px-5 md:px-8">

            <!-- Quick Actions -->
            <div class="-mt-8 mb-6 relative z-10">
                <div class="bg-[#ffffff] rounded-[24px]  -gray-200/60 p-4 md:p-6">
                    <div class="grid grid-cols-4 gap-1 md:gap-3">

                        <button onclick="window.location.href='<?= base_url('patient/consultation') ?>'"
                            class="flex flex-col items-center p-3 md:p-4 rounded-[16px] hover:bg-blue-50 transition-all group">
                            <div class="w-12 h-12 md:w-14 md:h-14 bg-[#ebe7e1] rounded-[16px] flex items-center justify-center mb-2 group-hover:bg-blue-200 transition-all">
                                <?= icon('appointments', 36, 'w-8 h-8 md:w-10 md:h-10 group-hover:scale-110 transition-transform duration-300') ?>
                            </div>
                            <span class="text-xs font-semibold text-gray-700 text-center leading-tight">Konsultasi</span>
                        </button>

                        <button onclick="window.location.href='<?= base_url('patient/prescription') ?>'"
                            class="flex flex-col items-center p-3 md:p-4 rounded-[16px] hover:bg-teal-50 transition-all group">
                            <div class="w-12 h-12 md:w-14 md:h-14 bg-[#ebe7e1] rounded-[16px] flex items-center justify-center mb-2 group-hover:bg-teal-200 transition-all">
                                <?= icon('prescription', 36, 'w-8 h-8 md:w-10 md:h-10 group-hover:scale-110 transition-transform duration-300') ?>
                            </div>
                            <span class="text-xs font-semibold text-gray-700 text-center leading-tight">Resep & Obat</span>
                        </button>

                        <button onclick="window.location.href='<?= base_url('patient/wellness') ?>'"
                            class="flex flex-col items-center p-3 md:p-4 rounded-[16px] hover:bg-green-50 transition-all group">
                            <div class="w-12 h-12 md:w-14 md:h-14 bg-[#ebe7e1] rounded-[16px] flex items-center justify-center mb-2 group-hover:bg-green-200 transition-all">
                                <?= icon('wellness', 36, 'w-8 h-8 md:w-10 md:h-10 group-hover:scale-110 transition-transform duration-300') ?>
                            </div>
                            <span class="text-xs font-semibold text-gray-700 text-center leading-tight">Wellness</span>
                        </button>

                        <button onclick="window.location.href='<?= base_url('patient/history') ?>'"
                            class="flex flex-col items-center p-3 md:p-4 rounded-[16px] hover:bg-purple-50 transition-all group">
                            <div class="w-12 h-12 md:w-14 md:h-14 bg-[#ebe7e1] rounded-[16px] flex items-center justify-center mb-2 group-hover:bg-purple-200 transition-all">
                                <?= icon('medical_records', 36, 'w-8 h-8 md:w-10 md:h-10 group-hover:scale-110 transition-transform duration-300') ?>
                            </div>
                            <span class="text-xs font-semibold text-gray-700 text-center leading-tight">Riwayat</span>
                        </button>

                    </div>
                </div>
            </div>

            <!-- Upcoming Appointment -->
            <div class="mb-6">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="font-bold text-[#111111] text-base md:text-lg">Jadwal Mendatang</h3>
                    <button onclick="window.location.href='<?= base_url('patient/history') ?>'" class="text-sm text-[#111111] font-semibold hover:text-[#111111]">Lihat Semua</button>
                </div>
                
                <?php 
                    $hasReminder = false;
                    if (!empty($upcoming)) {
                        $firstApt = $upcoming[0];
                        $aptTime = strtotime($firstApt['appointment_date'] . ' ' . $firstApt['time_slot']);
                        $timeDiff = $aptTime - time();
                        if ($timeDiff > 0 && $timeDiff <= 86400) { // Within 24 hours
                            $hasReminder = true;
                        }
                    }
                ?>
                
                <?php if ($hasReminder): ?>
                    <div class="mb-4 bg-[#FF9800]/10 border border-[#FF9800]/20 rounded-[16px] p-4 flex items-start">
                        <div class="w-8 h-8 bg-[#FF9800]/20 rounded-full flex items-center justify-center mr-3 flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-[#FF9800]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#FF9800] text-sm">Pengingat Jadwal!</h4>
                            <p class="text-xs text-[#111111] mt-1">Anda memiliki jadwal konsultasi dengan <?= esc($upcoming[0]['doctor_name']) ?> dalam waktu kurang dari 24 jam.</p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (empty($upcoming)): ?>
                    <div class="bg-[#ffffff] rounded-[24px] p-6 text-center border border-dashed border-[#d3cec6]">
                        <p class="text-[#7b7b78] text-sm">Belum ada jadwal konsultasi mendatang.</p>
                        <button onclick="window.location.href='<?= base_url('patient/consultation') ?>'" class="mt-2 text-[#111111] font-bold text-sm">Cari Dokter</button>
                    </div>
                <?php else: ?>
                    <div class="space-y-3">
                        <?php foreach ($upcoming as $apt): ?>
                            <div class="bg-[#003E7E] rounded-[24px] p-5 md:p-6 card-hover">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 md:w-14 md:h-14 bg-[#ffffff]/20 rounded-[16px] flex items-center justify-center mr-4 flex-shrink-0">
                                            <?= icon('doctor', 32, 'w-7 h-7 md:w-8 md:h-8') ?>
                                        </div>
                                        <div>
                                            <div class="flex items-center mb-0.5">
                                                <span class="w-2 h-2 <?= $apt['doctor_status'] == 'online' ? 'bg-[#4CAF50] status-online' : 'bg-gray-400' ?> rounded-full mr-2"></span>
                                                <span class="text-xs <?= $apt['doctor_status'] == 'online' ? 'text-green-300' : 'text-white/60' ?> font-medium"><?= $apt['doctor_status'] == 'online' ? 'Online' : 'Offline' ?></span>
                                            </div>
                                            <h4 class="text-white font-bold text-sm md:text-base"><?= esc($apt['doctor_name']) ?></h4>
                                            <p class="text-white/60 text-xs"><?= esc($apt['specialization']) ?> • <?= date('d M, H:i', strtotime($apt['appointment_date'] . ' ' . $apt['time_slot'])) ?> WIB</p>
                                        </div>
                                    </div>
                                    <button onclick="window.location.href='<?= base_url('patient/chat?id=' . $apt['id']) ?>'"
                                        class="bg-[#ffffff] text-[#111111] px-4 py-2 rounded-[16px] font-bold text-sm bg-[#ebe7e1] transition-all flex-shrink-0 ">
                                        Mulai Chat
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Desktop: two-column layout for bottom sections -->
            <div class="md:grid md:grid-cols-2 md:gap-6">

                <!-- Health Summary -->
                <div class="mb-6 md:mb-0">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="font-bold text-[#111111] text-base md:text-lg">Ringkasan Kesehatan</h3>
                        <button onclick="window.location.href='<?= base_url('patient/wellness') ?>'"
                            class="text-sm text-[#111111] font-semibold hover:text-[#111111]">Detail</button>
                    </div>
                    <div class="bg-[#ffffff] rounded-[24px]  p-4 md:p-5">
                        <div class="grid grid-cols-2 gap-3">
                            <div class="bg-red-50 rounded-[16px] p-3">
                                <div class="flex items-center mb-2">
                                    <div class="w-7 h-7 bg-red-100 rounded-[12px] flex items-center justify-center mr-2">
                                        <?= icon('wellness', 20) ?>
                                    </div>
                                    <span class="text-xs text-[#626260] font-medium">Jantung</span>
                                </div>
                                <p class="text-lg font-bold text-[#111111]">72 <span class="text-xs font-normal text-[#7b7b78]">bpm</span></p>
                                <span class="text-xs text-[#111111] font-semibold">Normal</span>
                            </div>
                            <div class="bg-[#ebe7e1] rounded-[16px] p-3">
                                <div class="flex items-center mb-2">
                                    <div class="w-7 h-7 bg-[#ebe7e1] rounded-[12px] flex items-center justify-center mr-2">
                                        <?= icon('steps', 20) ?>
                                    </div>
                                    <span class="text-xs text-[#626260] font-medium">Langkah</span>
                                </div>
                                <p class="text-lg font-bold text-[#111111]">6.240 <span class="text-xs font-normal text-[#7b7b78]">/ 10k</span></p>
                                <span class="text-xs text-[#FF9800] font-semibold">62% target</span>
                            </div>
                            <div class="bg-teal-50 rounded-[16px] p-3">
                                <div class="flex items-center mb-2">
                                    <div class="w-7 h-7 bg-[#ebe7e1] rounded-[12px] flex items-center justify-center mr-2">
                                        <?= icon('water', 20) ?>
                                    </div>
                                    <span class="text-xs text-[#626260] font-medium">Air Minum</span>
                                </div>
                                <p class="text-lg font-bold text-[#111111]">1,8 <span class="text-xs font-normal text-[#7b7b78]">/ 2L</span></p>
                                <span class="text-xs text-[#111111] font-semibold">90% target</span>
                            </div>
                            <div class="bg-purple-50 rounded-[16px] p-3">
                                <div class="flex items-center mb-2">
                                    <div class="w-7 h-7 bg-[#ebe7e1] rounded-[12px] flex items-center justify-center mr-2">
                                        <?= icon('sleep', 20) ?>
                                    </div>
                                    <span class="text-xs text-[#626260] font-medium">Tidur</span>
                                </div>
                                <p class="text-lg font-bold text-[#111111]">6,5 <span class="text-xs font-normal text-[#7b7b78]">jam</span></p>
                                <span class="text-xs text-[#FF9800] font-semibold">Kurang ideal</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Health Tips -->
                <div class="mb-6 md:mb-0">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="font-bold text-[#111111] text-base md:text-lg">Tips Kesehatan</h3>
                        <button class="text-sm text-[#111111] font-semibold hover:text-[#111111]">Lihat Semua</button>
                    </div>
                    <div class="space-y-3">
                        <div class="bg-[#ffffff] rounded-[24px] p-4  flex items-center space-x-3 cursor-pointer card-hover">
                            <div class="w-12 h-12    rounded-[16px] flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-[#111111] text-sm">Jaga Kesehatan Jantung</h4>
                                <p class="text-xs text-[#7b7b78] mt-0.5 truncate">5 tips mudah untuk jantung sehat</p>
                            </div>
                            <svg class="w-4 h-4 text-[#7b7b78] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                        <div class="bg-[#ffffff] rounded-[24px] p-4  flex items-center space-x-3 cursor-pointer card-hover">
                            <div class="w-12 h-12    rounded-[16px] flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-[#111111] text-sm">Manfaat Vitamin D</h4>
                                <p class="text-xs text-[#7b7b78] mt-0.5 truncate">Pentingnya sinar matahari pagi</p>
                            </div>
                            <svg class="w-4 h-4 text-[#7b7b78] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                        <div class="bg-[#ffffff] rounded-[24px] p-4  flex items-center space-x-3 cursor-pointer card-hover">
                            <div class="w-12 h-12    rounded-[16px] flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-[#111111] text-sm">Pentingnya Hidrasi</h4>
                                <p class="text-xs text-[#7b7b78] mt-0.5 truncate">Cara mudah memenuhi kebutuhan air</p>
                            </div>
                            <svg class="w-4 h-4 text-[#7b7b78] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<?= $this->include('components/bottom_nav') ?>
<?= $this->endSection() ?>
