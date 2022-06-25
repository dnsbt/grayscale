<?php

namespace App\Services;

use App\Models\AdminNav;
use App\Models\SiteConfiguration;

class SiteConfigurationService
{
    /**
     * @return array
     */
    public function getAllSiteConfigurations(): array
    {
        $items = SiteConfiguration::all();
        $processedItems = [];
        foreach ($items as $item) {
            $processedItems[$item->id] = $item->toArray();
            $processedItems[$item->id]['edit_url'] = route(AdminNav::ADMIN_SITE_CONFIG_EDIT, [$item->id]);
            $processedItems[$item->id]['delete_url'] = route(AdminNav::ADMIN_SITE_CONFIG_DELETE, [$item->id]);
        }
        return $processedItems;
    }

    /**
     * @return SiteConfiguration
     */
    public function createSiteConfiguration(): SiteConfiguration
    {
        return new SiteConfiguration();
    }

    /**
     * @param string $key
     * @param string $value
     * @return int
     */
    public function storeSiteConfiguration(string $key, string $value): int
    {
        $siteConfig = $this->createSiteConfiguration();
        $siteConfig->key = $key;
        $siteConfig->value = $value;
        $siteConfig->save();


        return $siteConfig->id;
    }

    /**
     * @param SiteConfiguration $siteConfig
     * @param string $key
     * @param string $value
     * @return void
     */
    public function updateSiteConfiguration(SiteConfiguration $siteConfig, string $key, string $value): void
    {
        $siteConfig->key = $key;
        $siteConfig->value = $value;
        $siteConfig->save();
    }

    /**
     * @param SiteConfiguration $siteConfig
     * @return void
     * @throws \Exception
     */
    public function destroySiteConfiguration(SiteConfiguration $siteConfig): void
    {
        $siteConfig->delete();
    }
}
