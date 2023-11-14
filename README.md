# Tpe
TpeWeb2 parte 3

Integrantes: 

Morales, Joaquin (joacomora2014@gmail.com)

Sarasola Nicolas (nicolassarasoladiaz@gmail.com)

Tema del Trabajo Práctico: Sistema de Gestión de Música y Artistas


## Uso de la API

endpoint : 


localhost/Web2TpeParte3/api/canciones/ (GET)
localhost/Web2TpeParte3/api/canciones/ (POST)
localhost/Web2TpeParte3/api/canciones/:ID (GET ID)
localhost/Web2TpeParte3/api/canciones/:ID (PUT)
localhost/Web2TpeParte3/api/canciones/:ID (DELETE)
localhost/Web2TpeParte3/api/auth/token (GET AUTORIZACION)

Servicios GET

GET ALL

localhost/Web2TpeParte3/api/canciones/

GET BY ID

localhost/Web2TpeParte3/api/canciones/:ID          ("POR EJEMPLO")    localhost/Web2TpeParte3/api/canciones/8



ordenPor Y orden 

Utilizando los parametros ordenPor y orden. podemos establecer orden decendente (DESC) o ascendente (ASC) a lo ingresado en ordenPor:

titulo 
Duración 
albumID

localhost/Web2TpeParte3/api/canciones?ordenPor=albumID&orden=ASC


PAGINACION

debemos ingresar dos valroes para nuestras keys , (pagina) y  (limite) de registros que queremos mostrar (maximo 3) , podemos utilizar solo la key de pagina y tendra por defecto limite de 3 registros.

localhost/Web2TpeParte3/api/canciones?pagina=1
localhost/Web2TpeParte3/api/canciones?pagina=1&limite=3  


FILTRO 

utilizamos los parametros campo y valor 

localhost/Web2TpeParte3/api/canciones?campo=albumID&valor=4


