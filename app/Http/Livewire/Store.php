<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Film;
use Usernotnull\Toast\Concerns\WireToast;

class Store extends Component
{
    public $actors, $actor_auto, $director_auto, $type;

    public function mount(){
        $this->film_id = request()->film_id;
        $this->confirm_delete = false;
        $this->error_copy = false;

        if($this->film_id === null){
            //Affiche les session
            $this->name = session('name');
            $this->actor = session('actor');
            $this->director = session('director');
            $this->year = session('year');
            $this->category = session('category');
            $this->type = "available";
        } else {
            $film = Film::findOrFail($this->film_id);

            $this->edit($film);
        }
    }

    public function render()
    {
        $this->actors = Film::select('actor')->where('actor', "like", "%".$this->actor."%")->groupBy('actor')->get();
        $this->directors = Film::select('director')->where('director', "like", "%".$this->director."%")->groupBy('director')->get();

        if($this->film_id === null){
            $search_copy = Film::where('name', $this->name)->first();

            if($search_copy === null){
                $this->error_copy = false;
            } else {
                $this->error_copy = true;
            }
        }

        $categories = ['action', 'aventure', 'biblique', 'catastrophe', 'comédie-francaise', 'comédie-dramatique', 'dessin-animé', 'documentaire', 'drame', 'espionnage', 'fait-vécu', 'guerre', 'policier', 'horreur', 'science-fiction', 'série', 'super-héros', 'thriller', 'vieux-film', 'western'];

        return view('livewire.store', compact('categories'));
    }

    public function edit($film){
        $this->name = $film->name;
        $this->actor = $film->actor;
        $this->director = $film->director;
        $this->year = $film->year;
        $this->category = $film->category;
        $this->type = $film->type;
    }

    public function store(){
        $dataValide = $this->validate([
            'name' => ['required'],
            'actor' => ['required'],
            'director' => ['required'],
            'year' => ['required', 'numeric', 'max_digits:4', 'min_digits:4'],
            'category' => ['required'],
        ]);

        $dataValide = array_merge($dataValide, ['type' => $this->type]);

        //Si c'est un ajout de nouveau film 
        if($this->film_id === null){
            $search_copy = Film::where('name', $dataValide['name'])->first();

            //Et que le film n'existe pas en doublon
            if($search_copy === null){
                Film::updateOrCreate(['id' => $this->film_id], $dataValide);

                $this->resetInputFields();
                toast()
                ->success("Nouveau film ajouté avec succès.")
                ->push();

            } else {
                toast()
                ->warning('Ce film existe déjà dans la base de données')
                ->push();
            }

            return redirect()->route('store');
        } else {
            Film::updateOrCreate(['id' => $this->film_id], $dataValide);

            toast()
            ->success("Film modifié avec succès.")
            ->push();

            return redirect()->route('index');
        }

    }

    public function confirmDelete() {
        $this->confirm_delete = true;
    }

    public function delete()
    {
        Film::find($this->film_id)->delete();

        $this->resetInputFields();

        toast()
            ->success("Film supprimé avec succès.")
            ->pushOnNextPage();

        //On revient à la page index
        return redirect()->route('index');
    }

    public function updated($name, $value)
    {
        if ($this->film_id === null) {
            session([$name => $value]);
        }

        if($name === "actor_auto"){
            $this->actor = $this->actor_auto;

            if ($this->film_id === null) {
                session(["actor" => $this->actor]);
            }
        }

        if($name === "director_auto"){
            $this->director = $this->director_auto;

            if ($this->film_id === null) {
                session(["director" => $this->director]);
            }
        }
    }
    
    public function switchType($type){
        $this->type = $type;
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->actor = '';
        $this->director = '';
        $this->year = '';
        $this->category = '';

        session()->forget(['name', 'actor', 'director', 'year', 'category']);
    }
}
