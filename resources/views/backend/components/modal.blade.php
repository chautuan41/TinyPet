<!-- Modal Structure -->


<!-- Modal Structure -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="inputTitle" class="modal-title"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Input field in the modal -->
        <form id="formModal">
          @csrf
          <!-- Các thẻ input sẽ được chèn vào đây -->
          <div id="dynamicInputs"></div>
          <!-- Add more inputs as needed -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  onclick="onAdd()" aria-label="Close">Đóng</button>
        <button type="button" class="btn btn-primary" id="saveModal" onclick="saveModalEdit()">Lưu</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Structure -->
<div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="inputTitle" class="modal-title"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Input field in the modal -->
        <form id="modalForm">
          @csrf
          <!-- Các thẻ input sẽ được chèn vào đây -->
          <div id="dynamicInputs"></div>
          <!-- Add more inputs as needed -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  onclick="onAdd()" aria-label="Close">Đóng</button>
        <button type="button" class="btn btn-primary" id="saveModal" onclick="saveModalEdit()">Lưu</button>
      </div>
    </div>
  </div>
</div>




