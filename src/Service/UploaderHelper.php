<?php

namespace App\Service;
use Gedmo\Sluggable\Util\Urlizer;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemException;
use Symfony\Component\Asset\Context\RequestStackContext;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploaderHelper
{
    private Filesystem $filesystem;
    private RequestStackContext $requestStackContext;

    public function __construct(Filesystem $filesystem, RequestStackContext $requestStackContext)
    {
        $this->filesystem = $filesystem;
        $this->requestStackContext = $requestStackContext;
    }

    public function uploadFile(File $file, ?string $existingFilename): array
    {
        if ($file instanceof UploadedFile) {
            $originalFilename = $file->getClientOriginalName();
        } else {
            $originalFilename = $file->getFilename();
        }

        $newFilename = Urlizer::urlize(pathinfo($originalFilename, PATHINFO_FILENAME)).'-'.uniqid().'.'.$file->guessExtension();

        $stream = fopen($file->getPathname(), 'r');
        try {
            $this->filesystem->writeStream(
                $newFilename,
                $stream
            );
        } catch (FilesystemException $e) {
            throw new \Error($e);
        }

        if (is_resource($stream)) {
            fclose($stream);
        }

        if ($existingFilename) {
            try {
                $this->filesystem->delete($existingFilename);
            } catch (FilesystemException $e) {
                throw new \Error($e);
            }
        }

        return [
            'newFilename' => $newFilename,
            'size' => $file->getSize(),
            'type' => $file->getType(),
            'extension' => $file->getClientOriginalExtension(),
        ];
    }

    public function deleteFile(?string $existingFilename): string
    {
        if ($existingFilename) {
            try {
                $this->filesystem->delete($existingFilename);
                return true;
            } catch (FilesystemException $e) {
            }
        }

        return false;
    }

    public function getPublicPath(string $path): string
    {
        return $this->requestStackContext->getBasePath().'/uploads/'.$path;
    }

}
