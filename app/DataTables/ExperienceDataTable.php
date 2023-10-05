<?php

namespace App\DataTables;

use App\Models\Experience;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ExperienceDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('edit', function ($query) {
                return view('pages.experience.datatable.edit', compact('query'));
            })
            ->addColumn('delete', 'pages.experience.datatable.delete')
            ->editColumn('teacher.name', function ($q) {
                return $q->teacher->name ?? "";
            })
            ->rawColumns(['edit', 'delete', 'name'])
            ->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        return Experience::Experiences()->with([
            'teacher' => function ($q) {
                return $q->select([
                    'teachers.id',
                    'teachers.name'
                ]);
            },
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
                    initEditeExperienceModal()
                }",

            ]);
    }

    protected function getColumns(): array
    {
        $columns =  [
            [
                'name' => 'experiences.id',
                'data' => 'id',
                'title' => trans('main.num'),
                "className" => 'search--col exact'
            ],

            [
                'name' => 'title',
                'data' => 'title',
                'title' => trans('main.experience'),
                "className" => 'search--col'
            ],

            [
                'name' => 'from',
                'data' => 'from',
                'title' => trans('main.from'),
                "className" => 'search--col'
            ],

            [
                'name' => 'to',
                'data' => 'to',
                'title' => trans('main.to'),
                "className" => 'search--col'
                ],

            [
                'name' => 'teacher.name',
                'data' => 'teacher.name',
                'title' => trans('main.teacher'),
                "className" => 'search--col'
            ],
        ];

        if(userCan('update-experience'))
        {
            $columns [] = [
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

        if(userCan('delete-experience'))
        {
            $columns [] = [
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
        return 'Experience_' . date('YmdHis');
    }
}