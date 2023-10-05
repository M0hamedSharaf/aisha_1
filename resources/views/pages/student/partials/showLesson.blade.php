<div class="modal fade" id="showBookModal" tabindex="-1" role="dialog" aria-labelledby="showBookModal"
     aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showBookModalTitle">
                    {{trans('main.book')}} 
                </h5>
            </div>
            <div class="modal-body">


                
                <canvas id="book-canvas" width="600px" height="800px"></canvas>


                @if (LaravelLocalization::getCurrentLocale() == 'ar')
                    <button class="btn btn-info" id="next">
                        <i class="fa-solid fa-right-long"></i>
                    </button>

                    <span class="mx-3 badge bg-secondary" id="currentPage">0</span>

                    <button class="btn btn-info" id="prev">
                        <i class="fa-solid fa-left-long"></i>
                    </button>
                @else
                    <button class="btn btn-info" id="prev">
                        <i class="fa-solid fa-left-long"></i>
                    </button>

                    <span class="mx-3 badge bg-secondary" id="currentPage">0</span>

                    <button class="btn btn-info" id="next">
                        <i class="fa-solid fa-right-long"></i>
                    </button>
                @endif


            </div>
        </div>
    </div>
</div>


