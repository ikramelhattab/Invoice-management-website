@extends('adminlte::page')

@section('htmlheader_title')
Add Customer
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
              <h3 class="box-title">Add Customer</h3>
            </div>

          <div class="box-body">


 <form role="form" action="{{ action('ClientController@store') }}" method="post"> 



    @csrf
 <div class="form-group">
      <label for="title">Registration number</label>
      <input class="form-control" type="text" name="matricule" placeholder="Registration number" id="title" />
    </div>

    <div class="form-group">
      <label>Customer name</label>
      <input class="form-control" type="text" name="nom" placeholder="Customer name" />
    </div>



 <div class="form-group">
      <label>Adress</label>
      <input class="form-control" type="text" name="adresse" placeholder="Adress" />
    </div>



 <div class="form-group">
      <label>Purchase order</label>
      <input class="form-control" type="text" name="bon_commande" placeholder="Purchase order" />
    </div>

 <div class="form-group">
      <label>Date </label>
      <input class="form-control" type="date" name="date_commande" placeholder="date" />
    </div>


<button class="btn btn-primary" type="submit">Submit</button>

<a href="{{action('ClientController@index')}}" class="btn btn-default">Back</a>

  </form>
                    
</div>
</div>

@endsection
