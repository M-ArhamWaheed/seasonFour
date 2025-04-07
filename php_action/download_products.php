<?php
require __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_REQUEST['action'] == 'download_products') {

    // ✅ 1. Database Connection
    $conn = new mysqli("localhost", "root", "", "twcppabi_seasonfour");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // ✅ 2. Fetch Data
    $sql = "SELECT * FROM product";
    $result = $conn->query($sql);

    // ✅ 3. Create Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // ✅ 4. Set Column Headers (adjust according to your table)
    $sheet->setCellValue('A1', 'ID');
    $sheet->setCellValue('B1', 'Product Name');
    $sheet->setCellValue('C1', 'Price');
    $sheet->setCellValue('D1', 'Description');

    // ✅ 5. Fill Data Rows
    $rowNum = 2;
    while ($row = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $rowNum, $row['product_id']);
        $sheet->setCellValue('B' . $rowNum, $row['product_name']);
        $sheet->setCellValue('C' . $rowNum, $row['purchase_rate']);
        $sheet->setCellValue('D' . $rowNum, $row['product_description']);
        $rowNum++;
    }

    // ✅ 6. Set Headers for Download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="products.xlsx"');
    header('Cache-Control: max-age=0');

    // ✅ 7. Output File
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');

    header('location: ../product.php?act=list');
    exit;
}

if ($_REQUEST['action'] == 'upload_products') {
    // ✅ 1. Database Connection
    $conn = new mysqli("localhost", "root", "", "twcppabi_seasonfour");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_FILES['excel_file']['tmp_name'])) {
        $file = $_FILES['excel_file']['tmp_name'];

        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        // Loop through each row (skip header)
        for ($i = 1; $i < count($rows); $i++) {
            $row = $rows[$i];

            // Skip rows that don’t have all required columns
            if (!isset($row[0], $row[1], $row[2], $row[3])) {
                continue;
            }

            $id = $conn->real_escape_string($row[0]);
            $name = $conn->real_escape_string($row[1]);
            $price = $conn->real_escape_string($row[2]);
            $category = $conn->real_escape_string($row[3]);

            if (!empty($id)) {
                $check = $conn->query("SELECT product_id FROM product WHERE product_id = '$id'");
                if ($check->num_rows > 0) {
                    $conn->query("UPDATE product SET product_name='$name', purchase_rate='$price', product_description='$category' WHERE product_id='$id'");
                } else {
                    $conn->query("INSERT INTO product (product_id, product_name, purchase_rate, product_description) VALUES ('$id', '$name', '$price', '$category')");
                }
            } else {
                $conn->query("INSERT INTO product (product_name, purchase_rate, product_description) VALUES ('$name', '$price', '$category')");
            }
        }

        echo "<script>alert('Products synced successfully!'); window.location.href='../product.php?act=list#';</script>";
    }
}
