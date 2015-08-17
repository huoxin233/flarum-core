<?php namespace Flarum\Admin\Actions;

use Flarum\Support\ClientAction as BaseClientAction;
use Psr\Http\Message\ServerRequestInterface as Request;
use Flarum\Core\Groups\Permission;
use Flarum\Api\Client;
use Flarum\Core\Settings\SettingsRepository;
use Flarum\Locale\LocaleManager;

class ClientAction extends BaseClientAction
{
    /**
     * {@inheritdoc}
     */
    protected $clientName = 'admin';

    /**
     * {@inheritdoc}
     */
    protected $translationKeys = [

    ];

    /**
     * {@inheritdoc}
     */
    public function __construct(Client $apiClient, LocaleManager $locales, SettingsRepository $settings)
    {
        parent::__construct($apiClient, $locales, $settings);

        $this->layout = __DIR__.'/../../../views/admin.blade.php';
    }

    /**
     * {@inheritdoc}
     */
    public function render(Request $request, array $routeParams = [])
    {
        $view = parent::render($request, $routeParams);

        $view->setVariable('config', $this->settings->all());
        $view->setVariable('permissions', Permission::map());
        $view->setVariable('extensions', app('flarum.extensions')->getInfo());

        return $view;
    }
}
