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

            <div class="mt-6 slide-up slide-up-delay-4">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500">atau masuk dengan</span>
                    </div>
                </div>
                <div class="mt-4 grid grid-cols-2 gap-3">
                    <button type="button" class="flex items-center justify-center py-3 px-4 border border-gray-200 rounded-xl hover:bg-gray-50 transition-all">
                        <svg class="w-5 h-5 mr-2" viewbox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                        </svg>
                        <span class="text-sm font-medium text-gray-700">Google</span>
                    </button>
                    <button type="button" class="flex items-center justify-center py-3 px-4 border border-gray-200 rounded-xl hover:bg-gray-50 transition-all">
                        <svg class="w-5 h-5 mr-2" fill="#000000" viewbox="0 0 24 24">
                            <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z" />
                        </svg>
                        <span class="text-sm font-medium text-gray-700">Apple</span>
                    </button>
                </div>
            </div>

            <p class="text-center mt-8 text-gray-600">
                Belum punya akun?
                <button type="button" onclick="window.location.href='<?= site_url('auth/register') ?>'" class="text-blue-600 font-semibold hover:text-blue-700">Daftar</button>
            </p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
