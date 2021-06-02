@extends('pharmacies.layouts.app')

@section('content')
<!-- Page Header -->
<div class="page-header">
	<div class="row">
		<div class="col-sm-12">
			<h3 class="page-title">List of orders</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{route('pharmacy_dashboard')}}">Dashboard</a></li>
				<li class="breadcrumb-item"><a href="javascript:(0);">Orders</a></li>
				<li class="breadcrumb-item active">Orders</li>
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
				<table class="datatable table table-hover table-center mb-0">
					<thead>
						<tr>
							<th>#</th>
							<th>Supplier Name</th>
							<th>Order Date</th>
							<th>Order list</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($orders as $k=>$order)
						<tr>
							<td>{{$k+1}}</td>
							<td>Douglas Meyer</td>
							<td>10-5-2020</td>
							<td>Dolofin Antigripal(Dolo)  3</td>
							<td>
								<div class="actions">
									<a href="javascript:void(0);" class="btn btn-sm bg-danger-light" data-toggle="modal" data-target="#deleteConfirmModal" onclick="deleteData({{ $supplier->id}})">
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


<!-- Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<form action="" id="deleteForm" method="post">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="acc_title">Delete</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					{{ csrf_field() }}
	                    {{ method_field('DELETE') }}
					<p id="acc_msg">are you sure you want to delete?</p>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success si_accept_confirm">Delete</button>
					<button type="button" class="btn btn-danger si_accept_cancel" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- /Modal -->
   
@endsection

@push('order')
<script>
    function deleteData(id)
     {
         var id = id;
         var url = '{{ route("orders.destroy", ":id") }}';
         url = url.replace(':id', id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }
</script>
@endpush