<?php

namespace App\DataTables;

use App\Models\Exam;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ExamDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('edit', 'pages.exam.datatable.edit')
            ->addColumn('delete', 'pages.exam.datatable.delete')
            ->rawColumns(['edit', 'delete'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Exam $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Exam $model): QueryBuilder
    {
        
        return $model->select([
            'exams.id',
            'student_id',
            'group_id',
            'lesson_from',
            'lesson_to',
        ])->with([
            'student:id,name',
            'group:id,from,to',
            'lesson_from:id,title',
            'lesson_to:id,title',
        ]);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
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
                ['extend' => 'print', 'className' => 'btn btn-primary mr-5px', 'text' => 'Print'],
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

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            [
                'name' => 'id',
                'data' => 'id',
                'title' => '#',
                "className" => 'search--col exact'
            ],

            [
                'name' => 'student.name',
                'data' => 'student.name',
                'title' => 'student',
                "className" => 'search--col'
            ],

            [
                'name' => 'group.from',
                'data' => 'group.from',
                'title' => 'group',
                "className" => 'search--col'
            ],

            [
                'name' => 'lesson_from.title',
                'data' => 'lesson_from.title',
                'title' => 'Lesson From',
                "className" => 'search--col'
            ],

            [
                'name' => 'lesson_to.title',
                'data' => 'lesson_to.title',
                'title' => 'Lesson To',
                "className" => 'search--col'
            ],


            [
                'name' => 'edit',
                'data' => 'edit',
                'title' => 'Edit',
                'printable' => false,
                'exportable' => false,
                'orderable' => false,
                'searchable' => false,
                "className" => 'not--search--col'
            ],
            
            [
                'name' => 'delete',
                'data' => 'delete',
                'title' => 'Delete',
                'printable' => false,
                'exportable' => false,
                'orderable' => false,
                'searchable' => false,
                "className" => 'not--search--col'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Exam_' . date('YmdHis');
    }
}
