<?php
use Livewire\Volt\Component;
use App\Models\Carrera;
use Livewire\Attributes\Layout;

new #[Layout('layouts.app')] 
class extends Component {
    public $nombre = '';
    public $error_borrado = '';

    public function save() {
        $this->validate(['nombre' => 'required|min:3']);
        Carrera::create(['nombre' => $this->nombre]);
        $this->nombre = '';
        session()->flash('message', 'Carrera creada con éxito.');
    }

    public function delete($id) {
        $carrera = Carrera::find($id);
        
        // verificación de estudiantes
        if ($carrera->estudiantes()->count() > 0) {
            $this->error_borrado = "No se puede eliminar: aún hay estudiantes registrados en la carrera " . $carrera->nombre;
            return;
        }

        $carrera->delete();
        $this->error_borrado = '';
        session()->flash('message', 'Carrera eliminada.');
    }

    public function with() {
        return ['carreras' => Carrera::all()];
    }
}; ?>

<div class="max-w-4xl mx-auto py-6">
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    @if ($error_borrado)
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ $error_borrado }}
        </div>
    @endif

    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-bold mb-4">Carreras</h2>
        <form wire:submit.prevent="save" class="flex gap-2 mb-6">
            <input type="text" wire:model="nombre" class="border p-2 flex-1 rounded" placeholder="Nombre de carrera">
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Guardar</button>
        </form>

        <table class="w-full">
            <thead><tr class="border-b text-left"><th>Nombre</th><th class="text-right">Acciones</th></tr></thead>
            <tbody>
                @foreach($carreras as $c)
                <tr class="border-b">
                    <td class="py-2">{{ $c->nombre }}</td>
                    <td class="py-2 text-right">
                        <button wire:click="delete({{ $c->id }})" class="text-red-600">Eliminar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>