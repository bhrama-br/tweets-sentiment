<div>
    
    <div class="relative flex items-top justify-center min-h-300 bg-gray-20 dark:bg-gray-800 sm:items-center sm:pt-0">
        <div class="top-0 center-0 px-6 py-4 sm:block">
            <input class="form-control" type="text" wire:model="search" placeholder="Palavra chave">
            <button class="bg-blue-200 px-4" wire:click="search_sentiments">
                    Buscar <span class="badge badge-primary"></span>
            </button>
        </div>
    </div>
        
    <div class="min-w-screen min-h-screen bg-gray-200 flex items-center justify-center px-5 py-5 sm:relative">
        <p class="top-20 sm:absolute text-red-500 font-semibold">@error('search') <span class="error">{{ $message }}</span> @enderror</p>


        <div wire:loading wire:target='search_sentiments'>
            <p class="text-center top-20 sm:absolute text-red-500 font-semibold">Espere Por Favor</p>
        </div>

        <div class="w-full max-w-3xl">
            <div class="-mx-2 md:flex">
                <div class="w-full md:w-1/2 px-2">
                    <div class="rounded-lg shadow-sm mb-4">
                        <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                            <div class="px-3 pt-8 pb-10 text-center relative z-10">
                                <h4 class="text-sm uppercase text-gray-500 leading-tight">Positive</h4>
                                <h3 class="text-3xl text-green-700 font-semibold leading-tight my-3">▲ {{ $perc_agree }}%</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 px-2">
                    <div class="rounded-lg shadow-sm mb-4">
                        <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                            <div class="px-3 pt-8 pb-10 text-center relative z-10">
                                <h4 class="text-sm uppercase text-gray-500 leading-tight">Neutral</h4>
                                <h3 class="text-3xl text-black-700 font-semibold leading-tight my-3">{{ $perc_neutral }}%</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 px-2">
                    <div class="rounded-lg shadow-sm mb-4">
                        <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                            <div class="px-3 pt-8 pb-10 text-center relative z-10">
                                <h4 class="text-sm uppercase text-gray-500 leading-tight">Negative</h4>
                                <h3 class="text-3xl text-red-500 font-semibold leading-tight my-3 ">▼ {{ $perc_disagree }}%</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
