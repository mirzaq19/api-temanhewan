### API untuk mengedit comment yang ada -> /api/comment/update

- Example Header: `{ Authorization: Bearer 1|XEg4gD0WWSLEPK2CBq4LTCjsVpski2FFEvnDX72B }`

- Example Input: 

```json
{ 
    "content": string,
    "forum_id": string,
    "comment_images": ?file
}
```
note: `comment_image` is optional and can be multiple

- Example Succes Output:

```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": "71456055-3b11-44a5-b93e-c83df258d60a",
        "content": "Halo test komen update",
        "comment_images": [],
        "author": {
            "id": "ab6322e0-cdbb-4c68-a0e7-05e6da5013e4",
            "name": "Petcarelia Grooming",
            "username": "petcareliag",
            "email": "petcarelia@gmail.com",
            "avatar": "https://api-temanhewan.mirzaq.com/image/user_default.png"
        },
        "created_at": "2022-06-08 22:35:50",
        "updated_at": "2022-06-08 22:36:10"
    }
}
```