@extends('backend.layouts.app')

@section('content')
@include('backend.components.modal')
<div class="container-fluid">
    <!--  Row 1 -->
    <div class="row">
        <div class="col-12">
            <div class="card w-100">
                <div class="card-body p-4">
                    <a  href="{{route('admin.role')}}"><h5 class="card-title fw-semibold mb-4">Bảng vai trò</h5></a> 
                    <div class="form-group">
                        <form id="searchForm">
                            <div class="row justify-content-end">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <select id="searchSelect" name="searchSelect" class="form-control form-control-sm form-select select2" data-placeholder="Điều kiện tìm kiếm">
                                            <option disabled selected>Lựa chọn tìm kiếm</option>
                                            <option value="role_id">Vai trò</option>
                                            <option value="status">Trạng thái</option>
                                        </select>
                                        <div id="contentSearch" class="form-control">
                                            <input type="hidden" name="searchInput" class="form-control form-control-sm" id="searchInput">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary light"
                                        title="Nhấn để tìm kiếm" type="button" onclick="btnSearch()" id="searchBtn">Tìm kiếm
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <button class="btn btn-secondary light "
                        title="Nhấn để tìm kiếm" type="button" onclick="onAdd()" id="saveEdit">Thêm vai trò</button>
                        
                    <hr>
                    
                    <div class="table">
                        <table class="table text-nowrap mb-0 align-middle" id="role">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">ID</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Tên vai trò</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Trạng thái</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Ngày tạo</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Ngày cập nhật</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Chức năng</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="py-6 px-6 text-center">
                        <p class="mb-0 fs-4">Design and Developed by <a href="#" target="_blank" class="pe-1 text-primary text-decoration">CT</a> Since 2025</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        //Load url
        urlLoad();        
    });
    //Load data
    render();
    function render(data = '') {
        arrID = [];

        let datatable = $('#role').DataTable({
            processing: true,
            serverSide: true,
            language: {
                processing: 'Tải dữ liệu',
            },
            aLengthMenu: [20, 40, 80, 120, 160],
            searching: false,
            bStateSave: true,
            ordering: false,
            autoWidth: false,
            ajax: {
                "url": `{{route('admin.role.data')}}`,
                "dataType": "json",
                "type": "GET",
                "data": data,
                beforeSend: function() {},
                complete: function() {},
            },
            oLanguage: {
                sLengthMenu: `Hiển thị _MENU_ <span class="tutorial" id="I-NDH-016"></span>`,
                sInfo: `Hiển thị _END_ dòng <span class="tutorial" id="I-NDH-017"></span>`,
            },
            drawCallback: function() {
                // idArray = ["I-NDH-016", "I-NDH-017"]
                // hideShowTutorialItemProcess(idArray);
            },
            columnDefs: [{
                    class: 'center',
                    render: function(col, type, row, index) {
                        // let stt = row.row_number;
                        // return `<div class="colorHeader">${stt}</div>`;
                        return `<td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">${row.id}</h6>
                                        </td>`;
                        // return `<div class="colorHeader">1</div>`;
                    },
                    targets: 0
                },
                {
                    class: 'center',
                    render: function(col, type, row) {
                        return (`
                                    <div class="fw-semibold mb-0">${row.role_name}</div>
                                `);
                    },
                    targets: 1
                },
                {
                    class: 'center',
                    render: function(col, type, row) {
                        return (`
                            <div class="fw-semibold mb-0">${row.statusCustom}</div>
                        `);
                    },
                    targets: 2
                },
                {
                    class: 'center',
                    render: function(col, type, row) {
                        return (`
                            <div class="fw-semibold mb-0">${row.created_at ? moment(row.created_at).format('DD/MM/YYYY H:mm') : '-'}</div>
                    `);
                    },
                    targets: 3
                },
                {
                    class: 'center',
                    render: function(col, type, row) {
                        return (`
                            <div class="fw-semibold mb-0">${row.updated_at ? moment(row.updated_at).format('DD/MM/YYYY H:mm') : '-'}</div>
                    `);
                    },
                    targets: 4
                },
                {
                    class: 'center',
                    render: function(col, type, row) {
                        // let url = window.location.href;
                        // let param = new URL(url).search;
                        iconDelete = `<a title="Xóa" class="ms-2" onClick="onDelete('${row.id}')" style="cursor: pointer;"><i class="fa-solid fa-trash-can"></i></a>`;
                        // if(user_type_number == 1 || personnel_auth == 1 || currentUserId == row.user_id){
                        // ${row.isEdit ? 'href="/curator/edit/'+row.user_id+param+'"' : 'class="disabledIcon"'}

                        
                        isEdit = `<a title="Sửa" class="" style="cursor: pointer;" onClick="onEdit(${row.id})"><i class="fa-solid fa-pen-to-square"></i></a>`;

                        // }

                        return (`
                        <div>
                            ${isEdit}
                            ${iconDelete}
                        </div>
                    `);
                    },
                    targets: 5
                },
            ],
            footerCallback: async function(tfoot, data, start, end, display) {
                // $("#curator").removeClass('dataTable');
                // return (`

                //         `);
            },
            createdRow: function(row, data, index) {

            }
        });
    };
    //Link 
</script>

<!-- SEARCH-->
<script>
    //Lựa chọn tìm kiếm
    $('#searchSelect').on('change', function() {
        let searchSelect = $(this).val();
        $(this).parent().find('#contentSearch').html(`
        <input type="text" name="searchInput" class="form-control form-control-sm" id="searchInput">`);
        if (searchSelect == 'status') {
            $(this).parent().find('#contentSearch').html(`
                <select id="searchInput" name="searchInput" class="form-control form-control-sm form-select" data-placeholder="Điều kiện tìm kiếm">
                    <option value="1">Hoạt động</option>
                    <option value="2">Ngưng hoạt động</option>
                </select>
            `);
        };  
        if (searchSelect == 'role_id') {
        roles = @json($dataSelect);
        let options = roles.map(role => {
            return `<option value="${role.id}">${role.role_name}</option>`;
        }).join('');

        $(this).parent().find('#contentSearch').html(`
            <select id="searchInput" name="searchInput" class="form-control form-control-sm form-select" data-placeholder="Chọn vai trò">
                ${options}
            </select>
        `);
    }
    });

    // Button search
    function btnSearch() {
        let formData = new FormData($('#searchForm')[0]);
        var object = {};
        formData.forEach(function(value, key) {
            object[key] = value;
            // let text = $(`#${key} option:selected`).text();
            // if (text) {
            //     object[`text_${key}`] = text;
            // }
        });
        history.pushState({}, null, "/admin/role?search=" + btoa(encodeURIComponent(JSON.stringify(object))));
        $('#role').DataTable().destroy();
        render(object);
    };

    //Search url 
    function urlLoad() {
        let url = window.location.href;
        let param = new URL(url).searchParams.get("search");
        if (param) {
            data = JSON.parse(decodeURIComponent(atob(param)));
            $('#searchSelect').val(data.searchSelect).trigger('change');
            $('#searchInput').val(data.searchInput).trigger('change');
            btnSearch();
        }
    }
</script>



<!-- MODAL EDIT-->
<script>
    const editGetBaseUrl = @json(route('admin.role.editGet', ['id' => 'ID_PLACEHOLDER']));
    const editPostBaseUrl = @json(route('admin.role.editPost', ['id' => 'ID_PLACEHOLDER']));
    function createDynamicInputs(data) {
        // Clear previous inputs if any
        $('#dynamicInputs').empty();
        // Duyệt qua mảng dữ liệu và tạo các input tương ứng
        data.forEach(function(item, index) {
            // Tạo các input động cho mỗi phần tử trong data
            if (item.name == "status") {
                var selected1 = item.value == 1 ? "selected" : "";
                var selected2 = item.value == 2 ? "selected" : "";
                var inputHTML = `
                    <div class="form-group mb-2">
                        <label for="input_${index}">${item.label}</label>
                        <select id="SelectModal" name="${item.name}" class="form-control form-control-sm form-select select2" data-placeholder="Điều kiện tìm kiếm">
                            <option value="1" ${selected1}>Hoạt động</option>
                            <option value="2" ${selected2}>Ngưng hoạt động</option>
                        </select>
                    </div>
                `;
            } else {
                var inputHTML = `
                    <div class="form-group mb-2">
                        <label for="input_${index}">${item.label}</label>
                        <input type="${item.type}" class="form-control" id="input_${index}" name="${item.name}" value="${item.value}" placeholder="${item.placeholder}" ${item.setting}>
                    </div>
                `;
            }
            // Append input vào form
            $('#dynamicInputs').append(inputHTML);
        });
    }

    let currentEditId = null;
    function onEdit(id) {
        currentEditId = id;
        let editUrl = editGetBaseUrl.replace('ID_PLACEHOLDER', currentEditId);
        $('#formModal')[0].reset();
    $('#modalForm').modal('show');
    $('#saveModal').attr('onclick', 'saveModalEdit()');
        
        $.ajax({
            url: editUrl,
            type: 'GET',
            processData: false,
            contentType: false,
            success: function(result) {

                if (result.success) {
                    $('#inputTitle').text("Chỉnh sửa " + result.title);
                    // Giả sử `result.data` chứa thông tin cấu trúc cho các input động
                    var dynamicData = result.data; // Dữ liệu có thể là mảng các đối tượng, ví dụ [{label: 'Tên', name: 'name', type: 'text', value: '', placeholder: 'Nhập tên'}]
                    createDynamicInputs(dynamicData);
                }
            }
        });
    }

    function saveModalEdit(){
        let formData = $('#formModal').serialize();
        let editUrl = editPostBaseUrl.replace('ID_PLACEHOLDER', currentEditId);
        
        $.ajax({
            url: editUrl,
            type: 'POST',
            data: formData,
            success: function(result) {
            if(result.success){
                window.location.replace(result.url);
            }
            else{
                Swal.fire({
                title: result.mess,
                icon: "warning"
                });
            }
            },
        })
    }
</script>

<!-- MODAL ADD-->
<script>
    
    function onAdd() {
        currentEditId = null;
    $('#inputTitle').text('Thêm mới vai trò');
    $('#formModal')[0].reset();
    $('#dynamicInputs').empty();

    const data = [
        { label: 'Tên vai trò', name: 'role_name', type: 'text', value: '', placeholder: 'Nhập tên', setting: '' },
        { label: 'Trạng thái', name: 'status', type: 'select', value: 1, placeholder: '', setting: '' }
    ];

    createDynamicInputs(data);
    // Đổi nút lưu để gọi đúng hàm
    $('#saveModal').attr('onclick', 'saveModalAdd()');
    $('#modalForm').modal('show');
    }

    function saveModalAdd() {
        let formData = $('#formModal').serialize();
        $.ajax({
            url: `{{route('admin.role.add')}}`,
            type: 'POST',
            data: formData,
            success: function(result) {
            if(result.success){
                window.location.replace(result.url);
            }
            else{
                Swal.fire({
                title: result.mess,
                icon: "warning"
                });
            }
            },
        })
    }
</script>

<!-- Delete -->
<script>
    const deleteBaseUrl = @json(route('admin.role.delete', ['id' => 'ID_PLACEHOLDER']));

    function onDelete(id) {
        Swal.fire({
            title: 'Bạn có chắc chắn muốn xoá?',
            text: "Hành động này không thể hoàn tác!",
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Xoá',
            cancelButtonText: 'Huỷ'
        }).then((result) => {
                if (result.value) { 
                    currentEditId = id;
                    deleteUrl = deleteBaseUrl.replace('ID_PLACEHOLDER', currentEditId);
                    $.ajax({
                        url: deleteUrl,
                        type: 'GET',
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                title: 'Đã xoá!',
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                                }).then(() => {
                                        location.reload();
                                    });
                            } else {
                                Swal.fire({
                                    title: 'Xoá thất bại!',
                                    icon: "error"
                                });
                            }
                        }
                    });
                }
            });
    }
</script>
@endsection