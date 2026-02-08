Car_Customization - Setup Guide

1. Requirements
   - XAMPP installed (Apache + MySQL)
   - Place the folder 'Car_Customization' into C:\xampp\htdocs\

2. Import Database
   - Open http://localhost/phpmyadmin
   - Click Import and choose the file car_customization.sql from the project root
   - Click Go to import database and sample data

3. Run Project
   - Start Apache and MySQL in XAMPP Control Panel
   - Open in browser: http://localhost/Car_Customization/
   - Use sample login: test@gmail.com / 1234
   - Or register a new user

4. Notes about images
   - The project contains placeholder images inside /images/.
   - If you want real high-resolution photos, replace the image files with your own real car photos
     but keep filenames same: fortuner_white.jpg, fortuner_black.jpg, hector_red.jpg, hector_silver.jpg, harrier_blue.jpg, harrier_grey.jpg

5. How it works (brief)
   - index.php: login page
   - register.php: create account
   - home.php: shows car cards from DB
   - customize.php: choose options and preview image
   - summary.php: shows final quotation and asks for email
   - thankyou.php: displays success message (no real email sent)
   - db.php: database connection

Project developed by Mayur.
