<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="h-full flex flex-col bg-[#f5f1ec] overflow-hidden fade-in">
    <!-- Header -->
    <header class="bg-[#ffffff] px-6 py-4 flex items-center justify-between border-b border-[#d3cec6] sticky top-0 z-10">
        <div>
            <h1 class="text-xl font-bold text-[#111111]">Dashboard Farmasi</h1>
            <p class="text-sm text-[#7b7b78] mt-1">Kelola pesanan dan pengambilan obat pasien</p>
        </div>
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-3 border-r border-[#ebe7e1] pr-4">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-bold text-[#111111]"><?= esc(session()->get('name')) ?></p>
                    <p class="text-xs text-[#7b7b78]">Apoteker</p>
                </div>
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-700 font-bold text-sm">
                    <?= substr(session()->get('name'), 0, 1) ?>
                </div>
            </div>
            <a href="<?= base_url('logout') ?>" class="text-red-500 hover:text-red-700 font-bold text-sm bg-red-50 px-4 py-2 rounded-[12px] transition-colors">Logout</a>
        </div>
    </header>

    <div class="flex-1 overflow-y-auto p-6">
        <div class="max-w-6xl mx-auto space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <?php
                    $countRedeemed = count(array_filter($prescriptions, fn($p) => $p['status'] == 'redeemed'));
                    $countPreparing = count(array_filter($prescriptions, fn($p) => $p['status'] == 'preparing'));
                    $countReady = count(array_filter($prescriptions, fn($p) => $p['status'] == 'ready'));
                ?>
                <div class="bg-white rounded-[24px] p-5 shadow-sm border border-[#ebe7e1]">
                    <div class="text-[#7b7b78] text-sm font-semibold mb-2">Perlu Disiapkan</div>
                    <div class="text-3xl font-extrabold text-blue-600"><?= $countRedeemed ?></div>
                </div>
                <div class="bg-white rounded-[24px] p-5 shadow-sm border border-[#ebe7e1]">
                    <div class="text-[#7b7b78] text-sm font-semibold mb-2">Sedang Disiapkan</div>
                    <div class="text-3xl font-extrabold text-yellow-500"><?= $countPreparing ?></div>
                </div>
                <div class="bg-white rounded-[24px] p-5 shadow-sm border border-[#ebe7e1]">
                    <div class="text-[#7b7b78] text-sm font-semibold mb-2">Siap Diambil</div>
                    <div class="text-3xl font-extrabold text-green-600"><?= $countReady ?></div>
                </div>
            </div>

            <div class="bg-white rounded-[32px] shadow-sm border border-[#ebe7e1] overflow-hidden">
                <div class="p-6 border-b border-[#ebe7e1] bg-[#f9f8f6]">
                    <h2 class="text-lg font-bold text-[#111111]">Daftar Resep Obat</h2>
                </div>
                <div class="p-0">
                    <?php if (empty($prescriptions)): ?>
                        <div class="text-center py-12">
                            <p class="text-[#7b7b78] font-medium">Tidak ada resep yang perlu diproses.</p>
                        </div>
                    <?php else: ?>
                        <!-- Desktop View (Table) -->
                        <div class="hidden md:block overflow-x-auto">
                            <table class="w-full text-left border-collapse min-w-[800px]">
                                <thead>
                                    <tr class="bg-gray-50 border-b border-gray-100 text-xs uppercase tracking-wider text-[#7b7b78]">
                                        <th class="py-4 px-6 font-semibold">Tanggal / Pasien</th>
                                        <th class="py-4 px-6 font-semibold">Dokter</th>
                                        <th class="py-4 px-6 font-semibold w-1/3">Daftar Obat</th>
                                        <th class="py-4 px-6 font-semibold text-center">Status</th>
                                        <th class="py-4 px-6 font-semibold text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <?php foreach ($prescriptions as $p): ?>
                                        <tr class="hover:bg-[#f9f8f6] transition-colors">
                                            <td class="py-4 px-6 align-top">
                                                <p class="text-sm font-bold text-[#111111]"><?= esc($p['patient_name']) ?></p>
                                                <p class="text-xs text-[#7b7b78] mt-1"><?= date('d M Y', strtotime($p['appointment_date'])) ?></p>
                                            </td>
                                            <td class="py-4 px-6 align-top text-sm text-[#111111]">
                                                <?= esc($p['doctor_name']) ?>
                                            </td>
                                            <td class="py-4 px-6 align-top">
                                                <ul class="list-disc pl-4 space-y-1">
                                                    <?php foreach ($p['items'] as $item): ?>
                                                        <li class="text-sm text-[#111111]">
                                                            <span class="font-semibold"><?= esc($item['medicine_name']) ?></span> 
                                                            <span class="text-[#626260] text-xs">x<?= esc($item['quantity']) ?> <?= esc($item['dosage']) ?></span>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                                <?php if ($p['notes']): ?>
                                                    <p class="text-xs text-orange-600 mt-2 bg-orange-50 p-2 rounded-lg"><span class="font-bold">Catatan Dokter:</span> <?= esc($p['notes']) ?></p>
                                                <?php endif; ?>
                                            </td>
                                            <td class="py-4 px-6 align-top text-center">
                                                <?php 
                                                    $badgeClass = '';
                                                    $statusText = '';
                                                    if ($p['status'] == 'redeemed') {
                                                        $badgeClass = 'bg-red-100 text-red-700';
                                                        $statusText = 'Perlu Disiapkan';
                                                    } elseif ($p['status'] == 'preparing') {
                                                        $badgeClass = 'bg-yellow-100 text-yellow-700';
                                                        $statusText = 'Sedang Disiapkan';
                                                    } elseif ($p['status'] == 'ready') {
                                                        $badgeClass = 'bg-blue-100 text-blue-700';
                                                        $statusText = 'Siap Diambil';
                                                    } elseif ($p['status'] == 'completed') {
                                                        $badgeClass = 'bg-green-100 text-green-700';
                                                        $statusText = 'Selesai';
                                                    }
                                                ?>
                                                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold <?= $badgeClass ?>">
                                                    <?= $statusText ?>
                                                </span>
                                            </td>
                                            <td class="py-4 px-6 align-top text-right">
                                                <form action="<?= base_url('pharmacy/update_status') ?>" method="POST" class="inline-block form-status">
                                                    <input type="hidden" name="prescription_id" value="<?= $p['id'] ?>">
                                                    
                                                    <?php if ($p['status'] == 'redeemed'): ?>
                                                        <input type="hidden" name="status" value="preparing">
                                                        <button type="button" class="btn-update-status bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white px-4 py-2 rounded-[12px] text-xs font-bold transition-all shadow-sm">
                                                            Mulai Siapkan
                                                        </button>
                                                    <?php elseif ($p['status'] == 'preparing'): ?>
                                                        <input type="hidden" name="status" value="ready">
                                                        <button type="button" class="btn-update-status bg-yellow-50 text-yellow-600 hover:bg-yellow-500 hover:text-white px-4 py-2 rounded-[12px] text-xs font-bold transition-all shadow-sm">
                                                            Tandai Siap
                                                        </button>
                                                    <?php elseif ($p['status'] == 'ready'): ?>
                                                        <input type="hidden" name="status" value="completed">
                                                        <button type="button" class="btn-update-status bg-green-50 text-green-600 hover:bg-green-600 hover:text-white px-4 py-2 rounded-[12px] text-xs font-bold transition-all shadow-sm">
                                                            Selesaikan
                                                        </button>
                                                    <?php endif; ?>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile View (Cards) -->
                        <div class="block md:hidden divide-y divide-gray-100">
                            <?php foreach ($prescriptions as $p): ?>
                                <div class="p-4 space-y-3">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="text-sm font-bold text-[#111111]"><?= esc($p['patient_name']) ?></p>
                                            <p class="text-xs text-[#7b7b78] mt-0.5"><?= date('d M Y', strtotime($p['appointment_date'])) ?> • Dr. <?= esc($p['doctor_name']) ?></p>
                                        </div>
                                        <?php 
                                            $badgeClass = '';
                                            $statusText = '';
                                            if ($p['status'] == 'redeemed') {
                                                $badgeClass = 'bg-red-100 text-red-700';
                                                $statusText = 'Perlu Disiapkan';
                                            } elseif ($p['status'] == 'preparing') {
                                                $badgeClass = 'bg-yellow-100 text-yellow-700';
                                                $statusText = 'Disiapkan';
                                            } elseif ($p['status'] == 'ready') {
                                                $badgeClass = 'bg-blue-100 text-blue-700';
                                                $statusText = 'Siap Diambil';
                                            } elseif ($p['status'] == 'completed') {
                                                $badgeClass = 'bg-green-100 text-green-700';
                                                $statusText = 'Selesai';
                                            }
                                        ?>
                                        <span class="inline-block px-2 py-1 rounded-md text-[10px] font-bold <?= $badgeClass ?>">
                                            <?= $statusText ?>
                                        </span>
                                    </div>
                                    
                                    <div class="bg-gray-50 rounded-[12px] p-3 border border-gray-100">
                                        <ul class="list-disc pl-4 space-y-1 mb-2">
                                            <?php foreach ($p['items'] as $item): ?>
                                                <li class="text-xs text-[#111111]">
                                                    <span class="font-semibold"><?= esc($item['medicine_name']) ?></span> 
                                                    <span class="text-[#626260]">x<?= esc($item['quantity']) ?> <?= esc($item['dosage']) ?></span>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <?php if ($p['notes']): ?>
                                            <p class="text-[11px] text-orange-600 mt-2 bg-orange-50 p-2 rounded-lg leading-relaxed"><span class="font-bold">Catatan:</span> <?= esc($p['notes']) ?></p>
                                        <?php endif; ?>
                                    </div>

                                    <form action="<?= base_url('pharmacy/update_status') ?>" method="POST" class="form-status block w-full pt-1">
                                        <input type="hidden" name="prescription_id" value="<?= $p['id'] ?>">
                                        
                                        <?php if ($p['status'] == 'redeemed'): ?>
                                            <input type="hidden" name="status" value="preparing">
                                            <button type="button" class="btn-update-status w-full bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white px-4 py-2.5 rounded-[12px] text-xs font-bold transition-all shadow-sm">
                                                Mulai Siapkan
                                            </button>
                                        <?php elseif ($p['status'] == 'preparing'): ?>
                                            <input type="hidden" name="status" value="ready">
                                            <button type="button" class="btn-update-status w-full bg-yellow-50 text-yellow-600 hover:bg-yellow-500 hover:text-white px-4 py-2.5 rounded-[12px] text-xs font-bold transition-all shadow-sm">
                                                Tandai Siap
                                            </button>
                                        <?php elseif ($p['status'] == 'ready'): ?>
                                            <input type="hidden" name="status" value="completed">
                                            <button type="button" class="btn-update-status w-full bg-green-50 text-green-600 hover:bg-green-600 hover:text-white px-4 py-2.5 rounded-[12px] text-xs font-bold transition-all shadow-sm">
                                                Selesaikan
                                            </button>
                                        <?php endif; ?>
                                    </form>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const updateButtons = document.querySelectorAll('.btn-update-status');
    updateButtons.forEach(button => {
        button.addEventListener('click', function() {
            let nextStatus = this.parentElement.querySelector('input[name="status"]').value;
            let actionText = '';
            
            if (nextStatus === 'preparing') actionText = 'Mulai menyiapkan obat ini?';
            else if (nextStatus === 'ready') actionText = 'Tandai obat ini siap diambil?';
            else if (nextStatus === 'completed') actionText = 'Selesaikan dan serahkan obat ke pasien?';

            Swal.fire({
                title: 'Konfirmasi',
                text: actionText,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#003E7E',
                cancelButtonColor: '#626260',
                confirmButtonText: 'Ya, Lanjutkan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.closest('form').submit();
                }
            });
        });
    });
});
</script>

<?= $this->endSection() ?>
