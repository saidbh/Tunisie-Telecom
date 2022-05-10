<?php

namespace App\Http\Middleware;

use App\Models\Access;
use App\Models\Categories;
use App\Models\Permissions;
use App\Models\SubCategories;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouteAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
        $user = Auth::user();
        $category = null;
        $subcategory = null;
        $action = null;
        if(count(explode('.',$request->route()->action['as'])) == 2){
            $subcategory = explode('.',$request->route()->action['as'])[0];
            $action = explode('.',$request->route()->action['as'])[1];
        } else {
            $subcategory = explode('.',$request->route()->action['as'])[0];
            if($request->route()->action['except'] == $subcategory){
                return $next($request);
            }
        }

        if( array_key_exists('name', $request->route()->action) )
        {
            $category = $request->route()->action['name'];

        } else {
            $category = $request->route()->action['as'];
        }


        if($category){
            $CID = Categories::where('link',$category)->pluck('id')->first();

            if($category == 'contacts'){
                return $next($request);
            }

            if( Access::where('roles_id',$user->userRole->role->id)->where('categories_id', $CID)->pluck('able')->first() == 1 ){

                if($subcategory && $subcategory != $category){
                    $SCID = SubCategories::where('link',$subcategory)->pluck('id')->first();

                    if(!$SCID){
                        return $next($request);
                    }

                    if(Permissions::where('roles_id',$user->userRole->role->id)->where('sub_categories_id', $SCID)->pluck('access')->first() == 1){

                        if(in_array($action, ['create','edit','update','destroy'])){
                            if(($action == 'create' || $action == 'store') && Permissions::where('roles_id',$user->userRole->role->id)->where('sub_categories_id', $SCID)->pluck('can_create')-> first() == 1){
                                return $next($request);
                            } else if(($action == 'edit' || $action == 'update') && Permissions::where('roles_id',$user->userRole->role->id)->where('sub_categories_id', $SCID)->pluck('can_update')->first() == 1){
                                return $next($request);
                            } else if($action == 'destroy' && Permissions::where('roles_id',$user->userRole->role->id)->where('sub_categories_id', $SCID)->pluck('can_delete')->first() == 1){
                                return $next($request);
                            } else{
                                abort(404);
                            }
                        } else {
                            return $next($request);
                        }

                    } else {
                        abort(404);
                    }
                } else {
                    return $next($request);
                }

            } else {
                abort(404);
            }
        }else {
            abort(404);
        }
    }
}
