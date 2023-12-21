<div>
    @if($available)
        <li class="relative flex justify-between gap-x-6 py-5">
            <div class="flex min-w-0 gap-x-4">
                <div class="min-w-0 flex-auto">
                    <p class="text-sm font-semibold leading-6 text-gray-900">
                        <button wire:click="checkHours()">
                            <span class="absolute inset-x-0 -top-px bottom-0"></span>
                            {{ $day }}
                        </button>
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-x-4">
                <div class="hidden sm:flex sm:flex-col sm:items-end">
                    <p class="text-sm leading-6 text-gray-900">Comprobar horas disponibles</p>
                </div>
                    <svg class="h-5 w-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                    </svg>
            </div>
        </li>

    @else
        <li class="relative flex justify-between gap-x-6 py-5">
            <div class="flex min-w-0 gap-x-4">
                <div class="min-w-0 flex-auto">
                    <p class="text-sm font-semibold leading-6 text-gray-900">
                        <button disabled>
                            <span class="absolute inset-x-0 -top-px bottom-0"></span>
                            {{ $day }}
                        </button>
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-x-4">
                <div class="hidden sm:flex sm:flex-col sm:items-end">
                    <p class="text-sm leading-6 text-red-600">
                        No hay horas disponibles
                    </p>
                </div>
                    <svg class="h-5 w-5 flex-none text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                    </svg>
            </div>
        </li>
    @endif
</div>