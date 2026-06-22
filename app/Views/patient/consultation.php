<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="doctor-screen" class="flex flex-col h-full bg-[#f5f1ec] fade-in">

    <div class="flex-1 overflow-y-auto pb-20 md:pb-6">

        <!-- Header -->
        <div class="bg-[#ffffff] px-5 py-4 border-b border-[#d3cec6] flex items-center sticky top-0 z-10 ">
            <button onclick="window.location.href='<?= base_url('patient') ?>'"
                class="p-2 -ml-1 rounded-[16px] hover:bg-[#f5f1ec] transition-all mr-2">
                <svg class="w-5 h-5 text-[#626260]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <h1 class="text-base font-bold text-[#111111]">Konsultasi Dokter</h1>
        </div>

        <div class="max-w-5xl mx-auto">

            <!-- Specialization Filter -->
            <div class="px-5 py-4 bg-[#ffffff] border-b border-gray-50">
                <div class="flex space-x-2 overflow-x-auto pb-1 scrollbar-hide">
                    <button class="flex-shrink-0 px-4 py-1.5 bg-[#003E7E] text-[#ffffff] rounded-full text-sm font-semibold  -blue-200">Semua</button>
                    <button class="flex-shrink-0 px-4 py-1.5 bg-[#f5f1ec] text-[#626260] rounded-full text-sm font-medium hover:bg-gray-200 transition-all">Umum</button>
                    <button class="flex-shrink-0 px-4 py-1.5 bg-[#f5f1ec] text-[#626260] rounded-full text-sm font-medium hover:bg-gray-200 transition-all">Anak</button>
                    <button class="flex-shrink-0 px-4 py-1.5 bg-[#f5f1ec] text-[#626260] rounded-full text-sm font-medium hover:bg-gray-200 transition-all">Jantung</button>
                    <button class="flex-shrink-0 px-4 py-1.5 bg-[#f5f1ec] text-[#626260] rounded-full text-sm font-medium hover:bg-gray-200 transition-all">Kulit</button>
                    <button class="flex-shrink-0 px-4 py-1.5 bg-[#f5f1ec] text-[#626260] rounded-full text-sm font-medium hover:bg-gray-200 transition-all">Gigi</button>
                </div>
            </div>

            <!-- Doctor List -->
            <div class="p-5 space-y-3 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-4 md:space-y-0">

                <?php if (!empty($doctors)): ?>
                    <?php foreach ($doctors as $doctor): ?>
                        <!-- Doctor Card -->
                        <div class="bg-[#ffffff] rounded-[24px] p-4  card-hover border border-gray-50 <?= $doctor['status'] == 'offline' ? 'opacity-80' : '' ?>">
                            <div class="flex items-start">
                                <div class="w-14 h-14 <?= $doctor['status'] == 'online' ? 'bg-[#ebe7e1]' : 'bg-[#f5f1ec]' ?> rounded-[24px] flex items-center justify-center mr-4 flex-shrink-0">
                                    <svg class="w-8 h-8 <?= $doctor['status'] == 'online' ? 'text-[#111111]' : 'text-[#7b7b78]' ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-start justify-between mb-0.5">
                                        <h4 class="font-bold text-[#111111] text-sm"><?= esc($doctor['name']) ?></h4>
                                        <div class="flex items-center ml-2 flex-shrink-0">
                                            <svg class="w-3.5 h-3.5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                            <span class="text-xs text-[#626260] ml-1 font-semibold">4.8</span>
                                        </div>
                                    </div>
                                    <p class="text-xs text-[#626260] font-medium"><?= esc($doctor['specialization']) ?></p>
                                    <p class="text-xs text-[#7b7b78] mt-0.5"><?= esc($doctor['experience_years']) ?> tahun pengalaman</p>
                                    <div class="flex items-center justify-between mt-3">
                                        <div class="flex items-center">
                                            <span class="w-2 h-2 <?= $doctor['status'] == 'online' ? 'bg-[#4CAF50] status-online' : 'bg-gray-300' ?> rounded-full mr-1.5"></span>
                                            <span class="text-xs <?= $doctor['status'] == 'online' ? 'text-[#111111]' : 'text-[#7b7b78]' ?> font-semibold"><?= ucfirst($doctor['status']) ?></span>
                                        </div>
                                        <span class="text-[#111111] font-bold text-sm">Rp <?= number_format($doctor['consultation_fee'], 0, ',', '.') ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php if ($doctor['status'] == 'online'): ?>
                                <button type="button" onclick="event.stopPropagation(); openBookingModal(<?= $doctor['id'] ?>, '<?= esc(addslashes($doctor['name'])) ?>', <?= $doctor['consultation_fee'] ?>)"
                                    class="mt-3 w-full py-2 bg-[#003E7E] text-[#ffffff] rounded-[16px] text-xs font-semibold hover:bg-[#002855] transition-all">
                                    Konsultasi Sekarang
                                </button>
                            <?php else: ?>
                                <button disabled
                                    class="mt-3 w-full py-2 bg-[#f5f1ec] text-[#7b7b78] rounded-[16px] text-xs font-semibold cursor-not-allowed">
                                    Tidak Tersedia
                                </button>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-full py-10 text-center">
                        <p class="text-[#626260]">Tidak ada dokter yang tersedia saat ini.</p>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>

</div>

<!-- Booking Modal -->
<div id="booking-modal" class="hidden fixed inset-0 z-50 flex items-end md:items-center justify-center bg-[#111111]/40 backdrop-blur-sm transition-opacity">
    <div class="bg-white rounded-t-[24px] md:rounded-[24px] shadow-2xl w-full max-w-md mx-auto overflow-hidden transform transition-transform translate-y-full md:translate-y-0" id="booking-modal-content">
        <div class="px-6 py-4 border-b border-[#d3cec6] flex justify-between items-center bg-[#f5f1ec]">
            <h3 class="text-base font-bold text-[#111111]">Mulai Konsultasi</h3>
            <button type="button" onclick="closeBookingModal()" class="p-2 text-[#7b7b78] hover:bg-[#ebe7e1] rounded-full transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <div class="p-6">
            <form action="<?= base_url('patient/book_appointment') ?>" method="POST">
                <input type="hidden" name="doctor_id" id="modal-doctor-id" value="">
                
                <div class="mb-4">
                    <p class="text-xs text-[#7b7b78] mb-1">Dokter Tujuan</p>
                    <p class="text-sm font-bold text-[#111111]" id="modal-doctor-name">-</p>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="appointment_date" class="block text-xs font-semibold text-[#111111] mb-2">Tanggal</label>
                        <input type="date" name="appointment_date" id="appointment_date" required min="<?= date('Y-m-d') ?>" 
                            class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-sm text-[#111111] focus:outline-none focus:ring-2 focus:ring-[#003E7E]/50 focus:border-[#003E7E] transition-all">
                    </div>
                    <div>
                        <label for="time_slot" class="block text-xs font-semibold text-[#111111] mb-2">Waktu (Format 24 Jam)</label>
                        <input type="text" name="time_slot" id="time_slot" required 
                            placeholder="Misal: 14:30" pattern="^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$" maxlength="5"
                            class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-sm text-[#111111] focus:outline-none focus:ring-2 focus:ring-[#003E7E]/50 focus:border-[#003E7E] transition-all">
                    </div>
                </div>

                <div class="mb-5">
                    <label for="reason" class="block text-xs font-semibold text-[#111111] mb-2">Keluhan Utama (Wajib)</label>
                    <textarea name="reason" id="reason" rows="3" required
                        placeholder="Ceritakan secara singkat keluhan yang Anda rasakan saat ini..."
                        class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-sm text-[#111111] focus:outline-none focus:ring-2 focus:ring-[#003E7E]/50 focus:border-[#003E7E] transition-all resize-none"></textarea>
                </div>
                
                <div class="flex items-center justify-between py-3 mb-6 border-t border-b border-[#ebe7e1]">
                    <span class="text-sm font-semibold text-[#626260]">Biaya Konsultasi</span>
                    <span class="text-base font-bold text-[#111111]" id="modal-fee">Rp 0</span>
                </div>

                <button type="submit"
                        class="w-full py-3.5 bg-[#003E7E] text-white rounded-[16px] font-bold text-sm hover:bg-[#002855] transition-all shadow-lg shadow-blue-500/20">
                    Ajukan Jadwal Konsultasi
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function openBookingModal(doctorId, doctorName, fee) {
        document.getElementById('modal-doctor-id').value = doctorId;
        document.getElementById('modal-doctor-name').textContent = doctorName;
        document.getElementById('modal-fee').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(fee);
        
        const modal = document.getElementById('booking-modal');
        const content = document.getElementById('booking-modal-content');
        
        modal.classList.remove('hidden');
        // Slight delay to allow display:block to apply before animation
        setTimeout(() => {
            content.classList.remove('translate-y-full');
        }, 10);
    }

    function closeBookingModal() {
        const modal = document.getElementById('booking-modal');
        const content = document.getElementById('booking-modal-content');
        
        content.classList.add('translate-y-full');
        setTimeout(() => {
            modal.classList.add('hidden');
            document.getElementById('reason').value = ''; // reset
        }, 300);
    }
</script>

<?= $this->include('components/bottom_nav') ?>
<?= $this->endSection() ?>
