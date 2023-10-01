# AplicacionAyudaPFC

OBJETIVO PRINCIPAL ---> El objetivo principal de este proyecto es crear una aplicación/asistente para la gestión de la memoria del proyecto con salida en formato editable, que pueda ser exportado a una suite informática como Microsoft Office o LibreOffice.

El objetivo principal se desglosa en los siguientes objetivos secundarios:
    • Gestión del documento.
    • Gestión de tiempo y tareas del trabajo personal.
    • Generador de documento.
    • Investigar y conocer otras herramientas similares.
    • Conocer y trabajar con las nuevas tecnologías implementadas como Vue y mejorar las de Bootstrap.

Que necesito para ello:
  1. Asistente de memoria.
  2. Presetación visual.
  3. Gestor temporal de tareas.
  4. Vitácora/documentación técnica.
  5. Conectar con GitHub.
  6. Generador de DAW.


ASISTENTE DE MEMORIA:
  1. Herramienta que ayude a elaborar la memoria de las PFC.
  2. Que permita definir estructura básica.
  3. Que permita añadir contenido de texto, imágenes y video.
  4. Que permita PDF y HTML.
  5. Plantillas de escritura.


CONECTOR CON GITHUB:
  1. Conectar con la Bitácora/documentación técnica.
  2. Conseguir que al guardar, guarde en local y en GitHUb.

Crear un manual de usuario.

# INFORMACIÓN

Esta aplicación consta de dos partes, un frontend en donde se encuentra toda la lógica para que el usuario tenga una experiencia sencilla, y el backend, donde se guardarían todos los datos relacionados con el proyecto. 

En la parte del frontend, se encuentran todos los archivos .vue y javascript donde se han creado todas las configuraciones de todas las funciones y todos los estilos visuales  junto con un store para ir guardando todos los datos a medida que se van creando las funcionalidades para ver si su funcionamiento es correcto antes de implementar los métodos para conectar con la base de datos.

En la parte de backend,  se encuentran todos los archivos php para el control y comunicación de las dos partes para la gestión de los datos. En esta parte se muestran los datos guardados cuando se hace alguna acción, como la de crear, editar o borrar, para que los guarde y muestre en pantalla.

Por la parte visual, ha sufrido bastantes cambios por las implementaciones a lo largo del proceso de creación de los distintos lenguajes como vue o bootstrap ya que cada uno tienen códigos distintos a la hora de crear los diferentes archivos y comunicarlos entre si.

Y por último, la aplicación tiene un store para comprobar que VUE está en funcionamiento y te permite crear, editar, borrar y guardar los datos creados en el frontend; y una base de datos donde se guardarán los datos y se mostrarán desde el backend en el frontend de la aplicación.

Se utilizará un entorno de trabajo utilizando docker y que implementa el servidor de aplicaciones, la aplicación web en sí desarrollada en PHP, y una base de datos en D-Beaver. El desarrollo contempla el control de código en un repositorio que estaría ubicado en GitHub.
La aplicación se desarrolla utilizando el framework de trabajo Symfony en su versión 6. También cabe destacar el uso de Bootstrap y Vue para los diseños visuales de las páginas web.

Se utiliza el framework de trabajo de Symfony pues:
    • Utiliza un concepto de Modelo-Vista-Controlador.
    • Te simplifica algunos de los procesos para la conexión con la base de datos.
    • Incorpora la gestión de las vistas utilizando  un sistema de plantillas: twig.

# ESTRUCTURA DEL PROYECTO

La estructura de la aplicación es de un proyecto Symfony. Las principales carpetas son: 
    • bin: contiene los archivos referentes a los comandos ejecutables en terminal.
    • config: contiene los archivos de configuración de la aplicación.
    • public: punto donde la aplicación se instancia para que se vea en el navegador.
    • src: contiene el código fuente de la aplicación.
            ▪ Controller: contiene los controladores que dan funcionalidad a la aplicación. 
            ▪ Entity: contiene los distintos ficheros .git.
            ▪ Repository: contiene los distintos ficheros .gitignore.
    • templates: contiene las distintas plantillas Twig.
    • var: contiene los archivos de caché, logs.
    • vendor: contiene el código de Symfony y las librerías externas.