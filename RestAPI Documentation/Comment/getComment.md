### API untuk mendapatkan data satu cooment -> /api/comment/get

- Example Input: `{ "comment_id": string }`

- Example Succes Output:

```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": "d0c045a7-3ebf-48a2-8510-c93a0808a965",
        "content": "halo tes komen",
        "comment_images": [],
        "author": {
            "id": "ab6322e0-cdbb-4c68-a0e7-05e6da5013e4",
            "name": "Petcarelia Grooming",
            "username": "petcareliag",
            "email": "petcarelia@gmail.com",
            "avatar": "https://api-temanhewan.mirzaq.com/image/user_default.png"
        },
        "created_at": "2022-06-08 14:03:45",
        "updated_at": "2022-06-08 14:03:45"
    }
}
```