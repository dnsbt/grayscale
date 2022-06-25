<?php

namespace App\Services;

use App\Exceptions\FileRelationException;
use App\Http\Requests\FileRequest;
use App\Models\AdminNav;
use App\Models\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService
{
    /**
     * @todo remake it on config
     */
    private const DISC = 'public';

    /**
     * @return File
     */
    public function createFile(): File
    {
        return new File();
    }

    /**
     * @param UploadedFile $uploadedFile
     * @return File
     * @throws \Exception
     */
    public function save(UploadedFile $uploadedFile): File
    {
        $fileName = microtime(true) . '.' . $uploadedFile->getClientOriginalName();
        $path = Storage::disk(self::DISC)
            ->putFileAs('uploads', $uploadedFile, $fileName, 'public');
        if ($path === false) {
            throw new \Exception('error file saving on fs');
        }
        $file = $this->createFile();
        $file->name = $fileName;
        $file->path = $path;
        $file->save();

        return $file;
    }

    /**
     * @return array
     */
    public function getAllFiles(): array
    {
        $items = File::all();
        $processedItems = [];

        foreach ($items as $item) {
            $processedItems[$item->id] = $item->toArray();

            $processedItems[$item->id]['edit_url'] = route(AdminNav::ADMIN_FILES_EDIT, [$item->id]);
            $processedItems[$item->id]['delete_url'] = route(AdminNav::ADMIN_FILES_DELETE, [$item->id]);
        }

        return $processedItems;
    }

    /**
     * @param File $file
     * @return bool
     * @throws FileRelationException
     * @throws \Throwable
     */
    public function delete(File $file): bool
    {
        try {
            if ($file->delete()) {
                return Storage::disk(self::DISC)->delete($file->path);
            }
        } catch (\Throwable $e) {
            if ($e->getCode() === '23000') {
                throw new FileRelationException($e->getMessage());
            }
            throw $e;
        }

        return false;
    }

    /**
     * @param int $fileId
     * @return string
     */
    public function getPublicUrl(int $fileId): string
    {
        /** @var File $file */
        $file = File::findOrFail($fileId);

        return Storage::url($file->path);
    }
}
