@extends('backend.layouts.app')

@section('content')
@include('backend.pages.roles.modal')
<div class="body-wrapper">
    <!--  Header Start -->
    <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item d-block d-xl-none">
                    <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                        <i class="ti ti-bell-ringing"></i>
                        <div class="notification bg-primary rounded-circle"></div>
                    </a>
                </li>
            </ul>
            <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                    <a id="btn" target="_blank" class="btn btn-primary">Download Free</a>
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="../backend/assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                            <div class="message-body">
                                <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="ti ti-user fs-6"></i>
                                    <p class="mb-0 fs-3">My Profile</p>
                                </a>
                                <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="ti ti-mail fs-6"></i>
                                    <p class="mb-0 fs-3">My Account</p>
                                </a>
                                <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="ti ti-list-check fs-6"></i>
                                    <p class="mb-0 fs-3">My Task</p>
                                </a>
                                <a href="./authentication-login.html" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!--  Header End -->
    <div class="container">
        <!--  Row 1 -->
        <div class="row">
            <div class="col-12">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Bảng phân quyền</h5>
                        <div class="form-group">
                            <form id="searchForm">
                                <div class="row justify-content-end">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <select id="searchSelect" name="searchSelect" class="form-control form-control-sm form-select select2" data-placeholder="Điều kiện tìm kiếm">
                                                <option>Lựa chọn tìm kiếm</option>
                                                <option value="role_name">Tên phân quyền</option>
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
                        </div>
                        <div class="table">
                            <table class="table text-nowrap mb-0 align-middle" id="role">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">ID</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Tên phân quyền</h6>
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
                                    <!-- <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">1</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1">Sunil Joshi</h6>
                                            <span class="fw-normal">Web Designer</span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">Elite Admin</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="badge bg-primary rounded-3 fw-semibold">Low</span>
                                            </div>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0 fs-4">$3.9</h6>
                                        </td>
                                    </tr> -->
                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="py-6 px-6 text-center">
            <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank" class="pe-1 text-primary text-decoration-underline">AdminMart.com</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a></p>
        </div>
    </div>
</div>


<script>
    render();

    function render(data = '') {
        arrID = [];

        let datatable = $('#role').DataTable({
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
                "url": `{{route('admin.role.data')}}`,
                "dataType": "json",
                "type": "GET",
                "data": data,
                beforeSend: function() {},
                complete: function() {},
            },
            oLanguage: {
                sLengthMenu: `Show _MENU_ entries <span class="tutorial" id="I-NDH-016"></span>`,
                sInfo: `Showing _START_ to _END_ of _TOTAL_ entries <span class="tutorial" id="I-NDH-017"></span>`,
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
                                            <h6 class="fw-semibold mb-0">${row.role_id}</h6>
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
                            <div class="fw-semibold mb-0">${row.updated_at ? row.updated_at : '-'}</div>
                    `);
                    },
                    targets: 4
                },
                {
                    class: 'center',
                    render: function(col, type, row) {
                        // let url = window.location.href;
                        // let param = new URL(url).search;
                        iconDelete = `<a title="Xóa" class="ms-2" onClick="onDelete('${row.role_id}')" style="cursor: pointer;"><i class="fa-solid fa-trash-can"></i></a>`;
                        // if(user_type_number == 1 || personnel_auth == 1 || currentUserId == row.user_id){
                            // ${row.isEdit ? 'href="/curator/edit/'+row.user_id+param+'"' : 'class="disabledIcon"'}
                        isEdit = `<a title="Sửa" class=""  style="cursor: pointer;" onClick="onEdit('${row.role_id}')"><i class="fa-solid fa-pen-to-square"></i></a>`;
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

    function btnSearch() {
        search();
    };

    $(document).ready(function() {
        urlLoad()

        $('#searchInput').keydown(function(event) {
            if (event.key === "Enter") {  // Kiểm tra nếu phím Enter được nhấn
                event.preventDefault();  // Ngăn chặn hành động mặc định của phím Enter (ví dụ, submit form)
                search();  // Gọi hàm tìm kiếm của bạn
            }
        });

        
    });

    

    function search() {
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
    });

    

    function onEdit(data){
        $('#editRoleModal').modal('show');
        $.ajax({
        url: `/admin/role/edit/${data}`,
        type: 'GET',
        processData: false,
        contentType: false,
        success: function(result) {
          if(result.success){
            $('#userInputModal').val(result.data.role_name);
            $('#searchSelectModal').val(result.data.status).trigger('change');
          }
          else{
            Swal.fire({
              title: result.mess,
              icon: "warning"
            });
          }
        }
      })
    }
    
  
    function urlLoad(){
        let url = window.location.href;
        let param = new URL(url).searchParams.get("search");
        if (param) {
            data = JSON.parse(decodeURIComponent(atob(param)));
            $('#searchSelect').val(data.searchSelect).trigger('change');
            $('#searchInput').val(data.searchInput).trigger('change');
            search();
        }
    }
    
    

</script>
@endsection