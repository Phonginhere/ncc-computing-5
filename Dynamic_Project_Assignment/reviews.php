<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'shopdb';

try {
  $pdo = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
} catch (PDOException $exception) {
  exit('Failed to connect to database!');
}

if (isset($_POST['name'], $_POST['rating'], $_POST['content'], $_POST['page_id'])) {
  $name = $_POST['name'];
  $rating = $_POST['rating'];
  $content = $_POST['content'];
  $pageID = $_POST['page_id'];

  $stmt = $pdo->prepare('INSERT INTO reviews (page_id, name, content, rating, submit_date) VALUES (?, ?, ?, ?, NOW())');
  $stmt->execute([$pageID, $name, $content, $rating]);
  exit('Your review has been submitted!');
}

$stmt = $pdo->prepare('SELECT * FROM reviews WHERE page_id = ? ORDER BY submit_date DESC');
$stmt->execute([$pageID]);
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare('SELECT AVG(rating) AS overall_rating, COUNT(*) AS total_reviews FROM reviews WHERE page_id = ?');
$stmt->execute([$pageID]);
$reviews_info = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="overall-rating">
  <span class="num"><?= number_format($reviews_info['overall_rating'], 1) ?></span>
  <span class="thumbs-up">👍</span>
  <span class="total"><?= $reviews_info['total_reviews'] ?> reviews</span>
</div>

<button class="write-review-btn">Write a Review</button>

<div class="write-review-form-container">
  <form id="reviewForm">
    <input name="name" type="text" placeholder="Your Name" required><br>
    <select name="rating" required>
      <option value="" disabled selected>Rating</option>
      <option value="1">1 Star</option>
      <option value="2">2 Stars</option>
      <option value="3">3 Stars</option>
      <option value="4">4 Stars</option>
      <option value="5">5 Stars</option>
    </select><br>
    <textarea name="content" placeholder="Your Review" required></textarea><br>
    <input type="submit" value="Submit Review">
  </form>
</div>

<div class="reviews-list">
  <?php foreach ($reviews as $review) { ?>
    <div class="review-item">
      <div class="review-header">
        <span class="name"><?= $review['name'] ?></span>
        <span class="rating"><?= $review['rating'] ?> Likes</span>
      </div>
      <div class="review-content"><?= $review['content'] ?></div>
      <div class="submit-date"><?= $review['submit_date'] ?></div>
    </div>
  <?php } ?>
</div>
