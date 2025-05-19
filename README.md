```
php artisan key:generate
php artisan jwt:secret
php artisan migrate --seed
php artisan serve
```

Documentation
Booking
----------------------------

POST<br>
Log in<br>
http://localhost:8000/api/auth/login<br>
{
    "email" : "user@mail.com",
    "password": "123456"
}

-------------------------
Housing <br>
Authorization Bearer Token <br>
GET<br>
list<br>
http://localhost:8000/api/housings?search=a

--------------------------

Authorization: Bearer Token<br>
GET<br>
view<br>
http://localhost:8000/api/housings/1

---------------------------
Authorization: Bearer Token<br>
POST<br>
create<br>
http://localhost:8000/api/housings<br>

{
    "name": "a",
    "address": "b"
}

---------------------------
PUT<br>
update<br>
http://localhost:8000/api/housings/1

Authorization: Bearer Token<br>

{
    "name": "c",
    "address": "d"
}

-----------------------------
DELETE<br>
delete<br>
http://localhost:8000/api/housings/1
Authorization: Bearer Token<br>

-------------------------
Booking

GET<br>
list<br>
http://localhost:8000/api/bookings?sort_by=check_in&sort_dir=desc


Authorization:Bearer Token

Query Params:<br>
search<br>
check_in_from<br>
check_in_to<br>
check_out_from<br>
check_out_to<br>
sort_by<br>
check_in<br>
sort_dir<br>
desc<br>

---------------------
POST
create
http://localhost:8000/api/bookings

Authorization: Bearer Token

{
    "housing_id": 2,
    "check_in": "2025-01-03 12:00:00",
    "check_out": "2025-01-04 14:00:00"
}

-------------------------------
Comment<br>
Authorization: Bearer Token<br>
GET<br>
List<br>
http://localhost:8000/api/bookings/1/comments<br>

--------------------------------------------

Authorization: Bearer Token<br>
POST<br>
create<br>
http://localhost:8000/api/bookings/1/comments<br>

{
    "text": "bla bla"
}
