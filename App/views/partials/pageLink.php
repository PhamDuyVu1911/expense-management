<nav class="page-link" style="<?php echo $hide = isset($func->handleDisplayPageLink()['display']) ? $func->handleDisplayPageLink()['display'] : ''; ?>">
    <a href="<?php echo $link = isset($func->handleDisplayPageLink()['url'][0]) ? $func->handleDisplayPageLink()['url'][0] : ''  ?>">
        <?php echo $controller = isset($func->handleDisplayPageLink()['url'][0]) ? $func->handleNameController() : ''; ?>
    </a>
    <!-- ----- -->
    <span><i class="fa-solid fa-chevron-right"></i></span>
    <!-- ----- -->
    <a onclick="handleLink()" class='<?php echo $active = isset($func->handleDisplayPageLink()['url']) ? 'active' : '' ?>'>
        <?php echo $controller = isset($func->handleDisplayPageLink()['url'][1]) ? $func->handleNameAction() : ''; ?>
    </a>
</nav>
<script>
    function handleLink() {
        window.location.href = window.location.href;
    }
</script>