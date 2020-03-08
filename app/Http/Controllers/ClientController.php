<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Client;
use DB;
use Validator;


/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class ClientController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
    
    $clients = DB::table('clients')->get();
    return view('clients',['clients'=> $clients]);
  }



  public function create(Request $request)
    {
        /* $this->validate($request, [
        'matricule' => 'required|unique:user|matricule',
    ]); */

    return view('add');
    }



  /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        

    }

 public function store(Request $request)
    {

$request->validate ([
'matricule' => 'required',
'nom' =>'required',
'adresse' =>'required'


]);
        $matricule = $request->get('matricule');
        $nom = $request->get('nom');
        $adresse = $request->get('adresse');
        $bon_commande = $request->get('bon_commande');
        $date_commande = $request->get('date_commande');

$clients = DB::insert('insert into clients(matricule,nom,adresse,bon_commande,date_commande)value(?,?,?,?,?)',[$matricule,$nom,$adresse,$bon_commande,$date_commande]);
if($clients){
    $red=redirect('client')->with('reçu','Client ajouté');
}
else{
   $red=redirect('client/create')->with('echec','Client non ajouté');
}
return $red;
    }

public function edit($id)
    {
        $clients=DB::select('select * from clients where id=?',[$id]);
        return view('edit',['clients'=>$clients]);
    }
    
 public function update(Request $request, $id)
    {

$request->validate ([
'matricule' => 'required',
'nom' =>'required',
'adresse' =>'required',
'bon_commande' =>'required',
'date_commande' =>'required'


]);

        $matricule = $request->get('matricule');
        $nom = $request->get('nom');
        $adresse = $request->get('adresse');
        $bon_commande = $request->get('bon_commande');
        $date_commande = $request->get('date_commande');
       

$clients = DB::update('update clients set matricule=?,nom=?,adresse=?,bon_commande=?,date_commande=? where id=?',[$matricule,$nom,$adresse,$bon_commande,$date_commande,$id] );

if($clients){
    $red=redirect('client')->with('reçu','Client ajouté');
}
else{
   $red=redirect('client/create')->with('echec','Client non ajouté');
}
return $red;

    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clients =DB::delete('delete from clients where id=?',[$id]);
        $red =redirect('client');
          return $red;
  
    }


}