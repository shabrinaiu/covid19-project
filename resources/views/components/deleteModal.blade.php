<!-- Modal Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-bold" id="deleteModalLabel">Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-dark">
                Are you sure to delete this {{$name}} ?
            </div>
            <div class="modal-footer">
                <form action="" method="post" class="d-inline" id="delete-form" name="deleteForm">
                    @method('delete')
                    @csrf
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="deletion()" id="delete-button" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
