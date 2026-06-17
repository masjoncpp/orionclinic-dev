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
            <div id="chat-messages" class="flex-1 overflow-auto p-4 space-y-4 pb-20">
                <div class="flex justify-center">
                    <span class="text-xs text-gray-400 bg-white px-4 py-1.5 rounded-full shadow-sm border border-gray-100">Konsultasi dimulai • <?= date('d M Y, H:i', strtotime($appointment['appointment_date'] . ' ' . $appointment['time_slot'])) ?></span>
                </div>

                <?php if (empty($messages)): ?>
                    <div id="no-messages" class="text-center py-10">
                        <p class="text-xs text-gray-400">Belum ada pesan dari pasien.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($messages as $msg): ?>
                        <?php if ($msg['sender_id'] == session()->get('user_id')): ?>
                            <div class="flex justify-end message-item" data-id="<?= $msg['id'] ?>">
                                <div class="bg-blue-600 rounded-2xl rounded-tr-none p-4 max-w-[80%] shadow-sm">
                                    <p class="text-white text-sm"><?= esc($msg['message']) ?></p>
                                    <span class="text-xs text-blue-200 mt-2 block"><?= date('H:i', strtotime($msg['created_at'])) ?></span>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="flex justify-start message-item" data-id="<?= $msg['id'] ?>">
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
                <?php if ($consultation && $consultation['status'] === 'active'): ?>
                    <div class="flex items-center space-x-3">
                        <button class="p-2 text-gray-400 hover:text-gray-600 transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>
                        </button>
                        <div class="flex-1 relative">
                            <input id="chat-input" type="text" placeholder="Ketik balasan untuk pasien..." class="w-full px-4 py-3 bg-gray-100 rounded-full text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500/30">
                        </div>
                        <button id="send-btn" class="p-3 bg-blue-600 rounded-full text-white hover:bg-blue-700 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                        </button>
                    </div>
                <?php else: ?>
                    <div class="text-center py-2">
                        <p class="text-xs text-gray-500 font-medium bg-gray-100 py-2 rounded-xl">Konsultasi telah berakhir.</p>
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
        if ($(`.message-item[data-id="${msg.id}"]`).length > 0) return;

        var isMe = (msg.sender_id == currentUserId);
        var time = new Date(msg.created_at).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
        
        var html = '';
        if (isMe) {
            html = `
                <div class="flex justify-end message-item" data-id="${msg.id}">
                    <div class="bg-blue-600 rounded-2xl rounded-tr-none p-4 max-w-[80%] shadow-sm">
                        <p class="text-white text-sm">${$('<div>').text(msg.message).html()}</p>
                        <span class="text-xs text-blue-200 mt-2 block">${time}</span>
                    </div>
                </div>`;
        } else {
            html = `
                <div class="flex justify-start message-item" data-id="${msg.id}">
                    <div class="bg-white rounded-2xl rounded-tl-none p-4 max-w-[80%] shadow-sm border border-gray-100">
                        <p class="text-gray-800 text-sm">${$('<div>').text(msg.message).html()}</p>
                        <span class="text-xs text-gray-400 mt-2 block">${time}</span>
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
