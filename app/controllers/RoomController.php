<?php

class RoomController extends Controller {

    // Open rooms
    public function create() {
        $tasks = Task::all()->lists('task_name', 'ID');
        return View::make('createRoom', compact('tasks') );
    }

    public function store() {
        $newRoom = new Room;
        //$newRoom->created_by = Auth::user()->id; //JOSH TODO
        $newRoom->task_fkey = Input::get('task');
        $existingKeys = Room::where('open', true)->lists('room_code');
        // generate random, unique string for room code
        $uniqueKey = false;
        while(!$uniqueKey) {
            $key = Str::random(4);
            $uniqueKey = !in_array($key, $existingKeys);
        }
        $newRoom->room_code = $key;
        $newRoom->open = 1;
        $newRoom->created_at = new DateTime();
        $newRoom->save();
        return Redirect::action('RoomController@viewOpenRooms'); // show open rooms
    }

    // Close Rooms
    public function viewOpenRooms() {
        //$openRooms = Room::where('created_by', Auth::user()->id)->where('open', 1)->get(); // JOSH TODO
        $openRooms = Room::where('open', 1)->get();
        //var_dump($openRooms->toArray()); die();
        foreach($openRooms as $currentRoom){
            $currentRoom->setAttribute('task', Task::where('id', $currentRoom->task_fkey)->first()->task_name);
        }
        return View::make('closeRooms', compact('openRooms'));
    }

    public function close($roomId) {
        $room = Room::where('id', $roomId)->first();
        if ($room != NULL) {
            $room->open = 0;
            $room->save();
        }
        return Redirect::to(URL::to("showroom")."/".$room->ID);
        // return Redirect::action('RoomController@viewOpenRooms');
    }

    // Remove responses from closed rooms
    public function viewClosedRooms() {
        $tasks = Task::all()->lists('task_name', 'id');
        $rooms = Room::where('open', 0)->get();
        foreach($rooms as $currentRoom){
            $currentRoom->setAttribute('task', Task::where('id', $currentRoom->task_fkey)->first()->task_name);
        }
        return View::make('roomSelect', compact('rooms'));
    }

    public function viewRoomData($roomId) {
        $roomResponses = ResponseDB::where('room_fkey', $roomId)->get();
        //var_dump($roomResponses->toArray()); die(); 
        $entries = 0;

        if (count($roomResponses) > 0) {
            $entries = count(ResponseData::where('response_fkey', $roomResponses[0]->id)->get());
            foreach($roomResponses as $currentResponse){
                $responseData = ResponseData::where('response_fkey', $currentResponse->id)->get();
                $currentResponse->setAttribute('data', $responseData); 
            }
            return View::make('roomData', compact('roomResponses', 'entries'));
        } else {
            // no responses 
            return Redirect::action('RoomController@viewClosedRooms'); 
        }
    }

    public function deleteRoomData($roomId, $responseId) {
        $response = ResponseDB::where('id', $responseId)->first();
        $data = ResponseData::where('response_fkey', $responseId)->get();
        $response->delete();
        foreach($data as $currentData){
            $currentData->delete();
        }
        return Redirect::action('RoomController@viewRoomData', ["roomId"=>$roomId]);
    }

}
