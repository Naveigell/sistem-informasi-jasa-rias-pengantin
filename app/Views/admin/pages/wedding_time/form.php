<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Jam Rias
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
    <div class="card">
        <?php /** @var stdClass $weddingTime */ ?>
        <form action="<?= @$weddingTime ? route_to('admin.wedding-times.update', $weddingTime['id']) : route_to('admin.wedding-times.store'); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <?php if (@$weddingTime): ?>
                <input type="hidden" name="_method" value="put">
            <?php endif; ?>
            <div class="card-header">
                <h4>Form Jam Rias</h4>
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
                    <label>Jam Rias</label>
                    <input name="wedding_time" type="time" class="form-control" value="<?= @$weddingTime ? $weddingTime['wedding_time'] : ''; ?>">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
<?= $this->endSection() ?>