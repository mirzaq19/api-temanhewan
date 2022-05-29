<?php

namespace App\Temanhewan\Core\Application\Service\DeleteForumImage;

use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Repository\ForumRepository;
use Illuminate\Support\Facades\Storage;

class DeleteForumImageService
{
    public function __construct(
        private ForumRepository $forumRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(DeleteForumImageRequest $request): void
    {
        if(!$this->forumRepository->isForumImageExist($request->getImageName()))
            throw new TemanhewanException("Image not found",1024);

        $this->forumRepository->deleteForumImage($request->getImageName());

        if(Storage::disk('public')->exists('user/forum_images/' . $request->getImageName())){
            Storage::disk('public')->delete('user/forum_images/' . $request->getImageName());
        }
    }
}
