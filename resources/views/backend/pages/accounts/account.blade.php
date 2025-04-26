@extends('backend.layouts.app')

@section('content')
@include('backend.components.modal')
<div class="container-fluid">
    <!--  Row 1 -->
    <div class="row ">
        <div class="col-12 ">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Bảng tài khoản</h5>
                    <div class="form-group">
                        <form id="searchForm">
                            <div class="row justify-content-end">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <select id="searchSelect" name="searchSelect" class="form-control form-control-sm form-select select2" data-placeholder="Điều kiện tìm kiếm">
                                            <option disabled selected>Lựa chọn tìm kiếm</option>
                                            <option value="email">Email</option>
                                            <option value="role_id">Vai trò</option>
                                            <option value="status">Trạng thái</option>
                                        </select>
                                        <div id="contentSearch" class="form-control">
                                            <input type="text" name="searchInput" class="form-control form-control-sm" id="searchInput">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary light"
                                        title="Nhấn để tìm kiếm" type="button" onclick="btnSearch()" id="searchBtn">Tìm kiếm</button>
                                </div>
                            </div>
                        </form>
                       
                    <hr>
                    </div>
                    <div class="table">
                        <table class="table text-nowrap mb-0 align-middle" id="account">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">ID</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Email</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Vai trò</h6>
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
    <div class="py-6 px-6 text-center">
        <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank" class="pe-1 text-primary text-decoration-underline">AdminMart.com</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a></p>
    </div>
</div>

<script>
    
    $(document).ready(function() {    
       
        urlLoad();
    });
    render();
    function render(data = '') {
        arrID = [];
        let datatable = $('#account').DataTable({
            processing: true,
            serverSide: true,
            language: {
                'processing': 'tải dữ liệu',
            },
            aLengthMenu: [20, 40, 80, 120, 160],
            searching: false,
            bStateSave: true,
            ordering: false,
            autoWidth: false,
            ajax: {
                "url": `{{route('admin.account.data')}}`,
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
                                            <h6 class="fw-semibold mb-0">${row.idA}</h6>
                                        </td>`;
                        // return `<div class="colorHeader">1</div>`;
                    },
                    targets: 0
                },
                {
                    class: 'center',
                    render: function(col, type, row) {
                        return (`
                                <td class="border-bottom-0">
                                    <h5 class="fw-semibold mb-0">${row.email}</h5>
                                    <h6 class="mb-0">${row.name}</h6>
                                </td>
                    `);
                    },
                    targets: 1
                },
                {
                    class: 'center',
                    render: function(col, type, row) {
                        return (`
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">${row.role_name}</h6>
                                </td>
                    `);
                    },
                    targets: 2
                },
                {
                    class: 'center',
                    render: function(col, type, row) {
                        return (`
                            <div class="fw-semibold mb-0">${row.statusCustom}</div>
                        `);
                    },
                    targets: 3
                },
                {
                    class: 'center',
                    render: function(col, type, row) {
                        return (`
                            <div class="fw-semibold mb-0">${row.created_at ? moment(row.created_at).format('DD/MM/YYYY H:mm') : '-'}</div>
                    `);
                    },
                    targets: 4
                },
                {
                    class: 'center',
                    render: function(col, type, row) {
                        return (`
                            <div class="fw-semibold mb-0">${row.updated_at ? moment(row.updated_at).format('DD/MM/YYYY H:mm') : '-'}</div>
                    `);
                    },
                    targets: 5
                },
                {
                    class: 'center',
                    render: function(col, type, row) {
                        // let url = window.location.href;
                        // let param = new URL(url).search;
                        iconDelete = `<a title="Xóa" class="ms-2" onClick="onDelete('${row.idA}')" style="cursor: pointer;"><i class="fa-regular fa-circle-xmark"></i></a>`;
                        // if(user_type_number == 1 || personnel_auth == 1 || currentUserId == row.user_id){
                        // ${row.isEdit ? 'href="/curator/edit/'+row.user_id+param+'"' : 'class="disabledIcon"'}
                        isEdit = `<a title="Sửa" class="ms-2" style="cursor: pointer;" onClick="onEdit('${row.idA}')"><i class="fa-solid fa-pen-to-square"></i></a>`;
                        isView = `<a title="Xem" class=""  style="cursor: pointer;" onClick="onView('${row.idA}')"><i class="fa-solid fa-eye"></i></a>`;
                        // }

                        return (`
                        <div>
                            ${isView}
                            ${isEdit}
                            ${iconDelete}
                        </div>
                    `);
                    },
                    targets: 6
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
</script>

<!-- SEARCH-->
<script>
    //Lựa chọn tìm kiếm
    $('#searchSelect').on('change', function() {
        let searchSelect = $(this).val();
        $(this).parent().find('#contentSearch').html(`
        <input type="text" name="searchInput" class="form-control form-control-sm" id="searchInput">`);
        $('#searchInput').focus();
        if (searchSelect == 'status') {
            const currentUser = {
                role_id: @json(Auth::user()->role_id)
            };
            if(currentUser.role_id == 1){
                $(this).parent().find('#contentSearch').html(`
                    <select id="searchInput" name="searchInput" class="form-control form-control-sm form-select" data-placeholder="Điều kiện tìm kiếm">
                        <option value="1">Hoạt động</option>
                        <option value="2">Ngưng hoạt động</option>
                        <option value="3">Đã bị khóa</option>
                    </select>
               `);
            }else {
                $(this).parent().find('#contentSearch').html(`
                    <select id="searchInput" name="searchInput" class="form-control form-control-sm form-select" data-placeholder="Điều kiện tìm kiếm">
                        <option value="1">Hoạt động</option>
                        <option value="2">Ngưng hoạt động</option>
                    </select>
                `);
            };
            
        };  
        if (searchSelect == 'role_id') {
            roles = @json($dataRoles);
            let options = roles.filter(role => role.id != 1).map(role => {
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
        history.pushState({}, null, "/admin/account?search=" + btoa(encodeURIComponent(JSON.stringify(object))));
        $('#account').DataTable().destroy();
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


<script>
    // <!-- MODAL EDIT-->
    const editGetBaseUrl = @json(route('admin.account.editGet', ['id' => 'ID_PLACEHOLDER']));
    const editPostBaseUrl = @json(route('admin.account.editPost', ['id' => 'ID_PLACEHOLDER']));
    function createDynamicInputs(data, method) {
        
        // Clear previous inputs if any
        $('#dynamicInputs').empty();
        // Duyệt qua mảng dữ liệu và tạo các input tương ứng
        data.forEach(function(item, index) {
            // Tạo các input động cho mỗi phần tử trong data
            if(item.select == "select"){
                if (item.name == "status") {
                    var selected1 = item.value == 1 ? "selected" : "";
                    var selected2 = item.value == 2 ? "selected" : "";
                    var selected3 = item.value == 3 ? "selected" : "";
                    var inputHTML = `
                        <div class="form-group mb-2">
                            <label for="input_${index}">${item.label}</label>
                            <select id="SelectModal" name="${item.name}" class="form-control form-control-sm form-select select2" data-placeholder="Điều kiện tìm kiếm" ${item.disabled}>
                                <option value="1" ${selected1}>Hoạt động</option>
                                <option value="2" ${selected2}>Ngưng hoạt động</option>
                                <option value="3" ${selected3}>Đã bị khóa</option>
                            </select>
                        </div>
                    `;
                }
                if (item.name == "role_id"){
                    const dataSelect = @json($dataRoles);
                    let options = dataSelect.filter(role => role.id != 1).map(role => {
                            let selected = role.id == item.value ? 'selected' : '';
                            return `<option value="${role.id}" ${selected}>${role.role_name}</option>`;
                        }).join('');
                    var inputHTML = `
                        <div class="form-group mb-2">
                                <label for="input_${index}">${item.label}</label>
                                <select id="SelectModal" name="${item.name}" class="form-control form-control-sm form-select select2" data-placeholder="Điều kiện tìm kiếm" ${item.disabled}>
                                    ${options}
                                </select>
                            </div>
                        `
                }
                
            } else {
                var inputHTML = `
                    <div class="form-group mb-2">
                        <label for="input_${index}">${item.label}</label>
                        <input type="${item.type}" class="form-control" id="input_${index}" name="${item.name}" value="${item.value}" placeholder="${item.placeholder}" ${item.disabled}>
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
        $('#saveModal').show();
        $('#modalForm').modal('show');
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
                    createDynamicInputs(dynamicData,1);
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
    // 
    
</script>

<!-- MODAL VIEW-->
<script>
    const viewBaseUrl = @json(route('admin.account.view', ['id' => 'ID_PLACEHOLDER']));
    function onView(id) {
        currentEditId = id;
        let viewUrl = viewBaseUrl.replace('ID_PLACEHOLDER', currentEditId);
        $('#saveModal').hide();
        $('#modalForm').modal('show');
        $.ajax({
            url: viewUrl,
            type: 'GET',
            processData: false,
            contentType: false,
            success: function(result) {

                if (result.success) {
                    $('#inputTitle').text("Chi Tiết " + result.title);
                    // Giả sử `result.data` chứa thông tin cấu trúc cho các input động
                    var dynamicData = result.data; // Dữ liệu có thể là mảng các đối tượng, ví dụ [{label: 'Tên', name: 'name', type: 'text', value: '', placeholder: 'Nhập tên'}]
                    createDynamicInputs(dynamicData,2);
                }
            }
        });
    }
</script>

<!-- Delete -->
<script>
    const deleteBaseUrl = @json(route('admin.account.delete', ['id' => 'ID_PLACEHOLDER']));

    function onDelete(id) {
        Swal.fire({
            title: 'Bạn có chắc chắn muốn khoá?',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Khóa',
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
                                title: 'Đã Khoá!',
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                                }).then(() => {
                                        location.reload();
                                    });
                            } else {
                                Swal.fire({
                                    title: 'Khoá thất bại!',
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