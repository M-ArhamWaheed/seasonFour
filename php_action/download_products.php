<?php
require __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$conn = new mysqli("localhost", "root", "", "twcppabi_seasonfour");

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
        // Map the row data to the columns
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



if ($_REQUEST['action'] == 'upload_products') {
    // Check if file is uploaded
    if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] == 0) {
        $file = $_FILES['excel_file']['tmp_name'];

        // Load the spreadsheet
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray();

        // Database connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Skip header row and process data
        for ($i = 1; $i < count($data); $i++) {
            $row = $data[$i];
            
            // Extract data from row
            $product_id = $row[0];
            $product_name = $row[1];
            $product_code = $row[2];
            $product_image = $row[3];
            $brand_id = $row[4];
            $category_id = $row[5];
            $quantity_instock = $row[6];
            $purchased = $row[7];
            $current_rate = $row[8];
            $f_days = $row[9];
            $t_days = $row[10];
            $purchase_rate = $row[11];
            $final_rate = $row[12];
            $status = $row[13];
            $availability = $row[14];
            $alert_at = $row[15];
            $weight = $row[16];
            $actual_rate = $row[17];
            $product_description = $row[18];
            $product_mm = $row[19];
            $product_inch = $row[20];
            $product_meter = $row[21];
            $inventory = $row[22];
            $category_name = $row[23];
            $category_country = $row[24];
            $brand_name = $row[25];
            $brand_country = $row[26];

            // Get or create category
            $category_id = null;
            if (!empty($category_name)) {
                $stmt = $conn->prepare("SELECT categories_id FROM categories WHERE categories_name = ?");
                $stmt->bind_param("s", $category_name);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows > 0) {
                    $category = $result->fetch_assoc();
                    $category_id = $category['categories_id'];
                    // Update category_country if it has changed
                    $stmt = $conn->prepare("UPDATE categories SET categories_country = ? WHERE categories_id = ?");
                    $stmt->bind_param("si", $category_country, $category_id);
                    $stmt->execute();
                } else {
                    // Insert new category with the provided category_country
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
                    $stmt->bind_param("ss", $category_name, $category_country);
                    $stmt->execute();
                    $category_id = $conn->insert_id; // Get the new category_id
                }
                $stmt->close();
            }

            // Get or create brand
            $brand_id = null;
            if (!empty($brand_name)) {
                $stmt = $conn->prepare("SELECT brand_id FROM brands WHERE brand_name = ?");
                $stmt->bind_param("s", $brand_name);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows > 0) {
                    $brand = $result->fetch_assoc();
                    $brand_id = $brand['brand_id'];
                    // Update brand_country if it has changed
                    $stmt = $conn->prepare("UPDATE brands SET brand_country = ? WHERE brand_id = ?");
                    $stmt->bind_param("si", $brand_country, $brand_id);
                    $stmt->execute();
                } else {
                    // Insert new brand with the provided brand_country and category_id
                    if ($category_id === null) {
                        // If no category is provided, set a default category or skip
                        // For now, let's skip the row (you can modify this to set a default category)
                        continue;
                    }
                    $stmt = $conn->prepare("
                        INSERT INTO brands (
                            category_id, 
                            brand_name, 
                            brand_country, 
                            brand_active, 
                            brand_status
                        ) VALUES (?, ?, ?, 1, 'active')
                    ");
                    $stmt->bind_param("iss", $category_id, $brand_name, $brand_country);
                    $stmt->execute();
                    $brand_id = $conn->insert_id;
                }
                $stmt->close();
            } else {
                // Skip if no brand name is provided
                continue;
            }

            // Check if product exists
            $stmt = $conn->prepare("SELECT product_id FROM product WHERE product_id = ?");
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
                $stmt->bind_param("sssiiddsdssdiiidsssssii", 
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
                $stmt->execute();
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
                $stmt->bind_param("isssiiddsdssdiiidsssssii", 
                    $product_id,
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
                    $inventory
                );
                $stmt->execute();
            }
            $stmt->close();
        }

        // Clean up
        $conn->close();
        
        // Success message
        echo "Products uploaded successfully!";
        exit;
    } else {
        echo "Error uploading file!";
        exit;
    }
}
