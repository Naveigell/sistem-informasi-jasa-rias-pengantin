<?= $this->extend('layouts/member/member') ?>

<?= $this->section('content-style'); ?>
    <style>
        .booking-form form .book-now, form button {
            display: block;
            font-size: 14px;
            text-transform: uppercase;
            text-align: center;
            border: 1px solid #dfa974;
            border-radius: 2px;
            align-self: center;
            color: #fff;
            font-weight: 500;
            background: #dfa974;
            width: 100%;
            margin-top: 18px;
            padding-top: 12px;
            padding-bottom: 12px;
        }
    </style>
    <style>
        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
        }

        /* Hide the images by default */
        .mySlides {
            display: none;
        }

        .mySlides img {
            height: 500px;
        }

        /* Next & previous buttons */
        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            margin-top: -22px;
            padding: 16px;
            color: white;
            font-weight: bold;
            font-size: 20px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
            background-color: rgba(255, 255, 255, 0.6);
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover, .next:hover {
            background-color: rgba(255, 255, 255, 1);
        }

        /* Caption text */
        .text {
            color: #f2f2f2;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }

        /* Number text (1/3 etc) */
        .numbertext {
            color: #f2f2f2;
            font-size: 15px;
            font-weight: bold;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        /* The dots/bullets/indicators */
        .dot {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .dot:hover {
            background-color: #717171;
        }

        /* Fading animation */
        .fade {
            animation-name: fade;
            animation-duration: 4s;
        }

        @keyframes fade {
            /*from {opacity: 1}*/
            /*to {opacity: 1}*/
        }
    </style>
<?= $this->endSection(); ?>

<?= $this->section('content-body') ?>

<?php
/**
 * @var array $subProduct
 * @var array $product
 */
?>
<?php
/**
 * @var array $weddingTimes
 * @var array $products
 * @var boolean $available
 * @var boolean $hasQueryParameters
 */
?>

    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2><?= $product['name']; ?> - <?= $subProduct['name']; ?></h2>
                        <div class="bt-option">
                            <a href="<?= route_to('member.home'); ?>">Home</a>
                            <span>Jasa</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Room Details Section Begin -->
    <section class="room-details-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="room-details-item">

                        <?php
                            $medias = (new \App\Models\ProductMedia())->where('product_id', $product['id'])->where('sub_product_id', $subProduct['id'])->findAll();
                        ?>

                        <?php if (count($medias) > 0): ?>

                            <div class="slideshow-container">

                                <?php foreach ($medias as $index => $media): ?>
                                    <div class="mySlides">
                                        <div class="numbertext"><?= $index + 1; ?> / <?= count($medias); ?></div>
                                        <img src="<?= base_url('/uploads/images/products/' . $media['media']); ?>" style="width:100%">
                                    </div>
                                <?php endforeach; ?>

                                <!-- Next and previous buttons -->
                                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                <a class="next" onclick="plusSlides(1)">&#10095;</a>
                            </div>
                        <?php endif; ?>

                        <div class="rd-text">
                            <div class="rd-title">
                                <h3><?= $product['name']; ?> - <?= $subProduct['name']; ?></h3>
                                <div class="rdt-right">
<!--                                    <div class="rating">-->
<!--                                        <i class="icon_star"></i>-->
<!--                                        <i class="icon_star"></i>-->
<!--                                        <i class="icon_star"></i>-->
<!--                                        <i class="icon_star"></i>-->
<!--                                        <i class="icon_star-half_alt"></i>-->
<!--                                    </div>-->
<!--                                    --><?php //if ($available): ?>
<!--                                        <form action="--><?//= route_to('member.booking.index', $product['id'], $subProduct['id']); ?><!--">-->
<!--                                            --><?php //if (@!empty($_GET['wedding_date'])): ?>
<!--                                                <input type="date" name="wedding_date" hidden readonly value="--><?//= date('Y-m-d', strtotime($_GET['wedding_date'])); ?><!--">-->
<!--                                            --><?php //endif; ?>
<!---->
<!--                                            --><?php //if (@!empty($_GET['wedding_time_id'])): ?>
<!--                                                <input type="text" name="wedding_time_id" hidden readonly value="--><?//= $_GET['wedding_time_id']; ?><!--">-->
<!--                                            --><?php //endif; ?>
<!---->
<!--                                            --><?php //if (@!empty($_GET['product_id'])): ?>
<!--                                                <input type="text" name="product_id" hidden readonly value="--><?//= $_GET['product_id']; ?><!--">-->
<!--                                            --><?php //endif; ?>
<!---->
<!--                                            --><?php //if (@!empty($_GET['sub_product_id'])): ?>
<!--                                                <input type="text" name="sub_product_id" hidden readonly value="--><?//= $_GET['sub_product_id']; ?><!--">-->
<!--                                            --><?php //endif; ?>
<!---->
<!--                                            <button style="padding-left: 20px; padding-right: 20px;">Pesan Sekarang!</button>-->
<!--                                        </form>-->
<!--                                    --><?php //endif; ?>
                                </div>
                            </div>
                            <h2 style="font-size: 25px;">
                                <?php if($subProduct['discount']): ?>
                                    <strike class="text-secondary"><?= format_currency($subProduct['price']); ?></strike> &nbsp;
                                    <b><?= format_currency($subProduct['discount']); ?></b>
                                <?php else: ?>
                                    <?= format_currency($subProduct['price']); ?>
                                <?php endif; ?>
                            </h2>
                            <p class="f-para"><?= $subProduct['description']; ?></p>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="room-booking booking-form">
                        <h3>Booking</h3>
                        <?php if ((empty(@$_GET['wedding_date']) ||
                                empty(@$_GET['wedding_time_id']) ||
                                empty(@$_GET['product_id']) ||
                                empty(@$_GET['sub_product_id'])) &&
                            @$_GET['check']): ?>

                            <div class="alert alert-danger">Tolong isi semua field</div>

                        <?php else: ?>

                        <?php endif; ?>

                        <?php if ($available): ?>
                            <div class="alert alert-success">
                                Tanggal Dapat Dibooking
                            </div>
                        <?php elseif ($hasQueryParameters): ?>
                            <div class="alert alert-danger">
                                Tanggal Sudah Terbooking
                            </div>
                        <?php endif; ?>
                        <form action="<?= route_to('member.product.detail', $product['id'], $subProduct['id']); ?>" id="form">
                            <input type="hidden" name="check" value="true">
                            <div class="check-date">
                                <label for="date-in">Tanggal Pernikahan</label>
                                <input type="text" value="<?= array_key_exists('wedding_date', $_GET) ? $_GET['wedding_date'] : ''; ?>" name="wedding_date" class="date-input" id="date-in">
                                <i class="icon_calendar"></i>
                            </div>
                            <div class="select-option">
                                <label for="date-out">Jam Rias</label>
                                <select id="guest" name="wedding_time_id">
                                    <option value=""></option>
                                    <?php foreach ($weddingTimes as $time): ?>
                                        <option <?= array_key_exists('wedding_time_id', $_GET) ? ($_GET['wedding_time_id'] == $time['id'] ? 'selected' : '') : ''; ?> value="<?= $time['id']; ?>"><?= date('H:i', strtotime($time['wedding_time'])); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <script>
                                let routes = [];
                            </script>
                            <div class="select-option">
                                <label for="product">Nama Jasa</label>
                                <select id="product" name="product_id">
                                    <option value=""></option>
                                    <?php foreach ($products as $prod): ?>

                                        <?php
                                            $subProds = (new \App\Models\SubProduct())->where('product_id', $prod['id'])->findAll();

                                            $subProdRoutes = [];

                                            foreach ($subProds as $subProd) {
                                                $subProdRoutes['id-' . $subProd['id']] = route_to('member.product.detail', $prod['id'], $subProd['id']);
                                        ?>
                                        <script>
                                            routes["<?= 'id-' . $subProd['id']; ?>"] = "<?= route_to('member.product.detail', $prod['id'], $subProd['id']); ?>";
                                        </script>

                                        <?php } ?>

                                        <option data-urls='<?= json_encode($subProdRoutes, 1); ?>' <?= array_key_exists('product_id', $_GET) ? ($_GET['product_id'] == $prod['id'] ? 'selected' : '') : ''; ?> data-sub-products='<?= json_encode($subProds, 1); ?>' value="<?= $prod['id']; ?>"><?= $prod['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="select-option">
                                <label for="sub-product">Sub Jasa</label>
                                <select id="sub-product" name="sub_product_id">
                                    <option value=""></option>
                                </select>
                            </div>

                            <button type="submit">Check Harga & Ketersediaan</button>
                        </form>
                    </div>
                    <?php if($available): ?>
                        <div class="room-booking booking-form mt-4">

                            <hr>

                            <?php
                                $weddingTime = null;

                                if (@$_GET['wedding_time_id']) {
                                    $weddingTime = (new \App\Models\WeddingTime())->where('id', $_GET['wedding_time_id'])->first();
                                }
                            ?>

                            <h3>Form Data Diri</h3>
                            <?php if ($errors = session()->getFlashdata('errors')): ?>
                                <div class="alert-danger alert">
                                    <ul>
                                        <?php foreach ($errors as $error): ?>
                                            <li><?= $error; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <form action="<?= route_to('member.booking.store', $_GET['product_id'], $_GET['sub_product_id']); ?>" id="form" method="post">
                                <?= csrf_field(); ?>
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input class="form-control" name="name" type="text" value="<?= session()->get('user')->name; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <input class="form-control" name="address" type="text">
                                </div>

                                <div class="form-group">
                                    <label for="">No Telp</label>
                                    <input class="form-control" name="phone" type="text">
                                </div>

                                <div class="form-group">
                                    <label for="">NIK</label>
                                    <input class="form-control" name="identity_card" type="text">
                                </div>

                                <div class="form-group">
                                    <label for="">Tanggal Pernikahan</label>
                                    <input class="form-control" name="wedding_date" readonly value="<?= @$_GET['wedding_date'] ? date('Y-m-d', strtotime($_GET['wedding_date'])) : ''; ?>" type="text">
                                </div>

                                <div class="form-group">
                                    <label for="">Jam Rias</label>
                                    <input class="form-control" name="wedding_time" readonly value="<?= $weddingTime ? date('H:i', strtotime($weddingTime['wedding_time'])) : ''; ?>" type="text">
                                </div>

                                <div class="form-group">
                                    <label for="">Tanggal Prewedding</label>
                                    <input class="form-control date-input" name="pre_wedding_date" type="text">
                                </div>

                                <?php if (@$_GET['wedding_time_id']): ?>
                                    <input type="hidden" name="wedding_time_id" value="<?= $_GET['wedding_time_id']; ?>" readonly>
                                <?php endif; ?>

                                <?php if (@$_GET['product_id']): ?>
                                    <input type="hidden" name="product_id" value="<?= $_GET['product_id']; ?>" readonly>
                                <?php endif; ?>

                                <?php if (@$_GET['sub_product_id']): ?>
                                    <input type="hidden" name="sub_product_id" value="<?= $_GET['sub_product_id']; ?>" readonly>
                                <?php endif; ?>

                                <?php if ($available): ?>
                                    <button type="submit">Pesan Sekarang!</button>
                                <?php endif; ?>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>

<?= $this->section('content-script'); ?>
    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        // Next/previous controls
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        // Thumbnail image controls
        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slides[slideIndex-1].style.display = "block";
        }
    </script>
    <script>

        $('#product').on('change', function (e) {
            let subProducts = $(this).find(':selected').data('sub-products');

            renderSubProduct(subProducts);

            changeFormAction('#sub-product');
        });

        function renderSubProduct(subProducts) {
            $('#sub-product').empty();

            for (const subProduct of subProducts) {
                $('#sub-product').append('<option data-id="' + subProduct.id + '" value="' + subProduct.id + '">' + subProduct.name + '</option>')
            }

            $('#sub-product').niceSelect('update');
        }

        function changeFormAction(element) {
            let id = $(element).find(':selected').data('id');

            $('#form').attr('action', routes['id-' + id]);
        }
    </script>

    <?php if (array_key_exists('sub_product_id', $_GET)): ?>
        <script>
            let subProducts = $('#product').find(':selected').data('sub-products');

            renderSubProduct(subProducts);

            $('#sub-product').val('<?= $_GET["sub_product_id"] ?>').change();
            $('#sub-product').niceSelect('update');

            $('#sub-product').on('change', function () {
                changeFormAction(this);
            })
        </script>
    <?php endif; ?>
<?= $this->endSection(); ?>
