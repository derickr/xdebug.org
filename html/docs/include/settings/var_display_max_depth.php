<p>Controls how many nested levels of array elements and object properties are
when variables are displayed with either [FUNC:xdebug_var_dump],
[CFG:show_local_vars] or through [FEAT:execution_trace].</p>
<p>The maximum value you can select is 1023. You can also use <i>-1</i> as
value to select this maximum number.</p>
<p>This setting does not have any influence on the number of children that is
send to the client through the [FEAT:remote] feature.</p>