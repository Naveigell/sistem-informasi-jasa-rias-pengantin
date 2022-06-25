<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Jasa
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>

    <div class="card">
        <div class="card-header">
            <h4 class="d-inline">Jasa</h4>
            <div class="card-header-action">
                <a href="<?= route_to('admin.products.create'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> &nbsp; Tambah Jasa</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table data-table" id="table-2">
                    <thead>
                    <tr>
                        <th>Nama Jasa</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php /** @var array $products */
                        foreach ($products as $product): ?>
                            <tr>
                                <td><?= $product['name']; ?></td>
                                <td>
                                    <a href="<?= route_to('admin.products.edit', $product['id']); ?>" class="btn btn-warning"><i class="fa fa-pen"></i></a>
                                    <a href="<?= route_to('admin.sub-products.index', $product['id']); ?>" class="btn btn-info"><i class="fa fa-list"></i></a>
                                    <button data-target="#deleteModal" data-url="<?= route_to('admin.products.destroy', $product['id']); ?>" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>