<div class="row g-3">
    <div class="col-md-6">
        <label for="name" class="form-label">Product Name</label>
        <input type="text" name="name" id="name"
               value="{{ old('name', $product->name ?? '') }}"
               class="form-control @error('name') is-invalid @enderror"
               placeholder="Enter product name">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="sku" class="form-label">SKU</label>
        <input type="text" name="sku" id="sku"
               value="{{ old('sku', $product->sku ?? '') }}"
               class="form-control @error('sku') is-invalid @enderror"
               placeholder="Enter SKU">
        @error('sku')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="price" class="form-label">Price (₹)</label>
        <input type="number" step="0.01" name="price" id="price"
               value="{{ old('price', $product->price ?? '') }}"
               class="form-control @error('price') is-invalid @enderror"
               placeholder="Enter price">
        @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="number" name="quantity" id="quantity"
               value="{{ old('quantity', $product->quantity ?? '') }}"
               class="form-control @error('quantity') is-invalid @enderror"
               placeholder="Enter quantity">
        @error('quantity')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>