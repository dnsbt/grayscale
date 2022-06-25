<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProjectRequest;
use App\Models\AdminNav;
use App\Models\Project;
use App\Services\FileService;
use App\Services\ProjectService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ProjectController extends AdminPageController
{
    private ProjectService $service;
    private FileService $fileService;

    /**
     * @param ProjectService $service
     * @param FileService $fileService
     */
    public function __construct(ProjectService $service, FileService $fileService)
    {
        $this->service = $service;
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
        $processedItems = $this->service->getAllProjects();
        $createUrl = route(AdminNav::ADMIN_PROJECTS_CREATE);

        return response(view(
            'admin.pages.project.table',
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
        $project = $this->service->createProject();
        $action = route(AdminNav::ADMIN_PROJECTS_STORE);
        $files = $this->fileService->getAllFiles();
        $fileList = [];
        foreach ($files as $file) {
            $fileItem = $file;
            $fileItem['url'] = $this->fileService->getPublicUrl($file['id']);
            $fileList[] = $file;
        }

        return response(
            view(
                'admin.pages.project.form',
                array_merge(
                    $generalPageData,
                    [
                        'project' => $project,
                        'action' => $action,
                        'files' => $fileList,
                    ]
                )
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjectRequest $request
     * @return RedirectResponse
     */
    public function store(ProjectRequest $request): RedirectResponse
    {
        $this->service->storeProject($request->title, $request->description, $request->file_id);

        return redirect(route(AdminNav::ADMIN_PROJECTS));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Project $project
     * @return Response
     */
    public function edit(Project $project): Response
    {
        $generalPageData = $this->getGeneralPageData();
        $action = route(AdminNav::ADMIN_PROJECTS_UPDATE, $project->id);
        $files = $this->fileService->getAllFiles();

        return response(
            view(
                'admin.pages.project.form',
                array_merge(
                    $generalPageData,
                    [
                        'project' => $project,
                        'action' => $action,
                        'files' => $files,
                    ]
                )
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProjectRequest $request
     * @param Project $project
     * @return RedirectResponse
     */
    public function update(ProjectRequest $request, Project $project): RedirectResponse
    {
        $this->service->updateProject($project, $request->title, $request->description, $request->file_id);

        return redirect(route(AdminNav::ADMIN_PROJECTS_EDIT, $project->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Project $project): RedirectResponse
    {
        $this->service->destroyProject($project);

        return redirect(route(AdminNav::ADMIN_PROJECTS));
    }
}
