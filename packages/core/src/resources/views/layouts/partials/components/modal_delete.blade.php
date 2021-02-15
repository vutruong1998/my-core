<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" style="display: none;">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form method="post" action="#">
                @csrf
                <input type="hidden" name="_method" value="delete" />
                <div class="modal-header">
                    <h5 class="modal-title" id="staticModalLabel">Xác nhận xoá bản ghi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                    Bạn có chắc chắn muốn xoá ?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
                    <button type="submit" class="btn btn-primary">Xác nhận</button>
                </div>
            </form>
        </div>
    </div>
</div>