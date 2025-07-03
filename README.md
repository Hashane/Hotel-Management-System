# Hotel Reservation & Management System (HRMS)

> A comprehensive web-based solution for hotel operations, built with Laravel and Bootstrap.

![Hotel Management System](logo.png)

[![Last Commit](https://img.shields.io/github/last-commit/Hashane/Hotel-Management-System)](https://github.com/Hashane/Hotel-Management-System/commits)
[![Stars](https://img.shields.io/github/stars/Hashane/Hotel-Management-System?style=social)](https://github.com/Hashane/Hotel-Management-System/stargazers)
[![Forks](https://img.shields.io/github/forks/Hashane/Hotel-Management-System?style=social)](https://github.com/Hashane/Hotel-Management-System/network/members)
[![Issues](https://img.shields.io/github/issues/Hashane/Hotel-Management-System)](https://github.com/Hashane/Hotel-Management-System/issues)

---

## ✨ Overview

The **Hotel Reservation and Management System (HRMS)** is a web-based platform developed for managing the full cycle of hotel operations. Designed for single-hotel setups, it offers features for:

* Room reservations and availability
* Check-ins and check-outs
* Billing and invoice generation
* Multi-role access and dashboards
* Travel company group bookings
* Long-term suite bookings (weekly/monthly)
* Detailed reporting for revenue and occupancy

Supported roles:

* **Customer** – Browses and books rooms
* **Clerk** – Manages check-ins/outs and assigns rooms
* **Manager** – Accesses reports and controls operations
* **Travel Company** – Makes group reservations with automated discounts

---

## 🔑 Key Features

### 🛏️ Reservation Module

* Room browsing by category/sub-category
* Online bookings with optional credit card
* Mandatory upfront payment for confirmation
* Automated cancellation of no-shows (non-refundable)

### 🧾 Check-In / Check-Out

* Real-time room assignment on check-in
* Check-in allowed only for fully paid reservations
* Additional charges added during checkout

### 💵 Billing System

* Itemized invoices auto-generated
* Travel companies receive grouped billing for reservations

### 📈 Reporting Module

* Occupancy and revenue reports by date
* Export in PDF/CSV formats for audits and presentations

### 🏠 Residential Suites

* Custom logic for long-term suite rentals
* Supports weekly and monthly billing cycles

### 🔐 Role-Based Access Control

* Secure login and route permissions per user role
* Clerks and managers have access to internal tools
* Customers access only their data

---

## 🧱 System Design

### Architecture

* **MVC Three-Tier**

  * UI: Blade with Bootstrap
  * Logic: Laravel Controllers, Services
  * Database: MySQL with Eloquent ORM

### Design Principles

* SOLID principles and DRY code
* Modular Services (e.g. `ReservationService`, `InvoiceService`)
* Enums for business logic (`BookingStatus`, `RoomType`)
* Helpers for common utilities and validation

### Visual Modeling

* Use Case Diagrams
* ER Diagrams, Class Diagrams, Flowcharts
* Gantt Charts for timeline planning
* SWOT analysis to refine scope

---

## ⚙️ Tech Stack

| Layer    | Technology          |
| -------- | ------------------- |
| Backend  | Laravel 12 (PHP)    |
| Frontend | Blade, Bootstrap 5  |
| Database | MySQL 8             |
| Tools    | PhpStorm,Git, Figma, Postman |

---

## 🚀 Getting Started

### Installation

```bash
git clone /Hashane/Hotel-Management-System.git
cd Hotel-Management-System
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
npm run dev
```

### Seeding Demo Data

```bash
php artisan db:seed
```

---

## 🧪 Example Use Cases

* Grouped room browsing (e.g. "Deluxe – King Lake View")
* One card per room group with count of available rooms
* Detailed view and booking form shown upon selection
* Admin dashboard with metrics on revenue, occupancy, etc.
* Cron job detects and cancels no-shows nightly

---

## 👤 Target Users

* Small hotel and resort owners
* Travel agencies booking on behalf of clients
* Front-desk clerks and hotel managers

---

## 📘 License

Licensed under the [MIT License](LICENSE).

---

## 🤝 Contributing

Pull requests and suggestions are welcome. New features or improvements are encouraged!

---

## 📬 Contact

Maintained by [Jude Hashane](https://www.linkedin.com/in/judehashane)

> **“Booking simplified. Hotel management redefined.”**
