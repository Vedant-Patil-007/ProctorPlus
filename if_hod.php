<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exam_system";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$branch = $_SESSION['branch'];
$role = $_SESSION['role'];

if (!$branch || !$role) {
    header("location:lg.php");
}



$branch = $_SESSION['branch'];
$role = $_SESSION['role'];
$table_name = "if_uploaded_files";
$html = '<p class="h3">Information Department-Verifier</p>';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Course List</title>
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
<?php echo $html; ?>
<div class="facupdate">
    <button class="btn btn-primary" onclick="location.href='hodupd.php'" style=' background-color: rgb(5, 92, 92);  border: none;'>Update Checker Information</button>
    <button class="btn btn-primary" onclick="location.href='regnew.php'" style=' background-color: rgb(5, 92, 92);  border: none;'>Register New Faculty</button>
    <button class="btn btn-primary" onclick="location.href='if_facupdate.php'" style=' background-color: rgb(5, 92, 92);  border: none;'>Update Faculty Login
        Credentials</button>
    <button class="btn btn-primary" onclick="location.href='delt.php'" style=' background-color: rgb(5, 92, 92);  border: none;'>Delete Faculty Login Credentials</button>
</div>

    <div class="mx-auto" style="width: 97%;">
        <table class="table table-striped">
            <thead class="table-header">
                <tr>
                <th style = " background-color: #2ef2e8;">Faculty Name</th>
                    <th style = " background-color: #2ef2e8;">Course Name</th>
                    <th style = " background-color: #2ef2e8;">Course Code</th>
                    <th style = " background-color: #2ef2e8;">Exam</th>
                    <th style = " background-color: #2ef2e8;">Question Paper</th>
                    <th style = " background-color: #2ef2e8;">Academic Year</th>
                    <th style = " background-color: #2ef2e8;">Status</th>
                    <th style = " background-color: #2ef2e8;">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php

$sql = "SELECT * FROM $table_name";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['faculty_name'] . "</td>";
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
    echo "<td>" . $row['status1'] . "</td>";
    echo "<td>";
    echo "<form method='post'>";
    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
    echo "<input type='hidden' name='file_name' value='" . $row['file_name'] . "'>";
    echo "<input type='hidden' name='faculty_name' value='" . $row['faculty_name'] . "'>";
    echo "<input type='hidden' name='file_path' value='" . $row['file_path'] . "'>";
    echo "<input type='hidden' name='hod_notes' value='" . $row['hod_notes'] . "'>";
    echo "<input type='hidden' name='exam' value='" . $row['exam'] . "'>";
    echo "<input type='hidden' name='coursename' value='" . $row['coursename'] . "'>";
    echo "<input type='hidden' name='coursecode' value='" . $row['coursecode'] . "'>";
    echo "<input type='hidden' name='acyear' value='" . $row['acyear'] . "'>";
    echo "<button class='btn btn-primary' type='submit' name='approve' class='btn' style=' background-color: rgb(5, 92, 92);  border: none;'>Approve</button>";
    echo "<button class='btn btn-primary' type='submit' name='disapprove' class='btn' style=' background-color: rgb(5, 92, 92);  border: none;'>Disapprove</button>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
?>
</tbody>
</table>
</div>
</body>

</html>


<?php

echo "<script>
function showAlert(message) {
    var modal = document.createElement('div');
    modal.style.position = 'fixed';
    modal.style.top = '0';
    modal.style.right = '0';
    modal.style.bottom = '0';
    modal.style.left = '0';
    modal.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
    modal.style.display = 'flex';
    modal.style.alignItems = 'center';
    modal.style.justifyContent = 'center';
    
    var messageBox = document.createElement('div');
    messageBox.style.backgroundColor = '#80dfff';
    messageBox.style.padding = '20px';
    messageBox.style.borderRadius = '10px';
    messageBox.style.boxShadow = '0 0 10px rgba(0, 0, 0, 0.5)';
    messageBox.style.fontSize = '18px';
    messageBox.style.maxWidth = '50%';
    messageBox.textContent = message;
    
    var closeButton = document.createElement('button');
    closeButton.textContent = 'Close';
    closeButton.style.cursor = 'pointer';
    closeButton.className = 'btn btnmsg btn-primary';

    closeButton.addEventListener('click', function() {
        modal.parentNode.removeChild(modal);
        window.location.href = 'if_hod.php';
    });

    closeButton.style.marginLeft = '12px'; // Add margin-top here
        
    messageBox.appendChild(closeButton);
    modal.appendChild(messageBox);
    document.body.appendChild(modal);
}
</script>";

if (isset($_POST['approve'])) {
    $id = $_POST['id'];
    $sql = "SELECT status1 FROM $table_name WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $field_value;
    if ($result) {
        $row = mysqli_fetch_array($result);
        $field_value = $row['status1'];
    } else {
    
    }
    if ($field_value == "Disapproved") {
        $sql = "UPDATE $table_name SET hod_notes='-' WHERE id=$id";
        if (mysqli_query($conn, $sql)) {

        } else {
            $message = 'Error updating hod notes when hod approves file after once he disapproves with reason : ' . mysqli_error($conn);
            echo "<script>showAlert('$message');</script>";
        }
    }

    $i = -1;
    do {
        $id = $_POST['id'];
        $file_name = $_POST['file_name'];
        $faculty_name = $_POST['faculty_name'];
        $file_path = $_POST['file_path'];
        $exam = $_POST['exam'];
        $coursename = $_POST['coursename'];
        $coursecode = $_POST['coursecode'];
        $acyear = $_POST['acyear'];
        $status1 = 'Approved';

        $branch = $_SESSION['branch'];
        if ($branch == "if") {
            $brnm = "Information Technology";
        } elseif ($branch == "cm") {
            $brnm = "Computer Tchnology";
        } elseif ($branch == "ce") {
            $brnm = "Civil Engineering";
        } elseif ($branch == "me") {
            $brnm = "Mechanical Engineering";
        } elseif ($branch == "mk") {
            $brnm = "Mechatronics Engineering";
        } elseif ($branch == "ae") {
            $brnm = "utomobile Engineering";
        } elseif ($branch == "pe") {
            $brnm = "Plastic Engineering";
        } elseif ($branch == "idd") {
            $brnm = "Interior Dress & Decoration Engineering";
        } elseif ($branch == "ddgm") {
            $brnm = "Dress Designing & Garment Manufacturing";
        } elseif ($branch == "ee") {
            $brnm = "Electrical Engineering";
        } elseif ($branch == "entc") {
            $brnm = "Electronics & Telecommunication Engineering";
        }
        
        $sql = "SELECT * FROM exam WHERE file_name = '$file_name' AND faculty_name = '$faculty_name' AND file_path = '$file_path' AND status1 = '$status1' AND coursename = '$coursename' AND coursecode = '$coursecode' AND exam = '$exam'";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            $message = 'File has been previously approved';
            echo "<script>showAlert('$message');</script>";
            break;
        } else {

            $sql1 = "UPDATE $table_name SET status1='Approved' WHERE id=$id";
            $sql2 = "INSERT INTO exam (file_name, faculty_name, branch, file_path, status1, coursename, coursecode, acyear, exam) VALUES('$file_name', '$faculty_name','$brnm', '$file_path', '$status1', '$coursename', '$coursecode', '$acyear', '$exam')";
            $sql = $sql1 . ";" . $sql2;
            $i = 1;
            if (mysqli_multi_query($conn, $sql)) {
                $message = 'File has been approved';
                echo "<script>showAlert('$message');</script>";
                break;
            } else {
                $message = 'Error Approving record' . mysqli_error($conn);
                echo "<script>showAlert('$message');</script>";
            }
        }
    
    } while ($i > 1 && mysqli_next_result($conn));


} elseif (isset($_POST['disapprove'])) {
    $id = $_POST['id'];
    $file_name = $_POST['file_name'];
    $faculty_name = $_POST['faculty_name'];
    $file_path = $_POST['file_path'];
    $exam = $_POST['exam'];
    $coursename = $_POST['coursename'];
    $coursecode = $_POST['coursecode'];
    $acyear = $_POST['acyear'];

    $status1 = 'Dispproved';

    $sql = "SELECT file_name FROM $table_name WHERE id = '$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            $fn = $row['file_name'];
            $sql = "DELETE FROM exam WHERE file_name='$fn'";
            if (mysqli_query($conn, $sql)) {

            } else {
                $message = 'Error Disapproving record - Can not delete a record from exam database : ' . mysqli_error($conn);
                echo "<script>showAlert('$message');</script>";
            }
        }
    } else {
        echo "No results found for ID $id.";
    }

    $sql = "INSERT INTO disapprove (file_name, faculty_name, file_path, status1, coursename, coursecode, acyear, exam) VALUES ('$file_name', '$faculty_name', '$file_path', '$status1', '$coursename', '$coursecode', '$acyear', '$exam')";
    if (mysqli_query($conn, $sql)) {
    } else {
        $message = 'Error Inserting record - Can not delete a record from exam database : ' . mysqli_error($conn);
        echo "<script>showAlert('$message');</script>";
    }
    $sql = "UPDATE $table_name SET status1='Disapproved' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
    } else {
        $message = 'Error updating record status - Can not delete a record from exam database : ' . mysqli_error($conn);
        echo "<script>showAlert('$message');</script>";
    }

    echo '<div class="container">';
    echo '<div class="row justify-content-center mt-4">';
    echo '<div class="rsnbox col-sm-12 col-md-8 col-lg-6 col-xl-5 form-container">';
    echo '<form method="post">';

    echo "<input type='hidden' name='id' value='" . $id . "'>";
    echo "<input type='hidden' name='file_name' value='" . $file_name . "'>";

    echo "<div class='form-group'>";
    echo "<label for='hodn'>Reason for Disapproval:</label>";
    echo "<textarea class='form-control' name='hodn' id='hodn' placeholder='Please enter reason for disapproval'></textarea>";
    echo "</div>";
    echo "<button class='btn btn-primary' type='submit' name='disapprove_submit'>Submit</button>";

    echo "</form>";
    echo "</div>";
    echo "</div>";
    echo "</div>";

}
if (isset($_POST['disapprove_submit'])) {
    $id = $_POST['id'];
    $hod_notes1 = $_POST['hodn'];
    $sql = "UPDATE $table_name SET hod_notes='$hod_notes1' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
    } else {
        $message = 'Error seting hod_notes for the record ' . mysqli_error($conn);
        echo "<script>showAlert('$message');</script>";
    }

    $file_name;
    $sql = "SELECT file_name FROM $table_name WHERE id = '$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            $fn = $row['file_name'];
            $sql = "UPDATE disapprove SET hod_notes='$hod_notes1' WHERE file_name='$fn'";
            if (mysqli_query($conn, $sql)) {
                $message = 'File has been disapproved successfully';
                echo "<script>showAlert('$message');</script>";

            } else {
                $message = 'Error Disapproving record : Updating hod-notes in disapprove database ' . mysqli_error($conn);
                echo "<script>showAlert('$message');</script>";
            }
        }
    } else {
        echo "No results found for ID $id.";
    }

}

mysqli_close($conn);

?>