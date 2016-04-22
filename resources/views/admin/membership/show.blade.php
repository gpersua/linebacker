@extends('app')

@section('htmlheader_title')
    Membership
@endsection

@section('main-content')

    <h1>Membership</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $membership->idlb_membership }}</td> <td> {{ $membership->description }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection