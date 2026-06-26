<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="flex flex-col h-full bg-[#f5f1ec] fade-in">
    <!-- Header -->
    <div class="bg-[#ffffff] px-5 py-4 border-b border-[#d3cec6] flex items-center justify-between sticky top-0 z-10 ">
        <div class="flex items-center">
            <button onclick="window.history.back()"
                class="p-2 -ml-2 rounded-full hover:bg-gray-100 transition-colors mr-2">
                <svg class="w-6 h-6 text-[#111111]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            <h1 class="text-base font-bold text-[#111111]">Notifikasi</h1>
        </div>
        <form action="<?= base_url((isset($role) ? $role : 'patient') . '/read_all_notifications') ?>" method="POST">
            <button type="submit" class="text-xs font-bold text-[#003E7E] hover:text-[#002855] transition-colors">Tandai Dibaca</button>
        </form>
    </div>

    <div class="p-5 max-w-2xl mx-auto flex-1 overflow-y-auto pb-24 w-full">
        <?php if (empty($notifications)): ?>
            <div class="bg-[#ffffff] rounded-[24px] p-10 text-center border border-dashed border-gray-300">
                <div class="w-16 h-16 bg-[#f5f1ec] rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-[#7b7b78]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                </div>
                <p class="text-[#626260] font-medium">Belum ada notifikasi.</p>
                <p class="text-[#7b7b78] text-xs mt-1">Notifikasi baru akan muncul di sini.</p>
            </div>
        <?php else: ?>
            <?php foreach ($notifications as $n): ?>
                <div class="bg-[#ffffff] rounded-[20px] p-4 shadow-sm border <?= $n['is_read'] ? 'border-gray-100 opacity-70' : 'border-blue-100 bg-blue-50/30' ?> mb-3 transition-all relative">
                    <?php if (!$n['is_read']): ?>
                        <div class="absolute top-4 right-4 w-2.5 h-2.5 bg-red-500 rounded-full"></div>
                    <?php endif; ?>
                    <div class="flex items-start">
                        <div class="w-10 h-10 rounded-full bg-[#ebe7e1] flex items-center justify-center mr-3 flex-shrink-0">
                            <svg class="w-5 h-5 text-[#003E7E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="flex-1 pr-4">
                            <h4 class="font-bold text-[#111111] text-sm mb-0.5"><?= esc($n['title']) ?></h4>
                            <p class="text-xs text-[#626260] leading-relaxed mb-2"><?= esc($n['message']) ?></p>
                            <span class="text-[10px] text-[#7b7b78] font-medium"><?= date('d M Y, H:i', strtotime($n['created_at'])) ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<?= $this->include('components/bottom_nav') ?>
<?= $this->endSection() ?>
