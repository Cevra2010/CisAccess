<?php
namespace Cis\CisAccess;

use App\Models\User;
use Cis\CisAccess\Models\Area;
use Cis\CisAccess\Models\Role;

class CisAccess {

    protected static $cisUserObjects;
    protected static $areas;
    protected static $areaTree;

    public static function init() {
        self::buildAreaTree();
        self::$cisUserObjects = collect();
    }

    public static function hasUserAccessToArea($areaSlug,User $user) {
        $userObject = self::getUserObject($user);
        return $userObject->checkAreaAccess($areaSlug);
    }

    public static function areaExists($areaSlug) {
        if(self::$areas->where("slug",$areaSlug)->count()) {
            return true;
        }
        return false;
    }

    public static function hasAreaChild(Area $area): bool
    {
        if(self::$areas->where('parent_slug',$area->slug)->count()){
            return true;
        }
        return false;
    }

    public static function getAreaChilds(Area $area) {
        return self::$areas->where('parent_slug',$area->slug);
    }

    protected static function getUserObject(User $user) {
        if($userObject = self::$cisUserObjects->where("id",$user->id)->first()) {
            return $userObject;
        }
        else {
            $userObject = new CisUserObject($user);
            self::$cisUserObjects->add($userObject);
            return $userObject;
        }
    }

    protected static function buildAreaTree() {
        self::$areas = Area::all();
        self::$areaTree = collect();
        foreach(self::$areas->where("parent_slug",null) as $mainArea) {
            self::$areaTree->add($mainArea);
            self::returnAreaChild(self::$areas,$mainArea);
        }
    }

    private static function returnAreaChild($areaCollection,$areaParent) {
        $areaParent->child = collect();
        if($areaParent->hasChilds()) {
            foreach ($areaParent->getChilds() as $child) {
                $areaParent->child->add($child);
                if ($child->hasChilds()) {
                    self::returnAreaChild($areaCollection, $child);
                }
            }
        }
    }

    public static function getAccessTree() {
        return self::$areaTree;
    }
}