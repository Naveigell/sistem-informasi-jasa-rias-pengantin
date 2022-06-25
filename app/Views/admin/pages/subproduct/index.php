<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Sub Jasa
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>

    <?php
    /** @var array $subProducts */
    /** @var int $productId */
    ?>

    <div class="card">
        <div class="card-header">
            <h4 class="d-inline">Sub Jasa</h4>
            <div class="card-header-action">
                <a href="<?= route_to('admin.sub-products.create', $productId); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> &nbsp; Tambah Sub Jasa</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table data-table" id="table-2">
                    <thead>
                    <tr>
                        <th>Nama Jasa</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($subProducts as $subProduct): ?>
                        <tr>
                            <td><?= $subProduct['name']; ?></td>
                            <td class="col-1"><?= format_currency($subProduct['price']); ?></td>
                            <td><?= $subProduct['description']; ?></td>
                            <td class="col-2">
                                <a href="<?= route_to('admin.sub-products.edit', $productId, $subProduct['id']); ?>" class="btn btn-warning"><i class="fa fa-pen"></i></a>
                                <a href="<?= route_to('admin.product-medias.index', $productId, $subProduct['id']); ?>" class="btn btn-info"><i class="fa fa-image"></i></a>
                                <button data-target="#deleteModal" data-url="<?= route_to('admin.sub-products.destroy', $productId, $subProduct['id']); ?>" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>