<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="h-full flex flex-col bg-[#f5f1ec] overflow-hidden fade-in">
    <header class="bg-[#ffffff] px-6 py-4 flex items-center justify-between border-b border-[#d3cec6] sticky top-0 z-10">
        <div class="flex items-center space-x-4">
            <a href="<?= base_url('admin') ?>" class="text-[#7b7b78] hover:text-[#111111] transition-colors">
                <?= icon('arrow-left', 24) ?>
            </a>
            <div>
                <h1 class="text-xl font-bold text-[#111111]">Kelola Spesialisasi</h1>
                <p class="text-sm text-[#7b7b78] mt-1">Daftar Kategori Spesialisasi Dokter</p>
            </div>
        </div>
    </header>

    <div class="flex-1 overflow-y-auto p-6">
        <div class="max-w-4xl mx-auto space-y-6">
            
            <div class="bg-white rounded-[32px] p-6 shadow-sm border border-[#ebe7e1]">
                <h2 class="text-lg font-bold text-[#111111] mb-4">Tambah Spesialisasi Baru</h2>
                <form action="<?= base_url('admin/specializations/add') ?>" method="POST" class="flex gap-4 items-end">
                    <div class="flex-1">
                        <label for="name" class="block text-xs font-semibold text-[#111111] mb-2">Nama Spesialisasi</label>
                        <input type="text" name="name" id="name" required placeholder="Contoh: Dokter Kandungan" class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-[#111111] text-sm focus:outline-none focus:border-[#003E7E] transition-colors">
                    </div>
                    <button type="submit" class="bg-[#003E7E] hover:bg-[#002a5c] text-white px-6 py-3 rounded-[16px] text-sm font-bold transition-all shadow-sm">
                        Simpan
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-[32px] shadow-sm border border-[#ebe7e1] overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-xs uppercase tracking-wider text-[#7b7b78]">
                                <th class="py-4 px-6 font-semibold">No</th>
                                <th class="py-4 px-6 font-semibold">Nama Spesialisasi</th>
                                <th class="py-4 px-6 font-semibold">Tgl Dibuat</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php $i = 1; foreach($specializations as $spec): ?>
                                <tr class="hover:bg-[#f9f8f6] transition-colors">
                                    <td class="py-4 px-6 align-middle text-sm font-bold text-[#7b7b78] w-16">
                                        <?= $i++ ?>
                                    </td>
                                    <td class="py-4 px-6 align-middle">
                                        <p class="text-sm font-bold text-[#111111]"><?= esc($spec['name']) ?></p>
                                    </td>
                                    <td class="py-4 px-6 align-middle text-sm text-[#7b7b78]">
                                        <?= date('d M Y', strtotime($spec['created_at'])) ?>
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
