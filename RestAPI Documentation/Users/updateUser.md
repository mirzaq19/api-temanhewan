### Api untuk update data user -> /api/user/update

- Example Headers: `{ Authorization: Bearer 1|XEg4gD0WWSLEPK2CBq4LTCjsVpski2FFEvnDX72B }`

- Example Input: 

```json
{ 
    "name": string,
    "profile_image": file,
    "birthdate": date (ex: 2000-12-19),
    "address": string,
    "phone": string 
}
```

- Example Success Output:

```json
{ 
    "status": true, 
    "message": "success"
}
```

note: Example successful output is same as other roles