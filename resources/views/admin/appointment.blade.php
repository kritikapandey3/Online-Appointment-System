@extends('admin.main.master')

@section('title','| Appointments')
@section('pagename','Appointments')
@push('css')
@toastr_css
@endpush
@section('content')
<div class="">
    {{ Form::open(['method' => 'post', 'route' => 'admin.appoint.choice']) }}
        <div class="form-group">
          <select class="form-control" name="select_doctor" id="select_doctor">
               @foreach ($doctor as $d)
             <option value={{ $d->id }}
                <?php if($d->id == $id) echo "selected"; ?>>{{ $d->doctor_name }}</option>
             @endforeach
          </select>
          <input type="submit" value="Change">
        </div>
    </form>
  </div>
       <div class="table-responsive">
           <table class="table table-bordered" id="example">
               <thead>
                   <tr>
                       <td>No.</td>
                       <td>Patient Name</td>
                       <td>Email</td>
                       <td>Phone</td>
                       <td>Department</td>
                       <td>Doctor</td>
                       <td>Booking Day</td>
                       <td>Booking Date</td>
                       {{--<td>Message</td>--}}
                       <td>Action</td>

                   </tr>
               </thead>
               <tbody>
                  @foreach ($appoint as $key => $a)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $a->patient_name }}</td>
                        <td>{{ $a->patient_email }}</td>
                        <td>{{ $a->appointment_phone }}</td>
                        <td>{{ $a->department->department_name }}</td>
                        <td>{{ $a->doctor->doctor_name }}</td>
                        <td>{{ $a->day->day_name }}</td>
                        <td>{{ $a->adate }}</td>
                        {{--<td>{{ $a->comment }}</td>--}}

                        <td>
                            <a href="#"><i class="fa fa-edit text-primary fa-md"></i></a>
                            <a href="#" onclick="myFunc()"><i class="fa fa-trash text-danger fa-md"></i></a>
                            <form action="#" id="appoint" method="POST">
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
        if(confirm('Are you sure you want to delete this appointment?')) {
          event.preventDefault();
          document.getElementById('appoint').submit();
        }
      }
</script>
@endpush