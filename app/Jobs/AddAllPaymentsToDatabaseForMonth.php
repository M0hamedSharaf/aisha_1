<?php

namespace App\Jobs;

use App\Models\Payment;
use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddAllPaymentsToDatabaseForMonth implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $month;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $month)
    {
        $this->month = $month;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $students = Student::select([
            'students.id'
        ])->with([
            'groups' => function($q){
                return $q->select([
                    'groups.id','groups.group_type_id'
                ])
                ->with('groupType:id,price');
            },
            'payments' => function($q){
                return $q->select([
                    'payments.id','payments.group_id','payments.student_id','paid'
                ])
                ->where('month',getCurrectMonthName());
            }
        ])->get();

        $data = [];
        foreach($students as $student)
        {
            foreach($student->groups as $group)
            {
                if($student->payments->where('group_id',$group->id)->contains('paid',true) == false)
                {
                    $data []= [
                        'student_id' => $student->id,
                        'group_id' => $group->id,
                        'amount' => $group->groupType->price,
                        'month' => $this->month,
                        'paid' => false
                    ];
                }
            }
        }

        Payment::insert($data);
    }
}
