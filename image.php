<!DOCTYPE html>
<html>
<head>
  <title>Image gallary</title>
  <style>
    /* Add your own styles for the Masonry container */
    .grid-container {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  grid-gap: 10px;
}

.grid-row:nth-child(even) {
  border: 2px solid #ccc;
}
.grid-item--width2 { width: 80px; }
.grid-item--height2 { height: 80px; }
  </style>
  <!-- Include the Masonry.js library -->
  <script src="masonry.js"></script>
</head>
<body>
  <div class="grid-container">
  <?php
  // Define the directory to read image files from
  $dir = "images/";

  // Use the glob() function to get all files with extensions .jpg, .png, .gif, etc.
  $imageFiles = glob($dir . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);

  // Loop through the array of image files to display in the grid items
  echo "<div class='grid-container'>";
  echo "<div class='grid-item grid-item--width2'></div>";
  echo "<div class='grid-item grid-item--height2'></div>";
  $i = 1;
  foreach ($imageFiles as $image) {
    // If it's the first item in a row, add a grid-row class to the container
    if ($i == 1) {
      if (($key = array_search($image, $imageFiles)) !== false) {
        if ($key % 8 == 0) {
          echo "<div class='grid-row'>";
        }
      }
    }
    // Add the grid item
   
    echo "<div class='grid-item'><img src='$image'></div>";
    $i++;
    // If it's the last item in a row, close the row and reset the counter
    if ($i == 5) {
      if (($key = array_search($image, $imageFiles)) !== false) {
        if ($key % 8 == 7) {
          echo "</div>";
        }
      }
      $i = 1;
    }
  }
  
  echo "</div>";
  echo "</div>";
  echo "</div>";
  
?>



<!-- Initialize Masonry on the grid container after page load -->
<script>
  var grid = document.querySelector('.grid-container');
  var msnry = new Masonry(grid, {
    itemSelector: '.grid-item',
    columnWidth: 200,
    gutter: 10
  });
</script>


    
    <!-- Initialize Masonry on the grid container after page load -->
    <script>
      var grid = document.querySelector('.grid-container');
      var msnry = new Masonry(grid, {
        itemSelector: '.grid-item',
        columnWidth: 200,
        gutter: 10
      });
    </script>
    
  <!-- Initialize Masonry on the grid container after page load -->
  <script>
    var grid = document.querySelector('.grid-container');
    var msnry = new Masonry(grid, {
        itemSelector: '.grid-item',
  // use element for option
  columnWidth: '.grid-sizer',
  percentPosition: true
    });
    $grid.imagesLoaded().progress( function() {
  $grid.masonry('layout');
});
  </script>
</body>
</html>
