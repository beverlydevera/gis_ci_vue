<h6>COMPETITIONS JOINED
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addNewCompetition" style="float:right;">Add New Competition</button>
</h6>
<br>
<div class="row">
    <div class="col-md-3">
        <div class="input-group mb-3">
        <div class="input-group-prepend smallerinput">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
        </div>
        <input type="text" class="form-control smallerinput" placeholder="Search">
        </div>
    </div>
</div>

<table class="table table-bordered table-responsive-sm table-sm">
    <thead>
        <tr>
            <th width="3%">#</th>
            <th>Competition Title</th>
            <th>Competion Type</th>
            <th>Awards Received</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Title 1</td>
            <td>Type 1</td>
            <td>Awards 1</td>
            <td>
                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i></button>
            </td>
        </tr>
    </tbody>
</table>

<div class="modal fade" id="addNewCompetition">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Competition Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                    <table class="table table-bordered table-responsive-sm table-sm billing-table">
                        <tr>
                            <th width="30%">Competition Title:</th>
                            <th><input type="text" class="form-control smallerinput" required></th>
                        </tr>
                        <tr>
                            <th width="30%">Competition Type:</th>
                            <th><input type="text" class="form-control smallerinput" required></th>
                        </tr>
                        <tr>
                            <th width="30%">Awards Received:</th>
                            <th><input type="text" class="form-control smallerinput"></th>
                        </tr>
                        <tr>
                            <th width="30%">Remarks:</th>
                            <th><input type="text" class="form-control smallerinput"></th>
                        </tr>
                        <tr>
                            <th width="30%">Upload Photos:</th>
                            <th><input type="file" multiple accept=".jpeg,.jpg,.png"></th>
                        </tr>
                    </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save event</button>
            </div>
        </div>
    </div>
</div>