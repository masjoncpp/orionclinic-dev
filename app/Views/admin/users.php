<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="h-full flex flex-col bg-[#f5f1ec] overflow-hidden fade-in">
    <header class="bg-[#ffffff] px-6 py-4 flex items-center justify-between border-b border-[#d3cec6] sticky top-0 z-10">
        <div class="flex items-center space-x-4">
            <a href="<?= base_url('admin') ?>" class="text-[#7b7b78] hover:text-[#111111] transition-colors">
                <?= icon('arrow-left', 24) ?>
            </a>
            <div>
                <h1 class="text-xl font-bold text-[#111111]">Manajemen Pengguna</h1>
                <p class="text-sm text-[#7b7b78] mt-1">Daftar seluruh pengguna sistem</p>
            </div>
        </div>
    </header>

    <div class="flex-1 overflow-y-auto p-6">
        <div class="max-w-6xl mx-auto">
            <div class="bg-white rounded-[32px] shadow-sm border border-[#ebe7e1] overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[800px]">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-xs uppercase tracking-wider text-[#7b7b78]">
                                <th class="py-4 px-6 font-semibold">Nama / ID</th>
                                <th class="py-4 px-6 font-semibold">Email</th>
                                <th class="py-4 px-6 font-semibold">Role</th>
                                <th class="py-4 px-6 font-semibold">Terdaftar</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php foreach($users as $user): ?>
                                <tr class="hover:bg-[#f9f8f6] transition-colors">
                                    <td class="py-4 px-6 align-middle">
                                        <p class="text-sm font-bold text-[#111111]"><?= esc($user['name']) ?></p>
                                        <p class="text-xs text-[#7b7b78] mt-1">ID: #<?= $user['id'] ?></p>
                                    </td>
                                    <td class="py-4 px-6 align-middle text-sm text-[#111111]">
                                        <?= esc($user['email']) ?>
                                    </td>
                                    <td class="py-4 px-6 align-middle">
                                        <?php 
                                            $roleClass = 'bg-gray-100 text-gray-700';
                                            if ($user['role'] == 'admin') $roleClass = 'bg-purple-100 text-purple-700';
                                            elseif ($user['role'] == 'doctor') $roleClass = 'bg-blue-100 text-blue-700';
                                            elseif ($user['role'] == 'patient') $roleClass = 'bg-green-100 text-green-700';
                                            elseif ($user['role'] == 'farmasi') $roleClass = 'bg-yellow-100 text-yellow-700';
                                        ?>
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-bold capitalize <?= $roleClass ?>">
                                            <?= esc($user['role']) ?>
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 align-middle text-sm text-[#7b7b78]">
                                        <?= $user['created_at'] ? date('d M Y', strtotime($user['created_at'])) : '-' ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
