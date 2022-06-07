### API untuk medapatkan data public user -> /api/user/public

- Example Input : `{ "old_pasword": string}`

- Example Output :

```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": "0f1cb842-3375-4f9f-9a40-6305963862f8",
        "name": "M. Auliya Mirzaq Romdloni",
        "profile_image": "https://api-temanhewan.mirzaq.com/image/user_default.png",
        "birthdate": "2000-12-19",
        "username": "bkurniawan08",
        "gender": "m",
        "role": "doctor",
        "balance": 0,
        "email": "budi.kurniawan08@gmail.com",
        "address": "Perum Japan raya Jl. Bola volly A.20, Sooko, Mojokerto",
        "phone": "082234260055"
    }
}
```