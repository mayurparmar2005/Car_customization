<?php
session_start();
if(!isset($_SESSION['email'])){
    header('Location: index.php');
    exit();
}
include('db.php');

if(!isset($_GET['car_id'])){
    header('Location: home.php');
    exit();
}

$car_id = intval($_GET['car_id']);
$carQ = mysqli_query($conn, "SELECT * FROM cars WHERE id=$car_id LIMIT 1");
if(mysqli_num_rows($carQ)==0) {
    header('Location: home.php');
    exit();
}
$car = mysqli_fetch_assoc($carQ);

function parseOpt($str){
    $parts = explode('|', $str);
    return ['label' => $parts[0], 'price' => intval($parts[1])];
}

$color = parseOpt($_GET['color']);
$engine = parseOpt($_GET['engine']);
$interior = parseOpt($_GET['interior']);
$variant = parseOpt($_GET['variant']);

// ✅ Get readable color name from database based on file name
$colorFile = mysqli_real_escape_string($conn, $color['label']);
$colorNameQ = mysqli_query($conn, "SELECT name FROM car_colors WHERE file='$colorFile' LIMIT 1");
if(mysqli_num_rows($colorNameQ) > 0){
    $colorRow = mysqli_fetch_assoc($colorNameQ);
    $color['display_name'] = $colorRow['name']; // e.g. White, Black
} else {
    // fallback if not found
    $color['display_name'] = pathinfo($color['label'], PATHINFO_FILENAME);
}

$total = $car['base_price'] + $color['price'] + $engine['price'] + $interior['price'] + $variant['price'];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Summary - <?php echo htmlspecialchars($car['name']); ?></title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="topbar">
  <div class="container">
    <h1>Quotation Summary</h1>
    <div class="right">
      <a class="btn" href="home.php">Home</a>
      <a class="btn" href="logout.php">Logout</a>
    </div>
  </div>
</header>

<main class="container">
  <div class="card">
    <h2><?php echo htmlspecialchars($car['name']); ?></h2>
    
    <!-- ✅ Corrected image path -->
    <img src="images/colors/<?php echo htmlspecialchars($color['label']); ?>" alt="Selected Car" style="max-width:300px">
    
    <ul>
      <li>Color: <?php echo htmlspecialchars($color['display_name']); ?></li>
      <li>Engine: <?php echo htmlspecialchars($engine['label']); ?></li>
      <li>Interior: <?php echo htmlspecialchars($interior['label']); ?></li>
      <li>Variant: <?php echo htmlspecialchars($variant['label']); ?></li>
    </ul>
    
    <h3>Total Price: ₹ <?php echo number_format($total); ?></h3>
    
    <form method="post" action="thankyou.php">
      <input type="hidden" name="car" value="<?php echo htmlspecialchars($car['name']); ?>">
      <input type="hidden" name="total" value="<?php echo $total; ?>">
      <input type="email" name="email" placeholder="Enter your email" required>
      <button type="submit" name="send">Send Quotation</button>
    </form>
  </div>
</main>
</body>
</html>
