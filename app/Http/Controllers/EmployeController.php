<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $employes = Employe::all();
        return response()->json([
            'status' => 'success',
            'employes' => $employes,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'sex' => 'required|string|max:1',
            'date_de_naissance' => 'required|date',
            'tel' => 'required|integer',
            'mail' => 'required|email:rfc,dns',
            'date_de_prise_de_fonction' => 'required|date|after:date_de_naissance',
            'fonction' => 'required|string|max:255',

        ]);

        $employe = Employe::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'sex' => $request->sex,
            'date_de_naissance' => $request->date_de_naissance,
            'tel' => $request->tel,
            'mail' => $request->mail,
            'date_de_prise_de_fonction' => $request->date_de_prise_de_fonction,
            'fonction' => $request->fonction,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Employee created successfully',
            'employe' => $employe,
        ]);
    }

    public function show($id)
    {
        $employe = Employe::find($id);
        return response()->json([
            'status' => 'success',
            'employe' => $employe,
        ]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'tips' => 'required|string|max:255',
        ]);
        $employe = Employe::where('nom','like','%'.$request->tips.'%')->where('prenom','like','%'.$request->tips.'%')->get();

        return response()->json([
            'status' => 'success',
            'employe' => $employe,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'sex' => 'required|string|max:1',
            'date_de_naissance' => 'required|date',
            'tel' => 'required|integer|unique:employe',
            'mail' => 'required|email:rfc,dns|unique:employe',
            'date_de_prise_de_fonction' => 'required|date|after:date_de_naissance',
            'fonction' => 'required|string|max:255',
        ]);

        $employe = Employe::find($id);
        $employe->nom = $request->nom;
        $employe->prenom = $request->prenom;
        $employe->sex = $request->sex;
        $employe->date_de_naissance = $request->date_de_naissance;
        $employe->tel = $request->tel;
        $employe->mail = $request->mail;
        $employe->date_de_prise_de_fonction = $request->date_de_prise_de_fonction;
        $employe->fonction = $request->fonction;
        $employe->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Employee updated successfully',
            'employee' => $employe,
        ]);
    }

    public function destroy($id)
    {
        $employe = Employe::find($id);
        $employe->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Employee deleted successfully',
            'employe' => $employe,
        ]);
    }
}
