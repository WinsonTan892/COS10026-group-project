<?php include 'header.inc'; ?>
<title>Apply</title>
</head>
<body>
<?php include 'menu.inc'; ?>
		
		<div class="apply">
			<div class="header-container">
				<a href="index.html"><img src="images/svs5.png" alt="SVS5 LOGO"></a>
				<h1 id="title"> Application Form</h1>
			</div>
			
			<form method="post" novalidate action="processEOI.php">

				<div class="JRN-row">
					<div>
						<label for="JRN">Job reference number:</label><br>
						<input name="JRN" id="JRN" type="text" placeholder="Enter job reference number" pattern="[a-zA-Z0-9]{5}" required>
					</div>
					<img src="images/office2.jpg" alt="Office meeting.">
				</div>

				<br>
				<hr>

				<div class="formcontainer">
				<h2>Applicant Information</h2>

				<div class="row">
					<div class="detail-column">
						<label for="firstname">First name:</label><br>
					</div>
					<div class="input-column">
						<input name="firstname" id="firstname" type="text" placeholder="Enter your first name" pattern="[a-zA-Z]{0,20}" required>
					</div>
				</div>

				<div class="row">
					<div class="detail-column">	
						<label for="lastname">Last name:</label><br>
					</div>
					<div class="input-column">
						<input name="lastname" id="lastname" type="text" placeholder="Enter your last name" pattern="[a-zA-Z]{0,20}" required>
					</div>
				</div>

				<div class="row">
					<div class="detail-column">
						<label for="DOB">Date of birth:</label><br>
					</div>
					<div class="input-column">
						<input name="DOB" id="DOB" type="date" required>
					</div>
				</div>

				<div class="row">
					<div class="detail-column">
						<label>Gender:</label><br>
					</div>
					<div class="input-column">
						<fieldset>
							<legend>Gender</legend>
							<label for="male"><input id="male" type="radio" name="gender" value="male" required>Male</label><br>
							<label for="female"><input id="female" type="radio" name="gender" value="female">Female</label><br>
							<label for="unspecified"><input id="unspecified" type="radio" name="gender" value="unspecified">Unspecified</label><br>
						</fieldset>
					</div>
				</div>
				
				<div class="row">
					<div class="detail-column">
						<label for="address">Address:</label><br>
					</div>
					<div class="input-column">
						<input name="address" id="address" type="text" pattern=".{0,40}" placeholder="Enter your address" required>
					</div>
				</div>
					
				<div class="row">
					<div class="detail-column">
						<label for="suburb">Suburb:</label><br>
					</div>
					<div class="input-column">
						<input name="suburb" id="suburb" type="text" pattern=".{0,40}" placeholder="Enter your suburb" required>
					</div>
				</div>
					
				<div class="row">
					<div class="detail-column">
						<label for="state">State:</label><br>
					</div>
					<div class="input-column">
						<select id="state" name="state" required>
							<option value="">(select an option)</option>
							<option value="VIC">VIC</option>
							<option value="NSW">NSW</option>
							<option value="QLD">QLD</option>
							<option value="NT">NT</option>
							<option value="WA">WA</option>
							<option value="SA">SA</option>
							<option value="TAS">TAS</option>
							<option value="ACT">ACT</option>
						</select>
					</div>
				</div>
					
				<div class="row">
					<div class="detail-column">
						<label for="postcode">Postcode:</label><br>				
					</div>
					<div class="input-column">
						<input name="postcode" id="postcode" type="text" pattern="[0-9]{4}" placeholder="Enter your postcode" required>
					</div>
				</div>
					<br>
					<hr>
					<h2>Contact Details</h2>
					
				<div class="row">
					<div class="detail-column">
						<label for="email">Email:</label><br>
					</div>
					<div class="input-column">
						<input name="email" id="email" type="email" placeholder="Enter your email:" required>
					</div>
				</div>
					
				<div class="row">
					<div class="detail-column">
						<label for="phonenumber">Phone number:</label><br>
					</div>
					<div class="input-column">
						<input name="phonenumber" id="phonenumber" type="text" pattern="[0-9\s]{8,12}" placeholder="Enter your phone number" required>
					</div>
				</div>

				<br>

				<hr>
					
				<h2>Applicant Qualifications</h2>	

				<div class="row">
					<div class="detail-column">
						<label>Skills:</label>		
					</div>
					<div class="input-column">
						<label><input value="teamwork" name="skills[]" type="checkbox" checked>Effective Teamwork</label><br>
						<label><input value="problem-solving" name="skills[]" type="checkbox">Problem Solving</label><br>
						<label><input value="leadership" name="skills[]" type="checkbox">Leadership</label><br>
						<label><input value="nsc" name="skills[]" type="checkbox">Network Security Control</label><br>
						<label><input value="os" name="skills[]" type="checkbox">High level understanding of operating systems</label><br>	
					</div>
				</div>
				<div class="row">
					<div class="detail-column">
						<label for="otherskills">Other Skills:</label>
					</div>
					<div class="input-column">
						<textarea name="otherskills" id="otherskills" rows="4" cols="40" placeholder="E.g I am adaptable, a fast critical thinker, etc."></textarea>
					</div>
				</div>
				
				<br>
				<hr> 

			</div>
				<div class="submit">
					<img src="images/meeting.jpg" alt='Image of an Office.' id="meeting">
					<input id="submit" type="submit" value="Apply">
				</div>
				
			</form>

			<?php include 'footer.inc'; ?>
		</div>
	</body>
</html>

