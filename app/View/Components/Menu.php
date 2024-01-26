<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Menu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
  
    public $active;

    public function __construct($active)
    {
        //
        
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $list = $this->list();
        return view('components.menu', ['list' => $list, 
                                        'active' => $this->active]);
    }
    public function list(){
        return[
            [
                'label' => 'Dashboard',
                'route' => 'dashboard',
                'icon'  => 'fa-solid fa-landmark'
            ],
            [
                'label' => 'Movies',
                'route' => 'dashboard.movies',
                'icon'  => 'fa-solid fa-display'
            ],
            [
                'label' => 'Theaters',
                'route' => 'dashboard.theaters',
                'icon'  => 'fas fa-university'
            ],
            [
                'label' => 'Ticket',
                'route' => 'dashboard.ticket',
                'icon'  => 'fas fa-ticket-alt'
            ],
            [
                'label' => 'Users',
                'route' => 'dashboard.users',
                'icon'  => 'fas fa-users'
            ],
            [
                'label' => 'Logout',
                'route' => 'dashboard.users',
                'icon'  => 'fas fa-users'
            ]
         ];
    }
    public function isActive($label){
        return $label === $this->active;
    }
}
