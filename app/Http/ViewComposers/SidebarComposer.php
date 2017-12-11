<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\GuzzleHttp\AuthorizeRequestServiceInterface;

class SidebarComposer
{
    protected $sidebarView;

    public function __construct(AuthorizeRequestServiceInterface $authorizeRequestService)
    {
        $this->sidebarView = $this->getPermissionSidebarView($authorizeRequestService);
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('sidebarView', $this->sidebarView);
    }

    private function getPermissionSidebarView($authorizeRequestService)
    {
        $accountsPermissions = $response = $authorizeRequestService->send(
            'post',
            config('sso.root_server.url.root') . '/api/permission/get-all-permissions',
            'ntbic_accounts'
        )->data;

        $homePermissions = $response = $authorizeRequestService->send(
            'post',
            config('sso.root_server.url.root') . '/api/permission/get-all-permissions',
            'ntbic_home'
        )->data;

        $databasePermissions = $response = $authorizeRequestService->send(
            'post',
            config('sso.root_server.url.root') . '/api/permission/get-all-permissions',
            'ntbic_database'
        )->data;

        $sidebarView = [
            'ntbic_accounts' => [
                'users' => [
                    'read' => $authorizeRequestService->checkPermissionInList(
                        'ntbic_accounts', 'read users', $accountsPermissions
                    ),
                    'store' => $authorizeRequestService->checkPermissionInList(
                        'ntbic_accounts', 'store users', $accountsPermissions
                    ),
                    'update' => $authorizeRequestService->checkPermissionInList(
                        'ntbic_accounts', 'update users', $accountsPermissions
                    ),
                    'destroy' => $authorizeRequestService->checkPermissionInList(
                        'ntbic_accounts', 'destroy users', $accountsPermissions
                    ),
                ]
            ],
            'ntbic_home' => [
                'permission' => [
                    'read' => $authorizeRequestService->checkPermissionInList(
                        'ntbic_home', 'read permission', $homePermissions)
                ],
                'user_permissions' => [
                    'read' => $authorizeRequestService->checkPermissionInList(
                        'ntbic_home', 'read user_permissions', $homePermissions),
                    'update' => $authorizeRequestService->checkPermissionInList(
                        'ntbic_home', 'update user_permission', $homePermissions),
                ],
                'user_roles' => [
                    'read' => $authorizeRequestService->checkPermissionInList(
                        'ntbic_home', 'read user_roles', $homePermissions),
                    'update' => $authorizeRequestService->checkPermissionInList(
                        'ntbic_home', 'update user_roles', $homePermissions),
                ],
                'role_permissions' => [
                    'read' => $authorizeRequestService->checkPermissionInList(
                        'ntbic_home', 'read role_permissions', $homePermissions),
                    'store' => $authorizeRequestService->checkPermissionInList(
                        'ntbic_home', 'store role_permissions', $homePermissions),
                    'update' => $authorizeRequestService->checkPermissionInList(
                        'ntbic_home', 'update role_permissions', $homePermissions),
                    'destroy' => $authorizeRequestService->checkPermissionInList(
                        'ntbic_home', 'destroy role_permissions', $homePermissions),
                ]
            ],
            'ntbic_database' => [
                'permission' => [
                    'read' => $authorizeRequestService->checkPermissionInList(
                        'ntbic_database', 'read permission', $databasePermissions),
                    'update' => $authorizeRequestService->checkPermissionInList(
                        'ntbic_database', 'update permission', $databasePermissions)
                ],
                'user_permissions' => [
                    'read' => $authorizeRequestService->checkPermissionInList(
                        'ntbic_database', 'read user_permissions', $databasePermissions),
                    'update' => $authorizeRequestService->checkPermissionInList(
                        'ntbic_database', 'update user_permission', $databasePermissions),
                ],
                'user_roles' => [
                    'read' => $authorizeRequestService->checkPermissionInList(
                        'ntbic_database', 'read user_roles', $databasePermissions),
                    'update' => $authorizeRequestService->checkPermissionInList(
                        'ntbic_database', 'update user_roles', $databasePermissions),
                ],
                'role_permissions' => [
                    'read' => $authorizeRequestService->checkPermissionInList(
                        'ntbic_database', 'read role_permissions', $databasePermissions),
                    'store' => $authorizeRequestService->checkPermissionInList(
                        'ntbic_database', 'store role_permissions', $databasePermissions),
                    'update' => $authorizeRequestService->checkPermissionInList(
                        'ntbic_database', 'update role_permissions', $databasePermissions),
                    'destroy' => $authorizeRequestService->checkPermissionInList(
                        'ntbic_database', 'destroy role_permissions', $databasePermissions),
                ]
            ]
        ];
        return $sidebarView;
    }
}