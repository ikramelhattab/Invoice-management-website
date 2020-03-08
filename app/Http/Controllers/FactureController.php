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
use PDF;
use DateTime;
use NumberToWords\NumberToWords;


/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class FactureController extends Controller
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
        $client = DB::table('factures')
            ->join('clients', 'factures.id_client', '=', 'clients.id')
            ->select('factures.*', 'clients.nom','clients.matricule','clients.adresse')
            ->get();



       return view('factures',[
        'cl' => $client,
    ]);
  }





  public function client($id){
    $client = DB::table('clients')->where('id', $id)->get();
    return response()->json($client);
  }


/*
public function postUpdate(Request $request){
    $data = $request->all();
    $id_client = $data['id_client'];
    $items = json_encode($data['category-group']);
    $factures = DB::update('update factures set items=?',[$items]);


  }*/



  public function postCreate(Request $request){
    $data = $request->all();
    $id_client = $data['id_client'];
    $items = json_encode($data['category-group']);
    $factures =DB::insert('insert into factures(items,id_client)value(?,?)',[$items,$id_client]);

    //var_dump($items);
  }

  public function create(Request $request)
    {
        $clients = DB::table('clients')->get();
        $autocomplete = [];
        foreach($clients as $c){
            $autocomplete[] = [
                'value' =>  $c->nom,
                'data'  =>  $c->id
            ];
        }

        $autocomplete_json = json_encode($autocomplete);
       

       return view('ajoute_facture',[
        'autocomplete' => $autocomplete_json, 
    
    ]);

}



public function show($id)
    {

        $clients = DB::table('clients')->get();
        $autocomplete = [];
        foreach($clients as $c){
            $autocomplete[] = [
                'value' =>  $c->nom,
                'data'  =>  $c->id
            ];
        }

        $autocomplete_json = json_encode($autocomplete);

        $data = DB::table('factures')
            ->join('clients', 'factures.id_client', '=', 'clients.id')
            ->select('factures.*', 'clients.nom','clients.matricule','clients.adresse')
            ->where('factures.id', $id)
            ->get();

        $data = $data->toArray()[0];
        $items = json_decode($data->items);
        $outputs = [];
        $i = 0;
        $outputs[] = '<div data-repeater-item="" style="">' . "\n";
    //$outputs[] = '<div class="col-xs-12 table-responsive">';


                    $outputs[] = '<table  class="table table-striped">';
                    $outputs[] = '<thread>';
                    $outputs[] = '<tr>';
                    $outputs[] = '<td>';
                    $outputs[] =" <b> Designation </b> ";
                    $outputs[] = '</td>';
                    $outputs[] = '<td>';
                    $outputs[] =" <b> Amount </b>";
                    $outputs[] = '</td>';
                    $outputs[] = '<td>';
                    $outputs[]=" <b> Unit price </b>";
                    $outputs[] = '</td>';
                    $outputs[] = '<td> ';
                    $outputs[] =" <b> Total HT </b> ";
                    $outputs[] = '</td>';
                    $outputs[] = '</tr>';
  $outputs[] = '</thread>';

        foreach($items as $item){
                    $outputs[] = '<tr>';
                  
                    $outputs[] = '<td>';
                    $outputs[] ="  $item->designation ";
                    $outputs[] = '</td>';
                    $outputs[] = '<td>';
                    $outputs[] ="  $item->quantite ";
                    $outputs[] = '</td>';
                    $outputs[] = '<td>';
                    $outputs[]="  $item->prix_unitaire ";
                    $outputs[] = '</td>';
                    $outputs[] = '<td>';
                    $outputs[]= $item->prix_unitaire *  $item->quantite;
                    $outputs[] = '</td>';
                    $outputs[] = '</tr>';



            $i++;
        }

        $outputs[] = '</table> <br><br>'  . "\n";

                   $outputs[] = '<div  class="table-responsive">';


                    $outputs[] = '<table class="table">';
                    $outputs[] = '<tr>';
                    $outputs[] = ' <th style="width:50%">Total HT:</th>';
                    $outputs[] = '<td>';
                    $t=0;
                            foreach($items as $item){

                    $total_HT =$item->prix_unitaire *  $item->quantite;
                    $t=$t+$total_HT;

            }
            $outputs[] =$t;

                    $outputs[] = '</td>';
                    $outputs[] = '</tr>';
                    $outputs[] = '<tr>';
                    $outputs[] = ' <th style="width:50%">TVA (19%):</th>';
                    $outputs[] = '<td>';
                    $outputs[] ="{$data->TVA}";
                    $outputs[] = '</td>';
                    $outputs[] = '</tr>';
                    $outputs[] = '<tr>';
                    $outputs[] =" <th>Stamp:</th>";
                    $outputs[] = '<td>';
                    $outputs[] ="{$data->timbre}";
                    $outputs[] = '</td>';
                    $outputs[] = '</tr>';
                    $outputs[] = '<tr>';
                    $outputs[] =" <th>Total TTC:</th>";
                    $outputs[] = '<td>';

                    $outputs[] = $t+ $data->TVA+ $data->timbre;
                                

                    $outputs[] = '</td>';
                    $outputs[] = '</tr>';
                    $outputs[] = '</table>' . "\n";
                    $outputs[] = '</div>' . "\n";
                    $outputs[]=" <p><B> Amount TTC is: </B>";
 
                    //$numberToWords = new NumberToWords();
                    //$numberTransformer = $numberToWords->getNumberTransformer('fr');
                    //$c=$numberTransformer->toWords($t+$data->TVA+$data->timbre); 
                    $total = trad($t+$data->TVA+$data->timbre);
                    $outputs[] = $total;
                    //$outputs[] =$c . "   " . "dinars";


//var_dump($data->toArray());die;

         //$factures=DB::select('select * from factures where id=?',[$id]);


           return view('show_facture',[/*'factures'=>$factures,*/
            'data' => $data,
            'autocomplete'=>$autocomplete_json,
            'output'=>join("\n", $outputs),
            'fac_id'=>$id

]);
          //$factures=DB::select('select * from factures where id=?',[$id]);          
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    $request->validate ([
     'designation' =>'required',
     'quantite' =>'required',
     'prix_unitaire' => 'required',
     'date_creation' => 'required'
       ]);
        $designation = $request->get('designation');
        $quantite = $request->get('quantite');
        $prix_unitaire = $request->get('prix_unitaire');

        $TVA=19;
        $timbre=0.6;





        $date_creation=$request->get('date_creation');
        $total_HT= $quantite * $prix_unitaire;
        $total_TTC= $total_HT + $TVA + $timbre;
        $id_client=$request->get('id_client');


   $factures =DB::insert('insert into factures(designation,quantite,prix_unitaire,total_HT,date_creation,TVA,timbre,total_TTC,id_client)value(?,?,?,?,?,?,?,?,?)',[$designation,$quantite,$prix_unitaire,$total_HT,$date_creation,$TVA,$timbre,$total_TTC,$id_client]);
if($factures){
    $red=redirect('facture')->with('reçu','facture ajouté');
}

else{
   $red=redirect('facture')->with('echec','facture non ajouté');
}

return $red;
    }

/**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $clients = DB::table('clients')->get();
        $autocomplete = [];
        foreach($clients as $c){
            $autocomplete[] = [
                'value' =>  $c->nom,
                'data'  =>  $c->id
            ];
        }

        $autocomplete_json = json_encode($autocomplete);

        $data = DB::table('factures')
            ->join('clients', 'factures.id_client', '=', 'clients.id')
            ->select('factures.*', 'clients.nom','clients.matricule','clients.adresse')
            ->where('factures.id', $id)
            ->get();

       
        $data = $data->toArray()[0];
        $items = json_decode($data->items);
        $outputs = [];
        $i = 0;

        foreach($items as $item){
                    $outputs[] = '<div data-repeater-item="" style="" >' . "\n";

            $outputs[] = '<input class="input-lg" type="text" name="category-group[' . $i . '][designation]" placeholder="Désignation" id="designation" value="' . $item->designation . '">' . "\n" ;
            $outputs[] = '<input class="input-lg" type="text" name="category-group[' . $i . '][quantite]" placeholder="Quantite" id="quantite" value="' . $item->quantite . '">' . "\n";
            $outputs[] = '<input class="input-lg" type="text" name="category-group[' . $i . '][prix_unitaire]" placeholder="Prix unitaire" id="prix" value="' . $item->prix_unitaire . '">' . "\n";
             $outputs[] = '<input data-repeater-delete="" type="button" value="-" class="delete-modal btn btn-danger btn-lg">' . "\n";
            $i++;
              $outputs[] = '</div>' . "\n";     

        }

         //$outputs[]='<br>';
         

//var_dump($data->toArray());die;

         //$factures=DB::select('select * from factures where id=?',[$id]);


    

        return view('update_facture',[/*'factures'=>$factures,*/
            'data' => $data,
            'autocomplete'=>$autocomplete_json,
            'output'=>join("\n", $outputs)
]);
}
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

    $data = $request->all();
       // $id_client = $data['id_client'];

    $items = json_encode($data['category-group']);
$factures = DB::update('update factures set items=? where id=?',[$items,$id] );


 }
 /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
        
          public function destroy($id)
    {
        $factures =DB::delete('delete from factures where id=?',[$id]);
        $red =redirect('facture');
          return $red;
    }


        public function pdf($id){

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_data_to_html($id));
        return $pdf->stream();
             //$pdf=PDF::loadView('show_facture',[/*'factures'=>$factures,*/

       
}

public function convert_data_to_html($id){
 $clients = DB::table('clients')->get();
        $autocomplete = [];
        foreach($clients as $c){
            $autocomplete[] = [
                'value' =>  $c->nom,
                'data'  =>  $c->id
            ];
        }

        $autocomplete_json = json_encode($autocomplete);

        $data = DB::table('factures')
            ->join('clients', 'factures.id_client', '=', 'clients.id')
            ->select('factures.*', 'clients.nom','clients.matricule','clients.adresse')
            ->where('factures.id', $id)
            ->get();

        $data = $data->toArray()[0];
        $items = json_decode($data->items);
                $i = 0;
 $now = new DateTime();
 $d = $now->format('d-m-Y');
$output = '<div class="row invoice-info">
  <table>
  <tr>
  <td style="border:0px solid; padding-left:10; width="30%"><p>DL PRO <br>
    Avenue Charles De Gaulle <br>
    Cyber Parc étage 2 <br> Hammem Sousse 4011 <br>
    Phone:+216 55941909 <br>
    e-mail:contact@dl-pro.net</p></td>
<td style="border:0px solid; padding-left:290; width="20%"><img src="C:\xampp\htdocs\htdocs\dlpro\public\img\img\dlpro.jpg"></td>
</tr>
</table>

   <center> <h1 style="border:1px solid; padding:12px; width="20%"> Invoice Number:'.$data->id.'</h1></center>
   <table> <tr><td style="border:0px solid; padding-left:420; width="20%">

                                                                      <small>Date of issue : ' . $d.'  ';

                                                                      

$output .= '</small></td></tr></table>
 <br>
<table> <tr><td style="border:0px solid; padding-left:10; width="20%">
         <b>Billed to :</b><br>
         '.$data->nom.' <br>
        '.$data->matricule.' <br>
        '.$data->adresse.'
        <br> </td>
</tr>
        </table>
        <br>

    
                    <table width="100%" style="border-collapse:responsive; border : 0px;" >
 
                    
<tbody>
 <tr>
                  
                    <th style="border:0px solid; padding:12px; width="20%">
                    <b> Designation </b> 
                    </th>
                    <th style="border:0px solid; padding:12px; width="20%">
                  <b> Amount </b>
                    </th>
                    <th style="border:0px solid; padding:12px; width="20%">
                   <b> Unit price  </b>
                    </th>
                    <th style="border:0px solid; padding:12px; width="20%"> 
                   <b> Total HT </b> 
                    </th>
                    </tr>                     
<tbody>';

  foreach($items as $item){
              $output .='<tr>
                   <td style="border:1px solid; padding:12px; width="20%">
                   '.$item->designation .'
                   </td>
                   <td style="border:1px solid; padding:12px; width="20%">
                    '.$item->quantite .'
                   </td>
                   <td style="border:1px solid; padding:12px; width="20%">
                      '.$item->prix_unitaire.'
                   </td>
                   <td style="border:1px solid; padding:12px; width="20%">
                     '.$item->prix_unitaire *  $item->quantite.'
                   </td>
                    </tr>';



            $i++;
        }
 $output .= '</table>  </div>';


                   $output .= ' <br><table style="border:0px solid; padding-left:383; width="20%">
                    <tr>
                    <th style="border:1px solid; padding:12px; width="20%">Total H.T:</th>
                   <td style="border:1px solid; padding:12px; width="20%">  ';

 $t=0;
                            foreach($items as $item){

                    $total_HT =$item->prix_unitaire *  $item->quantite;
                    $t=$t+$total_HT;

            }
           $output .=  $t;

                $output .=   ' </td>
                   </tr>
                   <tr>
                    <th style="border:1px solid; padding:12px; width="20%">TVA (19%):</th>
                   <td style="border:1px solid; padding:12px; width="20%"> '.$data->TVA.' </td>
                   </tr>
                   <tr>
                     <th style="border:1px solid; padding:12px; width="20%">Stamp:</th>
                   <td style="border:1px solid; padding:12px; width="20%">'.$data->timbre.'</td>
                   </tr>

                   <tr>
                     <th style="border:1px solid; padding:12px; width="20%">Total TTC:</th>
                   <td style="border:1px solid; padding:12px; width="20%">';
                                               $output.= $t+ $data->TVA+ $data->timbre;


                    $output .= '</td>
                    </tr>
                    </table>
                  </div>
                  <br>
                     <p><B> Amount TTC is: </B>';
 
                    $total = trad($t+$data->TVA+$data->timbre);
                    $output .=$total;
                    return $output;

}







}
