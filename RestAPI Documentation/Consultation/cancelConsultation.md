### API dimana user membatalkan janji konsultasi -> /api/consultation/cancel

- Example Header: `{ Authorization: Bearer 1|XEg4gD0WWSLEPK2CBq4LTCjsVpski2FFEvnDX72B }`

- Example Input: `{ "id": string }`

- Example Succes Output:

```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": "2ffb00f2-e6cc-47b9-8cb6-8c7304614627",
        "complaint": "kucing saya mager",
        "address": "Japan raya A. 20",
        "date": "2022-07-12",
        "time": "08:30",
        "fee": null,
        "status": "cancelled",
        "is_reviewed": false,
        "customer_id": "6b025fb5-d93d-4d72-8ef9-31ca9d57e19b",
        "doctor_id": "7c2da4c9-f8b4-4d47-99a7-24c56610c6df",
        "created_at": "2022-06-09 00:38:34",
        "updated_at": "2022-06-09 00:38:45"
    }
}
```