<?php
require_once 'connectionCounter.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1">
		<title>Reviews System</title>
		<link href="./css/styloz.css" rel="stylesheet" type="text/css">
		<link href="./css/test.css" rel="stylesheet" type="text/css">
		<link href="./css/review.css" rel="stylesheet" type="text/css">
  <link href="./css/custom.css" rel="stylesheet" type="text/css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
	<body>
	<?php include_once('./navbar.php');?>

	<div class="header">
    <h1>Customer Rating Page</h1>
  </div>
  
  <div class="main-content">
    <h2>Customer Rating</h2>
    <!-- Product details here -->
  </div>

  <div class="reviews-section">
    <?php
      $pageID = 1; // Replace with your actual page ID or retrieve it from your database
      include 'reviews.php';
    ?>
  </div>
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.write-review-btn').click(function() {
        $('.write-review-form-container').toggle();
      });

      $('#reviewForm').submit(function(e) {
        e.preventDefault();

        $.ajax({
          type: 'POST',
          url: 'reviews.php',
          data: $(this).serialize() + '&page_id=<?php echo $pageID; ?>', // Pass the page ID to review.php
          success: function(response) {
            alert(response);
            location.reload();
          }
        });
      });
    });
  </script>

  <div class="w3-container">
    <p>Number of Views: <?php echo $views; ?></p>
  </div>

  <?php include_once('./footer.php'); ?>

	</body>
</html>
