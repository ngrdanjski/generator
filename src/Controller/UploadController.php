<?php

namespace App\Controller;

use App\Entity\Media;
use App\Service\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UploadController extends AbstractController
{
    const UPLOAD_PATH = '/uploads/';

    #[Route(path: '/api/v1/upload', name: 'app_upload', methods: ["POST"])]
    public function upload(Request $request, UploaderHelper $uploaderHelper, EntityManagerInterface $entityManager): Response
    {
        $filename = $uploaderHelper->uploadFile($request->files->get('file'), null);

        $media = new Media();
        $media->setFileName($filename['newFilename']);
        $media->setPath(self::UPLOAD_PATH . $filename['newFilename']);
        $media->setSize($filename['size']);

        $entityManager->persist($media);
        $entityManager->flush();

        return $this->json($filename);
    }

    #[Route(path: '/api/v1/delete/{filename}', name: 'app_delete', methods: ["POST"])]
    public function delete($filename, UploaderHelper $uploaderHelper): Response
    {
        $response = $uploaderHelper->deleteFile($filename);

        return $this->json($response);
    }
}
