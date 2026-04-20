<?php
use Livewire\Volt\Component;
use App\Models\Estudiante;
use App\Models\Carrera;
use Livewire\Attributes\Layout;

new #[Layout('layouts.app')] 
class extends Component {
    //propiedades
    public $nombre, $email, $semestre, $carrera_id, $estudiante_id;
    public $editando = false;

    //guardar o actualizar
    public function save() {

        $data = $this->validate([
            'nombre' => 'required|min:3',
            'email' => 'required|email',
            'semestre' => 'required|numeric|min:1|max:12',
            'carrera_id' => 'required'
        ]);

        if ($this->editando) {
            // si se está editando, busca y actualiza
            $est = Estudiante::find($this->estudiante_id);
            $est->update($data);
            $this->editando = false;
            session()->flash('message', '¡Estudiante actualizado con éxito!');
        } else {
            // creación
            Estudiante::create($data);
            session()->flash('message', '¡Estudiante registrado con éxito!');
        }

        //limpiar formulario
        $this->reset(['nombre', 'email', 'semestre', 'carrera_id', 'editando']);
    }

    // cargar datos en el formulario para editar
    public function edit($id) {
        $est = Estudiante::find($id);
        $this->estudiante_id = $id;
        $this->nombre = $est->nombre;
        $this->email = $est->email;
        $this->semestre = $est->semestre;
        $this->carrera_id = $est->carrera_id;
        $this->editando = true;
    }

    // eliminar estudiante
    public function delete($id) {
        Estudiante::destroy($id);
        session()->flash('message', 'Estudiante eliminado correctamente.');
    }

    // pasar datos a la vista
    public function with() {
        return [
            'estudiantes' => Estudiante::with('carrera')->get(),
            'carreras' => Carrera::all()
        ];
    }
}; ?>

<div class="max-w-6xl mx-auto py-8 px-4">
    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow-sm animate-pulse">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-100 mb-8">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">
            {{ $editando ? '📝 Editar Estudiante' : '👤 Registrar Nuevo Estudiante' }}
        </h2>
        
        <form wire:submit.prevent="save" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div class="flex flex-col">
                <input type="text" wire:model="nombre" placeholder="Nombre" class="border rounded-lg p-2.5 focus:ring-2 focus:ring-blue-400 outline-none">
                @error('nombre') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
            
            <div class="flex flex-col">
                <input type="email" wire:model="email" placeholder="Correo" class="border rounded-lg p-2.5 focus:ring-2 focus:ring-blue-400 outline-none">
                @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="flex flex-col">
                <input type="number" wire:model="semestre" min="1" max="12" placeholder="Semestre (1-12)" class="border rounded-lg p-2.5 focus:ring-2 focus:ring-blue-400 outline-none">
                @error('semestre') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="flex flex-col">
                <select wire:model="carrera_id" class="border rounded-lg p-2.5 focus:ring-2 focus:ring-blue-400 outline-none">
                    <option value="">Selecciona Carrera</option>
                    @foreach($carreras as $c)
                        <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                    @endforeach
                </select>
                @error('carrera_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="font-bold py-2.5 px-4 rounded-lg text-white transition {{ $editando ? 'bg-orange-500 hover:bg-orange-600' : 'bg-blue-600 hover:bg-blue-700' }}">
                {{ $editando ? 'Actualizar' : 'Registrar' }}
            </button>
        </form>
        @if($editando)
            <button wire:click="$set('editando', false)" class="mt-2 text-sm text-gray-500 underline">Cancelar edición</button>
        @endif
    </div>

    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="p-4 font-bold text-gray-600">Nombre</th>
                    <th class="p-4 font-bold text-gray-600">Email</th>
                    <th class="p-4 font-bold text-gray-600">Semestre</th>
                    <th class="p-4 font-bold text-gray-600">Carrera</th>
                    <th class="p-4 font-bold text-gray-600 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($estudiantes as $e)
                    <tr class="hover:bg-gray-50 transition" wire:key="{{ $e->id }}">
                        <td class="p-4 text-gray-800">{{ $e->nombre }}</td>
                        <td class="p-4 text-gray-500 text-sm">{{ $e->email }}</td>
                        <td class="p-4"><span class="bg-blue-50 text-blue-700 px-2 py-1 rounded text-xs font-bold">{{ $e->semestre }}° Semestre</span></td>
                        <td class="p-4 font-semibold text-gray-700">{{ $e->carrera->nombre ?? 'N/A' }}</td>
                        <td class="p-4 text-center">
                            <button wire:click="edit({{ $e->id }})" class="text-indigo-600 hover:text-indigo-900 mr-4 font-medium">Editar</button>
                            <button wire:click="delete({{ $e->id }})" 
                                    onclick="confirm('¿Seguro que deseas eliminar a este estudiante?') || event.stopImmediatePropagation()"
                                    class="text-red-600 hover:text-red-900 font-medium">Eliminar</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-400 italic">No hay estudiantes registrados aún.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>