<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="h-full flex flex-col bg-[#f5f1ec] overflow-hidden fade-in">
    <header class="bg-[#ffffff] px-6 py-4 flex items-center justify-between border-b border-[#d3cec6] sticky top-0 z-10">
        <div class="flex items-center space-x-4">
            <a href="<?= esc($back_url ?? base_url('admin/patients')) ?>" class="text-[#7b7b78] hover:text-[#111111] transition-colors">
                <?= icon('arrow-left', 24) ?>
            </a>
            <div>
                <h1 class="text-xl font-bold text-[#111111]">Detail Pasien</h1>
                <p class="text-sm text-[#7b7b78] mt-1">Rekam Medis & Profil</p>
            </div>
        </div>
    </header>

    <div class="flex-1 overflow-y-auto p-6">
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Sidebar Kiri: Profil -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Info Utama -->
                <div class="bg-white rounded-[32px] p-6 shadow-sm border border-[#ebe7e1] text-center relative overflow-hidden">
                    <div class="absolute inset-0 h-24 bg-[#003E7E] rounded-t-[32px]"></div>
                    <div class="w-24 h-24 mx-auto rounded-[24px] bg-[#f5f1ec] flex items-center justify-center border-4 border-white relative z-10 mt-6 shadow-sm">
                        <?= icon('patient', 48, 'text-[#1BA098]') ?>
                    </div>
                    <h2 class="text-xl font-bold text-[#111111] mt-4"><?= esc($patient['name']) ?></h2>
                    <p class="text-[#7b7b78] text-sm"><?= esc($patient['email']) ?></p>
                    <div class="mt-4 inline-flex px-3 py-1 bg-green-50 text-green-700 text-xs font-bold rounded-full border border-green-200">
                        Aktif sejak <?= date('M Y', strtotime($patient['user_created_at'])) ?>
                    </div>
                </div>

                <!-- Info Kontak & Medis Dasar -->
                <div class="bg-white rounded-[32px] p-6 shadow-sm border border-[#ebe7e1]">
                    <h3 class="font-bold text-[#111111] text-sm mb-4 border-b border-[#f5f1ec] pb-2">Informasi Dasar</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-xs text-[#7b7b78] mb-1">Tanggal Lahir</p>
                            <p class="text-sm font-semibold text-[#111111]"><?= $patient['date_of_birth'] ? date('d F Y', strtotime($patient['date_of_birth'])) : '-' ?></p>
                        </div>
                        <div>
                            <p class="text-xs text-[#7b7b78] mb-1">Jenis Kelamin</p>
                            <p class="text-sm font-semibold text-[#111111] capitalize"><?= esc($patient['gender'] ?? '-') ?></p>
                        </div>
                        <div>
                            <p class="text-xs text-[#7b7b78] mb-1">Golongan Darah</p>
                            <p class="text-sm font-semibold text-red-600"><?= esc($patient['blood_type'] ?? 'Belum Diisi') ?></p>
                        </div>
                        <div>
                            <p class="text-xs text-[#7b7b78] mb-1">No. Telepon</p>
                            <p class="text-sm font-semibold text-[#111111]"><?= esc($patient['phone'] ?? '-') ?></p>
                        </div>
                        <div>
                            <p class="text-xs text-[#7b7b78] mb-1">Alamat</p>
                            <p class="text-sm font-semibold text-[#111111]"><?= esc($patient['address'] ?? '-') ?></p>
                        </div>
                    </div>

                    <h3 class="font-bold text-[#111111] text-sm mb-4 mt-6 border-b border-[#f5f1ec] pb-2">Kontak Darurat</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-xs text-[#7b7b78] mb-1">Nama Kontak Darurat</p>
                            <p class="text-sm font-semibold text-[#111111]"><?= esc($patient['emergency_contact'] ?? '-') ?></p>
                        </div>
                        <div>
                            <p class="text-xs text-[#7b7b78] mb-1">Telepon Darurat</p>
                            <p class="text-sm font-semibold text-[#111111]"><?= esc($patient['emergency_contact_phone'] ?? '-') ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Konten Kanan: Medis & Riwayat -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Kondisi Medis Penting -->
                <div class="bg-white rounded-[32px] p-6 shadow-sm border border-[#ebe7e1]">
                    <h3 class="font-bold text-[#111111] text-lg mb-4 flex items-center">
                        <span class="w-8 h-8 rounded-full bg-red-50 flex items-center justify-center mr-2">
                            <?= icon('medical_records', 16, 'text-red-500') ?>
                        </span>
                        Kondisi Medis Khusus
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-red-50/50 p-4 rounded-[20px] border border-red-100">
                            <p class="text-xs text-red-600 font-bold uppercase tracking-wider mb-2">Riwayat Alergi</p>
                            <p class="text-sm text-[#111111] font-medium leading-relaxed">
                                <?= $patient['allergies'] ? esc($patient['allergies']) : '<span class="text-gray-400 italic font-normal">Tidak ada catatan alergi</span>' ?>
                            </p>
                        </div>
                        <div class="bg-yellow-50/50 p-4 rounded-[20px] border border-yellow-100">
                            <p class="text-xs text-yellow-600 font-bold uppercase tracking-wider mb-2">Penyakit Bawaan</p>
                            <p class="text-sm text-[#111111] font-medium leading-relaxed">
                                <?= $patient['pre_existing_conditions'] ? esc($patient['pre_existing_conditions']) : '<span class="text-gray-400 italic font-normal">Tidak ada catatan penyakit bawaan</span>' ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Riwayat Konsultasi -->
                <div class="bg-white rounded-[32px] shadow-sm border border-[#ebe7e1] overflow-hidden">
                    <div class="p-6 border-b border-[#f5f1ec] flex justify-between items-center">
                        <h3 class="font-bold text-[#111111] text-lg">Riwayat Konsultasi</h3>
                        <span class="px-3 py-1 bg-blue-50 text-[#003E7E] rounded-full text-xs font-bold"><?= count($history) ?> Kunjungan</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-[#f9f8f6] text-xs uppercase tracking-wider text-[#7b7b78]">
                                    <th class="py-3 px-6 font-semibold">Tanggal</th>
                                    <th class="py-3 px-6 font-semibold">Dokter</th>
                                    <th class="py-3 px-6 font-semibold">Diagnosis & Tindak Lanjut</th>
                                    <th class="py-3 px-6 font-semibold">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#ebe7e1]">
                                <?php if (empty($history)): ?>
                                    <tr>
                                        <td colspan="4" class="py-8 px-6 text-center text-[#7b7b78] text-sm">Belum ada riwayat konsultasi.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($history as $appt): ?>
                                        <tr class="hover:bg-[#f9f8f6] transition-colors">
                                            <td class="py-4 px-6 align-middle">
                                                <p class="text-sm font-bold text-[#111111]"><?= date('d M Y', strtotime($appt['appointment_date'])) ?></p>
                                                <p class="text-xs text-[#7b7b78] mt-0.5"><?= date('H:i', strtotime($appt['time_slot'])) ?> WIB</p>
                                            </td>
                                            <td class="py-4 px-6 align-middle">
                                                <p class="text-sm font-semibold text-[#111111]"><?= esc($appt['doctor_name']) ?></p>
                                                <p class="text-xs text-[#003E7E]"><?= esc($appt['specialization']) ?></p>
                                            </td>
                                            <td class="py-4 px-6 align-middle text-sm text-[#111111]">
                                                <p class="font-semibold text-gray-800 mb-1"><?= $appt['diagnosis'] ? esc($appt['diagnosis']) : '<span class="text-gray-400 italic font-normal">-</span>' ?></p>
                                                <?php if ($appt['follow_up']): ?>
                                                    <div class="mt-2 bg-blue-50 text-blue-800 p-2 rounded-lg text-xs border border-blue-100">
                                                        <span class="font-bold flex items-center mb-1">
                                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                            Tindak Lanjut
                                                        </span>
                                                        <?= esc($appt['follow_up']) ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td class="py-4 px-6 align-middle">
                                                <?= statusBadge($appt['status']) ?>
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
</div>

<?= $this->endSection() ?>
