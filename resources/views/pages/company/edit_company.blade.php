@extends('layouts.index')
@section('content')
    <a class="btn btn-outline-danger mb-1" href="{{url()->previous()}}"><i class="ri-arrow-left-circle-fill pb-0"></i>
        Back</a>
    <div class="card col-md-12 ml-lg-5">
        <div class="card-header">
            <h3 class="card-title">Edit Company</h3>
        </div>
        <div class="card-body">
            <form class="row g-3 needs-validation" action="{{ route('company.update', $id) }}" enctype="multipart/form-data"
                method="POST" novalidate>
                @csrf
                @method('Put')
                <input type="hidden" name="cat_id" value="{{$com->cat_id}}" >
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Company Name</label>
                    <input type="text" class="form-control" id="validationCustom01" name="cname" value="{{$com->name}}" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please Write Company Name
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
                    <img src="{{ asset('images/company_images/' . $com->image) }}" class="img-thumbnail bg-dark mt-2"
                        style="width: 200px; height: auto" />
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
        $('#example-one').hierarchySelect({
            width: 460
        });

        $("input:radio[name='img']").on("change", function() {
            if (this.value == 'Yes') {
                $('#upimg').empty();
                $('#upimg').append(`
                        <label class="form-label mt-3">Upload Company Image</label>
                        <input name="cimg" class="form-control col-12" type="file" id="validationCustom03" required>`);
            } else if (this.value == 'No')
                $('#upimg').empty();
        });
    </script>
@endsection
