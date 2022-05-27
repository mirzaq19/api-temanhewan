### Api untuk get data user -> /api/user/get
    - Example Headers: `{ Authorization: Bearer 1|XEg4gD0WWSLEPK2CBq4LTCjsVpski2FFEvnDX72B }`
    - Example Input : -
    - Example Success Output: 
      ```json
      {
         "success": true,
         "message": "success",
         "data": {
              "id": "05da1940-12e6-4bd4-9782-ea31a88b5f2c",
              "name": "Budi Kurniawan",
              "profile_image": "https://api-temanhewan.mirzaq.com/image/user_default.png",
              "birthdate": "1999-10-08",
              "username": "bkurniawan08",
              "gender": "m",
              "role": "doctor",
              "balance": 0,
              "email": "budi.kurniawan08@gmail.com",
              "address": "Sukolilo, Surabaya",
              "phone": "0822345323445"
         }
      }```