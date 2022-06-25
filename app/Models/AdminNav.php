<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminNav extends Model
{
    public const ADMIN_LOGIN = 'admin_login';
    public const ADMIN_SITE_CONFIG = 'site_config.index';
    public const ADMIN_SITE_CONFIG_EDIT = 'site_config.edit';
    public const ADMIN_SITE_CONFIG_UPDATE = 'site_config.update';
    public const ADMIN_SITE_CONFIG_CREATE = 'site_config.create';
    public const ADMIN_SITE_CONFIG_STORE = 'site_config.store';
    public const ADMIN_SITE_CONFIG_DELETE = 'site_config.destroy';
    public const ADMIN_DASHBOARD = 'admin_dashboard';
    public const ADMIN_FILES = 'files.index';
    public const ADMIN_FILES_EDIT = 'files.edit';
    public const ADMIN_FILES_CREATE = 'files.create';
    public const ADMIN_FILES_STORE = 'files.store';
    public const ADMIN_FILES_DELETE = 'files.destroy';
    public const ADMIN_PROJECTS = 'projects.index';
    public const ADMIN_PROJECTS_EDIT = 'projects.edit';
    public const ADMIN_PROJECTS_UPDATE = 'projects.update';
    public const ADMIN_PROJECTS_CREATE = 'projects.create';
    public const ADMIN_PROJECTS_STORE = 'projects.store';
    public const ADMIN_PROJECTS_DELETE = 'projects.destroy';

    public static function getNav(): array
    {
        return [
            [
                'title' => 'Site Configuration',
                'route' => self::ADMIN_SITE_CONFIG
            ],
            [
                'title' => 'File service',
                'route' => self::ADMIN_FILES
            ],
            [
                'title' => 'Projects',
                'route' => self::ADMIN_PROJECTS
            ]
        ];
    }
}
