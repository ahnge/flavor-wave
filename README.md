# Main Page
![Main Ui](https://github.com/ahnge/flavor-wave/blob/develop/public/assets/highlights/main.png)

# Well Designed Table
![Main Ui](https://github.com/ahnge/flavor-wave/blob/develop/public/assets/highlights/show.png)

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

(2)Migration and seeding


Configure your database in the .env file.otherwise copy .env.example .


Then, run the following command -


 ```bash
  php artisan migrate —seed
```

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

(4)Enable extensions gd, zip in php.ini config file.

```bash
  ;extension=gd
  ;extension=zip
```
Just remove the ";" .


(5)Run the project

```bash
  php artisan serve
```
```bash
  npm run dev
```

Done!! The application should now be running on your localhost at port 8000.

## Accounts

(1)Admin Accounts

- sale@gmail.com
- warehouse@gmail.com
- truckdriver@gmail.com
- logistic@gmail.com

  Default password is 12345678 for all admin accounts.
  Login route for admin accounts is '/admin'.


(2)Distributor Account

- test@gmail.com

  Default password is "password".

  Or just register to create a distributor account.
  Login route for distributors is '/login'.

    
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

Laravel Framework, JQuery, Gmail Service, Amazon S3 Bucket , Flowbite , Tailwind

## Authors

- [@ahnge](https://github.com/ahnge)
- [@HeinZarNe](https://github.com/HeinZarNe)
- [@LinnPyaePyae](https://github.com/LinnPyaePyae)
- [@inhibitor255](https://github.com/inhibitor255)
- [@Dede182](https://github.com/Dede182)
- [@WinThiha](https://github.com/WinThiha)
