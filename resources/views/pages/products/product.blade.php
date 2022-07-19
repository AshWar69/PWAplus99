@extends('layouts.index')
@section('content')
<a class="btn btn-outline-danger mb-1" href="{{url()->previous()}}"><i class="ri-arrow-left-circle-fill pb-0"></i>
    Back</a>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add New Products</h3>
        </div>
        <div class="card-body">
            <form class="row g-3 needs-validation" id="prodData" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                @if ($type == 'Model')
                    <input type="hidden" name="mid" value="{{$id}}" >
                    <input type="hidden" name="cid" value="{{$com->cid}}" >
                    <input type="hidden" name="cat_id" value="{{$com->cat_id}}" >
                    <input type="hidden" name="type" value="{{$type}}" >
                @elseif ($type == 'Company')
                    <input type="hidden" name="cid" value="{{$id}}" >
                    <input type="hidden" name="type" value="{{$type}}" >
                    <input type="hidden" name="cat_id" value="{{$com->cat_id}}" >
                @endif
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="validationCustom01" name="pname" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please Fill Product Name
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Quantity</label>
                    <input type="number" class="form-control" min="0" id="validationCustom02" name="quantity" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please Fill Quantity
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Per Piece Rate</label>
                    <input type="number" step="0.01" min="0.1" class="form-control" id="validationCustom05" name="per"
                        required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please Fill Per Piece Price
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Rate</label>
                    <input type="number" step="0.01" min="0.1" class="form-control" readonly id="validationCustom03" name="rate"
                        required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please Fill Price
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">CGST</label>
                    <input type="number" class="form-control" id="validationCustom06" name="cgst" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please Fill Quantity
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">SGST</label>
                    <input type="number" class="form-control" id="validationCustom07" name="sgst"
                        required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please Fill Price
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Uploaded Image</label>
                    <input name="pimg" class="form-control col-12" type="file" id="validationCustom04" required>
                </div>
                {{-- <div class="col-md-12">
                    <label for="validationCustom02" class="form-label">Image</label>
                    <div class="dropzone">
                        <div class="fallback">
                            <input name="pimg" class="form-control" type="file" id="validationCustom04" required>
                        </div>
                        <div class="dz-message needsclick">
                            <div class="mb-3">
                                <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                            </div>

                            <h4>Drop files here or click to upload.</h4>
                        </div>
                    </div>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please Upload Image
                    </div>
                    <ul class="list-unstyled mb-0" id="dropzone-preview">
                        <li class="mt-2" id="dropzone-preview-list">
                            <!-- This is used as the file preview template -->
                            <div class="border rounded">
                                <div class="d-flex p-2">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-sm bg-light rounded">
                                            <img data-dz-thumbnail class="img-fluid rounded d-block" src="#"
                                                alt="Dropzone-Image" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="pt-1">
                                            <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>
                                            <p class="fs-13 text-muted mb-0" data-dz-size></p>
                                            <strong class="error text-danger" data-dz-errormessage></strong>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 ms-3 mt-2">
                                        <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div> --}}
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Submit form</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#validationCustom05').on('keyup', function(){
            var pr = $('#validationCustom05').val();
            var qn = $('#validationCustom02').val();
            $('#validationCustom03').empty();
            $('#validationCustom03').val(pr*qn);
        });

        $('#prodData').on('submit', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let formData = new FormData($('#prodData')[0]);
            $.ajax({
                url: "{{ route('saveProd') }}",
                type: "POST",
                data: formData, //$(this).serialize(),
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                success: function(data) {
                    if (data.errors) {
                        Swal.fire({
                            html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Oops...! Something went Wrong !</h4><p class="text-muted mx-4 mb-0">' +
                                data.errors + '</p></div></div>',
                            showCancelButton: !0,
                            cancelButtonClass: "btn btn-primary w-xs mb-1",
                            showConfirmButton: !1,
                            buttonsStyling: !1,
                            showCloseButton: !0,
                        });
                    }
                    if (data.success) {
                        Swal.fire({
                            html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Well done !</h4><p class="text-muted mx-4 mb-0">Aww yeah, ' +
                                data.success + '.</p></div></div>',
                            showCancelButton: !0,
                            cancelButtonClass: "btn btn-primary w-xs mb-1",
                            showConfirmButton: !1,
                            buttonsStyling: !1,
                            showCloseButton: !0,
                        });
                        $('#prodData')[0].reset();
                    }
                },
                error: function(data) {
                    Swal.fire({
                        html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Well done !</h4><p class="text-muted mx-4 mb-0">Aww yeah, ' +
                            data.responseJSON.errors.grp_name[0] + '.</p></div></div>',
                        showCancelButton: !0,
                        cancelButtonClass: "btn btn-primary w-xs mb-1",
                        showConfirmButton: !1,
                        buttonsStyling: !1,
                        showCloseButton: !0,
                    });
                }
            });
        });
    </script>
@endsection
