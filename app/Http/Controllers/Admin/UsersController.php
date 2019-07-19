<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UsersController extends Controller{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /*
     * Show create user page/form
     * */
    public function create(){
        try{
            $pageData = [
                'pageTitle' => 'Create User',
                'formType'  => 'create'
            ];
            return view('admin.pages.users.form',compact('pageData'));
        }catch (\Exception $e){
            return response()->json([
                'title'     => 'error',
                'message'   => $e->getMessage(),
                'type'      => 'ERROR'
            ]);
        }
    }
    /*
     * Store User details into database
     * */
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'firstName'     => 'required',
            'lastName'      => 'required',
            'username'      => 'required',
            'email'         => 'required',
            'password'      => 'required',
            'role'          => 'required',
            'isVisible'     => 'required'
        ], [
            'firstName.required'    => 'First name is required',
            'lastName.required'     => 'Last name is required',
            'username.required'     => 'Username is required',
            'email.required'        => 'Email address is required',
            'password.required'     => 'Password name is required',
            'role.required'         => 'User role is required',
            'isVisible.required'    => 'User visibility is required'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try{
            if($request->hasFile('avatar')){
                $file = $request->file('avatar');
                $avatarFileName = Str::random(10).'.'.$file->getClientOriginalExtension();
                Storage::disk('public')->put('avatar',$avatarFileName,$file);
            }else{
                $avatarFileName = 'default.png';
            }
            User::create([
                'avatar'        => $avatarFileName,
                'firstName'     => $request->get('firstName'),
                'lastName'      => $request->get('lastName'),
                'username'      => $request->get('username'),
                'email'         => $request->get('email'),
                'password'      => $request->get('password'),
                'role'          => $request->get('role'),
                'isVisible'     => $request->get('isVisible')
            ]);
            return response()->json([
                'title'     => 'success',
                'message'   => 'User Created Successfully',
                'type'      => 'SUCCESS'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'title'     => 'error',
                'message'   => $e->getMessage(),
                'type'      => 'Error'
            ]);
        }
    }
    /*
     * Show edit user page/form
     * */
    public function edit($user_id){
        try{
            $getOldUserData = User::find($user_id)->first();
            if($getOldUserData === null){
                return redirect()->back()->with([
                    'title'     => 'error',
                    'message'   => 'Invalid User ID',
                    'type'      => 'ERROR'
                ]);
            }
            $pageData = [
                'pageTitle' => 'Create User',
                'formType'  => 'create',
                'userData'  => User::find($user_id)
            ];
            return view('admin.pages.users.form',compact('pageData'));
        }catch (\Exception $e){
            return response()->json([
                'title'     => 'error',
                'message'   => $e->getMessage(),
                'type'      => 'Error'
            ]);
        }
    }
    /*
     * Store user details into database
     * */
    public function update(Request $request, $user_id){
        $validator = Validator::make($request->all(), [
            'firstName'     => 'required',
            'lastName'      => 'required',
            'username'      => 'required',
            'email'         => 'required',
            'password'      => 'required',
            'role'          => 'required',
            'isVisible'     => 'required'
        ], [
            'firstName.required'    => 'First name is required',
            'lastName.required'     => 'Last name is required',
            'username.required'     => 'Username is required',
            'email.required'        => 'Email address is required',
            'password.required'     => 'Password name is required',
            'role.required'         => 'User role is required',
            'isVisible.required'    => 'User visibility is required'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try{
            $getOldUserData = User::find($user_id)->first();
            if($getOldUserData === null){
                return redirect()->back()->with([
                    'title'     => 'error',
                    'message'   => 'Invalid User ID',
                    'type'      => 'ERROR'
                ]);
            }
            if($request->hasFile('avatar')){
                $file = $request->file('avatar');
                $avatarFileName = Str::random(10).'.'.$file->getClientOriginalExtension();
                Storage::disk('public')->put('avatar',$avatarFileName,$file);
            }else{
                if($getOldUserData->avatar !== 'default.png' || $getOldUserData->avatar !== null){
                    $avatarFileName = $getOldUserData->avatar;
                }else{
                    $avatarFileName = 'default.png';
                }
            }
            User::where('id',$user_id)->update([
                'avatar'        => $avatarFileName,
                'firstName'     => $request->get('firstName'),
                'lastName'      => $request->get('lastName'),
                'username'      => $request->get('username'),
                'email'         => $request->get('email'),
                'password'      => $request->get('password'),
                'role'          => $request->get('role'),
                'isVisible'     => $request->get('isVisible')
            ]);
            return response()->json([
                'title'     => 'success',
                'message'   => 'User Updated Successfully',
                'type'      => 'SUCCESS'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'title'     => 'error',
                'message'   => $e->getMessage(),
                'type'      => 'Error'
            ]);
        }
    }
    /*
     *  Remove user
     * */
    public function destroy($user_id){
        try{
            User::where('id',$user_id)->delete();
            return response()->json([
                'title'     => 'success',
                'message'   => 'User Removed Successfully',
                'type'      => 'SUCCESS'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'title'     => 'error',
                'message'   => $e->getMessage(),
                'type'      => 'Error'
            ]);
        }
    }
    /*
     *  Update user status
     * */
    public function updateStatus(Request $request, $user_id){
        try{
            User::where('id',$user_id)->update([
                'isVisible'  => $request->get('isVisible')
            ]);
            return response()->json([
                'title'     => 'success',
                'message'   => 'User Status Updated Successfully',
                'type'      => 'SUCCESS'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'title'     => 'error',
                'message'   => $e->getMessage(),
                'type'      => 'Error'
            ]);
        }
    }
}
