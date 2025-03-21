<?php include '../shares/header.php';
include(__DIR__ . '/../../controllers/SinhVienController.php');

$controller = new SinhVienController();
$controller->addStudent();
 ?>

<div class="container mx-auto mt-8 p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-3xl font-bold mb-4">THÊM SINH VIÊN</h1>
    <p class="text-gray-600 mb-6">Nhập thông tin sinh viên</p>

    <?php
    if (isset($_GET['error'])) {
        echo '<p class="text-red-500">' . htmlspecialchars($_GET['error']) . '</p>';
    }
    if (isset($_GET['success'])) {
        echo '<p class="text-green-500">Thêm sinh viên thành công!</p>';
    }
    ?>

    <form action="Create.php" method="POST" enctype="multipart/form-data">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 font-bold">MaSV</label>
                <input type="text" name="MaSV" required class="w-full border px-4 py-2 rounded-md focus:ring focus:ring-blue-300">
            </div>
            <div>
                <label class="block text-gray-700 font-bold">HoTen</label>
                <input type="text" name="HoTen" required class="w-full border px-4 py-2 rounded-md focus:ring focus:ring-blue-300">
            </div>
            <div>
                <label class="block text-gray-700 font-bold">GioiTinh</label>
                <select name="GioiTinh" required class="w-full border px-4 py-2 rounded-md focus:ring focus:ring-blue-300">
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-bold">NgaySinh</label>
                <input type="date" name="NgaySinh" required class="w-full border px-4 py-2 rounded-md focus:ring focus:ring-blue-300">
            </div>
            <div>
                <label class="block text-gray-700 font-bold">Hinh</label>
                <input type="file" name="Hinh" accept="image/*" class="w-full border px-4 py-2 rounded-md focus:ring focus:ring-blue-300">
            </div>
            <div>
                <label class="block text-gray-700 font-bold">MaNganh</label>
                <input type="text" name="MaNganh" required class="w-full border px-4 py-2 rounded-md focus:ring focus:ring-blue-300">
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600">Create</button>
            <a href="../../../public/Index.php" class="text-blue-500 ml-4">Back to List</a>
        </div>
    </form>
</div>
<?php include '../shares/footer.php';
 ?>
