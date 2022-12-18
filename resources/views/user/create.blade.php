<x-app-layout>
    <x-slot name="header">
        <x-form.button-back href="{{ route('user.index') }}"/>
    </x-slot>
    <form action="{{ route('user.store') }}" method="POST" autocomplete="off">
        @csrf
        <x-card bodyClass="pb-1">
            <x-slot name="action">
                <div>
                    <x-form.button type="submit" class="btn-submit" value="1" icon="bx bx-save" label="Save" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <div>
                    <x-form.button type="submit" class="btn-submit" value="1" icon="bx bx-save" label="Save" />
                </div>
            </x-slot>
            @include('user.form')
        </x-card>
    </form>

</x-app-layout>