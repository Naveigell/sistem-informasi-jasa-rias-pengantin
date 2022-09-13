<?php
    $products = (new \App\Models\Product())->findAll();
?>
<style>
    #member-account-link:after {
        content: none;
    }
</style>
<header class="header-section">
    <div class="menu-item">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="logo" style="transform: translateY(-20px)">
                        <a href="<?= route_to('member.home'); ?>" class="navbar-brand font-weight-bold" style="color: #dfa974;">
<!--                            Dewi Sri Salon & Spa-->
                            <img src="<?= base_url('member/img/logo.png'); ?>" alt="" style="width: 80px;">
                        </a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="nav-menu">
                        <nav class="mainmenu">
                            <ul>
                                <li class="active"><a href="<?= route_to('member.home'); ?>">Beranda</a></li>
                                <?php if(session()->get('hasLoggedIn')): ?>
                                    <li>
                                        <a>Jasa</a>
                                        <ul class="dropdown">
                                            <?php foreach ($products as $product): ?>
                                                <li><a><?= $product['name']; ?></a></li>

                                                <?php
                                                    $subProducts = (new \App\Models\SubProduct())->where('product_id', $product['id'])->findAll();
                                                ?>

                                                <?php foreach ($subProducts as $subProduct): ?>
                                                    <li><a href="<?= route_to('member.product.detail', $product['id'], $subProduct['id']); ?>">&bull; &nbsp; <?= $subProduct['name']; ?></a></li>
                                                <?php endforeach; ?>

                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                                <?php if (session()->get('hasLoggedIn')): ?>
                                    <li><a href="<?= route_to('member.payments.index'); ?>">Aktivitas</a></li>
                                <?php endif; ?>
                                <li><a href="<?= route_to('member.gallery.index'); ?>">Galeri</a></li>
                                <?php if (session()->has('hasLoggedIn') && session()->get('user')->id): ?>
                                    <li>
                                        <a id="member-account-link"><span style="display: inline-block; border: 1px solid #ebebeb; padding: 5px;"><?= session()->get('user')->email; ?></span></a>
                                        <ul class="dropdown">
                                            <li><a href="<?= route_to('member.accounts.index'); ?>">Ganti password</a></li>
                                            <li><a href="<?= route_to('logout'); ?>">Logout</a></li>
                                        </ul>
                                    </li>
                                <?php else: ?>
                                    <li><a href="<?= route_to('member.auth.login.index'); ?>">Login</a></li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>