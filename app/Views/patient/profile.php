<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="profile-screen" class="flex flex-col h-full bg-[#f5f1ec] fade-in">

    <div class="flex-1 overflow-y-auto pb-20 md:pb-6">

        <!-- Profile Header -->
        <div class="bg-[#003E7E] relative overflow-hidden px-5 pt-8 pb-20 md:pb-24">

                    <!-- Decorative Ornaments -->
                    <div class="absolute inset-0 pointer-events-none overflow-hidden z-0">
                        <!-- Soft Gradient Circles -->
                        <div class="absolute -top-24 -right-24 w-96 h-96 bg-white opacity-[0.03] rounded-full blur-3xl"></div>
                        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-[#1BA098] opacity-[0.15] rounded-full blur-3xl"></div>
                        
                        <!-- Wavy SVG Accent -->
                        <svg class="absolute top-0 right-0 w-full h-full opacity-[0.04]" viewBox="0 0 100 100" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0,50 Q25,20 50,50 T100,50 L100,0 L0,0 Z" fill="currentColor" class="text-white"/>
                            <path d="M0,80 Q25,50 50,80 T100,80 L100,100 L0,100 Z" fill="currentColor" class="text-[#1BA098]"/>
                        </svg>

                        <!-- Subtle Grid Pattern -->
                        <div class="absolute inset-0" style="background-image: radial-gradient(rgba(255,255,255,0.1) 1.5px, transparent 1.5px); background-size: 24px 24px;"></div>
                        
                        <!-- Accent Medical Crosses -->
                        <svg class="absolute top-10 right-1/4 w-8 h-8 text-white opacity-[0.08]" fill="currentColor" viewBox="0 0 24 24"><path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6v-2z"/></svg>
                        <svg class="absolute bottom-10 left-1/3 w-12 h-12 text-[#1BA098] opacity-[0.12] transform rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6v-2z"/></svg>
                    </div>

            <h1 class="text-base font-bold text-white mb-5">Profil Saya</h1>
            <div class="flex items-center">
                <div class="relative mr-4">
                    <img src="<?= base_url('assets/profile.png') ?>" alt="Profile"
                        class="w-16 h-16 rounded-[24px] object-cover border-2 border-white/30">
                    <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-400 rounded-full border-2 border-white"></div>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-white"><?= esc(session()->get('name') ?? 'Pengguna') ?></h2>
                    <p class="text-white/60 text-xs mt-0.5"><?= esc(session()->get('email') ?? '-') ?></p>
                    <p class="text-white/60 text-xs"><?= esc(session()->get('phone') ?? '-') ?></p>
                </div>
            </div>
        </div>

        <div class="px-5 max-w-2xl mx-auto">

            <!-- Family Members -->
            <div class="-mt-10 mb-5 relative z-10">
                <div class="bg-[#ffffff] rounded-[24px]  p-4">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="font-bold text-[#111111] text-sm">Anggota Keluarga</h3>
                        <button onclick="document.getElementById('add-family-modal').classList.remove('hidden')" class="text-xs text-[#111111] font-bold bg-[#ebe7e1] px-3 py-1.5 rounded-[12px] hover:bg-[#d3cec6] transition-all">+ Tambah</button>
                    </div>
                    <div class="space-y-2">
                        <?php if (empty($family_members)): ?>
                            <div class="p-4 text-center border border-dashed border-gray-300 rounded-[16px]">
                                <p class="text-xs text-[#7b7b78]">Belum ada anggota keluarga yang didaftarkan.</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($family_members as $member): ?>
                            <div class="flex items-center p-3 bg-[#f5f1ec] rounded-[16px] hover:bg-[#ebe7e1] transition-all cursor-pointer">
                                <div class="w-9 h-9 <?= $member['gender'] == 'female' ? 'bg-pink-100' : 'bg-[#ebe7e1]' ?> rounded-[16px] flex items-center justify-center mr-3 flex-shrink-0">
                                    <svg class="w-4 h-4 <?= $member['gender'] == 'female' ? 'text-pink-600' : 'text-[#111111]' ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h5 class="font-semibold text-[#111111] text-sm"><?= esc($member['name']) ?></h5>
                                    <?php 
                                        $age = date_diff(date_create($member['date_of_birth']), date_create('today'))->y;
                                    ?>
                                    <p class="text-xs text-[#7b7b78]"><?= esc($member['relation']) ?> • <?= $age ?> tahun</p>
                                </div>
                                <a href="<?= base_url('patient/family/delete/' . $member['id']) ?>" onclick="return confirm('Hapus anggota keluarga ini?')" class="p-2 text-red-500 hover:bg-red-50 rounded-full transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </a>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Menu Items -->
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-[16px] relative mb-4 shadow-sm" role="alert">
                    <span class="block sm:inline font-medium"><?= session()->getFlashdata('success') ?></span>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-[16px] relative mb-4 shadow-sm" role="alert">
                    <span class="block sm:inline font-medium"><?= session()->getFlashdata('error') ?></span>
                </div>
            <?php endif; ?>

            <div class="bg-[#ffffff] rounded-[24px]  overflow-hidden mb-6">
                <a href="<?= base_url('patient/edit_profile') ?>" class="w-full flex items-center p-4 hover:bg-[#f5f1ec] transition-all border-b border-gray-50">
                    <div class="w-9 h-9 bg-[#ebe7e1] rounded-[16px] flex items-center justify-center mr-3 flex-shrink-0">
                        <svg class="w-4 h-4 text-[#111111]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <span class="flex-1 text-left font-semibold text-[#111111] text-sm">Edit Profil & Info Medis</span>
                    <svg class="w-4 h-4 text-[#7b7b78]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                <button class="w-full flex items-center p-4 hover:bg-[#f5f1ec] transition-all border-b border-gray-50">
                    <div class="w-9 h-9 bg-teal-50 rounded-[16px] flex items-center justify-center mr-3 flex-shrink-0">
                        <svg class="w-4 h-4 text-[#111111]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                    </div>
                    <span class="flex-1 text-left font-semibold text-[#111111] text-sm">Metode Pembayaran</span>
                    <svg class="w-4 h-4 text-[#7b7b78]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <button class="w-full flex items-center p-4 hover:bg-[#f5f1ec] transition-all border-b border-gray-50">
                    <div class="w-9 h-9 bg-purple-50 rounded-[16px] flex items-center justify-center mr-3 flex-shrink-0">
                        <svg class="w-4 h-4 text-[#111111]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                    <span class="flex-1 text-left font-semibold text-[#111111] text-sm">Notifikasi</span>
                    <svg class="w-4 h-4 text-[#7b7b78]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <button class="w-full flex items-center p-4 hover:bg-[#f5f1ec] transition-all">
                    <div class="w-9 h-9 bg-orange-50 rounded-[16px] flex items-center justify-center mr-3 flex-shrink-0">
                        <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="flex-1 text-left font-semibold text-[#111111] text-sm">Bantuan & FAQ</span>
                    <svg class="w-4 h-4 text-[#7b7b78]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>

            <!-- Logout -->
            <div class="bg-[#ffffff] rounded-[24px]  overflow-hidden mb-6">
                <button onclick="window.location.href='<?= base_url('logout') ?>'"
                    class="w-full flex items-center p-4 hover:bg-red-50 transition-all">
                    <div class="w-9 h-9 bg-red-50 rounded-[16px] flex items-center justify-center mr-3 flex-shrink-0">
                        <svg class="w-4 h-4 text-[#E53935]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </div>
                    <span class="flex-1 text-left font-semibold text-[#E53935] text-sm">Keluar dari Akun</span>
                </button>
            </div>

            <p class="text-center text-xs text-[#7b7b78] mb-4">Orion Clinic v1.0.0</p>

        </div>
    </div>

</div>
<?= $this->include('components/bottom_nav') ?>
<!-- Modal Tambah Keluarga -->
<div id="add-family-modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50" onclick="document.getElementById('add-family-modal').classList.add('hidden')"></div>
    <div class="absolute bottom-0 left-0 right-0 bg-[#ffffff] rounded-t-[32px] p-6 slide-up-fast max-h-[90vh] overflow-y-auto">
        <div class="w-12 h-1.5 bg-[#ebe7e1] rounded-full mx-auto mb-6"></div>
        <h3 class="font-bold text-lg text-[#111111] mb-4">Tambah Anggota Keluarga</h3>
        <form action="<?= base_url('patient/family/add') ?>" method="POST" class="space-y-4">
            <div>
                <label class="block text-xs font-semibold text-[#111111] mb-2">Nama Lengkap</label>
                <input type="text" name="name" required class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-sm focus:outline-none focus:border-[#003E7E]">
            </div>
            <div>
                <label class="block text-xs font-semibold text-[#111111] mb-2">Hubungan</label>
                <select name="relation" required class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-sm focus:outline-none focus:border-[#003E7E]">
                    <option value="Suami">Suami</option>
                    <option value="Istri">Istri</option>
                    <option value="Anak">Anak</option>
                    <option value="Orang Tua">Orang Tua</option>
                    <option value="Saudara">Saudara</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-[#111111] mb-2">Tanggal Lahir</label>
                    <input type="date" name="date_of_birth" required class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-sm focus:outline-none focus:border-[#003E7E]">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[#111111] mb-2">Jenis Kelamin</label>
                    <select name="gender" required class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-sm focus:outline-none focus:border-[#003E7E]">
                        <option value="male">Laki-laki</option>
                        <option value="female">Perempuan</option>
                    </select>
                </div>
                <div class="col-span-2">
                    <label class="block text-xs font-semibold text-[#111111] mb-2">Golongan Darah</label>
                    <select name="blood_type" class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-sm focus:outline-none focus:border-[#003E7E]">
                        <option value="">-- Pilih --</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>
                        <option value="O">O</option>
                    </select>
                </div>
                <div class="col-span-2">
                    <label class="block text-xs font-semibold text-[#111111] mb-2">Riwayat Alergi (Opsional)</label>
                    <textarea name="allergies" rows="2" placeholder="Contoh: Kacang, Penisilin" class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-sm focus:outline-none focus:border-[#003E7E]"></textarea>
                </div>
                <div class="col-span-2">
                    <label class="block text-xs font-semibold text-[#111111] mb-2">Penyakit Bawaan (Opsional)</label>
                    <textarea name="pre_existing_conditions" rows="2" placeholder="Contoh: Asma, Diabetes" class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-sm focus:outline-none focus:border-[#003E7E]"></textarea>
                </div>
            </div>
            <button type="submit" class="w-full bg-[#003E7E] hover:bg-[#002a5c] transition-colors text-white py-4 rounded-[16px] font-bold mt-4 shadow-sm">Simpan Anggota Keluarga</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
