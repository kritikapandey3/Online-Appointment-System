@extends('admin.main.master')

@section('title','| Doctors')
@section('pagename','Doctors')
@push('css')
@toastr_css
@endpush
@section('content')
<div class="text-left">
    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#adddoctor">Add</a>
    <!-- Button trigger modal --> 
    <!-- Modal -->
    <div id="adddoctor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
            <div role="document" class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 id="exampleModalLabel" class="modal-title">Add Doctor</h5>
                  <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    {{ Form::open(['method' => 'post', 'route' => 'admin.doctor.store', 'files' => true]) }}

                    <div class="form-group">
                        {{ Form::label('doctor_name', 'Doctor Name:') }}
                        {{ Form::text('doctor_name', null ,['class' => 'form-control', 'placeholder' => 'Enter doctor name']) }}
                    </div>
                    
                    <div class="form-group">
                        {{ Form::label('doctor_degree', 'Doctor Degree:') }}
                        {{ Form::text('doctor_degree', null ,['class' => 'form-control', 'placeholder' => 'Enter doctor degree']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('doctor_information', 'Doctor Information:') }}
                        {{ Form::text('doctor_information', null ,['class' => 'form-control', 'placeholder' => 'Enter doctor information']) }}
                    </div>

                    <div class="form-group">
                      {{ Form::label('image', 'Image:') }}
                      {{ Form::file('image', ['class' => 'form-control-file']) }}
                    </div>

                    <div class="form-group">
                      <label for="department_id">Department</label>
                      <select class="form-control" name="department_id" id="department_id">
                        @foreach($depart as $key => $row)
                        <option value={{ $row->id}}>{{ $row->department_name }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                        <label for="day_id">Department</label>
                        <select class="form-control" name="day_id[]" id="day_id" multiple="multiple">
                          @foreach($day as $key => $days)
                          <option value={{ $days->id}}>{{ $days->day_name }}</option>
                          @endforeach
                        </select>
                      </div>
                          
                    <div class="form-group">       
                      <input type="submit" value="Add" class="btn btn-primary">
                    </div>
                  {{ Form::close() }}
                </div>
                <div class="modal-footer">
                  <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                  
                </div>
              </div>
            </div>
          </div>
    
    <script>
        $('#exampleModal').on('show.bs.modal', event => {
            var button = $(event.relatedTarget);
            var modal = $(this);
            // Use above variables to manipulate the DOM
            
        });
    </script>
</div>  
       {{-- @if(session()->has('message'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Success!</strong> {{ session()->get('message') }}
            </div>
       @endif --}}
      
       <div class="table-responsive">
           <table class="table table-bordered" id="example">
               <thead>
                   <tr>
                       <td>No.</td>
                       <td>Doctor Name</td>
                       <td>Degree</td>
                       <td>Department</td>
                       <td>Photo</td>
                       <td>Sitting Day</td>
                       <td>Action</td>
                   </tr>
               </thead>
               <tbody>
               @foreach($doctor as $key=> $doctors)
                   <tr>
                       <td>{{ $key + 1 }}</td>
                       <td>{{ $doctors->doctor_name }}</td>
                       <td>{{ $doctors->degree }}</td>
                       <td>{{ $doctors->department->department_name }}</td>
                      <td><img src="{{ asset('images/' . $doctors->image) }}" height="200" width="200"></td>
                       <td>
                       <?php foreach($doctors->days as $day) {
                       $let = $day->pivot->day_id;
                       $array = explode(',',$let);
                       $change = App\Day::whereIn('id',$array)->get();
                       foreach ($change as $chan) {
                       ?>
                       {{ $chan->day_name }}
                       <?php } } ?>
                      </td>
                       <td>
                           <a href="{{route('admin.doctor.edit',$doctors->id)}}"><i class="fa fa-edit text-primary fa-md"></i></a>
                           <a href="#" onclick="myFunc()"><i class="fa fa-trash text-danger fa-md"></i></a>
                           <form action="{{ route('admin.doctor.destroy',$doctors->id)}}" id="depart" method="POST">
                               @csrf
                               @method('DELETE')
                           </form>
                       </td>

                   </tr>
                @endforeach
               </tbody>
           </table>
       </div>
@endsection
@push('js')
@toastr_js
@toastr_render
<script>
    @if($errors->any())
          @foreach($errors->all() as $error)
           toastr.error('{{ $error }}','Error!');
          @endforeach
       @endif
$(document).ready(function() {
    $('#example').DataTable( {
    } );
} );
      function myFunc(){
        if(confirm('Are you sure you want to delete this doctor?')) {
          event.preventDefault();
          document.getElementById('depart').submit();
        }
      }
</script>
@endpush