# converterOnTheImage
Zadanie rekrutacyjne - Navifleet

Konwerter danych do pliku graficznego
http://pliki.i1.com.pl/screen/2015/12/16165704_p.png
Skrypt na wej�ciu przyjmuje dane w dowolnej strukturze JSON lub tablicy PHP (tabela zastosowania cz�ci samochodowych), wyj�ciem ma by� plik graficzny JPG lub PNG     maksymalnie odwzorowuj�cy wygl�d orygina�u, np.
�    ilo�� kolumn jest sta�a, ale w kolumnie Uwagi mo�e pojawi� si� tekst o d�ugo�ci do 255 znak�w
�    ikonka rodzaju paliwa ON/Pb powinna by� obrazkiem .png lub .jpg osadzonym w kodzie html strony
�    rozwi�zanie musi dzia�a� bez wykorzystania mechanizm�w przegl�darki (canvas) oraz poza systemem Windows


Rozwi�zanie wykona�em tak by generowany obraz by� dynamicznie skalowany z zachowaniem proporcji przedstawionego podgl�du.

Rozmiar obrazu jest zale�ny od rozmiaru czcionki / i lub paddingu jaki przyjmuje konstruktor klasy ImageTable.

Klasa Header zawiera nag�owki tabeli oraz ilo�� pikseli jaka widnia�a w podgl�dzie jako padding lewy i pracy pojedy�czej kolumny. 
By nowo wygenerowany obrazek by� w pe�ni skalowalny ale zachowywa� proporcje podzia�u na kolumny wyliczam proporcje padding�w wzgl�dem
pojedynczego znaku teksu a nastepnie definiuje w statycznej zmiennej rozmiar kolumny.


