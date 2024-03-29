<?= $this->extend('layouts/member/member') ?>

<?= $this->section('content-body'); ?>
<?php
/**
 * @var array $bookings
 */
?>
    <style>
        .danger-btn {
            display: inline-block;
            font-size: 13px;
            color: #cd0303;
            text-transform: uppercase;
            font-weight: 700;
            position: relative;
        }

        .danger-btn:hover {
            color: #cd0303;
        }
    </style>
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Aktivitas</h2>
                        <div class="bt-option">
                            <a href="<?= route_to('member.home'); ?>">Beranda</a>
                            <span>Aktivitas</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="rooms-section spad">
        <div class="container">
            <div class="row">
                <?php foreach ($bookings as $index => $booking): ?>

                    <?php
                        $media      = (new \App\Models\ProductMedia())->where('sub_product_id', $booking['sub_product_id'])->first();
                        $product    = (new \App\Models\Product())->where('id', $booking['product_id'])->first();
                        $subProduct = (new \App\Models\SubProduct())->where('id', $booking['sub_product_id'])->first();
                        $payment    = (new \App\Models\Payment())->where('booking_id', $booking['id'])->first();
                        $voucher    = (new \App\Models\SubProductVoucher())->where('id', $booking['voucher_id'])->first();
                    ?>

                    <div class="col-lg-4 col-md-6">
                        <div class="room-item position-relative">
                            <span class="position-absolute badge badge-danger" style="bottom: 10px; right: 10px; font-size: 14px;">
                                <?= $index + 1; ?>
                            </span>
                            <img src="<?= $media ? base_url('/uploads/images/products/' . $media['media']) : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRbeQlsruJMdFTjMK9OkGZY527BXOvbGDWWHg&usqp=CAU'; ?>" alt="">
                            <div class="ri-text">
                                <h4><?= $product['name']; ?> - <?= $subProduct['name']; ?></h4>
                                <h6><?= date('d F Y', strtotime($booking['wedding_date'])); ?></h6>

                                <h2 style="font-size: 25px;">
                                    <?php if($subProduct['discount']): ?>
                                        <strike class="text-secondary"><?= format_currency($subProduct['price']); ?></strike> &nbsp;
                                        <?php if ($voucher): ?>
                                            <br>
                                            <span>Disc : </span><strike class="text-secondary"><?= format_currency($subProduct['discount']); ?></strike> &nbsp;
                                            <br>
                                            <span>Voucher : </span><b><?= format_currency($subProduct['discount'] - $voucher['amount']); ?></b>
                                        <?php else: ?>
                                            <br>
                                            <span>Disc : </span><b><?= format_currency($subProduct['discount']); ?></b>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php if ($voucher): ?>
                                            <br>
                                            <strike class="text-secondary"><?= format_currency($subProduct['price']); ?></strike> &nbsp;
                                            <br>
                                            <span>Voucher : </span><b><?= format_currency($subProduct['price'] - $voucher['amount']); ?></b>
                                        <?php else: ?>
                                            <br>
                                            <b><?= format_currency($subProduct['price']); ?></b>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </h2>

                                <?php if ($booking['is_expired']): ?>
                                    <span class="badge badge-dark">Expired</span> <br><br>

                                    <a href="#" class="danger-btn">* Silakan Booking Ulang</a>
                                <?php else: ?>

                                    <?php if (!$payment): ?>
                                        <span class="badge badge-danger">Belum Bayar</span>
                                    <?php elseif ($payment['status'] === 'down_payment'): ?>
                                        <span class="badge badge-primary">Sudah di DP</span>
                                    <?php else: ?>
                                        <span class="badge badge-success">Pembayaran full</span>
                                    <?php endif; ?> <br><br>

                                    <a href="<?= route_to('member.payments.edit', $product['id'], $subProduct['id'], $booking['id']); ?>" class="primary-btn">Lihat Pemesanan</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?= $this->endSection(); ?>