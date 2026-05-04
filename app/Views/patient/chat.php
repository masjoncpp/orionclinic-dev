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
                <h4 class="font-bold text-gray-800 text-sm">Dr. Sarah Wijaya</h4>
                <div class="flex items-center">
                    <span class="w-2 h-2 bg-green-500 rounded-full mr-1.5 status-online"></span>
                    <span class="text-xs text-green-600 font-medium">Online sekarang</span>
                </div>
            </div>
        </div>
        <div class="flex space-x-2">
            <button class="p-2 bg-blue-50 rounded-xl hover:bg-blue-100 transition-all">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
            </button>
            <button class="p-2 bg-blue-50 rounded-xl hover:bg-blue-100 transition-all">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.069A1 1 0 0121 8.82v6.361a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Chat Messages -->
    <div id="chat-messages" class="flex-1 overflow-y-auto p-4 space-y-4 pb-20">

        <!-- System message -->
        <div class="flex justify-center">
            <span class="text-xs text-gray-400 bg-white px-4 py-1.5 rounded-full shadow-sm border border-gray-100">Konsultasi dimulai • Hari ini, 14:00</span>
        </div>

        <!-- Patient message -->
        <div class="flex justify-end">
            <div class="bg-blue-600 rounded-2xl rounded-tr-sm px-4 py-3 max-w-[78%] shadow-sm">
                <p class="text-white text-sm leading-relaxed">Selamat siang Dok. Saya mengalami demam dan sakit kepala sejak kemarin.</p>
                <span class="text-xs text-blue-200 mt-1 block text-right">14:02</span>
            </div>
        </div>

        <!-- Doctor message -->
        <div class="flex justify-start items-end space-x-2">
            <div class="w-7 h-7 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div class="bg-white rounded-2xl rounded-tl-sm px-4 py-3 max-w-[78%] shadow-sm border border-gray-50">
                <p class="text-gray-800 text-sm leading-relaxed">Baik, bisa ceritakan lebih detail? Berapa suhu tubuh Anda dan apakah ada gejala lain seperti batuk atau pilek?</p>
                <span class="text-xs text-gray-400 mt-1 block">14:03</span>
            </div>
        </div>

        <!-- Patient message -->
        <div class="flex justify-end">
            <div class="bg-blue-600 rounded-2xl rounded-tr-sm px-4 py-3 max-w-[78%] shadow-sm">
                <p class="text-white text-sm leading-relaxed">Suhu saya 38.5°C. Ada sedikit batuk kering tapi tidak pilek.</p>
                <span class="text-xs text-blue-200 mt-1 block text-right">14:05</span>
            </div>
        </div>

        <!-- Doctor message -->
        <div class="flex justify-start items-end space-x-2">
            <div class="w-7 h-7 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div class="bg-white rounded-2xl rounded-tl-sm px-4 py-3 max-w-[78%] shadow-sm border border-gray-50">
                <p class="text-gray-800 text-sm leading-relaxed">Baik. Berdasarkan gejala Anda, ini kemungkinan infeksi virus ringan. Saya akan meresepkan beberapa obat. Istirahat yang cukup dan minum air putih yang banyak ya.</p>
                <span class="text-xs text-gray-400 mt-1 block">14:08</span>
            </div>
        </div>

        <!-- Prescription card from doctor -->
        <div class="flex justify-start items-end space-x-2">
            <div class="w-7 h-7 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div class="bg-white rounded-2xl rounded-tl-sm px-4 py-3 max-w-[78%] shadow-sm border border-blue-100">
                <div class="flex items-center mb-3">
                    <div class="w-8 h-8 bg-teal-100 rounded-xl flex items-center justify-center mr-2">
                        <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                    </div>
                    <span class="text-sm font-bold text-gray-800">Resep Obat</span>
                </div>
                <div class="space-y-1.5 text-xs text-gray-600 mb-3">
                    <div class="flex justify-between">
                        <span>• Paracetamol 500mg</span>
                        <span class="text-gray-400 ml-4">3x sehari</span>
                    </div>
                    <div class="flex justify-between">
                        <span>• Amoxicillin 250mg</span>
                        <span class="text-gray-400 ml-4">2x sehari</span>
                    </div>
                    <div class="flex justify-between">
                        <span>• Vitamin C 1000mg</span>
                        <span class="text-gray-400 ml-4">1x sehari</span>
                    </div>
                </div>
                <button onclick="window.location.href='<?= base_url('patient/prescription') ?>'"
                    class="w-full text-xs text-blue-600 font-bold bg-blue-50 py-2 rounded-xl hover:bg-blue-100 transition-all">
                    Lihat Detail Resep
                </button>
                <span class="text-xs text-gray-400 mt-2 block">14:10</span>
            </div>
        </div>

    </div>

    <!-- Chat Input - fixed to bottom -->
    <div class="bg-white border-t border-gray-100 px-4 py-3 flex-shrink-0">
        <div class="flex items-center space-x-3">
            <button class="p-2 text-gray-400 hover:text-blue-600 transition-colors flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                </svg>
            </button>
            <input id="chat-input" type="text" placeholder="Ketik pesan..."
                class="flex-1 bg-gray-100 rounded-2xl px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:bg-white transition-all">
            <button id="send-btn"
                class="w-10 h-10 bg-blue-600 rounded-2xl flex items-center justify-center hover:bg-blue-700 transition-all active:scale-95 flex-shrink-0 shadow-md shadow-blue-200">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
            </button>
        </div>
    </div>

</div>

<script>
$(document).ready(function() {
    function sendMessage() {
        var text = $('#chat-input').val().trim();
        if (!text) return;

        var time = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
        var msgHtml = `
            <div class="flex justify-end">
                <div class="bg-blue-600 rounded-2xl rounded-tr-sm px-4 py-3 max-w-[78%] shadow-sm">
                    <p class="text-white text-sm leading-relaxed">${$('<div>').text(text).html()}</p>
                    <span class="text-xs text-blue-200 mt-1 block text-right">${time}</span>
                </div>
            </div>`;
        $('#chat-messages').append(msgHtml);
        $('#chat-input').val('');
        $('#chat-messages').scrollTop($('#chat-messages')[0].scrollHeight);

        setTimeout(function() {
            var replies = [
                'Baik, terima kasih informasinya.',
                'Silakan ikuti petunjuk pengobatan yang sudah diberikan ya.',
                'Jika dalam 3 hari tidak membaik, segera hubungi kembali.',
                'Semoga lekas sembuh!'
            ];
            var reply = replies[Math.floor(Math.random() * replies.length)];
            var replyTime = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
            var replyHtml = `
                <div class="flex justify-start items-end space-x-2">
                    <div class="w-7 h-7 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div class="bg-white rounded-2xl rounded-tl-sm px-4 py-3 max-w-[78%] shadow-sm border border-gray-50">
                        <p class="text-gray-800 text-sm leading-relaxed">${reply}</p>
                        <span class="text-xs text-gray-400 mt-1 block">${replyTime}</span>
                    </div>
                </div>`;
            $('#chat-messages').append(replyHtml);
            $('#chat-messages').scrollTop($('#chat-messages')[0].scrollHeight);
        }, 1200);
    }

    $('#send-btn').on('click', sendMessage);
    $('#chat-input').on('keypress', function(e) {
        if (e.which === 13) sendMessage();
    });

    $('#chat-messages').scrollTop($('#chat-messages')[0].scrollHeight);
});
</script>

<?= $this->endSection() ?>
