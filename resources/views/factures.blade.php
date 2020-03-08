@extends('adminlte::page')

@section('htmlheader_title')
	List Facture
@endsection


@section('main-content')
	   <div class="row">
        <div class="col-xs-12">
          <div class="box">

            
            <div class="box-header">

             <div class="col-md-1 text-right">
<a href="{{action('FactureController@create')}}" class="btn btn-primary glyphicon glyphicon-plus">Add</a>
               
</div>

 


 </div>

            <!-- /.box-header -->
            <div class="box-body">
              <table id="list_clients" class="table table-bordered table-hover">
                <thead>
                    <tr>
                            <th>Invoice number </th>
                            <th> Customer name </th>
                             <th> Registration number </th>
                             <th> Adress</th>
                            



                           
                         <th width="230"> Actions </th>
                        </tr>
                        
                          </thead>
                                <tbody>
                                 @foreach($cl as $facture)
                                 <tr>
                                    <td> {{ $facture ->id }} </td>

                                    <td>{{ $facture->nom}}</td>
                                    <td>{{ $facture->matricule}}</td>
                                    <td>{{ $facture->adresse}}</td>
                              
  

                                    

                                   
<td> 
      
     
<a href="{{action('FactureController@show',$facture->id)}}" class="btn btn-primary glyphicon glyphicon-eye-open"> Show</a>

<a href="{{action('FactureController@edit',$facture->id)}}" class="btn btn-warning glyphicon glyphicon-edit"> Edit</a>


 <button type="button" class="delete-modal btn btn-danger dlte-cl" data-toggle="modal" data-target="#delete" data-cltid="{{$facture->id}}">


            <span class="glyphicon glyphicon-trash"></span> Delete
        </button>
     
 </td>
                        </tr>           
@endforeach

</tbody>
 <tfoot>
                    <tr>
                    <th>Invoice number </th>
                            <th> Customer name </th>
                             <th> Registration number </th>
                             <th> Adress</th>
            
                         <th width="230"> Actions </th>
                        </tr>
                          </tfoot>                    
              </table>

                      </div>
               </div>
           </div>



</div>

 

<div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
            <h4 class="modal-title text-center" id="myModalLabely" >Confirm Invoice Deletion</h4>
             
            <form id="frmdlt" action="{{action('FactureController@destroy', -1)}}" method="post">

           @method('DELETE')

          @csrf   
       <div class ="modal-body">

  <p class="text-center">
Are you sure you want to delete this Invoice?
  </p>
<input type="hidden" name="clt" id="clt_id" value="">

</div>

            
<div class="modal-footer">

<button id="btn-close-del" type="button" data-href="{{action('FactureController@destroy', -1)}}" class="btn btn-success" data-dismiss="modal" >Cancel</button>
       
<button type="submit" class="btn btn-warning">Delete</button>

</div>

 </form>               
</div>
</div>
</div>
</div>
@endsection
@push('jscripts')
<script src="{{ asset('/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/plugins/datatables/dataTables.bootstrap.js') }}"></script>
<script>
   jQuery(document).ready(function () {
    jQuery('#list_clients').dataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });
    jQuery('.dlte-cl').on('click', function(){
      var url = jQuery('#frmdlt').attr('action').replace('-1', '') + jQuery(this).data('cltid');
      jQuery('#frmdlt').attr('action', url);
      return true;
    });
    jQuery('#delete').on('hidden.bs.modal', function () {
      var href = jQuery('#btn-close-del').data('href');
      jQuery('#frmdlt').attr('action', href);
    });
    });
</script>
@endpush