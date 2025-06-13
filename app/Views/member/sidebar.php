    
    <?php $segment1 = service('uri')->getSegment(1); ?>
    <ul class="nav flex-column text-white w-100">

        <li href="#" class="nav-link navlink text-white <?=($segment1 == 'member-dashboard')?'active':''?>">
            <span class="gap-icon"> <i class="fa-solid fa-gauge"></i> </span>
            <a href="<?=base_url('/member-dashboard')?>" class="text-white nav_items" >Dashboard</a>
        </li>
        <li href="#" class="nav-link navlink text-white <?=($segment1 == 'student-list' || $segment1 == 'student-cu')?'active':''?>">
            <span class="gap-icon">  <i class="fa-solid fa-face-smile"></i> </span>
            <a href="<?=base_url('/student-list')?>" class="text-white nav_items " > Student's List</a>
        </li>
        <li href="#" class="nav-link navlink text-white <?=($segment1 == 'bank-details')?'active':''?>">
            <span class="gap-icon"> <i class="fa-solid fa-money-bill-wave"></i> </span>
            <a href="<?=base_url('/bank-details')?>" class="text-white nav_items" > Bank Details</a>
        </li>
        <li href="#" class="nav-link navlink text-white <?=($segment1 == 'profile')?'active':''?>">
            <span class="gap-icon">  <i class="fa-solid fa-user"></i> </span>
            <a href="<?=base_url('/profile')?>" class="text-white nav_items" > My Profile</a>
        </li>
        <li href="#" class="nav-link navlink text-white <?=($segment1 == 'change-pass')?'active':''?>">
            <span class="gap-icon">  <i class="fa-solid fa-user"></i> </span>
            <a href="<?=base_url('/change-pass')?>" class="text-white nav_items" > Change Password</a>
        </li>
        <li href="#" class="nav-link navlink text-white">
            <span class="gap-icon"> <i class="fa-solid fa-right-from-bracket"></i> </span>
            <a href="<?=base_url('/member-logout')?>" class="text-white nav_items" onclick="return confirm('Are you sure?');"> Logout</a>
        </li>
    </ul>