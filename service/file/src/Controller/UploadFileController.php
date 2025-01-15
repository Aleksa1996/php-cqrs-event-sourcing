<?php

namespace App\Controller;

use Symfony\Component\Uid\Uuid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\Attribute\MapUploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UploadFileController extends AbstractController
{
    #[Route('/upload', name: 'app_upload_file', methods: [Request::METHOD_POST])]
    public function index(#[MapUploadedFile([new Assert\NotBlank(), new Assert\File(maxSize: '10M')])] UploadedFile $file, SluggerInterface $slugger): JsonResponse
    {
        $id = Uuid::v4()->toString();
        $file->move(sprintf('/var/www/html/public/files/%s', $id), $file->getClientOriginalName());

        return $this->json([
            'id' => $id,
            'file' => sprintf('http://file-service.local/files/%s/%s', $id, $file->getClientOriginalName()),
        ]);
    }
}
