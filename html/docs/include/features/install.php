<h2>Precompiled Windows Modules</h2>

<p>
There are a few precompiled modules for Windows, they are all for the non-debug
version of PHP. You can get those at the <a href='/download.php'>download</a>
page. Follow <a href='/wizard.php'>these instructions</a> to get Xdebug
installed.
</p>

<a name='pecl'></a>
<h2>PECL Installation</h2>

<p>
As of Xdebug 0.9.0 you can install Xdebug through PEAR/PECL. This only works
with with PEAR version 0.9.1-dev or higher and some UNIX.
</p>
<p>
Installing with PEAR/PECL is as easy as:
</p>
<pre class='example'>
# pecl install xdebug
</pre>
<p>
but you still need to add the correct line to your php.ini: (don't forget to
change the path and filename to the correct one &mdash; but make sure you use
the <b>full path</b>)
</p>
<pre class='example'>
zend_extension="/usr/local/php/modules/xdebug.so"
</pre>
<p><b>Note:</b> You should ignore any prompts to add "extension=xdebug.so" to
php.ini &mdash; this <b>will</b> cause problems.</p>

<a name='mac'></a>
<h2>Installation on Mac OS X</h2>

<p>
PHP is available from the unofficial Mac OS X package manager <a href='http://brew.sh/'>Homebrew</a>. Homebrew recommends using PECL to install Xdebug, so please follow the instructions above for <a href="#pecl">installing via PECL</a>.
</p>

<a name='source'></a>
<h2>Installation From Source</h2>

<p>
You can <a href='/download.php#releases'>download</a> the source of the latest <b>stable</b> release [KW:last_release_version].
Alternatively you can obtain Xdebug from GIT:
</p>
<pre class='example'>
git clone git://github.com/xdebug/xdebug.git
</pre>
<p>
This will checkout the latest development version which is currently [KW:last_dev_version].
You can also browse the source at <a href='https://github.com/derickr/xdebug'>https://github.com/derickr/xdebug</a>.
</p>

<a name='compile'></a>
<h2>Compiling</h2>

<p>There is a <a href='/wizard.php'>wizard</a> available that provides you
with the correct file to download, and which paths to use.</p>
<p>
You compile Xdebug separately from the rest of PHP.  Note, however,
that you need access to the scripts 'phpize' and 'php-config'.  If
your system does not have 'phpize' and 'php-config', you will need to
compile and install PHP from a source tarball first, as these script
are by-products of the PHP compilation and installation processes. (Debian users
can install the required tools with 
<code>apt-get install php5-dev</code>). It is important that the source version
matches the installed version as there are slight, but important, differences
between PHP versions.  Once you have access to 'phpize' and
'php-config', do the following:
</p>
<p>
<ol>
<li>Unpack the tarball: tar -xzf xdebug-[KW:last_release_version].tgz.  Note that you do
not need to unpack the tarball inside the PHP source code tree.
Xdebug is compiled separately, all by itself, as stated above.</li>

<li>cd xdebug-[KW:last_release_version]</li>

<li>Run phpize: phpize (or /path/to/phpize if phpize is not in your path). Make
sure you use the phpize that belongs to the PHP version that you want to use
Xdebug with. See this <a href='/docs/faq#api'>FAQ entry</a> if
you're having some issues with finding which phpize to use.</li>

<li>./configure --enable-xdebug
<li>make</li>
<li>make install</li>
</ol>

<a name='configure-php'></a>
<h2>Configure PHP to Use Xdebug</h2>

<ol>
<li>add the following line to php.ini:
zend_extension="/wherever/you/put/it/xdebug.so". For PHP versions earlier
than 5.3 <b>and</b> threaded usage of PHP (Apache 2 worker MPM or the
ISAPI module), add: zend_extension_ts="/wherever/you/put/it/xdebug.so" instead.
<strong>Note:</strong> In case you compiled PHP yourself and used
--enable-debug you would have to use zend_extension_debug=.
<strong>Note:</strong> If you want to use Xdebug and OPCache together, you
must load Xdebug after OPCache. Otherwise, they won't work properly.
<strong>From PHP 5.3 onwards, you always need to use the zend_extension PHP.ini
setting name, and not zend_extension_ts, nor zend_extension_debug. However,
your compile options (ZTS/normal build; debug/non-debug) still need to match
with what PHP is using.</strong>
</li>

<li>Restart your webserver.</li>

<li>Write a PHP page that calls '<i>phpinfo()</i>' Load it in a browser and
look for the info on the Xdebug module.  If you see it next to the Zend logo,
you have been successful! You can also use 'php -m' if you have a command
line version of PHP, it lists all loaded modules. Xdebug should appear
twice there (once under 'PHP Modules' and once under 'Zend Modules').</li>
</ol>
</p>

<a name='debugclient'></a>
<h2>Debugclient Installation</h2>

<p>
Unpack the Xdebug source tarball and issue the following commands:
</p>
<pre class='example'>
$ cd debugclient
$ ./configure --with-libedit
$ make
# make install
</pre>
<p>
This will install the debugclient binary in /usr/local/bin unless you don't 
have libedit installed on your system. You can either install it, or leave
out the '--with-libedit' option to configure. Debian 'unstable' users can
install the library with <code>apt-get install libedit-dev libedit2</code>.
</p>
<p>
If the configure script can not find libedit and you are sure you have (and
it's headers) installed correctly and you get link errors like the
following in your configure.log:
</p>
<pre class='example'>
/usr/lib64/libedit.so: undefined reference to `tgetnum'
/usr/lib64/libedit.so: undefined reference to `tgoto'
/usr/lib64/libedit.so: undefined reference to `tgetflag'
/usr/lib64/libedit.so: undefined reference to `tputs'
/usr/lib64/libedit.so: undefined reference to `tgetent'
/usr/lib64/libedit.so: undefined reference to `tgetstr'
collect2: ld returned 1 exit status
</pre>
<p>
you need to change your configure command to:
</p>
<pre class='example'>
$ LDFLAGS=-lncurses ./configure --with-libedit
</pre>