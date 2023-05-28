<?php namespace Cis\CisAccess\Traits;

use Cis\CisAccess\CisAccess;
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
     * returns the accessibility of the given area
     * @param $areaSlug
     * @return bool
     */
    public function hasAccess($areaSlug) : bool {
        return CisAccess::hasUserAccessToArea($areaSlug,$this);
    }

    /**
     * return the users roles
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}
