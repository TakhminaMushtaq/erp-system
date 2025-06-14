<!-- Modal -->
<div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
            @include('products.form')
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">
              <i class="fas fa-edit"></i> Update
          </button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              Cancel
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
