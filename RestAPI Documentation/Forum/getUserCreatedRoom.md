### Api untuk, get User created forums -> /api/forum/my

- Example Header: `{ Authorization: Bearer 1|XEg4gD0WWSLEPK2CBq4LTCjsVpski2FFEvnDX72B }`

- Example Input: 

```json
{ 
    "offset": int,
    "limit": int 
}```

- Expected Success Output:

```json
{
    "success": true,
    "message": "success",
    "data": [
        {
            "id": "07e1f858-67e8-4551-a61a-9f4f1eeaa2b1",
            "slug": "how-to-create-api-login-in-laravel-with-sanctum-autentication",
            "title": "How to create api login in laravel with sanctum autentication",
            "subtitle": "create api login with sanctum authentication",
            "content": "Lorem ipsum dolor sit amet",
            "forum_images": [
                        "http://api.temanhewan.local/storage/user/forum_images/165348828494.png",
                        "http://api.temanhewan.local/storage/user/forum_images/165348828442.png",
                ]
        },
        {
            "id": "d41cb8e6-b588-41d8-93b1-d2df602dbe15",
            "slug": "how-can-i-generate-a-ad-preview-without-requiring-the-ad-account-id-in-the-facebook-ads-api",
            "title": "How can I generate a ad preview without requiring the ad account id in the Facebook Ads API?",
            "subtitle": "generate a ad preview without requiring the ad account id in the Facebook Ads API?",
            "content": "Though it is mentioned in the docs about generating a ",
            "forum_images": [
                        "http://api.temanhewan.local/storage/user/forum_images/165348843173.png",
                        "http://api.temanhewan.local/storage/user/forum_images/165348843157.png",
            ]
        }
    ]
}
```