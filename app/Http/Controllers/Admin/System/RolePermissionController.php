<?php

namespace App\Http\Controllers\Admin\System;

use App\Models\Access;
use App\Models\Categories;
use App\Models\Permissions;
use App\Models\Roles;
use App\Models\SubCategories;
use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rolesList = Roles::where('name','!=','superadmin')->get();
        return view('admin.system.role-permission.index',compact('rolesList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::get();
        $subcategories = SubCategories::get();
          return view('admin.system.role-permission.create',['cats'=>$categories, "subcats"=>$subcategories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make( $request->all(),[
            "rolename" => "bail|required|min:3",
        ],[
            "rolename.required" => "Nom du rôle est requis",
            "rolename.min" => "Nom du rôle doit avoir minimum :min lettres",
        ]);

        if($validator->fails()){
            Session::flash('error', $validator->errors()->first());
            return redirect()->back()->withInput();
        }

        if(Roles::where("name",$request->rolename)->first()){
            Session::flash('error', 'Nom du rôle Existe déja');
            return redirect()->back()->withInput();
        }

        try{
            $role = new Roles();
            $role->name = $request->rolename;
            $role->description = $request->roledesc;
            $role->save();
        } catch (QueryException $qe) {
            Session::flash('error', $qe->getMessage());
            return redirect()->back()->withInput();
        }

        try {
            foreach ($request->access as $accessname => $value) {
                $access = new Access();
                $access->categories_id = Categories::where("link",$accessname)->pluck('id')->first();
                $access->roles_id = $role->id;
                $access->able = $value;
                $access->save();
            }
        } catch (QueryException $qe) {
            Session::flash('error', $qe->getMessage());
            return redirect()->back()->withInput();
        }

        try {
            foreach ($request->permissions as $name => $permission) {
                $permissionTable = new Permissions();
                $permissionTable->roles_id = $role->id;
                $permissionTable->sub_categories_id = SubCategories::where("link",$name)->pluck("id")->first();
                $permissionTable->can_read = $permission['can_read'];
                $permissionTable->can_create = $permission['can_create'];
                $permissionTable->can_update = $permission['can_update'];
                $permissionTable->can_delete = $permission['can_delete'];
                $permissionTable->access = $permission['access'];
                $permissionTable->save();
            }

            Session::flash('success', "Rôle ajouter avec succés");
            return redirect()->route('system-role-permission');
        } catch (QueryException $qe) {
            Session::flash('error', $qe->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Roles::find($id);
        if(!$role || $role && $role->id == 1){
            abort(404);
        }

        $categories = Categories::select("id","title","link")->get();
        $accesses = Access::where("roles_id",$id)->get();

        $subcategories = SubCategories::select("id","categories_id","title","link")->get();
        $permissions = Permissions::where("roles_id", $id)->get();

        $categoriesAccess = array();

        foreach ($categories as $category) {
            foreach ($accesses as $access) {
                if($category->id === $access->categories_id){
                    array_push($categoriesAccess,[
                        "cid" => $category->id,
                        "title" => $category->title,
                        "link" => $category->link,
                        "id" => $access->id,
                        "role" => $access->roles_id,
                        "able" => $access->able,
                    ]);
                }
            }
        }

        $subcategoriesPermissions = array();

        foreach ($subcategories as $subcategory) {
            foreach ($permissions as $permission) {
                if($subcategory->id === $permission->sub_categories_id){
                    array_push($subcategoriesPermissions, [
                        "scid" => $subcategory->id,
                        "cid" => $subcategory->categories_id,
                        "title" => $subcategory->title,
                        "link" => $subcategory->link,
                        "id" => $permission->id,
                        "role" => $permission->roles_id,
                        "can_read" => $permission->can_read,
                        "can_create" => $permission->can_create,
                        "can_update" => $permission->can_update,
                        "can_delete" => $permission->can_delete,
                        "access" => $permission->access,
                    ]);
                }
            }
        }

        return view("admin.system.role-permission.edit", ["role" => $role, "cats" => $categoriesAccess, "subcats" => $subcategoriesPermissions]);
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
        $validator = Validator::make( $request->all(),[
            "rolename" => "bail|required|min:3",
        ],[
            "rolename.required" => "Nom du rôle est requis",
            "rolename.min" => "Nom du rôle doit avoir minimum :min lettres",
        ]);

        if($validator->fails()){
            Session::flash('error', $validator->errors()->first());
            return redirect()->back()->withInput();
        }

        if(Roles::where("name",$request->rolename)->where('id', '!=', $id)->first()){
            Session::flash('error', 'Nom du rôle Existe déja');
            return redirect()->back()->withInput();
        }

        try{
            Roles::find($id)->update([
                "name" => $request->rolename,
                "description" => $request->roledesc,
            ]);
        } catch (QueryException $qe) {
            Session::flash('error', $qe->getMessage());
            return redirect()->back()->withInput();
        }

        try {
            foreach ($request->access as $accessname => $value) {
                Access::where(["roles_id"=>$id,"categories_id"=>Categories::where("link",$accessname)->pluck('id')->first()])
                    ->update([
                        "able" => $value
                    ]);
            }
        } catch (QueryException $qe) {
            Session::flash('error', $qe->getMessage());
            return redirect()->back()->withInput();
        }

        try {
            foreach ($request->permissions as $name => $permission) {
                Permissions::where(["roles_id"=>$id,"sub_categories_id"=>SubCategories::where("link",$name)->pluck("id")->first()])
                    ->update([
                        "can_read" => $permission['can_read'],
                        "can_create" => $permission['can_create'],
                        "can_update" => $permission['can_update'],
                        "can_delete" => $permission['can_delete'],
                        "access" => $permission['access'],
                    ]);
            }
            Session::flash('success', "Role Modifier avec success");
            return redirect()->route('system-role-permission');
        } catch (QueryException $qe) {
            Session::flash('error', $qe->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Roles::find($id)->delete();
        } catch (QueryException $qe) {
            Session::flash('error', 'Role est assigné a un ou plusieurs utilisateurs');
            return redirect()->back()->withInput();
        }

        Session::flash('success', "Permissions supprimer avec succés");
        return redirect()->route('system-role-permission');

    }
}
