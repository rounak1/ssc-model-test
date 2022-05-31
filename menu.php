<div class="profile__menu-left white-bg mb-50">
  <h3 class="profile__menu-title">
    <strong> <?php echo $user_data['name']; ?></strong><br/>
    <span><?php echo $user_data['school_name']; ?></span><br/>
    <span><?php echo $user_data['district']; ?></span>
  </h3>
  <div class="profile__menu-tab">
     <div class="nav nav-tabs flex-column justify-content-start text-start" >
        <a class="nav-link" href="myprofile.php"> <i class="fa-regular fa-square-list"></i> ড্যাশবোর্ড</a>

        <a class="nav-link" href="editprofile.php"> <i class="fa-regular fa-user"></i> এডিট প্রোফাইল</a>
        
        <a class="nav-link logout-link" href="logout.php"> <i class="fa-regular fa-arrow-right-from-bracket"></i> লগ আউট</a>
     </div>

   </div>
</div>