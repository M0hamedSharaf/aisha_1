<?php

namespace App\DataTables;

use App\Models\Teacher;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class TeacherDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        // dd($words);
        return (new EloquentDataTable($query))
            ->editColumn('groups.count', function ($query) {
                return $query->groups_count ?? '';
            })
            ->editColumn('groupStudents.count', function ($query) {
                return $query->group_students_count ?? '';
            })
            ->editColumn('role.name', function ($query) {
                return $query->role->name ?? '';
            })
            ->addColumn('edit', function ($query) {
                return view('pages.teacher.datatable.edit', compact('query'));
            })
            ->addColumn('delete', 'pages.teacher.datatable.delete')
            ->editColumn('name', function ($q) {
                return "<a class='text-primary' href=" . route('admin.teacher.show', $q->id) . " title='Enter Page show Teacher' >" . $q->name . "</a>";
            })
            ->editColumn('show', function ($q) {
                return "<a class='text-info' href=" . route('admin.teacher.show', $q->id) . " title='Enter Page show Teacher' ><i class='fa-solid fa-eye'></i></a>";
            })
            ->rawColumns(['edit', 'delete', 'name', 'show'])
            ->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        return Teacher::Teachers()->with('role:id,name')->withCount(['groups', 'groupStudents']);
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
                    initEditeTeacherModal()
                }",

            ]);
    }


    protected function getColumns(): array
    {
        $columns = [
            [
                'name' => 'teachers.id',
                'data' => 'id',
                'title' => trans('main.num'),
                "className" => 'search--col exact'
            ],

            [
                'name' => 'name',
                'data' => 'name',
                'title' => trans('main.name'),
                "className" => 'search--col'
            ],
            
            [
                'name' => 'email',
                'data' => 'email',
                'title' => trans('main.email'),
                "className" => 'search--col'
            ],

            [
                'name' => 'role.name',
                'data' => 'role.name',
                'title' => trans('main.role'),
                "className" => 'search--col'
            ],


            [
                'name' => 'birthday',
                'data' => 'birthday',
                'title' => trans('main.birthday'),
                "className" => 'search--col'
            ],

            [
                'name' => 'phone',
                'data' => 'phone',
                'title' => trans('main.phone'),
                "className" => 'search--col'
            ],

            [
                'name' => 'groups.count',
                'data' => 'groups.count',
                'title' => trans('group.groups_count'),
                'orderable' => false,
                'searchable' => false,
                "className" => 'not--search--col'
            ],

            [
                'name' => 'groupStudents.count',
                'data' => 'groupStudents.count',
                'title' => trans('group.groups_students'),
                'orderable' => false,
                'searchable' => false,
                "className" => 'not--search--col'
            ],
        ];

        if(userCan('show-teacher'))
        {
            $columns [] = [
                'name' => 'show',
                'data' => 'show',
                'title' => trans('main.show'),
                'printable' => false,
                'exportable' => false,
                'orderable' => false,
                'searchable' => false,
                "className" => 'not--search--col'
            ];
        }

        if(userCan('update-teacher'))
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

        if(userCan('delete-teacher'))
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
        return 'Teacher_' . date('YmdHis');
    }
}
