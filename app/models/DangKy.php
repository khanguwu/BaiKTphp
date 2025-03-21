<?php
class DangKy
{
    private $conn;
    private $table_name = "dangky";

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

    public function add($NgayDK, $MaSV)
    {
        $query = "INSERT INTO " . $this->table_name . " (NgayDK, MaSV) VALUES (:NgayDK, :MaSV)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':NgayDK', $NgayDK);
        $stmt->bindParam(':MaSV', $MaSV);

        return $stmt->execute();
    }
}
?>
