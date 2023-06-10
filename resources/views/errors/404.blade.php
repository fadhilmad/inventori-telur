@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="error-page">
            <h2 class="headline text-warning">404</h2>

            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-warning"></i> Woops! Ada yang tidak beres.</h3>

                <p>
                    {{ __($exception->getMessage() ?: 'Not found') }}<br>
                    Sementara itu, Anda mungkin dapat <a href="{{ route('dashboard') }}">kembali ke dashboard</a>
                </p>
            </div>
        </div>
    </section>
@endsection
