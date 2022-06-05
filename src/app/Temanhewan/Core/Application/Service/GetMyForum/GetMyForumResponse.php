<?php

namespace App\Temanhewan\Core\Application\Service\GetMyForum;

use App\Temanhewan\Core\Domain\Model\Forum;
use App\Temanhewan\Core\Domain\Model\User;
use JsonSerializable;

class GetMyForumResponse implements JsonSerializable
{
    public function __construct(
        private User $user,
        private Forum $forum,
        private array $forumImages
    ){}

    public function getForumImageUrl(array $images): array
    {
        $response = [];
        foreach ($images as $image) {
            $response[] = asset('storage/user/forum_images/' . $image);
        }
        return $response;
    }

    public function getProfileImageUrl(string $name): string
    {
        if ($name == 'user_default.png'){
            return asset('image/'. $name);
        }
        return asset('storage/user/profile_images/' . $name);
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->forum->getId()->id(),
            'slug' => $this->forum->getSlug(),
            'title' => $this->forum->getTitle(),
            'subtitle' => $this->forum->getSubtitle(),
            'content' => $this->forum->getContent(),
            'forum_images' => $this->getForumImageUrl($this->forumImages),
            'author' => [
                'id' => $this->user->getId()->id(),
                'name' => $this->user->getName(),
                'username' => $this->user->getUsername(),
                'email' => $this->user->getEmail(),
                'avatar' => $this->getProfileImageUrl($this->user->getProfileImage()),
            ],
            'created_at' => $this->forum->getCreatedAt()->format('Y-m-d H:i:s'),
            'updated_at' => $this->forum->getUpdatedAt()->format('Y-m-d H:i:s'),
        ];
    }
}
