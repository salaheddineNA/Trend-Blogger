@extends('layouts.app')

@section('title', 'Admin Panel')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Admin Menu</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('admin.messages.index') }}" class="list-group-item list-group-item-action position-relative">
                            <i class="bx bx-envelope me-2"></i> Messages
                            @php
                                $unreadCount = \App\Models\ContactMessage::where('is_read', false)->count();
                            @endphp
                            @if($unreadCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.7rem;">
                                    {{ $unreadCount }}
                                </span>
                            @endif
                        </a>
                        <a href="{{ route('admin.posts.index') }}" class="list-group-item list-group-item-action">
                            <i class="bx bx-file me-2"></i> Posts
                        </a>
                        <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action">
                            <i class="bx bx-folder me-2"></i> Categories
                        </a>
                        <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action">
                            <i class="bx bx-home me-2"></i> Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('admin_content')
        </div>
    </div>
</div>
@endsection
