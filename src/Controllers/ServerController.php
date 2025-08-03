<?php

namespace LaravelAuto\Sso\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use LaravelAuto\Sso\SingleSignOnServer;

class ServerController extends BaseController
{
    /**
     * @param Request $request
     * @param SingleSignOnServer $server
     *
     * @return void
     */
    public function attach(Request $request, SingleSignOnServer $server)
    {
        $server->attach(
            $request->get('broker', null),
            $request->get('token', null),
            $request->get('checksum', null)
        );
    }

    /**
     * @param Request $request
     * @param SingleSignOnServer $server
     *
     * @return mixed
     */
    public function login(Request $request, SingleSignOnServer $server)
    {
        return $server->login(
            $request->get('username', null),
            $request->get('password', null)
        );
    }

    /**
     * @param SingleSignOnServer $server
     *
     * @return string
     */
    public function logout(SingleSignOnServer $server)
    {
        return $server->logout();
    }

    /**
     * @param SingleSignOnServer $server
     *
     * @return string
     */
    public function userInfo(SingleSignOnServer $server)
    {
        return $server->userInfo();
    }
}
