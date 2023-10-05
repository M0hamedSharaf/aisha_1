
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-4 my-4">
    <div class="card ">
        <div class="card-header d-flex justify-content-between align-items-center card__header__for_tables_show_teacher">
            <h3 class="text-capitalize text-white">
                الدرس الجديد
            </h3>
        </div>
        <div class="card-body">
            <div class="user-info-list table-responsive ">
                    <table class="table table-bordered table-hover table-striped mb-4">
                        <thead>
                            <tr>
                                <th class="text-secondary">From Chapter</th>
                                <th class="text-secondary">To Chapter</th>
                                <th class="text-secondary">From Page</th>
                                <th class="text-secondary">To Page</th>
                                <th class="text-secondary">Finished</th>
                                <th class="text-secondary">Rate</th>
                                <th class="text-secondary">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($studentLesson->syllabus as $syllab)
                                    <tr role="row">
                                        <td>{{ $syllab->from_chapter }}</td>
                                        <td>{{ $syllab->to_chapter }}</td>
                                        <td>{{ $syllab->from_page }}</td>
                                        <td>{{ $syllab->to_page }}</td>
                                    @if ($syllab->finished == 1)
                                        <td>
                                            <span class="badge badge-success"> 
                                                Completed
                                            </span>
                                        </td>
                                    @else
                                        <td>
                                            <span class="badge badge-danger">
                                                Not Completed 
                                            </span>
                                        </td>
                                    @endif
                                        <td>
                                            @if ($syllab->rate == 'excellent')
                                                <span class="badge badge-primary">
                                                    {{ $syllab->rate }}
                                                </span>
                                            @elseif ($syllab->rate == 'very good')
                                                <span class="badge badge-secondary">
                                                    {{ $syllab->rate }}
                                                </span>
                                            @elseif ($syllab->rate == 'good')
                                                <span class="badge badge-success">
                                                    {{ $syllab->rate }}
                                                </span>
                                            @elseif ($syllab->rate == 'fail')
                                                <span class="badge badge-danger">
                                                    {{ $syllab->rate }}
                                                </span>
                                            @endif
                                        </td>
                                      
                                        <td>{{ $syllab->created_at }}</td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>





