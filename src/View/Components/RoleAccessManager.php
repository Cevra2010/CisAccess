<?php

namespace Cis\CisAccess\View\Components;

use Cis\CisAccess\CisAccess;
use Illuminate\View\Component;
use Cis\CisAccess\Models\Role;

class RoleAccessManager extends Component
{

    public $role;
    public $accessTree;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Role $role)
    {
        $this->role = $role;
        $this->accessTree = CisAccess::getAccessTree();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('cis-access::components.role-access-manager');
    }
}
