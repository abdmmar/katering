# Hena Katering

Sistem Pemesanan Katering

### Requirements

1. XAMPP
2. [Composer](https://getcomposer.org/download/)

### Setup

1. Clone this repository in your htdocs folder
   `git clone https://github.com/abdmmar/katering.git`
2. Install all dependecies
   `composer install`
3. Open XAMPP, start Apache and MySQL
4. Open MySQL by click Admin button
5. Create new database with name `catering_order`
6. Go to import tab and import `catering_order.sql` file
7. Create `.env` file in class folder
8. Add `EMAIL` and `PASS` variable, see `.env.example` to more detail
9. Open `localhost/your_folder_name` in the browser to run system locally.
10. Happy developing!

### Get Current Setup

1. Go to your folder in htdocs
2. Open terminal
3. `git pull` to get the latest development
4. `composer install` to install dependencies
