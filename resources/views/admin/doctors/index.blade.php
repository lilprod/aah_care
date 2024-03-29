@extends('admin.layouts.app')

@section('content')
<!-- Page Header -->
<div class="page-header">
	<div class="row">
		<div class="col-sm-12">
			<h3 class="page-title">List of Doctors</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
				<li class="breadcrumb-item"><a href="javascript:(0);">Users</a></li>
				<li class="breadcrumb-item active">Doctor</li>
			</ul>
		</div>
	</div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-md-12">
        @include('inc.messages')
    </div>
</div>

<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="datatable table table-hover table-center mb-0">
						<thead>
							<tr>
								<th>Doctor Name</th>
								<th>Speciality</th>
								<th>Member Since</th>
								<!--<th>Earned</th>-->
								<th>Account Status</th>.
								<th>Actions</th>
								
							</tr>
						</thead>
						<tbody>
							@foreach ($doctors as $i=>$doctor)
							<tr>
								<td>
									<h2 class="table-avatar">
										<a href="#" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="{{url('/storage/profile_images/'.$doctor->profile_picture ) }}" alt="User Image"></a>
										<a href="#">@if($doctor->title != ''){{ $doctor->title }}.@endif {{ $doctor->name }} {{ $doctor->firstname }}</a>
									</h2>
								</td>
								<td></td>
								
								<td>{{ $doctor->created_at->format('F d, Y h:ia') }}</td>
								
								<!--<td>$3100.00</td>-->
								
								<td>
									<div class="status-toggle">
										<!--<input type="checkbox" id="status_1" class="check" checked>-->
										 <input data-id="{{$doctor->id}}" id="status_{{$i}}" class="check" type="checkbox" data-on="Active" data-off="InActive" {{ $doctor->user->is_activated ? 'checked' : '' }}>
										<label for="status_{{$i}}" class="checktoggle">checkbox</label>
									</div>
								</td>

								<td class="text-right">

                                    <div class="actions">
                                        <a class="btn btn-sm bg-success-light" href="{{ URL::to('doctors/'.$doctor->id.'/edit') }}">
                                            <i class="fe fe-pencil"></i> Edit
                                        </a>
                                        <a data-toggle="modal" href="#" data-target="#delete_doctor" onclick="deleteData({{ $doctor->id}})" class="btn btn-sm bg-danger-light">
                                            <i class="fe fe-trash"></i> Delete
                                        </a>
                                    </div>

                                </td>
							</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>			
	</div>


<div id="delete_doctor" class="modal fade delete-modal" role="dialog">
	<div class="modal-dialog modal-dialog-centered">
		<form action="" id="deleteForm" method="post">
			<div class="modal-content">
				<div class="modal-body text-center">
					{{ csrf_field() }}
                    {{ method_field('DELETE') }}
					<!--<img src="/assets/assets/img/sent.png" alt="" width="50" height="46">-->
					<h3>Etes-vous sûr(e) de vouloir supprimer ce Doctor?</h3>
				</div>
				<div class="m-b-20 text-center"> 
					<a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
					<button type="submit" class="btn btn-danger">Delete</button>
				</div>
			</div>
		</form>
	</div>
</div>

@endsection

@push('doctor')

<script>
    $('.check').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var doctor_id = $(this).data('id'); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{!!URL::route('changeStatus')!!}',
            data: {'status': status, 'doctor_id': doctor_id},
            success: function(data){
              console.log(data.success)
            }
        });
    })
</script>

<script>
function deleteData(id)
     {
         var id = id;
         var url = '{{ route("doctors.destroy", ":id") }}';
         url = url.replace(':id', id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }
</script>
@endpush