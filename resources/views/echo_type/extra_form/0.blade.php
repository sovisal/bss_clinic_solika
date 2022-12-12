<tr>
    <td width="30%" class="text-right">Liver</td>
    <td>
        <x-bss-form.input name="liver" :value="old('liver', !empty($row) && $row->liver ? $row->liver : '')" />
    </td>
</tr>
<tr>
    <td class="text-right">- The thickness of the gallbladder wall</td>
    <td>
        <x-bss-form.input name="thickness" :value="old('thickness', !empty($row) && $row->thickness ? $row->thickness : '')" />
    </td>
</tr>
<tr>
    <td class="text-right">- Pancreas and spleen</td>
    <td>
        <x-bss-form.input name="spleen" :value="old('spleen', !empty($row) && $row->spleen ? $row->spleen : '')" />
    </td>
</tr>
<tr>
    <td class="text-right">- The kidneys</td>
    <td>
        <x-bss-form.input name="kidneys" :value="old('kidneys', !empty($row) && $row->kidneys ? $row->kidneys : '')" />
    </td>
</tr>
<tr>
    <td class="text-right">- Bladder</td>
    <td>
        <x-bss-form.input name="bladder" :value="old('bladder', !empty($row) && $row->bladder ? $row->bladder : '')" />
    </td>
</tr>
<tr>
    <td class="text-right">- Uterus</td>
    <td>
        <x-bss-form.input name="uterus" :value="old('uterus', !empty($row) && $row->uterus ? $row->uterus : '')" />
    </td>
</tr>
<tr>
    <td class="text-right">- Endometrium</td>
    <td>
        <x-bss-form.input name="endometrium" :value="old('endometrium', !empty($row) && $row->endometrium ? $row->endometrium : '')" />
    </td>
</tr>
<tr>
    <td class="text-right">- Ovaries</td>
    <td>
        <x-bss-form.input name="ovaries" :value="old('ovaries', !empty($row) && $row->ovaries ? $row->ovaries : '')" />
    </td>
</tr>
<tr>
    <td class="text-right">*</td>
    <td>
        <x-bss-form.input name="all" :value="old('all', !empty($row) && $row->all ? $row->all : '')" />
    </td>
</tr>
<tr>
    <td class="text-right">IMPRESSION</td>
    <td>
        <x-bss-form.input name="impression" :value="old('impression', !empty($row) && $row->impression ? $row->impression : '')" />
    </td>
</tr>