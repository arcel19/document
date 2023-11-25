


    <!-- partial -->
    <div class="content-wrapper">
        <h3 class="page-heading mb-4">Dashboard</h3>
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 mb-4">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <h4 class="text-danger">
                                    <i class="fa fa-bar-chart-o highlight-icon" aria-hidden="true"></i>
                                </h4>
                            </div>
                            <div class="float-right">
                                <p class="card-text text-dark">Visitors</p>
                                <h4 class="bold-text">{{ App\Models\User::count() }}</h4>
                            </div>
                        </div>
                        <p class="text-muted">
                            <i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i> 65% lower growth
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 mb-4">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <h4 class="text-warning">
                                    <i class="fa fa-folder highlight-icon" aria-hidden="true"></i>
                                </h4>
                            </div>
                            <div class="float-right">
                                <p class="card-text text-dark">Folders</p>
                                <h4 class="bold-text">{{ App\Models\Document::count() }}</h4>
                            </div>
                        </div>
                        <p class="text-muted">
                            <i class="fa fa-bookmark-o mr-1" aria-hidden="true"></i> Product-wise sales
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 mb-4">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <h4 class="text-success">
                                    <i class="fa fa-download highlight-icon" aria-hidden="true"></i>
                                </h4>
                            </div>
                            <div class="float-right">
                                <p class="card-text text-dark">Inbound</p>
                                <h4 class="bold-text">{{ App\Models\Document::where('valid',0)->count() }}</h4>
                            </div>
                        </div>
                        <p class="text-muted">
                            <i class="fa fa-calendar mr-1" aria-hidden="true"></i> Weekly Sales
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 mb-4">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <h4 class="text-primary">
                                    <i class="fa fa-upload highlight-icon" aria-hidden="true"></i>
                                </h4>
                            </div>
                            <div class="float-right">
                                <p class="card-text text-dark">Outbound</p>
                                <h4 class="bold-text">{{ App\Models\Document::where('valid', 1)->count() }}</h4>
                            </div>
                        </div>
                        <p class="text-muted">
                            <i class="fa fa-twitter mr-1" aria-hidden="true"></i> Just Updated
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 mb-4">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <h4 class="text-primary">
                                    <i class="fa fa-file highlight-icon" aria-hidden="true"></i>
                                </h4>
                            </div>
                            <div class="float-right">
                                <p class="card-text text-dark">Total File</p>
                                <h4 class="bold-text">{{ App\Models\File::count() }}</h4>
                            </div>
                        </div>
                        <p class="text-muted">
                            <i class="fa fa-twitter mr-1" aria-hidden="true"></i> Just Updated
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!DOCTYPE html>

     <
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    
    </div>

