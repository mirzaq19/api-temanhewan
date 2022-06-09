### API untuk membuat jenis jasa layanan dari grooming -> /api/grooming/service/create

- Example Headers: `{ Authorization: Bearer 1|XEg4gD0WWSLEPK2CBq4LTCjsVpski2FFEvnDX72B }`

- Example Input: 

```json
{ 
    "name": string,
    "description": string,
    "price": string,
    "grooming_id": string
}
```

- Example Succes Output:

```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": "4a7c54f8-884c-4701-992e-b32720ded561",
        "name": "Layanan mandi plus untuk kucing",
        "description": "ini adalah layanan premium untuk kucing anda agar kucing selalu tampak bersih dan wangi",
        "price": "350000",
        "grooming_id": "ab6322e0-cdbb-4c68-a0e7-05e6da5013e4",
        "created_at": "2022-06-09 09:12:22",
        "updated_at": "2022-06-09 09:12:22"
    }
}
```