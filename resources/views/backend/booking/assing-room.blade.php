<form action="" method="POST">
    @csrf

    <table class="table">
        <tr>
            <th>Room Number</th>
            <th>Action</th>
        </tr>

        @foreach ($room_numbers as $roo_number)
            <tr>
                <td>{{ $roo_number->room_no }}</td>
                <td>
                    <a href="{{ route('assign_room_store', [$booking->id, $roo_number->id]) }}" class="btn bg-primary"><i
                            class="lni lni-circle-plus"></i></a>
                </td>
            </tr>
        @endforeach

    </table>



</form>
