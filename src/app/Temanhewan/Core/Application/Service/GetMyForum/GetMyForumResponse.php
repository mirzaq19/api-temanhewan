<?php

namespace App\Temanhewan\Core\Application\Service\GetMyForum;

use App\Temanhewan\Core\Domain\Model\Forum;
use JsonSerializable;

class GetMyForumResponse implements JsonSerializable
{
    public function __construct(
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

    public function jsonSerialize()
    {
        return [
            'id' => $this->forum->getId()->id(),
            'slug' => $this->forum->getSlug(),
            'title' => $this->forum->getTitle(),
            'subtitle' => $this->forum->getSubtitle(),
            'content' => $this->forum->getContent(),
            'forum_images' => $this->getForumImageUrl($this->forumImages),
            'created_at' => $this->forum->getCreatedAt()->format('Y-m-d H:i:s'),
            'updated_at' => $this->forum->getUpdatedAt()->format('Y-m-d H:i:s'),
        ];
    }
}
