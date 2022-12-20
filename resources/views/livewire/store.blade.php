<div class="max-h-screen md:max-w-7xl md:mx-auto">
    <div class="relative rounded-b-3xl min-h-full p-4 bg-king-light md:shadow-xl flex flex-col gap-5 items-center">
        <div class="flex flex-col justify-center w-4/6">
            <label for="category" class="text-amber-600 text-xl font-bold indent-4">Catégories</label>
            <select name="category" id="category" wire:model='category' class="text-center rounded-3xl border-king border-2 h-11 bg-white text-king focus:ring focus:ring-honey focus:border-transparent text-xl font-bold">
                <option>Choissisez une option</option>
                @foreach($categories as $categorie)
                    <option value="{{ $categorie }}">{{ $categorie }}</option>
                @endforeach
            </select>
            @error('category') <span class="text-2xl text-red-600">{{ $message }}</span>@enderror
        </div>
        <div class="flex flex-col justify-center w-4/6">
            <label for="name" class="text-amber-600 text-xl font-bold indent-4">Nom</label>
            <input type="text" id="name" wire:model.debounce.300ms='name' class="text-center rounded-3xl border-king border-2 h-11 bg-white text-king focus:ring focus:ring-honey focus:border-transparent text-xl font-bold">
            @error('name') <span class="text-2xl text-red-600">{{ $message }}</span>@enderror
            @if($this->error_copy === true)
                <p class="text-3xl text-white font-bold text-center bg-red-600 rounded-3xl p-2">/!\ Ce film existe déjà dans la base de données /!\</p>
            @endif
        </div>
        <div class="flex flex-col justify-center w-4/6">
            <label for="actor" class="text-amber-600 text-xl font-bold indent-4">Acteur</label>
            <input type="text" id="actor" wire:model='actor' class="text-center rounded-3xl border-king border-2 h-11 bg-white text-king focus:ring focus:ring-honey focus:border-transparent text-xl font-bold">
            @error('actor') <span class="text-2xl text-red-600">{{ $message }}</span>@enderror
            <select id="actor_auto" wire:model='actor_auto' class="text-center rounded-3xl h-11 w-4/6 self-center bg-white text-king focus:ring focus:ring-honey focus:border-transparent text-xl font-bold">
                <option>Liste des acteurs</option>
                @foreach($this->actors as $actor)
                <option value="{{ $actor->actor }}">{{ $actor->actor }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-col justify-center w-4/6">
            <label for="director" class="text-amber-600 text-xl font-bold indent-4">Réalisateur</label>
            <input type="text" id="director" wire:model='director' class="text-center rounded-3xl border-king border-2 h-11 bg-white text-king focus:ring focus:ring-honey focus:border-transparent text-xl font-bold">
            @error('director') <span class="text-2xl text-red-600">{{ $message }}</span>@enderror
            <select id="director_auto" wire:model='director_auto' class="text-center rounded-3xl h-11 self-center w-4/6 bg-white text-king focus:ring focus:ring-honey focus:border-transparent text-xl font-bold">
                <option>Liste des réalisateurs</option>
                @foreach($this->directors as $director)
                <option value="{{ $director->director }}">{{ $director->director }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-col justify-center w-4/6">
            <label for="year" class="text-amber-600 text-xl font-bold indent-4">Année</label>
            <input type="number" id="year" wire:model='year' class="text-center rounded-3xl border-king border-2 h-11 bg-white text-king focus:ring focus:ring-honey focus:border-transparent text-xl font-bold">
            @error('year') <span class="text-2xl text-red-600">{{ $message }}</span>@enderror
        </div>
        <div class="flex px-8 py-6 w-4/6 justify-between">
            <button wire:click="switchType('available')" class="{{ $this->type === 'available' ? 'text-white bg-king' : 'text-king bg-white' }} w-52 border-king p-3 font-bold rounded-2xl text-2xl">disponible</button>
            <button wire:click="switchType('unavailable')" class="{{ $this->type === 'unavailable' ? 'text-white bg-king' : 'text-king bg-white' }} w-52 border-king p-3 font-bold rounded-2xl text-2xl">endommagé</button>
            <button wire:click="switchType('need')" class="{{ $this->type === 'need' ? 'text-white bg-king' : 'text-king bg-white' }} w-52 border-king p-3 font-bold rounded-2xl text-2xl">à acheter</button>
        </div>
        <div class="flex flex-col justify-center gap-3 w-96 mt-6 items-center">
            <button wire:click='store' class="bg-green-600 text-white text-xl font-semibold rounded-3xl py-2 flex justify-center gap-2 w-96">
                <svg width="32" height="32" viewBox="0 0 24 24">
                    <path fill="currentColor" d="m10.6 16.6l7.05-7.05l-1.4-1.4l-5.65 5.65l-2.85-2.85l-1.4 1.4ZM12 22q-2.075 0-3.9-.788q-1.825-.787-3.175-2.137q-1.35-1.35-2.137-3.175Q2 14.075 2 12t.788-3.9q.787-1.825 2.137-3.175q1.35-1.35 3.175-2.138Q9.925 2 12 2t3.9.787q1.825.788 3.175 2.138q1.35 1.35 2.137 3.175Q22 9.925 22 12t-.788 3.9q-.787 1.825-2.137 3.175q-1.35 1.35-3.175 2.137Q14.075 22 12 22Zm0-2q3.35 0 5.675-2.325Q20 15.35 20 12q0-3.35-2.325-5.675Q15.35 4 12 4Q8.65 4 6.325 6.325Q4 8.65 4 12q0 3.35 2.325 5.675Q8.65 20 12 20Zm0-8Z" />
                </svg>
                Valider
            </button>
            @if($this->film_id != null)
                @if($this->confirm_delete == false)
                    <button wire:click='confirmDelete' class="bg-white text-red-600 text-xl font-bold rounded-3xl mb-12 flex justify-center gap-2 items-center w-96">
                        <svg width="32" height="32" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12 5.99L19.53 19H4.47L12 5.99M2.74 18c-.77 1.33.19 3 1.73 3h15.06c1.54 0 2.5-1.67 1.73-3L13.73 4.99c-.77-1.33-2.69-1.33-3.46 0L2.74 18zM11 11v2c0 .55.45 1 1 1s1-.45 1-1v-2c0-.55-.45-1-1-1s-1 .45-1 1zm0 5h2v2h-2z"/>
                        </svg>
                        Supprimer
                    </button>
                @else
                    <button wire:click='delete' class="bg-white text-red-600 text-xl font-bold rounded-3xl mb-12 flex justify-center gap-2 items-center w-96">
                        <svg width="32" height="32" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12 5.99L19.53 19H4.47L12 5.99M2.74 18c-.77 1.33.19 3 1.73 3h15.06c1.54 0 2.5-1.67 1.73-3L13.73 4.99c-.77-1.33-2.69-1.33-3.46 0L2.74 18zM11 11v2c0 .55.45 1 1 1s1-.45 1-1v-2c0-.55-.45-1-1-1s-1 .45-1 1zm0 5h2v2h-2z"/>
                        </svg>
                        Confirmer votre choix
                    </button>
                @endif
            @else
                <button wire:click='resetInputFields' class="bg-white text-red-600 text-xl font-bold rounded-3xl mb-12 w-96">Tout effacer</button>
            @endif
        </div>
    </div>
</div>
