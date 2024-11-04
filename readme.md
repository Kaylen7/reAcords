# Acords-CLI
Practica acords desde la consola.

## Instal·lació

## Flujo de la app
````
index.php
|--- MainController
|   |--- getAcordsRandom
|   |   |--- AcordsGenerator
|   |---getAcordsEspecifics
|   |   |--- AcordsGenerator
|   |---getAcordsColeccio
|   |   |--- CatalogService
|   |   |   |--- CatalogNavigator
|   |   |   |--- AcordsCollection
|   |   |--- AcordsGenerator

````

## TO-DO
- [ ] Gestió _config_ file
- [ ] Vistes Pager
- [ ] Address glitch in menu rendering 
- [ ] Botó repetir final loop acords
- [ ] Change Catalog to Singleton model (?)
- [ ] Add preview chords before jumping into action
- [ ] Opció random a acords específics
- [ ] Compatibilitat multiplataforma
- [ ] Reanomenar classes
- [ ] Gestió d'errors
- [ ] Tests unitaris