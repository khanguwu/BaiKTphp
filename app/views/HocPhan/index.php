<?php 
include '../shares/header.php';
include '../../config/database.php'; 
include '../../models/HocPhan.php';

// Khởi tạo kết nối và model HocPhan
$database = new Database();
$db = $database->getConnection();
$hocPhan = new HocPhan($db);
$danhSachHocPhan = $hocPhan->getAll();
?>

<div class="container mt-5">
    <h2 class="text-center text-primary mb-4">📚 Danh Sách Học Phần</h2>
    
    <div class="table-responsive">
        <table class="table table-hover table-bordered text-center align-middle">
            <thead class="table-primary">
                <tr>
                    <th class="py-3">📌 Mã Học Phần</th>
                    <th class="py-3">📖 Tên Học Phần</th>
                    <th class="py-3">🎓 Số Tín Chỉ</th>
                    <th class="py-3">⚡ Hành Động</th>
                </tr>
            </thead>
            <tbody class="table-light">
                <?php foreach ($danhSachHocPhan as $hp) : ?>
                    <tr>
                        <td><?= htmlspecialchars($hp->MaHP) ?></td>
                        <td><?= htmlspecialchars($hp->TenHP) ?></td>
                        <td><?= htmlspecialchars($hp->SoTinChi) ?></td>
                        <td>
                            <button class="btn btn-outline-success fw-bold px-3 py-2">
                                Đăng Ký ✍️
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
