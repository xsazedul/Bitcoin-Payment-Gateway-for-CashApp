<div align="center">
# ⚡ Bitcoin Payment Gateway for Cash App

A production-ready Bitcoin Lightning payment gateway built with PHP and MySQL, enabling businesses to accept Bitcoin Lightning payments from compatible wallets, including Cash App.

Designed with a premium Cash App-style interface, Lightning Pay converts USD amounts into Lightning invoices in real-time using the OpenNode API.

---

![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Lightning](https://img.shields.io/badge/Bitcoin-Lightning-F7931A?style=for-the-badge&logo=bitcoin&logoColor=white)
![OpenNode](https://img.shields.io/badge/OpenNode-API-blue?style=for-the-badge)
![License](https://img.shields.io/badge/License-MIT-success?style=for-the-badge)

</div>

---

# ✨ Features

## 💵 USD to Bitcoin Lightning

- Accept payments in USD
- Automatic BTC conversion
- Live Lightning invoice generation
- QR Code generation
- Lightning payment request

---

## ⚡ Real-Time Payment Detection

- Automatic payment polling
- Instant payment confirmation
- Live checkout updates
- Payment status synchronization

---

## 📊 Admin Dashboard

- Total Revenue
- Total Payments
- Invoice History
- Payment Analytics
- Transaction Logs

---

## 🔐 Security

- PDO Prepared Statements
- SQL Injection Protection
- BCrypt Password Hashing
- OpenNode Webhook Verification
- HMAC Signature Validation
- CSRF Protection
- Secure Session Management
- Environment Variables (.env)

---

## 🎨 Modern User Interface

- Cash App Inspired Design
- Glassmorphism Components
- Dark Theme
- Mobile Responsive
- Premium Dashboard
- Smooth Animations

---

# 🛠 Tech Stack

| Technology | Version |
|------------|----------|
| PHP | 8.1+ |
| MySQL | 8+ |
| HTML5 | Latest |
| CSS3 | Latest |
| JavaScript | ES6+ |
| OpenNode API | Latest |

---

# 📂 Project Structure

# 📂 Project Structure

```text
Bitcoin-Payment-Gateway-for-CashApp/
│
├── app/                    # Core application logic
│   ├── Controllers/
│   ├── Models/
│   ├── Services/
│   ├── Helpers/
│   └── Core/
│
├── public/                 # Public assets
│   ├── css/
│   ├── js/
│   ├── images/
│   └── assets/
│
├── views/                  # Frontend templates
│
├── .env                    # Environment configuration
├── .htaccess               # Apache rewrite rules
├── api_error.log           # API error log
├── fix_db.php              # Database repair utility
├── index.php               # Application entry point
├── install.php             # Installation wizard
├── LICENSE                 # MIT License
├── nginx.conf.example      # Nginx configuration example
├── sql.sql                 # Database schema
└── README.md               # Project documentation
```


---

# 🚀 Installation

## 1. Clone Repository

```bash
git clone https://github.com/xsazedul/Bitcoin-Payment-Gateway-for-CashApp.git
```

---

## 2. Enter Project

```bash
cd Bitcoin-Payment-Gateway-for-CashApp
```

---

## 3. Create Database

```
Database Name

lightning_pay
```

Import:

```
sql.sql
```

---

## 4. Configure Environment

Create a `.env`

```env
APP_NAME=Lightning Pay

DB_HOST=localhost
DB_NAME=lightning_pay
DB_USER=root
DB_PASS=password

OPENNODE_API_KEY=YOUR_API_KEY
OPENNODE_ENVIRONMENT=live
```

---

## 5. Configure Web Server

Apache or Nginx

Point your web root to the project directory.

---

## 6. Configure OpenNode Webhook

Webhook URL

```
https://your-domain.com/api/webhook
```

Lightning Pay automatically verifies webhook signatures using HMAC.

---

# 🔑 Default Admin Login

```
URL

/admin/login
```

Username

```
admin
```

Password

```
admin123
```

⚠ **Change the default password before using in production.**

---

# 💳 Payment Flow

```
Customer

↓

Enter USD Amount

↓

Create Lightning Invoice

↓

Generate QR Code

↓

Customer Pays / Using CashApp

↓

OpenNode Webhook

↓

Payment Verification

↓

Invoice Paid

↓

Dashboard Updated
```

---

# 🔒 Security Features

- SQL Injection Protection
- Prepared Statements
- Environment Variables
- Secure Password Hashing
- Session Security
- HMAC Verification
- Webhook Validation
- Input Sanitization
- Output Escaping

---

# 📱 Responsive Design

Optimized for:

- Desktop
- Laptop
- Tablet
- Mobile

---

# 📸 Screenshots

```
Coming Soon
```

---

# 📈 Roadmap

- Multi-Currency Support
- Multi-Merchant Accounts
- Invoice Export
- API Authentication
- Email Notifications
- Telegram Notifications
- Payment Analytics
- Multi-language Support
- Theme Customization

---

# 🤝 Contributing

Contributions are welcome.

1. Fork the repository

2. Create a feature branch

```bash
git checkout -b feature/new-feature
```

3. Commit your changes

```bash
git commit -m "Add new feature"
```

4. Push

```bash
git push origin feature/new-feature
```

5. Open a Pull Request

---

# 📄 License

This project is licensed under the MIT License.

---

# ⭐ Support

If you find this project useful, consider giving it a ⭐ on GitHub.

---

<div align="center">

## ⚡ Built with PHP, Bitcoin Lightning & OpenNode

Made for developers who want a modern, secure and production-ready Lightning payment gateway.

</div>
