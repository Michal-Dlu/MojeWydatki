# Moje_wydatki

## Spis treści
1. [Opis](#opis)
2. [Instalacja](#instalacja)
3. [Użycie](#użycie)
4. [Przykłady](#przykłady)


## Opis

Program zawierający bazę danych do przechowywania domowych wydatków. Ma opcję Użytkowników, Sklepów i Wydatków w tych sklepach. 

## Instalacja



## Wymagania

Aby uruchomić ten projekt, musisz mieć zainstalowane:

- [PHP](https://www.php.net/) w wersji 7.3 lub wyższej
- [Composer](https://getcomposer.org/)
- [MySQL](https://www.mysql.com/) lub [MariaDB](https://mariadb.org/)
- [XAMPP](https://www.apachefriends.org/index.html) lub podobne środowisko serwerowe (np. WAMP, MAMP, Laragon)

## Instalacja

1. **Sklonuj repozytorium**:
   ```bash
   git clone https://github.com/TwójUżytkownik/Moje_wydatki.git
   
2. W terminalu wejdź do katalogu projektu: cd Moje_wydatki

3. Zainstaluj zależności PHP (Composer):
```bash
composer install
4. Skonfiguruj plik .env
Skopiuj plik .env.example do .env:
```bash
cp .env.example .env
5.W pliku .env ustaw dane do połączenia z bazą danych, np.:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=moje_wydatki
DB_USERNAME=root
DB_PASSWORD=
6. Wykonaj migrację w terminalu:
```bash
php artisan migrate



  


