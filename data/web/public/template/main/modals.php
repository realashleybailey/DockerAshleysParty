<div class="modal fade" id="errorBox" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white d-flex justify-content-center">
                <h5 class="modal-title" style="font-family: 'Roboto',sans-serif;">There was an error!</h5>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row text-center">
                        <i class="fa fa-times fa-3x text-danger"></i>
                    </div>
                    <div class="row bodytext text-center d-flex justify-content-center">
                        Undefined
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger ripple-surface" data-mdb-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="simpleBox" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container h-100 d-flex justify-content-center align-items-center">
                    <div class="row bodytext text-center d-flex justify-content-center">
                        Undefined
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark ripple-surface" data-mdb-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="loadingBox" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
        <div class="modal-content" style="background-color: rgba(255,255,255,0.8);">
            <div class="modal-body">
                <div class="container h-100 d-flex flex-row justify-content-center align-items-center">
                    <div class="row bodytext text-center">
                        <div class="container">
                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-center align-items-center mt-2">
                                Please Wait...
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>