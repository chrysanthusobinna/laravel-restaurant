[Back to README](README.md)

# Deploy Laravel Project on Shared Host cPanel

 I recommend Namecheap Shared Host for this.
 Login Cpanel.


#### 1. **Set PHP Version**
   - Determine the PHP version required by your Laravel project (check `composer.json` or run `php -v` in your local environment).
   - Log in to cPanel and navigate to **"Select PHP Version"** under **Software**.

#### 2. **Create Database and User**
   - In cPanel, go to **MySQL Databases**.
   - Create a new database and user.
   - Assign the user to the database with all privileges.
   - Note down the database name, username, and password for later use in the `.env` file.

#### 3. **Show Hidden Files**
   - Open **File Manager** in cPanel.
   - Click **Settings** in the top-right corner and check **Show Hidden Files (dotfiles)**.
   - This will make files like `.env` and `.htaccess` visible.

#### 4. **Clear Laravel Cache (Locally)**
   - Before uploading the project, clear all caches locally:
     ```bash
     php artisan config:clear
     php artisan cache:clear
     php artisan view:clear
     php artisan route:clear
     ```
   - This ensures you don’t upload unnecessary cache files.

#### 5. **Prepare Project for Upload**
   - Zip your Laravel project files, excluding unnecessary files like `.git` or `node_modules` if not needed on the server.
   - Upload the zipped file to **`public_html`** via File Manager.

#### 6. **Move Files to `public_html`**
   - Extract the uploaded zip file.
   - Move the contents of the `public` folder (like `index.php`, `css`, `js`, etc.) to **`public_html`**:
     ```
     /home/yourusername/laravel_project_files
     /home/yourusername/public_html
     ```

#### 7. **Edit `index.php`**
   - Update paths in `public_html/index.php` to reflect the new directory structure:
     ```php
     // Change
     '/../storage/framework/maintenance.php'
     '/storage/framework/maintenance.php'

     // Change
     '/../vendor/autoload.php'
     '/vendor/autoload.php'

     // Change
     '/../bootstrap/app.php'
     '/bootstrap/app.php'
     ```

#### 8. **Create a `php.ini` File**
   - In File Manager, create a `php.ini` file in your root directory (`/home/yourusername/`).
   - Add necessary configurations like:
     ```ini
     extension=pdo_sqlsrv
     extension=sqlsrv
     ```

#### 9. **Update `.env` File**
   - Edit the `.env` file to match your server configuration:
     ```env
     APP_ENV=production
     APP_DEBUG=false
     APP_URL=https://yourdomain.com

     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=your_database_name
     DB_USERNAME=your_database_user
     DB_PASSWORD=your_database_password
     ```

#### 10. **Enable SSH Access**
   - Enable SSH access in Namecheap cPanel by clicking on **Manage SSH** and turning on **Enable SSH access**.
   - Click on **Terminal** to access the command line interface.

#### 11. **Run Composer Commands**
   - If SSH is enabled, run the following commands via the terminal:
     ```bash
     cd public_html
     composer install   # If dependencies are not installed
     composer update    # To update existing dependencies
     php artisan migrate
     php artisan db:seed --class=UserSeeder
     ```

#### 12. **Test Your Application**
   - Visit your domain (e.g., `https://yourdomain.com`) to verify the deployment.
   - If you encounter issues, check logs in `storage/logs/laravel.log` or enable debugging temporarily by setting `APP_DEBUG=true` in `.env`.

---
 