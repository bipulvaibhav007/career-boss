    
    <?php $segment1 = service('uri')->getSegment(1); ?>
    <ul class="nav flex-column text-white w-100 pb-2">

        <li href="#" class="nav-link navlink text-white <?=($segment1 == 'student-dashboard')?'active':''?>">
            <a href="<?=base_url('/student-dashboard')?>" class="text-white nav_items" ><span class="gap-icon"> <i class="fa-solid fa-gauge"></i> </span> Dashboard</a>
        </li>
        
        <li href="#" class="nav-link navlink text-white <?=($segment1 == 'my-courses')?'active':''?>">
            <a href="<?=base_url('/my-courses')?>" class="text-white nav_items " ><span class="gap-icon">  <i class="fa-solid fa-face-smile"></i> </span> My Courses</a>
        </li>
        <li href="#" class="nav-link navlink text-white <?=($segment1 == 'live-classes')?'active':''?>">
            <a href="<?=base_url('/live-classes')?>" class="text-white nav_items " ><span class="gap-icon">  <i class="fa-solid fa-face-smile"></i> </span> Live Classes</a>
        </li>
        <li href="#" class="nav-link navlink text-white <?=($segment1 == 'live-chat')?'active':''?>">
            <a href="<?=base_url('/live-chat')?>" class="text-white nav_items" ><span class="gap-icon">  <i class="fa-solid fa-user"></i> </span> Live Chat with Teacher</a>
        </li>
        <li href="#" class="nav-link navlink text-white <?=($segment1 == 'notification')?'active':''?>">
            <a href="<?=base_url('/notification')?>" class="text-white nav_items " ><span class="gap-icon">  <i class="fa-solid fa-face-smile"></i> </span> Notification</a>
        </li>

        <li href="#" class="nav-link navlink text-white <?=($segment1 == 'account-profile' || $segment1 == 'account-payment' || $segment1 == 'account-quiz')?'active':''?>">
            <a href="<?=base_url('/account-profile')?>" class="text-white nav_items" ><span class="gap-icon"> <i class="fa-solid fa-money-bill-wave"></i> </span> Account</a>
        </li>
        <li href="#" class="nav-link navlink text-white <?=($segment1 == 'sample-paper')?'active':''?>">
            <a href="<?=base_url('/sample-paper')?>" class="text-white nav_items" ><span class="gap-icon">  <i class="fa-solid fa-user"></i> </span> Sample Paper</a>
        </li>
        <li href="#" class="nav-link navlink text-white <?=($segment1 == 'contact-us')?'active':''?>">
            <a href="<?=base_url('/contact-us')?>" class="text-white nav_items" ><span class="gap-icon">  <i class="fa-solid fa-face-smile"></i> </span> Contact Us</a>
        </li>
        <li href="#" class="nav-link navlink text-white <?=($segment1 == 'quiz' || $segment1 == 'quiz-list' || $segment1 == 'quiz-start' || $segment1 == 'quiz-finish' || $segment1 == 'check-ans')?'active':''?>">
            <a href="<?=base_url('/quiz')?>" class="text-white nav_items" ><span class="gap-icon">  <i class="fa-solid fa-face-smile"></i> </span> Test</a>
        </li>
        
        <li href="#" class="nav-link navlink text-white">
            <a href="<?=base_url('/student-logout')?>" class="text-white nav_items" onclick="return confirm('Are you sure you want to log out?');"><span class="gap-icon"> <i class="fa-solid fa-right-from-bracket"></i> </span> Logout</a>
        </li>
    </ul>