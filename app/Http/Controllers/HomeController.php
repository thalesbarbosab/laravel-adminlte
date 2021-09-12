<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use stdClass;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $user;
    protected $menu;

    public function __construct(User $user, Menu $menu)
    {
        $this->middleware('auth');
        $this->user = $user;
        $this->menu = $menu;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        //$this->authorize('is_admin');

        $user_counters = new stdClass;
        $user_counters->all_users = $this->user->all()->count();
        $user_counters->actived_users = $this->user->where('status','actived')->count();
        $user_counters->pre_registred_users = $this->user->where('status','pre_registred')->count();
        $user_counters->inactived_users = $this->user->where('status','inactived')->count();
        $user_counters->male_users = $this->user->where('gender','male')->count();
        $user_counters->female_users = $this->user->where('gender','female')->count();
        $user_counters->administrator_users = $this->user->where('profile','administrator')->count();
        $user_counters->user_users = $this->user->where('profile','user')->count();

        $users = $this->user->paginate(5);

        return view('dashboard',['users'=>$users,
                            'user_counters'=>$user_counters]);
    }

    public function menu($id)
    {
        $menu = $this->menu->where('actived',true)->where('id',$id)->firstOrFail();
        return view('menu',['menu'=>$menu]);
    }


}
