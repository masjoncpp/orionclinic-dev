<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="home-screen" class="flex active flex-col h-full w-full bg-[#f5f1ec] flex-1 relative">
            <div class="flex-1 overflow-auto pb-20">
                <!-- Header -->
                <div class="bg-[#003E7E] relative overflow-hidden px-6 pt-8 pb-16 rounded-b-3xl">

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

                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-[#ffffff]/20 rounded-full flex items-center justify-center mr-3 border-2 border-white/20 text-white font-bold text-xl">
                                <?php 
                                    $name = session()->get('name') ?? 'Doctor';
                                    $initials = substr($name, 0, 1);
                                    $lastSpace = strrpos($name, ' ');
                                    if ($lastSpace !== false) {
                                        $initials .= substr($name, $lastSpace + 1, 1);
                                    }
                                    echo esc(strtoupper($initials));
                                ?>
                            </div>
                            <div>
                                <p class="text-white/80 text-sm">Selamat Bertugas 👋</p>
                                <h2 class="text-white font-bold text-lg"><?= session()->get('name') ?></h2>
                            </div>
                        </div>
                        <button class="relative p-2 bg-[#ffffff]/10 rounded-full hover:bg-[#ffffff]/20 transition-all">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-[#E53935] rounded-full border-2 border-blue-600"></span>
                        </button>
                    </div>
                </div>
                
                <!-- Quick Stats -->
                <div class="px-6 -mt-8 relative z-10">
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="bg-[#ffffff] rounded-[24px] p-4 card-hover relative overflow-hidden shadow-sm hover:shadow-blue-500/20">
                            <div class="flex justify-between items-start mb-4">
                                <div class="w-12 h-12 bg-blue-50 rounded-[16px] flex items-center justify-center">
                                    <?= icon('patient', 26) ?>
                                </div>
                                <span class="bg-blue-50 text-blue-700 text-xs px-3 py-1.5 rounded-full font-bold shadow-sm">Hari Ini</span>
                            </div>
                            <p class="text-3xl font-extrabold text-[#111111] tracking-tight"><?= $stats['total_today'] ?></p>
                            <p class="text-sm text-[#626260] font-semibold mt-1">Total Pasien</p>
                            <div class="absolute bottom-0 left-0 right-0 h-1.5 bg-gradient-to-r from-blue-500 to-cyan-400"></div>
                        </div>
                        <div class="bg-[#ffffff] rounded-[24px] p-4 card-hover relative overflow-hidden shadow-sm hover:shadow-orange-500/20">
                            <div class="flex justify-between items-start mb-4">
                                <div class="w-12 h-12 bg-orange-50 rounded-[16px] flex items-center justify-center">
                                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                            </div>
                            <p class="text-3xl font-extrabold text-[#111111] tracking-tight"><?= $stats['pending'] ?></p>
                            <p class="text-sm text-[#626260] font-semibold mt-1">Permintaan Baru</p>
                            <div class="absolute bottom-0 left-0 right-0 h-1.5 bg-gradient-to-r from-orange-400 to-amber-300"></div>
                        </div>
                        <div class="bg-[#ffffff] rounded-[24px] p-4 card-hover relative overflow-hidden shadow-sm hover:shadow-purple-500/20">
                            <div class="flex justify-between items-start mb-4">
                                <div class="w-12 h-12 bg-purple-50 rounded-[16px] flex items-center justify-center">
                                    <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </div>
                            </div>
                            <p class="text-3xl font-extrabold text-[#111111] tracking-tight"><?= $stats['waiting'] ?></p>
                            <p class="text-sm text-[#626260] font-semibold mt-1">Dalam Antrean</p>
                            <div class="absolute bottom-0 left-0 right-0 h-1.5 bg-gradient-to-r from-indigo-500 to-purple-400"></div>
                        </div>
                         <div class="bg-[#ffffff] rounded-[24px] p-4 card-hover relative overflow-hidden shadow-sm hover:shadow-green-500/20">
                            <div class="flex justify-between items-start mb-4">
                                <div class="w-12 h-12 bg-green-50 rounded-[16px] flex items-center justify-center">
                                    <?= icon('success', 26) ?>
                                </div>
                            </div>
                            <p class="text-3xl font-extrabold text-[#111111] tracking-tight"><?= $stats['completed'] ?></p>
                            <p class="text-sm text-[#626260] font-semibold mt-1">Selesai</p>
                            <div class="absolute bottom-0 left-0 right-0 h-1.5 bg-gradient-to-r from-emerald-500 to-green-400"></div>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Patients -->
                <div class="px-6 mt-8">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-bold text-[#111111]">Jadwal Selanjutnya</h3>
                        <button onclick="window.location.href='<?= base_url('doctor/consultation') ?>'" class="text-sm text-[#111111] font-medium hover:underline">Lihat Semua</button>
                    </div>
                    <div class="space-y-4">
                        <?php if (empty($upcoming)): ?>
                            <div class="bg-[#ffffff] rounded-[24px] p-8 text-center border border-dashed border-gray-300">
                                <p class="text-[#7b7b78]">Tidak ada jadwal konsultasi hari ini.</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($upcoming as $apt): ?>
                                <div class="bg-[#ffffff] rounded-[24px] p-4  border border-[#d3cec6] flex items-center justify-between card-hover">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 rounded-full bg-[#ebe7e1] flex items-center justify-center mr-4 text-[#111111] font-bold">
                                            <?= substr($apt['patient_name'], 0, 1) ?>
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-[#111111]"><?= esc($apt['patient_name']) ?></h4>
                                            <p class="text-xs text-[#626260] mt-1">Keluhan: <?= esc($apt['reason']) ?></p>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <span class="bg-yellow-100 text-yellow-700 text-xs px-3 py-1 rounded-full font-medium mb-2"><?= date('H:i', strtotime($apt['time_slot'])) ?> WIB</span>
                                        <button onclick="window.location.href='<?= base_url('doctor/chat?id=' . $apt['id']) ?>'" class="bg-[#003E7E] text-[#ffffff] text-sm px-4 py-1.5 rounded-[12px] font-medium hover:bg-[#002855] transition">Mulai</button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- Mobile Bottom Nav -->
</div>
<?= $this->include('components/bottom_nav') ?>
<?= $this->endSection() ?>
