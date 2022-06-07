### API untuk update data Pet -> /api/pet/update

- Example Headers: `{ Authorization: Bearer 1|XEg4gD0WWSLEPK2CBq4LTCjsVpski2FFEvnDX72B }`

- Example Input : 

```json
{ 
    "id": string,
    "name": string,
    "race": string,
    "gender": string,
    "description": ?string ,
    "profil_image": ?file
}
```

- Expected Success Output: 

```json
{
    "success": true,
    "message": "Pet Added Successfully",
    "data": {
        "id": "cc611f10-018c-442b-b524-a3db39c784f5",
        "name": "bambang",
        "description": "kucing oren songong",
        "gender": "m",
        "race": "cat",
        "profile_image": "https://api-temanhewan.mirzaq.com/image/pet_default.png"
    }
}
```