<?php
require_once("settings.php");
$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die('Failed to connect to the database: ' . mysqli_connect_error());
}

function sanitize($connection, $data) {
    $data = trim($data);
    $data = mysqli_real_escape_string($connection, $data);
    return $data;
}

$position = '';
$applicant = '';
$deleteRefNumber = '';
$eoiId = '';
$status = '';

$query1 = "SELECT * FROM eoi";
$result1 = mysqli_query($conn, $query1);

if (isset($_GET['position'])) {
    $position = sanitize($conn, $_GET['position']);
    $query2 = "SELECT * FROM eoi WHERE JobReferenceNumber = '$position'";
    $result2 = mysqli_query($conn, $query2);
}

if (isset($_GET['applicant'])) {
    $applicant = sanitize($conn, $_GET['applicant']);
    $query3 = "SELECT * FROM eoi WHERE FirstName LIKE '%$applicant%' OR LastName LIKE '%$applicant%'";
    $result3 = mysqli_query($conn, $query3);
}

if (isset($_GET['delete'])) {
    $deleteRefNumber = sanitize($conn, $_GET['delete']);
    $query4 = "DELETE FROM eoi WHERE JobReferenceNumber = '$deleteRefNumber'";
    $result4 = mysqli_query($conn, $query4);
}

if (isset($_GET['eoi_id']) && isset($_GET['status'])) {
    $eoiId = sanitize($conn, $_GET['eoi_id']);
    $status = sanitize($conn, $_GET['status']);
    $query5 = "UPDATE eoi SET Status = '$status' WHERE EOInumber = '$eoiId'";
    $result5 = mysqli_query($conn, $query5);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Manage EOIs</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <h1 id="manage_heading">Manage EOIs</h1>
    <h2 id="manage_mini_headings">List all EOIs:</h2>
    <?php if (mysqli_num_rows($result1) > 0) { ?>
        <br>
        <table class="manage_table">
            <tr>
                <th id="manage_th">EOInumber</th>
                <th id="manage_th">Job Reference Number</th>
                <th id="manage_th">First Name</th>
                <th id="manage_th">Last Name</th>
                <th id="manage_th">Street Address</th>
                <th id="manage_th">Suburb/Town</th>
                <th id="manage_th">State</th>
                <th id="manage_th">Postcode</th>
                <th id="manage_th">Email Address</th>
                <th id="manage_th">Phone Number</th>
                <th id="manage_th">Skills</th>
                <th id="manage_th">Other Skills</th>
                <th id="manage_th">Status</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result1)) { ?>
                <tr>
                    <td id="manage_td"><?php echo $row['EOInumber']; ?></td>
                    <td id="manage_td"><?php echo $row['JobReferenceNumber']; ?></td>
                    <td id="manage_td"><?php echo $row['FirstName']; ?></td>
                    <td id="manage_td"><?php echo $row['LastName']; ?></td>
                    <td id="manage_td"><?php echo isset($row['Address']) ? $row['Address'] : ''; ?></td>
                    <td id="manage_td"><?php echo isset($row['Suburb']) ? $row['Suburb'] : ''; ?></td>
                    <td id="manage_td"><?php echo isset($row['State']) ? $row['State'] : ''; ?></td>
                    <td id="manage_td"><?php echo isset($row['Postcode']) ? $row['Postcode'] : ''; ?></td>
                    <td id="manage_td"><?php echo isset($row['Email']) ? $row['Email'] : ''; ?></td>
                    <td id="manage_td"><?php echo $row['PhoneNumber']; ?></td>
                    <td id="manage_td">
                        <?php
                        $skills = [];
                        if ($row['Teamwork'] == 1) {
                            $skills[] = 'Teamwork';
                        }
                        if ($row['ProblemSolving'] == 1) {
                            $skills[] = 'Problem Solving';
                        }
                        if ($row['Leadership'] == 1) {
                            $skills[] = 'Leadership';
                        }
                        if ($row['NSC'] == 1) {
                            $skills[] = 'NSC';
                        }
                        if ($row['os'] == 1) {
                            $skills[] = 'os';
                        }
                        echo implode(', ', $skills);
                        ?>
                    </td>
                    <td id="manage_td"><?php echo $row['OtherSkills']; ?></td>
                    <td id="manage_td"><?php echo $row['Status']; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No EOIs found.</p>
    <?php } ?>

    <h2 id="manage_mini_headings">List all EOIs for a particular position</h2>

    <form method="GET" action="" id="manage_form" class="manage_input_color">
        <label for="position" id="manage_label">Job Reference Number:</label>
        <input type="text" name="position" id="position">
        <input type="submit" value="Search">
    </form>

<?php if (isset($result2)) { ?>
    <?php if (mysqli_num_rows($result2) > 0) { ?>
        <br>
        <table class="manage_table">
            <tr>
                <th id="manage_th">EOInumber</th>
                <th id="manage_th">Job Reference Number</th>
                <th id="manage_th">First Name</th>
                <th id="manage_th">Last Name</th>
                <th id="manage_th">Street Address</th>
                <th id="manage_th">Suburb/Town</th>
                <th id="manage_th">State</th>
                <th id="manage_th">Postcode</th>
                <th id="manage_th">Email Address</th>
                <th id="manage_th">Phone Number</th>
                <th id="manage_th">Skills</th>
                <th id="manage_th">Other Skills</th>
                <th id="manage_th">Status</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result2)) { ?>
                <tr>
                    <td id="manage_td"><?php echo $row['EOInumber']; ?></td>
                    <td id="manage_td"><?php echo $row['JobReferenceNumber']; ?></td>
                    <td id="manage_td"><?php echo $row['FirstName']; ?></td>
                    <td id="manage_td"><?php echo $row['LastName']; ?></td>
                    <td id="manage_td"><?php echo isset($row['Address']) ? $row['Address'] : ''; ?></td>
                    <td id="manage_td"><?php echo isset($row['Suburb']) ? $row['Suburb'] : ''; ?></td>
                    <td id="manage_td"><?php echo isset($row['State']) ? $row['State'] : ''; ?></td>
                    <td id="manage_td"><?php echo isset($row['Postcode']) ? $row['Postcode'] : ''; ?></td>
                    <td id="manage_td"><?php echo isset($row['Email']) ? $row['Email'] : ''; ?></td>
                    <td id="manage_td"><?php echo isset($row['Phone']) ? $row['Phone'] : ''; ?></td>
                    <td id="manage_td">
                    <?php
                    $skills = [];
                    if ($row['Teamwork'] == 1) {
                        $skills[] = 'Teamwork';
                    }
                    if ($row['ProblemSolving'] == 1) {
                        $skills[] = 'Problem Solving';
                    }
                    if ($row['Leadership'] == 1) {
                        $skills[] = 'Leadership';
                    }
                    if ($row['NSC'] == 1) {
                        $skills[] = 'NSC';
                    }
                    if ($row['os'] == 1) {
                        $skills[] = 'os';
                    }
                    echo implode(', ', $skills);
                    ?>
                    </td>
                    <td id="manage_td"><?php echo isset($row['OtherSkills']) ? $row['OtherSkills'] : ''; ?></td>
                    <td id="manage_td"><?php echo $row['Status']; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No EOIs found for the specified position.</p>
    <?php } ?>
<?php } ?>

    <!-- Query 3: List all EOIs for a particular applicant -->
    <h2 id="manage_mini_headings">List all EOIs for a particular applicant</h2>
   
        <form method="GET" action="" id="manage_form" class="manage_input_color">
            <label for="applicant" id="manage_label">Applicant Name:</label>
            <input type="text" name="applicant" id="applicant">
            <input type="submit" value="Search">
        </form>

    <?php if (isset($result3) && mysqli_num_rows($result3) > 0) { ?>
        <br>
        <table class="manage_table">
            <tr>
                <th id="manage_th">EOInumber</th>
                <th id="manage_th">Job Reference Number</th>
                <th id="manage_th">First Name</th>
                <th id="manage_th">Last Name</th>
                <th id="manage_th">Street Address</th>
                <th id="manage_th">Suburb/Town</th>
                <th id="manage_th">State</th>
                <th id="manage_th">Postcode</th>
                <th id="manage_th">Email Address</th>
                <th id="manage_th">Phone Number</th>
                <th id="manage_th">Skills</th>
                <th id="manage_th">Other Skills</th>
                <th id="manage_th">Status</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result3)) { ?>
                <tr>
                    <td id="manage_td"><?php echo $row['EOInumber']; ?></td>
                    <td id="manage_td"><?php echo $row['JobReferenceNumber']; ?></td>
                    <td id="manage_td"><?php echo $row['FirstName']; ?></td>
                    <td id="manage_td"><?php echo $row['LastName']; ?></td>
                    <td id="manage_td"><?php echo isset($row['Address']) ? $row['Address'] : ''; ?></td>
                    <td id="manage_td"><?php echo isset($row['Suburb']) ? $row['Suburb'] : ''; ?></td>
                    <td id="manage_td"><?php echo isset($row['State']) ? $row['State'] : ''; ?></td>
                    <td id="manage_td"><?php echo isset($row['Postcode']) ? $row['Postcode'] : ''; ?></td>
                    <td id="manage_td"><?php echo isset($row['Email']) ? $row['Email'] : ''; ?></td>
                    <td id="manage_td"><?php echo $row['PhoneNumber']; ?></td>
                    <td id="manage_td">
                        <?php
                        $skills = [];
                        if ($row['Teamwork'] == 1) {
                            $skills[] = 'Teamwork';
                        }
                        if ($row['ProblemSolving'] == 1) {
                            $skills[] = 'Problem Solving';
                        }
                        if ($row['Leadership'] == 1) {
                            $skills[] = 'Leadership';
                        }
                        if ($row['NSC'] == 1) {
                            $skills[] = 'NSC';
                        }
                        if ($row['os'] == 1) {
                            $skills[] = 'os';
                        }
                        echo implode(', ', $skills);
                        ?>
                    </td>
                    <td id="manage_td"><?php echo $row['OtherSkills']; ?></td>
                    <td id="manage_td"><?php echo $row['Status']; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else if (isset($result3) && mysqli_num_rows($result3) === 0) { ?>
        <p>No EOIs found for the specified applicant.</p>
    <?php } ?>

    <h2 id="manage_mini_headings">Delete all EOIs with a specified job reference number</h2>
   
        <form method="GET" action="" id="manage_form" class="manage_input_color">
            <label  for="delete" id="manage_label">Job Reference Number:</label>
            <input type="text" name="delete" id="delete">
            <input type="submit" value="Delete">
        </form>
  
    <?php if (isset($result4)) { ?>
        <?php if (mysqli_affected_rows($conn) > 0) { ?>
            <p><?php echo mysqli_affected_rows($conn); ?> EOIs deleted successfully.</p>
        <?php } else { ?>
            <p>No EOIs found for the specified job reference number.</p>
        <?php } ?>
    <?php } ?>

    <h2 id="manage_mini_headings">Change the Status of an EOI</h2>

        <form method="GET" action="" id="manage_form" class="manage_input_color">
            <label for="eoi_id">EOI ID:</label>
            <input type="text" name="eoi_id" id="eoi_id">
            <label for="status">Status:</label>
            <select name="status" id="status" class="manage_drop_menu">
                <option value="New">New</option>
                <option value="Current">Current</option>
                <option value="Final">Final</option>
            </select>
            <input type="submit" value="Change">
        </form>
   
    <br>
    <a href="manager_login.php"><button type="button">Log Out</button></a>
    <?php if (isset($result5)) { ?>
        <?php if (mysqli_affected_rows($conn) > 0) { ?>
            <p>Status updated successfully.</p>
        <?php } else { ?>
            <p>Failed to update the status. Please check the EOI ID.</p>
        <?php } ?>
    <?php } ?>

</body>
</html>

<?php
mysqli_close($conn);
?>

