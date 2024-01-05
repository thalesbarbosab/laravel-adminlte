@extends('adminlte::page')
@section('title', 'Notificações')
@section('pagina', 'Notificações')
@section('content_header')
    <h1><i class="far fa-bell"></i> Notificações</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (count($notifications) > 0)
                <div class="card card-default">
                    <div class="card-header">
                        <a class="btn btn-primary" href="{{ route('notification.update_unreaded') }}"><i class="far fa-envelope-open mr-3"></i> Marcar todas as notificações como lidas</a>
                    </div>
                    <div class="card-body">
                        @foreach ($notifications as $notification)
                            <div class="callout callout-{{ $notification->alert }}">
                                <div class="row justify-content-between">
                                    <div class="col-sm-12 col-md-12 col-lg-8">
                                        <h5><i class="{{ $notification->icon }}"></i> {{ $notification->text }}</h5>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-2">
                                        <p>{{ $notification->created_at->diffForHumans() }}</p>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-2">
                                        <span class="badge badge-{{ $notification->readed ? 'success' : 'warning' }}">
                                            {{ $notification->readed ? 'Lida' : 'Não lida' }}
                                            @if ($notification->readed)
                                                {{ $notification->updated_at->diffForHumans() }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{  $notifications->links() }}
                    </div>
                </div>
            @else
                <div class="callout callout-info">
                    <div class="row justify-content-between">
                        <h5>Nenhuma notificação encontrada !</h5>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
