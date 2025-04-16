<?php
require __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$conn = new mysqli("localhost", "twcppabi_erp", "twcppabi_erp", "twcppabi_erp");

if ($_REQUEST['action'] == 'download_products') {
    // Database Connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch Product Data with Category and Brand Details
    $sql = "
    SELECT 
        p.product_id,
        p.product_name,
        p.product_code,
        p.product_image,
        p.brand_id,
        p.category_id,
        p.quantity_instock,
        p.purchased,
        p.current_rate,
        p.f_days,
        p.t_days,
        p.purchase_rate,
        p.final_rate,
        p.status,
        p.availability,
        p.alert_at,
        p.weight,
        p.actual_rate,
        p.product_description,
        p.product_mm,
        p.product_inch,
        p.product_meter,
        p.inventory,
        c.categories_name AS category_name,
        c.categories_country AS category_country,
        b.brand_name AS brand_name,
        b.category_id AS brand_category_name,  
        b.brand_country AS brand_country
    FROM product p
    LEFT JOIN categories c ON p.category_id = c.categories_id
    LEFT JOIN brands b ON p.brand_id = b.brand_id
    ";

    // Execute the query and check for errors
    $result = $conn->query($sql);
    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    // Create Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set Column Headers
    $headers = [
        'Product ID',
        'Product Name',
        'Product Code',
        'Product Image',
        'Brand ID',
        'Category ID',
        'Quantity In Stock',
        'Purchased',
        'Current Rate',
        'F Days',
        'T Days',
        'Purchase Rate',
        'Final Rate',
        'Status',
        'Availability',
        'Alert At',
        'Weight',
        'Actual Rate',
        'Product Description',
        'Product MM',
        'Product Inch',
        'Product Meter',
        'Inventory',
        'Category Name',
        'Category Country',
        'Brand Name',
        'Brand Category Name',
        'Brand Country'
    ];

    // Set headers in the Excel sheet
    $col = 'A';
    foreach ($headers as $header) {
        $sheet->setCellValue($col . '1', $header);
        $col++;
    }

    // Fill Data Rows
    $rowNum = 2;
    while ($row = $result->fetch_assoc()) {
        $col = 'A';
        $sheet->setCellValue($col++ . $rowNum, $row['product_id']);
        $sheet->setCellValue($col++ . $rowNum, $row['product_name']);
        $sheet->setCellValue($col++ . $rowNum, $row['product_code']);
        $sheet->setCellValue($col++ . $rowNum, $row['product_image']);
        $sheet->setCellValue($col++ . $rowNum, $row['brand_id']);
        $sheet->setCellValue($col++ . $rowNum, $row['category_id']);
        $sheet->setCellValue($col++ . $rowNum, $row['quantity_instock']);
        $sheet->setCellValue($col++ . $rowNum, $row['purchased']);
        $sheet->setCellValue($col++ . $rowNum, $row['current_rate']);
        $sheet->setCellValue($col++ . $rowNum, $row['f_days']);
        $sheet->setCellValue($col++ . $rowNum, $row['t_days']);
        $sheet->setCellValue($col++ . $rowNum, $row['purchase_rate']);
        $sheet->setCellValue($col++ . $rowNum, $row['final_rate']);
        $sheet->setCellValue($col++ . $rowNum, $row['status']);
        $sheet->setCellValue($col++ . $rowNum, $row['availability']);
        $sheet->setCellValue($col++ . $rowNum, $row['alert_at']);
        $sheet->setCellValue($col++ . $rowNum, $row['weight']);
        $sheet->setCellValue($col++ . $rowNum, $row['actual_rate']);
        $sheet->setCellValue($col++ . $rowNum, $row['product_description']);
        $sheet->setCellValue($col++ . $rowNum, $row['product_mm']);
        $sheet->setCellValue($col++ . $rowNum, $row['product_inch']);
        $sheet->setCellValue($col++ . $rowNum, $row['product_meter']);
        $sheet->setCellValue($col++ . $rowNum, $row['inventory']);
        $sheet->setCellValue($col++ . $rowNum, $row['category_name']);
        $sheet->setCellValue($col++ . $rowNum, $row['category_country']);
        $sheet->setCellValue($col++ . $rowNum, $row['brand_name']);
        $sheet->setCellValue($col++ . $rowNum, $row['brand_category_name']);
        $sheet->setCellValue($col++ . $rowNum, $row['brand_country']);
        $rowNum++;
    }

    // Set Headers for Download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="products.xlsx"');
    header('Cache-Control: max-age=0');

    // Output Excel File
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');

    // Close the database connection
    $conn->close();
    exit;
}

if ($_REQUEST['action'] == 'download_example') {
    // Create Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set Column Headers (same as your original code)
    $headers = [
        'Product ID',
        'Product Name',
        'Product Code',
        'Product Image',
        'Brand ID',
        'Category ID',
        'Quantity In Stock',
        'Purchased',
        'Current Rate',
        'F Days',
        'T Days',
        'Purchase Rate',
        'Final Rate',
        'Status',
        'Availability',
        'Alert At',
        'Weight',
        'Actual Rate',
        'Product Description',
        'Product MM',
        'Product Inch',
        'Product Meter',
        'Inventory',
        'Category Name',
        'Category Country',
        'Brand Name',
        'Brand Category Name',
        'Brand Country'
    ];

    // Set headers in the Excel sheet
    $col = 'A';
    foreach ($headers as $header) {
        $sheet->setCellValue($col . '1', $header);
        $col++;
    }

    // No data rows are added - leaving it empty for manual filling

    // Set Headers for Download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="product_template.xlsx"');
    header('Cache-Control: max-age=0');

    // Output Excel File
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}


if ($_REQUEST['action'] == 'upload_products') {
    if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] == 0) {
        $file = $_FILES['excel_file']['tmp_name'];

        try {
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray();
        } catch (Exception $e) {
            die("Error loading spreadsheet: " . $e->getMessage());
        }

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        for ($i = 1; $i < count($data); $i++) {
            $row = $data[$i];

            // Assign row data with NULL or '' as default for empty fields
            // Auto-generate product_id if not provided
            if (!empty($row[0])) {
                $product_id = (int)$row[0];
            } else {
                $result = $conn->query("SELECT MAX(product_id) as max_id FROM product");
                if ($result && $row_max = $result->fetch_assoc()) {
                    $product_id = $row_max['max_id'] !== null ? (int)$row_max['max_id'] + 1 : 1;
                } else {
                    $product_id = 1; // Default to 1 if table is empty or query fails
                }
            }

            $product_name = !empty($row[1]) ? (string)$row[1] : null;
            $product_code = !empty($row[2]) ? (string)$row[2] : null;
            $product_image = !empty($row[3]) ? (string)$row[3] : '';
            $brand_id = !empty($row[4]) ? (int)$row[4] : 0; // Can be NULL if no brand
            $category_id = !empty($row[5]) ? (int)$row[5] : null;
            $quantity_instock = !empty($row[6]) ? (int)$row[6] : 0;
            $purchased = !empty($row[7]) ? (int)$row[7] : '';
            $current_rate = !empty($row[8]) ? (float)$row[8] : 0;
            $f_days = !empty($row[9]) ? (int)$row[9] : null;
            $t_days = !empty($row[10]) ? (int)$row[10] : null;
            $purchase_rate = !empty($row[11]) ? (float)$row[11] : '';
            $final_rate = !empty($row[12]) ? (float)$row[12] : '';
            $status = !empty($row[13]) ? (string)$row[13] : '';
            $availability = !empty($row[14]) ? (string)$row[14] : null;
            $alert_at = !empty($row[15]) ? (int)$row[15] : null;
            $weight = !empty($row[16]) ? (float)$row[16] : '';
            $actual_rate = !empty($row[17]) ? (float)$row[17] : null;
            $product_description = !empty($row[18]) ? (string)$row[18] : null;
            $product_mm = !empty($row[19]) ? (string)$row[19] : '';
            $product_inch = !empty($row[20]) ? (string)$row[20] : null;
            $product_meter = !empty($row[21]) ? (string)$row[21] : '';
            $inventory = !empty($row[22]) ? (int)$row[22] : '';
            $category_name = !empty($row[23]) ? (string)$row[23] : null;
            $category_country = !empty($row[24]) ? (string)$row[24] : null;
            $brand_name = !empty($row[25]) ? (string)$row[25] : null;
            $brand_category_name = !empty($row[26]) ? (string)$row[26] : null;
            $brand_country = !empty($row[27]) ? (string)$row[27] : null;

            // Handle Category
            if (!empty($category_name)) {
                $stmt = $conn->prepare("SELECT categories_id FROM categories WHERE categories_name = ?");
                if (!$stmt) die("Prepare failed: " . $conn->error);
                $stmt->bind_param("s", $category_name);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $category = $result->fetch_assoc();
                    $category_id = $category['categories_id'];
                    $stmt = $conn->prepare("UPDATE categories SET categories_country = ? WHERE categories_id = ?");
                    if (!$stmt) die("Prepare failed: " . $conn->error);
                    $stmt->bind_param("si", $category_country, $category_id);
                    if (!$stmt->execute()) {
                        echo "Error updating category on row $i: " . $conn->error . "<br>";
                    }
                } else {
                    $stmt = $conn->prepare("
                        INSERT INTO categories (
                            categories_name, 
                            category_price, 
                            category_purchase, 
                            categories_country, 
                            categories_active, 
                            categories_status
                        ) VALUES (?, 0.00, 0.00, ?, 1, 'active')
                    ");
                    if (!$stmt) die("Prepare failed: " . $conn->error);
                    $stmt->bind_param("ss", $category_name, $category_country);
                    if (!$stmt->execute()) {
                        echo "Error inserting category on row $i: " . $conn->error . "<br>";
                    } else {
                        $category_id = $conn->insert_id;
                    }
                }
                $stmt->close();
            }

            // Handle Brand (no continue, allow NULL brand_id)
            if (!empty($brand_name)) {
                $stmt = $conn->prepare("SELECT brand_id FROM brands WHERE brand_name = ?");
                if (!$stmt) die("Prepare failed: " . $conn->error);
                $stmt->bind_param("s", $brand_name);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $brand = $result->fetch_assoc();
                    $brand_id = $brand['brand_id'];
                    $stmt = $conn->prepare("UPDATE brands SET brand_country = ?, category_id = ? WHERE brand_id = ?");
                    if (!$stmt) die("Prepare failed: " . $conn->error);
                    $stmt->bind_param("sii", $brand_country, $category_id, $brand_id);
                    if (!$stmt->execute()) {
                        echo "Error updating brand on row $i: " . $conn->error . "<br>";
                    }
                } else {
                    if ($category_id === null) {
                        echo "Warning row $i: No valid category_id for brand, skipping brand insertion.<br>";
                    } else {
                        $stmt = $conn->prepare("
                            INSERT INTO brands (
                                category_id, 
                                brand_name, 
                                brand_country, 
                                brand_active, 
                                brand_status
                            ) VALUES (?, ?, ?, 1, 'active')
                        ");
                        if (!$stmt) die("Prepare failed: " . $conn->error);
                        $stmt->bind_param("iss", $category_id, $brand_name, $brand_country);
                        if (!$stmt->execute()) {
                            echo "Error inserting brand on row $i: " . $conn->error . "<br>";
                        } else {
                            $brand_id = $conn->insert_id;
                        }
                    }
                }
                $stmt->close();
            } // No else or continue here, proceed to product handling

            // Handle Product (require only product_id and category_id)
            if ($product_id !== null && $category_id !== null) {
                $stmt = $conn->prepare("SELECT product_id FROM product WHERE product_id = ?");
                if (!$stmt) die("Prepare failed: " . $conn->error);
                $stmt->bind_param("i", $product_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    // Update existing product
                    $stmt = $conn->prepare("
                        UPDATE product 
                        SET product_name = ?, 
                            product_code = ?, 
                            product_image = ?, 
                            brand_id = ?, 
                            category_id = ?, 
                            quantity_instock = ?, 
                            purchased = ?, 
                            current_rate = ?, 
                            f_days = ?, 
                            t_days = ?, 
                            purchase_rate = ?, 
                            final_rate = ?, 
                            status = ?, 
                            availability = ?, 
                            alert_at = ?, 
                            weight = ?, 
                            actual_rate = ?, 
                            product_description = ?, 
                            product_mm = ?, 
                            product_inch = ?, 
                            product_meter = ?, 
                            inventory = ?
                        WHERE product_id = ?
                    ");
                    if (!$stmt) die("Prepare failed: " . $conn->error);
                    $stmt->bind_param(
                        "sssiiddsdssdiiidsssssii",
                        $product_name,
                        $product_code,
                        $product_image,
                        $brand_id,
                        $category_id,
                        $quantity_instock,
                        $purchased,
                        $current_rate,
                        $f_days,
                        $t_days,
                        $purchase_rate,
                        $final_rate,
                        $status,
                        $availability,
                        $alert_at,
                        $weight,
                        $actual_rate,
                        $product_description,
                        $product_mm,
                        $product_inch,
                        $product_meter,
                        $inventory,
                        $product_id
                    );
                    if (!$stmt->execute()) {
                        echo "Error updating product on row $i: " . $stmt->error . "<br>";
                    }
                } else {
                    // Insert new product
                    $stmt = $conn->prepare("
                        INSERT INTO product (
                            product_id,
                            product_name, 
                            product_code, 
                            product_image, 
                            brand_id, 
                            category_id, 
                            quantity_instock, 
                            purchased, 
                            current_rate, 
                            f_days, 
                            t_days, 
                            purchase_rate, 
                            final_rate, 
                            status, 
                            availability, 
                            alert_at, 
                            weight, 
                            actual_rate, 
                            product_description, 
                            product_mm, 
                            product_inch, 
                            product_meter, 
                            inventory
                        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                    ");
                    if (!$stmt) die("Prepare failed: " . $conn->error);

                    // Explicitly reassign variables to avoid scope issues
                    $p_id = $product_id;
                    $p_name = $product_name;
                    $p_code = $product_code;
                    $p_image = $product_image;
                    $b_id = $brand_id;
                    $c_id = $category_id;
                    $qty = $quantity_instock;
                    $purch = $purchased;
                    $curr_rate = $current_rate;
                    $f_d = $f_days;
                    $t_d = $t_days;
                    $purch_rate = $purchase_rate;
                    $fin_rate = $final_rate;
                    $stat = $status;
                    $avail = $availability;
                    $alert = $alert_at;
                    $wgt = $weight;
                    $act_rate = $actual_rate;
                    $desc = $product_description;
                    $mm = $product_mm;
                    $inch = $product_inch;
                    $meter = $product_meter;
                    $inv = $inventory;

                    $stmt->bind_param(
                        "isssiiddidssdssidssssii",
                        $p_id,
                        $p_name,
                        $p_code,
                        $p_image,
                        $b_id,
                        $c_id,
                        $qty,
                        $purch,
                        $curr_rate,
                        $f_d,
                        $t_d,
                        $purch_rate,
                        $fin_rate,
                        $stat,
                        $avail,
                        $alert,
                        $wgt,
                        $act_rate,
                        $desc,
                        $mm,
                        $inch,
                        $meter,
                        $inv
                    );
                    if (!$stmt->execute()) {
                        echo "Error inserting product on row $i: " . $stmt->error . "<br>";
                    }
                }
                $stmt->close();
            } else {
                echo "Skipping row $i: Missing required IDs (product_id: $product_id, category_id: $category_id).<br>";
                continue;
            }
        }

        $conn->close();
        echo "Products upload process completed!";
        exit;
    } else {
        echo "Error uploading file: " . ($_FILES['excel_file']['error'] ?? 'Unknown error');
        exit;
    }
}
