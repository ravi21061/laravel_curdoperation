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
    <h2>This is create page</h2>
    
    <div class=" py-3">
        <div class="container ">
            <div class="d-flex align-items-center justify-content-between py-2">
                <div class="h4 ">Edit Employees</div>
                <div>
                    <a href="{{route('employees.index')}}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <form action="{{route('employees.update',$employee->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card border-0 shadow-lg">
                <div class="card-body">
                   <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control @error('name') is-invalid @enderror" value="{{old('name',$employee->name)}}">
                    @error('name')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                   </div>
                   <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" id="email" placeholder="Enter Email" class="form-control @error('email') is-invalid @enderror" value="{{old('email',$employee->email)}}">
                    @error('email')
                    <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                   </div>
                   <div class="mb-3">
                <textarea name="address" id="" cols="30" rows="10" class="form-control" placeholder="Enter Address" class="form-control">{{old('address',$employee->address)}}</textarea>
                   </div>
                   <div class="mb-3">
                    <label for="image" class="form-label"></label>
                    <input type="file" name="image" class="@error('image') is-invalid @enderror" >
                    @error('image')
                    <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                    @if($employee->image!='' && file_exists(public_path().'/uploads/employees/'.$employee->image))
                    <img src="{{url('uploads/employees/'.$employee->image)}}" alt=""  width="100" height="100">
                    @else
                    <img src="{{url('uploads/employees/nouserimg.png')}}" alt="" width="50" height="50" class="rounded-circle">
                   
                    @endif
                   </div>
                </div>

            </div>
            <button class="btn btn-primary my-2">Update </button>
            </form>
        </div>
    </div>
    
</body>
</html>