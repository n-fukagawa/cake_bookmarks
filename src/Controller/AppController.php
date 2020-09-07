<?php
namespace App\Controller;

use Cake\Controller\Controller;

class AppController extends Controller
{
    public function initialize()
    {
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authorize'=> 'Controller',
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'email',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            'unauthorizedRedirect' => $this->referer() // 未認証時、元のページを返します。
        ]);

        // PagesController が動作し続けるように
        // display アクションを許可
        $this->Auth->allow(['display']);
    }
    // 自データかどうかの認証をする
    public function isAuthorized($user)
    {
        return false;
    }
}