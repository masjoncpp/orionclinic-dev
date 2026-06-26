<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<div class="h-full bg-[#f5f1ec] overflow-y-auto fade-in flex flex-col">
    <!-- Header -->
    <div class="bg-[#ffffff] px-4 py-4 border-b border-[#d3cec6] sticky top-0 z-10 flex items-center justify-between">
        <div class="flex items-center">
            <button onclick="window.history.back()" class="p-2 -ml-2 rounded-full hover:bg-gray-100 transition-colors mr-2">
                <svg class="w-6 h-6 text-[#111111]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            <h1 class="text-lg font-bold text-[#111111]">Invoice</h1>
        </div>
        <button onclick="downloadPDF()" class="text-sm font-bold text-[#003E7E] flex items-center bg-blue-50 px-3 py-1.5 rounded-lg hover:bg-blue-100 transition-colors">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
            PDF
        </button>
    </div>

    <div class="p-5 max-w-lg mx-auto pb-24 w-full">
        <!-- Invoice Document Area -->
        <div id="invoice-doc" class="bg-[#ffffff] rounded-[16px] p-6 shadow-sm border border-gray-100">
            
            <!-- Clinic Header -->
            <div class="flex justify-between items-center border-b border-gray-100 pb-4 mb-4">
                <div>
                    <h2 class="text-xl font-extrabold text-[#003E7E] tracking-tight">ORION CLINIC</h2>
                    <p class="text-xs text-[#7b7b78] mt-1">Jl. Imam Bonjol No.123 Semarang Barat,<br>Kota Semarang.</p>
                    <p class="text-xs text-[#7b7b78]">Telp: (021) 555-0123</p>
                </div>
                <div class="w-16 h-16">
                    <img src="<?= base_url('assets/img/logoorion.png') ?>" alt="Orion Clinic Logo" class="w-full h-full object-contain">
                </div>
            </div>

            <!-- Invoice Meta -->
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h3 class="text-xs font-bold text-[#626260] uppercase tracking-wider mb-1">DITAGIHKAN KEPADA</h3>
                    <p class="text-sm font-bold text-[#111111]"><?= esc($patient['patient_name']) ?></p>
                    <p class="text-xs text-[#7b7b78] mt-0.5">Pasien Orion Clinic</p>
                </div>
                <div class="text-right">
                    <h3 class="text-xs font-bold text-[#626260] uppercase tracking-wider mb-1">INVOICE NO.</h3>
                    <p class="text-sm font-bold text-[#111111]">INV-<?= str_pad($payment['id'], 5, '0', STR_PAD_LEFT) ?></p>
                    <p class="text-xs text-[#7b7b78] mt-0.5"><?= date('d M Y', strtotime($payment['payment_date'] ?? $payment['created_at'])) ?></p>
                </div>
            </div>

            <!-- Invoice Details -->
            <div class="mb-6">
                <h3 class="text-xs font-bold text-[#626260] uppercase tracking-wider mb-2 border-b border-gray-100 pb-2">Rincian Transaksi</h3>
                
                <?php if ($payment['type'] == 'prescription'): ?>
                    <div class="flex justify-between items-center py-2 text-sm border-b border-gray-50 mb-2">
                        <div>
                            <p class="font-bold text-[#111111]">Tebus Obat Resep</p>
                            <p class="text-xs text-[#7b7b78] mt-0.5"><?= esc($payment['doctor_name']) ?> (<?= esc($payment['specialization']) ?>)</p>
                        </div>
                    </div>
                    <?php if (!empty($prescriptionItems)): ?>
                        <div class="pl-4 mb-2 space-y-1 border-l-2 border-gray-100">
                            <p class="text-xs font-bold text-[#626260] mb-1">Daftar Obat:</p>
                            <?php foreach ($prescriptionItems as $item): ?>
                                <div class="flex justify-between text-xs">
                                    <span class="text-[#111111]">- <?= esc($item['medicine_name']) ?> (<?= esc($item['quantity']) ?> unit)</span>
                                    <span class="text-[#7b7b78]">Rp <?= number_format($item['quantity'] * 15000, 0, ',', '.') ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="flex justify-between items-center py-2 text-sm">
                        <div>
                            <p class="font-bold text-[#111111]">Konsultasi Dokter</p>
                            <p class="text-xs text-[#7b7b78] mt-0.5"><?= esc($payment['doctor_name']) ?> (<?= esc($payment['specialization']) ?>)</p>
                        </div>
                        <span class="font-medium text-[#111111]">Rp <?= number_format($payment['amount'], 0, ',', '.') ?></span>
                    </div>
                    <div class="flex justify-between items-center py-2 text-sm">
                        <p class="text-[#626260]">Biaya Admin</p>
                        <span class="font-medium text-[#111111]">Rp 2.500</span>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Total -->
            <div class="border-t border-gray-100 pt-4 mb-6">
                <div class="flex justify-between items-center">
                    <span class="font-bold text-[#111111]">Total Pembayaran</span>
                    <?php $total = $payment['amount'] + ($payment['type'] == 'consultation' ? 2500 : 0); ?>
                    <span class="font-extrabold text-xl text-[#003E7E]">Rp <?= number_format($total, 0, ',', '.') ?></span>
                </div>
            </div>

            <!-- Status -->
            <div class="bg-gray-50 rounded-[12px] p-4 text-center">
                <p class="text-xs text-[#7b7b78] mb-1">Status Pembayaran</p>
                <div class="inline-block">
                    <?php if ($payment['status'] == 'paid'): ?>
                        <span class="text-sm font-bold text-green-600 flex items-center justify-center">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            LUNAS
                        </span>
                    <?php else: ?>
                        <span class="text-sm font-bold text-red-600 flex items-center justify-center">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            GAGAL
                        </span>
                    <?php endif; ?>
                </div>
                <p class="text-[10px] text-[#7b7b78] mt-2">Metode: <?= strtoupper(str_replace('_', ' ', $payment['payment_method'])) ?></p>
            </div>
            
            <div class="mt-8 text-center text-[10px] text-gray-400">
                <p>Terima kasih telah mempercayakan layanan kesehatan Anda di Orion Clinic.</p>
                <p>Dokumen ini adalah bukti pembayaran yang sah.</p>
            </div>
        </div>
    </div>
</div>

<script>
function downloadPDF() {
    const element = document.getElementById('invoice-doc');
    const opt = {
        margin:       0.5,
        filename:     'Invoice_OrionClinic_INV-<?= str_pad($payment['id'], 5, '0', STR_PAD_LEFT) ?>.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
    };

    // New Promise-based usage:
    html2pdf().set(opt).from(element).save();
}
</script>

<?= $this->endSection() ?>
