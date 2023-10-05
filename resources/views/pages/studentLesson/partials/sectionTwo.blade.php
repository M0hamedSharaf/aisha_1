 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
    <div class="card ">
        <div class="card-header d-flex justify-content-between align-items-center card__header__for_tables_show_teacher">
            <h3 class="text-capitalize text-white">
               معلومات عن الدرس  
            </h3>
        </div>
        <div class="card-body"  >
            <div class="user-info-list">
                <table class="table">
                    <tbody>
                      <tr>
                        <th scope="row">
                            <h6 class="text-secondary">العدد الكلي لدرس</h6>
                        </th>
                        <td>
                            {{ $studentLesson->lesson->chapters_count ?? '' }}
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">
                            <h6 class="text-secondary">يبدأ الدرس من</h6>
                        </th>
                        <td> 
                            {{ $studentLesson->lesson->from_page ?? '' }}
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">
                            <h6 class="text-secondary">ينتهى الدرس  إلى</h6>
                        </th>
                        <td> 
                            {{ $studentLesson->lesson->to_page ?? '' }}
                        </td>
                      </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
