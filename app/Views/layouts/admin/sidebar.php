<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?= route_to('admin.dashboard.index'); ?>">Salon Dewi Sri</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= route_to('admin.dashboard.index'); ?>">SDS</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Home</li>
            <li><a class="nav-link" href="<?= route_to('admin.dashboard.index'); ?>"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
            <li class="menu-header">Additional</li>
            <li><a class="nav-link" href="<?= route_to('admin.products.index'); ?>"><i class="fa fa-shopping-bag"></i> <span>Jasa</span></a></li>
            <li><a class="nav-link" href="<?= route_to('admin.wedding-times.index'); ?>"><i class="fa fa-clock"></i> <span>Jam Rias</span></a></li>
            <li class="menu-header">Pemesanan</li>
            <li><a class="nav-link" href="<?= route_to('admin.bookings.index'); ?>"><i class="fa fa-link"></i> <span>Booking</span></a></li>
            <li class="menu-header">Other</li>
            <li><a class="nav-link" href="<?= route_to('admin.galleries.index'); ?>"><i class="fa fa-image"></i> <span>Gallery</span></a></li>
<!--            <li class="menu-header">Saran</li>-->
<!--            <li><a class="nav-link" href="--><?//= route_to('admin.suggestions.index'); ?><!--"><i class="fa fa-envelope"></i> <span>Saran</span></a></li>-->
        </ul>
    </aside>
</div>