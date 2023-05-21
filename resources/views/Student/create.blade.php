@extends('master')
@section('content')
  <div class="row pt-5">
    <div class="col-3"></div>
    <div class="col-6">
       <a href="{{route('student.index')}}" class="btn btn-success float-right">All Student</a>
    <h4>Create Students</h4>
    <form action="{{route('student.store')}}" method="post" enctype="multipart/form-data" id="form">
    @csrf
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="input form-control" name="name" id="name" placeholder="Enter Name">
  </div>
  <div class="form-group">
    <label for="age">Age</label>
    <input type="text" name="age" class="input form-control" id="age" placeholder="Enter Age">
  </div>
  <div class="form-group">
    <label for="profile">Profile</label>
    <input type="file" name="profile" class="input form-control" id="profile" style="color:black">
  </div>
  <div class="form-group">
    <label for="gender">Gender</label><br>
    <input type="radio" name="gender" id="gender" value="male">
    <label for="gender">male</label>
    <input type="radio" name="gender" id="gender" value="female">
    <label for="gender">Female</label></br>
    <span id="errorToShowGender"></span> 
  </div>
  <div class="form-group hobbies">
    <label for="hobby">Hobby</label><br>
    <input type="checkbox" name="hobby[]" class="hobby" value="music">
    <label for="gender">Music</label>
    <input type="checkbox" name="hobby[]" class="hobby" value="dance">
    <label for="gender">Dance</label>
    <input type="checkbox" name="hobby[]" class="hobby" value="drawing">
    <label for="gender">Drawing</label></br>
    <span id="errorToShow"></span> 
  </div>
  <div class="form-group">
    <label for="country">Country</label><br>
    <select name="country" class="input form-control">
       <option value="">Select Country</option>
        <option value="rajkot">Rajkot</option>
        <option value="ahemdavad">Ahemdavad</option>
        <option value="surat">Surat</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    </div>
    <div class="col-3"></div>
  </div>  
@endsection
@push('script')
<script>
    $(document).ready(function () {

  jQuery.validator.addMethod("noSpace", function(value, element) { 
  return value.indexOf(" ") < 0 && value != ""; 
}, "No space please and don't leave it empty");

 $('#form').validate({ 
    rules:{
        name : {
            maxlength:50,
            minlength:5,
            required:true,
            noSpace: true,
        },
        age : {
            range:[20,25],
            digits:true,
            required:true,
        },
        profile : {
            required:true,
            extension: "png|jpeg|jpg",
           // filesize: 2,
        },
        "hobby[]" : {
            required:true,
        },
        country:{
            required:true,
        },
        gender:{
            required:true,
        }
    },
    messages:{
        name:{
            required:"Name is required",
        },
        age : {
            required:"Age is required",
        },
        profile : {
            required:"Profile is required",
            extension:"Extension must be jpg,png,jpeg",
           // filesize : "File Size is to 2 MB",
        },
        gender:{
            required:"Gender is required",
        },
        "hobby[]" : {
            required:"Hobby is required",
        },
        country :{
            required:"Country is required",
        },
    },
    submitHandler: function (form) {
    console.log("Submitted!");
    form.submit();
   },
    errorPlacement: function(error, element) {
              if (element.attr("name") == "hobby[]") {
                    error.appendTo("#errorToShow");
                } else {
                    error.insertAfter(element);
                }
                if (element.attr("name") == "gender") {
                    error.appendTo("#errorToShowGender");
                } else {
                    error.insertAfter(element);
                }
    }
 });
});
</script>
@endpush
