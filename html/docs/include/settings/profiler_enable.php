Enables Xdebug's profiler which creates files in the
[CFG:profiler_output_dir:profile output directory].  Those files can be
read by KCacheGrind to visualize your data.  This setting can not be set in
your script with ini_set(). If you want to selectively enable the profiler,
please set [CFG:profiler_enable_trigger] to 1 <strong>instead</strong> of using
this setting.