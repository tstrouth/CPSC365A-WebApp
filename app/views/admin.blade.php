@extends('template')

@section("content")
<button class="btn btn-raised btn-secondary adv_cust_mod_btn"
        data-toggle="modal" data-target="#normal">Basic modal
</button>

<div class="modal fade" id="normal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalLabel">Basic Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    This is a modal window. You can do the following things with it:
                </p>
                <ul>
                    <li>
                        <strong>Read:</strong> modal windows will probably tell you something important
                        so don't forget to read what they say.
                    </li>
                    <li>
                        <strong>Look:</strong> a modal window enjoys a certain kind of attention; just
                        look at it and appreciate its presence.
                    </li>
                    <li>
                        <strong>Close:</strong> click on the button below to close the modal.
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button class="btn  btn-secondary" data-dismiss="modal">Close me!</button>
            </div>
        </div>
    </div>
</div>
@endsection
