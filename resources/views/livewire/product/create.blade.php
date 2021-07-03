<div>
    <h2 class="text-center">Agregar un nuevo producto</h2>
    <div class="row justify-content-center" style="width: 100%">
        <form wire:submit.prevent="save">
            <label for="">Nombre del producto</label>
            <input type="text" wire:model="name" class="form-control mb-2">
            @error('name') <p class="error mb-2">{{ $message }}</p> @enderror

            <label for="">Descripción</label>
            <textarea cols="20" rows="5" wire:model="description" class="form-control mb-2"></textarea>
            @error('description') <p class="error mb-2">{{ $message }}</p> @enderror

            <label for="">Price</label>
            <input type="number" wire:model="price" class="form-control mb-2">
            @error('price') <p class="error mb-2">{{ $message }}</p> @enderror

            <label for="">Thumbnail</label>
            <input type="file" wire:model="thumbnail" class="form-control mb-2">
            @error('name') <p class="error mb-2">{{ $message }}</p> @enderror

            @if ($thumbnail)
                {{ $thumbnail }}
                <img src="{{ $thumbnail->temporaryUrl() }}" class="img-fluid mb-2">
            @endif

            <button type="submit" class="btn btn-outline-primary btn-block">Save</button>

        </form>
    </div>
</div>
