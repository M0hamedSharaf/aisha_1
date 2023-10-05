<?php

namespace App\DataTables;

use App\Models\GroupType;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class GroupTypeDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            // ->addColumn('edit', 'pages.student.datatable.edit')
            ->addColumn('edit', function ($query) {
                return view('pages.groupType.datatable.edit', compact('query'));
            })
            ->addColumn('delete', 'pages.groupType.datatable.delete')
            ->editColumn('name', function ($q) {

                return "<a class='text-primary' href=" . route('admin.group_types.show', $q->id) . " title='Enter Page show Group Type' >" . $q->name . "</a>";
            })
            ->rawColumns(['edit', 'delete', 'name'])
            ->setRowId('id');
    }

    public function query(GroupType $model): QueryBuilder
    {
        return $model->newQuery();
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
                initEditeGroupTypeModal()
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
                'name' => 'name',
                'data' => 'name',
                'title' =>  trans('group.group_name'),
                "className" => 'search--col'
            ],

            [
                'name' => 'price',
                'data' => 'price',
                'title' => trans('main.price'),
                "className" => 'search--col'
            ],

            [
                'name' => 'days_num',
                'data' => 'days_num',
                'title' =>  trans('group.days_num'),
                "className" => 'search--col'
            ],
        ];

        if(userCan('update-groupStudent'))
        {
            $columns [] = [
                'name' => 'edit',
                'data' => 'edit',
                'title' =>  trans('main.edit'),
                'printable' => false,
                'exportable' => false,
                'orderable' => false,
                'searchable' => false,
                "className" => 'not--search--col'
            ];
        }

        if(userCan('delete-groupStudent'))
        {
            $columns [] = [
                'name' => 'delete',
                'data' => 'delete',
                'title' =>  trans('main.delete'),
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
        return 'GroupType_' . date('YmdHis');
    }
}