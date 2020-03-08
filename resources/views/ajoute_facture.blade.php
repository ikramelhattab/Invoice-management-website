@extends('adminlte::page')

@section('htmlheader_title')
    Add Invoice
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
              <h3 class="box-title">Add Invoice</h3>
            </div>

          <div class="box-body">

<form action="{{ url('/facture/save')}}" method="post" role="form" id="formulaire">
    
        @csrf

 <div class="input-group input-group-sm">

<input type="hidden" id="id_client" name="id_client">
<input  type="text" id="autocomplete" class="form-control" placeholder="Customer name">                    
                     <span class="input-group-btn">
                      <a type="button" class="btn btn-info btn-flat" href="{{action('ClientController@index')}}">+</a>
                    </span>
</div>

   <br>
                                


              <div class="form-group">
                <input type="text" class="form-control" id="matricule" placeholder="Registration number">    
              </div>
<br>

              <div class="form-group">

                <input type="text" class="form-control" id="adress" placeholder="Adress">

              </div>

<br>

    <div class="repeater">
    <div data-repeater-list="category-group">
        <div data-repeater-item >
        <input type="text" name="designation" placeholder="Designation" id="designation" class="input-lg"  />
       <input type="text" name="quantite" placeholder="Amount" id="quantite" class="input-lg"  />
        <input type="text" name="prix_unitaire" placeholder="Unit price" id="prix" class="input-lg" /> 


       <input  data-repeater-delete class="delete-modal btn btn-danger btn-lg " value="-" type="button" />
      </div>
    </div>
    <input data-repeater-create class="btn btn-primary glyphicon glyphicon-plus" value="+" type="button" />
    <br>
    <br>
       <button class="btn btn-primary " type="submit" id="submit" name="submit">Submit</button>
       <a href="{{action('FactureController@index')}}" class="btn btn-default">Back</a>


    </div>

    
<br>
<br>

</form>

</div>
</div>
@endsection


@push('jscripts')
<script src="{{ asset('/plugins/repeater/jquery.repeater.js') }}"></script>
<script src="{{ asset('/plugins/autocomplete/jquery.autocomplete.js') }}"></script>
<script>
var clients = <?php echo $autocomplete ;?>;
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