<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'prenom','sex','date_de_naissance','tel','mail','date_de_prise_de_fonction','fonction'];
}
