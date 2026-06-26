<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="h-full flex flex-col bg-[#f5f1ec] overflow-hidden fade-in">
    <!-- Header -->
    <header class="bg-[#ffffff] px-6 py-4 flex items-center justify-between border-b border-[#d3cec6] sticky top-0 z-10">
        <div>
            <h1 class="text-xl font-bold text-[#111111]">Admin Dashboard</h1>
            <p class="text-sm text-[#7b7b78] mt-1">Ringkasan sistem Orion Clinic</p>
        </div>
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-3 border-r border-[#ebe7e1] pr-4">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-bold text-[#111111]"><?= esc(session()->get('name')) ?></p>
                    <p class="text-xs text-[#7b7b78]">Administrator</p>
                </div>
                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 font-bold text-sm">
                    <?= substr(session()->get('name'), 0, 1) ?>
                </div>
            </div>
            <a href="<?= base_url('logout') ?>" class="text-red-500 hover:text-red-700 font-bold text-sm bg-red-50 px-4 py-2 rounded-[12px] transition-colors">Logout</a>
        </div>
    </header>

    <div class="flex-1 overflow-y-auto p-6">
        <div class="max-w-6xl mx-auto space-y-6">
            
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white rounded-[24px] p-6 shadow-sm border border-[#ebe7e1] flex items-center justify-between">
                    <div>
                        <p class="text-[#7b7b78] text-sm font-semibold mb-1">Total Pendapatan</p>
                        <h3 class="text-2xl font-extrabold text-[#003E7E]">Rp <?= number_format($totalRevenue, 0, ',', '.') ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center text-blue-600">
                        <?= icon('medical_records', 24) ?>
                    </div>
                </div>

                <div class="bg-white rounded-[24px] p-6 shadow-sm border border-[#ebe7e1] flex items-center justify-between">
                    <div>
                        <p class="text-[#7b7b78] text-sm font-semibold mb-1">Total Pasien</p>
                        <h3 class="text-2xl font-extrabold text-[#111111]"><?= $totalPatients ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-green-50 rounded-full flex items-center justify-center text-green-600">
                        <?= icon('patient', 24) ?>
                    </div>
                </div>

                <div class="bg-white rounded-[24px] p-6 shadow-sm border border-[#ebe7e1] flex items-center justify-between">
                    <div>
                        <p class="text-[#7b7b78] text-sm font-semibold mb-1">Total Dokter</p>
                        <h3 class="text-2xl font-extrabold text-[#111111]"><?= $totalDoctors ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-yellow-50 rounded-full flex items-center justify-center text-yellow-600">
                        <?= icon('doctor', 24) ?>
                    </div>
                </div>

                <div class="bg-white rounded-[24px] p-6 shadow-sm border border-[#ebe7e1] flex items-center justify-between">
                    <div>
                        <p class="text-[#7b7b78] text-sm font-semibold mb-1">Konsultasi Selesai</p>
                        <h3 class="text-2xl font-extrabold text-[#111111]"><?= $totalAppointments ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-purple-50 rounded-full flex items-center justify-center text-purple-600">
                        <?= icon('success', 24) ?>
                    </div>
                </div>
            </div>

            <!-- Mobile Quick Links (Visible only on small screens) -->
            <div class="md:hidden grid grid-cols-2 gap-4">
                <a href="<?= base_url('admin/doctors') ?>" class="bg-white p-4 rounded-[20px] shadow-sm border border-[#ebe7e1] flex flex-col items-center justify-center text-center hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center text-blue-600 mb-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <span class="text-xs font-bold text-[#111111]">Kelola Dokter</span>
                </a>
                <a href="<?= base_url('admin/patients') ?>" class="bg-white p-4 rounded-[20px] shadow-sm border border-[#ebe7e1] flex flex-col items-center justify-center text-center hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 bg-green-50 rounded-full flex items-center justify-center text-green-600 mb-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <span class="text-xs font-bold text-[#111111]">Kelola Pasien</span>
                </a>
                <a href="<?= base_url('admin/specializations') ?>" class="bg-white p-4 rounded-[20px] shadow-sm border border-[#ebe7e1] flex flex-col items-center justify-center text-center hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 bg-purple-50 rounded-full flex items-center justify-center text-purple-600 mb-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <span class="text-xs font-bold text-[#111111]">Spesialisasi</span>
                </a>
                <a href="<?= base_url('admin/transactions') ?>" class="bg-white p-4 rounded-[20px] shadow-sm border border-[#ebe7e1] flex flex-col items-center justify-center text-center hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 bg-orange-50 rounded-full flex items-center justify-center text-orange-600 mb-2">
                        <?= icon('receipt', 20) ?>
                    </div>
                    <span class="text-xs font-bold text-[#111111]">Keuangan</span>
                </a>
                <a href="<?= base_url('admin/users') ?>" class="bg-white p-4 rounded-[20px] shadow-sm border border-[#ebe7e1] flex flex-col items-center justify-center text-center hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-700 mb-2">
                        <?= icon('patient', 20) ?>
                    </div>
                    <span class="text-xs font-bold text-[#111111]">Semua Akun</span>
                </a>
                <a href="<?= base_url('admin/logs') ?>" class="bg-white p-4 rounded-[20px] shadow-sm border border-[#ebe7e1] flex flex-col items-center justify-center text-center hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 bg-red-50 rounded-full flex items-center justify-center text-red-600 mb-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <span class="text-xs font-bold text-[#111111]">Audit Log</span>
                </a>
            </div>

            <!-- Recent Transactions -->
            <div class="bg-white rounded-[32px] shadow-sm border border-[#ebe7e1] overflow-hidden">
                <div class="p-6 border-b border-[#ebe7e1] bg-[#f9f8f6] flex justify-between items-center">
                    <h2 class="text-lg font-bold text-[#111111]">Transaksi Terbaru</h2>
                    <a href="<?= base_url('admin/transactions') ?>" class="text-sm font-semibold text-[#003E7E] hover:underline">Lihat Semua</a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[600px]">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-xs uppercase tracking-wider text-[#7b7b78]">
                                <th class="py-4 px-6 font-semibold">Tanggal</th>
                                <th class="py-4 px-6 font-semibold">Pasien</th>
                                <th class="py-4 px-6 font-semibold">Tipe</th>
                                <th class="py-4 px-6 font-semibold">Total</th>
                                <th class="py-4 px-6 font-semibold text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php if(empty($recentTransactions)): ?>
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-[#7b7b78]">Belum ada transaksi.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach($recentTransactions as $tx): ?>
                                    <tr class="hover:bg-[#f9f8f6] transition-colors">
                                        <td class="py-4 px-6 text-sm text-[#7b7b78]"><?= date('d M Y, H:i', strtotime($tx['created_at'])) ?></td>
                                        <td class="py-4 px-6 text-sm font-bold text-[#111111]"><?= esc($tx['patient_name']) ?></td>
                                        <td class="py-4 px-6 text-sm text-[#111111] capitalize"><?= esc($tx['type']) ?></td>
                                        <td class="py-4 px-6 text-sm font-bold text-[#111111]">Rp <?= number_format($tx['amount'], 0, ',', '.') ?></td>
                                        <td class="py-4 px-6 text-center">
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
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>
