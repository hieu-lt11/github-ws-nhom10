<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php

class HomeController
{
  public $modelSanPham;
  public $modelBanner;
  public $modelTinTuc;
  public $modelDanhMuc;
  public $modelKhuyenMai;
  public $modelLienHe;

  public $modelUser;
  public $modelGioHang;


  public function __construct()
  {
    $this->modelBanner = new Banner();
    $this->modelSanPham = new SanPham();
    $this->modelTinTuc = new TinTuc();
    $this->modelDanhMuc = new DanhMuc();
    $this->modelKhuyenMai = new KhuyenMai();
    $this->modelLienHe = new LienHe();
    $this->modelUser = new User();
    $this->modelGioHang = new GioHang();
  }
  public function home()
  {
    // echo "đây là home";
    $listSanPham = $this->modelSanPham->getAllSanPham();
    $banNers = $this->modelBanner->getAll();
    $tinTucs = $this->modelTinTuc->getAll();
    // $products = $this->modelSanPham->getBestSellingProducts();

    // $products = $this->modelSanPham->getBestSellingProducts();


    // var_dump($banNers);die;
    require_once './views/trangchu.php';
  }
  public function search()
  {
    $searchTerm = $_GET['search_term'];  // Dữ liệu người dùng nhập vào

    // Tách các phần từ input (giả sử sử dụng dấu phẩy để phân cách)
    $searchParts = explode(',', $searchTerm);

    // Trim (xóa khoảng trắng) mỗi phần
    $productName = isset($searchParts[0]) ? trim($searchParts[0]) : '';
    $productDescription = isset($searchParts[1]) ? trim($searchParts[1]) : '';
    $productPrice = isset($searchParts[2]) ? trim($searchParts[2]) : '';

    // Gọi model để tìm kiếm
    $products = $this->modelSanPham->searchProducts($productName, $productDescription, $productPrice);

    // Trả về kết quả cho view
    require_once 'views/trangchu.php';
  }

  //tin tức
  public function tintuc()
  {
    $tinTucs = $this->modelTinTuc->getAll();
    require_once './views/listTinTuc.php';
  }

  //chi tiết tin tức
  public function chiTietTinTuc()
  {
    $id = $_GET['id'];

    $tinTuc = $this->modelTinTuc->DetailUpdate($id);
    if (!$tinTuc) {
      echo "Không tìm thấy nội dung chi tiết!";
      return;
    }
    // var_dump($id);die;
    require_once './views/chiTietTinTuc.php';
  }

  //chi tiết sản phẩm
  public function chiTietSanPham()
  {
    $id = $_GET['id_san_pham'];

    $sanPham = $this->modelSanPham->getDetailSanPham($id);
    $listDanhGia = $this->modelSanPham->getDanhGiaFromSanPham($id);
    $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);

    $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
    $listSanPhamCungDanhMuc = $this->modelSanPham->getlistSanPhamDanhMuc($sanPham['danh_muc_id']);
    $banNers = $this->modelBanner->getAll();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (isset($_SESSION['user_client'])) {
        $mail = $this->modelUser->getUserFormEmail($_SESSION['user_client']);

        $noi_dung = isset($_POST['noi_dung']) ? trim($_POST['noi_dung']) : null;

        if (!empty($noi_dung)) {
          $this->modelSanPham->themBinhLuan($mail['id'], $id, $noi_dung);


          $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);
        }

        header("Location: ?act=chi-tiet-san-pham&id_san_pham=" . $id);
        exit();
      } else {
        echo "<script>alert('Bạn cần đăng nhập để bình luận.'); window.location.href='?act=login';</script>";
        exit();
      }
    }
    // var_dump($SanPham);
    // die();
    if ($sanPham) {
      require_once './views/detailSanPham.php';
    } else {
      header("Location: " . BASE_URL);
      exit();
    }
  }

  // Tìm kiếm sản phẩm theo danh mục
  public function timKiemTheoDanhMuc()
  {


    // Lấy danh mục ID từ URL
    $danhMucId = isset($_GET['danh_muc_id']) ? $_GET['danh_muc_id'] : null;
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'asc';  // Mặc định là 'asc' nếu không có
    $banNers = $this->modelBanner->getAll();
    // Lấy tất cả danh mục
    $listDanhMuc = $this->modelDanhMuc->getAll();

    // Lọc sản phẩm theo danh mục
    if ($danhMucId) {
      $listSanPham = $this->modelSanPham->getSanPhamByDanhMucAndSort($danhMucId, $sort);
    } else {
      $listSanPham = [];
    }

    // Hiển thị view
    require_once './views/listGiayTheThao.php';
  }

  //danh sách sản phẩm
  public function listdanhsachsanpham()
  {
    // echo "đây là home";
    $listSanPham = $this->modelSanPham->getAllSanPham();
    $banNers = $this->modelBanner->getAll();
    $listDanhMuc = $this->modelDanhMuc->getAll();
    // $searchTerm = $_GET['search_term'];  // Dữ liệu người dùng nhập vào


    require_once './views/listGiayTheThao.php';
  }

  //khuyến mãi
  public function view()
  {
    //lấy ra danh sách khuyến mãi
    $danhSachKhuyenMai = $this->modelKhuyenMai->getAllKhuyenMai();
    $banNers = $this->modelBanner->getAll();

    // var_dump($danhSachKhuyenMai);
    // die();

    //đưa dữ liệu ra view
    require_once './views/KhuyenMai.php';
  }
  // Hàm xử lý thêm vào CSDL
  public function store()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $ten = $_POST['ten'];
      $email = $_POST['email'];
      $so_dien_thoai = $_POST['so_dien_thoai'];
      $noi_dung = $_POST['noi_dung'];
      $ngay_tao = date('Y-m-d H:i:s');
      $trang_thai = 1;

      $errors = [];

      if (empty($ten)) {
        $errors['ten'] = 'Bạn phải nhập tên liên hệ';
      }
      if (empty($email)) {
        $errors['email'] = 'Bạn phải nhập email';
      }
      if (empty($so_dien_thoai)) {
        $errors['so_dien_thoai'] = 'Bạn phải nhập số điện thoại liên hệ';
      }
      if (empty($noi_dung)) {
        $errors['noi_dung'] = 'Bạn phải nhập nội dung liên hệ';
      }

      if (empty($errors)) {
        $result = $this->modelLienHe->postDataClient($ten, $email, $so_dien_thoai, $noi_dung, $ngay_tao, $trang_thai);
        if ($result) {
          // Thêm thành công, chuyển hướng với thông báo

          header('Location: ?act=/&status=success');
          exit();
        } else {
          // Xử lý lỗi khi thêm thất bại
          header('Location: ?act=lien-he&status=fail');
          exit();
        }
      } else {
        $_SESSION['errors'] = $errors;
        header('Location: ?act=lien-he');
        exit();
      }
    }
  }



  public function views()
  {
    require_once './views/LienHe.php';
  }
  public function formLogin()
  {
    require_once './views/auth/formLogin.php';
    deleteSessionError();
    exit();
  }
  public function postLogin()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $email = $_POST['email'];
      $mat_khau = $_POST['mat_khau'];
      // var_dump($email);die;

      //xử lý ktra thông tin đnăg nhập
      $user = $this->modelUser->checkLogin($email, $mat_khau);

      // var_dump($user);die();

      if ($user == $email) { //trường hợp đăng nhập thành công
        // Lưu thông tin vào secstion
        $_SESSION['user_client'] = $user;
        header("Location: " . BASE_URL);
        exit();
      } else {
        //lỗi thì lưuu lỗi vào sesstion
        $_SESSION['error'] = $user;

        $_SESSION['flash'] = true;

        header("Location: " . BASE_URL . '?act=login');
        exit();
      }
    }
  }
  public function logout()
  {
    if (isset($_SESSION['user_client'])) {
      unset($_SESSION['user_client']);
      header("Location:" . BASE_URL . "?act=login");
    }
  }
  public function addGioHang()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      if (isset($_SESSION['user_client'])) {
        $mail = $this->modelUser->getUserFormEmail($_SESSION['user_client']);
        //lấy dữu liệu giỏ hàng của người dùng
        // var_dump($mail['id']);
        // die;

        $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);

        if (!$gioHang) {

          $gioHangId = $this->modelGioHang->addGioHang($mail['id']);

          $gioHang = ['id' => $gioHangId];
          $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
        } else {

          $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
        }

        $san_pham_id = $_POST['san_pham_id'];
        $so_luong = $_POST['so_luong'];


        // Kiểm tra số lượng tồn kho
        $so_luong_ton = $this->modelGioHang->getSoLuongSanPham($san_pham_id);
        // var_dump($so_luong_ton);
        // die;
      
        if ($so_luong > $so_luong_ton) {
          echo "<script>alert('Không thể thêm sản phẩm, số lượng vượt quá tồn kho.'); window.history.back();</script>";
          exit();
        }

        $checkSanPham = false;
        foreach ($chiTietGioHang as $detail) {
          if ($detail['san_pham_id'] == $san_pham_id) {
            $newSoLuong = $detail['so_luong'] + $so_luong;

            $this->modelGioHang->updateSoLuong($gioHang['id'], $san_pham_id, $newSoLuong);

            $checkSanPham = true;
            break;
          }
        }
      }
      if (!$checkSanPham) {
        $this->modelGioHang->addDetailGioHang($gioHang['id'], $san_pham_id, $so_luong);
      }


      header("Location: " . BASE_URL . '?act=gio-hang');
    } else {
      echo "<script>alert('Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.'); window.location.href='?act=login';</script>";
      exit();
    }
  }


  public function gioHang()
  {
    if (isset($_SESSION['user_client'])) {
      $mail = $this->modelUser->getUserFormEmail($_SESSION['user_client']);
      //lấy dữu liệu giỏ hàng của người dùng
      // var_dump($mail['id']);
      // die;
      $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);
      if (!$gioHang) {
        $gioHangId = $this->modelGioHang->addGioHang($mail['id']);
        $gioHang = ['id' => $gioHangId];
        $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
      } else {
        $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
      }


      require_once './views/gioHang.php';
      // var_dump($chiTietGioHang);die;





    } else {
      var_dump("chưa đăng nhập!");
      die;
    }
  }
  public function capNhatGioHang()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {  // Kiểm tra nếu là yêu cầu POST
      if (isset($_SESSION['user_client'])) {
        $mail = $this->modelUser->getUserFormEmail($_SESSION['user_client']);
        $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);
        $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);

        // Kiểm tra nếu có dữ liệu số lượng mới gửi lên
        if (isset($_POST['so_luong'])) {
          foreach ($_POST['so_luong'] as $sanPhamId => $soLuongMoi) {
            // Kiểm tra số lượng còn lại trong kho
            $soLuongConLai = $this->modelSanPham->getSoLuongSanPham($sanPhamId);
            if ($soLuongMoi > $soLuongConLai) {
              echo "<script>alert('Không đủ số lượng để cập nhật. Số lượng sản phẩm vượt quá tồn kho.'); window.history.back();</script>";
              exit();
            }
            // Cập nhật số lượng giỏ hàng
            $this->modelGioHang->updateSoLuong($gioHang['id'], $sanPhamId, $soLuongMoi);
          }
          header("Location: " . BASE_URL . '?act=gio-hang');  // Điều hướng lại trang giỏ hàng
        }
      }
    }
  }


  public function xoaSanPhamGioHang()
  {


    if (isset($_SESSION['user_client'])) {
      $mail = $this->modelUser->getUserFormEmail($_SESSION['user_client']);
      $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);

      if ($gioHang) {
        // Lấy ID sản phẩm từ form POST
        $sanPhamId = isset($_POST['san_pham_id']) ? $_POST['san_pham_id'] : null;

        if ($sanPhamId) {
          // Xóa sản phẩm khỏi giỏ hàng
          $this->modelGioHang->xoaSanPham($gioHang['id'], $sanPhamId);
        }
      }

      // Cập nhật lại giỏ hàng sau khi xóa
      $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);
      $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);


      header("Location: " . BASE_URL . '?act=gio-hang');
      exit();
    }
  }
}
