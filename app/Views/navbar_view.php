<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        <button type="button" id="sidebarToggle" class="btn btn-info">
            <i class="fas fa-align-left"></i>
            <span class="p-2"><?php echo icon('three-dots') ?></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <ul class="nav navbar-nav">
                <?php if(isset($navbar_actions)){
                    if(is_array($navbar_actions)){
                        foreach($navbar_actions as $action){
                            echo $action.'&nbsp;';
                        }
                    }else{
                        echo $navbar_actions;
                    }
                } 
                ?>
            </ul>
        </div>
        
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto list-group list-group-flush">
                <?php foreach($navbar_title as $key=>$title): ?>
                <li class="nav-item <?php if($key==0) echo 'active'; ?>">
                    <a class="nav-link list-group-item list-group-item-action list-group-item-primary <?php if($key==$navbar_active) echo 'active'; ?>" href="<?php echo $navbar_link[$key]; ?>"><?php echo $title; ?></a>
                    
                </li>
                <?php endforeach; ?>

            </ul>
        </div>
    </div>
</nav>