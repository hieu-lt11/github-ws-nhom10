<?php
class SanPham
{
    public $conn; //khai báo phương thức

    public function __construct()
    {
        $this->conn = connectDB();
    }
    //viết hàm lấy toàn bộ danh sách sản phẩm
    public function getAllSanPham()
    {
        try {
            $sql = 'SELECT san_phams.*, danh_muc_san_phams.ten_danh_muc
            FROM san_phams
            INNER JOIN danh_muc_san_phams ON san_phams.danh_muc_id = danh_muc_san_phams.id
            ';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }
    public function getDetailSanPham($id)
    {
        try {
            $sql = 'SELECT san_phams.*, danh_muc_san_phams.ten_danh_muc
            FROM san_phams
            INNER JOIN danh_muc_san_phams ON san_phams.danh_muc_id  = danh_muc_san_phams.id
            WHERE san_phams.id = :id
            ';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id' => $id]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo 'Lỗi' . $e->getMessage();
        }
    }
    public function getListAnhSanPham($id)
    {
        try {
            $sql = 'SELECT * FROM hinh_anh_san_phams WHERE san_pham_id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id' => $id]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo 'Lỗi' . $e->getMessage();
        }
    }
    public function getBinhLuanFromSanPham($id)
    {
        try {
            $sql = 'SELECT binh_luans.*, nguoi_dungs.ten_nguoi_dung, nguoi_dungs.avatar
            FROM binh_luans
            INNER JOIN nguoi_dungs ON binh_luans.tai_khoan_id = nguoi_dungs.id
            WHERE binh_luans.san_pham_id = :id
            ';
            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id' => $id]);
            return $stmt->fetchAll();
            // var_dump($stmt);die();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }

    
    public function searchProducts($productName, $productDescription, $productPrice)
    {
        // Khởi tạo phần điều kiện SQL
        $sql = "SELECT id, ten_san_pham, gia_ban, mo_ta_dai
                FROM san_phams
                WHERE 1=1";  // Bắt đầu với một điều kiện luôn đúng

        // Thêm điều kiện tìm kiếm cho từng cột nếu có dữ liệu
        if (!empty($productName)) {
            $sql .= " AND ten_san_pham LIKE :ten_san_pham";
        }
        if (!empty($productDescription)) {
            $sql .= " AND mo_ta_dai LIKE :mo_ta_dai";
        }
        if (!empty($productPrice)) {
            $sql .= " AND gia_ban LIKE :gia_ban";
        }

        $stmt = $this->conn->prepare($sql);

        // Gán giá trị cho từng tham số nếu có
        if (!empty($productName)) {
            $stmt->bindValue(':ten_san_pham', "%$productName%", PDO::PARAM_STR);
        }
        if (!empty($productDescription)) {
            $stmt->bindValue(':mo_ta_dai', "%$productDescription%", PDO::PARAM_STR);
        }
        if (!empty($productPrice)) {
            $stmt->bindValue(':gia_ban', "%$productPrice%", PDO::PARAM_STR);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDanhGiaFromSanPham($id)
    {
        try {
            $sql = 'SELECT danh_gia_san_phams.*, nguoi_dungs.ten_nguoi_dung
            FROM danh_gia_san_phams
            INNER JOIN nguoi_dungs ON danh_gia_san_phams.tai_khoan_id = nguoi_dungs.id
            WHERE danh_gia_san_phams.san_pham_id = :id
            ';
            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id' => $id]);
            return $stmt->fetchAll();
            // var_dump($stmt);die();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }
    public function getlistSanPhamDanhMuc($danh_muc_id)
    {
        try {
            $sql = 'SELECT san_phams.*, danh_muc_san_phams.ten_danh_muc
            FROM san_phams
            INNER JOIN danh_muc_san_phams ON san_phams.danh_muc_id = danh_muc_san_phams.id
            WHERE san_phams.danh_muc_id =
            ' . $danh_muc_id;

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }
    public function getSanPhamByDanhMucAndSort($danhMucId, $sort = 'asc')
    {


        // Kiểm tra giá trị sort (asc hoặc desc)
        if ($sort !== 'asc' && $sort !== 'desc') {
            $sort = 'asc';  // Mặc định là tăng dần nếu giá trị sort không hợp lệ
        }
        $sql = "SELECT * FROM san_phams WHERE danh_muc_id = :danh_muc_id order by gia_ban $sort";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':danh_muc_id', $danhMucId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getSoLuongSanPham($sanPhamId)
    {
        $sql = "SELECT so_luong FROM san_phams WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id'=>$sanPhamId]);
        $result = $stmt->fetch();
        return $result['so_luong'];
    }
    public function themBinhLuan($tai_khoan_id, $san_pham_id, $noi_dung)
    {
        try {
            $sql = "INSERT INTO binh_luans (tai_khoan_id, san_pham_id, noi_dung, ngay_dang)
                    VALUES (:tai_khoan_id, :san_pham_id, :noi_dung,NOW())";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':tai_khoan_id' => $tai_khoan_id,
                ':san_pham_id' => $san_pham_id,
                ':noi_dung' => $noi_dung,
            ]);
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }



}
