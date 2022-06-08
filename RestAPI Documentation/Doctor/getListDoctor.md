### API untuk melihat list doktor-doktor yang ada -> /api/doctor/list

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
            "id": "0f1cb842-3375-4f9f-9a40-6305963862f8",
            "name": "M. Auliya Mirzaq Romdloni",
            "avatar": "https://api-temanhewan.mirzaq.com/image/user_default.png",
            "email": "budi.kurniawan08@gmail.com",
            "gender": "m",
            "address": "Perum Japan raya Jl. Bola volly A.20, Sooko, Mojokerto",
            "phone": "082234260055",
            "rating": 5,
            "count_review": 1
        }
    ]
}
```