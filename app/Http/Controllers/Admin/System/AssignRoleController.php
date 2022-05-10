<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Middleware\Role;
use App\Models\Contacts;
use App\Models\Roles;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\QueryException;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AssignRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id','!=',1)->where('email','!=','superadmin@gmail.com')->get();
        return view("admin.system.assign-role.index", compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Roles::where('name','!=','superadmin')->get();
        $contacts = Contacts::all();
        return view("admin.system.assign-role.create", compact('roles','contacts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'password' => 'min:6|required',
                'confPassword' => 'bail|required|min:6|same:password',
                "assignRole" => "bail|required",
                "assignUser" => "bail|required",
            ],
            [
                "assignRole.required" => "Le champ Attribuer un rôle est obligatoire",
                "assignUser.required" => "Le champ Utilisateur est obligatoire",
                "password.required" => "Le champ mot de passe est obligatoire",
                "confPassword.required" => "Le champ confirmer mot de passe est obligatoire",
                "password.min" => "Le mot de passe doit comporter au moins :min caractères",
                "confPassword.min" => "Le mot de passe doit comporter au moins :min caractères",
                "confPassword.same" => "Le mot de passe de la confirmation et le mot de passe doivent correspondre.",
            ]);

        if($validator->fails()){
            Session::flash('error', $validator->errors()->first());
            return redirect()->back()->withInput();
        }
        try {
            $contact = Contacts::where('id', $request->assignUser)->first();
            $user = new User();
            $user->agencies_id = null;
            $user->email = $contact->email;
            $user->phone = $contact->phone;
            $user->password = Hash::make($request->password);
            $user->api_token = Str::random(60);
            $user->activated = $request->activated;
            $user->blocked = $request->blocked;
            $user->save();
            $contact->users_id = $user->id;
            $contact->save();
            $useRole = new UserRole();
            $useRole->users_id = $user->id;
            $useRole->roles_id = $request->assignRole;
            $useRole->save();
        } catch(QueryException $qe){
            Session::flash('error', 'Un utilisateur exist déja avec cet email');
            return redirect()->back()->withInput();
        }

        Session::flash('success', "Utilisateur créer avec succés");
        return redirect()->route('system-assign-role');
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
        $contact = Contacts::where('users_id',$id)->first();
        $user = User::find($id);
        $roles = Roles::where('name','!=','superadmin')->get();
        if(!$user){
            abort(404);
        }
        return view('admin.system.assign-role.edit',compact('user','roles','contact'));
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
        $validator = Validator::make($request->all(),
            [
                'password' => 'min:6|required',
                'confPassword' => 'bail|required|min:6|same:password',
                "assignRole" => "bail|required",
                "assignUser" => "bail|required",
            ],
            [
                "assignRole.required" => "Le champ Attribuer un rôle est obligatoire",
                "assignUser.required" => "Le champ Utilisateur est obligatoire",
                "password.required" => "Le champ mot de passe est obligatoire",
                "confPassword.required" => "Le champ confirmer mot de passe est obligatoire",
                "password.min" => "Le mot de passe doit comporter au moins :min caractères",
                "confPassword.min" => "Le mot de passe doit comporter au moins :min caractères",
                "confPassword.same" => "Le mot de passe de la confirmation et le mot de passe doivent correspondre.",
            ]);

        if($validator->fails()){
            Session::flash('error', $validator->errors()->first());
            return redirect()->back()->withInput();
        }
        try {
            User::where('id',$id)->update([
                'password' => Hash::make($request->password),
                'api_token' => Str::random(60),
                'activated' => $request->activated,
                'blocked' => $request->blocked
            ]);
            UserRole::where('users_id',$id)->update([
                'roles_id' => $request->assignRole
            ]);
        } catch(QueryException $qe){
            Session::flash('error', 'Somthing went wrong !');
            return redirect()->back()->withInput();
        }

        Session::flash('success', "Utilisateur mis a jour avec succés");
        return redirect()->route('system-assign-role');
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
            $user = User::find($id);
            if($user->contact){
                Contacts::where('users_id',$user->id)->update([
                    'users_id' => null,
                ]);
            }
            UserRole::where('users_id',$id)->delete();
            User::find($id)->delete();
            Session::flash('success', "Utilisateur supprimer avec succés");
            return redirect()->route('system-assign-role');
        } catch (QueryException $qe) {
            Session::flash('error', $qe->getMessage());
            return redirect()->back()->withInput();
        }
    }


}
