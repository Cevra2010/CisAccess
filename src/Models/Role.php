<?php

namespace Cis\CisAccess\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = [
        'name',
    ];

    public function areas() {
        return $this->belongsToMany(Area::class);
    }

    public function hasAccessToArea($areaSlug) {
        if($this->areas()->where('slug',$areaSlug)->count()) {
            return true;
        }
        return false;
    }
}
