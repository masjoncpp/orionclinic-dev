<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="history-detail-screen" class="flex flex-col h-full bg-[#f5f1ec] fade-in">
    <!-- Header -->
    <div class="bg-[#ffffff] px-4 py-3 border-b border-[#d3cec6] flex items-center justify-between sticky top-0 z-10 ">
        <div class="flex items-center">
            <button onclick="window.location.href='<?= base_url('patient/history') ?>'"
                class="p-2 -ml-1 rounded-[16px] hover:bg-[#f5f1ec] transition-all mr-2">
                <svg class="w-5 h-5 text-[#626260]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <h1 class="text-base font-bold text-[#111111]">Detail Riwayat</h1>
        </div>
        <button class="p-2 bg-blue-50 text-blue-600 rounded-[12px] hover:bg-blue-100 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
        </button>
    </div>

    <div class="flex-1 overflow-y-auto p-5 pb-20 max-w-2xl mx-auto w-full">
        <!-- Consultation Info -->
        <div class="bg-[#ffffff] rounded-[24px] p-5 border border-gray-50 mb-4 slide-up">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h2 class="text-lg font-bold text-[#111111] mb-1"><?= esc($appointment['doctor_name']) ?></h2>
                    <p class="text-sm text-[#626260]"><?= esc($appointment['specialization']) ?></p>
                </div>
                <?php 
                    $colorClass = 'bg-[#003E7E]';
                    if ($appointment['status'] == 'cancelled') $colorClass = 'bg-[#E53935]';
                    if ($appointment['status'] == 'completed') $colorClass = 'bg-[#4CAF50]';
                ?>
                <span class="text-xs font-bold <?= str_replace('bg-', 'text-', $colorClass) ?> <?= str_replace('bg-', 'bg-', $colorClass) ?>/10 px-3 py-1.5 rounded-full capitalize">
                    <?= $appointment['status'] ?>
                </span>
            </div>
            
            <div class="grid grid-cols-2 gap-4 pt-4 border-t border-gray-100">
                <div>
                    <p class="text-xs text-[#7b7b78] mb-1">Tanggal</p>
                    <p class="text-sm font-semibold text-[#111111]"><?= date('d F Y', strtotime($appointment['appointment_date'])) ?></p>
                </div>
                <div>
                    <p class="text-xs text-[#7b7b78] mb-1">Waktu</p>
                    <p class="text-sm font-semibold text-[#111111]"><?= date('H:i', strtotime($appointment['time_slot'])) ?> WIB</p>
                </div>
                <div class="col-span-2">
                    <p class="text-xs text-[#7b7b78] mb-1">Keluhan Utama</p>
                    <p class="text-sm font-medium text-[#111111]"><?= esc($appointment['reason']) ?></p>
                </div>
            </div>
        </div>

        <?php if ($consultation && $consultation['diagnosis']): ?>
        <!-- Clinical Notes -->
        <div class="bg-[#ffffff] rounded-[24px] p-5 border border-gray-50 mb-4 slide-up slide-up-delay-1">
            <h3 class="font-bold text-[#111111] text-base mb-4 flex items-center">
                <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                </div>
                Catatan Medis
            </h3>
            
            <div class="space-y-4">
                <div>
                    <h4 class="text-xs font-semibold text-[#7b7b78] uppercase tracking-wider mb-2">Diagnosis</h4>
                    <div class="p-3 bg-[#f9f8f6] rounded-[16px] border border-[#ebe7e1]">
                        <p class="text-sm text-[#111111]"><?= esc($consultation['diagnosis']) ?></p>
                    </div>
                </div>
                <?php if (!empty($consultation['doctor_notes'])): ?>
                <div>
                    <h4 class="text-xs font-semibold text-[#7b7b78] uppercase tracking-wider mb-2">Catatan Dokter</h4>
                    <div class="p-3 bg-[#f9f8f6] rounded-[16px] border border-[#ebe7e1]">
                        <p class="text-sm text-[#111111] leading-relaxed"><?= nl2br(esc($consultation['doctor_notes'])) ?></p>
                    </div>
                </div>
                <?php endif; ?>
                <?php if (!empty($consultation['follow_up'])): ?>
                <div>
                    <h4 class="text-xs font-semibold text-[#7b7b78] uppercase tracking-wider mb-2">Tindak Lanjut</h4>
                    <div class="p-3 bg-blue-50/50 rounded-[16px] border border-blue-100">
                        <p class="text-sm text-[#111111] leading-relaxed"><?= nl2br(esc($consultation['follow_up'])) ?></p>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($prescriptionItems)): ?>
        <!-- Prescription -->
        <div class="bg-[#ffffff] rounded-[24px] p-5 border border-gray-50 mb-4 slide-up slide-up-delay-2">
            <h3 class="font-bold text-[#111111] text-base mb-4 flex items-center">
                <div class="w-8 h-8 bg-green-50 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                Resep Obat
            </h3>
            
            <div class="space-y-3">
                <?php foreach ($prescriptionItems as $item): ?>
                <div class="flex items-start p-3 bg-[#f9f8f6] rounded-[16px] border border-[#ebe7e1]">
                    <div class="w-10 h-10 bg-[#ffffff] rounded-[12px] flex items-center justify-center mr-3 shadow-sm flex-shrink-0">
                        <svg class="w-5 h-5 text-[#003E7E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-[#111111] text-sm"><?= esc($item['medicine_name']) ?></h4>
                        <div class="flex mt-1 text-xs text-[#626260] space-x-3">
                            <span class="flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>
                                <?= esc($item['dosage']) ?>
                            </span>
                            <span class="flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <?= esc($item['frequency']) ?>
                            </span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Action Buttons -->
        <div class="grid grid-cols-2 gap-3 mt-6">
            <?php if ($appointment['status'] !== 'cancelled'): ?>
            <button onclick="window.location.href='<?= base_url('patient/chat?id=' . $appointment['id']) ?>'" class="py-3.5 bg-[#ffffff] text-[#111111] border border-[#d3cec6] rounded-[16px] text-sm font-bold hover:bg-gray-50 transition-all text-center">
                Lihat Chat
            </button>
            <?php endif; ?>
            
            <?php if (in_array($appointment['status'], ['unpaid', 'pending', 'confirmed'])): ?>
                <button onclick="document.getElementById('reschedule-modal').classList.remove('hidden')" class="py-3.5 bg-[#003E7E] text-white rounded-[16px] text-sm font-bold hover:bg-[#002855] transition-all shadow-sm">
                    Jadwalkan Ulang
                </button>
                <form action="<?= base_url('patient/cancel_appointment') ?>" method="POST" class="col-span-2 mt-2" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan janji temu ini?');">
                    <input type="hidden" name="appointment_id" value="<?= $appointment['id'] ?>">
                    <button type="submit" class="w-full py-3.5 bg-[#ffffff] text-[#E53935] border border-red-100 rounded-[16px] text-sm font-bold hover:bg-red-50 transition-all text-center">
                        Batalkan Janji Temu
                    </button>
                </form>
            <?php elseif ($appointment['status'] == 'cancelled'): ?>
                <button onclick="window.location.href='<?= base_url('patient/consultation') ?>'" class="py-3.5 bg-[#003E7E] text-white rounded-[16px] text-sm font-bold hover:bg-[#002855] transition-all col-span-2 shadow-sm">
                    Buat Janji Baru
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal Jadwal Ulang -->
<div id="reschedule-modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50" onclick="document.getElementById('reschedule-modal').classList.add('hidden')"></div>
    <div class="absolute bottom-0 left-0 right-0 bg-[#ffffff] rounded-t-[32px] p-6 slide-up-fast">
        <div class="w-12 h-1.5 bg-[#ebe7e1] rounded-full mx-auto mb-6"></div>
        <h3 class="font-bold text-lg text-[#111111] mb-4">Jadwalkan Ulang Janji Temu</h3>
        <form action="<?= base_url('patient/reschedule_appointment') ?>" method="POST" class="space-y-4">
            <input type="hidden" name="appointment_id" value="<?= $appointment['id'] ?>">
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-[#111111] mb-2">Tanggal Baru</label>
                    <input type="date" name="appointment_date" required min="<?= date('Y-m-d') ?>" value="<?= $appointment['appointment_date'] ?>"
                        class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-sm focus:outline-none focus:border-[#003E7E]">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[#111111] mb-2">Waktu Baru</label>
                    <input type="text" name="time_slot" required placeholder="Misal: 14:30" pattern="^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$" maxlength="5" value="<?= date('H:i', strtotime($appointment['time_slot'])) ?>"
                        class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-sm focus:outline-none focus:border-[#003E7E]">
                </div>
            </div>
            
            <button type="submit" class="w-full bg-[#003E7E] hover:bg-[#002a5c] transition-colors text-white py-4 rounded-[16px] font-bold mt-4 shadow-sm">Simpan Jadwal Baru</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
