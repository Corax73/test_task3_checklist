@extends ('layouts.dashboard')

@section('content')	
<table border="5px" align="center">
                     <thead>
                        <th>Name</th>
                        <th>Id</th>
                        <th>Email</th>
                        <th>Created_at</th>
                        <th>Usersgroup id</th>
                        <th>Usersgroup name</th>
                        <th>Change usersgroup</th>
                        <th>Max count checklists</th>
                    </thead>
                    <tbody>
                       @foreach($users as $key => $user)
                           @if($user)
                        <tr>
                           <form method="POST" action="{{ route('change', $user -> id ) }}" accept-charset="UTF-8">
                                    @csrf
                            <td class="table-text">
                                <p><a href="{{ route('checklists', $user -> id) }}">{{ $user -> name }}</a></p>
                            </td>
                            <td class="table-text">
                                <p>{{ $user -> id }}</p>                                
                            </td>
                            <td class="table-text">
                                <p>{{ $user -> email }}</p>
                            </td>
                            <td class="table-text">
                                <p>{{ $user -> created_at }}</p>
                            </td>
                            <td class="table-text">
                                <p>{{ $user -> membershipID ? $user -> membershipID -> usersgroup_id : 'No set' }}</p>
                            </td>
                            <td class="table-text">
                                <p>{{ $usersGroupNames[$user -> id] }}</p>                                
                            </td>
                            <td class="table-text">
                                <p><select name="selection_group" class="select">
                                    @foreach($names as $name)
                                    <option value="{{ $name }}">{{ $name }}</option>
                                    @endforeach
                                </select></p>
                                <p><input type="submit" name="action" class="b1" value="Change"></p>
                            </td>
                            <td class="table-text">
                                <p>{{ $user -> max ? $user -> max -> max : 'No set' }}</p>
                                <label for="max">Enter max count users checklists:</label>
                                <input type="number" id="max" name="max" min="0" max="10"> 
                                @if ($errors->has('max'))
                                <span class="text-danger">{{ $errors->first('max') }}</span>
                                @endif
                                <p><input type="submit" name="action" class="b1" value="Set max"></p>
                            </td>
                            </form>
                        </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
@endsection