### Api untuk, add new forum

- Example Input: 

```json
{ 
    "title": string,
    "subtitle": string,
    "content": string,
    "forum_images": ?file
}
```
`forum_image` merupakan opsional dan multiple

- Expected Success Output: 

```json
{ 
    "status": success,
    "message": success 
}
```