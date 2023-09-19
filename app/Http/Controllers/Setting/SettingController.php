<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Traits\FileUploadTriat;

class SettingController extends Controller
{

    use FileUploadTriat;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $collction=Setting::all();
        $setting=$collction->flatMap(function($collction){
            return [$collction->key=>$collction->value];
        });

        return view('pages.setting.index',compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
        $settings=$request->except('_token','_method','logo');
        foreach($settings as $key=>$value){
            Setting::where('key',$key)->update(['value'=>$value]);
        }
        if($request->hasFile('logo')){
           $logo=$request->file('logo')->getClientOriginalName();
           Setting::where('key','logo')->update(['value'=>$logo]);
           $this->uploadFile($request,'logo','setting');

        }
        session()->flash('edit',trans('messages.Update'));
          return  redirect()->route('setting.index');
           }

            catch (\Exception $e){

                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
