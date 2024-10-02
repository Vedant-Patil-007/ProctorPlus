<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exam_system";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$branch = $_SESSION['branch'];
$role = $_SESSION['role'];
if (!$branch || !$role) {
    header("location:lg.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/newform.css">
    <title>Registration Form</title>
</head>

<body>

<a href="lg.php" class="btn btn-outline-primary" style='color: rgb(5, 92, 92);  border: 2px solid rgb(5, 92, 92);'>Log Out</a>

    <div class="container-fluid">
        <div class="row justify-content-center">
        <img src="img/sppu_banner.png" alt="Header" class="img-fluid" style="height:200px; width:60%;   border-radius: 10px; margin-top:10px;">

        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-sm-12 col-md-8 col-lg-6 col-xl-5 form-container" style = " background-color: #2ef2e8;">
                <h2>Updation of Faculty</h2>
                <form method="post">
                    <div class="form-group">
                        <label for="fcname">Name</label>
                        <input type="text" class="form-control" name="fcname" id="fcname" required />
                    </div>
                    <div class="form-group">
                        <label for="coname">Course Name</label>
                        <input type="text" class="form-control" name="coname" id="coname" required />
                    </div>
                    <div class="form-group">
                        <label for="cocode">Course Code</label>
                        <input type="text" class="form-control" name="cocode" id="cocode" required />
                    </div>
                    <div class="form-group">
                        <label for="register_email">Faculty Email:</label>
                        <input type="email" class="form-control" id="register_email" name="register_email" required>
                    </div>
                    <div class="form-group">
                        <label for="register_password">Faculty Password:</label>
                        <input type="password" class="form-control" id="register_password" name="register_password"
                            required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg mt-3" name="action" value="upd"style = " background-color: rgb(5, 92, 92); border: none;">Update </button>

                </form>
            </div>
        </div>
    </div>
    </form>
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
    closeButton.style.marginLeft = '12px';
        
    messageBox.appendChild(closeButton);
    modal.appendChild(messageBox);
    document.body.appendChild(modal);
}
</script>";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    if ($action == 'upd') {
        $fcname = $_POST['fcname'];
        $coname = $_POST['coname'];
        $cocode = $_POST['cocode'];
        $email = $_POST['register_email'];
        $password = $_POST['register_password'];
        $role ="Faculty";
        $branch = $_SESSION['branch'];


        //updation where onlly coname matches

        $sql = "SELECT * FROM users WHERE branch='$branch' AND coname='$coname' AND cocode<>'$cocode'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $sql = "UPDATE users SET fcname='$fcname',cocode='$cocode',email='$email',password='$password' WHERE coname='$coname'";
            if (mysqli_query($conn, $sql)) {
                $message = 'Faculty Updation Successful';
                echo "<script>showAlert('$message');</script>";
            } else {
                $message = 'Error Updating faculty record : ' . mysqli_error($conn);
                echo "<script>showAlert('$message');</script>";
            }
            exit();
        }

        //updation where onlly cocode matches

        $sql = "SELECT * FROM users WHERE coname<>'$coname' AND cocode='$cocode'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $sql = "UPDATE users SET fcname='$fcname',coname='$coname',email='$email',password='$password' WHERE cocode='$cocode'";
            if (mysqli_query($conn, $sql)) {
                $message = 'Faculty Updation Successful';
                echo "<script>showAlert('$message');</script>";
            } else {
                $message = 'Error Updating faculty record : ' . mysqli_error($conn);
                echo "<script>showAlert('$message');</script>";
            }
            exit();
        }

        //updation where both cocode coname matches

        $sql = "SELECT * FROM users WHERE coname='$coname' AND cocode='$cocode'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $sql = "UPDATE users SET fcname='$fcname', email='$email',password='$password' WHERE cocode='$cocode'";
            if (mysqli_query($conn, $sql)) {
                $message = 'Faculty Updation Successful';
                echo "<script>showAlert('$message');</script>";
            } else {
                $message = 'Error Updating faculty record : ' . mysqli_error($conn);
                echo "<script>showAlert('$message');</script>";
            }
            exit();
        }

    }
    $message = 'Faculty record not found';
    echo "<script>showAlert('$message');</script>";

}

?>