@extends('backend.layouts.app')

@section('content')

@include('backend.pages.products.detail')
@include('backend.components.modal')
<div class="container-fluid">
    <!--  Row 1 -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Bảng Sản Phẩm</h5>
                    <div class="form-group">
                        <form id="searchForm">
                            <div class="row justify-content-end">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <select id="searchSelect" name="searchSelect" class="form-control form-control-sm form-select   " data-placeholder="Điều kiện tìm kiếm">
                                            <option value="" disabled selected>Lựa Chọn Tìm Kiếm</option>
                                            <option value="id">Mã Sản Phẩm</option>
                                            <option value="product_name">Tên Sản Phẩm</option>
                                            <option value="product_type">Loại Sản Phẩm</option>
                                            <option value="brand">Thương Hiệu</option>
                                            <option value="category">Danh Mục</option>
                                            <option value="status">Trạng Thái</option>
                                        </select>
                                        <div id="contentSearch" class="form-control form-control-sm">

                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary light"
                                        title="Nhấn để tìm kiếm" type="button" onclick="btnSearch()" id="searchBtn">Tìm Kiếm</button>
                                </div>
                            </div>
                        </form>
                        <button class="btn btn-secondary light "
                            title="Nhấn để tìm kiếm" type="button" onclick="onAdd()" id="saveEdit">Thêm Sản Phẩm Mới</button>

                        <hr>
                    </div>
                    <div class="table">
                        <table class="table text-nowrap mb-0 align-middle" id="product">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">ID</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Tên sản phẩm</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Thông tin</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Danh mục</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Loại sản phẩm</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Thương hiệu</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Trạng thái</h6>
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

        let datatable = $('#product').DataTable({
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
                "url": `{{route('admin.product.data')}}`,
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
                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">${row.product_name.length > 20 ? row.product_name.substring(0, 18) + ".." : row.product_name}</h6>
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
                                            <h6 class="fw-semibold mb-0">${row.description.length > 20 ? row.description.substring(0, 18) + ".." : row.description}</h6>
                                        </td>

                        `);
                    },
                    targets: 2
                },
                {
                    class: 'center',
                    render: function(col, type, row) {
                        return (`
                            <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">${row.category_name}</h6>
                                        </td>
                    `);
                    },
                    targets: 3
                },
                {
                    class: 'center',
                    render: function(col, type, row) {
                        return (`
                            <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">${row.product_type_name}</h6>
                                        </td>
                    `);
                    },
                    targets: 4
                },
                {
                    class: 'center',
                    render: function(col, type, row) {
                        return (`
                            <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">${row.brand_name}</h6>
                                        </td>
                    `);
                    },
                    targets: 5
                },
                {
                    class: 'center',
                    render: function(col, type, row) {
                        let option = "";
                        let status = "";
                        switch (row.statusCustom) {
                            case 1:
                                status = "Đang hoạt động";
                                option = `mb-0 badge bg-success rounded-3 fw-semibold`;
                                break;
                            case 2:
                                status = "Ngưng hoạt động";
                                option = `mb-0 badge bg-warning rounded-3 fw-semibold`;
                                break;
                            case 3:
                                status = "Đã bị khóa";
                                option = `mb-0 badge bg-danger rounded-3 fw-semibold`;
                                break;
                        };

                        return (`
                        <td class="border-bottom-0">
                                        <h6 class="${option}">${status}</h6>
                                    </td>
                        `);
                    },
                    targets: 6
                },
                {
                    class: 'center',
                    render: function(col, type, row) {
                        // let url = window.location.href;
                        // let param = new URL(url).search;
                        iconDelete = `<a title="Xóa" class="ms-2" onClick="onDelete('${row.id}')" style="cursor: pointer;"><i class="fa-solid fa-trash-can"></i></a>`;
                        // if(user_type_number == 1 || personnel_auth == 1 || currentUserId == row.user_id){
                        // ${row.isEdit ? 'href="/curator/edit/'+row.user_id+param+'"' : 'class="disabledIcon"'}
                        isEdit = `<a title="Sửa" class="ms-2"  style="cursor: pointer;" onClick="onEdit('${row.id}')"><i class="fa-solid fa-pen-to-square"></i></a>`;
                        // }
                        isView = `<a title="Xem" class=""  style="cursor: pointer;" onClick="onView('${row.id}')"><i class="fa-solid fa-eye"></i></a>`;

                        return (`
                        <div>
                            ${isView}
                            ${isEdit}
                            ${iconDelete}
                        </div>
                    `);
                    },
                    targets: 7
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
        $contentSearch = $(this).parent().find('#contentSearch');
        const selectTemplate = (options) => `
            <select id="searchInput" name="searchInput" class="form-control form-control-sm form-select dropdown-scroll" data-placeholder="Chọn điều kiện">
                ${options}
            </select>
        `;
        switch (searchSelect) {
            case 'status':
                $contentSearch.html(selectTemplate(`
                    <option value="1">Hoạt động</option>
                    <option value="2">Ngưng hoạt động</option>
                `));
                break;
            case 'brand':
                const brandOptions = @json($dataB).map(brand => `<option value="${brand.id}">${brand.brand_name}</option>`).join('');
                $contentSearch.html(selectTemplate(brandOptions));
                break;

            case 'category':
                const categoryOptions = @json($dataC).map(category => `<option value="${category.id}">${category.category_name}</option>`).join('');
                $contentSearch.html(selectTemplate(categoryOptions));
                break;
            case 'product_type':
                const productTypeOptions = @json($dataPT).map(producType => `<option value="${producType.id}">${producType.product_type_name}</option>`).join('');
                $contentSearch.html(selectTemplate(productTypeOptions));
                break;
            default:
                $contentSearch.html(`
                    <input type="text" name="searchInput" class="form-control form-control-sm" id="searchInput">
                `);
                $contentSearch.find('#searchInput').focus();
                break;
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
        history.pushState({}, null, "/admin/product?search=" + btoa(encodeURIComponent(JSON.stringify(object))));
        $('#product').DataTable().destroy();
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
    const editGetBaseUrl = @json(route('admin.product.editGet', ['id' => 'ID_PLACEHOLDER']));
    const editPostBaseUrl = @json(route('admin.product.editPost', ['id' => 'ID_PLACEHOLDER']));

    function createDynamicInputs(data) {
        $('#dynamicInputs').empty();

        data.forEach(function(item, index) {
            let inputHTML = '';
            if (item.setting == "select") {
                let options = '';
                let optionData = [];
                switch (item.name) {
                    case 'status':
                        options = `
                        <option value="1" ${item.value == 1 ? 'selected' : ''}>Hoạt động</option>
                        <option value="2" ${item.value == 2 ? 'selected' : ''}>Ngưng hoạt động</option>
                    `;
                        break;

                    case 'brand_id':
                        optionData = @json($dataB);
                        options = optionData.map(brand => `
                        <option value="${brand.id}" ${brand.id == item.value ? 'selected' : ''}>${brand.brand_name}</option>
                    `).join('');
                        break;

                    case 'category_id':
                        optionData = @json($dataC);
                        options = optionData.map(cat => `
                        <option value="${cat.id}" ${cat.id == item.value ? 'selected' : ''}>${cat.category_name}</option>
                    `).join('');
                        break;

                    case 'product_type_id':
                        optionData = @json($dataPT);
                        options = optionData.map(pt => `
                        <option value="${pt.id}" ${pt.id == item.value ? 'selected' : ''}>${pt.product_type_name}</option>
                    `).join('');
                        break;

                    default:
                        options = `<option value="">Không có dữ liệu</option>`;
                        break;
                }
                inputHTML = `
                <div class="form-group mb-2">
                    <label for="input_${index}">${item.label}</label>
                    <select id="input_${index}" name="${item.name}" class="form-control form-control-sm form-select select2" ${item.disabled}>
                        ${options}
                    </select>
                </div>
            `;
            } else {
                inputHTML = `
                <div class="form-group mb-2">
                    <label for="input_${index}">${item.label}</label>
                    <input type="${item.type}" class="form-control" id="input_${index}" name="${item.name}" value="${item.value}" placeholder="${item.placeholder}" ${item.disabled}>
                </div>
            `;
            }
            $('#dynamicInputs').append(inputHTML);
        });
    }

    let currentEditId = null;

    function onEdit(id) {
        currentEditId = id;
        let editUrl = editGetBaseUrl.replace('ID_PLACEHOLDER', currentEditId);
        $('#saveModal').show();
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

    function saveModalEdit() {
        let formData = $('#formModal').serialize();
        let editUrl = editPostBaseUrl.replace('ID_PLACEHOLDER', currentEditId);
        $.ajax({
            url: editUrl,
            type: 'POST',
            data: formData,
            success: function(result) {
                if (result.success) {
                    window.location.replace(result.url);
                } else {
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
    const deleteBaseUrl = @json(route('admin.product.delete', ['id' => 'ID_PLACEHOLDER']));

    function onDelete(id) {
        currentEditId = id;
        let deleteUrl = deleteBaseUrl.replace('ID_PLACEHOLDER', currentEditId);
        $.ajax({
            url: deleteUrl,
            type: 'GET',
            processData: false,
            contentType: false,
            success: function(result) {
                if (result.success) {
                    window.location.replace(result.url);
                } else {
                    Swal.fire({
                        title: result.mess,
                        icon: "warning"
                    });
                }
            },
        })
    }
</script>

<!-- MODAL VIEW-->
<script>
    const viewBaseUrl = @json(route('admin.product.view', ['id' => 'ID_PLACEHOLDER']));

    function onView(id) {
        currentEditId = id;
        let viewUrl = viewBaseUrl.replace('ID_PLACEHOLDER', currentEditId);
        $('#modalView').modal('show');
        $.ajax({
            url: viewUrl,
            type: 'GET',
            processData: false,
            contentType: false,
            success: function(result) {
                if (result.success) {
                    const tbodyDetail = $('#productDetail tbody');
                    tbodyDetail.empty(); // Xoá dữ liệu cũ nếu có
                    result.dataDT.forEach(function(item) {
                        const row = `
                            <tr>
                                <td>${item.id}</td>
                                <td>${item.product_id}</td>
                                <td>${item.size}</td>
                                <td>${item.price}</td>
                                <td>${item.quantity}</td>
                                <td>${item.created_at ? moment(item.created_at).format('DD/MM/YYYY H:mm') : '-'}</td>
                                <td>${item.updated_at ? moment(item.updated_at).format('DD/MM/YYYY H:mm') : '-'}</td>
                                <td>${item.statusCustom}</td>
                            </tr>
                        `;
                        tbodyDetail.append(row);
                    });

                    const tbodyID = $('#productID tbody');
                    tbodyID.empty(); // Xoá dữ liệu cũ nếu có
                    result.dataID.forEach(function (item, index) {
                        switch (item.status) {
                            case 1:
                                status = "Đang hoạt động";
                                option = `mb-0 badge bg-success rounded-3 fw-semibold`;
                                break;
                            case 2:
                                status = "Ngưng hoạt động";
                                option = `mb-0 badge bg-warning rounded-3 fw-semibold`;
                                break;
                            case 3:
                                status = "Đã bị khóa";
                                option = `mb-0 badge bg-danger rounded-3 fw-semibold`;
                                break;
                        };
                        const row = `
                            <tr>
                                <td>${item.id}</td>
                                <td>${item.product_name.length > 20 ? item.product_name.substring(0, 18) + ".." : item.product_name}</td>
                                <td><img src="{{ asset('${item.first_image.image_path}') }}" alt="Ảnh" width="70" height="70"></td>
                                <td>${item.created_at ? moment(item.created_at).format('DD/MM/YYYY H:mm') : '-'}</td>
                                <td>${item.updated_at ? moment(item.updated_at).format('DD/MM/YYYY H:mm') : '-'}</td>
                                <td><h6 class="${option}">${status}</h6></td>
                            </tr>
                        `;
                        tbodyID.append(row);
                    });
                    // Nếu muốn set tiêu đề modal
                    $('#inputTitleDetail').text('Chi tiết sản phẩm #' + currentEditId);

                }
            }
        });
    }
</script>


<!-- MODAL ADD-->
<script>
    function onAdd() {
        currentEditId = null;
        $('#inputTitle').text('Thêm mới vai trò');
        $('#formModal')[0].reset();
        $('#dynamicInputs').empty();

        const data = [{
                label: 'Tên sản phẩm',
                name: 'product_name',
                type: 'text',
                value: '',
                placeholder: 'Nhập tên sản phẩm',
                setting: ''
            },
            {
                label: 'Thông tin sản phẩm',
                name: 'description',
                type: 'text',
                value: '',
                placeholder: 'Nhập thông tin sản phẩm',
                setting: ''
            },
            {
                label: 'Ảnh sản phẩm',
                name: 'avatar',
                type: 'text',
                value: '',
                placeholder: 'Chọn ảnh sản phẩm',
                setting: ''
            },
            {
                label: 'Danh mục',
                name: 'category_id',
                type: 'text',
                value: '',
                placeholder: '',
                setting: 'select'
            },
            {
                label: 'Loại sản phẩm',
                name: 'product_type_id',
                type: 'text',
                value: '',
                placeholder: '',
                setting: 'select'
            },
            {
                label: 'Thương hiệu',
                name: 'brand_id',
                type: 'text',
                value: '',
                placeholder: '',
                setting: 'select'
            },
            {
                label: 'Trạng thái',
                name: 'status',
                type: 'select',
                value: 1,
                placeholder: '',
                setting: 'select'
            }
        ];

        createDynamicInputs(data);
        // Đổi nút lưu để gọi đúng hàm
        $('#saveModal').attr('onclick', 'saveModalAdd()');
        $('#modalForm').modal('show');
    }

    function saveModalAdd() {
        let formData = $('#formModal').serialize();
        $.ajax({
            url: `{{route('admin.product.add')}}`,
            type: 'POST',
            data: formData,
            success: function(result) {
                if (result.success) {
                    window.location.replace(result.url);
                } else {
                    Swal.fire({
                        title: result.mess,
                        icon: "warning"
                    });
                }
            },
        })
    }
</script>
@endsection