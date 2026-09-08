<div class="alert alert-danger alert-dismissible fade show mb-3" role="alert" style="border-left: 4px solid #dc3545; padding: 12px 15px;">
    <div class="d-flex align-items-center">
        <i class="bi bi-exclamation-circle me-2" style="font-size: 1.2rem;"></i>
        <div>
            <strong>Error!</strong>
            <div class="mt-1">{{ $message ?? 'Terjadi kesalahan.' }}</div>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
