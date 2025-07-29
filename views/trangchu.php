<?php require_once './views/layouts/header.php'; ?>

<?php require_once './views/layouts/menu.php'; ?>



<main> <br><br><br>
  <section class="swiper-container js-swiper-slider slideshow slideshow-navigation-white-sm"
    data-settings='{
        "autoplay": {
          "delay": 5000
        },
        "navigation": {
          "nextEl": ".slideshow__next",
          "prevEl": ".slideshow__prev"
        },
        "pagination": {
          "el": ".slideshow-pagination",
          "type": "bullets",
          "clickable": true
        },
        "slidesPerView": 1,
        "effect": "fade",
        "loop": true
      }'>
    <div class="swiper-wrapper">
      <?php foreach ($banNers as $key => $banner) { ?>

        <div class="swiper-slide">
          <div class="overflow-hidden position-relative h-100">
            <div class="slideshow-character position-absolute position-right-center mx-xl-5">
              <img loading="lazy" src="<?= $banner['link_hinh_anh'] ?>" width="945" height="733" alt="Woman Fashion 1" class="slideshow-character__img animate animate_fade animate_btt animate_delay-9 w-auto h-auto">
            </div>
            <div class="slideshow-text container position-absolute start-50 top-50 translate-middle">
              <h6 class="text-yellow-bg-rounded text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3">New Arrivals</h6>
              <h2 class="h1 fw-normal mb-2 mb-lg-3 animate animate_fade animate_btt animate_delay-5"><?= $banner['ten_danh_muc_banner'] ?></h2>
              <a href="shop1.html" class="btn-link btn-link_md default-underline fw-medium animate animate_fade animate_btt animate_delay-7">Shop Now</a>
            </div>
          </div>


        </div><!-- /.slideshow-item -->
      <?php } ?>
    </div><!-- /.slideshow-wrapper js-swiper-slider -->

    <div class="slideshow__prev position-absolute top-50 d-flex align-items-center justify-content-center">
      <i class="bi bi-chevron-left"></i>
    </div><!-- /.slideshow__prev -->
    
    <div class="slideshow__next position-absolute top-50 d-flex align-items-center justify-content-center">
      <i class="bi bi-chevron-right"></i>
    </div><!-- /.slideshow__next -->

    <div class="container">
      <div class="slideshow-pagination d-flex align-items-center position-absolute bottom-0 mb-5"></div>
      <!-- /.products-pagination -->
    </div><!-- /.container -->
  </section><!-- /.slideshow -->

  <section class="grid-banner container mb-3">
        <h2 class="d-none">Banner</h2>
        <div class="row">
          <div class="col-lg-4">
            <div class="grid-banner__item position-relative mb-3">
              <img loading="lazy" class="w-100 h-auto" src="./assets/images/home/demo10/grid_banner_1.jpg" width="450" height="450" alt="">
              
            </div>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <div class="grid-banner__item position-relative mb-3">
              <img loading="lazy" class="w-100 h-auto" src="./assets/images/home/demo10/grid_banner_2.jpg" width="450" height="450" alt="">
              
            </div>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <div class="grid-banner__item position-relative mb-3">
              <img loading="lazy" class="w-100 h-auto" src="./assets/images/home/demo10/grid_banner_3.jpg" width="450" height="450" alt="">
              
            </div>
          </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
      </section>
  <div class="container mw-1620 bg-white">
    <div class="mb-3 mb-xl-5 pt-1 pb-2"></div>



    <div class="mb-3 mb-xl-5 pt-1 pb-2"></div>



    <section class="products-carousel container">
      <div class="d-flex align-items-center justify-content-between flex-wrap mb-3 pb-xl-2 mb-xl-4">
        <h2 class="section-title fw-normal text-center">Sản phẩm mới</h2>
        <ul class="nav nav-tabs justify-content-center" id="collections-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link nav-link_underscore active" id="collections-tab-1-trigger" data-bs-toggle="tab" href="#collections-tab-1" role="tab" aria-controls="collections-tab-1" aria-selected="true">Sản Phẩm</a>
          </li>
        </ul>
      </div>

      <div class="tab-content pt-2" id="collections-tab-content">
        <div class="tab-pane fade show active" id="collections-tab-1" role="tabpanel" aria-labelledby="collections-tab-1-trigger">
          <div class="products-grid">
            <?php foreach ($listSanPham as $key => $sanPham) : ?>
              <div class="product-card product-card_style3">
                <div class="pc__img-wrapper border-radius-0">
                  <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                    <img loading="lazy" width="330" height="400" class="pc__img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                  </a>
                </div>
                <div class="pc__info position-relative">
                  <p class="pc__category text-uppercase">
                    <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>"><?= $sanPham['ten_san_pham'] ?></a>
                  </p>
                  <div class="product-card__price d-flex align-items-center">
                    <span class="money price"><?= number_format($sanPham['gia_ban'], 0, ',', '.') ?>đ</span>
                  </div>
                  <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                    <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Thêm giỏ hàng</button>
                    <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                      <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>" class="d-none d-xxl-block">Xem chi tiết</a>
                      <span class="d-block d-xxl-none">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <use href="#icon_view" />
                        </svg>
                      </span>
                    </button>
                  </div>
                  <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <use href="#icon_heart" />
                    </svg>
                  </button>
                </div>
              </div>
            <?php endforeach ?>
          </div>
        </div>
      </div>
    </section>
    <style>
      .products-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        /* 4 cột */
        gap: 20px;
        /* Khoảng cách giữa các sản phẩm */
      }

      .product-card {
        background-color: #fff;
        padding: 10px;
        border-radius: 5px;
      }
    </style>
  </div>
  <div class="mb-4 pb-4 mb-xl-4 mt-xl-3 pt-xl-3 pb-xl-4"></div>



  <div class="mb-4 pb-4 mb-xl-4 mt-xl-3 pt-xl-3 pb-xl-4"></div>



  <section class="blog-carousel container">
    <div class="d-flex align-items-center justify-content-between flex-wrap mb-3 pb-xl-2 mb-xl-4">
      <h2 class="section-title fw-normal text-center">Tin Tức</h2>
      <a class="btn-link btn-link_md default-underline text-uppercase fw-medium" href="blog_list1.html">Xem thêm</a>
    </div>

    <div class="position-relative">
      <div class="swiper-container js-swiper-slider"
        data-settings='{
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": 3,
            "slidesPerGroup": 3,
            "effect": "none",
            "loop": true,
            "breakpoints": {
              "320": {
                "slidesPerView": 1,
                "slidesPerGroup": 1,
                "spaceBetween": 14
              },
              "640": {
                "slidesPerView": 2,
                "slidesPerGroup": 2,
                "spaceBetween": 24
              },
              "800": {
                "slidesPerView": 3,
                "slidesPerGroup": 1,
                "spaceBetween": 30
              }
            }
          }'>
        <div class="swiper-wrapper blog-grid row-cols-xl-3">
          <?php foreach ($tinTucs as $key => $tintuc) { ?>
            <div class="swiper-slide blog-grid__item mb-4">
            <div class="blog-grid__item-image">
              <a href="?act=chi-tiet-tin-tuc&id=<?=$tintuc['tin_tuc_id']?>"><img loading="lazy" src="<?=$tintuc['hinh_anh']?>" width="450" height="300" alt=""></a>
            </div>
            <div class="blog-grid__item-detail">
              <div class="blog-grid__item-meta">
                <span class="blog-grid__item-meta__author">By Admin</span>
                <span class="blog-grid__item-meta__date"><?=$tintuc['ngay_xuat_ban']?></span>
              </div>
              <div class="blog-grid__item-title mb-0">
                <a href="?act=chi-tiet-tin-tuc&id=<?=$tintuc['tin_tuc_id']?>"><?=$tintuc['tieu_de']?></a>
              </div>
            </div>
          </div>
          <?php } ?>
          
        
        </div><!-- /.swiper-wrapper -->
      </div><!-- /.swiper-container js-swiper-slider -->
    </div><!-- /.position-relative -->
  </section>
  <?php require_once './views/layouts/cart.php'; ?>
  <?php require_once './views/layouts/footer.php'; ?>
<style>
  .blog-carousel container{
    display: flex;
    flex-direction: column;
    gap: 10px; /* Điều chỉnh khoảng cách giữa các phần tử */
  }
</style>

</main>

