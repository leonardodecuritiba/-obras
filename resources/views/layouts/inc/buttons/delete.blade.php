<button data-href="{{(isset($field_delete_route) ? $field_delete_route : route($PageResponse->route.'.destroy',$sel->id))}}"
        class="btn btn-simple btn-xs btn-danger btn-icon"
        onclick="showDeleteTableMessage(this)"
        data-entity="{{(isset($field_delete) ? $field_delete : $PageResponse->name).': '.$sel->getShortName()}}"
        {{--data-toggle="tooltip"--}}
        {{--data-placement="top"--}}
        {{--title="Remover"--}}
            ><i
            class="material-icons">remove_circle_outline</i></button>