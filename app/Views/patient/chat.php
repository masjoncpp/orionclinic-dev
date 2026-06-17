<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="chat-screen" class="flex flex-col h-full bg-gray-50 fade-in">

    <!-- Chat Header -->
    <div class="bg-white px-4 py-3 border-b border-gray-100 flex items-center justify-between flex-shrink-0 shadow-sm">
        <div class="flex items-center">
            <button onclick="window.location.href='<?= base_url('patient/consultation') ?>'"
                class="p-2 -ml-1 rounded-xl hover:bg-gray-100 transition-all mr-2">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <div class="w-10 h-10 bg-blue-100 rounded-2xl flex items-center justify-center mr-3 flex-shrink-0">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div>
                <h4 class="font-bold text-gray-800 text-sm"><?= esc($appointment['doctor_name']) ?></h4>
                <div class="flex items-center">
                    <span class="w-2 h-2 <?= $appointment['doctor_status'] == 'online' ? 'bg-green-500 status-online' : 'bg-gray-300' ?> rounded-full mr-1.5"></span>
                    <span class="text-xs <?= $appointment['doctor_status'] == 'online' ? 'text-green-600' : 'text-gray-400' ?> font-medium"><?= $appointment['doctor_status'] == 'online' ? 'Online sekarang' : 'Offline' ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Chat Messages -->
    <div id="chat-messages" class="flex-1 overflow-y-auto p-4 space-y-4 pb-20">

        <!-- System message -->
        <div class="flex justify-center">
            <span class="text-xs text-gray-400 bg-white px-4 py-1.5 rounded-full shadow-sm border border-gray-100">Konsultasi dimulai • <?= date('d M Y, H:i', strtotime($appointment['appointment_date'] . ' ' . $appointment['time_slot'])) ?></span>
        </div>

        <?php if (empty($messages)): ?>
            <div id="no-messages" class="text-center py-10">
                <p class="text-xs text-gray-400">Belum ada pesan. Silakan mulai percakapan.</p>
            </div>
        <?php else: ?>
            <?php foreach ($messages as $msg): ?>
                <?php if ($msg['sender_id'] == session()->get('user_id')): ?>
                    <div class="flex justify-end message-item" data-id="<?= $msg['id'] ?>">
                        <div class="bg-blue-600 rounded-2xl rounded-tr-sm px-4 py-3 max-w-[78%] shadow-sm">
                            <p class="text-white text-sm leading-relaxed"><?= esc($msg['message']) ?></p>
                            <span class="text-xs text-blue-200 mt-1 block text-right"><?= date('H:i', strtotime($msg['created_at'])) ?></span>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="flex justify-start items-end space-x-2 message-item" data-id="<?= $msg['id'] ?>">
                        <div class="w-7 h-7 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div class="bg-white rounded-2xl rounded-tl-sm px-4 py-3 max-w-[78%] shadow-sm border border-gray-50">
                            <p class="text-gray-800 text-sm leading-relaxed"><?= esc($msg['message']) ?></p>
                            <span class="text-xs text-gray-400 mt-1 block"><?= date('H:i', strtotime($msg['created_at'])) ?></span>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>

    <!-- Chat Input - fixed to bottom -->
    <div class="bg-white border-t border-gray-100 px-4 py-3 flex-shrink-0">
        <?php if ($consultation && $consultation['status'] === 'active'): ?>
            <div class="flex items-center space-x-3">
                <input id="chat-input" type="text" placeholder="Ketik pesan..."
                    class="flex-1 bg-gray-100 rounded-2xl px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:bg-white transition-all">
                <button id="send-btn"
                    class="w-10 h-10 bg-blue-600 rounded-2xl flex items-center justify-center hover:bg-blue-700 transition-all active:scale-95 flex-shrink-0 shadow-md shadow-blue-200">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
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
        
        // Skip if message already exists
        if ($(`.message-item[data-id="${msg.id}"]`).length > 0) return;

        var isMe = (msg.sender_id == currentUserId);
        var time = new Date(msg.created_at).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
        
        var html = '';
        if (isMe) {
            html = `
                <div class="flex justify-end message-item" data-id="${msg.id}">
                    <div class="bg-blue-600 rounded-2xl rounded-tr-sm px-4 py-3 max-w-[78%] shadow-sm">
                        <p class="text-white text-sm leading-relaxed">${$('<div>').text(msg.message).html()}</p>
                        <span class="text-xs text-blue-200 mt-1 block text-right">${time}</span>
                    </div>
                </div>`;
        } else {
            html = `
                <div class="flex justify-start items-end space-x-2 message-item" data-id="${msg.id}">
                    <div class="w-7 h-7 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div class="bg-white rounded-2xl rounded-tl-sm px-4 py-3 max-w-[78%] shadow-sm border border-gray-50">
                        <p class="text-gray-800 text-sm leading-relaxed">${$('<div>').text(msg.message).html()}</p>
                        <span class="text-xs text-gray-400 mt-1 block">${time}</span>
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

    // Poll for new messages every 3 seconds
    setInterval(fetchUpdates, 3000);

    scrollToBottom();
});
</script>

<?= $this->endSection() ?>
