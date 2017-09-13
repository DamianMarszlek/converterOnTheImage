# converterOnTheImage
Zadanie rekrutacyjne - Navifleet

Konwerter danych do pliku graficznego
http://pliki.i1.com.pl/screen/2015/12/16165704_p.png
Skrypt na wejœciu przyjmuje dane w dowolnej strukturze JSON lub tablicy PHP (tabela zastosowania czêœci samochodowych), wyjœciem ma byæ plik graficzny JPG lub PNG     maksymalnie odwzorowuj¹cy wygl¹d orygina³u, np.
•    iloœæ kolumn jest sta³a, ale w kolumnie Uwagi mo¿e pojawiæ siê tekst o d³ugoœci do 255 znaków
•    ikonka rodzaju paliwa ON/Pb powinna byæ obrazkiem .png lub .jpg osadzonym w kodzie html strony
•    rozwi¹zanie musi dzia³aæ bez wykorzystania mechanizmów przegl¹darki (canvas) oraz poza systemem Windows


Rozwi¹zanie wykona³em tak by generowany obraz by³ dynamicznie skalowany z zachowaniem proporcji przedstawionego podgl¹du.

Rozmiar obrazu jest zale¿ny od rozmiaru czcionki / i lub paddingu jaki przyjmuje konstruktor klasy ImageTable.

Klasa Header zawiera nag³owki tabeli oraz iloœæ pikseli jaka widnia³a w podgl¹dzie jako padding lewy i pracy pojedyñczej kolumny. 
By nowo wygenerowany obrazek by³ w pe³ni skalowalny ale zachowywa³ proporcje podzia³u na kolumny wyliczam proporcje paddingów wzglêdem
pojedynczego znaku teksu a nastepnie definiuje w statycznej zmiennej rozmiar kolumny.


