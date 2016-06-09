@extends('layouts.user')

@section('title', 'Saques')

@section('breadcrumb')
    <li class="breadcrumb-link">
        <a href="{{ route('user.finance.qrequests.index') }}">Finanças</a>
    </li>
    <li class="breadcrumb-link">
        <a href="{{ route('user.finance.withdrawals.index') }}">Saques</a>
    </li>
    <li class="breadcrumb-current-item">Fazer Saque</li>
@endsection

@section('content')
    <div class="row">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-icon glyphicon glyphicon-minus"></span>
                <span class="panel-title">Saques</span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Conta</th>
                                <th>Quantiade</th>
                                <th>Descrição</th>
                                <th>Sacado Em</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($withdrawals as $withdrawal)
                            <tr data-withdrawal="{{ $withdrawal->toJson() }}" class="row-data">
                                <td>{{ $withdrawal->id }}</td>
                                <td>{{ $withdrawal->user->name }}</td>
                                <td><button class="btn btn-link account-popover">Conta</button></td>
                                <td>{{ format_money($withdrawal->amount) }}</td>
                                <td>{{ $withdrawal->description }}</td>
                                <td>{{ $withdrawal->created_at->format('d/m/Y G:i') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="clearfix">
                        <div class="pull-right">
                            <nav>
                                {!! $withdrawals->links(); !!}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('.account-popover').popover({
            container: 'body',
            content: function () {
                var data = $(this).closest('.row-data').data('withdrawal');

                $ta = $('<textarea/>').attr('rows', 10).attr('cols', 50).prop('disabled', true).text(data.account_info);

                return $ta;
            },
            html: true,
            placement: 'top',
            trigger: 'hover',
            template: '<div class="popover" style="max-width: 100%;" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
        });
    </script>
@endsection
