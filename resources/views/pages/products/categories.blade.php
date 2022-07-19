@extends('layouts.index')
@section('content')
    {{-- <div class="card">
        <div class="card-header">
            <div class="row">
                <h3 class="col-md-3">Categories</h3>
                <div class="col-md-9 text-end">
                    <button type="button" id="expand" class="btn float-right btn-outline-primary ml-2">Hide All</button>

                    {{-- <button type="button" id="new" data-bs-toggle="modal" data-bs-target="#decModal"
                        class="btn float-right btn-outline-danger ml-2"><i class="fas fa-minus-circle"></i> Deactivate
                        Category
                    </button> --
                    <button type="button" id="new" data-bs-toggle="modal" data-bs-target="#delModal"
                        class="btn float-right btn-outline-danger ml-2"><i class="ri-delete-bin-2-fill align-bottom"></i> Delete Category
                    </button>
                    <button type="button" id="new" data-bs-toggle="modal" data-bs-target="#formModal"
                        class="btn float-right btn-outline-success ml-2"><i class="ri-add-circle-fill align-bottom"></i> New Category
                    </button>
                    <button type="button" id="new" data-bs-toggle="modal" data-bs-target="#MainModal"
                        class="btn float-right btn-outline-success"><i class="ri-add-circle-fill align-bottom"></i> New Main Category
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body tree">
            <ul class="text-dark">
                @foreach ($category as $categories)
                    <li class="fw-medium fs-14"><span><i class="ri-add-circle-fill align-bottom"></i>{{ $categories->name }}</span>
                        @if ($categories->childrenRecursive)
                            <ul class="te">
                                @foreach ($categories->childrenRecursive as $child)
                                    @include('pages.products.agchild', ['childs' => $child])
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div> --}}

    <h2 class="mb-2 page-title">Categories Report</h2>
    <div class="row my-4">
        <!-- Small table -->
        <div class="col-md-12">
            <button type="button" id="new" data-bs-toggle="modal" data-bs-target="#formModal"
                class="btn float-right btn-outline-success my-1"><i class="ri-add-circle-fill align-bottom"></i>Add New
                Category
            </button>
            {{-- <a href="{{URL::to('Category')}}" class="btn btn-outline-primary mb-2">Add New</a> --}}
            <div class="card shadow">
                <div class="card-body">
                    <!-- table -->
                    <table class="table datatables text-center" id="CategoryRep">
                        <thead>
                            <tr>
                                <th>SrNo</th>
                                <th>Action</th>
                                <th>Name</th>
                                <th>Active</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div> <!-- simple table -->
    </div> <!-- end section -->

    <!--======================Add New Main Category Modal=================-->
    <div id="formModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-gradient-navy">
                    <h6 class="modal-title" align="left">Add Category</h6>
                    <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <span id="answer1"></span>
                    <form id="smart-form2" class="row g-3 needs-validation" novalidate>
                        @csrf
                        <div class="col-md-12">
                            <label for="validationCustom01" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="validationCustom01" name="main_cat" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please Fill Category Name
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Upload Image</label>
                            <input id="validationCustom02" type="file" name="catimg" class="form-control" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please Fill Category Name
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Submit form</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- <!--======================Add New Category Modal=================-->
    <div id="formModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-gradient-navy">
                    <h6 class="modal-title" align="left">New Category</h6>
                    <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <span id="answer"></span>
                    <form id="smart-form" class="row g-3 needs-validation" novalidate>
                        @csrf
                        <div class="col-md-12">
                            <label for="validationCustom01" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="validationCustom01" name="catname" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please Fill Category Name
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="validationCustom02" class="form-label">Parent Category</label>
                            <div class="dropdown hierarchy-select form-control" id="example-one">
                                <button type="button" class="btn dropdown-toggle" id="example-one-button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                <div class="dropdown-menu" aria-labelledby="example-one-button">
                                    <div class="hs-searchbox">
                                        <input type="text" id="vb" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="hs-menu-inner">
                                        @foreach ($category as $cat)
                                            @php $level=1 @endphp
                                            <a class="dropdown-item" data-value="{{ $cat->id }}"
                                                data-level="{{ $level }}" href="">{{ $cat->name }}</a>
                                            @if ($cat->childrenRecursive)
                                                @foreach ($cat->childrenRecursive as $child)
                                                    @include('pages.products.child', ['childs' => $child, 'level' => $level + 1])
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <input class="d-none" name="pcat" readonly="readonly" aria-hidden="true"  id="validationCustom02" required
                                    type="text" />
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please Choose Parent Category
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Upload Image</label>
                            <input id="validationCustom03" type="file" name="catimg" class="form-control" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please Fill Category Name
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--======================Add New Main Category Modal=================-->
    <div id="MainModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-gradient-navy">
                    <h6 class="modal-title" align="left">New Main Category</h6>
                    <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <span id="answer1"></span>
                    <form id="smart-form2" class="row g-3 needs-validation" novalidate>
                        @csrf
                        <div class="col-md-12">
                            <label for="validationCustom01" class="form-label">Main Category Name</label>
                            <input type="text" class="form-control" id="validationCustom01" name="main_cat" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please Fill Category Name
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Upload Image</label>
                            <input id="validationCustom02" type="file" name="catimg" class="form-control" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please Fill Category Name
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Submit form</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!--======================Add New Category Modal=================-->
    <div id="delModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-gradient-navy">
                    <h6 class="modal-title" align="left">New Category</h6>
                    <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <span id="answer"></span>
                    <form id="delete-form" class="row g-3 needs-validation" novalidate>
                        <div class="col-md-12">
                            <label for="validationCustom02" class="form-label">Choose Category</label>
                            <div class="dropdown hierarchy-select form-control" id="example-three">
                                <button type="button" class="btn dropdown-toggle" id="example-one-button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                <div class="dropdown-menu" aria-labelledby="example-one-button">
                                    <div class="hs-searchbox">
                                        <input type="text" id="vb" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="hs-menu-inner">
                                        @foreach ($category as $cat)
                                            @php $level=1 @endphp
                                            <a class="dropdown-item" data-value="{{ $cat->id }}"
                                                data-level="{{ $level }}" href="">{{ $cat->name }}</a>
                                            @if ($cat->childrenRecursive)
                                                @foreach ($cat->childrenRecursive as $child)
                                                    @include('pages.products.child', ['childs' => $child, 'level' => $level + 1])
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <input class="d-none" name="delcat" readonly="readonly" aria-hidden="true"  id="validationCustom02" required
                                    type="text" />
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please Choose Category
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
    
@endsection

@section('scripts')
    <script>
        $(function() {
            var table = $('#CategoryRep').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('category.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'status'
                    },
                ]
            });
        });

        //Deleting Part for table=========================================
        var usid;
        $(document).on('click', '.del', function() {
            usid = $(this).attr('id');
            Swal.fire({
                //template: '#my-template',
                html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon><div class="mt-4 pt-2 fs-15 mx-5"><h4>Are you Sure ?</h4><p class="text-muted mx-4 mb-0">Are you Sure You want to Delete this Record ?</p></div></div>',
                showCancelButton: !0,
                confirmButtonClass: "btn btn-primary w-xs me-2 mb-1",
                confirmButtonText: "Yes, Delete It!",
                cancelButtonClass: "btn btn-danger w-xs mb-1",
                buttonsStyling: !1,
                showCloseButton: !0,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "delCategory/" + usid,
                        success: function(data) {
                            setTimeout(function() {
                                location.reload();
                            }, 200);
                        }
                    })
                }
            });
        });

        
        $('#smart-form2').on('submit', function(e) {
            e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let formData = new FormData($('#smart-form2')[0]);
                $.ajax({
                    url: "{{ route('mainCat') }}",
                    method: "POST",
                    data: formData, //$(this).serialize(),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(data) {
                        var html = '';
                        if (data.errors) {
                            html = "<div class= 'alert alert-danger alert-border-left alert-dismissible fade show' role='alert'><i class='ri-error-warning-line me-3 align-middle'></i> <strong>  " + data.errors + "  </strong><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                            
                        }
                        if (data.success) {
                            html = "<div class= 'alert alert-success alert-border-left alert-dismissible fade show' role='alert'><i class='ri-check-double-line me-3 align-middle'></i> <strong>  " + data.success + "  </strong><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                            $('#smart-form2')[0].reset();
                        }
                        $('#answer1').html(html);
                    },
                });
        });
    </script>
@endsection
