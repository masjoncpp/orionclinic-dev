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
            <div class="flex space-x-6 overflow-x-auto scrollbar-hide">
                <button type="button" data-filter="all" class="history-tab py-3 text-sm font-bold text-[#003E7E] border-b-2 border-[#003E7E] whitespace-nowrap">Semua</button>
                <button type="button" data-filter="active" class="history-tab py-3 text-sm font-medium text-[#7b7b78] hover:text-[#111111] border-b-2 border-transparent transition-colors whitespace-nowrap">Berlangsung</button>
                <button type="button" data-filter="completed" class="history-tab py-3 text-sm font-medium text-[#7b7b78] hover:text-[#111111] border-b-2 border-transparent transition-colors whitespace-nowrap">Selesai</button>
                <button type="button" onclick="window.location.href='<?= base_url('patient/prescription') ?>'" class="py-3 text-sm font-medium text-[#7b7b78] hover:text-[#1BA098] border-b-2 border-transparent transition-colors whitespace-nowrap flex items-center">
                    Resep Obat
                    <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                </button>
            </div>
        </div>

        <div class="p-5 max-w-2xl mx-auto">

            <!-- Timeline -->
            <div class="relative" id="history-timeline">
                <div class="absolute left-5 top-0 bottom-0 w-0.5 bg-[#d3cec6]"></div>

                <?php if (empty($history)): ?>
                    <div class="bg-[#ffffff] rounded-[24px] p-10 text-center border border-dashed border-gray-300 ml-12">
                        <p class="text-[#7b7b78]">Belum ada riwayat kesehatan.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($history as $h): ?>
                        <?php 
                            $colorClass = 'bg-[#003E7E]';
                            $badgeClass = 'text-[#003E7E] bg-[#003E7E]/10';
                            $filterGroup = 'active';
                            if ($h['status'] == 'unpaid') {
                                $colorClass = 'bg-[#FF9800]';
                                $badgeClass = 'text-[#FF9800] bg-[#FF9800]/10';
                            } elseif ($h['status'] == 'cancelled') {
                                $colorClass = 'bg-[#E53935]';
                                $badgeClass = 'text-[#E53935] bg-[#E53935]/10';
                                $filterGroup = 'cancelled';
                            } elseif ($h['status'] == 'completed') {
                                $colorClass = 'bg-[#4CAF50]';
                                $badgeClass = 'text-[#4CAF50] bg-[#4CAF50]/10';
                                $filterGroup = 'completed';
                            }
                            $targetLink = ($h['status'] == 'unpaid' && $h['payment_id'])
                                ? base_url('patient/payment?id=' . $h['payment_id'])
                                : base_url('patient/historyDetail?id=' . $h['id']);
                        ?>
                        <!-- History Item -->
                        <div class="history-item relative pl-12 pb-6" data-group="<?= $filterGroup ?>">
                            <div class="absolute left-3.5 top-4 w-4 h-4 <?= $colorClass ?> rounded-full border-2 border-white shadow-sm"></div>
                            <div onclick="window.location.href='<?= $targetLink ?>'" class="bg-[#ffffff] rounded-[24px] p-4 border border-[#ebe7e1] card-hover cursor-pointer">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-bold <?= $badgeClass ?> px-2.5 py-1 rounded-full capitalize"><?= esc($h['status']) ?></span>
                                    <span class="text-xs text-[#7b7b78]"><?= date('d M Y', strtotime($h['appointment_date'])) ?> • <?= date('H:i', strtotime($h['time_slot'])) ?></span>
                                </div>
                                <h4 class="font-bold text-[#111111] text-sm"><?= esc($h['doctor_name']) ?></h4>
                                <p class="text-xs text-[#626260] mt-1"><?= esc($h['reason']) ?></p>
                                <?php if ($h['diagnosis']): ?>
                                    <p class="text-xs text-[#003E7E] font-medium mt-1.5 bg-[#f5f1ec] px-2.5 py-1 rounded-lg inline-block">Diagnosis: <?= esc($h['diagnosis']) ?></p>
                                <?php endif; ?>
                                <div class="mt-3 pt-2.5 border-t border-gray-50 flex justify-end">
                                    <?php if ($h['status'] == 'unpaid' && $h['payment_id']): ?>
                                        <span class="text-xs text-[#FF9800] font-bold">Bayar Sekarang →</span>
                                    <?php else: ?>
                                        <span class="text-xs text-[#003E7E] font-bold">Lihat Detail Rekam Medis →</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div id="history-empty-filter" class="hidden bg-[#ffffff] rounded-[24px] p-8 text-center border border-dashed border-[#d3cec6] ml-12">
                        <p class="text-sm text-[#7b7b78]">Tidak ada riwayat pada kategori ini.</p>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>

</div>
<script>
document.querySelectorAll('.history-tab').forEach(tab => {
    tab.addEventListener('click', function() {
        const filter = this.getAttribute('data-filter');
        document.querySelectorAll('.history-tab').forEach(t => {
            t.className = 'history-tab py-3 text-sm font-medium text-[#7b7b78] hover:text-[#111111] border-b-2 border-transparent transition-colors whitespace-nowrap';
        });
        this.className = 'history-tab py-3 text-sm font-bold text-[#003E7E] border-b-2 border-[#003E7E] whitespace-nowrap';

        let visible = 0;
        document.querySelectorAll('.history-item').forEach(item => {
            const match = (filter === 'all') || (item.getAttribute('data-group') === filter);
            item.classList.toggle('hidden', !match);
            if (match) visible++;
        });
        const emptyEl = document.getElementById('history-empty-filter');
        if (emptyEl) emptyEl.classList.toggle('hidden', visible > 0);
    });
});
</script>
<?= $this->include('components/bottom_nav') ?>
<?= $this->endSection() ?>
