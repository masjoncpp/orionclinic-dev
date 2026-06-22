<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="register-screen" class="flex flex-col h-full bg-[#ffffff] md:absolute md:inset-0 md:z-50 md:flex-row">
            <!-- Desktop Banner -->
            <div class="hidden md:flex md:w-1/2 bg-[#003E7E] items-center justify-center p-12 text-white text-center relative overflow-hidden">
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
            <svg class="absolute top-20 right-1/4 w-12 h-12 text-white opacity-[0.08] transform rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6v-2z"/></svg>
            <svg class="absolute bottom-20 left-1/4 w-16 h-16 text-[#1BA098] opacity-[0.12] transform -rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6v-2z"/></svg>
            <svg class="absolute top-1/3 left-10 w-8 h-8 text-white opacity-[0.05] transform rotate-45" fill="currentColor" viewBox="0 0 24 24"><path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6v-2z"/></svg>
        </div>
                <div class="relative z-10">
                    <img src="<?= base_url('assets/logoorion.png') ?>" alt="Logo" class="w-32 h-32 mx-auto mb-8 bg-[#ffffff] p-4 rounded-[24px]  -blue-900/20 object-contain">
                    <h2 class="text-4xl font-bold mb-4">Buat Akun Baru</h2>
                    <p class="text-xl text-blue-100/90 leading-relaxed">Bergabunglah dengan ribuan<br>pengguna lainnya.</p>
                </div>
            </div>
            <div class="flex-1 overflow-auto px-6 pt-8 pb-6"><button type="button" onclick="window.location.href='<?= site_url('auth/login') ?>'"
                    class="mb-6 p-2 -ml-2 rounded-full hover:bg-[#f5f1ec] transition-all">
                    <svg class="w-6 h-6 text-[#626260]" fill="none" stroke="currentColor" viewbox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg></button>
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-[#111111]">Buat Akun Baru</h1>
                    <p class="text-[#626260] text-sm mt-1">Daftar untuk mulai menggunakan Orion Clinic</p>
                </div>
                <form action="<?= site_url('auth/register') ?>" method="post" class="space-y-4">
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="bg-red-50 text-[#E53935] p-4 rounded-[16px] mb-4 text-sm">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>
                    <?php $errors = session('errors'); ?>
                    <?php if (! empty($errors)): ?>
                        <div class="bg-red-50 text-[#E53935] p-4 rounded-[16px] mb-4 text-sm">
                            <?= implode('<br>', $errors) ?>
                        </div>
                    <?php endif; ?>
                    <?= csrf_field() ?>
                    <div><label for="fullname-input" class="block text-sm font-medium text-gray-700 mb-2">Nama
                            Lengkap</label>
                        <div class="relative">
                            <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-[#7b7b78]"
                                fill="none" stroke="currentColor" viewbox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg><input type="text" id="fullname-input" name="name" value="<?= old('name') ?>" required placeholder="Nama lengkap Anda"
                                class="w-full pl-12 pr-4 py-3.5 border border-[#d3cec6] rounded-[16px] text-[#111111] bg-[#f5f1ec] focus:bg-[#ffffff] transition-all">
                        </div>
                    </div>
                    <div><label for="reg-email-input" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <div class="relative">
                            <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-[#7b7b78]"
                                fill="none" stroke="currentColor" viewbox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg><input type="email" id="reg-email-input" name="email" value="<?= old('email') ?>" required placeholder="nama@email.com"
                                class="w-full pl-12 pr-4 py-3.5 border border-[#d3cec6] rounded-[16px] text-[#111111] bg-[#f5f1ec] focus:bg-[#ffffff] transition-all">
                        </div>
                    </div>
                    <div><label for="phone-input" class="block text-sm font-medium text-gray-700 mb-2">Nomor
                            Telepon</label>
                        <div class="relative">
                            <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-[#7b7b78]"
                                fill="none" stroke="currentColor" viewbox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg><input type="tel" id="phone-input" name="phone" value="<?= old('phone') ?>" required placeholder="08xxxxxxxxxx"
                                class="w-full pl-12 pr-4 py-3.5 border border-[#d3cec6] rounded-[16px] text-[#111111] bg-[#f5f1ec] focus:bg-[#ffffff] transition-all">
                        </div>
                    </div>
                    <div><label for="reg-password-input" class="block text-sm font-medium text-gray-700 mb-2">Kata
                            Sandi</label>
                        <div class="relative">
                            <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-[#7b7b78]"
                                fill="none" stroke="currentColor" viewbox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg><input type="password" id="reg-password-input" name="password" required placeholder="Min. 8 karakter"
                                class="w-full pl-12 pr-4 py-3.5 border border-[#d3cec6] rounded-[16px] text-[#111111] bg-[#f5f1ec] focus:bg-[#ffffff] transition-all">
                        </div>
                    </div>
                    <div class="flex items-start pt-2"><input type="checkbox" id="terms-checkbox" required
                            class="mt-1 w-4 h-4 text-[#111111] border-gray-300 rounded focus:ring-blue-500"> <label
                            for="terms-checkbox" class="ml-3 text-sm text-[#626260]"> Saya menyetujui <span
                                class="text-[#111111] font-medium">Syarat &amp; Ketentuan</span> serta <span
                                class="text-[#111111] font-medium">Kebijakan Privasi</span> </label>
                    </div><button type="submit"
                        class="w-full btn-primary text-white py-4 rounded-[16px] font-semibold text-lg mt-4"> Daftar
                        Sekarang </button>
                </form>
                <p class="text-center mt-6 text-[#626260]">Sudah punya akun? <button type="button"
                        onclick="window.location.href='<?= site_url('auth/login') ?>'"
                        class="text-[#111111] font-semibold hover:text-[#111111]">Masuk</button></p>
            </div>
        </div>
<?= $this->endSection() ?>
