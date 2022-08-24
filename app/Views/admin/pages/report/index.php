<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
Laporan Pemasukan
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
<?php /** @var array $incomes */ ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Laporan</h4>
            </div>
            <div class="card-body">
                <div class="">
                    <form action="<?= route_to('admin.reports.index'); ?>" class="row" method="get">
                        <div class="form-group col-3">
                            <label for="">Bulan</label>
                            <input name="month" type="month" class="form-control" value="<?= @$_GET['month'] ? $_GET['month'] : ''; ?>">
                        </div>
                        <div class="form-group col-12">
                            <button class="btn btn-primary" type="submit">Filter</button>
                            <?php if (count($incomes) > 0): ?>
                                <a href="<?= route_to('admin.reports.print'); ?>?<?= http_build_query($_GET); ?>" class="btn btn-success"><i class="fa fa-print"></i> Print</a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Pemesan</th>
                        <th scope="col">Nama Jasa</th>
                        <th scope="col">Tanggal Pemesanan</th>
                        <th scope="col">Jumlah</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($incomes as $index => $income): ?>

                        <?php
                            $booking    = (new \App\Models\Booking())->where('id', $income['booking_id'])->first();
                            $product    = (new \App\Models\Product())->where('id', $booking['product_id'])->first();
                            $subProduct = (new \App\Models\SubProduct())->where('id', $booking['sub_product_id'])->first();
                        ?>

                        <tr>
                            <th scope="row"><?= $index + 1; ?></th>
                            <td><?= $booking['name']; ?></td>
                            <td><?= $product['name']; ?> - <?= $subProduct['name']; ?></td>
                            <td><?= date('d F Y', strtotime($income['created_at'])); ?></td>
                            <td><?= format_currency($subProduct['discount'] ?? $subProduct['price']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

