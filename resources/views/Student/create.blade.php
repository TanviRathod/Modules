<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <title>Document</title>
    <style>
        .error {
            color: red;
        }
        input {
            color: black;
        }
    </style>
</head>
<body>
  <div class="row pt-5">
    <div class="col-3"></div>
    <div class="col-6">
       <a href="{{route('student.index')}}" class="btn btn-success float-right">All Student</a>
    <h4>Create Students</h4>
    <form action="{{route('student.store')}}" method="post" enctype="multipart/form-data" id="form">
        @csrf
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name">
  </div>
  <div class="form-group">
    <label for="age">Age</label>
    <input type="text" name="age" class="form-control" id="age" placeholder="Enter Age">
  </div>
  <div class="form-group">
    <label for="profile">Profile</label>
    <input type="file" name="profile" class="form-control" id="profile" style="color:black">
  </div>
  <div class="form-group">
    <label for="gender">Gender</label><br>
    <input type="radio" name="gender" id="gender" value="male" checked>
    <label for="gender">male</label>
    <input type="radio" name="gender" id="gender" value="female">
    <label for="gender">Female</label>
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
    <select name="country" class="form-control">
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
</body>
</html>
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
        profile : {
            required:true,
            extension: "png|jpeg|jpg",
            filesize: 2,
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
        profile : {
            required:"Profile is required",
            accept:"Extension must be jpg,png,jpeg",
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