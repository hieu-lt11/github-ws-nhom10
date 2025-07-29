<?php
class Banner
{
    public $conn;
    //kết nối cơ sở dữ liệu
    public function __construct()
    {
        $this->conn = connectDB();
    }

    //Danh sách banner
    public function getAll()
    {
        try {
            $sql = 'SELECT * FROM danh_muc_banners';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }

  }
