# converterToImage
Zadanie rekrutacyjne - Navifleet

Konwerter danych do pliku graficznego
[podglad](http://pliki.i1.com.pl/screen/2015/12/16165704_p.png)
Skrypt na wejœciu przyjmuje dane w dowolnej strukturze JSON lub tablicy PHP (tabela zastosowania czêœci samochodowych), wyjœciem ma byæ plik graficzny JPG lub PNG     maksymalnie odwzorowuj¹cy wygl¹d orygina³u, np.

- iloœæ kolumn jest sta³a, ale w kolumnie Uwagi mo¿e pojawiæ siê tekst o d³ugoœci do 255 znaków
- ikonka rodzaju paliwa ON/Pb powinna byæ obrazkiem .png lub .jpg osadzonym w kodzie html strony
- rozwi¹zanie musi dzia³aæ bez wykorzystania mechanizmów przegl¹darki (canvas) oraz poza systemem Windows



Rozwi¹zanie wykona³em tak by generowany obraz by³ dynamicznie skalowany do wprowadzonego rozmiaru czcionki i/lub paddingu z zachowaniem proporcji przedstawionego podgl¹du.

Rozmiar obrazu jest zale¿ny od rozmiaru czcionki / i lub paddingu jaki przyjmuje konstruktor klasy ImageTable.

Klasa Header zawiera nag³ówki tabeli oraz iloœæ pikseli jaka widnia³a w podgl¹dzie jako padding lewy i pracy pojedynczej kolumny.
By nowo wygenerowany obrazek by³ w pe³ni skalowalny ale zachowywa³ proporcje podzia³u na kolumny wyliczam proporcje paddingów wzglêdem pojedynczego znaku teksu a nastêpnie definiuje w statycznej zmiennej tej klasy poszczególne rozmiary kolumny.

Podpunkt pierwszy wspomina o kolumnie 'Uwagi' która w zaprezentowanym podgl¹dzie nie wystêpuje – za³o¿y³em ¿e chodzi³o Pañstwu o kolumnê 'Opis'. Ponadto skrypt ³amie linie tekstu w ka¿dej kolumnie gdzie jest to konieczne.

Podpunkt drugi zadania by³ tematem mojego zapytania do Pañstwa lecz pozosta³ bez odpowiedzi, dlatego ikonê paliwa generujê jako integralna czêœæ obrazu, poniewa¿ w sytuacji gdy u¿ytkownik kliknie PPM->zapisz obrazek jako... obraz zostanie zapisany w pe³ni kompletny podczas gdyby ikony benzyny wystêpowa³y w postaci obrazków osadzonych kodem html zapisany obraz nie zawiera³by wspomnianych ikon.


