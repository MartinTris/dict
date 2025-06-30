@extends('layouts.app')
@section('contents')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 font-weight-bold" style="color: #003566;">BPLO Management</h1>
        <div>
            <a href="{{ route('bplo.create') }}" class="btn btn-sm" style="background-color: #003566; color: white;">
                <i class="fas fa-plus"></i> Add New Record
            </a>
            <a href="{{ route('bplo.visualization') }}" class="btn btn-sm" style="background-color: #003566; color: white;">
                <i class="fas fa-chart-pie"></i> View Visualization
            </a>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold" style="color: #003566;">BPLO Records</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #003566; color: white;">
                        <tr>
                          
                            <th>Province</th>
                            <th>Municipality/City</th>
                            <th>BPCO Status</th>
                            <th>Congressional District</th>
                            <th>Income Class</th>
                            <th>Remarks</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bplos as $bplo)
                        <tr>
                           
                            <td>{{ $bplo->province }}</td>
                            <td>{{ $bplo->municipality_city }}</td>
                            <td>{{ $bplo->bpco_status }}</td>
                            <td>{{ $bplo->congressional_district }}</td>
                            <td>{{ $bplo->income_class }}</td>
                            <td>{{ $bplo->remarks }}</td>
                            <td>
                                <form action="{{ route('bplo.destroy', $bplo->id) }}" method="POST">
                                    <a class="btn btn-sm" style="background-color: #003566; color: white;" href="{{ route('bplo.show', $bplo->id) }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a class="btn btn-sm btn-primary" style="background-color: #4E7AC7; color: white;" href="{{ route('bplo.edit', $bplo->id) }}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection