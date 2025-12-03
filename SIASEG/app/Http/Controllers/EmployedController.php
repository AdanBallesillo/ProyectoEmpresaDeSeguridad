<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;
use App\Models\Employed;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Mail;
use App\Mail\CredencialesEmpleadoMail;

class EmployedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
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
            $empleados = $query->paginate(5);

            return view('Jefe.IndexPersonal', compact('empleados'));
        } catch (\Exception $e) {
            \Log::error('Error al obtener la lista de empleados: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al cargar la lista de empleados.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('crearempleado');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Diccionario de mensajes personalizados
        $errorMessages = [
            'CURP.unique' => 'Error: esta CURP ya está registrada en la base de datos.',
            'RFC.unique' => 'Error: este RFC ya está registrado en la base de datos.',
            'correo.unique' => 'Error: este correo ya está registrado en la base de datos.',
            'required' => 'El campo :attribute es obligatorio.',
            'email' => 'El formato del correo electrónico no es válido.',
            'max' => 'El campo :attribute no puede tener más de :max caracteres.',
            'image' => 'El archivo subido debe ser una imagen válida (jpg, png, gif, etc).',
            'mimes' => 'El formato de la imagen debe ser jpg, jpeg, png o gif.',
        ];

        try {
            // Validar los datos del formulario
            $validated = $request->validate(
                [
                    'nombres' => 'required|string|max:100',
                    'apellidos' => 'required|string|max:100',
                    'CURP' => 'required|string|max:18|unique:empleados,CURP',
                    'RFC' => 'required|string|max:13|unique:empleados,RFC',
                    'telefono' => 'required|string|max:15',
                    'fotografia' => 'nullable|image|mimes:jpg,jpeg,png,gif',
                    'rol' => 'required|string|max:100',
                    'correo' => 'required|email|max:150|unique:empleados,correo'
                ],
                $errorMessages
            );

            // Generar num_control único
            do {
                $noEmpleado = rand(100000, 999999);
            } while (Employed::where('no_empleado', $noEmpleado)->exists());

            // Generar password aleatorio
            $passwordPlain = Str::random(8);
            $passwordHashed = Hash::make($passwordPlain);

            // Crear nuevo empleado
            $personal = new Employed();
            $personal->fill($validated);
            $personal->no_empleado = $noEmpleado;
            $personal->password = $passwordHashed;

            // Guardar fotografía si se sube
            if ($request->hasFile('fotografia')) {
                $image = $request->file('fotografia');

                // Generar nombre único
                $imageName = time() . '_' . $image->getClientOriginalName();

                // Guardar en storage/app/public/fotos la imagen
                $path = $image->storeAs('fotos', $imageName, 'public');

                // Guardar ruta accesible públicamente en public/storage/fotos con ayuda del link simbólico
                $personal->fotografia = 'storage/' . $path;
            }

            // Guardar registro en la base de datos
            $personal->save();

            // Mandamos llamar al metodo para enviar las credenciales por correo
            $this->enviarCredencialesEmpleado($personal, $passwordPlain);

            // Retornar con datos útiles
            return redirect()->route('crearempleado')->with([
                'success' => 'Empleado registrado exitosamente.',
                'password' => $passwordPlain,
                'no_empleado' => $noEmpleado
            ]);
        } catch (ValidationException $e) {
            // Error de validación (regresa los mensajes)
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (QueryException $e) {
            // Error en base de datos
            Log::error('Error al guardar empleado: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Ocurrió un error al guardar los datos del empleado. Intenta de nuevo.')
                ->withInput();
        } catch (\Exception $e) {
            // Error general
            Log::error('Error inesperado: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Ha ocurrido un error inesperado. Contacta al administrador.')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('mostrarempleados');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            // Buscar el empleado por su ID o lanzar excepción si no existe
            $empleado = Employed::findOrFail($id);

            // Retornar la vista de edición y enviar los datos del empleado
            return view('Jefe.EditUsuarios', compact('empleado'));
        } catch (\Exception $e) {
            // Registrar error en el log de Laravel
            \Log::error('Error al cargar empleado para edición: ' . $e->getMessage());

            // Retornar al listado con un mensaje de error
            return redirect()
                ->route('mostrarempleados')
                ->with('error', 'No se pudo cargar la información del empleado.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Diccionario de mensajes personalizados
        $errorMessages = [
            'CURP.unique' => 'Error: esta CURP ya está registrada en la base de datos.',
            'RFC.unique' => 'Error: este RFC ya está registrado en la base de datos.',
            'correo.unique' => 'Error: este correo ya está registrado en la base de datos.',
            'required' => 'El campo :attribute es obligatorio.',
            'email' => 'El formato del correo electrónico no es válido.',
            'max' => 'El campo :attribute no puede tener más de :max caracteres.',
            'image' => 'El archivo subido debe ser una imagen válida (jpg, png, gif, etc).',
            'mimes' => 'El formato de la imagen debe ser jpg, jpeg, png o gif.',
        ];


        try {
            $empleado = Employed::findOrFail($id);

            // Validar los datos del formulario
            $validated = $request->validate(
                [
                    'nombres' => 'string|max:100',
                    'apellidos' => 'string|max:100',
                    'CURP' => 'string|max:18|unique:empleados,CURP,' . $id . ',id_empleado',
                    'RFC' => 'string|max:13|unique:empleados,RFC,' . $id . ',id_empleado',
                    'telefono' => 'string|max:15',
                    'rol' => 'string|max:100',
                    'correo' => 'email|max:150|unique:empleados,correo,' . $id . ',id_empleado',
                    'status' => 'required|in:Activo,Inactivo'
                ],
                $errorMessages
            );

            // Actualizar campos generales
            $empleado->fill($validated);

            // // Guardar fotografía si se sube
            // if ($request->hasFile('fotografia')) {
            //     $image = $request->file('fotografia');

            //     // Generar nombre único
            //     $imageName = time() . '_' . $image->getClientOriginalName();

            //     // Guardar en storage/app/public/fotos la imagen
            //     $path = $image->storeAs('fotos', $imageName, 'public');

            //     // Guardar ruta accesible públicamente en public/storage/fotos con ayuda del link simbólico
            //     $personal->fotografia = 'storage/' . $path;
            // }

            // init
            $credenciales = [];

            // Generar nuevo número de control si se selecciona
            if ($request->has('generar_no_control')) {
                $nuevoNumero = rand(100000, 999999);
                $empleado->no_empleado = $nuevoNumero;
                $credenciales['no_empleado'] = $nuevoNumero;
            }

            // Generar nueva contraseña si se selecciona
            if ($request->has('generar_password')) {
                $nuevaPass = Str::random(8);
                $empleado->password = Hash::make($nuevaPass);
                $credenciales['password'] = $nuevaPass;
            }

            $empleado->status = $request->status;
            $empleado->save();

            // enviar correo solo si se generaron credenciales nuevas
            if (!empty($credenciales)) {
                // enviar: nombre, correo, no_empleado, password (password puede ser null)
                $this->enviarCredencialesEmpleado($empleado, $credenciales['password'] ?? null);
            }

            // Mensaje base
            $mensaje = 'Empleado actualizado correctamente.';

            // Si se generaron credenciales nuevas, añadimos detalle al mensaje
            if (!empty($credenciales)) {
                $mensaje .= "\n\nNuevas credenciales generadas:";
            }

            // Retornar con los datos correctos
            return redirect()->back()->with([
                'success' => $mensaje,
                'no_empleado' => $credenciales['no_empleado'] ?? null,
                'password' => $credenciales['password'] ?? null,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error al actualizar empleado: ' . $e->getMessage());
            return redirect()->back()->with('error', 'No se pudo actualizar el empleado.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Enviar correo con credenciales del empleado.
     */
    private function enviarCredencialesEmpleado(Employed $empleado, ?string $passwordPlain)
    {
        try {
            Mail::to($empleado->correo)
                ->send(new CredencialesEmpleadoMail($empleado->nombres, $empleado->no_empleado, $passwordPlain));
            return true;
        } catch (\Exception $e) {
            Log::error('Error al enviar credenciales por correo: ' . $e->getMessage());
            return false;
        }
    }

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
}
