@extends ('layouts.dashboard')

@section('content')
<table border="5px" align="center">
                     <thead>
                        <th>Name</th>
                        <th>Id</th>
                        <th>User ID</th>
                        <th>User name</th>
                    </thead>
                    <tbody>
                       @foreach($checklists as $checklist)
                           @if($checklist)
                        <tr>
                           <form method="POST" action="{{ route('listChecklists', $checklist -> id ) }}" accept-charset="UTF-8">
                                    @csrf
                            <td class="table-text">
                                <p>{{ $checklist -> name }}</p>
                                <p><button type="submit" class="b1" value="List">List</button></p>
                            </td>
                            <td class="table-text">
                                <p>{{ $checklist -> id }}</p>                                
                            </td>
                            <td class="table-text">
                                <p>{{ $checklist -> whoUser -> id }}</p>
                            </td>
                            <td class="table-text">
                                <p>{{ $checklist -> whoUser -> name }}</p>
                            </td>
                            </form>
                        </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
@endsection