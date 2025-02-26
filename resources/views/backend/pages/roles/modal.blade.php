
<!-- Modal Structure -->
<div class="modal fade" id="editRoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Chỉnh sửa phân quyền</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      <div class="modal-body">
        <!-- Input field in the modal -->
        <form id="modalForm">
            @csrf
            <input type="hidden" name="_token" id='_token' value="{{ csrf_token() }}">
          <div class="form-group">
            <label for="userInput">Tên phân quyền</label>
            <input type="text" class="form-control" id="userInputModal" placeholder="Enter your name" value="">
          </div>
          <div class="form-group">
            <label for="userInput">Trạng thái</label>
            <select id="searchSelectModal" name="searchSelect" class="form-control form-control-sm form-select select2" data-placeholder="Điều kiện tìm kiếm">
                <option value="1">Hoạt động</option>
                <option value="2">Ngưng hoạt động</option>
            </select>
          </div>

          <!-- Add more inputs as needed -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Đóng</button>
        <button type="button" class="btn btn-primary" id="saveButton">Lưu</button>
      </div>
    </div>
  </div>
</div>



