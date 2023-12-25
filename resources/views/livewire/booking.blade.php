<div class="flex flex-wrap p-20">
    <div class="bg-gray-100 w-full max-w-sm md:w-1/2 md:max-w-none md:pr-2 mx-auto m-6 p-5 rounded">
        <form wire:submit="checkDays">
            <div class="mb-6">
                <label for="restaurant" class="inline-block text-gray-700 mb-2">Selecciona un restaurante</label>

                <select name="restaurant" class="bg-white h-10 w-full border-none rounded-lg"  wire:model.change="status.restaurant">
                    <option value="">Selecciona un restaurante</option>
                    @foreach($restaurantList as $restaurant)
                        <option value="{{ $restaurant['id'] }}">{{ $restaurant['name'] }}</option>
                    @endforeach
                </select>
                @error('status.restaurant')
                <p class="text-sm text-red-500" aria-live="assertive">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="restaurant" class="inline-block text-gray-700 mb-2">Selecciona número de personas</label>
                <select name="restaurant" class="bg-white h-10 w-full border-none rounded-lg"  wire:model.change="status.persons">
                    <option value="">Selecciona número de personas</option>
                    @for($i = 1; $i <= $maxPersons; $i++)
                        <option value="{{ $i }}">{{ $i }} personas</option>
                    @endfor
                </select>
                @error('status.persons')
                <p class="text-sm text-red-500" aria-live="assertive">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="restaurant" class="inline-block text-gray-700 mb-2">Selecciona un turno</label>
                <select name="restaurant" @class([
                    'h-10 w-full rounded-lg',
                    'bg-white border-none' => $errors->missing('status.turn'),
                    'border-2 border-red-500' => $errors->has('status.turn'),
                ])
                @error('status.turn')
                aria-invalid="true"
                        aria-description="{{ $message }}"
                        @enderror
                        wire:model.change="status.turn">
                    <option value="">Selecciona un turno</option>
                    @foreach($turnList as $turn)
                        <option value="{{ $turn['id'] }}">{{ $turn['name'] }}</option>
                    @endforeach
                </select>
                @error('status.turn')
                <p class="text-sm text-red-500" aria-live="assertive">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <div class="flex">
                    <button type="submit" class="relative w-full bg-blue-500 py-3 px-8 rounded-lg text-white font-medium disabled:cursor-not-allowed disabled:opacity-75">
                        Comprobar disponibilidad
                    </button>
                </div>
            </div>


        </form>

        @if($showHours)
            <x-dialog-modal wire:model="showHours">
                <x-slot name="title">
                    Horas disponibles
                </x-slot>
                <x-slot name="content">
                    Horas disponibles el {{ $this->status['date'] }}:
                    <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

                        @foreach($this->hours as $hour)
                            <li class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow">
                                <div class="flex w-full items-center justify-between space-x-6 p-6">
                                    <h3 class="truncate text-sm font-medium text-gray-900">
                                        {{ $hour }}
                                    </h3>
                                </div>
                                <div>
                                    <div class="-mt-px flex divide-x divide-gray-200">
                                        <div class="flex w-0 flex-1">
                                            <a href="#" class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5z"></path>
                                                </svg>
                                                Compartir
                                            </a>
                                        </div>
                                        <div class="-ml-px flex w-0 flex-1">
                                            <a href="#" class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z"></path>
                                                </svg>
                                                Reservar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </x-slot>
                <x-slot name="footer">
                    <x-secondary-button wire:click="$toggle('showHours')" wire:loading.attr="disabled">
                        Cancelar
                    </x-secondary-button>
                </x-slot>
            </x-dialog-modal>
        @endif
    </div>
    <div class="bg-gray-100 w-full max-w-sm md:w-1/2 md:max-w-none md:pr-2 mx-auto m-6 p-5 rounded ">
        <div id="days" class="mb-6 overflow-auto max-h-[500px] md:max-h-[600px]">

            <ul role="list" class="divide-y divide-gray-100">
                @if($days)
                    @foreach($days as $key => $day)
                        <livewire:day-availability :day="$key" :array="$day" :status="$status" @check="checkHours($event.detail.day)" :key="base64_encode($key . $rand)"/>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>
