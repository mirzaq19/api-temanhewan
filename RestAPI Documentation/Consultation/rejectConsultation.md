### API dimana dokter menolak janji konsultasi -> /api/consultation/reject

- Example Header: `{ Authorization: Bearer 1|XEg4gD0WWSLEPK2CBq4LTCjsVpski2FFEvnDX72B }`

- Example Input: `{ "id": string }`

- Example Succes Output:

```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": "e45131a6-d273-4c96-95c3-4d477a66d11c",
        "complaint": "kucing saya mager",
        "address": "Japan raya A. 20",
        "date": "2022-07-12",
        "time": "08:30",
        "fee": null,
        "status": "rejected",
        "is_reviewed": false,
        "customer_id": "7c2da4c9-f8b4-4d47-99a7-24c56610c6df",
        "doctor_id": "7c2da4c9-f8b4-4d47-99a7-24c56610c6df",
        "created_at": "2022-06-09 00:30:16",
        "updated_at": "2022-06-09 00:30:45"
    }
}
```