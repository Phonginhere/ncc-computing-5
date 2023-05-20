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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	</head>
	<body>
	<?php include_once('./navbar.php');?>

</div>
</div>

	    <nav class="navtop">
	    	<div>
	    		<h1>Reviews System</h1>
	    	</div>
	    </nav>
		<div class="content home">
			<h2>Reviews</h2>
			<p>Check out the below reviews for our website.</p>
			<div class="reviews"></div>
<script>
const reviews_page_id = 1;
fetch("reviews.php?page_id=" + reviews_page_id).then(response => response.text()).then(data => {
	document.querySelector(".reviews").innerHTML = data;
	document.querySelector(".reviews .write_review_btn").onclick = event => {
		event.preventDefault();
		document.querySelector(".reviews .write_review").style.display = 'block';
		document.querySelector(".reviews .write_review input[name='name']").focus();
	};
	document.querySelector(".reviews .write_review form").onsubmit = event => {
		event.preventDefault();
		fetch("reviews.php?page_id=" + reviews_page_id, {
			method: 'POST',
			body: new FormData(document.querySelector(".reviews .write_review form"))
		}).then(response => response.text()).then(data => {
			document.querySelector(".reviews .write_review").innerHTML = data;
		});
	};
});
</script>
		</div>
		<div class="w3-container">
  <p>Number of Views: <?php echo $views; ?></p>
  </div>
		<?php
    include_once('./footer.php');
    ?>
	</body>
</html>
