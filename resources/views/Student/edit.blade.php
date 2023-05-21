@extends('master')
@section('content')
  <div class="row pt-5">
    <div class="col-3"></div>
    <div class="col-6">
       <a href="{{route('student.index')}}" class="btn btn-success float-right">All Student</a>
    <h4>Edit Students</h4>
    <form action="{{route('student.update',$student_id->id)}}" method="post" enctype="multipart/form-data" id="form">
        @csrf
        @method('PUT')
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="input form-control"  name="name" value="{{$student_id->name}}" id="name" placeholder="Enter Name">
  </div>
  <div class="form-group">
    <label for="age">Age</label>
    <input type="text" name="age" class="input form-control" value="{{$student_id->age}}" id="age" placeholder="Enter Age">
  </div>
  <div class="form-group">
    <label for="profile">Profile</label>
    <input type="file" name="profile" class="input form-control" id="profile" value="{{$student_id->profile}}"  style="color: black;">
  <img src="/images/{{$student_id->profile}}" width="50px" >
</div>
  <div class="form-group">
    <label for="gender">Gender</label><br>
    <input type="radio" name="gender" id="gender" value="male" {{($student_id->gender ==  "male") ? "checked" : ""}}>
    <label for="gender">male</label>
    <input type="radio" name="gender" id="gender" value="female" {{($student_id->gender == "female") ? "checked" : ""}}>
    <label for="gender">Female</label>
  </div>
  @php 
  $hobby_value =json_decode($student_id->hobby);
  @endphp
  <div class="form-group hobbies">
    <label for="hobby">Hobby</label><br>
    <input type="checkbox" name="hobby[]" class="hobby" value="music" {{in_array('music',$hobby_value) ? "checked" : ""}}>
    <label for="gender">Music</label>
    <input type="checkbox" name="hobby[]" class="hobby" value="dance" {{in_array('dance',$hobby_value) ? "checked" : ""}}>
    <label for="gender">Dance</label>
    <input type="checkbox" name="hobby[]" class="hobby" value="drawing" {{in_array('drawing',$hobby_value) ? "checked" : ""}}>
    <label for="gender">Drawing</label></br>
    <span id="errorToShow"></span> 
  </div>
  <div class="form-group">
    <label for="country">Country</label><br>
    <select name="country" class="form-control">
        <option value="rajkot">Rajkot</option>
        <option value="ahemdavad">Ahemdavad</option>
        <option value="surat">Surat</option>
    </select>
  </div>
  <button type="submit" class="btn btn-success">Update</button>
</form>
    </div>
    <div class="col-3"></div>
  </div>  
@endsection
@push('script')
<script>
    $(document).ready(function () {
 
 $('#form').validate({ 
    rules:{
        name : {
            maxlength:50,
            minlength:5,
            required:true,
        },
        age : {
           range:[20,25],
            digits:true,
            required:true,
        },
        "hobby[]" : {
            required:true,
        },
    },
    messages:{
        name:{
            required:"Name is required",
        },
        age : {
            required:"Age is required",
        },
        "hobby[]" : {
            required:"Hobby is required",
        },
    },
    errorPlacement: function(error, element) {
        if (element.attr("name") == "hobby[]") {
                    error.appendTo("#errorToShow");
                } else {
                    error.insertAfter(element);
                }
    }
 });
});
</script>
@endpush