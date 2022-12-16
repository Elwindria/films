<div class="flex justify-center gap-8 mx-auto px-10">  
    <div class="w-10/12">
        <div class="flex flex-col gap-4 pt-6 pb-2 mb-2 px-2 sticky -top-1 bg-king-light rounded-b-3xl z-40">
            <div class="justify-center flex flex-col gap-4">
                <div class="relative w-2/5 self-center">
                    <input wire:model.debounce.500ms="search" class="text-2xl font-bold block w-full text-center appearance-none rounded-3xl p-5 border-honey border-2 h-8 bg-white focus:ring focus:ring-honey-light/50 focus:border-transparent text-king" placeholder="rechercher..." type="search" style="caret-color: rgb(107, 114, 128);" tabindex="0">
                </div>
                <div class="flex gap-2">
		            <button wire:click="switchOrderByType('id')" class="w-1/12 text-amber-600 text-2xl text-center font-bold">Num</button>
                    <button wire:click="switchOrderByType('name')" class="w-3/12 text-amber-600 text-2xl font-bold text-start">Titre</button>
                    <button wire:click="switchOrderByType('actor')" class="w-2/12 text-amber-600 text-2xl text-center font-bold">Acteur</button>
                    <button wire:click="switchOrderByType('director')" class="w-2/12 text-amber-600 text-2xl text-center font-bold">Réalisateur</button>
                    <button wire:click="switchOrderByType('year')" class="w-1/12 text-amber-600 text-2xl text-center font-bold">Année</button>
                    <button wire:click="switchOrderByType('category')" class="w-2/12 text-amber-600 text-2xl text-center font-bold">Catégorie</button>
                    <button wire:click="switchOrderByType('category')" class="w-1/12 text-amber-600 text-2xl text-center font-bold">Dispo</button>
                </div>
            </div>
        </div>
        <div class="flex flex-col justify-center gap-2">
            @foreach( $all_film as $film)
            <a href="{{ route('store', ['film_id' => $film->id]) }}" class="flex items-center bg-gray-300 p-2 border-king hover:bg-gray-400 rounded-3xl border-2">
		        <p class="w-1/12 font-bold text-center text-xl text-king">{{ $film->id }}</p>
                <p class="w-3/12 font-bold text-xl text-king">{{ $film->name }}</p>
                <p class="w-2/12 font-bold text-xl text-center text-king">{{ $film->actor }}</p>
                <p class="w-2/12 font-bold text-xl text-center text-king">{{ $film->director }}</p>
                <p class="w-1/12 font-bold text-xl text-center text-king">{{ $film->year }}</p>
                <p class="w-2/12 font-bold text-xl text-center text-king">{{ $film->category }}</p>
                <p class="w-1/12 flex justify-center">
                    @if($film->type == 'available')
                        <svg width="32" height="32" viewBox="0 0 16 16"><path fill="#32bd00" d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16Zm3.707-9.293l-4.003 4a1 1 0 0 1-1.415 0l-1.997-2a1 1 0 1 1 1.416-1.414l1.29 1.293l3.295-3.293a1 1 0 0 1 1.414 1.414Z"/></svg>
                    @elseif($film->type == 'unavailable')
                        <svg width="32" height="32" viewBox="0 0 2048 2048"><path fill="#cc0000" d="M1024 0q141 0 272 36t244 104t207 160t161 207t103 245t37 272q0 141-36 272t-104 244t-160 207t-207 161t-245 103t-272 37q-141 0-272-36t-244-104t-207-160t-161-207t-103-245t-37-272q0-141 36-272t104-244t160-207t207-161T752 37t272-37zm113 1024l342-342l-113-113l-342 342l-342-342l-113 113l342 342l-342 342l113 113l342-342l342 342l113-113l-342-342z"/></svg>
                    @else
                        <svg width="38" height="38" viewBox="0 0 24 24"><path fill="#ff7b00" d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10zm-1.95-11a2.5 2.5 0 0 1 4.064-1.41l1.701-1.133A4.5 4.5 0 0 0 8.028 11H7v2h1.027a4.5 4.5 0 0 0 7.788 2.543l-1.701-1.134A2.5 2.5 0 0 1 10.05 13l4.95.001v-2h-4.95z"/></svg>
                    @endif
                </p>
            </a>
            @endforeach
        </div>
    </div>
    <div class="flex flex-col items-start w-2/12">
        <div class="flex flex-col items-start sticky -top-1">
            <span class="font-bold text-2xl text-white px-3 py-8">Résultat ({{ $count }})</span>
            <button wire:click="switchCategoryType('all')" class="{{ $this->category === 'all' ? 'text-white' : 'text-amber-600' }} px-3 font-bold text-2xl capitalize ">Tout</button>
            <button wire:click="switchCategoryType('action')" class="{{ $this->category === 'action' ? 'text-white' : 'text-amber-600' }} px-3 font-bold text-2xl capitalize ">Action</button>
            <button wire:click="switchCategoryType('aventure')" class="{{ $this->category === 'aventure' ? 'text-white' : 'text-amber-600' }} px-3 font-bold text-2xl capitalize ">Aventure</button>
            <button wire:click="switchCategoryType('biblique')" class="{{ $this->category === 'biblique' ? 'text-white' : 'text-amber-600' }} px-3  capitalize font-bold text-2xl">biblique</button>
            <button wire:click="switchCategoryType('catastrophe')" class="{{ $this->category === 'catastrophe' ? 'text-white' : 'text-amber-600' }} px-3 capitalize font-bold text-2xl">catastrophe</button>
            <button wire:click="switchCategoryType('comédie')" class="{{ $this->category === 'comédie' ? 'text-white' : 'text-amber-600' }} px-3 capitalize font-bold text-2xl">comédie</button>
            <button wire:click="switchCategoryType('comédie-dramatique')" class="{{ $this->category === 'comédie-dramatique' ? 'text-white' : 'text-amber-600' }} px-3 capitalize font-bold text-2xl">comédie-dramatique</button>
            <button wire:click="switchCategoryType('comédie-francaise')" class="{{ $this->category === 'comédie-francaise' ? 'text-white' : 'text-amber-600' }} px-3 capitalize font-bold text-2xl">comédie-française</button>
            <button wire:click="switchCategoryType('comédie-policière')" class="{{ $this->category === 'comédie-policière' ? 'text-white' : 'text-amber-600' }} px-3 capitalize font-bold text-2xl">comédie-policière</button>
            <button wire:click="switchCategoryType('dessin-animé')" class="{{ $this->category === 'dessin-animé' ? 'text-white' : 'text-amber-600' }} px-3 capitalize font-bold text-2xl">dessin-animé</button>
            <button wire:click="switchCategoryType('documentaire')" class="{{ $this->category === 'documentaire' ? 'text-white' : 'text-amber-600' }} px-3 capitalize font-bold text-2xl">documentaire</button>
            <button wire:click="switchCategoryType('drame')" class="{{ $this->category === 'drame' ? 'text-white' : 'text-amber-600' }} px-3 capitalize font-bold text-2xl">drame</button>
            <button wire:click="switchCategoryType('espionnage')" class="{{ $this->category === 'espionnage' ? 'text-white' : 'text-amber-600' }} px-3 capitalize font-bold text-2xl">espionnage</button>
            <button wire:click="switchCategoryType('fait-vécu')" class="{{ $this->category === 'fait-vécu' ? 'text-white' : 'text-amber-600' }} px-3 capitalize font-bold text-2xl">fait-vécu</button>
            <button wire:click="switchCategoryType('fantastique')" class="{{ $this->category === 'fantastique' ? 'text-white' : 'text-amber-600' }} px-3 capitalize font-bold text-2xl">fantastique</button>
            <button wire:click="switchCategoryType('guerre')" class="{{ $this->category === 'guerre' ? 'text-white' : 'text-amber-600' }} px-3 capitalize font-bold text-2xl">guerre</button>
            <button wire:click="switchCategoryType('policier')" class="{{ $this->category === 'policier' ? 'text-white' : 'text-amber-600' }} px-3 font-bold text-2xl capitalize ">Policier</button>
            <button wire:click="switchCategoryType('horreur')" class="{{ $this->category === 'horreur' ? 'text-white' : 'text-amber-600' }} px-3 capitalize font-bold text-2xl">horreur</button>
            <button wire:click="switchCategoryType('science-fiction')" class="{{ $this->category === 'science-fiction' ? 'text-white' : 'text-amber-600' }}  capze px-3 py-1 font-bold text-2xl">Science-fiction</button>
            <button wire:click="switchCategoryType('série')" class="{{ $this->category === 'série' ? 'text-white' : 'text-amber-600' }} px-3 capitalize font-bold text-2xl">série</button>
            <button wire:click="switchCategoryType('super-héros')" class="{{ $this->category === 'super-héros' ? 'text-white' : 'text-amber-600' }} px-3 capitalize font-bold text-2xl">super-héros</button>
            <button wire:click="switchCategoryType('thriller')" class="{{ $this->category === 'thriller' ? 'text-white' : 'text-amber-600' }} px-3 capitalize font-bold text-2xl">thriller</button>
            <button wire:click="switchCategoryType('vieux-film')" class="{{ $this->category === 'vieux-film' ? 'text-white' : 'text-amber-600' }} px-3 capitalize font-bold text-2xl">vieux-film</button>
            <button wire:click="switchCategoryType('western')" class="{{ $this->category === 'western' ? 'text-white' : 'text-amber-600' }} px-3 capitalize font-bold text-2xl">western</button>
        </div>
    </div>
</div>