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
        height: 400px;
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
 * @var array $booking
 */
?>
<?php
/**
 * @var array $weddingTimes
 * @var array $weddingTime
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
                        <span>Pembayaran</span>
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
            <div class="col-lg-6">
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
                        </div>
                        <h2 style="font-size: 25px;">Rp. <?= number_format($subProduct['price'], 0, ',', '.'); ?><span></span></h2>
                        <p class="f-para"><?= $subProduct['description']; ?></p>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="room-booking booking-form">
                    <h3>Form Pemesanan</h3>
                    <?php if ($errors = session()->getFlashdata('errors')): ?>
                        <div class="alert-danger alert">
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li><?= $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <form action="<?= route_to('member.payments.store', $product['id'], $subProduct['id'], $booking['id']); ?>" id="form" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input class="form-control" readonly name="name" type="text" value="<?= $booking['name']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="">Alamat</label>
                            <input class="form-control" readonly name="address" type="text" value="<?= $booking['address']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="">No Telp</label>
                            <input class="form-control" readonly name="phone" type="text" value="<?= $booking['phone']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="">NIK</label>
                            <input class="form-control" readonly name="identity_card" type="text" value="<?= $booking['identity_card']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="">Tanggal Pernikahan</label>
                            <input class="form-control" name="wedding_date" readonly value="<?= date('d F Y', strtotime($booking['wedding_date'])); ?>" type="text">
                        </div>

                        <div class="form-group">
                            <label for="">Jam Rias</label>
                            <input class="form-control" name="wedding_time" readonly value="<?= date('H:i', strtotime($weddingTime['wedding_time'])) ?>" type="text">
                        </div>

                        <div class="form-group">
                            <label for="">Tanggal Prewedding</label>
                            <input class="form-control date-input" readonly name="pre_wedding_date" type="text" value="<?= date('d F Y', strtotime($booking['pre_wedding_date'])); ?>">
                        </div>

                        <hr>

                        <h3>Form Pembayaran</h3>

                        <?php
                            $payment = (new \App\Models\Payment())->where('booking_id', $booking['id'])->first();
                        ?>

                        <?php if (!$payment): ?>

                            <div class="form-group">
                                <label for="">Bukti Pembayaran</label>
                                <input class="form-control" name="proof" type="file">
                            </div>

                            <div class="form-group">
                                <label for="">Bank Pengirim</label>
                                <input class="form-control" name="sender_bank" type="text" value="">
                            </div>

                            <div class="form-group">
                                <label for="">Nomor Rekening Pengirim</label>
                                <input class="form-control" name="sender_account_number" type="text" value="">
                            </div>

                            <div class="form-group">
                                <label for="">Nama Pengirim</label>
                                <input class="form-control" name="sender_name" type="text" value="">
                            </div>

                            <div class="form-group">
                                <label for="">Bank Tujuan</label>
                                <input class="form-control" name="merchant_bank" type="text" value="">
                            </div>

                            <span class="text-danger"><small>* Jika DP belum dibayar 2x24 jam, maka dinyatakan hangus</small></span>

                            <button type="submit">Simpan</button>

                        <?php elseif ($payment['status'] === \App\Models\Payment::STATUS_DOWN_PAYMENT): ?>
                            <div class="form-group">
                                <label for="">Bukti Pembayaran</label>
                                <div class="" style="border: 1px dashed #5f5c5c; border-radius: 5px;">
                                    <img width="100%" src="<?= base_url('/uploads/images/payments/' . $payment['proof']); ?>" alt="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Bank Pengirim</label>
                                <input class="form-control" readonly name="sender_bank" type="text" value="<?= $payment['sender_bank']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Nomor Rekening Pengirim</label>
                                <input class="form-control" readonly name="sender_account_number" type="text" value="<?= $payment['sender_account_number']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Nama Pengirim</label>
                                <input class="form-control" readonly name="sender_name" type="text" value="<?= $payment['sender_name']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Bank Tujuan</label>
                                <input class="form-control" readonly name="merchant_bank" type="text" value="<?= $payment['merchant_bank']; ?>">
                            </div>

                            <span class="text-success"><small>* Pembayaran DP sudah dibayarkan, silakan menunggu admin untuk menghubungi anda melalui WA</small></span>

                        <?php elseif ($payment['status'] === \App\Models\Payment::STATUS_PAID_OFF): ?>
                            <div class="form-group">
                                <label for="">Bukti Pembayaran</label>
                                <div class="" style="border: 1px dashed #5f5c5c; border-radius: 5px;">
                                    <img width="100%" src="<?= base_url('/uploads/images/payments/' . $payment['proof']); ?>" alt="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Bank Pengirim</label>
                                <input class="form-control" readonly name="sender_bank" type="text" value="<?= $payment['sender_bank']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Nomor Rekening Pengirim</label>
                                <input class="form-control" readonly name="sender_account_number" type="text" value="<?= $payment['sender_account_number']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Nama Pengirim</label>
                                <input class="form-control" readonly name="sender_name" type="text" value="<?= $payment['sender_name']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Bank Tujuan</label>
                                <input class="form-control" readonly name="merchant_bank" type="text" value="<?= $payment['merchant_bank']; ?>">
                            </div>

                            <span class="text-success"><small>* Pembayaran sudah lunas</small></span>
                        <?php endif; ?>
                    </form>
                </div>
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
<?= $this->endSection(); ?>
