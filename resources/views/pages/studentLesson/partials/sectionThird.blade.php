 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
    <div class="card ">
        <div class="card-header d-flex justify-content-between align-items-center card__header__for_tables_show_teacher">
            <h3 class="text-capitalize text-white">
              تفصيل الدرس
            </h3>
        </div>
        <div class="card-body"  >
            <div class="user-info-list">
                <table class="table">
                    <tbody>
                      <tr>
                        <th scope="row">
                            <h6 class="text-secondary">أنتهيت هذا الدرس</h6>
                        </th>
                        <td class="{{ $studentLesson->finished ? 'text-success' : 'text-danger' }}">
                            {{ $studentLesson->finished ? 'Finished' : 'Not Finished' }}
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">
                            <h6 class="text-secondary">النسبة المؤية</h6>
                        </th>
                        <td>
                            {{ $studentLesson->percentage }}
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">
                            <h6 class="text-secondary">إنتهاء الفصل الاخير</h6>
                        </th>
                        <td> 
                            {{ $studentLesson->last_chapter_finished }}
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">
                            <h6 class="text-secondary">تم الانتهاء من الصفحة الإخيرة</h6>
                        </th>
                        <td> 
                            {{ $studentLesson->last_page_finished }}
                        </td>
                      </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


