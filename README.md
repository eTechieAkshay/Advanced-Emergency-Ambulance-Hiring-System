# Advanced Emergency Ambulance Hiring System (AEAHP)

An advanced, full-stack emergency medical transit routing and ambulance booking platform designed with a premium, futuristic **Glassmorphic User Interface**. The system bridges the gap between critical patients and immediate life-support transportation by providing streamlined real-time hiring workflows.

---

## 🚀 Key Features

* **Futuristic Glassmorphic UI:** Built using raw custom CSS engine incorporating blur backplates, saturated glows, and high-contrast color palettes for a cutting-edge aesthetic.
* **Instant Booking System:** Smooth hiring workflows capturing patient details, relative emergency contacts with standard country code validations (+91), timestamps, and medical requirement choices.
* **Auto-Generated Booking Slips:** Instant unique booking numbers generated seamlessly for tracking application status.
* **Live Operational Dashboard:** Quick admin analytics with real-time dynamic counters reflecting Total Vehicles, New Requests, Approved Trips, and Rejected Cases.
* **Vehicle Inventory Control:** Full CRUD module for admin to onboard and manage different ambulance categories (BLS, ALS, NICU, and Patient Transport).
* **Booking Evaluation Engine:** Single-window console to process incoming requests and instantly filter records via an optimized search engine.

---

## 🛠️ Tech Stack

* **Front-end UI:** HTML5, Premium Vanilla CSS3 (No Frameworks/Tailwind for pixel-perfect structural control), Advanced JavaScript (ES6+), BootStrap v5 (Grid Core), and Custom SVG Graphics.
* **Back-end Core:** PHP (Procedural/Object Hybrid Structure) with Session state tracking.
* **Database Engine:** Relational MySQL Database Engine utilizing strict column structures (`tbladmin`, `tblambulance`, `tblambulancehiring`, `tblpage`).

---

## 🔧 Local Setup

1. Clone the repository into your local server directory (e.g., `htdocs` for XAMPP).
2. Create a database named `eahpdb` in **phpMyAdmin** and import the database SQL dump file.
3. Configure database credentials inside `includes/dbconnection.php`.
4. Run `http://localhost/[folder-name]/index.php` in your browser.
