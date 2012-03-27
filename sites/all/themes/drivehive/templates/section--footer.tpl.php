<footer<?php print $attributes; ?>>
    <div id="footer">
            	<div id="copyright"></div>
            	<div id="footer-wrap">
                    <div class="fl">
                    <ul>
                        <li><a href="current_event.html">current event</a></li>
                        <li><a href="#">past events</a></li>
                        <li><a href="/about">about drive hive</a></li>
                        <li><a href="#">privacy &amp; legal</a></li>
                        <li><a href="/news">news</a></li>
                        <li class="last"><a href="contact.html">Contact US</a></li>       
                    </ul>
                    
                    </div>
                    <div class="fr">
                        
                        <ul>
                            <li><a id="footer-twitter" href="https://twitter.com/#!/drivehive">twitter</a></li>
                            <li><a id="footer-tube" href="http://youtube.com/drivehive">youtube</a></li>
                            <li><a id="footer-fb" href="http://www.facebook.com/pages/Drive-Hive">facebook</a></li>
                            <li><a id="footer-in" href="#">linkedin</a></li>
                            <li><a id="footer-rss" href="/rss.xml">rss</a></li>
                        </ul>
                        <div class="fix"></div>
                        <form method="post" action="#">
                            <input type="text" onblur="if (this.value == '') {this.value = 'ENTER EMAIL ADDRESS';}" onfocus="if (this.value == 'ENTER EMAIL ADDRESS') {this.value = '';}" value="ENTER EMAIL ADDRESS" id="footer-text-input" name="mail">
                            <input type="submit" class="linked" id="footer-submit" name="submit">
                        </form>
                    </div><!-- /fr -->
                    <div class="fix"></div>
                </div><!-- /footer-wrap -->
                
            </div>

  <?php print $content; ?>
</footer>