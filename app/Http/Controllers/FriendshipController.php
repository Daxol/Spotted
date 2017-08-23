<?php

namespace App\Http\Controllers;

use App\AuthClient;
use App\Friendship;
use App\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class FriendshipController extends Controller
{


    public function show($user, $friendship)
    {
        return Friendship::getFriendship($friendship);
    }

    public function index($id)
    {
        return User::friends($id);
    }

    public function store(Request $request, $id)
    {
        return Friendship::createFriendship($id);
    }

    public function update(Request $request, $user, $id)
    {
        return Friendship::changeFriendshipStatus($id, \request('status'));
    }
}
