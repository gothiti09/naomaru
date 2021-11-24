@props(['isComplete' => false, 'isCurrent' => false, 'isUpcoming' => false, 'href' => '#', 'title' => '', 'description' => '', 'haveNext' => true, 'required' => false])
<li class="relative pb-10">
    {{-- <div class="-ml-px absolute mt-0.5 top-4 left-4 w-0.5 h-full bg-primary-500" aria-hidden="true"></div> --}}
    @if ($haveNext)
        <div {!! $attributes->class(['bg-primary-500' => $isComplete, 'bg-gray-300' => !$isComplete])->merge(['class' => '-ml-px absolute mt-0.5 top-4 left-4 w-0.5 h-full']) !!} aria-hidden="true"></div>
    @endif
    <a href="{{ $href }}" class="relative flex items-start group">
        <span class="h-9 flex items-center">
            <span {{-- class="relative z-10 w-8 h-8 flex items-center justify-center bg-primary-500 rounded-full group-hover:bg-primary-800"> --}} {!! $attributes->class([
        'bg-primary-500 rounded-full group-hover:bg-primary-800' => $isComplete,
        'bg-white border-2 border-primary-500 rounded-full' => $isCurrent,
        'bg-white border-2 border-gray-300 rounded-full group-hover:border-gray-400' => $isUpcoming,
    ])->merge(['class' => 'relative z-10 w-8 h-8 flex items-center justify-center']) !!}>
                @if ($isComplete)
                    <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                @elseif($isCurrent)
                    <span class="h-9 flex items-center" aria-hidden="true">
                        <span
                            class="relative z-10 w-8 h-8 flex items-center justify-center bg-white border-2 border-primary-500 rounded-full">
                            <span class="h-2.5 w-2.5 bg-primary-500 rounded-full"></span>
                        </span>
                    </span>
                @elseif($isUpcoming)
                    <span class="h-9 flex items-center" aria-hidden="true">
                        <span
                            class="relative z-10 w-8 h-8 flex items-center justify-center bg-white border-2 border-gray-300 rounded-full group-hover:border-gray-400">
                            <span class="h-2.5 w-2.5 bg-transparent rounded-full group-hover:bg-gray-300"></span>
                        </span>
                    </span>
                @endif
            </span>
        </span>
        <span class="ml-4 min-w-0 flex flex-col">
            <span class="text-sm font-semibold tracking-wide" {!! $attributes->class([
        'text-gray-900' => $isComplete,
        'text-primary-500' => $isCurrent,
        'text-gray-500' => $isUpcoming,
    ])->merge(['class' => 'text-sm font-semibold tracking-wide']) !!}>{{ $title }}
                @if ($required)
                    <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                        必須
                    </p>
                @endif
            </span>
            <span class="text-xs text-gray-500">{{ $description }}</span>
        </span>
    </a>
</li>
