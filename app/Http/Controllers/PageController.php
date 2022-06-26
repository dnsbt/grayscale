<?php

namespace App\Http\Controllers;

use App\Models\EmailSubscription;
use App\Models\Project;
use App\Models\SiteConfiguration;
use App\Services\FileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PageController extends Controller
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
     * @return Response
     */
    public function index(): Response
    {
        $siteConfig = SiteConfiguration::all();
        $config = $siteConfig->pluck('value', 'key')->toArray();
        $action = route('email');
        $projects = [];

        foreach (Project::all()->toArray() as $key => $project) {
            $projects[$key] = $project;
            $projects[$key]['image_url'] = $this->fileService->getPublicUrl($project['file_id']);
        }

        return response(view('index', [
            'config' => $config,
            'projects' => $projects,
            'action' => $action,
        ]));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function email(Request $request): RedirectResponse
    {
        $email = new EmailSubscription();
        $email->email = $request->get('email');
        $email->save();

        return redirect()->back();
    }
}
