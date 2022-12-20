<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Film;
use Usernotnull\Toast\Concerns\WireToast;

class Index extends Component
{
    public $films, $orderBy, $search, $type;

    public function mount()
    {
        $this->category = 'all';
        $this->orderBy = 'name';
        $this->type = 'available';
        $this->direction = 'ASC';
        $this->search = '';
    }

    public function render()
    {
        if ($this->category === 'all') {
            $search_category = ['action', 'aventure', 'biblique', 'catastrophe','comédie' , 'comédie-française', 'comédie-dramatique', 'comédie-policière', 'dessin-animé', 'documentaire', 'drame', 'espionnage', 'fait-vécu', 'fantastique', 'guerre', 'policier', 'horreur', 'science-fiction', 'série', 'super-héros', 'thriller', 'vieux-film', 'western'];
        } else {
            $search_category = [$this->category];
        }

        $all_film_name = Film::whereIn('category', $search_category)->where('type', $this->type)->where('name', 'like', '%'.$this->search.'%')->orderBy($this->orderBy, $this->direction)->get();
        $all_film_actor = Film::whereIn('category', $search_category)->where('type', $this->type)->where('actor', 'like', '%'.$this->search.'%')->orderBy($this->orderBy, $this->direction)->get();
        $all_film_director = Film::whereIn('category', $search_category)->where('type', $this->type)->where('director', 'like', '%'.$this->search.'%')->orderBy($this->orderBy, $this->direction)->get();
        $all_film_year = Film::whereIn('category', $search_category)->where('type', $this->type)->where('year', '=', $this->search)->orderBy($this->orderBy, $this->direction)->get();
        $all_film_id = Film::whereIn('category', $search_category)->where('type', $this->type)->where('id', '=', $this->search)->orderBy($this->orderBy, $this->direction)->get();
        $all_film = $all_film_name->merge($all_film_actor)->merge($all_film_director)->merge($all_film_year)->merge($all_film_id);

        $count = $all_film->count();

        return view('livewire.index', compact('all_film', 'count'));
    }

    public function switchCategoryType($category)
    {
        $this->category = $category;
    }

    public function switchOrderByType($orderBy)
    {
        if($orderBy === "type"){
            if($this->type === 'available'){
                $this->type = 'unavailable';
            } else {
                $this->type = 'available';
            }
        } else {
            if($this->orderBy === $orderBy){
                if($this->direction === 'ASC'){
                    $this->direction = 'DESC';
                } else {
                    $this->direction = 'ASC';
                }
            } else {
                $this->orderBy = $orderBy;
                $this->direction = 'ASC';
            }
        }
    }
}
