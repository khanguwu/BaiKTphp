<?php
include '../app/views/shares/header.php';
include '../app/config/database.php';
include '../app/models/SinhVien.php';

// Khởi tạo kết nối và model SinhVien
$database = new Database();
$db = $database->getConnection();
$sinhVienModel = new SinhVien($db);

// Lấy danh sách sinh viên
$sinhViens = $sinhVienModel->getAll();
?>

<div class="container mx-auto mt-8 px-6">
    <h1 class="text-4xl font-bold mb-6 text-center text-gray-800">📋 Danh Sách Sinh Viên</h1>
    
    <div class="flex justify-between items-center mb-6">
        <a href="../app/views/SinhVien/Create.php" class="px-6 py-3 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 transition flex items-center gap-2">
            ➕ <span>Thêm Sinh Viên</span>
        </a>
    </div>

    <div class="overflow-x-auto rounded-lg shadow-lg bg-white p-4">
        <table class="min-w-full border border-gray-300 rounded-lg">
            <thead class="bg-gradient-to-r from-blue-500 to-blue-700 text-white">
                <tr>
                    <th class="py-3 px-6 text-left">Mã SV</th>
                    <th class="py-3 px-6 text-left">Họ Tên</th>
                    <th class="py-3 px-6 text-center">Giới Tính</th>
                    <th class="py-3 px-6 text-center">Ngày Sinh</th>
                    <th class="py-3 px-6 text-center">Hình</th>
                    <th class="py-3 px-6 text-left">Mã Ngành</th>
                    <th class="py-3 px-6 text-center">Hành Động</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                <?php foreach ($sinhViens as $sv) : ?>
                    <tr class="border-b border-gray-300 hover:bg-gray-100 transition">
                        <td class="py-4 px-6 font-medium text-gray-900"><?= htmlspecialchars($sv->MaSV) ?></td>
                        <td class="py-4 px-6"><?= htmlspecialchars($sv->HoTen) ?></td>
                        <td class="py-4 px-6 text-center"><span class="px-3 py-1 rounded-full <?= $sv->GioiTinh ? 'bg-blue-200 text-blue-800' : 'bg-pink-200 text-pink-800' ?>">
                            <?= $sv->GioiTinh ? 'Nam' : 'Nữ' ?></span>
                        </td>
                        <td class="py-4 px-6 text-center"><?= date("d-m-Y", strtotime($sv->NgaySinh)) ?></td>
                        <td class="py-4 px-6 text-center">
                            <?php if (!empty($sv->Hinh)) : ?>
                                <img src="../uploads/<?= htmlspecialchars($sv->Hinh) ?>" 
                                     alt="Avatar" 
                                     class="h-14 w-14 rounded-full object-cover border border-gray-300 shadow-md">
                            <?php else : ?>
                                <span class="text-gray-500 italic">Không có ảnh</span>
                            <?php endif; ?>
                        </td>
                        <td class="py-4 px-6 text-gray-900 font-medium"><?= htmlspecialchars($sv->MaNganh) ?></td>
                        <td class="py-4 px-6 text-center flex justify-center gap-4">
                            <a href="../app/views/SinhVien/Edit.php?MaSV=<?= $sv->MaSV ?>" class="text-blue-500 font-semibold hover:text-blue-700 flex items-center gap-1">
                                ✏️ <span>Sửa</span>
                            </a>
                            <a href="index.php?delete=<?= $sv->MaSV ?>" class="text-red-500 font-semibold hover:text-red-700 flex items-center gap-1" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">
                                🗑️ <span>Xóa</span>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include '../app/views/shares/footer.php';
?>
