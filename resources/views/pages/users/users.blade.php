@extends('layouts.index')
@section('content')
    <div class="card shadow">
        <div class="card-header">
            <h3 class="card-title mb-0">Users Report</h3>
        </div><!-- end card header -->
        <div class="card-body table-responsive">
            <!-- table -->
            <table class="table align-middle mb-0 datatables" id="userRep">
                <thead class="table-light text-center">
                    <tr>
                        <th>SrNo.</th>
                        <th>Profile Pic</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Gender</th>
                        <th>AlternateNumber</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($user as $p)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                <div class="flex-shrink-0">
                                    <img class="avatar-xs rounded-circle"
                                        src="{{ asset('images/users/' . $p->img) }}">
                                </div>
                            </td>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->email }}</td>
                            <td>{{ $p->mobile }}</td>
                            <td>{{ $p->gender }}</td>
                            <td>{{ $p->alternateNumber }}</td>
                        </tr>
                        @php $i++; @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            var table = $('#userRep').DataTable({
                processing: true,
            });
        });
    </script>
@endsection
