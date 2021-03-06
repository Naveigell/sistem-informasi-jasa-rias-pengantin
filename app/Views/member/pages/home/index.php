<?= $this->extend('layouts/member/member') ?>

<?= $this->section('content-style') ?>
<style>
    .booking-form form .book-now {
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

<?= $this->endSection() ?>

<?= $this->section('content-body') ?>

<?php
/**
 * @var array $weddingTimes
 * @var array $products
 * @var boolean $available
 * @var boolean $hasQueryParameters
 */
?>

    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hero-text">
                        <h1>Sona A Luxury Hotel</h1>
                        <p>Here are the best hotel booking sites, including recommendations for international
                            travel and for finding low-priced hotel rooms.</p>
                        <a href="#" class="primary-btn">Discover Now</a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 offset-xl-2 offset-lg-1">
                    <div class="booking-form">
                        <h3>Booking Jasa Rias</h3>

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

                        <form action="<?= route_to('member.home'); ?>">
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
                            <div class="select-option">
                                <label for="product">Nama Jasa</label>
                                <select id="product" name="product_id">
                                    <option value=""></option>
                                    <?php foreach ($products as $product): ?>

                                        <?php
                                            $subProduct = (new \App\Models\SubProduct())->where('product_id', $product['id'])->findAll();
                                        ?>

                                        <option <?= array_key_exists('product_id', $_GET) ? ($_GET['product_id'] == $product['id'] ? 'selected' : '') : ''; ?> data-sub-products='<?= json_encode($subProduct, 1); ?>' value="<?= $product['id']; ?>"><?= $product['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="select-option">
                                <label for="sub-product">Sub Jasa</label>
                                <select id="sub-product" name="sub_product_id">
                                    <option value=""></option>
                                </select>
                            </div>

                            <button type="submit">Check Ketersediaan</button>

                            <?php if ($available): ?>
                                <a href="<?= route_to('member.product.detail', $_GET['product_id'], $_GET['sub_product_id']) . '?' . http_build_query($_GET); ?>" class="book-now">Pesan Sekarang!</a>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-slider owl-carousel">
            <div class="hs-item set-bg" data-setbg="<?= base_url('member/img/wedding1.jpg'); ?>"></div>
            <div class="hs-item set-bg" data-setbg="<?= base_url('member/img/wedding2.jpg'); ?>"></div>
            <div class="hs-item set-bg" data-setbg="<?= base_url('member/img/wedding3.jpg'); ?>"></div>
        </div>
    </section>

    <section class="aboutus-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-pic">
                        <div class="row">
                            <div class="row">
                                <?php /** @var array $discountSubProducts */
                                foreach($discountSubProducts as $subProduct): ?>

                                    <?php
                                        $product = (new \App\Models\Product())->where('id', $subProduct['product_id'])->first();
                                        $media   = (new \App\Models\ProductMedia())->where('sub_product_id', $subProduct['id'])->first();
                                    ?>

                                    <div class="col-lg-4 col-md-4">
                                        <div class="room-item">
                                            <img src="<?= $media ? base_url('/uploads/images/products/' . $media['media']) : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRbeQlsruJMdFTjMK9OkGZY527BXOvbGDWWHg&usqp=CAU'; ?>" alt="">
                                            <div class="ri-text">
                                                <h4><?= $subProduct['name']; ?> - <?= $product['name']; ?></h4>

                                                <h2 style="font-size: 25px;">
                                                    <strike class="text-secondary"><?= format_currency($subProduct['price']); ?></strike> &nbsp;
                                                    <br>
                                                    <b><?= format_currency($subProduct['discount']); ?></b>
                                                    <span class="badge badge-danger"><?= calculate_discount($subProduct['price'], $subProduct['discount']); ?>%</span>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="services-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>What We Do</span>
                        <h2>Discover Our Services</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-036-parking"></i>
                        <h4>Travel Plan</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-033-dinner"></i>
                        <h4>Catering Service</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-026-bed"></i>
                        <h4>Babysitting</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-024-towel"></i>
                        <h4>Laundry</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-044-clock-1"></i>
                        <h4>Hire Driver</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-012-cocktail"></i>
                        <h4>Bar & Drink</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?= $this->endSection() ?>

<?= $this->section('content-script') ?>
<script>
    $('#product').on('change', function (e) {
        let subProducts = $(this).find(':selected').data('sub-products');

        renderSubProduct(subProducts);
    });

    function renderSubProduct(subProducts) {
        $('#sub-product').empty();

        for (const subProduct of subProducts) {
            $('#sub-product').append('<option value="' + subProduct.id + '">' + subProduct.name + '</option>')
        }

        $('#sub-product').niceSelect('update');
    }
</script>

<?php if (array_key_exists('sub_product_id', $_GET)): ?>
    <script>
        let subProducts = $('#product').find(':selected').data('sub-products');

        renderSubProduct(subProducts);

        $('#sub-product').val('<?= $_GET["sub_product_id"] ?>').change();
        $('#sub-product').niceSelect('update');
    </script>
<?php endif; ?>
<?= $this->endSection() ?>
