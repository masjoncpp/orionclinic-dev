<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="flex flex-col h-full bg-[#f5f1ec]">

    <!-- Header -->
    <div class="bg-[#003E7E] px-5 pt-8 pb-10">
        <div class="flex items-center text-white mb-6">
            <button onclick="window.history.back()" class="p-2 -ml-2 rounded-[16px] hover:bg-white/10 transition-all mr-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <h1 class="text-lg font-bold">Buat Resep & Rekam Medis</h1>
        </div>
        
        <div class="flex items-center">
            <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mr-4 text-white font-bold text-lg">
                <?= substr($appointment['patient_name'], 0, 1) ?>
            </div>
            <div>
                <h4 class="font-bold text-white"><?= esc($appointment['patient_name']) ?></h4>
                <p class="text-white/70 text-sm">Keluhan: <?= esc($appointment['reason']) ?></p>
            </div>
        </div>
    </div>

    <div class="flex-1 overflow-y-auto p-5 -mt-6">
        <form action="<?= base_url('doctor/write_prescription') ?>" method="POST" class="space-y-4">
            <input type="hidden" name="appointment_id" value="<?= $appointment['id'] ?>">
            
            <div class="bg-white rounded-[24px] p-5 shadow-sm">
                <h3 class="font-bold text-[#111111] mb-4">Diagnosis & Catatan</h3>
                
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-[#626260] mb-2">Diagnosis Utama *</label>
                    <input type="text" name="diagnosis" required placeholder="Contoh: ISPA, Gastritis, dll" 
                           class="w-full px-4 py-3 bg-[#f5f1ec] rounded-[16px] text-[#111111] focus:outline-none focus:ring-2 focus:ring-[#003E7E]/30">
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-[#626260] mb-2">Catatan Dokter</label>
                    <textarea name="notes" rows="3" placeholder="Saran istirahat, pantangan makanan, dll" 
                              class="w-full px-4 py-3 bg-[#f5f1ec] rounded-[16px] text-[#111111] focus:outline-none focus:ring-2 focus:ring-[#003E7E]/30"></textarea>
                </div>
            </div>

            <div class="bg-white rounded-[24px] p-5 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-[#111111]">Resep Obat</h3>
                    <button type="button" id="add-medicine" class="text-sm font-bold text-[#003E7E] px-3 py-1 bg-blue-50 rounded-full">+ Tambah</button>
                </div>
                
                <div id="medicines-container" class="space-y-4">
                    <div class="p-4 bg-[#f9f8f6] rounded-[16px] border border-[#ebe7e1] relative medicine-item">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-[#626260] mb-1">Nama Obat *</label>
                                <input type="text" name="medicine_name[]" required placeholder="mis: Paracetamol" 
                                       class="w-full px-4 py-2.5 bg-[#ffffff] border border-[#d3cec6] rounded-[12px] text-[#111111] focus:outline-none focus:ring-2 focus:ring-[#003E7E]/30 text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-[#626260] mb-1">Dosis *</label>
                                <input type="text" name="dosage[]" required placeholder="mis: 500mg" 
                                       class="w-full px-4 py-2.5 bg-[#ffffff] border border-[#d3cec6] rounded-[12px] text-[#111111] focus:outline-none focus:ring-2 focus:ring-[#003E7E]/30 text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-[#626260] mb-1">Aturan Pakai *</label>
                                <input type="text" name="frequency[]" required placeholder="mis: 3x1 Sesudah Makan" 
                                       class="w-full px-4 py-2.5 bg-[#ffffff] border border-[#d3cec6] rounded-[12px] text-[#111111] focus:outline-none focus:ring-2 focus:ring-[#003E7E]/30 text-sm">
                            </div>
                        </div>
                    </div>
                </div>

            <button type="submit" class="w-full py-4 bg-[#003E7E] text-white rounded-[24px] font-bold text-lg hover:bg-[#002855] transition-all shadow-lg shadow-blue-500/30 mt-4">
                Terbitkan Resep & Selesai
            </button>
        </form>
    </div>
</div>

<script>
document.getElementById('add-medicine').addEventListener('click', function() {
    const container = document.getElementById('medicines-container');
    const div = document.createElement('div');
    div.className = 'p-4 bg-[#f9f8f6] rounded-[16px] border border-[#ebe7e1] relative medicine-item';
    div.innerHTML = `
        <button type="button" class="absolute -top-2 -right-2 p-1.5 bg-red-100 text-red-500 rounded-full hover:bg-red-200 remove-medicine shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <div>
                <label class="block text-xs font-semibold text-[#626260] mb-1">Nama Obat *</label>
                <input type="text" name="medicine_name[]" required placeholder="mis: Paracetamol" 
                       class="w-full px-4 py-2.5 bg-[#ffffff] border border-[#d3cec6] rounded-[12px] text-[#111111] focus:outline-none focus:ring-2 focus:ring-[#003E7E]/30 text-sm">
            </div>
            <div>
                <label class="block text-xs font-semibold text-[#626260] mb-1">Dosis *</label>
                <input type="text" name="dosage[]" required placeholder="mis: 500mg" 
                       class="w-full px-4 py-2.5 bg-[#ffffff] border border-[#d3cec6] rounded-[12px] text-[#111111] focus:outline-none focus:ring-2 focus:ring-[#003E7E]/30 text-sm">
            </div>
            <div>
                <label class="block text-xs font-semibold text-[#626260] mb-1">Aturan Pakai *</label>
                <input type="text" name="frequency[]" required placeholder="mis: 3x1 Sesudah Makan" 
                       class="w-full px-4 py-2.5 bg-[#ffffff] border border-[#d3cec6] rounded-[12px] text-[#111111] focus:outline-none focus:ring-2 focus:ring-[#003E7E]/30 text-sm">
            </div>
        </div>
    `;
    container.appendChild(div);
    
    div.querySelector('.remove-medicine').addEventListener('click', function() {
        div.remove();
    });
});
</script>
<?= $this->endSection() ?>
