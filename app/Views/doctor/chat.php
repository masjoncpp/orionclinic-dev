<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="chat-screen" class="flex flex-col h-full w-full bg-gray-50 flex-1 relative">
            <!-- Chat Header -->
            <div class="bg-white px-4 py-3 border-b border-gray-100 flex items-center justify-between sticky top-0 z-10">
                <div class="flex items-center">
                    <button onclick="window.location.href='<?= base_url('doctor/consultation') ?>'" class="p-2 -ml-2 rounded-full hover:bg-gray-100 transition-all mr-2">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <div class="w-10 h-10 <?= $appointment['gender'] == 'female' ? 'bg-pink-100 text-pink-600' : 'bg-blue-100 text-blue-600' ?> rounded-full flex items-center justify-center mr-3 font-bold">
                         <?= substr($appointment['patient_name'], 0, 1) ?>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800 text-sm"><?= esc($appointment['patient_name']) ?></h4>
                        <div class="flex items-center">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-1"></span>
                            <span class="text-xs text-green-600">Online</span>
                        </div>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <button class="p-2 bg-blue-50 rounded-full hover:bg-blue-100 transition-all text-blue-600 font-semibold text-xs px-4">Buat Resep</button>
                </div>
            </div>
            
            <!-- Chat Messages -->
            <div class="flex-1 overflow-auto p-4 space-y-4 pb-20">
                <div class="flex justify-center">
                    <span class="text-xs text-gray-400 bg-white px-4 py-1.5 rounded-full shadow-sm border border-gray-100">Konsultasi dimulai • <?= date('d M Y, H:i', strtotime($appointment['appointment_date'] . ' ' . $appointment['time_slot'])) ?></span>
                </div>

                <?php if (empty($messages)): ?>
                    <div class="text-center py-10">
                        <p class="text-xs text-gray-400">Belum ada pesan dari pasien.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($messages as $msg): ?>
                        <?php if ($msg['sender_id'] == session()->get('user_id')): ?>
                            <!-- Doctor message (Current User) -->
                            <div class="flex justify-end">
                                <div class="bg-blue-600 rounded-2xl rounded-tr-none p-4 max-w-[80%] shadow-sm">
                                    <p class="text-white text-sm"><?= esc($msg['message']) ?></p>
                                    <span class="text-xs text-blue-200 mt-2 block"><?= date('H:i', strtotime($msg['created_at'])) ?></span>
                                </div>
                            </div>
                        <?php else: ?>
                            <!-- Patient message -->
                            <div class="flex justify-start">
                                <div class="bg-white rounded-2xl rounded-tl-none p-4 max-w-[80%] shadow-sm border border-gray-100">
                                    <p class="text-gray-800 text-sm"><?= esc($msg['message']) ?></p>
                                    <span class="text-xs text-gray-400 mt-2 block"><?= date('H:i', strtotime($msg['created_at'])) ?></span>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <!-- Chat Input -->
            <div class="bg-white px-4 py-3 border-t border-gray-100 absolute bottom-0 left-0 right-0">
                <div class="flex items-center space-x-3">
                    <button class="p-2 text-gray-400 hover:text-gray-600 transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>
                    </button>
                    <div class="flex-1 relative">
                        <input type="text" placeholder="Ketik balasan untuk pasien..." class="w-full px-4 py-3 bg-gray-100 rounded-full text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500/30">
                    </div>
                    <button class="p-3 bg-blue-600 rounded-full text-white hover:bg-blue-700 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                    </button>
                </div>
            </div>
</div>
<?= $this->include('components/bottom_nav') ?>
<?= $this->endSection() ?>
