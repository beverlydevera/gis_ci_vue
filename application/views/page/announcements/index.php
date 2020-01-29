<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Announcements</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group mb-3">
                                <div class="input-group-prepend smallerinput">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input type="text" class="form-control smallerinput" placeholder="Search Announcement">
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-3">
                                <a style="float:right;" data-target="#addNewAnnouncementModal" data-toggle="modal" class="btn bg-gradient-primary btn-xs">Add New Announcement</a>
                            </div>
                        </div>
                        <table class="table table-bordered table-responsive-sm table-sm">
                            <thead>                  
                                <tr>
                                    <th>#</th>
                                    <th>Announcement Title</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Sample Announcement 1</td>
                                    <td>January 20, 2020</td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-xs"><i class="fas fa-edit"></i></button>
                                        <button type="button" class="btn btn-success btn-xs"><i class="fas fa-share-square"></i></button>
                                        <!-- <span class="badge badge-success">POSTED</span> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="addNewAnnouncementModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Announcement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                    <table class="table table-bordered table-responsive-sm table-sm billing-table">
                        <tr>
                            <th width="10%">Date:</th>
                            <th>January 30, 2020</th>
                        </tr>
                        <tr>
                            <th width="10%">Title:</th>
                            <th><input type="text" class="form-control smallerinput" required></th>
                        </tr>
                        <tr>
                            <th width="10%">Text:</th>
                            <th>
                                <textarea class="form-control" rows=2></textarea>
                            </th>
                        </tr>
                        <tr>
                            <th width="10%">Photos:</th>
                            <th><input type="file" multiple></th>
                        </tr>
                    </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Announcement</button>
            </div>
        </div>
    </div>
</div>