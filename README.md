# CRUDEstudiantes

Nombre completo: Martín de Jesús Ramírez Rodríguez
Carrera: Tecnologías de la Información y Comunicaciones
Grupo:11:00 am
Correo institucional:23151193@aguascalientes.tecnm.mx

Esta página de CRUD empieza con una pantalla de login.
A razón de algunas recomendaciones personales, se ha empleado Laravel Breeze y Livewire Volt 
    para adentrarse en código más moderno, aunque también se intentó usar Flux, finalmente
    fue descartado por los errores constantes e incompatibilidades que se presentaban al 
    emperimentar con éste por primera vez.
En el login se hace primero un regustro con datos aleatorios. El campo del correo requiere una
    estructura similar a un correo con "@", así como confirmar una contraseña que se guardan en
    un caché. Las rutas de recuperación de contraseña venían integradas en el ejemplo del que se
    basó el proyecto en esta primera parte, realmente no lleva a ningún lado importante.
La siguiente pantalla muestra un menú de navegación con las opciones Carreras y Estudiantes.
Carreras simplemente pide un nombre y con eso deja crearla en una tabla que podrá ser usada en la 
    creación de Estudiantes, pues este último pide como campo obligatorio una carrera. De esta manera
    tampoco se podrá eliminar una carrera si aún existen estudiantes que pertenezcan a dicha carrera.
Los Estudiantes piden nombre, correo, semestre (del 1 al 12 como sería en el ITA) y una carrera que se
    seleccionará de un menú despegable según los nombres añadidos en la primera sección. Los datos del
    estudiante se pueden editar.
Se crearo algunas modificación en la estructura que otorgaba Laravel, como en la carpeta Lang, añadiendo
    otra, a su vez, llamada "es". Esto para buscarla forma de hacer traducción de la página al español
    partiendo del inglés predeterminado.

Finalmente las estructuras se veían algo distintas a como fueron en clase, aprovechar los paquetes de
Breeze y Volt fueron retadores y de haber usado otros seguramente habría ahorrado tiempo. Ciertamente
fueron de utlidad los tutoriales, recursos de las páginas, IA y conocidos ya experimentados en estas áreas.
Por ahora el resultado es satisfactorio tras el estrés de hacerlo en un par de días, se esperaría comenzar
con las siguientes tareas con mayor antelación para reducir situaciones así.
