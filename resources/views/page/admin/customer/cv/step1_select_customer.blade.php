@extends('layout.admin.adminLayout')
@section('page_title', 'Create CV')
@section('page_subtitle', 'Step 1: Select Customer')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-7">

            {{-- Step indicator --}}
            <div class="d-flex align-items-center gap-3 mb-8">
                <div class="d-flex align-items-center gap-2">
                    <span
                        class="w-30px h-30px rounded-circle bg-primary d-flex align-items-center justify-content-center text-white fw-bolder fs-8">1</span>
                    <span class="fw-bold text-primary">Select Customer</span>
                </div>
                <div class="flex-grow-1 border-top border-dashed border-gray-300"></div>
                <div class="d-flex align-items-center gap-2 opacity-50">
                    <span
                        class="w-30px h-30px rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white fw-bolder fs-8">2</span>
                    <span class="fw-bold text-muted">Choose Template</span>
                </div>
                <div class="flex-grow-1 border-top border-dashed border-gray-300"></div>
                <div class="d-flex align-items-center gap-2 opacity-50">
                    <span
                        class="w-30px h-30px rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white fw-bolder fs-8">3</span>
                    <span class="fw-bold text-muted">Review & Save</span>
                </div>
            </div>

            <div class="card card-flush">
                <div class="card-header pt-7">
                    <div class="card-title">
                        <h2>Select a Customer</h2>
                    </div>
                </div>
                <div class="card-body pt-5">
                    @if ($customers->isEmpty())
                        <div class="text-center text-muted py-10">
                            No customers yet.
                            <a href="{{ route('admin.customers.search') }}" class="text-primary ms-1">Add customer →</a>
                        </div>
                    @else
                        <form method="GET" action="{{ route('admin.cvs.step2') }}">
                            <div class="row g-4 mb-7">
                                @foreach ($customers as $customer)
                                    <div class="col-sm-6">
                                        <label class="cursor-pointer">
                                            <input type="radio" name="customer_id" value="{{ $customer->id }}"
                                                class="d-none customer-radio"
                                                {{ old('customer_id') == $customer->id ? 'checked' : '' }}>
                                            <div
                                                class="customer-card border rounded p-4 h-100 d-flex align-items-center gap-4
                                        {{ old('customer_id') == $customer->id ? 'border-primary bg-light-primary' : 'border-gray-200' }}">
                                                <div class="symbol symbol-50px flex-shrink-0">
                                                    <span class="symbol-label bg-light-info text-info fw-bolder fs-4">
                                                        {{ strtoupper(substr($customer->name, 0, 1)) }}
                                                    </span>
                                                </div>
                                                <div>
                                                    <div class="text-dark fw-bolder fs-6">{{ $customer->name }}</div>
                                                    <div class="text-muted fs-8">{{ $customer->phone }}</div>
                                                    @if ($customer->detail?->profession)
                                                        <div class="text-primary fs-8">{{ $customer->detail->profession }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary btn-lg px-10" id="nextBtn" disabled>
                                    Next: Choose Template →
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <script>
        document.querySelectorAll('.customer-radio').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('.customer-card').forEach(c => {
                    c.classList.remove('border-primary', 'bg-light-primary');
                    c.classList.add('border-gray-200');
                });
                this.nextElementSibling.classList.add('border-primary', 'bg-light-primary');
                this.nextElementSibling.classList.remove('border-gray-200');
                document.getElementById('nextBtn').disabled = false;
            });
        });
    </script>
@endsection
