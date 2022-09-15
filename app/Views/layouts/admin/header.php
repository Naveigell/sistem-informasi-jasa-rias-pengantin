<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                            class="fas fa-search"></i></a></li>
        </ul>
        <div class="search-element">
        </div>
    </form>
    <ul class="navbar-nav navbar-right">
        <?php
            $notifications = (new \App\Models\BookingNotification())->where('is_read', 0)->findAll();
        ?>
        <li class="dropdown dropdown-list-toggle">
            <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep position-relative" aria-expanded="false">
                <i class="far fa-bell"></i>
                <?php if (count($notifications) > 0): ?>
                    <span class="position-absolute badge-danger badge" style="left: -14px; bottom: -10px;"><?= count($notifications); ?></span>
                <?php endif; ?>
            </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <?php if (count($notifications) > 0): ?>
                    <div class="dropdown-header">Notifikasi</div>
                    <div class="dropdown-list-icons" tabindex="3">
                        <?php foreach ($notifications as $notification): ?>
                            <a href="<?= route_to('admin.bookings.show', $notification['booking_id']); ?>" class="dropdown-item dropdown-item-unread">
                                <div class="dropdown-item-icon bg-primary text-white">
                                    <i class="fas fa-bookmark"></i>
                                </div>
                                <div class="dropdown-item-desc">
                                    Ada booking baru yang masuk!
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </li>
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <div class="d-sm-none d-lg-inline-block"><?= session()->get('user')->email; ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <a href="<?= route_to('logout'); ?>" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>