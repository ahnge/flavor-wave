
# Flavor Wave

The solution to fix various problems affecting the FlavorWave company's data flow and operability.

One of the biggest problems of the FlavorWave is that there are inconsistencies in details of order and products between its five departments.

The app allows for the company's data to be flowed seamlessly with integrity across multiple departments.


## Installation


(1) Installing dependencies


```bash
  composer install
```

```bash
  npm install
```
(2)Run the project

```bash
  php artisan serve
```
```bash
  npm run dev
```

(2)Enable extensions gd, zip in php.ini config file.

```bash
  ;extension=gd
  ;extension=zip
```
Just remove the ";" .

Done!! The application should now be running on your localhost at port 8000.

(3)Edit Mail_Mailer and AWS configs in your .env file accordingly.

Change here-

```bash
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=yourusername
MAIL_PASSWORD=yourpassword
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=yourgmail
MAIL_FROM_NAME="your name"
```

And here-


```bash
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false
```
    
## Features

- Data tables
- Data charts
- Light/dark mode toggle
- Authenthication & Authorization
- Emails automation
- Alert Manager
- Preordering system
- Products and Preorders data manipulation


## Languages

PHP, Javascript, Mysql

## Tech Stack

Laravel Framework, JQuery, Gmail Service, Amazon S3 Bucket

## Authors

- [@ahnge](https://github.com/ahnge)
- [@HeinZarNe](https://github.com/HeinZarNe)
- [@LinnPyaePyae](https://github.com/LinnPyaePyae)
- [@inhibitor255](https://github.com/inhibitor255)
- [@Dede182](https://github.com/Dede182)
- [@WinThiha](https://github.com/WinThiha)
