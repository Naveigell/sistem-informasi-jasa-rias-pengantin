<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Booking
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>

    <?php
        /** @var array $booking */
        /** @var array $payment */
    ?>

    <div class="card">
        <div class="card-header">
            <h4 class="d-inline">Form Booking</h4>
        </div>
        <div class="card-body">
            <?= render_payment_status($booking['payment_status']); ?>
            <br><br>
            <div class="row">
                <div class="col-6">
                    <h6>Jasa Yang Dipilih</h6>
                    <br>
                    <div class="form-group">
                        <label>Nama Jasa</label>
                        <input type="text" disabled value="<?= $booking['product_name']; ?> - <?= $booking['sub_product_name']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Harga Jasa</label>
                        <input type="text" disabled value="<?= $booking['price']; ?>" class="form-control nominal">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Jasa</label>
                        <textarea name="" id="" cols="30" rows="10" style="height: 200px; resize: none;" disabled class="form-control"><?= $booking['description']; ?></textarea>
                    </div>
                </div>
                <div class="col-6">
                    <h6>Member</h6>
                    <br>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" disabled value="<?= $booking['member_name']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" disabled value="<?= $booking['address']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>No Telepon</label>

                        <input type="text" disabled value="<?= $booking['phone']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Pernikahan</label>
                        <input type="text" disabled value="<?= date('d F Y', strtotime($booking['wedding_date'])); ?> - <?= date('H:i', strtotime($booking['wedding_time'])); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Prewedding</label>
                        <input type="text" disabled value="<?= date('d F Y', strtotime($booking['pre_wedding_date'])); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Status Pembayaran</label>
                        <input type="text" disabled value="<?= ucwords(str_replace('_', ' ', $booking['payment_status'])); ?>" class="form-control">
                    </div>
                </div>
                <div class="col-12">
                    <hr>
                </div>
                <div class="col-12">
                    <h6 class="mt-4">Pembayaran</h6>
                    <br>
                    <div class="form-group">
                        <label>Bank Pengirim</label>
                        <input type="text" disabled value="<?= $payment ? $payment['sender_bank'] : '-'; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nomor Rekening Pengirim</label>
                        <input type="text" disabled value="<?= $payment ? $payment['sender_account_number'] : '-'; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nama Pengirim</label>
                        <input type="text" disabled value="<?= $payment ? $payment['sender_name'] : '-'; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Bank Tujuan</label>
                        <input type="text" disabled value="<?= $payment ? $payment['merchant_bank'] : '-'; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <input type="text" disabled value="<?= ucwords(str_replace('_', ' ', $payment ? $payment['status'] : '-')); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Bukti Pembayaran</label>
                        <div class="" style="border: 1px dashed #5f5c5c; border-radius: 5px;">
                            <img width="100%" src="<?= $payment ? base_url('/uploads/images/payments/' . $payment['proof']) : ''; ?>" alt="">
                        </div>
                    </div>

                    <?php if ($payment): ?>

                        <form action="<?= route_to('admin.bookings.update', $payment['booking_id']); ?>" method="post">
                            <input type="hidden" name="_method" value="put">
                            <div class="form-group">
                                <label for="">Status Pembayaran</label>
                                <select name="status" id="" class="form-control">
                                    <?php foreach ([\App\Models\Payment::STATUS_WAITING_PAYMENT,
                                                       \App\Models\Payment::STATUS_DOWN_PAYMENT,
                                                       \App\Models\Payment::STATUS_PAID_OFF] as $status): ?>
                                        <option <?= $status === $payment['status'] ? 'selected' : ''; ?> value="<?= $status; ?>"><?= ucwords(str_replace('_', ' ', $status)); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>