<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div id="edit-profile-screen" class="flex flex-col h-full bg-[#f5f1ec] fade-in w-full">
    <!-- Header -->
    <div class="bg-[#ffffff] px-4 py-3 border-b border-[#d3cec6] flex items-center sticky top-0 z-10">
        <button onclick="window.location.href='<?= base_url('patient/profile') ?>'"
            class="p-2 -ml-1 rounded-[16px] hover:bg-[#f5f1ec] transition-all mr-2">
            <svg class="w-5 h-5 text-[#626260]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        <h1 class="text-base font-bold text-[#111111]">Edit Profil & Info Medis</h1>
    </div>

    <div class="flex-1 overflow-y-auto p-5 pb-20 mx-auto w-full max-w-2xl">
        <div class="bg-[#ffffff] rounded-[24px] p-5 border border-[#ebe7e1] shadow-sm slide-up">
            <form action="<?= base_url('patient/profile/update') ?>" method="POST" class="space-y-4">
                
                <h3 class="font-bold text-[#111111] text-sm mb-4 flex items-center">
                    <span class="w-2 h-2 bg-[#003E7E] rounded-full mr-2"></span>
                    Informasi Akun Dasar
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-[#7b7b78] mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="<?= esc($user['name'] ?? '') ?>" required class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-[#111111] text-sm focus:outline-none focus:border-[#003E7E] transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-[#7b7b78] mb-1">Email</label>
                        <input type="email" name="email" value="<?= esc($user['email'] ?? '') ?>" required class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-[#111111] text-sm focus:outline-none focus:border-[#003E7E] transition-colors">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-[#7b7b78] mb-1">No. Handphone Pribadi</label>
                        <input type="text" name="phone" value="<?= esc($user['phone'] ?? '') ?>" placeholder="08123456789" class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-[#111111] text-sm focus:outline-none focus:border-[#003E7E] transition-colors">
                    </div>
                </div>

                <h3 class="font-bold text-[#111111] text-sm mb-4 mt-6 pt-4 border-t border-[#f5f1ec] flex items-center">
                    <span class="w-2 h-2 bg-[#1BA098] rounded-full mr-2"></span>
                    Informasi Medis Dasar
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-[#7b7b78] mb-1">Tanggal Lahir</label>
                        <input type="date" name="date_of_birth" value="<?= esc($patient['date_of_birth'] ?? '') ?>" class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-[#111111] text-sm focus:outline-none focus:border-[#003E7E] transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-[#7b7b78] mb-1">Jenis Kelamin</label>
                        <select name="gender" class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-[#111111] text-sm focus:outline-none focus:border-[#003E7E] transition-colors">
                            <option value="male" <?= ($patient['gender'] ?? '') == 'male' ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="female" <?= ($patient['gender'] ?? '') == 'female' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-[#7b7b78] mb-1">Golongan Darah</label>
                        <select name="blood_type" class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-[#111111] text-sm focus:outline-none focus:border-[#003E7E] transition-colors">
                            <option value="">-- Pilih --</option>
                            <option value="A" <?= ($patient['blood_type'] ?? '') == 'A' ? 'selected' : '' ?>>A</option>
                            <option value="B" <?= ($patient['blood_type'] ?? '') == 'B' ? 'selected' : '' ?>>B</option>
                            <option value="AB" <?= ($patient['blood_type'] ?? '') == 'AB' ? 'selected' : '' ?>>AB</option>
                            <option value="O" <?= ($patient['blood_type'] ?? '') == 'O' ? 'selected' : '' ?>>O</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-[#7b7b78] mb-1">Telepon Darurat</label>
                        <input type="text" name="emergency_contact_phone" value="<?= esc($patient['emergency_contact_phone'] ?? '') ?>" placeholder="08123456789" class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-[#111111] text-sm focus:outline-none focus:border-[#003E7E] transition-colors">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-[#7b7b78] mb-1">Nama Kontak Darurat</label>
                        <input type="text" name="emergency_contact" value="<?= esc($patient['emergency_contact'] ?? '') ?>" placeholder="Nama kerabat yang bisa dihubungi" class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-[#111111] text-sm focus:outline-none focus:border-[#003E7E] transition-colors">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-[#7b7b78] mb-1">Alamat Lengkap</label>
                        <textarea name="address" rows="2" class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-[#111111] text-sm focus:outline-none focus:border-[#003E7E] transition-colors"><?= esc($patient['address'] ?? '') ?></textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-[#7b7b78] mb-1">Riwayat Alergi (Opsional)</label>
                        <textarea name="allergies" rows="2" placeholder="Sebutkan jika ada (misal: alergi penisilin, kacang)" class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-[#111111] text-sm focus:outline-none focus:border-[#003E7E] transition-colors"><?= esc($patient['allergies'] ?? '') ?></textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-[#7b7b78] mb-1">Penyakit Bawaan (Opsional)</label>
                        <textarea name="pre_existing_conditions" rows="2" placeholder="Sebutkan jika ada (misal: asma, diabetes)" class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-[#111111] text-sm focus:outline-none focus:border-[#003E7E] transition-colors"><?= esc($patient['pre_existing_conditions'] ?? '') ?></textarea>
                    </div>
                </div>
                
                <div class="pt-6">
                    <button type="submit" class="w-full bg-[#003E7E] hover:bg-[#002a5c] text-white px-6 py-4 rounded-[16px] text-sm font-bold transition-all shadow-sm">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
