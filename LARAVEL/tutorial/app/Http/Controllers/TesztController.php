<?php
namespace App\Http\Controllers;
use App\Models\Name;
use App\Models\Family;

class TesztController extends Controller
{
    public function teszt()
    {
        $name = ['Gabi', 'Józsi', 'Pisti', 'Viktor', 'Anna', 'Kata'];
        $randomNameKey = array_rand($name, 1);
        $randomName = $name[$randomNameKey];
        return view('pages.teszt', data: compact(var_name: 'randomName')); //pages.teszt.blade.php




    }

    public function names()
    {
        /*$names = ['Gabi', 'Józsi', 'Pisti', 'Viktor', 'Anna', 'Kata'];
        return view('pages.names', compact('names'));*/

        $names = Name::all();   //name model alapján az adatbáziból rekordokat --> ez a lekérdezés

        /*$names = Name::find(1); //i-edik elemet
        $names = Name::where('name', "Anna")->first(); //első Anna nevű rekordot adja vissza
        $names = Name::where('name', "Anna")->get(); //összes Anna nevű elemet tartalmazó rekordot adja vissza egy tömbben
        $names = Name::where('id', ">", 2)->get(); //összes 2-nél nagyobb id-jú rekordot adja vissza

        $names = Name::where('name', "<>", "Anna") //nem egyenlő Anna
                        ->whereAnd("id",">", 1) //1-nél nagyobb id
                        ->orderBy("id", "desc") //fordított sorrendbe rendezve
                        ->get();*/


        return view("pages.names", compact("names"));
    }

    public function namesCreate($family, $name) {
        $nameRecord = new Name();
        $nameRecord->name = $name; //ennek az osztálynak a name mezője legyen a name-mel
        $nameRecord->family_id = $family;
        $nameRecord->save();
        return $nameRecord->id; //record osztály az id mezője
    }


    public function familiesCreate($name) {
        $familyRecord = new Family();
        $familyRecord->surname = $name;
        $familyRecord->save();
        return $familyRecord->id;
    }

    /*$names = \DB::table("names")
        ->where('name', '<>', 'Bela')
        ->get();*/

    /*$names = \DB::select('
        SELECT *
        FROM names
        WHERE name <> "Bela"
        AND id > 1
        ORDER BY id DESC');*/

}

