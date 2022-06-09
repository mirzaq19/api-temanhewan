### API untuk melihat review dari suatu pesanan jasa grooming -> /api/grooming/order/review/get

- Example Input: `{"id": string}`

- Example Success Output:

```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": 2,
        "rating": 4,
        "review": "hasilnya sangat sungguh kinclong, sih. tapi...",
        "is_public": true,
        "customer_id": "6b025fb5-d93d-4d72-8ef9-31ca9d57e19b",
        "grooming_id": "ab6322e0-cdbb-4c68-a0e7-05e6da5013e4",
        "grooming_service_id": "93a13e9e-bb9e-48c1-9d10-81ae236d7c89",
        "grooming_order_id": "56a0e4af-5578-4992-9c9d-a53344587680",
        "created_at": "2022-06-09 10:14:20",
        "updated_at": "2022-06-09 10:14:20"
    }
}
```