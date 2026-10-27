<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="h-full flex flex-col bg-[#f5f1ec] overflow-hidden fade-in">
    <header class="bg-[#ffffff] px-6 py-4 flex items-center justify-between border-b border-[#d3cec6] sticky top-0 z-10">
        <div class="flex items-center space-x-4">
            <a href="<?= base_url('admin') ?>" class="text-[#7b7b78] hover:text-[#111111] transition-colors">
                <?= icon('arrow-left', 24) ?>
            </a>
            <div>
                <h1 class="text-xl font-bold text-[#111111]">Kelola Pasien</h1>
                <p class="text-sm text-[#7b7b78] mt-1">Daftar Pasien Terdaftar</p>
            </div>
        </div>
    </header>

    <div class="flex-1 overflow-y-auto p-6">
        <div class="max-w-6xl mx-auto">
            <div class="bg-white rounded-[32px] shadow-sm border border-[#ebe7e1] overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <h3 class="font-bold text-[#111111]">Total Pasien (<?= count($patients) ?>)</h3>
                    <div class="relative w-full sm:w-72">
                        <input id="admin-patient-search" type="text" placeholder="Cari nama, email, telepon, alamat..." class="w-full pl-9 pr-4 py-2 bg-[#f9f8f6] border border-[#d3cec6] rounded-[12px] text-xs text-[#111111] focus:outline-none focus:border-[#003E7E]">
                        <svg class="w-4 h-4 text-[#7b7b78] absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[800px]">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-xs uppercase tracking-wider text-[#7b7b78]">
                                <th class="py-4 px-6 font-semibold">Nama Pasien</th>
                                <th class="py-4 px-6 font-semibold">Tgl Lahir / Gender</th>
                                <th class="py-4 px-6 font-semibold">Telepon</th>
                                <th class="py-4 px-6 font-semibold">Alamat</th>
                                <th class="py-4 px-6 font-semibold">Terdaftar</th>
                                <th class="py-4 px-6 font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php foreach($patients as $patient): ?>
                                <tr class="admin-patient-row hover:bg-[#f9f8f6] transition-colors">
                                    <td class="py-4 px-6 align-middle">
                                        <p class="text-sm font-bold text-[#111111]"><?= esc($patient['name']) ?></p>
                                        <p class="text-xs text-[#7b7b78] mt-1"><?= esc($patient['email']) ?></p>
                                    </td>
                                    <td class="py-4 px-6 align-middle">
                                        <p class="text-sm text-[#111111]"><?= esc($patient['date_of_birth'] ?? '-') ?></p>
                                        <p class="text-xs text-[#7b7b78] mt-1 capitalize"><?= esc($patient['gender'] ?? '-') ?></p>
                                    </td>
                                    <td class="py-4 px-6 align-middle text-sm text-[#111111]">
                                        <?= esc($patient['phone'] ?? '-') ?>
                                    </td>
                                    <td class="py-4 px-6 align-middle text-sm text-[#111111]">
                                        <?= esc($patient['address'] ?? '-') ?>
                                    </td>
                                    <td class="py-4 px-6 align-middle text-sm text-[#7b7b78]">
                                        <?= date('d M Y', strtotime($patient['created_at'])) ?>
                                    </td>
                                    <td class="py-4 px-6 align-middle">
                                        <a href="<?= base_url('admin/patients/detail/' . $patient['id']) ?>" class="text-[#003E7E] hover:text-[#002a5c] font-semibold text-xs border border-[#003E7E] px-3 py-1.5 rounded-[12px] hover:bg-blue-50 transition-colors">
                                            Lihat Detail
                                        </a>
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
    const searchInput = document.getElementById('admin-patient-search');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const q = this.value.trim().toLowerCase();
            document.querySelectorAll('.admin-patient-row').forEach(row => {
                row.classList.toggle('hidden', q && !row.textContent.toLowerCase().includes(q));
            });
        });
    }
});
</script>

<?= $this->endSection() ?>
