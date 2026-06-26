<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="history-screen" class="flex flex-col h-full bg-[#f5f1ec] fade-in">

    <div class="flex-1 overflow-y-auto pb-20 md:pb-6">

        <!-- Header -->
        <div class="bg-[#ffffff] px-5 py-4 border-b border-[#d3cec6] flex items-center sticky top-0 z-10 ">
            <button onclick="window.location.href='<?= base_url('patient') ?>'"
                class="p-2 -ml-1 rounded-[16px] hover:bg-[#f5f1ec] transition-all mr-2">
                <svg class="w-5 h-5 text-[#626260]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <h1 class="text-base font-bold text-[#111111]">Riwayat Kesehatan</h1>
        </div>

        <!-- Filter Tabs -->
        <div class="bg-[#ffffff] px-5 border-b border-[#d3cec6]">
            <div class="flex space-x-6">
                <button class="py-3 text-sm font-bold text-[#111111] border-b-2 border-blue-600">Semua</button>
                <button class="py-3 text-sm font-medium text-[#7b7b78] hover:text-[#626260] transition-colors">Konsultasi</button>
                <button class="py-3 text-sm font-medium text-[#7b7b78] hover:text-[#626260] transition-colors">Resep</button>
            </div>
        </div>

        <div class="p-5 max-w-2xl mx-auto">

            <!-- Timeline -->
            <div class="relative">
                <div class="absolute left-5 top-0 bottom-0 w-0.5 bg-gray-200"></div>

                <?php if (empty($history)): ?>
                    <div class="bg-[#ffffff] rounded-[24px] p-10 text-center border border-dashed border-gray-300 ml-12">
                        <p class="text-[#7b7b78]">Belum ada riwayat kesehatan.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($history as $h): ?>
                        <!-- History Item -->
                        <div class="relative pl-12 pb-6">
                            <?php 
                                $colorClass = 'bg-[#003E7E]'; // pending
                                if ($h['status'] == 'unpaid') $colorClass = 'bg-[#FF9800]';
                                if ($h['status'] == 'cancelled') $colorClass = 'bg-[#E53935]';
                                if ($h['status'] == 'completed') $colorClass = 'bg-[#4CAF50]';
                            ?>
                            <div class="absolute left-3.5 w-4 h-4 <?= $colorClass ?> rounded-full border-2 border-white "></div>
                            <div class="bg-[#ffffff] rounded-[24px] p-4  card-hover cursor-pointer">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-bold <?= str_replace('bg-', 'text-', $colorClass) ?> <?= str_replace('bg-', 'bg-', $colorClass) ?>/10 px-2.5 py-1 rounded-full capitalize"><?= $h['status'] ?></span>
                                    <span class="text-xs text-[#7b7b78]"><?= date('d M Y', strtotime($h['appointment_date'])) ?></span>
                                </div>
                                <h4 class="font-bold text-[#111111] text-sm"><?= esc($h['doctor_name']) ?></h4>
                                <p class="text-xs text-[#626260] mt-1"><?= esc($h['reason']) ?></p>
                                <?php if ($h['diagnosis']): ?>
                                    <p class="text-xs text-[#7b7b78] mt-1">Diagnosis: <?= esc($h['diagnosis']) ?></p>
                                <?php endif; ?>
                                <?php if ($h['status'] == 'unpaid' && $h['payment_id']): ?>
                                    <button onclick="window.location.href='<?= base_url('patient/payment?id=' . $h['payment_id']) ?>'" class="mt-3 text-xs text-orange-600 font-bold hover:text-orange-800 transition-colors">Bayar Sekarang →</button>
                                <?php else: ?>
                                    <button onclick="window.location.href='<?= base_url('patient/historyDetail?id=' . $h['id']) ?>'" class="mt-3 text-xs text-blue-600 font-bold hover:text-blue-800 transition-colors">Lihat Detail →</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>

</div>
<?= $this->include('components/bottom_nav') ?>
<?= $this->endSection() ?>
