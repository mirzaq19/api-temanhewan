### API undtuk mengganti User Password -> /api/user/change-password

- Example Header : `{Authorization : Bearer 68\LAExM4swI8sDWsmSaL36FzLu1qMFlir4uxATvr5w}`

- Example Input : 

```json
{ 
    "old_pasword": string,
    "password": string,
    "password_confirmation": string
}
```

- Example Output :

```json
{
    "success": true,
    "message": "success"
}
```