@if ($query->paid == 1)
    <td>
        <span class="badge badge-success"> 
            تم الدفع
        </span>
    </td>
@else
    <td>
        <span class="badge badge-danger">
        لم يدفع
        </span>
    </td>
@endif