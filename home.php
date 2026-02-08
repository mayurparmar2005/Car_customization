<?php
session_start();
if(!isset($_SESSION['email'])){
    header('Location: index.php');
    exit();
}
include('db.php');

// Fetch cars from DB
$cars = [];
$res = mysqli_query($conn, "SELECT * FROM cars");
while($row = mysqli_fetch_assoc($res)) $cars[] = $row;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Home - Car Customization</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="topbar">
  <div class="container">
    <h1>Car Customization</h1>
    <div class="right">
      <span>Logged in: <?php echo htmlspecialchars($_SESSION['email']); ?></span>
      <a class="btn" href="logout.php">Logout</a>
    </div>
  </div>
</header>

<main class="container">
  <h2>Choose a Car to Customize</h2>
  <div class="card-grid">
    <?php if(count($cars) > 0): ?>
      <?php foreach($cars as $car): 
        // Correct image path
        $imgPath = 'images/' . $car['image'];
        if(!file_exists($imgPath) || empty($car['image'])) {
            $imgPath = 'images/placeholder.jpg'; // fallback if missing
        }
      ?>
      <div class="card">
        <img src="<?php echo $imgPath; ?>" 
             alt="<?php echo htmlspecialchars($car['name']); ?>" 
             style="width:180px; height:120px; object-fit:cover; border-radius:10px;">

        <h3><?php echo htmlspecialchars($car['name']); ?></h3>
        <p class="muted">Base Price: ₹ <?php echo number_format($car['base_price']); ?></p>
        <a class="btn" href="customize.php?car_id=<?php echo $car['id']; ?>">Customize</a>
      </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No cars found in the database.</p>
    <?php endif; ?>
  </div>
</main>
</body>
</html>
