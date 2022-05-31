<?php

namespace App\Temanhewan\Core\Application\Service\DeleteCommentImage;

class DeleteCommentImageRequest
{
    public function __construct(
        private string $image_name
    ){}

    /**
     * @return string
     */
    public function getImageName(): string
    {
        return $this->image_name;
    }
}
