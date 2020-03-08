<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
      public $table="clients";
     protected $fillable=['matricule','nom','adresse','bon_commande','date_commande'];






}
