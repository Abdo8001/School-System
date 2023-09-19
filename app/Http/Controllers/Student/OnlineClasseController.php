<?php
namespace App\Http\Controllers\Student;


use App\Http\Controllers\Controller;
use App\Models\OnlineClasse;
use App\Models\Grade;
use App\Http\Traits\ZoomMeetings;
use MacsiDigital\Zoom\Facades\Zoom;

use Illuminate\Http\Request;

class OnlineClasseController extends Controller
{
   use ZoomMeetings;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $online_classes = OnlineClasse::where('created_by',auth()->user()->email)->get();
        return view('pages.online_classes.index', compact('online_classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Grades = Grade::all();
        return view('pages.online_classes.add', compact('Grades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

         try {
            $meeting = $this->createMeeting($request);

            OnlineClasse::create([
                'integration' => true,
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'created_by' => auth()->user()->email,
                'meeting_id' => $meeting->id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $meeting->duration,
                'password' => $meeting->password,
                'start_url' => $meeting->start_url,
                'join_url' => $meeting->join_url,
            ]);
            session()->flash('add',trans('messages.success'));
             return redirect()->route('zoom.index');

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(OnlineClasse $onlineClasse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OnlineClasse $onlineClasse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OnlineClasse $onlineClasse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
      try{  //dd($request);
        $meeting=Zoom::meeting()->find($request->meeting_id);
       $meeting->delete();
       OnlineClasse::where('meeting_id',$request->meeting_id)->delete();
       session()->flash('add',trans('messages.success'));
       return redirect()->route('zoom.index');

  } catch (\Exception $e) {
      return redirect()->back()->with(['error' => $e->getMessage()]);
  }

    }
}
