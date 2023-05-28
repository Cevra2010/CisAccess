<?php

namespace Cis\CisAccess\Http\Controllers;

use Cis\CisAccess\CisAccess;
use Cis\CisAccess\Models\Area;
use Cis\CisAccess\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function storeRoleAreaAttachments(Request $request) {

        /** @var Rolle $role */
        $role = Role::findOrFail($request->get('role'));

        /** detach all areas */
        $role->areas()->detach();

        /** loop thru the activated areas */
        foreach($request->except(['_token','role']) as $requestKey => $requestValue) {
            $areaSlug = str_replace("_",".",$requestKey);

            if(CisAccess::areaExists($areaSlug)) {
                $area = Area::where('slug',$areaSlug)->first();
                $role->areas()->attach($area);
            }
        }

        /** redirection to previsous page */
        return redirect()->back();
    }
}
