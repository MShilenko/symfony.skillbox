<?php

namespace App\Service;


use League\Flysystem\FilesystemOperator;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{
    /**
     * @var SluggerInterface
     */
    private $slugger;
    /**
     * @var FilesystemOperator
     */
    private $filesystem;

    public function __construct(FilesystemOperator $articlesFilesystem, SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
        $this->filesystem = $articlesFilesystem;
    }

    public function uploadFile(File $file, ?string $oldFileName = null): string 
    {
        $fileName = $this->slugger
            ->slug(pathinfo($file instanceof UploadedFile ? $file->getClientOriginalName() : $file->getFilename(), PATHINFO_FILENAME))
            ->append('-' . uniqid())
            ->append('.' . $file->guessExtension())
            ->toString()
        ;
        
        $stream = fopen($file->getPathname(), 'r');
        $this->filesystem->writeStream($fileName, $stream);
        if (is_resource($stream)) {
            fclose($stream);
        }

        if (! $this->filesystem->fileExists($fileName)) {
            throw new \Exception("Не удалось записать файл: $fileName");
        }
        
        if ($oldFileName && $this->filesystem->fileExists($oldFileName)) {
            $this->filesystem->delete($oldFileName);

            if ($this->filesystem->fileExists($oldFileName)) {
                throw new \Exception("Ошибка удаления файла: $oldFileName");
            }
        }

        return $fileName;
    }
}
