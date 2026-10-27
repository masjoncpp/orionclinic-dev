<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="wellness-screen" class="flex flex-col h-full bg-[#f5f1ec] fade-in">

    <div class="flex-1 overflow-y-auto pb-20 md:pb-6">

        <!-- Header -->
        <div class="bg-[#003E7E] relative overflow-hidden px-5 pt-8 pb-16 md:pb-20">

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

            <div class="flex items-center mb-5">
                <button onclick="window.location.href='<?= base_url('patient') ?>'"
                    class="p-2 -ml-1 bg-[#ffffff]/20 rounded-[16px] hover:bg-[#ffffff]/30 transition-all mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <div>
                    <h1 class="text-base font-bold text-white">Wellness & Kesehatan</h1>
                    <p class="text-white/60 text-xs">Pantau kesehatanmu hari ini</p>
                </div>
            </div>
        </div>

        <div class="px-5 max-w-2xl mx-auto">

            <!-- Health Score Card -->
            <div class="-mt-8 mb-5 relative z-10">
                <div class="bg-[#ffffff] rounded-[24px]  p-5">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-bold text-[#111111] text-sm">Skor Kesehatan</h3>
                        <span class="text-xs text-[#7b7b78] bg-[#f5f1ec] px-2.5 py-1 rounded-full">Hari ini</span>
                    </div>
                    <div class="flex items-center">
                        <div class="relative w-20 h-20 mr-5 flex-shrink-0">
                            <svg class="w-20 h-20 transform -rotate-90" viewBox="0 0 36 36">
                                <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#e5e7eb" stroke-width="3"/>
                                <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#10b981" stroke-width="3"
                                    stroke-dasharray="75 25" stroke-linecap="round"/>
                            </svg>
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <span class="text-xl font-bold text-[#111111]">75</span>
                                <span class="text-xs text-[#7b7b78]">/ 100</span>
                            </div>
                        </div>
                        <div class="flex-1 space-y-2.5">
                            <div>
                                <div class="flex justify-between text-xs text-[#626260] mb-1">
                                    <span class="font-medium">Aktivitas</span>
                                    <span class="font-bold text-[#111111]">80%</span>
                                </div>
                                <div class="h-2 bg-[#f5f1ec] rounded-full">
                                    <div class="h-2 bg-blue-500 rounded-full transition-all" style="width:80%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-xs text-[#626260] mb-1">
                                    <span class="font-medium">Tidur</span>
                                    <span class="font-bold text-[#111111]">65%</span>
                                </div>
                                <div class="h-2 bg-[#f5f1ec] rounded-full">
                                    <div class="h-2 bg-purple-500 rounded-full transition-all" style="width:65%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-xs text-[#626260] mb-1">
                                    <span class="font-medium">Hidrasi</span>
                                    <span class="font-bold text-[#111111]">90%</span>
                                </div>
                                <div class="h-2 bg-[#f5f1ec] rounded-full">
                                    <div class="h-2 bg-teal-500 rounded-full transition-all" style="width:90%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="mb-5">
                <h3 class="font-bold text-[#111111] text-sm mb-3">Statistik Hari Ini</h3>
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-[#ffffff] rounded-[24px] p-4 ">
                        <div class="flex items-center mb-2">
                            <div class="w-8 h-8 bg-red-100 rounded-[16px] flex items-center justify-center mr-2">
                                <svg class="w-4 h-4 text-[#E53935]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-[#626260]">Detak Jantung</span>
                        </div>
                        <p class="text-xl font-bold text-[#111111]">72 <span class="text-xs font-normal text-[#7b7b78]">bpm</span></p>
                        <span class="text-xs text-[#111111] font-bold">Normal</span>
                    </div>

                    <div class="bg-[#ffffff] rounded-[24px] p-4 ">
                        <div class="flex items-center mb-2">
                            <div class="w-8 h-8 bg-[#ebe7e1] rounded-[16px] flex items-center justify-center mr-2">
                                <svg class="w-4 h-4 text-[#111111]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-[#626260]">Langkah Kaki</span>
                        </div>
                        <p class="text-xl font-bold text-[#111111]">6.240 <span class="text-xs font-normal text-[#7b7b78]">/ 10k</span></p>
                        <span class="text-xs text-[#FF9800] font-bold">62% target</span>
                    </div>

                    <div class="bg-[#ffffff] rounded-[24px] p-4 ">
                        <div class="flex items-center mb-2">
                            <div class="w-8 h-8 bg-[#ebe7e1] rounded-[16px] flex items-center justify-center mr-2">
                                <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-[#626260]">Air Minum</span>
                        </div>
                        <p class="text-xl font-bold text-[#111111]">1,8 <span class="text-xs font-normal text-[#7b7b78]">/ 2L</span></p>
                        <span class="text-xs text-[#111111] font-bold">90% target</span>
                    </div>

                    <div class="bg-[#ffffff] rounded-[24px] p-4 ">
                        <div class="flex items-center mb-2">
                            <div class="w-8 h-8 bg-[#ebe7e1] rounded-[16px] flex items-center justify-center mr-2">
                                <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-[#626260]">Tidur</span>
                        </div>
                        <p class="text-xl font-bold text-[#111111]">6,5 <span class="text-xs font-normal text-[#7b7b78]">jam</span></p>
                        <span class="text-xs text-[#FF9800] font-bold">Kurang ideal</span>
                    </div>
                </div>
            </div>

            <!-- Tips Kesehatan -->
            <div class="mb-5">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="font-bold text-[#111111] text-sm">Tips Kesehatan</h3>
                    <button type="button" onclick="showAllHealthTips()" class="text-xs text-[#003E7E] font-bold hover:underline">Lihat Semua</button>
                </div>
                <div class="space-y-3">
                    <div onclick="showWellnessTip('Jaga Kesehatan Jantung', '1. Rutin berolahraga ringan minimal 30 menit sehari.\n2. Kurangi konsumsi garam berlebih dan makanan olahan.\n3. Perbanyak konsumsi sayur, buah, dan lemak sehat (omega-3).\n4. Kelola stres dengan baik dan tidur cukup 7-8 jam.\n5. Rutin periksa tekanan darah dan kolesterol secara berkala.')" class="bg-[#ffffff] rounded-[24px] p-4 border border-[#ebe7e1] flex items-center space-x-3 cursor-pointer card-hover">
                        <div class="w-12 h-12 bg-gradient-to-br from-[#E53935] to-rose-400 rounded-[16px] flex items-center justify-center flex-shrink-0 shadow-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-[#111111] text-sm">Jaga Kesehatan Jantung</h4>
                            <p class="text-xs text-[#7b7b78] mt-0.5">5 tips mudah untuk menjaga kesehatan jantung</p>
                        </div>
                        <svg class="w-4 h-4 text-[#7b7b78] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>

                    <div onclick="showWellnessTip('Manfaat Vitamin D', '1. Berjemur di bawah sinar matahari pagi (pukul 07.00-09.00) selama 10-15 menit.\n2. Vitamin D membantu penyerapan kalsium untuk kekuatan tulang dan gigi.\n3. Mendukung sistem kekebalan tubuh agar tidak mudah terserang infeksi.\n4. Sumber makanan kaya Vitamin D: ikan salmon, kuning telur, susu terfortifikasi.')" class="bg-[#ffffff] rounded-[24px] p-4 border border-[#ebe7e1] flex items-center space-x-3 cursor-pointer card-hover">
                        <div class="w-12 h-12 bg-gradient-to-br from-[#FF9800] to-amber-400 rounded-[16px] flex items-center justify-center flex-shrink-0 shadow-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-[#111111] text-sm">Manfaat Vitamin D</h4>
                            <p class="text-xs text-[#7b7b78] mt-0.5">Pentingnya sinar matahari pagi untuk tubuh sehat</p>
                        </div>
                        <svg class="w-4 h-4 text-[#7b7b78] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>

                    <div onclick="showWellnessTip('Pentingnya Hidrasi', '1. Minum minimal 8 gelas (2 liter) air putih setiap hari.\n2. Awali pagi hari dengan segelas air hangat untuk mengaktifkan metabolisme.\n3. Jangan tunggu haus—rasa haus adalah tanda tubuh sudah mulai dehidrasi.\n4. Kurangi minuman tinggi gula dan kafein berlebih.')" class="bg-[#ffffff] rounded-[24px] p-4 border border-[#ebe7e1] flex items-center space-x-3 cursor-pointer card-hover">
                        <div class="w-12 h-12 bg-gradient-to-br from-[#1BA098] to-teal-400 rounded-[16px] flex items-center justify-center flex-shrink-0 shadow-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-[#111111] text-sm">Pentingnya Hidrasi</h4>
                            <p class="text-xs text-[#7b7b78] mt-0.5">Cara mudah memenuhi kebutuhan air putih harian</p>
                        </div>
                        <svg class="w-4 h-4 text-[#7b7b78] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Reminders -->
            <div class="mb-5">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="font-bold text-[#111111] text-sm">Pengingat Hari Ini</h3>
                    <button type="button" onclick="addWellnessReminder()" class="text-xs text-[#003E7E] font-bold bg-[#ebe7e1] px-3 py-1.5 rounded-[12px] hover:bg-[#d3cec6] transition-all">+ Tambah</button>
                </div>
                <div id="reminders-list" class="space-y-3">
                    <div onclick="toggleReminder(this)" class="bg-[#ffffff] rounded-[24px] p-4 border border-[#ebe7e1] flex items-center cursor-pointer transition-all hover:border-[#003E7E]/30">
                        <div class="w-9 h-9 bg-yellow-100 rounded-[16px] flex items-center justify-center mr-3 flex-shrink-0">
                            <svg class="w-4 h-4 text-[#FF9800]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-[#111111]">Minum Obat / Vitamin</p>
                            <p class="text-xs text-[#7b7b78]">08:00, 14:00, 20:00 WIB</p>
                        </div>
                        <div class="reminder-check w-6 h-6 bg-[#4CAF50] rounded-full flex items-center justify-center flex-shrink-0" data-done="1">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                    </div>

                    <div onclick="toggleReminder(this)" class="bg-[#ffffff] rounded-[24px] p-4 border border-[#ebe7e1] flex items-center cursor-pointer transition-all hover:border-[#003E7E]/30">
                        <div class="w-9 h-9 bg-[#ebe7e1] rounded-[16px] flex items-center justify-center mr-3 flex-shrink-0">
                            <svg class="w-4 h-4 text-[#111111]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-[#111111]">Minum Air Putih</p>
                            <p class="text-xs text-[#7b7b78]">Target 8 gelas per hari</p>
                        </div>
                        <div class="reminder-check w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center flex-shrink-0" data-done="0"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<script>
function showWellnessTip(title, body) {
    Swal.fire({
        title: title,
        html: '<div class="text-left text-sm text-[#626260] leading-relaxed whitespace-pre-line bg-[#f5f1ec] p-4 rounded-[16px] border border-[#d3cec6]">' + body + '</div>',
        confirmButtonText: 'Tutup',
        confirmButtonColor: '#003E7E',
        customClass: { popup: 'rounded-[24px]' }
    });
}

function showAllHealthTips() {
    Swal.fire({
        title: 'Panduan Hidup Sehat Orion Clinic',
        html: `<div class="text-left space-y-3 text-xs text-[#626260]">
            <div class="p-3 bg-[#f5f1ec] rounded-[14px] border border-[#d3cec6]"><strong class="text-[#111111] block mb-1">❤️ Kesehatan Jantung</strong>Olahraga 30 menit/hari, kurangi garam & lemak jenuh, tidur 7-8 jam.</div>
            <div class="p-3 bg-[#f5f1ec] rounded-[14px] border border-[#d3cec6]"><strong class="text-[#111111] block mb-1">☀️ Vitamin D & Imunitas</strong>Berjemur 10-15 menit pukul 07.00-09.00 pagi untuk tulang & daya tahan tubuh.</div>
            <div class="p-3 bg-[#f5f1ec] rounded-[14px] border border-[#d3cec6]"><strong class="text-[#111111] block mb-1">💧 Hidrasi Optimal</strong>Minum 8 gelas (2L) air putih per hari agar fungsi organ dan konsentrasi terjaga.</div>
        </div>`,
        confirmButtonText: 'Mengerti',
        confirmButtonColor: '#003E7E',
        customClass: { popup: 'rounded-[24px]' }
    });
}

function toggleReminder(el) {
    const check = el.querySelector('.reminder-check');
    if (!check) return;
    const isDone = check.getAttribute('data-done') === '1';
    if (isDone) {
        check.setAttribute('data-done', '0');
        check.className = 'reminder-check w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center flex-shrink-0';
        check.innerHTML = '';
    } else {
        check.setAttribute('data-done', '1');
        check.className = 'reminder-check w-6 h-6 bg-[#4CAF50] rounded-full flex items-center justify-center flex-shrink-0';
        check.innerHTML = '<svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>';
    }
}

function addWellnessReminder() {
    Swal.fire({
        title: 'Tambah Pengingat Baru',
        html: `
            <input id="swal-rem-title" class="w-full px-4 py-3 mb-3 bg-[#f5f1ec] border border-[#d3cec6] rounded-[14px] text-sm" placeholder="Contoh: Olahraga Sore">
            <input id="swal-rem-desc" class="w-full px-4 py-3 bg-[#f5f1ec] border border-[#d3cec6] rounded-[14px] text-sm" placeholder="Waktu / Catatan (misal: 16:30 WIB)">
        `,
        showCancelButton: true,
        confirmButtonText: 'Simpan',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#003E7E',
        preConfirm: () => {
            const title = document.getElementById('swal-rem-title').value.trim();
            const desc = document.getElementById('swal-rem-desc').value.trim() || 'Hari ini';
            if (!title) {
                Swal.showValidationMessage('Nama pengingat wajib diisi');
                return false;
            }
            return { title, desc };
        }
    }).then((res) => {
        if (res.isConfirmed && res.value) {
            const list = document.getElementById('reminders-list');
            const item = document.createElement('div');
            item.className = 'bg-[#ffffff] rounded-[24px] p-4 border border-[#ebe7e1] flex items-center cursor-pointer transition-all hover:border-[#003E7E]/30';
            item.setAttribute('onclick', 'toggleReminder(this)');
            item.innerHTML = `
                <div class="w-9 h-9 bg-[#ebe7e1] rounded-[16px] flex items-center justify-center mr-3 flex-shrink-0">
                    <svg class="w-4 h-4 text-[#003E7E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-[#111111]">${$('<div>').text(res.value.title).html()}</p>
                    <p class="text-xs text-[#7b7b78]">${$('<div>').text(res.value.desc).html()}</p>
                </div>
                <div class="reminder-check w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center flex-shrink-0" data-done="0"></div>
            `;
            list.appendChild(item);
            Toast.fire({ icon: 'success', title: 'Pengingat ditambahkan' });
        }
    });
}
</script>

<?= $this->include('components/bottom_nav') ?>
<?= $this->endSection() ?>
