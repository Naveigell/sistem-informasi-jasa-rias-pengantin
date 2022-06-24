<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Modal
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>

    <div class="card">
        <div class="card-header">
            <h4 class="d-inline">Modal Usaha</h4>
            <div class="card-header-action">
                <a href="<?= route_to('admin.capitals.create'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> &nbsp; Tambah Modal</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table data-table" id="table-2">
                    <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>