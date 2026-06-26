<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="prescription-screen" class="flex flex-col h-full bg-[#f5f1ec] fade-in">

    <div class="flex-1 overflow-y-auto pb-20 md:pb-6">

        <!-- Header -->
        <div class="bg-[#ffffff] px-5 py-4 border-b border-[#d3cec6] flex items-center sticky top-0 z-10 ">
            <button onclick="window.location.href='<?= base_url('patient') ?>'"
                class="p-2 -ml-1 rounded-[16px] hover:bg-[#f5f1ec] transition-all mr-2">
                <svg class="w-5 h-5 text-[#626260]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <h1 class="text-base font-bold text-[#111111]">Resep & Obat</h1>
        </div>

        <div class="p-5 max-w-2xl mx-auto">

            <?php if (empty($prescriptions)): ?>
                <div class="bg-[#ffffff] rounded-[24px] p-10 text-center border border-dashed border-gray-300">
                    <div class="w-16 h-16 bg-[#f5f1ec] rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-[#7b7b78]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                    </div>
                    <p class="text-[#626260] font-medium">Belum ada resep obat.</p>
                    <p class="text-[#7b7b78] text-xs mt-1">Resep akan muncul setelah Anda menyelesaikan sesi konsultasi dengan dokter.</p>
                </div>
            <?php else: ?>
                <?php foreach ($prescriptions as $p): ?>
                    <!-- Prescription Card -->
                    <div class="bg-[#ffffff] rounded-[24px]  overflow-hidden mb-6">
                        <!-- Card Header -->
                        <div class="p-4 border-b border-gray-50">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-bold <?= $p['status'] == 'issued' ? 'text-[#111111] bg-[#ebe7e1]' : 'text-[#111111] bg-green-50' ?> px-3 py-1 rounded-full">
                                    <?= $p['status'] == 'issued' ? 'Aktif' : 'Selesai' ?>
                                </span>
                                <span class="text-xs text-[#7b7b78]"><?= date('d M Y', strtotime($p['created_at'])) ?></span>
                            </div>
                            <h4 class="font-bold text-[#111111] text-sm">Resep dari <?= esc($p['doctor_name']) ?></h4>
                            <p class="text-xs text-[#626260] mt-0.5">Diagnosis: <?= esc($p['diagnosis'] ?? 'Konsultasi Umum') ?></p>
                        </div>

                        <!-- Medicine List -->
                        <div class="divide-y divide-gray-50">
                            <?php foreach ($p['items'] as $item): ?>
                                <div class="p-4 flex items-center">
                                    <div class="w-11 h-11 bg-[#ebe7e1] rounded-[16px] flex items-center justify-center mr-3 flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#111111]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h5 class="font-semibold text-[#111111] text-sm"><?= esc($item['medicine_name']) ?> <?= esc($item['dosage']) ?></h5>
                                        <p class="text-xs text-[#7b7b78]"><?= esc($item['frequency']) ?> • <?= esc($item['duration']) ?></p>
                                    </div>
                                    <span class="text-sm font-bold text-gray-700"><?= esc($item['quantity']) ?> unit</span>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <?php if ($p['notes']): ?>
                            <div class="p-4 bg-[#f5f1ec] border-t border-gray-50">
                                <p class="text-xs text-[#111111]"><span class="font-bold">Catatan:</span> <?= esc($p['notes']) ?></p>
                            </div>
                        <?php endif; ?>

                        <div class="p-4 bg-[#f5f1ec] border-t border-gray-50 flex justify-between items-center">
                            <div>
                                <p class="text-xs text-[#7b7b78] mb-0.5">Total Harga Obat</p>
                                <p class="font-bold text-[#111111] text-sm">Rp <?= number_format($p['total_cost'], 0, ',', '.') ?></p>
                            </div>
                            <?php if ($p['status'] == 'issued'): ?>
                            <form action="<?= base_url('patient/checkout_prescription') ?>" method="POST" class="w-1/2">
                                <input type="hidden" name="prescription_id" value="<?= $p['id'] ?>">
                                <button type="submit" class="w-full btn-primary text-white py-2.5 rounded-[12px] font-bold text-sm shadow-sm">
                                    Tebus Obat
                                </button>
                            </form>
                            <?php elseif ($p['status'] == 'redeemed'): ?>
                            <div class="w-1/2 text-right">
                                <span class="bg-blue-100 text-blue-700 font-bold text-xs px-4 py-2 rounded-[12px]">Menunggu Apotek</span>
                            </div>
                            <?php elseif ($p['status'] == 'preparing'): ?>
                            <div class="w-1/2 text-right">
                                <span class="bg-yellow-100 text-yellow-700 font-bold text-xs px-4 py-2 rounded-[12px]">Sedang Disiapkan</span>
                            </div>
                            <?php elseif ($p['status'] == 'ready'): ?>
                            <div class="w-1/2 text-right">
                                <span class="bg-green-100 text-green-700 font-bold text-xs px-4 py-2 rounded-[12px]">Siap Diambil!</span>
                            </div>
                            <?php elseif ($p['status'] == 'completed'): ?>
                            <div class="w-1/2 text-right">
                                <span class="bg-gray-100 text-gray-700 font-bold text-xs px-4 py-2 rounded-[12px]">Selesai</span>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>

</div>
<?= $this->include('components/bottom_nav') ?>
<?= $this->endSection() ?>
