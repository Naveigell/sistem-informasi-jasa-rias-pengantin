<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Product Media
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>

<?php
/** @var array $medias */
/** @var int $productId */
/** @var int $subProductId */
?>

    <div class="card">
        <div class="card-header">
            <h4 class="d-inline">Product Media</h4>
            <div class="card-header-action">
                <a href="<?= route_to('admin.product-medias.create', $productId, $subProductId); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> &nbsp; Tambah Media</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table data-table" id="table-2">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($medias as $media): ?>
                        <tr>
                            <td>
                                <img alt="image" src="<?= base_url('/uploads/images/products/' . $media['media']); ?>" width="250" height="250">
                            </td>
                            <td class="col-2">
                                <a href="<?= route_to('admin.product-medias.edit', $productId, $subProductId, $media['id']); ?>" class="btn btn-warning"><i class="fa fa-pen"></i></a>
                                <button data-target="#deleteModal" data-url="<?= route_to('admin.product-medias.destroy', $productId, $subProductId, $media['id']); ?>" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>