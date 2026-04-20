@extends('admin.layout')

@section('title', 'Message Details')

@section('admin_content')
<style>
.message-detail-card {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    border-left: 4px solid #4DE5E7;
}

.message-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 25px;
}

.message-subject {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 15px;
}

.message-meta {
    display: flex;
    gap: 30px;
    align-items: center;
    color: #6c757d;
    font-size: 0.95rem;
}

.message-content {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 25px;
    border-left: 3px solid #4DE5E7;
}

.message-text {
    line-height: 1.7;
    color: #374151;
    font-size: 1.05rem;
    white-space: pre-wrap;
}

.sender-info {
    background: linear-gradient(135deg, #4DE5E7 0%, #764ba2 100%);
    color: white;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 25px;
}

.sender-name {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 5px;
}

.sender-email {
    opacity: 0.9;
    font-size: 0.95rem;
}

.btn-gradient {
    background: linear-gradient(135deg, #4DE5E7 0%, #764ba2 100%);
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    color: white;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-gradient:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(77, 229, 231, 0.3);
    color: white;
}
</style>

<!-- Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">
        <i class="bx bx-envelope-open me-2"></i>Message Details 
    <div class="d-flex gap-2 mt-4">
        <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back me-2"></i> Back to Messages
        </a>
        
        @if($message->is_read)
            <form action="{{ route('admin.messages.mark-unread', $message->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-warning">
                    <i class="bx bx-envelope me-2"></i> Mark Unread
                </button>
            </form>
        @else
            <form action="{{ route('admin.messages.mark-read', $message->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-gradient">
                    <i class="bx bx-check me-2"></i> Mark Read
                </button>
            </form>
        @endif
        
        <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" class="d-inline" 
              onsubmit="return confirm('Are you sure you want to delete this message?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger">
                <i class="bx bx-trash me-2"></i> Delete
            </button>
        </form>
    </div>
</div>

<!-- Message Detail -->
<div class="message-detail-card mb-5">
    <!-- Message Header -->
    <div class="message-header">
        <div class="message-subject">{{ $message->subject }}</div>
        <div class="message-meta">
            <div>
                <i class="bx bx-calendar me-2"></i>
                {{ $message->created_at->format('F d, Y - g:i A') }}
            </div>
            <div>
                <i class="bx bx-envelope me-2"></i>
                @if($message->is_read)
                    <span class="badge bg-success">Read</span>
                @else
                    <span class="badge bg-warning">Unread</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Sender Information -->
    <div class="sender-info">
        <div class="sender-name">
            <i class="bx bx-user me-2"></i>{{ $message->name }}
        </div>
        <div class="sender-email">
            <i class="bx bx-envelope me-2"></i>{{ $message->email }}
        </div>
    </div>

    <!-- Message Content -->
    <div class="message-content">
        <h5 class="mb-3">
            <i class="bx bx-message me-2"></i>Message
        </h5>
        <div class="message-text">{{ $message->message }}</div>
    </div>

    <!-- Quick Actions -->
    <div class="d-flex gap-3 justify-content-between align-items-center">
        <div class="text-muted small">
            <i class="bx bx-info-circle me-1"></i>
            This message was received {{ $message->created_at->diffForHumans() }}
        </div>
        
        <div class="d-flex gap-2">
            <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" 
               class="btn btn-gradient">
                <i class="bx bx-reply me-2"></i> Reply via Email
            </a>
        </div>
    </div>
</div>
@endsection
