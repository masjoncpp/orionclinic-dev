<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="consultation-screen" class="flex flex-col h-full w-full bg-gray-50 flex-1 relative">
            <div class="flex-1 overflow-auto pb-20">
                <div class="bg-white px-6 py-4 border-b border-gray-100 flex items-center sticky top-0 z-10">
                    <button onclick="window.location.href='<?= base_url('doctor') ?>'" class="p-2 -ml-2 rounded-full hover:bg-gray-100 transition-all mr-2 md:">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                    </button>
                    <h1 class="text-xl font-bold text-gray-800">Jadwal Konsultasi</h1>
                </div>
                <!-- Appointments Lists -->
                <div class="px-6 py-6 space-y-8">
                    
                    <!-- Today's Section -->
                    <div>
                        <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                            <span class="w-2 h-2 bg-blue-600 rounded-full mr-2"></span>
                            Hari Ini
                        </h3>
                        <?php if (empty($today_appointments)): ?>
                            <div class="bg-white rounded-2xl p-6 text-center border border-dashed border-gray-300">
                                <p class="text-gray-400 text-sm">Tidak ada jadwal hari ini.</p>
                            </div>
                        <?php else: ?>
                            <div class="space-y-4">
                                <?php foreach ($today_appointments as $apt): ?>
                                    <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex items-center justify-between card-hover">
                                        <div class="flex items-center">
                                            <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center mr-4 text-blue-600 font-bold">
                                                <?= substr($apt['patient_name'], 0, 1) ?>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-800"><?= esc($apt['patient_name']) ?></h4>
                                                <p class="text-sm text-gray-500 mt-1"><?= esc($apt['reason']) ?></p>
                                                <p class="text-xs text-gray-400 mt-1">Status: <?= ucfirst($apt['status']) ?></p>
                                            </div>
                                        </div>
                                        <div class="flex flex-col items-end">
                                            <span class="bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full font-medium mb-2"><?= date('H:i', strtotime($apt['time_slot'])) ?> WIB</span>
                                            <?php if ($apt['status'] == 'confirmed'): ?>
                                                <button onclick="window.location.href='<?= base_url('doctor/chat?id=' . $apt['id']) ?>'" class="bg-blue-600 text-white text-sm px-5 py-2 rounded-lg font-semibold hover:bg-blue-700 transition">Masuk Chat</button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Upcoming Section -->
                    <div>
                        <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                            <span class="w-2 h-2 bg-purple-600 rounded-full mr-2"></span>
                            Mendatang
                        </h3>
                        <?php if (empty($upcoming_appointments)): ?>
                            <div class="bg-white rounded-2xl p-6 text-center border border-dashed border-gray-300">
                                <p class="text-gray-400 text-sm">Tidak ada jadwal mendatang.</p>
                            </div>
                        <?php else: ?>
                            <div class="space-y-4">
                                <?php foreach ($upcoming_appointments as $apt): ?>
                                    <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex items-center justify-between opacity-80">
                                        <div class="flex items-center">
                                            <div class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center mr-4 text-purple-600 font-bold">
                                                <?= substr($apt['patient_name'], 0, 1) ?>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-800"><?= esc($apt['patient_name']) ?></h4>
                                                <p class="text-xs text-gray-400 mt-1"><?= date('d M Y', strtotime($apt['appointment_date'])) ?> • <?= date('H:i', strtotime($apt['time_slot'])) ?> WIB</p>
                                            </div>
                                        </div>
                                        <span class="bg-gray-100 text-gray-600 text-xs px-3 py-1 rounded-full font-medium italic">Menunggu</span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
            
            <!-- Mobile Bottom Nav -->
</div>
<?= $this->include('components/bottom_nav') ?>
<?= $this->endSection() ?>
