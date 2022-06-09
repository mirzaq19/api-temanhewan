### API untuk mengedit jenis jasa servis grooming yang sudah ada -> /api/grooming/service/update

- Example Headers: `{ Authorization: Bearer 1|XEg4gD0WWSLEPK2CBq4LTCjsVpski2FFEvnDX72B }`

- Example Input: 

```json
{ 
    "id": string,
    "name": string,
    "descriptiom": string,
    "price": string
}
```
note: `price` only number input

- Example Suuces Output:

```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": "93a13e9e-bb9e-48c1-9d10-81ae236d7c89",
        "name": "Layanan mandi plus untuk kucing (Promo)",
        "description": "ini adalah layanan premium untuk kucing anda agar kucing selalu tampak bersih dan wangi. Layanan ini sedang promo, akan mendapatkan sabun mandi kucing gratis",
        "price": "380000",
        "grooming_id": "ab6322e0-cdbb-4c68-a0e7-05e6da5013e4",
        "created_at": "2022-06-05 06:55:05",
        "updated_at": "2022-06-09 09:15:52"
    }
}
```