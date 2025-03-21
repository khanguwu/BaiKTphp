<?php
class SinhVien
{
    private $conn;
    private $table_name = "sinhvien";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE MaSV = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function add($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh)
    {
        $query = "INSERT INTO " . $this->table_name . " (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
                  VALUES (:MaSV, :HoTen, :GioiTinh, :NgaySinh, :Hinh, :MaNganh)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':MaSV', $MaSV, PDO::PARAM_STR);
        $stmt->bindParam(':HoTen', $HoTen, PDO::PARAM_STR);
        $stmt->bindParam(':GioiTinh', $GioiTinh, PDO::PARAM_STR);
        $stmt->bindParam(':NgaySinh', $NgaySinh, PDO::PARAM_STR);
        $stmt->bindParam(':Hinh', $Hinh, PDO::PARAM_STR);
        $stmt->bindParam(':MaNganh', $MaNganh, PDO::PARAM_STR);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            return false;
        }
    }

    public function delete($MaSV)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE MaSV = :MaSV";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':MaSV', $MaSV, PDO::PARAM_STR);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Delete Error: " . $e->getMessage());
            return false;
        }
    }

    public function update($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh)
    {
        $query = "UPDATE " . $this->table_name . " 
                  SET HoTen = :HoTen, GioiTinh = :GioiTinh, NgaySinh = :NgaySinh, Hinh = :Hinh, MaNganh = :MaNganh
                  WHERE MaSV = :MaSV";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':MaSV', $MaSV, PDO::PARAM_STR);
        $stmt->bindParam(':HoTen', $HoTen, PDO::PARAM_STR);
        $stmt->bindParam(':GioiTinh', $GioiTinh, PDO::PARAM_STR);
        $stmt->bindParam(':NgaySinh', $NgaySinh, PDO::PARAM_STR);
        $stmt->bindParam(':Hinh', $Hinh, PDO::PARAM_STR);
        $stmt->bindParam(':MaNganh', $MaNganh, PDO::PARAM_STR);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Update Error: " . $e->getMessage());
            return false;
        }
    }
}
?>
