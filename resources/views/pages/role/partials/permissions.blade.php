<div class="table-responsive">
    <table class="table table-bordered mb-4 text-left">
        <thead>
        <tr>
            <th>{{trans('main.tables')}}</th>
            <th>{{trans('roles.index_roles')}}</th>
            <th>{{trans('roles.create_Page')}}</th>
            <th>{{trans('roles.edit_Page')}}</th>
            <th>{{trans('roles.store_roles')}}</th>
            <th>{{trans('roles.update_roles')}}</th>
            <th>{{trans('roles.delete_roles')}}</th>
            <th>{{trans('roles.show_roles')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach (getPermissionsForView() as $table => $permissions)
            <tr>
                <td>
                    <label class="control control-checkbox text-dark">
                        {{getPermissionTables()[$table]}}
                        <input type="checkbox" name="permissions[{{$table}}][]" id="{{$table}}" class="checkAll auto"
                               data-table="{{$table}}"/>
                        <div class="control_indicator"></div>
                    </label>
                </td>
                @foreach ($permissions as $permission)
                    <td>
                        <label class="control control-checkbox">
                            <span class="opacity-0">#</span>
                            
                            <input type="checkbox" class="permissionCheckbox" name="permissions[{{$table}}][]"
                                   value="{{$permission['value'] }}" data-table="{{$table}}"/>
                            <div class="control_indicator"></div>
                        </label>
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
    


<div class="card-footer">
    <button type="button"
            class="btn btn-outline-danger"
            data-dismiss="modal">
            {{trans('main.close')}}
    </button>

    <button type="submit"
            class="btn btn-outline-primary">
            {{trans('main.create')}}
    </button>
</div>

</div>

@push('js')
    <script>
        // make all checkbox checked when click on checkAll
        

        // check if all checkboxs is checked then make checkAll checked
        
    </script>
@endpush
