<p>The format of the trace file.</p>
<table class='table'>
<tr><th>Value</th><th>Description</th></tr>
<tr><td class='ctr'>0</td><td>shows a human readable indented trace file with:
<i>time index</i>, <i>memory usage</i>, <i>memory delta</i> (if the setting <a
href='#show_mem_delta'>xdebug.show_mem_delta</a> is enabled), <i>level</i>, <i>function name</i>,
<i>function parameters</i> (if the setting [CFG:collect_params] is enabled),
<i>filename</i> and <i>line number</i>.</td></tr>

<tr><td class='ctr'>1</td><td>writes a computer readable format which has two
different records. There are different records for entering a stack frame, and
leaving a stack frame. The table below lists the fields in each type of record.
Fields are tab separated.
</td></tr>

<tr><td class='ctr'>2</td><td>writes a trace formatted in (simple) HTML.</td></tr>
</table>
<p>
Fields for the computerized format:
</p>
<table class='table'>
<tr><th>Record type</th><th class='ctr'>1</th><th class='ctr'>2</th><th class='ctr'>3</th><th class='ctr'>4</th><th class='ctr'>5</th><th class='ctr'>6</th><th class='ctr'>7</th><th class='ctr'>8</th><th class='ctr'>9</th><th class='ctr'>10</th><th class='ctr'>11</th><th class='ctr'>12 - ...</th></tr>
<tr>
	<th class='ctr'>Entry</th>
	<td>level</td>
	<td>function&nbsp;#</td>
	<td>always&nbsp;'0'</td>
	<td>time index</td>
	<td>memory usage</td>
	<td>function name</td>
	<td>user-defined&nbsp;(1) or internal function&nbsp;(0)</td>
	<td>name of the include/require file</td>
	<td>filename</td>
	<td>line number</td>
	<td>no. of parameters</td>
	<td>parameters (as many as specified in field 11) - tab separated</td>
</tr>
<tr><th class='ctr'>Exit</th>
	<td>level</td>
	<td>function&nbsp;#</td>
	<td>always&nbsp;'1'</td>
	<td>time index</td>
	<td>memory usage</td>
	<td colspan='7' class='ctr'><i>empty</i></td>
</tr>
<tr><th class='ctr'>Return</th>
	<td>level</td>
	<td>function&nbsp;#</td>
	<td>always&nbsp;'R'</td>
	<td colspan='2' class='ctr'><i>empty</i></td>
	<td>return value</td>
	<td colspan='6' class='ctr'><i>empty</i></td>
</tr>
</table>

<p>
See the introduction of [FEAT:execution_trace] for a few examples.
</p>