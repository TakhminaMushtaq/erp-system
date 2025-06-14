<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Create Sales Order') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('sales_orders.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <label for="customer_name" class="form-label">Customer Name</label>
                            <input type="text" name="customer_name" id="customer_name" class="form-control" value="{{ old('customer_name') }}" required>
                            @error('customer_name') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <label for="sale_date" class="form-label">Sale Date</label>
                            <input type="date" name="sale_date" id="sale_date" class="form-control" value="{{ old('sale_date', now()->toDateString()) }}" required>
                            @error('sale_date') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Products</label>
                        <table class="table table-bordered" id="products-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price (₹)</th>
                                    <th>Quantity</th>
                                    <th>Subtotal (₹)</th>
                                    <th>
                                    <button type="button" class="btn btn-sm btn-success" id="add-row"><i class="fas fa-plus"></i> </button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="products[0][product_id]" class="form-select product-select" required>
                                            <option value="">-- Select --</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                                    {{ $product->name }} (Stock: {{ $product->quantity }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control price" name="products[0][price]" step="0.01" readonly>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control qty" name="products[0][quantity]" min="1" value="1" required>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control subtotal" name="products[0][subtotal]" readonly>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mb-3 text-end">
                        <h5>Total: ₹<span id="total-amount">0.00</span></h5>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Save Order
                        </button>
                        <a href="{{ route('sales_orders.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    let rowIdx = 1;

    function updateSubtotal(row) {
        const price = parseFloat(row.find('.price').val()) || 0;
        const qty = parseFloat(row.find('.qty').val()) || 0;
        const subtotal = price * qty;
        row.find('.subtotal').val(subtotal.toFixed(2));
        updateTotal();
    }

    function updateTotal() {
        let total = 0;
        $('.subtotal').each(function () {
            total += parseFloat($(this).val()) || 0;
        });
        $('#total-amount').text(total.toFixed(2));
    }

    // Update price and subtotal when product is selected
    $(document).on('change', '.product-select', function () {
        const row = $(this).closest('tr');
        const price = $(this).find(':selected').data('price') || 0;
        row.find('.price').val(price);
        updateSubtotal(row);
    });

    // Update subtotal when quantity is changed
    $(document).on('input', '.qty', function () {
        const row = $(this).closest('tr');
        updateSubtotal(row);
    });

    // Remove row
    $(document).on('click', '.remove-row', function () {
        $(this).closest('tr').remove();
        updateTotal();
    });

    // Add new row
    $('#add-row').on('click', function () {
        const newRow = `
        <tr>
            <td>
                <select name="products[${rowIdx}][product_id]" class="form-select product-select" required>
                    <option value="">-- Select --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                            {{ $product->name }} (Stock: {{ $product->quantity }})
                        </option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" class="form-control price" name="products[${rowIdx}][price]" readonly></td>
            <td><input type="number" class="form-control qty" name="products[${rowIdx}][quantity]" min="1" value="1" required></td>
            <td><input type="number" class="form-control subtotal" name="products[${rowIdx}][subtotal]" readonly></td>
            <td><button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-trash"></i></button></td>
        </tr>
        `;
        $('tbody').append(newRow);
        rowIdx++;
    });
</script>

    @endpush
</x-app-layout>
