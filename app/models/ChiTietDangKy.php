<?php
class ChiTietDangKy
{
    private $conn;
    private $table_name = "chitietdangky";

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

    public function add($MaDK, $MaHP)
    {
        $query = "INSERT INTO " . $this->table_name . " (MaDK, MaHP) VALUES (:MaDK, :MaHP)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':MaDK', $MaDK);
        $stmt->bindParam(':MaHP', $MaHP);

        return $stmt->execute();
    }
}
?>
