<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function search(Request $request)
    {
        $term = $request->get('term');

        $results = User::where('name', 'like', "%{$term}%")
            ->limit(10) // Limit search results (optional)
            ->get();

        return response()->json([
            'results' => $results->map(function ($item) {
                return ['id' => $item->id, 'text' => $item->name];
            })
        ]);
    }
    public function search_captain(Request $request){
        $term = $request->get('term');

        $roleName = 'captain';
        $results = User::where('name', 'like', "%{$term}%")
            ->whereHas('roles', function ($query) use ($roleName) {
                $query->where('name', $roleName); // Replace $roleName with the desired role
            })
            ->limit(10)
            ->get();

        return response()->json([
            'results' => $results->map(function ($item) {
                return ['id' => $item->id, 'text' => $item->name];
            })
        ]);
    }

    public function search_collector(Request $request){
        $term = $request->get('term');
        $roleName = 'collector';
        $results = User::where('name', 'like', "%{$term}%")
            ->whereHas('roles', function ($query) use ($roleName) {
                $query->where('name', $roleName); // Replace $roleName with the desired role
            })
            ->limit(10)
            ->get();

        return response()->json([
            'results' => $results->map(function ($item) {
                return ['id' => $item->id, 'text' => $item->name];
            })
        ]);
    }

    public function getCustomers()
    {
        $roleName='customer';
        $customers = User::whereHas('roles', function ($query) use ($roleName) {
            $query->where('name', $roleName); // Replace $roleName with the desired role
	})
		->orderBy('created_at', 'desc')->paginate(50);
        return view('customers.index', compact('customers'));
    }

    public function getUsers(Request $request)
    {
        $roleName = $request->input('roleName'); // Get the roleName from query string or form input

        $users = User::with('country')->whereHas('roles', function ($query) use ($roleName) {
            $query->where('name', $roleName);
	})->paginate(50);

        return view('users.index', compact('users', 'roleName'));
    }

    public function show(){
        die('progress......');
    }

    public function edit(){
        die('progress......');
    }

    public function terms_conditions()
    {
        return view('app_views.terms_conditions');
    }

    public function privacy_policy()
    {
        return view('app_views.privacy_policy');
    }
}
