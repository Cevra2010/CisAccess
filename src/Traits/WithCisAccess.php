<?php namespace Cis\CisAccess\Traits;

use Cis\CisAccess\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

/*
|--------------------------------------------------------
| The Access Trait
|--------------------------------------------------------
| The access trait extends the laravels defaul user model
| with methods to check an area access
 */
trait WithCisAccess {

    /**
     * contains all, for this user instance accessible areas as collection or null
     * @var null|Collection
     */
    protected $accessibleCollection = null;

    /**
     * returns the accessibility of the given area
     * @param $areaSlug
     * @return bool
     */
    public function hasAccess($areaSlug) : bool {

        // load accessible areas only when needed for the user instance
        if($this->accessibleCollection === null) {
            $this->loadAccessibleAreas();
        }

        if(!$this->checkAreaAccess($areaSlug)) {
            return false;
        }

        return true;
    }

    /**
     * return the users roles
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * loads the accessible areas for this user instance
     * @return void
     */
    private function loadAccessibleAreas() : void {

        $areasCollection = collect();

        foreach($this->roles as $role){
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
    private function checkAreaAccess(string $areaSlug) : bool {
        foreach($this->accessibleCollection as $area) {
            if($areaSlug == $area->slug) {
                return true;
            }
        }
        return false;
    }

}
