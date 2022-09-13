<?= $this->extend('layouts/member/member') ?>

<?= $this->section('content-body') ?>

    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Akun</h2>
                        <div class="bt-option">
                            <a href="<?= route_to('member.home'); ?>">Beranda</a>
                            <span>Ganti Password</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="rooms-section spad">
        <div class="container">
            <div class="row">

                <form action="<?= route_to('member.accounts.password.update'); ?>" style="width: 100%;" method="post">

                    <?= csrf_field(); ?>

                    <input type="hidden" name="_method" value="PUT">

                    <?php if ($errors = session()->getFlashdata('errors')): ?>
                        <div class="alert-danger alert">
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li><?= $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php elseif ($success = session()->getFlashdata('success')): ?>
                        <div class="alert-success alert">
                            <ul>
                                <li><?= $success; ?></li>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="">Password lama</label>
                        <input type="password" name="old_password" class="form-control" placeholder="Masukkan password lama">
                    </div>
                    <div class="form-group">
                        <label for="">Password baru</label>
                        <input type="password" name="new_password" class="form-control" placeholder="Masukkan password baru">
                    </div>
                    <div class="form-group">
                        <label for="">Ulangi Password baru</label>
                        <input type="password" name="repeat_new_password" class="form-control" placeholder="Ulangi masukkan password baru">
                    </div>
                    <div>
                        <button class="btn btn-success">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
<?= $this->endSection() ?>