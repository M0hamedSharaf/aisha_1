<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 my-4">
    <div class="card ">
        <div class="card-header d-flex justify-content-between align-items-center card__header__for_tables_show_teacher">
            <h3 class="text-capitalize text-white">
               {{ trans('payment.total_payments') }}
            </h3>
        </div>
        <div class="card-body"  >
            <div id="paymentsThisMonthContainerGroup"
            data-href="{{ route('admin.group.getPaymentPerMonth', $group->id) }}">

                <div id="paymentsThisMonthChartOnGroupShow" style="position: relative;height: 500px;">
                </div>

            </div>
        </div>
    </div>
</div>

