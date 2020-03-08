@extends('adminlte::page')

@section('htmlheader_title')
Update Invoice
@endsection


@section('main-content')
	 <div class="row">
        <div class="col-md-11 offset-md-3">
           @if($errors->any())
           <div class="alert alert-danger">
            <ul>
      @foreach($errors->all() as $error)
     <li>{{$error}}</li>
      @endforeach
    </ul>
    </div>
     @endif

 <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Invoice</h3>
            </div>

          <div class="box-body">
            
              <form role="form" action="{{ action('FactureController@update',$data->id) }}" method="post"> 
    @csrf
    @method('PUT')
    
                 <div class="form-group">
                 <label>Registration number</label>
                <input class="form-control" type="text" name="matricule" placeholder="Bon commande" value="{{$data->matricule}}" disabled="true" />
                 </div>

                  <div class="form-group">
                  <label>Customer name</label>
                  <input type="text" class="form-control" name="nom" placeholder="nom client" value="{{$data->nom}}" disabled="true" >
                </div>

 <div class="form-group">
      <label>Adress</label>
      <input class="form-control" type="text" name="adresse" placeholder="adresse"  value="{{$data->adresse}}" disabled="true" />
    </div>



<div class="repeater">
    <div data-repeater-list="category-group">
      <?php echo $output;?>
    </div>
<input data-repeater-create class="btn btn-primary glyphicon glyphicon-plus" value="+" type="button" />
    </div>


    <br>

<button type="submit" class="btn btn-primary" type="submit">Update</button>

<a href="{{action('FactureController@index')}}" class="btn btn-default">Back</a>


  </form>
               
</div>
</div>

@endsection
@push('jscripts')
<script src="{{ asset('/plugins/repeater/jquery.repeater.js') }}"></script>
<script src="{{ asset('/plugins/autocomplete/jquery.autocomplete.js') }}"></script>
<script>
var clients = <?php echo $autocomplete ;?>;
   jQuery(document).ready(function () {
    jQuery('#list_clients').dataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });
    });
  var repeater = jQuery('.repeater').repeater({
    // (Optional)
    // "show" is called just after an item is added.  The item is hidden
    // at this point.  If a show callback is not given the item will
    // have $(this).show() called on it.
    show: function () {
      //$('.jstree-category-div').jstree();
      $(this).slideDown();
    },
    // (Optional)
    // "hide" is called when a user clicks on a data-repeater-delete
    // element.  The item is still visible.  "hide" is passed a function
    // as its first argument which will properly remove the item.
    // "hide" allows for a confirmation step, to send a delete request
    // to the server, etc.  If a hide callback is not given the item
    // will be deleted.
    hide: function (deleteElement) {
      if(confirm('Are you sure you want to delete this element?')) {
        $(this).slideUp(deleteElement);
        //$('.jstree-category-div').jstree();
      }
    }
   });
   /*repeater.setList([
   {
      'category-group':[{'designation':'test',
      'quantite':'3',
      'prix_unitaire':'10',
      'date_creation':'11/12/2019'
    }]
    }
    ]);*/

/* <?php echo $data->items;?> */
   jQuery('#autocomplete').autocomplete({
    lookup: clients,
    onSelect: function (suggestion) {
      var idc = suggestion.data;
      jQuery('#id_client').val(idc);
      $.get('{{ url('/facture/getData') }}/' + idc, function(data){
        $('#matricule').val(data[0].matricule);
        $('#adresse').val(data[0].adresse);

      });
        //alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
    }
});   
</script>
@endpush