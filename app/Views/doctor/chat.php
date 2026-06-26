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
                <div class="flex items-center space-x-2 relative" id="action-menu-container">
                    <button onclick="document.getElementById('action-menu').classList.toggle('hidden')" class="p-2 bg-[#f5f1ec] rounded-full hover:bg-[#ebe7e1] transition-all text-[#111111]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                        </svg>
                    </button>
                    
                    <div id="action-menu" class="hidden absolute top-10 right-0 mt-2 w-48 rounded-[16px] shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50 overflow-hidden divide-y divide-gray-50 border border-gray-100">
                        <div class="p-1">
                            <button onclick="window.location.href='<?= base_url('doctor/patient_profile/' . $appointment['patient_id']) ?>?back_to=chat&id=<?= $appointment['id'] ?>'" class="w-full text-left flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-[12px] transition-colors">
                                <svg class="mr-3 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Rekam Medis
                            </button>
                            <?php if ($consultation && $consultation['status'] === 'active'): ?>
                                <button onclick="window.location.href='<?= base_url('doctor/prescription_form?id=' . $appointment['id']) ?>'" class="w-full text-left flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-[12px] transition-colors">
                                    <svg class="mr-3 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                    Buat Resep
                                </button>
                            <?php endif; ?>
                        </div>
                        <?php if ($consultation && $consultation['status'] === 'active'): ?>
                        <div class="p-1">
                            <button onclick="document.getElementById('end-consultation-modal').classList.remove('hidden'); document.getElementById('action-menu').classList.add('hidden');" class="w-full text-left flex items-center px-4 py-2.5 text-sm font-bold text-red-600 hover:bg-red-50 rounded-[12px] transition-colors">
                                <svg class="mr-3 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Akhiri Konsultasi
                            </button>
                        </div>
                        <?php endif; ?>
                    </div>
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
                                    <?php if ($msg['attachment_path']): ?>
                                        <img src="<?= base_url($msg['attachment_path']) ?>" class="max-w-full rounded-lg mb-2">
                                    <?php endif; ?>
                                    <p class="text-white text-sm"><?= esc($msg['message']) ?></p>
                                    <span class="text-xs text-blue-200 mt-2 block"><?= date('H:i', strtotime($msg['created_at'])) ?></span>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="flex justify-start message-item" data-id="<?= $msg['id'] ?>">
                                <div class="bg-[#ffffff] rounded-[24px] rounded-tl-none p-4 max-w-[80%]  border border-[#d3cec6]">
                                    <?php if ($msg['attachment_path']): ?>
                                        <img src="<?= base_url($msg['attachment_path']) ?>" class="max-w-full rounded-lg mb-2">
                                    <?php endif; ?>
                                    <p class="text-[#111111] text-sm"><?= esc($msg['message']) ?></p>
                                    <span class="text-xs text-[#7b7b78] mt-2 block"><?= date('H:i', strtotime($msg['created_at'])) ?></span>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <!-- Chat Input -->
            <div class="bg-[#ffffff] px-4 py-3 border-t border-[#d3cec6] flex-shrink-0 z-20">
                <?php if ($consultation && $consultation['status'] === 'active'): ?>
                    <div class="flex items-center space-x-3">
                        <label for="chat-attachment" class="w-12 h-12 bg-[#f5f1ec] rounded-full flex items-center justify-center cursor-pointer hover:bg-[#ebe7e1] transition-all flex-shrink-0 text-[#626260]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>
                        </label>
                        <input type="file" id="chat-attachment" class="hidden" accept="image/*,.pdf,.doc,.docx">
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
<div id="end-consultation-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-[#111111]/40 backdrop-blur-sm transition-opacity p-4">
    <div class="bg-white rounded-[24px] shadow-2xl w-full max-w-md mx-auto overflow-hidden transform scale-100 flex flex-col max-h-[90vh]">
        <div class="p-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-lg font-extrabold text-[#111111] tracking-tight">Akhiri Konsultasi</h3>
            <button type="button" onclick="document.getElementById('end-consultation-modal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <form action="<?= base_url('doctor/end_consultation') ?>" method="POST" class="flex flex-col flex-1 overflow-hidden m-0">
            <div class="p-4 overflow-y-auto space-y-4">
                <input type="hidden" name="appointment_id" value="<?= $appointment['id'] ?>">
                
                <div>
                    <label class="block text-xs font-semibold text-[#111111] mb-2">Diagnosis <span class="text-red-500">*</span></label>
                    <input type="text" name="diagnosis" required class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-sm focus:outline-none focus:border-[#003E7E]">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-[#111111] mb-2">Catatan Dokter</label>
                    <textarea name="doctor_notes" rows="3" class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-sm focus:outline-none focus:border-[#003E7E]"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-[#111111] mb-2">Tindak Lanjut (Follow-up)</label>
                    <textarea name="follow_up" rows="2" placeholder="Contoh: Kontrol 1 minggu lagi" class="w-full bg-[#f9f8f6] border border-[#d3cec6] rounded-[16px] px-4 py-3 text-sm focus:outline-none focus:border-[#003E7E]"></textarea>
                </div>
                
                <div class="bg-red-50 text-red-700 p-3 rounded-xl text-xs flex items-start mt-2">
                    <svg class="w-4 h-4 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Setelah diakhiri, sesi chat akan ditutup dan Anda bisa meresepkan obat dari Riwayat Pasien.</span>
                </div>
            </div>
            <div class="p-4 border-t border-gray-100 flex space-x-3">
                <button type="button" onclick="document.getElementById('end-consultation-modal').classList.add('hidden')" 
                        class="flex-1 py-3 px-4 bg-[#f5f1ec] text-[#626260] rounded-[16px] font-bold text-sm hover:bg-[#ebe7e1] transition-all">
                    Batal
                </button>
                <button type="submit" 
                        class="flex-1 py-3 px-4 bg-red-500 text-white rounded-[16px] font-bold text-sm hover:bg-red-600 transition-all shadow-lg shadow-red-500/30">
                    Simpan & Akhiri
                </button>
            </div>
        </form>
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
                        ${msg.attachment_path ? '<img src="<?= base_url() ?>' + msg.attachment_path + '" class="max-w-full rounded-lg mb-2">' : ''}
                        <p class="text-white text-sm">${$('<div>').text(msg.message).html()}</p>
                        <span class="text-xs text-blue-200 mt-2 block">${time}</span>
                    </div>
                </div>`;
        } else {
            html = `
                <div class="flex justify-start message-item" data-id="${msg.id}">
                    <div class="bg-[#ffffff] rounded-[24px] rounded-tl-none p-4 max-w-[80%]  border border-[#d3cec6]">
                        ${msg.attachment_path ? '<img src="<?= base_url() ?>' + msg.attachment_path + '" class="max-w-full rounded-lg mb-2">' : ''}
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

    // Close action menu when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#action-menu-container').length) {
            $('#action-menu').addClass('hidden');
        }
    });

    setInterval(fetchUpdates, 3000);
    scrollToBottom();
});
</script>

<?= $this->endSection() ?>
