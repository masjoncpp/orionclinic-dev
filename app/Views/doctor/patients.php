<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="patient-screen" class="flex flex-col h-full w-full bg-[#f5f1ec] flex-1 relative">
            <div class="flex-1 overflow-auto pb-20">
                <div class="bg-[#ffffff] px-6 py-4 border-b border-[#d3cec6] flex items-center sticky top-0 z-10">
                    <button onclick="window.location.href='<?= base_url('doctor') ?>'" class="p-2 -ml-2 rounded-full hover:bg-[#f5f1ec] transition-all mr-2 md:hidden">
                        <svg class="w-6 h-6 text-[#626260]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                    </button>
                    <h1 class="text-xl font-bold text-[#111111]">Daftar Pasien</h1>
                </div>
                <!-- Search Bar -->
                <div class="bg-[#ffffff] px-6 py-4 border-b border-[#d3cec6]">
                     <div class="relative">
                        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-[#7b7b78]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input id="doctor-patient-search" type="text" placeholder="Cari nama pasien, ID, atau jenis kelamin..." class="w-full pl-12 pr-4 py-3.5 bg-[#f5f1ec] border border-[#d3cec6] rounded-[16px] text-[#111111] focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all">
                    </div>
                </div>
                <div class="px-6 py-6 space-y-4">
                    <?php if (empty($patients)): ?>
                        <div class="bg-[#ffffff] rounded-[24px] p-8 text-center border border-dashed border-gray-300">
                            <p class="text-[#7b7b78]">Belum ada data pasien.</p>
                        </div>
                    <?php else: ?>
                        <div id="patient-empty-search" class="hidden bg-[#ffffff] rounded-[24px] p-8 text-center border border-dashed border-gray-300">
                            <p class="text-sm font-semibold text-[#111111]">Pasien tidak ditemukan</p>
                            <p class="text-xs text-[#7b7b78] mt-1">Coba kata kunci pencarian lain.</p>
                        </div>
                        <?php foreach ($patients as $p): 
                            $genderLabel = $p['gender'] == 'female' ? 'Perempuan' : 'Laki-laki';
                            $searchStr = strtolower(($p['name'] ?? '') . ' #' . ($p['id'] ?? '') . ' ' . $genderLabel);
                        ?>
                            <div onclick="window.location.href='<?= base_url('doctor/patientHistory?id=' . $p['id']) ?>'"
                                 data-search="<?= esc($searchStr) ?>"
                                 class="patient-card-item bg-[#ffffff] rounded-[24px] p-4 border border-[#d3cec6] flex items-center justify-between card-hover cursor-pointer">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 <?= $p['gender'] == 'female' ? 'bg-pink-100 text-pink-600' : 'bg-[#ebe7e1] text-[#111111]' ?> rounded-full flex items-center justify-center mr-4 font-bold">
                                        <?php 
                                            $pName = $p['name'] ?? 'Patient';
                                            $pInitials = substr($pName, 0, 1);
                                            $pLastSpace = strrpos($pName, ' ');
                                            if ($pLastSpace !== false) {
                                                $pInitials .= substr($pName, $pLastSpace + 1, 1);
                                            }
                                            echo esc(strtoupper($pInitials));
                                        ?>
                                    </div>
                                    <div>
                                        <div class="flex items-center space-x-2">
                                            <h4 class="font-semibold text-[#111111]"><?= esc($p['name']) ?></h4>
                                            <span class="text-[11px] text-[#7b7b78] bg-[#f5f1ec] px-2 py-0.5 rounded-full">ID #<?= $p['id'] ?></span>
                                        </div>
                                        <p class="text-sm text-[#626260] mt-1"><?= $genderLabel ?>, <?= $p['date_of_birth'] ? date_diff(date_create($p['date_of_birth']), date_create('today'))->y : '?' ?> Tahun</p>
                                        <a href="<?= base_url('doctor/patientHistory?id=' . $p['id']) ?>" class="inline-block text-xs text-[#003E7E] mt-2 font-bold hover:underline transition-colors">Lihat Riwayat Medis →</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Mobile Bottom Nav -->
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('doctor-patient-search');
    const cards = document.querySelectorAll('.patient-card-item');
    const emptyState = document.getElementById('patient-empty-search');
    if (searchInput && cards.length > 0) {
        searchInput.addEventListener('input', function() {
            const q = this.value.trim().toLowerCase();
            let visible = 0;
            cards.forEach(card => {
                const hay = card.getAttribute('data-search') || '';
                if (!q || hay.includes(q)) {
                    card.classList.remove('hidden');
                    visible++;
                } else {
                    card.classList.add('hidden');
                }
            });
            if (emptyState) {
                emptyState.classList.toggle('hidden', visible > 0);
            }
        });
    }
});
</script>
<?= $this->include('components/bottom_nav') ?>
<?= $this->endSection() ?>
