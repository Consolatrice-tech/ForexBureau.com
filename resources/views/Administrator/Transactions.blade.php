@extends('Administrator.Layout')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Transaction Records</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Sender Names</th>
                        <th>Receiver Names</th>
                        <th>Receiver Location</th>
                        <th>Amount</th>
                        <th>Currency</th>
                        <th>Transaction Type</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $counter = 1 ?>
                    @foreach ($allTransactions as $transaction)
                    <tr>
                    <th scope="row">
                        {{$counter}}
                    </th>
                    <?php $counter++ ?>
                        <td>{{ $transaction->sender_Names }}</td>
                        <td>{{ $transaction->receiver_Names }}</td>
                        <td>{{ $transaction->receiver_Location }}</td>
                        <td>{{ $transaction->amount }}</td>
                        <td>{{ $transaction->currency }}</td>
                        <td>{{ $transaction->Transaction_type }}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
</div>
@endsection
