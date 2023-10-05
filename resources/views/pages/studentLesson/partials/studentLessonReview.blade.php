<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-4 my-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center card__header__for_tables_show_teacher">
            <h3 class="text-capitalize text-white">
                مراجعة الدرس
            </h3>
        </div>
        <div class="card-body">
            <div class="user-info-list table-responsive">
                    <table class="table mb-4">
                        <thead>
                            <tr>
                                <th class="text-secondary">Id</th>
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
                            @foreach ($studentLessonReview->syllabusReviews as $syllabusReview)
                                    <tr role="row">
                                        <td class="sorting_1">{{ $syllabusReview->id }}</td>
                                        <td>{{ $syllabusReview->from_chapter }}</td>
                                        <td>{{ $syllabusReview->to_chapter }}</td>
                                        <td>{{ $syllabusReview->from_page }}</td>
                                        <td>{{ $syllabusReview->to_page }}</td>

                                        @if ($syllabusReview->finished == 1)
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
                                        </td>
                                        <td>
                                            @if ($syllabusReview->rate == 'excellent')
                                                <span class="badge badge-primary">
                                                    {{ $syllabusReview->rate }}
                                                </span>
                                            @elseif ($syllabusReview->rate == 'very good')
                                                <span class="badge badge-secondary">
                                                    {{ $syllabusReview->rate }}
                                                </span>
                                            @elseif ($syllabusReview->rate == 'good')
                                                <span class="badge badge-success">
                                                    {{ $syllabusReview->rate }}
                                                </span>
                                            @elseif ($syllabusReview->rate == 'fail')
                                                <span class="badge badge-danger">
                                                    {{ $syllabusReview->rate }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{ $syllabusReview->created_at }}</td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>