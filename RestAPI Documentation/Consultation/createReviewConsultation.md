### API untuk membuat review pada jan temu konsultasi -> /api/consultation/review/create

- Example Header: `{ Authorization: Bearer 1|XEg4gD0WWSLEPK2CBq4LTCjsVpski2FFEvnDX72B }`

- Example Input: 

```json
{
    "id": string,
    "rating": integer,
    "review": string,
    "is_public": boolean
}
```
note: `rating` only can do between number 1 until 5

- Example Succes Output:

```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": 4,
        "rating": 5,
        "review": "terimakasih anjing saya jadi hiperaktif",
        "is_public": true,
        "customer_id": "6b025fb5-d93d-4d72-8ef9-31ca9d57e19b",
        "doctor_id": "7c2da4c9-f8b4-4d47-99a7-24c56610c6df",
        "consultation_id": "b051b8e5-6fc0-4df1-9201-fdf720802dab",
        "created_at": "2022-06-09 00:56:24",
        "updated_at": "2022-06-09 00:56:24"
    }
}
```