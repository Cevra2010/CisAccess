@php $deep++ @endphp
@foreach($parent as $child)
    <!-- Parent //-->
    <div class="cis-access-area-element @if($loop->last)@endif">
        <div class="flex">
            @for($i = 0; $i < $deep; $i++)
                <div class="w-10"><i class="fa fa-ellipsis"></i></div>
            @endfor
            <div class="mr-2"><input type="checkbox" name="{{ $child->slug }}" @if($role->hasAccessToArea($child->slug)) checked @endif></div>
            <div>{{ $child->name }}</div>
        </div>
    </div>

    <!-- Childs //-->
    @if($child->child)
        @include("cis-access::components.role-access-manager-child",['parent' => $child->child,'deep' => $deep])
    @endif
@endforeach
