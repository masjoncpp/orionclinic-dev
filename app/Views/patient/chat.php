<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="chat-screen" class="flex flex-col h-full bg-[#f5f1ec] fade-in">

    <!-- Chat Header -->
    <div class="bg-[#ffffff] px-4 py-3 border-b border-[#d3cec6] flex items-center justify-between flex-shrink-0 ">
        <div class="flex items-center">
            <button onclick="window.location.href='<?= base_url('patient/consultation') ?>'"
                class="p-2 -ml-1 rounded-[16px] hover:bg-[#f5f1ec] transition-all mr-2">
                <svg class="w-5 h-5 text-[#626260]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <div class="w-10 h-10 bg-[#ebe7e1] rounded-[24px] flex items-center justify-center mr-3 flex-shrink-0">
                <svg class="w-5 h-5 text-[#111111]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div>
                <h4 class="font-bold text-[#111111] text-sm"><?= esc($appointment['doctor_name']) ?></h4>
                <div class="flex items-center">
                    <span class="w-2 h-2 <?= $appointment['doctor_status'] == 'online' ? 'bg-[#4CAF50] status-online' : 'bg-gray-300' ?> rounded-full mr-1.5"></span>
                    <span class="text-xs <?= $appointment['doctor_status'] == 'online' ? 'text-[#111111]' : 'text-[#7b7b78]' ?> font-medium"><?= $appointment['doctor_status'] == 'online' ? 'Online sekarang' : 'Offline' ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Chat Messages -->
    <div id="chat-messages" class="flex-1 overflow-y-auto p-4 space-y-4 pb-20">

        <?php if ($appointment['status'] == 'pending'): ?>
            <div class="h-full flex flex-col items-center justify-center text-center px-4 py-10">
                <div class="w-20 h-20 bg-yellow-50 rounded-full flex items-center justify-center mb-6 animate-pulse border-4 border-yellow-100">
                    <svg class="w-10 h-10 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-[#111111] mb-2">Menunggu Persetujuan Dokter</h3>
                <p class="text-sm text-[#7b7b78] max-w-md">Jadwal konsultasi Anda pada <strong class="text-[#111111]"><?= date('d M Y', strtotime($appointment['appointment_date'])) ?></strong> pukul <strong class="text-[#111111]"><?= date('H:i', strtotime($appointment['time_slot'])) ?> WIB</strong> telah dikirimkan ke dokter.</p>
                <div class="mt-8">
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-semibold bg-[#ebe7e1] text-[#626260]">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-[#626260]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        Otomatis memuat ulang...
                    </span>
                </div>
            </div>
        <?php else: ?>
            <!-- System message -->
            <div class="flex justify-center">
                <span class="text-xs text-[#7b7b78] bg-[#ffffff] px-4 py-1.5 rounded-full  border border-[#d3cec6]">Konsultasi dimulai • <?= date('d M Y, H:i', strtotime($appointment['appointment_date'] . ' ' . $appointment['time_slot'])) ?></span>
            </div>

            <?php if (empty($messages)): ?>
                <div id="no-messages" class="text-center py-10">
                    <p class="text-xs text-[#7b7b78]">Belum ada pesan. Silakan mulai percakapan.</p>
                </div>
            <?php else: ?>
                <?php foreach ($messages as $msg): ?>
                    <?php if ($msg['sender_id'] == session()->get('user_id')): ?>
                        <div class="flex justify-end message-item" data-id="<?= $msg['id'] ?>">
                            <div class="bg-[#003E7E] rounded-[24px] rounded-tr-sm px-4 py-3 max-w-[78%] ">
                                <?php if ($msg['attachment_path']): ?>
                                    <img src="<?= base_url($msg['attachment_path']) ?>" class="max-w-full rounded-lg mb-2">
                                <?php endif; ?>
                                <p class="text-white text-sm leading-relaxed"><?= esc($msg['message']) ?></p>
                                <span class="text-xs text-blue-200 mt-1 block text-right"><?= date('H:i', strtotime($msg['created_at'])) ?></span>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="flex justify-start items-end space-x-2 message-item" data-id="<?= $msg['id'] ?>">
                            <div class="w-7 h-7 bg-[#ebe7e1] rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-3.5 h-3.5 text-[#111111]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div class="bg-[#ffffff] rounded-[24px] rounded-tl-sm px-4 py-3 max-w-[78%]  border border-gray-50">
                                <?php if ($msg['attachment_path']): ?>
                                    <img src="<?= base_url($msg['attachment_path']) ?>" class="max-w-full rounded-lg mb-2">
                                <?php endif; ?>
                                <p class="text-[#111111] text-sm leading-relaxed"><?= esc($msg['message']) ?></p>
                                <span class="text-xs text-[#7b7b78] mt-1 block"><?= date('H:i', strtotime($msg['created_at'])) ?></span>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endif; ?>

    </div>

    <!-- Chat Input - fixed to bottom -->
    <div class="bg-[#ffffff] border-t border-[#d3cec6] px-4 py-3 flex-shrink-0">
        <?php if ($appointment['status'] == 'pending'): ?>
            <div class="text-center py-2">
                <p class="text-xs text-[#7b7b78] italic">Menunggu respon dokter...</p>
            </div>
        <?php elseif ($consultation && $consultation['status'] === 'active'): ?>
            <div class="flex items-center space-x-3">
                <label for="chat-attachment" class="w-10 h-10 bg-[#f5f1ec] rounded-[24px] flex items-center justify-center cursor-pointer hover:bg-[#ebe7e1] transition-all flex-shrink-0 text-[#626260]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                    </svg>
                </label>
                <input type="file" id="chat-attachment" class="hidden" accept="image/*,.pdf,.doc,.docx">
                <input id="chat-input" type="text" placeholder="Ketik pesan..."
                    class="flex-1 bg-[#f5f1ec] rounded-[24px] px-4 py-2.5 text-sm text-[#111111] focus:outline-none focus:ring-2 focus:ring-blue-300 focus:bg-[#ffffff] transition-all">
                <button id="send-btn"
                    class="w-10 h-10 bg-[#003E7E] rounded-[24px] flex items-center justify-center hover:bg-[#002855] transition-all active:scale-95 flex-shrink-0  -blue-200">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                </button>
            </div>
        <?php else: ?>
            <div class="text-center py-2">
                <p class="text-xs text-[#626260] font-medium bg-[#f5f1ec] py-2 rounded-[16px]">Konsultasi telah berakhir.</p>
            </div>
        <?php endif; ?>
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
        
        // Skip if message already exists
        if ($(`.message-item[data-id="${msg.id}"]`).length > 0) return;

        var isMe = (msg.sender_id == currentUserId);
        // Fix to strictly use 24-hour format
        var time = new Date(msg.created_at).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', hour12: false }).replace('.', ':');
        
        var html = '';
        if (isMe) {
            html = `
                <div class="flex justify-end message-item" data-id="${msg.id}">
                    <div class="bg-[#003E7E] rounded-[24px] rounded-tr-sm px-4 py-3 max-w-[78%]">
                        ${msg.attachment_path ? '<img src="<?= base_url() ?>' + msg.attachment_path + '" class="max-w-full rounded-lg mb-2">' : ''}
                        <p class="text-white text-sm leading-relaxed">${$('<div>').text(msg.message).html()}</p>
                        <span class="text-xs text-blue-200 mt-1 block text-right">${time}</span>
                    </div>
                </div>`;
        } else {
            html = `
                <div class="flex justify-start items-end space-x-2 message-item" data-id="${msg.id}">
                    <div class="w-7 h-7 bg-[#ebe7e1] rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5 text-[#111111]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div class="bg-[#ffffff] rounded-[24px] rounded-tl-sm px-4 py-3 max-w-[78%]  border border-gray-50">
                        ${msg.attachment_path ? '<img src="<?= base_url() ?>' + msg.attachment_path + '" class="max-w-full rounded-lg mb-2">' : ''}
                        <p class="text-[#111111] text-sm leading-relaxed">${$('<div>').text(msg.message).html()}</p>
                        <span class="text-xs text-[#7b7b78] mt-1 block">${time}</span>
                    </div>
                </div>`;
        }
        
        $('#chat-messages').append(html);
        if (parseInt(msg.id) > lastId) lastId = parseInt(msg.id);
        scrollToBottom();
    }

    function sendMessage() {
        var text = $('#chat-input').val().trim();
        var fileInput = document.getElementById('chat-attachment');
        var file = fileInput ? fileInput.files[0] : null;

        if (!text && !file) return;
        if (!consultationId) return;

        $('#send-btn').prop('disabled', true).addClass('opacity-50');

        var formData = new FormData();
        formData.append('consultation_id', consultationId);
        if (text) formData.append('message', text);
        if (file) formData.append('attachment', file);

        $.ajax({
            url: "<?= base_url('chat/send') ?>",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.status === 'success') {
                    $('#chat-input').val('');
                    if (fileInput) fileInput.value = '';
                    fetchUpdates();
                } else {
                    Toast.fire({ icon: 'error', title: response.message });
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

    <?php if ($appointment['status'] == 'pending'): ?>
    // Auto-reload for pending appointments to check if approved
    setInterval(function() {
        window.location.reload();
    }, 4000);
    <?php else: ?>
    // Poll for new messages every 3 seconds only if confirmed
    setInterval(fetchUpdates, 3000);
    <?php endif; ?>

    scrollToBottom();
});
</script>

<?= $this->endSection() ?>
