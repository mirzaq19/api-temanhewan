### API untuk melihat review seorang dokter -> /api/doctor/reviews

- Example Input:

```json
{
    "doctor_id": string,
    "all": boolean
}
```
note: `all` is not urgent and is not primary either

- Example Succes Output:

```json
{
    "success": true,
    "message": "success",
    "data": []
}
```