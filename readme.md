# 💿 ReDo   
CLI per practicar acords bàsics 🎸.  

## 🖼️ Context
Resol [kata-some-chords](https://github.com/CloudSalander/kata-some-chords). 

## ⚙️ Instal·lació
1. Clona el repositori: `git clone url_repo`
2. Accedeix-hi: `cd repo`
3. Inicialitza el programa: `php index.php`

### Com funciona
L'objectiu del programa és facilitar l'assaig de sèries d'acords. Per fer-ho, compta amb un arxiu de configuració on hi consta el tempo, el compàs i el temps d'estudi (en minuts). El programa utilitza aquesta informació per anar mostrant una sèrie d'acords en bucle fins que s'acaba el temps d'estudi. 

Hi ha tres modes d'acords:  
**1. Acords random**: la sèrie d'acords és aleatòria.  
**2. Acords específics**: el programa demana l'input d'acords que es volen assajar.  
**3. Acords de catàleg**: el programa conté un catàleg d'acords comuns extrets d'un pdf compartit a xxss per Jaime Altozano, traduït a JSON per ChatGPT 🤖 (El material és en castellà). El catàleg s'organitza per seccions i conté informació descriptiva i exemples de cançons conegudes que fan servir cada sèrie d'acords.  

El catàleg es pot navegar de dues formes:  
    - **per seccions**: visió exhaustiva de la informació de cada secció.  
    - **per índex artista-cançó**: mostra l'índex d'artistes i cançons en ordre alfabètic.    

>[!TIP]  
>És aconsellable fer servir l'opció `4. Canviar configuració` per ajustar l'arxiu de configuració a les necessitats de cada usuaria, per tal d'evitar errors en l'execució del programa.  

## 🏛️ Estructura de l'app  
````
index.php
|--- MainController
|   |--- getAcordsRandom
|   |   |--- AcordsFactory
|   |---getAcordsEspecifics
|   |   |--- AcordsFactory
|   |---getAcordsColeccio
|   |   |--- CatalogueService
|   |---getConfiguration
|   |   |--- ConfigurationService
````
````
AcordsFactory
|--- AcordsController
|--- Acords
|--- AcordsDisplay
````
````
CatalogueService
|--- MenuFactory
|--- CatalogueController
|--- Catalogue
|--- CatalogueDisplay
````
````
ConfigurationService
|--- MenuFactory
|--- ConfigurationController
|--- ConfigurationDisplay
````

## 👷‍♀️ TO-DO
- [ ] Botó repetir final loop acords // Funciones goBack entre servicios. 
- [ ] Refactoritzar codi, evaluar acoplament de dependències.
- [ ] Subdividir compassos 12/8, 6/8, etc
- [ ] Address glitch in menu rendering
- [ ] Canviar acords Random per sèrie del catàleg random
- [ ] Compatibilitat multiplataforma
- [ ] Reanomenar classes a un únic idioma 🤦‍♀️
- [ ] Gestió d'errors
- [ ] Tests unitaris
- [x] Gestió _config_ file
- [x] Vistes Pager
- [x] Pasarela -> preview chords before jumping into action