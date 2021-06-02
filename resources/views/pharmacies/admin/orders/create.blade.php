@extends('pharmacies.layouts.app')

@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">Orders</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('pharmacy_dashboard')}}">Orders</a></li>
                <li class="breadcrumb-item"><a href="javascript:(0);">Orders</a></li>
                <li class="breadcrumb-item active">New Order</li>
            </ul>
        </div>
    </div>
</div>


<div class="col-md-12">
    @include('inc.messages')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">New Order</h4>
            </div>
        </div>

        <form method="POST" action="{{ route('orders.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                    
                <div class="row">

                    <div class="col-lg-4 col-lg-offset-4">
                      <div class="form-group">
                        <label> Fourniseur</label>
                        <div class="form-group">
                            <select class="form-control select" name="supplier_id">
                                @foreach($suppliers as $supplier)
                                    <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                @endforeach
                            </select>
                        </div>
                      </div>
                    </div>

                </div>

                <table id="dynamic_field" class="table table-striped table-bordered">
                  <thead>
                      <tr>
                          <th><label>Médicament</label></th>
                          <th><label>Description</label></th>
                          <th><label>Quantité</label></th>
                          <th><label>P.U. HT</label></th>
                          <th><label>P.U. TT</label></th>
                          <th><label>Montant</label></th>
                          <th><button class="btn btn-primary" title="Ajouter Article" id="add" type="button"><i class="fa fa-plus"></i></button> </th>
                      </tr>
                  </thead>

                  <tbody>

                    <tr>

                      <td>
                        <div class="form-group">
                          <select class="form-control article" id="drug_id[]" name="drug_id[]" required>
                            @foreach($drugs as $drug)
                              <option value="{{$drug->id}}">{{$drug->name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </td>

                      <td>
                        <div class="form-group">
                          <input class="form-control" name="designation[]" type="text" value="" id="designation[]">
                        </div>
                      </td>



                      <td>
                        <div class="form-group">
                          <input class="form-control qty" name="quantity[]" type="number" value="" id="quantity" required>
                        </div>
                      </td>

                      <td>
                        <div class="form-group">
                           <input class="form-control price" name="price[]" type="number" value="" id="price[]" required>
                        </div>
                      </td>

                      <td>
                        <div class="form-group">
                          <input class="form-control price" name="price[]" type="number" value="" id="price[]" required>
                        </div>
                      </td>

                      <td>
                        <div class="form-group">
                          <input class="form-control amount" name="amount[]" type="number" value="" id="amount[]">
                        </div>
                      </td>
                     
                   
                      <td style="border: none;"></td>

                    </tr>
                  </tbody>
                  <tfoot>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                    <td><b>Total</b></td>
                    <td><b class="total"></b></td>

                  </tfoot>
              </table>

            </div>



            <div class="card-footer">
                <div class="m-t-20 text-center">
                    <button class="btn btn-primary submit-btn">Add Supplier</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('add_order')

<script type="text/javascript">

$(document).ready(function(){  
      var i=1; 
      @php $j = 1; @endphp
      $('#add').click(function(){ 
          //var con = 'etats_'+i+'[]'; 
          //"etats_'+i+'"
           $('#dynamic_field').append('<tr id="row'+i+'"><td><div class="form-group"><select class="form-control article" id="article_id[]" name="article_id[]" required>@foreach($articles as $article)<option value="{{$article->id}}">{{$article->title}}</option>@endforeach</select></div></td><td><div class="form-group"><input class="form-control" name="designation[]" type="text" value="" id="designation[]"></div></td><td><div class="form-group"><input class="form-control qty" name="quantity[]" type="number" value="" id="quantity" required min="0"></div></td><td><div class="form-group"><select class="form-control tidy" id="tidy" name="tidy[]" required><option value="Cintre">Cintre</option><option value="Plie">Vêtement Plié</option></select></div></td><td><div class="form-group"><input class="form-control price" name="price[]" type="number" value="" id="price[]" required></div></td><td><div class="form-group"><input class="form-control amount" name="amount[]" type="number" value="" id="amount[]"></div></td><td style="width: 15%"> @foreach ($etats as $etat)<input name="etats_'+i+'[]" type="checkbox" value="{{$etat->id}}"> <label>{{$etat->title, ucfirst($etat->title)}}</label><br> @endforeach</td><td><button type="button" name="remove" id="'+i+'" class="btn bg-red btn_remove">X</button></td></tr>'); 
              $('.article').trigger('change');
              i++;
              console.log('j ==== '+"{{ $j }}")
      });  

      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();
           total();
      }); 

      $('#submit').click(function(){            
           $.ajax({  
                url:"name.php",  
                method:"POST",  
                data:$('#add_name').serialize(),  
                success:function(data)  
                {  
                     alert(data);  
                     $('#add_name')[0].reset();  
                }  
           });  
      });

        $('#mode_reglement').on('change', function (e) {
            var optionSelected = $("option:selected", this);
            var valueSelected = this.value;
            if((valueSelected === 'FLOOZ') ||  (valueSelected === 'T-MONEY') ||  (valueSelected === 'AUTRE')){
              $('#reference_div').show();
            }else{
              $('#reference_div').hide()
            }
        });

      $('tbody').delegate('.article','change',function (){
        var tr = $(this).parent().parent().parent();
        var id = tr.find('.article').val();
        var e = $('#action').val();
        var dataId={'id':id, 'unit':e};

        $.ajax({
          type : 'GET',
          url : '{!!URL::route('findPrice')!!}',
          dataType: 'json',
          data : dataId,
          success:function(data){
            //console.log(data)
            tr.find('.price').val(data);
          }
        });
      });

      $('.article').trigger('change');

      

      $('tbody').delegate('.article','change',function (){
        var tr = $(this).parent().parent().parent();
          tr.find('.qty').focus();
          total();
      });
      
      $('tbody').delegate('.qty,.price','keyup',function (){
        var tr = $(this).parent().parent().parent();
          var qty= tr.find('.qty').val();
          var price = tr.find('.price').val();
          //console.log(price);
          var amount= (qty * price);
          tr.find('.amount').val(amount);
          total();
      });
 });  

function total() 
{
  var total = 0;
  $('.amount').each(function(i,e){
    var amount = $(this).val()-0;
    total +=amount;
  })
  $('.total').html(total);
};

  Date.prototype.addDays = function(days) {
      var date = new Date(this.valueOf());
      date.setDate(date.getDate() + days);
      return date;
  };

  var date = new Date();
  //alert(date.addDays(5));
  document.getElementById('date_retrait').valueAsDate = date.addDays(2);

 </script>

@endpush