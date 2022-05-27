### Api untuk login -> api/user/login
    - Example Input: `{ email: string, password: string}`
    - Example Success Output: 
    ```json
    { 
        success: true, 
        message: Success, 
        data: { 
           user:{
              "id": ...,
              "name": ...,
              "profile_image": ...,
              "birthdate": "2000-12-19",
              "username": "mirzaq19",
              "gender": "m",
              "role": "customer",
              "balance": 0,
              "email": ...,
              "email_verified_at": null,
              "address": "Japan raya, sooko, mojokerto",
              "phone": "082234260055",
              "created_at": "2022-05-22T01:10:51.000000Z",
              "updated_at": "2022-05-22T01:10:51.000000Z" 
              }, 
           access_token: 1|XEg4gD0WWSLEPK2CBq4LTCjsVpski2FFEvnDX72B, 
           token_type: Bearer 
        }
      }
      ```