<?php
/**
 * Created by PhpStorm.
 * User: Windows 10
 * Date: 07/03/2023
 * Time: 03:48 PM
 */
?>
<div>
    <label class="text-gray-500">
{{ $label }}
</label>
<div class="relative">
    <button
        wire:click="toggle"
        class="w-full flex items-center justify-between h-12 bg-white border rounded-lg px-2"
    >
        @if ($selected !== null)
            {{ $items[$selected] }}
        @else
            Choose...
        @endif

        <div class="text-gray-400">
            @if ($open)
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                          clip-rule="evenodd"/>
                </svg>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                          clip-rule="evenodd"/>
                </svg>
            @endif
        </div>
    </button>
    @if ($open)
        <ul class="bg-white absolute mt-1 z-10 border rounded-lg w-full">
            @foreach($items as $item)
                <li wire:click="select({{ $loop->index }})"
                    @class([
                'px-3 py-2 cursor-pointer flex items-center justify-between',
                'bg-blue-500 text-white' => $selected === $loop->index,
                'hover:bg-blue-400 hover:text-white',
                ])
                >
                {{ $item }}

                @if ($selected === $loop->index)
                    <div class="text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                             fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                    @endif
                    </li>
                    @endforeach
        </ul>
    @endif
</div>
</div>
