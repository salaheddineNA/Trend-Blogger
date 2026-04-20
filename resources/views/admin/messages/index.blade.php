@extends('admin.layout')

@section('title', 'Messages')

@section('admin_content')
<style>
.message-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 50px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    border-left: 4px solid #4DE5E7;
}

.message-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.message-card.unread {
    border-left: 4px solid #764ba2;
    background: linear-gradient(135deg, rgba(118, 75, 162, 0.05) 0%, rgba(255, 255, 255, 1) 100%);
}

.message-header {
    display: flex;
    justify-content: between;
    align-items: center;
    margin-bottom: 15px;
}

.message-meta {
    display: flex;
    gap: 20px;
    align-items: center;
    color: #6c757d;
    font-size: 0.9rem;
}

.message-subject {
    font-size: 1.2rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 10px;
}

.message-excerpt {
    color: #6b7280;
    line-height: 1.5;
    margin-bottom: 15px;
}

.message-actions {
    display: flex;
    gap: 10px;
}

.badge-read {
    background: #10b981;
    color: white;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.badge-unread {
    background: #764ba2;
    color: white;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.stats-card {
    background: linear-gradient(135deg, #4DE5E7 0%, #764ba2 100%);
    color: white;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 30px;
    text-align: center;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: bold;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.9;
}
</style>

<!-- Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">
        <i class="bx bx-envelope me-2"></i>Contact Messages       
    </h2>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-primary btn-sm">
            <i class="bx bx-refresh me-1"></i> Refresh
        </a>
    </div>
</div>

<!-- Statistics -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="stats-card">
            <div class="stat-number">{{ $messages->count() }}</div>
            <div class="stat-label">Total Messages</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stats-card">
            <div class="stat-number">{{ $messages->where('is_read', false)->count() }}</div>
            <div class="stat-label">Unread Messages</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stats-card">
            <div class="stat-number">{{ $messages->where('is_read', true)->count() }}</div>
            <div class="stat-label">Read Messages</div>
        </div>
    </div>
</div>

<!-- Messages List -->
@if($messages->count() > 0)
    @foreach($messages as $message)
        <div class="message-card {{ $message->is_read ? '' : 'unread' }}" >
            <div class="message-header">
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="mb-1">{{ $message->name }}</h5>
                            <small class="text-muted">{{ $message->email }}</small>
                        </div>
                        <div>
                            @if($message->is_read)
                                <span class="badge-read">Read</span>
                            @else
                                <span class="badge-unread">Unread</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="message-subject">
                        {{ $message->subject }}
                    </div>
                    
                    <div class="message-meta">
                        <div>
                            <i class="bx bx-calendar me-1"></i>
                            {{ $message->created_at->format('M d, Y - g:i A') }}
                        </div>
                    </div>
                    
                    <div class="message-excerpt">
                        {{ Str::limit($message->message, 150) }}
                    </div>
                    
                    <div class="message-actions">
                        <a href="{{ route('admin.messages.show', $message->id) }}" class="btn btn-sm btn-primary">
                            <i class="bx bx-show me-1"></i> View
                        </a>
                        
                        @if($message->is_read)
                            <form action="{{ route('admin.messages.mark-unread', $message->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-warning">
                                    <i class="bx bx-envelope me-1"></i> Mark Unread
                                </button>
                            </form>
                        @else
                            <form action="{{ route('admin.messages.mark-read', $message->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-success">
                                    <i class="bx bx-check me-1"></i> Mark Read
                                </button>
                            </form>
                        @endif
                        
                        <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" class="d-inline" 
                              onsubmit="return confirm('Are you sure you want to delete this message?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bx bx-trash me-1"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="text-center py-5 mb-5">
        <i class="bx bx-envelope-open fs-1 text-muted"></i>
        <h4 class="mt-3">No messages yet</h4>
        <p class="text-muted">When users contact you, their messages will appear here.</p>
    </div>
@endif
@endsection
