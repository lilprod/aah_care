@extends('pharmacies.layouts.app')

@section('content')
<!-- Page Header -->
<div class="page-header">
	<div class="row">
		<div class="col-sm-12">
			<h3 class="page-title">List of suppliers</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{route('pharmacy_dashboard')}}">Dashboard</a></li>
				<li class="breadcrumb-item"><a href="javascript:(0);">Suppliers</a></li>
				<li class="breadcrumb-item active">Suppliers</li>
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
								<th>Supplier Name</th>
								<th>Email</th>
								<th>Phone number</th>
								<th>Location</th>
								<th>Added since</th>
								<th>Actions</th>
								
							</tr>
						</thead>
						<tbody>
							@foreach ($suppliers as $i=>$supplier)
							<tr>
								<td>
									<h2 class="table-avatar">
										<!--<a href="#" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="#" alt="User Image"></a>-->
										<a href="#"> {{ $supplier->name }}</a>
									</h2>
								</td>
								<td>{{ $supplier->email }}</td>
								<td>{{ $supplier->phone_number }}</td>
								<td>{{ $supplier->country }}, {{ $supplier->city }}, {{ $supplier->address }}</td>
								
								<td>{{ $supplier->created_at->format('F d, Y h:ia') }}</td>

								<td class="text-right">

                                    <div class="actions">
                                        <a class="btn btn-sm bg-success-light" href="{{ URL::to('suppliers/'.$supplier->id.'/edit') }}">
                                            <i class="fe fe-pencil"></i> Edit
                                        </a>
                                        <a data-toggle="modal" href="#" data-target="#delete_doctor" onclick="deleteData({{ $supplier->id}})" class="btn btn-sm bg-danger-light">
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
						<h3>Do you want to delete this Supplier?</h3>
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

@push('supplier')
<script>
	function deleteData(id)
     {
         var id = id;
         var url = '{{ route("suppliers.destroy", ":id") }}';
         url = url.replace(':id', id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }
</script>
@endpush