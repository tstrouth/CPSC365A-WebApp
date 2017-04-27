@extends('template')

@section("header_styles")

@endsection

@section("footer_scripts")

@endsection

@section("content")
<div class="outer">
  <div class="inner bg-container">
    <div class="row">
      <div class="col-12 col-xl-12">
        <div class="card">
          <div class="card-block">
            <div class="row" style="margin-bottom:0">
              <div class="col-lg-12">
                <button class="btn btn-raised btn-primary"
                        data-toggle="modal" data-target="#normal">New Admin
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="outer">
  <div class="inner bg-container">
    <div class="row">
      <div class="col-12  col-xl-12">
        <div class="card">
          <div class="card-header bg-white">
              Users
          </div>
          <div class="card-block">
            <div class="table-responsive m-t-35">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>User Type</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="normal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalLabel">New Admin</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
              <form action="{{URL::to('new_admin')}}" method="post">
                <div class="row">
                  <div class="col-lg-12 input_field_sections">
                    <h5>Username</h5>
                    <input type="text" class="form-control" name="username"
                           value=""/>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12 input_field_sections">
                    <h5>Password</h5>
                    <input type="password" name="password" class="form-control form-control-warning"
                           id="password">
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12 input_field_sections">
                    <h5>User Type</h5>
                    <select id="user-type" name="user-type" class="form-control chzn-select" >
                      <option value=2>Teacher</option>
                      <option value=3>Admin</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12 input_field_sections">
                    <button type="submit" class="btn btn-raised btn-secondary" >Save</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
                <button class="btn  btn-secondary" data-dismiss="modal">Close me!</button>
            </div>
        </div>
    </div>
</div>
@endsection
