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

localhost/Web2TpeParte3/api/canciones/:ID          ("POR EJEMPLO")    localhost/Web2TpeParte3/api/canciones/12



SORT Y ORDER

Utilizando los parametros SORT y ORDER podemos establecer orden decendente (desc) o ascendente (asc) a lo ingresado en SORT:

titulo 
Duración 
albumID

localhost/Web2TpeParte3/api/canciones?sort=id&order=asc