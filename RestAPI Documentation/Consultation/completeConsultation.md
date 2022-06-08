### API untuk menyelesaikan pembayaran -> /api/consultation/complete

- Example Header: `{ Authorization: Bearer 1|XEg4gD0WWSLEPK2CBq4LTCjsVpski2FFEvnDX72B }`

- Example Input: `{ "id": string }`

- Example Succes Output:

```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": "b051b8e5-6fc0-4df1-9201-fdf720802dab",
        "complaint": "kucing saya mager",
        "address": "Japan raya A. 20",
        "date": "2022-07-12",
        "time": "08:30",
        "fee": 999999,
        "status": "completed",
        "is_reviewed": false,
        "customer_id": "6b025fb5-d93d-4d72-8ef9-31ca9d57e19b",
        "doctor_id": "7c2da4c9-f8b4-4d47-99a7-24c56610c6df",
        "created_at": "2022-06-09 00:23:23",
        "updated_at": "2022-06-09 00:26:05"
    }
}
```