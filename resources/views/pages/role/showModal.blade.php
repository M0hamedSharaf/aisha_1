<div class="modal fade" id="showRoleModal" tabindex="-1" role="dialog" aria-labelledby="showRoleModal" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header card-header create__form__header">
                <h5 class="modal-title text-white font-weight-bold" >
                    {{trans('main.users')}}
                </h5>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb-4">
                        <thead>
                            <tr>
                                <th>{{trans('main.num')}}</th>
                                <th>{{trans('main.name')}}</th>
                                <th>{{trans('main.email')}}</th>
                                <th>{{trans('main.role')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Data comes from AJAX --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>