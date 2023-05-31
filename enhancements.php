<?php include 'common.inc'; ?>
<title>Enhancements</title>
</head>
<body>
<?php include 'menu.inc'; ?>
	
  <div class="enhancement-container">

    <h2>List of enhancements</h2>

      <div class="enhancement">
        <div class="details">
          <h3>CSS enhancements - Link Highlighting, Animations, Progress Bar, Responsiveness</h3>
          <p class="enhancementalignleft">The :hover pseudo-class is used to define the style for links when the user hovers over them.</p>
          <ul>
            <li>CSS link highlighting is considered advanced and beneficial because it improves the usability and accessibility of a website. By providing visual cues to users about the state of links, it helps them understand where they currently are in the website and where they can go next.</li>
            <li>code needed to implement feature</li>
            <li>reference used: https://css-tricks.com/css-link-hover-effects, https://alvaromontoro.com/blog/68014/css-only-reading-progress-indicator</li>
            <li><a href="apply.html#submit">hyperlink to enhancement</a></li>
            <li>CSS Animations help direct the user's focus onto the important elements on a webpage whilst also making it more lively. This results in a more coherent and entertaining experience.</li>
            <li> In order to implement animations into the webpage, the @keyframes rule is used. This rule determines the animation style at a given point in time, where the animation begins with a 'from' keyframe and ends with a 'to' keyframe. This allows sections of a webpage to change opacity, slide left to right and vice versa.</li>
            <li>reference used: https://www.bitdegree.org/learn/css-animation#:~:text=You%20can%20create%20the%20CSS,go%20from%200%20to%201.&text=Note%3A%20the%20opacity%20property%20value,the%20more%20transparent%20the%20element.</li>
            <li><a href="jobs.html">hyperlink to enhancement</a></li>
            <li>Responsiveness in a html page prevents the text within a html file from overlapping, which is a common problem when a page is opened from smaller devices due to their small screens. As a byproduct, the webpage remains fluid and visually pleasing.</li>
	          <li>Through utilising the @media rule, the layout of the page can be altered within a set range (range used is the pixel length of the webpage). This allows for multiple different layouts of a page to be created within a single css file.</li>
	         <li>Reference used: https://www.w3schools.com/cssref/css3_pr_mediaquery.php</li>
         <li><a href="jobs.html">hyperlink to enhancement</a></li>
          </ul>
        </div>
      </div>
	 

      <div class="enhancement">
        <div class="details">
          <h3>HTML Enhancement - Image Maps</h3>
          <p class="enhancementalignleft">An image that allows users to click on specific areas outlined by coordinates that are linked to specific URLs.</p>
          <ul>
            <li>Image maps go beyond the requirement as they enable a more interactive and engaging user experience, compared to traditional static images.</li>
            <li>They can be used to optimize web page layouts and reduce clutter, allowing more information into a single image while still maintaining a clean and organized look</li>
	          <li>The "img", "map" and "area" tags were used to implement this enhancement. The coordinate values were passed into the "coords" attribute to map out clickable areas. The areas are then linked to the image with the "usemap" attribute.</li>
            <li>credit to https://www.image-map.net/ for generating coordinates used in image map</li>
            <li>additional reference: https://www.w3schools.com/html/html_images_imagemap.asp</li>
            <li><a href="about.html">hyperlink to enhancement</a></li>
          </ul>
        </div>
      </div>

  </div>
	<?php include 'footer.inc'; ?>
  </body>
</html>
