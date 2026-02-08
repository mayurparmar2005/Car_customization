🚗 Car Customization System
A Web-Based Vehicle Configuration & Quotation Platform
OVERVIEW 📖📖
The **Car Customization System** is a dynamic web application developed using **PHP and MySQL**. It allows users to interactively customize a vehicle by selecting various configurations (Color, Engine, Interior, Variant).

The system calculates the total price in real-time and provides a detailed quotation. A unique feature of this project is its ability to **email the final quotation** directly to the user.
SPECIFICATIONS
🔐 User Authentication:** Secure Login and Registration system to manage user sessions.
🎨 Live Customization:** Users can choose from different:
    Colors** (e.g., Red, Blue, Black)
    Engine Types** (e.g., V6, V8, Hybrid)
    Interiors** (e.g., Leather, Fabric)
    Variants** (e.g., Standard, Premium)
💰 Dynamic Pricing:** The total cost updates automatically based on selected options.
📧 Email Integration:** Generates a summary and sends a quotation email to the client using PHP Mailer / SMTP.
📱 Responsive Design:** Clean and user-friendly interface.


🛠️ Technologies Used
Frontend: HTML5, CSS3, JavaScript
Backend: PHP (Native)
Database: MySQL (Relational Database)
Server: Apache (via XAMPP/WAMP)

🚀 How to Run This Project
Since this project uses PHP and MySQL, it requires a local server.
1.  Download & Install XAMPP.
2.  Clone the Repository:
    Download this project and extract it to `C:\xampp\htdocs\car_customization.
3.  Setup the Database:
    Open **phpMyAdmin** (`http://localhost/phpmyadmin`).
    Create a new database named `car_customization`.
    Import the `database.sql` file provided in this folder.
4.  Configure Email (Optional):
   Update `thankyou.php` or `sendmail.ini` with your SMTP credentials to enable email sending.
5.  Run the Project:
    Open your browser and go to `http://localhost/car_customization`.

👤 Author
Mayur Parmar
Full Stack Developer
Mayur Parmar | Full Stack Developer

*Created for WebTechnolgy Subject (Semester -5 ) Nov-2025 / / Academic Submission.*
