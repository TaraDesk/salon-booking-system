# Salon Booking System

## Overview

The **Salon Booking System** is a Laravel-based web application that simplifies salon appointment management for both staff and clients. It offers user authentication, role-based access, appointment booking, and service management, all within a clean and responsive interface.

## Features

* **User Authentication**: Secure registration and login system.
* **Role-Based Access**:

  * **Admin**: Access to dashboard, manage services, view and manage all appointments.
  * **Client**: Access to public booking interface, personal appointment history, and profile.
* **Appointment Management**:

  * Book, reschedule, or cancel appointments.
  * View upcoming and past bookings.
* **Service Management** (Admin only): Add, update, and delete salon services (e.g., haircut, coloring).
* **Interactive Alerts**: SweetAlert integration for confirmations and notifications.
* **Responsive Design**: Modern UI using Tailwind CSS for a seamless experience on all devices.
* **Icons**: Lucide icons used for interface elements and action buttons.

## Technologies Used

* **Frontend**: Tailwind CSS, Lucide Icons, SweetAlert
* **Backend**: Laravel (PHP)
* **Database**: SQLite

## Installation

### Clone the Repository

```bash
git clone https://github.com/your-username/salon-booking-system.git
cd salon-booking-system
```

### Install Dependencies

```bash
composer install
npm install && npm run dev
```

### Setup Environment

1. Copy the `.env` file:

   ```bash
   cp .env.example .env
   ```
2. Update the `.env` file with your local database details.

### Generate Application Key

```bash
php artisan key:generate
```

### Setup Database

1. Create a new database.
2. Run migrations and seed the database:

   ```bash
   php artisan migrate:fresh --seed
   ```

### Run the Application

```bash
php artisan serve
```

Open in your browser:
[http://localhost:8000](http://localhost:8000)

## Usage

* **Register an Account**: New users can sign up with an email and password.
* **Login**: Use credentials to access the system.
* **Client Features**:
  * View available services.
  * Book a salon appointments.
  * Access appointment history and profile.
* **Admin Features**:
  * Access admin dashboard.
  * Manage all appointments and services.
  * View registered users and system metrics.