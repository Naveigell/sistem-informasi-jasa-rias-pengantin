<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Sub Jasa
<?= $this->endSection() ?>

<?= $this->section('content-title') ?>
    <style>
        .ck-editor__editable {
            min-height: 300px;
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
    <div class="card">
        <?php /** @var stdClass $product */ ?>
        <?php /** @var stdClass $subProduct */ ?>
        <form action="<?= @$subProduct ? route_to('admin.sub-products.update', $product['id'], $subProduct['id']) : route_to('admin.sub-products.store', $product['id']); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <?php if (@$subProduct): ?>
                <input type="hidden" name="_method" value="put">
            <?php endif; ?>
            <div class="card-header">
                <h4>Form Sub Jasa</h4>
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
                    <label>Nama Produk</label>
                    <input name="name" type="text" class="form-control" value="<?= @$subProduct ? $subProduct['name'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label>Harga Produk</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                Rp.
                            </div>
                        </div>
                        <input name="price" type="text" class="form-control nominal" value="<?= @$subProduct ? $subProduct['price'] : ''; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="description" class="form-control" id="editor" cols="30" rows="10"><?= @$subProduct ? $subProduct['description'] : ''; ?></textarea>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
<?= $this->endSection() ?>

<?= $this->section('content-script') ?>
    <script src="<?= base_url('/vendor/ckeditor5/build/ckeditor.js'); ?>"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ), {
                height: 400,
                // toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
                // heading: {
                //     options: [
                //         { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                //         { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                //         { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                //     ]
                // }
            } )
            .catch( error => {
                console.log( error );
            } );
    </script>
<?= $this->endSection() ?>