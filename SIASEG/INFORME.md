# INFORME


Debido a la creación de esta rama `branch-to-dev-exportFunction` decidí crear un pequeño archivo .md para corregir algunos problemas que se puedan aparecer, documentando aquí los cambios que estoy realizando e implementarlos con mayor facilidad a la rama principal.



### Instalación de la biblioteca sugerida (`DomPDF`) para la creación de archivos .PDF

Si prefieres leer la documentación original, [clic aquí](https://github.com/barryvdh/laravel-dompdf).

Requieres instalar el paquete:
```
composer require barryvdh/laravel-dompdf
```


Instalada la librería, se agregó una etiqueta para funcionar como botón para exportar a PDF en el divisor de la barra de busquedas en `IndexPersonal.blade.php`:

``` html
<!-- Barra de búsqueda --> <!-- Hay un error en 'max-width: 700px;', esta mal declarado, no corregiré hasta tener aprobación. -->
            <div class="search-bar" style="margin-bottom: 20px; display: flex; justify-content: center; width: 100%; ">
                <form action="{{ route('mostrarempleados') }}" method="GET" style="display: flex; width: 100%; max-width: 700px; gap: 10px;">
                    <input type="text" name="busqueda" placeholder="Buscar empleado..."
                        value="{{ request('busqueda') }}"
                        style="flex: 1; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
                    <button type="submit" style="padding: 10px 20px; border: none; background: #FF8B00; color: white; border-radius: 5px;">
                        Buscar
                    </button>
                </form>

                {{-- Aquí agregaré la etiqueta para el botón de exporat a PDF, en caso de algun problema, consultar aquí --}}
                <a href="{{ route('empleados.pdf') }}" class="">Exportar a PDF</a>
            </div>
```

El diseño se implementará pronto.

<br>

Después, se agrega una nueva ruta en `web.php`

```php
// Esta ruta sirve para mostrar el PDF, aun sin exportar.
Route::get('empleados/pdf', [EmployedController::class, 'generatePDF'])->name('empleados.pdf');

```

<br>

Y por último agregué una nueva función en el controlador de empleados `EmployedController.php`:

```PHP
    public function generatePdf(Request $request){
        try {
            $query = Employed::query();

            // Si viene algo en la barra de búsqueda
            if ($request->filled('busqueda')) {
                $busqueda = $request->busqueda;

                // indicamos las columnas donde se realizará la búsqueda
                $query->where(function ($q) use ($busqueda) {
                    $q->where('nombres', 'like', "%{$busqueda}%")
                        ->orWhere('apellidos', 'like', "%{$busqueda}%")
                        ->orWhere('RFC', 'like', "%{$busqueda}%")
                        ->orWhere('CURP', 'like', "%{$busqueda}%")
                        ->orWhere('correo', 'like', "%{$busqueda}%")
                        ->orWhere('telefono', 'like', "%{$busqueda}%");
                });
            }

            // Paginamos los resultados
            // el numero es la cantidad de resultados por página
            $empleados = $query->paginate();

            $pdf = Pdf::loadView('details.empleados', compact('empleados')) ->setPaper('Letter', 'landscape');
            return $pdf->download('empleados.pdf');

        } catch (\Exception $e) {
            \Log::error('Error al obtener la lista de empleados: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al cargar la lista de empleados.');
        }
    }
```

Basandome en el código inicial para mostrar los resultados, pero evitando que haga alguna paginación, este fragmento puede ser optimizado, y lo será, aunque por motivos de prueba, se reutilizó un código anterior para comprobar funcionamientos.


Este último código hace referencia a una nueva vista, debido a la naturaleza del funcionamiento de la biblioteca `DomPDF`, este requiere que se haga una vista forzosamente para "imprimirla" y crear el PDF basado en eso, por lo que se creo un nuevo directorio en `resources.

```text
resources/
├── css/
├── js/
└── views/
    └── details/
        └── empleados.blade.php
```

`empleados.blade.php` es encargado de crear la tabla e implementarle el diseño.
