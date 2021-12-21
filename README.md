# instalasi

Configurasi database config in `.env`
```sh
DB_CONNECTION=mysql
DB_HOST={host}
DB_PORT={port}
DB_DATABASE={database}
DB_USERNAME={user}
DB_PASSWORD={password}
```

Install JWT package
```sh
$ composer require tymon/jwt-auth
```

Install Guzzle package
```sh
$ composer require guzzlehttp/guzzle:^7.0
```

Run Migration
```sh
$ php artisan migrate
```

Run Seed role
```sh
$ php artisan db:seed
```

# Rest API

endpoint Sign Up
```sh
method: POST
url: https://apijdsphp.herokuapp.com/api/sign_up
param:
{
    "nik": "{nik}",
    "password": "{password}",
    "password_confirmation": "{password}",
    "role_id": {1, 2} // 1 Admin 2 User
}
result:
{
    "status": 200,
    "data": {
        "message": "Register user successful",
        "token": "jwt token"
    }
}
```

endpoint Sign In
```sh
method: POST
url: https://apijdsphp.herokuapp.com/api/sign_in
param:
{
    "nik": "{nik}",
    "password": "{password}",
}
result:
{
    "status": 200,
    "data": {
        "message": "Login successful",
        "token": "jwt token"
    }
}
```

endpoint User
```sh
method: GET 
url: https://apijdsphp.herokuapp.com/api/user
header: 
{
    Authorization: Bearer {Token}
}
result:
{
    "status": 200,
    "data": {
        "nik": "1234567890123456",
        "role": "Admin",
        "jwt": "{jwt token}"
    }
}
```

endpoint Sign Out
```sh
method: GET
url: https://apijdsphp.herokuapp.com/api/sign_out
header: 
{
    Authorization: Bearer {Token}
}
result:
{
    "status": 200,
    "message": "User successfully signed out"
}
```

# Fetch Data

endpoint Data
```sh
method: GET
url: https://apijdsphp.herokuapp.com/api/data
header: 
{
    Authorization: Bearer {Token}
}
result:
{
    "status": 200,
    "data": [
        {
            "id": "1",
            "createdAt": "2021-06-09T09:37:05.527Z",
            "price": "218.00",
            "department": "Outdoors",
            "product": "Salad",
            "price_idr": "3,136,791.10"
        },
        ...
    ]
}
```

endpoint Data Order
```sh
method: GET
url: https://apijdsphp.herokuapp.com/api/data_order
header: 
{
    Authorization: Bearer {Token}
}
result:
{
    "status": 200,
    "data": [
        {
            "department": "Games",
            "product": "Computer",
            "price_idr": "57,555.80"
        },
        ...
    ]
}
```