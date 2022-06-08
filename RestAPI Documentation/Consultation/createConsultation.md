### API untuk membuat janji temu konsultasi antar user dan dokter -> /api/consultation/create

- Example Header: `{ Authorization: Bearer 1|XEg4gD0WWSLEPK2CBq4LTCjsVpski2FFEvnDX72B }`

- Example Input: 

```json
{
    "complaint": string,
    "address": string,
    "date": date,
    "time": time,
    "doctor_id": string
}
```
note: `time` has regeq rule like this `'regex:/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/'` meaning is 2 first character is hour from 00 - 24 the second part is minute from 00-59

- Example Success Output:

```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": "e824da9b-d792-4c8e-8487-827f30a17650",
        "complaint": "kucing saya mager",
        "address": "Japan raya A. 20",
        "date": "2022-07-12",
        "time": "08:30",
        "fee": null,
        "status": "pending",
        "is_reviewed": false,
        "customer_id": "7c2da4c9-f8b4-4d47-99a7-24c56610c6df",
        "doctor_id": "0f1cb842-3375-4f9f-9a40-6305963862f8",
        "created_at": "2022-06-09 00:02:30",
        "updated_at": "2022-06-09 00:02:30"
    }
}
```