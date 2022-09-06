<?= $this->extend('layouts/member/member') ?>

<?= $this->section('content-body') ?>

    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Ubah Password</h2>
                        <div class="bt-option">
                            <a href="<?= route_to('member.home'); ?>">Beranda</a>
                            <span>Akun</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="rooms-section spad">
        <div class="container">
            <div class="row">

                <form action="<?= route_to('auth.password.store'); ?>?<?= http_build_query($_GET); ?>" style="width: 100%;" method="post">

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
                        <label for="">Password Baru</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Ulangi Password Password</label>
                        <input type="password" name="repeat_password" class="form-control">
                    </div>
                    <div>
                        <button class="btn btn-success">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
<?= $this->endSection() ?>