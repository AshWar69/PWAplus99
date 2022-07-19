@extends('layouts.index')
@section('content')
<a class="btn btn-outline-danger mb-1" href="{{url()->previous()}}"><i class="ri-arrow-left-circle-fill pb-0"></i>
    Back</a>
    <div class="card shadow">
        <div class="card-header">
            <h3 class="card-title mb-0">Orders Report</h3>
        </div><!-- end card header -->
        <div class="card-body table-responsive">
            <div class="row g-4 mb-3">
                <div class="col-sm-auto">
                    <div>
                        {{-- <a type="button" class="btn btn-success add-btn" href="{{URL::to('Product/'.$id)}}"><i class="ri-add-line align-bottom me-1"></i> Add</a> --}}
                    </div>
                </div>
            </div>
            <!-- table -->
            <table class="table align-middle mb-0 datatables" id="orderRep">
                <thead class="table-light text-center">
                    <tr>
                        <th>SrNo.</th>
                        <th>Action</th>
                        <th>Order_Details</th>
                        <th>UserName</th>
                        <th>Add1</th>
                        <th>Add1</th>
                        <th>Mobile</th>
                        <th>Pincode</th>
                        <th>City</th>
                        <th>Price</th>
                        <th>Tax</th>
                        <th>Total_Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                <div class="hstack gap-3 flex-wrap">
                                    <a href="javascript:void(0);" class="link-success accept fs-15" id="{{ $order->id }}"><i
                                            class="ri-check-fill"></i></a>
                                    <a href="javascript:void(0);" class="link-danger fs-15 reject" id="{{ $order->id }}"><i
                                            class="ri-close-fill"></i></a>
                                </div>
                            </td>
                            <td>{{ $order->order_details }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->add1 }}</td>
                            <td>{{ $order->add2 }}</td>
                            <td>{{ $order->pmob }}</td>
                            <td>{{ $order->pincode }}</td>
                            <td>{{ $order->city }}</td>
                            <td>{{ $order->price }}</td>
                            <td>{{ $order->taxamount }}</td>
                            <td>{{ $order->tprice }}</td>
                            <td>{{$order->status }}</td>
                        </tr>
                        @php $i++; @endphp
                    @endforeach
                </tbody>
            </table>
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
            var table = $('#orderRep').DataTable({
                processing: true,
            });
        });

        //Deleting Part for table=========================================
        var usid;
        $(document).on('click', '.reject', function() {
            usid = $(this).attr('id');
            Swal.fire({
                //template: '#my-template',
                html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Oops...!!</h4><p class="text-muted mx-4 mb-0">Your Really Want to Reject This Order.</p></div></div>',
                showCancelButton: !0,
                confirmButtonClass: "btn btn-primary w-xs me-2 mb-1",
                confirmButtonText: "Yes, Reject It!",
                cancelButtonClass: "btn btn-danger w-xs mb-1",
                buttonsStyling: !1,
                showCloseButton: !0,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "{{route('rejectOrder')}}",
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
        
        
        //Deleting Part for table=========================================
        var usid;
        $(document).on('click', '.accept', function() {
            usid = $(this).attr('id');
            Swal.fire({
                //template: '#my-template',
                html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Oops...!!</h4><p class="text-muted mx-4 mb-0">Your Really Want to Reject This Order.</p></div></div>',
                showCancelButton: !0,
                confirmButtonClass: "btn btn-success w-xs me-2 mb-1",
                confirmButtonText: "Yes, Accept It!",
                cancelButtonClass: "btn btn-danger w-xs mb-1",
                buttonsStyling: !1,
                showCloseButton: !0,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "{{route('acceptOrder')}}",
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
