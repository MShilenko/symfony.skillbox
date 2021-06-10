<?php

namespace App\Service;

use Exception;
use League\Flysystem\FilesystemOperator;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
            throw new Exception(sprintf('Не удалось записать файл: %s', $fileName));
        }
        
        if ($oldFileName && $this->filesystem->fileExists($oldFileName)) {
            $this->filesystem->delete($oldFileName);

            if ($this->filesystem->fileExists($oldFileName)) {
                throw new Exception(sprintf('Ошибка удаления файла: %s', $oldFileName));
            }
        }

        return $fileName;
    }
}
