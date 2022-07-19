@extends('layouts.index')
@section('content')
    <a class="btn btn-outline-danger mb-3" href="{{ URL::to('Products/'.$pro->id) }}"><i class="ri-arrow-left-circle-fill pb-0"></i>
        Back</a>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add New Products</h3>
        </div>
        <div class="card-body">
            <form class="row g-3 needs-validation" id="prodData" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                <input type="hidden" value="{{$pro->id}}" name="id">
                <input type="hidden" value="{{$pro->company}}" name="cid">
                <input type="hidden" value="{{$pro->category}}" name="cat_id">
                <input type="hidden" value="{{$pro->model}}" name="mid">
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="validationCustom01" name="pname" required value="{{$pro->name}}">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please Fill Product Name
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Quantity</label>
                    <input type="number" class="form-control" min="0" id="validationCustom02" name="quantity" value="{{$pro->quantity}}" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please Fill Quantity
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Per Piece Rate</label>
                    <input type="number" step="0.01" min="0.1" class="form-control" value="{{$pro->price/$pro->quantity}}" id="validationCustom05" name="per"
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
                    <input type="number" step="0.01" min="0.1" class="form-control" readonly id="validationCustom03" name="rate" value="{{$pro->price}}"
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
                    <input type="number" class="form-control" id="validationCustom06" value="{{$pro->cgst}}" name="cgst" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please Fill Quantity
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">SGST</label>
                    <input type="number" class="form-control" id="validationCustom07" value="{{$pro->sgst}}" name="sgst"
                        required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please Fill Price
                    </div>
                </div>
                <div class="col-6">
                    <label class="form-label">Want To Change Uploaded Image ? </label><br>
                    <label class="form-check-label">Yes</label>
                    <input type="radio" class="form-check-input" id="formradioRight1" name="img" value="Yes">
                    <label class="form-check-label">No</label>
                    <input type="radio" class="form-check-input" id="formradioRight2" name="img" value="No">
                    <div id="upimg">

                    </div>
                </div>
                <div class="col-md-6">
                    <label>Uploaded Image</label>
                    <img src="{{asset('images/product_images/'.$pro->image)}}" class="img-thumbnail bg-dark mt-2" style="width: 200px; height: auto"/>
                </div>
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
        $('#validationCustom02').on('keyup', function(){
            var pr = $('#validationCustom05').val();
            var qn = $('#validationCustom02').val();
            $('#validationCustom03').empty();
            $('#validationCustom03').val(pr*qn);
        });

        $("input:radio[name='img']").on("change",function(){
            if(this.value == 'Yes')
            {
                $('#upimg').empty();
                $('#upimg').append(`
                        <label class="form-label">Upload Image</label>
                        <input name="pimg" class="form-control col-12" type="file" id="validationCustom04" required>`
                        );
            }
            else if(this.value == 'No')
                $('#upimg').empty();
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
                url: "{{ route('updProd') }}",
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
                        $('#smart-form')[0].reset();
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
