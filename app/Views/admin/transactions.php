<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="h-full flex flex-col bg-[#f5f1ec] overflow-hidden fade-in">
    <header class="bg-[#ffffff] px-6 py-4 flex items-center justify-between border-b border-[#d3cec6] sticky top-0 z-10 no-print">
        <div class="flex items-center space-x-4">
            <a href="<?= base_url('admin') ?>" class="text-[#7b7b78] hover:text-[#111111] transition-colors">
                <?= icon('arrow-left', 24) ?>
            </a>
            <div>
                <h1 class="text-xl font-bold text-[#111111]">Laporan Keuangan</h1>
                <p class="text-sm text-[#7b7b78] mt-1">Riwayat semua transaksi pembayaran</p>
            </div>
        </div>
        <button onclick="window.print()" class="flex items-center space-x-1.5 px-4 py-2 bg-[#f5f1ec] hover:bg-[#ebe7e1] rounded-[12px] text-[#003E7E] text-xs font-bold transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            <span>Cetak Laporan</span>
        </button>
    </header>

    <div class="flex-1 overflow-y-auto p-6">
        <div class="max-w-6xl mx-auto">
            <div class="bg-white rounded-[32px] shadow-sm border border-[#ebe7e1] overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 no-print">
                    <h3 class="font-bold text-[#111111]">Daftar Transaksi (<?= count($transactions) ?>)</h3>
                    <div class="relative w-full sm:w-72">
                        <input id="admin-tx-search" type="text" placeholder="Cari pasien, dokter, status..." class="w-full pl-9 pr-4 py-2 bg-[#f9f8f6] border border-[#d3cec6] rounded-[12px] text-xs text-[#111111] focus:outline-none focus:border-[#003E7E]">
                        <svg class="w-4 h-4 text-[#7b7b78] absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[800px]">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-xs uppercase tracking-wider text-[#7b7b78]">
                                <th class="py-4 px-6 font-semibold">Tanggal</th>
                                <th class="py-4 px-6 font-semibold">Pasien</th>
                                <th class="py-4 px-6 font-semibold">Dokter Terkait</th>
                                <th class="py-4 px-6 font-semibold">Tipe Transaksi</th>
                                <th class="py-4 px-6 font-semibold">Total</th>
                                <th class="py-4 px-6 font-semibold text-center">Status</th>
                                <th class="py-4 px-6 font-semibold text-right">Verifikasi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php foreach($transactions as $tx): ?>
                                <tr class="admin-tx-row hover:bg-[#f9f8f6] transition-colors">
                                    <td class="py-4 px-6 align-middle text-sm text-[#7b7b78]">
                                        <?= date('d M Y, H:i', strtotime($tx['created_at'])) ?>
                                    </td>
                                    <td class="py-4 px-6 align-middle font-bold text-sm text-[#111111]">
                                        <?= esc($tx['patient_name']) ?>
                                    </td>
                                    <td class="py-4 px-6 align-middle text-sm text-[#111111]">
                                        <?= esc($tx['doctor_name']) ?>
                                    </td>
                                    <td class="py-4 px-6 align-middle text-sm text-[#111111] capitalize">
                                        <?= esc($tx['type']) ?>
                                        <?php if (!empty($tx['bukti_transfer'])): ?>
                                            <a href="<?= base_url('uploads/payments/' . $tx['bukti_transfer']) ?>" target="_blank" class="block text-xs text-blue-600 underline mt-0.5">Lihat Bukti</a>
                                        <?php endif; ?>
                                    </td>
                                    <td class="py-4 px-6 align-middle font-bold text-sm text-[#003E7E]">
                                        Rp <?= number_format($tx['amount'], 0, ',', '.') ?>
                                    </td>
                                    <td class="py-4 px-6 align-middle text-center">
                                        <?php if($tx['status'] == 'paid'): ?>
                                            <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">Lunas</span>
                                        <?php elseif($tx['status'] == 'pending'): ?>
                                            <span class="bg-yellow-100 text-yellow-700 text-xs font-bold px-3 py-1 rounded-full">Pending</span>
                                        <?php else: ?>
                                            <span class="bg-red-100 text-red-700 text-xs font-bold px-3 py-1 rounded-full">Gagal</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="py-4 px-6 align-middle text-right">
                                        <?php if($tx['status'] == 'pending'): ?>
                                            <form action="<?= base_url('admin/transactions/verify') ?>" method="POST" class="inline-flex space-x-2">
                                                <input type="hidden" name="payment_id" value="<?= $tx['id'] ?>">
                                                <button type="submit" name="status" value="paid" class="bg-green-50 text-green-700 hover:bg-green-600 hover:text-white px-3 py-1.5 rounded-[10px] text-xs font-bold transition-all">Setujui</button>
                                                <button type="submit" name="status" value="failed" class="bg-red-50 text-red-600 hover:bg-red-600 hover:text-white px-3 py-1.5 rounded-[10px] text-xs font-bold transition-all">Tolak</button>
                                            </form>
                                        <?php else: ?>
                                            <span class="text-xs text-[#7b7b78]">-</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('admin-tx-search');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const q = this.value.trim().toLowerCase();
            document.querySelectorAll('.admin-tx-row').forEach(row => {
                row.classList.toggle('hidden', q && !row.textContent.toLowerCase().includes(q));
            });
        });
    }
});
</script>

<?= $this->endSection() ?>
