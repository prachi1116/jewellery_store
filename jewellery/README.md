# 💎 PyJewellery Store

**PyJewellery Store** is a dynamic and stylish online jewellery shop built using HTML, CSS, Bootstrap, JavaScript, and PHP with a MySQL database. It showcases a beautiful range of necklaces, rings, and earrings, allowing users to browse products and place orders with flexible payment options like Cash on Delivery, UPI, Cards, and more.

---

## 🌟 Features

- ✨ Responsive landing page with modern UI
- 🛍 Product showcase with pricing and "Place an Order" functionality
- 🧾 Order form with dynamic price calculation (JavaScript)
- 💸 Multiple payment method options on checkout (COD, UPI, Cards, etc.)
- 🗃 Order storage using PHP and MySQL
- 📱 Mobile-friendly design with Bootstrap 4
- 🔐 Admin login (if included in full project)
- 📦 Backend processing with PHP

---

## 📁 Project Structure

```
/
├── index.html               # Main landing page
├── about.html               # About Us section
├── shop.html                # Shop page
├── book.php                 # Order form (dynamic)
├── payment.php              # Payment page with multiple options
├── conn.php                 # MySQL database connection
├── css/
│   ├── bootstrap.css
│   ├── style.css
│   └── responsive.css
├── js/
│   ├── jquery-3.4.1.min.js
│   ├── bootstrap.js
│   └── custom.js
├── images/                  # Product and UI images
├── sql/                     # (Optional) SQL schema file
└── README.md
```

---

## 💡 Technologies Used

- **Frontend**: HTML5, CSS3, Bootstrap, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Styling Libraries**: Font Awesome

---

## 🚀 How to Run Locally

1. Clone the repo:
   ```bash
   git clone https://github.com/yourusername/pyjewellery-store.git
   cd pyjewellery-store
   ```

2. Set up the database:
   - Create a MySQL database (e.g., `jewellery_store`)
   - Import `shopnow` table (manually or via SQL file if included)

3. Update `conn.php` with your database credentials:
   ```php
   $conn = mysqli_connect("localhost", "username", "password", "jewellery");
   ```

4. Run using a local server:
   - Use XAMPP, WAMP, or any PHP-enabled server
   - Place files in `htdocs/` (for XAMPP) and start Apache & MySQL
   - Visit `http://localhost/jewellery/index.html`

---

## 🖼 Sample Pages

- **Homepage** – Displays slider, latest products, and blog.
- **Shop Page** – View and order latest jewellery items.
- **Payment Page** – Choose between COD, UPI, Card, etc.
- **About & Blog Pages** – Additional content for users.

---

## 🛡 License

This project is open-source and free to use for educational and non-commercial purposes. Feel free to fork and customize it!

---

## 🙌 Credits

Built with ❤️ by prachi yadav  
Design inspired by modern jewellery ecommerce themes.

---

## 📬 Contact

For feedback, suggestions, or collaborations, reach out at: 

🌐 linkedin---https://www.linkedin.com/in/prachi-yadav-73b506342?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app

## 🛠 XAMPP Setup Instructions

To run this project locally, you'll need a local server environment like **XAMPP**:

1. **Download and Install XAMPP**  
   👉 [https://www.apachefriends.org/index.html](https://www.apachefriends.org/index.html)

2. **Start Apache and MySQL** from the XAMPP Control Panel.

3. **Place Project Files in `htdocs/`**  
   Navigate to `C:/xampp/htdocs` and paste the project folder there.

4. **Import the Database**:
   - Open [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
   - Click **New**, create a database (e.g., `jewellery`)
   - Go to **Import**, and choose your `.sql` file (if provided)
   - admin name=prachi and password=123456
5. **Edit `conn.php` with your database credentials** (default for XAMPP):
   ```php
   $conn = mysqli_connect("localhost", "root", "", "jewellery");
   ```

You're all set! Visit the site via [http://localhost/jewellery/index.html](http://localhost/jewellery/index.html)