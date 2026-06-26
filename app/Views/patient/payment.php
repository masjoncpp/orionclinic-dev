<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="h-full bg-[#f5f1ec] overflow-y-auto fade-in">
    <!-- Header -->
    <div class="bg-[#ffffff] px-4 py-4 border-b border-[#d3cec6] sticky top-0 z-10 flex items-center justify-center">
        <h1 class="text-lg font-bold text-[#111111]">Pembayaran Konsultasi</h1>
    </div>

    <div class="p-5 max-w-lg mx-auto pb-24">
        
        <!-- Info Card -->
        <div class="bg-[#ffffff] rounded-[24px] p-6 shadow-sm border border-gray-100 mb-6">
            <h2 class="text-sm font-semibold text-[#626260] mb-4">Rincian Tagihan</h2>
            
            <?php if ($payment['type'] == 'consultation'): ?>
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-[#ebe7e1] rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-[#111111]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <p class="font-bold text-[#111111]"><?= esc($appointment['doctor_name'] ?? 'Dokter') ?></p>
                        <p class="text-xs text-[#7b7b78]"><?= esc($appointment['specialization'] ?? 'Spesialis') ?></p>
                    </div>
                </div>

                <div class="space-y-3">
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-[#7b7b78]">Jadwal Konsultasi</span>
                        <span class="font-medium text-[#111111]"><?= date('d M Y', strtotime($appointment['appointment_date'])) ?>, <?= date('H:i', strtotime($appointment['time_slot'])) ?> WIB</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-[#7b7b78]">Biaya Konsultasi</span>
                        <span class="font-medium text-[#111111]">Rp <?= number_format($payment['amount'], 0, ',', '.') ?></span>
                    </div>
            <?php else: ?>
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-green-50 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                    </div>
                    <div>
                        <p class="font-bold text-[#111111]">Tebus Obat Resep</p>
                        <p class="text-xs text-[#7b7b78]">Dari <?= esc($appointment['doctor_name'] ?? 'Dokter') ?></p>
                    </div>
                </div>

                <div class="space-y-3">
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-[#7b7b78]">Total Biaya Obat</span>
                        <span class="font-medium text-[#111111]">Rp <?= number_format($payment['amount'], 0, ',', '.') ?></span>
                    </div>
            <?php endif; ?>
                <div class="flex justify-between items-center text-sm">
                    <span class="text-[#7b7b78]">Biaya Admin</span>
                    <span class="font-medium text-[#111111]">Rp 2.500</span>
                </div>
                
                <div class="h-px bg-gray-100 my-4"></div>
                
                <div class="flex justify-between items-center">
                    <span class="font-bold text-[#111111]">Total Pembayaran</span>
                    <span class="font-extrabold text-xl text-[#003E7E]">Rp <?= number_format($payment['amount'] + 2500, 0, ',', '.') ?></span>
                </div>
            </div>
        </div>

        <form action="<?= base_url('patient/process_payment') ?>" method="POST" id="payment-form" enctype="multipart/form-data">
            <input type="hidden" name="payment_id" value="<?= $payment['id'] ?>">
            
            <h2 class="text-sm font-semibold text-[#626260] mb-4 px-2">Metode Pembayaran</h2>
            
            <div class="space-y-3 mb-6">
                <!-- Virtual Account -->
                <label class="block relative">
                    <input type="radio" name="payment_method" value="bca_va" class="peer sr-only payment-method-radio" checked>
                    <div class="bg-[#ffffff] rounded-[16px] p-4 border-2 border-transparent peer-checked:border-[#003E7E] peer-checked:bg-[#f8faff] cursor-pointer transition-all flex items-center shadow-sm">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4 text-[#003E7E] font-bold text-xs">
                            BCA
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-[#111111] text-sm">BCA Virtual Account</h3>
                            <p class="text-xs text-[#7b7b78]">Verifikasi otomatis</p>
                        </div>
                        <div class="w-5 h-5 rounded-full border-2 border-gray-300 peer-checked:border-[#003E7E] flex items-center justify-center">
                            <div class="w-2.5 h-2.5 bg-[#003E7E] rounded-full opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                        </div>
                    </div>
                </label>

                <!-- E-Wallet -->
                <label class="block relative">
                    <input type="radio" name="payment_method" value="gopay" class="peer sr-only payment-method-radio">
                    <div class="bg-[#ffffff] rounded-[16px] p-4 border-2 border-transparent peer-checked:border-[#003E7E] peer-checked:bg-[#f8faff] cursor-pointer transition-all flex items-center shadow-sm">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4 text-green-600 font-bold text-xs">
                            GPY
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-[#111111] text-sm">GoPay</h3>
                            <p class="text-xs text-[#7b7b78]">Verifikasi otomatis</p>
                        </div>
                        <div class="w-5 h-5 rounded-full border-2 border-gray-300 peer-checked:border-[#003E7E] flex items-center justify-center">
                            <div class="w-2.5 h-2.5 bg-[#003E7E] rounded-full opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                        </div>
                    </div>
                </label>

                <!-- Transfer Manual -->
                <label class="block relative">
                    <input type="radio" name="payment_method" value="manual_transfer" class="peer sr-only payment-method-radio">
                    <div class="bg-[#ffffff] rounded-[16px] p-4 border-2 border-transparent peer-checked:border-[#003E7E] peer-checked:bg-[#f8faff] cursor-pointer transition-all flex items-center shadow-sm">
                        <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-4 text-orange-600 font-bold text-xs">
                            TRF
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-[#111111] text-sm">Transfer Manual</h3>
                            <p class="text-xs text-[#7b7b78]">Verifikasi manual max 1x24 jam</p>
                        </div>
                        <div class="w-5 h-5 rounded-full border-2 border-gray-300 peer-checked:border-[#003E7E] flex items-center justify-center">
                            <div class="w-2.5 h-2.5 bg-[#003E7E] rounded-full opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                        </div>
                    </div>
                </label>
            </div>

            <div id="upload-section" class="mb-8 hidden bg-[#ffffff] p-5 rounded-[16px] border border-gray-100 shadow-sm transition-all">
                <h3 class="text-sm font-bold text-[#111111] mb-2">Upload Bukti Transfer</h3>
                <p class="text-xs text-[#626260] mb-4">Transfer ke BCA 1234567890 a.n. Orion Clinic</p>
                <div class="flex items-center justify-center w-full">
                    <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-[#d3cec6] border-dashed rounded-[12px] cursor-pointer bg-[#f5f1ec] hover:bg-gray-100 transition-colors">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-6 h-6 mb-2 text-[#7b7b78]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            <p class="text-xs text-[#7b7b78]"><span class="font-bold">Klik untuk upload</span> bukti pembayaran</p>
                            <p id="file-name" class="text-xs text-[#003E7E] mt-2 font-semibold hidden"></p>
                        </div>
                        <input id="bukti_transfer" name="bukti_transfer" type="file" class="hidden" accept="image/jpeg, image/png, application/pdf" />
                    </label>
                </div>
            </div>

            <!-- Bottom Button -->
            <div class="mt-8 pt-4 border-t border-gray-100">
                <button type="submit" class="w-full bg-[#003E7E] text-white font-bold py-4 px-4 rounded-[16px] shadow-[0_8px_20px_rgba(0,62,126,0.25)] hover:bg-[#002855] transition-all flex items-center justify-center">
                    Bayar Sekarang
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const radios = document.querySelectorAll('.payment-method-radio');
    const uploadSection = document.getElementById('upload-section');
    const fileInput = document.getElementById('bukti_transfer');
    const fileNameDisplay = document.getElementById('file-name');

    radios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'manual_transfer') {
                uploadSection.classList.remove('hidden');
                fileInput.setAttribute('required', 'required');
            } else {
                uploadSection.classList.add('hidden');
                fileInput.removeAttribute('required');
                // Optional: clear file input
                // fileInput.value = '';
                // fileNameDisplay.classList.add('hidden');
            }
        });
    });

    fileInput.addEventListener('change', function() {
        if (this.files && this.files.length > 0) {
            fileNameDisplay.textContent = this.files[0].name;
            fileNameDisplay.classList.remove('hidden');
        } else {
            fileNameDisplay.classList.add('hidden');
        }
    });
});
</script>

<?= $this->endSection() ?>
