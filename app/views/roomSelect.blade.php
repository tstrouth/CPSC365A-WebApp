


    <script>
        @foreach($rooms as $room)
            $("#room{{$room->id}}").click(function(){
                window.location = $(this).data("url");
            });
        @endforeach
    </script>


    <div class="row">
        <table>
            <tr>
                <th>Created By</th>
                <th>Created At</th>
                <th>Task</th>
            </tr>
            <tbody>
                @foreach($rooms as $currentRoom)
                    <tr id="room".{{$currentRoom->id}} class="clickable-row" data-url="{{ action('RoomController@viewRoomData', ['roomId'=>$currentRoom->id]) }}">
                        <td>{{$currentRoom->created_by}}</td>
                        <td>{{$currentRoom->created_at}}</td>
                        <td>{{$currentRoom->task}}</td>
                    </tr>
                @endforeach
            </tbody>
            <table
        </table>
    </div>

