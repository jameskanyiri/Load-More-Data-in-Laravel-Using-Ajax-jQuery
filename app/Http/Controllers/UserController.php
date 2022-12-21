<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function loadMore(Request $request)
    {
        $results = User::orderBy('id')->paginate(50);
        $users = '';
        if ($request->ajax()) {
            foreach ($results as $result) {
                $users.='<div class="card mb-2"> <div class="card-body">'.$result->id.' <h5 class="card-title">'.$result->post_name.'</h5> '.$result->post_description.'</div></div>';
            }
            return $users;
        }
        return view('welcome');
    } 
}
