
ABOUT

The XSPF Playlist module generates a XSPF playlist suitable for use with various 
players. While et was designed for Jeroen Wijering's flash player, it should work with
other players.

The admin interface allows the administrator to select what node types 
it works on, choose a default thumbnail file to use, and forthcoming support for CCK 
fields. It also supports multiple file types (audio, video, flash) that are supported 
by the flash player.

INSTALLATION

Place the module in your modules directory. Activate the module at admin > build > modules
Create your settings admin > settings > xspf playlist

USAGE

You can generate a xspf playlist for a node by using the url:
http//mysite.com/node/NID/xspf
where NID is the node id of the node that you want the playlist for.

You can also create an XSPF file form a view- go to admin/build/views and select XSPF Playlist
for your type of view. This has not really been tested under D6.

For further information, including developer usage, see the project's Drupal handbook page:
http://drupal.org/node/278260.

