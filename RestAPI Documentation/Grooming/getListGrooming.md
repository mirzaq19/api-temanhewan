### API untuk melihat list data grooming yang ada -> /api/grooming/list

- Example Input: 
```json
{   
    "offset": int,
    "limit": int
}
```

- Example Succes Output:

```json
{
    "success": true,
    "message": "success",
    "data": [
        {
            "id": "24a295c3-0ef2-4913-9806-03f59a3ff11b",
            "name": "noiceDANnoice",
            "avatar": "https://api-temanhewan.mirzaq.com/image/user_default.png",
            "email": "noice@gmail.com",
            "gender": "m",
            "address": "Jl. R.A basuni no.24, Kecamatan Sooko, Kabupaten Mojokerto",
            "phone": "085863856253",
            "rating": 0,
            "count_review": 0
        },
        {
            "id": "ab6322e0-cdbb-4c68-a0e7-05e6da5013e4",
            "name": "Petcarelia Grooming",
            "avatar": "https://api-temanhewan.mirzaq.com/image/user_default.png",
            "email": "petcarelia@gmail.com",
            "gender": "m",
            "address": "Jl. R.A basuni no.24, Kecamatan Sooko, Kabupaten Mojokerto",
            "phone": "085863856253",
            "rating": 0,
            "count_review": 0
        },
        {
            "id": "ab6322e0-cdbb-4c68-a0e7-05e6da5013e5",
            "name": "Penanam Tanaman",
            "avatar": "https://api-temanhewan.mirzaq.com/image/user_default.png",
            "email": "penanamtanaman@gmail.com",
            "gender": "m",
            "address": "Jl. R.A basuni no.24, Kecamatan Sooko, Kabupaten Mojokerto",
            "phone": "085863856253",
            "rating": 0,
            "count_review": 0
        }
    ]
}
```