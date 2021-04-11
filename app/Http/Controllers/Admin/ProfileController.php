<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;
use App\ProfileHistory;
use Carbon\Carbon;
class ProfileController extends Controller
{
    public function index(Request $request)
{
      $cond_name = $request->cond_name;
      if ($cond_name != '') {
          // 検索されたら検索結果を取得する
          $posts = profile::where('name', $cond_name)->get();
    } else {
          // それ以外はすべてのニュースを取得する
          $posts = profile::all();
      }
      return view('admin.profile.index', ['posts' => $posts, 'cond_name' => $cond_name]);
  }
  
    public function add()
    {
        return view('admin.profile.create');
    }

    public function create(Request $request)
    {
      // 以下を追記
      // Varidationを行う
      $this->validate($request, Profile::$rules);
      $profile = new Profile ;
      $form = $request->all();
      
      unset($form['_token']);
      // データベースに保存する
      $profile->fill($form);
      $profile->save();

        return redirect('admin/profile/create');
    }

    public function edit(Request $request)
    
    {$profile = Profile::find($request->id);
      if (empty($profile)) {
        abort(404);    
      }
      return view('admin.profile.edit', ['profile_form' => $profile]);
        
    }

    
    
     public function update(Request $request)
    {
        $this->validate($request, Profile::$rules);
        $profile = profile::find($request->id);
        $profile_form = $request->all();
       
        unset($profile_form['_token']);
        $profile->fill($profile_form)->save();

        // 以下を追記
        $profile_history = new ProfileHistory;
        $profile_history->profile_id = $profile->id;
        $profile_history->edited_at = Carbon::now();
        $profile_history->save();

        
        return redirect()->back();
    }

}
