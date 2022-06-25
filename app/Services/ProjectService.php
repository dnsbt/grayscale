<?php

namespace App\Services;

use App\Models\AdminNav;
use App\Models\Project;

class ProjectService
{
    /**
     * @return array
     */
    public function getAllProjects(): array
    {
        $items = Project::all();
        $processedItems = [];
        foreach ($items as $item) {
            $processedItems[$item->id] = $item->toArray();
            $processedItems[$item->id]['edit_url'] = route(AdminNav::ADMIN_PROJECTS_EDIT, [$item->id]);
            $processedItems[$item->id]['delete_url'] = route(AdminNav::ADMIN_PROJECTS_DELETE, [$item->id]);
        }
        return $processedItems;
    }

    /**
     * @param string $title
     * @param string $description
     * @param int $file_id
     * @return int
     */
    public function storeProject(string $title, string $description, int $file_id): int
    {
        $project = $this->createProject();
        $project->title = $title;
        $project->description = $description;
        $project->file_id = $file_id;
        $project->save();


        return $project->id;
    }

    /**
     * @param Project $project
     * @param string $title
     * @param string $description
     * @param int $file_id
     * @return void
     */
    public function updateProject(Project $project, string $title, string $description, int $file_id): void
    {
        $project->title = $title;
        $project->description = $description;
        $project->file_id = $file_id;
        $project->save();
    }

    /**
     * @param Project $project
     * @return void
     * @throws \Exception
     */
    public function destroyProject(Project $project): void
    {
        $project->delete();
    }

    /**
     * @param int $id
     * @return array
     */
    public function getFileIdProject(int $id): array
    {
        $file_id = Project::all()
            ->where('id', '=', $id)
            ->pluck('file_id')->toArray();

        return $file_id;
    }

    /**
     * @return Project
     */
    public function createProject(): Project
    {
        return new Project();
    }
}
