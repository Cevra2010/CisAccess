<?php

namespace Cis\CisAccess;

use App\Models\User;

class CisUserObject {

    protected $user;
    protected $areas;
    protected $accessibleCollection = null;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->loadAccessibleAreas();
    }

    /**
     * loads the accessible areas for this user instance
     * @return void
     */
    protected function loadAccessibleAreas() : void {

        $areasCollection = collect();
        
        foreach($this->user->roles as $role){
            foreach($role->areas as $area) {
                if(!$areasCollection->where('slug',$area->slug)->count()) {
                    $areasCollection->add($area);
                }
            }
        }

        if($areasCollection->count()) {
            $this->accessibleCollection = $areasCollection;
        }
    }

    /**
     * Checks if the given area is in the accessible collection
     *
     * @param string $areaSlug
     * @return bool
     */
    public function checkAreaAccess(string $areaSlug) : bool
    {
        foreach ($this->accessibleCollection as $area) {
            if ($areaSlug == $area->slug) {
                return true;
            }
        }
        return false;
    }
}