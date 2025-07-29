<?php require_once './views/layouts/header.php'; ?>

<?php require_once './views/layouts/menu.php'; ?>

<main><br><br><br><br><br>
  <div class="mb-4 pb-4"></div>
  <section class="login-register container">
    <h2 class="d-none">Đăng nhập và Đăng ký</h2>
    <ul class="nav nav-tabs mb-5" id="login_register" role="tablist">
      <li class="nav-item" role="presentation">
        <a class="nav-link nav-link_underscore active" id="login-tab" data-bs-toggle="tab" href="#tab-item-login" role="tab" aria-controls="tab-item-login" aria-selected="true">Đăng nhập</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link nav-link_underscore" id="register-tab" data-bs-toggle="tab" href="#tab-item-register" role="tab" aria-controls="tab-item-register" aria-selected="false">Đăng ký</a>
      </li>
    </ul>
    <div class="tab-content pt-2" id="login_register_tab_content">
      <div class="tab-pane fade show active" id="tab-item-login" role="tabpanel" aria-labelledby="login-tab">
        <?php if (isset($_SESSION['error'])): ?>
          <div class="alert alert-danger">
            <?= ($_SESSION['error']); ?>
          </div>
          <?php unset($_SESSION['error']); // Xóa lỗi sau khi hiển thị 
          ?>
        <?php endif; ?>
        <div class="login-form">

          <form action="<?= BASE_URL . '?act=check-login' ?>" method="post" name="login-form" class="needs-validation" novalidate>
            <div class="form-floating mb-3">
              <input name="email" type="email" class="form-control " id="customerNameEmailInput1" placeholder="Email" required>
              <label for="customerNameEmailInput1">Email</label>
            </div>

            <div class="pb-3"></div>

            <div class="form-floating mb-3">
              <input name="mat_khau" type="password" class="form-control" id="customerPasswodInput" placeholder="Mật khẩu" required>
              <label for="customerPasswodInput">Mật khẩu</label>
            </div>

            <div class="d-flex align-items-center mb-3 pb-2">

              <a href="reset_password.html" class="btn-text ms-auto">Quên mật khẩu?</a>
            </div><button class="btn btn-primary w-100 text-uppercase" type="submit">Đăng nhập</button>

            <div class="customer-option mt-4 text-center">
              <span class="text-secondary">Chưa có tài khoản?</span>
              <a href="#register-tab" class="btn-text js-show-register">Tạo tài khoản</a>
            </div>
          </form>
        </div>
      </div>
      <div class="tab-pane fade" id="tab-item-register" role="tabpanel" aria-labelledby="register-tab">
        <div class="register-form">
          <form name="register-form" class="needs-validation" novalidate>
            <div class="form-floating mb-3">
              <input name="register_username" type="text" class="form-control form-control_gray" id="customerNameRegisterInput" placeholder="Username" required>
              <label for="customerNameRegisterInput">Tên tài khoản</label>
            </div>

            <div class="pb-3"></div>

            <div class="form-floating mb-3">
              <input name="register_email" type="email" class="form-control form-control_gray" id="customerEmailRegisterInput" placeholder="Email address *" required>
              <label for="customerEmailRegisterInput">Email</label>
            </div>

            <div class="pb-3"></div>

            <div class="form-floating mb-3">
              <input name="register_password" type="password" class="form-control form-control_gray" id="customerPasswodRegisterInput" placeholder="Password *" required>
              <label for="customerPasswodRegisterInput">Mật khẩu</label>
            </div>

            <div class="d-flex align-items-center mb-3 pb-2">
              <p class="m-0">Dữ liệu cá nhân của bạn sẽ được sử dụng để hỗ trợ trải nghiệm của bạn trên toàn bộ trang web này, để quản lý quyền truy cập vào tài khoản của bạn và cho các mục đích khác được mô tả trong chính sách bảo mật của chúng tôi.</p>
            </div>

            <button class="btn btn-primary w-100 text-uppercase" type="submit">Đăng ký</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</main>
<?php require_once './views/layouts/footer.php'; ?>