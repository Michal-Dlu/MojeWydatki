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
<img width="5440" height="2312" alt="PanelBezCustomera" src="https://github.com/user-attachments/assets/c0abb86d-1bf1-42f3-b836-518a075e985c" />



Zalecany Edytor kodu(opcjonalnie)
Do pracy z projektem warto użyć edytora tekstu np.:
- Visual Studio Code,
- PHPStorm,
- Notepad++
  Nie jest to wymagane do działania aplikacji, ale znacznie ułatwia pracę z kodem. 

# Użycie

Panel główny aplikacji. Tu wybieramy gdzie chcemy działać.
<img width="1366" height="768" alt="MojeWydatki" src="https://github.com/user-attachments/assets/b9434916-f362-47db-8def-f836ead712c2" />
Na początku musimy dodać pierwszego użytkownika, ponieważ aplikacja blokuje nam opcje Sklepy i Wydatki.
<img width="5440" height="2312" alt="PanelBezCustomera" src="https://github.com/user-attachments/assets/0df3113b-fbef-4b4e-8564-ea651a6dcae5" />



Wybieramy Użytkownicy. Pokazuje się nam lista użytkowników. Tutaj wybieramy DODAJ UŻYTKOWNIKA. 
<img width="1864" height="1104" alt="Customers" src="https://github.com/user-attachments/assets/60779eb2-d862-4c4c-8524-fdcab0f8391d" />

Pokaże nam się formularz do dodawania nowego użytkownika.
<img width="1864" height="1104" alt="AddCustomer" src="https://github.com/user-attachments/assets/8b25ec0b-24b4-4cb3-ac1f-c6a4efa824ad" />

Po wpisaniu nazwy nowego użytkownika i kliknięciu przycisku "Zapisz użytkownika". Znów pokaże nam się lista użytkowników, gdzie można usunąć lub edytować użytkowników.
Można też wyczyścić formularz kilkająć "WYCZYŚĆ FORMULARZ". Można też powrócić do Listy użytkowników klikając "LISTA UŻYTKOWNIKÓW" lub do panelu głównego klikając 
"POWRÓT DO MENU".

Dodanych użytkowników można edytować i usuwać, klikając przyciski "Edytuj" i "Usuń" przy danym użytkowniku.
<img width="1864" height="1104" alt="Customer Edition" src="https://github.com/user-attachments/assets/f0af19c2-b9c7-42fc-9295-3e8b29fcdecb" />

Jeśli wybraliśmy "Edytuj" wyświelta nam się strona do edycji użytkownika. 
<img width="1864" height="1104" alt="CustomerEdition2" src="https://github.com/user-attachments/assets/165e6497-b11e-42fc-aa44-e946b05e1c0b" />


Jeśli poprawimy dane i zatwierdzimy użytkownika. Wrócimy do Listy Użytkowników
ale pojawi nam się komunikat: Użytkownik został zaktualizowany pomyślnie.
<img width="1864" height="1104" alt="CustomerEdition3" src="https://github.com/user-attachments/assets/47548a45-897d-42d2-91c2-bb9dbb55769f" />

Jeśli wybieramy Usuń przy użytkowniku aplikacja zapyta czy jesteśmy pewni, że chcemy usunąć tego użytkownika.
<img width="1864" height="1104" alt="CustomerDelete" src="https://github.com/user-attachments/assets/b9c0a9dd-c2fd-4eae-97bb-8ed7b483e1f3" />

Jeśli wciśniemy Ok. Apilkacja usunie danego użytkownika i wyświetli odpowiedni komunikat.
<img width="1864" height="1104" alt="CustomerDelete2" src="https://github.com/user-attachments/assets/deaa008f-325b-494e-999a-0afb7c899b33" />


Jeśli mamy już chociaż jednego użytkownika. Możemy przejść do Menu Głównego klikając "POWRÓT DO MENU" w prawym, górnym roku ekranu.
Następnie należy wybrać opcję Sklepy w Menu Głównym, ponieważ do wpisaywania wydatków potrzebny jest chociaż jeden sklep.
Po kliknięciu kafelka "Sklepy" przechodzimy do formularza do wpisywania sklepów przyporządkowanych do danego użytkownika. Użytkowników wybieramy z rozwijanej listy po kliknięciu 
"Wybierz użytkownika".

<img width="1864" height="1104" alt="sklep" src="https://github.com/user-attachments/assets/11a0ac2d-3879-44f9-85d9-436990cf633f" />


i po kliknięciu:


<img width="1864" height="1104" alt="sklep2" src="https://github.com/user-attachments/assets/01c2de95-2984-4275-ac2a-9fd89f3801ed" />



Aby dodać sklep do bazy danych przechodzimy do formularza poprzez kliknęcie "DODAJ SKLEP"

<img width="1864" height="1104" alt="sklep3" src="https://github.com/user-attachments/assets/887fee41-823e-4125-9eaf-a7e07be514ee" />

Formularz wygląda następująco:


<img width="1864" height="1104" alt="sklep4" src="https://github.com/user-attachments/assets/25459c07-471b-4c20-a5ff-05607918b3c7" />


Wpisujemy nazwę sklepu i wybieramy użytkownika z listy rozwijanej i klikamy przycisk "Zapisz Sklep":


Aplikacja wysyłą nas do Listy Sklepów z odpowiednim komentarzem "Sklep został dodany pomyślnie".

![sklep4](https://github.com/user-attachments/assets/13256881-8996-4383-a65b-477bf36af124)


Aby zobaczyć Sklepy przypisane do danego użytkownika należy go wybrać z listy rozwijanej i kliknąć przycisk "Filtruj".

<img width="1366" height="768" alt="sklep6" src="https://github.com/user-attachments/assets/944a7d82-83d6-4cfa-b568-3e1be2924b8d" />




Teraz możemy dodać następny sklep klikając "DODAJ SKLEP" lub przejść do Menu Głównego klikając "POWRÓT DO MENU" jeśli chcemy wprowadzić wydatek.
W Menu Głównym klikamy kafelek: "Wydatki".
Przechodzimy do Listy Wydatków.

<img width="1366" height="768" alt="wydatki" src="https://github.com/user-attachments/assets/403e835e-0d86-40ad-97e0-1578a90efecc" />




Lista ta służy do filtrowania wydatków według miesiąca, roku, użytkownika, sklepu. Wybrać rok i miesiąc musimy wtedy wyświetlą nam się wszzytkie wydatki
wszystkich użytkowników w danym roku i miesiącu. Wybierając z listy rozwijanej użytkownika wyfiltrujemy wydatki danego użytkownika ze wsztkich sklepów z w danym roki i miesiącu. Możemy też filtrować po sklepach. Wszystko jest podsumowane na dole ekranu. 
Ale najperw trzeba dodać nowe wydatki. W tym celu klikamy "NOWY WYDATEK".
Przechodzimy do formularza:



<img width="1366" height="768" alt="wydatki2" src="https://github.com/user-attachments/assets/efa2cf0b-178e-48b0-9b2a-e75f20d5ff6a" />


Wypełniamy fromularz:
Użytkownika i przypisany do niego sklep wybieramy z listy rozwijanej, kwotę sobie wpisaujemy w odpowiednim polu a po kliknięciu w ikonkę kalendarza wybieramy datę wydatku.


<img width="1366" height="768" alt="wydatki3" src="https://github.com/user-attachments/assets/13129307-72b5-459c-8789-1390657a0eab" />




Datę zakupu można też zmieniać bezpośrednio ale mnusimy pamiętać, że w zależności od ustawień lokalizacujnych przeglądarki może być w formacie polskim lub angielskim 
tj. najpierw jest miesiąc a potem dzień miesiąca.

tu polska wersja przeglądarki

<img width="1366" height="768" alt="wydatek7" src="https://github.com/user-attachments/assets/ddfc49e6-4110-4b65-abbe-30648d4dc559" />


a tu angielska przeglądarki

<img width="1366" height="768" alt="wydatki4" src="https://github.com/user-attachments/assets/e80fec9a-9a09-434a-b255-afb06d47cf0a" />


Zapisujemy klikając przycisk Zapisz. Aplikacja wraca nas do Listy Wydatków ze stosownym komentarzem. Dodany wydatek pojawia się na górze listy.


<img width="1366" height="768" alt="wydatek4" src="https://github.com/user-attachments/assets/8fe50fd0-240b-43ef-a05b-ae3d870dfeb2" />


Teraz możemy sobie wyfiltrować podsumowane wydatki. Wybierająć interesujące nas opcje i klikając przycisk Pokaż sumę wydatków. Np. filtrując miesiąc, rok i użytkownika otrzymujemy podsumowane wszytkie wydatki użytkownika 
we wszystkich sklepach:


<img width="1366" height="768" alt="wydatki5" src="https://github.com/user-attachments/assets/08459d52-599c-4dc1-b6a4-51634492a369" />




lub można też wyfiltrować według danego sklepu:


<img width="1366" height="768" alt="wydatki6" src="https://github.com/user-attachments/assets/75ac3b09-213b-4f7b-9a4e-4af7538548ac" />














  


