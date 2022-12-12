<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-bottom">
            <div>
                <x-form.button color="danger" href="{!! route('setting.ecg-type.index') !!}"
                    label="Back" icon="bx bx-left-arrow-alt" />
            </div>
        </div>
    </x-slot>
    <x-slot name="js">
        <script src="{{ asset('js/dragula.min.js') }}"></script>
        <script>
            dragula([document.getElementById("widget-todo-list")], {
                moves: function (e, o, t) {
                    return t.classList.contains("cursor-move");
                },
            });
            
        </script>
    </x-slot>


    <form action="{{ route('setting.ecg-type.update_order') }}" method="POST">
        @csrf
        <x-card class="widget-todo">
            <x-slot name="header">
                <h5>Sort Type Order</h5>
                <x-form.button type="submit" icon="bx bx-save" label="Save" />
            </x-slot>
            <x-dragable-list>
                @foreach ($rows as $row)
                <x-dragable-item>
                    <x-slot name="rightSide">
                        {{ d_currency($row->price) }} : <strong>Price</strong>
                    </x-slot>
                    <input type="hidden" name="ids[]" value="{{ $row->id }}" />
                    <div>
                        {{ d_obj($row, ['name_en', 'name_kh']) }}
                    </div>
                </x-dragable-item>
                @endforeach
            </x-dragable-list>
            <x-slot name="footer">
                <x-form.button type="submit" icon="bx bx-save" label="Save" />
            </x-slot>
        </x-card>
    </form>
</x-app-layout>