@extends('layouts.admin')

@section('title', 'Editar Kit | Electrónica Digital MX')
@section('page-title', 'Modificar Kit de Seguridad')

@section('styles')
<style>
    .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; margin-bottom: 1.5rem; }
    .form-group { display: flex; flex-direction: column; gap: 0.4rem; }
    .form-group.full { grid-column: span 2; }
    .form-label { font-size: 0.88rem; font-weight: 600; color: var(--admin-dark); }
    .form-input { padding: 0.75rem 1rem; border: 1px solid var(--admin-border); border-radius: 8px; font-size: 0.9rem; outline: none; }
    .form-input:focus { border-color: var(--admin-blue); box-shadow: 0 0 0 3px rgba(21,78,231,0.1); }
    .form-checkbox { display: flex; align-items: center; gap: 0.6rem; font-size: 0.9rem; font-weight: 500; cursor: pointer; }
</style>
@endsection

@section('content')
    <div class="card">
        <form action="{{ route('admin.kits.update', $kit) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Nombre del Kit / Paquete *</label>
                    <input type="text" name="name" class="form-input" value="{{ old('name', $kit->name) }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Categoría *</label>
                    <select name="category_id" class="form-input" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $kit->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Precio Estimado (MXN)</label>
                    <input type="number" step="0.01" name="estimated_price" class="form-input" value="{{ old('estimated_price', $kit->estimated_price) }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Distintivo Visual (Badge)</label>
                    <input type="text" name="badge" class="form-input" value="{{ old('badge', $kit->badge) }}">
                </div>

                <div class="form-group full">
                    <label class="form-label">Resumen Técnico de Componentes *</label>
                    <input type="text" name="specs_summary" class="form-input" value="{{ old('specs_summary', $kit->specs_summary) }}" required>
                </div>

                <div class="form-group full">
                    <label class="form-label">URL de Imagen del Producto</label>
                    <input type="url" name="image_url" class="form-input" value="{{ old('image_url', $kit->image_url) }}">
                </div>

                <div class="form-group full">
                    <label class="form-label">Descripción Comercial</label>
                    <textarea name="description" rows="3" class="form-input">{{ old('description', $kit->description) }}</textarea>
                </div>

                <div class="form-group full">
                    <label class="form-label">Viñetas de Características (Una por línea)</label>
                    <textarea name="features_text" rows="3" class="form-input">{{ old('features_text', is_array($kit->features) ? implode("\n", $kit->features) : '') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-checkbox">
                        <input type="checkbox" name="includes_installation" value="1" {{ $kit->includes_installation ? 'checked' : '' }}>
                        <span>¿Incluye mano de obra / instalación técnica?</span>
                    </label>
                </div>

                <div class="form-group">
                    <label class="form-checkbox">
                        <input type="checkbox" name="is_active" value="1" {{ $kit->is_active ? 'checked' : '' }}>
                        <span>Visible en el catálogo público</span>
                    </label>
                </div>
            </div>

            <div style="display:flex; gap:1rem;">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Guardar Cambios</button>
                <a href="{{ route('admin.kits.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
