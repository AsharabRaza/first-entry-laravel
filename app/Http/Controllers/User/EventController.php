<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{
    public function events(){

        $memberInfo = expireStatus(auth()->user()->id);
        if ($memberInfo && $memberInfo['status'] == false) {
            return view('dashboard.user.membership')->with(['membershipInfo' => $memberInfo]);
        }

        $this->data['events'] = Event::orderBy('id', 'DESC')->paginate(15);
        return view('dashboard.user.events',['data'=>$this->data]);
    }
    public function event_landing(Request $request){
        $slug = $request->event;

        $this->data['event'] = Event::where('slug', $slug)->first();

        $user_id = $this->data['event']->user_id;
        $this->data['other_events'] = Event::where('user_id', $user_id)
            ->where('slug', '!=', $slug)
            ->get();

        $this->data['user'] = User::find($user_id);

        return view('dashboard.user.event_landing_page',['data'=>$this->data]);
    }
    public function add_event(Request $request){

        if($request->isMethod('post')){

            $user_id = auth()->user()->id;
            $name = $request->input('name');
            $image = 'image here';
            $date = $request->input('date');
            $time = $request->input('time');
            $event_date = date('Y-m-d H:i:s', strtotime("$date $time"));
            $location = $request->input('location');
            $about_event = $request->input('about_event');
            $how_it_works = $request->input('how_it_works');
            $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $name) . '-' . uniqid();

            $filenameBanner = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('assets/images/media/'), $filenameBanner);

            $filenameAbout = $request->file('about_event_image')->getClientOriginalName();
            $request->file('about_event_image')->move(public_path('assets/images/media/'), $filenameAbout);

            $event = new Event;
            $event->user_id = $user_id;
            $event->name = $name;
            $event->image = $filenameBanner;
            $event->date = $date;
            $event->time = $time;
            $event->event_date = $event_date;
            $event->location = $location;
            $event->about_event = $about_event;
            $event->about_event_image = $filenameAbout;
            $event->how_it_works = $how_it_works;
            $event->slug = $slug;

            if($event->save()){
                $output['success'] = true;
                $output['msg'] = 'Event successfully added. Reloading.....';
            }else{
                $output['success'] = false;
                $output['msg'] = 'Something went wrong. Please try again later.';
            }

            return response()->json($output);

        }else{
            return view('dashboard.user.add_event',['data'=>$this->data]);
        }
    }
}
