<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieving a model
        $admin_users = User::where('type', 0)->get();

        return view('admin.admin_user.index', compact('admin_users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Retrieving models
        $admin_roles = Role::where('id', '!=', 1)->get();

        return view('admin.admin_user.create', compact('admin_roles'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Form validation
        $request->validate([
            'role_id' => 'integer',
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6',
            'profile_photo_path' => 'image|mimes:jpeg,jpg,png|max:2048',
        ]);

        // Get All Request
        $input = $request->all();

        // super-admin control
        if ($input['role_id'] == 1) {
            return redirect()->route('admin-user.create')
                ->with('warning', 'content.you_do_not_have_permission_to_access');
        }

        $role = Role::findOrFail($input['role_id']);

        if ($request->hasFile('profile_photo_path')) {

            // Get image file
            $profile_photo_path_file = $request->file('profile_photo_path');

            // Folder path
            $folder = 'uploads/img/profile/admin/';

            // Make image name
            $profile_photo_path_name = time() . '-' . $profile_photo_path_file->getClientOriginalName();

            // Original size upload file
            $profile_photo_path_file->move($folder, $profile_photo_path_name);

            // Set input
            $input['profile_photo_path'] = $profile_photo_path_name;

        } else {
            // Set input
            $input['profile_photo_path'] = null;
        }

        $user = User::factory()->create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'profile_photo_path' => $input['profile_photo_path'],
            'type' => 0,
        ]);

        $user->assignRole($role);

        return redirect()->route('admin-user.index')
            ->with('success', 'content.created_successfully');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Retrieving models
        $admin_user = User::findOrFail($id);
        $admin_roles = Role::where('id', '!=', 1)->get();

        return view('admin.admin_user.edit', compact('admin_user', 'admin_roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Form validation
        $request->validate([
            'role_id' => 'integer',
            'name' => 'required|max:255',
            'email'   =>  [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($id),
            ],
            'password' => 'required|confirmed|min:6',
            'profile_photo_path' => 'image|mimes:jpeg,jpg,png|max:2048',
        ]);

        // Get model
        $admin_user = User::findOrFail($id);

        // Get All Request
        $input = $request->all();

        // super-admin control
        if ($input['role_id'] == 1) {
            return redirect()->route('admin-user.edit', $id)
                ->with('warning', 'content.you_do_not_have_permission_to_access');
        }

        $role = Role::findOrFail($input['role_id']);

        if($request->hasFile('profile_photo_path')) {

            // Get image file
            $profile_photo_path_file = $request->file('profile_photo_path');

            // Folder path
            $folder = 'uploads/img/profile/admin/';

            // Make image name
            $profile_photo_path_name = time().'-'.$profile_photo_path_file->getClientOriginalName();

            // Delete Image
            File::delete(public_path($folder.$admin_user->profile_photo_path));

            // Original size upload file
            $profile_photo_path_file->move($folder, $profile_photo_path_name);

            // Set input
            $input['profile_photo_path'] = $profile_photo_path_name;

        }

        // Password hashed
        $input['password'] = Hash::make($input['password']);

        // Update model
        User::find($id)->update($input);

        $admin_user = User::findOrFail($id);

        if ($admin_user->getRoleNames()->first() != null) {

            if ($admin_user->getRoleNames()->first() != $role->name) {

                // Old role remove
                $admin_user->removeRole($admin_user->getRoleNames()->first());

                // New role assing
                $admin_user->assignRole($role->name);

            }

        } else {

            // New role assing
            $admin_user->assignRole($role->name);

        }


        return redirect()->route('admin-user.index')
            ->with('success', 'content.created_successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Retrieve a model
        $admin_user = User::find($id);

        // Folder path
        $folder = 'uploads/img/profile/admin/';

        // Delete Image
        File::delete(public_path($folder.$admin_user->profile_photo_path));


        if ($admin_user->getRoleNames()->first() != null) {
            // Remove role
            $admin_user->removeRole($admin_user->getRoleNames()->first());
        }

        // Delete record
        $admin_user->delete();

        return redirect()->route('admin-user.index')
            ->with('success', 'content.deleted_successfully');
    }
}
