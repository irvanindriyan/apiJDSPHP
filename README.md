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
    "nik": "1234567890123456",
    "password": "123456",
    "password_confirmation": "123456",
    "role_id": 1
}
result:
{
    "status": 200,
    "data": {
        "message": "Register user successful",
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGlqZHNwaHAuaGVyb2t1YXBwLmNvbVwvYXBpXC9zaWduX3VwIiwiaWF0IjoxNjQwMDY4NTIxLCJleHAiOjE2NDAwNzIxMjEsIm5iZiI6MTY0MDA2ODUyMSwianRpIjoiYXd4MUd2bWhhN3pPQXI4dCIsInN1YiI6MSwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.8GFLL1sIkNjasNO7wGU9bGLF7KbCio3cSJsW8LsV6Qs"
    }
}
```

endpoint Sign In
```sh
method: POST
url: https://apijdsphp.herokuapp.com/api/sign_in
param:
{
    "nik": "1234567890123456",
    "password": "123456",
}
result:
{
    "status": 200,
    "data": {
        "message": "Login successful",
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGlqZHNwaHAuaGVyb2t1YXBwLmNvbVwvYXBpXC9zaWduX2luIiwiaWF0IjoxNjQwMDY4NTkxLCJleHAiOjE2NDAwNzIxOTEsIm5iZiI6MTY0MDA2ODU5MSwianRpIjoiRWx4WlF4Wm04UVNBNTVxWiIsInN1YiI6MSwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.VCs4hiNeZaXdQmycKx6OVZrW-PPR4ceGHruPbPJAWi8"
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
        "jwt": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGlqZHNwaHAuaGVyb2t1YXBwLmNvbVwvYXBpXC91c2VyIiwiaWF0IjoxNjQwMDY4NjU1LCJleHAiOjE2NDAwNzIyNTUsIm5iZiI6MTY0MDA2ODY1NSwianRpIjoiZGZzbjhmREkwbXRlNWJwciIsInN1YiI6MSwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.MH3la1Yj0xuNpN3EIgOTZGKre1s-DLs89fEERWbesMg"
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
url: https://apijdsnode.herokuapp.com/api/fetch/data_order
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