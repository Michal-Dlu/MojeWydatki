# Moje_wydatki

## Spis treści
1. [Opis](#opis)
2. [Instalacja](#instalacja)
3. [Użycie](#użycie)
4. [Przykłady](#przykłady)
 

## Opis

Program zawierający bazę danych do przechowywania domowych wydatków. Ma opcję Użytkowników, Sklepów i Wydatków w tych sklepach. 





## Wymagania

Aby uruchomić ten projekt, musisz mieć zainstalowane:


- [Composer](https://getcomposer.org/)
- [XAMPP](https://www.apachefriends.org/index.html) lub podobne środowisko serwerowe (np. WAMP, MAMP, Laragon), który zawiera:
  
- Serwer lokalny Apache
- [PHP](https://www.php.net/) w wersji 7.3 lub wyższej
- MySQL

  XAMPPa nie instaluj w C:\FolderFiles, ponieważ jest to folder chroniony i serwer lokalny nie wystartuje. Najlepiej zostaw podstawowe opcje instalacyjne.
  Po zainstalowaniu XAMPP uruchom serwer i bazę danych
<img width="1366" height="768" alt="MySQL" src="https://github.com/user-attachments/assets/55e39f9e-de0e-42cc-bfda-44677482c5a3" />

## Instalacja

1. Pobierz projekt:
Opcja łatwiejsza:
Pobierz projekt jako plik ZIP z GitHub i rozpakuj go do folderu:
    C:\xampp\htdocs\ lub innego gdzie zainstalowałeś XAMPPa

Opcja dla znających GITa:   
**Sklonuj repozytorium**:
    W terminalu wpisz: 
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

Jeśli używasz Windows i to nie działa, po prostu:
- kliknij prawym przyciskiem myszki
- kopiuj
- zmień nazwę na .env

5.W pliku .env ustaw dane do połączenia z bazą danych, np.:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=moje_wydatki
DB_USERNAME=root
DB_PASSWORD=

6. Utwórz bazę danych:

6.. Wykonaj migrację w terminalu:
```bash
php artisan migrate
Twoja aplikacja będzie dostępna pod adresem: http://localhost:8000





  


