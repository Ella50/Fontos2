
## Postman beállítása a végpontok teszteléséhez

1. GET /api/ingatlan (összes ingatlan lekérése)
Beállítások:

Metódus: GET

URL: http://127.0.0.1:8000/api/ingatlan

Headers: nem kell semmi

Body: nem kell

Kattints a "Send" gombra!

2. POST /api/ingatlan (új ingatlan létrehozása)
Beállítások:

Metódus: POST

URL: http://127.0.0.1:8000/api/ingatlan

Headers:

Key: Content-Type

Value: application/json

Body:

Válaszd a raw opciót

Válaszd a JSON formátumot

Másold be ezt:

json
{
    "kategoria": 1,
    "leiras": "Gyönyörű családi ház eladó",
    "tehermentes": true,
    "ar": 26990000,
    "kepUrl": "https://example.com/haz.jpg"
}
3. DELETE /api/ingatlan/{id} (ingatlan törlése)
Beállítások:

Metódus: DELETE

URL: http://127.0.0.1:8000/api/ingatlan/1 (az 1-es ID-jű ingatlant törli)

Headers: nem kell

Body: nem kell

📸 Postman képernyőképek segítségével:
GET kérés beállítása:
text
[GET] ➔ http://127.0.0.1:8000/api/ingatlan
POST kérés beállítása:
text
[POST] ➔ http://127.0.0.1:8000/api/ingatlan
Headers:
  Content-Type: application/json

Body (raw JSON):
{
    "kategoria": 1,
    "leiras": "Teszt ingatlan",
    "tehermentes": true,
    "ar": 15000000
}
📋 Teljes tesztelési sorrend:
1. Először töltsd fel a kategóriákat (ha még nem tetted)
bash
php artisan db:seed --class=DatabaseSeeder
2. GET kérés - üres lista
Küldj egy GET kérést → [] (üres) választ kapsz, mert még nincs ingatlan.

3. POST kérés - új ingatlan
Küldj egy POST kérést a fenti JSON-nel → Válasz: {"id":1} 201-es kóddal

4. GET kérés - már van adat
Küldj újra GET kérést → Már látnod kell az ingatlant a listában:

json
[
    {
        "id": 1,
        "kategoria": "Ház",
        "leiras": "Gyönyörű családi ház eladó",
        "hirdetesDatuma": "2026-02-24T...",
        "tehermentes": true,
        "ar": 26990000,
        "kepUrl": "https://example.com/haz.jpg"
    }
]
5. DELETE kérés - törlés
Küldj DELETE kérést: http://127.0.0.1:8000/api/ingatlan/1
→ 204-es válasz (üres)

6. GET kérés - ellenőrzés
Újra GET → megint [] üres lista

⚠️ Fontos: Előtte ellenőrizd!
1. Fut a szerver?
bash
php artisan serve
A terminálban látnod kell: Server running on [http://127.0.0.1:8000]

2. Vannak kategóriák?
bash
php artisan db:seed --class=DatabaseSeeder
3. Jó a .env beállítás?
ini
CACHE_STORE=file
SESSION_DRIVER=file
DB_DATABASE=ingatlan
🎯 Gyors teszt curl-lel (ha nincs Postman):
GET:

bash
curl http://127.0.0.1:8000/api/ingatlan
POST:

bash
curl -X POST http://127.0.0.1:8000/api/ingatlan ^
  -H "Content-Type: application/json" ^
  -d "{\"kategoria\":1,\"leiras\":\"Teszt\",\"tehermentes\":true,\"ar\":15000000}"
DELETE:

bash
curl -X DELETE http://127.0.0.1:8000/api/ingatlan/1
Ha a POST kérésnél 400-as hibát kapsz ("Hiányos adatok"), akkor valamelyik mező hiányzik vagy rossz a neve. Ellenőrizd, hogy a JSON-ben pontosan ezek a mezőnevek szerepelnek-e:

kategoria (nem kategoria_id)

leiras

tehermentes (boolean)

ar (szám)

kepUrl (opcionális)