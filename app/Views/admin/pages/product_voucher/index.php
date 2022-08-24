<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Voucher
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>

<?php
/** @var array $vouchers */
/** @var int $productId */
/** @var int $subProductId */
?>

    <div class="card">
        <div class="card-header">
            <h4 class="d-inline">Voucher</h4>
            <div class="card-header-action">
                <a href="<?= route_to('admin.product-vouchers.create', $productId, $subProductId); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> &nbsp; Tambah Voucher</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table data-table" id="table-2">
                    <thead>
                    <tr>
                        <th>Kode Voucher</th>
                        <th>Jumlah</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($vouchers as $voucher): ?>
                        <tr>
                            <td><?= $voucher['code']; ?></td>
                            <td><?= format_currency($voucher['amount']); ?></td>
                            <td class="col-2">
                                <a href="<?= route_to('admin.product-vouchers.edit', $productId, $subProductId, $voucher['id']); ?>" class="btn btn-warning"><i class="fa fa-pen"></i></a>
                                <button data-target="#deleteModal" data-url="<?= route_to('admin.product-vouchers.destroy', $productId, $subProductId, $voucher['id']); ?>" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>