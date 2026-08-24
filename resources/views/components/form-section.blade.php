@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit="{{ $submit }}">
            <div class="px-6 py-6 bg-white sm:p-8 shadow-sm border border-gray-100/80 {{ isset($actions) ? 'sm:rounded-t-2xl' : 'sm:rounded-2xl' }}">
                <div class="grid grid-cols-6 gap-6">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
                <div class="flex items-center justify-end px-6 py-4 bg-gray-50/50 border-t border-gray-100 text-end sm:px-8 shadow-sm sm:rounded-b-2xl">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>

