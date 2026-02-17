# Installation Guide - Mon Portfolio

This guide will help you set up the Mon Portfolio application on your local machine or server.

## Table of Contents

1. [System Requirements](#system-requirements)
2. [Local Installation](#local-installation)
3. [Database Setup](#database-setup)
4. [Configuration](#configuration)
5. [Testing](#testing)
6. [Troubleshooting](#troubleshooting)
7. [Server Deployment](#server-deployment)

## System Requirements

- **PHP:** 7.4 or higher
- **MySQL:** 5.7 or higher (or MariaDB 10.2+)
- **Web Server:** Apache 2.4+, Nginx, or any PHP-compatible server
- **Extensions:**
  - PDO (PHP Data Objects)
  - mysqli extension
  - cURL (optional, for API calls)

## Local Installation

### Step 1: Clone the Repository

```bash
git clone https://github.com/gitpronk-coder/mon-profil-app.git
cd mon-profil-app
```

### Step 2: Set Up Environment Variables

```bash
# Copy the example environment file
cp .env.example .env

# Edit the .env file with your settings
nano .env  # or use your preferred editor
```

### Step 3: Install Dependencies (Optional)

If using Composer:

```bash
composer install
```

### Step 4: Create Database

#### Using Command Line:

```bash
# Create the database
mysql -u your_username -p your_password -e "CREATE DATABASE portfolio_db;"

# Import the schema
mysql -u your_username -p your_password portfolio_db < database/schema.sql
```

#### Using phpMyAdmin:

1. Open phpMyAdmin in your browser
2. Click on "New" to create a new database
3. Name it `portfolio_db`
4. Click "Create"
5. Select the new database
6. Go to "Import" tab
7. Choose `database/schema.sql` from your computer
8. Click "Import"

## Database Setup

### Create Database User (Recommended)

For security, create a dedicated database user:

```bash
mysql -u root -p
```

```sql
-- Create user
CREATE USER 'portfolio_user'@'localhost' IDENTIFIED BY 'secure_password';

-- Grant privileges
GRANT ALL PRIVILEGES ON portfolio_db.* TO 'portfolio_user'@'localhost';

-- Flush privileges
FLUSH PRIVILEGES;

-- Exit
EXIT;
```

### Verify Schema

After importing, verify the tables were created:

```bash
mysql -u portfolio_user -p portfolio_db
```

```sql
SHOW TABLES;
DESCRIBE users;
DESCRIBE projects;
DESCRIBE contacts;
DESCRIBE skills;
```

## Configuration

### Edit .env File

Update the following variables:

```env
# Database Configuration
DB_HOST=localhost
DB_USER=portfolio_user
DB_PASSWORD=secure_password
DB_NAME=portfolio_db
DB_PORT=3306

# Application Configuration
APP_DEBUG=true           # Set to false in production
APP_ENV=development      # Set to production when live
APP_URL=http://localhost
APP_NAME=Mon Portfolio

# Email Configuration (optional)
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_FROM=noreply@yourportfolio.com
```

### Configure Database Connection

Edit `config/config.php` to match your `.env` settings:

```php
<?php
return [
    'database' => [
        'host' => $_ENV['DB_HOST'] ?? 'localhost',
        'user' => $_ENV['DB_USER'] ?? 'root',
        'password' => $_ENV['DB_PASSWORD'] ?? '',
        'dbname' => $_ENV['DB_NAME'] ?? 'portfolio_db',
    ],
    'app' => [
        'debug' => $_ENV['APP_DEBUG'] ?? false,
        'url' => $_ENV['APP_URL'] ?? 'http://localhost',
    ],
];
?>
```

## Testing

### Local Development Server

Start PHP's built-in server:

```bash
php -S localhost:8000
```

Visit `http://localhost:8000` in your browser.

### Test Database Connection

Create a test file `test_connection.php`:

```php
<?php
require_once 'includes/Database.php';

db = new Database(['database' => [
    'host' => 'localhost',
    'user' => 'portfolio_user',
    'password' => 'your_password',
    'dbname' => 'portfolio_db'
]]);

$conn = $db->connect();

if ($conn) {
    echo "✓ Database connection successful!";
} else {
    echo "✗ Database connection failed!";
}
?>
```

Run it:
```bash
php test_connection.php
```

### Test Pages

1. Home Page: `http://localhost:8000/index.php`
2. About: `http://localhost:8000/pages/about.php`
3. Projects: `http://localhost:8000/pages/projects.php`
4. Skills: `http://localhost:8000/pages/skills.php`
5. Contact: `http://localhost:8000/pages/contact.php`

## Troubleshooting

### Issue: "PDO Exception: Connection failed"

**Solutions:**
- Verify MySQL is running: `mysql -u root -p`
- Check credentials in `.env` are correct
- Ensure the database exists: `SHOW DATABASES;`
- Check user has correct privileges

### Issue: "Fatal error: Class 'Database' not found"

**Solutions:**
- Verify file path in includes/
- Check PHP error logs
- Ensure all files are in correct directories
- Restart web server

### Issue: "Table doesn't exist" Error

**Solutions:**
- Verify schema was imported correctly
- Run: `mysql -u portfolio_user -p portfolio_db < database/schema.sql` again
- Check table names in error message

### Issue: "Permission denied" on files

**Solutions:**
```bash
# Make directories writable
chmod 755 .
chmod 755 config/
chmod 755 database/

# Make PHP files readable
chmod 644 *.php
chmod 644 includes/*.php
```

### Issue: Contact form not working

**Solutions:**
- Verify `contacts` table exists
- Check form validation in ContactForm.php
- Review browser console for JavaScript errors
- Check PHP error logs

## Server Deployment

### Using cPanel

1. Upload files via FTP/SFTP to `public_html/`
2. Create database via cPanel
3. Import schema
4. Update `.env` with server credentials
5. Set file permissions: `755` for directories, `644` for files

### Using Shared Hosting

1. Upload via FTP
2. Request PHP version 7.4+
3. Create MySQL database
4. Update configuration files
5. Test thoroughly

### Using Docker

Create a `docker-compose.yml`:

```yaml
version: '3.8'

services:
  php:
    image: php:7.4-apache
    volumes:
      - .:/var/www/html
    ports:
      - "8000:80"
    
  mysql:
    image: mysql:5.7
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: portfolio_db
    ports:
      - "3306:3306"
```

Run:
```bash
docker-compose up -d
```

## Post-Installation

1. **Change Default Passwords**
   - Update database user password
   - Set strong admin credentials

2. **Disable Debug Mode**
   - Set `APP_DEBUG=false` in production

3. **Set Up Backups**
   - Regularly backup database
   - Backup uploaded files

4. **Monitor Logs**
   - Check PHP error logs
   - Monitor database performance

5. **Update Regularly**
   - Keep PHP updated
   - Update database regularly

## Getting Help

- Check the [README.md](README.md) for more information
- Review GitHub Issues for known problems
- Contact support at support@example.com

---

**Last Updated:** 2026-02-17 08:52:26