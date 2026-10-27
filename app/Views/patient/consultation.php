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

            <!-- Search & Specialization Filter -->
            <div class="px-5 py-4 bg-[#ffffff] border-b border-[#ebe7e1] space-y-3">
                <div class="relative">
                    <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-[#7b7b78]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" id="doctor-search" value="<?= esc(service('request')->getGet('q') ?? '') ?>" placeholder="Cari nama dokter atau spesialisasi..."
                        class="w-full pl-10 pr-4 py-2.5 bg-[#f5f1ec] border border-[#d3cec6] rounded-[16px] text-sm text-[#111111] focus:bg-[#ffffff] transition-all">
                </div>
                <div class="flex space-x-2 overflow-x-auto pb-1 scrollbar-hide" id="spec-filters">
                    <button type="button" data-spec="all" class="spec-pill flex-shrink-0 px-4 py-1.5 bg-[#003E7E] text-[#ffffff] rounded-full text-xs font-bold shadow-sm transition-all">Semua</button>
                    <button type="button" data-spec="umum" class="spec-pill flex-shrink-0 px-4 py-1.5 bg-[#f5f1ec] text-[#626260] rounded-full text-xs font-semibold hover:bg-[#ebe7e1] transition-all">Umum</button>
                    <button type="button" data-spec="anak" class="spec-pill flex-shrink-0 px-4 py-1.5 bg-[#f5f1ec] text-[#626260] rounded-full text-xs font-semibold hover:bg-[#ebe7e1] transition-all">Anak</button>
                    <button type="button" data-spec="jantung" class="spec-pill flex-shrink-0 px-4 py-1.5 bg-[#f5f1ec] text-[#626260] rounded-full text-xs font-semibold hover:bg-[#ebe7e1] transition-all">Jantung</button>
                    <button type="button" data-spec="kulit" class="spec-pill flex-shrink-0 px-4 py-1.5 bg-[#f5f1ec] text-[#626260] rounded-full text-xs font-semibold hover:bg-[#ebe7e1] transition-all">Kulit</button>
                    <button type="button" data-spec="gigi" class="spec-pill flex-shrink-0 px-4 py-1.5 bg-[#f5f1ec] text-[#626260] rounded-full text-xs font-semibold hover:bg-[#ebe7e1] transition-all">Gigi</button>
                    <button type="button" data-spec="penyakit dalam" class="spec-pill flex-shrink-0 px-4 py-1.5 bg-[#f5f1ec] text-[#626260] rounded-full text-xs font-semibold hover:bg-[#ebe7e1] transition-all">Penyakit Dalam</button>
                </div>
            </div>

            <!-- Doctor List -->
            <div id="doctor-grid" class="p-5 space-y-3 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-4 md:space-y-0">

                <?php if (!empty($doctors)): ?>
                    <?php foreach ($doctors as $doctor): ?>
                        <!-- Doctor Card -->
                        <div class="doctor-card bg-[#ffffff] rounded-[24px] p-4 card-hover border border-[#ebe7e1] <?= $doctor['status'] == 'offline' ? 'opacity-80' : '' ?>"
                             data-name="<?= esc(strtolower($doctor['name'])) ?>"
                             data-spec="<?= esc(strtolower($doctor['specialization'])) ?>">
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
                                    
                                    <!-- Schedule Info -->
                                    <div class="mt-2.5 bg-[#f9f8f6] p-2.5 rounded-[12px] border border-gray-100">
                                        <p class="text-[10px] font-semibold text-[#626260] mb-1.5 uppercase tracking-wider flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Jadwal Praktik
                                        </p>
                                        <?php if (!empty($doctor['schedules'])): ?>
                                            <ul class="text-[11px] text-[#111111] space-y-1">
                                                <?php foreach ($doctor['schedules'] as $sch): ?>
                                                    <li class="flex justify-between items-center">
                                                        <span class="font-medium"><?= esc($sch['day_of_week']) ?></span>
                                                        <span class="text-[#626260]"><?= date('H:i', strtotime($sch['start_time'])) ?> - <?= date('H:i', strtotime($sch['end_time'])) ?> WIB</span>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php else: ?>
                                            <p class="text-[11px] text-[#7b7b78] italic">Jadwal belum tersedia</p>
                                        <?php endif; ?>
                                    </div>

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
                    <div id="no-doctor-match" class="hidden col-span-full bg-[#ffffff] rounded-[24px] p-8 text-center border border-dashed border-[#d3cec6]">
                        <p class="text-[#626260] font-semibold text-sm">Dokter dengan kriteria tersebut tidak ditemukan.</p>
                        <button type="button" onclick="resetDoctorFilter()" class="mt-2 text-xs font-bold text-[#003E7E] hover:underline">Tampilkan Semua Dokter</button>
                    </div>
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
<div id="booking-modal" class="fixed inset-0 z-[60] hidden flex items-end sm:items-center justify-center bg-[#111111]/40 backdrop-blur-sm transition-opacity">
    <div class="bg-[#ffffff] w-full sm:w-[440px] max-h-[90vh] flex flex-col rounded-t-[32px] sm:rounded-[32px] overflow-hidden transform translate-y-full transition-transform duration-300 shadow-2xl" id="booking-modal-content">
        <!-- Handle for mobile drag -->
        <div class="w-full flex justify-center pt-3 pb-1 sm:hidden">
            <div class="w-12 h-1.5 bg-gray-300 rounded-full"></div>
        </div>
        
        <div class="px-6 py-4 border-b border-[#ebe7e1] flex items-center justify-between sticky top-0 bg-white z-10">
            <h3 class="text-lg font-bold text-[#111111]">Mulai Konsultasi</h3>
            <button onclick="closeBookingModal()" class="w-8 h-8 flex items-center justify-center rounded-full bg-[#f5f1ec] text-[#626260] hover:bg-[#ebe7e1] transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
        
        <div class="p-6 overflow-y-auto flex-1">
            <form action="<?= base_url('patient/book_appointment') ?>" method="POST" class="flex flex-col h-full">
                <input type="hidden" name="doctor_id" id="modal-doctor-id" value="">
                
                <div class="mb-4 bg-[#f5f1ec] p-3.5 rounded-[16px] flex items-center border border-[#ebe7e1]">
                    <div class="w-11 h-11 bg-white rounded-full flex items-center justify-center mr-3 shadow-sm">
                        <svg class="w-6 h-6 text-[#003E7E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-[#7b7b78] mb-0.5">Dokter Tujuan</p>
                        <p class="text-sm font-bold text-[#003E7E]" id="modal-doctor-name">-</p>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="family_member_id" class="block text-xs font-semibold text-[#111111] mb-1.5">Pasien Konsultasi</label>
                    <select name="family_member_id" id="family_member_id"
                        class="w-full bg-[#ffffff] border border-[#d3cec6] rounded-[16px] px-4 py-2.5 text-sm text-[#111111] focus:outline-none focus:ring-2 focus:ring-[#003E7E]/50 focus:border-[#003E7E] transition-all shadow-sm">
                        <option value="">Diri Sendiri (<?= esc(session()->get('name')) ?>)</option>
                        <?php if (!empty($family_members)): ?>
                            <?php foreach ($family_members as $fm): ?>
                                <option value="<?= $fm['id'] ?>"><?= esc($fm['name']) ?> (<?= esc($fm['relation']) ?>)</option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-3 mb-3">
                    <div>
                        <label for="appointment_date" class="block text-xs font-semibold text-[#111111] mb-1.5">Tanggal</label>
                        <input type="date" name="appointment_date" id="appointment_date" required min="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d') ?>"
                            class="w-full bg-[#ffffff] border border-[#d3cec6] rounded-[16px] px-3.5 py-2.5 text-sm text-[#111111] focus:outline-none focus:ring-2 focus:ring-[#003E7E]/50 focus:border-[#003E7E] transition-all shadow-sm">
                    </div>
                    <div>
                        <label for="time_slot" class="block text-xs font-semibold text-[#111111] mb-1.5">Jam Praktik</label>
                        <input type="time" name="time_slot" id="time_slot" required value="09:00"
                            class="w-full bg-[#ffffff] border border-[#d3cec6] rounded-[16px] px-3.5 py-2.5 text-sm text-[#111111] focus:outline-none focus:ring-2 focus:ring-[#003E7E]/50 focus:border-[#003E7E] transition-all shadow-sm">
                    </div>
                </div>

                <!-- Quick Time Slot Chips -->
                <div class="mb-4">
                    <p class="text-[11px] font-semibold text-[#626260] mb-1.5">Pilihan Jam Cepat (WIB):</p>
                    <div class="flex flex-wrap gap-1.5">
                        <?php foreach (['08:00', '09:00', '10:00', '11:00', '13:00', '14:00', '15:00', '16:00', '19:00', '20:00'] as $slot): ?>
                            <button type="button" onclick="selectTimeChip(this, '<?= $slot ?>')"
                                class="time-chip px-2.5 py-1 text-xs font-semibold rounded-[10px] border border-[#d3cec6] bg-[#f5f1ec] text-[#111111] hover:border-[#003E7E] transition-all <?= $slot === '09:00' ? 'active' : '' ?>">
                                <?= $slot ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="mb-5">
                    <label for="reason" class="block text-xs font-semibold text-[#111111] mb-1.5">Keluhan Utama <span class="text-red-500">*</span></label>
                    <textarea name="reason" id="reason" rows="3" required
                        placeholder="Ceritakan secara singkat keluhan yang Anda rasakan saat ini..."
                        class="w-full bg-[#ffffff] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-sm text-[#111111] focus:outline-none focus:ring-2 focus:ring-[#003E7E]/50 focus:border-[#003E7E] transition-all resize-none shadow-sm"></textarea>
                </div>
                
                <div class="mt-auto pt-4 border-t border-[#ebe7e1]">
                    <div class="flex items-center justify-between mb-4 bg-blue-50/50 p-3.5 rounded-[16px] border border-blue-100">
                        <span class="text-sm font-semibold text-[#003E7E]">Biaya Konsultasi</span>
                        <span class="text-lg font-extrabold text-[#111111]" id="modal-fee">Rp 0</span>
                    </div>

                    <button type="submit"
                            class="w-full py-3.5 bg-[#003E7E] text-white rounded-[16px] font-bold text-sm hover:bg-[#002855] transition-all shadow-[0_8px_20px_rgba(0,62,126,0.25)] flex justify-center items-center">
                        Ajukan Jadwal Sekarang
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let activeSpec = 'all';

    function filterDoctors() {
        const query = (document.getElementById('doctor-search')?.value || '').toLowerCase().trim();
        const cards = document.querySelectorAll('.doctor-card');
        let visibleCount = 0;

        cards.forEach(card => {
            const name = card.getAttribute('data-name') || '';
            const spec = card.getAttribute('data-spec') || '';
            const matchSpec = (activeSpec === 'all') || spec.includes(activeSpec);
            const matchQuery = !query || name.includes(query) || spec.includes(query);

            if (matchSpec && matchQuery) {
                card.classList.remove('hidden');
                visibleCount++;
            } else {
                card.classList.add('hidden');
            }
        });

        const noMatch = document.getElementById('no-doctor-match');
        if (noMatch) {
            noMatch.classList.toggle('hidden', visibleCount > 0);
        }
    }

    function resetDoctorFilter() {
        activeSpec = 'all';
        const search = document.getElementById('doctor-search');
        if (search) search.value = '';
        document.querySelectorAll('.spec-pill').forEach(btn => {
            if (btn.getAttribute('data-spec') === 'all') {
                btn.className = 'spec-pill flex-shrink-0 px-4 py-1.5 bg-[#003E7E] text-[#ffffff] rounded-full text-xs font-bold shadow-sm transition-all';
            } else {
                btn.className = 'spec-pill flex-shrink-0 px-4 py-1.5 bg-[#f5f1ec] text-[#626260] rounded-full text-xs font-semibold hover:bg-[#ebe7e1] transition-all';
            }
        });
        filterDoctors();
    }

    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('doctor-search');
        if (searchInput) {
            searchInput.addEventListener('input', filterDoctors);
            if (searchInput.value.trim() !== '') {
                filterDoctors();
            }
        }

        document.querySelectorAll('.spec-pill').forEach(pill => {
            pill.addEventListener('click', function() {
                activeSpec = this.getAttribute('data-spec');
                document.querySelectorAll('.spec-pill').forEach(btn => {
                    btn.className = 'spec-pill flex-shrink-0 px-4 py-1.5 bg-[#f5f1ec] text-[#626260] rounded-full text-xs font-semibold hover:bg-[#ebe7e1] transition-all';
                });
                this.className = 'spec-pill flex-shrink-0 px-4 py-1.5 bg-[#003E7E] text-[#ffffff] rounded-full text-xs font-bold shadow-sm transition-all';
                filterDoctors();
            });
        });

        const timeInput = document.getElementById('time_slot');
        if (timeInput) {
            timeInput.addEventListener('input', function() {
                document.querySelectorAll('.time-chip').forEach(chip => {
                    chip.classList.toggle('active', chip.textContent.trim() === this.value);
                });
            });
        }
    });

    function selectTimeChip(btn, time) {
        document.getElementById('time_slot').value = time;
        document.querySelectorAll('.time-chip').forEach(chip => chip.classList.remove('active'));
        btn.classList.add('active');
    }

    function openBookingModal(doctorId, doctorName, fee) {
        document.getElementById('modal-doctor-id').value = doctorId;
        document.getElementById('modal-doctor-name').textContent = doctorName;
        document.getElementById('modal-fee').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(fee);
        
        const modal = document.getElementById('booking-modal');
        const content = document.getElementById('booking-modal-content');
        
        modal.classList.remove('hidden');
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
            document.getElementById('reason').value = '';
        }, 300);
    }
</script>

<?= $this->include('components/bottom_nav') ?>
<?= $this->endSection() ?>
