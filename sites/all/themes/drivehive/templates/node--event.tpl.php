<article<?php print $attributes; ?>>
  <?php //print $user_picture; ?>
  <?php if (!$page && $title): ?>
  <header>
    <?php print render($title_prefix); ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
    <?php print render($title_suffix); ?>
  </header>
  <?php endif; ?>
  
  <div<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
?>
<div id="celebrity-wrapper">
	<div id="celebrity">
            <h3>
	CELEBRITY / / <span>CHARITY</span></h3>
            <div id="guest-blurb">
            <?php if(!empty($guest_face_pic)){print $guest_face_pic;} ?>
            <?php if(!empty($guest_quote)){print $guest_quote;} ?>
            </div><!--#guest-blurb-->
            <div class="fix">
	&nbsp;</div>
            <div class="fl">
	<?php if(!empty($charity_pic)){print $charity_pic;} ?>
            
            </div>
           <div id="about">
	<?php print render($content); ?>
               

<?php 
//print '<pre style="color:orange; font-size:11px;">';
//print_r($content);
//print '</pre>';
//print render($content['field_event_product']); 
?>
           </div>
	</div> <!--#celebrity-->
</div> <!--#celebrity-wrapper-->


<?php print $event_sponsors; ?>
  </div>
  	
		<?php
		
		print $last_related_blog;
		?>

                                        <?php print $recent_blogs; ?>
		                        


  <div class="clearfix">
    <?php if (!empty($content['links'])): ?>
      <nav class="links node-links clearfix"><?php //print render($content['links']); ?></nav>
    <?php endif; ?>
	    <?php  print render($content['comments']); ?>
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
<div class="frame-wrapper" id="media-box">
                	<div class="frame">
                    	<h4>TWITTER</h4>
                    	<div id="divTweet" style="position: relative; width: 520px; height: 210px; overflow: hidden;">
                    	   <ul class="tweet" style="position: absolute; top: 0px; left: 0px; display: block; z-index: 3; opacity: 1; width: 520px;">
                        	<li>
                            	<div class="media-pic">
                                	<img alt="" src="/sites/all/themes/drivehive/images/temp/tweet-pic1.jpg">
                                </div><!-- /media-pic -->
                                <div class="media-txt">
                                	<a href="#">Chris Martin</a> : I can't believe it is just 12 days away. Waiting to see all our fans tune in → 18 minutes ago
                                </div><!-- /media-txt -->
                            </li>
							<li>
                            	<div class="media-pic">
                                	<img alt="" src="/sites/all/themes/drivehive/images/temp/tweet-pic2.jpg">
                                </div><!-- /media-pic -->
                                <div class="media-txt">
									<a href="#">anieprice@DriveHive</a> : you rule what would I do without you guys???? Listening to Rush of Blood right now #:) → 2 hours ago
								</div><!-- /media-txt -->
                            </li>
                            <li>
                            	<div class="media-pic">
                                	<img alt="" src="/sites/all/themes/drivehive/images/temp/tweet-pic3.jpg">
                                </div><!-- /media-pic -->
                                <div class="media-txt">
									<a href="#">Katie Williams</a> : Counting down to the DriveHive amazingness!!! Get ready players #yeahbuddy → 18 hours ago
                                </div><!-- /media-txt -->
                            </li>
							<li>
                            	<div class="media-pic">
                                	<img alt="" src="/sites/all/themes/drivehive/images/temp/tweet-pic4.jpg">
                                </div><!-- /media-pic -->
                                <div class="media-txt">
									<a href="#">John Weber@Coldplay</a> : What took so long buds?? Counting the seconds to hear Angel #DriveHive → 22 hours ago
								</div><!-- /media-txt -->
                            </li>
                        </ul>
                        <ul class="tweet" style="position: absolute; top: -210px; left: 0px; display: none; z-index: 2; opacity: 1; width: 520px;">
                        	<li>
                            	<div class="media-pic">
                                	<img alt="" src="/sites/all/themes/drivehive/images/temp/tweet-pic1.jpg">
                                </div><!-- /media-pic -->
                                <div class="media-txt">
                                	<a href="#">Chris Martin</a> : I can't believe it is just 12 days away. Waiting to see all our fans tune in → 18 minutes ago
                                </div><!-- /media-txt -->
                            </li>
							<li>
                            	<div class="media-pic">
                                	<img alt="" src="/sites/all/themes/drivehive/images/temp/tweet-pic2.jpg">
                                </div><!-- /media-pic -->
                                <div class="media-txt">
									<a href="#">anieprice@DriveHive</a> : you rule what would I do without you guys???? Listening to Rush of Blood right now #:) → 2 hours ago
								</div><!-- /media-txt -->
                            </li>
                            <li>
                            	<div class="media-pic">
                                	<img alt="" src="/sites/all/themes/drivehive/images/temp/tweet-pic3.jpg">
                                </div><!-- /media-pic -->
                                <div class="media-txt">
									<a href="#">Katie Williams</a> : Counting down to the DriveHive amazingness!!! Get ready players #yeahbuddy → 18 hours ago
                                </div><!-- /media-txt -->
                            </li>
							<li>
                            	<div class="media-pic">
                                	<img alt="" src="/sites/all/themes/drivehive/images/temp/tweet-pic4.jpg">
                                </div><!-- /media-pic -->
                                <div class="media-txt">
									<a href="#">John Weber@Coldplay</a> : What took so long buds?? Counting the seconds to hear Angel #DriveHive → 22 hours ago
								</div><!-- /media-txt -->
                            </li>
                        </ul>
                    	</div>
                    	
                        
                        <h4>FACEBOOK</h4>
                        <div id="divFace" style="position: relative; width: 530px; height: 262px; overflow: hidden;">
                        <ul class="face" style="position: absolute; top: 0px; left: 0px; display: block; z-index: 3; opacity: 1; width: 530px;">
                        	<li>
                            	<div class="media-pic">
                                	<img alt="" src="/sites/all/themes/drivehive/images/temp/face-pic1.jpg">
                                </div><!-- /media-pic -->
                                <div class="media-txt">
                                	<a href="#">Awwwww snap! Coldplay = Awesome...this is all</a> by Jered Wilkerson 
                                </div><!-- /media-txt -->
                            </li>
							<li>
                            	<div class="media-pic">
                                	<img alt="" src="/sites/all/themes/drivehive/images/temp/face-pic2.jpg">
                                </div><!-- /media-pic -->
                                <div class="media-txt">
									<a href="#">Can't wait to see this! I can't wait for the next album to come out either. Great pic Drive Hive!!!!!  </a> by Christine Edgington
								</div><!-- /media-txt -->
                            </li>
                            <li>
                            	<div class="media-pic">
                                	<img alt="" src="/sites/all/themes/drivehive/images/temp/face-pic3.jpg">
                                </div><!-- /media-pic -->
                                <div class="media-txt">
									<a href="#">And the Countdown Begins</a> 1,259 people recommend this
                                </div><!-- /media-txt -->
                            </li>
							<li>
                            	<div class="media-pic">
                                	<img alt="" src="/sites/all/themes/drivehive/images/temp/face-pic4.jpg">
                                </div><!-- /media-pic -->
                                <div class="media-txt">
									<a href="#">Dig - N - It. Why we have to wait until December???</a> by Curtis Meyers
								</div><!-- /media-txt -->
                            </li>
                        </ul>
                        <ul class="face" style="position: absolute; top: -262px; left: 0px; display: none; z-index: 2; opacity: 1; width: 530px;">
                        	<li>
                            	<div class="media-pic">
                                	<img alt="" src="/sites/all/themes/drivehive/images/temp/face-pic1.jpg">
                                </div><!-- /media-pic -->
                                <div class="media-txt">
                                	<a href="#">Awwwww snap! Coldplay = Awesome...this is all</a> by Jered Wilkerson 
                                </div><!-- /media-txt -->
                            </li>
							<li>
                            	<div class="media-pic">
                                	<img alt="" src="/sites/all/themes/drivehive/images/temp/face-pic2.jpg">
                                </div><!-- /media-pic -->
                                <div class="media-txt">
									<a href="#">Can't wait to see this! I can't wait for the next album to come out either. Great pic Drive Hive!!!!!  </a> by Christine Edgington
								</div><!-- /media-txt -->
                            </li>
                            <li>
                            	<div class="media-pic">
                                	<img alt="" src="/sites/all/themes/drivehive/images/temp/face-pic3.jpg">
                                </div><!-- /media-pic -->
                                <div class="media-txt">
									<a href="#">And the Countdown Begins</a> 1,259 people recommend this
                                </div><!-- /media-txt -->
                            </li>
							<li>
                            	<div class="media-pic">
                                	<img alt="" src="/sites/all/themes/drivehive/images/temp/face-pic4.jpg">
                                </div><!-- /media-pic -->
                                <div class="media-txt">
									<a href="#">Dig - N - It. Why we have to wait until December???</a> by Curtis Meyers
								</div><!-- /media-txt -->
                            </li>
                        </ul>
                        </div>
                        
                        <div class="fix"></div>
                    </div><!-- /frame -->
                </div>
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      

	<div id="event-detail-lower">


	</div> <!-- #event-detail-lower -->

  </div>
</article>

