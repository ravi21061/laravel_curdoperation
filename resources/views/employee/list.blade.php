<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class=" py-3">
        <div class="container ">
            <div class="d-flex align-items-center justify-content-between py-2">
                <div class="h4 ">Employees</div>
                <div>
                    <a href="{{route('employees.create')}}" class="btn btn-primary">create</a>
                </div>
            </div>
           @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
           @endif
            <div class="card border-0 shadow-lg">
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>action</th>
                        </tr>
                        @if($employees->isNotEmpty())
                        @foreach ($employees as $employee)
                         <tr>
                            <td>{{$employee->id}}</td>
                            {{-- <td></td> --}}
                            <td>
                                @if($employee->image!='' && file_exists(public_path().'/uploads/employees/'.$employee->image))
                                <img src="{{url('uploads/employees/'.$employee->image)}}" alt="" width="50" height="50" class="rounded-circle">
                                @else
                                <img src="{{url('uploads/employees/nouserimg.png')}}" alt="" width="50" height="50" class="rounded-circle">
                               
                                @endif
                            </td>
                            <td>{{$employee->name}}</td>
                            <td>{{$employee->email}}</td>
                            <td>{{$employee->address}}</td>
                            <td>
                                <a href="{{route('employees.edit',$employee->id)}}" class="btn btn-primary">Edit</a>
                                <a href="#" class="btn btn-primary">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                       
                        @else
                        <tr>
                            <td colspan="6">Record Not found</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
            <div>
                {{$employees->links()}}
            </div>
        </div>
    </div>

</body>

</html>