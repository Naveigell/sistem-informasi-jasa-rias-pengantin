<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Jam Rias
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>

    <div class="card">
        <div class="card-header">
            <h4 class="d-inline">Jam Rias</h4>
            <div class="card-header-action">
                <a href="<?= route_to('admin.wedding-times.create'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> &nbsp; Tambah Waktu</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table data-table" id="table-2">
                    <thead>
                    <tr>
                        <th>Jam</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php /** @var array $weddingTimes */
                    foreach ($weddingTimes as $weddingTime): ?>
                        <tr>
                            <td><?= date('H:i', strtotime($weddingTime['wedding_time'])); ?></td>
                            <td class="col-1">
                                <a href="<?= route_to('admin.wedding-times.edit', $weddingTime['id']); ?>" class="btn btn-warning"><i class="fa fa-pen"></i></a>
                                <button data-target="#deleteModal" data-url="<?= route_to('admin.wedding-times.destroy', $weddingTime['id']); ?>" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>