<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="consultation-screen" class="flex flex-col h-full w-full bg-[#f5f1ec] flex-1 relative">
            <div class="flex-1 overflow-auto pb-20">
                <div class="bg-[#ffffff] px-6 py-4 border-b border-[#d3cec6] flex items-center sticky top-0 z-10">
                    <button onclick="window.location.href='<?= base_url('doctor') ?>'" class="p-2 -ml-2 rounded-full hover:bg-[#f5f1ec] transition-all mr-2 md:">
                        <svg class="w-6 h-6 text-[#626260]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                    </button>
                    <h1 class="text-xl font-bold text-[#111111]">Jadwal Konsultasi</h1>
                </div>
                <!-- Appointments Lists -->
                <div class="px-6 py-6 space-y-8">
                    <!-- Pending Section -->
                    <?php if (!empty($pending_appointments)): ?>
                    <div>
                        <h3 class="font-bold text-[#111111] mb-4 flex items-center">
                            <span class="w-2 h-2 bg-yellow-500 rounded-full mr-2 animate-pulse"></span>
                            Permintaan Konsultasi Baru
                        </h3>
                        <div class="space-y-4">
                            <?php foreach ($pending_appointments as $apt): ?>
                                <div class="bg-[#ffffff] rounded-[24px] p-4 border border-yellow-200 flex flex-col md:flex-row md:items-center justify-between shadow-sm">
                                    <div class="flex items-center mb-3 md:mb-0">
                                        <div class="w-14 h-14 bg-yellow-50 rounded-[24px] flex items-center justify-center mr-4 text-yellow-700 font-bold">
                                            <?= substr($apt['patient_name'], 0, 1) ?>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-[#111111]"><?= esc($apt['patient_name']) ?></h4>
                                            <p class="text-sm text-[#626260] mt-1 break-words"><span class="font-medium">Keluhan:</span> <?= esc($apt['reason']) ?></p>
                                            <p class="text-xs text-[#7b7b78] mt-1"><?= date('d M Y', strtotime($apt['appointment_date'])) ?> • <?= date('H:i', strtotime($apt['time_slot'])) ?> WIB</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <form action="<?= base_url('doctor/reject_appointment') ?>" method="POST">
                                            <input type="hidden" name="appointment_id" value="<?= $apt['id'] ?>">
                                            <button type="submit" onclick="return confirm('Tolak permintaan konsultasi ini?')" class="bg-red-50 text-red-600 text-sm px-4 py-2 rounded-[12px] font-semibold hover:bg-red-100 transition">Tolak</button>
                                        </form>
                                        <form action="<?= base_url('doctor/accept_appointment') ?>" method="POST">
                                            <input type="hidden" name="appointment_id" value="<?= $apt['id'] ?>">
                                            <button type="submit" class="bg-[#003E7E] text-[#ffffff] text-sm px-5 py-2 rounded-[12px] font-semibold hover:bg-[#002855] transition">Terima</button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Today's Section -->
                    <div>
                        <h3 class="font-bold text-[#111111] mb-4 flex items-center">
                            <span class="w-2 h-2 bg-[#003E7E] rounded-full mr-2"></span>
                            Hari Ini
                        </h3>
                        <?php if (empty($today_appointments)): ?>
                            <div class="bg-[#ffffff] rounded-[24px] p-6 text-center border border-dashed border-gray-300">
                                <p class="text-[#7b7b78] text-sm">Tidak ada jadwal hari ini.</p>
                            </div>
                        <?php else: ?>
                            <div class="space-y-4">
                                <?php foreach ($today_appointments as $apt): ?>
                                    <div class="bg-[#ffffff] rounded-[24px] p-4  border border-[#d3cec6] flex items-center justify-between card-hover">
                                        <div class="flex items-center">
                                            <div class="w-14 h-14 bg-[#ebe7e1] rounded-[24px] flex items-center justify-center mr-4 text-[#111111] font-bold">
                                                <?= substr($apt['patient_name'], 0, 1) ?>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-[#111111]"><?= esc($apt['patient_name']) ?></h4>
                                                <p class="text-sm text-[#626260] mt-1"><?= esc($apt['reason']) ?></p>
                                                <p class="text-xs text-[#7b7b78] mt-1">Status: <?= ucfirst($apt['status']) ?></p>
                                            </div>
                                        </div>
                                        <div class="flex flex-col items-end">
                                            <span class="bg-[#ebe7e1] text-[#111111] text-xs px-3 py-1 rounded-full font-medium mb-2"><?= date('H:i', strtotime($apt['time_slot'])) ?> WIB</span>
                                            <?php if ($apt['status'] == 'confirmed'): ?>
                                                <button onclick="window.location.href='<?= base_url('doctor/chat?id=' . $apt['id']) ?>'" class="bg-[#003E7E] text-[#ffffff] text-sm px-5 py-2 rounded-[12px] font-semibold hover:bg-[#002855] transition">Masuk Chat</button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Upcoming Section -->
                    <div>
                        <h3 class="font-bold text-[#111111] mb-4 flex items-center">
                            <span class="w-2 h-2 bg-purple-600 rounded-full mr-2"></span>
                            Mendatang
                        </h3>
                        <?php if (empty($upcoming_appointments)): ?>
                            <div class="bg-[#ffffff] rounded-[24px] p-6 text-center border border-dashed border-gray-300">
                                <p class="text-[#7b7b78] text-sm">Tidak ada jadwal mendatang.</p>
                            </div>
                        <?php else: ?>
                            <div class="space-y-4">
                                <?php foreach ($upcoming_appointments as $apt): ?>
                                    <div class="bg-[#ffffff] rounded-[24px] p-4  border border-[#d3cec6] flex items-center justify-between opacity-80">
                                        <div class="flex items-center">
                                            <div class="w-14 h-14 bg-purple-50 rounded-[24px] flex items-center justify-center mr-4 text-[#111111] font-bold">
                                                <?= substr($apt['patient_name'], 0, 1) ?>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-[#111111]"><?= esc($apt['patient_name']) ?></h4>
                                                <p class="text-xs text-[#7b7b78] mt-1"><?= date('d M Y', strtotime($apt['appointment_date'])) ?> • <?= date('H:i', strtotime($apt['time_slot'])) ?> WIB</p>
                                            </div>
                                        </div>
                                        <span class="bg-[#f5f1ec] text-[#626260] text-xs px-3 py-1 rounded-full font-medium italic">Menunggu</span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Completed Section -->
                    <div>
                        <h3 class="font-bold text-[#111111] mb-4 flex items-center">
                            <span class="w-2 h-2 bg-[#4CAF50] rounded-full mr-2"></span>
                            Selesai / Riwayat
                        </h3>
                        <?php if (empty($completed_appointments)): ?>
                            <div class="bg-[#ffffff] rounded-[24px] p-6 text-center border border-dashed border-gray-300">
                                <p class="text-[#7b7b78] text-sm">Belum ada riwayat konsultasi.</p>
                            </div>
                        <?php else: ?>
                            <div class="space-y-4">
                                <?php foreach ($completed_appointments as $apt): ?>
                                    <div class="bg-[#ffffff] rounded-[24px] p-4 border border-[#d3cec6] flex items-center justify-between opacity-80 card-hover">
                                        <div class="flex items-center">
                                            <div class="w-14 h-14 bg-green-50 rounded-[24px] flex items-center justify-center mr-4 text-[#111111] font-bold">
                                                <?= substr($apt['patient_name'], 0, 1) ?>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-[#111111]"><?= esc($apt['patient_name']) ?></h4>
                                                <p class="text-xs text-[#7b7b78] mt-1"><?= date('d M Y', strtotime($apt['appointment_date'])) ?> • <?= date('H:i', strtotime($apt['time_slot'])) ?> WIB</p>
                                            </div>
                                        </div>
                                        <button onclick="window.location.href='<?= base_url('doctor/historyDetail?id=' . $apt['id']) ?>'" class="text-sm font-semibold text-blue-600 hover:text-blue-800">Lihat Detail →</button>
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
