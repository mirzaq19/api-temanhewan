### Api untuk, list User's pets -> /api/pet/list

- Example Headers: `{ Authorization: Bearer 1|XEg4gD0WWSLEPK2CBq4LTCjsVpski2FFEvnDX72B }`

- Example Input: 

```json
{ 
    "offset": int, 
    "limit": int 
}
```

- Expected Success Output: 

```json
{ 
    "status": true, 
    "message": success, 
    "data": 
        [ 
            { 
                id, 
                name, 
                description, 
                race, 
                gender, 
                profile_image 
            } 
        ]
}
```