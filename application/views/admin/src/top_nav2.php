<div class="row">
  
  <!-- Profile Info and Notifications -->
  <div class="col-md-6 col-sm-8 clearfix">    
    <ul class="user-info pull-left pull-none-xsm">
    
            <!-- Profile Info -->
      <li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->
        
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="<?php echo base_url()."data/user_picture/$user_picture";?>" alt="" class="img-circle" width="44" />
          <?php echo $full_name
          
          ?>
        </a>
        <?php echo "(". $user_level . ")";?>
        <ul class="dropdown-menu">
          
          <!-- Reverse Caret -->
          <li class="caret"></li>
          
          <!-- Profile sub-links -->
          <li>
            <a href="<?php echo base_url(). "manage_user/profile" ;?>">
              <i class="entypo-user"></i>
              Your Profile
            </a>
            <a href="<?php echo base_url(). "admin/logout";?>">
              <i class="entypo-logout"></i>
              Logout
            </a>
          </li>
          
         
          
          
        </ul>
    
    </ul>
        
   
        
      </li>
    
    </ul>
  
  </div>
  
  <!-- Raw Links -->
  <div class="col-md-6 col-sm-4 clearfix hidden-xs">
    
    <ul class="list-inline links-list pull-right">
        
      <li>
        <a href="<?php echo base_url();?>" target='_blank' >
          <i class="entypo-globe"></i>
          Visit website
        </a>
      </li>
      <!--
      <li class="sep"></li>
      <li>
        <a href="#" >
          <i class="entypo-cog"></i>
          Setting
        </a>
      </li>
    -->
    <?php if ($user_level=="Administrator") { ?>
      <li class="sep"></li>
       <li>
        <a href="<?php echo base_url();?>manage_message" >
          <i class="entypo-mail"></i>
          Message
          <?php
            $CI =& get_instance();
            $CI->load->model('contact_model');
            $unread = $CI->contact_model->total_unread();
            if ($unread>0){
              echo "<span id='message_count' class='badge badge-success chat-notifications-badge'>$unread</span>";
            }
          ?>
          
        </a>
      </li>
     <?php } ?>
    </ul>
    
  </div>
</div>
<hr>
    
