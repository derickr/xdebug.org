When this setting is set to 1, you can trigger the generation of trace
files by using the XDEBUG_TRACE GET/POST parameter, or set a cookie with the
name XDEBUG_TRACE. This will then write the trace data to
[CFG:trace_output_dir:defined directory]. In order to prevent Xdebug
to generate trace files for each request, you need to set
[CFG:auto_trace] to 0. Access to the trigger itself can be configured through
[CFG:trace_enable_trigger_value].