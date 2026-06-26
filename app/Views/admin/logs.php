<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="h-full flex flex-col bg-[#f5f1ec] overflow-hidden fade-in">
    <header class="bg-[#ffffff] px-6 py-4 flex items-center justify-between border-b border-[#d3cec6] sticky top-0 z-10">
        <div class="flex items-center space-x-4">
            <a href="<?= base_url('admin') ?>" class="text-[#7b7b78] hover:text-[#111111] transition-colors">
                <?= icon('arrow-left', 24) ?>
            </a>
            <div>
                <h1 class="text-xl font-bold text-[#111111]">Audit Log Aktivitas</h1>
                <p class="text-sm text-[#7b7b78] mt-1">Riwayat aktivitas penting oleh Admin</p>
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
                                <th class="py-4 px-6 font-semibold w-1/6">Waktu</th>
                                <th class="py-4 px-6 font-semibold w-1/6">Pengguna</th>
                                <th class="py-4 px-6 font-semibold w-1/6">Aksi</th>
                                <th class="py-4 px-6 font-semibold w-2/6">Detail</th>
                                <th class="py-4 px-6 font-semibold w-1/6">IP Address</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php foreach($logs as $log): ?>
                                <tr class="hover:bg-[#f9f8f6] transition-colors">
                                    <td class="py-4 px-6 align-top text-xs font-bold text-[#111111]">
                                        <?= date('d M Y, H:i', strtotime($log['created_at'])) ?>
                                    </td>
                                    <td class="py-4 px-6 align-top">
                                        <p class="text-xs font-bold text-[#111111]"><?= esc($log['user_name'] ?? 'System') ?></p>
                                        <p class="text-[10px] text-[#7b7b78] mt-0.5 capitalize"><?= esc($log['user_role'] ?? 'System') ?></p>
                                    </td>
                                    <td class="py-4 px-6 align-top">
                                        <span class="inline-block bg-blue-50 text-blue-700 px-2 py-1 rounded-md text-[10px] font-bold">
                                            <?= esc($log['action']) ?>
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 align-top text-xs text-[#111111] leading-relaxed">
                                        <?= esc($log['details']) ?>
                                    </td>
                                    <td class="py-4 px-6 align-top text-xs text-[#7b7b78]">
                                        <?= esc($log['ip_address']) ?>
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
