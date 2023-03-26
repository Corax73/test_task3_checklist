@extends ('layouts.dashboard')

@section('content')

<table border="5px" align="center">
                     <thead>
                        <th>Username</th>
                        <th>Checklist</th>
                        <th>Item</th>
                        <th>Item_id</th>
                        <th>Implementation</th>
                    </thead>
                    <tbody>
                       @foreach($items as $item)
                           @if($item)
                        <tr>
                           <form method="POST" action="" accept-charset="UTF-8">
                                    @csrf
                            <td class="table-text">
                                <p>{{ $item -> checklistId -> whoUser -> name }}</p>
                            </td>
                            <td class="table-text">
                                <p>{{ $item -> checklistId -> name }}</p>                                
                            </td>
                            <td class="table-text">
                                <p>{{ $item -> description }}</p>                                
                            </td>
                            <td class="table-text">
                                <p>{{ $item -> id }}</p>
                            </td>
                            <td class="table-text">
                                <p>{{ $item -> implementation }}</p>
                            </td>
                            </form>
                        </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
@endsection