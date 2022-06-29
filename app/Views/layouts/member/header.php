<?php
    $products = (new \App\Models\Product())->findAll();
?>

<header class="header-section">
    <div class="menu-item">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="logo">
                        <a href="<?= route_to('member.home'); ?>">
                            <img src="<?= base_url('member/img/logo.png'); ?>" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="nav-menu">
                        <nav class="mainmenu">
                            <ul>
                                <li class="active"><a href="<?= route_to('member.home'); ?>">Home</a></li>
                                <li><a>Jasa</a>
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
                                <?php if (session()->get('hasLoggedIn')): ?>
                                    <li><a href="<?= route_to('member.payments.index'); ?>">Pemesanan & Pembayaran</a></li>
                                <?php endif; ?>
                                <?php if (session()->has('hasLoggedIn') && session()->get('user')->id): ?>
                                    <li><a href="<?= route_to('logout'); ?>">Logout</a></li>
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