<?= $this->extend('layouts/member/member') ?>

<?= $this->section('content-style'); ?>
    <style>
        .heading {
            text-align: center;
            font-size: 2.0em;
            letter-spacing: 1px;
            padding: 40px;
            color: white;
        }

        .gallery-image {
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .gallery-image img {
            height: 250px;
            width: 350px;
            transform: scale(1.0);
            transition: transform 0.4s ease;
        }

        .img-box {
            box-sizing: content-box;
            margin: 10px;
            height: 250px;
            width: 350px;
            overflow: hidden;
            display: inline-block;
            color: white;
            position: relative;
            background-color: white;
        }

        .caption {
            position: absolute;
            bottom: 5px;
            left: 20px;
            opacity: 0.0;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .transparent-box {
            height: 250px;
            width: 350px;
            background-color:rgba(0, 0, 0, 0);
            position: absolute;
            top: 0;
            left: 0;
            transition: background-color 0.3s ease;
        }

        .img-box:hover img {
            transform: scale(1.1);
        }

        .img-box:hover .transparent-box {
            background-color:rgba(0, 0, 0, 0.5);
        }

        .img-box:hover .caption {
            transform: translateY(-20px);
            opacity: 1.0;
        }

        .img-box:hover {
            cursor: pointer;
        }

        .caption > p:nth-child(2) {
            font-size: 0.8em;
        }

        .opacity-low {
            opacity: 0.5;
        }
    </style>
<?= $this->endSection(); ?>

<?= $this->section('content-body'); ?>
<?php
/**
 * @var array $bookings
 */
?>
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Galeri</h2>
                        <div class="bt-option">
                            <a href="<?= route_to('member.home'); ?>">Beranda</a>
                            <span>Galeri</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="">
        <div class="gallery-image">
            <?php /** @var array $galleries */
            foreach ($galleries as $gallery): ?>

                <div class="img-box">
                    <img src="<?= base_url('/uploads/images/galleries/' . $gallery['media']); ?>" alt="" />
<!--                    <div class="transparent-box">-->
<!--                        <div class="caption">-->
<!--                            <p>Library</p>-->
<!--                            <p class="opacity-low">Architect Design</p>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?= $this->endSection(); ?>