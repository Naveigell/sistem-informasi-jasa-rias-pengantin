<style>
    table {
        max-width: 100%;
        max-height: 100%;
        margin-top: 30px;
    }
    body {
        padding: 5px;
        position: relative;
        width: 100%;
        height: 100%;
    }
    table th,
    table td {
        padding: .625em;
        /*text-align: center;*/
    }
    table .kop:before {
        content: ': ';
    }
    .left {
        text-align: left;
    }
    .right {
        text-align: right;
    }
    table #caption {
        font-size: 1.5em;
        margin: .5em 0 .75em;
    }
    table.border {
        width: 100%;
        border-collapse: collapse
    }

    table.border tbody th, table.border tbody td {
        border: thin solid #000;
        padding: 2px
    }
    .ttd td, .ttd th {
        padding-bottom: 4em;
    }
    @media print {

        html, body {
            height:100%;
            margin: 0 !important;
            padding: 0 !important;
            overflow: hidden;
        }

    }

    #tbl td {
        padding-left: 10px;
    }

    .text-center {
        text-align: center;
    }
</style>
<?php
/** @var array $incomes */

$total = 0;
?>
<div id="printable" class="container">
    <table id="tbl" border="0" cellpadding="0" cellspacing="0" width="485" class="border" style="overflow-x:auto;">
        <thead>
        <tr>
            <td style="text-align: center;" colspan="5" width="485" id="caption"><?= shop_information()['shop_name']; ?></td>
        </tr>
        <tr>
            <td style="text-align: center;" colspan="5">Laporan Pemasukan <?= shop_information()['shop_name']; ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="text-center"><b>Nomor</b></td>
            <td class="text-center"><b>Nama Pemesan</b></td>
            <td class="text-center"><b>Nama Jasa</b></td>
            <td class="text-center"><b>Tanggal Pemesanan</b></td>
            <td class="text-center"><b>Jumlah</b></td>
        </tr>
        <?php
        foreach($incomes as $index => $income): ?>

            <?php
                $booking    = (new \App\Models\Booking())->where('id', $income['booking_id'])->first();
                $product    = (new \App\Models\Product())->where('id', $booking['product_id'])->first();
                $subProduct = (new \App\Models\SubProduct())->where('id', $booking['sub_product_id'])->first();

                $total += $subProduct['discount'] ?? $subProduct['price'];
            ?>

            <tr>
                <th scope="row"><?= $index + 1; ?></th>
                <td><?= $booking['name']; ?></td>
                <td><?= $product['name']; ?> - <?= $subProduct['name']; ?></td>
                <td><?= date('d F Y', strtotime($income['created_at'])); ?></td>
                <td><?= format_currency($subProduct['discount'] ?? $subProduct['price']); ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><b><?= format_currency($total); ?></b></td>
        </tr>
        </tbody>
        <tfoot>
        <?php for ($i = 0; $i < 4; $i++): ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        <?php endfor; ?>
        <tr class="ttd">
            <th colspan="3"></th>
            <th colspan="1">Mengetahui</th>
        </tr>
        <tr class="ttd">
            <td colspan="3"></td>
            <td style="text-align: center;" colspan="1"><?= shop_information()['shop_owner']; ?></td>
        </tr>
        </tfoot>
    </table>
</div>
<script>
    window.print();
</script>