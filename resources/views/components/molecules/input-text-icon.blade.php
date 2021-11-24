@props(['action' => '', 'placeholder' => '', 'icon' => '', 'name' => '', 'value' => ''])

<div>
    <div {{ $attributes->merge(['class' => 'relative rounded-md shadow-sm']) }}>
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <!-- Heroicon name: solid/mail -->
            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                aria-hidden="true">
                <path fill-rule="evenodd"
                    d="{{$icon}}"
                    clip-rule="evenodd" />
            </svg>
        </div>
        <input type="text" name="{{$name}}" id="{{$name}}" value="{{ old($name, $value) }}"
            class="focus:ring-gray-500 focus:border-gray-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md"
            placeholder="{{ $placeholder }}">
    </div>
</div>
