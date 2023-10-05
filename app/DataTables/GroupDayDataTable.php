<?php

namespace App\DataTables;

use App\Models\GroupDay;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class GroupDayDataTable extends DataTable
{

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('delete', 'pages.groupDays.datatable.delete')
            ->editColumn('from_time', function ($q) {
                return date("h:i a", strtotime($q->from_time)) ?? "";
            })
            ->editColumn('to_time', function ($q) {
                return date("h:i a", strtotime($q->to_time)) ?? "";
            })
            ->editColumn('day', function ($query) {
                return view('pages.groupDays.datatable.day', compact('query'));
            })
            ->rawColumns(['delete', 'day'])
            ->setRowId('id');
    }


    public function query(): QueryBuilder
    {
        return GroupDay::GroupDays()->with([
            'group' => function ($q) {
                return $q->select([
                    'groups.id',
                    'groups.name',
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
                'dom' => 'Blrtip',
                'lengthMenu' => [[10, 25, 50, -1], [10, 25, 50, 'All records']],
                'buttons' => [
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

                }",

            ]);
    }


    protected function getColumns(): array
    {
        $columns = [
            [
                'name' => 'group_days.id',
                'data' => 'id',
                'title' => trans('main.num'),
                "className" => 'search--col exact'
                ],

            [
                'name' => 'group.name',
                'data' => 'group.name',
                'title' => trans('group.group_name'),
                "className" => 'search--col exact'
            ],

            [
                'name' => 'from_time',
                'data' => 'from_time',
                'title' =>trans('main.from'),
                "className" => 'search--col'
            ],

            [
                'name' => 'to_time',
                'data' => 'to_time',
                'title' => trans('main.to'),
                "className" => 'search--col'
            ],

            [
                'name' => 'day',
                'data' => 'day',
                'title' =>trans('main.day'),
                "className" => 'search--col'
            ],
        ];

        if(userCan('delete-groupDay'))
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
        return 'GroupDay_' . date('YmdHis');
    }
}
