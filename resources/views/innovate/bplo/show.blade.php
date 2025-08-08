@extends('layouts.app')
@section('contents')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 font-weight-bold" style="color: #003566;">BPLO Record Details</h1>
            <div>
                <a href="{{ url('/bplo/' . $bplo->id . '/edit') }}" class="btn btn-sm btn-primary edit-btn mx-1"
                    style="background-color:#003566; border:none">
                    <i class="fas fa-edit"></i> Edit Record
                </a>
                <a href="{{ url('/bplo') }}" class="btn btn-sm btn-secondary"
                    style="background-color:#6a84a0; border:none">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color: #003566;">BPLO Information</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 30%; background-color: #003566; color: white;">Province</th>
                            <td>{{ $bplo->province }}</td>
                        </tr>
                        <tr>
                            <th style="background-color: #003566; color: white;">Municipality/City</th>
                            <td>{{ $bplo->municipality_city }}</td>
                        </tr>
                        <tr>
                            <th style="background-color: #003566; color: white;">BPCO Status</th>
                            <td>{{ $bplo->bpco_status }}</td>
                        </tr>
                        <tr>
                            <th style="background-color: #003566; color: white;">Congressional District</th>
                            <td>{{ $bplo->congressional_district }}</td>
                        </tr>
                        <tr>
                            <th style="background-color: #003566; color: white;">Income Class</th>
                            <td>{{ $bplo->income_class }}</td>
                        </tr>
                        <tr>
                            <th style="background-color: #003566; color: white;">Remarks</th>
                            <td>{{ $bplo->remarks ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th style="background-color: #003566; color: white;">Created At</th>
                            <td>{{ $bplo->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th style="background-color: #003566; color: white;">Updated At</th>
                            <td>{{ $bplo->updated_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
