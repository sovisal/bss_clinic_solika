<form class="w-100" action="{!! $url !!}" method="get">
    <div class="row justify-content-center" style="margin-top: -40px">
        <div class="col-sm-3 col-md-2">
            <x-form.daterangepicker
                name="ft_daterangepicker"
                label="Date"
                value="{{ request()->ft_daterangepicker ?: (now()->startOfMonth()->format('d/M/Y') .' - '. now()->endOfMonth()->format('d/M/Y')) }}"
                drpStart="{{ request()->ft_daterangepicker_drp_start ?: now()->startOfMonth() }}"
                drpEnd="{{ request()->ft_daterangepicker_drp_end ?: now()->endOfMonth() }}"
            />
        </div>
        <div class="col-sm-3 col-md-2">
            <x-form.select name="ft_product_id" label="{{ __('form.stock.product') }}">
            <option value="">{{ __('form.all') }}</option>
                @foreach ($products as $product)
                <option value="{{ $product->id }}" @selected($product->id == request()->ft_product_id)>{{ d_obj($product, ['name_en', 'name_kh']) }}</option>
                @endforeach
            </x-form.select>
        </div>
        {!! $slot !!}
        <div class="col-md-auto">
            <div class="form-group">
                <label>​ ​</label>
                <x-form.button type="submit" color="dark" name="filter-btn-search" id="filter-btn-search" class="mt-0 btn-block btn-search-filter"
                    icon="bx bx-search" label="{{ __('button.search') }}" />
            </div>
        </div>
    </div>
</form>