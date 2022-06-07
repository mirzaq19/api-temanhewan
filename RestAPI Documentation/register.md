### Api untuk register user -> /api/user/register

- Example Input: 
```json
{ 
    "name": string, 
    "profile_image": file, 
    "birthdate": date (ex: 2000-12-19), 
    "username": string, 
    "gender": string( "m" | "f"), 
    "role": string( "customer" | "doctor" | "grooming" ), 
    "email": string, 
    "password": string, 
    "password_confirmation": string, 
    "address": string, phone: string 
}
```

- Example Success Output: 

```json
{ 
    "status": true, 
    "message": success, 
    "User created successfully"
}
```