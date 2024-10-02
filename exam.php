<?php

session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exam_system";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$role = $_SESSION['role'];
if (!$role) {
    header("location:lg.php");
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Examination Cell</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/table.css">
</head>

<body>

    <a href="lg.php" class="btn btn-outline-primary" style='color: rgb(5, 92, 92);  border: 2px solid rgb(5, 92, 92);'>Log Out</a>

    <div class="container-fluid">
        <div class="row justify-content-center">
        <img src="img/sppu_banner.png" alt="Header" class="img-fluid" style="height:200px; width:60%;   border-radius: 10px; margin-top:10px;">
        </div>
    </div>

    <p class="h3">Examination Cell</p>
    <div class="mx-auto" style="width: 97%;">
        <table class="table table-striped">
            <thead class="table-header">
                <tr>
                    <th style='Background-color: #2ef2e8;  border: none;'>Faculty Name</th>
                    <th style='Background-color: #2ef2e8;  border: none;'>Branch</th>
                    <th style='Background-color: #2ef2e8;  border: none;'>Course Name</th>
                    <th style='Background-color: #2ef2e8;  border: none;'>Course Code</th>
                    <th style='Background-color: #2ef2e8;  border: none;'>Exam</th>
                    <th style='Background-color: #2ef2e8;  border: none;'>Question Paper</th>
                    <th style='Background-color: #2ef2e8;  border: none;'>Academic Year</th>
                    <th style='Background-color: #2ef2e8;  border: none;'>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php

                $sql = "SELECT * FROM exam";
                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['faculty_name'] . "</td>";
                    echo "<td>" . $row['branch'] . "</td>";
                    echo "<td>" . $row['coursename'] . "</td>";
                    echo "<td>" . $row['coursecode'] . "</td>";
                    if ($row['exam'] == 'InSem') {
                        echo "<td>" . "InSem" . "</td>";
                    }
                    if ($row['exam'] == 'EndSem') {
                        echo "<td>" . "EndSem" . "</td>";
                    }
                    if ($row['exam'] == 'final') {
                        echo "<td>" . "Final" . "</td>";
                    }
                    echo "<td> <a class='a1' href='uploads/" . $row["file_name"] . "'>" . $row["file_name"] . "</a></td>";
                    echo "<td>" . $row['acyear'] . "</td>";

                    echo '<td><button class="btn btn-primary" onclick="printPDF(\'' . $row['file_path'] . '\')">Print</button></td>';
                    echo "</tr>";
                }

                ?>

            </tbody>
        </table>
    </div>
</body>

</html>


<script>
    function printPDF(filepath) {
        var pdfWindow = window.open(filepath, "_blank");
        pdfWindow.print();
    }
</script>