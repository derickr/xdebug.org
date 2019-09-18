<a name="introduction"></a>
<h2>Introduction</h2>

<p>Xdebug's (remote) debugger allows you to examine data structure,
interactively walk through your and debug your code. The protocol that is being
used is open, and is called <a href="/docs-dbgp.php">DBGp</a>. This protocol is
implemented in Xdebug 2, and replaces an older GDB-like protocol that is no
longer supported.
</p>

<a name="clients"></a>
<h2>Clients</h2>
<p>
Xdebug 2 is bundled with a <b>simple command line client</b> for the
<a href="/docs-dbgp.php">DBGp</a> protocol.
There are a few other client implementations (both free and commercial) as
well. I am not the author of any of those, so please refer to the original
authors for <b>support</b>:
<ul>
<li><b><a href="http://devphp.sf.net/">Dev-PHP</a></b> (IDE: Windows)</li>
<li><b>Eclipse <a href="https://wiki.eclipse.org/Debugging_using_XDebug">plugin</a></b> (IDE).</li>
<li><b>Emacs <a href="http://code.google.com/p/geben-on-emacs/">plugin</a></b> (Editor Plugin).</li>
<li><b><a href="https://www.kdevelop.org/">KDevelop</a></b> (IDE: Linux (KDE); Open Source).</li>
<li>ActiveState's <b><a href="http://activestate.com/products/komodo_ide/?src=AScom&type=bn&X=HP&campaign=KMD">Komodo</a></b> (IDE: Windows, Linux, Mac; Commercial).</li>
<li><b><a href="http://www.bluestatic.org/software/macgdbp/index.php">MacGDBP</a></b> (Standalone client for Mac OS X; Free)</li>
<li><b><a href="http://php.netbeans.org">NetBeans</a></b> (IDE: Windows, Linux, Mac OS X and Solaris).</li>
<li><b><a href="https://notepad-plus-plus.org/">Notepad++</a></b> <a href="http://sourceforge.net/project/showfiles.php?group_id=189927&package_id=236520">plugin</a> (Editor: Windows).</li>
<li>WaterProof's <b><a href="http://www.waterproof.fr/products/PHPEdit/">PHPEdit</a></b> (IDE, from version 2.10: Windows; Commercial).</li>
<li>Devsense's <b><a href="http://www.devsense.com/products/php-tools">PHP Tools for Visual Studio</a></b> (MS Visual Studio Plugin; Commercial).</li>
<li>JetBrain's <b><a href="http://www.jetbrains.com/phpstorm/">PhpStorm</a></b> (IDE; Commercial).</li>
<li><b><a href="http://protoeditor.sourceforge.net/">Protoeditor</a></b> (Editor: Linux).</li>
<li><b><a href="https://github.com/robertbasic/pugdebug">pugdebug</a></b> (Standalone client for Linux, Windows and Mac OS X; Open Source).</li>
<li><b><a href="https://packagecontrol.io/packages/Xdebug%20Client">SublimeTextXdebug</a></b> (Plugin for Sublime Text 2 and 3, Open Source).</li>
<li><b>VIM <a href="https://github.com/joonty/vdebug">plugin</a></b> (Editor Plugin).</li>
<li>jcx software's <b><a href="http://www.vsphp.com/">VS.Php</a></b> (MS Visual Studio Plugin; Commercial).</li>
<li><b><a href="https://chrome.google.com/webstore/detail/xdebug/nhodjblplijafdpjjfhhanfmchplpfgl?hl=en-GB&gl=GB">Xdebug Chrome App</a></b> (Chrome Application; <a href="https://github.com/artbek/chrome-xdebug-client">Open Source</a>)</li>
<li><b><a href="http://code.google.com/p/xdebugclient/">XDebugClient</a></b> (Standalone client for Windows).</li>
</ul>
</p>
<p>
A simple command line client for debugging is bundled with Xdebug in the
<code>debugclient</code> directory.
</p>

<a name="starting"></a>
<h2>Starting The Debugger</h2>

<p>In order to enable Xdebug's debugger you need to make some configuration
settings in php.ini. These settings are [CFG:remote_enable] to enable the
debugger, [CFG:remote_host] and [CFG:remote_port] to configure the IP address
and port where the debugger should connect to. There is also a
[CFG:remote_connect_back] setting that can be used if your development server
is shared with multiple developers.</p>

<p>If you want the debugger to initiate a session when an error situation
occurs (PHP error or exception) then you also need to change the
[CFG:remote_mode] setting. Allowed values for this setting are "req" (the
default) which makes the debugger initiate a session as soon as a script is
started, or "jit" when a session should only be initiated on an error.
</p>

<a name="activate_debugger"></a>
<p>
After made all those settings Xdebug will still not start a debugging session
automatically when a script is run. You need to activate Xdebug's debugger
and you can do that in three ways:
<ol>
<li>When running the script from the command line you need to set an
environment variable, like:
<pre class="example">
export XDEBUG_CONFIG="[CFGS:idekey]=session_name"
php myscript.php
</pre>
On Windows, setting an environment variable is done with <code>set</code>:
<pre class="example">
set XDEBUG_CONFIG="[CFGS:idekey]=session_name"
</pre>
You can also configure the [CFG:remote_host], [CFG:remote_port],
[CFG:remote_mode] and [CFG:remote_handler] in this same environment variable as
long as you separate the values by a space:
<pre class="example">
export XDEBUG_CONFIG="[CFGS:idekey]=session_name [CFGS:remote_host]=localhost [CFGS:profiler_enable]=1"
</pre>
All settings that you can set through the XDEBUG_CONFIG setting can also be set
with normal php.ini settings.</li>

<li>If you want to debug a script started through a web browser, simply add
<code>XDEBUG_SESSION_START=session_name</code> as parameter to the URL.
Instead of using a GET parameter, you can also set XDEBUG_SESSION_START as a
POST parameter, or through a cookie named XDEBUG_SESSION. Refer to the <a
href="#browser_session">next section</a> to read on how debug sessions work
from within a browser window.</li>

<li>An alternative way to activate the debugger while running PHP through a web
server is by installing one of the following four browser extensions. Each of
them allows you to simply enable the debugger by clicking on one button. When
these extensions are active, they set the XDEBUG_SESSION cookie directly,
instead of going through XDEBUG_SESSION_START as described in
<a href="#browser_session">HTTP Debug Sessions</a> further on.

The extensions are:
<a name="browser-extensions"></a><a name="firefox-ext"></a>
<dl>
	<dt>Xdebug Helper for Firefox</dt>
	<dd>
		This <a href="https://addons.mozilla.org/en-GB/firefox/addon/xdebug-helper-for-firefox/">extension</a>
		for Firefox was built to make debugging with an IDE easier. You can
		find the extension at
		<a href="https://addons.mozilla.org/en-GB/firefox/addon/xdebug-helper-for-firefox/">https://addons.mozilla.org/en-GB/firefox/addon/xdebug-helper-for-firefox/</a>.
		The source code for this extension is on <a href="https://github.com/BrianGilbert/xdebug-helper-for-firefox">GitHub</a>.
	</dd>

	<dt>Xdebug Helper for Chrome</dt>
	<dd>
		This <a href="https://chrome.google.com/extensions/detail/eadndfjplgieldjbigjakmdgkmoaaaoc">extension</a>
		for Chrome will help you to enable/disable debugging and profiling with
		a single click. You can find the extension at
		<a href="https://chrome.google.com/extensions/detail/eadndfjplgieldjbigjakmdgkmoaaaoc">https://chrome.google.com/extensions/detail/eadndfjplgieldjbigjakmdgkmoaaaoc</a>.
	</dd>

	<dt>Xdebug Toggler for Safari</dt>
	<dd>
		This <a href="http://benmatselby.posterous.com/xdebug-toggler-for-safari">extension</a>
		for Safari allows you to auto start Xdebug debugging from within Safari.
		You can get it from Github at
		<a href="https://github.com/benmatselby/xdebug-toggler">https://github.com/benmatselby/xdebug-toggler</a>.
	</dd>

	<dt>Xdebug launcher for Opera</dt>
	<dd>
		This <a
		href="https://addons.opera.com/addons/extensions/details/xdebug-launcher/?display=en">extension</a>
		for Opera allows you to start an Xdebug session from Opera. 
	</dd>
</dl>
</ol>
</p>

<p>
Before you start your script you will need to tell your client that it can
receive debug connections, please refer to the documentation of the specific
client on how to do this. To use the bundled client simply start it after
<a href=install#debugclient>compiling and installing</a> it. You can
start it by running "debugclient".
</p>
<p>
When the debugclient starts it will show the following information and then
waits until a connection is initiated by the debug server:
</p>
<pre class="example">
Xdebug Simple DBGp client (0.10.0)
Copyright 2002-2007 by Derick Rethans.
- libedit support: enabled
	 
Waiting for debug server to connect.
</pre>
<p>
After a connection is made the output of the debug server is shown:
</p>
<pre class="example">
Connect
&lt;?xml version="1.0" encoding="iso-8859-1"?>
&lt;init xmlns="urn:debugger_protocol_v1"
      xmlns:xdebug="http://xdebug.org/dbgp/xdebug"
      fileuri="file:///home/httpd/www.xdebug.org/html/docs/index.php"
      language="PHP"
      protocol_version="1.0"
      appid="13202"
      idekey="derick">
  &lt;engine version="2.0.0RC4-dev">&lt;![CDATA[Xdebug]]>&lt;/engine>
  &lt;author>&lt;![CDATA[Derick Rethans]]>&lt;/author>
  &lt;url>&lt;![CDATA[http://xdebug.org]]>&lt;/url>
  &lt;copyright>&lt;![CDATA[Copyright (c) 2002-2007 by Derick Rethans]]>&lt;/copyright>
&lt;/init>
(cmd)
</pre>
<p>
Now you can use the commandset as explained on the <a
href="/docs-dbgp.php">DBGp</a> documentation page. When the script ends the
debug server disconnects from the client and the debugclient resumes with
waiting for a new connection.
</p>

<a name="communication"></a>
<h2>Communication Set-up</h2>
<h3>With a static IP/single developer</h3>
<p>
With remote debugging, Xdebug embedded in PHP acts like the client, and the IDE
as the server. The following animation shows how the communication channel is
set-up:
</p>
<p align="center">
<img src="/images/docs/dbgp-setup.gif"/>
</p>
<p>
<ul>
	<li>The IP of the server is 10.0.1.2 with HTTP on port 80</li>
	<li>The IDE is on IP 10.0.1.42, so [CFG:remote_host] is set to
	10.0.1.42</li>
	<li>The IDE listens on port 9000, so [CFG:remote_port] is set to 9000</li>
	<li>The HTTP request is started on the machine running the IDE</li>
	<li>Xdebug connects to 10.0.1.42:9000</li>
	<li>Debugging runs, HTTP Response provided</li>
</ul>
</p>
<h3>With an unknown IP/multiple developers</h3>
<p>
If [CFG:remote_connect_back] is used, the set-up is slightly different:
</p>
<p align="center">
<img src="/images/docs/dbgp-setup2.gif"/>
</p>
<p>
<ul>
	<li>The IP of the server is 10.0.1.2 with HTTP on port 80</li>
	<li>The IDE is on an unknown IP, so [CFG:remote_connect_back] is set to
	1</li>
	<li>The IDE listens on port 9000, so [CFG:remote_port] is set to 9000</li>
	<li>The HTTP request is made, Xdebug detects the IP addres from the HTTP
	headers</li>
	<li>Xdebug connects to the detected IP (10.0.1.42) on port 9000</li>
	<li>Debugging runs, HTTP Response provided</li>
</ul>
</p>

<a name="browser_session"></a>
<h2>HTTP Debug Sessions</h2>
<p>
Xdebug contains functionality to keep track of a debug session when started
through a browser: cookies. This works like this:
<ul>
<li>When the URL variable <code>XDEBUG_SESSION_START=name</code> is appended
to an URL—or through a POST variable with the same name—Xdebug emits a cookie
with the name "XDEBUG_SESSION" and as value the value of the
XDEBUG_SESSION_START URL parameter. The default expiry time of the cookie is
one hour, but this can be configured through the
[CFG:remote_cookie_expire_time] setting. The
DBGp protocol also passes this same value to the init packet when connecting
to the debugclient in the "idekey" attribute.</li>
<li>When there is a GET (or POST) variable XDEBUG_SESSION_START or the
XDEBUG_SESSION cookie is set, Xdebug will try to connect to a debugclient.</li>
<li>To stop a debug session (and to destroy the cookie) simply add the URL
parameter <code>XDEBUG_SESSION_STOP</code>. Xdebug will then no longer try
to make a connection to the debugclient.</li>
</ul>
</p>


<a name="multiple-users"></a>
<h2>Multiple Users Debugging</h2>
<p>
Xdebug only allows you to specify one IP address to connect to with
[CFG:remote_host]) while doing remote debugging. It does not
automatically connect back to the IP address of the machine the browser 
runs on, unless you use [CFG:remote_connect_back].
</p>
<p>
If all of your developers work on different projects on the same (development)
server, you can make the [CFG:remote_host] setting for each directory
through Apache's .htaccess functionality by using <code>php_value
xdebug.remote_host=10.0.0.5</code>.  However, for the case where multiple
developers work on the same code, the .htaccess trick does not work as the
directory in which the code lives is the same.
</p>
<p>
There are two solutions to this. First of all, you can use a <b>DBGp proxy</b>.
For an overview on how to use this proxy, please refer to the article at <a
href="http://derickrethans.nl/debugging-with-multiple-users.html">Debugging
with multiple users</a>. You can download the proxy on
<a href="http://code.activestate.com/komodo/remotedebugging/">ActiveState's web
site</a> as part of the python remote debugging package. There is some
more documentation in the
<a href="http://community.activestate.com/faq/komodo-ide-debugger-proxy-pydbgpproxy">Komodo FAQ</a>.
</p>
<p>
Secondly you can
use the [CFG:remote_connect_back] <b>setting</b> that was introduced in
Xdebug
2.1.
</p>


<a name="implementation-details"></a>
<h2>Implementation Details</h2>
<p>
Xdebug's implementation of the
<a href="/docs-dbgp.php#context-names">DBGp protocol's <code>context_names</code></a>
command does not depend on the stack level. The returned value is always the
same during each debugger session, and hence, can be safely cached.
</p>

<h2>Custom DBGp commands</h2>
<p>
The DBGp protocol allows for debugger engine specific commands, prefixed with
the <code>xcmd_</code> prefix. Xdebug includes a few of these, and they're
documented here.
</p>

<a name="xcmd_profiler_get_name"></a>
<h3>DBGp: xcmd_profiler_name_get</h3>
<p>
If Xdebug's profiler is currently active (See: [FEAT:profiler]), this command
returns the name of the file that is being used to write the profiling
information to.
</p>

<a name="xcmd_get_executable_lines"></a>
<h3>DBGp: xcmd_get_executable_lines</h3>
<p>
This command returns which lines in an active stack frame can have a working
breakpoint. These are the lines which have an <code>EXT_STMT</code>
opcode on them. This commands accepts a <code>-d</code> option, which
indicates the stack depth, with <code>0</code> being the top leve stack frame.
</p>
<p>
The command returns the information in the following XML format:
</p>
<pre class="example">
&lt;?xml version="1.0" encoding="iso-8859-1"?&gt;
&lt;response
  xmlns="urn:debugger_protocol_v1"
  xmlns:xdebug="https://xdebug.org/dbgp/xdebug"
  command="xcmd_get_executable_lines"
  transaction_id="10"&gt;
	&lt;xdebug:lines&gt;
		&lt;xdebug:line lineno="2"&gt;&lt;/xdebug:line&gt;
		&lt;xdebug:line lineno="3"&gt;&lt;/xdebug:line&gt;
		&lt;xdebug:line lineno="4"&gt;&lt;/xdebug:line&gt;
		&lt;xdebug:line lineno="6"&gt;&lt;/xdebug:line&gt;
		&lt;xdebug:line lineno="8"&gt;&lt;/xdebug:line&gt;
	&lt;/xdebug:lines&gt;
&lt;/response&gt;
</pre>