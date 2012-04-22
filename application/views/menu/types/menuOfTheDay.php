<div id="menu">
    <h1><?php echo $menuType['name'] ?></h1>
    <div class="description"><?php echo $menuType['description'] ?></div>
    <div id="calendar"></div>
    <?php foreach ($sections as $section): ?>
        <div class="section">
            <h2><?php echo $section['name'] ?></h2>
            <ul class="products">

            </ul>
        </div>
    <?php endforeach ?>
</div>
<script type="text/javascript" language="javascript">
    $("#calendar").datepicker();
</script>
