# 🏥 CuraCare Doctor Appointment System

CuraCare is a web-based Doctor Appointment Management System designed to simplify the process of booking and managing doctor appointments for patients, doctors, and administrators.

The system is built using modern web technologies and follows structured development practices to ensure efficiency and usability.

---

## 🚀 Technologies Used

* 💻 PHP (Backend Logic)
* 🌐 HTML (Structure)
* 🎨 Bootstrap (UI Styling)
* ⚡ JavaScript (Client-side Interactivity)
* 🔄 AJAX (Asynchronous Data Handling)
* 🗄️ MySQL (Database)

---

## 📁 Project Setup Instructions

### 1. Extract Project

Extract the project folder and ensure the main directory name is:

```
Project
```

Place it inside:

```
C:\xampp\htdocs\
```

So the path becomes:

```
C:\xampp\htdocs\Project
```

---

### 2. Database Setup

* Open phpMyAdmin
* Create a database named:

```
edoc
```

* Import the file:

```
edoc_database.sql
```

---

## ⚙️ Server Configuration (Important Fix)

### CAPTCHA Issue Fix (GD Library Error)

If CAPTCHA is not loading and you get the error:

```
Call to undefined function imagecreate()
```

Follow these steps:

### Step 1: Open php.ini

```
C:\xampp\php\php.ini
```

### Step 2: Enable GD Extension

Find:

```
;extension=gd
```

Change to:

```
extension=gd
```

### Step 3: Restart Server

* Stop Apache in XAMPP
* Start Apache again

### Step 4: Test

Open:

```
http://localhost/Project/captcha.php
```

---

## 🔑 Demo Login Credentials

### 🧑 Patient Login

* Email: `patient@edoc.com`
* Password: `123`

---

### 🩺 Doctor Login

* Email: `smayankhospital@gmail.com`
* Password: `Niraj@123`

---

### 🛠️ Admin Login

* Email: `admin@doc.com`
* Password: `123`

---

## 👨‍⚕️ Viewing or Adding More Doctors

To add more doctor accounts:

* Open the `edoc` database
* Go to the `doctor` table
* Add new doctor email and password manually or 

All doctor credentials are stored in the database.

---

## ✨ Features

* Patient registration and login
* Doctor dashboard for managing appointments
* Admin panel for system control
* Appointment booking system
* CAPTCHA security for login
* Responsive UI using Bootstrap
* AJAX-based smooth interactions

---

## 📌 Note

This project is developed for academic purposes to demonstrate real-world software development using PHP, MySQL, and web technologies.

It helps understand:

* Database management
* Server-side programming
* Frontend-backend integration
* SDLC process implementation

---

## ⚠️ Important

* Ensure project folder name is **Project**
* Database name must be **edoc**
* GD extension must be enabled for CAPTCHA to work

