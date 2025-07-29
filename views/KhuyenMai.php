<?php require_once './views/layouts/header.php'; ?>
<?php require_once './views/layouts/menu.php'; ?>


<div class="container"><br><br><br><br><br><br><br><br><br>

  <main>
    
    
    <div class="row g-4">
<?php foreach($danhSachKhuyenMai as $KhuyenMaiItem){ ?>
      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card text-center shadow " style="width: 250px; height:250px;">
          <p class="card-img-top mx-auto mt-3">Adadis</p>
          <div class="card-body w-[250px] h-[250px]">
            <h5 class="card-title"><?= $KhuyenMaiItem['ten_khuyen_mai'] ?></h5>
            <p class="card-text text-muted">Hạn sử dụng: <?= $KhuyenMaiItem['ngay_ket_thuc'] ?></p>
            <div class="d-flex justify-content-between align-items-center border p-2 rounded bg-light">
              <span>MÃ: <strong><?= $KhuyenMaiItem['ma_khuyen_mai'] ?></strong></span>
              <button class="btn btn-danger btn-sm" onclick="copyCode('SHOPEE20')">Sao chép mã</button>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>


    </div>
  </main>
</div>
<div class="mb-4 pb-4"></div>
  <div class="mb-4 pb-4"> </div>


<?php require_once './views/layouts/footer.php'; ?>


<script>
  function copyCode(code) {
  navigator.clipboard.writeText(code).then(() => {
    alert("Đã sao chép mã: " + code);
  });
}

</script>
