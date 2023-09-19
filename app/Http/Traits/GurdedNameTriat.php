<?php
namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;
use App\Providers\RouteServiceProvider;


trait GurdedNameTriat
{
public function getGurdedName($request){
    if($request->type=='student'){

       $gurded_name='student';
    }elseif($request->type=='parent'){
        $gurded_name='parent';

    }elseif($request->type=='teacher'){
        $gurded_name='teacher';

    }
    else{
        $gurded_name='web';

    }
    return $gurded_name;

}
public function redirect_To($request){
    if($request->type=='student'){
       // return redirect()->route('Classrooms.index');
       return redirect()->intended(RouteServiceProvider::STUDENT);

     }elseif($request->type=='parent'){
           return redirect()->intended(RouteServiceProvider::PERANT);

     }elseif($request->type=='teacher'){
        return redirect()->intended(RouteServiceProvider::TEACHER);

     }
     else{
        return redirect()->intended(RouteServiceProvider::HOME);

     }


}

}

