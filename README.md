## Loan App

`` php artisan env:decrypt --key=3UVsEgGVK36XN82KKeyLFMhvosbZN1aF --env=production ``

#### On Linux

`` cp .env.production .env``


### Setup & Run

```
php artisan migrate --seed
php artisan serve
```

### API
Seed user data can be used for testing API endpoints.

```
Email: joe@website.com
Password: 123456
```

API collections in Postman are hosted at:

[Postman](https://documenter.getpostman.com/view/9759229/2s9YCBt94r)

### Frontend & Tests

1. I have calculator pages to test loan repayment calculation manually

```
<ip address>
```

2. I have created features test for testing loan repayment and monthly interest calculation functions

```
php artisan test
```
or

```
./vendor/bin/phpunit
```