<?php
echo "Hello World! <br>";
/*La etiqueta de cierre  "?>" solo es necesaria cuando el código php 
está incrustado en html, cuando solo hay php se puede omitir (y es 
práctica recomendada hacerlo) 

El archivo de configuración de php es php.ini. 
En él se encuentran algunas de las siguientes directivas: 

- short_open_tags: Indica si se pueden utilizar en PHP los delimitadores cortos < ? y ?>. 
Es preferible no usarlos, pues puede causarnos problemas si utilizamos páginas con
XML. Para prohibir la utilización de estos delimitadores con PHP le asignamos a esta directiva el valor Off. 
Por defecto suelen estar a On.

- max_execution_time: Permite que puedas ajustar el número máximo de segundos que podrá durar la ejecución de un script PHP. 
Evita que el servidor se bloquee si se produce algún error en un script.

- display_errors: Permite visualizar los errores que se produzcan en el código PHP. 
Para ver el nivel de detalles de los errores mostrados se complementa con la directiva siguiente, los valores recomendados 
por defecto son: Para un entorno en producción a Off, para un entorno endesarrollo a On. Por defecto suele estar en On.

- error_reporting: Indica qué tipo de errores se mostrarán en el caso de que se produzcan. 
Por ejemplo, si haces error_reporting = E_ALL, te mostrará todos los tipos de errores. 
Si no quieres que temuestre los avisos pero sí otros tipos de errores, puedes hacer
error_reporting = E_ALL & ~E_NOTICE.

- file_uploads: Indica si se pueden o no subir ficheros al servidor por HTTP.

- upload_max_filesize: En caso de que se puedan subir ficheros por HTTP, puedes indicar el límite máximo permitido para el tamaño 
de cada archivo. Por ejemplo, upload_max_filesize = 1M

- post_max_size: Complementa la directiva anterior, establece el tamaño máximo de un archivo subido por POST. 
Por ejemplo, post_max_size = 1M.
 */