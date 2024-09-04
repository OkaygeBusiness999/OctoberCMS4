<?php namespace AppAuth\Google;

use Backend;
use System\Classes\PluginBase;
use RainLab\User\Models\User as UserModel;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{
    /**
     * pluginDetails about this plugin.
     */
    public function pluginDetails()
    {
        return [
            'name' => 'Google',
            'description' => 'Provides Google SSO integration.',
            'author' => 'AppAuth',
            'icon' => 'icon-google'
        ];
    }

    /**
     * register method, called when the plugin is first registered.
     */
    public function register()
    {
        //
    }

    /**
     * boot method, called right before the request route.
     */
    public function boot()
    {
        UserModel::extend(function ($model) {
            $model->addFillable([
                'google_token',
                'google_refresh_token',
            ]);
        });
    }

    /**
     * registerComponents used by the frontend.
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'AppAuth\Google\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * registerPermissions used by the backend.
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'appauth.google.some_permission' => [
                'tab' => 'Google',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * registerNavigation used by the backend.
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'google' => [
                'label' => 'Google',
                'url' => Backend::url('appauth/google/mycontroller'),
                'icon' => 'icon-leaf',
                'permissions' => ['appauth.google.*'],
                'order' => 500,
            ],
        ];
    }
}
