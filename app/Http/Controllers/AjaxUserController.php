<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AjaxUserController extends Controller
{
    public function search(Request $request){
        $keyword = $request->query('q');

        $users = User::query()
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}")
                      ->orWhere('email', 'like', "%{$keyword}");
            })
            ->select('id', 'name', 'email', 'role')
            ->limit(10)
            ->get();
        
        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }
}
