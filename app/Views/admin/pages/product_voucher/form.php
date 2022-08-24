<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Voucher
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
    <div class="card">
        <?php /** @var stdClass $product */ ?>
        <?php /** @var stdClass $subProduct */ ?>
        <?php /** @var stdClass $voucher */ ?>

        <form action="<?= @$voucher ? route_to('admin.product-vouchers.update', $product['id'], $subProduct['id'], $voucher['id']) : route_to('admin.product-vouchers.store', $product['id'], $subProduct['id']); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <?php if (@$voucher): ?>
                <input type="hidden" name="_method" value="put">
            <?php endif; ?>
            <div class="card-header">
                <h4>Form Voucher</h4>
            </div>
            <div class="card-body">
                <?php if ($errors = session()->getFlashdata('errors')): ?>
                    <div class="alert-danger alert">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label>Kode Voucher</label>
                    <input name="code" type="text" readonly class="form-control" value="<?= @$voucher ? $voucher['code'] : 'VCHR' . date('YmdHis'); ?>">
                    <small class="text-dark">* Dibuat secara otomatis</small>
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                Rp.
                            </div>
                        </div>
                        <input name="amount" type="text" class="form-control nominal" value="<?= @$voucher ? $voucher['amount'] : ''; ?>">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
<?= $this->endSection() ?>