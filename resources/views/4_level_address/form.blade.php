<table class="table-form striped">
    <tr>
        <td width="20%" class="text-right">Name KH <small class='required'>*</small></td>
        <td>
            <x-bss-form.input name="name_kh" value="{{  ((isset($province->_name_kh))? $province->_name_kh : '' ) }}" required autofocus />
        </td>
    </tr>
    <tr>
        <td width="20%" class="text-right">Name KH <small class='required'>*</small></td>
        <td>
            <x-bss-form.input name="name_en" value="{{ ((isset($province->_name_en))? $province->_name_en : '' ) }}" required />
        </td>
    </tr>
    <tr>
        <td width="20%" class="text-right">Path KH <small class='required'>*</small></td>
        <td>
            <x-bss-form.input name="path_kh" value="{{ ((isset($province->_path_kh))? $province->_path_kh : '' ) }}" required />
        </td>
    </tr>
    <tr>
        <td width="20%" class="text-right">Path KH <small class='required'>*</small></td>
        <td>
            <x-bss-form.input name="path_en" value="{{ ((isset($province->_path_en))? $province->_path_en : '' ) }}" required />
        </td>
    </tr>
</table>
