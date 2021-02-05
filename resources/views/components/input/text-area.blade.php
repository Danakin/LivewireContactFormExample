<div class="flex flex-row flex-wrap mb-2 items-center">
    <label 
        for="{{ $name }}"
        class="w-full sm:w-3/12"
    >{{ $slot }}</label>
    <textarea
        rows="10"
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $required ? "required" : ""}}
        wire:model.debounce.500ms="{{ $model }}"
        class="w-full sm:w-9/12 border bg-gray-100 focus:bg-white focus:border-gray-100 focus:outline-none px-2 py-1" 
    ></textarea>
    @include('components.input.partials.error', ['name' => $name])
</div>