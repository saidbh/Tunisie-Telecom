<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\True_;

class AuthController extends Controller
{
    function loginView(){
        return view('Auth.login');
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                "email" => "bail|required|email",
                "password" => "bail|required|min:6",
            ],
            [
                "email.required" => "email requis",
                "email.email" => "email mauvais format",
                "password.required" => "mot de passe requis",
                "password.min" => "mot de passe :min requis",
            ]);

        if($validator->fails()){
            Session::flash('error', $validator->errors()->first());
            return redirect()->back()->withInput();
        }

        if(Auth::attempt(["email"=>$request->email,"password"=>$request->password, "activated"=>1, "blocked"=>0, "archived"=>0])){
            if(Auth::user()->contact)
            {
                Session::put('user_type', Auth::user()->contact->first_name.' '.Auth::user()->contact->last_name);
            }
              return redirect()->route('admin.dashboard');

        }else {
            Session::flash('error', "Email ou mot de passe incorrect");
            return redirect()->back()->withInput();
        }
    }
    function registrationView(){
        return view('authentication.registration');

    }
    public function registration(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
//                "firstname" => "bail|required",
//                "lastname" => "bail|required",
                "email" => "bail|required|email",
                "phone" => "bail|required",
                "password" => "bail|required|min:6",
                "termsconditions" => "required|accepted"
            ],
            [
//                "firstname.required" => "pr??nom requis",
//                "lastname.required" => "nom requis",
                "email.required" => "email requis",
                "email.email" => "email mauvais format",
                "phone.required" => "num??ro requis",
                "password.required" => "mot de passe requis",
                "password.min" => "mot de passe :min requis",
                "termsconditions.required" => "vous devez accepter les terms et les conditions",
                "termsconditions.accepted" => "vous devez accepter les terms et les conditions",
            ]);

        if($validator->fails()){
            Session::flash('error', $validator->errors()->first());
            return redirect()->back()->withInput();
        }

        if(User::where("email", $request->email)->first()) {
            Session::flash('error', 'Email exist d??ja');
            return redirect()->back()->withInput();
        }

        if(User::where("phone", $request->phone)->first()) {
            Session::flash('error', 'Num??ro de t??l??phone exist d??ja');
            return redirect()->back()->withInput();
        }

        try{
            $user = new User();
            $user->first_name = $request->firstname;
            $user->last_name = $request->lastname;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->gender = "Male";
            $user->birthday = "1994-01-08";
            $user->password = Hash::make($request->password);
            $user->save();

            Session::flash('success', "Compte cr??er avec succ??s");
            return redirect()->route('login')->withInput(['email'=>$request->email]);

        }catch(QueryException $qe){
            Session::flash('error', $qe->getMessage());
            return redirect()->back()->withInput();
        }
    }
    function recoverPasswordView(){
        return view('Auth.recover-password');
    }

    public function recoverPassword(Request $request)
    {

    }

    function confirmEmail(){
        return view('Auth.confirm-email');
    }

    function lockScreen(){
        return view('Auth.lock-screen');
    }
}
