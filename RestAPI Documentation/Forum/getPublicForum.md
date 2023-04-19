### Api untuk, get satu forum -> /api/forum/public

- Example Header: `{ Authorization: Bearer 1|XEg4gD0WWSLEPK2CBq4LTCjsVpski2FFEvnDX72B }`

- Example Input: 
```json
{   
    "offset": int,
    "limit": int
}
```

- Examples Success Output:
```json
{
    "success": true,
    "message": "success",
    "data": [
        {
            "id": "f6c3534a-253f-4b92-befd-2e332720fc58",
            "slug": "a-465",
            "title": "a",
            "subtitle": "a",
            "content": "a",
            "forum_images": [],
            "author": {
                "id": "ab6322e0-cdbb-4c68-a0e7-05e6da5013e4",
                "name": "Petcarelia Grooming",
                "username": "petcareliag",
                "email": "petcarelia@gmail.com",
                "avatar": "https://api-temanhewan.mirzaq.com/image/user_default.png"
            },
            "created_at": "2022-06-07 15:57:24",
            "updated_at": "2022-06-07 15:57:24"
        },
        {
            "id": "bcf961f4-881f-469b-bff9-e9c1fb061fcd",
            "slug": "how-to-create-api-login-in-laravel-with-sanctum-autentication-349",
            "title": "How to create api login in laravel with sanctum autentication using laravel 9",
            "subtitle": "create api login with sanctum authentication using laravel 9",
            "content": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam convallis vitae felis eu pharetra. Vestibulum porta nunc tortor, ut lacinia mauris venenatis facilisis. In quis fermentum velit, a sodales orci. Nulla scelerisque non felis nec iaculis. Mauris sit amet lacinia mauris, vitae dictum quam. Phasellus tempus tellus in turpis blandit finibus. Sed rhoncus vel purus sit amet maximus. Ut malesuada arcu sit amet eros auctor, quis ornare mauris cursus. Cras sed posuere nibh, non pulvinar augue. In ac metus et nibh condimentum pulvinar vitae sed mi.\n\nDonec id nisl luctus, placerat est dapibus, vehicula ante. Vivamus eget fringilla elit. Aliquam vel ex turpis. In in malesuada lectus, ac commodo dui. Mauris vestibulum non mauris id dapibus. Nulla vehicula erat sed est varius viverra. Praesent non eros nec dui volutpat rutrum sit amet eget enim. Mauris faucibus id sapien id condimentum. Pellentesque iaculis placerat eros, a pellentesque orci iaculis eget. In laoreet eleifend dui dictum pharetra. Nullam id est tortor.\n\nAenean bibendum aliquam ullamcorper. Vivamus nec auctor felis. Cras a dapibus leo, vitae imperdiet ipsum. Mauris faucibus nisi ut urna ornare, quis mattis mauris convallis. Fusce vulputate nunc nec odio tincidunt euismod. Nullam quis lacus elementum, fringilla lectus sed, aliquam nibh. Suspendisse et neque in orci pharetra vestibulum a sed urna. In mollis dictum auctor. Interdum et malesuada fames ac ante ipsum primis in faucibus.\n\nDuis sapien tellus, aliquam in metus nec, mollis tempor nulla. Sed consequat, lacus et suscipit posuere, massa ex vehicula libero, et semper sem purus nec enim. Phasellus accumsan sapien magna, quis luctus tortor congue ut. Donec et quam sem. Phasellus eget suscipit risus. Vestibulum pretium maximus massa eget lacinia. Donec semper tellus vitae est suscipit, id tempus purus finibus. Aliquam a tristique diam, in lobortis leo. Quisque a pretium lorem. In imperdiet, orci et luctus imperdiet, turpis lorem mollis nisi, nec feugiat quam mauris maximus massa. Donec vulputate ultricies mauris, id volutpat eros pharetra vel. Ut vitae dui sit amet orci scelerisque feugiat. Phasellus justo nisi, semper ut facilisis quis, pharetra eu elit. Sed a eleifend tortor.\n\nQuisque tempor ut diam id malesuada. Quisque interdum nisl in nisi aliquam pellentesque. Ut ut odio eget purus ultricies condimentum. Sed eu urna turpis. Phasellus cursus diam in sollicitudin tempor. Pellentesque id risus eros. Fusce aliquet vestibulum lorem sed fermentum. Integer rutrum neque erat, in suscipit magna porttitor id. Etiam rhoncus luctus risus, nec dictum tellus ultricies id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer interdum eros tempor elit faucibus congue. Nunc ac odio malesuada, malesuada arcu et, elementum odio.",
            "forum_images": [],
            "author": {
                "id": "ab6322e0-cdbb-4c68-a0e7-05e6da5013e4",
                "name": "Petcarelia Grooming",
                "username": "petcareliag",
                "email": "petcarelia@gmail.com",
                "avatar": "https://api-temanhewan.mirzaq.com/image/user_default.png"
            },
            "created_at": "2022-06-07 15:54:27",
            "updated_at": "2022-06-07 16:03:18"
        },
        {
            "id": "75d9799b-2395-4ab4-9f15-2cf65eec512b",
            "slug": "apakah-bisa-642",
            "title": "Apakah bisa?",
            "subtitle": "WEW bisa!!",
            "content": "mantapp!!",
            "forum_images": [],
            "author": {
                "id": "322b5070-bc2a-4104-be57-414bdff9d02d",
                "name": "HUSIN ASSEGAFF",
                "username": "husinassegaff15@gmail.com",
                "email": "husinassegaff15@gmail.com",
                "avatar": "https://api-temanhewan.mirzaq.com/image/user_default.png"
            },
            "created_at": "2022-06-05 22:29:33",
            "updated_at": "2022-06-05 22:29:33"
        },
        {
            "id": "c309f431-693c-4b16-bf29-c0dfbc4447b8",
            "slug": "test-109",
            "title": "test",
            "subtitle": "test1",
            "content": "test123",
            "forum_images": [],
            "author": {
                "id": "322b5070-bc2a-4104-be57-414bdff9d02d",
                "name": "HUSIN ASSEGAFF",
                "username": "husinassegaff15@gmail.com",
                "email": "husinassegaff15@gmail.com",
                "avatar": "https://api-temanhewan.mirzaq.com/image/user_default.png"
            },
            "created_at": "2022-06-05 22:21:52",
            "updated_at": "2022-06-05 22:21:52"
        },
        {
            "id": "954cfa81-5fa5-4521-a310-299361a213f0",
            "slug": "asdasd2-850",
            "title": "asdasd2",
            "subtitle": "asdasd2",
            "content": "asdasdasd",
            "forum_images": [],
            "author": {
                "id": "322b5070-bc2a-4104-be57-414bdff9d02d",
                "name": "HUSIN ASSEGAFF",
                "username": "husinassegaff15@gmail.com",
                "email": "husinassegaff15@gmail.com",
                "avatar": "https://api-temanhewan.mirzaq.com/image/user_default.png"
            },
            "created_at": "2022-06-04 22:47:34",
            "updated_at": "2022-06-04 22:47:34"
        }
    ]
}
```