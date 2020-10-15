<div id="flash-overlay-modal" style="z-index: 999999;" class="modal fade {{ isset($modalClass) ? $modalClass : '' }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ $title }}</h4>
            </div>

            <div class="modal-body">
                <p>{!! $body !!}</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn_1" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
