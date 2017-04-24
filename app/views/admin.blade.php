@extends('template')

@section("content")
<button class="btn btn-raised btn-secondary adv_cust_mod_btn"
        data-toggle="modal" data-target="#normal">New Admin
</button>

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
                  <div class="col-lg-12 input_field_sections">
                    <h5>Username</h5>
                    <input type="text" class="form-control" name="username"
                           value=""/>
                  </div>
                  <div class="col-lg-12 input_field_sections">
                    <h5>Password</h5>
                    <input type="password" name="password" class="form-control form-control-warning"
                           id="password">
                  </div>
                  <div class="col-lg-12 input_field_sections">
                    <button class="btn btn-raised btn-secondary" >Save
                    </button>
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
