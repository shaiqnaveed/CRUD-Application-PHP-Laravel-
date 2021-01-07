<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>

    <div class='container'>
    
        <div class="col-md-offset-2 col-8">
        
            <div class='row'>
                <h1 class="text-center">Todo List App</h1>
            </div>

            {{-- display success message --}}

            @if (Session::has('success'))
	        <div class="alert alert-success">
		    <strong>Success:</strong> {{ Session::get('success') }}
	        </div>
            @endif

            {{-- display error message --}}

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                <strong>Error:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row" style="margin-top: 10px; margin-bottom: 10px ">
                <form action="{{ route('tasks.store') }}" method='POST'>
                {{ csrf_field() }}
                    <div class="col-md-9">
                        <input type="text" class="form-control" name='taskName'>
                    </div>
                    <div class="col-md-3">
                        <input type='submit' class='btn btn-primary btn-block' value='Ad Task'>
                    </div>                
                </form>
            </div>


            {{-- display stored tasks --}}
            @if (count($storedTasks) > 0)
                <table class='table'>
                
                
                    <thead>
                        <th>Task #</th>
                        <th>Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    
                    
                    <tbody>
                        
                        @foreach ($storedTasks as $storedTask)
                        <tr>
                            <td>{{ $storedTask->id }}</td>
                            <td>{{ $storedTask->name }}</td>
                            <td><a href="{{ route( 'tasks.edit', [ 'tasks'=>$storedTask->id ]) }}" class="btn btn-default">Edit</a></td>
                            <td>
                                <form action= "{{ route( 'tasks.destroy', [ 'tasks'=>$storedTask->id ]) }}" method='POST'  >
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="submit" class="btn btn-danger" value="Delete">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>

                </table>
            
        
            @endif
            <div class="row text-center">
            {{ $storedTasks->links() }}
            </div>

        </div>

    </div>

</body>
</html>

