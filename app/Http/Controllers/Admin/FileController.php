<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\FileRelationException;
use App\Models\AdminNav;
use App\Models\File;
use App\Services\FileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class FileController extends AdminPageController
{
    private FileService $fileService;

    /**
     * @param FileService $fileService
     */
    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $generalPageData = $this->getGeneralPageData();
        $processedItems = $this->fileService->getAllFiles();
        $createUrl = route(AdminNav::ADMIN_FILES_CREATE);

        return response(view(
            'admin.pages.files.table',
            array_merge($generalPageData, ['items' => $processedItems, 'create_url' => $createUrl])
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        $generalPageData = $this->getGeneralPageData();
        $file = $this->fileService->createFile();
        $action = route(AdminNav::ADMIN_FILES_STORE);

        return response(view(
            'admin.pages.files.form',
            array_merge(
                $generalPageData,
                [
                    'file' => $file,
                    'action' => $action,
                ]
            )
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws \Exception
     */
    public function store(Request $request): RedirectResponse
    {
        if (!$request->hasfile('files')) {
            throw new BadRequestException();
        }

        $files = $request->file('files');
        $this->fileService->save($files);

        return redirect(route(AdminNav::ADMIN_FILES));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param File $file
     * @return RedirectResponse
     * @throws \Exception
     * @throws \Throwable
     */
    public function destroy(File $file): RedirectResponse
    {
        try {
            $this->fileService->delete($file);
        } catch (FileRelationException $fre) {
            //todo make beautiful exception
            return redirect(route(AdminNav::ADMIN_FILES));
        } catch (\Throwable $e) {
            throw $e;
        }


        return redirect(route(AdminNav::ADMIN_FILES));
    }
}
