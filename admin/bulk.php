<?php
require_once 'vendor/autoload.php';
require_once 'PhpSpreadsheet/src/PhpSpreadsheet/IOFactory.php';
require_once 'PhpSpreadsheet/src/PhpSpreadsheet/Spreadsheet.php';
require_once 'PhpSpreadsheet/src/PhpSpreadsheet/Worksheet/Worksheet.php';
require_once 'PhpSpreadsheet/src/PhpSpreadsheet/Cell/DataType.php';
require_once 'PhpSpreadsheet/src/PhpSpreadsheet/Cell/Cell.php';

// include mysql database configuration file
include_once '../includes/dbconn.php';

if (isset($_POST['bulk'])) {

    // Validate whether selected file is an Excel file
    if (!empty($_FILES['upload']['name']) && pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION) == 'xlsx') {

        // Load the Excel file
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($_FILES['upload']['tmp_name']);

        // Get the first worksheet in the Excel file
        $worksheet = $spreadsheet->getActiveSheet();

        // Get the row number where the data starts
        $startRow = 4; // Change this to the row number where the data starts in your Excel file
        $inserted = 0;
        $skipped = 0;
        // Loop through each row of data in the Excel file
        for ($row = $startRow; $row < $worksheet->getHighestRow(); $row++) {

            // Get the data from each column in the current row
            $registration_number = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
            $firstname = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
            $middlename = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
            $lastname = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
            $faculty = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
            $department = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
            $level = $worksheet->getCellByColumnAndRow(7, $row)->getValue();

            // Check if user already exists in the database with the same registration number
            $query = "SELECT * FROM userregistration WHERE regNo = '" . mysqli_real_escape_string($mysqli, $registration_number) . "'";

            $check = mysqli_query($mysqli, $query);

            if ($check->num_rows > 0) {
                // User already exists in the database, so skip this record
                $skipped++;
                continue;
            }

            // Insert new record into database
            $query = "INSERT INTO userregistration (regNo, firstName, middleName, lastName, faculty, department,level) VALUES ('" . mysqli_real_escape_string($mysqli, $registration_number) . "', '" . mysqli_real_escape_string($mysqli, $firstname) . "', '" . mysqli_real_escape_string($mysqli, $middlename) . "', '" . mysqli_real_escape_string($mysqli, $lastname) . "', '" . mysqli_real_escape_string($mysqli, $faculty) . "', '" . mysqli_real_escape_string($mysqli, $department) . "', '" . mysqli_real_escape_string($mysqli, $level) . "')";

            mysqli_query($mysqli, $query);
            $inserted++;
        }

        // Close opened Excel file
        $spreadsheet->disconnectWorksheets();
        unset($spreadsheet);
        echo "
    <script>
        alert('You have successfully uploaded {$inserted} student(s) in bulk.');
        window.location.href = 'dashboard.php';
    </script>
";
        $_SESSION['excel'] = "Set";
    } else {
        echo "
    <script>
        alert('Please Select a Valid Excel File');
        window.location.href = 'dashboard.php';
    </script>
    ";
    }
}
