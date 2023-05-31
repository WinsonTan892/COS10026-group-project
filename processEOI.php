<?php include 'header.inc'; ?>
    <title>Application Confirmation</title>
  </head>
  <body>
    <h1>Application Confirmation</h1>
<?php
require_once("settings.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: apply.html");
    exit();
  }
  
function sanitise_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;      
}

$JRN = '';
if (isset($_POST["JRN"])) {
    $JRN = $_POST["JRN"];
    $JRN = sanitise_input($JRN);
}

if (isset($_POST["firstname"])) {
    $firstname = $_POST["firstname"];
    $firstname = sanitise_input($firstname);
}

if (isset($_POST["lastname"])) {
    $lastname = $_POST["lastname"];
    $lastname = sanitise_input($lastname);
}

$age = '';
if (isset($_POST["DOB"])) {
    $DOB = $_POST["DOB"];
    $DOB = sanitise_input($DOB);
    $date = DateTime::createFromFormat('Y-m-d', $DOB);
    if ($date !== false) {
      $interval = $date->diff(new DateTime());
      $age = $interval->y;
    }
}

$gender = null;
if (isset($_POST["gender"])) {
    $gender = $_POST["gender"];
}

if (isset($_POST["address"])) {
    $address = $_POST["address"];
    $address = sanitise_input($address);
}

if (isset($_POST["suburb"])) {
    $suburb = $_POST["suburb"];
    $suburb = sanitise_input($suburb);
}

if (isset($_POST["state"])) {
  $state = $_POST["state"];
}

if (isset($_POST["postcode"])) {
    $postcode = $_POST["postcode"];
    $postcode = sanitise_input($postcode);
}

if (isset($_POST["email"])) {
    $email = $_POST["email"];
    $email = sanitise_input($email);
}

if (isset($_POST["phonenumber"])) {
    $phonenumber = $_POST["phonenumber"];
    $phonenumber = sanitise_input($phonenumber);
}


if (isset($_POST["skills"])) {
  $skills = $_POST["skills"];
  $teamwork = false;
  $problemsolving = false;
  $leadership = false;
  $nsc = false;
  $os = false;
  foreach ($skills as $skill) { 
    if ($skill == "teamwork") {
      $teamwork = true;
    }
    if ($skill == "problem-solving") {
      $problemsolving = true;
    }
    if ($skill == "leadership") {
      $leadership = true;
    }
    if ($skill == "nsc") {
      $nsc = true;
    }
    if ($skill == "os") {
      $os = true;
    }
  }
}

if (isset($_POST["otherskills"])) {
    $otherskills = $_POST["otherskills"];
    $otherskills = sanitise_input($otherskills);
}

  $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

  if (!$conn) {
    die("Connection failed");
  } 

  $uniqueNumber = rand(0,1000000000);

  $sql = "CREATE TABLE IF NOT EXISTS `eoi` (
    `EOInumber` int(11) NOT NULL,
    `JobReferenceNumber` varchar(5) NOT NULL,
    `FirstName` varchar(50) NOT NULL,
    `LastName` varchar(50) NOT NULL,
    `DOB` varchar(10) NOT NULL,
    `gender` enum('Male','Female','Unspecified') NOT NULL,
    `Address` varchar(40) NOT NULL,
    `Suburb` varchar(40) NOT NULL,
    `State` enum('VIC','NSW','QLD','NT','WA','SA','TAS','ACT') NOT NULL,
    `Postcode` varchar(4) NOT NULL,
    `Email` varchar(100) NOT NULL,
    `PhoneNumber` varchar(10) NOT NULL,
    `Teamwork` tinyint(1) DEFAULT NULL,
    `ProblemSolving` tinyint(1) DEFAULT NULL,
    `Leadership` tinyint(1) DEFAULT NULL,
    `NSC` tinyint(1) DEFAULT NULL,
    `os` tinyint(1) DEFAULT NULL,
    `OtherSkills` varchar(1000) DEFAULT NULL,
    `Status` enum('New','Current','Final') DEFAULT 'New'
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1";

  $conn->query($sql);
  
  $sql = "INSERT INTO eoi (EOInumber, jobreferencenumber, firstname, lastname, DOB, gender, address, suburb, state, postcode, email, phonenumber, teamwork, problemsolving, leadership, nsc, os, otherskills)
  VALUES ('$uniqueNumber','$JRN','$firstname', '$lastname', '$DOB', '$gender', '$address', '$suburb', '$state', '$postcode', '$email', '$phonenumber', '$teamwork', '$problemsolving', '$leadership', '$nsc', '$os', '$otherskills')";
  
  if ($conn->query($sql) === TRUE) {
    $id = $conn->insert_id;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
  $conn->close();

    $errmsg = "";

    if ($JRN == "" || !preg_match("/^[a-zA-Z0-9]{5}$/", $JRN)) {
      $errmsg .= "<p>You must enter a valid job reference number (exactly 5 alphanumeric characters).</p>";
    }

    if ($firstname == "" || !preg_match("/^[a-zA-Z]{1,20}$/", $firstname)) {
      $errmsg .= "<p>You must enter a valid first name (max 20 alpha characters).</p>";
    }

    if ($lastname == "" || !preg_match("/^[a-zA-Z]{1,20}$/", $lastname)) {
      $errmsg .= "<p>You must enter a valid last name (max 20 alpha characters).</p>";
    }

    if ($age <= 15 || $age >= 80) {
      $errmsg .= "<p>You must enter a valid date of birth (dd/mm/yyyy between 15 and 80).</p>";
    }

    if (!isset($gender) || ($gender != "male" && $gender != "female" && $gender != "unspecified")) {
      $errmsg .= "<p>You must select a valid gender.</p>";
    }

    if ($address == "" || !preg_match("/^[a-zA-Z0-9\s\/]{1,40}$/", $address)) {
      $errmsg .= "<p>You must enter a valid street address (max 40 characters).</p>";
    }

    if ($suburb == "" || !preg_match("/^[a-zA-Z\s]{1,40}$/", $suburb)) {
      $errmsg .= "<p>You must enter a valid suburb/town (max 40 characters).</p>";
    }

    if ($state == "" || !in_array($state, array("VIC", "NSW", "QLD", "NT", "WA", "SA", "TAS", "ACT"))) {
      $errmsg .= "<p>You must select a valid state (VIC, NSW, QLD, NT, WA, SA, TAS, ACT).</p>";
    }

    if ($postcode == "" || !preg_match("/^\d{4}$/", $postcode)) {
      $errmsg .= "<p>You must enter a valid postcode (exactly 4 digits).</p>";
    } 
    else {
      if ($state == "VIC" && !preg_match("/^(3|8)\d{3}$/", $postcode)) {
        $errmsg .= "<p>The postcode does not match the selected state (VIC).</p>";
      }
      if ($state == "NSW" && !preg_match("/^(1|2)\d{3}$/", $postcode)) {
        $errmsg .= "<p>The postcode does not match the selected state (NSW).</p>";
      }
      if ($state == "QLD" && !preg_match("/^4\d{3}$/", $postcode)) {
        $errmsg .= "<p>The postcode does not match the selected state (QLD).</p>";
        }
      if ($state == "NT" && !preg_match("/^08\d{2}$/", $postcode)) {
        $errmsg .= "<p>The postcode does not match the selected state (NT).</p>";
        }
      if ($state == "WA" && !preg_match("/^6\d{3}$/", $postcode)) {
        $errmsg .= "<p>The postcode does not match the selected state (WA).</p>";
        }
      if ($state == "SA" && !preg_match("/^5\d{3}$/", $postcode)) {
        $errmsg .= "<p>The postcode does not match the selected state (SA).</p>";
        }
      if ($state == "TAS" && !preg_match("/^7\d{3}$/", $postcode)) {
        $errmsg .= "<p>The postcode does not match the selected state (TAS).</p>";
        }
      if ($state == "ACT" && !preg_match("/^2\d{3}$/", $postcode)) {
        $errmsg .= "<p>The postcode does not match the selected state (ACT).</p>";
        }
      }

    if ($email == "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errmsg .= "<p>You must enter a valid email address.</p>";
    }

    if ($phonenumber == "" || !preg_match("/^\d{8,12}$/", $phonenumber)) {
      $errmsg .= "<p>You must enter a valid 8 to 12 digit phone number.</p>";
    }

    if (empty($skills)) {
      $errmsg .= "<p>You must select at least one skill.</p>";
    }
    
    if (!preg_match("/^[a-zA-Z\s,]*$/", $otherskills)) {
      $errmsg .= "<p>You must enter valid text (only letters, spaces, and commas).</p>";
      }

    if ($errmsg != "") {
        echo "<p>$errmsg</p>";
      }
      else {  
        echo "Success!<br>";
        echo "Your EOInumber: " . $uniqueNumber;
      }
    
?>
    <?php include 'footer.inc'; ?>
  </body>
</html>
