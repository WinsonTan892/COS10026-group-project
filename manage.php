<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: manager_login.php");
    exit();
}

require_once("settings.php");

$conn = mysqli_connect($host, $user, $pwd, $sql_db);

$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die('Failed to connect to the database: ' . mysqli_connect_error());
}

function sanitize($connection, $data) {
    $data = trim($data);
    $data = mysqli_real_escape_string($connection, $data);
    return $data;
}

$tableExists = mysqli_query($conn, "SHOW TABLES LIKE 'eoi'");
if ($tableExists->num_rows === 0) {
    die('The "eoi" table does not exist in the database.');
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
    <title>Manage EOIs</title>
</head>
<body>
    <h1>Manage EOIs</h1>

    <h2>List all EOIs</h2>
    <?php if (mysqli_num_rows($result1) > 0) { ?>
        <table>
            <tr>
                <th>EOInumber</th>
                <th>Job Reference Number</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Street Address</th>
                <th>Suburb/Town</th>
                <th>State</th>
                <th>Postcode</th>
                <th>Email Address</th>
                <th>Phone Number</th>
                <th>Skills</th>
                <th>Other Skills</th>
                <th>Status</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result1)) { ?>
                <tr>
                    <td><?php echo $row['EOInumber']; ?></td>
                    <td><?php echo $row['JobReferenceNumber']; ?></td>
                    <td><?php echo $row['FirstName']; ?></td>
                    <td><?php echo $row['LastName']; ?></td>
                    <td><?php echo isset($row['Address']) ? $row['Address'] : ''; ?></td>
                    <td><?php echo isset($row['Suburb']) ? $row['Suburb'] : ''; ?></td>
                    <td><?php echo isset($row['State']) ? $row['State'] : ''; ?></td>
                    <td><?php echo isset($row['Postcode']) ? $row['Postcode'] : ''; ?></td>
                    <td><?php echo isset($row['Email']) ? $row['Email'] : ''; ?></td>
                    <td><?php echo $row['PhoneNumber']; ?></td>
                    <td>
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
                    <td><?php echo $row['OtherSkills']; ?></td>
                    <td><?php echo $row['Status']; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No EOIs found.</p>
    <?php } ?>

    <h2>List all EOIs for a particular position</h2>
<form method="GET" action="">
    <label for="position">Job Reference Number:</label>
    <input type="text" name="position" id="position">
    <input type="submit" value="Search">
</form>
<?php if (isset($result2)) { ?>
    <?php if (mysqli_num_rows($result2) > 0) { ?>
        <table>
            <tr>
                <th>EOInumber</th>
                <th>Job Reference Number</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Street Address</th>
                <th>Suburb/Town</th>
                <th>State</th>
                <th>Postcode</th>
                <th>Email Address</th>
                <th>Phone Number</th>
                <th>Skills</th>
                <th>Other Skills</th>
                <th>Status</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result2)) { ?>
                <tr>
                    <td><?php echo $row['EOInumber']; ?></td>
                    <td><?php echo $row['JobReferenceNumber']; ?></td>
                    <td><?php echo $row['FirstName']; ?></td>
                    <td><?php echo $row['LastName']; ?></td>
                    <td><?php echo isset($row['Address']) ? $row['Address'] : ''; ?></td>
                    <td><?php echo isset($row['Suburb']) ? $row['Suburb'] : ''; ?></td>
                    <td><?php echo isset($row['State']) ? $row['State'] : ''; ?></td>
                    <td><?php echo isset($row['Postcode']) ? $row['Postcode'] : ''; ?></td>
                    <td><?php echo isset($row['Email']) ? $row['Email'] : ''; ?></td>
                    <td><?php echo isset($row['Phone']) ? $row['Phone'] : ''; ?></td>
                    <td>
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
                    <td><?php echo isset($row['OtherSkills']) ? $row['OtherSkills'] : ''; ?></td>
                    <td><?php echo $row['Status']; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No EOIs found for the specified position.</p>
    <?php } ?>
<?php } ?>

    <!-- Query 3: List all EOIs for a particular applicant -->
    <h2>List all EOIs for a particular applicant</h2>
    <form method="GET" action="">
        <label for="applicant">Applicant Name:</label>
        <input type="text" name="applicant" id="applicant">
        <input type="submit" value="Search">
    </form>
    <?php if (isset($result3) && mysqli_num_rows($result3) > 0) { ?>
        <table>
            <tr>
                <th>EOInumber</th>
                <th>Job Reference Number</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Street Address</th>
                <th>Suburb/Town</th>
                <th>State</th>
                <th>Postcode</th>
                <th>Email Address</th>
                <th>Phone Number</th>
                <th>Skills</th>
                <th>Other Skills</th>
                <th>Status</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result3)) { ?>
                <tr>
                    <td><?php echo $row['EOInumber']; ?></td>
                    <td><?php echo $row['JobReferenceNumber']; ?></td>
                    <td><?php echo $row['FirstName']; ?></td>
                    <td><?php echo $row['LastName']; ?></td>
                    <td><?php echo isset($row['Address']) ? $row['Address'] : ''; ?></td>
                    <td><?php echo isset($row['Suburb']) ? $row['Suburb'] : ''; ?></td>
                    <td><?php echo isset($row['State']) ? $row['State'] : ''; ?></td>
                    <td><?php echo isset($row['Postcode']) ? $row['Postcode'] : ''; ?></td>
                    <td><?php echo isset($row['Email']) ? $row['Email'] : ''; ?></td>
                    <td><?php echo $row['PhoneNumber']; ?></td>
                    <td>
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
                    <td><?php echo $row['OtherSkills']; ?></td>
                    <td><?php echo $row['Status']; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else if (isset($result3) && mysqli_num_rows($result3) === 0) { ?>
        <p>No EOIs found for the specified applicant.</p>
    <?php } ?>


    <h2>Change the Status of an EOI</h2>
    <form method="GET" action="">
        <label for="eoi_id">EOI ID:</label>
        <input type="text" name="eoi_id" id="eoi_id">
        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="New">New</option>
            <option value="Current">Current</option>
            <option value="Final">Final</option>
        </select>
        <input type="submit" value="Change">
    </form>
    
    <h2>Delete all EOIs with a specified job reference number</h2>
    <form method="GET" action="">
        <label for="delete">Job Reference Number:</label>
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

