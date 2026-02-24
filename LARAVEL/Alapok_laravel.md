composer create-project laravel/laravel "name"


.env adatbázis beállítások -> átírni a connection-t mysql-re, jelszó mysql (kiszedni az ottani kommenteket)


(model migrationnal)
terminálban: php artisan make:model kategoria -m
            php artisan make:model ingatlan -mc --api


átnevezés a migration fájlnévben és két helyen a fájlban a táblaneveket (ne kategorias hanem kategoriak)


kategoria migrationben:
    $table->id();
    $table->string(('nev'));


ingatlanok migrationben:

    $table->id();
    $table->foreignId('kategoria')->references('id')->on('kategoriak');
    $table->string('leiras')->nullable();
    $table->timestamp('hirdetesDatuma')->nullable()->default(DB::raw('CURRENT\_TIMESTAMP'));
    $table->boolean('tehermentes');
    $table->integer('ar');
    $table->string('kepUrl')->nullable();



kategoria és ingatlan modellek:

    public $table = 'kategoriak'; vagy ugye ingatlanok
    public $timestamps = false;



databaseseederbe:

use App\\Models\\kategoria

$kategoriak = \['Ház', 'Lakás', 'Építési telek', 'Garázs', 'Mezőgazdasági terület', 'Ipari ingatlan'];

    foreach ($kategoriak as $key => $value) {
        kategoria::create(\['nev' => $value]);
    }


PHPMYADMIN: ingatlan adatbázis létrehozása manuálisan

php artisan migrate
php artisan db:seed

ingatlanok táblába phpmyadminból csv importálás, 1. sortól (0 helyett 1)


terminal: php artisan install:api (no) -> létrehoz a controllerbe alap függvényeket

        composer remove laravel/sanctum -> config mappában sanctum.php-t manuálisan törölni



ingatlancontroller-be:

    public function index()
    {
        $ingatlanok = ingatlan::all();
        return response()->json($ingatlanok);
    }



api-ba:
    sanctumos törlése
    Route::get('/ingatlan', \[IngatlanController::class, 'index']);



SZERVER FUTTATÁSA - HELYES ADATBÁZIS MEZŐK FIGYELÉSE



utána lekérdezés: http://localhost:8000/api/ingatlan



minden lekérdezés, kategoriánál helyes megjelenítés:

ingatlan.php:

    public function kategoria()
    {
        return $this->belongsTo(kategoria::class, 'kategoria');
    }



ingatlancontroller:

    public function index()
    {
        $ingatlanok = ingatlan::with('kategoria')->get();
        return response()->json($ingatlanok);
    }



### új ingatlan felvitele:

ingatlancontroller:

use Illuminate\\Support\\Facades\\Validator;

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), \[
        'kategoria' => 'required',
        'tehermentes' => 'required',
        'ar' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(\['message' => 'Hiányos adatok'], 400);
        }

        return ingatlan::create($request->all());



        //aztán hogy az id-t adja vissza:

        $ingatlan = ingatlan::create($request->all());

        return response()->json(\['id' => $ingatlan->id], 201);
    }



ingatlan.php:

    public $guarded = \[];


api.php:

    Route::post('/ingatlan', \[IngatlanController::class, 'store']);



### ingatlan törlése:

ingatlancontroller:

    show és update törlése (nem kell)

    public function destroy($id)
    {
        $ingatlan = ingatlan::where('id', '=', $id);
        if ($ingatlan->exists()) {
            $ingatlan->delete();
            return (response('', 204));
        }
        return response('Ingatlan nem létezik', 404);
    }



api.php:

    Route::delete('/ingatlan/{id}', \[IngatlanController::class, 'destroy']);


-------------
## Problémák elhárítása

bootstrap/app.php
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',   
        commands: __DIR__.'/../routes/console.php',
        health: '/up',

.env
    CACHE_STORE=file
    SESSION_DRIVER=file

