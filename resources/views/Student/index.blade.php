@extends('master')
@section('content')
    <div class="row pt-5">
        <div class="col-1"></div>
        <div class="col-10">
       <h4>Students</h4>
        <a href="{{route('student.create')}}" class="btn btn-success float-right">Create Student</a>
        <select  name="cityFilter" id="cityFilter" class="float-right cityFilter mr-2">
        <option value="0">All City</option>
        <option value="rajkot">Rajkot</option>
        <option value="ahemdavad">Ahemdavad</option>
        <option value="surat">Surat</option>
       </select> 
       <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Age</th>
                <th>Profile</th>
                <th>Gender</th>
                <th>Hobby</th>
                <th>Country</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
        </div>
        <div class="col-1"></div>
    </div>

<div class="modal fade exampleModal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  id="" action="{{route('editmodel')}}" method="post">
            <input type="hidden" name="">
      <select  name="project" id="project" class="form-control project mr-2">
        <option value="">All Project</option>
         @foreach($projectList as $project)
         <option value="{{$project->id}}">{{$project->name}}</option>
         @endforeach
       </select> </br>

       <select  name="developer" id="developer" class="form-control developer mr-2">
        <option value="">All developer</option>
       </select> 
        </form>
      </div> 
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection
@push('script')

  
    <script type="text/javascript">
  
    function Data()
    {
        $('#cityFilter option[value="' + localStorage.getItem("filterCity") +'"]').attr("selected", "selected");

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        destroy:true,
        ajax: {
            url: "{{ route('student.getdata') }}",
            data: function (d) {
                //  d.cityFilterId = $('.cityFilter option:selected').val();
                 d.cityFilterId = localStorage.getItem("filterCity");
                 
            }
            },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'age', name: 'age'},
            {data: 'profile', name: 'profile'},
            {data: 'gender', name: 'gender'},
            {data: 'hobby', name: 'hobby'},
            {data: 'country', name: 'country'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
}

Data();

$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  $(document).on('click', '.delete_button', function (e) {
    e.preventDefault();
   var id = $(this).data('id');
  
   swal({
              title: `Are you sure you want to delete this record?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                        type: "post",
                        url: "{{route('student.delete')}}",
                        data: {
                            id: id,
                            "_token":"{{csrf_token()}}",
                        },
                        dataType: "json",
                        success: function(response) {
                            Data();
                        }
                    });
            }
          });
});

$('.cityFilter').on('change',function(){
    // var cityFilterId = $('.cityFilter option:selected').val();
    // var url = "{{route('student.filterdata', '')}}"+"/"+cityFilterId;
    //  window.location=url;
    localStorage.setItem("filterCity", this.value);

    // $.cookie("filterCity", this.value);
    Data();
});

function openModel(id)
{ 
  $('#exampleModal').show();
}

 $('.project').on('change',function(){
    $('.developer').empty();
    projectId= $(this).val();
    $.ajax({
        type: "post",
        url: "{{route('getdeveloper')}}",
        data: {
            projectId : projectId,
            "_token":"{{csrf_token()}}",
        },
        dataType: "json",
        success: function (response) { 
            $.each(response.developer, function(key,val) {             
                $('.developer').append('<option value="'+val.id+'">'+val.name+'</option>');
        });    
               
            
        }
    });
 });
</script>
@endpush
