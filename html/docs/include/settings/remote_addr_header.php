If [CFG:remote_addr_header] is configured to be a non-empty string, then
the value is used as key in the $SERVER superglobal array to determine which
header to use to find the IP address or hostname to use for 'connecting back
to'. This setting is only used in combination with [CFG:remote_connect_back]
and is otherwise ignored.</p>