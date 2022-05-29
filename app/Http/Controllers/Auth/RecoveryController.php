<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Models\RecoveryCode;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\PasswordReset;

class RecoveryController extends Controller
{

    public function CodeView(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'recovery' => 'bail|required|email',
        ]);
        if($validator->fails()){
            Session::flash('error',$validator->errors()->first());
            return redirect()->back()->withInput();
        }
        try{
            $user = User::where('email',$request->recovery)->first();
            if($user)
            {
                $generateCode = new RecoveryCode();
                $generateCode->users_id = $user->id;
                $generateCode->code = rand(0000,9999);
                $generateCode->save();
                Mail::to($user->email)->send(new PasswordReset($generateCode->code));
                return view('Recovery.validationcode', compact('user'));
            }else
            {
                Session::flash('error', 'Utilisateur n\'existe pas ');
                return redirect()->back()->withInput();
            }

        }catch(QueryException $e){
            Session::flash('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function CodeVerification(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_recovery' => 'bail|required',
            'pwd_recovery' => 'bail|required'
        ]);
        if($validator->fails()){
            Session::flash('error',$validator->errors()->first());
            return redirect()->back()->withInput();
        }
        try
        {
            $code = RecoveryCode::where('users_id',$request->user_recovery)
            ->where('code',$request->pwd_recovery)
            ->first();
            if($code->code == $request->pwd_recovery)
            {
                return view('Recovery.newpassword',['user' => $request->user_recovery]);
                RecoveryCode::where('users_id',$request->user_recovery)
                ->where('code',$request->pwd_recovery)
                ->delete();
            }else{
                RecoveryCode::where('users_id',$request->user_recovery)
                ->where('code',$request->pwd_recovery)
                ->delete();
                Session::flash('error', 'Code non correct !');
                return redirect()->route('login');
            }
        }catch(QueryException $e)
        {
            Session::flash('error', 'Error has been happened !');
            return redirect()->back()->withInput();
        }
        
    }
    public function NewPasswordValidation(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'password' => 'bail|required',
            'confirmed' => 'bail|required',
            'user' => 'bail|required'
        ]);
        if($validator->fails()){
            Session::flash('error',$validator->errors()->first());
            return redirect()->back()->withInput();
        }
        try
        {
            if($request->password == $request->confirmed)
            {
                User::where('id',$request->user)->update([
                    'password' => Hash::make($request->password)
                ]);
                Session::flash('success', 'Mot de passe reinitialier avec succeé !');
                return redirect()->route('login');
            }else{
                Session::flash('error', 'SVP confirmer votre mot de passe !');
                return redirect()->back()->withInput();
            }
        }catch(QueryException $e)
        {
            Session::flash('error', 'Error has been happened !');
            return redirect()->back()->withInput();
        }
    }
}
