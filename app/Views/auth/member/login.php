<?= $this->extend('layouts/member/member') ?>

<?= $this->section('content-body') ?>

    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Login</h2>
                        <div class="bt-option">
                            <a href="<?= route_to('member.home'); ?>">Home</a>
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

                <form action="<?= route_to('member.auth.login.store'); ?>" style="width: 100%;" method="post">

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
                        <label for="">Email</label>
                        <input type="text" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div>
                        <button class="btn btn-success">Login</button>
                        <a href="<?= route_to('member.auth.register.index'); ?>" class="btn btn-primary">Register</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
<?= $this->endSection() ?>