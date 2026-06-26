<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="h-full flex flex-col bg-[#f5f1ec] overflow-hidden fade-in">
    <header class="bg-[#ffffff] px-6 py-4 flex items-center justify-between border-b border-[#d3cec6] sticky top-0 z-10">
        <div class="flex items-center space-x-4">
            <a href="<?= base_url('admin') ?>" class="text-[#7b7b78] hover:text-[#111111] transition-colors">
                <?= icon('arrow-left', 24) ?>
            </a>
            <div>
                <h1 class="text-xl font-bold text-[#111111]">Laporan Keuangan</h1>
                <p class="text-sm text-[#7b7b78] mt-1">Riwayat semua transaksi pembayaran</p>
            </div>
        </div>
    </header>

    <div class="flex-1 overflow-y-auto p-6">
        <div class="max-w-6xl mx-auto">
            <div class="bg-white rounded-[32px] shadow-sm border border-[#ebe7e1] overflow-hidden">
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
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php foreach($transactions as $tx): ?>
                                <tr class="hover:bg-[#f9f8f6] transition-colors">
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
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
