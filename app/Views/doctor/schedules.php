<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="schedule-screen" class="flex flex-col h-full bg-[#f5f1ec] fade-in relative">
    
    <div class="flex-1 overflow-y-auto pb-20 md:pb-6">
        <!-- Header -->
        <div class="bg-[#ffffff] px-5 py-4 border-b border-[#d3cec6] flex items-center sticky top-0 z-10 ">
            <button onclick="window.location.href='<?= base_url('doctor/profile') ?>'"
                class="p-2 -ml-1 rounded-[16px] hover:bg-[#f5f1ec] transition-all mr-2">
                <svg class="w-5 h-5 text-[#626260]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <div>
                <h1 class="text-base font-bold text-[#111111]">Atur Jadwal Praktik</h1>
            </div>
        </div>

        <div class="p-5 max-w-2xl mx-auto">
            
            <?php if(session()->getFlashdata('success')): ?>
                <div class="bg-[#4CAF50]/10 border border-[#4CAF50]/30 text-[#4CAF50] px-4 py-3 rounded-[16px] mb-5 flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-sm font-medium"><?= session()->getFlashdata('success') ?></span>
                </div>
            <?php endif; ?>

            <div class="bg-[#ffffff] rounded-[24px] p-5 md:p-8 border border-gray-100 shadow-sm">
                <form action="<?= base_url('doctor/updateSchedule') ?>" method="POST">
                    <div class="space-y-4">
                        <?php 
                        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                        foreach ($days as $day): 
                            $isActive = isset($scheduleMap[$day]);
                            $start = $isActive ? date('H:i', strtotime($scheduleMap[$day]['start_time'])) : '08:00';
                            $end = $isActive ? date('H:i', strtotime($scheduleMap[$day]['end_time'])) : '16:00';
                        ?>
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between p-4 rounded-[16px] <?= $isActive ? 'bg-[#f9f8f6] border border-[#d3cec6]' : 'bg-white border border-gray-100' ?> transition-colors hover:border-[#003E7E]/30 schedule-row">
                            <div class="flex items-center w-full sm:w-1/3 mb-3 sm:mb-0">
                                <label class="relative inline-flex items-center cursor-pointer mr-4">
                                    <input type="checkbox" name="active_days[]" value="<?= $day ?>" class="sr-only peer day-toggle" <?= $isActive ? 'checked' : '' ?>>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#003E7E]"></div>
                                </label>
                                <span class="font-bold text-sm <?= $isActive ? 'text-[#111111]' : 'text-[#7b7b78]' ?> day-label"><?= $day ?></span>
                            </div>
                            
                            <div class="flex items-center space-x-2 w-full sm:w-2/3 time-inputs <?= $isActive ? '' : 'opacity-30 pointer-events-none' ?>">
                                <div class="flex-1">
                                    <input type="text" name="start_time[<?= $day ?>]" value="<?= $start ?>" 
                                        class="w-full bg-[#ffffff] border border-[#d3cec6] rounded-[12px] px-3 py-2 text-sm text-[#111111] focus:outline-none focus:ring-2 focus:ring-[#003E7E]/50 focus:border-[#003E7E] transition-all text-center"
                                        placeholder="08:00" pattern="^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$" maxlength="5">
                                </div>
                                <span class="text-[#7b7b78] font-medium text-sm">-</span>
                                <div class="flex-1">
                                    <input type="text" name="end_time[<?= $day ?>]" value="<?= $end ?>" 
                                        class="w-full bg-[#ffffff] border border-[#d3cec6] rounded-[12px] px-3 py-2 text-sm text-[#111111] focus:outline-none focus:ring-2 focus:ring-[#003E7E]/50 focus:border-[#003E7E] transition-all text-center"
                                        placeholder="16:00" pattern="^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$" maxlength="5">
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="mt-8">
                        <button type="submit" class="w-full bg-[#003E7E] text-white px-8 py-3.5 rounded-[16px] font-bold text-sm hover:bg-[#002855] transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Simpan Jadwal
                        </button>
                    </div>
                </form>
            </div>

            <!-- Info Box -->
            <div class="mt-6 bg-[#003E7E]/5 border border-[#003E7E]/10 rounded-[24px] p-5 flex items-start">
                <div class="w-10 h-10 bg-[#003E7E]/10 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                    <svg class="w-5 h-5 text-[#003E7E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h4 class="font-bold text-[#111111] text-sm mb-1">Informasi Penjadwalan</h4>
                    <p class="text-sm text-[#626260] leading-relaxed">
                        Jadwal yang Anda atur di sini akan ditampilkan di profil Anda pada halaman pencarian pasien. 
                        Pasien tidak dapat memesan jadwal konsultasi di luar hari dan jam operasional yang telah Anda aktifkan.
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggles = document.querySelectorAll('.day-toggle');
    
    toggles.forEach(toggle => {
        toggle.addEventListener('change', function() {
            const row = this.closest('.schedule-row');
            const timeInputs = row.querySelector('.time-inputs');
            const label = row.querySelector('.day-label');
            
            if (this.checked) {
                row.classList.add('bg-[#f9f8f6]', 'border-[#d3cec6]');
                row.classList.remove('bg-white', 'border-gray-100');
                timeInputs.classList.remove('opacity-30', 'pointer-events-none');
                label.classList.add('text-[#111111]');
                label.classList.remove('text-[#7b7b78]');
                
                // Set required attr
                timeInputs.querySelectorAll('input').forEach(input => input.setAttribute('required', 'required'));
            } else {
                row.classList.remove('bg-[#f9f8f6]', 'border-[#d3cec6]');
                row.classList.add('bg-white', 'border-gray-100');
                timeInputs.classList.add('opacity-30', 'pointer-events-none');
                label.classList.remove('text-[#111111]');
                label.classList.add('text-[#7b7b78]');
                
                // Remove required attr
                timeInputs.querySelectorAll('input').forEach(input => input.removeAttribute('required'));
            }
        });
        
        // Trigger change event to set initial state correctly (required attributes)
        if (toggle.checked) {
            const row = toggle.closest('.schedule-row');
            const timeInputs = row.querySelector('.time-inputs');
            timeInputs.querySelectorAll('input').forEach(input => input.setAttribute('required', 'required'));
        }
    });
});
</script>

<?= $this->include('components/bottom_nav') ?>
<?= $this->endSection() ?>
