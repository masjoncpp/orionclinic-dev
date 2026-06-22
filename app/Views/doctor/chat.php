<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="chat-screen" class="flex flex-col h-full w-full bg-[#f5f1ec] flex-1 relative">
            <!-- Chat Header -->
            <div class="bg-[#ffffff] px-4 py-3 border-b border-[#d3cec6] flex items-center justify-between sticky top-0 z-10">
                <div class="flex items-center">
                    <button onclick="window.location.href='<?= base_url('doctor/consultation') ?>'" class="p-2 -ml-2 rounded-full hover:bg-[#f5f1ec] transition-all mr-2">
                        <svg class="w-6 h-6 text-[#626260]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <div class="w-10 h-10 <?= $appointment['gender'] == 'female' ? 'bg-pink-100 text-pink-600' : 'bg-[#ebe7e1] text-[#111111]' ?> rounded-full flex items-center justify-center mr-3 font-bold">
                         <?= substr($appointment['patient_name'], 0, 1) ?>
                    </div>
                    <div>
                        <h4 class="font-semibold text-[#111111] text-sm"><?= esc($appointment['patient_name']) ?></h4>
                        <div class="flex items-center">
                            <span class="w-2 h-2 bg-[#4CAF50] rounded-full mr-1"></span>
                            <span class="text-xs text-[#111111]">Online</span>
                        </div>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <?php if ($consultation && $consultation['status'] === 'active'): ?>
                        <button type="button" onclick="document.getElementById('end-consultation-modal').classList.remove('hidden')" class="p-2 bg-red-100 rounded-[12px] hover:bg-red-200 transition-all text-red-700 font-semibold text-xs px-3">Selesai</button>
                        <button onclick="window.location.href='<?= base_url('doctor/prescription_form?id=' . $appointment['id']) ?>'" class="p-2 bg-[#003E7E] rounded-[12px] hover:bg-[#002855] transition-all text-white font-semibold text-xs px-3">Buat Resep</button>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Chat Messages -->
            <div id="chat-messages" class="flex-1 overflow-auto p-4 space-y-4 pb-20">
                <div class="flex justify-center">
                    <span class="text-xs text-[#7b7b78] bg-[#ffffff] px-4 py-1.5 rounded-full  border border-[#d3cec6]">Konsultasi dimulai • <?= date('d M Y, H:i', strtotime($appointment['appointment_date'] . ' ' . $appointment['time_slot'])) ?></span>
                </div>

                <?php if (empty($messages)): ?>
                    <div id="no-messages" class="text-center py-10">
                        <p class="text-xs text-[#7b7b78]">Belum ada pesan dari pasien.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($messages as $msg): ?>
                        <?php if ($msg['sender_id'] == session()->get('user_id')): ?>
                            <div class="flex justify-end message-item" data-id="<?= $msg['id'] ?>">
                                <div class="bg-[#003E7E] rounded-[24px] rounded-tr-none p-4 max-w-[80%] ">
                                    <p class="text-white text-sm"><?= esc($msg['message']) ?></p>
                                    <span class="text-xs text-blue-200 mt-2 block"><?= date('H:i', strtotime($msg['created_at'])) ?></span>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="flex justify-start message-item" data-id="<?= $msg['id'] ?>">
                                <div class="bg-[#ffffff] rounded-[24px] rounded-tl-none p-4 max-w-[80%]  border border-[#d3cec6]">
                                    <p class="text-[#111111] text-sm"><?= esc($msg['message']) ?></p>
                                    <span class="text-xs text-[#7b7b78] mt-2 block"><?= date('H:i', strtotime($msg['created_at'])) ?></span>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <!-- Chat Input -->
            <div class="bg-[#ffffff] px-4 py-3 border-t border-[#d3cec6] absolute bottom-0 left-0 right-0">
                <?php if ($consultation && $consultation['status'] === 'active'): ?>
                    <div class="flex items-center space-x-3">
                        <button class="p-2 text-[#7b7b78] hover:text-[#626260] transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>
                        </button>
                        <div class="flex-1 relative">
                            <input id="chat-input" type="text" placeholder="Ketik balasan untuk pasien..." class="w-full px-4 py-3 bg-[#f5f1ec] rounded-full text-[#111111] focus:outline-none focus:ring-2 focus:ring-blue-500/30">
                        </div>
                        <button id="send-btn" class="p-3 bg-[#003E7E] rounded-full text-white hover:bg-[#002855] transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                        </button>
                    </div>
                <?php else: ?>
                    <div class="text-center py-2">
                        <p class="text-xs text-[#626260] font-medium bg-[#f5f1ec] py-2 rounded-[16px]">Konsultasi telah berakhir.</p>
                    </div>
                <?php endif; ?>
            </div>
</div>

<!-- Custom End Consultation Modal -->
<div id="end-consultation-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-[#111111]/40 backdrop-blur-sm transition-opacity">
    <div class="bg-white rounded-[24px] shadow-2xl w-full max-w-xs mx-4 overflow-hidden transform scale-100">
        <div class="p-6 text-center">
            <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-4 border-[4px] border-white shadow-sm">
                <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h3 class="text-lg font-extrabold text-[#111111] mb-2 tracking-tight">Akhiri Konsultasi?</h3>
            <p class="text-sm text-[#7b7b78] mb-6 leading-relaxed">Anda belum meresepkan obat. Apakah Anda yakin ingin mengakhiri sesi ini?</p>
            <div class="flex space-x-3">
                <button type="button" onclick="document.getElementById('end-consultation-modal').classList.add('hidden')" 
                        class="flex-1 py-2.5 px-4 bg-[#f5f1ec] text-[#626260] rounded-[16px] font-bold text-sm hover:bg-[#ebe7e1] transition-all">
                    Kembali
                </button>
                <form action="<?= base_url('doctor/end_consultation') ?>" method="POST" class="flex-1 m-0 p-0">
                    <input type="hidden" name="appointment_id" value="<?= $appointment['id'] ?>">
                    <button type="submit" 
                            class="w-full py-2.5 px-4 bg-red-500 text-white rounded-[16px] font-bold text-sm hover:bg-red-600 transition-all shadow-lg shadow-red-500/30">
                        Ya, Akhiri
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    var consultationId = "<?= $consultation['id'] ?? '' ?>";
    var currentUserId = "<?= session()->get('user_id') ?>";
    var lastId = 0;

    // Get the last message ID
    $('.message-item').each(function() {
        var id = parseInt($(this).data('id'));
        if (id > lastId) lastId = id;
    });

    function scrollToBottom() {
        $('#chat-messages').scrollTop($('#chat-messages')[0].scrollHeight);
    }

    function appendMessage(msg) {
        $('#no-messages').remove();
        if ($(`.message-item[data-id="${msg.id}"]`).length > 0) return;

        var isMe = (msg.sender_id == currentUserId);
        var time = new Date(msg.created_at).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', hour12: false }).replace('.', ':');
        
        var html = '';
        if (isMe) {
            html = `
                <div class="flex justify-end message-item" data-id="${msg.id}">
                    <div class="bg-[#003E7E] rounded-[24px] rounded-tr-none p-4 max-w-[80%] ">
                        <p class="text-white text-sm">${$('<div>').text(msg.message).html()}</p>
                        <span class="text-xs text-blue-200 mt-2 block">${time}</span>
                    </div>
                </div>`;
        } else {
            html = `
                <div class="flex justify-start message-item" data-id="${msg.id}">
                    <div class="bg-[#ffffff] rounded-[24px] rounded-tl-none p-4 max-w-[80%]  border border-[#d3cec6]">
                        <p class="text-[#111111] text-sm">${$('<div>').text(msg.message).html()}</p>
                        <span class="text-xs text-[#7b7b78] mt-2 block">${time}</span>
                    </div>
                </div>`;
        }
        
        $('#chat-messages').append(html);
        if (parseInt(msg.id) > lastId) lastId = parseInt(msg.id);
        scrollToBottom();
    }

    function sendMessage() {
        var text = $('#chat-input').val().trim();
        if (!text || !consultationId) return;

        $('#send-btn').prop('disabled', true).addClass('opacity-50');

        $.ajax({
            url: "<?= base_url('chat/send') ?>",
            method: "POST",
            data: {
                consultation_id: consultationId,
                message: text
            },
            success: function(response) {
                if (response.status === 'success') {
                    $('#chat-input').val('');
                    fetchUpdates();
                } else {
                    alert(response.message);
                }
            },
            complete: function() {
                $('#send-btn').prop('disabled', false).removeClass('opacity-50');
            }
        });
    }

    function fetchUpdates() {
        if (!consultationId) return;

        $.ajax({
            url: "<?= base_url('chat/updates') ?>",
            method: "GET",
            cache: false,
            data: {
                consultation_id: consultationId,
                last_id: lastId
            },
            success: function(messages) {
                if (messages && messages.length > 0) {
                    messages.forEach(appendMessage);
                }
            }
        });
    }

    $('#send-btn').on('click', sendMessage);
    $('#chat-input').on('keypress', function(e) {
        if (e.which === 13) sendMessage();
    });

    setInterval(fetchUpdates, 3000);
    scrollToBottom();
});
</script>

<?= $this->include('components/bottom_nav') ?>
<?= $this->endSection() ?>
