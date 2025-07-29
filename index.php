<?php
session_start();
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';

// Require toàn bộ file Models
require_once 'models/SanPham.php';
require_once 'models/Banner.php';
require_once 'models/TinTuc.php';
require_once 'models/DanhMuc.php';
require_once 'models/KhuyenMai.php';
require_once 'models/LienHe.php';
require_once 'models/User.php';
require_once 'models/GioHang.php';

// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
  // Trang chủ
  '/'                 => (new HomeController())->home(),
  'chi-tiet-san-pham' => (new HomeController())->chiTietSanPham(),
  'them-gio-hang' => (new HomeController())->addGioHang(),
  'gio-hang' => (new HomeController())->gioHang(),
  'cap-nhat-gio-hang' =>  (new HomeController())->capNhatGioHang(),
  'xoa-san-pham-gio-hang' =>  (new HomeController())->xoaSanPhamGioHang(),



  'list-tin-tuc' => (new HomeController())->tintuc(),
  'chi-tiet-tin-tuc' => (new HomeController())->chiTietTinTuc(),
  'banners' => (new HomeController())->home(),
  'list-danh-sach-san-pham' => (new HomeController())->listdanhsachsanpham(),
  'tim-kiem-theo-danh-muc' => (new HomeController())->timKiemTheoDanhMuc(),
  'khuyen-mai' => (new HomeController())->view(),
  'lien-he'  => (new HomeController())->views(),
  'add-lien-he'  => (new HomeController())->store(),
  'search'  => (new HomeController())->search(),
  'login'            => (new HomeController())->formLogin(),
  'check-login'            => (new HomeController())->postLogin(),
  'logout'            => (new HomeController())->logout(),
};
