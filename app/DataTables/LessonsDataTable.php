<?php

namespace App\DataTables;

use App\Models\Lesson;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LessonsDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            // ->addColumn('edit', 'pages.lesson.datatable.edit')
            ->addColumn('edit', function ($query) {
                return view('pages.lesson.datatable.edit', compact('query'));
            })
            ->addColumn('delete', 'pages.lesson.datatable.delete')
            ->editColumn('subject.name', function ($q) {
                return $q->subject->name ?? "";
            })

            ->rawColumns(['edit', 'delete'])
            ->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        return Lesson::Lessons()->with([
            'subject:id,name',
        ]);
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('product-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'dom'          => 'Blrtip',
                'lengthMenu'   => [[10, 25, 50, -1], [10, 25, 50, 'All records']],
                'buttons'      => [
                    ['extend' => 'print', 'className' => 'btn btn-primary mr-5px', 'text' => trans('main.print')],
                ],
                "language" => [
                    'lengthMenu' => "<div class='lengthMenuSelect' data-lang='". LaravelLocalization::getCurrentLocale() ."'>" . trans('main.display') .
                        '<select class="form-control">' .
                            '<option value="10">10</option>' .
                            '<option value="20">20</option>' .
                            '<option value="30">30</option>' .
                            '<option value="40">40</option>' .
                            '<option value="50">50</option>' .
                            '<option value="-1">All</option>' .
                        '</select> '
                    . trans('main.records') . "</div>",
                    "info" =>  trans('main.showing') . " _START_ " . trans('main.to') . " _END_ " . trans('main.of') . " _TOTAL_ " . trans('main.records'),
                    "paginate" => [
                        "next" => trans('main.next'),
                        "previous" => trans('main.previous'),
                    ]
                ],
                'order' => [
                    0, 'desc'
                ],
                'scrollX' => true,
                'initComplete' => "function() {
                this.api().columns().every(function(){
                    var column = this;
                    var exact = $(column.header()).hasClass('exact')
                    var input = document.createElement(\"input\")
                    input.style.width = column.header().style.width
                    $(input).appendTo($(column.footer()).empty())
                    .on('keyup change clear',function(){
                        if(exact)
                        {
                            var val = $(this).val()
                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        }
                        else
                        {
                            column.search($(this).val() , false, false, true).draw()
                        }
                    })

                    if($(column.header()).hasClass('not--search--col'))
                    {
                        $(column.footer()).empty()
                    }
                })
            }",
                "fnDrawCallback" => "function( oSettings ) {
                refreshAllTableLinks()
                initEditeLessonModal()
            }",

            ]);
    }

    protected function getColumns(): array
    {
        $columns = [
            [
                'name' => 'id',
                'data' => 'id',
                'title' => trans('main.num'),
                "className" => 'search--col exact'
            ],

            [
                'name' => 'subject_id',
                'data' => 'subject.name',
                'title' => trans('main.subject'),
                "className" => 'search--col'
            ],

            [
                'name' => 'title',
                'data' => 'title',
                'title' => trans('main.title'),
                "className" => 'search--col'
            ],
            [
                'name' => 'from_page',
                'data' => 'from_page',
                'title' => trans('lesson.from_page'),
                "className" => 'search--col'
            ],
            [
                'name' => 'to_page',
                'data' => 'to_page',
                'title' => trans('lesson.to_page'),
                "className" => 'search--col'
            ],

            [
                'name' => 'chapters_count',
                'data' => 'chapters_count',
                'title' =>  trans('lesson.chapters_count'),
                "className" => 'search--col'
            ],
        ];

        if(userCan('update-lesson'))
        {
            $columns [] =  [
                'name' => 'edit',
                'data' => 'edit',
                'title' => trans('main.edit'),
                'printable' => false,
                'exportable' => false,
                'orderable' => false,
                'searchable' => false,
                "className" => 'not--search--col'
            ];
        }

        if(userCan('delete-lesson'))
        {
            $columns [] =  [
                'name' => 'delete',
                'data' => 'delete',
                'title' => trans('main.delete'),
                'printable' => false,
                'exportable' => false,
                'orderable' => false,
                'searchable' => false,
                "className" => 'not--search--col'
            ];
        }

        return $columns;
    }

    protected function filename(): string
    {
        return 'Lessons_' . date('YmdHis');
    }
}