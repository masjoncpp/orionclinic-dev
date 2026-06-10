<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="register-screen" class="flex flex-col h-full bg-white md:absolute md:inset-0 md:z-50 md:flex-row">
            <!-- Desktop Banner -->
            <div class="hidden md:flex md:w-1/2 bg-gradient-to-br from-blue-600 to-blue-800 items-center justify-center p-12 text-white text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
                <div class="relative z-10">
                    <img src="<?= base_url('assets/logoorion.png') ?>" alt="Logo" class="w-32 h-32 mx-auto mb-8 bg-white p-4 rounded-3xl shadow-lg shadow-blue-900/20 object-contain">
                    <h2 class="text-4xl font-bold mb-4">Buat Akun Baru</h2>
                    <p class="text-xl text-blue-100/90 leading-relaxed">Bergabunglah dengan ribuan<br>pengguna lainnya.</p>
                </div>
            </div>
            <div class="flex-1 overflow-auto px-6 pt-8 pb-6"><button type="button" onclick="window.location.href='<?= site_url('auth/login') ?>'"
                    class="mb-6 p-2 -ml-2 rounded-full hover:bg-gray-100 transition-all">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewbox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg></button>
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Buat Akun Baru</h1>
                    <p class="text-gray-500 text-sm mt-1">Daftar untuk mulai menggunakan Orion Clinic</p>
                </div>
                <form action="<?= site_url('auth/register') ?>" method="post" class="space-y-4">
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-4 text-sm">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>
                    <?php $errors = session('errors'); ?>
                    <?php if (! empty($errors)): ?>
                        <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-4 text-sm">
                            <?= implode('<br>', $errors) ?>
                        </div>
                    <?php endif; ?>
                    <?= csrf_field() ?>
                    <div><label for="fullname-input" class="block text-sm font-medium text-gray-700 mb-2">Nama
                            Lengkap</label>
                        <div class="relative">
                            <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                                fill="none" stroke="currentColor" viewbox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg><input type="text" id="fullname-input" name="name" value="<?= old('name') ?>" required placeholder="Nama lengkap Anda"
                                class="w-full pl-12 pr-4 py-3.5 border border-gray-200 rounded-xl text-gray-800 bg-gray-50 focus:bg-white transition-all">
                        </div>
                    </div>
                    <div><label for="reg-email-input" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <div class="relative">
                            <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                                fill="none" stroke="currentColor" viewbox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg><input type="email" id="reg-email-input" name="email" value="<?= old('email') ?>" required placeholder="nama@email.com"
                                class="w-full pl-12 pr-4 py-3.5 border border-gray-200 rounded-xl text-gray-800 bg-gray-50 focus:bg-white transition-all">
                        </div>
                    </div>
                    <div><label for="phone-input" class="block text-sm font-medium text-gray-700 mb-2">Nomor
                            Telepon</label>
                        <div class="relative">
                            <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                                fill="none" stroke="currentColor" viewbox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg><input type="tel" id="phone-input" name="phone" value="<?= old('phone') ?>" required placeholder="08xxxxxxxxxx"
                                class="w-full pl-12 pr-4 py-3.5 border border-gray-200 rounded-xl text-gray-800 bg-gray-50 focus:bg-white transition-all">
                        </div>
                    </div>
                    <div><label for="reg-password-input" class="block text-sm font-medium text-gray-700 mb-2">Kata
                            Sandi</label>
                        <div class="relative">
                            <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                                fill="none" stroke="currentColor" viewbox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg><input type="password" id="reg-password-input" name="password" required placeholder="Min. 8 karakter"
                                class="w-full pl-12 pr-4 py-3.5 border border-gray-200 rounded-xl text-gray-800 bg-gray-50 focus:bg-white transition-all">
                        </div>
                    </div>
                    <div class="flex items-start pt-2"><input type="checkbox" id="terms-checkbox" required
                            class="mt-1 w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"> <label
                            for="terms-checkbox" class="ml-3 text-sm text-gray-600"> Saya menyetujui <span
                                class="text-blue-600 font-medium">Syarat &amp; Ketentuan</span> serta <span
                                class="text-blue-600 font-medium">Kebijakan Privasi</span> </label>
                    </div><button type="submit"
                        class="w-full btn-primary text-white py-4 rounded-xl font-semibold text-lg mt-4"> Daftar
                        Sekarang </button>
                </form>
                <p class="text-center mt-6 text-gray-600">Sudah punya akun? <button type="button"
                        onclick="window.location.href='<?= site_url('auth/login') ?>'"
                        class="text-blue-600 font-semibold hover:text-blue-700">Masuk</button></p>
            </div>
        </div>
<?= $this->endSection() ?>
