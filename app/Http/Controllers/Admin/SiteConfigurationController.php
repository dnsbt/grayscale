<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SiteConfigurationRequest;
use App\Models\AdminNav;
use App\Models\SiteConfiguration;
use App\Services\SiteConfigurationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class SiteConfigurationController extends AdminPageController
{
    private SiteConfigurationService $service;

    /**
     * @param SiteConfigurationService $service
     */
    public function __construct(SiteConfigurationService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $generalPageData = $this->getGeneralPageData();
        $processedItems = $this->service->getAllSiteConfigurations();
        $createUrl = route(AdminNav::ADMIN_SITE_CONFIG_CREATE);

        return response(
            view(
                'admin.pages.site_config.table',
                array_merge($generalPageData, ['items' => $processedItems, 'create_url' => $createUrl])
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        $generalPageData = $this->getGeneralPageData();
        $siteConfig = $this->service->createSiteConfiguration();
        $action = route(AdminNav::ADMIN_SITE_CONFIG_STORE);

        return response(
            view(
                'admin.pages.site_config.form',
                array_merge(
                    $generalPageData,
                    [
                        'site_config' => $siteConfig,
                        'action' => $action,
                    ]
                )
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SiteConfigurationRequest $request
     * @return RedirectResponse
     */
    public function store(SiteConfigurationRequest $request): RedirectResponse
    {
        $this->service->storeSiteConfiguration($request->key, $request->value);

        return redirect(route(AdminNav::ADMIN_SITE_CONFIG));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param SiteConfiguration $siteConfig
     * @return Response
     */
    public function edit(SiteConfiguration $siteConfig): Response
    {
        $generalPageData = $this->getGeneralPageData();
        $action = route(AdminNav::ADMIN_SITE_CONFIG_UPDATE, $siteConfig->id);


        return response(
            view(
                'admin.pages.site_config.form',
                array_merge(
                    $generalPageData,
                    [
                        'site_config' => $siteConfig,
                        'action' => $action,
                    ]
                )
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SiteConfigurationRequest $request
     * @param SiteConfiguration $siteConfig
     * @return RedirectResponse
     */
    public function update(SiteConfigurationRequest $request, SiteConfiguration $siteConfig): RedirectResponse
    {
        $this->service->updateSiteConfiguration($siteConfig, $request->key, $request->value);

        return redirect(route(AdminNav::ADMIN_SITE_CONFIG_EDIT, $siteConfig->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SiteConfiguration $siteConfig
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(SiteConfiguration $siteConfig): RedirectResponse
    {
        $this->service->destroySiteConfiguration($siteConfig);

        return redirect(route(AdminNav::ADMIN_SITE_CONFIG));
    }
}
