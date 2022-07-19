@extends('layouts.index')
@section('content')
<a class="btn btn-outline-danger mb-1" href="{{url()->previous()}}"><i class="ri-arrow-left-circle-fill pb-0"></i>
    Back</a>
    <div class="card shadow">
        <div class="card-header">
            <h3 class="card-title mb-0">Products Report</h3>
        </div><!-- end card header -->
        <div class="card-body table-responsive">
            <div class="row g-4 mb-3">
                <div class="col-sm-auto">
                    <div>
                        <a type="button" class="btn btn-success add-btn" href="{{URL::to('Product/'.$id)}}"><i class="ri-add-line align-bottom me-1"></i> Add</a>
                    </div>
                </div>
            </div>
            <!-- table -->
            @if($type == 'Models')
            <table class="table align-middle mb-0 datatables" id="prodRep">
                <thead class="table-light text-center">
                    <tr>
                        <th>SrNo.</th>
                        <th>Action</th>
                        <th>Image</th>
                        <th>Product_Name</th>
                        <th>Model</th>
                        <th>Company</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total_Price</th>
                        <th>CGST</th>
                        <th>SGST</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($pro as $p)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                <div class="hstack gap-3 flex-wrap">
                                    <a href="{{URL::to('product/'.$p->id.'/edit')}}" class="link-success fs-15"><i
                                            class="ri-edit-2-line"></i></a>
                                    <a href="javascript:void(0);" class="link-danger fs-15 del" id="{{ $p->id }}"><i
                                            class="ri-delete-bin-line"></i></a>
                                </div>
                            </td>
                            <td>
                                <div class="flex-shrink-0">
                                    <img class="avatar-xs rounded-circle"
                                        src="{{ asset('images/product_images/' . $p->image) }}">
                                </div>
                            </td>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->modelname }}</td>
                            <td>{{ $p->cname }}</td>
                            <td>{{ $p->perprice }}</td>
                            <td>{{ $p->quantity }}</td>
                            <td>{{ $p->perprice*$p->quantity }}</td>
                            <td>{{ $p->cgst }}</td>
                            <td>{{ $p->sgst }}</td>
                            <td>
                                @if ($p->status == 'Y')
                                    <span class="badge badge-soft-success text-uppercase">Active</span>
                                @else
                                    <span class="badge badge-soft-danger text-uppercase">InActive</span>
                                @endif
                            </td>
                        </tr>
                        @php $i++; @endphp
                    @endforeach
                </tbody>
            </table>
            @elseif ($type == 'Company')
            <table class="table align-middle mb-0 datatables" id="prodRep">
                <thead class="table-light text-center">
                    <tr>
                        <th>SrNo.</th>
                        <th>Action</th>
                        <th>Image</th>
                        <th>Product_Name</th>
                        <th>Company</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total_Price</th>
                        <th>CGST</th>
                        <th>SGST</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($pro as $p)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                <div class="hstack gap-3 flex-wrap">
                                    <a href="{{URL::to('product/'.$p->id.'/edit')}}" class="link-success fs-15"><i
                                            class="ri-edit-2-line"></i></a>
                                    <a href="javascript:void(0);" class="link-danger fs-15 del" id="{{ $p->id }}"><i
                                            class="ri-delete-bin-line"></i></a>
                                </div>
                            </td>
                            <td>
                                <div class="flex-shrink-0">
                                    <img class="avatar-xs rounded-circle"
                                        src="{{ asset('images/product_images/' . $p->image) }}">
                                </div>
                            </td>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->cname }}</td>
                            <td>{{ $p->perprice }}</td>
                            <td>{{ $p->quantity }}</td>
                            <td>{{ $p->perprice*$p->quantity }}</td>
                            <td>{{ $p->cgst }}</td>
                            <td>{{ $p->sgst }}</td>
                            <td>
                                @if ($p->status == 'Y')
                                    <span class="badge badge-soft-success text-uppercase">Active</span>
                                @else
                                    <span class="badge badge-soft-danger text-uppercase">InActive</span>
                                @endif
                            </td>
                        </tr>
                        @php $i++; @endphp
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>

    <template id="my-template">
        <swal-title>
            Are You Sure You Want To Delete This Record?
        </swal-title>
        <swal-icon>
            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
        </swal-icon>
        <swal-button type="confirm">
            <a href='#' class='del text-danger ml-4'>Delete</a>
        </swal-button>
        <swal-button type="cancel">
            Cancel
        </swal-button>
        <swal-param name="allowEscapeKey" value="false" />
        <swal-param name="customClass" value='{ "popup": "my-popup" }' />
    </template>
@endsection

@section('scripts')
    <script>
        $(function() {
            var table = $('#prodRep').DataTable({
                processing: true,
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
                        url: "{{route('delProducts')}}",
                        data: { 'id': usid },
                        success: function(data) {
                            setTimeout(function() {
                                location.reload();
                            }, 200);
                        }
                    })
                }
            });
        });
    </script>
@endsection
