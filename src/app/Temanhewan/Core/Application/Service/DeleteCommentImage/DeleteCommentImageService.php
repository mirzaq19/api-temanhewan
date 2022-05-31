<?php

namespace App\Temanhewan\Core\Application\Service\DeleteCommentImage;

use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Repository\CommentRepository;
use Illuminate\Support\Facades\Storage;

class DeleteCommentImageService
{
    public function __construct(
        private CommentRepository $commentRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(DeleteCommentImageRequest $request): void
    {
        if(!$this->commentRepository->isCommentImageExist($request->getImageName()))
            throw new TemanhewanException("Image not found",1033);

        $this->commentRepository->deleteCommentImage($request->getImageName());

        if(Storage::disk('public')->exists('user/comment_images/' . $request->getImageName())){
            Storage::disk('public')->delete('user/comment_images/' . $request->getImageName());
        }
    }
}
