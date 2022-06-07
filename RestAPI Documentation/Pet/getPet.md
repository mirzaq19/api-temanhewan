### Api untuk, get data User's pet -> /api/pet/get

- Example Headers: `{ Authorization: Bearer 1|XEg4gD0WWSLEPK2CBq4LTCjsVpski2FFEvnDX72B }`

- Example Input: `{ "id": string }`

- Expected Success Output: 

```json
{ 
    "status": true, 
    "message": success,
    "data": { 
                id, 
                name, 
                description, 
                race, 
                gender, 
                profile_image 
            } 
}
```