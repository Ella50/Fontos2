<?php
namespace App\Http\Controllers;
use App\Models\Name;
use App\Models\Family;
use Illuminate\Http\Request;
use Exception;
use GuzzleHttp\Psr7\Query;
use Illuminate\Database\QueryException;

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
        $families = Family::all();

        /*$names = Name::find(1); //i-edik elemet
        $names = Name::where('name', "Anna")->first(); //első Anna nevű rekordot adja vissza
        $names = Name::where('name', "Anna")->get(); //összes Anna nevű elemet tartalmazó rekordot adja vissza egy tömbben
        $names = Name::where('id', ">", 2)->get(); //összes 2-nél nagyobb id-jú rekordot adja vissza

        $names = Name::where('name', "<>", "Anna") //nem egyenlő Anna
                        ->whereAnd("id",">", 1) //1-nél nagyobb id
                        ->orderBy("id", "desc") //fordított sorrendbe rendezve
                        ->get();*/


        return view("pages.names", compact("names", 'families'));
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

    public function deleteName(Request $request) {
        $name = Name::find($request->input('id'));
        $name->delete();
        return 'ok';
    }

    public function manageSurname() {
        $names = Family::all();
        return view("pages.surname", compact("names"));
    }

    public function deleteSurname(Request $request) {
        try{
            $family = Family::find($request->input('id'));
            $family->delete();
            return response()->json(['success' => true]);
        }
        catch (QueryException $e) {
            return response()->json(['success' => false, 'message' => 'A családnév nem törölhető, mert vannak hozzá kapcsolódó nevek.']);
        }
        catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Ismeretlen hiba a törlés során. ']);
        }
        
    }

    public function newSurname(Request $request) {
        $validateData = $request->validate(['inputFamily' => 'required|alpha|min:2|max:20']); //VALIDÁTOR   alpha: csak betűket tartalmaz
        
        $familyRecord = new Family();
        $familyRecord->surname = $request->input('inputFamily');
        $familyRecord->save();
        return redirect('/names/manage/surname');
    }

    public function newName(Request $request) {
        $validateData = $request->validate(['inputFamily' => 'required|integer|exists:App\Models\Family,id',
                                                    'inputName' => 'required|alpha|min:2|max:20']);

        $name = new Name();
        $name->family_id = $request->input('inputFamily');
        $name->name = $request->input('inputName');
        $name->save();
        return redirect('/names');
    }



/* ----------------JEGYZETEK------------------------

    function saveData(Request $request) {
        
    
    }

    function returnObject(){
        $obj = new \stdClass();
        $obj->name = "Tódor";
        $obj->server = "SZBI-PG";
        return response()->json($obj);
    }


    function returnError(){
        return response()
            ->view('error', ['valtozo'=> 'Ez egy változó értéke'], 404);
    }


    function redirectAway(){
        return redirect()->away('https://szbi-pg.hu');
    }


*/

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

