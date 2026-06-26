<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="flex flex-col h-full bg-[#f5f1ec] fade-in">
    <!-- Header -->
    <div class="bg-[#ffffff] px-5 py-4 border-b border-[#d3cec6] flex items-center sticky top-0 z-10 ">
        <button onclick="window.location.href='<?= base_url('patient/profile') ?>'"
            class="p-2 -ml-1 rounded-[16px] hover:bg-[#f5f1ec] transition-all mr-2">
            <svg class="w-5 h-5 text-[#626260]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        <h1 class="text-base font-bold text-[#111111]">Riwayat Pembayaran</h1>
    </div>

    <div class="p-5 max-w-2xl mx-auto flex-1 overflow-y-auto pb-24 w-full">
        <?php if (empty($payments)): ?>
            <div class="bg-[#ffffff] rounded-[24px] p-10 text-center border border-dashed border-gray-300">
                <p class="text-[#7b7b78]">Belum ada riwayat pembayaran.</p>
            </div>
        <?php else: ?>
            <?php foreach ($payments as $p): ?>
                <?php 
                    $colorClass = 'bg-[#FF9800]';
                    $textColor = 'text-[#FF9800]';
                    $bgLight = 'bg-orange-50';
                    $statusText = 'Menunggu';
                    
                    if ($p['status'] == 'paid') {
                        $colorClass = 'bg-[#4CAF50]';
                        $textColor = 'text-[#4CAF50]';
                        $bgLight = 'bg-green-50';
                        $statusText = 'Berhasil';
                    } elseif ($p['status'] == 'failed') {
                        $colorClass = 'bg-[#E53935]';
                        $textColor = 'text-[#E53935]';
                        $bgLight = 'bg-red-50';
                        $statusText = 'Gagal';
                    }
                ?>
                <div class="bg-[#ffffff] rounded-[20px] p-4 shadow-sm border border-gray-100 mb-4 cursor-pointer card-hover" 
                     onclick="window.location.href='<?= base_url($p['status'] == 'pending' ? 'patient/payment?id=' . $p['id'] : 'patient/invoice?id=' . $p['id']) ?>'">
                    
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-[12px] bg-[#f5f1ec] flex items-center justify-center">
                                <?php if ($p['type'] == 'prescription'): ?>
                                    <svg class="w-5 h-5 text-[#003E7E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                                <?php else: ?>
                                    <svg class="w-5 h-5 text-[#003E7E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                <?php endif; ?>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#111111] text-sm"><?= $p['type'] == 'prescription' ? 'Tebus Obat Resep' : 'Biaya Konsultasi' ?></h4>
                                <p class="text-xs text-[#7b7b78]"><?= date('d M Y, H:i', strtotime($p['created_at'])) ?></p>
                            </div>
                        </div>
                        <span class="text-xs font-bold <?= $textColor ?> <?= $bgLight ?> px-2.5 py-1 rounded-full"><?= $statusText ?></span>
                    </div>

                    <div class="flex justify-between items-end border-t border-gray-50 pt-3">
                        <div>
                            <p class="text-xs text-[#626260] mb-0.5"><?= esc($p['doctor_name']) ?></p>
                            <p class="font-bold text-[#111111]">Rp <?= number_format($p['amount'] + ($p['type'] == 'consultation' ? 2500 : 0), 0, ',', '.') ?></p>
                        </div>
                        <?php if ($p['status'] == 'pending'): ?>
                            <button class="text-xs font-bold text-white bg-orange-500 hover:bg-orange-600 px-4 py-2 rounded-[10px] transition-colors">Bayar</button>
                        <?php else: ?>
                            <button class="text-xs font-bold text-[#003E7E] bg-blue-50 hover:bg-blue-100 px-4 py-2 rounded-[10px] transition-colors">Lihat Invoice</button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<?= $this->include('components/bottom_nav') ?>
<?= $this->endSection() ?>
