@extends('layouts.index')
@section('content')
    <a class="btn btn-outline-danger mb-1" href="{{url()->previous()}}"><i class="ri-arrow-left-circle-fill pb-0"></i>
        Back</a>
    <div class="card col-md-12 ml-lg-5">
        <div class="card-header">
            <h3 class="card-title">Update Category</h3>
        </div>
        <div class="card-body">
            <form class="row g-3 needs-validation" id="compForm" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                <input type="hidden" name="id" value="{{$id}}">
                <div class="col-md-12">
                    <label for="validationCustom01" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="validationCustom01" name="main_cat" value="{{$cat->name}}" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please Fill Category Name
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
                    <img src="{{asset('images/category_images/'.$cat->img)}}" class="img-thumbnail bg-dark mt-2" style="width: 200px; height: auto"/>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>        
        $("input:radio[name='img']").on("change",function(){
            if(this.value == 'Yes')
            {
                $('#upimg').empty();
                $('#upimg').append(`
                        <label class="form-label">Upload Image</label>
                        <input name="catimg" class="form-control col-12" type="file" id="validationCustom04" required>`
                        );
            }
            else if(this.value == 'No')
                $('#upimg').empty();
        });

        $('#compForm').on('submit', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let formData = new FormData($('#compForm')[0]);
            $.ajax({
                url: "{{ route('updCategory') }}",
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
                        $('#compForm')[0].reset();
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
