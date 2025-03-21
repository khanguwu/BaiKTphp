<?php
class HocPhan
{
    private $conn;
    private $table_name = "hocphan";

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

    public function add($MaHP, $TenHP, $SoTinChi)
    {
        $query = "INSERT INTO " . $this->table_name . " (MaHP, TenHP, SoTinChi) VALUES (:MaHP, :TenHP, :SoTinChi)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':MaHP', $MaHP);
        $stmt->bindParam(':TenHP', $TenHP);
        $stmt->bindParam(':SoTinChi', $SoTinChi);

        return $stmt->execute();
    }
}
?>
