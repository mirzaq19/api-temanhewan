### API untuk dokter menyetujui konsultasi -> /api/consultation/accept

- Example Header: `{ Authorization: Bearer 1|XEg4gD0WWSLEPK2CBq4LTCjsVpski2FFEvnDX72B }`

- Example Input: 

```json
{
    "id": string,
    "fee": string
}
```

- Example Succes Output:

```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": "8dbe1591-91c8-437b-8e50-7ee86dfb9dcf",
        "complaint": "kucing saya mager",
        "address": "Japan raya A. 20",
        "date": "2022-07-12",
        "time": "08:30",
        "fee": 120000,
        "status": "accepted",
        "is_reviewed": false,
        "customer_id": "7c2da4c9-f8b4-4d47-99a7-24c56610c6df",
        "doctor_id": "7c2da4c9-f8b4-4d47-99a7-24c56610c6df",
        "created_at": "2022-06-09 00:13:54",
        "updated_at": "2022-06-09 00:14:20"
    }
}
```