<?php
namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\User;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoriesController extends Controller{


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
                'pageTitle' => 'Create Category',
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
            $slug = SlugService::createSlug(Category::class, 'cat_name_slug', $request->get('cat_name'));
            User::create([
                'cat_avatar'        => $avatarFileName,
                'cat_parent_id'     => $request->get('cat_parent_id'),
                'cat_name'          => $request->get('cat_name'),
                'cat_name_slug'     => $slug,
                'cat_description'   => $request->get('cat_description'),
            ]);
            return response()->json([
                'title'     => 'success',
                'message'   => 'Category Created Successfully',
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
                    'message'   => 'Invalid Category ID',
                    'type'      => 'ERROR'
                ]);
            }
            $pageData = [
                'pageTitle' => 'Create Category',
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
    public function update(Request $request, $category_id){
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
            $getOldCategoryData = Category::find($category_id)->first();
            if($getOldCategoryData === null){
                return redirect()->back()->with([
                    'title'     => 'error',
                    'message'   => 'Invalid Category ID',
                    'type'      => 'ERROR'
                ]);
            }
            if($request->hasFile('cat_avatar')){
                $file = $request->file('cat_avatar');
                $avatarFileName = Str::random(10).'.'.$file->getClientOriginalExtension();
                Storage::disk('public')->put('avatar',$avatarFileName,$file);
            }else{
                if($getOldCategoryData->cat_avatar !== 'default.png' || $getOldCategoryData->cat_avatar !== null){
                    $avatarFileName = $getOldCategoryData->cat_avatar;
                }else{
                    $avatarFileName = 'default.png';
                }
            }
            $slug = SlugService::createSlug(Category::class, 'cat_name_slug', $request->get('cat_name'));
            Category::where('id',$category_id)->update([
                'cat_avatar'        => $avatarFileName,
                'cat_parent_id'     => $request->get('cat_parent_id'),
                'cat_name'          => $request->get('cat_name'),
                'cat_name_slug'     => $slug,
                'cat_description'   => $request->get('cat_description'),
            ]);
            return response()->json([
                'title'     => 'success',
                'message'   => 'Category Updated Successfully',
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
    public function destroy($category_id){
        try{
            Category::where('id',$category_id)->delete();
            return response()->json([
                'title'     => 'success',
                'message'   => 'Category Removed Successfully',
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
    public function updateStatus(Request $request, $category_id){
        try{
            Category::where('id',$category_id)->update([
                'isVisible'  => $request->get('isVisible')
            ]);
            return response()->json([
                'title'     => 'success',
                'message'   => 'Category Status Updated Successfully',
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
