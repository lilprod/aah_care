@extends('pharmacies.layouts.app')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">Welcome Admin Pharmacy!</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item active">Dashboard</li>
            </ul>
        </div>
    </div>
</div>
<!-- /Page Header -->  

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <!--<div class="card-header">{{ __('Dashboard Admin Pharmacy') }}</div>-->

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                {{ __('You are logged in!') }}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
        <div class="card-header">
            <h5 class="card-title"><i class='fa fa-search'></i> Recherche </h5>
        </div>

        <div class="card-body">
          <h5 align="center"><b>Nombre de Patient(s) :</b> <span id="total_records"></span></h5>

        <div class="row">
             <div class='col-lg-4 col-md-6 col-sm-12'>
            </div> 
            
            <div class='col-lg-4 col-md-6 col-sm-12'>
              <div class="form-group">
                  <input type="text" name="search" id="search" class="form-control" placeholder="Recherche" />
              </div>
            </div>
            
             <div class='col-lg-4 col-md-6 col-sm-12'>
            </div>
        </div>

            <div class="dt-responsive">
              <table class="table">
                  <thead>
                      <tr>
                        <th>Matricule</th>
                        <th>Nom</th>
                         <th>Prénoms</th>
                         <th>Email</th>
                         <th>Téléphone</th>
                         <th>Action</th>
                    </tr>
                   </thead>
                   <tbody id="tbody">

                   </tbody>
                </table>
            </div>
      </div>
    </div>
    </div>    
</div>


@endsection

@push('dashboard')
<script>
 $(document).ready(function(){

 fetch_patient_data();

 function fetch_patient_data(query = '')
 {
  $.ajax({
   url:"{{ route('patient_search.action') }}",
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {
    $('#tbody').html(data.table_data);
    $('#total_records').text(data.total_data);
   }
  })
 }

 $(document).on('keyup', '#search', function(){
  var query = $(this).val();
  console.log(query);
  /*if(query===''){
    $('tbody').html("");
    $('#total_records').text("");
  }else{
    fetch_customer_data(query);

  }*/
  fetch_patient_data(query);  
 });
});
</script>

@endpush
