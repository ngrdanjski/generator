<?php

namespace App\Controller;

use App\Service\UploaderHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UploadController extends AbstractController
{
    #[Route(path: '/api/v1/upload', name: 'app_upload', methods: ["POST"])]
    public function upload(Request $request, UploaderHelper $uploaderHelper): Response
    {
        $filename = $uploaderHelper->uploadImage($request->files->get('file'), null);

        return $this->json($filename);
    }

    #[Route(path: '/api/v1/delete/{filename}', name: 'app_delete', methods: ["POST"])]
    public function delete($filename, UploaderHelper $uploaderHelper): Response
    {
        $response = $uploaderHelper->deleteImage($filename);

        return $this->json($response);
    }
}
