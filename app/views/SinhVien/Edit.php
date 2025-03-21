<?php
include '../app/views/shares/header.php';
include '../app/config/database.php';
include '../app/models/SinhVien.php';

$database = new Database();
$db = $database->getConnection();
$sinhVienModel = new SinhVien($db);

if (!isset($_GET['MaSV'])) {
    echo "<p class='text-red-500 text-center mt-6'>Mã sinh viên không hợp lệ.</p>";
    exit();
}

$MaSV = $_GET['MaSV'];
$sv = $sinhVienModel->getById($MaSV);

if (!$sv) {
    echo "<p class='text-red-500 text-center mt-6'>Không tìm thấy sinh viên.</p>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sv->HoTen = $_POST['HoTen'];
    $sv->GioiTinh = $_POST['GioiTinh'];
    $sv->NgaySinh = $_POST['NgaySinh'];
    $sv->MaNganh = $_POST['MaNganh'];
    
    if ($sinhVienModel->update($sv)) {
        header("Location: index.php");
        exit();
    } else {
        echo "<p class='text-red-500 text-center mt-6'>Cập nhật thất bại.</p>";
    }
}
?>

<div class="container mx-auto mt-8 px-6">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">✏️ Chỉnh Sửa Sinh Viên</h1>
    <form method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
        <label class="block mb-2 font-semibold">Họ Tên:</label>
        <input type="text" name="HoTen" value="<?= htmlspecialchars($sv->HoTen) ?>" class="w-full p-2 border rounded mb-4" required>
        
        <label class="block mb-2 font-semibold">Giới Tính:</label>
        <select name="GioiTinh" class="w-full p-2 border rounded mb-4">
            <option value="1" <?= $sv->GioiTinh ? 'selected' : '' ?>>Nam</option>
            <option value="0" <?= !$sv->GioiTinh ? 'selected' : '' ?>>Nữ</option>
        </select>
        
        <label class="block mb-2 font-semibold">Ngày Sinh:</label>
        <input type="date" name="NgaySinh" value="<?= $sv->NgaySinh ?>" class="w-full p-2 border rounded mb-4" required>
        
        <label class="block mb-2 font-semibold">Mã Ngành:</label>
        <input type="text" name="MaNganh" value="<?= htmlspecialchars($sv->MaNganh) ?>" class="w-full p-2 border rounded mb-4" required>
        
        <button type="submit" class="w-full py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition">Lưu</button>
    </form>
</div>

<?php include '../app/views/shares/footer.php'; ?>