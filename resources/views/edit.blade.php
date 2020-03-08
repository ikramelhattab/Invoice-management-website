@extends('adminlte::page')

@section('htmlheader_title')
	Update Client
@endsection


@section('main-content')
	  <div class="row">
        <div class="col-md-6 offset-md-3">
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
              <h3 class="box-title">Edit Customer</h3>
            </div>

          <div class="box-body">
            @foreach($clients as $client)

              <form role="form" action="{{ action('ClientController@update',$client->id) }}" method="post"> 
    @csrf
    @method('PUT')
    
    <div class="form-group">
      <label>Registration number</label>
      <input class="form-control" type="text" name="matricule" placeholder="Bon commande" value="{{$client->matricule}}" />
    </div>

     <div class="form-group">
                  <label> Customer name</label>
                  <input type="text" class="form-control" name="nom" placeholder="nom client" value="{{$client->nom}}">
                </div>



 <div class="form-group">
      <label>Adress</label>
      <input class="form-control" type="text" name="adresse" placeholder="adresse"  value="{{$client->adresse}}"/>
    </div>



 <div class="form-group">
      <label>Purchase order</label>
      <input class="form-control" type="text" name="bon_commande" placeholder="Bon commande" value="{{$client->bon_commande}}" />
    </div>

 <div class="form-group">
      <label>Date </label>
      <input class="form-control" type="Date" name="date_commande" placeholder="Date commande" value="{{$client->date_commande}}" />
    </div>


<button type="submit" class="btn btn-primary" type="submit">Update</button>

<a href="{{action('ClientController@index')}}" class="btn btn-default">Back</a>


  </form>
   @endforeach                 
</div>
</div>

@endsection
