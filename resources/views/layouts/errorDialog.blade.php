<div class="modal fade" id="modalError" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-col-red">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Peringatan !</h4>
            </div>
            <div class="modal-body">
                @if (!empty($errors->all()))
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                   @endforeach
               @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect btn-close" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
@if (count($errors) > 0)
    @if(!empty($errors->all()))
    <script>
    $(document).ready(function(){
        $('#modalError').modal('show');
    });
    </script>
    @endif
@endif
