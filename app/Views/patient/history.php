<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="history-screen" class="flex flex-col h-full bg-gray-50 fade-in">

    <div class="flex-1 overflow-y-auto pb-20 md:pb-6">

        <!-- Header -->
        <div class="bg-white px-5 py-4 border-b border-gray-100 flex items-center sticky top-0 z-10 shadow-sm">
            <button onclick="window.location.href='<?= base_url('patient') ?>'"
                class="p-2 -ml-1 rounded-xl hover:bg-gray-100 transition-all mr-2">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <h1 class="text-base font-bold text-gray-800">Riwayat Kesehatan</h1>
        </div>

        <!-- Filter Tabs -->
        <div class="bg-white px-5 border-b border-gray-100">
            <div class="flex space-x-6">
                <button class="py-3 text-sm font-bold text-blue-600 border-b-2 border-blue-600">Semua</button>
                <button class="py-3 text-sm font-medium text-gray-400 hover:text-gray-600 transition-colors">Konsultasi</button>
                <button class="py-3 text-sm font-medium text-gray-400 hover:text-gray-600 transition-colors">Resep</button>
            </div>
        </div>

        <div class="p-5 max-w-2xl mx-auto">

            <!-- Timeline -->
            <div class="relative">
                <div class="absolute left-5 top-0 bottom-0 w-0.5 bg-gray-200"></div>

                <?php if (empty($history)): ?>
                    <div class="bg-white rounded-2xl p-10 text-center border border-dashed border-gray-300 ml-12">
                        <p class="text-gray-400">Belum ada riwayat kesehatan.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($history as $h): ?>
                        <!-- History Item -->
                        <div class="relative pl-12 pb-6">
                            <?php 
                                $colorClass = 'bg-blue-600';
                                if ($h['status'] == 'cancelled') $colorClass = 'bg-red-600';
                                if ($h['status'] == 'completed') $colorClass = 'bg-green-600';
                            ?>
                            <div class="absolute left-3.5 w-4 h-4 <?= $colorClass ?> rounded-full border-2 border-white shadow-md"></div>
                            <div class="bg-white rounded-2xl p-4 shadow-sm card-hover cursor-pointer">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-bold <?= str_replace('bg-', 'text-', $colorClass) ?> <?= str_replace('bg-', 'bg-', $colorClass) ?>/10 px-2.5 py-1 rounded-full capitalize"><?= $h['status'] ?></span>
                                    <span class="text-xs text-gray-400"><?= date('d M Y', strtotime($h['appointment_date'])) ?></span>
                                </div>
                                <h4 class="font-bold text-gray-800 text-sm"><?= esc($h['doctor_name']) ?></h4>
                                <p class="text-xs text-gray-500 mt-1"><?= esc($h['reason']) ?></p>
                                <?php if ($h['diagnosis']): ?>
                                    <p class="text-xs text-gray-400 mt-1">Diagnosis: <?= esc($h['diagnosis']) ?></p>
                                <?php endif; ?>
                                <button class="mt-3 text-xs text-blue-600 font-semibold hover:text-blue-700">Lihat Detail →</button>
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
