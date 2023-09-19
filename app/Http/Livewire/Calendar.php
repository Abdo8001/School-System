<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Event;


class Calendar extends Component
{

    public $events ='';

    public function getevent()
    {
        $events = Event::select('id','title','start')->get();

        return  json_encode($events);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addevent($event)
    {
        $input['title'] = $event['title'];
        $input['start'] = $event['start'];
        Event::create($input);
    }



    /**
     * Write code on Method
     *
     * @return response()
     */
    public function eventDrop($event, $oldEvent)
    {
        $eventdata = Event::find($event['id']);
        $eventdata->start = $event['start'];
        $eventdata->save();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function render()
    {
      //  $this->dispatchBrowserEvent('livewire:load');

        $events = Event::select('id','title','start')->get();

        $this->events = json_encode($events);

        return view('livewire.calendar');
    }
//     public function delete($event)
//     {
//         //  $eventdata = Event::find($event['id']);
//            $this->eventdata->delete();
//            return json_encode($eventdata);
//    }

}


// //
//    eventClick: function(info) {
    // if (confirm("{{trans('admin_dashboard.Event_Delete')}}")) {
    //     var id = info.event.id;
    //     var eventDelete = id;
    //     @this.deleteevent(eventDelete);
    //     alert("{{trans('admin_dashboard.Deleted')}}");
    // }else{
    //     alert("{{trans('admin_dashboard.EventCancel')}}");
    // }
    // }
