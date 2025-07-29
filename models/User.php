<?php
class User
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getUserFormEmail($email) {
        try {
            $sql = "SELECT*FROM nguoi_dungs WHERE email=:email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':email' => $email]);
           return $stmt->fetch();

        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
            return false;
        }
    }
    public function checkLogin($email, $mat_khau)
    {
        try {
            $sql = "SELECT*FROM nguoi_dungs WHERE email=:email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch();

            if ($user && password_verify($mat_khau, $user['mat_khau'])) {
                if ($user['vai_tro'] == 2) {

                    if ($user['trang_thai'] == 1) {
                        return $user['email'];
                    } else {
                        return "Tài khoản bị cấm";
                    }
                } else {
                    return "Tài khoản không có quyền đăng nhập";
                }
            } else {
                return "Sai tài khoản hoặc mật khẩu";
            }
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
            return false;
        }
    }
}