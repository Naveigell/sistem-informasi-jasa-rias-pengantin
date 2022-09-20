<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Booking
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>

    <div class="card">
        <div class="card-header">
            <h4 class="d-inline">Booking</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table data-table" id="table-2">
                    <thead>
                    <tr>
                        <th>Nama Member</th>
                        <th>Alamat</th>
                        <th>Nomor Telp</th>
                        <th>NIK</th>
                        <th>Tipe Jasa</th>
                        <th>Tanggal Rias</th>
                        <th>Tanggal Prewedding</th>
                        <th>Status Pembayaran</th>
                        <th>Expired</th>
                        <th>Selesai</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php /** @var array $bookings */
                    foreach ($bookings as $booking): ?>
                        <?php
                            $phone = $booking['phone'];

                            // check if first of phone number starts with 0
                            if ($phone[0] == '0') {
                                $phone = '62' . substr($phone, 1);
                            }
                        ?>
                        <tr>
                            <td><?= $booking['member_name']; ?></td>
                            <td><?= $booking['address']; ?></td>
                            <td><?= $booking['phone']; ?></td>
                            <td><?= $booking['identity_card']; ?></td>
                            <td><a target="_blank" href="<?= route_to('admin.sub-products.edit', $booking['product_id'], $booking['sub_product_id']); ?>" class="text text-primary"><?= $booking['product_name']; ?> - <?= $booking['sub_product_name']; ?></a></td>
                            <td><?= date('d F Y', strtotime($booking['wedding_date'])); ?> - <?= date('H:i', strtotime($booking['wedding_time'])); ?></td>
                            <td><?= $booking['pre_wedding_date'] ? date('d F Y', strtotime($booking['pre_wedding_date'])) : '-'; ?></td>
                            <td><?= render_payment_status($booking['payment_status']); ?></td>
                            <td>
                                <?php if ($booking['is_expired']): ?>
                                    <span class="badge-success badge">Iya</span>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($booking['is_finish']): ?>
                                    <span class="badge-success badge">Iya</span>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= route_to('admin.bookings.show', $booking['booking_id']); ?>" class="btn btn-warning"><i class="fa fa-pen"></i></a>
                                <a target="_blank" href="https://wa.me/<?= $phone; ?>" class="btn btn-success"><i class="fa fa-phone"></i></a>
                                <?php if (!$booking['is_finish']): ?>
                                    <button data-finish-url="<?= route_to('admin.bookings.finish', $booking['booking_id']); ?>" class="btn btn-info btn-finish"><i class="fa fa-check"></i></button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <form action="" id="form" method="post">
            <?= csrf_field(); ?>
            <input type="hidden" name="_method" value="PUT">
        </form>
    </div>
<?= $this->endSection() ?>

<?= $this->section('content-script') ?>
    <script>
        var form = $('#form');

        $('.btn-finish').on('click', function () {

            var url = $(this).data('finish-url');

            form.attr('action', url);

            Swal.fire({
                title: 'Selesai?',
                text: 'Aksi ini tidak akan bisa di kembalikan.',
                showDenyButton: true,
                confirmButtonText: 'Iya',
                denyButtonText: `Batal`,
            }).then((result) => {

                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
    </script>
<?= $this->endSection() ?>