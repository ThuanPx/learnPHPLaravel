<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckAdmin;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware(CheckAdmin::class);
    }

    public function getUser(Request $request, $id)
    {
        $langAndroid = new stdClass;
        $langAndroid->name = 'Android';
        $langPHP = new stdClass;
        $langPHP->name = 'PHP';
        $works = [$langAndroid, $langPHP];

        return response()
            ->json([
                'id' => $id,
                'name' => 'ThuanPx',
                'team' => 'MI2',
                'works' => $works
            ]);
    }

    public function createUser(UserRequest $request)
    {
        $request->validated();
        return $this->fakeUser($request);
    }

    public function updateUser(UserRequest $request)
    {
        $request->validated();
        return $this->fakeUser($request);
    }

    public function deleteUser($id)
    {
        if ($id == 1710) {
            abort(500);
        }
        return response()
            ->json([
                'message' => 'delete success'
            ]);
    }

    private function fakeUser(UserRequest $request)
    {
        return response()
            ->json([
                'id' => $request->id,
                'name' =>  $request->name,
                'team' => $request->team,
            ]);
    }
}
