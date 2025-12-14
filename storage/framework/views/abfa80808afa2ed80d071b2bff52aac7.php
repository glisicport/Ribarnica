<link href="<?php echo e(asset('assets/css/admin/about.css')); ?>" rel="stylesheet" />

<div class="wrapper">

    <div class="header">
        <h2 class="title">Upravljanje sadržajem – O nama</h2>

        <button class="btn-edit-about" onclick="openAboutModal()">
            <i class="fas fa-edit"></i> Izmeni O nama
        </button>
    </div>

    <!-- PRIKAZ PODATAKA -->
    <div class="about-box">

    <!-- TITEL -->
    <h2 class="about-title"><?php echo e($about->title); ?></h2>

    <!-- SHORT DESCRIPTION -->
    <div class="about-section">
        <h4 class="section-heading">Kratak opis</h4>
        <p class="section-text"><?php echo e($about->short_description); ?></p>
    </div>

    <!-- LONG DESCRIPTION -->
    <div class="about-section">
        <h4 class="section-heading">Dugi opis</h4>
        <p class="section-text long"><?php echo e($about->long_description); ?></p>
    </div>

    <!-- MISSION -->
    <div class="about-section">
        <h4 class="section-heading">Misija</h4>
        <p class="section-text"><?php echo e($about->mission); ?></p>
    </div>

    <!-- VISION -->
    <div class="about-section">
        <h4 class="section-heading">Vizija</h4>
        <p class="section-text"><?php echo e($about->vision); ?></p>
    </div>

    <!-- IMAGE -->
    <?php if($about->image): ?>
        <div class="about-image-box">
            <img src="<?php echo e(asset('storage/' . $about->image)); ?>" class="about-image">
        </div>
    <?php endif; ?>

</div>


</div>

<?php echo $__env->make('admin.about_us.aboutModal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<script>
    window.aboutData = {
        title: <?php echo json_encode($about->title, 15, 512) ?>,
        short_description: <?php echo json_encode($about->short_description, 15, 512) ?>,
        long_description: <?php echo json_encode($about->long_description, 15, 512) ?>,
        mission: <?php echo json_encode($about->mission, 15, 512) ?>,
        vision: <?php echo json_encode($about->vision, 15, 512) ?>
    };
</script>


<script src="<?php echo e(asset('assets/js/admin/about.js')); ?>"></script>
<?php /**PATH /var/www/html/resources/views/admin/about_us/index.blade.php ENDPATH**/ ?>