<?php
namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait FileUploadTriat
{

public function uploadFile($request,$Name,$folder=''){
    $file_name=$request->file($Name)->getClientOriginalName();
    $request->file($Name)->storeAs('attachments/'.$folder,$file_name,'upload_attachments');
}
public function deleteUplodedFile($name){
    $exist=Storage::disk('upload_attachments')->exists('attachments/library/'.$name);
    if($exist){
        Storage::disk('upload_attachments')->delete('attachments/library/'.$name);
    }

}
}
