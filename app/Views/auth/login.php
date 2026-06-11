<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="login-screen" class="flex flex-col h-full bg-white md:inset-0 md:z-50 md:flex-row">
    <div class="hidden md:flex md:w-1/2 bg-gradient-to-br from-blue-600 to-blue-800 items-center justify-center p-12 text-white text-center relative overflow-hidden">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        <div class="relative z-10">
            <img src="<?= base_url('assets/logoorion.png') ?>" alt="Logo" class="w-32 h-32 mx-auto mb-8 bg-white p-4 rounded-3xl shadow-lg shadow-blue-900/20 object-contain">
            <h2 class="text-4xl font-bold mb-4">Orion Clinic</h2>
            <p class="text-xl text-blue-100/90 leading-relaxed">Solusi kesehatan terpadu<br>untuk keluarga modern.</p>
        </div>
    </div>
    <div class="flex-1 overflow-auto px-6 pt-12 pb-6">
        <div class="mx-auto w-full max-w-md">
            <div class="text-center mb-8 slide-up">
                <img src="<?= base_url('assets/logoorion.png') ?>" alt="Orion Clinic Logo" class="mx-auto mb-4 w-20 h-20 object-contain">
                <h1 id="login-title" class="text-2xl font-bold text-gray-800">Selamat Datang</h1>
                <p class="text-gray-500 text-sm mt-1">Masuk ke akun Orion Clinic Anda</p>
            </div>

            <form action="<?= site_url('auth/login') ?>" method="post" class="space-y-4">
                <?= csrf_field() ?>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="bg-green-50 text-green-700 p-4 rounded-xl text-sm font-medium">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="bg-red-50 text-red-600 p-4 rounded-xl text-sm font-medium">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <div class="slide-up slide-up-delay-1">
                    <label for="email-input" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <div class="relative">
                        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewbox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                        <input type="email" id="email-input" name="email" value="<?= old('email') ?>" placeholder="nama@email.com" required class="w-full pl-12 pr-4 py-3.5 border border-gray-200 rounded-xl text-gray-800 bg-gray-50 focus:bg-white transition-all">
                    </div>
                </div>

                <div class="slide-up slide-up-delay-2">
                    <label for="password-input" class="block text-sm font-medium text-gray-700 mb-2">Kata Sandi</label>
                    <div class="relative">
                        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewbox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <input type="password" id="password-input" name="password" placeholder="Masukkan kata sandi" required class="w-full pl-12 pr-4 py-3.5 border border-gray-200 rounded-xl text-gray-800 bg-gray-50 focus:bg-white transition-all">
                    </div>
                </div>

                <div class="flex justify-end slide-up slide-up-delay-3">
                    <button type="button" class="text-sm text-blue-600 font-medium hover:text-blue-700">Lupa kata sandi?</button>
                </div>

                <button type="submit" class="w-full btn-primary text-white py-4 rounded-xl font-semibold text-lg slide-up slide-up-delay-3">
                    Masuk
                </button>
            </form>

            <p class="text-center mt-8 text-gray-600">
                Belum punya akun?
                <button type="button" onclick="window.location.href='<?= site_url('auth/register') ?>'" class="text-blue-600 font-semibold hover:text-blue-700">Daftar</button>
            </p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
