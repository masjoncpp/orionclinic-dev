<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="login-screen" class="flex flex-col h-full bg-[#ffffff] md:inset-0 md:z-50 md:flex-row">
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
            <h2 class="text-4xl font-bold mb-4">Orion Clinic</h2>
            <p class="text-xl text-blue-100/90 leading-relaxed">Solusi kesehatan terpadu<br>untuk keluarga modern.</p>
        </div>
    </div>
    <div class="flex-1 overflow-auto px-6 pt-12 pb-6">
        <div class="mx-auto w-full max-w-md">
            <div class="text-center mb-8 slide-up">
                <img src="<?= base_url('assets/logoorion.png') ?>" alt="Orion Clinic Logo" class="mx-auto mb-4 w-20 h-20 object-contain">
                <h1 id="login-title" class="text-2xl font-bold text-[#111111]">Selamat Datang</h1>
                <p class="text-[#626260] text-sm mt-1">Masuk ke akun Orion Clinic Anda</p>
            </div>

            <form action="<?= site_url('auth/login') ?>" method="post" class="space-y-4">
                <?= csrf_field() ?>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="bg-green-50 text-green-700 p-4 rounded-[16px] text-sm font-medium">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="bg-red-50 text-[#E53935] p-4 rounded-[16px] text-sm font-medium">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <div class="slide-up slide-up-delay-1">
                    <label for="email-input" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <div class="relative">
                        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-[#7b7b78]" fill="none" stroke="currentColor" viewbox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                        <input type="email" id="email-input" name="email" value="<?= old('email') ?>" placeholder="nama@email.com" required class="w-full pl-12 pr-4 py-3.5 border border-[#d3cec6] rounded-[16px] text-[#111111] bg-[#f5f1ec] focus:bg-[#ffffff] transition-all">
                    </div>
                </div>

                <div class="slide-up slide-up-delay-2">
                    <label for="password-input" class="block text-sm font-medium text-gray-700 mb-2">Kata Sandi</label>
                    <div class="relative">
                        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-[#7b7b78]" fill="none" stroke="currentColor" viewbox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <input type="password" id="password-input" name="password" placeholder="Masukkan kata sandi" required class="w-full pl-12 pr-4 py-3.5 border border-[#d3cec6] rounded-[16px] text-[#111111] bg-[#f5f1ec] focus:bg-[#ffffff] transition-all">
                    </div>
                </div>

                <div class="flex justify-end slide-up slide-up-delay-3">
                    <button type="button" class="text-sm text-[#111111] font-medium hover:text-[#111111]">Lupa kata sandi?</button>
                </div>

                <button type="submit" class="w-full btn-primary text-white py-4 rounded-[16px] font-semibold text-lg slide-up slide-up-delay-3">
                    Masuk
                </button>
            </form>

            <p class="text-center mt-8 text-[#626260]">
                Belum punya akun?
                <button type="button" onclick="window.location.href='<?= site_url('auth/register') ?>'" class="text-[#111111] font-semibold hover:text-[#111111]">Daftar</button>
            </p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
