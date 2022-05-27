### Api untuk, Add new my pet -> /api/pet/create
    - Example Headers: `{ Authorization: Bearer 1|XEg4gD0WWSLEPK2CBq4LTCjsVpski2FFEvnDX72B }`
    - Example Input: 
    ```json
    { 
        name: string, 
        profile_image: file, 
        description(optional): ?string, 
        race: string ("cat" | "dog"), 
        gender: string ("m" | "f") 
    }```
    - Expected Success Output: 
    ```json 
    { 
        status: true, 
        message: Pet Added Successfully, 
        data: { id, name, description, race, gender, profile_image }
    }```