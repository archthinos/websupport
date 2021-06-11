# Zadanie

Podľa api na https://rest.websupport.sk/docs/v1.zone vytvor jednoduché webové rozhranie, ktoré vylistuje dns záznamy (A, MX atď. v jednom zozname), vie pridať nový záznam a vie vymazať záznam. Stačí, keď bude podporovať jednu doménu, ktorá bude niekde v konfigu napevno.

Daj si, prosím, pozor na to, že rôzne záznamy môžu mať rôzne parametre. (MX vs A, atď.)

Skús to nakódiť bez použitia frameworkov alebo iných knižníc.

# Nastavenie

Nastavenie aplikácie nájdete v súbore config.php (je potrebné premenovať config.php.dist na config.php).

* API_URL - adresa kde sa API nachádza
* API_KEY - API identifikátor (Osobné nastavenia - API autentifikácia)
* API_SERCRET - tajný kľúč pre API identifikátor (Osobné nastavenia - API autentifikácia - API identifikátor - Tajný kľúč)
* PAGE_SIZE - počet položiek, ktoré vracia API pri volaní. Je ho možné zmeniť na ľubovolnú hodnotu (default:100)


# Validator 

V adresári app\Rules nájdete nastavenia validátora pre každý formulár záznamov. 

Parametre validátora: 
* string - skontroluje či je premenná reťazec
* required - skontroluje či premenná bola vyplnená vo formulári
* int - skontroluje či je premenná číslo
* ipv4 - skontroluje či je premenná IPv4 (napr. 1.2.3.4)
* ipv6 - skontroluje či je premenná IPv6 (napr. 0:0:0:0:0:FFFF:0102:0304)

Podmienky kontroli premennej sa môžu reťaziť, napr.:

    return [
        'foo' => 'required|string',
        'bar' => 'string|ipv4|required',
    ]

# Rozšírenie aplikácie
* Route može podporovať premenne
* Routes presunúť do samostantého súboru
* Odstrániť používanie $_REQUEST
* Presunúť /index.php do public/ pre bezpečnosť
* Šablónovací systém
* Testy pre aplikáciu

