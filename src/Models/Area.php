<?php

namespace Cis\CisAccess\Models;

use Cis\CisAccess\CisAccess;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';
    protected $fillable = [
        'name',
        'parent',
    ];

    public function getChilds() {
        return CisAccess::getAreaChilds($this);
    }

    public function hasChilds() {
        return CisAccess::hasAreaChild($this);
    }
}
