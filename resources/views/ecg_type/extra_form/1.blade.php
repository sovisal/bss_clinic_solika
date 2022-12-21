<x-bss-form.textarea-row
    name="default_form"
    class="my-simple-editor"
    label="Detail"
    rows="3"
>{{ old('default_form', !empty($row) && $row->default_form ? $row->default_form : '') }}</x-bss-form.textarea-row>