<!DOCTYPE html>
<html>
<?php include_once 'includes/head.php';


?>
<style>
    @page {
        size: A4;
        margin: 10mm;
        /* Adjust margins as needed */
    }

    body {
        margin: 0;
        padding: 0;
        background: white;
    }

    .invoice-container {
        width: 100%;
        /* A4 width */
        min-height: 297mm;
        /* A4 height */
        background: white;
        padding: 10mm;
        box-shadow: none;
    }

    @media print {
        body {
            margin: 0;
            padding: 0;
        }

        .invoice-container {
            width: 100%;
            min-height: 297mm;
            padding: 10mm;
            box-shadow: none;
        }

        .bg-img img {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }

    .seasonh {
        font-size: 20px;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header p {
        font-size: 12px;
    }

    .image {
        width: 150px;
        height: 150px;
    }

    .fright {
        text-align: end;
    }

    .heding {
        color: darkgreen;
    }

    .heding h2 {
        font-size: 16px;
    }

    .heding p {
        font-size: 14px;
    }

    .invo {
        text-align: center;
    }

    .label {
        font-size: 14px;
        display: flex;
        justify-content: space-between;
        background-color: darkgreen;
        color: white;
        border-radius: 30px;
        margin: 0;
        padding: 10px;
        margin-bottom: 20px;
    }

    .label p {
        margin: 0;
    }

    .invoice-bg {}

    .content {
        position: relative;
        width: 100%;
    }

    .bg-img {
        position: absolute;
        display: flex;
        justify-content: center;
        width: 80%;
        ;
    }

    .bg-image {
        width: 400px;
        opacity: 0.05;
    }

    .invoice-details {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    table {
        width: 100%;
        background-color: transparent !important;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table th {
        border: 1px dotted darkgreen;
        padding: 8px;
        text-align: center;
        color: darkgreen !important;
    }

    table td {
        text-align: center;
        padding: 10px 0px;
        border-bottom: 1px solid #e9ecef;
    }


    table .descri {
        text-align: left;
    }

    .tablefooter {
        border-top: 1px dotted darkgreen !important;
        margin-top: 20px;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
    }

    .netamount {
        text-align: end;
        padding-right: 30px;
    }

    .return {
        display: flex;
        justify-content: space-between;
        font-size: 14px;
        font-weight: bold;
        border-bottom: 3px solid black;
        margin-top: 200px;
    }

    .footer {
        margin-top: 5px;
        display: flex;
        justify-content: space-between;
    }

    .centerdiv {
        margin: 0 5px;
        font-weight: bold;
    }

    .center {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
    }

    .qr {
        margin-top: 15px;
        width: 100px;
    }

    p {
        font-size: 14px;
    }
</style>

<body>
    <?php for ($i = 0; $i < 1; $i++) :
        $totalQTY = 0;
        if ($i > 0) {
            $margin = "margin-top:-270px !important";
            $copy = "Company Copy";
        } else {
            $margin = "";
            $copy = "Customer Copy";
        }

        if ($_REQUEST['type'] == "purchase") {
            $nameSHow = 'Supplier';
            $order = fetchRecord($dbc, "purchase", "purchase_id", $_REQUEST['id']);
            $comment = $order['purchase_narration'];
            $table_row = "390px";
            $getDate = $order['purchase_date'];
            if ($order['payment_type'] == "credit_purchase") {

                $order_type = "credit purchase";
            } else {
                $order_type = "cash purchase";
            }
            $order_item = mysqli_query($dbc, "SELECT purchase_item.*,product.* FROM purchase_item INNER JOIN product ON purchase_item.product_id=product.product_id WHERE purchase_item.purchase_id='" . $_REQUEST['id'] . "'");
        } elseif ($_REQUEST['type'] == "order") {
            $nameSHow = 'Customer';
            $order = fetchRecord($dbc, "orders", "order_id", $_REQUEST['id']);
            $getDate = $order['order_date'];
            $comment = $order['order_narration'];
            $order_item = mysqli_query($dbc, "SELECT order_item.*,product.* FROM order_item INNER JOIN product ON order_item.product_id=product.product_id WHERE order_item.order_id='" . $_REQUEST['id'] . "'");
            if ($order['payment_type'] == "credit_sale") {
                $table_row = "300px";
                if ($order['payment_type'] == "none") {
                    $order_type = "credit sale";
                } else {
                    $order_type = $order['credit_sale_type'] . " (Credit)";
                }
            } else {
                $order_type = "cash sale";
                $table_row = "350px";
            }
        } elseif ($_REQUEST['type'] == "quotation") {
            $nameSHow = 'Customer';
            $order = fetchRecord($dbc, "quotations", "quotation_id", $_REQUEST['id']);
            $getDate = $order['quotation_date'];
            $comment = $order['quotation_narration'];
            $order_item = mysqli_query($dbc, "SELECT quotation_item.*,product.* FROM quotation_item INNER JOIN product ON quotation_item.product_id=product.product_id WHERE quotation_item.quotation_id='" . $_REQUEST['id'] . "'");
            if ($order['payment_type'] == "quotation") {
                $table_row = "300px";
                if ($order['payment_type'] == "none") {
                    $order_type = "Quotation";
                } else {
                    $order_type = " (Quotation)";
                }
            } else {
                $order_type = "Quotation";
                $table_row = "350px";
            }
        } elseif ($_REQUEST['type'] == "lpo") {
            $nameSHow = 'Customer';
            $order = fetchRecord($dbc, "lpo", "lpo_id", $_REQUEST['id']);
            $getDate = $order['lpo_date'];
            $comment = $order['lpo_narration'];
            $order_item = mysqli_query($dbc, "SELECT lpo_item.*,product.* FROM lpo_item INNER JOIN product ON lpo_item.product_id=product.product_id WHERE lpo_item.lpo_id='" . $_REQUEST['id'] . "'");
            if ($order['payment_type'] == "lpo") {
                $table_row = "300px";
                if ($order['payment_type'] == "none") {
                    $order_type = "LPO";
                } else {
                    $order_type = " (LPO)";
                }
            } else {
                $order_type = "LPO";
                $table_row = "350px";
            }
        }


        $date = date('D d-M-Y h:i A', strtotime($order['timestamp'] . " +10 hours"));

    ?>

        <div class="invoice-container">
            <div class="header">
                <div>
                    <div class="heding">
                        <h2><span class="seasonh">season</span> FOUR</h2>
                        <p>A/C & REFRIGERATION CONTRACTING EST</p>
                    </div>
                    <div>
                        <p>
                            Farwaniyah Branch Block 4,5t 45-55529970
                            <i class="fa-brands fa-whatsapp"></i> 66944871
                        </p>
                        <p>
                            Shuwaikh Branch Block 3,5t 53-66945212
                            <i class="fa-brands fa-whatsapp"></i> 99408640
                        </p>
                        <p>Telefex : 24734306</p>
                        <p><i class="fa-solid fa-envelope"></i> season4-kw@hotmail.com</p>
                        <p><i class="fa-brands fa-instagram"></i> seasonfourkwt</p>
                    </div>
                </div>
                <div class="image"><img class="image" src="img/logo/<?= $get_company['logo'] ?>" alt="" /></div>
                <div class="fright">
                    <div class="heding">
                        <h2>الموسم الرابع</h2>
                        <p>مؤسسة المقاولات لتكييف الهواء والتبريد</p>
                    </div>
                    <div>
                        <p>
                            فرع الفروانية قطعة 4.5 45-55529970
                            <i class="fa-brands fa-whatsapp"></i> 66944871
                        </p>
                        <p>
                            فرع الشويخ قطعة 3.5 53-66945212
                            <i class="fa-brands fa-whatsapp"></i> 99408640
                        </p>
                        <p>تليفليكس : 24734306</p>
                        <p><i class="fa-solid fa-envelope"></i> season4-kw@hotmail.com</p>
                        <p><i class="fa-brands fa-instagram"></i> seasonfourkwt</p>
                    </div>
                </div>
            </div>

            <div class="label">
                <p>ALL TYPES OF A/C, REFRIGERATOR, WASHING MACHINE SPARE PARTS</p>
                <p>جميع أنواع قطع غيار المكيفات والثلاجات والغسالات</p>
            </div>
            <div class="invo">
                <h2>INVOICE</h2>
            </div>

            <div class="invoice-bg">
                <div class="bg-img">
                    <img class="bg-image" src="img/logo/<?= $get_company['logo'] ?>" alt="" />
                </div>
                <div class="content">
                    <div class="invoice-details">
                        <div>
                            <p class="text-capitalize"><strong>Customer:</strong> <?= $order['client_name']  ?></p>
                            <!-- <p><strong>Bill No:</strong> 1996</p> -->
                        </div>
                        <div>
                            <p><strong>DATE:</strong> <?= $date  ?> </p>
                            <!-- <p><strong>TIME:</strong> <?= date($order['timestamp']) ?> -->
                            </p>
                        </div>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 10%;">S.No</th>
                                <th style="width: 10%;">Description</th>
                                <th style="width: 10%;">Qty</th>
                                <th style="width: 10%;">Unit Price</th>
                                <th style="width: 10%;">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $c = 0; 
                             $totalAm = 0;
                            while ($r = mysqli_fetch_assoc($order_item)) {
                                $c++;

                            ?>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td class="text-center" class="descri"><?=strtoupper($r['product_name'])?> | <?=strtoupper($r['product_detail'])?> </td>
                                    <td class="text-center"><?= $r['quantity'] ?></td>
                                    <td class="text-center"><?= $r['rate'] ?></td>
                                    <td class="text-center"><?= $r['rate'] *  $r['quantity']?></td>
                                </tr>
                            <?php
                                $totalQTY += $r['quantity'];
                                $totalAm+= $r['rate'] *  $r['quantity'];
                            } ?>
                        </tbody>
                        <tfoot>
                            <tr class="tablefooter">
                                <td></td>
                                <td></td>
                                <td><?= $totalQTY ?></td>
                                <td></td>
                                <td><?= $totalAm ?></td>
                            </tr>
                    </table>
                    </tfoot>
                </div>
            </div>

            <div class="netamount">
                <p><strong>Discount:</strong> <?=  $order['discount'] ?></p>
                <p><strong>Net Amount:</strong> <?=  $order['grand_total'] ?></p>
            </div>

            <div>
                <div class="return">
                    <p>
                        Goods can be returned within 14 days original packaging & Invoice
                    </p>
                    <p>يمكن إرجاع البضائع خلال 14 يومًا مع العبوة الأصلية والفاتورة</p>
                </div>

                <div class="footer">
                    <div>
                        <img class="qr" src="img/logo/frame.svg" alt="" />
                    </div>
                    <div class="centerdiv text-center">
                        <p>
                            Please issue The cheque In the name of "Season Four Electronic &
                            Repairing"
                        </p>
                        <p>
                            "يرجى إصدار الشيك باسم "مؤسسة فصول الاربعة للاجهزة الكهربائية والالكترونية وتصليحها""</p>
                        <div class="center">
                            <div><span>Receiver's Sign </span><span> علامة المستقبل</span></div>
                            <div><span>Salesman's Sign </span><span> علامة البائع</span></div>
                        </div>
                    </div>
                    <div><img class="qr" src="img/logo/frame-2.svg" alt="" /></div>
                </div>
            </div>
        </div><!-- end of container -->
    <?php endfor; ?>


</body>

</html>
<script type="text/javascript">
    window.print();
    //   window.close();
</script>