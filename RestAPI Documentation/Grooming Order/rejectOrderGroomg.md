### API untuk groomer dapat menolak pesanan jasa grooming dari user -> /api/grooming/order/reject

- Example Header: `{ Authorization: Bearer 1|XEg4gD0WWSLEPK2CBq4LTCjsVpski2FFEvnDX72B }`

- Example Input: `{"id": string}`

- Example Success Output:

```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": "37b08c03-d1dc-4afc-b35c-50d922293195",
        "address": "Jl. bola volly A.20",
        "is_reviewed": false,
        "status": "rejected",
        "grooming_service_id": "93a13e9e-bb9e-48c1-9d10-81ae236d7c89",
        "pet_id": "5e864533-e06e-4475-835c-01174b53ba52",
        "customer_id": "6b025fb5-d93d-4d72-8ef9-31ca9d57e19b",
        "grooming_id": "ab6322e0-cdbb-4c68-a0e7-05e6da5013e4",
        "created_at": "2022-06-09 09:57:07",
        "updated_at": "2022-06-09 09:58:16"
    }
}
```