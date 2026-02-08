<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}

include('db.php');

if (!isset($_GET['car_id'])) {
    header('Location: home.php');
    exit();
}

$car_id = intval($_GET['car_id']);
$carQ = mysqli_query($conn, "SELECT * FROM cars WHERE id=$car_id LIMIT 1");
if (mysqli_num_rows($carQ) == 0) {
    header('Location: home.php');
    exit();
}
$car = mysqli_fetch_assoc($carQ);

// Fetch available color images for this car
$colors = mysqli_query($conn, "SELECT * FROM car_colors WHERE car_id=$car_id");

// Predefined options
$engines = [
    ['name' => 'Petrol', 'price' => 0],
    ['name' => 'Diesel', 'price' => 50000]
];
$interiors = [
    ['name' => 'Standard', 'price' => 0],
    ['name' => 'Premium', 'price' => 70000]
];
$variants = [
    ['name' => 'Base', 'price' => 0],
    ['name' => 'Top', 'price' => 100000]
];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Customize - <?php echo htmlspecialchars($car['name']); ?></title>
<link rel="stylesheet" href="css/style.css">
<style>
body {
  font-family: 'Segoe UI', sans-serif;
  background-color: #f7fbff;
  margin: 0;
}
.topbar {
  background: #fff;
  border-bottom: 1px solid #ddd;
  padding: 15px 40px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.topbar a.btn {
  background-color: #0b69d9;
  color: white;
  padding: 8px 15px;
  border-radius: 6px;
  text-decoration: none;
  margin-left: 10px;
  font-size: 15px;
  transition: 0.3s;
}
.topbar a.btn:hover {
  background-color: #094fa1;
}
.container {
  width: 90%;
  max-width: 1100px;
  margin: 20px auto;
}
.two-col {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 40px;
  align-items: start;
}
.preview-card {
  background: #fff;
  border-radius: 10px;
  padding: 20px;
  text-align: center;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
.preview-card img {
  width: 100%;
  height: auto;
  border-radius: 10px;
  transition: 0.3s;
}
form select, form button {
  width: 100%;
  padding: 10px;
  margin-top: 10px;
  border-radius: 6px;
  border: 1px solid #ccc;
  font-size: 16px;
}
form button {
  background-color: #0b69d9;
  color: white;
  border: none;
  margin-top: 20px;
  cursor: pointer;
  transition: 0.3s;
}
form button:hover {
  background-color: #094fa1;
}
#totalPreview {
  font-weight: bold;
  margin-top: 20px;
}
</style>
</head>
<body>
<header class="topbar">
  <h2>Car Customization</h2>
  <div>
    <a class="btn" href="home.php">Back</a>
    <a class="btn" href="logout.php">Logout</a>
  </div>
</header>

<main class="container">
  <div class="two-col">
    <div>
      <div class="preview-card">
        <img id="carImage" 
             src="images/cars/<?php echo htmlspecialchars($car['image']); ?>" 
             alt="<?php echo htmlspecialchars($car['name']); ?>">
      </div>
      <h3><?php echo htmlspecialchars($car['name']); ?></h3>
      <p>Base Price: ₹ <?php echo number_format($car['base_price']); ?></p>
    </div>

    <div>
      <form id="customForm" method="get" action="summary.php">
        <input type="hidden" name="car_id" value="<?php echo $car['id']; ?>">

        <label>Color</label>
        <select name="color" id="colorSelect">
          <option value="|0">Default (+₹0)</option>
          <?php while ($c = mysqli_fetch_assoc($colors)): ?>
            <option value="<?php echo htmlspecialchars($c['file']); ?>|<?php echo intval($c['price']); ?>">
              <?php echo htmlspecialchars($c['name']); ?> (+₹<?php echo number_format($c['price']); ?>)
            </option>
          <?php endwhile; ?>
        </select>

        <label>Engine</label>
        <select name="engine" id="engineSelect">
          <?php foreach($engines as $e): ?>
            <option value="<?php echo $e['name']; ?>|<?php echo $e['price']; ?>">
              <?php echo $e['name']; ?> (+₹<?php echo number_format($e['price']); ?>)
            </option>
          <?php endforeach; ?>
        </select>

        <label>Interior</label>
        <select name="interior" id="interiorSelect">
          <?php foreach($interiors as $i): ?>
            <option value="<?php echo $i['name']; ?>|<?php echo $i['price']; ?>">
              <?php echo $i['name']; ?> (+₹<?php echo number_format($i['price']); ?>)
            </option>
          <?php endforeach; ?>
        </select>

        <label>Variant</label>
        <select name="variant" id="variantSelect">
          <?php foreach($variants as $v): ?>
            <option value="<?php echo $v['name']; ?>|<?php echo $v['price']; ?>">
              <?php echo $v['name']; ?> (+₹<?php echo number_format($v['price']); ?>)
            </option>
          <?php endforeach; ?>
        </select>

        <p id="totalPreview">Final Price Preview: ₹ <?php echo number_format($car['base_price']); ?></p>
        <button type="submit">Get Quotation</button>
      </form>
    </div>
  </div>
</main>

<script>
const basePrice = <?php echo $car['base_price']; ?>;
const colorSelect = document.getElementById('colorSelect');
const engineSelect = document.getElementById('engineSelect');
const interiorSelect = document.getElementById('interiorSelect');
const variantSelect = document.getElementById('variantSelect');
const totalPreview = document.getElementById('totalPreview');
const carImage = document.getElementById('carImage');

function updatePrice() {
  const color = colorSelect.value.split('|');
  const engine = engineSelect.value.split('|');
  const interior = interiorSelect.value.split('|');
  const variant = variantSelect.value.split('|');

  const colorPrice = parseInt(color[1]) || 0;
  const enginePrice = parseInt(engine[1]) || 0;
  const interiorPrice = parseInt(interior[1]) || 0;
  const variantPrice = parseInt(variant[1]) || 0;

  const total = basePrice + colorPrice + enginePrice + interiorPrice + variantPrice;
  totalPreview.innerText = "Final Price Preview: ₹ " + total.toLocaleString('en-IN');

  // Update car image
  const imgFile = color[0];
  if (imgFile && imgFile.trim() !== '') {
    const newSrc = "images/colors/" + imgFile;
    const testImg = new Image();
    testImg.onload = () => { carImage.src = newSrc; };
    testImg.onerror = () => { carImage.src = "images/cars/<?php echo htmlspecialchars($car['image']); ?>"; };
    testImg.src = newSrc;
  } else {
    carImage.src = "images/cars/<?php echo htmlspecialchars($car['image']); ?>";
  }
}

[colorSelect, engineSelect, interiorSelect, variantSelect].forEach(sel => {
  sel.addEventListener('change', updatePrice);
});

updatePrice();
</script>
</body>
</html>
