<x-bss-form.textarea-row
    name="result"
    class="my-simple-editor"
    label="Result"
    rows="3"
>{{ old('result', !empty($row) && $row->result ? $row->result : '') }}</x-bss-form.textarea-row>