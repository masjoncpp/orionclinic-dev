<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="patient-history-screen" class="flex flex-col h-full bg-[#f5f1ec] fade-in w-full">
    <!-- Header -->
    <div class="bg-[#ffffff] px-4 py-3 border-b border-[#d3cec6] flex items-center justify-between sticky top-0 z-10 ">
        <div class="flex items-center">
            <button onclick="window.location.href='<?= base_url('doctor/patients') ?>'"
                class="p-2 -ml-1 rounded-[16px] hover:bg-[#f5f1ec] transition-all mr-2">
                <svg class="w-5 h-5 text-[#626260]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <h1 class="text-base font-bold text-[#111111]">Riwayat Medis Pasien</h1>
        </div>
    </div>

    <div class="flex-1 overflow-y-auto p-5 pb-20 mx-auto w-full max-w-4xl">
        <!-- Patient Info Card -->
        <div class="bg-[#ffffff] rounded-[24px] p-5 border border-gray-50 mb-6 slide-up">
            <div class="flex items-center mb-4">
                <div class="w-16 h-16 <?= $patient['gender'] == 'female' ? 'bg-pink-100 text-pink-600' : 'bg-[#ebe7e1] text-[#111111]' ?> rounded-[20px] flex items-center justify-center mr-4 text-xl font-bold">
                    <?php 
                        $pName = $patient['name'] ?? 'Patient';
                        $pInitials = substr($pName, 0, 1);
                        $pLastSpace = strrpos($pName, ' ');
                        if ($pLastSpace !== false) {
                            $pInitials .= substr($pName, $pLastSpace + 1, 1);
                        }
                        echo esc(strtoupper($pInitials));
                    ?>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-[#111111] mb-1"><?= esc($patient['name']) ?></h2>
                    <p class="text-sm text-[#626260] capitalize"><?= $patient['gender'] == 'female' ? 'Perempuan' : 'Laki-laki' ?><?= $patient['date_of_birth'] ? ', ' . date_diff(date_create($patient['date_of_birth']), date_create('today'))->y . ' Tahun' : '' ?></p>
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-4 pt-4 border-t border-gray-100">
                <div>
                    <p class="text-xs text-[#7b7b78] mb-1">Email</p>
                    <p class="text-sm font-semibold text-[#111111]"><?= esc($patient['email']) ?></p>
                </div>
                <div>
                    <p class="text-xs text-[#7b7b78] mb-1">No. HP</p>
                    <p class="text-sm font-semibold text-[#111111]"><?= esc($patient['phone']) ?></p>
                </div>
                <?php if ($patient['allergies']): ?>
                <div class="col-span-2">
                    <p class="text-xs text-[#7b7b78] mb-1">Alergi</p>
                    <p class="text-sm font-medium text-red-600 bg-red-50 p-2 rounded-lg"><?= esc($patient['allergies']) ?></p>
                </div>
                <?php endif; ?>
                <?php if ($patient['pre_existing_conditions']): ?>
                <div class="col-span-2">
                    <p class="text-xs text-[#7b7b78] mb-1">Kondisi Medis Sebelumnya</p>
                    <p class="text-sm font-medium text-[#111111] bg-[#f9f8f6] p-2 rounded-lg"><?= esc($patient['pre_existing_conditions']) ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <h3 class="font-bold text-[#111111] mb-4 flex items-center slide-up slide-up-delay-1">
            <span class="w-2 h-2 bg-[#4CAF50] rounded-full mr-2"></span>
            Riwayat Kunjungan
        </h3>

        <?php if (empty($history)): ?>
            <div class="bg-[#ffffff] rounded-[24px] p-8 text-center border border-dashed border-gray-300 slide-up slide-up-delay-2">
                <p class="text-[#7b7b78]">Belum ada riwayat konsultasi medis yang selesai dengan Anda.</p>
            </div>
        <?php else: ?>
            <div class="space-y-4">
                <?php foreach ($history as $index => $h): ?>
                    <div class="bg-[#ffffff] rounded-[24px] p-5 border border-[#d3cec6] flex flex-col card-hover slide-up" style="animation-delay: <?= 0.1 * ($index + 2) ?>s">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <p class="text-sm font-bold text-[#111111]"><?= date('d M Y', strtotime($h['appointment_date'])) ?></p>
                                <p class="text-xs text-[#626260] mt-0.5"><?= date('H:i', strtotime($h['time_slot'])) ?> WIB</p>
                            </div>
                            <span class="text-[10px] font-bold text-[#003E7E] bg-[#003E7E]/10 px-2.5 py-1 rounded-full uppercase tracking-wider">Selesai</span>
                        </div>
                        
                        <div class="bg-[#f9f8f6] p-3 rounded-[16px] border border-[#ebe7e1] mb-4">
                            <p class="text-xs text-[#7b7b78] mb-1">Keluhan Utama:</p>
                            <p class="text-sm font-medium text-[#111111]"><?= esc($h['reason']) ?></p>
                            
                            <?php if ($h['diagnosis']): ?>
                                <p class="text-xs text-[#7b7b78] mt-3 mb-1">Diagnosis Anda:</p>
                                <p class="text-sm font-medium text-[#111111]"><?= esc($h['diagnosis']) ?></p>
                            <?php endif; ?>
                        </div>

                        <button onclick="window.location.href='<?= base_url('doctor/historyDetail?id=' . $h['id']) ?>'" class="text-sm text-center py-2.5 w-full bg-blue-50 text-blue-600 rounded-[12px] font-bold hover:bg-blue-100 transition-colors">
                            Lihat Detail Konsultasi
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</div>
<?= $this->endSection() ?>
