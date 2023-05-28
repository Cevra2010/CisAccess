<div class="cis-access-role-headline">
    Zugriffsberechtigungen (Rolle: {{ $role->name }})
</div>
<form action="{{ route("cis-access::storeRoleAreaAttachment") }}" method="POST">
    <input type="hidden" name="role" value="{{ $role->id }}">
    @csrf
    @foreach($accessTree as $accessTreeItem)
    <div class="cis-access-box">
        <div class="cis-access-access-tree-header">
           <input type="checkbox" name="{{ $accessTreeItem->slug }}" @if($role->hasAccessToArea($accessTreeItem->slug)) checked @endif>
            <i class="fa fa-layer-group"></i>
            {{ $accessTreeItem->name }}
        </div>
        <div class="cis-access-access-tree-body">
                @if($accessTreeItem->child)
                    @include("cis-access::components.role-access-manager-child",['parent' => $accessTreeItem->child,'deep' => -1])
                @endif
        </div>
    </div>
    @endforeach

    <button class="cis-btn btn-green" type="submit">Speichern</button>
</form>