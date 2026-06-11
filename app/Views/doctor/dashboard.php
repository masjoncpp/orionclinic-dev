<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="home-screen" class="flex active flex-col h-full w-full bg-gray-50 flex-1 relative">
            <div class="flex-1 overflow-auto pb-20">
                <!-- Header -->
                <div class="bg-gradient-to-br from-blue-600 to-blue-800 px-6 pt-8 pb-16 rounded-b-3xl">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mr-3 border-2 border-white/20 text-white font-bold text-xl">
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
                        <button class="relative p-2 bg-white/10 rounded-full hover:bg-white/20 transition-all">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-blue-600"></span>
                        </button>
                    </div>
                </div>
                
                <!-- Quick Stats -->
                <div class="px-6 -mt-8">
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="bg-white rounded-2xl p-4 shadow-lg card-hover border-b-4 border-blue-500">
                            <div class="flex justify-between items-start mb-2">
                                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                </div>
                                <span class="bg-blue-100 text-blue-600 text-xs px-2 py-1 rounded-full font-semibold">Hari Ini</span>
                            </div>
                            <p class="text-2xl font-bold text-gray-800"><?= $stats['total_today'] ?></p>
                            <p class="text-sm text-gray-500 font-medium">Total Pasien</p>
                        </div>
                        <div class="bg-white rounded-2xl p-4 shadow-lg card-hover border-b-4 border-yellow-500">
                            <div class="flex justify-between items-start mb-2">
                                <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                            </div>
                            <p class="text-2xl font-bold text-gray-800"><?= $stats['waiting'] ?></p>
                            <p class="text-sm text-gray-500 font-medium">Menunggu</p>
                        </div>
                         <div class="bg-white rounded-2xl p-4 shadow-lg card-hover border-b-4 border-green-500">
                            <div class="flex justify-between items-start mb-2">
                                <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                            </div>
                            <p class="text-2xl font-bold text-gray-800"><?= $stats['completed'] ?></p>
                            <p class="text-sm text-gray-500 font-medium">Selesai</p>
                        </div>
                        <div class="bg-white rounded-2xl p-4 shadow-lg card-hover border-b-4 border-purple-500">
                            <div class="flex justify-between items-start mb-2">
                                <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                            </div>
                            <p class="text-2xl font-bold text-gray-800">Rp <?= number_format($doctor['consultation_fee'] * $stats['completed'] / 1000, 1) ?>K</p>
                            <p class="text-sm text-gray-500 font-medium">Pendapatan Est.</p>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Patients -->
                <div class="px-6 mt-8">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-bold text-gray-800">Jadwal Selanjutnya</h3>
                        <button onclick="window.location.href='<?= base_url('doctor/consultation') ?>'" class="text-sm text-blue-600 font-medium hover:underline">Lihat Semua</button>
                    </div>
                    <div class="space-y-4">
                        <?php if (empty($upcoming)): ?>
                            <div class="bg-white rounded-2xl p-8 text-center border border-dashed border-gray-300">
                                <p class="text-gray-400">Tidak ada jadwal konsultasi hari ini.</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($upcoming as $apt): ?>
                                <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex items-center justify-between card-hover">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mr-4 text-blue-600 font-bold">
                                            <?= substr($apt['patient_name'], 0, 1) ?>
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-gray-800"><?= esc($apt['patient_name']) ?></h4>
                                            <p class="text-xs text-gray-500 mt-1">Keluhan: <?= esc($apt['reason']) ?></p>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <span class="bg-yellow-100 text-yellow-700 text-xs px-3 py-1 rounded-full font-medium mb-2"><?= date('H:i', strtotime($apt['time_slot'])) ?> WIB</span>
                                        <button onclick="window.location.href='<?= base_url('doctor/chat?id=' . $apt['id']) ?>'" class="bg-blue-600 text-white text-sm px-4 py-1.5 rounded-lg font-medium hover:bg-blue-700 transition">Mulai</button>
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
