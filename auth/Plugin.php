<?php namespace AppAuth\Auth;

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
            'name' => 'Auth',
            'description' => 'Extends RainLab.User plugin',
            'author' => 'AppAuth',
            'icon' => 'icon-leaf'
        ];
    }

    /**
     * Plugin dependencies.
     */
    public $require = ['RainLab.User'];

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
        // Extend the User model to add additional fields
        UserModel::extend(function($model) {
            // Add fillable fields
            $model->addFillable([
                'slack_id',
                'google_token',
                'google_refresh_token',
            ]);

            // Add validation rules for new fields if needed
            $model->rules['slack_id'] = 'nullable|unique:users';
            $model->rules['google_token'] = 'nullable|string';
            $model->rules['google_refresh_token'] = 'nullable|string';
        });
    }

    /**
     * registerComponents used by the frontend.
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'AppAuth\Auth\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * registerPermissions used by the backend.
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'appauth.auth.some_permission' => [
                'tab' => 'Auth',
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
            'auth' => [
                'label' => 'Auth',
                'url' => Backend::url('appauth/auth/mycontroller'),
                'icon' => 'icon-leaf',
                'permissions' => ['appauth.auth.*'],
                'order' => 500,
            ],
        ];
    }
}
