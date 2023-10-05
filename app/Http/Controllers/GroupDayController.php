<?php

namespace App\Http\Controllers;

use App\DataTables\GroupDayDataTable;
use App\Http\Requests\GroupDay\StoreGroupDayRequest;
use App\Models\Group;
use App\Models\GroupDay;
use App\Services\GroupDay\GroupDayService;
use App\Services\Permission\PermissionService;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class GroupDayController extends Controller
{
    private GroupDayDataTable $groupDayDataTable;
    private GroupDayService $groupDayService;
    private PermissionService $permissionService;

    public function __construct(
        GroupDayDataTable $groupDayDataTable,
        GroupDayService   $groupDayService,
        PermissionService $permissionService
    ) {
        $this->groupDayDataTable = $groupDayDataTable;
        $this->groupDayService = $groupDayService;
        $this->permissionService = $permissionService;


        $this->permissionService->handlePermissions($this, [
            'index' => 'index-groupDay',
            'store' => 'store-groupDay',
            'delete' => 'delete-groupDay',
        ]);
    }

    public function index()
    {
        $groups = Group::groups()
            ->select(['id', 'name', 'group_type_id'])
            ->with([
                'groupType:id,days_num',
                'groupDays:id,group_id'
            ])
            ->get();

        return $this->groupDayDataTable->render('pages.groupDays.index', [
            'groups' => $groups,
        ]);
    }

    public function store(StoreGroupDayRequest $request)
    {
        $this->groupDayService->createGroupDay($request);

        Alert::toast('تمت العملية بنجاح', 'success');
        return redirect()->back();
    }

    public function delete(GroupDay $groupDay)
    {
        $this->groupDayService->deleteGroupDay($groupDay);

        Alert::toast('تمت العملية بنجاح', 'success');
        return redirect()->back();
    }

    public function getGroupDaysOfGroup(Request $request): JsonResponse
    {
        return response()->json([
            'groupDays' => $this->groupDayService->getGroupDaysOfGroup($request->group_id),
        ]);
    }

    public function getGroupDaysForCalendar()
    {
        if (getGuard() == "admin") {
            $groups = Group::with('groupDays')->get();
        } else if (getGuard() == "teacher") {
            $groups = Auth::guard(getGuard())->user()->groups()->with('groupDays')->get();
        } else if (getGuard() == "student") {
            $groups = Auth::guard(getGuard())->user()->groups()->with('groupDays')->get();
        }

        $firstDayOfYear = date('Y-m-d', strtotime('first day of january this year'));
        $lastDayOfYear = date('Y-m-d', strtotime('last day of december this year'));

        $begin  = new DateTime($firstDayOfYear);
        $end    = new DateTime($lastDayOfYear);

        $result = [];

        foreach ($groups as $group) {
            foreach ($group->groupDays as $groupDay) {
                while ($begin <= $end) {
                    if ($begin->format("l") == $groupDay->day) {
                        $fromDateTimeString = $begin->format("Y-m-d") . " " . $groupDay->from_time;
                        $toDateTimeString = $begin->format("Y-m-d") . " " . $groupDay->to_time;
                        $nowDateTimeString = date("Y-m-d H:i:s");

                        $fromDateTime = new DateTime($fromDateTimeString);
                        $toDateTime = new DateTime($toDateTimeString);
                        $nowDateTime = new DateTime($nowDateTimeString);

                        $className = "";

                        if ($nowDateTime < $fromDateTime) {
                            $className = "bg-primary";
                        } else if ($nowDateTime >= $fromDateTime && $nowDateTime <= $toDateTime) {
                            $className = "bg-success";
                        } else {
                            $className = "bg-danger";
                        }

                        $result[] = [
                            "id" => 'group-' . $group->id . "-" . $groupDay->id,
                            "title" => "Class in the group " . $group->name,
                            "start" => $begin->format("Y-m-d") . "T" . $groupDay->from_time,
                            "end" => $begin->format("Y-m-d") . "T" . $groupDay->to_time,
                            "className" => $className,
                            "description" => 'Aenean fermentum quam vel sapien rutrum cursus. Vestibulum imperdiet finibus odio, nec tincidunt felis facilisis eu. '
                        ];
                    }

                    $begin->modify('+1 day');
                }

                $begin  = new DateTime($firstDayOfYear);
                $end    = new DateTime($lastDayOfYear);
            }
        }

        return response()->json([
            'data' => $result
        ]);
    }
}
