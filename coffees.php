<?php include 'header.php'; ?>
<link rel="stylesheet" href="css/coffees.css">
<video autoplay muted loop id="background-video">
    <source src="videos/coffee_bg.mp4" type="video/mp4">
    Your browser does not support the video tag.
</video>



<div class="coffee-list">
    <div class="coffee-card">
        <img src="images/espresso.jpg" alt="Espresso">
        <h3>Espresso</h3>
        <p>Strong and bold coffee, perfect for a quick energy boost.</p>
        <a href="coffee_detail.php?coffee=Espresso">Order Now</a>
    </div>

    <div class="coffee-card">
        <img src="images/latte.jpg" alt="Latte">
        <h3>Latte</h3>
        <p>Smooth blend of espresso and steamed milk.</p>
        <a href="coffee_detail.php?coffee=Latte">Order Now</a>
    </div>

    <div class="coffee-card">
        <img src="images/cappuccino.jpg" alt="Cappuccino">
        <h3>Cappuccino</h3>
        <p>Classic Italian coffee with rich foam.</p>
        <a href="coffee_detail.php?coffee=Cappuccino">Order Now</a>
    </div>

    <div class="coffee-card">
        <img src="images/americano.jpg" alt="Americano">
        <h3>Americano</h3>
        <p>Espresso with added hot water for a milder flavor.</p>
        <a href="coffee_detail.php?coffee=Americano">Order Now</a>
    </div>

    <div class="coffee-card">
        <img src="images/mocha.jpg" alt="Mocha">
        <h3>Mocha</h3>
        <p>Delicious mix of chocolate, espresso and milk.</p>
        <a href="coffee_detail.php?coffee=Mocha">Order Now</a>
    </div>
</div>

<?php include 'footer.php'; ?>
