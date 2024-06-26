<div class="input-container flex flex-col gap-1 w-full">
    @isset($label)
        <label for="{{ $id ?? $name }}" class="select-none">
            {{ $label }}
        </label>
    @endisset

    <div class="relative w-full flex gap-1 items-center" wire:loading.class='animate-pulse'>
        <input type="{{ $type ?? "text" }}" name="{{ $name ?? $id }}" id="{{ $id ?? $name }}" value="{{ old($name ?? $id ?? null, $value ?? null) }}"
            @isset($placeholder) placeholder="{{ $placeholder }}@if (isset($required) && $required) * @endif" @endisset
            @isset($min) min="{{ $min }}" @endisset
            @isset($max) max="{{ $max }}" @endisset
            @isset($step) step="{{ $step }}" @endisset @disabled(isset($disabled) && $disabled)

            @required(isset($required) && $required)

            @isset($wireModel) wire:model.live.debounce.{{$wireDebounce ?? 250}}ms='{{$wireModel}}' @endisset
            @isset($wireEnter) wire:keydown.prevent.enter='{{ $wireEnter }}' @endisset

            @class([
                "w-full px-4 py-2 rounded-md border border-neutral-300 bg-white dark:bg-neutral-800 dark:border-neutral-600 focus-within:border-yellow-600 focus-within:shadow-inner !outline-none transition-all duration-300 !ring-0",
                "text-neutral-900 dark:text-neutral-100",
                'disabled:bg-neutral-200 dark:disabled:bg-neutral-700 disabled:text-neutral-600 dark:disabled:text-black disabled:cursor-not-allowed disabled:select-none',
                'placeholder:text-gray-400' => !$errors->has($name ?? $id),
                'border-red-600 bg-red-100 text-red-600 placeholder:text-red-600' => $errors->has($name ?? $id),
                $inputClass ?? "" => isset($inputClass),
            ])>

            <div wire:loading.class='opacity-100' class="absolute pointer-events-none opacity-0 bg-neutral-200/80 dark:bg-neutral-800/80 rounded backdrop-blur-sm left-0 top-0 w-full h-full flex justify-center items-center text-center">
                <p>Chargement...</p>
            </div>

            @if (isset($suffix))
                <div class="h-full px-2 py-1 bg-neutral-100 dark:bg-neutral-900 dark:border-neutral-700 text-neutral-500 rounded flex flex-col flex-shrink-0 select-none justify-center border">
                    {{ $suffix }}
                </div>
            @endif
    </div>

    @error($name ?? $id)
        <div class="text-sm text-red-600">{{ $message }}</div>
    @enderror
</div>
