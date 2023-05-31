<?php

session_start();

// Checks whether user is logged in. if not, redirect to the manager login page
if (!isset($_SESSION['username'])) {
    header("Location: manager_login.php"); 
    exit(); 
}

require_once("settings.php");
$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die('Failed to connect to the database: ' . mysqli_connect_error());
}

$query = "SHOW TABLES LIKE 'eoi'";
$result = mysqli_query($conn, $query);
// Checks whether a table was collected from the database. If not, return a statement
if (mysqli_num_rows($result) === 0) {
    echo "No EOI table found.";
} else {
}
// Function that is called to sanitise data
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

// Used to sort data in ascending or descending order depending on which column header was clicked.
$sort = '';
if (isset($_GET['sort'])) {
    $sort = sanitize($conn, $_GET['sort']);
    if ($sort !== 'asc' && $sort !== 'desc') {
        $sort = ''; 
    }
}

$sort2 = '';
if (isset($_GET['sort2'])) {
    $sort2 = sanitize($conn, $_GET['sort2']);
    if ($sort2 !== 'asc' && $sort2 !== 'desc') {
        $sort2 = ''; 
    }
}

$sort3 = '';
if (isset($_GET['sort3'])) {
    $sort3 = sanitize($conn, $_GET['sort3']);
    if ($sort3 !== 'asc' && $sort3 !== 'desc') {
        $sort3 = ''; 
    }
}

$sort4 = '';
if (isset($_GET['sort4'])) {
    $sort4 = sanitize($conn, $_GET['sort4']);
    if ($sort4 !== 'asc' && $sort4 !== 'desc') {
        $sort4 = ''; 
    }
}
$sort5 = '';
if (isset($_GET['sort5'])) {
    $sort5 = sanitize($conn, $_GET['sort5']);
    if ($sort5 !== 'asc' && $sort5 !== 'desc') {
        $sort5 = ''; 
    }
}
$sort6 = '';
if (isset($_GET['sort6'])) {
    $sort6 = sanitize($conn, $_GET['sort6']);
    if ($sort6 !== 'asc' && $sort6 !== 'desc') {
        $sort6 = ''; 
    }
}
$sort7 = '';
if (isset($_GET['sort7'])) {
    $sort7 = sanitize($conn, $_GET['sort7']);
    if ($sort7 !== 'asc' && $sort7 !== 'desc') {
        $sort7 = ''; 
    }
}
$sort8 = '';
if (isset($_GET['sort8'])) {
    $sort8 = sanitize($conn, $_GET['sort8']);
    if ($sort8 !== 'asc' && $sort8 !== 'desc') {
        $sort8 = ''; 
    }
}
$sort9 = '';
if (isset($_GET['sort9'])) {
    $sort9 = sanitize($conn, $_GET['sort9']);
    if ($sort9 !== 'asc' && $sort9 !== 'desc') {
        $sort9 = ''; 
    }
}
$sort10 = '';
if (isset($_GET['sort10'])) {
    $sort10 = sanitize($conn, $_GET['sort10']);
    if ($sort10 !== 'asc' && $sort10 !== 'desc') {
        $sort10 = ''; 
    }
}
$sort11 = '';
if (isset($_GET['sort11'])) {
    $sort11 = sanitize($conn, $_GET['sort11']);
    if ($sort11 !== 'asc' && $sort11 !== 'desc') {
        $sort11 = ''; 
    }
}
$sort12 = '';
if (isset($_GET['sort12'])) {
    $sort12 = sanitize($conn, $_GET['sort12']);
    if ($sort12 !== 'asc' && $sort12 !== 'desc') {
        $sort12 = ''; 
    }
}
$sort13 = '';
if (isset($_GET['sort13'])) {
    $sort13 = sanitize($conn, $_GET['sort13']);
    if ($sort13 !== 'asc' && $sort13 !== 'desc') {
        $sort13 = ''; 
    }
}
$query1 = "SELECT * FROM eoi";
if (!empty($sort)) {
    $query1 .= " ORDER BY EOInumber $sort";
}
elseif (!empty($sort2)) {
    $query1 .= " ORDER BY JobReferenceNumber $sort2";
}
elseif (!empty($sort3)) {
    $query1 .= " ORDER BY FirstName $sort3";
}
elseif (!empty($sort4)) {
    $query1 .= " ORDER BY LastName $sort4";
}
elseif (!empty($sort5)) {
    $query1 .= " ORDER BY DOB $sort5";
}
elseif (!empty($sort6)) {
    $query1 .= " ORDER BY gender $sort6";
}
elseif (!empty($sort7)) {
    $query1 .= " ORDER BY Address $sort7";
}
elseif (!empty($sort8)) {
    $query1 .= " ORDER BY Suburb $sort8";
}
elseif (!empty($sort9)) {
    $query1 .= " ORDER BY State $sort9";
}
elseif (!empty($sort10)) {
    $query1 .= " ORDER BY Postcode $sort10";
}
elseif (!empty($sort11)) {
    $query1 .= " ORDER BY Email $sort11";
}
elseif (!empty($sort12)) {
    $query1 .= " ORDER BY PhoneNumber $sort12";
}
elseif (!empty($sort13)) {
    $query1 .= " ORDER BY Status $sort13";
}
$result1 = mysqli_query($conn, $query1);

// Used for Searching for data
// Construct a query to retrieve data based on the Job Reference Number and execute it
if (isset($_GET['position'])) {
    $position = sanitize($conn, $_GET['position']);
    $query2 = "SELECT * FROM eoi WHERE JobReferenceNumber = '$position'";
    $result2 = mysqli_query($conn, $query2);
}

// Construct a query to retrieve data based on first or last name and execute it
if (isset($_GET['applicant'])) {
    $applicant = sanitize($conn, $_GET['applicant']);
    $query3 = "SELECT * FROM eoi WHERE FirstName LIKE '%$applicant%' OR LastName LIKE '%$applicant%'";
    $result3 = mysqli_query($conn, $query3);
}
//Used for deleting data
// Construct query to delete data based on job reference number
if (isset($_GET['delete'])) {
    $deleteRefNumber = sanitize($conn, $_GET['delete']);
    $query4 = "DELETE FROM eoi WHERE JobReferenceNumber = '$deleteRefNumber'";
    $result4 = mysqli_query($conn, $query4);
}
//Used for changing EOI status
// Construct query to update eoi entry status based on EOInumber
if (isset($_GET['eoi_id']) && isset($_GET['status'])) {
    $eoiId = sanitize($conn, $_GET['eoi_id']);
    $status = sanitize($conn, $_GET['status']);
    $query5 = "UPDATE eoi SET Status = '$status' WHERE EOInumber = '$eoiId'";
    $result5 = mysqli_query($conn, $query5);
}
?>

<?php include 'header.inc'; ?>
    <title>Manage EOIs</title>
</head>
<body>
	
    <h1 id="manage_heading">Manage EOIs</h1>
    <h2 id="manage_mini_headings">List all EOIs:</h2>
    <?php if (mysqli_num_rows($result1) > 0) { ?>
        <br>
	<!-- List all EOIs that can be collected from a table -->
        <table class="manage_table">
            <tr>
		<th id="manage_th"><a href="?sort=<?php echo $sort === 'asc' ? 'desc' : 'asc'; ?>">EOInumber</a></th>
		<th id="manage_th"><a href="?sort2=<?php echo $sort2 === 'asc' ? 'desc' : 'asc'; ?>">Job Reference Number</a></th>
		<th id="manage_th"><a href="?sort3=<?php echo $sort3 === 'asc' ? 'desc' : 'asc'; ?>">First Name</a></th>
		<th id="manage_th"><a href="?sort4=<?php echo $sort4 === 'asc' ? 'desc' : 'asc'; ?>">Last Name</a></th>
		<th id="manage_th"><a href="?sort5=<?php echo $sort5 === 'asc' ? 'desc' : 'asc'; ?>">Date of Birth</th>
		<th id="manage_th"><a href="?sort6=<?php echo $sort6 === 'asc' ? 'desc' : 'asc'; ?>">Gender</th>
		<th id="manage_th"><a href="?sort7=<?php echo $sort7 === 'asc' ? 'desc' : 'asc'; ?>">Street Address</th>
		<th id="manage_th"><a href="?sort8=<?php echo $sort8 === 'asc' ? 'desc' : 'asc'; ?>">Suburb/Town</th>
		<th id="manage_th"><a href="?sort9=<?php echo $sort9 === 'asc' ? 'desc' : 'asc'; ?>">State</th>
		<th id="manage_th"><a href="?sort10=<?php echo $sort10=== 'asc' ? 'desc' : 'asc'; ?>">Postcode</th>
		<th id="manage_th"><a href="?sort11=<?php echo $sort11 === 'asc' ? 'desc' : 'asc'; ?>">Email Address</th>
		<th id="manage_th"><a href="?sort12=<?php echo $sort12 === 'asc' ? 'desc' : 'asc'; ?>">Phone Number</th>
		<th id="manage_th">Skills</th>
		<th id="manage_th">Other Skills</th>
		<th id="manage_th"><a href="?sort13=<?php echo $sort13 === 'asc' ? 'desc' : 'asc'; ?>">Status</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result1)) { ?>
                <tr>
			<td id="manage_td"><?php echo $row['EOInumber']; ?></td>
			<td id="manage_td"><?php echo $row['JobReferenceNumber']; ?></td>
			<td id="manage_td"><?php echo $row['FirstName']; ?></td>
			<td id="manage_td"><?php echo $row['LastName']; ?></td>
			<td id="manage_td"><?php echo $row['DOB']; ?></td>
			<td id="manage_td"><?php echo $row['gender']; ?></td>
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
	<!-- List all EOIs with the same job reference number that was inputted in the textbox under header "List all EOIs for a particular position" -->
        <table class="manage_table">
            <tr>
		<th id="manage_th">EOInumber</th>
		<th id="manage_th">Job Reference Number</th>
		<th id="manage_th">First Name</th>
		<th id="manage_th">Last Name</th>
		<th id="manage_th">Date of Birth</th>
		<th id="manage_th">Gender</th>
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
					<td id="manage_td"><?php echo $row['DOB']; ?></td>
					<td id="manage_td"><?php echo $row['gender']; ?></td>
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

    <h2 id="manage_mini_headings">List all EOIs for a particular applicant</h2>
   
        <form method="GET" action="" id="manage_form" class="manage_input_color">
            <label for="applicant" id="manage_label">Applicant Name:</label>
            <input type="text" name="applicant" id="applicant">
            <input type="submit" value="Search">
        </form>

    <?php if (isset($result3) && mysqli_num_rows($result3) > 0) { ?>
        <br>
	<!-- List all EOIs with the same name that was inputted in the textbox under header "List all EOIs for a particular applicant" -->
        <table class="manage_table">
            <tr>
		<th id="manage_th">EOInumber</th>
		<th id="manage_th">Job Reference Number</th>
		<th id="manage_th">First Name</th>
		<th id="manage_th">Last Name</th>
		<th id="manage_th">Date of Birth</th>
		<th id="manage_th">Gender</th>
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
			<td id="manage_td"><?php echo $row['DOB']; ?></td>
			<td id="manage_td"><?php echo $row['gender']; ?></td>
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
   	<!-- Delete the EOI that has the same job reference number as the one inputted into the textbox -->
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
	<!-- Change the status of the EOI entry -->
        <form method="GET" action="" id="manage_form" class="manage_input_color">
            <label for="eoi_id">EOI ID:</label>
            <input type="text" name="eoi_id" id="eoi_id">
            <label for="status">Status:</label>
            <select name="status" id="status" class="manage_drop_menu">
                <option value="New">New</option>
                <option value="Approved">Approved</option>
                <option value="Denied">Denied</option>
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
	<?php include 'footer.inc'; ?>
</body>
</html>

<?php
mysqli_close($conn);
?>
