<?php
include(__DIR__ . '/../config/database.php');
include(__DIR__ . '/../models/SinhVien.php');

class SinhVienController
{
    private $sinhVienModel;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->sinhVienModel = new SinhVien($db);
    }

    public function getAllStudents()
    {
        return $this->sinhVienModel->getAll();
    }

    public function addStudent()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $MaSV = $_POST['MaSV'];
            $HoTen = $_POST['HoTen'];
            $GioiTinh = $_POST['GioiTinh'];
            $NgaySinh = $_POST['NgaySinh'];
            $MaNganh = $_POST['MaNganh'];

            $Hinh = "";
            if (!empty($_FILES['Hinh']['name'])) {
                $target_dir = "../../uploads/";
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $Hinh = basename($_FILES["Hinh"]["name"]);
                $target_file = $target_dir . $Hinh;
                if (move_uploaded_file($_FILES["Hinh"]["tmp_name"], $target_file)) {
                    $Hinh = "../app/uploads/" . $Hinh;
                }
            }

            if ($this->sinhVienModel->add($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh)) {
                header("Location: index.php?success=1");
                exit();
            } else {
                header("Location: Create.php?error=1");
                exit();
            }
        }
    }

    public function deleteStudent()
    {
        if (isset($_GET['MaSV'])) {
            $MaSV = $_GET['MaSV'];
            if ($this->sinhVienModel->delete($MaSV)) {
                header("Location: index.php?deleted=1");
                exit();
            } else {
                header("Location: index.php?delete_error=1");
                exit();
            }
        }
    }

    public function updateStudent()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $MaSV = $_POST['MaSV'];
            $HoTen = $_POST['HoTen'];
            $GioiTinh = $_POST['GioiTinh'];
            $NgaySinh = $_POST['NgaySinh'];
            $MaNganh = $_POST['MaNganh'];

            $Hinh = $_POST['OldHinh'];
            if (!empty($_FILES['Hinh']['name'])) {
                $target_dir = "../../uploads/";
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $Hinh = basename($_FILES["Hinh"]["name"]);
                $target_file = $target_dir . $Hinh;
                if (move_uploaded_file($_FILES["Hinh"]["tmp_name"], $target_file)) {
                    $Hinh = "../app/uploads/" . $Hinh;
                }
            }

            if ($this->sinhVienModel->update($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh)) {
                header("Location: index.php?updated=1");
                exit();
            } else {
                header("Location: Edit.php?error=1&MaSV=$MaSV");
                exit();
            }
        }
    }
}
?>
