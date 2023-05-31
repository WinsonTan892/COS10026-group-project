<?php include 'common.inc'; ?>
<title>PHP Enhancements</title>
</head>
<body>
<?php include 'menu.inc'; ?>
	
  <div class="enhancement-container">

    <h2>List of enhancements</h2>

      <div class="enhancement">
        <div class="details">
          <h3>Manager login control</h3>
          <ul>
          <li>Login controls would be considered vital due to it drastically improving the privacy and security of staff details and job applicants data. </li>
          <li><a href="manager_login.php">Hyper link to enhancement.</a></li> 
          <li>When a user trys to direclty access the manager.php page and has not logged in before, the page will redirect the user to the manager_login.php page.</li>
          <li>This is achieved by cheacking whether the user has entered a username during the session, if not, the page will redirect the user to the manager_login.php page.</li>
          <li><a href="manage.php">hyperlink to enhancement</a></li>
          </ul>
        </div>
      </div>
	 

      <div class="enhancement">
        <div class="details">
          <h3>Sorting of EOI table</h3>
          <p class="enhancementalignleft">A set of sorting parameters for the EOI table</p>
          <ul>
            <li>The ability to sort and order elements inside the EOI table go above and beyond the requirments, enabling users to better navigate and filter applicants for the potential job openings. </li>
            <li>When a header is first clicked it will order the the data relating to the header in descending order, if clicked again it will then sort the data in ascending order. </li>
	          <li>this was implemented by creating a series of if statments, checking to see which header was clicked and thus which ordering query should be made while also checking to see if it should be ascending or descending.</li>
            <li><a href="manage.php">hyperlink to enhancement</a></li>
          </ul>
        </div>
      </div>

  </div>
	<?php include 'footer.inc'; ?>
  </body>
</html>
