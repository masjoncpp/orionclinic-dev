<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="h-full flex flex-col bg-[#f5f1ec] overflow-hidden fade-in">
    <header class="bg-[#ffffff] px-6 py-4 flex items-center justify-between border-b border-[#d3cec6] sticky top-0 z-10">
        <div class="flex items-center space-x-4">
            <a href="<?= base_url('admin') ?>" class="text-[#7b7b78] hover:text-[#111111] transition-colors">
                <?= icon('arrow-left', 24) ?>
            </a>
            <div>
                <h1 class="text-xl font-bold text-[#111111]">Kelola Dokter</h1>
                <p class="text-sm text-[#7b7b78] mt-1">Manajemen & Verifikasi Dokter</p>
            </div>
        </div>
    </header>

    <div class="flex-1 overflow-y-auto p-6">
        <div class="max-w-6xl mx-auto space-y-6">

            <!-- Form Tambah Dokter -->
            <div class="bg-white rounded-[32px] p-6 shadow-sm border border-[#ebe7e1]">
                <h2 class="text-lg font-bold text-[#111111] mb-4">Tambah Akun Dokter Baru</h2>
                <form action="<?= base_url('admin/doctors/add') ?>" method="POST">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-semibold text-[#111111] mb-2">Nama Lengkap</label>
                            <input type="text" name="name" required placeholder="dr. Budi Santoso" class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-[#111111] text-sm focus:outline-none focus:border-[#003E7E] transition-colors">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-[#111111] mb-2">Email</label>
                            <input type="email" name="email" required placeholder="budi@orion.com" class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-[#111111] text-sm focus:outline-none focus:border-[#003E7E] transition-colors">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-[#111111] mb-2">Password</label>
                            <input type="password" name="password" required placeholder="Minimal 6 karakter" class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-[#111111] text-sm focus:outline-none focus:border-[#003E7E] transition-colors">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-[#111111] mb-2">Spesialisasi</label>
                            <select name="specialization" required class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-[#111111] text-sm focus:outline-none focus:border-[#003E7E] transition-colors">
                                <option value="">-- Pilih Spesialisasi --</option>
                                <?php foreach($specializations as $spec): ?>
                                    <option value="<?= esc($spec['name']) ?>"><?= esc($spec['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-[#111111] mb-2">Pengalaman (Tahun)</label>
                            <input type="number" name="experience_years" required placeholder="Contoh: 5" min="0" class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-[#111111] text-sm focus:outline-none focus:border-[#003E7E] transition-colors">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-[#111111] mb-2">Tarif Konsultasi (Rp)</label>
                            <input type="number" name="consultation_fee" required placeholder="Contoh: 50000" min="0" class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-[#111111] text-sm focus:outline-none focus:border-[#003E7E] transition-colors">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-[#111111] mb-2">Nomor STR</label>
                            <input type="text" name="str_number" required placeholder="Nomor STR valid" class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-[#111111] text-sm focus:outline-none focus:border-[#003E7E] transition-colors">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-[#111111] mb-2">Nomor SIP</label>
                            <input type="text" name="sip_number" required placeholder="Nomor SIP valid" class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-[#111111] text-sm focus:outline-none focus:border-[#003E7E] transition-colors">
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-[#003E7E] hover:bg-[#002a5c] text-white px-8 py-3 rounded-[16px] text-sm font-bold transition-all shadow-sm">
                            Buat Akun Dokter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tabel Dokter -->
            <div class="bg-white rounded-[32px] shadow-sm border border-[#ebe7e1] overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[800px]">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-xs uppercase tracking-wider text-[#7b7b78]">
                                <th class="py-4 px-6 font-semibold">Nama / Email</th>
                                <th class="py-4 px-6 font-semibold">Spesialisasi</th>
                                <th class="py-4 px-6 font-semibold">STR / SIP</th>
                                <th class="py-4 px-6 font-semibold text-center">Verifikasi</th>
                                <th class="py-4 px-6 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php foreach($doctors as $doctor): ?>
                                <tr class="hover:bg-[#f9f8f6] transition-colors">
                                    <td class="py-4 px-6 align-middle">
                                        <p class="text-sm font-bold text-[#111111]"><?= esc($doctor['name']) ?></p>
                                        <p class="text-xs text-[#7b7b78] mt-1"><?= esc($doctor['email']) ?></p>
                                    </td>
                                    <td class="py-4 px-6 align-middle text-sm text-[#111111]">
                                        <?= esc($doctor['specialization']) ?>
                                    </td>
                                    <td class="py-4 px-6 align-middle">
                                        <p class="text-xs text-[#111111]"><span class="font-bold">STR:</span> <?= esc($doctor['str_number'] ?? '-') ?></p>
                                        <p class="text-xs text-[#111111]"><span class="font-bold">SIP:</span> <?= esc($doctor['sip_number'] ?? '-') ?></p>
                                    </td>
                                    <td class="py-4 px-6 align-middle text-center">
                                        <?php if($doctor['is_verified']): ?>
                                            <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">Terverifikasi</span>
                                        <?php else: ?>
                                            <span class="bg-red-100 text-red-700 text-xs font-bold px-3 py-1 rounded-full">Belum Verifikasi</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="py-4 px-6 align-middle text-right">
                                        <form action="<?= base_url('admin/doctors/verify') ?>" method="POST" class="inline-block form-status">
                                            <input type="hidden" name="doctor_id" value="<?= $doctor['id'] ?>">
                                            <?php if($doctor['is_verified']): ?>
                                                <button type="button" class="btn-update-status text-red-600 hover:text-red-800 text-xs font-bold">Cabut Verifikasi</button>
                                            <?php else: ?>
                                                <button type="button" class="btn-update-status bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white px-4 py-2 rounded-[12px] text-xs font-bold transition-all shadow-sm">Verifikasi</button>
                                            <?php endif; ?>
                                        </form>
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
