<?php

class RoomController extends Controller {

    // Open rooms
    public function create() {
        $tasks = Task::all()->lists('task_name', 'id'); // cols: id, task_name
        return view::make('createRoom', array('tasks') );
    }

    public function store() {
        $newRoom = new Room;
        $newRoom->createdBy = Auth::user()->id;
        $newRoom->task_fkey = Input::get('task');
        $existingKeys = Room::all()->list('room_code');
        // generate random, unique string for room code
        $uniqueKey = false;
        while(!$uniqueKey) {
            $key = Str::random(8);
            $uniqueKey = !in_array($key, $existingKeys);
        }
        $newRoom->room_code = $key;
        $newRoom->save();
        return Redirect::action('RoomController@viewOpenRooms');
    }

    // Close Rooms
    public function viewOpenRooms() {
        $rooms = Room::where('created_by', Auth::user()->id)->where('open', 1)->get();
        $openRooms = [];
        foreach ($rooms as $currentRoom){
            $openRooms[$room->id] = 'Created At '.$room->created_at;
        }
        return view::make('closeRooms', array('openRooms'));
    }

    public function close() {
        $roomId = Input::get('room');
        $room = Room::where('id', $roomId)->first();
        if ($room != NULL) {
            $room->delete();
        }

        return Redirect::action('RoomController@viewOpenRooms');
    }

    // Remove responses from closed rooms
    public function viewClosedRooms() {
        $tasks = Task::all()->lists('task_name', 'id');
        $rooms = Room::where('open', 0)->get();
        foreach($rooms as $currentRoom){
            $currentRoom->setAttribute('task', Task::where('id', $currentRoom->task_fkey)->first()->task_name);
        }
        return view::make('roomSelect', $rooms);
    }

    public function viewRoomData($roomId) {
        $roomResponses = Response::where('room_fkey', $roomId)->get();
        foreach($roomResponses as $currentResponse){
            $currentResponse->setAttribute('responseData', ResponseData::where('response_fkey', $currentResponse->id)->first());
        }
        return view::make('roomData', compact('roomResponses'));
    }

    public function deleteRoomData($roomId, $reponseId) {
        $currentResponse = Response::where('id', $responseId)->first();
        $currentData = ResponseData::where('response_fkey', $responseId)->first();
        $currentResponse->delete();
        $currentData->delete();
        return Redirect::action('RoomControler@viewRoomData', ["roomId"=>$roomId]);
    }

}
