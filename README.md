# MojeWydatki

## Spis treści
1. [Opis](#opis)
2. [Wymagania](#wymagania)
3. [Instalacja](#instalacja)
4. [Użycie](#użycie)
5. [Przykłady](#przykłady)
 

## Opis

Aplikacja webowa służąca do zarządzania domowymi wydatkami.
Umożliwia:
 - Zarządzanie użytkownikami,
 - Dodawanie sklepów,
 - Rejestrowanie wydatków w tych sklepach,
 - Przechowywanie danych w basie MySQL 

## Wymagania

Aby uruchomić ten projekt, musisz mieć zainstalowane:


- [Composer](https://getcomposer.org/)
- [XAMPP](https://www.apachefriends.org/index.html) lub podobne środowisko serwerowe (np. WAMP, MAMP, Laragon), który zawiera:
  
- Serwer lokalny np. XAMPP
- [PHP](https://www.php.net/) w wersji 7.3 lub wyższej
- MySQL

  Nie instaluj XAMPP w folderze C:\FolderFiles, ponieważ jest to katalog chroniony i serwer lokalny może się nie uruchomić. Najlepiej zostaw domyślną lokalizację instalacji.
  Po zainstalowaniu XAMPP uruchom:
  - serwer Apache
  - bazę danych MySQL
<img width="1366" height="768" alt="MySQL" src="https://github.com/user-attachments/assets/55e39f9e-de0e-42cc-bfda-44677482c5a3" />

## Instalacja

1. Pobierz projekt:

Opcja łatwiejsza:
Pobierz projekt jako plik ZIP z GitHub i rozpakuj go do folderu:
    C:\xampp\htdocs\
    lub innego gdzie zainstalowałeś XAMPP

Opcja dla znających GITa:   
**Sklonuj repozytorium**:
    W terminalu wpisz: 
   
   git clone https://github.com/Michal-Dlu/MojeWydatki
      
2. W terminalu wejdź do katalogu projektu: cd MojeWydatki

3. Zainstaluj zależności PHP (Composer):

composer install

4. Skonfiguruj plik .env
Skopiuj plik .env.example do .env:

cp .env.example .env

Jeśli używasz Windows i to nie działa, po prostu:
- kliknij prawym przyciskiem myszki
- kopiuj
- zmień nazwę .env.example na .env

5.W pliku .env ustaw dane do połączenia z bazą danych, np.:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=moje_wydatki
DB_USERNAME=root
DB_PASSWORD=

6. Utwórz bazę danych:
W XAMPP po uruchomieniu serwera Apache i MySQL Kilknij Admin
<img width="1366" height="768" alt="phpMyAdmin" src="https://github.com/user-attachments/assets/2245db2f-e753-4c98-afec-d6e6de5efbe7" />
Następnie kliknij Databases
<img width="1366" height="768" alt="Databases" src="https://github.com/user-attachments/assets/e3e90ed8-9e18-427c-89a6-10e6d95e4773" />
A następnie utwórz bazę danych o nazwie takiej jaką masz w .env DB_DATABASE=
w tym wypadku mam DB_DATABASE=moje_wydatki. Kliknij Create.
<img width="1366" height="768" alt="createDatabase" src="https://github.com/user-attachments/assets/92a0b788-4a4e-4193-ac54-fe2b2dcd1cf8" />

7. Wygeneruj klucz aplikacji. W terminalu wpisz:

php artisan key:generate 

8. Wykonaj migrację w terminalu:

php artisan migrate

Twoja aplikacja będzie dostępna pod adresem: http://localhost:8000/index
9. W terminalu wpisz:

php artisan serve

Wejdź na ten adres w przeglądarce http://localhost:8000/index
Powinien wyświetlić się panel główny aplikacji MojeWydatki: 
<img width="1366" height="768" alt="MojeWydatki" src="https://github.com/user-attachments/assets/b9434916-f362-47db-8def-f836ead712c2" />

Zalecany Edytor kodu(opcjonalnie)
Do pracy z projektem warto użyć edytora tekstu np.:
- Visual Studio Code,
- PHPStorm,
- Notepad++
  Nie jest to wymagane do działania aplikacji, ale znacznie ułatwia pracę z kodem. 



  


