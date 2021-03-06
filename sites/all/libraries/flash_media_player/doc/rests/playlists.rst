.. _playlists:

Playlist Support
================

First, note that playlist XML files are subject to the :ref:`crossdomain` of Flash. This means that a videoplayer on one domain cannot load a playlist from another domain. It can be fixed by placing a *crossdomain.xml* file at the server the playlist is loaded from. 

If your playlist and player.swf are hosted on the same domain, these restrictions don't apply.

Supported XML Formats
---------------------

That said, the following playlist formats are supported:

* `ASX <http://msdn2.microsoft.com/en-us/library/ms910265.aspx>`_ feeds
* `ATOM <http://code.google.com/apis/youtube/2.0/developers_guide_protocol.html#Understanding_Video_Entries>`_ feeds with `Media <http://search.yahoo.com/mrss>`_ extensions
* `RSS <http://cyber.law.harvard.edu/rss/rss.html>`_ feeds with `iTunes <http://apple.com/itunes/store/podcaststechspecs.html>`_ extensions and `Media <http://search.yahoo.com/mrss>`_ extensions
* `XSPF <http://xspf.org/specs>`_ feeds

Here is an overview of all the tags of each format the player processes, and the entry in the JW Player playlist they correspond to:

==============  ==============  ==============  ==============  ==============  ==============  ==============
JW Player       XSPF            RSS             itunes:         media:          ASX             ATOM          
==============  ==============  ==============  ==============  ==============  ==============  ==============
author          creator         (none)          author          credit          author          (none)        
date            (none)          pubDate         (none)          (none)          (none)          published     
description     annotation      description     summary         description     abstract        summary       
duration        duration        (none)          duration        content         duration        (none)        
file            location        enclosure       (none)          content         ref             (none)        
link            info            link            (none)          (none)          moreinfo        link          
image           image           (none)          (none)          thumbnail       (none)          (none)        
start           (none)          (none)          (none)          (none)          starttime       (none)        
streamer        (none)          (none)          (none)          (none)          (none)          (none)        
tags            (none)          category        keywords        keywords        (none)          (none)        
title           title           title           (none)          title           title           title         
type            (none)          (none)          (none)          (none)          (none)          (none)        
==============  ==============  ==============  ==============  ==============  ==============  ==============

All **media:** tags can be embedded in a **media:group** element. A **media:content** element can also act as a container.


JWPlayer Namespace
------------------

In order to enable all JW Player file properties for all feed formats, the player contains a **jwplayer** namespace. By inserting this into your feed, properties that are not supported by the feed format itself (such as the **streamer**) can be amended without breaking validation.  Any of the entries listed in the above table can be inserted. Here's an example, of a video that uses :ref:`rtmp`:

.. code-block:: html

   <rss version="2.0" xmlns:jwplayer="http://developer.longtailvideo.com/">
     <channel>
       <title>Example RSS feed with jwplayer extensions</title>
       <item>
         <title>Big Buck Bunny</title>
         <jwplayer:file>videos/nPripu9l-60830.mp4</jwplayer:file>
         <jwplayer:streamer>rtmp://myserver.com/myApp/</jwplayer:streamer>
         <jwplayer:duration>34</jwplayer:duration>
       </item>
     </channel>
   </rss>


**Pay attention to the top level tag, which describes the JW Player namespace with the xmlns attribute. This must be available in order to not break validity.**


Mixing namespaces
-----------------

You can mix **jwplayer** elements with both the regular elements of a feed and elements from the mRSS and iTunes extensions. If multiple elements match the same playlist entry, the elements will be prioritized:

* Elements that are defined by the feed format (e.g. the *enclosure* in RSS)  get the lowest priority.
* Elements defined by the *itunes* namespace rank third.
* Element defined by the *media* namespace (e.g. *media:content*) rank second.
* Elements defined by the *jwplayer* extension always gets the highest priority.

This feature allows you to set, for example, a specific video version or streaming features for the JW Player, while other feed aggregators will pick the default content. In the above example feed, we could insert a regular *enclosure* element that points to a download of the video. This would make the feed useful for both the JW Player and text-oriented aggregators such as Feedburner.