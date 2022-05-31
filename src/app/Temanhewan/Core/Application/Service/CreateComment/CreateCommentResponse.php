<?php

namespace App\Temanhewan\Core\Application\Service\CreateComment;

use App\Temanhewan\Core\Domain\Model\Comment;
use App\Temanhewan\Core\Domain\Model\User;
use JsonSerializable;

class CreateCommentResponse implements JsonSerializable
{
    public function __construct(
        private Comment $comment,
        private User $user,
        private array $commentImages
    ){}

    public function getProfileImageUrl(string $image): string
    {
        if ($image == 'user_default.png'){
            return asset('image/'. $image);
        }
        return asset('storage/user/profile_images/' . $image);
    }

    public function getCommentImageUrl(array $images): array
    {
        $response = [];
        foreach ($images as $image) {
            $response[] = asset('storage/user/comment_images/' . $image);
        }
        return $response;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->comment->getId()->id(),
            'content' => $this->comment->getContent(),
            'comment_images' => $this->getCommentImageUrl($this->commentImages),
            'author' => [
                'id' => $this->user->getId()->id(),
                'name' => $this->user->getName(),
                'username' => $this->user->getUsername(),
                'email' => $this->user->getEmail(),
                'avatar' => $this->getProfileImageUrl($this->user->getProfileImage()),
            ],
            'created_at' => $this->comment->getCreatedAt()->format('Y-m-d H:i:s'),
            'updated_at' => $this->comment->getUpdatedAt()->format('Y-m-d H:i:s'),
        ];
    }
}
